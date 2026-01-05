<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\UserAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = Session::get('cart', []);
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        $addresses = UserAddress::where('user_id', Auth::id())->get();

        return view('frontend.checkout.index', compact('cart', 'total', 'addresses'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'payment_method' => 'required|in:cod,online',
            'shipping_method' => 'required|in:new,existing',
            'address_id' => 'required_if:shipping_method,existing',
            'name' => 'required_if:shipping_method,new',
            'phone' => 'required_if:shipping_method,new',
            'address_line1' => 'required_if:shipping_method,new',
            'city' => 'required_if:shipping_method,new',
            'state' => 'required_if:shipping_method,new',
            'zip' => 'required_if:shipping_method,new',
            'country' => 'required_if:shipping_method,new',
        ]);

        $cart = Session::get('cart', []);
        if (empty($cart)) {
            return redirect()->route('cart.index');
        }

        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        try {
            DB::beginTransaction();

            $shippingAddress = [];

            if ($request->shipping_method == 'existing') {
                $address = UserAddress::where('user_id', Auth::id())->where('id', $request->address_id)->firstOrFail();
                $shippingAddress = $address->toArray();
            } else {
                $shippingAddress = [
                    'name' => $request->name,
                    'phone' => $request->phone,
                    'address_line1' => $request->address_line1,
                    'address_line2' => $request->address_line2,
                    'city' => $request->city,
                    'state' => $request->state,
                    'zip' => $request->zip,
                    'country' => $request->country,
                ];

                // Save new address if user wants (checkbox usually, but auto-saving for now for simplicity)
                UserAddress::create(array_merge($shippingAddress, ['user_id' => Auth::id()]));
            }

            $order = Order::create([
                'user_id' => Auth::id(),
                'order_number' => 'ORD-' . strtoupper(Str::random(10)),
                'subtotal' => $total, // For now total = subtotal
                'total' => $total,
                'discount' => 0,
                'payment_method' => $request->payment_method,
                'payment_status' => 'pending',
                'status' => 'pending',
                'shipping_address' => $shippingAddress,
            ]);

            foreach ($cart as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item['id'],
                    'product_name' => $item['name'],
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                    'total' => $item['price'] * $item['quantity'],
                ]);

                // Reduce Stock
                // Product::where('id', $item['id'])->decrement('stock_quantity', $item['quantity']);
            }

            DB::commit();
            Session::forget('cart');

            return redirect()->route('checkout.success', $order)->with('success', 'Order placed successfully!');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Failed to place order: ' . $e->getMessage());
        }
    }

    public function success(Order $order)
    {
        if ($order->user_id != Auth::id()) {
            abort(403);
        }
        return view('frontend.checkout.success', compact('order'));
    }
}
