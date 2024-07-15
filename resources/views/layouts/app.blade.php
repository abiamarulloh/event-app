<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=poppins:300,400,500,600" rel="stylesheet" />

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @livewireStyles
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-[#FFFFF] light:bg-[#FFFFF] shadow-sm">
            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>

            @if(!request()->routeIs('event-register') && !request()->routeIs('cart.index') && !request()->routeIs('history.detail'))
                @include('layouts.sidebar')
            @endif
            

            @if(route('explore') == request()->url() || route('profile.edit') == request()->url() || route('history') == request()->url() || request()->routeIs('history.detail'))
                @include('layouts.navigation-bottom')
            @endif
        </div>

        @livewireScripts
    </body>
</html>
