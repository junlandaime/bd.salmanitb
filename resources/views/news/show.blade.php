@extends('layouts.app')
@section('title', $news->title . ' - Berita Bidang Dakwah Masjid Salman ITB')
@section('meta_description', Str::limit($news->excerpt ?? strip_tags($news->content), 160))
@section('og_title', $news->title . ' - Berita Bidang Dakwah Masjid Salman ITB')
@section('og_description', Str::limit($news->excerpt ?? strip_tags($news->content), 200))
@section('og_image', $news->featured_image ? Storage::url($news->featured_image) : '')
 
@section('content')

{{-- ========================= NEWS HEADER ========================= --}}
<section class="relative isolate overflow-hidden bg-gradient-to-br from-slate-900 via-emerald-950 to-teal-950 text-white py-12 md:py-20">
    <div aria-hidden="true" class="absolute -top-24 -left-24 h-80 w-80 rounded-full bg-emerald-500/20 blur-3xl pointer-events-none"></div>
    <div aria-hidden="true" class="absolute -bottom-24 -right-24 h-80 w-80 rounded-full bg-teal-400/15 blur-3xl pointer-events-none"></div>
    <div class="absolute inset-0 opacity-5 bg-[radial-gradient(#fff_1px,transparent_1px)] [background-size:20px_20px] pointer-events-none"></div>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 space-y-4 text-center">
        @if($news->category)
            <span class="inline-flex items-center gap-1.5 px-3.5 py-1 rounded-full bg-emerald-500/15 border border-emerald-400/30 text-emerald-300 text-xs font-semibold">
                {{ $news->category->name }}
            </span>
        @endif

        <h1 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold tracking-tight text-white leading-tight">
            {{ $news->title }}
        </h1>

        <div class="flex items-center justify-center gap-4 text-xs text-slate-300 pt-2">
            <div class="flex items-center gap-2">
                <div class="w-6 h-6 rounded-full bg-emerald-600 flex items-center justify-center text-[10px] font-bold text-white">
                    {{ substr($news->author->name ?? 'A', 0, 1) }}
                </div>
                <span>{{ $news->author->name ?? 'Humas Salman ITB' }}</span>
            </div>
            <span>•</span>
            <span>{{ $news->published_at ? $news->published_at->format('d F Y') : '' }}</span>
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
                <li><a href="{{ route('news.index') }}" class="hover:text-emerald-700 transition">Berita</a></li>
                <li><span>/</span></li>
                <li class="text-emerald-700 font-bold truncate max-w-xs">{{ $news->title }}</li>
            </ol>
        </nav>
    </div>
</div>

{{-- ========================= NEWS CONTENT ========================= --}}
<article class="py-12 bg-white">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        
        @if($news->featured_image)
            <div class="rounded-3xl overflow-hidden shadow-md mb-10 aspect-[16/9]">
                <img src="{{ Storage::url($news->featured_image) }}" alt="{{ $news->title }}"
                    class="w-full h-full object-cover">
            </div>
        @endif

        <!-- News Body -->
        <div class="prose prose-emerald max-w-none text-gray-800 text-sm sm:text-base leading-relaxed space-y-4">
            {!! $news->content !!}
        </div>

        <!-- Tags -->
        @if($news->tags && $news->tags->count() > 0)
            <div class="mt-12 pt-6 border-t border-gray-100 flex flex-wrap items-center gap-2">
                <span class="text-xs font-bold text-gray-500">Tag:</span>
                @foreach($news->tags as $tag)
                    <span class="px-3 py-1 rounded-full bg-gray-100 text-gray-700 text-xs font-medium">
                        #{{ $tag->name }}
                    </span>
                @endforeach
            </div>
        @endif

        <!-- Share & Back -->
        <div class="mt-8 pt-6 border-t border-gray-100 flex flex-col sm:flex-row justify-between items-center gap-4">
            <a href="{{ route('news.index') }}"
                class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl border border-gray-200 bg-white hover:bg-gray-50 text-xs font-bold text-gray-700 shadow-2xs transition">
                <span>&larr;</span>
                <span>Kembali ke Daftar Berita</span>
            </a>

            <div class="flex items-center gap-2">
                <span class="text-xs text-gray-500 font-medium">Bagikan:</span>
                <a href="https://wa.me/?text={{ urlencode($news->title . ' ' . url()->current()) }}" target="_blank"
                    class="w-8 h-8 rounded-xl bg-emerald-50 text-emerald-700 hover:bg-emerald-600 hover:text-white flex items-center justify-center text-xs font-bold transition"
                    title="Bagikan ke WhatsApp">
                    WA
                </a>
            </div>
        </div>

        <!-- Related News -->
        @if(isset($relatedNews) && $relatedNews->count() > 0)
            <div class="mt-16 pt-10 border-t border-gray-200">
                <h3 class="text-lg font-bold text-gray-900 mb-6">Berita Terkait</h3>
                <div class="grid gap-6 sm:grid-cols-2">
                    @foreach($relatedNews as $related)
                        <article class="group rounded-2xl bg-gray-50 border border-gray-200 p-4 hover:bg-white hover:shadow-md transition">
                            <a href="{{ route('news.show', $related->slug) }}" class="flex gap-4 items-center">
                                <div class="w-20 h-20 rounded-xl overflow-hidden flex-shrink-0">
                                    <img src="{{ $related->featured_image ? Storage::url($related->featured_image) : 'https://picsum.photos/200' }}"
                                        alt="{{ $related->title }}" class="w-full h-full object-cover">
                                </div>
                                <div class="space-y-1">
                                    <p class="text-[10px] text-gray-400 font-semibold">{{ $related->published_at ? $related->published_at->format('d M Y') : '' }}</p>
                                    <h4 class="text-xs font-bold text-gray-900 group-hover:text-emerald-700 transition line-clamp-2">{{ $related->title }}</h4>
                                </div>
                            </a>
                        </article>
                    @endforeach
                </div>
            </div>
        @endif

    </div>
</article>

@endsection
