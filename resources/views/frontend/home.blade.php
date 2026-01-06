@extends('frontend.layouts.app')

@section('content')

<!-- Hero Slider -->
<div class="relative bg-gray-900 overflow-hidden group" x-data="{ 
    activeSlide: 0, 
    slides: {{ $sliders->count() }}, 
    interval: null,
    startTimer() { this.interval = setInterval(() => { this.activeSlide = (this.activeSlide === this.slides - 1) ? 0 : this.activeSlide + 1 }, 5000); },
    stopTimer() { clearInterval(this.interval); } 
}" x-init="startTimer()" @mouseenter="stopTimer()" @mouseleave="startTimer()">
    
    <div class="relative h-[500px] md:h-[600px]">
        @forelse($sliders as $index => $slider)
            <div x-show="activeSlide === {{ $index }}" 
                 x-transition:enter="transition ease-out duration-700"
                 x-transition:enter-start="opacity-0 transform scale-105"
                 x-transition:enter-end="opacity-100 transform scale-100"
                 x-transition:leave="transition ease-in duration-700"
                 x-transition:leave-start="opacity-100 transform scale-100"
                 x-transition:leave-end="opacity-0 transform scale-95"
                 class="absolute inset-0 w-full h-full">
                
                <!-- Image -->
                <div class="absolute inset-0 bg-black/40 z-10"></div>
                <img src="{{ Storage::url($slider->image) }}" alt="{{ $slider->title }}" class="w-full h-full object-cover">
                
                <!-- Content -->
                <div class="absolute inset-0 z-20 flex items-center justify-center text-center px-4">
                    <div class="max-w-3xl space-y-6">
                        @if($slider->title)
                            <h1 x-show="activeSlide === {{ $index }}"
                                x-transition:enter="transition ease-out duration-700 delay-300"
                                x-transition:enter-start="opacity-0 translate-y-8"
                                x-transition:enter-end="opacity-100 translate-y-0"
                                class="text-4xl md:text-6xl font-bold text-white tracking-tight drop-shadow-lg">
                                {{ $slider->title }}
                            </h1>
                        @endif
                        
                        @if($slider->description)
                            <p x-show="activeSlide === {{ $index }}"
                               x-transition:enter="transition ease-out duration-700 delay-500"
                               x-transition:enter-start="opacity-0 translate-y-8"
                               x-transition:enter-end="opacity-100 translate-y-0"
                               class="text-lg md:text-xl text-gray-200 font-medium drop-shadow-md">
                                {{ $slider->description }}
                            </p>
                        @endif

                        @if($slider->link)
                            <div x-show="activeSlide === {{ $index }}"
                                 x-transition:enter="transition ease-out duration-700 delay-700"
                                 x-transition:enter-start="opacity-0 translate-y-8"
                                 x-transition:enter-end="opacity-100 translate-y-0">
                                <a href="{{ $slider->link }}" class="inline-block bg-green-600 hover:bg-green-700 text-white font-semibold py-3 px-8 rounded-full shadow-lg transform hover:-translate-y-1 transition duration-300">
                                    {{ $slider->link_text ?? 'Shop Now' }}
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <!-- Placeholder if no slides -->
            <div class="w-full h-full flex flex-col items-center justify-center bg-gray-800 text-white">
                <svg class="w-16 h-16 text-gray-600 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                <span class="text-gray-400 font-medium text-lg">No Banners Configured</span>
                <p class="text-gray-500 text-sm mt-2">Go to Admin Panel to add banners.</p>
            </div>
        @endforelse

        <!-- Indicators -->
        @if($sliders->count() > 1)
            <div class="absolute bottom-6 left-0 right-0 z-30 flex justify-center space-x-3">
                @foreach($sliders as $index => $slider)
                    <button @click="activeSlide = {{ $index }}" 
                            class="h-3 w-3 rounded-full transition-all duration-300 focus:outline-none"
                            :class="activeSlide === {{ $index }} ? 'bg-green-500 w-8' : 'bg-white/50 hover:bg-white'">
                    </button>
                @endforeach
            </div>

            <!-- Pre/Next Buttons -->
            <button @click="activeSlide = (activeSlide === 0) ? slides - 1 : activeSlide - 1" class="absolute left-4 top-1/2 transform -translate-y-1/2 z-30 p-2 rounded-full bg-white/10 hover:bg-white/20 text-white backdrop-blur-sm transition opacity-0 group-hover:opacity-100 focus:outline-none">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" /></svg>
            </button>
            <button @click="activeSlide = (activeSlide === slides - 1) ? 0 : activeSlide + 1" class="absolute right-4 top-1/2 transform -translate-y-1/2 z-30 p-2 rounded-full bg-white/10 hover:bg-white/20 text-white backdrop-blur-sm transition opacity-0 group-hover:opacity-100 focus:outline-none">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
            </button>
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
