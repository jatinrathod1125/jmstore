@extends('frontend.layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <div class="flex flex-col md:flex-row gap-8">
            <!-- Sidebar -->
            <div class="w-full md:w-1/4">
                <div class="bg-white rounded-lg shadow-md p-6">
                    <div class="flex items-center space-x-4 mb-6">
                        <div
                            class="h-12 w-12 rounded-full bg-green-100 flex items-center justify-center text-green-600 font-bold text-xl">
                            {{ substr($user->name, 0, 1) }}
                        </div>
                        <div>
                            <h3 class="font-semibold text-gray-900">{{ $user->name }}</h3>
                            <p class="text-sm text-gray-500">{{ $user->email }}</p>
                        </div>
                    </div>
                    <nav class="space-y-2">
                        <a href="{{ route('user.dashboard') }}"
                            class="flex items-center text-green-600 font-medium px-4 py-2 bg-green-50 rounded-md">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                                </path>
                            </svg>
                            Dashboard
                        </a>
                        <a href="{{ route('user.orders') }}"
                            class="flex items-center text-gray-600 hover:text-green-600 px-4 py-2 hover:bg-gray-50 rounded-md transition-colors">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                            </svg>
                            My Orders
                        </a>
                        <form method="POST" action="{{ route('logout') }}" class="mt-4 pt-4 border-t border-gray-100">
                            @csrf
                            <button type="submit"
                                class="w-full flex items-center text-red-600 hover:text-red-700 px-4 py-2 hover:bg-red-50 rounded-md transition-colors">
                                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                                    </path>
                                </svg>
                                Logout
                            </button>
                        </form>
                    </nav>
                </div>
            </div>

            <!-- Main Content -->
            <div class="w-full md:w-3/4">
                <h1 class="text-2xl font-bold text-gray-800 mb-6">Overview</h1>

                <!-- Stats -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-100">
                        <div class="text-gray-500 text-sm mb-1">Total Orders</div>
                        <div class="text-2xl font-bold text-gray-900">{{ $recentOrders->count() }}</div>
                        <!-- Ideally total count -->
                    </div>
                    <!-- Add more stats if needed -->
                </div>

                <!-- Recent Orders -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center">
                        <h2 class="font-semibold text-gray-800">Recent Orders</h2>
                        <a href="{{ route('user.orders') }}" class="text-sm text-green-600 hover:text-green-700">View
                            All</a>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left">
                            <thead class="bg-gray-50 text-gray-600 text-xs uppercase">
                                <tr>
                                    <th class="px-6 py-3">Order ID</th>
                                    <th class="px-6 py-3">Date</th>
                                    <th class="px-6 py-3">Status</th>
                                    <th class="px-6 py-3">Total</th>
                                    <th class="px-6 py-3">Action</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @forelse($recentOrders as $order)
                                                        <tr>
                                                            <td class="px-6 py-4 text-sm font-medium text-gray-900">#{{ $order->id }}</td>
                                                            <td class="px-6 py-4 text-sm text-gray-500">{{ $order->created_at->format('M d, Y') }}
                                                            </td>
                                                            <td class="px-6 py-4">
                                                                <span
                                                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                                                        {{ $order->status == 'completed' ? 'bg-green-100 text-green-800' :
                                    ($order->status == 'pending' ? 'bg-yellow-100 text-yellow-800' : 'bg-gray-100 text-gray-800') }}">
                                                                    {{ ucfirst($order->status) }}
                                                                </span>
                                                            </td>
                                                            <td class="px-6 py-4 text-sm text-gray-900">${{ number_format($order->total ?? 0, 2) }}
                                                            </td>
                                                            <td class="px-6 py-4 text-sm">
                                                                <a href="#" class="text-green-600 hover:text-green-900">View</a>
                                                            </td>
                                                        </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-6 py-4 text-center text-sm text-gray-500">No orders found.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection