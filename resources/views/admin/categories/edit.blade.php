@extends('admin.layouts.app')

@section('content')
    <div class="max-w-2xl mx-auto">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-gray-800">Edit Category</h2>
            <a href="{{ route('admin.categories.index') }}" class="text-gray-600 hover:text-gray-800">Back</a>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <form action="{{ route('admin.categories.update', $category) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Name</label>
                    <input type="text" name="name" id="name" value="{{ old('name', $category->name) }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500 outline-none"
                        required>
                </div>

                <div class="mb-4">
                    <label for="parent_id" class="block text-sm font-medium text-gray-700 mb-1">Parent Category</label>
                    <select name="parent_id" id="parent_id"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500 outline-none">
                        <option value="">None (Top Level)</option>
                        @foreach($parents as $parent)
                            <option value="{{ $parent->id }}" {{ $category->parent_id == $parent->id ? 'selected' : '' }}>
                                {{ $parent->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label for="image" class="block text-sm font-medium text-gray-700 mb-1">Image</label>
                    @if($category->image)
                        <div class="mb-2">
                            <img src="{{ Storage::url($category->image) }}" alt="Current Image"
                                class="h-12 w-12 rounded object-cover">
                        </div>
                    @endif
                    <input type="file" name="image" id="image"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500 outline-none">
                </div>

                <div class="mb-6">
                    <label class="flex items-center">
                        <div
                            class="relative inline-block w-10 mr-2 align-middle select-none transition duration-200 ease-in">
                            <input type="hidden" name="status" value="0">
                            <input type="checkbox" name="status" value="1" class="hidden" id="status-toggle" {{ $category->status ? 'checked' : '' }}>
                            <label for="status-toggle"
                                class="block overflow-hidden h-6 rounded-full bg-gray-300 cursor-pointer peer-checked:bg-green-600"></label>
                        </div>
                        <!-- Fallback if toggle isn't styled perfectly with Alpine yet -->
                        <input type="checkbox" name="status" value="1" {{ $category->status ? 'checked' : '' }}
                            class="form-checkbox h-5 w-5 text-green-600 rounded focus:ring-green-500 ml-2">
                        <span class="ml-2 text-gray-700">Active</span>
                    </label>
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded-lg hover:bg-green-700">Update
                        Category</button>
                </div>
            </form>
        </div>
    </div>
@endsection