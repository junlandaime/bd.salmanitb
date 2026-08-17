@extends('layouts.app')
@section('title', 'Berita Bidang Dakwah Masjid Salman ITB')

@section('content')

{{-- ========================= HERO SECTION ========================= --}}
<section class="relative isolate overflow-hidden bg-gradient-to-br from-slate-900 via-emerald-950 to-teal-950 text-white py-12 md:py-20">
    <div aria-hidden="true" class="absolute -top-24 -left-24 h-80 w-80 rounded-full bg-emerald-500/20 blur-3xl pointer-events-none"></div>
    <div aria-hidden="true" class="absolute -bottom-24 -right-24 h-80 w-80 rounded-full bg-teal-400/15 blur-3xl pointer-events-none"></div>
    <div class="absolute inset-0 opacity-5 bg-[radial-gradient(#fff_1px,transparent_1px)] [background-size:20px_20px] pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
        <div class="max-w-3xl mx-auto space-y-4" data-aos="fade-down">
            <span class="inline-flex items-center gap-1.5 px-3.5 py-1 rounded-full bg-emerald-500/15 border border-emerald-400/30 text-emerald-300 text-xs font-semibold">
                <span>📰</span>
                <span>Kabar Terkini</span>
            </span>
            <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold tracking-tight text-white leading-tight">
                Berita &amp; Informasi Salman ITB
            </h1>
            <p class="text-slate-300 text-xs sm:text-sm leading-relaxed">
                Liputan kegiatan, pengumuman resmi, dan kabar aktual seputar aktivitas dakwah serta komunitas jamaah Masjid Salman ITB.
            </p>
        </div>
    </div>
</section>

{{-- ========================= BREADCRUMB & SEARCH ========================= --}}
<div class="bg-white border-b border-gray-200/80">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <nav class="flex text-xs font-medium text-gray-500" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-2">
                    <li><a href="{{ route('home') }}" class="hover:text-emerald-700 transition">Beranda</a></li>
                    <li><span>/</span></li>
                    <li class="text-emerald-700 font-bold">Berita</li>
                </ol>
            </nav>

            <form action="{{ route('news.index') }}" method="GET" class="relative max-w-xs w-full">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari berita..."
                    class="w-full pl-9 pr-4 py-2 rounded-xl bg-gray-50 border border-gray-200 text-xs text-gray-800 placeholder-gray-400 focus:bg-white focus:outline-none focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 transition">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- ========================= FEATURED NEWS SPOTLIGHT ========================= --}}
@if (isset($featuredNews) && $featuredNews)
<section class="py-10 bg-gray-50/70 border-b border-gray-200/80">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="rounded-3xl bg-white border border-gray-200/80 shadow-xs hover:shadow-xl transition-all duration-300 overflow-hidden" data-aos="zoom-in">
            <a href="{{ route('news.show', $featuredNews->slug) }}" class="block">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-0 items-center">
                    <div class="lg:col-span-6 relative aspect-[16/10] lg:aspect-auto lg:h-full overflow-hidden">
                        <img src="{{ $featuredNews->featured_image ? Storage::url($featuredNews->featured_image) : 'https://picsum.photos/800/500' }}"
                            alt="{{ $featuredNews->title }}"
                            class="w-full h-full object-cover hover:scale-105 transition-transform duration-500">
                        <div class="absolute top-4 left-4">
                            <span class="px-3 py-1 rounded-full bg-emerald-600 text-white font-bold text-xs shadow-sm">
                                Berita Utama
                            </span>
                        </div>
                    </div>
                    <div class="lg:col-span-6 p-6 sm:p-10 space-y-4">
                        <div class="flex items-center gap-3 text-xs text-gray-500">
                            @if($featuredNews->category)
                                <span class="px-2.5 py-0.5 rounded-full bg-emerald-50 text-emerald-700 font-bold text-[11px]">
                                    {{ $featuredNews->category->name }}
                                </span>
                            @endif
                            <span>•</span>
                            <span>{{ $featuredNews->published_at ? $featuredNews->published_at->format('d M Y') : '' }}</span>
                        </div>
                        <h2 class="text-xl sm:text-2xl font-bold text-gray-900 leading-snug hover:text-emerald-700 transition">
                            {{ $featuredNews->title }}
                        </h2>
                        <p class="text-xs sm:text-sm text-gray-600 leading-relaxed line-clamp-3">
                            {{ $featuredNews->excerpt ?? Str::limit(strip_tags($featuredNews->content), 150) }}
                        </p>
                        <div class="pt-2 flex items-center gap-2 text-xs font-bold text-emerald-700">
                            <span>Baca Berita Lengkap</span>
                            <span>&rarr;</span>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>
