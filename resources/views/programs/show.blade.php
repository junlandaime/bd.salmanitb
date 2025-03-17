@extends('layouts.app')

@section('title', $program->title . ' - Program Bidang Dakwah Masjid Salman ITB')
@section('meta_description', Str::limit($program->description, 160))
@section('og_title', $program->title . ' - Program Bidang Dakwah Masjid Salman ITB')
@section('og_description', Str::limit($program->description, 200))
@section('og_image', 'https://bidangdakwah.salmanitb.com/storage/' . $program->featured_image)

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
    <!-- Hero Section -->
    <section class="py-12 lg:py-24 md:px-40 bg-white">
        <div class="container mx-auto px-4">
            <div class="flex flex-col lg:flex-row items-center justify-between">
                <!-- Text Content -->
                <div class="lg:w-1/2 mb-8 lg:mb-0" data-aos="fade-up" data-aos-duration="1000">
                    <h1 class="text-5xl font-semibold text-gray-800 mb-4">{{ $program->title }}</h1>
                    <p class="text-base text-gray-500">Bidang Dakwah YPM Salman ITB</p>
                </div>

                <!-- Image -->
                <div class="lg:w-1/2" data-aos="fade-up" data-aos-delay="200" data-aos-duration="1000">
                    <img src="{{ Storage::url($program->featured_image) }}" alt="{{ $program->title }}"
                        class="w-full h-auto rounded-lg shadow-lg">
                </div>
            </div>
        </div>
    </section>

    <section class="py-12 lg:py-24 md:px-40">
        <!-- Header Section -->
        <div class="mb-12" data-aos="fade-up" data-aos-duration="800">
            <h1 class="text-4xl md:text-5xl font-semibold text-gray-900 mb-6">{{ $program->title }}</h1>
            <p class="text-gray-700 text-lg">
                {{ $program->description }}
            </p>
        </div>

        <!-- Main Content -->
        <div class="flex flex-col md:flex-row gap-8 items-center">
            <!-- Image Section -->
            <div class="w-full md:w-1/2" data-aos="fade-right" data-aos-duration="1000">
                <img src="{{ Storage::url($program->featured_image) }}" alt="{{ $program->title }}"
                    class="w-full h-auto rounded-lg shadow-lg">
            </div>

            <!-- Description Section -->
            <div class="w-full md:w-1/2" data-aos="fade-left" data-aos-duration="1000" data-aos-delay="200">
                <h2 class="text-3xl font-semibold text-gray-900 mb-6">{{ $program->title }}</h2>
                <p class="text-gray-700 mb-4">
                    {!! nl2br(e($program->overview)) !!}
                </p>

            </div>
        </div>
    </section>

    <section>
        <div class="mx-auto px-4 md:px-40 py-12 md:py-16 bg-white">
            <div class="text-center mb-16" data-aos="fade-up" data-aos-duration="800">
                <h1 class="text-4xl md:text-5xl font-semibold mb-6">Kegiatan Layanan</h1>
                <p class="text-lg text-gray-700 max-w-4xl mx-auto">
                    Dalam rangka mendukung kelancaran ibadah dan kegiatan keagamaan, kami menyediakan berbagai kegiatan dan
                    layanan
                    {{ $program->title }}:
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 px-4">

                @forelse ($program->activities as $kegiatan)
                    <!-- Kajian Sabtu Dhuha -->
                    <div class="bg-white rounded-xl shadow-lg overflow-hidden transition-transform hover:scale-105"
                        data-aos="fade-up" data-aos-duration="800" data-aos-delay="200">
                        <div class="h-64 overflow-hidden">
                            <img src="{{ Storage::url($kegiatan->featured_image) }}" alt="{{ $kegiatan->title }}"
                                class="w-full h-full object-cover">
                        </div>
                        <div class="p-6 text-center">
                            <h2 class="text-2xl font-semibold mb-2">{{ $kegiatan->title }}</h2>
                            <div class="w-16 h-1 bg-green-500 mx-auto my-4"></div>
                            <p class="text-gray-600 mb-6">
                                {{ $kegiatan->description }}
                            </p>
                            <a href="#"
                                class="inline-flex items-center px-4 py-2 bg-green-500 hover:bg-green-600 text-white rounded-lg transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                Selengkapnya
                            </a>
                        </div>
                    </div>
                @empty
                @endforelse


                @forelse ($program->services as $layanan)
                    <!-- Layanan Sholat Jamaah -->
                    <div class="bg-white rounded-xl shadow-lg overflow-hidden transition-transform hover:scale-105"
                        data-aos="fade-up" data-aos-duration="800" data-aos-delay="100">
                        <div class="h-64 overflow-hidden">
                            <img src="{{ Storage::url($layanan->image) }}" alt="{{ $layanan->title }}"
                                class="w-full h-full
                                object-cover">
                        </div>
                        <div class="p-6 text-center">
                            <h2 class="text-2xl font-semibold mb-2">Layanan {{ $layanan->title }}</h2>
                            <div class="w-16 h-1 bg-green-500 mx-auto my-4"></div>
                            <p class="text-gray-600 mb-6">
                                Memastikan pelaksanaan sholat berjamaah lima waktu serta sholat Jumat dengan suasana yang
                                khusyuk dan tertib.
                            </p>
                            <a href="#"
                                class="inline-flex items-center px-4 py-2 bg-green-500 hover:bg-green-600 text-white rounded-lg transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                </svg>
                                Hubungi Kami
                            </a>
                        </div>
                    </div>
                @empty
                @endforelse



            </div>
        </div>
    </section>

    <!-- Engaging Topics Section -->
    <section class="py-20 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16" data-aos="fade-up" data-aos-duration="800">
                <h3 class="text-4xl font-semibold mb-6 relative inline-block">
                    <span
                        class="absolute -top-6 left-1/2 transform -translate-x-1/2 text-green-500 opacity-25 text-6xl">"</span>
                    Transformative Topics
                    <span
                        class="absolute -bottom-6 left-1/2 transform -translate-x-1/2 text-green-500 opacity-25 text-6xl rotate-180">"</span>
                </h3>
                <p class="text-lg text-gray-700 max-w-4xl mx-auto">
                    Embark on a journey of spiritual growth through our carefully crafted learning modules
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach ($program->topics as $topic)
                    <div class="bg-white rounded-xl shadow-lg overflow-hidden transition-transform hover:scale-105"
                        data-aos="fade-up" data-aos-duration="800" data-aos-delay="100">
                        <div class="h-1 bg-green-500"></div>
                        <div class="p-6 text-center">
                            <div class="w-16 h-16 bg-green-50 rounded-full flex items-center justify-center mb-6 mx-auto">
                                <i class="fas fa-{{ $topic->icon }} text-xl text-green-500"></i>
                            </div>

                            <h4 class="text-2xl font-semibold mb-4">{{ $topic->title }}</h4>
                            <p class="text-gray-600 mb-6">{{ $topic->description }}</p>
                            <div class="mt-6">
                                <a href="#schedule"
                                    class="inline-flex items-center px-4 py-2 bg-green-500 hover:bg-green-600 text-white rounded-lg transition-colors">
                                    Learn More
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Interactive Schedule Section -->
    <section id="schedule" class="py-20 bg-white relative overflow-hidden">
        <div class="absolute top-0 right-0 -mr-16 -mt-16">
            <svg width="404" height="404" fill="none" viewBox="0 0 404 404">
                <defs>
                    <pattern id="pattern-squares" x="0" y="0" width="20" height="20"
                        patternUnits="userSpaceOnUse">
                        <rect x="0" y="0" width="4" height="4" fill="rgba(22, 101, 52, 0.1)"></rect>
                    </pattern>
                </defs>
                <rect width="404" height="404" fill="url(#pattern-squares)"></rect>
            </svg>
        </div>

        <div class="container mx-auto px-4 relative z-10">
            <div class="max-w-4xl mx-auto">
                <div class="text-center mb-14" data-aos="fade-up" data-aos-duration="800">
                    <span
                        class="inline-block py-1 px-3 rounded-full text-xs font-semibold bg-green-100 text-green-800 mb-3">
                        Your Path to Knowledge
                    </span>
                    <h3 class="text-4xl font-semibold mb-4">Embark on Your Spiritual Journey</h3>
                    <p class="text-lg text-gray-700">Mark your calendar for enlightening sessions that nurture your soul
                    </p>
                </div>

                <div class="bg-white rounded-2xl shadow-xl overflow-hidden" data-aos="fade-up" data-aos-duration="800"
                    data-aos-delay="200">
                    <div class="flex flex-wrap">
                        <div class="w-full md:w-1/2 bg-green-50 p-8">
                            <div class="flex items-center mb-6">
                                <div
                                    class="w-12 h-12 flex-shrink-0 rounded-full bg-green-500 flex items-center justify-center">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <h4 class="ml-4 text-xl font-semibold">Weekly Gatherings</h4>
                            </div>
                            <ul class="space-y-6">
                                @foreach ($program->schedules->where('type', 'regular') as $schedule)
                                    <li class="flex flex-col space-y-2 border-b border-green-100 pb-4">
                                        <span class="text-lg font-medium text-gray-900">{{ $schedule->title }}</span>
                                        <div class="flex items-center text-gray-600">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                                </path>
                                            </svg>
                                            <span>{{ $schedule->day }}</span>
                                        </div>
                                        <div class="flex items-center text-gray-600">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                            <span>{{ date('h:i A', strtotime($schedule->start_time)) }} -
                                                {{ date('h:i A', strtotime($schedule->end_time)) }}</span>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                        <div class="w-full md:w-1/2 bg-white p-8">
                            <div class="flex items-center mb-6">
                                <div
                                    class="w-12 h-12 flex-shrink-0 rounded-full bg-yellow-500 flex items-center justify-center">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z">
                                        </path>
                                    </svg>
                                </div>
                                <h4 class="ml-4 text-xl font-semibold">Special Programs</h4>
                            </div>
                            <ul class="space-y-6">
                                @foreach ($program->schedules->where('type', 'special') as $schedule)
                                    <li class="flex flex-col space-y-2 border-b border-gray-100 pb-4">
                                        <span class="text-lg font-medium text-gray-900">{{ $schedule->title }}</span>
                                        <div class="flex items-center text-gray-600">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                                </path>
                                            </svg>
                                            <span>{{ $schedule->day }}</span>
                                        </div>
                                        <div class="flex items-center text-gray-600">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                            <span>{{ date('h:i A', strtotime($schedule->start_time)) }} -
                                                {{ date('h:i A', strtotime($schedule->end_time)) }}</span>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Inspiring Call-to-Action -->
    <section class="py-24 bg-gradient-to-br from-green-500 to-green-600 relative">
        <div class="absolute inset-0 opacity-10">
            <svg width="100%" height="100%" fill="none">
                <defs>
                    <pattern id="small-grid" width="20" height="20" patternUnits="userSpaceOnUse">
                        <path d="M 20 0 L 0 0 0 20" fill="none" stroke="white" stroke-width="0.5"></path>
                    </pattern>
                </defs>
                <rect width="100%" height="100%" fill="url(#small-grid)"></rect>
            </svg>
        </div>

        <div class="container mx-auto px-4 relative z-10">
            <div class="max-w-3xl mx-auto text-center" data-aos="fade-up" data-aos-duration="800">
                <h3 class="text-4xl font-semibold text-white mb-6">Begin Your Spiritual Journey with {{ $program->title }}
                </h3>
                <p class="text-white text-opacity-90 text-lg mb-10 leading-relaxed">
                    Deepen your faith, expand your horizons, and connect with a vibrant community dedicated to growth and
                    understanding
                </p>
                <div class="flex flex-col sm:flex-row justify-center items-center space-y-4 sm:space-y-0 sm:space-x-4">
                    <a href="#"
                        class="inline-flex items-center px-8 py-4 bg-white text-green-600 rounded-lg font-medium shadow-lg transition-transform hover:scale-105">
                        <span>Begin Your Journey</span>
                        <svg class="ml-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                        </svg>
                    </a>
                    <a href="#"
                        class="inline-flex items-center px-8 py-4 border-2 border-white text-white rounded-lg font-medium transition-all hover:bg-white hover:bg-opacity-10">
                        <svg class="mr-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                            </path>
                        </svg>
                        <span>Learn More</span>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Immersive Hero Section -->
    <section class="relative h-screen flex items-center justify-center overflow-hidden">
        <div class="absolute inset-0 z-0">
            <div class="absolute inset-0 bg-gradient-to-b from-transparent to-black opacity-70"></div>
            <video class="w-full h-full object-cover" autoplay loop muted poster="{{ $program->featured_image }}">
                <source src="{{ Storage::url($program->video_background ?? $program->featured_image) }}"
                    type="video/mp4">
            </video>
        </div>
        <div class="container relative z-10 mx-auto px-4">
            <div class="max-w-3xl mx-auto text-center">
                <h1 class="text-white font-serif text-6xl md:text-7xl leading-tight animate-fade-in-up">
                    {{ $program->title }}
                </h1>
                <p class="mt-6 text-xl text-gray-200 font-light leading-relaxed animate-fade-in-up animation-delay-300">
                    {{ $program->description }}
                </p>
                <div class="mt-10 animate-fade-in-up animation-delay-600">
                    <a href="#overview" class="group inline-flex items-center">
                        <span class="text-white text-lg mr-2">Explore the Journey</span>
                        <svg class="w-6 h-6 text-white transition-transform group-hover:translate-y-1" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
        <div class="absolute bottom-0 left-0 right-0 h-24 bg-gradient-to-t from-white to-transparent"></div>
    </section>

    <!-- Inspirational Overview -->
    <section id="overview" class="py-20 bg-white">
        <div class="container mx-auto px-4">
            <div class="flex flex-wrap items-center">
                <div class="w-full lg:w-6/12 px-4 mb-12 lg:mb-0">
                    <div class="relative">
                        <img src="{{ Storage::url($program->featured_image) }}" alt="{{ $program->title }}"
                            class="rounded-lg shadow-xl max-w-full h-auto" style="transform: rotate(-2deg);">
                        <div class="absolute -bottom-6 -right-6 w-32 h-32 bg-green-500 rounded-full flex items-center justify-center text-white font-semibold text-xl"
                            style="transform: rotate(15deg);">
                            Join Us!
                        </div>
                    </div>
                </div>
                <div class="w-full lg:w-6/12 px-4">
                    <div class="pl-0 lg:pl-12">
                        <h2 class="text-4xl font-serif mb-6 relative">
                            <span class="relative z-10">The Spirit of {{ $program->title }}</span>
                            <span class="absolute -bottom-3 left-0 w-20 h-1 bg-green-500"></span>
                        </h2>
                        <div class="prose prose-lg text-gray-700 space-y-6">
                            {!! nl2br(e($program->overview)) !!}
                        </div>
                        <blockquote class="italic text-gray-600 border-l-4 border-green-500 pl-4 my-8">
                            "Seeking knowledge is an obligation upon every Muslim." - Prophet Muhammad ﷺ
                        </blockquote>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Engaging Topics Section -->
    <section class="py-20 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <h3 class="inline-block text-3xl font-serif relative">
                    <span
                        class="absolute -top-6 left-1/2 transform -translate-x-1/2 text-green-500 opacity-25 text-6xl font-serif">"</span>
                    Transformative Topics
                    <span
                        class="absolute -bottom-6 left-1/2 transform -translate-x-1/2 text-green-500 opacity-25 text-6xl font-serif rotate-180">"</span>
                </h3>
                <p class="mt-4 max-w-2xl mx-auto text-gray-600">Embark on a journey of spiritual growth through our
                    carefully crafted learning modules</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
                @foreach ($program->topics as $topic)
                    <div
                        class="bg-white rounded-xl shadow-lg overflow-hidden transform transition duration-300 hover:-translate-y-2 hover:shadow-xl">
                        <div class="h-1 bg-green-500"></div>
                        <div class="p-8">
                            <div class="w-16 h-16 bg-green-50 rounded-full flex items-center justify-center mb-6 mx-auto">
                                {{-- <svg class="w-8 h-8 text-green-500" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="{{ $topic->icon }}"></path>
                                </svg> --}}
                                <i class="fas fa-{{ $topic->icon }} text-xl text-green-500"></i>
                            </div>

                            <h4 class="text-xl font-semibold text-center mb-4">{{ $topic->title }}</h4>
                            <p class="text-gray-600 text-center">{{ $topic->description }}</p>
                            <div class="mt-8 text-center">
                                <a href="#schedule" class="text-green-500 font-medium hover:underline">Learn More</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Interactive Schedule Section -->
    <section id="schedule" class="py-20 bg-white relative overflow-hidden">
        <div class="absolute top-0 right-0 -mr-16 -mt-16">
            <svg width="404" height="404" fill="none" viewBox="0 0 404 404">
                <defs>
                    <pattern id="pattern-squares" x="0" y="0" width="20" height="20"
                        patternUnits="userSpaceOnUse">
                        <rect x="0" y="0" width="4" height="4" fill="rgba(22, 101, 52, 0.1)"></rect>
                    </pattern>
                </defs>
                <rect width="404" height="404" fill="url(#pattern-squares)"></rect>
            </svg>
        </div>

        <div class="container mx-auto px-4 relative z-10">
            <div class="max-w-4xl mx-auto">
                <div class="text-center mb-14">
                    <span
                        class="inline-block py-1 px-3 rounded-full text-xs font-semibold bg-green-100 text-green-800 mb-3">Your
                        Path to Knowledge</span>
                    <h3 class="text-3xl font-serif">Embark on Your Spiritual Journey</h3>
                    <p class="mt-3 text-gray-600">Mark your calendar for enlightening sessions that nurture your soul</p>
                </div>

                <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
                    <div class="flex flex-wrap">
                        <div class="w-full md:w-1/2 bg-green-50 p-10">
                            <div class="flex items-center mb-6">
                                <div
                                    class="w-12 h-12 flex-shrink-0 rounded-full bg-green-500 flex items-center justify-center">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <h4 class="ml-4 text-xl font-semibold">Weekly Gatherings</h4>
                            </div>
                            <ul class="space-y-6">
                                @foreach ($program->schedules->where('type', 'regular') as $schedule)
                                    <li class="flex flex-col space-y-2 border-b border-green-100 pb-4">
                                        <span class="text-lg font-medium text-gray-900">{{ $schedule->title }}</span>
                                        <div class="flex items-center text-gray-600">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                                </path>
                                            </svg>
                                            <span>{{ $schedule->day }}</span>
                                        </div>
                                        <div class="flex items-center text-gray-600">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                            <span>{{ date('h:i A', strtotime($schedule->start_time)) }} -
                                                {{ date('h:i A', strtotime($schedule->end_time)) }}</span>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                        <div class="w-full md:w-1/2 bg-white p-10">
                            <div class="flex items-center mb-6">
                                <div
                                    class="w-12 h-12 flex-shrink-0 rounded-full bg-yellow-500 flex items-center justify-center">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z">
                                        </path>
                                    </svg>
                                </div>
                                <h4 class="ml-4 text-xl font-semibold">Special Programs</h4>
                            </div>
                            <ul class="space-y-6">
                                @foreach ($program->schedules->where('type', 'special') as $schedule)
                                    <li class="flex flex-col space-y-2 border-b border-gray-100 pb-4">
                                        <span class="text-lg font-medium text-gray-900">{{ $schedule->title }}</span>
                                        <div class="flex items-center text-gray-600">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                                </path>
                                            </svg>
                                            <span>{{ $schedule->day }}</span>
                                        </div>
                                        <div class="flex items-center text-gray-600">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                            <span>{{ date('h:i A', strtotime($schedule->start_time)) }} -
                                                {{ date('h:i A', strtotime($schedule->end_time)) }}</span>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Inspiring Call-to-Action -->
    <section class="py-24 bg-gradient-to-br from-green-500 to-green-600 relative">
        <div class="absolute inset-0 opacity-10">
            <svg width="100%" height="100%" fill="none">
                <defs>
                    <pattern id="small-grid" width="20" height="20" patternUnits="userSpaceOnUse">
                        <path d="M 20 0 L 0 0 0 20" fill="none" stroke="white" stroke-width="0.5"></path>
                    </pattern>
                </defs>
                <rect width="100%" height="100%" fill="url(#small-grid)"></rect>
            </svg>
        </div>

        <div class="container mx-auto px-4 relative z-10">
            <div class="max-w-3xl mx-auto text-center">
                <h3 class="text-4xl font-serif text-white mb-6">Begin Your Spiritual Journey with {{ $program->title }}
                </h3>
                <p class="text-white text-opacity-90 text-lg mb-10 leading-relaxed">
                    Deepen your faith, expand your horizons, and connect with a vibrant community dedicated to growth and
                    understanding
                </p>
                <div class="flex flex-col sm:flex-row justify-center items-center space-y-4 sm:space-y-0 sm:space-x-4">
                    <a href="#"
                        class="inline-flex items-center px-8 py-4 bg-white text-green-600 rounded-full font-medium shadow-lg transform transition duration-300 hover:-translate-y-1 hover:shadow-xl">
                        <span>Begin Your Journey</span>
                        <svg class="ml-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                        </svg>
                    </a>
                    <a href="#"
                        class="inline-flex items-center px-8 py-4 border-2 border-white text-white rounded-full font-medium transform transition duration-300 hover:-translate-y-1 hover:bg-white hover:bg-opacity-10">
                        <svg class="mr-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                            </path>
                        </svg>
                        <span>Learn More</span>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials -->
    <section class="py-20 bg-white">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <h3 class="text-3xl font-serif mb-4">Voices from Our Community</h3>
                <p class="text-gray-600 max-w-2xl mx-auto">Hear from those whose lives have been transformed</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-gray-50 p-8 rounded-lg relative">
                    <div class="absolute -top-4 -right-4 text-green-500 text-5xl font-serif">"</div>
                    <p class="text-gray-700 italic mb-6">Joining this program has deepened my understanding of faith and
                        brought a sense of peace to my daily life.</p>
                    <div class="flex items-center">
                        <img src="/api/placeholder/48/48" alt="Member" class="w-12 h-12 rounded-full">
                        <div class="ml-4">
                            <h5 class="font-medium">Ahmad Saputra</h5>
                            <p class="text-sm text-gray-500">Member since 2021</p>
                        </div>
                    </div>
                </div>

                <div class="bg-gray-50 p-8 rounded-lg relative">
                    <div class="absolute -top-4 -right-4 text-green-500 text-5xl font-serif">"</div>
                    <p class="text-gray-700 italic mb-6">The community I've found here has become like family. The
                        teachings have given me guidance through difficult times.</p>
                    <div class="flex items-center">
                        <img src="/api/placeholder/48/48" alt="Member" class="w-12 h-12 rounded-full">
                        <div class="ml-4">
                            <h5 class="font-medium">Siti Nurhaliza</h5>
                            <p class="text-sm text-gray-500">Member since 2020</p>
                        </div>
                    </div>
                </div>

                <div class="bg-gray-50 p-8 rounded-lg relative">
                    <div class="absolute -top-4 -right-4 text-green-500 text-5xl font-serif">"</div>
                    <p class="text-gray-700 italic mb-6">As a parent, I'm grateful my children have this place to learn
                        values and develop their spiritual foundation.</p>
                    <div class="flex items-center">
                        <img src="/api/placeholder/48/48" alt="Member" class="w-12 h-12 rounded-full">
                        <div class="ml-4">
                            <h5 class="font-medium">Rudi Hartono</h5>
                            <p class="text-sm text-gray-500">Member since 2022</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
