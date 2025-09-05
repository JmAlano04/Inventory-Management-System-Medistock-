<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans text-gray-900 bg-gray-100 relative">

   <!-- SVG Background -->
    <svg class="absolute inset-0 -z-10 w-full h-full" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1600 800" preserveAspectRatio="none">
    <rect fill="#ffffff" width="1600" height="800"/>
    <g fill-opacity="1">
        <polygon fill="#f0fdf4" points="1600 160 0 460 0 350 1600 50"/>       <!-- green-50 -->
        <polygon fill="#dcfce7" points="1600 260 0 560 0 450 1600 150"/>       <!-- green-100 -->
        <polygon fill="#bbf7d0" points="1600 360 0 660 0 550 1600 250"/>       <!-- green-200 -->
        <polygon fill="#86efac" points="1600 460 0 760 0 650 1600 350"/>       <!-- green-300 -->
        <polygon fill="#4ade80" points="1600 800 0 800 0 750 1600 450"/>       <!-- green-400 -->
    </g>
    </svg>


    <!-- Main Content -->
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
       

        <div class="w-full sm:max-w-md mt-6 px-10 py-10 bg-secondary-light shadow-lg overflow-hidden sm:rounded-md">
            
        <div class="text-center">
            <a href="/" class="text-green-900 text-2xl">
                Medistock.
            </a>
        </div>
            {{ $slot }}
        </div>
    </div>
</body>
</html>
