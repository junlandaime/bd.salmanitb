@extends('layouts.app')

@section('title', 'Daftar Alumni Ta\'aruf')
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
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="mb-8">
            <nav class="mb-4">
                <ol class="flex text-sm">
                    <li class="flex items-center">
                        <a href="{{ route('alumni.dashboard') }}" class="text-green-600 hover:text-green-700">Dashboard
                            Alumni</a>
                        <svg class="w-4 h-4 mx-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </li>
                    <li class="flex items-center">
                        <a href="{{ route('taaruf.index') }}" class="text-green-600 hover:text-green-700">Ta'aruf</a>
                        <svg class="w-4 h-4 mx-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </li>
                    <li class="text-gray-500">Daftar Alumni</li>
                </ol>
            </nav>
            <h2 class="text-3xl font-bold text-green-600">Daftar Alumni Ta'aruf</h2>
            <p class="text-gray-500 mt-2">Berikut adalah daftar alumni yang siap untuk ta'aruf</p>
        </div>

        @if (session('error'))
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4" role="alert">
                <p>{{ session('error') }}</p>
            </div>
        @endif

        @if (session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4" role="alert">
                <p>{{ session('success') }}</p>
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="lg:col-span-2">
                <div class="bg-white rounded-lg shadow-lg overflow-hidden mb-8">
                    <div class="p-6 border-b">
                        <h5 class="text-xl font-bold text-green-600 mb-4">Pencarian dan Filter</h5>
                        <form action="{{ route('taaruf.list') }}" method="GET" class="space-y-4">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <!-- Search Input -->
                                <div>
                                    <label for="search" class="block text-sm font-medium text-gray-700 mb-1">Cari
                                        Nama</label>
                                    <div class="relative rounded-md shadow-sm">
                                        <input type="text" name="search" id="search"
                                            class="focus:ring-green-500 focus:border-green-500 block w-full pl-3 pr-10 py-2 sm:text-sm border-gray-300 rounded-md"
                                            placeholder="Masukkan nama..." value="{{ request('search') }}">
                                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                            </svg>
                                        </div>
                                    </div>
                                </div>

                                <!-- Filter Type -->
                                <div>
                                    <label for="filter"
                                        class="block text-sm font-medium text-gray-700 mb-1">Filter</label>
                                    <select id="filter" name="filter"
                                        class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm rounded-md">
                                        <option value="all"
                                            {{ request('filter') == 'all' || !request('filter') ? 'selected' : '' }}>
                                            Semua
                                        </option>
                                        <option value="location" {{ request('filter') == 'location' ? 'selected' : '' }}>
                                            Berdasarkan Lokasi
                                        </option>
                                        <option value="education" {{ request('filter') == 'education' ? 'selected' : '' }}>
                                            Berdasarkan Pendidikan
                                        </option>
                                        <option value="marriage_year"
                                            {{ request('filter') == 'marriage_year' ? 'selected' : '' }}>
                                            Berdasarkan Target Menikah
                                        </option>
                                    </select>
                                </div>
                            </div>

                            <!-- Location Filter Options -->
                            <div class="hidden filter-options space-y-4" id="location-options">
                                <div class="bg-green-50 border border-green-200 rounded-lg p-4">
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <!-- Location Type Selection -->
                                        <div>
                                            <label for="location_type" class="block text-sm font-medium text-gray-700 mb-2">
                                                <svg class="inline-block h-4 w-4 mr-1 text-green-600" fill="none"
                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                                </svg>
                                                Tipe Lokasi
                                            </label>
                                            <select name="location_type" id="location_type"
                                                class="block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm rounded-md">
                                                <option value="origin"
                                                    {{ request('location_type') == 'origin' || !request('location_type') ? 'selected' : '' }}>
                                                    Asal Daerah
                                                </option>
                                                <option value="residence"
                                                    {{ request('location_type') == 'residence' ? 'selected' : '' }}>
                                                    Domisili Saat Ini
                                                </option>
                                            </select>
                                        </div>

                                        <!-- Location Level Selection -->
                                        <div>
                                            <label for="location_level"
                                                class="block text-sm font-medium text-gray-700 mb-2">
                                                <svg class="inline-block h-4 w-4 mr-1 text-green-600" fill="none"
                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7" />
                                                </svg>
                                                Level Wilayah
                                            </label>
                                            <select name="location_level" id="location_level"
                                                class="block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm rounded-md">
                                                <option value="province"
                                                    {{ request('location_level') == 'province' || !request('location_level') ? 'selected' : '' }}>
                                                    Provinsi
                                                </option>
                                                <option value="city"
                                                    {{ request('location_level') == 'city' ? 'selected' : '' }}>
                                                    Kota/Kabupaten
                                                </option>
                                                <option value="district"
                                                    {{ request('location_level') == 'district' ? 'selected' : '' }}>
                                                    Kecamatan
                                                </option>
                                            </select>
                                        </div>
                                    </div>

                                    <!-- Dynamic Location Dropdowns -->
                                    <div class="mt-4 grid grid-cols-1 gap-4" id="location-selects">
                                        <!-- Province Select -->
                                        <div id="province-select-container">
                                            <label for="location_province"
                                                class="block text-sm font-medium text-gray-700 mb-2">
                                                Pilih Provinsi
                                            </label>
                                            <select name="location_province" id="location_province"
                                                class="block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm rounded-md">
                                                <option value="">-- Semua Provinsi --</option>
                                            </select>
                                        </div>

                                        <!-- City Select (Hidden by default) -->
                                        <div id="city-select-container" class="hidden">
                                            <label for="location_city"
                                                class="block text-sm font-medium text-gray-700 mb-2">
                                                Pilih Kota/Kabupaten
                                            </label>
                                            <select name="location_city" id="location_city" disabled
                                                class="block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm rounded-md">
                                                <option value="">-- Pilih Provinsi Terlebih Dahulu --</option>
                                            </select>
                                        </div>

                                        <!-- District Select (Hidden by default) -->
                                        <div id="district-select-container" class="hidden">
                                            <label for="location_district"
                                                class="block text-sm font-medium text-gray-700 mb-2">
                                                Pilih Kecamatan
                                            </label>
                                            <select name="location_district" id="location_district" disabled
                                                class="block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm rounded-md">
                                                <option value="">-- Pilih Kota/Kabupaten Terlebih Dahulu --</option>
                                            </select>
                                        </div>
                                    </div>

                                    <!-- Info Badge -->
                                    <div class="mt-3 flex items-start">
                                        <svg class="h-5 w-5 text-blue-500 mt-0.5 mr-2 flex-shrink-0" fill="currentColor"
                                            viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        <p class="text-xs text-gray-600">
                                            <strong>Tips:</strong> Pilih level wilayah terlebih dahulu, kemudian pilih
                                            wilayah yang diinginkan.
                                            Semakin spesifik level yang dipilih, semakin detail pencarian yang dilakukan.
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <!-- Education Filter Options (Enhanced Version) -->
                            <div class="hidden filter-options" id="education-options">
                                <div class="bg-green-50 border border-green-200 rounded-lg p-4">
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <!-- Education Filter Type Selection -->
                                        <div>
                                            <label for="education_filter_type"
                                                class="block text-sm font-medium text-gray-700 mb-2">
                                                <svg class="inline-block h-4 w-4 mr-1 text-green-600" fill="none"
                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                                </svg>
                                                Tipe Filter Pendidikan
                                            </label>
                                            <select name="education_filter_type" id="education_filter_type"
                                                class="block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm rounded-md">
                                                <option value="strata"
                                                    {{ request('education_filter_type') == 'strata' || !request('education_filter_type') ? 'selected' : '' }}>
                                                    Berdasarkan Strata Pendidikan
                                                </option>
                                                <option value="university"
                                                    {{ request('education_filter_type') == 'university' ? 'selected' : '' }}>
                                                    Berdasarkan Kampus
                                                </option>
                                                <option value="major"
                                                    {{ request('education_filter_type') == 'major' ? 'selected' : '' }}>
                                                    Berdasarkan Jurusan/Program Studi
                                                </option>
                                                <option value="strata_university"
                                                    {{ request('education_filter_type') == 'strata_university' ? 'selected' : '' }}>
                                                    Berdasarkan Strata dan Kampus
                                                </option>
                                                <option value="strata_major"
                                                    {{ request('education_filter_type') == 'strata_major' ? 'selected' : '' }}>
                                                    Berdasarkan Strata dan Jurusan
                                                </option>
                                                <option value="full"
                                                    {{ request('education_filter_type') == 'full' ? 'selected' : '' }}>
                                                    Filter Lengkap (Strata, Kampus, Jurusan)
                                                </option>
                                            </select>
                                        </div>

                                        <!-- Empty space for visual balance -->
                                        <div></div>
                                    </div>

                                    <!-- Dynamic Education Filter Dropdowns -->
                                    <div class="mt-4 grid grid-cols-1 gap-4" id="education-selects">

                                        <!-- Strata Select -->
                                        <div id="strata-select-container">
                                            <label for="filter_education_level"
                                                class="block text-sm font-medium text-gray-700 mb-2">
                                                <svg class="inline-block h-4 w-4 mr-1 text-green-600" fill="none"
                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                                                </svg>
                                                Pilih Strata Pendidikan
                                            </label>
                                            <select name="filter_education_level" id="filter_education_level"
                                                class="block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm rounded-md">
                                                <option value="">-- Semua Strata --</option>
                                                <option value="SD"
                                                    {{ request('filter_education_level') == 'SD' ? 'selected' : '' }}>
                                                    SD/Sederajat</option>
                                                <option value="SMP"
                                                    {{ request('filter_education_level') == 'SMP' ? 'selected' : '' }}>
                                                    SMP/Sederajat</option>
                                                <option value="SMA"
                                                    {{ request('filter_education_level') == 'SMA' ? 'selected' : '' }}>
                                                    SMA/Sederajat</option>
                                                <option value="SMK"
                                                    {{ request('filter_education_level') == 'SMK' ? 'selected' : '' }}>SMK
                                                </option>
                                                <option value="D3"
                                                    {{ request('filter_education_level') == 'D3' ? 'selected' : '' }}>
                                                    Diploma 3 (D3)</option>
                                                <option value="D4"
                                                    {{ request('filter_education_level') == 'D4' ? 'selected' : '' }}>
                                                    Diploma 4 (D4)</option>
                                                <option value="S1"
                                                    {{ request('filter_education_level') == 'S1' ? 'selected' : '' }}>
                                                    Sarjana (S1)</option>
                                                <option value="S2"
                                                    {{ request('filter_education_level') == 'S2' ? 'selected' : '' }}>
                                                    Magister (S2)</option>
                                                <option value="S3"
                                                    {{ request('filter_education_level') == 'S3' ? 'selected' : '' }}>
                                                    Doktor (S3)</option>
                                            </select>
                                        </div>

                                        <!-- University Select -->
                                        <div id="university-select-container" class="hidden">
                                            <label for="filter_university"
                                                class="block text-sm font-medium text-gray-700 mb-2">
                                                <svg class="inline-block h-4 w-4 mr-1 text-green-600" fill="none"
                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                                </svg>
                                                Pilih Kampus/Universitas
                                            </label>
                                            <select name="filter_university" id="filter_university"
                                                class="block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm rounded-md">
                                                <option value="">Memuat data kampus...</option>
                                            </select>
                                            <p class="mt-1 text-xs text-gray-500">💡 Ketik untuk mencari nama kampus</p>
                                        </div>

                                        <!-- Major Select -->
                                        <div id="major-select-container" class="hidden">
                                            <label for="filter_major"
                                                class="block text-sm font-medium text-gray-700 mb-2">
                                                <svg class="inline-block h-4 w-4 mr-1 text-green-600" fill="none"
                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                                </svg>
                                                Pilih Jurusan/Program Studi
                                            </label>
                                            <input type="text" name="filter_major" id="filter_major"
                                                class="block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm rounded-md"
                                                placeholder="Ketik jurusan... (contoh: Teknik Informatika)"
                                                value="{{ request('filter_major') }}">
                                            <p class="mt-1 text-xs text-gray-500">💡 Ketik nama jurusan atau program studi
                                                yang dicari</p>
                                        </div>

                                    </div>

                                    <!-- Info Badge -->
                                    <div class="mt-3 flex items-start">
                                        <svg class="h-5 w-5 text-blue-500 mt-0.5 mr-2 flex-shrink-0" fill="currentColor"
                                            viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        <p class="text-xs text-gray-600">
                                            <strong>Tips:</strong> Pilih tipe filter terlebih dahulu, kemudian isi kriteria
                                            yang diinginkan.
                                            Filter akan mencari profil yang sesuai dengan kombinasi kriteria yang Anda
                                            tentukan.
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <!-- Marriage Year Filter Options -->
                            <div class="hidden filter-options" id="marriage_year-options">
                                <label for="marriage_year" class="block text-sm font-medium text-gray-700 mb-1">Pilih
                                    Target Tahun Menikah</label>
                                <select name="marriage_year" id="marriage_year"
                                    class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm rounded-md">
                                    <option value="">Pilih Tahun</option>
                                    @for ($year = 2025; $year <= 2030; $year++)
                                        <option value="{{ $year }}"
                                            {{ request('marriage_year') == $year ? 'selected' : '' }}>
                                            {{ $year }}
                                        </option>
                                    @endfor
                                </select>
                            </div>

                            <!-- Action Buttons -->
                            <div class="flex justify-between items-center">
                                <a href="{{ route('taaruf.list') }}"
                                    class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                    </svg>
                                    Reset Filter
                                </a>
                                <button type="submit"
                                    class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                    </svg>
                                    Terapkan Filter
                                </button>
                            </div>
                        </form>
                    </div>

                    <div class="p-6">
                        <!-- View Controls -->
                        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
                            <h5 class="text-xl font-bold text-green-600">Profil Alumni</h5>

                            <div class="flex flex-col sm:flex-row gap-3 w-full sm:w-auto">
                                <!-- Per Page Selection -->
                                <div class="flex items-center gap-2">
                                    <label for="per_page"
                                        class="text-sm text-gray-600 whitespace-nowrap">Tampilkan:</label>
                                    <select id="per_page" name="per_page"
                                        class="block w-full sm:w-auto pl-3 pr-8 py-2 text-sm border-gray-300 focus:outline-none focus:ring-green-500 focus:border-green-500 rounded-md">
                                        <option value="10" {{ request('per_page', 10) == 10 ? 'selected' : '' }}>10
                                        </option>
                                        <option value="25" {{ request('per_page', 10) == 25 ? 'selected' : '' }}>25
                                        </option>
                                        <option value="50" {{ request('per_page', 10) == 50 ? 'selected' : '' }}>50
                                        </option>
                                        <option value="100" {{ request('per_page', 10) == 100 ? 'selected' : '' }}>100
                                        </option>
                                    </select>
                                </div>

                                <!-- View Toggle -->
                                <div class="flex items-center bg-gray-100 rounded-md p-1">
                                    <button type="button" id="cardViewBtn"
                                        class="view-toggle flex items-center px-3 py-2 text-sm font-medium rounded transition-colors {{ request('view', 'card') == 'card' ? 'bg-white text-green-600 shadow-sm' : 'text-gray-600 hover:text-gray-900' }}">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z">
                                            </path>
                                        </svg>
                                        Card
                                    </button>
                                    <button type="button" id="listViewBtn"
                                        class="view-toggle flex items-center px-3 py-2 text-sm font-medium rounded transition-colors {{ request('view') == 'list' ? 'bg-white text-green-600 shadow-sm' : 'text-gray-600 hover:text-gray-900' }}">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4 6h16M4 12h16M4 18h16"></path>
                                        </svg>
                                        List
                                    </button>
                                </div>
                            </div>
                        </div>

                        @if (count($profiles) > 0)
                            <!-- Card View -->
                            <div id="cardView" class="{{ request('view') == 'list' ? 'hidden' : '' }}">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    @foreach ($profiles as $profile)
                                        @php
                                            $age = \App\Helpers\DateHelper::getAgeFromBirthPlaceDate(
                                                $profile->birth_place_date,
                                            );
                                        @endphp
                                        <div
                                            class="bg-white rounded-lg border shadow-sm hover:shadow-md transition duration-300 h-full">
                                            <div class="p-6">
                                                <div class="flex justify-center mb-4">
                                                    @if ($profile->photo_url)
                                                        <img src="{{ $profile->photo_url }}"
                                                            alt="{{ $profile->full_name }}"
                                                            class="w-24 h-24 rounded-full object-cover">
                                                    @else
                                                        <div
                                                            class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center">
                                                            <svg class="w-12 h-12 text-gray-400" fill="none"
                                                                stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2"
                                                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z">
                                                                </path>
                                                            </svg>
                                                        </div>
                                                    @endif
                                                </div>

                                                <h5 class="text-xl font-bold text-center mb-4">{{ $profile->full_name }}
                                                </h5>

                                                <div class="space-y-2">
                                                    <div class="flex justify-between">
                                                        <span class="text-gray-500">Usia:</span>
                                                        <span
                                                            class="{{ $age === null ? 'text-red-600 font-semibold' : '' }}"
                                                            @if ($age === null) title="Lengkapi data tempat & tanggal lahir agar usia tampil" @endif>
                                                            @if ($age === null)
                                                                N/A
                                                            @else
                                                                {{ $age }} tahun
                                                            @endif
                                                        </span>
                                                    </div>
                                                    <div class="flex justify-between">
                                                        <span class="text-gray-500">Domisili:</span>
                                                        <span
                                                            class="text-wrap text-right text-sm">{{ $profile->current_residence }}</span>
                                                    </div>
                                                    <div class="flex justify-between">
                                                        <span class="text-gray-500">Pendidikan:</span>
                                                        <span
                                                            class="text-wrap text-right text-sm">{{ $profile->last_education }}</span>
                                                    </div>
                                                    <div class="flex justify-between">
                                                        <span class="text-gray-500">Pekerjaan:</span>
                                                        <span
                                                            class="text-wrap text-right text-sm">{{ $profile->occupation }}</span>
                                                    </div>
                                                    @if ($profile->marriage_target_year)
                                                        <div class="flex justify-between">
                                                            <span class="text-gray-500">Target Menikah:</span>
                                                            <span
                                                                class="text-wrap text-right text-sm">{{ $profile->marriage_target_year }}</span>
                                                        </div>
                                                    @endif
                                                </div>

                                                <div class="text-center mt-6">
                                                    <a href="{{ route('taaruf.profile.show', $profile->id) }}"
                                                        class="inline-flex items-center px-4 py-2 border border-green-600 rounded-md text-sm font-medium text-green-600 hover:bg-green-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z">
                                                            </path>
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                                            </path>
                                                        </svg>
                                                        Lihat Profil Lengkap
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <!-- Table View -->
                            <div id="listView" class="{{ request('view') == 'list' ? '' : 'hidden' }}">
                                <div class="bg-white rounded-lg border shadow-sm overflow-hidden">
                                    <div class="overflow-x-auto">
                                        <table class="min-w-full divide-y divide-gray-200">
                                            <thead class="bg-gray-50">
                                                <tr>
                                                    <th scope="col"
                                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                        Foto
                                                    </th>
                                                    <th scope="col"
                                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                        Nama Lengkap
                                                    </th>
                                                    <th scope="col"
                                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                        Usia
                                                    </th>
                                                    <th scope="col"
                                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                        Domisili
                                                    </th>
                                                    {{-- <th scope="col"
                                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                        Pendidikan
                                                    </th>
                                                    <th scope="col"
                                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                        Pekerjaan
                                                    </th> --}}
                                                    <th scope="col"
                                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                        Target Menikah
                                                    </th>
                                                    <th scope="col"
                                                        class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                        Aksi
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody class="bg-white divide-y divide-gray-200">
                                                @foreach ($profiles as $profile)
                                                    <tr class="hover:bg-gray-50 transition duration-150">
                                                        <td class="px-6 py-4 whitespace-nowrap">
                                                            @if ($profile->photo_url)
                                                                <img src="{{ $profile->photo_url }}"
                                                                    alt="{{ $profile->full_name }}"
                                                                    class="w-12 h-12 rounded-full object-cover">
                                                            @else
                                                                <div
                                                                    class="w-12 h-12 bg-gray-100 rounded-full flex items-center justify-center">
                                                                    <svg class="w-6 h-6 text-gray-400" fill="none"
                                                                        stroke="currentColor" viewBox="0 0 24 24">
                                                                        <path stroke-linecap="round"
                                                                            stroke-linejoin="round" stroke-width="2"
                                                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z">
                                                                        </path>
                                                                    </svg>
                                                                </div>
                                                            @endif
                                                        </td>
                                                        <td class="px-6 py-4 whitespace-nowrap">
                                                            <div class="text-sm font-medium text-gray-900">
                                                                {{ $profile->full_name }}</div>
                                                        </td>
                                                        <td class="px-6 py-4 whitespace-nowrap">
                                                            <div class="text-sm text-gray-900">
                                                                {{ \App\Helpers\DateHelper::getAgeFromBirthPlaceDate($profile->birth_place_date) ?? 'N/A' }}
                                                                tahun
                                                            </div>
                                                        </td>
                                                        <td class="px-6 py-4">
                                                            <div class="text-sm text-gray-900">
                                                                {{ $profile->current_residence }}</div>
                                                        </td>
                                                        {{-- <td class="px-6 py-4">
                                                            <div class="text-sm text-gray-900">
                                                                {{ $profile->last_education }}</div>
                                                        </td>
                                                        <td class="px-6 py-4">
                                                            <div class="text-sm text-gray-900">{{ $profile->occupation }}
                                                            </div>
                                                        </td> --}}
                                                        <td class="px-6 py-4 whitespace-nowrap">
                                                            <div class="text-sm text-gray-900">
                                                                {{ $profile->marriage_target_year ?? '-' }}
                                                            </div>
                                                        </td>
                                                        <td class="px-6 py-4 whitespace-nowrap text-center">
                                                            <a href="{{ route('taaruf.profile.show', $profile->id) }}"
                                                                class="inline-flex items-center px-3 py-1.5 border border-green-600 rounded-md text-xs font-medium text-green-600 hover:bg-green-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                                                <svg class="w-4 h-4 mr-1" fill="none"
                                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                                        stroke-width="2"
                                                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z">
                                                                    </path>
                                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                                        stroke-width="2"
                                                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                                                    </path>
                                                                </svg>
                                                                Lihat
                                                            </a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="flex justify-center mt-8">
                                {{ $profiles->appends(request()->query())->links() }}
                            </div>
                        @else
                            <div class="text-center py-16">
                                <svg class="w-16 h-16 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z">
                                    </path>
                                </svg>
                                <h4 class="text-xl font-bold mb-2">Belum ada profil alumni yang tersedia</h4>
                                <p class="text-gray-500">Saat ini belum ada alumni lawan jenis yang aktif dalam fitur
                                    Ta'aruf</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="lg:col-span-1">
                <div class="bg-white rounded-lg shadow-lg overflow-hidden mb-6 top-5">
                    <div class="p-6 border-b">
                        <h5 class="text-xl font-bold text-green-600">Informasi</h5>
                    </div>
                    <div class="p-6">
                        <div class="bg-blue-50 border-l-4 border-blue-500 p-4 mb-4">
                            <div class="flex">
                                <svg class="w-5 h-5 text-blue-500 mr-2" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span class="text-blue-700">Daftar ini hanya menampilkan profil alumni lawan jenis yang
                                    aktif dalam fitur Ta'aruf.</span>
                            </div>
                        </div>

                        <p class="font-bold text-gray-700 mb-2">Panduan melihat profil:</p>
                        <ul class="list-disc pl-5 mb-4 text-gray-600 space-y-1">
                            <li>Klik "Lihat Profil Lengkap" untuk melihat informasi lebih detail</li>
                            <li>Profil yang ditampilkan telah menyetujui untuk ditampilkan dalam daftar ini</li>
                            <li>Hormati privasi setiap alumni dengan tidak menyebarkan informasi profil mereka</li>
                        </ul>

                        <p class="font-bold text-gray-700 mb-2">Langkah selanjutnya:</p>
                        <ul class="list-disc pl-5 mb-4 text-gray-600 space-y-1">
                            <li>Jika tertarik dengan profil tertentu, Anda dapat menghubungi admin untuk proses ta'aruf
                                lebih lanjut</li>
                            <li>Admin akan memfasilitasi proses perkenalan sesuai dengan ketentuan ta'aruf</li>
                        </ul>

                        <div class="bg-yellow-50 border-l-4 border-yellow-500 p-4 mt-4">
                            <div class="flex">
                                <svg class="w-5 h-5 text-yellow-500 mr-2" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z">
                                    </path>
                                </svg>
                                <span class="text-yellow-700">Dilarang menghubungi alumni secara langsung tanpa melalui
                                    proses yang telah ditentukan.</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                    <div class="p-6 border-b">
                        <h5 class="text-xl font-bold text-green-600">Status Profil Anda</h5>
                    </div>
                    <div class="p-6">
                        @if ($myProfile && $myProfile->is_active)
                            <div class="bg-green-50 border-l-4 border-green-500 p-4">
                                <div class="flex">
                                    <svg class="w-5 h-5 text-green-500 mr-2" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    <span class="text-green-700">Profil Ta'aruf Anda sedang aktif dan dapat dilihat oleh
                                        alumni lain.</span>
                                </div>
                            </div>
                        @else
                            <div class="bg-yellow-50 border-l-4 border-yellow-500 p-4">
                                <div class="flex">
                                    <svg class="w-5 h-5 text-yellow-500 mr-2" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z">
                                        </path>
                                    </svg>
                                    <span class="text-yellow-700">Profil Ta'aruf Anda sedang tidak aktif dan tidak dapat
                                        dilihat oleh alumni lain.</span>
                                </div>
                            </div>

                            <a href="{{ route('taaruf.index') }}"
                                class="mt-4 w-full inline-flex items-center justify-center px-4 py-2 border border-green-600 rounded-md text-sm font-medium text-green-600 hover:bg-green-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                    </path>
                                </svg>
                                Kelola Profil Ta'aruf
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Select2 CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />

    <!-- jQuery (required for Select2) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <!-- Select2 JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

    <!-- ============================================= -->
    <!-- 2. CUSTOM STYLES -->
    <!-- ============================================= -->
    <style>
        /* Base Select2 Styling */
        .select2-container--default .select2-selection--single {
            height: 42px !important;
            border: 1px solid #d1d5db !important;
            border-radius: 0.375rem !important;
            padding: 0.5rem 0.75rem !important;
            transition: all 0.2s ease;
        }

        .select2-container--default .select2-selection--single:hover {
            border-color: #10b981 !important;
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 30px !important;
            padding-left: 0 !important;
            color: #374151 !important;
            font-size: 0.875rem;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 40px !important;
            right: 8px !important;
        }

        .select2-container--default.select2-container--focus .select2-selection--single,
        .select2-container--default .select2-selection--single:focus {
            border-color: #10b981 !important;
            outline: none !important;
            box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.1) !important;
        }

        .select2-dropdown {
            border: 1px solid #d1d5db !important;
            border-radius: 0.375rem !important;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05) !important;
        }

        .select2-container--default .select2-results__option {
            padding: 8px 12px !important;
            font-size: 0.875rem;
        }

        .select2-container--default .select2-results__option--highlighted[aria-selected] {
            background-color: #10b981 !important;
            color: white !important;
        }

        .select2-container--default .select2-results__option[aria-selected=true] {
            background-color: #d1fae5 !important;
            color: #065f46 !important;
        }

        .select2-search--dropdown {
            padding: 8px !important;
        }

        .select2-search--dropdown .select2-search__field {
            border: 1px solid #d1d5db !important;
            border-radius: 0.375rem !important;
            padding: 0.5rem !important;
            font-size: 0.875rem;
        }

        .select2-search--dropdown .select2-search__field:focus {
            border-color: #10b981 !important;
            outline: none !important;
            box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.1) !important;
        }

        .select2-container {
            width: 100% !important;
        }

        /* Major input styling */
        #filter_major {
            transition: all 0.2s ease;
        }

        #filter_major:hover {
            border-color: #10b981;
        }

        #filter_major:focus {
            border-color: #10b981 !important;
            box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.1) !important;
        }

        /* Container transitions */
        #strata-select-container,
        #university-select-container,
        #major-select-container {
            transition: all 0.3s ease-in-out;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .select2-container--default .select2-selection--single {
                height: 44px !important;
                padding: 0.625rem 0.75rem !important;
            }

            .select2-container--default .select2-selection--single .select2-selection__rendered {
                line-height: 32px !important;
            }
        }
    </style>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const filterSelect = document.getElementById('filter');
                const filterOptions = document.querySelectorAll('.filter-options');
                const perPageSelect = document.getElementById('per_page');
                const cardViewBtn = document.getElementById('cardViewBtn');
                const listViewBtn = document.getElementById('listViewBtn');
                const cardView = document.getElementById('cardView');
                const listView = document.getElementById('listView');

                // Location filter elements
                const locationLevelSelect = document.getElementById('location_level');
                const locationProvinceSelect = document.getElementById('location_province');
                const locationCitySelect = document.getElementById('location_city');
                const locationDistrictSelect = document.getElementById('location_district');
                const provinceContainer = document.getElementById('province-select-container');
                const cityContainer = document.getElementById('city-select-container');
                const districtContainer = document.getElementById('district-select-container');

                // Saved filter values
                const savedProvince = "{{ request('location_province') ?? '' }}";
                const savedCity = "{{ request('location_city') ?? '' }}";
                const savedDistrict = "{{ request('location_district') ?? '' }}";

                // Function to get current URL parameters
                function getUrlParams() {
                    const params = new URLSearchParams(window.location.search);
                    return params;
                }

                // Function to update URL and reload page
                function updateUrlAndReload(key, value) {
                    const params = getUrlParams();
                    params.set(key, value);
                    window.location.search = params.toString();
                }

                // Function to show the appropriate filter options based on selection
                function showFilterOptions() {
                    filterOptions.forEach(option => {
                        option.classList.add('hidden');
                    });

                    const selectedFilter = filterSelect.value;
                    if (selectedFilter !== 'all') {
                        const optionsToShow = document.getElementById(selectedFilter + '-options');
                        if (optionsToShow) {
                            optionsToShow.classList.remove('hidden');
                        }
                    }
                }

                // Function to show/hide location selects based on level
                function updateLocationSelects() {
                    const level = locationLevelSelect.value;

                    // Reset visibility
                    provinceContainer.classList.remove('hidden');
                    cityContainer.classList.add('hidden');
                    districtContainer.classList.add('hidden');

                    // Show based on level
                    if (level === 'city' || level === 'district') {
                        cityContainer.classList.remove('hidden');
                    }
                    if (level === 'district') {
                        districtContainer.classList.remove('hidden');
                    }
                }

                // Load provinces
                function loadProvinces() {
                    fetch('https://ibnux.github.io/data-indonesia/provinsi.json')
                        .then(response => response.json())
                        .then(data => {
                            locationProvinceSelect.innerHTML = '<option value="">-- Semua Provinsi --</option>';
                            data.forEach(prov => {
                                const option = document.createElement('option');
                                option.value = prov.nama;
                                option.textContent = prov.nama;
                                option.setAttribute('data-id', prov.id);
                                if (prov.nama === savedProvince) {
                                    option.selected = true;
                                }
                                locationProvinceSelect.appendChild(option);
                            });

                            if (savedProvince) {
                                locationProvinceSelect.dispatchEvent(new Event('change'));
                            }
                        })
                        .catch(error => console.error('Error loading provinces:', error));
                }

                // Load cities based on province
                locationProvinceSelect.addEventListener('change', function() {
                    const selected = this.options[this.selectedIndex];
                    const provId = selected.getAttribute('data-id');

                    locationCitySelect.innerHTML =
                        '<option value="">-- Pilih Provinsi Terlebih Dahulu --</option>';
                    locationCitySelect.disabled = true;
                    locationDistrictSelect.innerHTML =
                        '<option value="">-- Pilih Kota/Kabupaten Terlebih Dahulu --</option>';
                    locationDistrictSelect.disabled = true;

                    if (!provId) return;

                    locationCitySelect.innerHTML = '<option value="">Loading...</option>';

                    fetch(`https://ibnux.github.io/data-indonesia/kabupaten/${provId}.json`)
                        .then(response => response.json())
                        .then(data => {
                            locationCitySelect.innerHTML =
                                '<option value="">-- Semua Kota/Kabupaten --</option>';
                            data.forEach(kota => {
                                const option = document.createElement('option');
                                option.value = kota.nama;
                                option.textContent = kota.nama;
                                option.setAttribute('data-id', kota.id);
                                if (kota.nama === savedCity) {
                                    option.selected = true;
                                }
                                locationCitySelect.appendChild(option);
                            });
                            locationCitySelect.disabled = false;

                            if (savedCity) {
                                locationCitySelect.dispatchEvent(new Event('change'));
                            }
                        })
                        .catch(error => console.error('Error loading cities:', error));
                });

                // Load districts based on city
                locationCitySelect.addEventListener('change', function() {
                    const selected = this.options[this.selectedIndex];
                    const cityId = selected.getAttribute('data-id');

                    locationDistrictSelect.innerHTML =
                        '<option value="">-- Pilih Kota/Kabupaten Terlebih Dahulu --</option>';
                    locationDistrictSelect.disabled = true;

                    if (!cityId) return;

                    locationDistrictSelect.innerHTML = '<option value="">Loading...</option>';

                    fetch(`https://ibnux.github.io/data-indonesia/kecamatan/${cityId}.json`)
                        .then(response => response.json())
                        .then(data => {
                            locationDistrictSelect.innerHTML =
                                '<option value="">-- Semua Kecamatan --</option>';
                            data.forEach(kec => {
                                const option = document.createElement('option');
                                option.value = kec.nama;
                                option.textContent = kec.nama;
                                option.setAttribute('data-id', kec.id);
                                if (kec.nama === savedDistrict) {
                                    option.selected = true;
                                }
                                locationDistrictSelect.appendChild(option);
                            });
                            locationDistrictSelect.disabled = false;
                        })
                        .catch(error => console.error('Error loading districts:', error));
                });

                // Initialize
                showFilterOptions();
                updateLocationSelects();
                loadProvinces();

                // Event listeners
                filterSelect.addEventListener('change', showFilterOptions);
                locationLevelSelect.addEventListener('change', updateLocationSelects);

                // Per page change handler
                if (perPageSelect) {
                    perPageSelect.addEventListener('change', function() {
                        updateUrlAndReload('per_page', this.value);
                    });
                }

                // View toggle handlers
                if (cardViewBtn && listViewBtn) {
                    cardViewBtn.addEventListener('click', function() {
                        if (!cardView.classList.contains('hidden')) return;

                        cardView.classList.remove('hidden');
                        listView.classList.add('hidden');

                        cardViewBtn.classList.add('bg-white', 'text-green-600', 'shadow-sm');
                        cardViewBtn.classList.remove('text-gray-600', 'hover:text-gray-900');

                        listViewBtn.classList.remove('bg-white', 'text-green-600', 'shadow-sm');
                        listViewBtn.classList.add('text-gray-600', 'hover:text-gray-900');

                        updateUrlAndReload('view', 'card');
                    });

                    listViewBtn.addEventListener('click', function() {
                        if (!listView.classList.contains('hidden')) return;

                        listView.classList.remove('hidden');
                        cardView.classList.add('hidden');

                        listViewBtn.classList.add('bg-white', 'text-green-600', 'shadow-sm');
                        listViewBtn.classList.remove('text-gray-600', 'hover:text-gray-900');

                        cardViewBtn.classList.remove('bg-white', 'text-green-600', 'shadow-sm');
                        cardViewBtn.classList.add('text-gray-600', 'hover:text-gray-900');

                        updateUrlAndReload('view', 'list');
                    });
                }
            });
        </script>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Tunggu hingga jQuery dan Select2 benar-benar loaded
                setTimeout(function() {
                    if (typeof jQuery !== 'undefined' && typeof jQuery.fn.select2 !== 'undefined') {
                        // Inisialisasi Select2 pada dropdown pendidikan
                        jQuery('#education').select2({
                            placeholder: "Ketik untuk mencari pendidikan...",
                            allowClear: true,
                            width: '100%',
                            dropdownParent: jQuery(
                                '#education-options'), // Pastikan dropdown muncul di tempat yang tepat
                            language: {
                                noResults: function() {
                                    return "Tidak ada hasil yang ditemukan";
                                },
                                searching: function() {
                                    return "Mencari...";
                                },
                                inputTooShort: function() {
                                    return "Ketik untuk mencari";
                                }
                            },
                            // Konfigurasi pencarian
                            matcher: function(params, data) {
                                // Jika tidak ada query pencarian, tampilkan semua
                                if (jQuery.trim(params.term) === '') {
                                    return data;
                                }

                                // Jika tidak ada text pada option, skip
                                if (typeof data.text === 'undefined') {
                                    return null;
                                }

                                // Pencarian case-insensitive dan flexible
                                var term = params.term.toLowerCase();
                                var text = data.text.toLowerCase();

                                // Cek apakah text mengandung term yang dicari
                                if (text.indexOf(term) > -1) {
                                    return data;
                                }

                                return null;
                            }
                        });

                        // Event listener untuk select
                        jQuery('#education').on('select2:select', function(e) {
                            console.log('Pendidikan dipilih:', e.params.data.text);
                        });

                        // Event listener untuk clear
                        jQuery('#education').on('select2:clear', function(e) {
                            console.log('Pilihan pendidikan dihapus');
                        });

                        // Sinkronisasi dengan existing script untuk filter visibility
                        const filterSelect = document.getElementById('filter');
                        if (filterSelect) {
                            filterSelect.addEventListener('change', function() {
                                // Destroy dan re-initialize Select2 saat filter berubah
                                if (this.value === 'education') {
                                    setTimeout(function() {
                                        if (jQuery('#education').hasClass(
                                                'select2-hidden-accessible')) {
                                            jQuery('#education').select2('destroy');
                                        }
                                        jQuery('#education').select2({
                                            placeholder: "Ketik untuk mencari pendidikan...",
                                            allowClear: true,
                                            width: '100%',
                                            dropdownParent: jQuery('#education-options')
                                        });
                                    }, 100);
                                }
                            });
                        }
                    } else {
                        console.error('jQuery atau Select2 belum dimuat dengan benar');
                    }
                }, 100);
            });

            // Enhanced Education Filter Script
            document.addEventListener('DOMContentLoaded', function() {
                // Variables
                let universitiesData = [];
                const educationFilterType = document.getElementById('education_filter_type');
                const strataContainer = document.getElementById('strata-select-container');
                const universityContainer = document.getElementById('university-select-container');
                const majorContainer = document.getElementById('major-select-container');
                const filterUniversitySelect = document.getElementById('filter_university');

                // Saved filter values
                const savedFilterType = "{{ request('education_filter_type') ?? 'strata' }}";
                const savedStrata = "{{ request('filter_education_level') ?? '' }}";
                const savedUniversity = "{{ request('filter_university') ?? '' }}";
                const savedMajor = "{{ request('filter_major') ?? '' }}";

                // Function to show/hide education filter options based on type
                function updateEducationFilterOptions() {
                    const filterType = educationFilterType.value;

                    // Hide all by default
                    strataContainer.classList.add('hidden');
                    universityContainer.classList.add('hidden');
                    majorContainer.classList.add('hidden');

                    // Show based on filter type
                    switch (filterType) {
                        case 'strata':
                            strataContainer.classList.remove('hidden');
                            break;
                        case 'university':
                            universityContainer.classList.remove('hidden');
                            break;
                        case 'major':
                            majorContainer.classList.remove('hidden');
                            break;
                        case 'strata_university':
                            strataContainer.classList.remove('hidden');
                            universityContainer.classList.remove('hidden');
                            break;
                        case 'strata_major':
                            strataContainer.classList.remove('hidden');
                            majorContainer.classList.remove('hidden');
                            break;
                        case 'full':
                            strataContainer.classList.remove('hidden');
                            universityContainer.classList.remove('hidden');
                            majorContainer.classList.remove('hidden');
                            break;
                    }
                }

                // Function to load universities data
                function loadUniversitiesForFilter() {
                    filterUniversitySelect.innerHTML = '<option value="">Memuat data kampus...</option>';

                    fetch(
                            'https://raw.githubusercontent.com/aryomuzakki/api-perguruan-tinggi-di-indonesia/main/data/pt.json'
                        )
                        .then(response => response.json())
                        .then(data => {
                            universitiesData = data;

                            // Sort alphabetically
                            const universities = data.map(pt => ({
                                id: pt.nama,
                                text: pt.nama
                            })).sort((a, b) => a.text.localeCompare(b.text));

                            // Clear and rebuild options
                            filterUniversitySelect.innerHTML = '<option value="">-- Semua Kampus --</option>';

                            // Add universities
                            universities.forEach(uni => {
                                const option = document.createElement('option');
                                option.value = uni.id;
                                option.textContent = uni.text;
                                filterUniversitySelect.appendChild(option);
                            });

                            // Initialize Select2 if available
                            if (typeof jQuery !== 'undefined' && typeof jQuery.fn.select2 !== 'undefined') {
                                // Destroy existing Select2 if any
                                if (jQuery('#filter_university').hasClass('select2-hidden-accessible')) {
                                    jQuery('#filter_university').select2('destroy');
                                }

                                // Initialize Select2
                                jQuery('#filter_university').select2({
                                    placeholder: "Ketik untuk mencari kampus...",
                                    allowClear: true,
                                    width: '100%',
                                    dropdownParent: jQuery('#university-select-container'),
                                    language: {
                                        noResults: function() {
                                            return "Kampus tidak ditemukan";
                                        },
                                        searching: function() {
                                            return "Mencari...";
                                        }
                                    },
                                    matcher: function(params, data) {
                                        if (jQuery.trim(params.term) === '') {
                                            return data;
                                        }
                                        if (typeof data.text === 'undefined') {
                                            return null;
                                        }
                                        const term = params.term.toLowerCase();
                                        const text = data.text.toLowerCase();
                                        if (text.indexOf(term) > -1) {
                                            return data;
                                        }
                                        return null;
                                    }
                                });

                                // Set saved value if exists
                                if (savedUniversity) {
                                    jQuery('#filter_university').val(savedUniversity).trigger('change');
                                }
                            }

                            console.log('✅ Berhasil memuat ' + universities.length + ' kampus untuk filter');
                        })
                        .catch(error => {
                            console.error('❌ Error loading universities:', error);
                            filterUniversitySelect.innerHTML = '<option value="">Gagal memuat data kampus</option>';
                        });
                }

                // Initialize Major Input with autocomplete suggestions (optional enhancement)
                function initializeMajorInput() {
                    const majorInput = document.getElementById('filter_major');

                    // Common majors list (you can expand this)
                    const commonMajors = [
                        'Teknik Informatika', 'Sistem Informasi', 'Ilmu Komputer',
                        'Manajemen', 'Akuntansi', 'Ekonomi Pembangunan',
                        'Hukum', 'Ilmu Komunikasi', 'Desain Grafis',
                        'Kedokteran', 'Keperawatan', 'Farmasi',
                        'Teknik Sipil', 'Teknik Elektro', 'Teknik Mesin',
                        'Pendidikan', 'Psikologi', 'Sastra Inggris',
                        'Matematika', 'Fisika', 'Kimia', 'Biologi'
                    ];

                    // Add datalist for autocomplete
                    const datalist = document.createElement('datalist');
                    datalist.id = 'major-suggestions';
                    commonMajors.forEach(major => {
                        const option = document.createElement('option');
                        option.value = major;
                        datalist.appendChild(option);
                    });
                    majorInput.setAttribute('list', 'major-suggestions');
                    majorInput.parentNode.appendChild(datalist);
                }

                // Event listener for filter type change
                educationFilterType.addEventListener('change', function() {
                    updateEducationFilterOptions();

                    // Load universities if needed
                    const filterType = this.value;
                    if (filterType === 'university' || filterType === 'strata_university' || filterType ===
                        'full') {
                        if (universitiesData.length === 0) {
                            loadUniversitiesForFilter();
                        }
                    }
                });

                // Initialize on page load
                setTimeout(function() {
                    updateEducationFilterOptions();
                    initializeMajorInput();

                    // Load universities if filter type needs it
                    const currentFilterType = educationFilterType.value;
                    if (currentFilterType === 'university' || currentFilterType === 'strata_university' ||
                        currentFilterType === 'full') {
                        loadUniversitiesForFilter();
                    }
                }, 100);

                // Integration with existing filter script
                const filterSelect = document.getElementById('filter');
                if (filterSelect) {
                    filterSelect.addEventListener('change', function() {
                        if (this.value === 'education') {
                            setTimeout(function() {
                                updateEducationFilterOptions();

                                // Re-initialize Select2 if needed
                                const currentFilterType = educationFilterType.value;
                                if (currentFilterType === 'university' || currentFilterType ===
                                    'strata_university' || currentFilterType === 'full') {
                                    if (universitiesData.length === 0) {
                                        loadUniversitiesForFilter();
                                    } else if (typeof jQuery !== 'undefined' && typeof jQuery.fn
                                        .select2 !== 'undefined') {
                                        // Re-initialize Select2
                                        if (jQuery('#filter_university').hasClass(
                                                'select2-hidden-accessible')) {
                                            jQuery('#filter_university').select2('destroy');
                                        }
                                        jQuery('#filter_university').select2({
                                            placeholder: "Ketik untuk mencari kampus...",
                                            allowClear: true,
                                            width: '100%',
                                            dropdownParent: jQuery(
                                                '#university-select-container')
                                        });
                                        if (savedUniversity) {
                                            jQuery('#filter_university').val(savedUniversity).trigger(
                                                'change');
                                        }
                                    }
                                }
                            }, 100);
                        }
                    });
                }
            });
        </script>
    @endpush
@endsection
