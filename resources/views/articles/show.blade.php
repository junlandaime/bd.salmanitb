@extends('layouts.app')
@section('title', $article->title . ' - Artikel Bidang Dakwah Masjid Salman ITB')
@section('meta_description', Str::limit($article->excerpt, 160))
@section('og_title', $article->title . ' - Artikel Bidang Dakwah Masjid Salman ITB')
@section('og_description', Str::limit($article->excerpt, 200))
@section('og_image', 'https://bidangdakwah.salmanitb.com/storage/' . $article->featured_image)

<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-WE2HFGE5VL"></script>
<script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
        dataLayer.push(arguments);
    }
    gtag('js', new Date());
    gtag('config', 'G-WE2HFGE5VL');
</script>

@section('content')
    <style>
        .soft-container {
            max-width: 1200px;
            margin: 0 auto;
            padding-left: 1rem;
            padding-right: 1rem
        }

        . {
            position: relative
        }

        .:before {
            content: "";
            position: absolute;
            inset: -1px;
            border-radius: 1rem;
            padding: 1px;
            background: linear-gradient(135deg, rgba(16, 185, 129, .6), rgba(59, 130, 246, .35));
            -webkit-mask: linear-gradient(#000 0 0) content-box, linear-gradient(#000 0 0);
            -webkit-mask-composite: xor;
            mask-composite: exclude
        }

        .card:hover .card-image {
            transform: scale(1.05)
        }

        .card .card-image {
            transition: transform .6s cubic-bezier(.2, .8, .2, 1)
        }

        .section-badge {
            letter-spacing: .06em
        }

        .glass {
            background: rgba(255, 255, 255, .65);
            backdrop-filter: saturate(1.4) blur(8px)
        }

        .dot-pattern {
            background-image: radial-gradient(rgba(0, 0, 0, .06) 1px, transparent 1px);
            background-size: 16px 16px
        }

        .article-content {
            font-size: 1.125rem;
            line-height: 1.75;
            color: #374151;
        }

        .article-content h2 {
            font-size: 1.875rem;
            font-weight: 700;
            margin-top: 2.5rem;
            margin-bottom: 1.25rem;
            color: #111827;
        }

        .article-content h3 {
            font-size: 1.5rem;
            font-weight: 700;
            margin-top: 2rem;
            margin-bottom: 1rem;
            color: #111827;
        }

        .article-content p {
            margin-bottom: 1.5rem;
        }

        .article-content ul,
        .article-content ol {
            margin-bottom: 1.5rem;
            padding-left: 1.5rem;
        }

        .article-content li {
            margin-bottom: 0.5rem;
        }

        .article-content blockquote {
            border-left: 4px solid #10b981;
            padding-left: 1.5rem;
            margin: 2rem 0;
            font-style: italic;
            color: #6b7280;
        }

        .article-content a {
            color: #10b981;
            text-decoration: underline;
        }

        .article-content img {
            border-radius: 1rem;
            margin: 2rem 0;
        }
    </style>

    {{-- ========================= HERO ARTICLE ========================= --}}
    <section class="relative isolate overflow-hidden bg-gradient-to-br from-blue-700 via-blue-600 to-blue-700 text-white">
        <div aria-hidden="true" class="absolute -top-24 -left-24 h-64 w-64 rounded-full bg-blue-500/30 blur-3xl"></div>
        <div aria-hidden="true" class="absolute -bottom-24 -right-24 h-64 w-64 rounded-full bg-blue-400/20 blur-3xl"></div>

        <div class="soft-container py-12 md:py-16">
            <div class="max-w-4xl mx-auto">
                <div class="mb-6" data-aos="fade-down">
                    <a href="{{ route('articles.index') }}"
                        class="inline-flex items-center gap-2 text-white/90 hover:text-white transition font-medium">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5">
                            <path d="M10.5 19.5 3 12l7.5-7.5M3 12h18" />
                        </svg>
                        Kembali ke Artikel
                    </a>
                </div>

                <div class="flex flex-wrap gap-2 mb-6" data-aos="fade-up">
                    <span class="px-3 py-1 text-sm font-semibold rounded-full bg-white/20 backdrop-blur-sm text-white"
                        style="border: 1px solid rgba(255,255,255,0.3)">
                        {{ $article->category->name }}
                    </span>
                    @foreach ($article->tags as $tag)
                        <span class="px-3 py-1 text-sm font-medium rounded-full bg-white/10 backdrop-blur-sm text-white">
                            {{ $tag->name }}
                        </span>
                    @endforeach
                </div>

                <h1 class="text-4xl md:text-5xl font-extrabold leading-tight mb-6" data-aos="fade-up" data-aos-delay="100">
                    {{ $article->title }}
                </h1>

                <div class="flex flex-wrap items-center gap-4 text-white/90" data-aos="fade-up" data-aos-delay="200">
                    <div class="inline-flex items-center gap-2">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                clip-rule="evenodd" />
                        </svg>
                        <span class="font-medium">{{ $article->author->name }}</span>
                    </div>
                    <span>&bull;</span>
                    <div class="inline-flex items-center gap-2">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                clip-rule="evenodd" />
                        </svg>
                        <span>{{ $article->published_at->format('d M Y') }}</span>
                    </div>
                    <span>&bull;</span>
                    <div class="inline-flex items-center gap-2">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z"
                                clip-rule="evenodd" />
                        </svg>
                        <span>{{ $article->reading_time }}</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ========================= FEATURED IMAGE ========================= --}}
    @if ($article->featured_image)
        <section class="py-8 bg-gray-50">
            <div class="soft-container">
                <div class="max-w-5xl mx-auto" data-aos="zoom-in">
                    <div class=" rounded-2xl overflow-hidden shadow-2xl">
                        <img src="{{ Storage::url($article->featured_image) }}" alt="{{ $article->title }}"
                            class="w-full h-auto object-cover">
                    </div>
                </div>
            </div>
        </section>
    @endif

    {{-- ========================= ARTICLE CONTENT ========================= --}}
    <article class="py-16 bg-white">
        <div class="soft-container">
            <div class="max-w-4xl mx-auto">
                <div class=" rounded-2xl bg-white p-8 md:p-12 shadow-sm" data-aos="fade-up">
                    <div class="article-content">
                        {!! $article->sanitized_content !!}
                    </div>

                    {{-- Share Section --}}
                    <div class="mt-12 pt-8 border-t border-gray-200">
                        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                            <div>
                                <p class="text-sm font-semibold text-gray-700 mb-2">Bagikan Artikel Ini:</p>
                                <div class="flex gap-3">
                                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(route('articles.show', $article->slug)) }}"
                                        target="_blank"
                                        class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-blue-600 text-white hover:bg-blue-700 transition">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                            <path
                                                d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" />
                                        </svg>
                                    </a>
                                    <a href="https://twitter.com/intent/tweet?url={{ urlencode(route('articles.show', $article->slug)) }}&text={{ urlencode($article->title) }}"
                                        target="_blank"
                                        class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-sky-500 text-white hover:bg-sky-600 transition">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                            <path
                                                d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z" />
                                        </svg>
                                    </a>
                                    <a href="https://wa.me/?text={{ urlencode($article->title . ' ' . route('articles.show', $article->slug)) }}"
                                        target="_blank"
                                        class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-green-600 text-white hover:bg-green-700 transition">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                            <path
                                                d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z" />
                                        </svg>
                                    </a>
                                </div>
                            </div>
                            <a href="{{ route('articles.index') }}"
                                class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-blue-600 text-white font-semibold hover:bg-blue-700 transition">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                    class="w-5 h-5">
                                    <path
                                        d="M11.25 4.533A9.707 9.707 0 006 3a9.735 9.735 0 00-3.25.555.75.75 0 00-.5.707v14.25a.75.75 0 001 .707A8.237 8.237 0 016 18.75c1.995 0 3.823.707 5.25 1.886V4.533zM12.75 20.636A8.214 8.214 0 0118 18.75c.966 0 1.89.166 2.75.47a.75.75 0 001-.708V4.262a.75.75 0 00-.5-.707A9.735 9.735 0 0018 3a9.707 9.707 0 00-5.25 1.533v16.103z" />
                                </svg>
                                Lihat Artikel Lain
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </article>

    {{-- ========================= RELATED ARTICLES ========================= --}}
    @if ($relatedArticles->count() > 0)
        <section class="py-16 bg-gray-50">
            <div class="soft-container">
                <div class="max-w-6xl mx-auto">
                    <div class="mb-10" data-aos="fade-down">
                        <span class="inline-flex px-3 py-1 rounded-full bg-blue-100 text-blue-700 section-badge text-xs">
                            ARTIKEL TERKAIT
                        </span>
                        <h2 class="mt-3 text-3xl font-bold tracking-tight">Baca Juga</h2>
                        <p class="mt-2 text-gray-600">Artikel lainnya yang mungkin menarik untuk Anda</p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach ($relatedArticles as $relatedArticle)
                            <article class="card  rounded-2xl bg-white shadow-sm hover:shadow-xl transition overflow-hidden"
                                data-aos="fade-up" data-aos-delay="{{ $loop->index * 80 }}">
                                <a href="{{ route('articles.show', $relatedArticle->slug) }}" class="block">
                                    @if ($relatedArticle->featured_image)
                                        <div class="relative h-48 overflow-hidden">
                                            <img src="{{ Storage::url($relatedArticle->featured_image) }}"
                                                alt="{{ $relatedArticle->title }}"
                                                class="card-image w-full h-full object-cover">
                                            <div class="absolute inset-0 bg-gradient-to-t from-black/30 via-transparent">
                                            </div>
                                        </div>
                                    @endif
                                    <div class="p-6">
                                        <h3 class="text-lg font-semibold text-gray-900 mb-2 leading-snug">
                                            {{ $relatedArticle->title }}
                                        </h3>
                                        <p class="text-gray-600 text-sm mb-4">
                                            {{ Str::limit($relatedArticle->excerpt, 100) }}
                                        </p>
                                        <div class="flex items-center text-sm text-gray-500 gap-2">
                                            <span class="inline-flex items-center gap-1">
                                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd"
                                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                                {{ $relatedArticle->reading_time }}
                                            </span>
                                            <span>&bull;</span>
                                            <span>{{ $relatedArticle->published_at->format('d M Y') }}</span>
                                        </div>
                                        <div class="mt-4">
                                            <span
                                                class="inline-flex items-center gap-2 text-blue-700 font-semibold text-sm">
                                                Baca Artikel
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                    fill="currentColor" class="w-4 h-4">
                                                    <path d="M13.5 4.5 21 12l-7.5 7.5M21 12H3" />
                                                </svg>
                                            </span>
                                        </div>
                                    </div>
                                </a>
                            </article>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
    @endif

    {{-- ========================= CTA ========================= --}}
    <section class="relative py-16 bg-gradient-to-r from-blue-700 via-blue-600 to-blue-700 text-white overflow-hidden">
        <div aria-hidden="true" class="absolute inset-0 dot-pattern opacity-20"></div>
        <div class="soft-container relative">
            <div class="max-w-4xl mx-auto text-center" data-aos="zoom-in">
                <h2 class="text-3xl md:text-4xl font-extrabold">Tetap Terhubung</h2>
                <p class="mt-3 text-white/90 max-w-2xl mx-auto">
                    Ikuti terus update artikel dan kajian terbaru dari Bidang Dakwah Masjid Salman ITB
                </p>
                <div class="mt-8 flex flex-wrap justify-center gap-4">
                    <a href="{{ route('articles.index') }}"
                        class="inline-flex items-center gap-2 px-6 py-3 rounded-xl bg-white text-blue-700 font-semibold shadow hover:shadow-md transition">
                        Lihat Semua Artikel
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5">
                            <path d="M13.5 4.5 21 12l-7.5 7.5M21 12H3" />
                        </svg>
                    </a>
                    <a href="{{ route('programs.index') }}"
                        class="inline-flex items-center gap-2 px-6 py-3 rounded-xl ring-1 ring-white/40 font-semibold hover:bg-white/10 transition">
                        Jelajahi Program
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection
