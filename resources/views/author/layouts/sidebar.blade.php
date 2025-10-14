<nav class="mt-4 px-2 space-y-1">
    <a href="{{ route('author.dashboard') }}"
        class="flex items-center px-4 py-2 rounded-md text-gray-700 hover:bg-gray-100 {{ request()->routeIs('author.dashboard') ? 'bg-gray-100' : '' }}">
        <svg class="w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
            stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z" />
        </svg>
        Dashboard
    </a>

    <a href="{{ route('author.articles.index') }}"
        class="flex items-center px-4 py-2 rounded-md text-gray-700 hover:bg-gray-100 {{ request()->routeIs('author.articles.*') ? 'bg-gray-100' : '' }}">
        <svg class="w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
            stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9.5a2.5 2.5 0 00-2.5-2.5H15" />
        </svg>
        Artikel Saya
    </a>

    <a href="{{ route('author.news.index') }}"
        class="flex items-center px-4 py-2 rounded-md text-gray-700 hover:bg-gray-100 {{ request()->routeIs('author.news.*') ? 'bg-gray-100' : '' }}">
        <svg class="w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
            stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9.5a2.5 2.5 0 00-2.5-2.5H15M12 10V3m0 0l3 3m-3-3L9 6" />
        </svg>
        Berita Saya
    </a>
</nav>
