<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'JioMart Clone') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-gray-50 text-gray-800 antialiased flex flex-col min-h-screen">
    
    <!-- Header -->
    <header class="bg-white shadow-sm sticky top-0 z-50">
        <!-- Top Bar -->
        <div class="bg-green-600 text-white text-xs py-1">
            <div class="container mx-auto px-4 flex justify-between items-center">
                <span>Welcome to Grocery Store</span>
                <span>Call Us: 1800-123-4567</span>
            </div>
        </div>

        <!-- Main Header -->
        <div class="container mx-auto px-4 py-4 flex items-center justify-between">
            <!-- Logo -->
            <a href="{{ route('home') }}" class="text-2xl font-bold text-green-700 flex items-center">
                <svg class="h-8 w-8 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                </svg>
                GroStore
            </a>

            <!-- Search Bar -->
            <div class="hidden md:flex flex-1 mx-8 max-w-2xl">
                <div class="relative w-full">
                    <input type="text" placeholder="Search for products..." class="w-full border border-gray-300 rounded-l-lg py-2 px-4 focus:outline-none focus:ring-1 focus:ring-green-500">
                    <button class="absolute right-0 top-0 h-full bg-green-600 text-white px-6 rounded-r-lg hover:bg-green-700">Search</button>
                </div>
            </div>

            <!-- User Actions -->
            <div class="flex items-center space-x-6">
                @auth
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open" class="flex items-center text-gray-700 hover:text-green-600 focus:outline-none">
                            <span class="mr-1">Result</span>
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                        </button>
                        <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-50 transition" x-transition>
                            <a href="{{ route('user.orders') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">My Orders</a>
                            <form method="POST" action="{{ route('admin.logout') }}">
                                @csrf
                                <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Logout</button>
                            </form>
                        </div>
                    </div>
                @else
                    <a href="{{ route('admin.login') }}" class="text-gray-700 hover:text-green-600 text-sm font-medium">Log In</a>
                @endauth
                
                <a href="{{ route('cart.index') }}" class="flex items-center text-gray-700 hover:text-green-600">
                    <div class="relative">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                        <!-- Badge Idea: <span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full h-4 w-4 flex items-center justify-center">?</span> -->
                    </div>
                    <span class="ml-1 hidden md:block text-sm font-medium">Cart</span>
                </a>
            </div>
        </div>
        
        <!-- Navbar -->
        <nav class="bg-gray-100 border-b border-gray-200">
            <div class="container mx-auto px-4">
                <div class="flex space-x-8 overflow-x-auto">
                    <!-- Dynamic Categories will go here or just static for now with controller data -->
                    @php
                        // We might share categories via view composer later, for now assuming $categories passed available or check
                        $navCategories = \App\Models\Category::whereNull('parent_id')->where('status', true)->take(8)->get();
                    @endphp
                    
                    <a href="{{ route('home') }}" class="py-3 text-sm font-medium text-gray-700 hover:text-green-600 whitespace-nowrap">Home</a>
                    @foreach($navCategories as $cat)
                        <a href="{{ route('products.index', ['category' => $cat->slug]) }}" class="py-3 text-sm font-medium text-gray-700 hover:text-green-600 whitespace-nowrap">{{ $cat->name }}</a>
                    @endforeach
                </div>
            </div>
        </nav>
    </header>

    <!-- Content -->
    <main class="flex-grow">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-8 mt-12">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <h3 class="text-lg font-bold mb-4">GroStore</h3>
                    <p class="text-gray-400 text-sm">Your daily online grocery store. High quality products delivered to your doorstep.</p>
                </div>
                <div>
                    <h4 class="font-semibold mb-3">Links</h4>
                    <ul class="text-sm text-gray-400 space-y-2">
                        <li><a href="#" class="hover:text-white">About Us</a></li>
                        <li><a href="#" class="hover:text-white">Contact Us</a></li>
                        <li><a href="#" class="hover:text-white">Terms of Service</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-semibold mb-3">Categories</h4>
                    <ul class="text-sm text-gray-400 space-y-2">
                         @foreach($navCategories->take(4) as $cat)
                            <li><a href="{{ route('products.index', ['category' => $cat->slug]) }}" class="hover:text-white">{{ $cat->name }}</a></li>
                        @endforeach
                    </ul>
                </div>
                 <div>
                    <h4 class="font-semibold mb-3">Contact</h4>
                    <p class="text-sm text-gray-400">123 Grocery St, Tech City<br>support@grostore.com<br>1800-123-4567</p>
                </div>
            </div>
            <div class="border-t border-gray-700 mt-8 pt-8 text-center text-sm text-gray-400">
                &copy; {{ date('Y') }} GroStore. All rights reserved.
            </div>
        </div>
    </footer>
</body>
</html>
