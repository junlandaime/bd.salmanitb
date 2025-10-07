@extends('layouts.app')

@section('title', $activity->title . ' - Program Bidang Dakwah Masjid Salman ITB')
@section('meta_description', Str::limit($activity->description, 160))
@section('og_title', $activity->title . ' - Program Bidang Dakwah Masjid Salman ITB')
@section('og_description', Str::limit($activity->description, 200))
@section('og_image', 'https://bidangdakwah.salmanitb.com/storage/' . $activity->featured_image)

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

        .pulse-glow {
            animation: pulse-glow 2s ease-in-out infinite;
        }

        @keyframes pulse-glow {

            0%,
            100% {
                box-shadow: 0 0 20px rgba(16, 185, 129, 0.4);
            }

            50% {
                box-shadow: 0 0 40px rgba(16, 185, 129, 0.6);
            }
        }
    </style>

    @php
        $registrationStatus = [
            'closed' => !$activeBatch && $upcomingBatches->isEmpty(),
            'upcoming' => !$activeBatch && $upcomingBatches->isNotEmpty(),
            'open' =>
                $activeBatch &&
                now()->between($activeBatch->tanggal_mulai_pendaftaran, $activeBatch->tanggal_selesai_pendaftaran),
            'ending_soon' =>
                $activeBatch &&
                now()->between(
                    $activeBatch->tanggal_selesai_pendaftaran->subDays(7),
                    $activeBatch->tanggal_selesai_pendaftaran,
                ),
        ];
    @endphp

    {{-- ========================= HERO ========================= --}}
    <section
        class="relative isolate overflow-hidden bg-gradient-to-br from-emerald-700 via-emerald-600 to-emerald-700 text-white">
        <!-- Background Image Overlay -->
        <div class="absolute inset-0 z-0">
            <img src="{{ Storage::url($activity->featured_image) }}" alt="{{ $activity->title }}"
                class="w-full h-full object-cover opacity-20">
        </div>

        <!-- Decorative blobs -->
        <div aria-hidden="true" class="absolute -top-24 -left-24 h-64 w-64 rounded-full bg-emerald-500/30 blur-3xl"></div>
        <div aria-hidden="true" class="absolute -bottom-24 -right-24 h-64 w-64 rounded-full bg-emerald-400/20 blur-3xl"></div>

        <div class="soft-container relative z-10 py-20 md:py-32">
            <div class="text-center max-w-4xl mx-auto">
                {{-- Activity Title with typing effect --}}
                <h1 class="text-4xl md:text-6xl font-extrabold leading-tight mb-6" data-aos="fade-down">
                    {{ $activity->title }}
                </h1>

                {{-- Registration Status Cards --}}
                <div class="mt-10" data-aos="fade-up" data-aos-delay="200">
                    @if ($registrationStatus['open'] || $registrationStatus['ending_soon'])
                        <div class="glass rounded-2xl p-8  {{ $registrationStatus['ending_soon'] ? 'pulse-glow' : '' }}">
                            {{-- Batch Image --}}
                            @if ($activeBatch->featured_image)
                                <div class="mb-6">
                                    <img src="{{ Storage::url($activeBatch->featured_image) }}"
                                        alt="{{ $activeBatch->nama_batch }}"
                                        class="w-full max-w-md mx-auto rounded-xl shadow-lg">
                                </div>
                            @endif

                            {{-- Batch Info --}}
                            <div class="flex items-center justify-center gap-3 mb-6">
                                <h2 class="text-xl md:text-2xl font-bold">
                                    Batch {{ $activeBatch->batch_ke }} - {{ $activeBatch->nama_batch }}
                                </h2>
                                @if ($registrationStatus['ending_soon'])
                                    <span
                                        class="px-4 py-2 bg-amber-400 text-black rounded-full text-sm font-bold animate-pulse">
                                        Segera Ditutup!
                                    </span>
                                @else
                                    <span class="px-4 py-2 bg-emerald-400 text-emerald-900 rounded-full text-sm font-bold">
                                        Dibuka
                                    </span>
                                @endif
                            </div>

                            {{-- Stats Grid --}}
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
                                <div class="bg-emerald-500 rounded-xl p-4 backdrop-blur-sm">
                                    <p class="text-sm text-white/80 mb-1">Investasi</p>
                                    <p class="text-2xl font-extrabold">
                                        Rp {{ number_format($activeBatch->harga, 0, ',', '.') }}
                                    </p>
                                </div>
                                <div class="bg-emerald-500 rounded-xl p-4 backdrop-blur-sm">
                                    <p class="text-sm text-white/80 mb-1">Sisa Kuota</p>
                                    <p class="text-2xl font-extrabold">{{ $activeBatch->kuota }} Peserta</p>
                                </div>
                                <div class="bg-emerald-500 rounded-xl p-4 backdrop-blur-sm">
                                    <p class="text-sm text-white/80 mb-1">Batas Pendaftaran</p>
                                    <p class="text-lg font-bold">
                                        {{ $activeBatch->tanggal_selesai_pendaftaran->format('d M Y') }}
                                    </p>
                                </div>
                            </div>

                            {{-- CTA Button --}}
                            <a href="{{ $activeBatch->external_link }}" target="_blank"
                                class="inline-flex items-center gap-2 px-8 py-4 rounded-xl bg-white text-emerald-700 font-bold text-lg shadow-xl hover:shadow-2xl hover:scale-105 transition-all duration-300">
                                @if ($registrationStatus['ending_soon'])
                                    DAFTAR SEKARANG - KUOTA TERBATAS
                                @else
                                    DAFTAR SEKARANG
                                @endif
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 7l5 5m0 0l-5 5m5-5H6" />
                                </svg>
                            </a>
                        </div>
                    @elseif ($registrationStatus['upcoming'])
                        <div class="glass rounded-2xl p-8 ">
                            {{-- Upcoming Batch Image --}}
                            @if ($upcomingBatches->first()->featured_image)
                                <div class="mb-6">
                                    <img src="{{ Storage::url($upcomingBatches->first()->featured_image) }}"
                                        alt="{{ $upcomingBatches->first()->nama_batch }}"
                                        class="w-full max-w-md mx-auto rounded-xl shadow-lg">
                                </div>
                            @endif

                            <div class="inline-flex items-center gap-3 px-6 py-3 bg-amber-400 text-black rounded-full mb-4">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                <span class="font-bold">
                                    Dibuka {{ $upcomingBatches->first()->tanggal_mulai_pendaftaran->format('d F Y') }}
                                </span>
                            </div>

                            <p class="text-lg mb-6">Batch selanjutnya akan segera dibuka. Pantau terus untuk informasi
                                terbaru!</p>

                            <button type="button"
                                class="inline-flex items-center gap-2 px-6 py-3 rounded-xl bg-white/20 hover:bg-white/30 font-semibold transition">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                                </svg>
                                Ingatkan Saya
                            </button>
                        </div>
                    @else
                        <div class="glass rounded-2xl p-8 ">
                            <div class="inline-flex items-center gap-2 px-6 py-3 bg-gray-500 rounded-full mb-4">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span class="font-bold">Nantikan Batch Selanjutnya</span>
                            </div>

                            <p class="text-lg mb-6">{{ $activity->overview }}</p>

                            {{-- Social Media --}}
                            <p class="text-sm mb-4">Pantau media sosial kami untuk informasi batch terbaru:</p>
                            <div class="flex justify-center gap-4">
                                @if ($landingPage->social_facebook)
                                    <a href="{{ $landingPage->social_facebook }}" target="_blank"
                                        class="w-12 h-12 rounded-full bg-white/20 hover:bg-white/30 flex items-center justify-center transition">
                                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                            <path fill-rule="evenodd"
                                                d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </a>
                                @endif
                                @if ($landingPage->social_instagram)
                                    <a href="{{ $landingPage->social_instagram }}" target="_blank"
                                        class="w-12 h-12 rounded-full bg-white/20 hover:bg-white/30 flex items-center justify-center transition">
                                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                            <path fill-rule="evenodd"
                                                d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </a>
                                @endif
                                @if ($landingPage->social_twitter)
                                    <a href="{{ $landingPage->social_twitter }}" target="_blank"
                                        class="w-12 h-12 rounded-full bg-white/20 hover:bg-white/30 flex items-center justify-center transition">
                                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                            <path
                                                d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84" />
                                        </svg>
                                    </a>
                                @endif
                                @if ($landingPage->social_youtube)
                                    <a href="{{ $landingPage->social_youtube }}" target="_blank"
                                        class="w-12 h-12 rounded-full bg-white/20 hover:bg-white/30 flex items-center justify-center transition">
                                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                            <path fill-rule="evenodd"
                                                d="M19.812 5.418c.861.23 1.538.907 1.768 1.768C21.998 8.746 22 12 22 12s0 3.255-.418 4.814a2.504 2.504 0 0 1-1.768 1.768c-1.56.419-7.814.419-7.814.419s-6.255 0-7.814-.419a2.505 2.505 0 0 1-1.768-1.768C2 15.255 2 12 2 12s0-3.255.417-4.814a2.507 2.507 0 0 1 1.768-1.768C5.744 5 11.998 5 11.998 5s6.255 0 7.814.418ZM15.194 12 10 15V9l5.194 3Z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </a>
                                @endif
                            </div>
                        </div>
                    @endif
                </div>

                {{-- Scroll Indicator --}}
                <div class="mt-12 animate-bounce" data-aos="fade-up" data-aos-delay="400">
                    <svg class="w-8 h-8 mx-auto text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 14l-7 7m0 0l-7-7m7 7V3" />
                    </svg>
                </div>
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
                            <a href="{{ route('programs.show', $activity->program->slug) }}"
                                class="ml-2 text-gray-600 hover:text-emerald-600 transition">{{ $activity->program->title }}</a>
                        </div>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            <a href="{{ route('activities.index') }}"
                                class="ml-2 text-gray-600 hover:text-emerald-600 transition">Kegiatan</a>
                        </div>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            <span class="ml-2 text-emerald-600 font-medium">{{ $activity->title }}</span>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>
    </div>

    {{-- ========================= ACTIVITY OVERVIEW ========================= --}}
    <section class="py-16 bg-white">
        <div class="soft-container">
            <div class="grid md:grid-cols-2 gap-12 items-center">
                <div data-aos="fade-right">
                    @if ($activity->is_featured)
                        <span
                            class="inline-flex items-center gap-1 px-3 py-1 rounded-full bg-amber-100 text-amber-700 text-xs font-semibold mb-4">
                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                            </svg>
                            Kegiatan Unggulan
                        </span>
                    @endif

                    <span
                        class="inline-flex px-3 py-1 rounded-full bg-emerald-100 text-emerald-700 section-badge text-xs mb-3">
                        TENTANG KEGIATAN
                    </span>
                    <h2 class="text-3xl md:text-4xl font-bold mb-4">{{ $activity->title }}</h2>
                    <div class="h-1 w-20 bg-gradient-to-r from-emerald-600 to-emerald-400 rounded-full mb-6"></div>

                    <div class="prose prose-lg max-w-none text-gray-600">
                        <p class="mb-4">
                            {{ $activity->title }} adalah kegiatan unggulan di bawah Program
                            <span class="font-semibold text-emerald-600">{{ $activity->program->title }}</span>
                            dari Bidang Dakwah Masjid Salman ITB.
                        </p>
                        <div class="space-y-3">
                            {!! nl2br(e($activity->description)) !!}
                        </div>
                    </div>
                </div>

                <div data-aos="fade-left" data-aos-delay="200">
                    <div class="relative">
                        <div
                            class=" rounded-2xl overflow-hidden shadow-xl transform hover:scale-105 transition-transform duration-500">
                            <img src="{{ Storage::url($activity->featured_image) }}" alt="{{ $activity->title }}"
                                class="w-full h-full object-cover">
                        </div>
                        {{-- Decorative elements --}}
                        <div class="absolute -bottom-6 -left-6 w-24 h-24 rounded-full bg-emerald-200/50 -z-10"></div>
                        <div class="absolute -top-6 -right-6 w-20 h-20 rounded-full border-4 border-emerald-200/50 -z-10">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ========================= SECTIONS ========================= --}}
    @include('activities.section-learning-path', ['learningPaths' => $activity->learningPath])
    @include('activities.section-highlight', ['highlights' => $activity->highlights])

    {{-- ========================= REGISTRATION CTA ========================= --}}
    @if ($registrationStatus['open'] || $registrationStatus['ending_soon'])
        <section id="daftar"
            class="py-16 bg-gradient-to-br from-emerald-700 via-emerald-600 to-emerald-700 relative overflow-hidden">
            <div aria-hidden="true" class="absolute inset-0 dot-pattern opacity-20"></div>

            <div class="soft-container relative z-10">
                <div class="max-w-4xl mx-auto">
                    <div class="glass rounded-2xl p-8 md:p-12 " data-aos="zoom-in">
                        <div class="text-center mb-8">
                            <h3 class="text-3xl md:text-4xl font-extrabold text-white mb-4">Daftar Sekarang</h3>
                            <p class="text-lg text-white/90">
                                Investasi terbaik adalah mempersiapkan diri dengan ilmu dan keterampilan yang tepat.
                                Daftarkan diri Anda sekarang!
                            </p>
                        </div>

                        {{-- Info Grid --}}
                        <div class="grid md:grid-cols-3 gap-4 mb-8">
                            <div class="bg-emerald-500 backdrop-blur-sm rounded-xl p-5 text-white">
                                <div class="flex items-start gap-3">
                                    <div class="bg-white/20 rounded-full p-2 mt-1">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                    <div class="flex-1">
                                        <h4 class="font-bold mb-1">
                                            Pendaftaran
                                            {{ $registrationStatus['ending_soon'] ? 'Segera Ditutup' : 'Dibuka' }}
                                        </h4>
                                        <p class="text-sm text-white/80">
                                            {{ $activeBatch->tanggal_mulai_pendaftaran->format('d F Y') }} -
                                            {{ $activeBatch->tanggal_selesai_pendaftaran->format('d F Y') }}
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="bg-emerald-500 backdrop-blur-sm rounded-xl p-5 text-white">
                                <div class="flex items-start gap-3">
                                    <div class="bg-white/20 rounded-full p-2 mt-1">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                    <div class="flex-1">
                                        <h4 class="font-bold mb-1">Periode Pembelajaran</h4>
                                        <p class="text-sm text-white/80">
                                            {{ $activeBatch->tanggal_mulai_kegiatan->format('d F Y') }} -
                                            {{ $activeBatch->tanggal_selesai_kegiatan->format('d F Y') }}
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="bg-emerald-500 backdrop-blur-sm rounded-xl p-5 text-white">
                                <div class="flex items-start gap-3">
                                    <div class="bg-white/20 rounded-full p-2 mt-1">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                                        </svg>
                                    </div>
                                    <div class="flex-1">
                                        <h4 class="font-bold mb-1">Investasi</h4>
                                        <p class="text-sm text-white/80">
                                            Rp {{ number_format($activeBatch->harga, 0, ',', '.') }}
                                            <span class="block text-xs">(termasuk modul & sertifikat)</span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- CTA Button --}}
                        <div class="text-center" x-data="{ sending: false, sent: false }">
                            <a href="{{ $activeBatch->external_link }}" target="_blank"
                                @click="sending = true; setTimeout(() => { sending = false; sent = true; }, 1000)"
                                class="inline-flex items-center justify-center gap-2 px-8 py-4 rounded-xl bg-white text-emerald-700 font-bold text-lg shadow-xl hover:shadow-2xl hover:scale-105 transition-all duration-300"
                                :class="{ 'cursor-not-allowed opacity-75': sending || sent }">
                                <span x-show="!sending && !sent">
                                    Daftar Sekarang
                                </span>
                                <span x-show="sending" class="flex items-center gap-2">
                                    <svg class="animate-spin h-5 w-5" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10"
                                            stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor"
                                            d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                        </path>
                                    </svg>
                                    Mengirim...
                                </span>
                                <span x-show="sent" class="flex items-center gap-2">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7" />
                                    </svg>
                                    Segera Isi Formulir
                                </span>
                            </a>

                            <p x-show="sent" x-transition class="mt-4 text-white text-sm">
                                Terima kasih! Kami akan menghubungi Anda dalam 1x24 jam.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif

    {{-- ========================= ADDITIONAL SECTIONS ========================= --}}
    @include('activities.section-testimonials', ['testimonials' => $activity->testimonials])
    @include('activities.section-gallery', ['gallery' => $activity->gallery])
    @include('activities.section-faq', ['faqs' => $activity->faqs])
@endsection
