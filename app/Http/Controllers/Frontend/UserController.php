<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function orders()
    {
        $orders = Order::where('user_id', Auth::id())
            ->with(['items.product'])
            ->latest()
            ->paginate(5);

        return view('frontend.user.orders', compact('orders'));
    }
}
