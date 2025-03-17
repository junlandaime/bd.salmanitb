@extends('layouts.app')
@section('title', 'Aktivasi Berhasil - Bidang Dakwah Masjid Salman ITB')

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
    <main class="mt-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="relative z-10 pb-8 bg-white sm:pb-16 md:pb-20">
                <div class="relative pt-6 px-4 sm:px-6 lg:px-8">
                    <!-- Green Blob Animation -->
                    <div class="absolute right-0 top-0 transform -translate-y-1/2">
                        <div class="w-96 h-96 bg-emerald-500 rounded-full opacity-20 animate-blob"></div>
                    </div>

                    <!-- Yellow Accent -->
                    <div class="absolute right-20 top-40">
                        <div class="w-24 h-24 bg-yellow-400 rounded-full"></div>
                    </div>

                    <div class="max-w-md mx-auto">
                        <div class="bg-white rounded-xl shadow-lg overflow-hidden animate__animated animate__fadeIn">
                            <div class="bg-emerald-600 text-white p-6">
                                <h2 class="text-2xl font-bold text-center">Aktivasi Berhasil</h2>
                            </div>
                            <div class="p-8 space-y-6">
                                <div class="text-center mb-8">
                                    <div class="relative mx-auto pb-4">
                                        <a href="/" class="flex justify-center items-center w-full">
                                            <x-application-logo class="fill-current text-emerald-600" />
                                        </a>
                                    </div>
                                    <div class="mb-4 text-emerald-600">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                    <h5
                                        class="mt-6 text-xl font-semibold text-gray-900 animate__animated animate__fadeInUp">
                                        Selamat! Akun Anda Telah Aktif
                                    </h5>
                                    <p
                                        class="mt-2 text-sm text-gray-600 animate__animated animate__fadeInUp animate__delay-1s">
                                        Akun Anda telah berhasil diaktifkan. Anda sekarang dapat mengakses semua fitur dan
                                        materi
                                        yang tersedia untuk alumni batch kegiatan yang Anda ikuti.
                                    </p>
                                </div>

                                <div>
                                    <a href="{{ route('alumni.dashboard') }}"
                                        class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-emerald-600 hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500 transition-colors duration-200">
                                        <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                                            <svg class="h-5 w-5 text-emerald-500 group-hover:text-emerald-400"
                                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd"
                                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-8.707l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 001.414 1.414L9 9.414V13a1 1 0 102 0V9.414l1.293 1.293a1 1 0 001.414-1.414z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </span>
                                        Ke Dashboard Alumni
                                    </a>
                                </div>

                                <!-- Social Proof -->
                                <div class="mt-8 border-t border-gray-200 pt-6">
                                    <p class="text-xs text-center text-gray-500">
                                        Dipercaya oleh lebih dari 1000+ alumni Bidang Dakwah
                                    </p>
                                    <div class="mt-4 flex justify-center space-x-4">
                                        <div class="flex -space-x-2">
                                            <img class="w-8 h-8 rounded-full border-2 border-white"
                                                src="https://picsum.photos/200" alt="User">
                                            <img class="w-8 h-8 rounded-full border-2 border-white"
                                                src="https://picsum.photos/201" alt="User">
                                            <img class="w-8 h-8 rounded-full border-2 border-white"
                                                src="https://picsum.photos/202" alt="User">
                                            <div
                                                class="flex items-center justify-center w-8 h-8 rounded-full border-2 border-white bg-emerald-100 text-emerald-800 text-xs font-medium">
                                                +999
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Add Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
@endsection
