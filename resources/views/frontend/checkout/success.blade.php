@extends('frontend.layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-16 flex items-center justify-center">
        <div class="bg-white rounded-lg shadow-sm p-8 max-w-md w-full text-center border border-gray-200">
            <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-6">
                <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
            </div>
            <h1 class="text-2xl font-bold text-gray-900 mb-2">Order Placed Successfully!</h1>
            <p class="text-gray-500 mb-6">Thank you for your purchase. Your order #{{ $order->order_number }} has been
                placed.</p>

            <div class="space-y-3">
                <a href="{{ route('home') }}"
                    class="block w-full bg-green-600 text-white font-bold py-2 rounded-lg hover:bg-green-700 transition">Continue
                    Shopping</a>
                <a href="{{ route('user.orders') }}"
                    class="block w-full bg-gray-100 text-gray-700 font-bold py-2 rounded-lg hover:bg-gray-200 transition">View
                    My Orders</a>
            </div>
        </div>
    </div>
@endsection