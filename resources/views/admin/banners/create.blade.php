@extends('admin.layouts.app')

@section('content')
    <div class="max-w-2xl mx-auto">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-gray-800">Add Banner</h2>
            <a href="{{ route('admin.banners.index') }}" class="text-gray-600 hover:text-gray-800">Back</a>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <form action="{{ route('admin.banners.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-4">
                    <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Title (Optional)</label>
                    <input type="text" name="title" id="title" value="{{ old('title') }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500 outline-none">
                </div>

                <div class="mb-4">
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description
                        (Optional)</label>
                    <textarea name="description" id="description" rows="3"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500 outline-none">{{ old('description') }}</textarea>
                </div>

                <div class="mb-4">
                    <label for="link" class="block text-sm font-medium text-gray-700 mb-1">Link (Optional)</label>
                    <input type="text" name="link" id="link" value="{{ old('link') }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500 outline-none"
                        placeholder="e.g., https://example.com/products/apple">
                </div>

                <div class="mb-4">
                    <label for="link_text" class="block text-sm font-medium text-gray-700 mb-1">Link Text (Optional)</label>
                    <input type="text" name="link_text" id="link_text" value="{{ old('link_text', 'Shop Now') }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500 outline-none"
                        placeholder="e.g., Shop Now">
                </div>

                <div class="mb-4">
                    <label for="type" class="block text-sm font-medium text-gray-700 mb-1">Type</label>
                    <select name="type" id="type"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500 outline-none">
                        <option value="home_slider">Home Slider</option>
                        <option value="promo_small">Small Promo</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label for="image" class="block text-sm font-medium text-gray-700 mb-1">Image</label>
                    <input type="file" name="image" id="image"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500 outline-none"
                        required>
                </div>

                <div class="mb-6">
                    <label class="flex items-center">
                        <input type="checkbox" name="status" value="1" checked
                            class="form-checkbox h-5 w-5 text-green-600 rounded focus:ring-green-500">
                        <span class="ml-2 text-gray-700">Active</span>
                    </label>
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded-lg hover:bg-green-700">Save
                        Banner</button>
                </div>
            </form>
        </div>
    </div>
@endsection