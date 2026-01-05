<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function index()
    {
        $cart = Session::get('cart', []);
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }
        return view('frontend.cart', compact('cart', 'total'));
    }

    public function add(Request $request)
    {
        $product = Product::find($request->product_id);

        if (!$product) {
            return redirect()->back()->with('error', 'Product not found.');
        }

        $cart = Session::get('cart', []);
        $quantity = $request->input('quantity', 1);

        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity'] += $quantity;
        } else {
            $cart[$product->id] = [
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->discount_price ?: $product->price,
                'image' => $product->images ? $product->images[0] : null,
                'slug' => $product->slug,
                'quantity' => $quantity,
            ];
        }

        // Check stock (simplified)
        if ($cart[$product->id]['quantity'] > $product->stock_quantity) {
            return redirect()->back()->with('error', 'Not enough stock available.');
        }

        Session::put('cart', $cart);

        return redirect()->route('cart.index')->with('success', 'Product added to cart!');
    }

    public function update(Request $request)
    {
        if ($request->id && $request->quantity) {
            $cart = Session::get('cart');
            $cart[$request->id]['quantity'] = $request->quantity;
            Session::put('cart', $cart);
            return redirect()->back()->with('success', 'Cart updated successfully');
        }
    }

    public function remove(Request $request)
    {
        if ($request->id) {
            $cart = Session::get('cart');
            if (isset($cart[$request->id])) {
                unset($cart[$request->id]);
                Session::put('cart', $cart);
            }
            return redirect()->back()->with('success', 'Product removed successfully');
        }
    }
}
