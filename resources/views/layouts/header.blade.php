<!-- Navbar -->
<nav x-data="{ isOpen: false }"
    class="bg-white/95 backdrop-blur-md md:fixed w-full top-0 z-50 shadow-sm border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">
            <!-- Logo and Brand -->
            <div class="flex-shrink-0 flex items-center space-x-3">
                <a href="{{ route('home') }}" class="flex items-center space-x-2 group">
                    <x-application-logo
                        class="block h-10 w-auto fill-current text-emerald-600 transition-transform group-hover:scale-105" />
                </a>
            </div>

            <!-- Desktop Menu -->
            <div class="hidden md:block">
                <div class="ml-10 flex items-center space-x-1">
                    <a href="{{ route('home') }}"
                        class="text-gray-700 hover:text-emerald-600 hover:bg-emerald-50 px-4 py-2 rounded-lg text-sm font-medium transition {{ request()->routeIs('home') ? 'bg-emerald-50 text-emerald-600' : '' }}">
                        Home
                    </a>

                    <!-- Program Dropdown -->
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open"
                            class="text-gray-700 hover:text-emerald-600 hover:bg-emerald-50 px-4 py-2 rounded-lg text-sm font-medium inline-flex items-center gap-1 transition {{ request()->routeIs('programs.*') ? 'bg-emerald-50 text-emerald-600' : '' }}">
                            <span>Program</span>
                            <svg class="w-4 h-4 transition-transform" :class="{ 'rotate-180': open }" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                        <div x-show="open" x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                            x-transition:leave="transition ease-in duration-150"
                            x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
                            @click.away="open = false"
                            class="absolute left-0 mt-2 w-56 bg-white rounded-xl shadow-lg border border-gray-100 py-2 z-10">
                            @foreach (App\Models\Program::take(6)->get() as $program)
                                <a href="{{ route('programs.show', $program->slug) }}"
                                    class="block px-4 py-2.5 text-sm text-gray-700 hover:bg-emerald-50 hover:text-emerald-600 transition">
                                    {{ $program->title }}
                                </a>
                            @endforeach
                        </div>
                    </div>

                    <!-- Activities Dropdown -->
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open"
                            class="text-gray-700 hover:text-emerald-600 hover:bg-emerald-50 px-4 py-2 rounded-lg text-sm font-medium inline-flex items-center gap-1 transition {{ request()->routeIs('activities.*') ? 'bg-emerald-50 text-emerald-600' : '' }}">
                            <span>Kegiatan</span>
                            <svg class="w-4 h-4 transition-transform" :class="{ 'rotate-180': open }" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                        <div x-show="open" x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                            x-transition:leave="transition ease-in duration-150"
                            x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
                            @click.away="open = false"
                            class="absolute left-0 mt-2 w-56 bg-white rounded-xl shadow-lg border border-gray-100 py-2 z-10">
                            <a href="{{ route('activities.index') }}"
                                class="block px-4 py-2.5 text-sm text-gray-700 hover:bg-emerald-50 hover:text-emerald-600 transition font-medium border-b border-gray-100">
                                Semua Kegiatan
                            </a>
                            @foreach (App\Models\Activity::take(5)->where('status', 'published')->get() as $activity)
                                <a href="{{ route('activities.show', $activity->slug) }}"
                                    class="block px-4 py-2.5 text-sm text-gray-700 hover:bg-emerald-50 hover:text-emerald-600 transition">
                                    {{ $activity->title }}
                                </a>
                            @endforeach
                        </div>
                    </div>

                    <!-- Content Dropdown -->
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open"
                            class="text-gray-700 hover:text-emerald-600 hover:bg-emerald-50 px-4 py-2 rounded-lg text-sm font-medium inline-flex items-center gap-1 transition {{ request()->routeIs('articles.*') || request()->routeIs('news.*') ? 'bg-emerald-50 text-emerald-600' : '' }}">
                            <span>Konten</span>
                            <svg class="w-4 h-4 transition-transform" :class="{ 'rotate-180': open }" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                        <div x-show="open" x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                            x-transition:leave="transition ease-in duration-150"
                            x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
                            @click.away="open = false"
                            class="absolute left-0 mt-2 w-48 bg-white rounded-xl shadow-lg border border-gray-100 py-2 z-10">
                            <a href="{{ route('articles.index') }}"
                                class="block px-4 py-2.5 text-sm text-gray-700 hover:bg-emerald-50 hover:text-emerald-600 transition">
                                Artikel
                            </a>
                            <a href="{{ route('news.index') }}"
                                class="block px-4 py-2.5 text-sm text-gray-700 hover:bg-emerald-50 hover:text-emerald-600 transition">
                                Berita
                            </a>
                        </div>
                    </div>

                    <a href="{{ route('services.index') }}"
                        class="text-gray-700 hover:text-emerald-600 hover:bg-emerald-50 px-4 py-2 rounded-lg text-sm font-medium transition {{ request()->routeIs('services.*') ? 'bg-emerald-50 text-emerald-600' : '' }}">
                        Layanan
                    </a>
                    <a href="{{ route('contact') }}"
                        class="text-gray-700 hover:text-emerald-600 hover:bg-emerald-50 px-4 py-2 rounded-lg text-sm font-medium transition {{ request()->routeIs('contact') ? 'bg-emerald-50 text-emerald-600' : '' }}">
                        Contact
                    </a>
                </div>
            </div>

            <!-- Auth Buttons -->
            <div class="hidden md:flex items-center space-x-3">
                @auth
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open"
                            class="flex items-center space-x-2 px-3 py-2 rounded-lg hover:bg-gray-50 transition">
                            <img class="h-9 w-9 rounded-full ring-2 ring-emerald-500/20"
                                src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user() ? Auth::user()->name : '') }}&background=059669&color=fff"
                                alt="{{ Auth::user()->name }}">
                            <span class="text-sm font-medium text-gray-700">{{ Str::limit(Auth::user()->name, 15) }}</span>
                            <svg class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>

                        <div x-show="open" x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                            x-transition:leave="transition ease-in duration-150"
                            x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
                            @click.away="open = false"
                            class="absolute right-0 mt-2 w-56 bg-white rounded-xl shadow-lg border border-gray-100 py-2 z-10">
                            @if (auth()->user()->hasRole('admin'))
                                <a href="{{ route('admin.dashboard') }}"
                                    class="flex items-center gap-2 px-4 py-2.5 text-sm text-gray-700 hover:bg-emerald-50 hover:text-emerald-600 transition">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z">
                                        </path>
                                    </svg>
                                    Admin Dashboard
                                </a>
                            @endif
                            @if (auth()->user()->hasRole('alumni'))
                                <a href="{{ route('alumni.dashboard') }}"
                                    class="flex items-center gap-2 px-4 py-2.5 text-sm text-gray-700 hover:bg-emerald-50 hover:text-emerald-600 transition">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                    Alumni Dashboard
                                </a>
                            @endif
                            <a href="{{ route('alumni.password.change') }}"
                                class="flex items-center gap-2 px-4 py-2.5 text-sm text-gray-700 hover:bg-emerald-50 hover:text-emerald-600 transition">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z">
                                    </path>
                                </svg>
                                Ubah Password
                            </a>
                            <div class="border-t border-gray-100 my-1"></div>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit"
                                    class="flex items-center gap-2 w-full text-left px-4 py-2.5 text-sm text-red-600 hover:bg-red-50 transition">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                                        </path>
                                    </svg>
                                    Logout
                                </button>
                            </form>
                        </div>
                    </div>
                @else
                    <a href="{{ route('login') }}"
                        class="inline-flex items-center gap-2 bg-emerald-600 text-white px-5 py-2.5 rounded-lg text-sm font-semibold hover:bg-emerald-700 transition shadow-sm hover:shadow">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1">
                            </path>
                        </svg>
                        Login
                    </a>
                @endauth
            </div>

            <!-- Mobile menu button -->
            <div class="md:hidden">
                <button @click="isOpen = !isOpen"
                    class="text-gray-700 hover:text-emerald-600 p-2 rounded-lg hover:bg-emerald-50 transition">
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

    <!-- Mobile Menu -->
    <div x-show="isOpen" x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 -translate-y-2" class="md:hidden bg-white border-t border-gray-100">
        <div class="px-4 pt-2 pb-3 space-y-1">
            <a href="{{ route('home') }}"
                class="text-gray-700 hover:text-emerald-600 hover:bg-emerald-50 block px-3 py-2.5 rounded-lg text-base font-medium transition {{ request()->routeIs('home') ? 'bg-emerald-50 text-emerald-600' : '' }}">
                Home
            </a>

            <!-- Mobile Program Dropdown -->
            <div x-data="{ open: false }">
                <button @click="open = !open"
                    class="w-full text-left text-gray-700 hover:text-emerald-600 hover:bg-emerald-50 px-3 py-2.5 rounded-lg text-base font-medium transition {{ request()->routeIs('programs.*') ? 'bg-emerald-50 text-emerald-600' : '' }} flex justify-between items-center">
                    <span>Program</span>
                    <svg class="w-4 h-4 transition-transform" :class="{ 'rotate-180': open }" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div x-show="open" x-collapse class="pl-4 mt-1 space-y-1">
                    @foreach (App\Models\Program::take(3)->get() as $program)
                        <a href="{{ route('programs.show', $program->slug) }}"
                            class="text-gray-600 hover:text-emerald-600 hover:bg-emerald-50 block px-3 py-2 rounded-lg text-sm transition">
                            {{ $program->title }}
                        </a>
                    @endforeach
                </div>
            </div>

            <!-- Mobile Activities Dropdown -->
            <div x-data="{ open: false }">
                <button @click="open = !open"
                    class="w-full text-left text-gray-700 hover:text-emerald-600 hover:bg-emerald-50 px-3 py-2.5 rounded-lg text-base font-medium transition {{ request()->routeIs('activities.*') ? 'bg-emerald-50 text-emerald-600' : '' }} flex justify-between items-center">
                    <span>Kegiatan</span>
                    <svg class="w-4 h-4 transition-transform" :class="{ 'rotate-180': open }" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div x-show="open" x-collapse class="pl-4 mt-1 space-y-1">
                    <a href="{{ route('activities.index') }}"
                        class="text-gray-600 hover:text-emerald-600 hover:bg-emerald-50 block px-3 py-2 rounded-lg text-sm transition font-medium">
                        Semua Kegiatan
                    </a>
                    @foreach (App\Models\Activity::take(3)->get() as $activity)
                        <a href="{{ route('activities.show', $activity->slug) }}"
                            class="text-gray-600 hover:text-emerald-600 hover:bg-emerald-50 block px-3 py-2 rounded-lg text-sm transition">
                            {{ $activity->title }}
                        </a>
                    @endforeach
                </div>
            </div>

            <!-- Mobile Content Dropdown -->
            <div x-data="{ open: false }">
                <button @click="open = !open"
                    class="w-full text-left text-gray-700 hover:text-emerald-600 hover:bg-emerald-50 px-3 py-2.5 rounded-lg text-base font-medium transition {{ request()->routeIs('articles.*') || request()->routeIs('news.*') ? 'bg-emerald-50 text-emerald-600' : '' }} flex justify-between items-center">
                    <span>Konten</span>
                    <svg class="w-4 h-4 transition-transform" :class="{ 'rotate-180': open }" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div x-show="open" x-collapse class="pl-4 mt-1 space-y-1">
                    <a href="{{ route('articles.index') }}"
                        class="text-gray-600 hover:text-emerald-600 hover:bg-emerald-50 block px-3 py-2 rounded-lg text-sm transition">
                        Artikel
                    </a>
                    <a href="{{ route('news.index') }}"
                        class="text-gray-600 hover:text-emerald-600 hover:bg-emerald-50 block px-3 py-2 rounded-lg text-sm transition">
                        Berita
                    </a>
                </div>
            </div>

            <a href="{{ route('services.index') }}"
                class="text-gray-700 hover:text-emerald-600 hover:bg-emerald-50 block px-3 py-2.5 rounded-lg text-base font-medium transition {{ request()->routeIs('services.*') ? 'bg-emerald-50 text-emerald-600' : '' }}">
                Layanan
            </a>
            <a href="{{ route('contact') }}"
                class="text-gray-700 hover:text-emerald-600 hover:bg-emerald-50 block px-3 py-2.5 rounded-lg text-base font-medium transition {{ request()->routeIs('contact') ? 'bg-emerald-50 text-emerald-600' : '' }}">
                Contact
            </a>
        </div>

        <!-- Mobile Auth Section -->
        @guest
            <div class="pt-4 pb-3 border-t border-gray-100 px-4">
                <a href="{{ route('login') }}"
                    class="flex items-center justify-center gap-2 w-full px-4 py-3 bg-emerald-600 text-white rounded-lg font-semibold hover:bg-emerald-700 transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1">
                        </path>
                    </svg>
                    Login
                </a>
            </div>
        @else
            <div class="pt-4 pb-3 border-t border-gray-100">
                <div class="flex items-center px-5 mb-3">
                    <div class="flex-shrink-0">
                        <img class="h-12 w-12 rounded-full ring-2 ring-emerald-500/20"
                            src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user() ? Auth::user()->name : '') }}&background=059669&color=fff"
                            alt="{{ Auth::user()->name }}">
                    </div>
                    <div class="ml-3">
                        <div class="text-base font-semibold text-gray-800">{{ Auth::user()->name }}</div>
                        <div class="text-sm text-gray-500">{{ Auth::user()->email }}</div>
                    </div>
                </div>
                <div class="px-4 space-y-1">
                    @if (auth()->user()->hasRole('admin'))
                        <a href="{{ route('admin.dashboard') }}"
                            class="flex items-center gap-2 px-3 py-2.5 rounded-lg text-base font-medium text-gray-700 hover:bg-emerald-50 hover:text-emerald-600 transition">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z">
                                </path>
                            </svg>
                            Admin Dashboard
                        </a>
                    @endif
                    @if (auth()->user()->hasRole('alumni'))
                        <a href="{{ route('alumni.dashboard') }}"
                            class="flex items-center gap-2 px-3 py-2.5 rounded-lg text-base font-medium text-gray-700 hover:bg-emerald-50 hover:text-emerald-600 transition">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            Alumni Dashboard
                        </a>
                    @endif
                    <a href="{{ route('alumni.password.change') }}"
                        class="flex items-center gap-2 px-3 py-2.5 rounded-lg text-base font-medium text-gray-700 hover:bg-emerald-50 hover:text-emerald-600 transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z">
                            </path>
                        </svg>
                        Ubah Password
                    </a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            class="flex items-center gap-2 w-full text-left px-3 py-2.5 rounded-lg text-base font-medium text-red-600 hover:bg-red-50 transition">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                                </path>
                            </svg>
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        @endguest
    </div>
</nav>
