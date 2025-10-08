@extends('layouts.app')
@section('title', 'Bidang Dakwah Masjid Salman ITB')

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

        .grid-auto-fit {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 1rem
        }

        .dot-pattern {
            background-image: radial-gradient(rgba(0, 0, 0, .06) 1px, transparent 1px);
            background-size: 16px 16px
        }
    </style>

    {{-- ========================= HERO ========================= --}}
    <section id="home"
        class="relative isolate overflow-hidden bg-gradient-to-br from-emerald-700 via-emerald-600 to-emerald-700 text-white">
        <!-- Decorative blobs -->
        <div aria-hidden="true" class="absolute -top-24 -left-24 h-64 w-64 rounded-full bg-emerald-500/30 blur-3xl"></div>
        <div aria-hidden="true" class="absolute -bottom-24 -right-24 h-64 w-64 rounded-full bg-emerald-400/20 blur-3xl"></div>

        <div class="soft-container py-16 md:py-24">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-10 items-center">
                <div data-aos="fade-right" data-aos-duration="800">
                    <p
                        class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white/10 ring-1 ring-white/20 section-badge text-sm">
                        <span class="i-lucide-sparkles"></span> Selamat datang di
                    </p>
                    <h1 class="mt-4 text-4xl md:text-5xl font-extrabold leading-tight">BIDANG DAKWAH</h1>
                    <h2 class="mt-2 text-2xl md:text-3xl font-semibold">Yayasan Pembina Masjid (YPM) Salman ITB</h2>
                    <div class="mt-6 text-white/90 prose prose-invert max-w-none">
                        {!! $landingpage->hero_subtitle !!}
                    </div>
                    <div class="mt-8 flex flex-wrap gap-3" data-aos="fade-up" data-aos-delay="200">
                        <a href="{{ route('programs.index') }}"
                            class="inline-flex items-center gap-2 rounded-xl bg-white text-emerald-700 px-5 py-3 font-semibold shadow hover:shadow-md transition">
                            Jelajahi Program
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5">
                                <path d="M13.5 4.5 21 12l-7.5 7.5m7.5-7.5H3" />
                            </svg>
                        </a>
                        <a href="#kegiatan"
                            class="inline-flex items-center gap-2 rounded-xl ring-1 ring-white/40 px-5 py-3 font-semibold hover:bg-white/10 transition">
                            Lihat Kegiatan
                        </a>
                    </div>
                </div>
                <div class="relative" data-aos="fade-left" data-aos-duration="800" data-aos-delay="100">
                    <div class="glass rounded-2xl p-2 ">
                        <img src="{{ $landingpage ? Storage::url($landingpage->hero_image) : asset('bd.jpg') }}"
                            alt="Hero" class="card-image w-full aspect-square object-cover rounded-2xl" />
                    </div>
                </div>
            </div>

            {{-- Quick stats (animated) --}}
            <div class="mt-12 grid grid-cols-2 md:grid-cols-4 gap-4" data-aos="fade-up">
                <div class="glass rounded-2xl p-6 text-center">
                    <p class="text-4xl font-extrabold" x-data="{ c: 0, t: 0 }" x-init="let end = {{ (int) ($landingpage->stats1_count ?? 0) }};
                    const step = Math.max(1, Math.floor(end / 60));
                    t = setInterval(() => {
                        c += step;
                        if (c >= end) {
                            c = end;
                            clearInterval(t)
                        }
                    }, 20)"><span
                            x-text="c">0</span>+</p>
                    <p class="text-sm opacity-80 mt-1">{{ $landingpage->stats1 }}</p>
                </div>
                <div class="glass rounded-2xl p-6 text-center">
                    <p class="text-4xl font-extrabold" x-data="{ c: 0, t: 0 }" x-init="let end = {{ (int) ($landingpage->stats2_count ?? 0) }};
                    const step = Math.max(1, Math.floor(end / 60));
                    t = setInterval(() => {
                        c += step;
                        if (c >= end) {
                            c = end;
                            clearInterval(t)
                        }
                    }, 20)"><span
                            x-text="c">0</span>+</p>
                    <p class="text-sm opacity-80 mt-1">{{ $landingpage->stats2 }}</p>
                </div>
                <div class="glass rounded-2xl p-6 text-center">
                    <p class="text-4xl font-extrabold" x-data="{ c: 0, t: 0 }" x-init="let end = {{ (int) ($landingpage->stats3_count ?? 0) }};
                    const step = Math.max(1, Math.floor(end / 60));
                    t = setInterval(() => {
                        c += step;
                        if (c >= end) {
                            c = end;
                            clearInterval(t)
                        }
                    }, 20)"><span
                            x-text="c">0</span>+</p>
                    <p class="text-sm opacity-80 mt-1">{{ $landingpage->stats3 }}</p>
                </div>
                <div class="glass rounded-2xl p-6 text-center">
                    <p class="text-4xl font-extrabold" x-data="{ c: 0, t: 0 }" x-init="let end = {{ (int) ($landingpage->stats4_count ?? 0) }};
                    const step = Math.max(1, Math.floor(end / 60));
                    t = setInterval(() => {
                        c += step;
                        if (c >= end) {
                            c = end;
                            clearInterval(t)
                        }
                    }, 20)"><span
                            x-text="c">0</span>+</p>
                    <p class="text-sm opacity-80 mt-1">{{ $landingpage->stats4 }}</p>
                </div>
            </div>
        </div>
    </section>

    {{-- ========================= KELAS MENDATANG (QUERY DI VIEW DIPERTAHANKAN) ========================= --}}
    @php
        $upcomingPrograms = App\Models\Activity::with([
            'batches' => function ($query) {
                $query
                    ->where('status', 'aktif')
                    ->where(function ($q) {
                        $q->where('tanggal_mulai_pendaftaran', '>=', now())->orWhere(
                            'tanggal_selesai_pendaftaran',
                            '>=',
                            now(),
                        );
                    })
                    ->orderBy('tanggal_mulai_pendaftaran');
            },
        ])
            ->where('status', 'published')
            ->whereHas('batches', function ($query) {
                $query->where('status', 'aktif')->where('tanggal_selesai_pendaftaran', '>=', now());
            })
            ->get();
    @endphp

    <section class="py-16 bg-gray-50">
        <div class="soft-container">
            <div class="text-center mb-12" data-aos="fade-down">
                <span class="inline-flex px-3 py-1 rounded-full bg-violet-100 text-violet-700 section-badge text-xs">KELAS
                    MENDATANG</span>
                <h2 class="mt-3 text-3xl md:text-4xl font-bold tracking-tight">Jadwal Pendaftaran Terdekat</h2>
                <div class="mt-4 h-1 w-20 bg-gradient-to-r from-violet-600 to-violet-500 mx-auto rounded-full"></div>
                <p class="mt-4 text-gray-600 max-w-2xl mx-auto">Daftarkan diri Anda pada batch yang masih dibuka.</p>
            </div>

            <div class="space-y-4">
                @forelse($upcomingPrograms as $program)
                    @foreach ($program->batches as $batch)
                        <div class=" rounded-2xl bg-white p-6 shadow-sm hover:shadow-lg transition" data-aos="fade-up"
                            data-aos-delay="{{ $loop->parent->index * 100 + $loop->index * 50 }}">
                            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
                                <div class="flex-1">
                                    <p class="text-sm text-emerald-600 font-medium mb-1">{{ $program->title }}</p>
                                    <h3 class="text-xl font-bold text-gray-900">
                                        Batch {{ $batch->batch_ke ?? $loop->iteration }}
                                    </h3>
                                </div>

                                <div class="flex flex-wrap gap-2 lg:gap-3">
                                    <span
                                        class="inline-flex items-center gap-2 rounded-full bg-emerald-50 text-emerald-700 px-4 py-2 font-medium text-sm">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                        Buka: {{ $batch->tanggal_mulai_pendaftaran->format('d M Y') }}
                                    </span>
                                    <span
                                        class="inline-flex items-center gap-2 rounded-full bg-rose-50 text-rose-700 px-4 py-2 font-medium text-sm">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                        Tutup: {{ $batch->tanggal_selesai_pendaftaran->format('d M Y') }}
                                    </span>
                                </div>

                                <div class="lg:ml-4">
                                    <a href="{{ route('activities.show', $program->slug) }}"
                                        class="inline-flex items-center justify-center gap-2 px-5 py-2.5 rounded-xl bg-emerald-600 text-white font-semibold hover:bg-emerald-700 transition shadow hover:shadow-md w-full lg:w-auto">
                                        Detail
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                            class="w-4 h-4">
                                            <path d="M13.5 4.5 21 12l-7.5 7.5M21 12H3" />
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @empty
                    <div class="text-center py-12">
                        <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-gray-100 mb-4">
                            <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                </path>
                            </svg>
                        </div>
                        <p class="text-gray-500 text-lg">Belum ada jadwal pendaftaran yang tersedia.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    {{-- ========================= ARTIKEL & BERITA ========================= --}}
    <section class="py-16 bg-white">
        <div class="soft-container">
            <div class="grid lg:grid-cols-5 gap-10 items-start">
                <div class="lg:col-span-3">
                    <div class="mb-6">
                        <span
                            class="inline-flex px-3 py-1 rounded-full bg-blue-100 text-blue-700 section-badge text-xs">ARTIKEL
                            PILIHAN</span>
                        <h2 class="mt-3 text-3xl font-bold">Wawasan & Tadabbur</h2>
                    </div>
                    <div class="grid gap-6 sm:grid-cols-2">
                        @foreach ($featuredArticles as $article)
                            <article
                                class="card  rounded-2xl bg-white shadow-sm hover:shadow-xl transition overflow-hidden"
                                data-aos="zoom-in" data-aos-delay="{{ $loop->index * 80 }}">
                                <a href="{{ route('articles.show', $article->slug) }}" class="block">
                                    <img src="{{ Storage::url($article->featured_image) ?? 'https://picsum.photos/600/400' }}"
                                        alt="{{ $article->title }}" class="card-image w-full h-44 object-cover">
                                    <div class="p-5">
                                        <p class="text-xs text-gray-500">{{ $article->published_at->format('d M Y') }}</p>
                                        <h3 class="mt-1 text-lg font-semibold">{{ $article->title }}</h3>
                                        <p class="mt-2 text-gray-600 text-sm">{{ Str::limit($article->content, 100) }}</p>
                                        <span
                                            class="mt-3 inline-flex items-center gap-2 text-emerald-700 font-semibold">Read
                                            More</span>
                                    </div>
                                </a>
                            </article>
                        @endforeach
                    </div>
                </div>
                <div class="lg:col-span-2">
                    <div class="mb-6">
                        <span
                            class="inline-flex px-3 py-1 rounded-full bg-blue-100 text-blue-700 section-badge text-xs">BERITA
                            TERBARU</span>
                        <h2 class="mt-3 text-3xl font-bold">Kabar Salman</h2>
                    </div>
                    <div class="space-y-5">
                        @foreach ($latestNews as $news)
                            <article class=" rounded-2xl bg-white shadow-sm hover:shadow-md transition overflow-hidden"
                                data-aos="fade-left" data-aos-delay="{{ $loop->index * 80 }}">
                                <a href="{{ route('news.show', $news->slug) }}" class="flex gap-4">
                                    <img src="{{ Storage::url($news->featured_image) ?? 'https://picsum.photos/320/240' }}"
                                        alt="{{ $news->title }}"
                                        class="card-image w-32 h-24 md:w-36 md:h-28 object-cover rounded-xl">
                                    <div class="py-3 pr-4">
                                        <p class="text-xs text-gray-500">{{ $news->published_at->format('d M Y') }}</p>
                                        <h3 class="text-base font-semibold leading-snug">{{ $news->title }}</h3>
                                        <p class="mt-1 text-gray-600 line-clamp-2 text-sm">{!! Str::limit($news->content, 100) !!}</p>
                                    </div>
                                </a>
                            </article>
                        @endforeach
                    </div>
                    <div class="mt-6">
                        <a href="{{ route('news.index') }}"
                            class="inline-flex items-center gap-2 text-emerald-700 font-semibold">Lihat semua berita</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ========================= PROGRAM UNGGULAN ========================= --}}
    <section id="program" class="py-16 bg-gray-50">
        <div class="soft-container">
            <div class="text-center mb-10" data-aos="fade-down">
                <span
                    class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-emerald-100 text-emerald-700 section-badge text-xs">PROGRAM
                    UNGGULAN</span>
                <h2 class="mt-3 text-3xl md:text-4xl font-bold tracking-tight">Pilih Program Terbaik Untuk Anda</h2>
                <p class="mt-3 text-gray-600 max-w-3xl mx-auto">Beberapa program pilihan yang paling diminati jamaah.
                    Temukan materi, jadwal, dan batch aktifnya.</p>
            </div>

            <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($featuredPrograms as $program)
                    <article class="card  rounded-2xl bg-white shadow-sm hover:shadow-xl transition overflow-hidden"
                        data-aos="zoom-in" data-aos-delay="{{ $loop->index * 80 }}">
                        <a href="{{ route('programs.show', $program->slug) }}" class="block">
                            <div class="relative overflow-hidden">
                                <img class="card-image w-full h-56 object-cover"
                                    src="{{ Storage::url($program->featured_image) ?? 'https://picsum.photos/600/400' }}"
                                    alt="{{ $program->title }}">
                                <div class="absolute inset-0 bg-gradient-to-t from-black/40 via-transparent"></div>
                            </div>
                            <div class="p-6">
                                <h3 class="text-xl font-semibold">{{ $program->title }}</h3>
                                <p class="mt-2 text-gray-600 text-sm">{{ Str::limit($program->description, 120) }}</p>
                                <div class="mt-4 flex items-center justify-between">
                                    <span class="inline-flex items-center text-emerald-700 font-semibold">Detail
                                        Program</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                        class="w-5 h-5 text-emerald-700">
                                        <path d="M13.5 4.5 21 12l-7.5 7.5M21 12H3" />
                                    </svg>
                                </div>
                            </div>
                        </a>
                    </article>
                @endforeach
            </div>

            <div class="text-center mt-10" data-aos="fade-up">
                <a href="{{ route('programs.index') }}"
                    class="inline-flex items-center gap-2 px-5 py-3 rounded-xl bg-emerald-600 text-white font-semibold hover:bg-emerald-700 transition">Lihat
                    Semua Program</a>
            </div>
        </div>
    </section>

    {{-- ========================= KEGIATAN (DENGAN BATCH) ========================= --}}
    <section id="kegiatan" class="py-16 bg-white">
        <div class="soft-container">
            <div class="flex items-end justify-between mb-8">
                <div>
                    <span
                        class="inline-flex px-3 py-1 rounded-full bg-sky-100 text-sky-700 section-badge text-xs">KEGIATAN</span>
                    <h2 class="mt-3 text-3xl md:text-4xl font-bold">Kegiatan & Kelas Aktif</h2>
                    <p class="mt-2 text-gray-600">Ikuti kelas yang sedang berjalan atau jadwalkan diri untuk batch
                        mendatang.</p>
                </div>
            </div>

            <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                @forelse($activities as $activity)
                    <div class="card  rounded-2xl bg-white shadow-sm hover:shadow-xl transition overflow-hidden"
                        data-aos="fade-up" data-aos-delay="{{ $loop->index * 80 }}">
                        <div class="relative">
                            <img src="{{ Storage::url($activity->featured_image) }}" alt="{{ $activity->title }}"
                                class="card-image w-full h-56 object-cover">
                            @if ($activity->is_featured)
                                <span
                                    class="absolute top-4 left-4 inline-flex items-center gap-1 bg-amber-400 text-black px-3 py-1 rounded-full text-xs font-semibold">Unggulan</span>
                            @endif
                        </div>
                        <div class="p-6">
                            <h3 class="text-lg font-semibold">{{ $activity->title }}</h3>

                            @php
                                $activeBatch = $activity->getActiveBatch();
                                $upcomingBatches = $activity->getUpcomingBatches();
                            @endphp

                            <div class="mt-3 space-y-2 text-sm">
                                @if ($activeBatch)
                                    <div class="flex items-center justify-between rounded-lg bg-emerald-50 px-3 py-2">
                                        <span class="font-medium text-emerald-700">Pendaftaran Dibuka</span>
                                        <span
                                            class="text-emerald-700">{{ $activeBatch->tanggal_mulai_pendaftaran->format('d M Y') }}
                                            – {{ $activeBatch->tanggal_selesai_pendaftaran->format('d M Y') }}</span>
                                    </div>
                                @endif
                                @if ($upcomingBatches && $upcomingBatches->count())
                                    <div class="rounded-lg bg-gray-50 px-3 py-2">
                                        <p class="text-gray-700 font-medium">Batch Mendatang</p>
                                        <ul class="mt-1 grid-auto-fit">
                                            @foreach ($upcomingBatches as $batch)
                                                <li class="flex items-center justify-between text-gray-600">
                                                    <span>Batch {{ $batch->batch_number ?? $loop->iteration }}</span>
                                                    <span
                                                        class="text-xs">{{ $batch->tanggal_mulai_pendaftaran->format('d M') }}
                                                        – {{ $batch->tanggal_selesai_pendaftaran->format('d M Y') }}</span>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                            </div>

                            <div class="mt-5 flex items-center justify-between">
                                <a href="{{ route('activities.show', $activity->slug) }}"
                                    class="inline-flex items-center gap-2 font-semibold text-emerald-700 hover:text-emerald-800">Detail
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                        class="w-4 h-4">
                                        <path d="M13.5 4.5 21 12l-7.5 7.5M21 12H3" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center text-gray-500">Belum ada kegiatan untuk saat ini.</div>
                @endforelse
            </div>
        </div>
    </section>



    {{-- ========================= CTA ========================= --}}
    <section
        class="relative py-16 bg-gradient-to-r from-emerald-700 via-emerald-600 to-emerald-700 text-white overflow-hidden">
        <div aria-hidden="true" class="absolute inset-0 dot-pattern opacity-20"></div>
        <div class="soft-container relative">
            <div class="grid md:grid-cols-2 gap-6 items-center">
                <div data-aos="fade-right">
                    <h2 class="text-3xl md:text-4xl font-extrabold">Siap Bertumbuh Bersama Komunitas?</h2>
                    <p class="mt-2 text-white/90">Ikuti kelas, kajian, dan program pembinaan yang dirancang untuk
                        meningkatkan kualitas keislaman serta kontribusi sosial Anda.</p>
                </div>
                <div class="flex md:justify-end" data-aos="fade-left">
                    <a href="{{ route('programs.index') }}"
                        class="inline-flex items-center gap-2 px-6 py-3 rounded-xl bg-white text-emerald-700 font-semibold shadow hover:shadow-md transition">Mulai
                        Ikut Program</a>
                </div>
            </div>
        </div>
    </section>
@endsection
