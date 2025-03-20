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
    <header class="relative pt-16 pb-32 flex content-center items-center justify-center" style="min-height: 50vh;">
        <div class="absolute top-0 w-full h-full bg-center bg-cover" style='background-image: url("{{ asset('bd3.jpg') }}");'>
            <span class="w-full h-full absolute opacity-50 bg-black"></span>
        </div>
        <div class="container relative mx-auto px-4">
            <div class="items-center flex flex-wrap">
                <div class="w-full lg:w-8/12 px-4 ml-auto mr-auto text-center">
                    <div class="pr-12">
                        <div class="flex justify-center items-center space-x-4 mb-6">
                            <span class="px-3 py-1 rounded-full text-sm font-medium"
                                style="background-color: #05966920; color: #059669">
                                Program
                            </span>
                            <span class="text-white">{{ date('d F Y') }}</span>
                        </div>
                        <!-- Animated Title -->
                        <div x-data="{ text: '', fullText: 'Program & Kegiatan', charIndex: 0 }" x-init="() => {
                            const interval = setInterval(() => {
                                if (charIndex <= fullText.length) {
                                    text = fullText.substring(0, charIndex);
                                    charIndex++;
                                } else {
                                    clearInterval(interval);
                                }
                            }, 100);
                        }">
                            <h1 class="text-white font-semibold text-5xl mb-6">
                                <span x-text="text"></span>
                                <span class="animate-pulse">|</span>
                            </h1>
                        </div>
                        <div class="flex items-center justify-center">
                            <p class="text-gray-200">
                                Menebarkan cahaya ilmu dan keimanan melalui program-program unggulan
                                Bidang Dakwah Masjid Salman ITB untuk membangun peradaban Islami yang berdampak
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Breadcrumb -->
    <div class="bg-white shadow-sm w-full top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <nav class="flex py-3 text-gray-700 text-sm">
                <ol class="inline-flex items-center space-x-1 md:space-x-3">
                    <li class="inline-flex items-center">
                        <a href="{{ route('home') }}" class="inline-flex items-center text-gray-600 hover:text-green-500">
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
                            <span class="ml-1 text-green-500 font-medium md:ml-2">Program & Kegiatan</span>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>
    </div>

    <!-- Program Section with Modern Hover Effects -->
    <section id="programs" class="py-24 lg:px-32 bg-white">
        <div class="container mx-auto px-4">


            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-green-600 to-emerald-500">
                    Eksplorasi Program
                </h2>
                <div class="h-1 w-20 bg-gradient-to-r from-green-600 to-emerald-500 mx-auto my-6"></div>
                <p class="max-w-2xl mx-auto text-lg text-gray-600">
                    Temukan program yang sesuai dengan kebutuhan spiritual dan intelektual Anda
                </p>
            </div>

            <!-- Interactive Program Grid -->
            <div class="flex flex-wrap">
                @foreach ($programs as $program)
                    <div
                        class="w-full md:w-4/12 px-4 text-center mb-12 transform transition duration-500 hover:-translate-y-2">
                        <div
                            class="relative flex flex-col min-w-0 break-words bg-white w-full shadow-xl rounded-lg overflow-hidden group">
                            <div class="relative overflow-hidden">
                                <img alt="{{ $program->title }}" src="{{ Storage::url($program->featured_image) }}"
                                    class="w-full align-middle rounded-t-lg transition duration-500 group-hover:scale-110">
                                <div
                                    class="absolute inset-0 bg-gradient-to-t from-green-900 to-transparent opacity-0 group-hover:opacity-70 transition duration-300">
                                </div>
                            </div>
                            <div class="px-6 py-6 flex-auto">
                                <div
                                    class="inline-flex items-center justify-center w-12 h-12 mb-5 rounded-full bg-green-100 text-green-600 mx-auto">
                                    <i
                                        class="fas fa-{{ ['mosque', 'book-open', 'users', 'hands-helping', 'graduation-cap', 'hand-holding-droplet'][$loop->index % 6] }} text-xl"></i>
                                </div>
                                <h6 class="text-2xl font-bold">{{ $program->title }}</h6>
                                <p class="mt-3 mb-5 text-gray-600 leading-relaxed">
                                    {{ $program->description }}
                                </p>
                                <a href="{{ route('programs.show', $program->slug) }}"
                                    class="group relative inline-flex items-center justify-center overflow-hidden rounded-full border-2 border-green-500 p-4 px-6 py-3 font-medium text-white transition duration-300 ease-out">
                                    <span class="absolute inset-0 bg-gradient-to-r from-green-500 to-emerald-600"></span>
                                    <span
                                        class="ease absolute bottom-0 left-0 h-1 w-0 bg-white transition-all duration-500 group-hover:w-full"></span>
                                    <span
                                        class="ease absolute right-0 top-0 h-0 w-0 border-t-2 border-white transition-all duration-500 group-hover:w-full"></span>
                                    <span
                                        class="ease absolute bottom-0 right-0 h-0 w-0 border-b-2 border-white transition-all duration-500 group-hover:h-full"></span>
                                    <span
                                        class="ease absolute left-0 top-0 h-0 w-0 border-l-2 border-white transition-all duration-500 group-hover:h-full"></span>
                                    <span class="relative font-semibold tracking-wider">
                                        Lihat Program <i class="fas fa-arrow-right ml-2"></i>
                                    </span>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Featured Programs with Modern Timeline Effect -->
    @if ($featuredActivities->count() > 0)
        <section class="py-24 lg:px-32 bg-gray-50 relative overflow-hidden">
            <!-- Decorative Elements -->
            <div class="absolute -right-24 -top-24 w-96 h-96 bg-green-100 rounded-full opacity-50"></div>
            <div class="absolute -left-24 -bottom-24 w-96 h-96 bg-green-100 rounded-full opacity-50"></div>

            <div class="container mx-auto px-4 relative z-10">
                <div class="flex flex-wrap justify-center text-center mb-16">
                    <div class="w-full lg:w-7/12 px-4">
                        <span
                            class="text-xs font-semibold inline-block py-1 px-2 uppercase rounded-full text-green-600 bg-green-200 mb-4">Direkomendasikan</span>
                        <h2 class="text-5xl font-bold mb-2">Kegiatan <span
                                class="bg-clip-text text-transparent bg-gradient-to-r from-green-600 to-emerald-500">Unggulan</span>
                        </h2>
                        <div class="h-1 w-24 bg-gradient-to-r from-green-600 to-emerald-500 mx-auto my-4"></div>
                        <p class="text-xl leading-relaxed mt-6 text-gray-600">
                            Kegiatan pilihan yang dirancang untuk memaksimalkan manfaat bagi Anda dan masyarakat
                        </p>
                    </div>
                </div>

                <div class="flex flex-wrap items-stretch">
                    @foreach ($featuredActivities as $activity)
                        <div class="w-full md:w-4/12 px-4 mb-12 transform transition duration-500 hover:-translate-y-2">
                            <div
                                class="relative flex flex-col h-full min-w-0 break-words bg-white w-full shadow-xl rounded-lg overflow-hidden">
                                <div class="relative">
                                    <div
                                        class="absolute top-0 left-0 w-full h-full bg-gradient-to-b from-black opacity-60 z-10">
                                    </div>
                                    <img alt="{{ $activity->title }}" src="{{ Storage::url($activity->featured_image) }}"
                                        class="w-full align-middle rounded-t-lg h-64 object-cover">
                                    <div class="absolute top-0 left-0 p-4 z-20">
                                        <span
                                            class="inline-block px-3 py-1 text-xs font-semibold bg-green-500 text-white rounded-full">
                                            {{ $activity->program->title }}
                                        </span>
                                    </div>
                                    <div class="absolute bottom-0 left-0 p-4 z-20">
                                        <h6 class="text-2xl font-bold text-white">{{ $activity->title }}</h6>
                                        @if ($activity->start_date)
                                            <div class="flex items-center text-white opacity-80 text-sm mt-2">
                                                <i class="far fa-calendar-alt mr-2"></i>
                                                {{ \Carbon\Carbon::parse($activity->start_date)->format('d M Y') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="px-6 py-6 flex-auto flex flex-col justify-between flex-grow">
                                    <div>
                                        <p class="text-gray-600 leading-relaxed">
                                            {{ Str::limit($activity->description, 120) }}
                                        </p>
                                        @if ($activity->location)
                                            <div class="flex items-center text-gray-500 text-sm mt-4">
                                                <i class="fas fa-map-marker-alt mr-2 text-green-500"></i>
                                                {{ $activity->location }}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="mt-5 pt-5 border-t border-gray-200">
                                        <a href="{{ route('activities.show', $activity->slug) }}"
                                            class="inline-block bg-white border-2 border-green-500 text-green-600 hover:bg-green-500 hover:text-white font-bold uppercase text-sm px-6 py-3 rounded-full shadow hover:shadow-lg outline-none focus:outline-none ease-linear transition-all duration-150 w-full text-center">
                                            Selengkapnya <i class="fas fa-long-arrow-alt-right ml-2"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- View All Button -->
                <div class="text-center mt-6">
                    <a href="{{ route('activities.index') }}"
                        class="group relative inline-flex items-center justify-center overflow-hidden rounded-full border-2 border-green-500 p-4 px-8 py-4 font-medium text-white transition duration-300 ease-out">
                        <span class="absolute inset-0 bg-gradient-to-r from-green-600 to-green-700"></span>
                        <span
                            class="ease absolute bottom-0 left-0 h-1 w-0 bg-white transition-all duration-500 group-hover:w-full"></span>
                        <span
                            class="ease absolute right-0 top-0 h-0 w-0 border-t-2 border-white transition-all duration-500 group-hover:w-full"></span>
                        <span
                            class="ease absolute bottom-0 right-0 h-0 w-0 border-b-2 border-white transition-all duration-500 group-hover:h-full"></span>
                        <span
                            class="ease absolute left-0 top-0 h-0 w-0 border-l-2 border-white transition-all duration-500 group-hover:h-full"></span>
                        <span class="relative font-semibold tracking-wider">
                            Lihat Semua Kegiatan <i class="fas fa-chevron-right ml-2"></i>
                        </span>
                    </a>
                </div>
            </div>
        </section>
    @endif

    <!-- Testimonial Section with Modern Cards -->
    {{-- <section class="py-24 lg:px-32 bg-white">
        <div class="container mx-auto px-4">
            <div class="flex flex-wrap justify-center text-center mb-16">
                <div class="w-full lg:w-6/12 px-4">
                    <h2 class="text-5xl font-bold mb-2">Apa Kata <span
                            class="bg-clip-text text-transparent bg-gradient-to-r from-green-600 to-emerald-500">Mereka</span>
                    </h2>
                    <div class="h-1 w-24 bg-gradient-to-r from-green-600 to-emerald-500 mx-auto my-4"></div>
                    <p class="text-xl leading-relaxed mt-6 text-gray-600">
                        Pengalaman peserta program dakwah Masjid Salman ITB
                    </p>
                </div>
            </div>

            <div class="flex flex-wrap">
                @for ($i = 0; $i < 3; $i++)
                    <div class="w-full md:w-4/12 px-4 mb-8">
                        <div class="bg-gray-50 rounded-lg p-8 shadow-md hover:shadow-xl transition-shadow duration-300">
                            <div class="text-green-500 mb-4">
                                <i class="fas fa-quote-left text-3xl"></i>
                            </div>
                            <p class="text-gray-700 italic mb-6 leading-relaxed">
                                "Program ini telah mengubah cara pandang saya terhadap Islam. Saya belajar bahwa agama tidak
                                hanya tentang ritual, tetapi juga tentang membangun peradaban dan memberikan manfaat kepada
                                sesama."
                            </p>
                            <div class="flex items-center">
                                <div class="w-12 h-12 rounded-full bg-green-200 flex items-center justify-center mr-4">
                                    <span class="text-green-600 font-bold">{{ chr(65 + $i) }}</span>
                                </div>
                                <div>
                                    <h6 class="font-semibold">Peserta Program {{ ['Taklim', 'Mentoring', 'Kajian'][$i] }}
                                    </h6>
                                    <p class="text-xs text-gray-500">
                                        {{ ['Mahasiswa ITB', 'Alumni', 'Masyarakat Umum'][$i] }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endfor
            </div>
        </div>
    </section> --}}

    <!-- Call to Action with Modern Design -->
    <section class="relative py-32">
        <div class="absolute inset-0 bg-gradient-to-r from-green-600 to-green-800">
            <img src="https://picsum.photos/1920/500" alt="Background" class="w-full h-full object-cover opacity-20">
        </div>
        <div class="container mx-auto px-4 relative z-10">
            <div class="flex flex-wrap items-center">
                <div class="w-full lg:w-7/12 px-4 ml-auto mr-auto text-center">
                    <h2 class="text-white font-bold text-5xl mb-6">Siap untuk bergabung?</h2>
                    <p class="text-xl text-gray-100 mb-8 leading-relaxed">
                        Jadilah bagian dari perjalanan membangun peradaban Islam melalui program-program dakwah yang
                        inspiratif dan bermanfaat
                    </p>
                    <a href="{{ route('contact') }}"
                        class="group relative inline-flex items-center justify-center overflow-hidden rounded-full border-2 border-white p-4 px-8 py-4 font-medium text-green-700 transition duration-300 ease-out">
                        <span class="absolute inset-0 bg-white"></span>
                        <span
                            class="ease absolute bottom-0 left-0 h-1 w-0 bg-green-500 transition-all duration-500 group-hover:w-full"></span>
                        <span
                            class="ease absolute right-0 top-0 h-0 w-0 border-t-2 border-green-500 transition-all duration-500 group-hover:w-full"></span>
                        <span
                            class="ease absolute bottom-0 right-0 h-0 w-0 border-b-2 border-green-500 transition-all duration-500 group-hover:h-full"></span>
                        <span
                            class="ease absolute left-0 top-0 h-0 w-0 border-l-2 border-green-500 transition-all duration-500 group-hover:h-full"></span>
                        <span class="relative font-semibold tracking-wider">
                            Daftar Sekarang <i class="fas fa-user-plus ml-2"></i>
                        </span>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Newsletter Subscription with Modern Form -->
    {{-- <section class="py-12 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="flex flex-wrap items-center">
                <div class="w-full md:w-6/12 px-4 ml-auto mr-auto text-center md:text-left">
                    <h4 class="text-2xl font-semibold mb-2">Dapatkan Informasi Terbaru</h4>
                    <p class="text-gray-600">
                        Berlangganan newsletter kami untuk mendapatkan informasi terbaru tentang program dan kegiatan dakwah
                    </p>
                </div>
                <div class="w-full md:w-5/12 px-4 ml-auto mr-auto mt-8 md:mt-0">
                    <form class="flex flex-col md:flex-row">
                        <input type="email"
                            class="rounded-l-lg md:rounded-r-none px-4 py-3 w-full md:w-2/3 focus:outline-none focus:ring-2 focus:ring-green-500 border border-gray-300"
                            placeholder="Alamat Email Anda">
                        <button
                            class="bg-gradient-to-r from-green-500 to-emerald-600 text-white rounded-r-lg md:rounded-l-none px-6 py-3 w-full md:w-auto mt-3 md:mt-0 font-semibold hover:from-green-600 hover:to-emerald-700 transition duration-200">
                            Berlangganan
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section> --}}
@endsection
