<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ config('app.name', 'Journal App') }}</title>

    <!-- Tailwind CSS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 text-gray-800 min-h-screen flex flex-col">

    <!-- Navbar -->
    <nav class="bg-white shadow-md">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
            <a href="{{ route('journals.index') }}" class="text-2xl font-bold text-blue-600 hover:text-blue-800 transition duration-200">
                📘 Journal App
            </a>
            <div class="space-x-4">
                @auth
                    <span class="text-gray-700">Hi, {{ auth()->user()->name }}!</span>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="text-red-600 hover:text-red-800 font-semibold transition duration-200">
                            Logout
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="text-blue-600 hover:text-blue-800 font-medium transition duration-200">
                        Login
                    </a>
                    <a href="{{ route('register') }}" class="text-blue-600 hover:text-blue-800 font-medium transition duration-200">
                        Register
                    </a>
                @endauth
            </div>
        </div>
    </nav>

    <!-- Page Content -->
    <main class="flex-grow container mx-auto px-4 py-8">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-white border-t text-center text-gray-500 py-4 text-sm">
        &copy; {{ now()->year }} Journal App. All rights reserved.
    </footer>

</body>
</html>
