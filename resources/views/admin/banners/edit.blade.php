@extends('admin.layouts.app')

@section('content')
    <div class="max-w-2xl mx-auto">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-gray-800">Edit Banner</h2>
            <a href="{{ route('admin.banners.index') }}" class="text-gray-600 hover:text-gray-800">Back</a>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <form action="{{ route('admin.banners.update', $banner) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Title (Optional)</label>
                    <input type="text" name="title" id="title" value="{{ old('title', $banner->title) }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500 outline-none">
                </div>

                <div class="mb-4">
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description
                        (Optional)</label>
                    <textarea name="description" id="description" rows="3"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500 outline-none">{{ old('description', $banner->description) }}</textarea>
                </div>

                <div class="mb-4">
                    <label for="link" class="block text-sm font-medium text-gray-700 mb-1">Link (Optional)</label>
                    <input type="text" name="link" id="link" value="{{ old('link', $banner->link) }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500 outline-none">
                </div>

                <div class="mb-4">
                    <label for="link_text" class="block text-sm font-medium text-gray-700 mb-1">Link Text (Optional)</label>
                    <input type="text" name="link_text" id="link_text" value="{{ old('link_text', $banner->link_text) }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500 outline-none">
                </div>

                <div class="mb-4">
                    <label for="type" class="block text-sm font-medium text-gray-700 mb-1">Type</label>
                    <select name="type" id="type"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500 outline-none">
                        <option value="home_slider" {{ $banner->type == 'home_slider' ? 'selected' : '' }}>Home Slider
                        </option>
                        <option value="promo_small" {{ $banner->type == 'promo_small' ? 'selected' : '' }}>Small Promo
                        </option>
                    </select>
                </div>

                <div class="mb-4">
                    <label for="image" class="block text-sm font-medium text-gray-700 mb-1">Image</label>
                    @if($banner->image)
                        <div class="mb-2">
                            <img src="{{ Storage::url($banner->image) }}" alt="Current Image"
                                class="h-20 w-40 object-cover rounded">
                        </div>
                    @endif
                    <input type="file" name="image" id="image"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500 outline-none">
                </div>

                <div class="mb-6">
                    <label class="flex items-center">
                        <input type="checkbox" name="status" value="1" {{ $banner->status ? 'checked' : '' }}
                            class="form-checkbox h-5 w-5 text-green-600 rounded focus:ring-green-500">
                        <span class="ml-2 text-gray-700">Active</span>
                    </label>
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded-lg hover:bg-green-700">Update
                        Banner</button>
                </div>
            </form>
        </div>
    </div>
@endsection