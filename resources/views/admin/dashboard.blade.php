@extends('admin.layouts.app')

@section('content')
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Stat Card -->
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 bg-blue-100 rounded-full text-blue-600 mr-4">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                    </svg>
                </div>
                <div>
                    <p class="text-sm text-gray-500 font-medium">Total Orders</p>
                    <p class="text-2xl font-bold text-gray-800">1,254</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 bg-green-100 rounded-full text-green-600 mr-4">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                        </path>
                    </svg>
                </div>
                <div>
                    <p class="text-sm text-gray-500 font-medium">Total Revenue</p>
                    <p class="text-2xl font-bold text-gray-800">₹4,25,000</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 bg-purple-100 rounded-full text-purple-600 mr-4">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z">
                        </path>
                    </svg>
                </div>
                <div>
                    <p class="text-sm text-gray-500 font-medium">Customers</p>
                    <p class="text-2xl font-bold text-gray-800">3,400</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 bg-yellow-100 rounded-full text-yellow-600 mr-4">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                    </svg>
                </div>
                <div>
                    <p class="text-sm text-gray-500 font-medium">Total Products</p>
                    <p class="text-2xl font-bold text-gray-800">540</p>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white shadow rounded-lg p-6">
        <h3 class="text-lg font-bold text-gray-800 mb-4">Recent Orders</h3>
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="border-b border-gray-200 text-gray-500 text-sm">
                        <th class="py-3 px-4">Order ID</th>
                        <th class="py-3 px-4">Customer</th>
                        <th class="py-3 px-4">Date</th>
                        <th class="py-3 px-4">Status</th>
                        <th class="py-3 px-4">Total</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    <tr class="hover:bg-gray-50">
                        <td class="py-3 px-4 font-medium text-green-600">#ORD-2541</td>
                        <td class="py-3 px-4">Rahul Kumar</td>
                        <td class="py-3 px-4">Jan 05, 2026</td>
                        <td class="py-3 px-4"><span
                                class="bg-yellow-100 text-yellow-700 px-2 py-1 rounded text-xs">Pending</span></td>
                        <td class="py-3 px-4">₹1,250</td>
                    </tr>
                    <tr class="hover:bg-gray-50">
                        <td class="py-3 px-4 font-medium text-green-600">#ORD-2540</td>
                        <td class="py-3 px-4">Priya Singh</td>
                        <td class="py-3 px-4">Jan 04, 2026</td>
                        <td class="py-3 px-4"><span
                                class="bg-green-100 text-green-700 px-2 py-1 rounded text-xs">Delivered</span></td>
                        <td class="py-3 px-4">₹850</td>
                    </tr>
                    <tr class="hover:bg-gray-50">
                        <td class="py-3 px-4 font-medium text-green-600">#ORD-2539</td>
                        <td class="py-3 px-4">Amit Sharma</td>
                        <td class="py-3 px-4">Jan 04, 2026</td>
                        <td class="py-3 px-4"><span
                                class="bg-blue-100 text-blue-700 px-2 py-1 rounded text-xs">Processing</span></td>
                        <td class="py-3 px-4">₹2,400</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection