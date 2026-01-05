@extends('admin.layouts.app')

@section('content')
<div class="max-w-5xl mx-auto">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Order Details #{{ $order->order_number }}</h2>
        <a href="{{ route('admin.orders.index') }}" class="text-gray-600 hover:text-gray-800">Back</a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Order Items -->
        <div class="lg:col-span-2 space-y-6">
            <div class="bg-white rounded-lg shadow overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                    <h3 class="text-lg font-medium text-gray-900">Items</h3>
                </div>
                <div class="p-6">
                    <ul class="divide-y divide-gray-200">
                        @foreach($order->items as $item)
                        <li class="py-4 flex">
                            @if($item->product && $item->product->images)
                                <img src="{{ Storage::url($item->product->images[0]) }}" alt="{{ $item->product_name }}" class="h-16 w-16 rounded object-cover">
                            @else
                                <div class="h-16 w-16 bg-gray-200 rounded flex items-center justify-center text-gray-500 text-xs">No Img</div>
                            @endif
                            
                            <div class="ml-4 flex-1">
                                <h4 class="text-sm font-medium text-gray-900">{{ $item->product_name }}</h4>
                                <p class="text-sm text-gray-500">Quantity: {{ $item->quantity }}</p>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-900">₹{{ $item->total }}</p>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                    <div class="border-t border-gray-200 pt-4 mt-4 text-right space-y-2">
                        <div class="flex justify-between text-sm text-gray-600">
                            <span>Subtotal</span>
                            <span>₹{{ $order->subtotal }}</span>
                        </div>
                        <div class="flex justify-between text-sm text-gray-600">
                            <span>Discount</span>
                            <span>-₹{{ $order->discount }}</span>
                        </div>
                        <div class="flex justify-between text-lg font-bold text-gray-900 pt-2">
                            <span>Total</span>
                            <span>₹{{ $order->total }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Status Update -->
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Update Status</h3>
                <form action="{{ route('admin.orders.update', $order) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-4">
                        <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Order Status</label>
                        <select name="status" id="status" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500 outline-none">
                            <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>Processing</option>
                            <option value="shipped" {{ $order->status == 'shipped' ? 'selected' : '' }}>Shipped</option>
                            <option value="delivered" {{ $order->status == 'delivered' ? 'selected' : '' }}>Delivered</option>
                            <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                        </select>
                    </div>

                    <div class="mb-6">
                        <label for="payment_status" class="block text-sm font-medium text-gray-700 mb-1">Payment Status</label>
                         <select name="payment_status" id="payment_status" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500 outline-none">
                            <option value="pending" {{ $order->payment_status == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="paid" {{ $order->payment_status == 'paid' ? 'selected' : '' }}>Paid</option>
                            <option value="failed" {{ $order->payment_status == 'failed' ? 'selected' : '' }}>Failed</option>
                        </select>
                    </div>

                    <button type="submit" class="w-full bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">Update Order</button>
                </form>
            </div>

            <!-- Customer Details -->
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Customer Details</h3>
                <p class="text-sm font-medium text-gray-900">{{ $order->user ? $order->user->name : 'Guest User' }}</p>
                <p class="text-sm text-gray-500">{{ $order->user ? $order->user->email : '' }}</p>
            </div>

            <!-- Shipping Address -->
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Shipping Address</h3>
                @php
                    $address = $order->shipping_address;
                    // Handle if address is json string or array
                    if(is_string($address)) $address = json_decode($address, true);
                @endphp
                <address class="text-sm text-gray-600 not-italic">
                    <strong>{{ $address['name'] ?? 'N/A' }}</strong><br>
                    {{ $address['address_line1'] ?? '' }}<br>
                    {{ $address['address_line2'] ?? '' }}<br>
                    {{ $address['city'] ?? '' }}, {{ $address['state'] ?? '' }} {{ $address['zip'] ?? '' }}<br>
                    {{ $address['country'] ?? '' }}<br>
                    Phone: {{ $address['phone'] ?? 'N/A' }}
                </address>
            </div>
        </div>
    </div>
</div>
@endsection
