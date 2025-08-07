<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    <meta charset="utf-8">
    <title>Journal App</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 dark:bg-gray-900 text-gray-800 dark:text-white min-h-screen">

    <nav class="bg-white dark:bg-gray-800 shadow">
        <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">
            <h1 class="text-xl font-bold text-teal-600">📝 Journal</h1>
            @auth
                <div class="flex items-center gap-4">
                    <a href="{{ route('journals.index') }}" class="hover:underline">Home</a>
                    <a href="{{ route('journals.create') }}" class="hover:underline">Create</a>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="text-red-500 hover:underline">Logout</button>
                    </form>
                </div>
            @endauth
            @guest
                <div class="flex gap-4">
                    <a href="{{ route('login') }}" class="hover:underline">Login</a>
                    <a href="{{ route('register') }}" class="hover:underline">Register</a>
                </div>
            @endguest
        </div>
    </nav>

    <main class="py-8 px-4 max-w-4xl mx-auto">
        @yield('content')
    </main>

</body>
</html>
