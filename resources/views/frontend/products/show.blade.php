@extends('frontend.layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <div class="bg-white rounded-lg shadow-sm p-6 md:p-8 flex flex-col md:flex-row gap-8">
            <!-- Product Images -->
            <div class="w-full md:w-1/2">
                @if($product->images && count($product->images) > 0)
                    <div
                        class="mb-4 h-96 bg-gray-50 rounded-lg flex items-center justify-center overflow-hidden border border-gray-100">
                        <img src="{{ Storage::url($product->images[0]) }}" alt="{{ $product->name }}"
                            class="max-h-full max-w-full object-contain" id="mainImage">
                    </div>
                    <div class="flex space-x-2 overflow-x-auto pb-2">
                        @foreach($product->images as $image)
                            <button onclick="document.getElementById('mainImage').src = '{{ Storage::url($image) }}'"
                                class="border border-gray-200 rounded p-1 hover:border-green-500 transition flex-shrink-0 h-20 w-20 flex items-center justify-center">
                                <img src="{{ Storage::url($image) }}" class="max-h-full max-w-full object-contain">
                            </button>
                        @endforeach
                    </div>
                @else
                    <div class="h-96 bg-gray-100 rounded-lg flex items-center justify-center text-gray-400">
                        No Image Available
                    </div>
                @endif
            </div>

            <!-- Product Details -->
            <div class="w-full md:w-1/2">
                <h1 class="text-3xl font-bold text-gray-800 mb-2">{{ $product->name }}</h1>
                <div class="flex items-center text-sm text-gray-500 mb-4">
                    <span class="mr-4">Brand: <a href="#"
                            class="text-green-600 hover:underline">{{ $product->brand ? $product->brand->name : 'Generic' }}</a></span>
                    <span>Category: <a href="{{ route('products.index', ['category' => $product->category->slug]) }}"
                            class="text-green-600 hover:underline">{{ $product->category->name }}</a></span>
                </div>

                <div class="mb-6">
                    @if($product->discount_price)
                        <div class="flex items-baseline space-x-2">
                            <span class="text-3xl font-bold text-gray-900">₹{{ $product->discount_price }}</span>
                            <span class="text-lg text-gray-400 line-through">₹{{ $product->price }}</span>
                            <span class="text-green-600 text-sm font-bold bg-green-100 px-2 py-1 rounded">
                                {{ round((($product->price - $product->discount_price) / $product->price) * 100) }}% OFF
                            </span>
                        </div>
                    @else
                        <span class="text-3xl font-bold text-gray-900">₹{{ $product->price }}</span>
                    @endif
                    <p class="text-sm text-gray-500 mt-1">Inclusive of all taxes</p>
                </div>

                @if($product->stock_quantity > 0)
                    <div class="mb-6">
                        <span class="text-green-600 font-medium">In Stock</span>
                    </div>
                @else
                    <div class="mb-6">
                        <span class="text-red-600 font-medium">Out of Stock</span>
                    </div>
                @endif

                <form action="{{ route('cart.add') }}" method="POST" class="mb-8 border-b border-gray-200 pb-8">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">

                    <div class="flex items-center space-x-4 mb-4">
                        <div class="flex items-center border border-gray-300 rounded">
                            <button type="button"
                                onclick="const qty = document.getElementById('qty'); if(qty.value > 1) qty.value--;"
                                class="px-3 py-1 bg-gray-50 hover:bg-gray-100 text-gray-600">-</button>
                            <input type="number" name="quantity" id="qty" value="1" min="1"
                                max="{{ $product->stock_quantity }}"
                                class="w-12 text-center border-l border-r border-gray-300 py-1 outline-none text-gray-700 font-medium appearance-none">
                            <button type="button" onclick="const qty = document.getElementById('qty'); qty.value++;"
                                class="px-3 py-1 bg-gray-50 hover:bg-gray-100 text-gray-600">+</button>
                        </div>

                        <button type="submit"
                            class="flex-1 bg-green-600 text-white font-bold py-3 px-6 rounded hover:bg-green-700 transition flex items-center justify-center {{ $product->stock_quantity <= 0 ? 'opacity-50 cursor-not-allowed' : '' }}"
                            {{ $product->stock_quantity <= 0 ? 'disabled' : '' }}>
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z">
                                </path>
                            </svg>
                            Add to Cart
                        </button>
                    </div>
                </form>

                <div class="prose prose-sm text-gray-600 max-w-none">
                    <h3 class="text-lg font-bold text-gray-800 mb-2">Description</h3>
                    <p>{!! nl2br(e($product->description ?? $product->short_description)) !!}</p>
                </div>
            </div>
        </div>
    </div>
@endsection