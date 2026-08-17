<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard') - Bidang Dakwah Masjid Salman ITB</title>
    <link rel="icon" href="{{ asset('favicon.png') }}">

    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-WE2HFGE5VL"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag() { dataLayer.push(arguments); }
        gtag('js', new Date());
        gtag('config', 'G-WE2HFGE5VL');
    </script>
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 font-sans antialiased">
    <div x-data="{ 
            sidebarOpen: window.innerWidth >= 1024,
            isMobile: window.innerWidth < 1024,
            init() {
                window.addEventListener('resize', () => {
                    this.isMobile = window.innerWidth < 1024;
                    if (!this.isMobile) {
                        this.sidebarOpen = true;
                    }
                });
            }
        }" 
        x-init="init()"
        class="min-h-screen relative">
        
        <!-- Mobile Backdrop Overlay -->
        <div x-show="sidebarOpen && isMobile" 
             x-transition:enter="transition-opacity ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition-opacity ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             @click="sidebarOpen = false" 
             class="fixed inset-0 bg-gray-900/60 backdrop-blur-xs z-40 lg:hidden" 
             style="display: none;">
        </div>

        <!-- Sidebar -->
        <aside class="fixed inset-y-0 left-0 bg-white shadow-xl w-64 transform transition-transform duration-300 ease-in-out z-50 flex flex-col h-screen"
            :class="{ '-translate-x-full': !sidebarOpen, 'translate-x-0': sidebarOpen }">
            
            <!-- Sidebar Header -->
            <div class="flex items-center justify-between px-4 py-3.5 border-b border-gray-100 flex-shrink-0">
                <div class="flex items-center space-x-3">
                    <a href="{{ route('home') }}" class="flex items-center gap-2">
                        <x-application-logo class="block h-8 w-auto fill-current text-emerald-600" />
                        <span class="font-bold text-sm text-gray-800 tracking-tight">Bidang Dakwah</span>
                    </a>
                </div>
                <button @click="sidebarOpen = false" 
                    type="button"
                    class="lg:hidden p-1.5 rounded-xl text-gray-400 hover:bg-gray-100 hover:text-gray-700 transition"
                    aria-label="Tutup Menu">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <!-- Scrollable Navigation Area -->
            <div class="flex-1 overflow-y-auto overscroll-contain pb-6">
                @include('admin.layouts.sidebar')
            </div>
        </aside>

        <!-- Main Content Wrapper -->
        <div class="min-h-screen flex flex-col transition-all duration-300"
             :class="{ 'lg:ml-64': sidebarOpen, 'lg:ml-0': !sidebarOpen }">
            
            <!-- Top Navigation Header -->
            <header class="bg-white border-b border-gray-200/80 sticky top-0 z-30 shadow-xs">
                <div class="flex justify-between items-center px-4 sm:px-6 py-3">
                    <div class="flex items-center gap-3">
                        <button @click="sidebarOpen = !sidebarOpen" 
                            type="button"
                            class="p-2 rounded-xl text-gray-500 hover:bg-gray-100 hover:text-gray-700 transition focus:outline-none"
                            aria-label="Toggle Sidebar">
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            </svg>
                        </button>
                        <a href="{{ route('admin.dashboard') }}" class="text-xs font-bold text-emerald-700 bg-emerald-50 px-2.5 py-1 rounded-lg lg:hidden">
                            Admin Panel
                        </a>
                    </div>

                    <div class="flex items-center space-x-3 sm:space-x-4">
                        <a href="{{ route('home') }}" target="_blank" class="hidden sm:inline-flex items-center gap-1.5 text-xs font-semibold text-gray-500 hover:text-emerald-600 px-3 py-1.5 rounded-lg border border-gray-200 hover:bg-gray-50 transition">
                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                            </svg>
                            Lihat Web
                        </a>

                        <div class="relative" x-data="{ open: false }">
                            <button @click="open = !open"
                                class="flex items-center space-x-2 text-gray-700 hover:text-gray-900 p-1.5 rounded-xl hover:bg-gray-50 transition">
                                <img class="h-8 w-8 rounded-full border border-gray-200 object-cover"
                                    src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()?->name ?? 'Admin') }}&background=10b981&color=fff"
                                    alt="Profile">
                                <span class="hidden sm:inline-block text-xs font-bold text-gray-800">{{ Auth::user()?->name ?? 'Admin' }}</span>
                                <svg class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>

                            <div x-show="open" 
                                 x-transition:enter="transition ease-out duration-100"
                                 x-transition:enter-start="transform opacity-0 scale-95"
                                 x-transition:enter-end="transform opacity-100 scale-100"
                                 x-transition:leave="transition ease-in duration-75"
                                 x-transition:leave-start="transform opacity-100 scale-100"
                                 x-transition:leave-end="transform opacity-0 scale-95"
                                 @click.away="open = false"
                                 class="absolute right-0 mt-2 w-48 bg-white rounded-xl shadow-lg py-1.5 border border-gray-100 z-50"
                                 style="display: none;">
                                <div class="px-4 py-2 border-b border-gray-100">
                                    <p class="text-xs font-bold text-gray-900 truncate">{{ Auth::user()?->name ?? 'Admin' }}</p>
                                    <p class="text-[11px] text-gray-500 truncate">{{ Auth::user()?->email ?? '' }}</p>
                                    <div class="flex flex-wrap gap-1 mt-1.5">
                                        @foreach(Auth::user()?->roles ?? [] as $role)
                                            <span class="px-1.5 py-0.5 text-[9px] font-bold rounded-md bg-emerald-50 text-emerald-700 border border-emerald-200">
                                                {{ $role->name }}
                                            </span>
                                        @endforeach
                                    </div>
                                </div>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit"
                                        class="flex items-center gap-2 w-full text-left px-4 py-2 text-xs font-semibold text-red-600 hover:bg-red-50 transition">
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                        </svg>
                                        Keluar (Logout)
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <main class="flex-1">
                @if (session('success'))
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-4">
                        <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 px-4 py-3 rounded-xl flex items-center justify-between shadow-xs" role="alert">
                            <span class="text-sm font-medium">{{ session('success') }}</span>
                            <button type="button" onclick="this.parentElement.remove()" class="text-emerald-500 hover:text-emerald-700">✕</button>
                        </div>
                    </div>
                @endif

                @if (session('error'))
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-4">
                        <div class="bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-xl flex items-center justify-between shadow-xs" role="alert">
                            <span class="text-sm font-medium">{{ session('error') }}</span>
                            <button type="button" onclick="this.parentElement.remove()" class="text-red-500 hover:text-red-700">✕</button>
                        </div>
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>

    @stack('scripts')
</body>

</html>
