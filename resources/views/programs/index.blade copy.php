@extends('layouts.app')

@section('content')
<!-- Inspirational Hero Section -->
<section class="relative min-h-screen flex items-center justify-center overflow-hidden" id="hero">
    <div class="absolute inset-0 z-0">
        <div class="absolute inset-0 bg-gradient-to-b from-black via-transparent to-black opacity-60"></div>
        <video class="w-full h-full object-cover" autoplay loop muted playsinline
            poster='https://picsum.photos/1920/1081'>
            <source src="{{ asset('videos/islamic-background.mp4') }}" type="video/mp4">
        </video>
    </div>
    <div class="container relative z-10 mx-auto px-4">
        <div class="max-w-3xl mx-auto text-center">
            <h1 class="text-white font-serif text-5xl md:text-6xl leading-tight animate-fade-in-up">
                <span class="block">Program & Kegiatan</span>
                <span class="text-green-400">Masjid Salman ITB</span>
            </h1>
            <p class="mt-6 text-xl text-gray-200 font-light leading-relaxed animate-fade-in-up animation-delay-300">
                Menginspirasi, Membangun, dan Menguatkan Generasi Muslim Melalui Program Dakwah yang Bermanfaat
            </p>
            <div class="mt-10 animate-fade-in-up animation-delay-600">
                <a href="#programs"
                    class="group inline-flex items-center transition-all duration-300 hover:text-green-400">
                    <span class="text-white text-lg mr-2">Mulai Perjalanan Anda</span>
                    <svg class="w-6 h-6 text-white transition-transform duration-300 group-hover:translate-y-1 group-hover:text-green-400"
                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
                    </svg>
                </a>
            </div>
        </div>
    </div>
    <!-- Geometric Islamic Pattern Overlay -->
    <div class="absolute bottom-0 left-0 right-0 h-32 bg-gradient-to-t from-gray-50 to-transparent"></div>
    <div class="absolute top-0 left-0 w-full h-full pointer-events-none opacity-15">
        <svg class="w-full h-full" preserveAspectRatio="none" viewBox="0 0 1200 1200"
            xmlns="http://www.w3.org/2000/svg">
            <pattern id="islamic-pattern" x="0" y="0" width="60" height="60" patternUnits="userSpaceOnUse">
                <path d="M0,30 L30,0 L60,30 L30,60 Z" fill="none" stroke="white" stroke-width="1"></path>
                <path d="M0,30 C0,15 15,0 30,0 C45,0 60,15 60,30 C60,45 45,60 30,60 C15,60 0,45 0,30 Z" fill="none"
                    stroke="white" stroke-width="1"></path>
            </pattern>
            <rect width="100%" height="100%" fill="url(#islamic-pattern)"></rect>
        </svg>
    </div>
</section>

<!-- Programs Section with Islamic Design Elements -->
<section id="programs" class="py-20 bg-gray-50 relative">
    <!-- Decorative Elements - Islamic Arch Style Corner -->
    <div class="absolute top-0 right-0 w-64 h-64 opacity-10">
        <svg viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
            <path d="M100,0 C70,0 50,20 50,50 C50,80 70,100 100,100 Z" fill="#128C7E"></path>
        </svg>
    </div>
    <div class="absolute bottom-0 left-0 w-64 h-64 opacity-10 transform rotate-180">
        <svg viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
            <path d="M100,0 C70,0 50,20 50,50 C50,80 70,100 100,100 Z" fill="#128C7E"></path>
        </svg>
    </div>

    <div class="container mx-auto px-4 relative z-10">
        <div class="text-center mb-16">
            <div class="inline-block mb-4">
                <div class="w-16 h-1 mx-auto bg-green-500 mb-1"></div>
                <div class="w-10 h-1 mx-auto bg-green-500 mb-1"></div>
                <div class="w-6 h-1 mx-auto bg-green-500"></div>
            </div>
            <h2 class="text-4xl font-serif mb-4">Program Bidang Dakwah</h2>
            <p class="text-lg text-gray-600 max-w-xl mx-auto">
                Menghidupkan Islam dalam kehidupan sehari-hari melalui program-program yang dirancang untuk semua
                kalangan
            </p>
        </div>

        <!-- Program Cards with Islamic-Inspired Design -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
            @foreach ($programs as $program)
            <div
                class="group relative overflow-hidden rounded-lg shadow-lg bg-white transform transition duration-300 hover:-translate-y-2 hover:shadow-xl">
                <!-- Decorative Islamic Pattern Hover Overlay -->
                <div
                    class="absolute inset-0 bg-green-500 opacity-0 group-hover:opacity-20 transition-opacity duration-300 pointer-events-none">
                    <svg class="w-full h-full" preserveAspectRatio="none" viewBox="0 0 100 100"
                        xmlns="http://www.w3.org/2000/svg">
                        <pattern id="program-pattern-{{ $program->id }}" x="0" y="0" width="10" height="10"
                            patternUnits="userSpaceOnUse">
                            <path d="M0,5 L5,0 L10,5 L5,10 Z" fill="none" stroke="currentColor"
                                stroke-width="0.5"></path>
                        </pattern>
                        <rect width="100%" height="100%" fill="url(#program-pattern-{{ $program->id }})"></rect>
                    </svg>
                </div>

                <div class="relative">
                    <div class="h-64 overflow-hidden">
                        <img alt="{{ $program->title }}"
                            src="https://picsum.photos/seed/{{ $program->id }}/400/300"
                            class="w-full h-full object-cover transform transition duration-500 group-hover:scale-110">
                    </div>

                    <!-- Arch-styled overlay on image -->
                    <div
                        class="absolute bottom-0 left-0 right-0 h-24 bg-gradient-to-t from-black to-transparent opacity-70">
                    </div>

                    <!-- Green ornamental border - Islamic inspired -->
                    <div class="absolute top-0 left-0 w-full h-1 bg-green-500 opacity-70"></div>
                    <div class="absolute bottom-0 left-0 right-0">
                        <svg viewBox="0 0 1200 30" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M0,0 Q300,30 600,0 T1200,0 V30 H0 Z" fill="#10B981" opacity="0.7"></path>
                        </svg>
                    </div>
                </div>

                <div class="p-6">
                    <h3
                        class="text-xl font-semibold mb-3 group-hover:text-green-600 transition-colors duration-300">
                        {{ $program->title }}
                    </h3>
                    <p class="text-gray-600 mb-6">
                        {{ $program->description }}
                    </p>
                    <div class="flex justify-between items-center">
                        <a href="{{ route('programs.show', $program->slug) }}"
                            class="inline-flex items-center text-green-600 font-medium hover:text-green-800 transition-colors duration-300">
                            <span>Lihat Program</span>
                            <svg class="w-4 h-4 ml-2 transform transition-transform duration-300 group-hover:translate-x-1"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                            </svg>
                        </a>
                        <div
                            class="w-10 h-10 flex items-center justify-center rounded-full bg-green-50 text-green-600">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M12 4v16m8-8H4"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Featured Activities with Islamic Inspiration -->
