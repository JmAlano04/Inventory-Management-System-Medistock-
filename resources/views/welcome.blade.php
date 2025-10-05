<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Medistock') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    <!-- Styles / Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-secondary-light font-sans text-text-base min-h-screen flex flex-col">
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
    <!-- Header -->
    <header class="w-full px-6 py-4 flex items-center justify-between bg-white shadow-md">
        <h1 class="text-2xl font-bold text-primary-dark tracking-tight">
            MediStock
        </h1>
        <div class="space-x-4">
    @auth
        <a href="{{ route('dashboard') }}" class="px-5 py-2 rounded bg-button-primary text-text-light hover:bg-button-hover transition">
            Dashboard
        </a>
    @else
        <a href="{{ route('login') }}" class="px-5 py-2 rounded bg-button-primary text-text-light hover:bg-button-hover transition">
            Login
        </a>
        <a href="{{ route('register') }}" class="px-5 py-2 rounded border border-primary-dark text-primary-dark hover:bg-primary-light transition">
            Register
        </a>
    @endauth
</div>
    </header>

    <!-- Hero Section -->
    <main class="flex-grow flex items-center justify-center px-6">
        <div class="max-w-2xl text-center bg-white p-10 rounded-lg shadow-lg">
            <h2 class="text-4xl font-bold text-primary-dark mb-4">
                Welcome to MediStock
            </h2>
            <p class="text-lg text-text-muted mb-6">
                Streamline your medical inventory with ease. Track supplies, monitor expirations, and manage logistics — all in one place.
            </p>
            {{-- <div class="space-x-4">
                <a href="{{ route('login') }}" class="px-6 py-3 rounded bg-button-primary text-text-light font-medium hover:bg-button-hover transition">
                    Get Started
                </a>
                <a href="{{ route('register') }}" class="px-6 py-3 rounded border border-primary-dark text-primary-dark font-medium hover:bg-primary-light transition">
                    Create Account
                </a>
            </div> --}}
        </div>
    </main>

    <!-- Footer -->
    <footer class="w-full text-center text-sm text-text-muted py-4">
        &copy; {{ date('Y') }} MediStock. All rights reserved.
    </footer>
</body>


</html>
