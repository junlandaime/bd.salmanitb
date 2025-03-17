<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Bidang Dakwah Masjid Salman ITB')</title>
    <link rel="icon" href="{{ asset('favicon.png') }}">
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=roboto:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Styles -->
    {{-- @livewireStyles --}}

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
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
        <!-- Header -->
        @include('layouts.header')

        <!-- Page Content -->
        <main class="pt-16">
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Flash Messages -->
            @if (session()->has('success'))
                <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 4000)"
                    class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4" role="alert">
                    <p class="font-bold">Success!</p>
                    <p>{{ session('success') }}</p>
                </div>
            @endif

            @if (session()->has('error'))
                <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 4000)"
                    class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4" role="alert">
                    <p class="font-bold">Error!</p>
                    <p>{{ session('error') }}</p>
                </div>
            @endif

            <!-- Main Content -->
            @yield('content')
        </main>

        <!-- Footer -->
        @include('layouts.footer')
    </div>


    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Additional Scripts -->
    @stack('scripts')
</body>

</html>
