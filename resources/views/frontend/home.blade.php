@extends('frontend.layouts.app')

@section('content')

<!-- Hero Slider -->
<div class="relative bg-gray-200">
    <div x-data="{ activeSlide: 0, slides: [{{ $sliders->count() }}] }" class="relative h-[700px]">
        @if($sliders->count() > 0)
            @foreach($sliders as $index => $slider)
                <div x-show="activeSlide === {{ $index }}" class="absolute inset-0 w-full h-full transition duration-500 transform">
                    <img src="{{ Storage::url($slider->image) }}" alt="{{ $slider->title }}" class="w-full h-full object-cover">
                </div>
            @endforeach
             
            <!-- Controls (Simple) -->
             <div class="absolute bottom-4 left-0 right-0 flex justify-center space-x-2">   
                @foreach($sliders as $index => $slider)
                    <button @click="activeSlide = {{ $index }}" class="h-2 w-2 rounded-full" :class="activeSlide === {{ $index }} ? 'bg-green-600' : 'bg-gray-400'"></button>
                @endforeach
            </div>
        @else
            <!-- Placeholder -->
            <div class="w-full h-full flex items-center justify-center bg-gray-300">
                <span class="text-gray-500 font-bold text-xl">No Banners Configured</span>
            </div>
        @endif
    </div>
</div>

<!-- Home Categories -->
<section class="container mx-auto px-4 py-8">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">Shop by Category</h2>
    <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4">
        @foreach($categories as $category)
            <a href="{{ route('products.index', ['category' => $category->slug]) }}" class="group block text-center">
                <div class="bg-white rounded-full h-32 w-32 mx-auto flex items-center justify-center shadow-sm group-hover:shadow-md transition overflow-hidden border border-gray-100">
                    @if($category->image)
                        <img src="{{ Storage::url($category->image) }}" alt="{{ $category->name }}" class="h-full w-full object-cover">
                    @else
                        <svg class="h-10 w-10 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" /></svg>
                    @endif
                </div>
                <h3 class="mt-3 text-sm font-medium text-gray-700 group-hover:text-green-600">{{ $category->name }}</h3>
            </a>
        @endforeach
    </div>
</section>

<!-- Featured Products -->
<section class="bg-gray-50 py-12">
    <div class="container mx-auto px-4">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-gray-800">Top Deals</h2>
            <a href="{{ route('products.index') }}" class="text-sm font-medium text-green-600 hover:text-green-700">View All</a>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-4">
            @foreach($featuredProducts as $product)
                <div class="bg-white rounded-lg shadow-sm hover:shadow-md transition p-3">
                    <a href="{{ route('products.show', $product->slug) }}" class="block relative h-40 overflow-hidden rounded mb-3">
                        @if($product->images && count($product->images) > 0)
                            <img src="{{ Storage::url($product->images[0]) }}" alt="{{ $product->name }}" class="w-full h-full object-contain">
                        @else
                             <div class="w-full h-full flex items-center justify-center bg-gray-100 text-gray-400 text-xs">No Image</div>
                        @endif
                         @if($product->discount_price)
                            <div class="absolute top-0 left-0 bg-green-600 text-white text-xs font-bold px-2 py-1 rounded-br">OFFER</div>
                        @endif
                    </a>
                    
                    <div class="mb-2">
                        <span class="text-xs text-gray-500">{{ $product->category->name }}</span>
                        <h3 class="font-semibold text-gray-800 text-sm truncate"><a href="{{ route('products.show', $product->slug) }}">{{ $product->name }}</a></h3>
                    </div>

                    <div class="flex items-center justify-between mt-auto">
                        <div>
                            @if($product->discount_price)
                                <span class="text-sm font-bold text-gray-900">₹{{ $product->discount_price }}</span>
                                <span class="text-xs text-gray-500 line-through ml-1">₹{{ $product->price }}</span>
                            @else
                                <span class="text-sm font-bold text-gray-900">₹{{ $product->price }}</span>
                            @endif
                        </div>
                        <form action="{{ route('cart.add') }}" method="POST">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <input type="hidden" name="quantity" value="1">
                            <button type="submit" class="bg-green-100 text-green-700 hover:bg-green-600 hover:text-white p-2 rounded-full transition">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" /></svg>
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endsection
