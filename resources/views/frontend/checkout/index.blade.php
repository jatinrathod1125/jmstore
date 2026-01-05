@extends('frontend.layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Checkout</h1>

        <div class="flex flex-col lg:flex-row gap-8">
            <!-- Delivery Details -->
            <div class="flex-1">
                <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-200">
                    <form action="{{ route('checkout.store') }}" method="POST" id="checkout-form">
                        @csrf

                        <!-- Address Section -->
                        <div class="mb-8">
                            <h2 class="text-lg font-bold text-gray-900 mb-4">Delivery Address</h2>

                            @if($addresses->count() > 0)
                                <div class="mb-4 space-y-3">
                                    @foreach($addresses as $address)
                                        <label
                                            class="flex items-start p-3 border border-gray-200 rounded cursor-pointer hover:border-green-500">
                                            <input type="radio" name="shipping_method" value="existing" @if($loop->first) checked
                                            @endif class="mt-1 text-green-600 focus:ring-green-500"
                                                onclick="document.getElementById('new-address-form').style.display = 'none'; document.getElementById('address-id-input').disabled = false;">
                                            <input type="hidden" name="address_id" value="{{ $address->id }}" id="address-id-input">
                                            <div class="ml-3">
                                                <span class="block font-medium text-gray-900">{{ $address->name }}
                                                    ({{ $address->phone }})</span>
                                                <span class="block text-sm text-gray-500">
                                                    {{ $address->address_line1 }}
                                                    @if($address->address_line2), {{ $address->address_line2 }} @endif
                                                    <br>
                                                    {{ $address->city }}, {{ $address->state }} {{ $address->zip }}
                                                </span>
                                            </div>
                                        </label>
                                    @endforeach

                                    <label
                                        class="flex items-center p-3 border border-gray-200 rounded cursor-pointer hover:border-green-500">
                                        <input type="radio" name="shipping_method" value="new"
                                            class="text-green-600 focus:ring-green-500"
                                            onclick="document.getElementById('new-address-form').style.display = 'block'; document.getElementById('address-id-input').disabled = true;">
                                        <span class="ml-3 font-medium text-gray-900">Add New Address</span>
                                    </label>
                                </div>
                            @else
                                <input type="hidden" name="shipping_method" value="new">
                            @endif

                            <!-- New Address Form (Toggle) -->
                            <div id="new-address-form"
                                class="{{ $addresses->count() > 0 ? 'hidden' : '' }} space-y-4 border-t border-gray-200 pt-4 mt-4">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                                        <input type="text" name="name"
                                            class="w-full border border-gray-300 rounded px-3 py-2 outline-none focus:border-green-500">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Phone Number</label>
                                        <input type="tel" name="phone"
                                            class="w-full border border-gray-300 rounded px-3 py-2 outline-none focus:border-green-500">
                                    </div>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Address Line 1</label>
                                    <input type="text" name="address_line1"
                                        class="w-full border border-gray-300 rounded px-3 py-2 outline-none focus:border-green-500">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Address Line 2
                                        (Optional)</label>
                                    <input type="text" name="address_line2"
                                        class="w-full border border-gray-300 rounded px-3 py-2 outline-none focus:border-green-500">
                                </div>
                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">City</label>
                                        <input type="text" name="city"
                                            class="w-full border border-gray-300 rounded px-3 py-2 outline-none focus:border-green-500">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">State</label>
                                        <input type="text" name="state"
                                            class="w-full border border-gray-300 rounded px-3 py-2 outline-none focus:border-green-500">
                                    </div>
                                </div>
                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Zip Code</label>
                                        <input type="text" name="zip"
                                            class="w-full border border-gray-300 rounded px-3 py-2 outline-none focus:border-green-500">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Country</label>
                                        <input type="text" name="country" value="India"
                                            class="w-full border border-gray-300 rounded px-3 py-2 outline-none focus:border-green-500">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Payment Section -->
                        <div class="mb-8">
                            <h2 class="text-lg font-bold text-gray-900 mb-4">Payment Method</h2>
                            <div class="space-y-3">
                                <label
                                    class="flex items-center p-4 border border-gray-200 rounded cursor-pointer hover:border-green-500">
                                    <input type="radio" name="payment_method" value="cod" checked
                                        class="text-green-600 focus:ring-green-500 h-5 w-5">
                                    <span class="ml-3 font-medium text-gray-900">Cash on Delivery (COD)</span>
                                </label>
                                <label
                                    class="flex items-center p-4 border border-gray-200 rounded cursor-pointer hover:border-green-500 opacity-70">
                                    <input type="radio" name="payment_method" value="online" disabled
                                        class="text-green-600 focus:ring-green-500 h-5 w-5">
                                    <div class="ml-3">
                                        <span class="block font-medium text-gray-900">Online Payment (UPI / Card)</span>
                                        <span class="text-xs text-gray-500">Coming Soon</span>
                                    </div>
                                </label>
                            </div>
                        </div>

                        <button type="submit"
                            class="w-full bg-green-600 text-white font-bold py-4 rounded-lg hover:bg-green-700 transition">Place
                            Order</button>
                    </form>
                </div>
            </div>

            <!-- Order Summary -->
            <div class="w-full lg:w-80">
                <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-200 sticky top-24">
                    <h2 class="text-lg font-bold text-gray-900 mb-4">Order Summary</h2>
                    <div class="space-y-3 mb-6">
                        @foreach($cart as $item)
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">{{ $item['name'] }} x {{ $item['quantity'] }}</span>
                                <span class="font-medium text-gray-900">₹{{ $item['price'] * $item['quantity'] }}</span>
                            </div>
                        @endforeach
                        <div class="border-t pt-3 flex justify-between text-base font-bold text-gray-900">
                            <span>Total Payable</span>
                            <span>₹{{ $total }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection