<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Login - {{ config('app.name', 'JioMart Clone') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 min-h-screen flex items-center justify-center">
    <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md">
        <div class="text-center mb-8">
            <h2 class="text-2xl font-bold text-gray-800">Admin Login</h2>
            <p class="text-gray-500 text-sm mt-1">Sign in to access the control panel</p>
        </div>

        @if($errors->any())
            <div class="mb-4 bg-red-50 text-red-600 p-3 rounded text-sm">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('admin.authenticate') }}">
            @csrf

            <div class="mb-6">
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                <input type="email" name="email" id="email" required autofocus
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500 outline-none transition transition-all"
                    placeholder="admin@example.com">
            </div>

            <div class="mb-6">
                <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                <input type="password" name="password" id="password" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500 outline-none transition transition-all"
                    placeholder="********">
            </div>

            <button type="submit"
                class="w-full bg-green-600 text-white font-semibold py-3 rounded-lg hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-opacity-50 transition duration-300">
                Sign In
            </button>
        </form>
    </div>
</body>

</html>