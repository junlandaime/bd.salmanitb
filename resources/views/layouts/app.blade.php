<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="overflow-x-hidden max-w-full">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=5">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Bidang Dakwah Masjid Salman ITB')</title>
    <link rel="icon" href="{{ asset('favicon.png') }}">

    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-WE2HFGE5VL"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag() { dataLayer.push(arguments); }
        gtag('js', new Date());
        gtag('config', 'G-WE2HFGE5VL');
    </script>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=roboto:400,500,600&display=swap" rel="stylesheet" />
    
    <!-- Alpine Plugins -->
    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/persist@3.x.x/dist/cdn.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/collapse@3.x.x/dist/cdn.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/intersect@3.x.x/dist/cdn.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <!-- Meta tags untuk SEO dan sharing -->
    <meta name="description" content="@yield('meta_description', $frontLandingPage->meta_description ?? '')">
    <meta name="keywords" content="@yield('meta_keywords', $frontLandingPage->meta_keywords ?? '')">
    <meta name="author" content="Tim Bidang Dakwah Salman ITB">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="@yield('og_title', $frontLandingPage->meta_title ?? '')">
    <meta property="og:description" content="@yield('og_description', $frontLandingPage->meta_description ?? '')">
    <meta property="og:image" content="@yield('og_image', !empty($frontLandingPage->hero_image) ? Storage::url($frontLandingPage->hero_image) : '')">

    <!-- Twitter -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:url" content="{{ url()->current() }}">
    <meta name="twitter:title" content="@yield('og_title', $frontLandingPage->meta_title ?? '')">
    <meta name="twitter:description" content="@yield('og_description', $frontLandingPage->meta_description ?? '')">
    <meta name="twitter:image" content="@yield('og_image', !empty($frontLandingPage->hero_image) ? Storage::url($frontLandingPage->hero_image) : '')">

    @yield('additional_meta_tags')

    <!-- Additional Styles -->
    @stack('styles')

    <!-- AOS -->
    <link rel="stylesheet" href="https://unpkg.com/aos@2.3.4/dist/aos.css">

    <style>
        html, body {
            overflow-x: hidden !important;
            max-width: 100vw !important;
            width: 100% !important;
            position: relative;
        }
    </style>
</head>

<body class="font-sans antialiased overflow-x-hidden max-w-full w-full bg-gray-100 text-gray-900 selection:bg-emerald-500 selection:text-white">
    <div class="min-h-screen bg-gray-100 flex flex-col w-full max-w-full overflow-x-hidden">
        <!-- Header -->
        @include('layouts.header')

        <!-- Page Content -->
        <main class="pt-16 flex-1 w-full max-w-full overflow-x-hidden">
            @if (isset($header))
                <header class="bg-white shadow-xs border-b border-gray-200">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Flash Messages -->
            @if (session()->has('success'))
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-4">
                    <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 4000)"
                        class="bg-emerald-50 border border-emerald-200 text-emerald-800 p-4 rounded-2xl shadow-xs flex items-center justify-between" role="alert">
                        <div class="flex items-center gap-2">
                            <span class="font-bold">Sukses:</span>
                            <span>{{ session('success') }}</span>
                        </div>
                        <button type="button" @click="show = false" class="text-emerald-600 hover:text-emerald-800">✕</button>
                    </div>
                </div>
            @endif

            @if (session()->has('error'))
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-4">
                    <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 4000)"
                        class="bg-red-50 border border-red-200 text-red-800 p-4 rounded-2xl shadow-xs flex items-center justify-between" role="alert">
                        <div class="flex items-center gap-2">
                            <span class="font-bold">Error:</span>
                            <span>{{ session('error') }}</span>
                        </div>
                        <button type="button" @click="show = false" class="text-red-600 hover:text-red-800">✕</button>
                    </div>
                </div>
            @endif

            <!-- Main Content -->
            @yield('content')
        </main>

        <!-- Footer -->
        @include('layouts.footer')
    </div>

    <!-- Additional Scripts -->
    @stack('scripts')

    <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            AOS.init({
                once: true,
                duration: 700,
                offset: 60,
                disable: function() {
                    return window.innerWidth < 768; // Disable on small screens to prevent overflow
                }
            });
        });
    </script>
</body>

</html>
