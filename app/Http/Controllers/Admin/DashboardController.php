<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Order;
use App\Models\User;
use App\Models\Product;

class DashboardController extends Controller
{
    public function index()
    {
        $totalOrders = Order::count();
        $totalRevenue = Order::where('payment_status', 'paid')->sum('total'); // Assuming only paid orders count towards revenue, or just simple sum if not tracking payment status rigorously yet.
        // Let's stick to simple sum for now if payment_status isn't fully utilized, or check if 'status' != 'cancelled'.
        // For simplicity based on typical requested "Total Revenue":
        $totalRevenue = Order::sum('total');

        $totalCustomers = User::where('role', '!=', 'admin')->count();
        $totalProducts = Product::count();

        $recentOrders = Order::with('user')->latest()->take(5)->get();

        return view('admin.dashboard', compact('totalOrders', 'totalRevenue', 'totalCustomers', 'totalProducts', 'recentOrders'));
    }
}
