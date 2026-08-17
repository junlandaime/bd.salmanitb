<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', config('app.name', 'Bidang Dakwah Salman ITB'))</title>
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
    <link href="https://fonts.bunny.net/css?family=roboto:400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Alpine Plugins -->
    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/persist@3.x.x/dist/cdn.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/collapse@3.x.x/dist/cdn.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body class="font-sans antialiased text-gray-900 bg-gradient-to-br from-slate-900 via-emerald-950 to-teal-950 min-h-screen relative flex flex-col justify-between selection:bg-emerald-500 selection:text-white">
    <!-- Ambient glowing lights -->
    <div aria-hidden="true" class="absolute top-0 left-1/4 h-96 w-96 rounded-full bg-emerald-500/15 blur-3xl pointer-events-none"></div>
    <div aria-hidden="true" class="absolute bottom-0 right-1/4 h-96 w-96 rounded-full bg-teal-400/10 blur-3xl pointer-events-none"></div>

    <!-- Top Navigation Bar -->
    <div class="relative z-10 w-full px-4 sm:px-6 lg:px-8 pt-6 flex justify-between items-center max-w-6xl mx-auto">
        <a href="{{ route('home') }}" class="inline-flex items-center gap-2 text-xs font-semibold text-emerald-300 hover:text-white transition">
            <span>&larr;</span>
            <span>Kembali ke Beranda</span>
        </a>
        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-white/10 text-emerald-300 border border-white/10 text-[11px] font-medium">
            <span>🕌</span>
            <span>Portal Salman ITB</span>
        </span>
    </div>

    <!-- Main Container -->
    <div class="relative z-10 flex-1 flex flex-col items-center justify-center px-4 sm:px-6 lg:px-8 py-10">
        <div class="max-w-md w-full bg-white/5 backdrop-blur-md p-6 sm:p-8 rounded-3xl border border-white/10 shadow-2xl">
            <!-- Logo -->
            <div class="flex justify-center pb-6">
                <a href="{{ route('home') }}" class="group">
                    <x-application-logo
                        class="h-10 w-auto fill-current text-emerald-400 transition-transform group-hover:scale-105" />
                </a>
            </div>

            <!-- Content -->
            <div>
                @hasSection('content')
                    @yield('content')
                @else
                    {{ $slot ?? '' }}
                @endif
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="relative z-10 pb-6 text-center text-xs text-slate-400">
        <p>&copy; {{ date('Y') }} Bidang Dakwah YPM Salman ITB. All rights reserved.</p>
    </footer>
</body>

</html>
