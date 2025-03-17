@extends('layouts.app')
@section('title', 'Aktivasi Akun - Bidang Dakwah Masjid Salman ITB')

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
                    <div class="absolute right-0 top-0 transform  -translate-y-1/2">
                        <div class="w-96 h-96 bg-emerald-500 rounded-full opacity-20 animate-blob"></div>
                    </div>

                    <!-- Yellow Accent -->
                    <div class="absolute right-20 top-40">
                        <div class="w-24 h-24 bg-yellow-400 rounded-full"></div>
                    </div>

                    <div class="max-w-md mx-auto">
                        <div class="bg-white rounded-xl shadow-lg overflow-hidden animate__animated animate__fadeIn">
                            <div class="bg-emerald-600 text-white p-6">
                                <h2 class="text-2xl font-bold text-center">Aktivasi Akun</h2>
                                <p class="mt-2 text-sm text-center text-emerald-100">Buat password baru untuk mengaktifkan
                                    akun Anda</p>
                            </div>
                            <div class="p-8 space-y-6">
                                <div class="text-center mb-8">
                                    <div class="relative mx-auto pb-4">
                                        <a href="/" class="flex justify-center items-center w-full">
                                            <x-application-logo class="fill-current text-emerald-600" />
                                        </a>
                                    </div>
                                    {{-- <h5
                                        class="mt-6 text-xl font-semibold text-gray-900 animate__animated animate__fadeInUp">
                                        Bidang Dakwah Masjid Salman ITB</h5> --}}
                                    <p
                                        class="mt-2 text-sm text-gray-600 animate__animated animate__fadeInUp animate__delay-1s">
                                        Silakan buat password baru untuk mengaktifkan akun Anda.
                                    </p>
                                </div>

                                <form method="POST" action="{{ route('activation.activate', $token) }}"
                                    class="space-y-6 animate__animated animate__fadeIn">
                                    @csrf

                                    <!-- Password -->
                                    <div class="rounded-md shadow-sm -space-y-px">
                                        <div class="relative group">
                                            <div
                                                class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                <svg class="h-5 w-5 text-gray-400 group-focus-within:text-emerald-500"
                                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                    fill="currentColor">
                                                    <path fill-rule="evenodd"
                                                        d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                            </div>
                                            <input id="password" type="password" name="password" required
                                                autocomplete="new-password"
                                                class="appearance-none rounded-t-md relative block w-full px-3 py-2 pl-10 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-emerald-500 focus:border-emerald-500 focus:z-10 sm:text-sm"
                                                placeholder="Password Baru">
                                        </div>
                                        <div class="relative group">
                                            <div
                                                class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                <svg class="h-5 w-5 text-gray-400 group-focus-within:text-emerald-500"
                                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                    fill="currentColor">
                                                    <path fill-rule="evenodd"
                                                        d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                            </div>
                                            <input id="password-confirm" type="password" name="password_confirmation"
                                                required autocomplete="new-password"
                                                class="appearance-none rounded-b-md relative block w-full px-3 py-2 pl-10 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-emerald-500 focus:border-emerald-500 focus:z-10 sm:text-sm"
                                                placeholder="Konfirmasi Password">
                                        </div>
                                    </div>

                                    @error('password')
                                        <p class="mt-2 text-sm text-red-600">
                                            <strong>{{ $message }}</strong>
                                        </p>
                                    @enderror

                                    <div>
                                        <button type="submit"
                                            class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-emerald-600 hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500 transition-colors duration-200">
                                            <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                                                <svg class="h-5 w-5 text-emerald-500 group-hover:text-emerald-400"
                                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                    fill="currentColor">
                                                    <path fill-rule="evenodd"
                                                        d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                            </span>
                                            Aktivasi Akun
                                        </button>
                                    </div>
                                </form>

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

    <style>

    </style>

    <!-- Add Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
@endsection
