@extends('frontend.layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex flex-col md:flex-row gap-8">
        <!-- Sidebar Filters -->
        <aside class="w-full md:w-64 flex-shrink-0">
            <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-100">
                <h3 class="font-bold text-gray-800 mb-4 border-b pb-2">Categories</h3>
                <ul class="space-y-2 text-sm text-gray-600">
                    @foreach($categories as $category)
                        <li>
                            <a href="{{ route('products.index', ['category' => $category->slug]) }}" class="hover:text-green-600 block {{ request('category') == $category->slug ? 'text-green-600 font-bold' : '' }}">
                                {{ $category->name }}
                            </a>
                            @if($category->children->count() > 0)
                                <ul class="pl-4 mt-1 space-y-1 border-l-2 border-gray-100">
                                    @foreach($category->children as $child)
                                        <li>
                                            <a href="{{ route('products.index', ['category' => $child->slug]) }}" class="hover:text-green-600 block {{ request('category') == $child->slug ? 'text-green-600 font-bold' : '' }}">
                                                {{ $child->name }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </li>
                    @endforeach
                </ul>

                <h3 class="font-bold text-gray-800 mt-8 mb-4 border-b pb-2">Brands</h3>
                <ul class="space-y-2 text-sm text-gray-600">
                     @foreach($brands as $brand)
                        <li>
                            <label class="flex items-center">
                                <span class="ml-2 hover:text-green-600 cursor-pointer">{{ $brand->name }}</span>
                            </label>
                        </li>
                    @endforeach
                </ul>
            </div>
        </aside>

        <!-- Product Grid -->
        <div class="flex-1">
             <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-bold text-gray-800">
                    @if(request('category'))
                        {{ ucfirst(str_replace('-', ' ', request('category'))) }}
                    @else
                        All Products
                    @endif
                </h1>
                <span class="text-sm text-gray-500">{{ $products->total() }} Products Found</span>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                 @forelse($products as $product)
                    <div class="bg-white rounded-lg shadow-sm hover:shadow-md transition p-3 border border-gray-100">
                        <a href="{{ route('products.show', $product->slug) }}" class="block relative h-48 overflow-hidden rounded mb-3">
                            @if($product->images && count($product->images) > 0)
                                <img src="{{ Storage::url($product->images[0]) }}" alt="{{ $product->name }}" class="w-full h-full object-contain">
                            @else
                                <div class="w-full h-full flex items-center justify-center bg-gray-100 text-gray-400 text-xs">No Img</div>
                            @endif
                             @if($product->discount_price)
                                <div class="absolute top-0 left-0 bg-green-600 text-white text-xs font-bold px-2 py-1 rounded-br">OFFER</div>
                            @endif
                        </a>
                        
                        <div class="mb-2">
                            <span class="text-xs text-gray-500">{{ $product->category->name }}</span>
                            <h3 class="font-semibold text-gray-800 text-sm truncate" title="{{ $product->name }}"><a href="{{ route('products.show', $product->slug) }}">{{ $product->name }}</a></h3>
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
                @empty
                    <div class="col-span-full py-12 text-center text-gray-500">
                        No products found in this category.
                    </div>
                @endforelse
            </div>
            
            <div class="mt-8">
                {{ $products->appends(request()->query())->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
