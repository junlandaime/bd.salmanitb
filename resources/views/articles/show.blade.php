@extends('layouts.app')
@section('title', $article->title . ' - Artikel Bidang Dakwah Masjid Salman ITB')
@section('meta_description', Str::limit($article->excerpt ?? strip_tags($article->content), 160))
@section('og_title', $article->title . ' - Artikel Bidang Dakwah Masjid Salman ITB')
@section('og_description', Str::limit($article->excerpt ?? strip_tags($article->content), 200))
@section('og_image', $article->featured_image ? Storage::url($article->featured_image) : '')
 
@section('content')

{{-- ========================= ARTICLE HEADER ========================= --}}
<section class="relative isolate overflow-hidden bg-gradient-to-br from-slate-900 via-emerald-950 to-teal-950 text-white py-12 md:py-20">
    <div aria-hidden="true" class="absolute -top-24 -left-24 h-80 w-80 rounded-full bg-emerald-500/20 blur-3xl pointer-events-none"></div>
    <div aria-hidden="true" class="absolute -bottom-24 -right-24 h-80 w-80 rounded-full bg-teal-400/15 blur-3xl pointer-events-none"></div>
    <div class="absolute inset-0 opacity-5 bg-[radial-gradient(#fff_1px,transparent_1px)] [background-size:20px_20px] pointer-events-none"></div>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 space-y-4 text-center">
        @if($article->category)
            <span class="inline-flex items-center gap-1.5 px-3.5 py-1 rounded-full bg-emerald-500/15 border border-emerald-400/30 text-emerald-300 text-xs font-semibold">
                {{ $article->category->name }}
            </span>
        @endif

        <h1 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold tracking-tight text-white leading-tight">
            {{ $article->title }}
        </h1>

        <div class="flex items-center justify-center gap-4 text-xs text-slate-300 pt-2">
            <div class="flex items-center gap-2">
                <div class="w-6 h-6 rounded-full bg-emerald-600 flex items-center justify-center text-[10px] font-bold text-white">
                    {{ substr($article->author->name ?? 'A', 0, 1) }}
                </div>
                <span>{{ $article->author->name ?? 'Tim Bidang Dakwah' }}</span>
            </div>
            <span>•</span>
            <span>{{ $article->published_at ? $article->published_at->format('d F Y') : '' }}</span>
        </div>
    </div>
</section>

{{-- ========================= BREADCRUMB ========================= --}}
<div class="bg-white border-b border-gray-200/80">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-3">
        <nav class="flex text-xs font-medium text-gray-500" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-2">
                <li><a href="{{ route('home') }}" class="hover:text-emerald-700 transition">Beranda</a></li>
                <li><span>/</span></li>
                <li><a href="{{ route('articles.index') }}" class="hover:text-emerald-700 transition">Artikel</a></li>
                <li><span>/</span></li>
                <li class="text-emerald-700 font-bold truncate max-w-xs">{{ $article->title }}</li>
            </ol>
        </nav>
    </div>
</div>

{{-- ========================= ARTICLE CONTENT ========================= --}}
<article class="py-12 bg-white">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        
        @if($article->featured_image)
            <div class="rounded-3xl overflow-hidden shadow-md mb-10 aspect-[16/9]">
                <img src="{{ Storage::url($article->featured_image) }}" alt="{{ $article->title }}"
                    class="w-full h-full object-cover">
            </div>
        @endif

        <!-- Article Body -->
        <div class="prose prose-emerald max-w-none text-gray-800 text-sm sm:text-base leading-relaxed space-y-4">
            {!! $article->content !!}
        </div>

        <!-- Tags -->
        @if($article->tags && $article->tags->count() > 0)
            <div class="mt-12 pt-6 border-t border-gray-100 flex flex-wrap items-center gap-2">
                <span class="text-xs font-bold text-gray-500">Tag:</span>
                @foreach($article->tags as $tag)
                    <span class="px-3 py-1 rounded-full bg-gray-100 text-gray-700 text-xs font-medium">
                        #{{ $tag->name }}
                    </span>
                @endforeach
            </div>
        @endif

        <!-- Share & Back -->
        <div class="mt-8 pt-6 border-t border-gray-100 flex flex-col sm:flex-row justify-between items-center gap-4">
            <a href="{{ route('articles.index') }}"
                class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl border border-gray-200 bg-white hover:bg-gray-50 text-xs font-bold text-gray-700 shadow-2xs transition">
                <span>&larr;</span>
                <span>Kembali ke Daftar Artikel</span>
            </a>

            <div class="flex items-center gap-2">
                <span class="text-xs text-gray-500 font-medium">Bagikan:</span>
                <a href="https://wa.me/?text={{ urlencode($article->title . ' ' . url()->current()) }}" target="_blank"
                    class="w-8 h-8 rounded-xl bg-emerald-50 text-emerald-700 hover:bg-emerald-600 hover:text-white flex items-center justify-center text-xs font-bold transition"
                    title="Bagikan ke WhatsApp">
                    WA
                </a>
            </div>
        </div>

    </div>
</article>

@endsection
