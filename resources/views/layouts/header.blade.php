<!-- Navbar -->
<nav x-data="{ isOpen: false }"
    class="bg-white/95 backdrop-blur-md fixed inset-x-0 top-0 z-50 w-full shadow-xs border-b border-gray-200/80 transition-all">
    <div class="max-w-7xl mx-auto px-3 sm:px-6 lg:px-8 w-full">
        <div class="flex items-center justify-between h-16 w-full gap-2 sm:gap-4">
            
            <!-- Logo and Brand -->
            <div class="flex-shrink-0 flex items-center min-w-0">
                <a href="{{ route('home') }}" class="flex items-center group">
                    <x-application-logo
                        class="h-7 sm:h-9 md:h-10 w-auto max-w-[130px] xs:max-w-[170px] sm:max-w-[210px] md:max-w-none fill-current text-emerald-600 transition-transform group-hover:scale-105" />
                </a>
            </div>

            <!-- Desktop Navigation Menu -->
            <div class="hidden lg:block">
                <div class="flex items-center space-x-1">
                    <a href="{{ route('home') }}"
                        class="px-3.5 py-2 rounded-xl text-xs font-semibold transition {{ request()->routeIs('home') ? 'bg-emerald-50 text-emerald-700 shadow-2xs font-bold' : 'text-gray-700 hover:text-emerald-700 hover:bg-gray-50' }}">
                        Beranda
                    </a>

                    <!-- Program Dropdown -->
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open"
                            class="px-3 py-2 rounded-xl text-xs font-semibold inline-flex items-center gap-1 transition {{ request()->routeIs('programs.*') ? 'bg-emerald-50 text-emerald-700 font-bold' : 'text-gray-700 hover:text-emerald-700 hover:bg-gray-50' }}">
                            <span>Program</span>
                            <svg class="w-3.5 h-3.5 transition-transform text-gray-400" :class="{ 'rotate-180 text-emerald-600': open }" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                        <div x-show="open" x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 translate-y-1 scale-95" x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                            x-transition:leave="transition ease-in duration-150"
                            x-transition:leave-start="opacity-100 translate-y-0 scale-100" x-transition:leave-end="opacity-0 translate-y-1 scale-95"
                            @click.away="open = false"
                            class="absolute left-0 mt-2 w-64 bg-white rounded-2xl shadow-xl border border-gray-100 p-2 z-20">
                            <a href="{{ route('programs.index') }}"
                                class="flex items-center justify-between px-3.5 py-2 rounded-xl text-xs font-bold text-emerald-700 bg-emerald-50/60 hover:bg-emerald-50 mb-1 transition">
                                <span>Semua Program</span>
                                <span>&rarr;</span>
                            </a>
                            @foreach (App\Models\Program::take(5)->get() as $program)
                                <a href="{{ route('programs.show', $program->slug) }}"
                                    class="block px-3.5 py-2 rounded-xl text-xs text-gray-700 hover:bg-gray-50 hover:text-emerald-700 transition">
                                    {{ $program->title }}
                                </a>
                            @endforeach
                        </div>
                    </div>

                    <!-- Activities Dropdown -->
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open"
                            class="px-3 py-2 rounded-xl text-xs font-semibold inline-flex items-center gap-1 transition {{ request()->routeIs('activities.*') ? 'bg-emerald-50 text-emerald-700 font-bold' : 'text-gray-700 hover:text-emerald-700 hover:bg-gray-50' }}">
                            <span>Kegiatan</span>
                            <svg class="w-3.5 h-3.5 transition-transform text-gray-400" :class="{ 'rotate-180 text-emerald-600': open }" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                        <div x-show="open" x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 translate-y-1 scale-95" x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                            x-transition:leave="transition ease-in duration-150"
                            x-transition:leave-start="opacity-100 translate-y-0 scale-100" x-transition:leave-end="opacity-0 translate-y-1 scale-95"
                            @click.away="open = false"
                            class="absolute left-0 mt-2 w-64 bg-white rounded-2xl shadow-xl border border-gray-100 p-2 z-20">
                            <a href="{{ route('activities.index') }}"
                                class="flex items-center justify-between px-3.5 py-2 rounded-xl text-xs font-bold text-emerald-700 bg-emerald-50/60 hover:bg-emerald-50 mb-1 transition">
                                <span>Semua Kegiatan</span>
                                <span>&rarr;</span>
                            </a>
                            @foreach (App\Models\Activity::take(5)->where('status', 'published')->get() as $activity)
                                <a href="{{ route('activities.show', $activity->slug) }}"
                                    class="block px-3.5 py-2 rounded-xl text-xs text-gray-700 hover:bg-gray-50 hover:text-emerald-700 transition">
                                    {{ $activity->title }}
                                </a>
                            @endforeach
                        </div>
                    </div>

                    @auth
                        <!-- Ta'aruf Special Link (Only for Logged-In Users) -->
                        <a href="{{ route('taaruf.index') }}"
                            class="px-3 py-2 rounded-xl text-xs font-semibold inline-flex items-center gap-1.5 transition {{ request()->is('taaruf*') ? 'bg-rose-50 text-rose-700 font-bold border border-rose-200/60' : 'text-gray-700 hover:text-rose-700 hover:bg-rose-50/50' }}">
                            <span>💍</span>
                            <span>Ta'aruf</span>
                        </a>
                    @endauth

                    <!-- Content Dropdown -->
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open"
                            class="px-3 py-2 rounded-xl text-xs font-semibold inline-flex items-center gap-1 transition {{ request()->routeIs('articles.*') || request()->routeIs('news.*') ? 'bg-emerald-50 text-emerald-700 font-bold' : 'text-gray-700 hover:text-emerald-700 hover:bg-gray-50' }}">
                            <span>Konten</span>
                            <svg class="w-3.5 h-3.5 transition-transform text-gray-400" :class="{ 'rotate-180 text-emerald-600': open }" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                        <div x-show="open" x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 translate-y-1 scale-95" x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                            x-transition:leave="transition ease-in duration-150"
                            x-transition:leave-start="opacity-100 translate-y-0 scale-100" x-transition:leave-end="opacity-0 translate-y-1 scale-95"
                            @click.away="open = false"
                            class="absolute left-0 mt-2 w-48 bg-white rounded-2xl shadow-xl border border-gray-100 p-2 z-20">
                            <a href="{{ route('articles.index') }}"
                                class="flex items-center gap-2 px-3.5 py-2 rounded-xl text-xs text-gray-700 hover:bg-gray-50 hover:text-emerald-700 transition">
                                <span>📖</span>
                                <span>Artikel</span>
                            </a>
                            <a href="{{ route('news.index') }}"
                                class="flex items-center gap-2 px-3.5 py-2 rounded-xl text-xs text-gray-700 hover:bg-gray-50 hover:text-emerald-700 transition">
                                <span>📰</span>
                                <span>Berita Salman</span>
                            </a>
                        </div>
                    </div>

                    <a href="{{ route('services.index') }}"
                        class="px-3.5 py-2 rounded-xl text-xs font-semibold transition {{ request()->routeIs('services.*') ? 'bg-emerald-50 text-emerald-700 font-bold' : 'text-gray-700 hover:text-emerald-700 hover:bg-gray-50' }}">
                        Layanan
                    </a>

                    <a href="{{ route('contact') }}"
                        class="px-3.5 py-2 rounded-xl text-xs font-semibold transition {{ request()->routeIs('contact') ? 'bg-emerald-50 text-emerald-700 font-bold' : 'text-gray-700 hover:text-emerald-700 hover:bg-gray-50' }}">
                        Kontak
                    </a>
                </div>
            </div>

            <!-- Desktop Auth Controls -->
            <div class="hidden lg:flex items-center space-x-3">
                <!-- Feedback Icon -->
                @php
                    $headerAnsweredCount = auth()->check() ? \App\Models\Feedback::byUser(auth()->id())->where('status', 'answered')->count() : 0;
                @endphp
                <a href="@auth{{ auth()->user()->hasRole('alumni') ? route('alumni.feedback.index') : route('peserta.feedback.index') }}@else{{ route('login') }}@endauth"
                    class="p-2 rounded-xl text-gray-500 hover:text-emerald-700 hover:bg-emerald-50 transition relative group"
                    title="Feedback">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                    </svg>
                    @if($headerAnsweredCount > 0)
                        <span class="absolute top-1.5 right-1.5 flex h-2.5 w-2.5">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-emerald-500 ring-2 ring-white"></span>
                        </span>
                    @endif
                    <span class="absolute -bottom-8 left-1/2 -translate-x-1/2 px-2 py-0.5 bg-gray-800 text-white text-[10px] font-medium rounded-md opacity-0 group-hover:opacity-100 transition whitespace-nowrap pointer-events-none">
                        @if($headerAnsweredCount > 0)
                            {{ $headerAnsweredCount }} Balasan Admin
                        @else
                            Feedback
                        @endif
                    </span>
                </a>
                @auth
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open"
                            class="flex items-center gap-2.5 px-3 py-1.5 rounded-full border border-gray-200/90 bg-white hover:bg-gray-50/80 transition shadow-2xs">
                            <img class="h-7 w-7 rounded-full ring-2 ring-emerald-500/20 object-cover"
                                src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user() ? Auth::user()->name : '') }}&background=059669&color=fff"
                                alt="{{ Auth::user()->name }}">
                            <span class="text-xs font-bold text-gray-800 max-w-[110px] truncate">{{ Auth::user()->name }}</span>
                            <svg class="h-3.5 w-3.5 text-gray-400 transition-transform" :class="{ 'rotate-180': open }" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>

                        <div x-show="open" x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 translate-y-1 scale-95" x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                            x-transition:leave="transition ease-in duration-150"
                            x-transition:leave-start="opacity-100 translate-y-0 scale-100" x-transition:leave-end="opacity-0 translate-y-1 scale-95"
                            @click.away="open = false"
                            class="absolute right-0 mt-2 w-56 bg-white rounded-2xl shadow-xl border border-gray-100 p-2 z-20 space-y-1">
                            
                            <div class="px-3.5 py-2 border-b border-gray-100 mb-1">
                                <p class="text-[11px] font-medium text-gray-400">Masuk sebagai:</p>
                                <p class="text-xs font-bold text-gray-900 truncate">{{ Auth::user()->email }}</p>
                            </div>

                            @if (auth()->user()->hasRole('admin'))
                                <a href="{{ route('admin.dashboard') }}"
                                    class="flex items-center gap-2.5 px-3.5 py-2 rounded-xl text-xs font-semibold text-gray-700 hover:bg-emerald-50 hover:text-emerald-700 transition">
                                    <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z">
                                        </path>
                                    </svg>
                                    Admin Dashboard
                                </a>
                            @endif

                            @if (!auth()->user()->hasRole('admin') && !auth()->user()->hasRole('author'))
                                <a href="{{ route('peserta.dashboard') }}"
                                    class="flex items-center gap-2.5 px-3.5 py-2 rounded-xl text-xs font-semibold text-gray-700 hover:bg-emerald-50 hover:text-emerald-700 transition">
                                    <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                    </svg>
                                    Dashboard Peserta
                                </a>
                            @endif

                            @if (auth()->user()->hasRole('alumni'))
                                <a href="{{ route('alumni.dashboard') }}"
                                    class="flex items-center gap-2.5 px-3.5 py-2 rounded-xl text-xs font-semibold text-gray-700 hover:bg-emerald-50 hover:text-emerald-700 transition">
                                    <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                    Portal Alumni
                                </a>
                            @endif

                            @if (auth()->user()->hasRole('author'))
                                <a href="{{ route('author.dashboard') }}"
                                    class="flex items-center gap-2.5 px-3.5 py-2 rounded-xl text-xs font-semibold text-gray-700 hover:bg-emerald-50 hover:text-emerald-700 transition">
                                    <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                    Author Dashboard
                                </a>
                            @endif

                            <a href="{{ route('profile.edit') }}"
                                class="flex items-center gap-2.5 px-3.5 py-2 rounded-xl text-xs text-gray-700 hover:bg-gray-50 transition">
                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                Pengaturan Akun
                            </a>

                            <div class="border-t border-gray-100 pt-1">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit"
                                        class="flex items-center gap-2.5 w-full text-left px-3.5 py-2 rounded-xl text-xs font-semibold text-red-600 hover:bg-red-50 transition">
                                        <svg class="w-4 h-4 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                                            </path>
                                        </svg>
                                        Keluar
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @else
                    <a href="{{ route('login') }}"
                        class="inline-flex items-center gap-2 px-5 py-2 rounded-xl bg-gradient-to-r from-emerald-600 to-teal-600 hover:from-emerald-700 hover:to-teal-700 text-white text-xs font-bold shadow-sm shadow-emerald-500/20 hover:shadow-md transition">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1">
                            </path>
                        </svg>
                        <span>Masuk</span>
                    </a>
                @endauth
            </div>

            <!-- Mobile menu button -->
            <div class="lg:hidden flex items-center gap-1.5 flex-shrink-0">
                @auth
                    <a href="@if(auth()->user()->hasRole('alumni')){{ route('alumni.feedback.index') }}@else{{ route('peserta.feedback.index') }}@endif"
                        class="p-2 rounded-xl text-gray-500 hover:text-emerald-600 transition flex-shrink-0 relative" title="Feedback">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                        </svg>
                        @if($headerAnsweredCount > 0)
                            <span class="absolute top-1.5 right-1.5 flex h-2 w-2">
                                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                                <span class="relative inline-flex rounded-full h-2 w-2 bg-emerald-500"></span>
                            </span>
                        @endif
                    </a>
                    <a href="{{ auth()->user()->hasRole('admin') ? route('admin.dashboard') : (auth()->user()->hasRole('alumni') ? route('alumni.dashboard') : route('peserta.dashboard')) }}"
                        class="p-0.5 rounded-full ring-2 ring-emerald-500/20 flex-shrink-0" title="Dashboard">
                        <img class="h-7 w-7 rounded-full object-cover"
                            src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user() ? Auth::user()->name : '') }}&background=059669&color=fff"
                            alt="{{ Auth::user()->name }}">
                    </a>
                @endauth
                <button @click="isOpen = !isOpen"
                    class="text-gray-700 hover:text-emerald-600 p-2 rounded-xl hover:bg-gray-100 transition focus:outline-none flex-shrink-0"
                    aria-label="Menu">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path x-show="!isOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path x-show="isOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Menu Drawer -->
    <div x-show="isOpen" x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 -translate-y-2" class="lg:hidden bg-white border-t border-gray-100 max-h-[85vh] overflow-y-auto">
        <div class="px-4 pt-3 pb-6 space-y-1">
            <a href="{{ route('home') }}"
                class="block px-3.5 py-2.5 rounded-xl text-xs font-semibold transition {{ request()->routeIs('home') ? 'bg-emerald-50 text-emerald-700 font-bold' : 'text-gray-700 hover:bg-gray-50' }}">
                Beranda
            </a>

            <!-- Mobile Program -->
            <div x-data="{ open: false }">
                <button @click="open = !open"
                    class="w-full text-left px-3.5 py-2.5 rounded-xl text-xs font-semibold text-gray-700 hover:bg-gray-50 flex justify-between items-center">
                    <span>Program</span>
                    <svg class="w-3.5 h-3.5 transition-transform" :class="{ 'rotate-180 text-emerald-600': open }" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div x-show="open" x-collapse class="pl-4 space-y-1">
                    <a href="{{ route('programs.index') }}" class="block px-3 py-2 rounded-lg text-xs font-bold text-emerald-700">
                        Semua Program &rarr;
                    </a>
                    @foreach (App\Models\Program::take(4)->get() as $program)
                        <a href="{{ route('programs.show', $program->slug) }}" class="block px-3 py-2 rounded-lg text-xs text-gray-600 hover:text-emerald-700">
                            {{ $program->title }}
                        </a>
                    @endforeach
                </div>
            </div>

            <!-- Mobile Activities -->
            <div x-data="{ open: false }">
                <button @click="open = !open"
                    class="w-full text-left px-3.5 py-2.5 rounded-xl text-xs font-semibold text-gray-700 hover:bg-gray-50 flex justify-between items-center">
                    <span>Kegiatan</span>
                    <svg class="w-3.5 h-3.5 transition-transform" :class="{ 'rotate-180 text-emerald-600': open }" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div x-show="open" x-collapse class="pl-4 space-y-1">
                    <a href="{{ route('activities.index') }}" class="block px-3 py-2 rounded-lg text-xs font-bold text-emerald-700">
                        Semua Kegiatan &rarr;
                    </a>
                    @foreach (App\Models\Activity::take(4)->where('status', 'published')->get() as $activity)
                        <a href="{{ route('activities.show', $activity->slug) }}" class="block px-3 py-2 rounded-lg text-xs text-gray-600 hover:text-emerald-700">
                            {{ $activity->title }}
                        </a>
                    @endforeach
                </div>
            </div>

            @auth
                <a href="{{ route('taaruf.index') }}"
                    class="block px-3.5 py-2.5 rounded-xl text-xs font-semibold text-rose-800 bg-rose-50/70 border border-rose-200/60">
                    💍 Ta'aruf Salman
                </a>
            @endauth

            <div x-data="{ open: false }">
                <button @click="open = !open"
                    class="w-full text-left px-3.5 py-2.5 rounded-xl text-xs font-semibold text-gray-700 hover:bg-gray-50 flex justify-between items-center">
                    <span>Konten</span>
                    <svg class="w-3.5 h-3.5 transition-transform" :class="{ 'rotate-180 text-emerald-600': open }" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div x-show="open" x-collapse class="pl-4 space-y-1">
                    <a href="{{ route('articles.index') }}" class="block px-3 py-2 rounded-lg text-xs text-gray-600">Artikel</a>
                    <a href="{{ route('news.index') }}" class="block px-3 py-2 rounded-lg text-xs text-gray-600">Berita Salman</a>
                </div>
            </div>

            <a href="{{ route('services.index') }}"
                class="block px-3.5 py-2.5 rounded-xl text-xs font-semibold text-gray-700 hover:bg-gray-50">
                Layanan
            </a>
            <a href="{{ route('contact') }}"
                class="block px-3.5 py-2.5 rounded-xl text-xs font-semibold text-gray-700 hover:bg-gray-50">
                Kontak
            </a>

            <!-- Mobile Auth Drawer Section -->
            <div class="pt-4 border-t border-gray-100">
                @guest
                    <a href="{{ route('login') }}"
                        class="flex items-center justify-center gap-2 w-full py-2.5 rounded-xl bg-gradient-to-r from-emerald-600 to-teal-600 text-white text-xs font-bold shadow-sm">
                        <span>Masuk / Login</span>
                    </a>
                @else
                    <div class="p-3 bg-gray-50 rounded-2xl border border-gray-200/80 mb-2">
                        <div class="flex items-center gap-3">
                            <img class="h-9 w-9 rounded-full object-cover"
                                src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user() ? Auth::user()->name : '') }}&background=059669&color=fff"
                                alt="{{ Auth::user()->name }}">
                            <div class="min-w-0">
                                <div class="text-xs font-bold text-gray-900 truncate">{{ Auth::user()->name }}</div>
                                <div class="text-[11px] text-gray-500 truncate">{{ Auth::user()->email }}</div>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-1">
                        @if (auth()->user()->hasRole('admin'))
                            <a href="{{ route('admin.dashboard') }}"
                                class="block px-3 py-2 rounded-xl text-xs font-bold text-emerald-700 bg-emerald-50">
                                Admin Dashboard
                            </a>
                        @endif
                        @if (!auth()->user()->hasRole('admin') && !auth()->user()->hasRole('author'))
                            <a href="{{ route('peserta.dashboard') }}"
                                class="block px-3 py-2 rounded-xl text-xs font-bold text-emerald-700 bg-emerald-50">
                                Dashboard Peserta
                            </a>
                        @endif
                        @if (auth()->user()->hasRole('alumni'))
                            <a href="{{ route('alumni.dashboard') }}"
                                class="block px-3 py-2 rounded-xl text-xs font-bold text-emerald-700 bg-emerald-50">
                                Portal Alumni
                            </a>
                        @endif
                        <a href="@if(auth()->user()->hasRole('alumni')){{ route('alumni.feedback.index') }}@else{{ route('peserta.feedback.index') }}@endif"
                            class="flex items-center justify-between px-3 py-2 rounded-xl text-xs text-gray-700 hover:bg-gray-50">
                            <div class="flex items-center">
                                <i class="fas fa-comment-dots mr-2 text-gray-400"></i>
                                <span>Feedback Saya</span>
                            </div>
                            @if($headerAnsweredCount > 0)
                                <span class="px-2 py-0.5 text-[10px] font-bold bg-emerald-600 text-white rounded-full">
                                    {{ $headerAnsweredCount }} Balasan
                                </span>
                            @endif
                        </a>
                        <a href="{{ route('profile.edit') }}" class="block px-3 py-2 rounded-xl text-xs text-gray-700 hover:bg-gray-50">
                            Pengaturan Profil
                        </a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="block w-full text-left px-3 py-2 rounded-xl text-xs font-bold text-red-600 hover:bg-red-50">
                                Keluar
                            </button>
                        </form>
                    </div>
                @endguest
            </div>
        </div>
    </div>
</nav>
