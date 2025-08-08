<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Journal') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts & Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-50 text-gray-900">
    <div class="min-h-screen flex flex-col sm:justify-center items-center py-8">
        
        <!-- Logo -->
        <a href="/" class="mb-4">
            <x-application-logo class="w-20 h-20 text-gray-600" />
        </a>

        <!-- Content Card -->
        <div class="w-full sm:max-w-md bg-white shadow-lg rounded-lg p-6">
            {{ $slot }}
        </div>

    </div>
</body>
</html>
