@extends('frontend.layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-gray-800">My Orders</h1>
    </div>

    <div class="space-y-6">
        @forelse($orders as $order)
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
                <div class="bg-gray-50 px-6 py-4 border-b border-gray-200 flex flex-col md:flex-row md:items-center justify-between gap-4">
                    <div class="flex flex-col md:flex-row md:gap-8 text-sm">
                        <div>
                            <span class="block text-gray-500 uppercase text-xs">Order Placed</span>
                            <span class="font-medium text-gray-900">{{ $order->created_at->format('d M Y') }}</span>
                        </div>
                        <div>
                            <span class="block text-gray-500 uppercase text-xs">Total</span>
                            <span class="font-medium text-gray-900">₹{{ $order->total }}</span>
                        </div>
                         <div>
                            <span class="block text-gray-500 uppercase text-xs">Order #</span>
                            <span class="font-medium text-gray-900">{{ $order->order_number }}</span>
                        </div>
                    </div>
                     <div>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium capitalize 
                            {{ $order->status === 'delivered' ? 'bg-green-100 text-green-800' : '' }}
                            {{ $order->status === 'cancelled' ? 'bg-red-100 text-red-800' : '' }}
                            {{ $order->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : '' }}
                            {{ $order->status === 'processing' ? 'bg-blue-100 text-blue-800' : '' }}
                            {{ $order->status === 'shipped' ? 'bg-purple-100 text-purple-800' : '' }}
                        ">
                            {{ $order->status }}
                        </span>
                    </div>
                </div>
                
                <div class="p-6">
                    <ul class="divide-y divide-gray-200">
                        @foreach($order->items as $item)
                            <li class="py-4 flex">
                                <div class="flex-shrink-0 h-16 w-16 border border-gray-200 rounded-md overflow-hidden">
                                     @if($item->product && $item->product->images)
                                        <img src="{{ Storage::url($item->product->images[0]) }}" alt="{{ $item->product_name }}" class="h-full w-full object-cover">
                                    @else
                                        <div class="h-full w-full bg-gray-100 flex items-center justify-center text-xs text-gray-400">No Img</div>
                                    @endif
                                </div>
                                <div class="ml-4 flex-1 flex flex-col justify-between">
                                    <div>
                                        <h4 class="text-sm font-medium text-gray-900 mb-1">{{ $item->product_name }}</h4>
                                        <p class="text-sm text-gray-500">Qty: {{ $item->quantity }}</p>
                                    </div>
                                    <p class="text-sm font-medium text-gray-900 mt-2">₹{{ $item->total }}</p>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @empty
            <div class="text-center py-12 bg-white rounded-lg shadow-sm border border-gray-100">
                <svg class="h-16 w-16 text-gray-300 mx-auto mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" /></svg>
                <h2 class="text-xl font-medium text-gray-900 mb-2">No orders found</h2>
                <p class="text-gray-500 mb-6">You haven't placed any orders yet.</p>
                <a href="{{ route('home') }}" class="bg-green-600 text-white px-6 py-2 rounded-lg hover:bg-green-700 font-medium">Start Shopping</a>
            </div>
        @endforelse

        <div class="mt-4">
            {{ $orders->links() }}
        </div>
    </div>
</div>
@endsection
