@extends('layouts.app')
@section('title', 'Artikel Bidang Dakwah Masjid Salman ITB')

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
    </style>

    {{-- ========================= HERO SECTION ========================= --}}
    <section class="relative isolate overflow-hidden bg-gradient-to-br from-blue-700 via-blue-600 to-blue-700 text-white">
        <div aria-hidden="true" class="absolute -top-24 -left-24 h-64 w-64 rounded-full bg-blue-500/30 blur-3xl"></div>
        <div aria-hidden="true" class="absolute -bottom-24 -right-24 h-64 w-64 rounded-full bg-blue-400/20 blur-3xl"></div>

        <div class="soft-container py-16 md:py-20">
            <div class="text-center" data-aos="fade-down">
                <span
                    class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white/10 ring-1 ring-white/20 section-badge text-sm">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M9 4.804A7.968 7.968 0 005.5 4c-1.255 0-2.443.29-3.5.804v10A7.969 7.969 0 015.5 14c1.669 0 3.218.51 4.5 1.385A7.962 7.962 0 0114.5 14c1.255 0 2.443.29 3.5.804v-10A7.968 7.968 0 0014.5 4c-1.255 0-2.443.29-3.5.804V12a1 1 0 11-2 0V4.804z" />
                    </svg>
                    ARTIKEL & WAWASAN
                </span>
                <h1 class="mt-4 text-4xl md:text-5xl font-extrabold leading-tight">Wawasan & Tadabbur</h1>
                <p class="mt-4 text-white/90 max-w-2xl mx-auto text-lg">Kumpulan artikel pilihan seputar dakwah, kajian
                    Islam, dan pengembangan diri untuk memperkaya pemahaman keislaman Anda.</p>
            </div>
        </div>
    </section>

    {{-- ========================= FEATURED ARTICLE ========================= --}}
    @if ($featuredArticle)
        <section class="py-16 bg-gray-50">
            <div class="soft-container">
                <div class="mb-8" data-aos="fade-down">
                    <span class="inline-flex px-3 py-1 rounded-full bg-amber-100 text-amber-700 section-badge text-xs">
                        ARTIKEL PILIHAN
                    </span>
                </div>

                <div class=" rounded-2xl bg-white shadow-xl overflow-hidden" data-aos="zoom-in">
                    <a href="{{ route('articles.show', $featuredArticle->slug) }}" class="block">
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-0">
                            @if ($featuredArticle->featured_image)
                                <div class="relative h-80 lg:h-full overflow-hidden">
                                    <img src="{{ Storage::url($featuredArticle->featured_image) }}"
                                        alt="{{ $featuredArticle->title }}"
                                        class="card-image absolute inset-0 w-full h-full object-cover">
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/40 via-transparent"></div>
                                </div>
                            @endif
                            <div class="p-8 lg:p-12 flex flex-col justify-center">
                                <span
                                    class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-sm font-semibold bg-emerald-100 text-emerald-700 mb-4 w-fit">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                    </svg>
                                    Featured
                                </span>
                                <h2 class="text-3xl md:text-4xl font-extrabold text-gray-900 mb-4 leading-tight">
                                    {{ $featuredArticle->title }}
                                </h2>
                                <p class="text-gray-600 mb-6 text-lg">{{ $featuredArticle->excerpt }}</p>
                                <div class="flex items-center text-sm text-gray-500 gap-3">
                                    <span class="inline-flex items-center gap-1">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        {{ $featuredArticle->reading_time }}
                                    </span>
                                    <span>&bull;</span>
                                    <span>{{ $featuredArticle->published_at->format('d M Y') }}</span>
                                    <span>&bull;</span>
                                    <span class="font-medium">{{ $featuredArticle->author->name }}</span>
                                </div>
                                <div class="mt-6">
                                    <span class="inline-flex items-center gap-2 text-emerald-700 font-semibold">
                                        Baca Selengkapnya
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                            class="w-5 h-5">
                                            <path d="M13.5 4.5 21 12l-7.5 7.5M21 12H3" />
                                        </svg>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </section>
    @endif

    {{-- ========================= ARTICLES LIST ========================= --}}
    <section class="py-16 bg-white">
        <div class="soft-container">
            <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center gap-4 mb-10"
                data-aos="fade-down">
                <div>
                    <span class="inline-flex px-3 py-1 rounded-full bg-blue-100 text-blue-700 section-badge text-xs">
                        SEMUA ARTIKEL
                    </span>
                    <h2 class="mt-3 text-3xl font-bold tracking-tight">Artikel Terbaru</h2>
                </div>

                <div class="flex flex-wrap gap-3 w-full lg:w-auto">
                    <select id="category-filter"
                        class="flex-1 lg:flex-none rounded-xl border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 px-4 py-2.5 font-medium">
                        <option value="">Semua Kategori</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ request('category') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    <select id="tag-filter"
                        class="flex-1 lg:flex-none rounded-xl border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 px-4 py-2.5 font-medium">
                        <option value="">Semua Tag</option>
                        @foreach ($tags as $tag)
                            <option value="{{ $tag->id }}" {{ request('tag') == $tag->id ? 'selected' : '' }}>
                                {{ $tag->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($articles as $article)
                    <article class="card  rounded-2xl bg-white shadow-sm hover:shadow-xl transition overflow-hidden"
                        data-aos="fade-up" data-aos-delay="{{ $loop->index * 80 }}">
                        <a href="{{ route('articles.show', $article->slug) }}" class="block">
                            @if ($article->featured_image)
                                <div class="relative h-56 overflow-hidden">
                                    <img src="{{ Storage::url($article->featured_image) }}" alt="{{ $article->title }}"
                                        class="card-image w-full h-full object-cover">
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/30 via-transparent"></div>
                                </div>
                            @endif
                            <div class="p-6">
                                <div class="flex flex-wrap gap-2 mb-4">
                                    <span class="px-3 py-1 text-xs font-semibold rounded-full"
                                        style="background-color: {{ $article->category->color }}20; color: {{ $article->category->color }}">
                                        {{ $article->category->name }}
                                    </span>
                                    @foreach ($article->tags->take(2) as $tag)
                                        <span class="px-3 py-1 text-xs font-medium bg-gray-100 text-gray-700 rounded-full">
                                            {{ $tag->name }}
                                        </span>
                                    @endforeach
                                </div>
                                <h3 class="text-xl font-semibold text-gray-900 mb-2 leading-snug">
                                    {{ $article->title }}
                                </h3>
                                <p class="text-gray-600 mb-4 text-sm">{{ Str::limit($article->excerpt, 100) }}</p>
                                <div class="flex items-center text-sm text-gray-500 gap-2">
                                    <span class="inline-flex items-center gap-1">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        {{ $article->reading_time }}
                                    </span>
                                    <span>&bull;</span>
                                    <span>{{ $article->published_at->format('d M Y') }}</span>
                                </div>
                                <div class="mt-4">
                                    <span class="inline-flex items-center gap-2 text-emerald-700 font-semibold text-sm">
                                        Baca Artikel
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                            class="w-4 h-4">
                                            <path d="M13.5 4.5 21 12l-7.5 7.5M21 12H3" />
                                        </svg>
                                    </span>
                                </div>
                            </div>
                        </a>
                    </article>
                @endforeach
            </div>

            @if ($articles->hasPages())
                <div class="mt-12" data-aos="fade-up">
                    {{ $articles->links() }}
                </div>
            @endif
        </div>
    </section>

    {{-- ========================= CTA ========================= --}}
    <section class="relative py-16 bg-gradient-to-r from-blue-700 via-blue-600 to-blue-700 text-white overflow-hidden">
        <div aria-hidden="true" class="absolute inset-0 dot-pattern opacity-20"></div>
        <div class="soft-container relative">
            <div class="text-center" data-aos="zoom-in">
                <h2 class="text-3xl md:text-4xl font-extrabold">Ingin Berkontribusi?</h2>
                <p class="mt-3 text-white/90 max-w-2xl mx-auto">
                    Bagikan pemikiran dan wawasan Anda melalui artikel untuk menginspirasi komunitas.
                </p>
                <div class="mt-8">
                    <a href="{{ route('contact') }}"
                        class="inline-flex items-center gap-2 px-6 py-3 rounded-xl bg-white text-blue-700 font-semibold shadow hover:shadow-md transition">
                        Hubungi Kami
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5">
                            <path d="M13.5 4.5 21 12l-7.5 7.5M21 12H3" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </section>

    @push('scripts')
        <script>
            document.getElementById('category-filter').addEventListener('change', function() {
                updateFilters();
            });

            document.getElementById('tag-filter').addEventListener('change', function() {
                updateFilters();
            });

            function updateFilters() {
                const category = document.getElementById('category-filter').value;
                const tag = document.getElementById('tag-filter').value;

                let url = new URL(window.location.href);
                if (category) {
                    url.searchParams.set('category', category);
                } else {
                    url.searchParams.delete('category');
                }
                if (tag) {
                    url.searchParams.set('tag', tag);
                } else {
                    url.searchParams.delete('tag');
                }

                window.location.href = url.toString();
            }
        </script>
    @endpush
@endsection
