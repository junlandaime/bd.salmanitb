@extends('layouts.app')

@section('title', 'Detail Profil Ta\'aruf')
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
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="mb-8">
            <nav class="flex" aria-label="Breadcrumb">
                <ol class="flex items-center space-x-2">
                    <li>
                        <a href="{{ route('alumni.dashboard') }}" class="text-green-600 hover:text-green-700">Dashboard
                            Alumni</a>
                    </li>
                    <li class="flex items-center">
                        <svg class="h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                clip-rule="evenodd" />
                        </svg>
                        <a href="{{ route('taaruf.index') }}" class="ml-2 text-green-600 hover:text-green-700">Ta'aruf</a>
                    </li>
                    <li class="flex items-center">
                        <svg class="h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                clip-rule="evenodd" />
                        </svg>
                        <a href="{{ route('taaruf.list') }}" class="ml-2 text-green-600 hover:text-green-700">Daftar
                            Alumni</a>
                    </li>
                    <li class="flex items-center">
                        <svg class="h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                clip-rule="evenodd" />
                        </svg>
                        <span class="ml-2 text-gray-500">Detail Profil</span>
                    </li>
                </ol>
            </nav>
            <h2 class="text-3xl font-bold text-gray-900 mt-4">Profil Ta'aruf</h2>
            <p class="text-gray-600">Detail informasi profil alumni</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="lg:col-span-2">
                {{-- Informasi Dasar (sudah ada) --}}
                <div class="bg-white rounded-lg shadow-lg mb-8 overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h5 class="text-xl font-bold text-green-600">Informasi Dasar</h5>
                    </div>
                    <div class="p-6">
                        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                            <div class="text-center mb-4">
                                @if ($profile->photo_url)
                                    <img src="{{ $profile->photo_url }}" alt="{{ $profile->full_name }}"
                                        class="rounded-lg border border-gray-200 inline-block max-w-full h-auto"
                                        style="max-width: 200px;">
                                @else
                                    <div class="bg-gray-100 rounded-lg flex items-center justify-center w-40 h-40 mx-auto">
                                        <svg class="h-20 w-20 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                @endif
                            </div>

                            <div class="md:col-span-3 md:pl-10">
                                <h4 class="text-2xl font-bold mb-4">{{ $profile->full_name }}</h4>

                                <div class="space-y-2 mb-6">
                                    <p><span class="font-semibold">Nama Panggilan:</span> {{ $profile->nickname }}</p>
                                    <p class="mb-1"><strong>Usia:</strong>
                                        {{ \App\Helpers\DateHelper::getAgeFromBirthPlaceDate($profile->birth_place_date) ?? 'N/A' }}
                                        tahun</p>
                                    <p><span class="font-semibold">Domisili Saat Ini:</span>
                                        {{ $profile->current_residence }}</p>
                                    @if ($profile->instagram)
                                        <p><span class="font-semibold">Instagram:</span> @ {{ $profile->instagram }}</p>
                                    @endif
                                    <p><span class="font-semibold">Batch SPN:</span>
                                        @if ($profile->user->batchAlumni->first() && $profile->user->batchAlumni->first()->activityBatch)
                                            {{ $profile->user->batchAlumni->first()->activityBatch->nama_batch }} -
                                            {{ $profile->user->batchAlumni->first()->activityBatch->activity->title }}
                                        @else
                                            Tidak tersedia
                                        @endif
                                    </p>
                                </div>

                                <div>
                                    <a href="{{ route('taaruf.list') }}"
                                        class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 transition">
                                        <svg class="h-5 w-5 mr-2 text-gray-500" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                                        </svg>
                                        Kembali ke Daftar
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Asal Daerah --}}
                <div class="bg-white rounded-lg shadow-lg mb-8 overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200 bg-gradient-to-r from-green-50 to-green-100">
                        <h5 class="text-xl font-bold text-green-700 flex items-center">
                            <svg class="h-6 w-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                            </svg>
                            Asal Daerah
                        </h5>
                        <p class="text-sm text-gray-600 mt-1">Tempat asal kelahiran dan tumbuh kembang</p>
                    </div>
                    <div class="p-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            {{-- Provinsi Asal --}}
                            <div class="bg-gray-50 rounded-lg p-4 border border-gray-200">
                                <div class="flex items-start">
                                    <div class="flex-shrink-0">
                                        <div
                                            class="flex items-center justify-center h-10 w-10 rounded-lg bg-green-100 text-green-600">
                                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7" />
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="ml-4 flex-1">
                                        <p class="text-xs font-medium text-gray-500 uppercase tracking-wide">Provinsi</p>
                                        <p class="mt-1 text-base font-semibold text-gray-900">
                                            {{ $profile->origin_province ?? '-' }}
                                        </p>
                                    </div>
                                </div>
                            </div>

                            {{-- Kota/Kabupaten Asal --}}
                            <div class="bg-gray-50 rounded-lg p-4 border border-gray-200">
                                <div class="flex items-start">
                                    <div class="flex-shrink-0">
                                        <div
                                            class="flex items-center justify-center h-10 w-10 rounded-lg bg-blue-100 text-blue-600">
                                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="ml-4 flex-1">
                                        <p class="text-xs font-medium text-gray-500 uppercase tracking-wide">Kota/Kabupaten
                                        </p>
                                        <p class="mt-1 text-base font-semibold text-gray-900">
                                            {{ $profile->origin_city ?? '-' }}
                                        </p>
                                    </div>
                                </div>
                            </div>

                            {{-- Kecamatan Asal --}}
                            <div class="bg-gray-50 rounded-lg p-4 border border-gray-200">
                                <div class="flex items-start">
                                    <div class="flex-shrink-0">
                                        <div
                                            class="flex items-center justify-center h-10 w-10 rounded-lg bg-purple-100 text-purple-600">
                                            <svg class="h-6 w-6" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="ml-4 flex-1">
                                        <p class="text-xs font-medium text-gray-500 uppercase tracking-wide">Kecamatan</p>
                                        <p class="mt-1 text-base font-semibold text-gray-900">
                                            {{ $profile->origin_district ?? '-' }}
                                        </p>
                                    </div>
                                </div>
                            </div>

                            {{-- Kelurahan Asal --}}

                        </div>
                    </div>
                </div>

                {{-- Domisili Saat Ini --}}
                <div class="bg-white rounded-lg shadow-lg mb-8 overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200 bg-gradient-to-r from-blue-50 to-blue-100">
                        <h5 class="text-xl font-bold text-blue-700 flex items-center">
                            <svg class="h-6 w-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            Domisili Saat Ini
                        </h5>
                        <p class="text-sm text-gray-600 mt-1">Tempat tinggal sekarang</p>
                    </div>
                    <div class="p-6">
                        {{-- Alamat Lengkap --}}


                        {{-- Detail Wilayah --}}
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            {{-- Provinsi Domisili --}}
                            <div class="bg-gray-50 rounded-lg p-4 border border-gray-200">
                                <div class="flex items-start">
                                    <div class="flex-shrink-0">
                                        <div
                                            class="flex items-center justify-center h-10 w-10 rounded-lg bg-green-100 text-green-600">
                                            <svg class="h-6 w-6" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7" />
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="ml-4 flex-1">
                                        <p class="text-xs font-medium text-gray-500 uppercase tracking-wide">Provinsi</p>
                                        <p class="mt-1 text-base font-semibold text-gray-900">
                                            {{ $profile->residence_province ?? '-' }}
                                        </p>
                                    </div>
                                </div>
                            </div>

                            {{-- Kota/Kabupaten Domisili --}}
                            <div class="bg-gray-50 rounded-lg p-4 border border-gray-200">
                                <div class="flex items-start">
                                    <div class="flex-shrink-0">
                                        <div
                                            class="flex items-center justify-center h-10 w-10 rounded-lg bg-blue-100 text-blue-600">
                                            <svg class="h-6 w-6" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="ml-4 flex-1">
                                        <p class="text-xs font-medium text-gray-500 uppercase tracking-wide">Kota/Kabupaten
                                        </p>
                                        <p class="mt-1 text-base font-semibold text-gray-900">
                                            {{ $profile->residence_city ?? '-' }}
                                        </p>
                                    </div>
                                </div>
                            </div>

                            {{-- Kecamatan Domisili --}}
                            <div class="bg-gray-50 rounded-lg p-4 border border-gray-200">
                                <div class="flex items-start">
                                    <div class="flex-shrink-0">
                                        <div
                                            class="flex items-center justify-center h-10 w-10 rounded-lg bg-purple-100 text-purple-600">
                                            <svg class="h-6 w-6" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="ml-4 flex-1">
                                        <p class="text-xs font-medium text-gray-500 uppercase tracking-wide">Kecamatan</p>
                                        <p class="mt-1 text-base font-semibold text-gray-900">
                                            {{ $profile->residence_district ?? '-' }}
                                        </p>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-lg mb-8 overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h5 class="text-xl font-bold text-green-600">Pendidikan dan Pekerjaan</h5>
                    </div>
                    <div class="p-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Pendidikan Terakhir -->
                            <div>
                                <h6 class="font-bold text-gray-800 mb-3 flex items-center">
                                    <svg class="w-5 h-5 mr-2 text-green-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path d="M12 14l9-5-9-5-9 5 9 5z" />
                                        <path
                                            d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222" />
                                    </svg>
                                    Pendidikan Terakhir
                                </h6>

                                @if (!empty($profile->education_level) || !empty($profile->university) || !empty($profile->major))
                                    <div
                                        class="bg-gradient-to-br from-green-50 to-white rounded-lg p-4 border border-green-100">
                                        <div class="space-y-2">
                                            <!-- Strata -->
                                            @if (!empty($profile->education_level))
                                                <div class="flex items-center">
                                                    <span
                                                        class="inline-flex items-center justify-center w-6 h-6 rounded-full bg-green-500 text-white text-xs font-bold mr-2">
                                                        @php
                                                            $strataIcon = [
                                                                'SD' => 'SD',
                                                                'SMP' => 'SM',
                                                                'SMA' => 'SA',
                                                                'SMK' => 'SK',
                                                                'D3' => 'D3',
                                                                'D4' => 'D4',
                                                                'S1' => 'S1',
                                                                'S2' => 'S2',
                                                                'S3' => 'S3',
                                                            ];
                                                        @endphp
                                                        {{ $strataIcon[$profile->education_level] ?? '' }}
                                                    </span>
                                                    <div>
                                                        @php
                                                            $educationLabels = [
                                                                'SD' => 'SD/Sederajat',
                                                                'SMP' => 'SMP/Sederajat',
                                                                'SMA' => 'SMA/Sederajat',
                                                                'SMK' => 'SMK',
                                                                'D3' => 'Diploma 3',
                                                                'D4' => 'Diploma 4',
                                                                'S1' => 'Sarjana',
                                                                'S2' => 'Magister',
                                                                'S3' => 'Doktor',
                                                            ];
                                                        @endphp
                                                        <p class="text-sm font-semibold text-gray-800">
                                                            {{ $educationLabels[$profile->education_level] ?? $profile->education_level }}
                                                        </p>
                                                    </div>
                                                </div>
                                            @endif

                                            <!-- Kampus -->
                                            @if (!empty($profile->university))
                                                <div class="pl-8">
                                                    <p class="text-sm text-gray-600 font-medium">
                                                        📚
                                                        @if ($profile->university === 'Lainnya' && !empty($profile->custom_university))
                                                            {{ $profile->custom_university }}
                                                        @else
                                                            {{ $profile->university }}
                                                        @endif
                                                    </p>
                                                </div>
                                            @endif

                                            <!-- Jurusan -->
                                            @if (!empty($profile->major))
                                                <div class="pl-8">
                                                    <p class="text-sm text-gray-600">
                                                        🎓 {{ $profile->major }}
                                                    </p>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                @elseif(!empty($profile->last_education))
                                    <!-- Fallback ke field lama -->
                                    <div class="bg-gray-50 rounded-lg p-4 border border-gray-200">
                                        <p class="text-gray-600">{{ $profile->last_education }}</p>
                                    </div>
                                @else
                                    <div class="bg-gray-50 rounded-lg p-4 border border-gray-200">
                                        <p class="text-gray-400 italic flex items-center">
                                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            Belum diisi
                                        </p>
                                    </div>
                                @endif
                            </div>

                            <!-- Pekerjaan -->
                            <div>
                                <h6 class="font-bold text-gray-800 mb-3 flex items-center">
                                    <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </svg>
                                    Pekerjaan
                                </h6>

                                @if (!empty($profile->occupation))
                                    <div
                                        class="bg-gradient-to-br from-blue-50 to-white rounded-lg p-4 border border-blue-100">
                                        <p class="text-gray-700 font-medium">💼 {{ $profile->occupation }}</p>
                                    </div>
                                @else
                                    <div class="bg-gray-50 rounded-lg p-4 border border-gray-200">
                                        <p class="text-gray-400 italic flex items-center">
                                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            Belum diisi
                                        </p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-lg mb-8 overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h5 class="text-xl font-bold text-green-600">Informasi Tambahan</h5>
                    </div>
                    <div class="p-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <div class="mb-6">
                                    <h6 class="font-bold text-gray-800 mb-2">Target Tahun Menikah</h6>
                                    <p class="text-gray-600">{{ $profile->marriage_target_year ?? 'Tidak disebutkan' }}
                                    </p>
                                </div>

                                <div class="mb-6">
                                    <h6 class="font-bold text-gray-800 mb-2">Kepribadian</h6>
                                    <p class="text-gray-600">{{ $profile->personality ?? 'Tidak disebutkan' }}</p>
                                </div>

                                <div class="mb-6">
                                    <h6 class="font-bold text-gray-800 mb-2">Harapan dalam Pernikahan</h6>
                                    <p class="text-gray-600">{{ $profile->expectation ?? 'Tidak disebutkan' }}</p>
                                </div>
                            </div>

                            <div>
                                <div class="mb-6">
                                    <h6 class="font-bold text-gray-800 mb-2">Kriteria Pasangan</h6>
                                    <p class="text-gray-600">{{ $profile->visi_misi ?? 'Tidak disebutkan' }}
                                    </p>
                                </div>
                                <div class="mb-6">
                                    <h6 class="font-bold text-gray-800 mb-2">Kelebihan dan Kekurangan</h6>
                                    <p class="text-gray-600">{{ $profile->kelebihan_kekurangan ?? 'Tidak disebutkan' }}
                                    </p>
                                </div>

                                <div>
                                    <h6 class="font-bold text-gray-800 mb-2">Visi Misi Pernikahan</h6>
                                    <p class="text-gray-600">{{ $profile->ideal_partner_criteria ?? 'Tidak disebutkan' }}
                                    </p>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>




                @php
                    $publicQuestions = \App\Models\TaarufQuestion::where('profile_id', $profile->id)
                        ->where('is_answered', true)
                        ->where('is_public', true)
                        ->orderBy('created_at', 'desc')
                        ->get();
                @endphp

                @if (count($publicQuestions) > 0)
                    <!-- In your code where the questions section begins, replace with this: -->
                    <div class="bg-white rounded-lg shadow-lg mb-8 overflow-hidden">
                        <div class="px-6 py-4 border-b border-gray-200">
                            <h5 class="text-xl font-bold text-green-600">Pertanyaan & Jawaban</h5>
                        </div>
                        <div class="p-6">
                            <div class="space-y-4">
                                @foreach ($publicQuestions as $index => $question)
                                    <div class="border border-gray-200 rounded-lg overflow-hidden"
                                        x-data="{ open: {{ $index === 0 ? 'true' : 'false' }} }">
                                        <div class="bg-gray-50 p-0" id="heading{{ $index }}">
                                            <button
                                                class="w-full flex items-center justify-between p-4 text-left focus:outline-none"
                                                type="button" @click="open = !open"
                                                :aria-expanded="open ? 'true' : 'false'"
                                                aria-controls="collapse{{ $index }}">
                                                <div class="flex items-center">
                                                    <svg class="h-5 w-5 text-green-600 mr-2" fill="currentColor"
                                                        viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd"
                                                            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-3a1 1 0 00-.867.5 1 1 0 11-1.731-1A3 3 0 0113 8a3.001 3.001 0 01-2 2.83V11a1 1 0 11-2 0v-1a1 1 0 011-1 1 1 0 100-2zm0 8a1 1 0 100-2 1 1 0 000 2z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                    <span
                                                        class="font-medium text-gray-800">{{ $question->question }}</span>
                                                </div>
                                                <svg class="h-5 w-5 text-gray-500 transform"
                                                    :class="{ 'rotate-180': open }" fill="currentColor"
                                                    viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd"
                                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                            </button>
                                        </div>

                                        <div id="collapse{{ $index }}" x-show="open"
                                            x-transition:enter="transition ease-out duration-200"
                                            x-transition:enter-start="opacity-0 transform scale-95"
                                            x-transition:enter-end="opacity-100 transform scale-100"
                                            x-transition:leave="transition ease-in duration-100"
                                            x-transition:leave-start="opacity-100 transform scale-100"
                                            x-transition:leave-end="opacity-0 transform scale-95">
                                            <div class="p-4 border-t border-gray-200">
                                                <div class="flex">
                                                    <svg class="h-5 w-5 text-green-600 mr-2 mt-0.5" fill="currentColor"
                                                        viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd"
                                                            d="M18 13V5a2 2 0 00-2-2H4a2 2 0 00-2 2v8a2 2 0 002 2h3l3 3 3-3h3a2 2 0 002-2zM5 7a1 1 0 011-1h8a1 1 0 110 2H6a1 1 0 01-1-1zm1 3a1 1 0 100 2h3a1 1 0 100-2H6z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                    <span class="text-gray-700">{{ $question->answer }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif

                <div class="bg-white rounded-lg shadow-lg overflow-hidden mt-6">
                    <div class="p-6 border-b">
                        <h5 class="text-xl font-bold text-green-600">Tanyakan Sesuatu</h5>
                    </div>
                    <div class="p-6">
                        <div class="bg-blue-50 border-l-4 border-blue-500 p-4 mb-4">
                            <div class="flex">
                                <svg class="w-5 h-5 text-blue-500 mr-2" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span class="text-blue-700">Anda dapat mengajukan pertanyaan kepada alumni ini. Pertanyaan
                                    dapat dikirim secara anonim.</span>
                            </div>
                        </div>

                        <form action="{{ route('taaruf.profile.questions.store', $profile->id) }}" method="POST">
                            @csrf
                            <div class="mb-4">
                                <label for="question" class="block text-gray-700 mb-2">Pertanyaan Anda:</label>
                                <textarea name="question" id="question" rows="4"
                                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-green-300 focus:ring focus:ring-green-200 focus:ring-opacity-50 @error('question') border-red-500 @enderror"
                                    required maxlength="500"></textarea>
                                @error('question')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                                <p class="text-gray-500 text-sm mt-1">Maksimal 500 karakter</p>
                            </div>

                            <div class="mb-4">
                                <div class="flex items-center">
                                    {{-- <input type="checkbox" id="is_anonymous" name="is_anonymous" value="1" checked
                                        class="rounded border-gray-300 text-green-600 shadow-sm focus:border-green-300 focus:ring focus:ring-green-200 focus:ring-opacity-50">
                                    <label for="is_anonymous" class="ml-2 text-gray-700">Kirim sebagai pertanyaan
                                        anonim</label> --}}
                                </div>
                                <p class="text-gray-500 text-sm mt-1 ml-6">Nama Anda tidak akan ditampilkan kepada alumni,
                                    tetapi admin tetap dapat melihat identitas Anda.</p>
                            </div>

                            <button type="submit"
                                class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                                </svg>
                                Kirim Pertanyaan
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-1">
                <div class="bg-white rounded-lg shadow-lg mb-8 overflow-hidden top-8">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h5 class="text-xl font-bold text-green-600">Panduan Ta'aruf</h5>
                    </div>
                    <div class="p-6">
                        <div class="bg-blue-50 text-blue-800 p-4 rounded-lg mb-4">
                            <div class="flex">
                                <svg class="h-5 w-5 mr-2 text-blue-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                        clip-rule="evenodd" />
                                </svg>
                                <span>Jika Anda tertarik dengan profil ini, silakan ikuti panduan berikut.</span>
                            </div>
                        </div>

                        <p class="font-semibold text-gray-800 mb-2">Langkah-langkah Ta'aruf:</p>
                        <ol class="list-decimal pl-5 mb-6 space-y-2 text-gray-600">
                            <li>Hubungi admin melalui email atau WhatsApp untuk menyampaikan ketertarikan Anda</li>
                            <li>Admin akan memfasilitasi proses awal ta'aruf dengan menghubungi alumni yang bersangkutan
                            </li>
                            <li>Jika kedua belah pihak setuju, admin akan memfasilitasi pertemuan awal</li>
                            <li>Proses ta'aruf selanjutnya akan difasilitasi sesuai dengan ketentuan yang berlaku</li>
                        </ol>

                        <div class="bg-yellow-50 text-yellow-800 p-4 rounded-lg mb-6">
                            <div class="flex">
                                <svg class="h-5 w-5 mr-2 text-yellow-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z"
                                        clip-rule="evenodd" />
                                </svg>
                                <span>Dilarang menghubungi alumni secara langsung tanpa melalui proses yang telah
                                    ditentukan.</span>
                            </div>
                        </div>

                        <div class="mt-4">
                            <p class="font-semibold text-gray-800 mb-3">Kontak Admin:</p>
                            <p class="flex items-center mb-3 text-gray-600">
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
                            <button
                                class="flex items-center px-4 py-2 my-5 bg-red-600 hover:bg-red-700 text-white rounded-md transition duration-300 ease-in-out focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-opacity-50">
                                <svg class="h-5 w-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                </svg>
                                <a target="_blank"
                                    href="https://docs.google.com/forms/d/e/1FAIpQLSf_iqVADX6qSlJ4T5ceaYAmele14_0AtlcVp9pQpsIKu44BjQ/viewform"
                                    class="text-white no-underline">Ajukan Nama untuk Taaruf</a>
                            </button>
                            <p class="flex items-center text-gray-600 mb-3">
                                <svg class="h-5 w-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M4 4a2 2 0 012-2h4.586a1 1 0 01.707.293l4.414 4.414a1 1 0 01.293.707V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z"
                                        clip-rule="evenodd" />
                                </svg>
                                <a target="_blank"
                                    href="https://docs.google.com/document/d/1Nd28lj0pWuKRh2gBGRgnCFGPdW1VLifs/edit?tab=t.0#heading=h.gjdgxs">Template
                                    CV Format SPN</a>
                            </p>
                            <p class="flex items-center text-gray-600 mb-3">
                                <svg class="h-5 w-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                        clip-rule="evenodd" />
                                </svg>
                                <a target="_blank"
                                    href="https://www.canva.com/design/DAGgvvB4Mpc/3IOk581b_A1XvYJ1phJU5g/view?utm_content=DAGgvvB4Mpc&utm_campaign=designshare&utm_medium=link2&utm_source=uniquelinks&utlId=he59da50a6a">Penjelasan
                                    Taaruf di SPN</a>
                            </p>
                            </p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h5 class="text-xl font-bold text-green-600">Pengingat Penting</h5>
                    </div>
                    <div class="p-6">
                        <ul class="space-y-3 text-gray-600">
                            <li class="flex items-start">
                                <svg class="h-5 w-5 text-green-500 mr-2 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                        clip-rule="evenodd" />
                                </svg>
                                <span>Hormati privasi alumni dengan tidak menyebarkan informasi profil mereka</span>
                            </li>
                            <li class="flex items-start">
                                <svg class="h-5 w-5 text-green-500 mr-2 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                        clip-rule="evenodd" />
                                </svg>
                                <span>Jaga adab komunikasi sesuai syariat Islam</span>
                            </li>
                            <li class="flex items-start">
                                <svg class="h-5 w-5 text-green-500 mr-2 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                        clip-rule="evenodd" />
                                </svg>
                                <span>Pastikan niat Anda untuk ta'aruf adalah untuk tujuan pernikahan</span>
                            </li>
                            <li class="flex items-start">
                                <svg class="h-5 w-5 text-green-500 mr-2 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                        clip-rule="evenodd" />
                                </svg>
                                <span>Ikuti semua ketentuan yang telah ditetapkan dalam proses ta'aruf</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
