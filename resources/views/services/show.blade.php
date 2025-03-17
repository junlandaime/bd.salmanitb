@extends('layouts.app')
@section('title', $service->title . ' - Layanan Bidang Dakwah Masjid Salman ITB')
@section('meta_description', Str::limit($service->description, 160))
@section('og_title', $service->title . ' - Layanan Bidang Dakwah Masjid Salman ITB')
@section('og_description', Str::limit($service->description, 200))
@section('og_image', 'https://bidangdakwah.salmanitb.com/storage/' . $service->featured_image)

@section('additional_meta_tags')

@endsection

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
    <section class="relative pt-16 pb-32 flex content-center items-center justify-center" style="min-height: 40vh;">
        <div class="absolute top-0 w-full h-full bg-center bg-cover"
            style='background-image: url("{{ $service->image ? Storage::url($service->image) : 'https://picsum.photos/1920/1085' }}");'>
            <span class="w-full h-full absolute opacity-50 bg-black"></span>
        </div>
        <div class="container relative mx-auto">
            <div class="items-center flex flex-wrap">
                <div class="w-full lg:w-6/12 px-4 ml-auto mr-auto text-center">
                    <div class="pr-12" data-aos="fade-up">
                        <h1 class="text-white font-semibold text-5xl">
                            {{ $service->title }}
                        </h1>
                        <p class="mt-4 text-lg text-gray-200">
                            Layanan di bawah Program {{ $service->program->title }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Service Content -->
    <section class="py-20 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="flex flex-wrap">
                <div class="w-full lg:w-8/12 px-4 mx-auto">
                    <div class="bg-white rounded-lg shadow-lg p-8 mb-8" data-aos="fade-up">
                        @if ($service->icon)
                            <div class="flex items-center mb-6">
                                <div
                                    class="text-white p-3 text-center inline-flex items-center justify-center w-12 h-12 mr-4 shadow-lg rounded-full bg-green-400">
                                    <i class="{{ $service->icon }}"></i>
                                </div>
                                <h2 class="text-3xl font-bold">{{ $service->title }}</h2>
                            </div>
                        @else
                            <h2 class="text-3xl font-bold mb-6">{{ $service->title }}</h2>
                        @endif

                        <!-- Divider -->
                        <div class="h-0.5 bg-gray-200 w-1/4 mb-8"></div>

                        <!-- Service Description -->
                        <div class="prose max-w-none" data-aos="fade-up" data-aos-delay="100">
                            <p class="text-lg text-gray-700 leading-relaxed mb-8">
                                {{ $service->description }}
                            </p>
                        </div>

                        <!-- Call to Action -->
                        @if ($service->link_url)
                            <div class="mt-12" data-aos="fade-up" data-aos-delay="200">
                                <a href="{{ $service->link_url }}"
                                    class="inline-block bg-green-500 text-white px-8 py-4 rounded-md font-medium hover:bg-green-600 transition duration-300">
                                    {{ $service->link_text ?? 'Pelajari Lebih Lanjut' }}
                                </a>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="w-full lg:w-4/12 px-4">
                    <!-- Related Program -->
                    <div class="bg-white shadow-lg rounded-lg overflow-hidden mb-8 card-hover" data-aos="fade-left">
                        <div class="p-6">
                            <h3 class="text-xl font-bold mb-4">Program Terkait</h3>

                            <!-- Divider -->
                            <div class="h-0.5 bg-gray-200 w-1/3 mb-6"></div>

                            <h4 class="text-lg font-semibold mb-2">{{ $service->program->title }}</h4>
                            <p class="text-gray-600 mb-4">{{ $service->program->description }}</p>
                            <a href="{{ route('programs.show', $service->program->slug) }}"
                                class="text-green-600 hover:text-green-800 font-medium flex items-center">
                                Lihat Detail Program
                                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                                    </path>
                                </svg>
                            </a>
                        </div>
                    </div>

                    <!-- Contact Info -->
                    <div class="bg-white shadow-lg rounded-lg overflow-hidden card-hover" data-aos="fade-left"
                        data-aos-delay="100">
                        <div class="p-6">
                            <h3 class="text-xl font-bold mb-4">Butuh Bantuan?</h3>

                            <!-- Divider -->
                            <div class="h-0.5 bg-gray-200 w-1/3 mb-6"></div>

                            <p class="text-gray-600 mb-6">Jika Anda memiliki pertanyaan tentang layanan ini, jangan ragu
                                untuk menghubungi kami.</p>
                            <a href="{{ route('contact') }}"
                                class="inline-block bg-green-500 text-white px-6 py-3 rounded-md font-medium hover:bg-green-600 transition duration-300 w-full text-center">
                                Hubungi Kami
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Other Services -->
    <section class="py-20 bg-white">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-12" data-aos="fade-up">Layanan Lainnya</h2>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach ($service->program->services()->where('id', '!=', $service->id)->take(3)->get() as $otherService)
                    <div class="bg-white rounded-lg shadow-lg overflow-hidden card-hover" data-aos="fade-up"
                        data-aos-delay="{{ $loop->index * 100 }}">
                        <div class="p-6">
                            @if ($otherService->icon)
                                <div
                                    class="text-white p-3 text-center inline-flex items-center justify-center w-12 h-12 mb-5 shadow-lg rounded-full bg-green-400">
                                    <i class="{{ $otherService->icon }}"></i>
                                </div>
                            @endif
                            <h3 class="text-xl font-bold mb-3">{{ $otherService->title }}</h3>

                            <!-- Divider -->
                            <div class="h-0.5 bg-gray-200 w-1/3 mb-4"></div>

                            <p class="text-gray-600 mb-6">
                                {{ Str::limit($otherService->description, 100) }}
                            </p>

                            <div class="flex justify-start mt-4">
                                <a href="{{ route('services.show', $otherService->slug) }}"
                                    class="text-green-600 hover:text-green-800 font-medium flex items-center">
                                    Selengkapnya
                                    <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="flex justify-center mt-12" data-aos="fade-up" data-aos-delay="300">
                <a href="{{ route('services.index') }}"
                    class="bg-green-500 text-white px-6 py-3 rounded-md font-medium hover:bg-green-600 transition duration-300">
                    Lihat Semua Layanan
                </a>
            </div>
        </div>
    </section>
@endsection
