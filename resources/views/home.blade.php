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


@push('styles')
    <style>
        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        .card-hover {
            transition: all 0.3s ease;
        }
    </style>
@endpush

@section('content')
    <!-- Main Content -->
    <main class="">
        <!-- Hero Section -->
        <section id="home" class="py-16 bg-gray-100 md:px-40" data-aos="fade-in">
            <div class="container mx-auto px-4">
                <div class="flex flex-col md:flex-row items-center">
                    <div class="md:w-1/2 mb-8 md:mb-0" data-aos="fade-right" data-aos-delay="100">
                        <p class="text-lg mb-3">Selamat datang di</p>
                        <h1 class="text-4xl md:text-5xl font-bold mb-4">BIDANG DAKWAH</h1>
                        <h2 class="text-3xl md:text-4xl font-bold mb-6">Yayasan Pembina Masjid (YPM) Salman ITB</h2>
                        <p class="text-gray-700 mb-8">
                            {!! $landingpage->hero_subtitle !!}
                        </p>
                        <!-- CTA Buttons -->
                        <div class="mt-5 sm:mt-8 sm:flex sm:justify-center lg:justify-start" data-aos="fade-up"
                            data-aos-delay="300">
                            <div class="rounded-md shadow">
                                <a href="{{ route('programs.index') }}"
                                    class="w-full flex items-center justify-center px-4 py-2 border border-transparent text-base font-medium rounded-md text-white bg-green-600 hover:bg-green-700 md:py-2 md:text-xs md:px-4">
                                    Lihat Program
                                </a>
                            </div>
                            <div class="mt-3 sm:mt-0 sm:ml-3">
                                <a href="{{ route('contact') }}"
                                    class="w-full flex items-center justify-center px-4 py-2 border border-transparent text-base font-medium rounded-md text-green-700 bg-green-100 hover:bg-green-200 md:py-2 md:text-xs md:px-4">
                                    Konsultasi
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="md:w-1/2 flex justify-center" data-aos="fade-left" data-aos-delay="200">
                        <div class="bg-gray-300 w-full max-w-md aspect-square rounded-lg flex items-center justify-center">
                            <img src="{{ $landingpage ? Storage::url($landingpage->hero_image) : asset('bd.jpg') }}"
                                class="object-cover object-center rounded-lg shadow-lg transition-opacity duration-500"
                                alt="">
                            <svg class="w-24 h-24 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Program Layanan Section -->
        <section id="program" class="py-16 md:px-40 bg-gray-50" data-aos="fade-in">
            <div class="container mx-auto px-4">
                <h2 class="text-3xl font-bold text-center mb-8" data-aos="fade-up">Program Layanan Kami</h2>
                <p class="text-center max-w-3xl mx-auto mb-12" data-aos="fade-up" data-aos-delay="100">
                    Bidang Dakwah Salman ITB hadir dengan beragam program layanan yang dirancang untuk memenuhi kebutuhan
                    spiritual dan edukasi umat Islam di lingkungan Masjid Salman ITB dan sekitarnya. Berikut adalah
                    penjelasan mengenai program-program unggulan kami:
                </p>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach ($featuredPrograms as $program)
                        <!-- Card 1 -->
                        <div class="bg-white rounded-lg shadow-lg overflow-hidden transform hover:scale-105 transition duration-300 card-hover"
                            data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                            <div class="p-4">
                                <div class="bg-gray-100 h-64 rounded-lg flex items-center justify-center">
                                    <div class="flex flex-col items-center">
                                        <img src="{{ Storage::url($program->featured_image) ?? 'https://picsum.photos/400/300' }}"
                                            alt="{{ $program->title }}" class="w-full h-full object-cover">

                                    </div>
                                </div>
                                <!-- Title -->
                                <h2 class="text-xl font-semibold text-center mb-2">{{ $program->title }}</h2>

                                <!-- Divider -->
                                <div class="h-0.5 bg-gray-200 w-1/2 mx-auto mb-6"></div>

                                <!-- Description -->
                                <p class="text-gray-600 text-center text-sm mb-6">
                                    {{ Str::limit($program->description, 100) }} </p>
                                <div class="flex justify-center mb-4">
                                    <a href="{{ route('programs.show', $program->slug) }}"
                                        class="bg-green-500 text-white px-2 py-1 text-xs rounded-lg flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20"
                                            fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        Selengkapnya
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach


                </div>
            </div>
        </section>

        {{-- Kegiatan Favorit --}}
        <div class="container mx-auto px-4 max-w-6xl py-16">
            <!-- Heading Section -->
            <div class="mb-10" data-aos="fade-down" data-aos-duration="800">
                <h1 class="text-3xl font-bold mb-8">Kelas/kegiatan Terfavorit</h1>
                <p class="text-base text-gray-700">
                    Diantara kegiatan atau kelas yang kami sediakan, berikut adalah beberapa kelas yang favorit dan sangat
                    kami rekomendasikan untuk dapat anda ikuti
                </p>
            </div>

            <!-- Cards Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                @forelse($activities as $activity)
                    <div data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}" data-aos-duration="800"
                        class="bg-white rounded-lg overflow-hidden shadow-lg transition-transform duration-300 hover:-translate-y-2 hover:shadow-xl">
                        <!-- Featured badge -->
                        @if ($activity->is_featured)
                            <div class="absolute top-4 left-4 z-10">
                                <span
                                    class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M5 2a1 1 0 011 1v1h1a1 1 0 010 2H6v1a1 1 0 01-2 0V6H3a1 1 0 010-2h1V3a1 1 0 011-1zm0 10a1 1 0 011 1v1h1a1 1 0 110 2H6v1a1 1 0 11-2 0v-1H3a1 1 0 110-2h1v-1a1 1 0 011-1zm7-10a1 1 0 01.707.293l.707.707L15.414 4a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-2-2A1 1 0 0110 5.414l.293.293a1 1 0 001.414 0l.293-.293A1 1 0 0112 5z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                    Unggulan
                                </span>
                            </div>
                        @endif

                        <!-- Activity Image -->
                        <div class="relative">
                            <img src="{{ Storage::url($activity->featured_image) }}" alt="{{ $activity->title }}"
                                class="w-full h-56 object-cover">
                            <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black to-transparent h-20">
                            </div>
                        </div>

                        <!-- Activity Content -->
                        <div class="p-6">
                            <!-- Program Badge -->
                            <div class="mb-3">
                                <span class="px-3 py-1 text-xs font-semibold bg-gray-100 text-gray-800 rounded-full">
                                    {{ $activity->program->title }}
                                </span>
                            </div>

                            <!-- Activity Title -->
                            <h3 class="text-xl font-bold text-gray-900 mb-3 line-clamp-2">{{ $activity->title }}</h3>

                            <!-- Activity Overview -->
                            <p class="text-gray-600 mb-4 line-clamp-3">{{ $activity->overview }}</p>

                            <!-- Activity Highlights -->
                            @if ($activity->highlights->isNotEmpty())
                                <div class="mb-4">
                                    <div class="flex flex-wrap gap-2">
                                        @foreach ($activity->highlights->take(3) as $highlight)
                                            <span class="text-xs px-2 py-1 bg-green-50 text-green-700 rounded">
                                                {{ $highlight->title }}
                                            </span>
                                        @endforeach
                                    </div>
                                </div>
                            @endif

                            <!-- Registration Status -->
                            <div class="flex justify-between items-center mt-6">
                                <div>
                                    @php
                                        $activeBatch = $activity->getActiveBatch();
                                        $upcomingBatches = $activity->getUpcomingBatches();
                                    @endphp

                                    @if ($activeBatch)
                                        <span
                                            class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-base bg-green-100 text-green-800">
                                            Pendaftaran Dibuka
                                        </span>
                                    @elseif($upcomingBatches->isNotEmpty())
                                        <span
                                            class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-base bg-yellow-100 text-yellow-800">
                                            {{-- Pendaftaran Akan Dibuka --}}
                                            Cooming Soon
                                        </span>
                                    @else
                                        <span
                                            class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-base bg-gray-100 text-gray-800">
                                            Pendaftaran Ditutup
                                        </span>
                                    @endif
                                </div>

                                <a href="{{ route('activities.show', $activity->slug) }}"
                                    class="text-green-600 hover:text-green-800 font-medium flex items-center">
                                    Detail
                                    <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full py-12 text-center" data-aos="fade-up" data-aos-delay="400"
                        data-aos-duration="800">
                        <svg class="w-16 h-16 mx-auto text-gray-400" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                            </path>
                        </svg>
                        <h3 class="mt-4 text-lg font-medium text-gray-900">Tidak Ada Kegiatan</h3>
                        <p class="mt-2 text-gray-600">Saat ini belum ada kegiatan yang tersedia.</p>
                    </div>
                @endforelse

            </div>

            <!-- "See More" Button -->
            <div class="flex justify-start" data-aos="fade-up" data-aos-delay="300" data-aos-duration="500">
                <button
                    class="bg-green-500 hover:bg-green-600 text-white font-medium px-6 py-3 rounded transition duration-300">
                    Lihat Kelas Lainnya
                </button>
            </div>
        </div>


        @php
            $upcomingPrograms = App\Models\Activity::with([
                'batches' => function ($query) {
                    $query
                        ->where('status', 'aktif')
                        ->where(function ($q) {
                            $q->where('tanggal_mulai_pendaftaran', '<=', now()->addMonths(2))->where(
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

        <!-- Upcoming Program -->
        <section class="py-16 bg-gray-50" data-aos="fade-in">
            <div class="max-w-6xl mx-auto px-4">
                <h2 class="text-2xl font-bold mb-8" data-aos="fade-up">Kegiatan Mendatang</h2>
                <div class="space-y-4">
                    @forelse($upcomingPrograms as $program)
                        @foreach ($program->batches as $batch)
                            <div class="bg-white rounded-xl shadow-lg p-6 hover:shadow-xl transition-all duration-300"
                                data-aos="fade-up" data-aos-delay="100">
                                <div class="flex gap-6">
                                    <div class="text-center bg-blue-50 px-4 py-2 rounded-lg">
                                        <div class="text-2xl font-bold text-bluebg-blue-600">
                                            {{ $batch->tanggal_mulai_kegiatan->format('d') }}</div>
                                        <div class="text-sm text-bluebg-blue-600">
                                            {{ $batch->tanggal_mulai_kegiatan->format('M') }}
                                        </div>
                                    </div>
                                    <div class="flex-1">
                                        <div class="flex justify-between items-start">
                                            <div>
                                                <h3 class="font-semibold text-lg">{{ $program->title }}</h3>
                                                <p class="text-gray-600">Batch {{ $batch->batch_ke }} -
                                                    {{ $batch->nama_batch }}</p>
                                            </div>
                                            @if ($batch->isOpenForRegistration())
                                                <span class="px-3 py-1 bg-green-100 text-green-600 text-sm rounded-full">
                                                    Pendaftaran Dibuka
                                                </span>
                                            @else
                                                <span class="px-3 py-1 bg-blue-100 text-blue-600 text-sm rounded-full">
                                                    Upcoming
                                                </span>
                                            @endif
                                        </div>
                                        <div class="mt-2 flex gap-2 justify-between items-start">
                                            <div>
                                                {{-- <span
                                                    class="px-2 py-1 {{ $program->tipe_kelas === 'online' ? 'bg-blue-100 text-blue-600' : ($program->tipe_kelas === 'offline' ? 'bg-yellow-100 text-yellow-600' : 'bg-purple-100 text-purple-600') }} text-sm rounded">
                                                    {{ ucfirst($program->tipe_kelas) }}
                                                </span>
                                                <span
                                                    class="px-2 py-1 bg-blue-100 text-blue-600 text-sm rounded">{{ $program->durasi }}</span> --}}
                                                @if ($batch->isOpenForRegistration())
                                                    <span class="px-2 py-1 bg-red-100 text-red-600 text-sm rounded">
                                                        Sisa
                                                        {{ $batch->tanggal_selesai_pendaftaran->diffForHumans(null, true) }}
                                                    </span>
                                                @endif
                                            </div>
                                            @if ($batch->isOpenForRegistration())
                                                <div class="">

                                                    <a href="{{ route('activities.show', $program) }}"
                                                        class="inline-block px-3 py-1 bg-green-600 text-white rounded-lg hover:bg-green-900 transition-colors">
                                                        Daftar Sekarang
                                                    </a>
                                                </div>
                                            @endif
                                        </div>

                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @empty
                        <div class="text-center text-gray-500 py-8">
                            Tidak ada program yang akan datang dalam waktu dekat
                        </div>
                    @endforelse
                </div>
            </div>
        </section>

        <section class="flex flex-col lg:flex-row items-center py-16 gap-8 lg:gap-16 md:px-44">
            <!-- Image Container -->
            <div class="w-full lg:w-1/2 flex items-center justify-center" data-aos="fade-right" data-aos-duration="1000">
                <x-application-logo-full class="w-2/5 h-auto" />
            </div>

            <!-- Content Container -->
            <div class="w-full lg:w-1/2 px-4" data-aos="fade-left" data-aos-duration="1000" data-aos-delay="200">
                <div class="space-y-6">
                    <p class="text-green-500 font-medium">Sekilas</p>
                    <h2 class="text-4xl font-bold text-gray-900">Tentang Kami</h2>

                    <div class="space-y-4 text-gray-700 text-justify">
                        {!! $landingpage->about_content !!}
                    </div>

                    {{-- <button
                        class="inline-flex items-center px-4 py-2 bg-green-500 text-white rounded-md hover:bg-green-600 transition-colors"
                        x-data="{ hover: false }" @mouseenter="hover = true" @mouseleave="hover = false">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 7l5 5m0 0l-5 5m5-5H6" />
                        </svg>
                        Read more
                    </button> --}}
                </div>
            </div>
        </section>

        {{-- Penerima Manfaat --}}
        <section class="w-full bg-gray-200 py-16">
            <div class="container mx-auto px-4">
                <div class="text-center mb-12" data-aos="fade-up" data-aos-duration="800">
                    <h3 class="text-xl md:text-2xl font-medium mb-2">Jumlah Peserta</h3>
                    <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold">Penerima Manfaat Program</h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 max-w-6xl mx-auto">
                    <!-- Rumah Quran -->
                    <div class="text-center" data-aos="zoom-in" data-aos-duration="600" data-aos-delay="100">
                        <h2 class="text-5xl md:text-6xl font-bold mb-4" x-data="{ count: 0 }" x-init="() => {
                            const interval = setInterval(() => {
                                count = count + 10;
                                if (count >= {{ $landingpage->stats_1 }}) {
                                    clearInterval(interval);
                                    count = {{ $landingpage->stats_1 }};
                                }
                            }, 20);
                        }">
                            <span x-text="count">0</span>+
                        </h2>
                        <h3 class="text-xl md:text-2xl font-medium mb-1">{{ $landingpage->stats1 }}</h3>
                        {{-- <p class="text-sm md:text-base">(Program <span class="font-medium">Studi Islam</span>)</p> --}}
                    </div>

                    <!-- Sekolah Pranikah -->
                    <div class="text-center" data-aos="zoom-in" data-aos-duration="600" data-aos-delay="200">
                        <h2 class="text-5xl md:text-6xl font-bold mb-4" x-data="{ count: 0 }" x-init="() => {
                            const interval = setInterval(() => {
                                count = count + 12;
                                if (count >= {{ $landingpage->stats_2 }}) {
                                    clearInterval(interval);
                                    count = {{ $landingpage->stats_2 }};
                                }
                            }, 20);
                        }">
                            <span x-text="count">0</span>+
                        </h2>
                        <h3 class="text-xl md:text-2xl font-medium mb-1">{{ $landingpage->stats2 }}</h3>
                        {{-- <p class="text-sm md:text-base">(Program <span class="font-medium">Pendidikan Keluarga</span>)</p> --}}
                    </div>

                    <!-- Bahasa Arab -->
                    <div class="text-center" data-aos="zoom-in" data-aos-duration="600" data-aos-delay="300">
                        <h2 class="text-5xl md:text-6xl font-bold mb-4" x-data="{ count: 0 }" x-init="() => {
                            const interval = setInterval(() => {
                                count = count + 8;
                                if (count >= {{ $landingpage->stats_3 }}) {
                                    clearInterval(interval);
                                    count = {{ $landingpage->stats_3 }};
                                }
                            }, 20);
                        }">
                            <span x-text="count">0</span>+
                        </h2>
                        <h3 class="text-xl md:text-2xl font-medium mb-1">{{ $landingpage->stats3 }}</h3>
                        {{-- <p class="text-sm md:text-base">(Program <span class="font-medium">Studi Islam</span>)</p> --}}
                    </div>

                    <!-- Pemulasaraan jenazah -->
                    <div class="text-center" data-aos="zoom-in" data-aos-duration="600" data-aos-delay="400">
                        <h2 class="text-5xl md:text-6xl font-bold mb-4" x-data="{ count: 0 }" x-init="() => {
                            const interval = setInterval(() => {
                                count = count + 3;
                                if (count >= {{ $landingpage->stats_4 }}) {
                                    clearInterval(interval);
                                    count = {{ $landingpage->stats_4 }};
                                }
                            }, 20);
                        }">
                            <span x-text="count">0</span>+
                        </h2>
                        <h3 class="text-xl md:text-2xl font-medium mb-1">{{ $landingpage->stats4 }}</h3>
                        {{-- <p class="text-sm md:text-base">(Program <span class="font-medium">Ketakmiran</span>)</p> --}}
                    </div>
                </div>
            </div>
        </section>

        <div class="container mx-auto px-4 py-16 max-w-7xl">
            <div x-data="{}" class="flex flex-col lg:flex-row gap-8 items-center">
                <!-- Left side with features -->
                <div class="w-full lg:w-3/5 grid grid-cols-1 md:grid-cols-2 gap-8">
                    <h1 class="text-4xl md:text-5xl font-bold text-gray-900 col-span-full mb-8" data-aos="fade-right"
                        data-aos-duration="1000">
                        Mengapa Memilih Kami?
                    </h1>

                    <!-- Feature 1 -->
                    <div class="flex flex-col items-start" data-aos="fade-up" data-aos-delay="100"
                        data-aos-duration="800">
                        <div class="bg-gray-200 rounded-full p-6 mb-4">
                            <i class="fas fa-users text-green-600 text-3xl"></i>
                        </div>
                        <h3 class="text-xl text-green-600 font-medium mb-2">Tim Profesional</h3>
                        {{-- <p class="text-gray-600">
                            Lorem ipsum dolor sit amet consectetur. Tincidunt tortor nibh adipiscing enim nulla phasellus
                            mattis at.
                        </p> --}}
                    </div>

                    <!-- Feature 2 -->
                    <div class="flex flex-col items-start" data-aos="fade-up" data-aos-delay="200"
                        data-aos-duration="800">
                        <div class="bg-gray-200 rounded-full p-6 mb-4">
                            <i class="fas fa-medal text-green-600 text-3xl"></i>
                        </div>
                        <h3 class="text-xl text-green-600 font-medium mb-2">Pilihan Kelas</h3>
                        {{-- <p class="text-gray-600">
                            Lorem ipsum dolor sit amet consectetur. Tincidunt tortor nibh adipiscing enim nulla phasellus
                            mattis at.
                        </p> --}}
                    </div>

                    <!-- Feature 3 -->
                    <div class="flex flex-col items-start" data-aos="fade-up" data-aos-delay="300"
                        data-aos-duration="800">
                        <div class="bg-gray-200 rounded-full p-6 mb-4">
                            <i class="fas fa-graduation-cap text-green-600 text-3xl"></i>
                        </div>
                        <h3 class="text-xl text-green-600 font-medium mb-2">Layanan Pasca Program</h3>
                        {{-- <p class="text-gray-600">
                            Lorem ipsum dolor sit amet consectetur. Tincidunt tortor nibh adipiscing enim nulla phasellus
                            mattis at.
                        </p> --}}
                    </div>

                    <!-- Feature 4 -->
                    <div class="flex flex-col items-start" data-aos="fade-up" data-aos-delay="400"
                        data-aos-duration="800">
                        <div class="bg-gray-200 rounded-full p-6 mb-4">
                            <i class="fas fa-globe text-green-600 text-3xl"></i>
                        </div>
                        <h3 class="text-xl text-green-600 font-medium mb-2">Terjangkau</h3>
                        {{-- <p class="text-gray-600">
                            Lorem ipsum dolor sit amet consectetur. Tincidunt tortor nibh adipiscing enim nulla phasellus
                            mattis at.
                        </p> --}}
                    </div>
                </div>

                <!-- Right side with image -->
                <div class="w-full lg:w-2/5" data-aos="fade-left" data-aos-duration="1200">
                    <div class="bg-gray-200 rounded-lg p-6 relative overflow-hidden aspect-square">
                        <img src="{{ asset('bd.jpg') }}" alt="">

                    </div>
                </div>
            </div>
        </div>

        <!-- Latest News Section -->
        <section class="py-16 bg-white" data-aos="fade-in">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <h2 class="text-3xl font-bold text-center mb-12" data-aos="fade-up">Berita Terbaru</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                    @foreach ($latestNews as $news)
                        <div class="bg-white rounded-lg shadow-lg overflow-hidden" data-aos="zoom-in"
                            data-aos-delay="{{ $loop->index * 100 }}">
                            <img src="{{ Storage::url($news->featured_image) ?? 'https://picsum.photos/400/300' }}"
                                alt="{{ $news->title }}" class="w-full h-48 object-cover">
                            <div class="p-6">
                                <div class="text-sm text-gray-500">{{ $news->published_at->format('d M Y') }}</div>
                                <h3 class="mt-2 text-xl font-bold">{{ $news->title }}</h3>
                                <p class="mt-2 text-gray-600">{{ Str::limit($news->content, 100) }}</p>
                                <a href="{{ route('news.show', $news->slug) }}"
                                    class="mt-4 inline-block text-green-600 hover:text-green-700">Read More →</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        <!-- Featured Articles Section -->
        <section class="py-16 bg-gray-50" data-aos="fade-in">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <h2 class="text-3xl font-bold text-center mb-12" data-aos="fade-up">Artikel Pilihan</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    @foreach ($featuredArticles as $article)
                        <div class="bg-white rounded-lg shadow-lg overflow-hidden" data-aos="flip-up"
                            data-aos-delay="{{ $loop->index * 100 }}">
                            <img src="{{ Storage::url($article->image_url) ?? 'https://picsum.photos/400/300' }}"
                                alt="{{ $article->title }}" class="w-full h-48 object-cover">
                            <div class="p-6">
                                <div class="text-sm text-gray-500">{{ $article->published_at->format('d M Y') }}</div>
                                <h3 class="mt-2 text-xl font-bold">{{ $article->title }}</h3>
                                <p class="mt-2 text-gray-600">{{ Str::limit($article->content, 100) }}</p>
                                <a href="{{ route('articles.show', $article->slug) }}"
                                    class="mt-4 inline-block text-green-600 hover:text-green-700">Read More →</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>



        <!-- CTA Section -->
        <section class="relative bg-green-500 py-20 overflow-hidden" data-aos="fade-in">
            <!-- Animated Wave Background -->
            <div class="absolute inset-0 opacity-10">
                <svg class="w-full h-full" viewBox="0 0 1440 320" preserveAspectRatio="none">
                    <path fill="currentColor"
                        d="M0,96L48,112C96,128,192,160,288,160C384,160,480,128,576,112C672,96,768,96,864,112C960,128,1056,160,1152,160C1248,160,1344,128,1392,112L1440,96L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z">
                    </path>
                </svg>
            </div>

            <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center">
                    <h2 class="text-3xl font-extrabold text-white sm:text-4xl" data-aos="fade-up">
                        <span class="block">Siap untuk bergabung?</span>
                        <span class="block text-green-100">Daftar sekarang dan ikuti kegiatan kami.</span>
                    </h2>
                    <div class="mt-8 flex justify-center" data-aos="zoom-in" data-aos-delay="200">
                        <div class="inline-flex rounded-md shadow">
                            <a href="{{ route('programs.index') }}"
                                class="inline-flex items-center justify-center px-5 py-3 border border-transparent text-base font-medium rounded-md text-green-600 bg-white hover:bg-green-50">
                                Daftar Sekarang
                            </a>
                        </div>
                        <div class="ml-3 inline-flex">
                            <a href="{{ route('contact') }}"
                                class="inline-flex items-center justify-center px-5 py-3 border border-transparent text-base font-medium rounded-md text-white bg-green-600 hover:bg-green-700">
                                Hubungi Kami
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>


@endsection
