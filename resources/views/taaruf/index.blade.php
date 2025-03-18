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
                                            <img src="{{ Storage::url($taarufProfile->photo_url) }}"
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
                                        <form action="{{ route('taaruf.profile.toggle') }}" method="POST" class="flex-1">
                                            @csrf
                                            <button type="submit"
                                                class="w-full inline-flex items-center justify-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
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
                            <p class="flex items-center text-gray-600">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-gray-400" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                                admin@salmanitb.com
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
