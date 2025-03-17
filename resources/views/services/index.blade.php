@extends('layouts.app')
@section('title', 'Layanan Bidang Dakwah Masjid Salman ITB')
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
    <!-- Hero Section -->
    <section class="relative pt-16 pb-32 flex content-center items-center justify-center " style="min-height: 50vh;">
        <div class="absolute top-0 w-full h-full bg-center bg-cover"
            style='background-image: url("https://picsum.photos/1920/1085");'>
            <span class="w-full h-full absolute opacity-50 bg-black"></span>
        </div>
        <div class="container relative mx-auto">
            <div class="items-center flex flex-wrap">
                <div class="w-full lg:w-6/12 px-4 ml-auto mr-auto text-center">
                    <div class="pr-12" data-aos="fade-up">
                        <h1 class="text-white font-semibold text-5xl">
                            Layanan Kami
                        </h1>
                        <p class="mt-4 text-lg text-gray-200">
                            Berbagai layanan untuk memenuhi kebutuhan spiritual dan sosial umat
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Grid -->
    <section class="py-20 bg-gray-50 md:px-40">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-8" data-aos="fade-up">Layanan Yang Kami Sediakan</h2>
            <p class="text-center max-w-3xl mx-auto mb-12" data-aos="fade-up" data-aos-delay="100">
                Bidang Dakwah Salman ITB menyediakan berbagai layanan yang dirancang untuk memenuhi kebutuhan spiritual dan
                sosial umat Islam di lingkungan Masjid Salman ITB dan sekitarnya.
            </p>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach ($services as $service)
                    <div data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}" data-aos-duration="800"
                        class="bg-white rounded-lg overflow-hidden shadow-lg transition-transform duration-300 hover:-translate-y-2 hover:shadow-xl card-hover">
                        <div class="p-6">
                            @if ($service->icon)
                                <div
                                    class="text-white p-3 text-center inline-flex items-center justify-center w-12 h-12 mb-5 shadow-lg rounded-full bg-green-400">
                                    <i class="{{ $service->icon }}"></i>
                                </div>
                            @endif
                            <h3 class="text-xl font-bold text-gray-900 mb-3">{{ $service->title }}</h3>

                            <!-- Divider -->
                            <div class="h-0.5 bg-gray-200 w-1/3 mb-4"></div>

                            <p class="text-gray-600 mb-6">
                                {{ $service->description }}
                            </p>

                            @if ($service->link_url)
                                <div class="flex justify-start mt-4">
                                    <a href="{{ route('services.show', $service->slug) }}"
                                        class="text-green-600 hover:text-green-800 font-medium flex items-center">
                                        {{ $service->link_text ?? 'Selengkapnya' }}
                                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 5l7 7-7 7"></path>
                                        </svg>
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="relative py-20 bg-white md:px-40">
        <div class="container mx-auto px-4">
            <div class="flex flex-wrap items-center">
                <div class="w-full md:w-6/12 px-4 mr-auto ml-auto" data-aos="fade-right">
                    <h3 class="text-3xl mb-2 font-semibold leading-normal">
                        Butuh Informasi Lebih Lanjut?
                    </h3>
                    <p class="text-lg font-light leading-relaxed mt-4 mb-4 text-gray-700">
                        Tim kami siap membantu Anda dengan informasi lebih detail tentang layanan-layanan yang kami
                        sediakan.
                    </p>
                    <div class="mt-8">
                        <a href="{{ route('contact') }}"
                            class="bg-green-500 text-white px-6 py-3 rounded-md font-medium hover:bg-green-600 transition duration-300">
                            Hubungi Kami
                        </a>
                    </div>
                </div>

                <div class="w-full md:w-4/12 px-4 mr-auto ml-auto" data-aos="fade-left">
                    <div class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded-lg bg-green-500">
                        <img alt="Contact Us" src="https://picsum.photos/400/300" class="w-full align-middle rounded-t-lg">
                        <blockquote class="relative p-8 mb-4">
                            <h4 class="text-xl font-bold text-white">
                                Jam Operasional
                            </h4>
                            <p class="text-md font-light mt-2 text-white">
                                Senin - Jumat: 08:00 - 17:00<br>
                                Sabtu: 09:00 - 15:00<br>
                                Minggu: Tutup
                            </p>
                        </blockquote>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
