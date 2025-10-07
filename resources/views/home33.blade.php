@extends('layouts.app')
@section('title', 'Bidang Dakwah Masjid Salman ITB')

@section('content')
@php
    $hero = $landingpage ? Storage::url($landingpage->hero_image) : asset('bd.jpg');
@endphp

<main class="min-h-screen bg-gradient-to-b from-white to-gray-50">
    {{-- HERO --}}
    <section class="relative overflow-hidden">
        <div class="absolute inset-0">
            <img src="{{ $hero }}" alt="Hero image" class="h-full w-full object-cover object-center">
            {{-- Overlay to ensure text readability --}}
            <div class="absolute inset-0 bg-gradient-to-b from-black/70 via-black/50 to-black/70"></div>
        </div>

        <div class="relative z-10 container mx-auto px-4 py-20 md:py-28">
            <div class="max-w-4xl">
                <h1 class="text-white font-extrabold tracking-tight text-3xl sm:text-4xl md:text-6xl leading-tight">
                    {{ $landingpage->headline ?? 'Program & Aktivitas Dakwah yang Berdampak' }}
                </h1>
                <p class="mt-4 text-white/90 text-base md:text-lg max-w-2xl">
                    {{ $landingpage->subheadline ?? 'Memberi ruang belajar, bertumbuh, dan berkontribusi untuk ummat—mulai dari kelas reguler, kajian tematik, hingga aktivitas sosial yang terukur.' }}
                </p>

                <div class="mt-8 flex flex-col sm:flex-row gap-3">
                    <a href="#programs" class="inline-flex items-center justify-center gap-2 rounded-xl px-5 py-3 text-sm font-semibold text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="currentColor"><path d="M3 6h18v2H3V6zm0 5h18v2H3v-2zm0 5h18v2H3v-2z"/></svg>
                        Lihat Program
                    </a>
                    <a href="{{ route('contact') }}" class="inline-flex items-center justify-center gap-2 rounded-xl px-5 py-3 text-sm font-semibold bg-white/90 text-gray-900 hover:bg-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-white/70">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="currentColor"><path d="M2 4h20v12H5l-3 3V4z"/></svg>
                        Hubungi Kami
                    </a>
                </div>
            </div>
        </div>
    </section>

    {{-- QUICK STATS --}}
    <section class="container mx-auto px-4 -mt-10 md:-mt-12 relative z-20">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            @php
                $stats = [
                    ['label' => $landingpage->stats_1_label ?? $landingpage->stats1_label ?? 'Peserta Aktif', 'value' => $landingpage->stats_1 ?? $landingpage->stats1 ?? '—'],
                    ['label' => $landingpage->stats_2_label ?? $landingpage->stats2_label ?? 'Program Berjalan', 'value' => $landingpage->stats_2 ?? $landingpage->stats2 ?? '—'],
                    ['label' => $landingpage->stats_3_label ?? $landingpage->stats3_label ?? 'Relawan', 'value' => $landingpage->stats_3 ?? $landingpage->stats3 ?? '—'],
                    ['label' => $landingpage->stats_4_label ?? $landingpage->stats4_label ?? 'Kegiatan/Bulan', 'value' => $landingpage->stats_4 ?? $landingpage->stats4 ?? '—'],
                ];
            @endphp
            @foreach ($stats as $i => $s)
                <div class="rounded-2xl bg-white shadow-sm ring-1 ring-gray-100 p-5 md:p-6 backdrop-blur supports-[backdrop-filter]:bg-white/90" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                    <div class="text-3xl md:text-4xl font-extrabold">{{ $s['value'] }}</div>
                    <div class="mt-1 text-sm text-gray-600">{{ $s['label'] }}</div>
                </div>
            @endforeach
        </div>
    </section>

    {{-- FEATURED PROGRAMS --}}
    <section id="programs" class="container mx-auto px-4 mt-14 md:mt-20">
        <div class="flex items-end justify-between gap-4">
            <div>
                <h2 class="text-2xl md:text-3xl font-bold tracking-tight">Program Unggulan</h2>
                <p class="text-gray-600 mt-1">Pilih jalur kegiatan yang sesuai dengan kebutuhan Anda.</p>
            </div>
            <div class="hidden sm:block">
                <a @php $programIndexUrl = Route::has('program.index') ? route('program.index') : '#'; @endphp href="{{ $programIndexUrl }}" class="text-sm font-semibold text-green-700 hover:text-green-800">Semua Program →</a>
            </div>
        </div>

        <div class="mt-6 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($featuredPrograms as $program)
                <article class="group relative overflow-hidden rounded-2xl bg-white ring-1 ring-gray-100 shadow-sm hover:shadow-md transition-shadow" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                    <div class="p-5 md:p-6">
                        <h3 class="text-lg md:text-xl font-semibold group-hover:text-green-700">{{ $program->title }}</h3>

                        {{-- Batches --}}
                        @if(isset($program->batches) && $program->batches->count())
                            <div class="mt-4 space-y-4">
                                @foreach ($program->batches as $batch)
                                    <div class="flex gap-4">
                                        <div class="text-center bg-green-50 px-3 py-2 rounded-lg">
                                            <div class="text-xl font-bold text-green-700">{{ $batch->tanggal_mulai_kegiatan->format('d') }}</div>
                                            <div class="text-xs font-medium text-green-700">{{ $batch->tanggal_mulai_kegiatan->format('M') }}</div>
                                        </div>
                                        <div class="flex-1">
                                            <div class="flex items-start justify-between">
                                                <div>
                                                    <p class="font-medium leading-tight">Batch {{ $batch->batch_ke }} – {{ $batch->nama_batch }}</p>
                                                    <p class="text-sm text-gray-600 mt-0.5">Durasi {{ $program->durasi }}</p>
                                                </div>
                                                <span class="inline-flex items-center rounded-full bg-amber-50 text-amber-700 text-xs font-medium px-2 py-1">
                                                    Tutup {{ $batch->tanggal_selesai_pendaftaran->diffForHumans(null, true) }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif

                        <div class="mt-5 flex gap-3">
                            <a @php $programUrl = Route::has('program.show') ? route('program.show', $program->slug ?? $program->id ?? null) : '#'; @endphp href="{{ $programUrl }}"
                               class="inline-flex items-center justify-center rounded-lg px-4 py-2 text-sm font-semibold text-white bg-green-600 hover:bg-green-700">
                                Lihat Program
                            </a>
                            <a href="{{ route('contact') }}"
                               class="inline-flex items-center justify-center rounded-lg px-4 py-2 text-sm font-semibold bg-gray-100 text-gray-900 hover:bg-gray-200">
                                Konsultasi
                            </a>
                        </div>
                    </div>
                </article>
            @endforeach
        </div>
    </section>

    {{-- ACTIVITIES HIGHLIGHTS --}}
    @isset($activity)
    <section class="container mx-auto px-4 mt-14 md:mt-20">
        <div class="flex items-end justify-between gap-4">
            <div>
                <h2 class="text-2xl md:text-3xl font-bold tracking-tight">Sorotan Aktivitas</h2>
                <p class="text-gray-600 mt-1">{{ $activity->program->title ?? 'Kegiatan terbaru pilihan tim' }}</p>
            </div>
        </div>

        <div class="mt-6 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($activity->highlights->take(3) ?? [] as $highlight)
                <article class="rounded-2xl overflow-hidden ring-1 ring-gray-100 bg-white shadow-sm hover:shadow-md transition-shadow" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                    <div class="p-5 md:p-6">
                        <h3 class="font-semibold text-lg">{{ $highlight->title }}</h3>
                        <p class="mt-1 text-sm text-gray-600 line-clamp-3">{{ $activity->overview }}</p>
                        <div class="mt-5">
                            <a href="{{ route('activity.show', $activity->slug ?? $activity->id ?? null) ?? '#' }}" class="text-sm font-semibold text-green-700 hover:text-green-800">Lihat Detail →</a>
                        </div>
                    </div>
                </article>
            @endforeach
        </div>
    </section>
    @endisset

    {{-- NEWS --}}
    <section class="container mx-auto px-4 mt-14 md:mt-20">
        <div class="flex items-end justify-between gap-4">
            <div>
                <h2 class="text-2xl md:text-3xl font-bold tracking-tight">Berita Terbaru</h2>
                <p class="text-gray-600 mt-1">Update kegiatan dan kabar terbaru.</p>
            </div>
            <div class="hidden sm:block">
                <a @php $newsIndexUrl = Route::has('news.index') ? route('news.index') : '#'; @endphp href="{{ $newsIndexUrl }}" class="text-sm font-semibold text-green-700 hover:text-green-800">Semua Berita →</a>
            </div>
        </div>
        <div class="mt-6 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($latestNews as $news)
                <article class="rounded-2xl overflow-hidden ring-1 ring-gray-100 bg-white shadow-sm hover:shadow-md transition-shadow" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                    <div class="p-5 md:p-6">
                        <h3 class="font-semibold text-lg leading-tight">
                            <a @php $newsUrl = Route::has('news.show') ? route('news.show', $news->slug ?? $news->id ?? null) : '#'; @endphp href="{{ $newsUrl }}" class="hover:text-green-700">
                                {{ $news->title }}
                            </a>
                        </h3>
                        <p class="mt-2 text-sm text-gray-600 line-clamp-3">{{ $news->excerpt ?? '' }}</p>
                        <div class="mt-5 text-sm">
                            <a @php $newsUrl = Route::has('news.show') ? route('news.show', $news->slug ?? $news->id ?? null) : '#'; @endphp href="{{ $newsUrl }}" class="font-semibold text-green-700 hover:text-green-800">Baca Selengkapnya →</a>
                        </div>
                    </div>
                </article>
            @endforeach
        </div>
    </section>

    {{-- ARTICLES --}}
    <section class="container mx-auto px-4 mt-14 md:mt-20 mb-20">
        <div class="flex items-end justify-between gap-4">
            <div>
                <h2 class="text-2xl md:text-3xl font-bold tracking-tight">Artikel Pilihan</h2>
                <p class="text-gray-600 mt-1">Bacaan singkat untuk menambah wawasan.</p>
            </div>
            <div class="hidden sm:block">
                <a @php $articlesIndexUrl = Route::has('articles.index') ? route('articles.index') : '#'; @endphp href="{{ $articlesIndexUrl }}" class="text-sm font-semibold text-green-700 hover:text-green-800">Semua Artikel →</a>
            </div>
        </div>
        <div class="mt-6 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($featuredArticles as $article)
                <article class="rounded-2xl overflow-hidden ring-1 ring-gray-100 bg-white shadow-sm hover:shadow-md transition-shadow" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                    <div class="p-5 md:p-6">
                        <h3 class="font-semibold text-lg leading-tight">
                            <a @php $articleUrl = Route::has('articles.show') ? route('articles.show', $article->slug ?? $article->id ?? null) : '#'; @endphp href="{{ $articleUrl }}" class="hover:text-green-700">
                                {{ $article->title }}
                            </a>
                        </h3>
                        <p class="mt-2 text-sm text-gray-600 line-clamp-3">{{ $article->excerpt ?? '' }}</p>
                        <div class="mt-5 text-sm">
                            <a @php $articleUrl = Route::has('articles.show') ? route('articles.show', $article->slug ?? $article->id ?? null) : '#'; @endphp href="{{ $articleUrl }}" class="font-semibold text-green-700 hover:text-green-800">Baca Selengkapnya →</a>
                        </div>
                    </div>
                </article>
            @endforeach
        </div>
    </section>
</main>

{{-- Accessibility helpers (optional): add a subtle text shadow for text over images --}}
<style>
/* Ensures hero text always readable even if overlay fails */
.hero-text-shadow h1, .hero-text-shadow p { text-shadow: 0 1px 2px rgba(0,0,0,.5); }
</style>
@endsection
