@extends('layouts.app')

@section('title', 'Daftar Alumni Ta\'aruf')

@section('content')
<div class="min-h-screen bg-gray-50/70 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
        
        <!-- Header Card -->
        <div class="bg-gradient-to-br from-slate-900 via-rose-950 to-pink-950 rounded-3xl text-white p-6 sm:p-8 shadow-lg relative overflow-hidden">
            <div class="absolute inset-0 opacity-10 bg-[radial-gradient(#fff_1px,transparent_1px)] [background-size:16px_16px]"></div>
            
            <div class="relative z-10">
                <nav class="flex items-center gap-2 text-xs text-rose-300/80 mb-3 font-medium">
                    <a href="{{ route('alumni.dashboard') }}" class="hover:text-white transition">Dashboard Alumni</a>
                    <span>/</span>
                    <a href="{{ route('taaruf.index') }}" class="hover:text-white transition">Ta'aruf</a>
                    <span>/</span>
                    <span class="text-white font-semibold">Daftar Alumni</span>
                </nav>

                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                    <div>
                        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-rose-500/20 border border-rose-400/30 text-rose-300 text-xs font-semibold mb-2">
                            <span>👥</span>
                            <span>Katalog Peserta Ta'aruf</span>
                        </div>
                        <h1 class="text-2xl sm:text-3xl font-bold tracking-tight text-white">
                            Daftar Peserta Ta'aruf Aktif
                        </h1>
                        <p class="text-xs sm:text-sm text-slate-300 mt-1">
                            Gunakan filter pencarian domisili, tingkat pendidikan, atau target menikah untuk mencari calon pasangan yang sevisi.
                        </p>
                    </div>

                    <a href="{{ route('taaruf.index') }}"
                        class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-white/10 hover:bg-white/20 backdrop-blur text-white text-xs font-semibold border border-white/15 transition shadow-xs self-start md:self-auto">
                        &larr; Dashboard Ta'aruf
                    </a>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Left 2 Cols: Filter & Candidate Listings -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Search & Filter Card -->
                <div class="bg-white rounded-2xl border border-gray-200/80 shadow-sm p-6">
                    <h2 class="text-sm font-bold text-gray-900 pb-3 border-b border-gray-100 mb-4 flex items-center gap-2">
                        <span>🔍</span>
                        <span>Pencarian dan Filter Peserta</span>
                    </h2>
                    
                    <form action="{{ route('taaruf.list') }}" method="GET" class="space-y-4">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <!-- Search Input -->
                            <div>
                                <label for="search" class="block text-xs font-bold text-gray-700 mb-1">Cari Nama Peserta</label>
                                <div class="relative rounded-xl shadow-2xs">
                                    <input type="text" name="search" id="search"
                                        class="w-full pl-3 pr-10 py-2 text-xs border border-gray-300 rounded-xl focus:ring-2 focus:ring-rose-500 focus:border-rose-500 transition"
                                        placeholder="Masukkan nama..." value="{{ request('search') }}">
                                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none text-gray-400">
                                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                        </svg>
                                    </div>
                                </div>
                            </div>

                            <!-- Filter Type -->
                            <div>
                                <label for="filter" class="block text-xs font-bold text-gray-700 mb-1">Kategori Filter</label>
                                <select id="filter" name="filter"
                                    class="w-full px-3 py-2 text-xs border border-gray-300 rounded-xl focus:ring-2 focus:ring-rose-500 focus:border-rose-500 transition">
                                    <option value="all" {{ request('filter') == 'all' || !request('filter') ? 'selected' : '' }}>Semua Peserta</option>
                                    <option value="location" {{ request('filter') == 'location' ? 'selected' : '' }}>Berdasarkan Lokasi / Domisili</option>
                                    <option value="education" {{ request('filter') == 'education' ? 'selected' : '' }}>Berdasarkan Pendidikan</option>
                                    <option value="marriage_year" {{ request('filter') == 'marriage_year' ? 'selected' : '' }}>Berdasarkan Target Menikah</option>
                                </select>
                            </div>
                        </div>

                        <!-- Location Filter Options -->
                        <div class="hidden filter-options space-y-4" id="location-options">
                            <div class="bg-rose-50/50 border border-rose-100 rounded-xl p-4">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <!-- Location Type Selection -->
                                    <div>
                                        <label for="location_type" class="block text-xs font-bold text-gray-700 mb-1">Tipe Wilayah</label>
                                        <select name="location_type" id="location_type"
                                            class="w-full px-3 py-2 text-xs border border-gray-300 rounded-xl focus:ring-2 focus:ring-rose-500">
                                            <option value="origin" {{ request('location_type') == 'origin' || !request('location_type') ? 'selected' : '' }}>Asal Daerah Kelahiran</option>
                                            <option value="residence" {{ request('location_type') == 'residence' ? 'selected' : '' }}>Domisili Tempat Tinggal Saat Ini</option>
                                        </select>
                                    </div>

                                    <!-- Location Level Selection -->
                                    <div>
                                        <label for="location_level" class="block text-xs font-bold text-gray-700 mb-1">Tingkat Wilayah</label>
                                        <select name="location_level" id="location_level"
                                            class="w-full px-3 py-2 text-xs border border-gray-300 rounded-xl focus:ring-2 focus:ring-rose-500">
                                            <option value="province" {{ request('location_level') == 'province' || !request('location_level') ? 'selected' : '' }}>Provinsi</option>
                                            <option value="city" {{ request('location_level') == 'city' ? 'selected' : '' }}>Kota / Kabupaten</option>
                                            <option value="district" {{ request('location_level') == 'district' ? 'selected' : '' }}>Kecamatan</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- Dynamic Location Dropdowns -->
                                <div class="mt-3 grid grid-cols-1 gap-3" id="location-selects">
                                    <!-- Province Select -->
                                    <div id="province-select-container">
                                        <label for="location_province" class="block text-xs font-medium text-gray-700 mb-1">Pilih Provinsi</label>
                                        <select name="location_province" id="location_province"
                                            class="w-full px-3 py-2 text-xs border border-gray-300 rounded-xl focus:ring-2 focus:ring-rose-500">
                                            <option value="">-- Semua Provinsi --</option>
                                        </select>
                                    </div>

                                    <!-- City Select -->
                                    <div id="city-select-container" class="hidden">
                                        <label for="location_city" class="block text-xs font-medium text-gray-700 mb-1">Pilih Kota / Kabupaten</label>
                                        <select name="location_city" id="location_city" disabled
                                            class="w-full px-3 py-2 text-xs border border-gray-300 rounded-xl focus:ring-2 focus:ring-rose-500">
                                            <option value="">-- Pilih Provinsi Terlebih Dahulu --</option>
                                        </select>
                                    </div>

                                    <!-- District Select -->
                                    <div id="district-select-container" class="hidden">
                                        <label for="location_district" class="block text-xs font-medium text-gray-700 mb-1">Pilih Kecamatan</label>
                                        <select name="location_district" id="location_district" disabled
                                            class="w-full px-3 py-2 text-xs border border-gray-300 rounded-xl focus:ring-2 focus:ring-rose-500">
                                            <option value="">-- Pilih Kota/Kabupaten Terlebih Dahulu --</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Education Filter Options -->
                        <div class="hidden filter-options" id="education-options">
                            <div class="bg-rose-50/50 border border-rose-100 rounded-xl p-4">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <label for="education_filter_type" class="block text-xs font-bold text-gray-700 mb-1">Tipe Filter Pendidikan</label>
                                        <select name="education_filter_type" id="education_filter_type"
                                            class="w-full px-3 py-2 text-xs border border-gray-300 rounded-xl focus:ring-2 focus:ring-rose-500">
                                            <option value="strata" {{ request('education_filter_type') == 'strata' || !request('education_filter_type') ? 'selected' : '' }}>Jenjang Strata</option>
                                            <option value="university" {{ request('education_filter_type') == 'university' ? 'selected' : '' }}>Nama Kampus</option>
                                            <option value="major" {{ request('education_filter_type') == 'major' ? 'selected' : '' }}>Jurusan / Program Studi</option>
                                            <option value="strata_university" {{ request('education_filter_type') == 'strata_university' ? 'selected' : '' }}>Strata &amp; Kampus</option>
                                            <option value="strata_major" {{ request('education_filter_type') == 'strata_major' ? 'selected' : '' }}>Strata &amp; Jurusan</option>
                                            <option value="full" {{ request('education_filter_type') == 'full' ? 'selected' : '' }}>Lengkap (Strata + Kampus + Jurusan)</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="mt-3 grid grid-cols-1 gap-3" id="education-selects">
                                    <div id="strata-select-container">
                                        <label for="filter_education_level" class="block text-xs font-medium text-gray-700 mb-1">Pilih Jenjang</label>
                                        <select name="filter_education_level" id="filter_education_level"
                                            class="w-full px-3 py-2 text-xs border border-gray-300 rounded-xl focus:ring-2 focus:ring-rose-500">
                                            <option value="">-- Semua Jenjang --</option>
                                            <option value="SMA/SMK" {{ request('filter_education_level') == 'SMA/SMK' ? 'selected' : '' }}>SMA / SMK</option>
                                            <option value="D3" {{ request('filter_education_level') == 'D3' ? 'selected' : '' }}>Diploma (D3)</option>
                                            <option value="S1" {{ request('filter_education_level') == 'S1' ? 'selected' : '' }}>Sarjana (S1)</option>
                                            <option value="S2" {{ request('filter_education_level') == 'S2' ? 'selected' : '' }}>Magister (S2)</option>
                                            <option value="S3" {{ request('filter_education_level') == 'S3' ? 'selected' : '' }}>Doktor (S3)</option>
                                        </select>
                                    </div>

                                    <div id="university-select-container" class="hidden">
                                        <label for="filter_university" class="block text-xs font-medium text-gray-700 mb-1">Cari Kampus</label>
                                        <select name="filter_university" id="filter_university" class="w-full">
                                            <option value="">-- Semua Kampus --</option>
                                        </select>
                                    </div>

                                    <div id="major-select-container" class="hidden">
                                        <label for="filter_major" class="block text-xs font-medium text-gray-700 mb-1">Jurusan / Program Studi</label>
                                        <input type="text" name="filter_major" id="filter_major"
                                            class="w-full px-3 py-2 text-xs border border-gray-300 rounded-xl focus:ring-2 focus:ring-rose-500"
                                            placeholder="Ketik jurusan..." value="{{ request('filter_major') }}">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Marriage Year Options -->
                        <div class="hidden filter-options" id="marriage-year-options">
                            <div class="bg-rose-50/50 border border-rose-100 rounded-xl p-4">
                                <label for="filter_marriage_year" class="block text-xs font-bold text-gray-700 mb-1">Target Tahun Menikah</label>
                                <select name="filter_marriage_year" id="filter_marriage_year"
                                    class="w-full px-3 py-2 text-xs border border-gray-300 rounded-xl focus:ring-2 focus:ring-rose-500">
                                    <option value="">-- Semua Target Tahun --</option>
                                    @for ($year = date('Y'); $year <= date('Y') + 5; $year++)
                                        <option value="{{ $year }}" {{ request('filter_marriage_year') == $year ? 'selected' : '' }}>{{ $year }}</option>
                                    @endfor
                                    <option value="Segera" {{ request('filter_marriage_year') == 'Segera' ? 'selected' : '' }}>Insya Allah Segera</option>
                                </select>
                            </div>
                        </div>

                        <!-- Submit & Reset Buttons -->
                        <div class="flex items-center gap-2 pt-2">
                            <button type="submit"
                                class="inline-flex items-center gap-2 px-5 py-2 rounded-xl bg-gradient-to-r from-rose-500 to-pink-500 hover:from-rose-600 hover:to-pink-600 text-white font-semibold text-xs shadow-xs transition">
                                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                                <span>Terapkan Filter</span>
                            </button>

                            <a href="{{ route('taaruf.list') }}"
                                class="px-4 py-2 rounded-xl border border-gray-300 bg-white hover:bg-gray-50 text-gray-700 text-xs font-semibold transition">
                                Reset
                            </a>
                        </div>
                    </form>
                </div>

                <!-- Candidate Results Section -->
                <div class="bg-white rounded-2xl border border-gray-200/80 shadow-sm p-6">
                    <!-- Top Bar -->
                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 pb-4 border-b border-gray-100 mb-6">
                        <div>
                            <h2 class="text-sm font-bold text-gray-900 flex items-center gap-2">
                                <span>👥</span>
                                <span>Daftar Peserta Ta'aruf</span>
                            </h2>
                            <p class="text-xs text-gray-500 mt-0.5">Ditemukan <span class="font-bold text-gray-800">{{ $profiles->total() ?? count($profiles) }}</span> profil alumni aktif</p>
                        </div>

                        <div class="flex items-center gap-3 self-end sm:self-auto">
                            <!-- Per Page Selection -->
                            <div class="flex items-center gap-1.5 text-xs text-gray-500">
                                <span>Tampilkan:</span>
                                <select id="per_page" name="per_page"
                                    class="px-2 py-1 text-xs border border-gray-300 rounded-lg focus:ring-2 focus:ring-rose-500">
                                    <option value="10" {{ request('per_page', 10) == 10 ? 'selected' : '' }}>10</option>
                                    <option value="25" {{ request('per_page', 10) == 25 ? 'selected' : '' }}>25</option>
                                    <option value="50" {{ request('per_page', 10) == 50 ? 'selected' : '' }}>50</option>
                                    <option value="100" {{ request('per_page', 10) == 100 ? 'selected' : '' }}>100</option>
                                </select>
                            </div>

                            <!-- View Toggle Switcher -->
                            <div class="flex items-center bg-gray-100 p-1 rounded-xl border border-gray-200/80">
                                <button type="button" id="cardViewBtn"
                                    class="view-toggle flex items-center gap-1 px-3 py-1.5 text-xs font-semibold rounded-lg transition {{ request('view', 'card') == 'card' ? 'bg-white text-rose-700 shadow-xs' : 'text-gray-600 hover:text-gray-900' }}">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
                                    </svg>
                                    <span>Card</span>
                                </button>
                                <button type="button" id="listViewBtn"
                                    class="view-toggle flex items-center gap-1 px-3 py-1.5 text-xs font-semibold rounded-lg transition {{ request('view') == 'list' ? 'bg-white text-rose-700 shadow-xs' : 'text-gray-600 hover:text-gray-900' }}">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                                    </svg>
                                    <span>List</span>
                                </button>
                            </div>
                        </div>
                    </div>

                    @if (count($profiles) > 0)
                        <!-- Card View Grid -->
                        <div id="cardView" class="{{ request('view') == 'list' ? 'hidden' : '' }}">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                                @foreach ($profiles as $profile)
                                    @php
                                        $age = \App\Helpers\DateHelper::getAgeFromBirthPlaceDate($profile->birth_place_date);
                                    @endphp
                                    <div class="bg-gradient-to-b from-white to-gray-50/70 rounded-2xl border border-gray-200/90 hover:border-rose-300 hover:shadow-md transition duration-200 p-5 flex flex-col justify-between group">
                                        <div>
                                            <!-- Card Header: Avatar, Name, Age Badge -->
                                            <div class="flex items-center gap-3.5 pb-4 border-b border-gray-100">
                                                @if ($profile->photo_url)
                                                    <img src="{{ $profile->photo_url }}" alt="{{ $profile->full_name }}"
                                                        class="w-14 h-14 rounded-2xl object-cover border border-rose-100 shadow-2xs shrink-0">
                                                @else
                                                    <div class="w-14 h-14 rounded-2xl bg-rose-50 text-rose-600 border border-rose-100 flex items-center justify-center font-bold text-xl shadow-2xs shrink-0">
                                                        {{ strtoupper(substr($profile->full_name, 0, 1)) }}
                                                    </div>
                                                @endif
                                                <div class="min-w-0 flex-1">
                                                    <h3 class="text-sm font-bold text-gray-900 truncate group-hover:text-rose-700 transition">
                                                        {{ $profile->full_name }}
                                                    </h3>
                                                    <div class="flex items-center gap-1.5 mt-1 flex-wrap">
                                                        <span class="px-2 py-0.5 rounded-full bg-rose-50 border border-rose-100 text-rose-700 text-[10px] font-bold">
                                                            {{ $age ? $age . ' Tahun' : 'Usia -' }}
                                                        </span>
                                                        @if ($profile->marriage_target_year)
                                                            <span class="px-2 py-0.5 rounded-full bg-emerald-50 border border-emerald-100 text-emerald-700 text-[10px] font-semibold">
                                                                Target: {{ $profile->marriage_target_year }}
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Card Info Items -->
                                            <div class="py-3.5 space-y-2 text-xs">
                                                <div class="flex items-start gap-2 text-gray-600">
                                                    <span class="text-gray-400 shrink-0">📍</span>
                                                    <span class="truncate">{{ $profile->current_residence ?: ($profile->residence_city ?: '-') }}</span>
                                                </div>
                                                <div class="flex items-start gap-2 text-gray-600">
                                                    <span class="text-gray-400 shrink-0">🎓</span>
                                                    <span class="truncate">{{ $profile->education_level ?: ($profile->last_education ?: '-') }}{{ $profile->university ? ' • ' . $profile->university : '' }}</span>
                                                </div>
                                                <div class="flex items-start gap-2 text-gray-600">
                                                    <span class="text-gray-400 shrink-0">💼</span>
                                                    <span class="truncate">{{ $profile->occupation ?: '-' }}</span>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Card Action -->
                                        <div class="pt-3 border-t border-gray-100">
                                            <a href="{{ route('taaruf.profile.show', $profile->id) }}"
                                                class="w-full inline-flex items-center justify-center gap-1.5 py-2 px-3 rounded-xl bg-white hover:bg-rose-50 text-rose-700 border border-rose-200 font-bold text-xs shadow-2xs transition group-hover:bg-rose-600 group-hover:text-white group-hover:border-rose-600">
                                                <span>Lihat Biodata Lengkap</span>
                                                <span>&rarr;</span>
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- Table View -->
                        <div id="listView" class="{{ request('view') == 'list' ? '' : 'hidden' }}">
                            <div class="overflow-x-auto rounded-xl border border-gray-200">
                                <table class="min-w-full divide-y divide-gray-200 text-xs">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th class="px-4 py-3 text-left font-bold text-gray-700">Foto</th>
                                            <th class="px-4 py-3 text-left font-bold text-gray-700">Nama Lengkap</th>
                                            <th class="px-4 py-3 text-left font-bold text-gray-700">Usia</th>
                                            <th class="px-4 py-3 text-left font-bold text-gray-700">Domisili</th>
                                            <th class="px-4 py-3 text-left font-bold text-gray-700">Target Menikah</th>
                                            <th class="px-4 py-3 text-center font-bold text-gray-700">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-100 bg-white">
                                        @foreach ($profiles as $profile)
                                            <tr class="hover:bg-rose-50/40 transition">
                                                <td class="px-4 py-3 whitespace-nowrap">
                                                    @if ($profile->photo_url)
                                                        <img src="{{ $profile->photo_url }}" alt="{{ $profile->full_name }}"
                                                            class="w-9 h-9 rounded-xl object-cover border border-gray-200">
                                                    @else
                                                        <div class="w-9 h-9 rounded-xl bg-rose-50 text-rose-600 border border-rose-100 flex items-center justify-center font-bold text-xs">
                                                            {{ strtoupper(substr($profile->full_name, 0, 1)) }}
                                                        </div>
                                                    @endif
                                                </td>
                                                <td class="px-4 py-3 whitespace-nowrap font-bold text-gray-900">
                                                    {{ $profile->full_name }}
                                                </td>
                                                <td class="px-4 py-3 whitespace-nowrap text-gray-600">
                                                    {{ \App\Helpers\DateHelper::getAgeFromBirthPlaceDate($profile->birth_place_date) ? \App\Helpers\DateHelper::getAgeFromBirthPlaceDate($profile->birth_place_date) . ' th' : '-' }}
                                                </td>
                                                <td class="px-4 py-3 whitespace-nowrap text-gray-600">
                                                    {{ $profile->current_residence ?: '-' }}
                                                </td>
                                                <td class="px-4 py-3 whitespace-nowrap text-rose-600 font-semibold">
                                                    {{ $profile->marriage_target_year ?: '-' }}
                                                </td>
                                                <td class="px-4 py-3 whitespace-nowrap text-center">
                                                    <a href="{{ route('taaruf.profile.show', $profile->id) }}"
                                                        class="inline-flex items-center gap-1 px-3 py-1 rounded-lg bg-rose-50 text-rose-700 border border-rose-200 hover:bg-rose-600 hover:text-white transition font-semibold text-[11px]">
                                                        <span>Lihat</span>
                                                        <span>&rarr;</span>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- Pagination -->
                        <div class="flex justify-center mt-6">
                            {{ $profiles->appends(request()->query())->links() }}
                        </div>
                    @else
                        <div class="text-center py-16 bg-gray-50/50 rounded-2xl border border-dashed border-gray-200">
                            <div class="w-12 h-12 rounded-2xl bg-gray-100 text-gray-400 flex items-center justify-center text-xl mx-auto mb-2">
                                👥
                            </div>
                            <h4 class="text-sm font-bold text-gray-900 mb-1">Belum Ada Profil Alumni yang Sesuai</h4>
                            <p class="text-xs text-gray-500">Coba ubah kriteria filter atau kata kunci pencarian Anda.</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Right 1 Col: Sidebar Info & Status -->
            <div class="space-y-6">
                <!-- Status Profil Anda -->
                <div class="bg-white rounded-2xl border border-gray-200/80 shadow-sm p-6 space-y-4">
                    <h3 class="text-xs font-bold text-gray-900 pb-3 border-b border-gray-100 flex items-center gap-2">
                        <span>👤</span>
                        <span>Status Profil Anda</span>
                    </h3>

                    @if ($myProfile && $myProfile->is_active)
                        <div class="p-3.5 bg-emerald-50 rounded-xl border border-emerald-200 text-xs space-y-1">
                            <div class="flex items-center gap-2 font-bold text-emerald-800">
                                <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                                <span>Profil Sedang Aktif</span>
                            </div>
                            <p class="text-emerald-700 text-[11px] leading-relaxed">
                                Biodata Anda saat ini dapat ditemukan dan dilihat oleh alumni lawan jenis di katalog ini.
                            </p>
                        </div>
                    @else
                        <div class="p-3.5 bg-amber-50 rounded-xl border border-amber-200 text-xs space-y-1">
                            <div class="flex items-center gap-2 font-bold text-amber-800">
                                <span class="w-2 h-2 rounded-full bg-amber-500"></span>
                                <span>Profil Belum Aktif</span>
                            </div>
                            <p class="text-amber-700 text-[11px] leading-relaxed">
                                Profil Anda disembunyikan dari katalog ta'aruf.
                            </p>
                        </div>

                        <a href="{{ route('taaruf.index') }}"
                            class="w-full inline-flex items-center justify-center gap-2 py-2 px-3 rounded-xl bg-rose-600 hover:bg-rose-700 text-white font-bold text-xs shadow-xs transition">
                            <span>Aktifkan Profil Ta'aruf &rarr;</span>
                        </a>
                    @endif
                </div>

                <!-- Panduan & Tata Tertib -->
                <div class="bg-white rounded-2xl border border-gray-200/80 shadow-sm p-6 space-y-4 text-xs text-gray-600">
                    <h3 class="text-xs font-bold text-gray-900 pb-3 border-b border-gray-100 flex items-center gap-2">
                        <span>🛡️</span>
                        <span>Adab &amp; Ketentuan Ta'aruf</span>
                    </h3>

                    <ul class="space-y-2 leading-relaxed">
                        <li class="flex items-start gap-2">
                            <span class="text-rose-500 font-bold">•</span>
                            <span>Katalog hanya menampilkan profil alumni yang telah memberikan persetujuan (informed consent).</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <span class="text-rose-500 font-bold">•</span>
                            <span>Dilarang menduplikasi, mempublikasikan, atau menyebarkan biodata peserta ke pihak luar.</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <span class="text-rose-500 font-bold">•</span>
                            <span>Proses kelanjutan ta'aruf wajib melalui fasilitator resmi panitia SPN Salman ITB.</span>
                        </li>
                    </ul>
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

                        cardViewBtn.classList.add('bg-white', 'text-rose-700', 'shadow-xs');
                        cardViewBtn.classList.remove('text-gray-600', 'hover:text-gray-900');

                        listViewBtn.classList.remove('bg-white', 'text-rose-700', 'shadow-xs');
                        listViewBtn.classList.add('text-gray-600', 'hover:text-gray-900');

                        updateUrlAndReload('view', 'card');
                    });

                    listViewBtn.addEventListener('click', function() {
                        if (!listView.classList.contains('hidden')) return;

                        listView.classList.remove('hidden');
                        cardView.classList.add('hidden');

                        listViewBtn.classList.add('bg-white', 'text-rose-700', 'shadow-xs');
                        listViewBtn.classList.remove('text-gray-600', 'hover:text-gray-900');

                        cardViewBtn.classList.remove('bg-white', 'text-rose-700', 'shadow-xs');
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
