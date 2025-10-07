@extends('layouts.app')
@section('title', 'Program Bidang Dakwah Masjid Salman ITB')

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

    {{-- ========================= HERO ========================= --}}
    <section
        class="relative isolate overflow-hidden bg-gradient-to-br from-emerald-700 via-emerald-600 to-emerald-700 text-white">
        <div aria-hidden="true" class="absolute -top-24 -left-24 h-64 w-64 rounded-full bg-emerald-500/30 blur-3xl"></div>
        <div aria-hidden="true" class="absolute -bottom-24 -right-24 h-64 w-64 rounded-full bg-emerald-400/20 blur-3xl"></div>

        <div class="soft-container py-16 md:py-24">
            <div class="text-center" data-aos="fade-down" data-aos-duration="800">
                <p
                    class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white/10 ring-1 ring-white/20 section-badge text-sm">
                    <span>{{ date('d F Y') }}</span>
                </p>
                <h1 class="mt-4 text-4xl md:text-5xl font-extrabold leading-tight">Program & Kegiatan</h1>
                <p class="mt-4 text-white/90 max-w-3xl mx-auto text-lg">
                    Menebarkan cahaya ilmu dan keimanan melalui program-program unggulan Bidang Dakwah Masjid Salman ITB
                    untuk membangun peradaban Islami yang berdampak
                </p>
            </div>
        </div>
    </section>

    {{-- ========================= BREADCRUMB ========================= --}}
    <div class="bg-white shadow-sm border-b border-gray-100">
        <div class="soft-container">
            <nav class="flex py-3 text-sm" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3">
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
                            <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            <span class="ml-1 text-emerald-600 font-medium md:ml-2">Program & Kegiatan</span>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>
    </div>

    {{-- ========================= PROGRAM SECTION ========================= --}}
    <section class="py-16 bg-gray-50">
        <div class="soft-container">
            <div class="text-center mb-12" data-aos="fade-down">
                <span
                    class="inline-flex px-3 py-1 rounded-full bg-emerald-100 text-emerald-700 section-badge text-xs">EKSPLORASI
                    PROGRAM</span>
                <h2 class="mt-3 text-3xl md:text-4xl font-bold tracking-tight">Pilih Program Terbaik Untuk Anda</h2>
                <div class="mt-4 h-1 w-20 bg-gradient-to-r from-emerald-600 to-emerald-500 mx-auto rounded-full"></div>
                <p class="mt-4 text-gray-600 max-w-2xl mx-auto text-lg">
                    Temukan program yang sesuai dengan kebutuhan spiritual dan intelektual Anda
                </p>
            </div>

            <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($programs as $program)
                    <article class="card  rounded-2xl bg-white shadow-sm hover:shadow-xl transition overflow-hidden"
                        data-aos="zoom-in" data-aos-delay="{{ $loop->index * 80 }}">
                        <a href="{{ route('programs.show', $program->slug) }}" class="block">
                            <div class="relative overflow-hidden">
                                <img class="card-image w-full h-56 object-cover"
                                    src="{{ Storage::url($program->featured_image) }}" alt="{{ $program->title }}">
                                <div class="absolute inset-0 bg-gradient-to-t from-black/40 via-transparent"></div>
                                <div class="absolute top-4 left-4">
                                    <div
                                        class="inline-flex items-center justify-center w-12 h-12 rounded-full bg-white/90 text-emerald-600">
                                        <i
                                            class="fas fa-{{ ['mosque', 'book-open', 'users', 'hands-helping', 'graduation-cap', 'hand-holding-droplet'][$loop->index % 6] }} text-xl"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="p-6">
                                <h3 class="text-xl font-semibold">{{ $program->title }}</h3>
                                <p class="mt-2 text-gray-600 text-sm leading-relaxed">
                                    {{ Str::limit($program->description, 120) }}
                                </p>
                                <div class="mt-4 flex items-center justify-between">
                                    <span class="inline-flex items-center text-emerald-700 font-semibold text-sm">
                                        Lihat Program
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                            class="w-4 h-4 ml-1">
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
    </section>

    {{-- ========================= FEATURED ACTIVITIES ========================= --}}
    @if ($featuredActivities->count() > 0)
        <section class="py-16 bg-white relative overflow-hidden">
            <div aria-hidden="true" class="absolute -right-24 -top-24 h-96 w-96 rounded-full bg-emerald-100/50 blur-3xl">
            </div>
            <div aria-hidden="true" class="absolute -left-24 -bottom-24 h-96 w-96 rounded-full bg-emerald-100/50 blur-3xl">
            </div>

            <div class="soft-container relative">
                <div class="text-center mb-12" data-aos="fade-down">
                    <span
                        class="inline-flex px-3 py-1 rounded-full bg-amber-100 text-amber-700 section-badge text-xs">DIREKOMENDASIKAN</span>
                    <h2 class="mt-3 text-3xl md:text-4xl font-bold tracking-tight">Kegiatan Unggulan</h2>
                    <div class="mt-4 h-1 w-20 bg-gradient-to-r from-emerald-600 to-emerald-500 mx-auto rounded-full"></div>
                    <p class="mt-4 text-gray-600 max-w-2xl mx-auto text-lg">
                        Kegiatan pilihan yang dirancang untuk memaksimalkan manfaat bagi Anda dan masyarakat
                    </p>
                </div>

                <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach ($featuredActivities as $activity)
                        <article class="card  rounded-2xl bg-white shadow-sm hover:shadow-xl transition overflow-hidden"
                            data-aos="fade-up" data-aos-delay="{{ $loop->index * 80 }}">
                            <div class="relative">
                                <img src="{{ Storage::url($activity->featured_image) }}" alt="{{ $activity->title }}"
                                    class="card-image w-full h-56 object-cover">
                                <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent"></div>
                                <div class="absolute top-4 left-4">
                                    <span
                                        class="inline-flex items-center gap-1 bg-emerald-500 text-white px-3 py-1 rounded-full text-xs font-semibold">
                                        {{ $activity->program->title }}
                                    </span>
                                </div>
                                <div class="absolute bottom-4 left-4 right-4">
                                    <h3 class="text-xl font-bold text-white">{{ $activity->title }}</h3>
                                    @if ($activity->start_date)
                                        <div class="flex items-center text-white/90 text-sm mt-2">
                                            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                                    clip-rule="evenodd"></path>
                                            </svg>
                                            {{ \Carbon\Carbon::parse($activity->start_date)->format('d M Y') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="p-6">
                                <p class="text-gray-600 text-sm leading-relaxed">
                                    {{ Str::limit($activity->description, 120) }}
                                </p>
                                @if ($activity->location)
                                    <div class="flex items-center text-gray-500 text-sm mt-3">
                                        <svg class="w-4 h-4 mr-2 text-emerald-500" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                        {{ $activity->location }}
                                    </div>
                                @endif
                                <div class="mt-5 pt-5 border-t border-gray-200">
                                    <a href="{{ route('activities.show', $activity->slug) }}"
                                        class="inline-flex items-center justify-center gap-2 w-full px-4 py-2 rounded-xl bg-emerald-600 text-white font-semibold hover:bg-emerald-700 transition">
                                        Selengkapnya
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                            class="w-4 h-4">
                                            <path d="M13.5 4.5 21 12l-7.5 7.5M21 12H3" />
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>

                <div class="text-center mt-10" data-aos="fade-up">
                    <a href="{{ route('activities.index') }}"
                        class="inline-flex items-center gap-2 px-6 py-3 rounded-xl bg-emerald-600 text-white font-semibold hover:bg-emerald-700 transition shadow hover:shadow-md">
                        Lihat Semua Kegiatan
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5">
                            <path d="M13.5 4.5 21 12l-7.5 7.5M21 12H3" />
                        </svg>
                    </a>
                </div>
            </div>
        </section>
    @endif

    {{-- ========================= CTA ========================= --}}
    <section
        class="relative py-16 bg-gradient-to-r from-emerald-700 via-emerald-600 to-emerald-700 text-white overflow-hidden">
        <div aria-hidden="true" class="absolute inset-0 dot-pattern opacity-20"></div>
        <div class="soft-container relative">
            <div class="text-center" data-aos="fade-up">
                <h2 class="text-3xl md:text-4xl font-extrabold">Siap untuk Bergabung?</h2>
                <p class="mt-4 text-white/90 max-w-2xl mx-auto text-lg">
                    Jadilah bagian dari perjalanan membangun peradaban Islam melalui program-program dakwah yang inspiratif
                    dan bermanfaat
                </p>
                <div class="mt-8">
                    <a href="{{ route('contact') }}"
                        class="inline-flex items-center gap-2 px-6 py-3 rounded-xl bg-white text-emerald-700 font-semibold shadow hover:shadow-md transition">
                        Daftar Sekarang
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5">
                            <path d="M13.5 4.5 21 12l-7.5 7.5M21 12H3" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection
