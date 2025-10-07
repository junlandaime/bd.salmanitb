@extends('layouts.app')
@section('title', $news->title . ' - Berita Bidang Dakwah Masjid Salman ITB')
@section('meta_description', Str::limit($news->excerpt, 160))
@section('og_title', $news->title . ' - Berita Bidang Dakwah Masjid Salman ITB')
@section('og_description', Str::limit($news->excerpt, 200))
@section('og_image', 'https://bidangdakwah.salmanitb.com/storage/' . $news->featured_image)

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

        .article-content {
            font-size: 1.125rem;
            line-height: 1.75;
            color: #374151;
        }

        .article-content h2 {
            font-size: 1.875rem;
            font-weight: 700;
            margin-top: 2rem;
            margin-bottom: 1rem;
            color: #111827;
        }

        .article-content h3 {
            font-size: 1.5rem;
            font-weight: 600;
            margin-top: 1.5rem;
            margin-bottom: 0.75rem;
            color: #1f2937;
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

        .article-content img {
            border-radius: 1rem;
            margin: 2rem 0;
        }

        .article-content blockquote {
            border-left: 4px solid #10b981;
            padding-left: 1.5rem;
            margin: 2rem 0;
            font-style: italic;
            color: #6b7280;
        }
    </style>

    {{-- ========================= HERO HEADER ========================= --}}
    <section
        class="relative isolate overflow-hidden bg-gradient-to-br from-emerald-700 via-emerald-600 to-emerald-700 text-white">
        <!-- Featured Image Background -->
        <div class="absolute inset-0">
            <img src="{{ Storage::url($news->featured_image) }}" alt="{{ $news->title }}"
                class="w-full h-full object-cover opacity-20">
            <div class="absolute inset-0 bg-gradient-to-t from-emerald-900 via-emerald-800/80 to-transparent"></div>
        </div>

        <!-- Decorative blobs -->
        <div aria-hidden="true" class="absolute -top-24 -left-24 h-64 w-64 rounded-full bg-emerald-500/30 blur-3xl"></div>
        <div aria-hidden="true" class="absolute -bottom-24 -right-24 h-64 w-64 rounded-full bg-emerald-400/20 blur-3xl"></div>

        <div class="soft-container py-16 md:py-24 relative">
            <div class="max-w-4xl mx-auto">
                <!-- Category & Date -->
                <div class="flex flex-wrap items-center justify-center gap-4 mb-6" data-aos="fade-down">
                    <span class="inline-flex items-center px-4 py-2 rounded-full font-semibold text-sm"
                        style="background-color: {{ $news->category->color }}; color: white;">
                        {{ $news->category->name }}
                    </span>
                    <span class="inline-flex items-center gap-2 text-white/90">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                clip-rule="evenodd" />
                        </svg>
                        {{ $news->published_at->format('d F Y') }}
                    </span>
                </div>

                <!-- Title -->
                <h1 class="text-4xl md:text-5xl font-extrabold leading-tight text-center mb-8" data-aos="fade-up"
                    data-aos-delay="100">
                    {{ $news->title }}
                </h1>

                <!-- Featured Image -->
                <div class="glass rounded-2xl p-3 mb-8" data-aos="zoom-in" data-aos-delay="200">
                    <img src="{{ Storage::url($news->featured_image) }}" alt="{{ $news->title }}"
                        class="w-full aspect-video object-cover rounded-xl">
                </div>

                <!-- Author Info -->
                <div class="flex items-center justify-center gap-4" data-aos="fade-up" data-aos-delay="300">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode($news->author->name) }}&background=10b981&color=fff"
                        class="w-14 h-14 rounded-full ring-4 ring-white/20">
                    <div class="text-left">
                        <p class="font-semibold text-lg">{{ $news->author->name }}</p>
                        <p class="text-white/80 text-sm">{{ $news->author->title ?? 'Staff Bidang Dakwah' }}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ========================= ARTICLE CONTENT ========================= --}}
    <section class="py-16 bg-gray-50">
        <div class="soft-container">
            <div class="max-w-4xl mx-auto">
                <!-- Event Details -->
                @if ($news->event_date || $news->location)
                    <div class=" rounded-2xl bg-gradient-to-br from-emerald-50 to-blue-50 p-6 mb-8" data-aos="fade-up">
                        <div class="flex flex-wrap gap-8">
                            @if ($news->event_date)
                                <div class="flex items-start gap-3">
                                    <div
                                        class="flex-shrink-0 w-12 h-12 rounded-xl bg-emerald-600 flex items-center justify-center">
                                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-gray-600 mb-1">Tanggal & Waktu</p>
                                        <p class="font-bold text-gray-900">{{ $news->event_date->format('d F Y, H:i') }}
                                            WIB</p>
                                    </div>
                                </div>
                            @endif

                            @if ($news->location)
                                <div class="flex items-start gap-3">
                                    <div
                                        class="flex-shrink-0 w-12 h-12 rounded-xl bg-blue-600 flex items-center justify-center">
                                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-gray-600 mb-1">Lokasi</p>
                                        <p class="font-bold text-gray-900">{{ $news->location }}</p>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                @endif

                <!-- Main Content Card -->
                <div class=" rounded-2xl bg-white p-8 md:p-12 shadow-lg mb-8" data-aos="fade-up" data-aos-delay="100">
                    <!-- Excerpt -->
                    <p class="text-xl font-medium text-gray-700 mb-8 pb-8 border-b border-gray-200">
                        {{ $news->excerpt }}
                    </p>

                    <!-- Article Body -->
                    <div class="article-content">
                        {!! $news->content !!}
                    </div>

                    <!-- Tags -->
                    @if ($news->tags->count() > 0)
                        <div class="flex flex-wrap gap-2 pt-8 mt-8 border-t border-gray-200">
                            @foreach ($news->tags as $tag)
                                <span
                                    class="inline-flex items-center gap-1 px-3 py-1 bg-gray-100 text-gray-700 rounded-full text-sm font-medium hover:bg-gray-200 transition">
                                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M17.707 9.293a1 1 0 010 1.414l-7 7a1 1 0 01-1.414 0l-7-7A.997.997 0 012 10V5a3 3 0 013-3h5c.256 0 .512.098.707.293l7 7zM5 6a1 1 0 100-2 1 1 0 000 2z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    {{ $tag->name }}
                                </span>
                            @endforeach
                        </div>
                    @endif

                    <!-- Share Buttons -->
                    <div class="pt-8 mt-8 border-t border-gray-200">
                        <h3 class="text-lg font-bold text-gray-900 mb-4">Bagikan Artikel:</h3>
                        <div class="flex flex-wrap gap-3">
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}"
                                target="_blank"
                                class="inline-flex items-center gap-2 px-5 py-2.5 bg-blue-600 text-white font-semibold rounded-xl hover:bg-blue-700 transition shadow hover:shadow-md">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" />
                                </svg>
                                Facebook
                            </a>
                            <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->url()) }}&text={{ urlencode($news->title) }}"
                                target="_blank"
                                class="inline-flex items-center gap-2 px-5 py-2.5 bg-sky-500 text-white font-semibold rounded-xl hover:bg-sky-600 transition shadow hover:shadow-md">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z" />
                                </svg>
                                Twitter
                            </a>
                            <a href="https://wa.me/?text={{ urlencode($news->title . ' ' . request()->url()) }}"
                                target="_blank"
                                class="inline-flex items-center gap-2 px-5 py-2.5 bg-green-600 text-white font-semibold rounded-xl hover:bg-green-700 transition shadow hover:shadow-md">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z" />
                                </svg>
                                WhatsApp
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Author Bio Card -->
                <div class=" rounded-2xl bg-white p-8 shadow-lg mb-8" data-aos="fade-up" data-aos-delay="200">
                    <div class="flex flex-col sm:flex-row items-center sm:items-start gap-6">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode($news->author->name) }}&background=10b981&color=fff&size=128"
                            class="w-24 h-24 rounded-2xl ring-4 ring-emerald-100">
                        <div class="flex-1 text-center sm:text-left">
                            <h3 class="text-2xl font-bold text-gray-900 mb-2">{{ $news->author->name }}</h3>
                            <p class="text-gray-600 mb-4">
                                {{ $news->author->bio ?? 'Staff Bidang Dakwah Masjid Salman ITB' }}
                            </p>
                            @if ($news->author->twitter || $news->author->linkedin || $news->author->website)
                                <div class="flex flex-wrap gap-3 justify-center sm:justify-start">
                                    @if ($news->author->twitter)
                                        <a href="{{ $news->author->twitter }}" target="_blank"
                                            class="inline-flex items-center gap-2 text-sky-600 hover:text-sky-700 font-medium">
                                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                                <path
                                                    d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z" />
                                            </svg>
                                            Twitter
                                        </a>
                                    @endif
                                    @if ($news->author->linkedin)
                                        <a href="{{ $news->author->linkedin }}" target="_blank"
                                            class="inline-flex items-center gap-2 text-blue-600 hover:text-blue-700 font-medium">
                                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                                <path
                                                    d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z" />
                                            </svg>
                                            LinkedIn
                                        </a>
                                    @endif
                                    @if ($news->author->website)
                                        <a href="{{ $news->author->website }}" target="_blank"
                                            class="inline-flex items-center gap-2 text-emerald-600 hover:text-emerald-700 font-medium">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9" />
                                            </svg>
                                            Website
                                        </a>
                                    @endif
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Related News -->
                @if ($relatedNews->count() > 0)
                    <div class="mb-8" data-aos="fade-up" data-aos-delay="300">
                        <div class="flex items-center gap-3 mb-6">
                            <div class="h-1 w-12 bg-gradient-to-r from-emerald-600 to-emerald-500 rounded-full"></div>
                            <h2 class="text-3xl font-bold text-gray-900">Berita Terkait</h2>
                        </div>
                        <div class="grid gap-6 sm:grid-cols-2">
                            @foreach ($relatedNews as $relatedItem)
                                <article
                                    class="card  rounded-2xl bg-white shadow-sm hover:shadow-xl transition overflow-hidden"
                                    data-aos="fade-up" data-aos-delay="{{ $loop->index * 80 }}">
                                    <a href="{{ route('news.show', $relatedItem->slug) }}" class="block">
                                        <div class="relative overflow-hidden">
                                            <img src="{{ Storage::url($relatedItem->featured_image) }}"
                                                alt="{{ $relatedItem->title }}"
                                                class="card-image w-full h-48 object-cover">
                                            <div class="absolute inset-0 bg-gradient-to-t from-black/40 via-transparent">
                                            </div>
                                            <div class="absolute top-4 left-4">
                                                <span
                                                    class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold"
                                                    style="background-color: {{ $relatedItem->category->color }}; color: white;">
                                                    {{ $relatedItem->category->name }}
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
                                                {{ $relatedItem->published_at->format('d M Y') }}
                                            </div>
                                            <h3 class="text-lg font-bold mb-2 leading-snug">{{ $relatedItem->title }}</h3>
                                            <p class="text-gray-600 text-sm mb-4 line-clamp-2">{{ $relatedItem->excerpt }}
                                            </p>
                                            <span class="inline-flex items-center gap-2 text-emerald-700 font-semibold">
                                                Baca Selengkapnya
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                    fill="currentColor" class="w-4 h-4">
                                                    <path d="M13.5 4.5 21 12l-7.5 7.5M21 12H3" />
                                                </svg>
                                            </span>
                                        </div>
                                    </a>
                                </article>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>

    {{-- ========================= CTA ========================= --}}
    <section
        class="relative py-16 bg-gradient-to-r from-emerald-700 via-emerald-600 to-emerald-700 text-white overflow-hidden">
        <div aria-hidden="true" class="absolute inset-0 opacity-10">
            <div class="absolute inset-0"
                style="background-image: radial-gradient(rgba(255, 255, 255, .15) 1px, transparent 1px); background-size: 16px 16px">
            </div>
        </div>
        <div class="soft-container relative">
            <div class="max-w-3xl mx-auto text-center" data-aos="fade-up">
                <h2 class="text-3xl md:text-4xl font-extrabold mb-4">Ikuti Berita & Kegiatan Lainnya</h2>
                <p class="text-lg text-white/90 mb-8">
                    Jangan lewatkan update terbaru dari Bidang Dakwah Masjid Salman ITB
                </p>
                <a href="{{ route('news.index') }}"
                    class="inline-flex items-center gap-2 px-6 py-3 rounded-xl bg-white text-emerald-700 font-semibold shadow-lg hover:shadow-xl transition">
                    Lihat Semua Berita
                    <svg viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4">
                        <path d="M13.5 4.5 21 12l-7.5 7.5M21 12H3" />
                    </svg>
                </a>
            </div>
        </div>
    </section>
@endsection
