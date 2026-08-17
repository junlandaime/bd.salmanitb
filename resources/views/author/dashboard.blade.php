@extends('author.layouts.app')

@section('title', 'Dashboard Penulis')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 space-y-6">

    <!-- Hero Welcome Banner -->
    <div class="relative overflow-hidden rounded-3xl bg-gradient-to-br from-emerald-800 via-teal-800 to-slate-900 text-white p-6 sm:p-8 shadow-lg shadow-emerald-950/10 border border-emerald-700/40">
        <!-- Ambient Decorative Glows -->
        <div aria-hidden="true" class="absolute -top-24 -right-24 w-72 h-72 rounded-full bg-emerald-400/20 blur-3xl pointer-events-none"></div>
        <div aria-hidden="true" class="absolute -bottom-24 -left-24 w-72 h-72 rounded-full bg-teal-300/15 blur-3xl pointer-events-none"></div>

        <div class="relative z-10 flex flex-col md:flex-row md:items-center md:justify-between gap-6">
            <div class="space-y-2 max-w-xl">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white/10 backdrop-blur-xs border border-white/15 text-emerald-200 text-xs font-semibold">
                    <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                    <span>Ruang Kerja Redaksi &amp; Penulis</span>
                </div>
                <h1 class="text-2xl sm:text-3xl font-extrabold tracking-tight text-white leading-tight">
                    Ahlan wa Sahlan, {{ Auth::user()->name }}! ✍️
                </h1>
                <p class="text-xs sm:text-sm text-emerald-100/90 leading-relaxed">
                    Sampaikan gagasan, hikmah, dan syiar dakwah melalui tulisan artikel dan liputan berita kegiatan Masjid Salman ITB.
                </p>
            </div>

            <div class="flex flex-wrap gap-3 shrink-0">
                <a href="{{ route('author.articles.create') }}"
                    class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-emerald-500 hover:bg-emerald-400 text-teal-950 font-bold text-xs shadow-md transition">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    <span>Tulis Artikel Baru</span>
                </a>
                <a href="{{ route('author.news.create') }}"
                    class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-white/15 hover:bg-white/25 text-white font-semibold text-xs border border-white/20 backdrop-blur-xs transition shadow-2xs">
                    <svg class="w-4 h-4 text-blue-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    <span>Tulis Berita Baru</span>
                </a>
            </div>
        </div>
    </div>

    <!-- Quick Stats Grid (4 Cards) -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        <!-- Stat 1: Total Artikel -->
        <div class="bg-white rounded-2xl p-5 border border-gray-200/80 shadow-xs flex items-center justify-between">
            <div class="space-y-1">
                <p class="text-xs font-bold uppercase tracking-wider text-gray-500">Artikel Saya</p>
                <div class="flex items-baseline gap-2">
                    <span class="text-2xl font-extrabold text-gray-900">{{ $articleCount }}</span>
                    <span class="text-xs text-gray-500">total</span>
                </div>
                <div class="flex items-center gap-2 text-[11px] text-gray-500">
                    <span class="text-emerald-700 font-semibold">{{ $publishedArticleCount }} Terbit</span>
                    <span>•</span>
                    <span class="text-amber-700 font-semibold">{{ $draftArticleCount }} Draft</span>
                </div>
            </div>
            <div class="w-12 h-12 rounded-2xl bg-emerald-50 text-emerald-700 flex items-center justify-center text-xl shadow-2xs">
                <i class="fas fa-newspaper"></i>
            </div>
        </div>

        <!-- Stat 2: Total Berita -->
        <div class="bg-white rounded-2xl p-5 border border-gray-200/80 shadow-xs flex items-center justify-between">
            <div class="space-y-1">
                <p class="text-xs font-bold uppercase tracking-wider text-gray-500">Berita &amp; Liputan</p>
                <div class="flex items-baseline gap-2">
                    <span class="text-2xl font-extrabold text-gray-900">{{ $newsCount }}</span>
                    <span class="text-xs text-gray-500">total</span>
                </div>
                <div class="flex items-center gap-2 text-[11px] text-gray-500">
                    <span class="text-emerald-700 font-semibold">{{ $publishedNewsCount }} Terbit</span>
                    <span>•</span>
                    <span class="text-amber-700 font-semibold">{{ $draftNewsCount }} Draft</span>
                </div>
            </div>
            <div class="w-12 h-12 rounded-2xl bg-blue-50 text-blue-700 flex items-center justify-center text-xl shadow-2xs">
                <i class="fas fa-bullhorn"></i>
            </div>
        </div>

        <!-- Stat 3: Total Terbit Publik -->
        <div class="bg-white rounded-2xl p-5 border border-gray-200/80 shadow-xs flex items-center justify-between">
            <div class="space-y-1">
                <p class="text-xs font-bold uppercase tracking-wider text-gray-500">Total Terbit</p>
                <div class="flex items-baseline gap-2">
                    <span class="text-2xl font-extrabold text-emerald-700">{{ $publishedArticleCount + $publishedNewsCount }}</span>
                    <span class="text-xs text-gray-500">tulisan aktif</span>
                </div>
                <p class="text-[11px] text-gray-400">Dapat dibaca oleh publik</p>
            </div>
            <div class="w-12 h-12 rounded-2xl bg-teal-50 text-teal-700 flex items-center justify-center text-xl shadow-2xs">
                <i class="fas fa-globe"></i>
            </div>
        </div>

        <!-- Stat 4: Featured Items -->
        <div class="bg-white rounded-2xl p-5 border border-gray-200/80 shadow-xs flex items-center justify-between">
            <div class="space-y-1">
                <p class="text-xs font-bold uppercase tracking-wider text-gray-500">Unggulan (Featured)</p>
                <div class="flex items-baseline gap-2">
                    <span class="text-2xl font-extrabold text-amber-600">{{ $featuredArticleCount + $featuredNewsCount }}</span>
                    <span class="text-xs text-gray-500">postingan</span>
                </div>
                <p class="text-[11px] text-amber-700 font-medium">Tampil di beranda utama</p>
            </div>
            <div class="w-12 h-12 rounded-2xl bg-amber-50 text-amber-600 flex items-center justify-center text-xl shadow-2xs">
                <i class="fas fa-star"></i>
            </div>
        </div>
    </div>

    <!-- Recent Content Grid (2 Columns) -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

        <!-- Column 1: Recent Articles -->
        <div class="bg-white rounded-3xl border border-gray-200/80 shadow-sm p-6 space-y-4">
            <div class="flex items-center justify-between pb-3 border-b border-gray-100">
                <div class="flex items-center gap-2">
                    <span class="w-2.5 h-2.5 rounded-full bg-emerald-500"></span>
                    <h2 class="text-sm font-bold text-gray-900">Artikel Terbaru Saya</h2>
                </div>
                <a href="{{ route('author.articles.index') }}" class="text-xs font-bold text-emerald-700 hover:text-emerald-900 transition flex items-center gap-1">
                    <span>Lihat Semua</span>
                    <span>&rarr;</span>
                </a>
            </div>

            @if($recentArticles->isEmpty())
                <div class="text-center py-8 bg-gray-50/60 rounded-2xl border border-dashed border-gray-200">
                    <i class="fas fa-file-signature text-3xl text-gray-300 mb-2"></i>
                    <p class="text-xs text-gray-500">Belum ada artikel yang Anda buat.</p>
                    <a href="{{ route('author.articles.create') }}" class="inline-block mt-3 px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs rounded-xl shadow-2xs transition">
                        Mulai Tulis Artikel
                    </a>
                </div>
            @else
                <div class="space-y-3">
                    @foreach($recentArticles as $article)
                        <div class="flex items-center justify-between p-3 rounded-2xl border border-gray-100 hover:border-emerald-200 hover:bg-emerald-50/20 transition group">
                            <div class="flex items-center gap-3 min-w-0">
                                @if($article->featured_image)
                                    <img src="{{ Storage::url($article->featured_image) }}" alt="{{ $article->title }}" class="w-12 h-12 rounded-xl object-cover border border-gray-200 shrink-0">
                                @else
                                    <div class="w-12 h-12 rounded-xl bg-emerald-50 text-emerald-700 flex items-center justify-center font-bold text-sm shrink-0 border border-emerald-100">
                                        📄
                                    </div>
                                @endif
                                <div class="min-w-0">
                                    <div class="flex items-center gap-2">
                                        <span class="px-2 py-0.5 rounded-full text-[10px] font-bold" style="background-color: {{ $article->category->color ?? '#10b981' }}20; color: {{ $article->category->color ?? '#10b981' }}">
                                            {{ $article->category->name ?? 'Umum' }}
                                        </span>
                                        <span class="px-2 py-0.5 rounded-full text-[10px] font-bold {{ $article->status === 'published' ? 'bg-emerald-50 text-emerald-700 border border-emerald-200' : 'bg-amber-50 text-amber-700 border border-amber-200' }}">
                                            {{ $article->status === 'published' ? 'Terbit' : 'Draft' }}
                                        </span>
                                    </div>
                                    <h4 class="text-xs font-bold text-gray-900 truncate mt-1 group-hover:text-emerald-700 transition">
                                        {{ $article->title }}
                                    </h4>
                                    <p class="text-[10px] text-gray-400 mt-0.5">
                                        {{ $article->created_at->translatedFormat('d M Y, H:i') }} WIB
                                    </p>
                                </div>
                            </div>

                            <div class="flex items-center gap-1.5 shrink-0 pl-3">
                                @if($article->status === 'published')
                                    <a href="{{ route('articles.show', $article->slug) }}" target="_blank" class="p-1.5 text-gray-400 hover:text-emerald-600 rounded-lg hover:bg-gray-100 transition" title="Lihat di Web">
                                        <i class="fas fa-external-link-alt text-xs"></i>
                                    </a>
                                @endif
                                <a href="{{ route('author.articles.edit', $article) }}" class="p-1.5 text-gray-400 hover:text-gray-700 rounded-lg hover:bg-gray-100 transition" title="Edit Artikel">
                                    <i class="fas fa-pen text-xs"></i>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        <!-- Column 2: Recent News -->
        <div class="bg-white rounded-3xl border border-gray-200/80 shadow-sm p-6 space-y-4">
            <div class="flex items-center justify-between pb-3 border-b border-gray-100">
                <div class="flex items-center gap-2">
                    <span class="w-2.5 h-2.5 rounded-full bg-blue-500"></span>
                    <h2 class="text-sm font-bold text-gray-900">Berita &amp; Liputan Terbaru Saya</h2>
                </div>
                <a href="{{ route('author.news.index') }}" class="text-xs font-bold text-blue-700 hover:text-blue-900 transition flex items-center gap-1">
                    <span>Lihat Semua</span>
                    <span>&rarr;</span>
                </a>
            </div>

            @if($recentNews->isEmpty())
                <div class="text-center py-8 bg-gray-50/60 rounded-2xl border border-dashed border-gray-200">
                    <i class="fas fa-bullhorn text-3xl text-gray-300 mb-2"></i>
                    <p class="text-xs text-gray-500">Belum ada rilis berita yang Anda buat.</p>
                    <a href="{{ route('author.news.create') }}" class="inline-block mt-3 px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-bold text-xs rounded-xl shadow-2xs transition">
                        Mulai Tulis Berita
                    </a>
                </div>
            @else
                <div class="space-y-3">
                    @foreach($recentNews as $newsItem)
                        <div class="flex items-center justify-between p-3 rounded-2xl border border-gray-100 hover:border-blue-200 hover:bg-blue-50/20 transition group">
                            <div class="flex items-center gap-3 min-w-0">
                                @if($newsItem->featured_image)
                                    <img src="{{ Storage::url($newsItem->featured_image) }}" alt="{{ $newsItem->title }}" class="w-12 h-12 rounded-xl object-cover border border-gray-200 shrink-0">
                                @else
                                    <div class="w-12 h-12 rounded-xl bg-blue-50 text-blue-700 flex items-center justify-center font-bold text-sm shrink-0 border border-blue-100">
                                        📢
                                    </div>
                                @endif
                                <div class="min-w-0">
                                    <div class="flex items-center gap-2">
                                        <span class="px-2 py-0.5 rounded-full text-[10px] font-bold" style="background-color: {{ $newsItem->category->color ?? '#3b82f6' }}20; color: {{ $newsItem->category->color ?? '#3b82f6' }}">
                                            {{ $newsItem->category->name ?? 'Kegiatan' }}
                                        </span>
                                        <span class="px-2 py-0.5 rounded-full text-[10px] font-bold {{ $newsItem->status === 'published' ? 'bg-emerald-50 text-emerald-700 border border-emerald-200' : 'bg-amber-50 text-amber-700 border border-amber-200' }}">
                                            {{ $newsItem->status === 'published' ? 'Terbit' : 'Draft' }}
                                        </span>
                                    </div>
                                    <h4 class="text-xs font-bold text-gray-900 truncate mt-1 group-hover:text-blue-700 transition">
                                        {{ $newsItem->title }}
                                    </h4>
                                    <p class="text-[10px] text-gray-400 mt-0.5">
                                        {{ $newsItem->created_at->translatedFormat('d M Y, H:i') }} WIB
                                    </p>
                                </div>
                            </div>

                            <div class="flex items-center gap-1.5 shrink-0 pl-3">
                                @if($newsItem->status === 'published')
                                    <a href="{{ route('news.show', $newsItem->slug) }}" target="_blank" class="p-1.5 text-gray-400 hover:text-blue-600 rounded-lg hover:bg-gray-100 transition" title="Lihat di Web">
                                        <i class="fas fa-external-link-alt text-xs"></i>
                                    </a>
                                @endif
                                <a href="{{ route('author.news.edit', $newsItem) }}" class="p-1.5 text-gray-400 hover:text-gray-700 rounded-lg hover:bg-gray-100 transition" title="Edit Berita">
                                    <i class="fas fa-pen text-xs"></i>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

    </div>

    <!-- Panduan Redaksi & Tips Penulisan Card -->
    <div class="bg-gradient-to-br from-emerald-50/50 to-teal-50/30 rounded-3xl border border-emerald-200/70 p-6 shadow-2xs">
        <div class="flex items-start gap-4">
            <div class="w-10 h-10 rounded-2xl bg-emerald-600 text-white flex items-center justify-center font-bold text-lg shrink-0 shadow-2xs">
                💡
            </div>
            <div class="space-y-2">
                <h3 class="text-sm font-bold text-emerald-950">Tips Redaksi &amp; Publikasi Konten Dakwah Salman</h3>
                <p class="text-xs text-emerald-900/80 leading-relaxed">
                    Pastikan artikel dan berita Anda memiliki ringkasan (*excerpt*) yang memikat, gambar sampul beresolusi tajam (rasio 16:9), serta pemilihan kategori dan tag yang tepat agar mudah ditemukan jamaah melalui mesin pencari dan website.
                </p>
            </div>
        </div>
    </div>

</div>
@endsection
