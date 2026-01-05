@extends('frontend.layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Your Shopping Cart</h1>

    @if(session('cart') && count(session('cart')) > 0)
        <div class="flex flex-col lg:flex-row gap-8">
            <!-- Cart Items -->
            <div class="flex-1">
                <div class="bg-white rounded-lg shadow-sm overflow-hidden border border-gray-200">
                    <table class="w-full">
                        <thead class="bg-gray-50 border-b border-gray-200">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Product</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Price</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Quantity</th>
                                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Total</th>
                                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach(session('cart') as $id => $details)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            @if($details['image'])
                                                <img src="{{ Storage::url($details['image']) }}" alt="{{ $details['name'] }}" class="h-12 w-12 object-contain rounded border border-gray-100">
                                            @else
                                                <div class="h-12 w-12 bg-gray-100 rounded flex items-center justify-center text-xs text-gray-400">No Img</div>
                                            @endif
                                            <div class="ml-4">
                                                <a href="{{ route('products.show', $details['slug']) }}" class="text-sm font-medium text-gray-900 hover:text-green-600">{{ $details['name'] }}</a>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">₹{{ $details['price'] }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <form action="{{ route('cart.update') }}" method="POST" class="flex items-center">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $id }}">
                                            <input type="number" name="quantity" value="{{ $details['quantity'] }}" min="1" class="w-16 border border-gray-300 rounded px-2 py-1 text-sm focus:outline-none focus:border-green-500" onchange="this.form.submit()">
                                        </form>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-bold text-gray-900">
                                        ₹{{ $details['price'] * $details['quantity'] }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <form action="{{ route('cart.remove') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $id }}">
                                            <button type="submit" class="text-red-600 hover:text-red-900">Remove</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Summary -->
            <div class="w-full lg:w-80">
                <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-200">
                    <h2 class="text-lg font-bold text-gray-900 mb-4">Order Summary</h2>
                    <div class="space-y-3 mb-6">
                        <div class="flex justify-between text-sm text-gray-600">
                            <span>Subtotal</span>
                            <span>₹{{ $total }}</span>
                        </div>
                        <div class="flex justify-between text-sm text-gray-600">
                            <span>Shipping</span>
                            <span class="text-green-600">Free</span>
                        </div>
                        <div class="border-t pt-3 flex justify-between text-base font-bold text-gray-900">
                            <span>Total</span>
                            <span>₹{{ $total }}</span>
                        </div>
                    </div>
                    <a href="{{ route('checkout.index') }}" class="block w-full bg-green-600 text-center text-white font-bold py-3 rounded-lg hover:bg-green-700 transition">Proceed to Checkout</a>
                    <a href="{{ route('products.index') }}" class="block w-full text-center text-green-600 font-medium py-3 mt-2 hover:underline">Continue Shopping</a>
                </div>
            </div>
        </div>
    @else
        <div class="text-center py-12 bg-white rounded-lg shadow-sm border border-gray-100">
            <svg class="h-16 w-16 text-gray-300 mx-auto mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
            <h2 class="text-xl font-medium text-gray-900 mb-2">Your cart is empty</h2>
            <p class="text-gray-500 mb-6">Looks like you haven't added anything to your cart yet.</p>
            <a href="{{ route('products.index') }}" class="bg-green-600 text-white px-6 py-2 rounded-lg hover:bg-green-700 font-medium">Start Shopping</a>
        </div>
    @endif
</div>
@endsection
