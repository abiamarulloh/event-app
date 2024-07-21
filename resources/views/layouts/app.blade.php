<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=poppins:300,400,500,600" rel="stylesheet" />

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

        @if (config('app.env') === 'production')
            <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
        @endif

        <!-- Primary Meta Tags -->
        <title>Eventku: Platform Terbaik untuk Mengelola dan Menemukan Event Menarik</title>
        <meta name="title" content="Eventku: Platform Terbaik untuk Mengelola dan Menemukan Event Menarik" />
        <meta name="description" content="Temukan dan kelola berbagai event menarik dengan mudah di Eventku. Dari acara lokal hingga festival besar, jadikan setiap momen spesial dengan solusi event management kami yang intuitif. Kunjungi eventku.site untuk info lebih lanjut!" />

        <!-- Open Graph / Facebook -->
        <meta property="og:type" content="website" />
        <meta property="og:url" content="https://eventku.site" />
        <meta property="og:title" content="Eventku: Platform Terbaik untuk Mengelola dan Menemukan Event Menarik" />
        <meta property="og:description" content="Temukan dan kelola berbagai event menarik dengan mudah di Eventku. Dari acara lokal hingga festival besar, jadikan setiap momen spesial dengan solusi event management kami yang intuitif. Kunjungi eventku.site untuk info lebih lanjut!" />
        <meta property="og:image" content="https://eventku.site/public/storage/logo-color.png" />

        <!-- Twitter -->
        <meta property="twitter:card" content="summary_large_image" />
        <meta property="twitter:url" content="https://eventku.site" />
        <meta property="twitter:title" content="Eventku: Platform Terbaik untuk Mengelola dan Menemukan Event Menarik" />
        <meta property="twitter:description" content="Temukan dan kelola berbagai event menarik dengan mudah di Eventku. Dari acara lokal hingga festival besar, jadikan setiap momen spesial dengan solusi event management kami yang intuitif. Kunjungi eventku.site untuk info lebih lanjut!" />
        <meta property="twitter:image" content="https://eventku.site/public/storage/logo-color.png" />


        <link rel="shortcut icon" href="https://eventku.site/public/storage/logo-color.png" type="image/x-icon">

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