@if ($featuredActivities->count() > 0)
<section class="py-20 bg-white relative overflow-hidden">
    <!-- Islamic Geometric Background Pattern -->
    <div class="absolute inset-0 pointer-events-none opacity-5">
        <svg width="100%" height="100%" xmlns="http://www.w3.org/2000/svg">
            <pattern id="featured-pattern" patternUnits="userSpaceOnUse" width="80" height="80" x="0"
                y="0">
                <g fill="none" stroke="#128C7E" stroke-width="0.5">
                    <path d="M0,40 L40,0 L80,40 L40,80 Z"></path>
                    <path d="M40,0 A40,40 0 0,1 80,40 A40,40 0 0,1 40,80 A40,40 0 0,1 0,40 A40,40 0 0,1 40,0">
                    </path>
                    <path d="M20,20 L60,20 L60,60 L20,60 Z"></path>
                    <circle cx="40" cy="40" r="20"></circle>
                </g>
            </pattern>
            <rect width="100%" height="100%" fill="url(#featured-pattern)"></rect>
        </svg>
    </div>

    <div class="container mx-auto px-4 relative z-10">
        <div class="text-center mb-16">
            <div class="inline-block relative">
                <span
                    class="inline-block w-3 h-3 bg-green-500 opacity-50 rounded-full absolute -left-6 -top-6"></span>
                <span
                    class="inline-block w-3 h-3 bg-green-500 opacity-50 rounded-full absolute -right-6 -top-6"></span>
                <span
                    class="inline-block w-3 h-3 bg-green-500 opacity-50 rounded-full absolute -left-6 -bottom-6"></span>
                <span
                    class="inline-block w-3 h-3 bg-green-500 opacity-50 rounded-full absolute -right-6 -bottom-6"></span>
                <h2 class="text-4xl font-serif relative">Kegiatan Unggulan</h2>
            </div>
            <p class="mt-4 text-lg text-gray-600 max-w-2xl mx-auto">
                Bergabunglah dengan kegiatan-kegiatan inspiratif yang telah mengubah kehidupan ribuan muslim
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
            @foreach ($featuredActivities as $activity)
            <div
                class="group bg-white rounded-lg shadow-lg overflow-hidden transform transition duration-300 hover:-translate-y-2 hover:shadow-xl">
                <div class="relative overflow-hidden">
                    <img alt="{{ $activity->title }}" src="{{ $activity->image_url }}"
                        class="w-full h-64 object-cover transform transition duration-500 group-hover:scale-110">

                    <!-- Islamic Arch Overlay -->
                    <div class="absolute bottom-0 left-0 right-0">
                        <svg viewBox="0 0 100 12" preserveAspectRatio="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path d="M0,12 Q25,0 50,12 T100,12 V12 H0 Z" fill="white"></path>
                        </svg>
                    </div>

                    <!-- Activity Program Tag -->
                    <div class="absolute top-4 right-4">
                        <span
                            class="px-3 py-1 bg-green-500 bg-opacity-90 text-white text-xs font-medium rounded-full shadow-md">
                            {{ $activity->program->title }}
                        </span>
                    </div>
                </div>

                <div class="px-6 py-6">
                    <div class="flex items-center mb-4">
                        <div
                            class="w-10 h-10 flex-shrink-0 rounded-full bg-green-50 flex items-center justify-center mr-3">
                            <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <h3
                            class="text-xl font-semibold group-hover:text-green-600 transition-colors duration-300">
                            {{ $activity->title }}
                        </h3>
                    </div>

                    <p class="text-gray-600 mb-6">
                        {{ Str::limit($activity->description, 120) }}
                    </p>

                    <div class="flex justify-between items-center">
                        <a href="{{ route('activities.show', $activity->slug) }}"
                            class="inline-flex items-center text-green-600 font-medium hover:text-green-800 transition-colors duration-300">
                            <span>Selengkapnya</span>
                            <svg class="w-4 h-4 ml-2 transform transition-transform duration-300 group-hover:translate-x-1"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                            </svg>
                        </a>

                        <!-- Muslim Calendar Date Icon - Replace with actual dates -->
                        <div class="flex items-center text-sm text-gray-500">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                </path>
                            </svg>
                            <span>Ramadhan 1444H</span>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- See All Activities Button -->
        <div class="text-center mt-16">
            <a href="{{ route('activities.index') }}"
                class="inline-flex items-center px-6 py-3 bg-green-500 text-white rounded-full font-medium shadow-md transform transition duration-300 hover:-translate-y-1 hover:shadow-lg hover:bg-green-600">
                <span>Lihat Semua Kegiatan</span>
                <svg class="ml-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                </svg>
            </a>
        </div>
    </div>
