<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard') - Bidang Dakwah Masjid Salman ITB</title>
    <link rel="icon" href="{{ asset('favicon.png') }}">
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100">
    <div x-data="{ sidebarOpen: true }" class="min-h-screen">
        <!-- Sidebar -->
        <aside class="fixed inset-y-0 left-0 bg-white shadow-lg w-64 transform transition-transform duration-300"
            :class="{ '-translate-x-full': !sidebarOpen, 'translate-x-0': sidebarOpen }">
            <div class="flex items-center justify-between p-4 border-b">
                <div class="flex items-center space-x-3">
                    <a href="{{ route('home') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                    </a>
                </div>
                <button @click="sidebarOpen = false" class="md:hidden text-gray-500 hover:text-gray-600">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            @include('admin.layouts.sidebar')
            {{-- <nav class="mt-4 px-2">
                <a href="{{ route('admin.dashboard') }}"
                    class="block px-4 py-2 rounded-md text-gray-700 hover:bg-gray-100 {{ request()->routeIs('admin.dashboard') ? 'bg-gray-100' : '' }}">
                    Dashboard
                </a>
                <a href="{{ route('admin.programs.index') }}"
                    class="block px-4 py-2 rounded-md text-gray-700 hover:bg-gray-100 {{ request()->routeIs('admin.programs.*') ? 'bg-gray-100' : '' }}">
                    Programs
                </a>
                <a href="{{ route('admin.categories.index') }}" class="block px-4 py-2 rounded-md text-gray-700 hover:bg-gray-100 {{ request()->routeIs('admin.categories.*') ? 'bg-gray-100' : '' }}">
                    Categories
                </a>
                <a href="{{ route('admin.schedules.index') }}" class="block px-4 py-2 rounded-md text-gray-700 hover:bg-gray-100 {{ request()->routeIs('admin.schedules.*') ? 'bg-gray-100' : '' }}">
                    Schedules
                </a>
            </nav> --}}
        </aside>

        <!-- Main Content -->
        <div class="lg:ml-64">
            <!-- Top Navigation -->
            <header class="bg-white shadow-sm">
                <div class="flex justify-between items-center px-4 py-3">
                    <button @click="sidebarOpen = !sidebarOpen" class="text-gray-500 hover:text-gray-600">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>

                    <div class="flex items-center space-x-4">
                        <div class="relative" x-data="{ open: false }">
                            <button @click="open = !open"
                                class="flex items-center space-x-2 text-gray-700 hover:text-gray-900">
                                <img class="h-8 w-8 rounded-full"
                                    src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user() ? Auth::user()->name : '') }}"
                                    alt="Profile">
                                <span>{{ Auth::user()->name }}</span>
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>

                            <div x-show="open" @click.away="open = false"
                                class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1">
                                {{-- <a href="{{ route('admin.profile') }}"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Profile</a>
                                <a href="{{ route('admin.settings') }}"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Settings</a> --}}
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit"
                                        class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                        Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <main>
                @if (session('success'))
                    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 m-4" role="alert">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 m-4" role="alert">
                        {{ session('error') }}
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>

    @stack('scripts')
</body>

</html>
