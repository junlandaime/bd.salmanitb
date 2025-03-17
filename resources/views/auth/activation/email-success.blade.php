@extends('layouts.app')
@section('title', 'Email Terverifikasi - Bidang Dakwah Masjid Salman ITB')

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
                    <div class="absolute right-0 top-0 transform translate-x-1/2 -translate-y-1/2">
                        <div class="w-96 h-96 bg-emerald-500 rounded-full opacity-20 animate-blob"></div>
                    </div>

                    <!-- Yellow Accent -->
                    <div class="absolute right-20 top-40">
                        <div class="w-24 h-24 bg-yellow-400 rounded-full"></div>
                    </div>

                    <div class="max-w-md mx-auto">
                        <div class="bg-white rounded-xl shadow-lg overflow-hidden animate__animated animate__fadeIn">
                            <div class="bg-emerald-600 text-white p-6">
                                <h2 class="text-2xl font-bold text-center">Email Aktivasi Terkirim</h2>
                                <p class="mt-2 text-sm text-center text-emerald-100">Silakan periksa email Anda</p>
                            </div>
                            <div class="p-8 space-y-6">
                                <div class="text-center mb-8">
                                    <div class="relative w-24 h-24 mx-auto">
                                        <div
                                            class="absolute inset-0 w-full h-full flex items-center justify-center text-emerald-500 animate__animated animate__bounceIn">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M3 19v-8.93a2 2 0 01.89-1.664l7-4.666a2 2 0 012.22 0l7 4.666A2 2 0 0121 10.07V19M3 19a2 2 0 002 2h14a2 2 0 002-2M3 19l6.75-4.5M21 19l-6.75-4.5M3 10l6.75 4.5M21 10l-6.75 4.5m0 0l-1.14.76a2 2 0 01-2.22 0l-1.14-.76" />
                                            </svg>
                                        </div>
                                        <div class="absolute inset-0 w-full h-full rounded-lg bg-emerald-500 opacity-20">
                                        </div>
                                    </div>
                                    <h5
                                        class="mt-6 text-xl font-semibold text-gray-900 animate__animated animate__fadeInUp">
                                        Email Aktivasi Telah Dikirim!</h5>
                                    <p class="mt-4 text-gray-600 animate__animated animate__fadeInUp animate__delay-1s">
                                        Kami telah mengirimkan link aktivasi ke alamat email Anda.
                                        Silakan periksa kotak masuk email Anda dan klik link aktivasi untuk mengaktifkan
                                        akun Anda.
                                    </p>

                                    <p
                                        class="mt-3 text-sm text-gray-500 animate__animated animate__fadeInUp animate__delay-1s">
                                        Jika Anda tidak menerima email dalam beberapa menit, silakan periksa folder spam
                                        atau coba lagi.
                                    </p>
                                </div>

                                <div
                                    class="flex flex-col sm:flex-row space-y-3 sm:space-y-0 sm:space-x-3 animate__animated animate__fadeInUp animate__delay-2s">
                                    <a href="{{ route('activation.email.form') }}"
                                        class="flex-1 inline-flex justify-center items-center px-4 py-2 border border-emerald-600 text-sm font-medium rounded-md text-emerald-600 bg-white hover:bg-emerald-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500 transition-colors duration-200">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                        </svg>
                                        Coba Lagi
                                    </a>
                                    <a href="{{ route('login') }}"
                                        class="flex-1 inline-flex justify-center items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-emerald-600 hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500 transition-colors duration-200">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                                        </svg>
                                        Kembali ke Login
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
@endsection
