@extends('layouts.app')

@section('content')
    <!-- Dynamic Hero Section with Parallax Effect -->
    <section class="relative pt-20 pb-36 flex content-center items-center justify-center" style="min-height: 80vh;">
        <div class="absolute top-0 w-full h-full bg-center bg-cover"
            style='background-image: url("https://picsum.photos/1920/1081");'>
            <span class="w-full h-full absolute opacity-60 bg-gradient-to-r from-green-900 to-black"></span>
        </div>
        <div class="absolute w-full h-full bg-pattern-islamic opacity-10"></div>
        <div class="container relative mx-auto">
            <div class="items-center flex flex-wrap">
                <div class="w-full lg:w-7/12 px-4 ml-auto mr-auto text-center">
                    <div class="pr-12 animate-fade-in-up">
                        <h1 class="text-white font-bold text-6xl mb-6">
                            Program & Kegiatan
                        </h1>
                        <h1 class="text-white font-bold text-4xl mb-6">
                            Bidang Dakwah Masjid Salman ITB
                        </h1>
                        <div class="h-1 w-32 bg-green-400 mx-auto mb-6"></div>
                        <p class="mt-4 text-xl text-gray-100 leading-relaxed">
                            Menebarkan cahaya ilmu dan keimanan melalui program-program unggulan
                            Bidang Dakwah Masjid Salman ITB untuk membangun peradaban Islami yang berdampak
                        </p>
                        <div class="mt-8">
                            <a href="#programs" class="animate-bounce inline-block">
                                <svg class="w-8 h-8 text-white mx-auto" fill="none" stroke-linecap="round"
                                    stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                    <path d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Program Section with Hover Effects -->
    <section id="programs" class="py-24 lg:px-32 bg-gradient-to-b from-gray-50 to-white">
        <div class="container mx-auto px-4">
            <div class="flex flex-wrap justify-center text-center mb-16">
                <div class="w-full lg:w-6/12 px-4">
                    <h2 class="text-5xl font-bold text-gray-800 mb-2">Program <span class="text-green-600">Dakwah</span>
                    </h2>
                    <div class="h-1 w-24 bg-green-500 mx-auto my-4"></div>
                    <p class="text-xl leading-relaxed mt-6 text-gray-600">
                        Temukan program yang sesuai dengan kebutuhan spiritual dan intelektual Anda
                    </p>
                </div>
            </div>

            <!-- Interactive Program Grid -->
            <div class="flex flex-wrap">
                @foreach ($programs as $program)
                    <div class="w-full md:w-4/12 px-4 text-center mb-12 transform transition duration-500 hover:scale-105">
                        <div
                            class="relative flex flex-col min-w-0 break-words bg-white w-full shadow-xl rounded-lg overflow-hidden group">
                            <div class="relative overflow-hidden">
                                <img alt="{{ $program->title }}" {{-- src="https://picsum.photos/seed/{{ $program->id }}/400/300" --}}
                                    src="{{ Storage::url($program->featured_image) }}"
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
                                    class="inline-block bg-gradient-to-r from-green-500 to-green-600 text-white font-bold uppercase text-sm px-6 py-3 rounded-full shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150 transform hover:-translate-y-1">
                                    Lihat Program <i class="fas fa-arrow-right ml-2"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Featured Programs with Timeline Effect -->
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
                        <h2 class="text-5xl font-bold mb-2">Kegiatan <span class="text-green-600">Unggulan</span></h2>
                        <div class="h-1 w-24 bg-green-500 mx-auto my-4"></div>
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
                                    <img alt="{{ $activity->title }}" src="{{ $activity->image_url }}"
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
                        class="inline-block bg-gradient-to-r from-green-600 to-green-700 text-white font-bold uppercase text-sm px-8 py-4 rounded-full shadow-lg hover:shadow-xl outline-none focus:outline-none ease-linear transition-all duration-150 transform hover:-translate-y-1">
                        Lihat Semua Kegiatan <i class="fas fa-chevron-right ml-2"></i>
                    </a>
                </div>
            </div>
        </section>
    @endif

    <!-- Testimonial Section -->
    <section class="py-24 lg:px-32 bg-white">
        <div class="container mx-auto px-4">
            <div class="flex flex-wrap justify-center text-center mb-16">
                <div class="w-full lg:w-6/12 px-4">
                    <h2 class="text-5xl font-bold mb-2">Apa Kata <span class="text-green-600">Mereka</span></h2>
                    <div class="h-1 w-24 bg-green-500 mx-auto my-4"></div>
                    <p class="text-xl leading-relaxed mt-6 text-gray-600">
                        Pengalaman peserta program dakwah Masjid Salman ITB
                    </p>
                </div>
            </div>

            <div class="flex flex-wrap">
                @for ($i = 0; $i < 3; $i++)
                    <div class="w-full md:w-4/12 px-4 mb-8">
                        <div class="bg-gray-50 rounded-lg p-8 shadow-md">
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
                                        {{ ['Mahasiswa ITB', 'Alumni', 'Masyarakat Umum'][$i] }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endfor
            </div>
        </div>
    </section>

    <!-- Call to Action -->
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
                    <a href="{{ route('register') }}"
                        class="inline-block bg-white text-green-700 active:bg-gray-200 font-bold uppercase text-base px-8 py-4 rounded-full shadow-lg hover:shadow-xl outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150">
                        Daftar Sekarang <i class="fas fa-user-plus ml-2"></i>
                    </a>
                    {{-- <a href="{{ route('contact') }}"
                        class="inline-block bg-transparent border-2 border-white text-white hover:bg-white hover:text-green-700 font-bold uppercase text-base px-8 py-4 rounded-full shadow-lg hover:shadow-xl outline-none focus:outline-none ml-1 mb-1 ease-linear transition-all duration-150">
                        Hubungi Kami <i class="fas fa-envelope ml-2"></i>
                    </a> --}}
                </div>
            </div>
        </div>
    </section>

    <!-- Newsletter Subscription -->
    <section class="py-12 bg-gray-50">
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
                            class="bg-green-600 text-white rounded-r-lg md:rounded-l-none px-6 py-3 w-full md:w-auto mt-3 md:mt-0 font-semibold hover:bg-green-700 transition duration-200">
                            Berlangganan
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
