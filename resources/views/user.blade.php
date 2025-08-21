<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>
        <!-- Inside <head> or before </body> -->
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen flex bg-primary-DEFAULT">
            <!-- Sidebar -->
           <aside class="w-64 h-[calc(100vh-0.5rem)] fixed m-1 z-10 bg-primary-dark shadow rounded-sm">
                @include('layouts.sidebar')
            </aside>


            <!-- Main Content -->
            <div class="flex-1 ml-64 ">
                @include('layouts.navigation')

                <!-- Page Heading -->
                @isset($header)
                    <header">
                        <div class="max-w-7xl mt-9">
                            {{ $header }}
                        </div>
                    </header>
                @endisset

                <!-- Page Content -->
                <main>
                    <h1>Jenmar</h1>
                        
                  
                </main>
            </div>
        </div>
    </body>
</html>
