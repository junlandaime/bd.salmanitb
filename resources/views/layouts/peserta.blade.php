<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Dashboard Peserta - Bidang Dakwah Salman ITB')</title>
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
    
    <!-- Scripts & Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    
    <!-- Alpine Plugins -->
    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/collapse@3.x.x/dist/cdn.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    @stack('styles')
</head>

<body class="font-sans antialiased bg-slate-50/80 text-gray-900" x-data="{ sidebarOpen: false }">
    <div class="flex h-screen overflow-hidden">
        
        <!-- Sidebar Backdrop for Mobile -->
        <div x-show="sidebarOpen" x-transition.opacity 
             class="fixed inset-0 z-20 bg-gray-900/60 backdrop-blur-xs lg:hidden"
             @click="sidebarOpen = false" style="display: none;"></div>

        <!-- Sidebar -->
        <aside :class="{'translate-x-0': sidebarOpen, '-translate-x-full': !sidebarOpen}"
               class="fixed inset-y-0 left-0 z-30 w-64 transition-transform duration-300 transform bg-gradient-to-b from-teal-900 via-emerald-950 to-slate-950 lg:translate-x-0 lg:static lg:inset-0 text-white shadow-2xl flex flex-col">
            
            <!-- Logo Header -->
            <div class="flex items-center justify-between px-6 h-20 border-b border-white/10 shrink-0">
                <a href="{{ route('home') }}" class="flex items-center gap-2.5 group">
                    <img src="{{ asset('favicon.png') }}" alt="Logo" class="h-8 w-auto bg-white rounded-lg p-1 shadow-sm transition-transform group-hover:scale-105">
                    <div>
                        <span class="text-sm font-extrabold tracking-wider block text-white">Bidang Dakwah</span>
                        <span class="text-[10px] text-teal-300 font-medium tracking-tight">Masjid Salman ITB</span>
                    </div>
                </a>
                <button @click="sidebarOpen = false" class="lg:hidden text-teal-300 hover:text-white p-1">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <!-- Navigation Links -->
            <nav class="flex-1 px-4 py-6 space-y-1.5 overflow-y-auto">
                <a href="{{ route('peserta.dashboard') }}" 
                   class="flex items-center px-4 py-3 text-xs font-bold rounded-xl transition {{ request()->routeIs('peserta.dashboard') ? 'bg-emerald-500/20 text-emerald-300 border border-emerald-400/30' : 'text-slate-300 hover:bg-white/5 hover:text-white' }}">
                    <i class="fas fa-home w-5 text-center text-sm"></i>
                    <span class="ml-2.5">Dashboard</span>
                </a>

                <a href="{{ route('peserta.feedback.index') }}" 
                   class="flex items-center justify-between px-4 py-3 text-xs font-bold rounded-xl transition {{ request()->routeIs('peserta.feedback.*') ? 'bg-emerald-500/20 text-emerald-300 border border-emerald-400/30' : 'text-slate-300 hover:bg-white/5 hover:text-white' }}">
                    <div class="flex items-center">
                        <i class="fas fa-comment-dots w-5 text-center text-sm"></i>
                        <span class="ml-2.5">Feedback &amp; Aspirasi</span>
                    </div>
                    @php
                        $answeredCount = \App\Models\Feedback::byUser(auth()->id())->where('status', 'answered')->count();
                    @endphp
                    @if($answeredCount > 0)
                        <span class="px-2 py-0.5 text-[10px] font-extrabold bg-emerald-400 text-teal-950 rounded-full shadow-xs">
                            {{ $answeredCount }} Baru
                        </span>
                    @endif
                </a>

                <a href="{{ route('profile.edit') }}" 
                   class="flex items-center px-4 py-3 text-xs font-bold rounded-xl transition {{ request()->routeIs('profile.edit') ? 'bg-emerald-500/20 text-emerald-300 border border-emerald-400/30' : 'text-slate-300 hover:bg-white/5 hover:text-white' }}">
                    <i class="fas fa-user-cog w-5 text-center text-sm"></i>
                    <span class="ml-2.5">Pengaturan Profil</span>
                </a>
                
                @if(auth()->user() && auth()->user()->hasRole('alumni'))
                <div class="pt-4 mt-4 border-t border-white/10">
                    <p class="px-4 text-[10px] font-bold uppercase tracking-wider text-slate-400 mb-2">Portal Khusus</p>
                    <a href="{{ route('alumni.dashboard') }}" 
                       class="flex items-center justify-between px-4 py-2.5 text-xs font-bold rounded-xl text-teal-200 bg-teal-800/30 border border-teal-500/20 hover:bg-teal-800/50 hover:text-white transition">
                        <div class="flex items-center">
                            <i class="fas fa-graduation-cap w-5 text-center text-sm text-teal-400"></i>
                            <span class="ml-2.5">Portal Alumni</span>
                        </div>
                        <i class="fas fa-chevron-right text-[10px] text-teal-400"></i>
                    </a>
                </div>
                @endif
            </nav>
            
            <!-- User Info & Settings (Bottom) -->
            <div class="p-4 border-t border-white/10 bg-black/20">
                <a href="{{ route('profile.edit') }}" class="flex items-center justify-between p-2 rounded-xl hover:bg-white/5 transition mb-3 group">
                    <div class="flex items-center gap-3 min-w-0">
                        <div class="w-9 h-9 rounded-xl bg-emerald-500/20 border border-emerald-400/30 flex items-center justify-center text-emerald-300 font-bold text-xs shrink-0">
                            {{ strtoupper(substr(auth()->user()->name ?? 'P', 0, 1)) }}
                        </div>
                        <div class="min-w-0 flex-1">
                            <p class="text-xs font-bold text-white truncate group-hover:text-emerald-300 transition">{{ auth()->user()->name }}</p>
                            <p class="text-[10px] text-slate-400 truncate">{{ auth()->user()->email }}</p>
                        </div>
                    </div>
                    <i class="fas fa-cog text-xs text-slate-400 group-hover:text-white transition"></i>
                </a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="flex items-center justify-center gap-2 w-full px-4 py-2 text-xs font-bold text-red-300 hover:text-red-200 rounded-xl bg-red-500/10 hover:bg-red-500/20 border border-red-500/20 transition">
                        <i class="fas fa-sign-out-alt"></i>
                        <span>Keluar Akun</span>
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main Content Area -->
        <div class="flex flex-col flex-1 w-full overflow-hidden">
            <!-- Topbar -->
            <header class="flex items-center justify-between px-6 py-4 bg-white border-b border-gray-200/80 sticky top-0 z-30 shadow-2xs">
                <div class="flex items-center gap-3">
                    <button @click="sidebarOpen = true" class="text-gray-500 hover:text-emerald-700 p-1.5 rounded-xl hover:bg-gray-100 focus:outline-none lg:hidden">
                        <i class="fas fa-bars text-lg"></i>
                    </button>
                    <h1 class="text-lg font-bold text-gray-800">@yield('header', 'Dashboard Peserta')</h1>
                </div>
                
                <div class="flex items-center gap-3 sm:gap-4">
                    <a href="{{ route('home') }}" target="_blank"
                        class="hidden sm:inline-flex items-center gap-1.5 text-xs font-semibold text-gray-600 hover:text-emerald-700 px-3.5 py-1.5 rounded-xl border border-gray-200 hover:bg-gray-50 transition shadow-2xs">
                        <i class="fas fa-globe text-gray-400"></i>
                        <span>Lihat Website</span>
                    </a>

                    <!-- User Profile Dropdown -->
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open"
                            class="flex items-center gap-2.5 p-1.5 rounded-2xl hover:bg-gray-50 transition text-left focus:outline-none">
                            <span class="text-xs font-bold text-gray-700 hidden md:block">
                                {{ auth()->user()->name }}
                            </span>
                            <div class="h-8 w-8 rounded-xl bg-teal-100 text-teal-800 flex items-center justify-center text-xs font-extrabold shadow-2xs border border-teal-200">
                                {{ strtoupper(substr(auth()->user()->name ?? 'P', 0, 1)) }}
                            </div>
                            <svg class="h-4 w-4 text-gray-400 hidden sm:block" fill="none" viewBox="0 0 24 24" stroke="currentColor">
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
                             class="absolute right-0 mt-2 w-60 bg-white rounded-2xl shadow-xl py-2 border border-gray-100 z-50"
                             style="display: none;">
                            <div class="px-4 py-2.5 border-b border-gray-100">
                                <p class="text-xs font-bold text-gray-900 truncate">{{ auth()->user()->name }}</p>
                                <p class="text-[11px] text-gray-500 truncate">{{ auth()->user()->email }}</p>
                            </div>
                            <a href="{{ route('peserta.dashboard') }}"
                                class="flex items-center gap-2.5 px-4 py-2 text-xs font-medium text-gray-700 hover:bg-gray-50 transition">
                                <i class="fas fa-th-large text-gray-400 w-4 text-center"></i>
                                <span>Dashboard Peserta</span>
                            </a>
                            @if(auth()->user() && auth()->user()->hasRole('alumni'))
                                <a href="{{ route('alumni.dashboard') }}"
                                    class="flex items-center gap-2.5 px-4 py-2 text-xs font-semibold text-teal-700 bg-teal-50/60 hover:bg-teal-50 transition">
                                    <i class="fas fa-graduation-cap text-teal-500 w-4 text-center"></i>
                                    <span>Portal Alumni</span>
                                </a>
                            @endif
                            <a href="{{ route('profile.edit') }}"
                                class="flex items-center gap-2.5 px-4 py-2 text-xs font-medium text-gray-700 hover:bg-gray-50 transition">
                                <i class="fas fa-user-cog text-gray-400 w-4 text-center"></i>
                                <span>Pengaturan Akun</span>
                            </a>
                            <a href="{{ route('peserta.feedback.index') }}"
                                class="flex items-center gap-2.5 px-4 py-2 text-xs font-medium text-gray-700 hover:bg-gray-50 transition">
                                <i class="fas fa-comment-dots text-gray-400 w-4 text-center"></i>
                                <span>Feedback &amp; Aspirasi</span>
                            </a>
                            <a href="{{ route('home') }}" target="_blank"
                                class="sm:hidden flex items-center gap-2.5 px-4 py-2 text-xs font-medium text-gray-700 hover:bg-gray-50 transition">
                                <i class="fas fa-globe text-gray-400 w-4 text-center"></i>
                                <span>Lihat Website</span>
                            </a>
                            <div class="border-t border-gray-100 my-1"></div>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit"
                                    class="flex items-center gap-2.5 w-full text-left px-4 py-2 text-xs font-semibold text-red-600 hover:bg-red-50 transition">
                                    <i class="fas fa-sign-out-alt text-red-400 w-4 text-center"></i>
                                    <span>Keluar (Logout)</span>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Main Scrollable Content -->
            <main class="flex-1 overflow-x-hidden overflow-y-auto p-4 sm:p-6 lg:p-8">
                <!-- Flash Messages -->
                @if (session()->has('success'))
                    <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)"
                        class="max-w-5xl mx-auto bg-emerald-50 border border-emerald-200 text-emerald-800 p-4 mb-6 rounded-2xl shadow-xs flex items-center justify-between" role="alert">
                        <div class="flex items-center gap-2.5 text-xs font-semibold">
                            <i class="fas fa-check-circle text-emerald-600 text-base"></i>
                            <span>{{ session('success') }}</span>
                        </div>
                        <button type="button" @click="show = false" class="text-emerald-500 hover:text-emerald-700">✕</button>
                    </div>
                @endif

                @if (session()->has('error'))
                    <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)"
                        class="max-w-5xl mx-auto bg-red-50 border border-red-200 text-red-800 p-4 mb-6 rounded-2xl shadow-xs flex items-center justify-between" role="alert">
                        <div class="flex items-center gap-2.5 text-xs font-semibold">
                            <i class="fas fa-exclamation-circle text-red-600 text-base"></i>
                            <span>{{ session('error') }}</span>
                        </div>
                        <button type="button" @click="show = false" class="text-red-500 hover:text-red-700">✕</button>
                    </div>
                @endif
                
                @yield('content')
            </main>
        </div>
    </div>

    @stack('scripts')
</body>
</html>
