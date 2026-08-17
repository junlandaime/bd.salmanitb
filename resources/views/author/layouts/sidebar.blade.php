<nav class="mt-4 px-3 space-y-1.5 text-sm font-medium">

    <div class="px-3 py-1">
        <p class="text-[11px] font-bold tracking-wider text-gray-400 uppercase">Ruang Penulis</p>
    </div>

    <!-- Dashboard -->
    <a href="{{ route('author.dashboard') }}"
        class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition {{ request()->routeIs('author.dashboard') ? 'bg-emerald-50 text-emerald-700 font-semibold' : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' }}">
        <svg class="w-5 h-5 {{ request()->routeIs('author.dashboard') ? 'text-emerald-600' : 'text-gray-400' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
        </svg>
        <span>Dashboard</span>
    </a>

    <!-- Artikel Saya -->
    <a href="{{ route('author.articles.index') }}"
        class="flex items-center justify-between px-3 py-2.5 rounded-xl transition {{ request()->routeIs('author.articles.*') ? 'bg-emerald-50 text-emerald-700 font-semibold' : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' }}">
        <div class="flex items-center gap-3">
            <svg class="w-5 h-5 {{ request()->routeIs('author.articles.*') ? 'text-emerald-600' : 'text-gray-400' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9.5a2.5 2.5 0 00-2.5-2.5H15" />
            </svg>
            <span>Artikel Saya</span>
        </div>
        @php
            $myArticleCount = \App\Models\Article::ownedBy(auth()->user())->count();
        @endphp
        @if($myArticleCount > 0)
            <span class="px-2 py-0.5 text-[11px] font-bold rounded-full bg-gray-100 text-gray-700 border border-gray-200">
                {{ $myArticleCount }}
            </span>
        @endif
    </a>

    <!-- Berita Saya -->
    <a href="{{ route('author.news.index') }}"
        class="flex items-center justify-between px-3 py-2.5 rounded-xl transition {{ request()->routeIs('author.news.*') ? 'bg-emerald-50 text-emerald-700 font-semibold' : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' }}">
        <div class="flex items-center gap-3">
            <svg class="w-5 h-5 {{ request()->routeIs('author.news.*') ? 'text-emerald-600' : 'text-gray-400' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9.5a2.5 2.5 0 00-2.5-2.5H15M12 10V3m0 0l3 3m-3-3L9 6" />
            </svg>
            <span>Berita Saya</span>
        </div>
        @php
            $myNewsCount = \App\Models\News::ownedBy(auth()->user())->count();
        @endphp
        @if($myNewsCount > 0)
            <span class="px-2 py-0.5 text-[11px] font-bold rounded-full bg-gray-100 text-gray-700 border border-gray-200">
                {{ $myNewsCount }}
            </span>
        @endif
    </a>

    <!-- Aksi Cepat Menulis -->
    <div class="pt-4 mt-4 border-t border-gray-100 space-y-2">
        <div class="px-3 py-1">
            <p class="text-[10px] font-bold tracking-wider text-gray-400 uppercase">Tulis Cepat</p>
        </div>
        <a href="{{ route('author.articles.create') }}"
            class="flex items-center gap-2.5 px-3 py-2 rounded-xl text-xs font-bold text-emerald-700 bg-emerald-50/80 border border-emerald-200/80 hover:bg-emerald-100/70 transition">
            <svg class="w-4 h-4 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            <span>Tulis Artikel Baru</span>
        </a>
        <a href="{{ route('author.news.create') }}"
            class="flex items-center gap-2.5 px-3 py-2 rounded-xl text-xs font-bold text-blue-700 bg-blue-50/80 border border-blue-200/80 hover:bg-blue-100/70 transition">
            <svg class="w-4 h-4 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            <span>Tulis Berita Baru</span>
        </a>
    </div>

</nav>
