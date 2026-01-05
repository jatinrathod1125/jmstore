@extends('admin.layouts.app')

@section('content')
    <div class="max-w-2xl mx-auto">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-gray-800">Add Brand</h2>
            <a href="{{ route('admin.brands.index') }}" class="text-gray-600 hover:text-gray-800">Back</a>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <form action="{{ route('admin.brands.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Name</label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500 outline-none"
                        required>
                </div>

                <div class="mb-4">
                    <label for="logo" class="block text-sm font-medium text-gray-700 mb-1">Logo</label>
                    <input type="file" name="logo" id="logo"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500 outline-none">
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
                        Brand</button>
                </div>
            </form>
        </div>
    </div>
@endsection