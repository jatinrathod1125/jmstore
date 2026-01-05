@extends('admin.layouts.app')

@section('content')
    <div class="max-w-4xl mx-auto">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-gray-800">Edit Product</h2>
            <a href="{{ route('admin.products.index') }}" class="text-gray-600 hover:text-gray-800">Back</a>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Left Column -->
                    <div>
                        <div class="mb-4">
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Product Name</label>
                            <input type="text" name="name" id="name" value="{{ old('name', $product->name) }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500 outline-none"
                                required>
                        </div>

                        <div class="mb-4">
                            <label for="category_id" class="block text-sm font-medium text-gray-700 mb-1">Category</label>
                            <select name="category_id" id="category_id"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500 outline-none"
                                required>
                                <option value="">Select Category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="brand_id" class="block text-sm font-medium text-gray-700 mb-1">Brand</label>
                            <select name="brand_id" id="brand_id"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500 outline-none">
                                <option value="">Select Brand</option>
                                @foreach($brands as $brand)
                                    <option value="{{ $brand->id }}" {{ $product->brand_id == $brand->id ? 'selected' : '' }}>
                                        {{ $brand->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="grid grid-cols-2 gap-4 mb-4">
                            <div>
                                <label for="price" class="block text-sm font-medium text-gray-700 mb-1">Price</label>
                                <input type="number" step="0.01" name="price" id="price"
                                    value="{{ old('price', $product->price) }}"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500 outline-none"
                                    required>
                            </div>
                            <div>
                                <label for="discount_price" class="block text-sm font-medium text-gray-700 mb-1">Discount
                                    Price</label>
                                <input type="number" step="0.01" name="discount_price" id="discount_price"
                                    value="{{ old('discount_price', $product->discount_price) }}"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500 outline-none">
                            </div>
                        </div>
                    </div>

                    <!-- Right Column -->
                    <div>
                        <div class="mb-4">
                            <label for="sku" class="block text-sm font-medium text-gray-700 mb-1">SKU</label>
                            <input type="text" name="sku" id="sku" value="{{ old('sku', $product->sku) }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500 outline-none">
                        </div>

                        <div class="mb-4">
                            <label for="stock_quantity" class="block text-sm font-medium text-gray-700 mb-1">Stock
                                Quantity</label>
                            <input type="number" name="stock_quantity" id="stock_quantity"
                                value="{{ old('stock_quantity', $product->stock_quantity) }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500 outline-none"
                                required>
                        </div>

                        <div class="mb-4">
                            <label for="images" class="block text-sm font-medium text-gray-700 mb-1">Images</label>
                            @if($product->images && count($product->images) > 0)
                                <div class="flex space-x-2 mb-2 overflow-x-auto">
                                    @foreach($product->images as $image)
                                        <img src="{{ Storage::url($image) }}" alt="Product Image"
                                            class="h-12 w-12 rounded object-cover border border-gray-200">
                                    @endforeach
                                </div>
                            @endif
                            <input type="file" name="images[]" id="images" multiple
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500 outline-none">
                        </div>

                        <div class="mb-4 flex space-x-6">
                            <label class="flex items-center">
                                <div
                                    class="relative inline-block w-10 mr-2 align-middle select-none transition duration-200 ease-in">
                                    <input type="hidden" name="status" value="0">
                                    <input type="checkbox" name="status" value="1" class="hidden" id="status-toggle" {{ $product->status ? 'checked' : '' }}>
                                    <label for="status-toggle"
                                        class="block overflow-hidden h-6 rounded-full bg-gray-300 cursor-pointer peer-checked:bg-green-600"></label>
                                </div>
                                <span class="ml-2 text-gray-700">Active</span>
                            </label>
                            <label class="flex items-center">
                                <input type="hidden" name="is_featured" value="0">
                                <input type="checkbox" name="is_featured" value="1" {{ $product->is_featured ? 'checked' : '' }} class="form-checkbox h-5 w-5 text-yellow-500 rounded focus:ring-yellow-500 ml-2">
                                <span class="ml-2 text-gray-700">Featured</span>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="mb-4">
                    <label for="short_description" class="block text-sm font-medium text-gray-700 mb-1">Short
                        Description</label>
                    <textarea name="short_description" id="short_description" rows="2"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500 outline-none">{{ old('short_description', $product->short_description) }}</textarea>
                </div>

                <div class="mb-6">
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Full Description</label>
                    <textarea name="description" id="description" rows="4"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500 outline-none">{{ old('description', $product->description) }}</textarea>
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded-lg hover:bg-green-700">Update
                        Product</button>
                </div>
            </form>
        </div>
    </div>
@endsection