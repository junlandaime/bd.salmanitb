@extends('layouts.app')
@section('title', 'Kegiatan Bidang Dakwah Masjid Salman ITB')

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

        <div class="soft-container py-20 md:py-28">
            <div class="text-center" data-aos="fade-down">
                <p
                    class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white/10 ring-1 ring-white/20 section-badge text-sm">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.762zM9.3 16.573A9.026 9.026 0 007 14.935v-3.957l1.818.78a3 3 0 002.364 0l5.508-2.361a11.026 11.026 0 01.25 3.762 1 1 0 01-.89.89 8.968 8.968 0 00-5.35 2.524 1 1 0 01-1.4 0zM6 18a1 1 0 001-1v-2.065a8.935 8.935 0 00-2-.712V17a1 1 0 001 1z" />
                    </svg>
                    Kegiatan Kami
                </p>
                <h1 class="mt-4 text-4xl md:text-5xl font-extrabold leading-tight">Kegiatan & Kelas Aktif</h1>
                <p class="mt-4 text-lg text-white/90 max-w-2xl mx-auto">
                    Temukan berbagai kegiatan menarik yang dirancang untuk pengembangan diri dan kontribusi positif bagi
                    masyarakat.
                </p>
            </div>
        </div>
    </section>

    {{-- ========================= BREADCRUMB ========================= --}}
    <div class="bg-white shadow-sm border-b border-gray-100">
        <div class="soft-container">
            <nav class="flex py-3 text-sm">
                <ol class="inline-flex items-center space-x-2">
                    <li class="inline-flex items-center">
                        <a href="{{ route('home') }}"
                            class="inline-flex items-center text-gray-600 hover:text-emerald-600 transition">
                            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z">
                                </path>
                            </svg>
                            Home
                        </a>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            <span class="ml-2 text-emerald-600 font-medium">Kegiatan</span>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>
    </div>

    {{-- ========================= FILTER & CONTENT ========================= --}}
    <section class="py-16 bg-gray-50">
        <div class="soft-container">
            {{-- Section Header --}}
            <div class="text-center mb-10" data-aos="fade-down">
                <span
                    class="inline-flex px-3 py-1 rounded-full bg-sky-100 text-sky-700 section-badge text-xs">EKSPLORASI</span>
                <h2 class="mt-3 text-3xl md:text-4xl font-bold tracking-tight">Semua Kegiatan</h2>
                <div class="mt-4 h-1 w-20 bg-gradient-to-r from-emerald-600 to-emerald-400 mx-auto rounded-full"></div>
                <p class="mt-4 text-gray-600 max-w-2xl mx-auto">
                    Berbagai kegiatan untuk mengembangkan potensi dan memberikan dampak positif bagi masyarakat.
                </p>
            </div>

            {{-- Filter Pills --}}
            <div class="flex flex-wrap justify-center gap-3 mb-12" data-aos="fade-up">
                <a href="{{ route('activities.index') }}"
                    class="px-5 py-2.5 rounded-full {{ !request('program') ? 'bg-emerald-600 text-white shadow-md' : 'bg-white text-gray-700 hover:bg-gray-50' }} font-medium transition">
                    Semua
                </a>
                @foreach ($programs ?? [] as $program)
                    <a href="{{ route('activities.index', ['program' => $program->slug]) }}"
                        class="px-5 py-2.5 rounded-full {{ request('program') == $program->slug ? 'bg-emerald-600 text-white shadow-md' : 'bg-white text-gray-700 hover:bg-gray-50' }} font-medium transition">
                        {{ $program->title }}
                    </a>
                @endforeach
            </div>

            {{-- Activities Grid --}}
            <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                @forelse($activities as $activity)
                    <article class="card  rounded-2xl bg-white shadow-sm hover:shadow-xl transition overflow-hidden"
                        data-aos="zoom-in" data-aos-delay="{{ $loop->index * 80 }}">
                        <div class="relative">
                            <img src="{{ Storage::url($activity->featured_image) }}" alt="{{ $activity->title }}"
                                class="card-image w-full h-56 object-cover">

                            {{-- Featured Badge --}}
                            @if ($activity->is_featured)
                                <span
                                    class="absolute top-4 left-4 inline-flex items-center gap-1 bg-amber-400 text-black px-3 py-1 rounded-full text-xs font-semibold">
                                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                    </svg>
                                    Unggulan
                                </span>
                            @endif

                            <div class="absolute inset-0 bg-gradient-to-t from-black/40 via-transparent"></div>
                        </div>

                        <div class="p-6">
                            {{-- Program Badge --}}
                            <div class="mb-3">
                                <span class="px-3 py-1 text-xs font-semibold bg-gray-100 text-gray-800 rounded-full">
                                    {{ $activity->program->title }}
                                </span>
                            </div>

                            {{-- Activity Title --}}
                            <h3 class="text-xl font-semibold text-gray-900 mb-3 line-clamp-2">{{ $activity->title }}</h3>

                            {{-- Activity Overview --}}
                            <p class="text-gray-600 text-sm mb-4 line-clamp-3">{{ $activity->overview }}</p>

                            {{-- Activity Highlights --}}
                            @if ($activity->highlights->isNotEmpty())
                                <div class="flex flex-wrap gap-2 mb-4">
                                    @foreach ($activity->highlights->take(3) as $highlight)
                                        <span
                                            class="text-xs px-2.5 py-1 bg-emerald-50 text-emerald-700 rounded-lg font-medium">
                                            {{ $highlight->title }}
                                        </span>
                                    @endforeach
                                </div>
                            @endif

                            {{-- Batch Status --}}
                            @php
                                $activeBatch = $activity->getActiveBatch();
                                $upcomingBatches = $activity->getUpcomingBatches();
                            @endphp

                            <div class="mb-4 space-y-2 text-sm">
                                @if ($activeBatch)
                                    <div class="flex items-center justify-between rounded-lg bg-emerald-50 px-3 py-2">
                                        <span class="font-medium text-emerald-700">Pendaftaran Dibuka</span>
                                    </div>
                                @elseif($upcomingBatches && $upcomingBatches->count())
                                    <div class="flex items-center justify-between rounded-lg bg-amber-50 px-3 py-2">
                                        <span class="font-medium text-amber-700">Akan Dibuka</span>
                                    </div>
                                @else
                                    <div class="flex items-center justify-between rounded-lg bg-gray-50 px-3 py-2">
                                        <span class="font-medium text-gray-600">Nantikan Batch Selanjutnya</span>
                                    </div>
                                @endif
                            </div>

                            {{-- Action Button --}}
                            <div class="flex items-center justify-between pt-2 border-t border-gray-100">
                                <a href="{{ route('activities.show', $activity->slug) }}"
                                    class="inline-flex items-center gap-2 font-semibold text-emerald-700 hover:text-emerald-800 transition">
                                    Detail
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13.5 4.5 21 12l-7.5 7.5M21 12H3" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </article>
                @empty
                    <div class="col-span-full py-16 text-center" data-aos="fade-up">
                        <svg class="w-20 h-20 mx-auto text-gray-300" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <h3 class="mt-6 text-xl font-semibold text-gray-900">Tidak Ada Kegiatan</h3>
                        <p class="mt-2 text-gray-600">Saat ini belum ada kegiatan yang tersedia.</p>
                    </div>
                @endforelse
            </div>

            {{-- Pagination --}}
            @if ($activities->hasPages())
                <div class="mt-12" data-aos="fade-up">
                    {{ $activities->links() }}
                </div>
            @endif
        </div>
    </section>

    {{-- ========================= CTA ========================= --}}
    <section
        class="relative py-16 bg-gradient-to-r from-emerald-700 via-emerald-600 to-emerald-700 text-white overflow-hidden">
        <div aria-hidden="true" class="absolute inset-0 dot-pattern opacity-20"></div>
        <div class="soft-container relative">
            <div class="text-center max-w-3xl mx-auto" data-aos="fade-up">
                <h2 class="text-3xl md:text-4xl font-extrabold mb-4">Ingin Tahu Lebih Banyak?</h2>
                <p class="text-lg text-white/90 mb-8">
                    Kami memiliki berbagai program dan kegiatan yang dirancang untuk mengembangkan potensi dan memberikan
                    dampak positif.
                </p>
                <div class="flex flex-wrap justify-center gap-4">
                    <a href="{{ route('programs.index') }}"
                        class="inline-flex items-center gap-2 px-6 py-3 rounded-xl bg-white text-emerald-700 font-semibold shadow hover:shadow-md transition">
                        Lihat Program Kami
                    </a>
                    <a href="{{ route('contact') }}"
                        class="inline-flex items-center gap-2 px-6 py-3 rounded-xl ring-2 ring-white/40 font-semibold hover:bg-white/10 transition">
                        Hubungi Kami
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection
