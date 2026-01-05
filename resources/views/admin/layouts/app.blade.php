<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'JioMart Clone') }} - Admin</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>

<body class="bg-gray-100 font-sans antialiased">
    <div class="min-h-screen flex" x-data="{ sidebarOpen: true }">
        <!-- Sidebar -->
        <aside class="bg-white w-64 border-r border-gray-200 flex-shrink-0 transition-transform duration-300"
            :class="sidebarOpen ? 'translate-x-0' : '-translate-x-64 absolute lg:relative lg:translate-x-0'">
            <div class="h-16 flex items-center justify-center border-b border-gray-200">
                <span class="text-xl font-bold text-green-600">Grocery Admin</span>
            </div>

            <nav class="p-4 space-y-1 overflow-y-auto h-[calc(100vh-4rem)]">
                <a href="{{ route('admin.dashboard') }}"
                    class="flex items-center px-4 py-3 text-gray-700 hover:bg-green-50 hover:text-green-700 rounded-lg {{ request()->routeIs('admin.dashboard') ? 'bg-green-50 text-green-700' : '' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z">
                        </path>
                    </svg>
                    Dashboard
                </a>

                <a href="{{ route('admin.categories.index') }}"
                    class="flex items-center px-4 py-3 text-gray-700 hover:bg-green-50 hover:text-green-700 rounded-lg {{ request()->routeIs('admin.categories.*') ? 'bg-green-50 text-green-700' : '' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10">
                        </path>
                    </svg>
                    Categories
                </a>

                <a href="{{ route('admin.brands.index') }}"
                    class="flex items-center px-4 py-3 text-gray-700 hover:bg-green-50 hover:text-green-700 rounded-lg {{ request()->routeIs('admin.brands.*') ? 'bg-green-50 text-green-700' : '' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z">
                        </path>
                    </svg>
                    Brands
                </a>

                <a href="{{ route('admin.products.index') }}"
                    class="flex items-center px-4 py-3 text-gray-700 hover:bg-green-50 hover:text-green-700 rounded-lg {{ request()->routeIs('admin.products.*') ? 'bg-green-50 text-green-700' : '' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                    </svg>
                    Products
                </a>

                <a href="{{ route('admin.orders.index') }}"
                    class="flex items-center px-4 py-3 text-gray-700 hover:bg-green-50 hover:text-green-700 rounded-lg {{ request()->routeIs('admin.orders.*') ? 'bg-green-50 text-green-700' : '' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                    </svg>
                    Orders
                </a>

                <a href="{{ route('admin.banners.index') }}"
                    class="flex items-center px-4 py-3 text-gray-700 hover:bg-green-50 hover:text-green-700 rounded-lg {{ request()->routeIs('admin.banners.*') ? 'bg-green-50 text-green-700' : '' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                        </path>
                    </svg>
                    Banners
                </a>

                <form method="POST" action="{{ route('admin.logout') }}" class="mt-8">
                    @csrf
                    <button type="submit"
                        class="w-full flex items-center px-4 py-3 text-red-600 hover:bg-red-50 hover:text-red-700 rounded-lg">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                            </path>
                        </svg>
                        Logout
                    </button>
                </form>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 flex flex-col overflow-hidden">
            <!-- Header -->
            <header class="bg-white border-b border-gray-200 h-16 flex items-center justify-between px-6">
                <button @click="sidebarOpen = !sidebarOpen"
                    class="text-gray-500 hover:text-gray-700 lg:hidden focus:outline-none">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>

                <div class="flex items-center space-x-4">
                    <span class="text-sm text-gray-700">{{ Auth::user()->name ?? 'Admin' }}</span>
                    <div
                        class="h-8 w-8 rounded-full bg-green-100 flex items-center justify-center text-green-600 font-bold">
                        {{ substr(Auth::user()->name ?? 'A', 0, 1) }}
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <div class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100 p-6">
                @if(session('success'))
                    <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative"
                        role="alert">
                        <span class="block sm:inline">{{ session('success') }}</span>
                    </div>
                @endif

                @if($errors->any())
                    <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                        <ul class="list-disc pl-5">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @yield('content')
            </div>
        </main>
    </div>
</body>

</html>