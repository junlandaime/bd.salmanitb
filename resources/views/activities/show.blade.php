@extends('layouts.app')

@section('title', $activity->title . ' - Program Bidang Dakwah Masjid Salman ITB')
@section('meta_description', Str::limit($activity->description, 160))
@section('og_title', $activity->title . ' - Program Bidang Dakwah Masjid Salman ITB')
@section('og_description', Str::limit($activity->description, 200))
@section('og_image', 'https://bidangdakwah.salmanitb.com/storage/' . $activity->featured_image)

@section('additional_meta_tags')

@endsection

{{-- @if ($registrationStatus['open'] || $registrationStatus['ending_soon'])

    @if ($activeBatch->featured_image)
        <img src="{{ Storage::url($activeBatch->featured_image) }}" alt="{{ $activeBatch->nama_batch }}" class="w-2/6">
    @endif
@else
@endif --}}

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


    <!-- Main Content -->
    <main>
        <!-- Hero Section -->
        <section class="relative pt-16 pb-32 flex content-center items-center justify-center" style="min-height: 85vh;">
            <div class="absolute top-0 w-full h-full bg-cover bg-center"
                style="background-image: url('{{ Storage::url($activity->featured_image) }}');">
                <span class="w-full h-full absolute opacity-50 bg-black"></span>
                <!-- Animated overlay pattern -->
                <div class="absolute inset-0 z-10 opacity-30">
                    {{-- <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%">
                        <defs>
                            <pattern id="pattern" width="40" height="40" patternUnits="userSpaceOnUse">
                                <circle cx="20" cy="20" r="2" fill="white" />
                            </pattern>
                        </defs>
                        <rect width="100%" height="100%" fill="url(#pattern)" />
                    </svg> --}}
                </div>
            </div>
            <div class="container relative mx-auto z-20">
                <div class="items-center flex flex-wrap">
                    <div class="w-full lg:w-7/12 px-4 ml-auto mr-auto text-center">
                        <!-- Animated Title -->
                        <div x-data="{ text: '', fullText: '{{ $activity->title }}', charIndex: 0 }" x-init="() => {
                            const interval = setInterval(() => {
                                if (charIndex <= fullText.length) {
                                    text = fullText.substring(0, charIndex);
                                    charIndex++;
                                } else {
                                    clearInterval(interval);
                                }
                            }, 100);
                        }">
                            <h1 class="text-white font-bold text-5xl md:text-6xl tracking-tight">
                                <span x-text="text"></span>
                                <span class="animate-pulse">|</span>
                            </h1>
                        </div>


                        @php
                            $registrationStatus = [
                                'closed' => !$activeBatch && $upcomingBatches->isEmpty(),
                                'upcoming' => !$activeBatch && $upcomingBatches->isNotEmpty(),
                                'open' =>
                                    $activeBatch &&
                                    now()->between(
                                        $activeBatch->tanggal_mulai_pendaftaran,
                                        $activeBatch->tanggal_selesai_pendaftaran,
                                    ),
                                'ending_soon' =>
                                    $activeBatch &&
                                    now()->between(
                                        $activeBatch->tanggal_selesai_pendaftaran->subDays(7),
                                        $activeBatch->tanggal_selesai_pendaftaran,
                                    ),
                            ];
                        @endphp

                        <!-- Registration Status Section -->
                        <div class="mt-8 space-y-4 text-white">
                            @if ($registrationStatus['open'] || $registrationStatus['ending_soon'])
                                <div class="space-y-4 flex flex-col items-center">
                                    @if ($activeBatch->featured_image)
                                        <img src="{{ Storage::url($activeBatch->featured_image) }}"
                                            alt="{{ $activeBatch->nama_batch }}" class="w-2/6">
                                    @endif

                                    <!-- Registration Status Header -->
                                    <div class="flex items-center gap-2">
                                        <h2 class="text-lg font-semibold">
                                            Batch {{ $activeBatch->batch_ke }} - {{ $activeBatch->nama_batch }}
                                        </h2>



                                        @if ($registrationStatus['ending_soon'])
                                            <span
                                                class="px-3 py-1 bg-yellow-500 text-white text-sm rounded-full animate-pulse">
                                                Pendaftaran Segera Ditutup
                                            </span>
                                        @else
                                            <span class="px-3 py-1 bg-green-500 text-white text-sm rounded-full">
                                                Pendaftaran Dibuka
                                            </span>
                                        @endif
                                    </div>

                                    <!-- Batch Information -->
                                    <div class="flex gap-8 justify-center">
                                        <div class="flex flex-col items-center">
                                            <span class="text-sm text-gray-600">Harga Program</span>
                                            <span class="text-2xl font-bold">
                                                Rp {{ number_format($activeBatch->harga, 0, ',', '.') }}
                                            </span>
                                        </div>
                                        <div class="flex flex-col items-center">
                                            <span class="text-sm text-gray-600">Sisa Kuota</span>
                                            <span class="text-2xl font-bold">{{ $activeBatch->kuota }} Peserta</span>
                                        </div>
                                    </div>
                                </div>

                                <div>
                                    <span class="block text-sm opacity-75">Batas Pendaftaran</span>
                                    <span class="text-lg">
                                        {{ $activeBatch->tanggal_selesai_pendaftaran->format('d F Y') }}
                                    </span>
                                </div>

                                <!-- Registration Button -->
                                <div class="mt-8 flex justify-center opacity-0 animate-[fadeIn_1.5s_ease-in_forwards_1.5s]">
                                    <a href="{{ $activeBatch->external_link }}"
                                        class="group relative inline-flex items-center justify-center overflow-hidden rounded-full border-2 border-green-500 p-4 px-6 py-3 font-medium text-white transition duration-300 ease-out">
                                        <span
                                            class="absolute inset-0 bg-gradient-to-r from-green-500 to-emerald-600"></span>
                                        <span
                                            class="ease absolute bottom-0 left-0 h-1 w-0 bg-white transition-all duration-500 group-hover:w-full"></span>
                                        <span
                                            class="ease absolute right-0 top-0 h-0 w-0 border-t-2 border-white transition-all duration-500 group-hover:w-full"></span>
                                        <span
                                            class="ease absolute bottom-0 right-0 h-0 w-0 border-b-2 border-white transition-all duration-500 group-hover:h-full"></span>
                                        <span
                                            class="ease absolute left-0 top-0 h-0 w-0 border-l-2 border-white transition-all duration-500 group-hover:h-full"></span>
                                        <span class="relative font-semibold tracking-wider">
                                            @if ($registrationStatus['ending_soon'])
                                                DAFTAR SEKARANG - KUOTA TERBATAS
                                            @else
                                                DAFTAR SEKARANG
                                            @endif
                                        </span>
                                    </a>
                                </div>
                            @elseif ($registrationStatus['upcoming'])
                                <!-- Upcoming Batch Status -->
                                <div class="mt-8 space-y-4">
                                    <div class="inline-block px-4 py-2 bg-yellow-500 text-white rounded-lg">
                                        <span class="block font-semibold mb-1">Batch Selanjutnya</span>
                                        <div class="flex items-center gap-2">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                                </path>
                                            </svg>
                                            <span>
                                                Dibuka pada
                                                {{ $upcomingBatches->first()->tanggal_mulai_pendaftaran->format('d F Y') }}
                                            </span>
                                            @if ($activeBatch->featured_image)
                                                <img src="{{ Storage::url($activeBatch->featured_image) }}"
                                                    alt="{{ $activeBatch->nama_batch }}" class="w-2/6">
                                            @endif
                                        </div>
                                    </div>

                                    <!-- Reminder Button -->
                                    <div class="flex justify-center">
                                        <button type="button"
                                            class="px-6 py-3 bg-white bg-opacity-20 rounded-lg hover:bg-opacity-30 transition-all duration-300
                                        flex items-center gap-2">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9">
                                                </path>
                                            </svg>
                                            <span>Ingatkan Saya</span>
                                        </button>
                                    </div>
                                </div>
                            @else
                                <!-- Closed Registration Status -->
                                <p class="mt-6 text-xl text-gray-200 transition-opacity duration-1000 delay-800">
                                    {{ $activity->overview }}
                                </p>
                                <div class="mt-8 space-y-4">
                                    <div class="inline-block px-4 py-2 bg-gray-600 text-white rounded-lg">
                                        <span class="block font-semibold mb-1">Nantikan Batch Selanjutnya</span>
                                        <p class="text-sm opacity-80">
                                            Batch selanjutnya akan diumumkan segera.
                                            Pantau terus media sosial kami untuk informasi terbaru.
                                        </p>
                                    </div>

                                    <!-- Social Media Links -->
                                    <div class="flex justify-center gap-4">
                                        @if ($landingPage->social_facebook)
                                            <a href="{{ $landingPage->social_facebook }}" target="_blank"
                                                class="text-gray-100 hover:text-gray-900">
                                                <span class="sr-only">Facebook</span>
                                                <svg class="h-10 w-10" fill="currentColor" viewBox="0 0 24 24">
                                                    <path fill-rule="evenodd"
                                                        d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                            </a>
                                        @endif
                                        @if ($landingPage->social_instagram)
                                            <a href="{{ $landingPage->social_instagram }}" target="_blank"
                                                class="text-gray-100 hover:text-gray-900">
                                                <span class="sr-only">Instagram</span>
                                                <svg class="h-10 w-10" fill="currentColor" viewBox="0 0 24 24">
                                                    <path fill-rule="evenodd"
                                                        d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                            </a>
                                        @endif
                                        @if ($landingPage->social_twitter)
                                            <a href="{{ $landingPage->social_twitter }}" target="_blank"
                                                class="text-gray-100 hover:text-gray-900">
                                                <span class="sr-only">Twitter</span>
                                                <svg class="h-10 w-10" fill="currentColor" viewBox="0 0 24 24">
                                                    <path
                                                        d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84" />
                                                </svg>
                                            </a>
                                        @endif
                                        @if ($landingPage->social_youtube)
                                            <a href="{{ $landingPage->social_youtube }}" target="_blank"
                                                class="text-gray-100 hover:text-gray-900">
                                                <span class="sr-only">YouTube</span>
                                                <svg class="h-10 w-10" fill="currentColor" viewBox="0 0 24 24">
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
                    </div>
                </div>
            </div>
            <!-- Scroll indicator -->
            <div class="absolute bottom-10 left-1/2 transform -translate-x-1/2 animate-bounce">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3">
                    </path>
                </svg>
            </div>
        </section>

        <!-- Breadcrumb -->
        <div class="bg-white shadow-sm w-full top-0 z-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <nav class="flex py-3 text-gray-100 text-sm">
                    <ol class="inline-flex items-center space-x-1 md:space-x-3">
                        <li class="inline-fle10 it10ms-center">
                            <a href="{{ route('home') }}"
                                class="inline-flex items-center text-gray-600 hover:text-green-500">
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
                                <a href="{{ route('programs.show', $activity->program->slug) }}"
                                    class="ml-1 text-gray-600 hover:text-green-500 md:ml-2">{{ $activity->program->title }}</a>
                            </div>
                        </li>
                        <li>
                            <div class="flex items-center">
                                <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                <a href="{{ route('activities.index') }}"
                                    class="ml-1 text-gray-600 hover:text-green-500 md:ml-2">Kegiatan</a>
                            </div>
                        </li>
                        <li>
                            <div class="flex items-center">
                                <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                <span class="ml-1 text-green-500 font-medium md:ml-2">{{ $activity->title }}</span>
                            </div>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>



        <!-- Activity Overview -->
        <section class="py-20 bg-white sm:px-6 lg:px-28">
            <div class="container mx-auto px-4">
                <div class="flex flex-wrap items-center mb-16">
                    <div class="w-full md:w-6/12 px-4 mb-8 md:mb-0">
                        <div class="relative">
                            @if ($activity->is_featured)
                                <span
                                    class="text-xs font-semibold inline-block py-1 px-2 uppercase rounded-full text-green-600 bg-green-200 absolute -top-4 -left-4">Kegiatan
                                    Unggulan</span>
                            @endif
                            <h2
                                class="text-3xl font-bold mb-4 bg-clip-text text-transparent bg-gradient-to-r from-green-600 to-emerald-500">
                                Tentang {{ $activity->title }}
                            </h2>
                            <div class="h-1 w-20 bg-gradient-to-r from-green-600 to-emerald-500 mb-6"></div>
                            <p class="text-lg leading-relaxed text-gray-600 mb-4">
                                {{ $activity->title }} adalah Kegiatan unggulan di bawah Program
                                {{ $activity->program->name }} dari Bidang Dakwah Masjid Salman ITB. Program ini
                                {!! nl2br(e($activity->description)) !!}
                            </p>
                            {{-- <div class="text-lg leading-relaxed text-gray-600 space-y-4">
                                {!! nl2br(e($activity->description)) !!}
                            </div> --}}
                        </div>
                    </div>
                    <div class="w-full md:w-6/12 px-4">
                        <div class="relative">
                            <!-- Image with frame effect -->
                            <div
                                class="border-8 border-white shadow-2xl rounded-lg overflow-hidden transform rotate-3 transition-transform duration-500 hover:rotate-0">
                                {{-- @if ($registrationStatus['open'] || $registrationStatus['ending_soon'] || $registrationStatus['upcoming'])
                                    <img src="{{ Storage::url($activeBatch->featured_image) }}"
                                        alt="{{ $activeBatch->title }}" 
                                        
                                        @endif --}}
                                <img src="{{ Storage::url($activity->featured_image) }}" alt="{{ $activity->title }}"
                                    class="w-full">
                                {{-- @if (($registrationStatus['open'] || $registrationStatus['ending_soon']) && isset($activeBatch->featured_image))
                                    <img src="{{ Storage::url($activeBatch->featured_image) }}"
                                        alt="{{ $activeBatch->nama_batch }}" class="w-full">
                                @elseif ($registrationStatus['upcoming'] && $upcomingBatches->first()->featured_image)
                                    <img src="{{ Storage::url($upcomingBatches->first()->featured_image) }}"
                                        alt="{{ $upcomingBatches->first()->nama_batch }}" class="w-full">
                                @else
                                    <img src="{{ Storage::url($activity->featured_image) }}"
                                        alt="{{ $activity->title }}" class="w-full">
                                @endif --}}
                            </div>
                            <!-- Decorative elements -->
                            <div class="absolute -bottom-4 -left-4 w-20 h-20 rounded-full bg-green-200 z-0"></div>
                            <div class="absolute -top-8 -right-8 w-16 h-16 rounded-full border-4 border-emerald-200 z-0">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        @include('activities.section-learning-path', ['learningPaths' => $activity->learningPath])
        @include('activities.section-highlight', ['highlights' => $activity->highlights])


        @if ($registrationStatus['open'] || $registrationStatus['ending_soon'])
            <!-- Registration Form Section -->
            <section id="daftar" class="py-24 bg-white text-center">
                <div class="container mx-auto px-4">
                    <div class="max-w-lg mx-auto">
                        <div class="bg-gradient-to-br from-green-500 to-emerald-600 rounded-xl overflow-hidden shadow-xl">
                            <div class="md:w-full p-8 md:p-12 text-white">
                                <h3 class="text-3xl font-bold mb-6">Daftar Sekarang</h3>
                                <p class="mb-8 opacity-90">
                                    Investasi terbaik untuk pernikahan Anda adalah mempersiapkan diri dengan ilmu dan
                                    keterampilan yang tepat. Daftarkan diri Anda sekarang!
                                </p>
                                <div class="flex justify-center">
                                    <div class="space-y-6 ">
                                        <!-- Schedule Info -->
                                        <div class="flex items-center text-justify">
                                            <div class="bg-white bg-opacity-20 rounded-full p-2 mr-4">
                                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                                    </path>
                                                </svg>
                                            </div>
                                            <div>
                                                <h4 class="font-semibold">Pendaftaran
                                                    {{ $registrationStatus['ending_soon'] ? 'Segera Ditutup' : 'Dibuka' }}
                                                </h4>
                                                <p class="text-sm opacity-80">
                                                    {{ $activeBatch->tanggal_mulai_pendaftaran->format('d F Y') }} -
                                                    {{ $activeBatch->tanggal_selesai_pendaftaran->format('d F Y') }}
                                                </p>
                                            </div>
                                        </div>
                                        <!-- Learning Period -->
                                        <div class="flex items-center text-justify">
                                            <div class="bg-white bg-opacity-20 rounded-full p-2 mr-4">
                                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z">
                                                    </path>
                                                </svg>
                                            </div>
                                            <div>
                                                <h4 class="font-semibold">Periode Pembelajaran</h4>
                                                <p class="text-sm opacity-80">
                                                    {{ $activeBatch->tanggal_mulai_kegiatan->format('d F Y') }} -
                                                    {{ $activeBatch->tanggal_selesai_kegiatan->format('d F Y') }}</p>
                                            </div>
                                        </div>
                                        <!-- Investment Info -->
                                        <div class="flex items-center text-justify">
                                            <div class="bg-white bg-opacity-20 rounded-full p-2 mr-4">
                                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z">
                                                    </path>
                                                </svg>
                                            </div>
                                            <div>
                                                <h4 class="font-semibold">Investasi</h4>
                                                <p class="text-sm opacity-80">
                                                    Rp {{ number_format($activeBatch->harga, 0, ',', '.') }}
                                                    <span class="block">(termasuk modul dan sertifikat)</span>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div x-data="{ sending: false, sent: false }" class="mt-6">
                                    <div>
                                        <!-- Submit Button -->
                                        <a href="{{ $activeBatch->external_link }}" target="_blank"
                                            @click="sending = true; setTimeout(() => { sending = false; sent = true; }, 1000)"
                                            class="block w-full bg-gradient-to-r from-green-500 to-emerald-600 text-white py-3 px-4 rounded-lg font-semibold transition-transform transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500"
                                            :class="{ 'cursor-not-allowed opacity-75': sending || sent }">
                                            <div class="flex justify-center items-center">
                                                <div x-show="!sending && !sent">
                                                    Daftar Sekarang
                                                </div>
                                                <div x-show="sending" class="flex items-center justify-center">
                                                    <svg class="animate-spin mr-2 h-4 w-4 text-white" fill="none"
                                                        viewBox="0 0 24 24">
                                                        <circle class="opacity-25" cx="12" cy="12" r="10"
                                                            stroke="currentColor" stroke-width="4"></circle>
                                                        <path class="opacity-75" fill="currentColor"
                                                            d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                                        </path>
                                                    </svg>
                                                    Mengirim...
                                                </div>
                                                <div x-show="sent" class="flex items-center justify-center">
                                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M5 13l4 4L19 7"></path>
                                                    </svg>
                                                    Segera Isi Formulir
                                                </div>
                                            </div>
                                        </a>
                                        <!-- Success Message -->
                                        <div x-show="sent" x-transition class="text-sm text-green-600 text-center mt-4">
                                            Terima kasih! Kami akan menghubungi Anda dalam 1x24 jam.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        @endif

        @include('activities.section-testimonials', ['testimonials' => $activity->testimonials])
        @include('activities.section-gallery', ['gallery' => $activity->gallery])
        @include('activities.section-faq', ['faqs' => $activity->faqs])
    </main>
@endsection