</section>
@endif

<!-- Islamic Quote Section -->
<section class="py-20 bg-green-50 relative overflow-hidden">
    <div class="absolute inset-0 bg-opacity-50">
        <svg class="w-full h-full opacity-5" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
            <pattern id="quote-pattern" patternUnits="userSpaceOnUse" width="100" height="100">
                <path
                    d="M30,10 L70,10 C80,10 90,20 90,30 L90,70 C90,80 80,90 70,90 L30,90 C20,90 10,80 10,70 L10,30 C10,20 20,10 30,10 Z"
                    fill="none" stroke="#128C7E" stroke-width="0.5"></path>
            </pattern>
            <rect width="100%" height="100%" fill="url(#quote-pattern)"></rect>
        </svg>
    </div>

    <div class="container mx-auto px-4 relative z-10">
        <div class="max-w-4xl mx-auto text-center">
            <div class="text-green-600 text-6xl font-serif mb-6 opacity-25">"</div>
            <blockquote class="text-2xl md:text-3xl font-serif text-gray-800 leading-relaxed mb-8">
                Sesungguhnya Allah tidak akan mengubah keadaan suatu kaum sebelum mereka mengubah keadaan diri mereka
                sendiri
            </blockquote>
            <p class="text-green-600 font-medium text-lg">QS. Ar-Ra'd 13:11</p>
        </div>
    </div>
</section>

<!-- Call to Action Section -->
<section class="py-16 bg-gradient-to-br from-green-600 to-green-700 relative overflow-hidden">
    <div class="absolute inset-0 opacity-10">
        <svg width="100%" height="100%" fill="none">
            <defs>
                <pattern id="cta-grid" width="40" height="40" patternUnits="userSpaceOnUse">
                    <path d="M 40 0 L 0 0 0 40" fill="none" stroke="white" stroke-width="0.5"></path>
                </pattern>
            </defs>
            <rect width="100%" height="100%" fill="url(#cta-grid)"></rect>
        </svg>
    </div>

    <div class="container mx-auto px-4 relative z-10">
        <div class="max-w-3xl mx-auto text-center">
            <h3 class="text-3xl font-serif text-white mb-6">Bergabunglah Dengan Kami</h3>
            <p class="text-white text-opacity-90 text-lg mb-10 leading-relaxed">
                Mari bersama-sama membangun peradaban Islam yang lebih baik melalui ilmu dan amal yang bermanfaat
            </p>
            <div class="flex flex-col sm:flex-row justify-center items-center space-y-4 sm:space-y-0 sm:space-x-4">
                <a href="{{ route('register') }}"
                    class="inline-flex items-center px-8 py-4 bg-white text-green-600 rounded-full font-medium shadow-lg transform transition duration-300 hover:-translate-y-1 hover:shadow-xl">
                    <span>Daftar Sekarang</span>
                    <svg class="ml-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                    </svg>
                </a>
                {{-- <a href="{{ route('contact') }}"
                class="inline-flex items-center px-8 py-4 border-2 border-white text-white rounded-full font-medium transform transition duration-300 hover:-translate-y-1 hover:bg-white hover:bg-opacity-10">
                <span>Hubungi Kami</span>
                <svg class="ml-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                    </path>
                </svg>
                </a> --}}
            </div>
        </div>
    </div>

    <div class="absolute bottom-0 left-0 right-0">
        <svg viewBox="0 0 1200 30" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M0,0 Q300,30 600,0 T1200,0 V30 H0 Z" fill="white"></path>
        </svg>
    </div>
</section>
@endsection