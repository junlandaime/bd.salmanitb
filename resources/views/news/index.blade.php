@extends('layouts.app')
@section('title', 'Berita Bidang Dakwah Masjid Salman ITB')

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
        /* Subtle upgrades without changing data structure */
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

    {{-- ========================= HERO ========================= --}}
    <section
        class="relative isolate overflow-hidden bg-gradient-to-br from-emerald-700 via-emerald-600 to-emerald-700 text-white">
        <!-- Decorative blobs -->
        <div aria-hidden="true" class="absolute -top-24 -left-24 h-64 w-64 rounded-full bg-emerald-500/30 blur-3xl"></div>
        <div aria-hidden="true" class="absolute -bottom-24 -right-24 h-64 w-64 rounded-full bg-emerald-400/20 blur-3xl"></div>

        @if ($featuredNews)
            <!-- Featured News Hero -->
            <div class="absolute inset-0">
                <img src="{{ Storage::url($featuredNews->featured_image ?? 'news/default.jpg') }}"
                    alt="{{ $featuredNews->title }}" class="w-full h-full object-cover opacity-20">
                <div class="absolute inset-0 bg-gradient-to-t from-emerald-900 via-emerald-800/80 to-transparent"></div>
            </div>
        @endif

        <div class="soft-container py-20 md:py-32 relative">
            <div class="max-w-4xl mx-auto text-center">
                @if ($featuredNews)
                    <div data-aos="fade-down" data-aos-duration="800">
                        <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full section-badge text-sm"
                            style="background-color: {{ $featuredNews->category->color }}30; color: {{ $featuredNews->category->color }}; border: 1px solid {{ $featuredNews->category->color }}50;">
                            {{ $featuredNews->category->name }}
                        </span>
                    </div>
                    <h1 class="mt-6 text-4xl md:text-5xl font-extrabold leading-tight" data-aos="fade-up"
                        data-aos-delay="100">
                        {{ $featuredNews->title }}
                    </h1>
                    <p class="mt-6 text-lg md:text-xl text-white/90 max-w-2xl mx-auto" data-aos="fade-up"
                        data-aos-delay="200">
                        {{ $featuredNews->excerpt }}
                    </p>
                    <div class="mt-8" data-aos="fade-up" data-aos-delay="300">
                        <a href="{{ route('news.show', $featuredNews->slug) }}"
                            class="inline-flex items-center gap-2 rounded-xl bg-white text-emerald-700 px-6 py-3 font-semibold shadow-lg hover:shadow-xl transition">
                            Baca Selengkapnya
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5">
                                <path d="M13.5 4.5 21 12l-7.5 7.5M21 12H3" />
                            </svg>
                        </a>
                    </div>
                @else
                    <div data-aos="fade-down" data-aos-duration="800">
                        <span
                            class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white/10 ring-1 ring-white/20 section-badge text-sm">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M2 5a2 2 0 012-2h8a2 2 0 012 2v10a2 2 0 002 2H4a2 2 0 01-2-2V5zm3 1h6v4H5V6zm6 6H5v2h6v-2z"
                                    clip-rule="evenodd" />
                                <path d="M15 7h1a2 2 0 012 2v5.5a1.5 1.5 0 01-3 0V7z" />
                            </svg>
                            Berita & Kegiatan
                        </span>
                    </div>
                    <h1 class="mt-6 text-4xl md:text-5xl font-extrabold leading-tight" data-aos="fade-up"
                        data-aos-delay="100">
                        Kabar Terbaru Salman
                    </h1>
                    <p class="mt-6 text-lg text-white/90 max-w-2xl mx-auto" data-aos="fade-up" data-aos-delay="200">
                        Ikuti perkembangan dan kegiatan terbaru dari Bidang Dakwah Masjid Salman ITB
                    </p>
                @endif
            </div>
        </div>
    </section>

    {{-- ========================= SEARCH & FILTER ========================= --}}
    <section class="py-8 bg-gray-50 -mt-8 relative z-10">
        <div class="soft-container">
            <div class="max-w-4xl mx-auto">
                <div class=" rounded-2xl bg-white p-6 shadow-lg" data-aos="fade-up">
                    <form action="{{ route('news.index') }}" method="GET" class="flex flex-col md:flex-row gap-4">
                        <div class="flex-1">
                            <div class="relative">
                                <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-400" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                                <input type="text" name="search" placeholder="Cari berita..."
                                    class="w-full pl-10 pr-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition"
                                    value="{{ request('search') }}">
                            </div>
                        </div>
                        <div class="w-full md:w-64">
                            <select name="category"
                                class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition">
                                <option value="">Semua Kategori</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->slug }}" @selected(request('category') == $category->slug)>
                                        {{ $category->name }} ({{ $category->news_count }})
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit"
                            class="inline-flex items-center justify-center gap-2 px-6 py-3 bg-emerald-600 text-white font-semibold rounded-xl hover:bg-emerald-700 transition shadow hover:shadow-md">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                            </svg>
                            Filter
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    {{-- ========================= NEWS GRID ========================= --}}
    <section class="py-16 bg-gray-50">
        <div class="soft-container">
            @if ($news->count() > 0)
                <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach ($news as $item)
                        <article class="card  rounded-2xl bg-white shadow-sm hover:shadow-xl transition overflow-hidden"
                            data-aos="zoom-in" data-aos-delay="{{ $loop->index * 80 }}">
                            <a href="{{ route('news.show', $item->slug) }}" class="block">
                                <div class="relative overflow-hidden">
                                    <img src="{{ Storage::url($item->featured_image) }}" alt="{{ $item->title }}"
                                        class="card-image w-full h-56 object-cover">
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/40 via-transparent"></div>
                                    <div class="absolute top-4 left-4">
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold"
                                            style="background-color: {{ $item->category->color }}; color: white;">
                                            {{ $item->category->name }}
                                        </span>
                                    </div>
                                </div>
                                <div class="p-6">
                                    <div class="flex items-center gap-2 text-sm text-gray-500 mb-3">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        {{ $item->published_at->format('d M Y') }}
                                    </div>
                                    <h3 class="text-xl font-bold mb-3 leading-snug">{{ $item->title }}</h3>
                                    <p class="text-gray-600 text-sm mb-4 line-clamp-3">{{ $item->excerpt }}</p>

                                    @if ($item->event_date || $item->location)
                                        <div class="space-y-2 mb-4 pb-4 border-b border-gray-100">
                                            @if ($item->event_date)
                                                <div class="flex items-center text-emerald-600 text-sm">
                                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                    </svg>
                                                    {{ $item->event_date->format('d F Y, H:i') }}
                                                </div>
                                            @endif
                                            @if ($item->location)
                                                <div class="flex items-center text-gray-600 text-sm">
                                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    </svg>
                                                    {{ $item->location }}
                                                </div>
                                            @endif
                                        </div>
                                    @endif

                                    <span class="inline-flex items-center gap-2 text-emerald-700 font-semibold">
                                        Baca Selengkapnya
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                            class="w-4 h-4">
                                            <path d="M13.5 4.5 21 12l-7.5 7.5M21 12H3" />
                                        </svg>
                                    </span>
                                </div>
                            </a>
                        </article>
                    @endforeach
                </div>

                {{-- Pagination --}}
                <div class="mt-12 flex justify-center" data-aos="fade-up">
                    {{ $news->links() }}
                </div>
            @else
                {{-- Empty State --}}
                <div class="text-center py-16" data-aos="fade-up">
                    <div class="inline-flex items-center justify-center w-20 h-20 rounded-full bg-gray-100 mb-6">
                        <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-2">Tidak Ada Berita Ditemukan</h3>
                    <p class="text-gray-600 mb-6">Coba ubah filter atau kata kunci pencarian Anda</p>
                    <a href="{{ route('news.index') }}"
                        class="inline-flex items-center gap-2 px-6 py-3 rounded-xl bg-emerald-600 text-white font-semibold hover:bg-emerald-700 transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                        </svg>
                        Reset Filter
                    </a>
                </div>
            @endif
        </div>
    </section>

    {{-- ========================= CTA ========================= --}}
    <section
        class="relative py-16 bg-gradient-to-r from-emerald-700 via-emerald-600 to-emerald-700 text-white overflow-hidden">
        <div aria-hidden="true" class="absolute inset-0 dot-pattern opacity-20"></div>
        <div class="soft-container relative">
            <div class="max-w-3xl mx-auto text-center" data-aos="fade-up">
                <h2 class="text-3xl md:text-4xl font-extrabold mb-4">Jangan Lewatkan Update Terbaru</h2>
                <p class="text-lg text-white/90 mb-8">
                    Ikuti terus berita dan kegiatan dari Bidang Dakwah Masjid Salman ITB
                </p>
                <a href="{{ route('programs.index') }}"
                    class="inline-flex items-center gap-2 px-6 py-3 rounded-xl bg-white text-emerald-700 font-semibold shadow-lg hover:shadow-xl transition">
                    Lihat Program Kami
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5">
                        <path d="M13.5 4.5 21 12l-7.5 7.5M21 12H3" />
                    </svg>
                </a>
            </div>
        </div>
    </section>
@endsection
