<!-- Navbar -->
<nav x-data="{ isOpen: false }" class="bg-white md:fixed w-full top-0 z-50 shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">
            <!-- Logo and Brand -->
            <div class="flex-shrink-0 flex items-center space-x-3">

                <a href="{{ route('home') }}">
                    <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                </a>
            </div>

            <!-- Desktop Menu -->
            <div class="hidden md:block">
                <div class="ml-10 flex items-center space-x-4">
                    <a href="{{ route('home') }}"
                        class="text-gray-700 hover:text-gray-900 px-3 py-2 rounded-md text-sm font-medium {{ request()->routeIs('home') ? 'bg-gray-100' : '' }}">
                        Home
                    </a>

                    <!-- Program Dropdown -->
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open"
                            class="text-gray-700 hover:text-gray-900 px-3 py-2 rounded-md text-sm font-medium inline-flex items-center {{ request()->routeIs('programs.*') ? 'bg-gray-100' : '' }}">
                            <span>Program</span>
                            <svg class="ml-1 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                        <div x-show="open" @click.away="open = false"
                            class="absolute left-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-10">
                            {{-- <a href="{{ route('programs.index') }}"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                Semua Program
                            </a> --}}
                            @foreach (App\Models\Program::take(6)->get() as $program)
                                <a href="{{ route('programs.show', $program->slug) }}"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    {{ $program->title }}
                                </a>
                            @endforeach
                        </div>
                    </div>

                    <!-- Activities Dropdown -->
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open"
                            class="text-gray-700 hover:text-gray-900 px-3 py-2 rounded-md text-sm font-medium inline-flex items-center {{ request()->routeIs('activities.*') ? 'bg-gray-100' : '' }}">
                            <span>Kegiatan</span>
                            <svg class="ml-1 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                        <div x-show="open" @click.away="open = false"
                            class="absolute left-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-10">
                            <a href="{{ route('activities.index') }}"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                Semua Kegiatan
                            </a>
                            @foreach (App\Models\Activity::take(5)->where('status', 'published')->get() as $activity)
                                <a href="{{ route('activities.show', $activity->slug) }}"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    {{ $activity->title }}
                                </a>
                            @endforeach
                        </div>
                    </div>

                    <!-- Content Dropdown -->
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open"
                            class="text-gray-700 hover:text-gray-900 px-3 py-2 rounded-md text-sm font-medium inline-flex items-center {{ request()->routeIs('articles.*') || request()->routeIs('news.*') ? 'bg-gray-100' : '' }}">
                            <span>Konten</span>
                            <svg class="ml-1 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                        <div x-show="open" @click.away="open = false"
                            class="absolute left-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-10">
                            <a href="{{ route('articles.index') }}"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                Artikel
                            </a>
                            <a href="{{ route('news.index') }}"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                Berita
                            </a>
                        </div>
                    </div>

                    <a href="{{ route('services.index') }}"
                        class="text-gray-700 hover:text-gray-900 px-3 py-2 rounded-md text-sm font-medium {{ request()->routeIs('services.*') ? 'bg-gray-100' : '' }}">
                        Layanan
                    </a>
                    <a href="{{ route('contact') }}"
                        class="text-gray-700 hover:text-gray-900 px-3 py-2 rounded-md text-sm font-medium {{ request()->routeIs('contact') ? 'bg-gray-100' : '' }}">
                        Contact
                    </a>
                </div>
            </div>

            <!-- Auth Buttons -->
            <div class="hidden md:flex items-center space-x-3">
                @auth
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open" class="flex items-center space-x-2 text-gray-700 hover:text-gray-900">
                            <img class="h-8 w-8 rounded-full"
                                src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user() ? Auth::user()->name : '') }}"
                                alt="{{ Auth::user()->name }}">
                            <span>{{ Auth::user()->name }}</span>
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>

                        <div x-show="open" @click.away="open = false"
                            class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-10">
                            @if (auth()->user()->hasRole('admin'))
                                <a href="{{ route('admin.dashboard') }}"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    Admin Dashboard
                                </a>
                            @endif
                            @if (auth()->user()->hasRole('alumni'))
                                <a href="{{ route('alumni.dashboard') }}"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    Alumni Dashboard
                                </a>
                            @endif
                            <a href="{{ route('alumni.password.change') }}"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                Ubah Password
                            </a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit"
                                    class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    Logout
                                </button>
                            </form>
                        </div>
                    </div>
                @else
                    <a href="{{ route('login') }}"
                        class="bg-green-500 text-white px-4 py-2 rounded-md text-sm font-medium hover:bg-green-600 transition duration-300">
                        Login
                    </a>
                @endauth
            </div>

            <!-- Mobile menu button -->
            <div class="md:hidden">
                <button @click="isOpen = !isOpen" class="text-gray-700 hover:text-gray-900">
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
    <div x-show="isOpen" class="md:hidden bg-white">
        <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
            <a href="{{ route('home') }}"
                class="text-gray-700 block px-3 py-2 rounded-md text-base font-medium {{ request()->routeIs('home') ? 'bg-gray-100' : '' }}">
                Home
            </a>

            <!-- Mobile Program Dropdown -->
            <div x-data="{ open: false }">
                <button @click="open = !open"
                    class="w-full text-left text-gray-700 hover:text-gray-900 block px-3 py-2 rounded-md text-base font-medium {{ request()->routeIs('programs.*') ? 'bg-gray-100' : '' }} flex justify-between items-center">
                    <span>Program</span>
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path x-show="!open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 9l-7 7-7-7" />
                        <path x-show="open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M5 15l7-7 7 7" />
                    </svg>
                </button>
                <div x-show="open" class="pl-4">
                    {{-- <a href="{{ route('programs.index') }}"
                        class="text-gray-700 hover:text-gray-900 block px-3 py-2 rounded-md text-sm font-medium">
                        Semua Program
                    </a> --}}
                    @foreach (App\Models\Program::take(3)->get() as $program)
                        <a href="{{ route('programs.show', $program->slug) }}"
                            class="text-gray-700 hover:text-gray-900 block px-3 py-2 rounded-md text-sm font-medium">
                            {{ $program->title }}
                        </a>
                    @endforeach
                </div>
            </div>

            <!-- Mobile Activities Dropdown -->
            <div x-data="{ open: false }">
                <button @click="open = !open"
                    class="w-full text-left text-gray-700 hover:text-gray-900 block px-3 py-2 rounded-md text-base font-medium {{ request()->routeIs('activities.*') ? 'bg-gray-100' : '' }} flex justify-between items-center">
                    <span>Kegiatan</span>
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path x-show="!open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 9l-7 7-7-7" />
                        <path x-show="open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M5 15l7-7 7 7" />
                    </svg>
                </button>
                <div x-show="open" class="pl-4">
                    <a href="{{ route('activities.index') }}"
                        class="text-gray-700 hover:text-gray-900 block px-3 py-2 rounded-md text-sm font-medium">
                        Semua Kegiatan
                    </a>
                    @foreach (App\Models\Activity::take(3)->get() as $activity)
                        <a href="{{ route('activities.show', $activity->slug) }}"
                            class="text-gray-700 hover:text-gray-900 block px-3 py-2 rounded-md text-sm font-medium">
                            {{ $activity->title }}
                        </a>
                    @endforeach
                </div>
            </div>

            <!-- Mobile Content Dropdown -->
            <div x-data="{ open: false }">
                <button @click="open = !open"
                    class="w-full text-left text-gray-700 hover:text-gray-900 block px-3 py-2 rounded-md text-base font-medium {{ request()->routeIs('articles.*') || request()->routeIs('news.*') ? 'bg-gray-100' : '' }} flex justify-between items-center">
                    <span>Konten</span>
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path x-show="!open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 9l-7 7-7-7" />
                        <path x-show="open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M5 15l7-7 7 7" />
                    </svg>
                </button>
                <div x-show="open" class="pl-4">
                    <a href="{{ route('articles.index') }}"
                        class="text-gray-700 hover:text-gray-900 block px-3 py-2 rounded-md text-sm font-medium">
                        Artikel
                    </a>
                    <a href="{{ route('news.index') }}"
                        class="text-gray-700 hover:text-gray-900 block px-3 py-2 rounded-md text-sm font-medium">
                        Berita
                    </a>
                </div>
            </div>

            <a href="{{ route('services.index') }}"
                class="text-gray-700 hover:text-gray-900 block px-3 py-2 rounded-md text-base font-medium {{ request()->routeIs('services.*') ? 'bg-gray-100' : '' }}">
                Layanan
            </a>
            <a href="{{ route('contact') }}"
                class="text-gray-700 hover:text-gray-900 block px-3 py-2 rounded-md text-base font-medium {{ request()->routeIs('contact') ? 'bg-gray-100' : '' }}">
                Contact
            </a>
        </div>
        @guest
            <div class="pt-4 pb-3 border-t border-gray-200">
                <div class="flex items-center px-5">
                    <div class="flex-shrink-0">
                        <img class="h-10 w-10 rounded-full"
                            src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user() ? Auth::user()->name : '') }}"
                            alt="">
                    </div>
                    <div class="ml-3">
                        <div class="text-base font-medium text-gray-800">Guest</div>
                        <div class="text-sm font-medium text-gray-500">Please login to access more features</div>
                    </div>
                </div>
                <div class="mt-3 px-2 space-y-1">
                    <a href="{{ route('login') }}"
                        class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:bg-gray-100">
                        Login
                    </a>
                </div>
            </div>
        @else
            <div class="pt-4 pb-3 border-t border-gray-200">
                <div class="flex items-center px-5">
                    <div class="flex-shrink-0">
                        <img class="h-10 w-10 rounded-full"
                            src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user() ? Auth::user()->name : '') }}"
                            alt="">
                    </div>
                    <div class="ml-3">
                        <div class="text-base font-medium text-gray-800">{{ Auth::user()->name }}</div>
                        <div class="text-sm font-medium text-gray-500">{{ Auth::user()->email }}</div>
                    </div>
                </div>
                <div class="mt-3 px-2 space-y-1">
                    @if (auth()->user()->hasRole('admin'))
                        <a href="{{ route('admin.dashboard') }}"
                            class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:bg-gray-100">
                            Admin Dashboard
                        </a>
                    @endif
                    @if (auth()->user()->hasRole('alumni'))
                        <a href="{{ route('alumni.dashboard') }}"
                            class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:bg-gray-100">
                            Alumni Dashboard
                        </a>
                    @endif
                    <a href="{{ route('alumni.password.change') }}"
                        class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:bg-gray-100">
                        Ubah Password
                    </a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            class="block w-full text-left px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:bg-gray-100">
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        @endguest
    </div>
</nav>