</section>
@endif

{{-- ========================= NEWS LIST & CATEGORIES ========================= --}}
<section class="py-16 bg-gray-50/70">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Category Filters -->
        @if(isset($categories) && $categories->count() > 0)
            <div class="flex flex-wrap gap-2 mb-10 pb-4 border-b border-gray-200/80">
                <a href="{{ route('news.index') }}"
                    class="px-3.5 py-1.5 rounded-xl text-xs font-semibold transition {{ !request('category') ? 'bg-emerald-600 text-white font-bold' : 'bg-white text-gray-700 border border-gray-200 hover:border-emerald-300' }}">
                    Semua Kategori
                </a>
                @foreach($categories as $category)
                    <a href="{{ route('news.index', ['category' => $category->slug]) }}"
                        class="px-3.5 py-1.5 rounded-xl text-xs font-semibold transition {{ request('category') == $category->slug ? 'bg-emerald-600 text-white font-bold' : 'bg-white text-gray-700 border border-gray-200 hover:border-emerald-300' }}">
                        {{ $category->name }} ({{ $category->news_count ?? $category->news->count() }})
                    </a>
                @endforeach
            </div>
        @endif

        <!-- News Grid -->
        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
            @forelse ($news as $item)
                <article class="group rounded-2xl bg-white border border-gray-200/80 shadow-xs hover:shadow-xl hover:border-emerald-300 transition-all duration-300 overflow-hidden flex flex-col justify-between"
                    data-aos="fade-up" data-aos-delay="{{ $loop->index * 60 }}">
                    
                    <div>
                        <div class="relative aspect-[16/10] overflow-hidden">
                            <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                                src="{{ $item->featured_image ? Storage::url($item->featured_image) : 'https://picsum.photos/600/400' }}"
                                alt="{{ $item->title }}">
                            @if($item->category)
                                <div class="absolute top-3 left-3">
                                    <span class="px-2.5 py-1 rounded-full bg-slate-900/80 backdrop-blur text-white text-[11px] font-bold">
                                        {{ $item->category->name }}
                                    </span>
                                </div>
                            @endif
                        </div>

                        <div class="p-6 space-y-2.5">
                            <p class="text-[11px] font-semibold text-gray-400">
                                {{ $item->published_at ? $item->published_at->format('d M Y') : '' }}
                            </p>
                            <h3 class="text-base font-bold text-gray-900 group-hover:text-emerald-700 transition leading-snug line-clamp-2">
                                <a href="{{ route('news.show', $item->slug) }}">
                                    {{ $item->title }}
                                </a>
                            </h3>
                            <p class="text-xs text-gray-500 leading-relaxed line-clamp-3">
                                {{ $item->excerpt ?? Str::limit(strip_tags($item->content), 120) }}
                            </p>
                        </div>
                    </div>

                    <div class="p-6 pt-0">
                        <a href="{{ route('news.show', $item->slug) }}"
                            class="inline-flex items-center gap-1.5 text-xs font-bold text-emerald-600 group-hover:text-emerald-700 transition">
                            <span>Baca Selengkapnya</span>
                            <span>&rarr;</span>
                        </a>
                    </div>
                </article>
            @empty
                <div class="col-span-full text-center py-12 bg-white rounded-2xl border border-dashed border-gray-200">
                    <div class="w-12 h-12 rounded-2xl bg-gray-100 text-gray-400 flex items-center justify-center text-xl mx-auto mb-2">
                        📰
                    </div>
                    <p class="text-sm font-bold text-gray-800">Tidak ada berita yang ditemukan.</p>
                </div>
            @endforelse
        </div>

        <div class="mt-12">
            {{ $news->links() }}
        </div>

    </div>
</section>

@endsection
