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
                                    <a href="#daftar"
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
                                        <span class="block font-semibold mb-1">Pendaftaran Ditutup</span>
                                        <p class="text-sm opacity-80">
                                            Batch selanjutnya akan diumumkan segera.
                                            Pantau terus media sosial kami untuk informasi terbaru.
                                        </p>
                                    </div>

                                    <!-- Social Media Links -->
                                    <div class="flex justify-center gap-4">
                                        <a href="#" class="text-white hover:text-green-400 transition-colors">
                                            <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24">
                                                <path
                                                    d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z" />
                                            </svg>
                                        </a>
                                        <a href="#" class="text-white hover:text-green-400 transition-colors">
                                            <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24">
                                                <path
                                                    d="M22.46 6c-.77.35-1.6.58-2.46.69.88-.53 1.56-1.37 1.88-2.38-.83.5-1.75.85-2.72 1.05C18.37 4.5 17.26 4 16 4c-2.35 0-4.27 1.92-4.27 4.29 0 .34.04.67.11.98C8.28 9.09 5.11 7.38 3 4.79c-.37.63-.58 1.37-.58 2.15 0 1.49.75 2.81 1.91 3.56-.71 0-1.37-.2-1.95-.5v.03c0 2.08 1.48 3.82 3.44 4.21a4.22 4.22 0 0 1-1.93.07 4.28 4.28 0 0 0 4 2.98 8.521 8.521 0 0 1-5.33 1.84c-.34 0-.68-.02-1.02-.06C3.44 20.29 5.7 21 8.12 21 16 21 20.33 14.46 20.33 8.79c0-.19 0-.37-.01-.56.84-.6 1.56-1.36 2.14-2.23z" />
                                            </svg>
                                        </a>
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
                <nav class="flex py-3 text-gray-700 text-sm">
                    <ol class="inline-flex items-center space-x-1 md:space-x-3">
                        <li class="inline-flex items-center">
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
                                {{ $activity->program->name }} dari Bidang Dakwah Masjid Salman ITB yang dikhususkan untuk
                                mempersiapkan calon pengantin dalam menghadapi kehidupan pernikahan. Kegiatan ini mencakup
                                aspek ilmu pengetahuan, keterampilan praktis, dan pembentukan mental spiritual yang
                                diperlukan dalam membangun keluarga sakinah.
                            </p>
                            <div class="text-lg leading-relaxed text-gray-600 space-y-4">
                                {!! nl2br(e($activity->description)) !!}
                            </div>
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
            <section id="daftar" class="py-24 bg-white">
                <div class="container mx-auto px-4">
                    <div class="max-w-4xl mx-auto">
                        <div class="bg-gradient-to-br from-green-500 to-emerald-600 rounded-xl overflow-hidden shadow-xl">
                            <div class="md:flex">
                                <!-- Left Column - Information -->
                                <div class="md:w-1/2 p-8 md:p-12 text-white">
                                    <h3 class="text-3xl font-bold mb-6">Daftar Sekarang</h3>
                                    <p class="mb-8 opacity-90">
                                        Investasi terbaik untuk pernikahan Anda adalah mempersiapkan diri dengan ilmu dan
                                        keterampilan yang tepat. Daftarkan diri Anda sekarang!
                                    </p>
                                    <div class="space-y-6">
                                        <!-- Schedule Info -->
                                        <div class="flex items-center">
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
                                        <div class="flex items-center">
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
                                                <p class="text-sm opacity-80">{{ $activeBatch->durasi_program }}</p>
                                            </div>
                                        </div>
                                        <!-- Investment Info -->
                                        <div class="flex items-center">
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
                                                    Rp {{ number_format($activeBatch->harga, 0, ',', '.') }}/pasangan
                                                    <span class="block">(termasuk modul dan sertifikat)</span>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Right Column - Registration Form -->
                                <div class="md:w-1/2 bg-white p-8 md:p-12">
                                    <form x-data="{ sending: false, sent: false }"
                                        @submit.prevent="sending = true; setTimeout(() => { sending = false; sent = true; }, 1000)">
                                        <div class="space-y-6">
                                            <!-- Name Field -->
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700 mb-1">Nama
                                                    Lengkap</label>
                                                <input type="text" name="name" required
                                                    class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500"
                                                    placeholder="Masukkan nama lengkap Anda">
                                            </div>
                                            <!-- Email Field -->
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                                                <input type="email" name="email" required
                                                    class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500"
                                                    placeholder="email@example.com">
                                            </div>
                                            <!-- WhatsApp Field -->
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700 mb-1">Nomor
                                                    WhatsApp</label>
                                                <input type="tel" name="whatsapp" required
                                                    class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500"
                                                    placeholder="08xxxxxxxxxx">
                                            </div>
                                            <!-- Marriage Status Field -->
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700 mb-1">Status
                                                    Pernikahan</label>
                                                <select name="status" required
                                                    class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500">
                                                    <option value="">Pilih status</option>
                                                    <option value="planning">Rencana menikah</option>
                                                    <option value="engaged">Sudah bertunangan</option>
                                                    <option value="newlywed">Pengantin baru (< 1 tahun)</option>
                                                </select>
                                            </div>
                                            <!-- Submit Button -->
                                            <div>
                                                <button type="submit"
                                                    class="w-full bg-gradient-to-r from-green-500 to-emerald-600 text-white py-3 rounded-lg font-semibold transition-transform transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500"
                                                    :disabled="sending || sent">
                                                    <span x-show="!sending && !sent">Daftar Sekarang</span>
                                                    <span x-show="sending" class="flex items-center justify-center">
                                                        <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white"
                                                            fill="none" viewBox="0 0 24 24">
                                                            <circle class="opacity-25" cx="12" cy="12"
                                                                r="10" stroke="currentColor" stroke-width="4"></circle>
                                                            <path class="opacity-75" fill="currentColor"
                                                                d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                                            </path>
                                                        </svg>
                                                        Mengirim...
                                                    </span>
                                                    <span x-show="sent" class="flex items-center justify-center">
                                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2" d="M5 13l4 4L19 7"></path>
                                                        </svg>
                                                        Pendaftaran Terkirim
                                                    </span>
                                                </button>
                                            </div>
                                            <!-- Success Message -->
                                            <div x-show="sent" x-transition class="text-sm text-green-600 text-center">
                                                Terima kasih! Kami akan menghubungi Anda dalam 1x24 jam.
                                            </div>
                                        </div>
                                    </form>
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
