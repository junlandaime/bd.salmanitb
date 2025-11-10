@extends('layouts.app')

@section('title', 'Ta\'aruf - Bidang Dakwah Masjid Salman ITB')
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
    <div class="mt-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <!-- Breadcrumb -->
            <nav class="mb-4">
                <ol class="flex space-x-2 text-sm text-gray-600">
                    <li><a href="{{ route('alumni.dashboard') }}" class="hover:text-green-600">Dashboard Alumni</a></li>
                    <li><span class="mx-2">/</span></li>
                    <li class="text-green-600 font-medium">Ta'aruf</li>
                </ol>
            </nav>

            <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Fitur Ta'aruf</h1>
                    <p class="text-gray-500 mt-1">Khusus untuk alumni Sekolah Pranikah Online dan Offline</p>
                </div>
            </div>

            @if (session('error'))
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6" role="alert">
                    <p>{{ session('error') }}</p>
                </div>
            @endif

            @if (session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6" role="alert">
                    <p>{{ session('success') }}</p>
                </div>
            @endif

            {{-- @if (isset($needsProfileUpdate) && $needsProfileUpdate)
                <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 mb-6" role="alert">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-yellow-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm">Profil Ta'aruf Anda perlu dilengkapi. Silakan tambahkan informasi kriteria
                                pasangan
                                dan kelebihan kekurangan pada profil Anda.</p>
                            <p class="mt-2">
                                <a href="{{ route('taaruf.profile.edit') }}"
                                    class="inline-flex items-center px-3 py-1 border border-transparent text-sm leading-5 font-medium rounded-md text-yellow-700 bg-yellow-100 hover:bg-yellow-50 focus:outline-none focus:border-yellow-300 focus:shadow-outline-yellow active:bg-yellow-200 transition ease-in-out duration-150">
                                    Lengkapi Profil
                                    <svg class="ml-1 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                        fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </a>
                            </p>
                        </div>
                    </div>
                </div>
            @endif --}}

            @if (isset($needsProfileUpdate) && $needsProfileUpdate)
                <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 mb-6 rounded-r-lg shadow-sm" role="alert">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-6 w-6 text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3 flex-1">
                            <h3 class="text-sm font-semibold text-yellow-800">
                                ⚠️ Profil Ta'aruf Anda Belum Lengkap
                            </h3>
                            <div class="mt-2 text-sm text-yellow-700">
                                <p class="mb-2">Silakan lengkapi data berikut untuk meningkatkan peluang Ta'aruf Anda:</p>


                                @if (isset($missingFields) && count($missingFields) > 0)
                                    <div class="bg-white rounded-md p-3 mt-3 border border-yellow-200">
                                        <p class="font-medium text-yellow-800 mb-2 flex items-center">
                                            <svg class="h-4 w-4 mr-1" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                                            </svg>
                                            Data yang belum dilengkapi ({{ count($missingFields) }} item):
                                        </p>
                                        <ul class="list-none space-y-1 ml-5">
                                            @foreach ($missingFields as $field)
                                                <li class="flex items-start text-gray-700">
                                                    <svg class="h-4 w-4 text-yellow-500 mr-2 mt-0.5 flex-shrink-0"
                                                        fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd"
                                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                    <span>{{ $field }}</span>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    @if ($needsBirthDateWarning ?? false)
                                        <div class="mt-3 bg-red-50 border border-red-200 rounded-md p-3">
                                            <div class="flex items-start">
                                                <svg class="h-5 w-5 text-red-500 mr-2 mt-0.5 flex-shrink-0"
                                                    fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd"
                                                        d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                                <div class="text-sm text-red-700">
                                                    <p class="font-medium">Tanggal lahir Anda belum dapat diproses.</p>
                                                    <p>Pastikan kolom <strong>Tempat &amp; Tanggal Lahir</strong> diisi
                                                        dengan format
                                                        <em>Kota, 4 Oktober 1995</em> agar usia dapat tampil di daftar
                                                        profil.
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    @endif

                                    {{-- Completion Progress Bar --}}
                                    @php
                                        // Calculate total required fields dynamically
                                        // Base fields: 2 (Visi Misi, Kelebihan Kekurangan)
                                        // Location fields: 8 (4 Asal + 4 Domisili)
                                        // Education fields: 3 (Strata, Kampus, Jurusan - untuk pendidikan tinggi)
                                        // Total: 13 fields

                                        $totalFields = 13;

                                        // Adjust total if education level is SD-SMK (major not required)
                                        if (!empty($taarufProfile->education_level)) {
                                            $lowEducationLevels = ['SD', 'SMP', 'SMA', 'SMK'];
                                            if (in_array($taarufProfile->education_level, $lowEducationLevels)) {
                                                $totalFields = 12; // Exclude major from total
                                            }
                                        }

                                        $completedFields = $totalFields - count($missingFields);
                                        $percentage =
                                            $completedFields > 0 ? round(($completedFields / $totalFields) * 100) : 0;
                                    @endphp

                                    <div class="mt-4">
                                        <div class="flex justify-between text-xs text-yellow-700 mb-1">
                                            <span class="font-medium">Kelengkapan Profil</span>
                                            <span class="font-bold">{{ $percentage }}%</span>
                                        </div>
                                        <div class="w-full bg-yellow-200 rounded-full h-2.5">
                                            <div class="bg-yellow-600 h-2.5 rounded-full transition-all duration-300"
                                                style="width: {{ $percentage }}%"></div>
                                        </div>
                                        <p class="text-xs text-yellow-600 mt-1 text-center">
                                            {{ $completedFields }} dari {{ $totalFields }} data telah dilengkapi
                                        </p>
                                    </div>
                                @endif
                                <p class="mb-2 text-green-500">Melengkapi data-data ini akan mempermudah proses fungsi
                                    filter
                                    baru:</p>
                            </div>

                            <div class="mt-4 flex flex-wrap gap-2">
                                <a href="{{ route('taaruf.profile.edit') }}"
                                    class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-yellow-600 hover:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500 transition ease-in-out duration-150 shadow-sm">
                                    <svg class="mr-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                    Lengkapi Profil Sekarang
                                </a>

                                <button type="button" onclick="this.closest('[role=alert]').remove()"
                                    class="inline-flex items-center px-3 py-2 border border-yellow-300 text-sm font-medium rounded-md text-yellow-700 bg-yellow-50 hover:bg-yellow-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500 transition ease-in-out duration-150">
                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                    <span class="ml-1">Nanti Saja</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="md:col-span-2">
                    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                        <div class="p-6 border-b border-gray-200">
                            <h2 class="text-xl font-bold text-gray-900">Tentang Fitur Ta'aruf</h2>
                        </div>
                        <div class="p-6">
                            <p class="text-gray-600 mb-4">Fitur Ta'aruf adalah layanan khusus yang disediakan oleh Bidang
                                Dakwah Masjid Salman ITB untuk memfasilitasi proses ta'aruf (perkenalan) bagi alumni Sekolah
                                Pranikah Online dan Offline yang siap menuju jenjang pernikahan.</p>

                            <p class="text-gray-600 mb-2">Melalui fitur ini, Anda dapat:</p>
                            <ul class="list-disc pl-5 mb-4 text-gray-600 space-y-1">
                                <li>Membuat profil ta'aruf yang berisi informasi diri</li>
                                <li>Melihat profil alumni lain yang juga bersedia untuk ta'aruf</li>
                                <li>Mengaktifkan atau menonaktifkan status ta'aruf Anda</li>
                            </ul>

                            <p class="text-gray-600">Semua informasi yang Anda berikan akan dijaga kerahasiaannya dan hanya
                                dapat diakses oleh alumni Sekolah Pranikah yang juga telah menyetujui ketentuan ta'aruf.</p>
                        </div>
                    </div>
                </div>

                <div class="space-y-6">
                    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                        <div class="p-6 border-b border-gray-200">
                            <h2 class="text-xl font-bold text-gray-900">Status Ta'aruf Anda</h2>
                        </div>
                        <div class="p-6">
                            @if (!$taarufProfile)
                                <div class="text-center py-6">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto text-gray-400 mb-4"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2" />
                                    </svg>
                                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Anda belum membuat profil Ta'aruf
                                    </h3>
                                    <p class="text-gray-500 mb-6">Buat profil untuk mulai menggunakan fitur Ta'aruf</p>

                                    <a href="{{ route('taaruf.terms') }}"
                                        class="inline-flex items-center justify-center px-5 py-3 border border-transparent text-base font-medium rounded-md text-white bg-green-600 hover:bg-green-700 w-full">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 4v16m8-8H4" />
                                        </svg>
                                        Buat Profil Ta'aruf
                                    </a>
                                </div>
                            @else
                                <div class="text-center py-4">
                                    <div class="mb-4">
                                        @if ($taarufProfile->photo_url)
                                            <img src="{{ $taarufProfile->photo_url }}"
                                                alt="{{ $taarufProfile->full_name }}"
                                                class="h-24 w-24 rounded-full object-cover mx-auto border-4 border-green-100">
                                        @else
                                            <div
                                                class="h-24 w-24 rounded-full bg-gray-100 flex items-center justify-center mx-auto border-4 border-green-100">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-400"
                                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                                </svg>
                                            </div>
                                        @endif
                                    </div>

                                    <h3 class="text-lg font-semibold text-gray-900">{{ $taarufProfile->full_name }}</h3>
                                    <p class="text-gray-500 mb-4">{{ $taarufProfile->occupation }}</p>

                                    <div class="mb-6">
                                        <span
                                            class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium {{ $taarufProfile->is_active ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="{{ $taarufProfile->is_active ? 'M5 13l4 4L19 7' : 'M6 18L18 6M6 6l12 12' }}" />
                                            </svg>
                                            {{ $taarufProfile->is_active ? 'Profil Aktif' : 'Profil Tidak Aktif' }}
                                        </span>
                                    </div>

                                    <div class="flex space-x-2 mb-4">
                                        <a href="{{ route('taaruf.profile.edit') }}"
                                            class="flex-1 inline-flex items-center justify-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                            Edit Profil
                                        </a>
                                        <form action="{{ route('taaruf.profile.toggle') }}" method="POST"
                                            class="flex-1">
                                            @csrf
                                            <button type="submit"
                                                class="w-full inline-flex items-center justify-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1"
                                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4" />
                                                </svg>
                                                {{ $taarufProfile->is_active ? 'Nonaktifkan' : 'Aktifkan' }}
                                            </button>
                                        </form>
                                    </div>

                                    @if ($taarufProfile->is_active)
                                        <a href="{{ route('taaruf.list') }}"
                                            class="inline-flex items-center justify-center px-5 py-3 border border-transparent text-base font-medium rounded-md text-white bg-green-600 hover:bg-green-700 w-full">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                            </svg>
                                            Lihat Daftar Ta'aruf
                                        </a>
                                    @else
                                        <a href="{{ route('taaruf.terms') }}"
                                            class="inline-flex items-center justify-center px-5 py-3 border border-transparent text-base font-medium rounded-md text-white bg-green-600 hover:bg-green-700 w-full">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            Aktifkan Kembali
                                        </a>
                                    @endif

                                    {{-- <a href="{{ route('taaruf.questions.index') }}"
                                        class="mt-6 inline-flex items-center justify-center px-5 py-3 border border-transparent text-base font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 w-full">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                        </svg>
                                        Lihat Pertanyaan Saya
                                    </a> --}}



                                    @if (isset($unreadQuestionsCount) && $unreadQuestionsCount > 0)
                                        <a href="{{ route('taaruf.questions.index') }}"
                                            class="mt-3 inline-flex items-center justify-center px-5 py-3 border border-transparent text-base font-medium rounded-md text-white bg-yellow-500 hover:bg-yellow-600 w-full relative">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            Pertanyaan Ta'aruf
                                            <span
                                                class="absolute -top-2 -right-2 flex items-center justify-center w-6 h-6 bg-red-500 text-white text-xs font-bold rounded-full">
                                                {{ $unreadQuestionsCount }}
                                            </span>
                                        </a>
                                        <div class="mt-3 p-3 bg-yellow-50 border border-yellow-200 rounded-md text-left">
                                            <div class="flex items-center text-yellow-800">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2"
                                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                                                </svg>
                                                <span class="text-sm">
                                                    Anda memiliki {{ $unreadQuestionsCount }} pertanyaan
                                                    {{ $unreadQuestionsCount > 1 ? 'baru' : 'baru' }} yang perlu dijawab.
                                                </span>
                                            </div>
                                        </div>
                                    @else
                                        <a href="{{ route('taaruf.questions.index') }}"
                                            class="mt-3 inline-flex items-center justify-center px-5 py-3 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 w-full">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            Pertanyaan Ta'aruf
                                        </a>
                                    @endif
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                        <div class="p-6 border-b border-gray-200">
                            <h2 class="text-xl font-bold text-gray-900">Informasi Penting</h2>
                        </div>
                        <div class="p-6">
                            <div class="bg-blue-50 text-blue-700 p-4 rounded-lg mb-4">
                                <div class="flex">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 flex-shrink-0"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <span>Fitur Ta'aruf hanya tersedia untuk alumni Sekolah Pranikah Online dan
                                        Offline.</span>
                                </div>
                            </div>

                            <p class="text-gray-600 mb-1">Jika Anda memiliki pertanyaan, silakan hubungi admin melalui:</p>
                            <p class="font-semibold text-gray-800 mb-2">Kontak Admin:</p>
                            <p class="flex items-center mb-2 text-gray-600">
                                <svg class="h-5 w-5 mr-2 text-gray-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                                    <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                                </svg>
                                <a target="_blank" href="mailto:bidangdakwah@salmanitb.com">bidangdakwah@salmanitb.com</a>
                            </p>
                            <p class="flex items-center text-gray-600">
                                <svg class="h-5 w-5 mr-2 text-gray-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z" />
                                </svg>
                                <a target="_blank"
                                    href="https://wa.me/{{ preg_replace('/[^0-9]/', '', '+6285722183585') }}">+6285722183585</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
