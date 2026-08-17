@extends('layouts.app')

@section('title', 'Edit Profil Ta\'aruf - ' . $profile->full_name)

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
                    <span class="text-white font-semibold">Edit Profil</span>
                </nav>

                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                    <div>
                        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-rose-500/20 border border-rose-400/30 text-rose-300 text-xs font-semibold mb-2">
                            <span>✏️</span>
                            <span>Perbarui Biodata Ta'aruf</span>
                        </div>
                        <h1 class="text-2xl sm:text-3xl font-bold tracking-tight text-white">
                            Edit Profil Ta'aruf
                        </h1>
                        <p class="text-xs sm:text-sm text-slate-300 mt-1">
                            Perbarui informasi domisili, pekerjaan, visi misi keluarga, atau kriteria pasangan hidup Anda.
                        </p>
                    </div>

                    <a href="{{ route('taaruf.index') }}"
                        class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-white/10 hover:bg-white/20 backdrop-blur text-white text-xs font-semibold border border-white/15 transition shadow-xs self-start md:self-auto">
                        &larr; Dashboard Ta'aruf
                    </a>
                </div>
            </div>
        </div>

        @if (session('error'))
            <div class="bg-red-50 border border-red-200 text-red-800 p-4 rounded-2xl shadow-sm flex items-center justify-between" role="alert">
                <span class="text-sm font-medium">{{ session('error') }}</span>
                <button type="button" onclick="this.parentElement.remove()" class="text-red-500 hover:text-red-700">✕</button>
            </div>
        @endif

        @if (session('success'))
            <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 p-4 rounded-2xl shadow-sm flex items-center justify-between" role="alert">
                <span class="text-sm font-medium">{{ session('success') }}</span>
                <button type="button" onclick="this.parentElement.remove()" class="text-emerald-500 hover:text-emerald-700">✕</button>
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <!-- Left 2 Columns: Main Form -->
            <div class="lg:col-span-2 space-y-6">
                <form action="{{ route('taaruf.profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <!-- 1. Informasi Dasar -->
                    <div class="bg-white rounded-2xl border border-gray-200/80 shadow-sm p-6 sm:p-7 space-y-4">
                        <h2 class="text-sm font-bold text-gray-900 pb-3 border-b border-gray-100 flex items-center gap-2">
                            <span>👤</span>
                            <span>Informasi Dasar Diri</span>
                        </h2>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label for="gender" class="block text-xs font-bold text-gray-700 mb-1">
                                    Jenis Kelamin <span class="text-rose-500">*</span>
                                </label>
                                <select name="gender" id="gender" required
                                    class="w-full px-3.5 py-2.5 text-xs rounded-xl border border-gray-300 focus:ring-2 focus:ring-rose-500 focus:border-rose-500 transition @error('gender') border-red-500 @enderror">
                                    <option value="">-- Pilih Jenis Kelamin --</option>
                                    <option value="male" {{ old('gender', $profile->gender) == 'male' ? 'selected' : '' }}>Laki-laki (Ikhwan)</option>
                                    <option value="female" {{ old('gender', $profile->gender) == 'female' ? 'selected' : '' }}>Perempuan (Akhwat)</option>
                                </select>
                                @error('gender')
                                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="nickname" class="block text-xs font-bold text-gray-700 mb-1">
                                    Nama Panggilan <span class="text-rose-500">*</span>
                                </label>
                                <input type="text" name="nickname" id="nickname" required
                                    value="{{ old('nickname', $profile->nickname) }}"
                                    class="w-full px-3.5 py-2.5 text-xs rounded-xl border border-gray-300 focus:ring-2 focus:ring-rose-500 focus:border-rose-500 transition @error('nickname') border-red-500 @enderror">
                                @error('nickname')
                                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div>
                            <label for="full_name" class="block text-xs font-bold text-gray-700 mb-1">
                                Nama Lengkap <span class="text-rose-500">*</span>
                            </label>
                            <input type="text" name="full_name" id="full_name" required
                                value="{{ old('full_name', $profile->full_name) }}"
                                class="w-full px-3.5 py-2.5 text-xs rounded-xl border border-gray-300 focus:ring-2 focus:ring-rose-500 focus:border-rose-500 transition @error('full_name') border-red-500 @enderror">
                            @error('full_name')
                                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="birth_place_date" class="block text-xs font-bold text-gray-700 mb-1">
                                Tempat, Tanggal Lahir <span class="text-rose-500">*</span>
                            </label>
                            <input type="text" name="birth_place_date" id="birth_place_date" required
                                value="{{ old('birth_place_date', $profile->birth_place_date) }}"
                                placeholder="Contoh: Jakarta, 15 Januari 1995"
                                class="w-full px-3.5 py-2.5 text-xs rounded-xl border border-gray-300 focus:ring-2 focus:ring-rose-500 focus:border-rose-500 transition @error('birth_place_date') border-red-500 @enderror">
                            @error('birth_place_date')
                                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- 2. Asal Daerah -->
                    <div class="bg-white rounded-2xl border border-gray-200/80 shadow-sm p-6 sm:p-7 space-y-4">
                        <div>
                            <h2 class="text-sm font-bold text-gray-900 pb-1 flex items-center gap-2">
                                <span>🏡</span>
                                <span>Asal Daerah (Kelahiran)</span>
                            </h2>
                            <p class="text-[11px] text-gray-500">Data ini digunakan untuk mempermudah pencarian asal daerah.</p>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="origin_province" class="block text-xs font-bold text-gray-700 mb-1">
                                    Provinsi Asal <span class="text-rose-500">*</span>
                                </label>
                                <select id="origin_province" name="origin_province" required
                                    class="w-full px-3.5 py-2.5 text-xs rounded-xl border border-gray-300 focus:ring-2 focus:ring-rose-500 focus:border-rose-500 transition @error('origin_province') border-red-500 @enderror">
                                    <option value="">Pilih Provinsi</option>
                                </select>
                                @error('origin_province')
                                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="origin_city" class="block text-xs font-bold text-gray-700 mb-1">
                                    Kota / Kabupaten Asal <span class="text-rose-500">*</span>
                                </label>
                                <select id="origin_city" name="origin_city" required disabled
                                    class="w-full px-3.5 py-2.5 text-xs rounded-xl border border-gray-300 focus:ring-2 focus:ring-rose-500 focus:border-rose-500 transition @error('origin_city') border-red-500 @enderror">
                                    <option value="">Pilih Kota/Kabupaten</option>
                                </select>
                                @error('origin_city')
                                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="origin_district" class="block text-xs font-bold text-gray-700 mb-1">
                                    Kecamatan Asal <span class="text-rose-500">*</span>
                                </label>
                                <select id="origin_district" name="origin_district" required disabled
                                    class="w-full px-3.5 py-2.5 text-xs rounded-xl border border-gray-300 focus:ring-2 focus:ring-rose-500 focus:border-rose-500 transition @error('origin_district') border-red-500 @enderror">
                                    <option value="">Pilih Kecamatan</option>
                                </select>
                                @error('origin_district')
                                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="origin_village" class="block text-xs font-bold text-gray-700 mb-1">
                                    Kelurahan Asal <span class="text-rose-500">*</span>
                                </label>
                                <select id="origin_village" name="origin_village" required disabled
                                    class="w-full px-3.5 py-2.5 text-xs rounded-xl border border-gray-300 focus:ring-2 focus:ring-rose-500 focus:border-rose-500 transition @error('origin_village') border-red-500 @enderror">
                                    <option value="">Pilih Kelurahan</option>
                                </select>
                                @error('origin_village')
                                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- 3. Domisili Saat Ini -->
                    <div class="bg-white rounded-2xl border border-gray-200/80 shadow-sm p-6 sm:p-7 space-y-4">
                        <div>
                            <h2 class="text-sm font-bold text-gray-900 pb-1 flex items-center gap-2">
                                <span>📍</span>
                                <span>Domisili Saat Ini</span>
                            </h2>
                            <p class="text-[11px] text-gray-500">Informasi domisili dan alamat tempat tinggal Anda saat ini.</p>
                        </div>

                        <div>
                            <label for="current_residence" class="block text-xs font-bold text-gray-700 mb-1">
                                Alamat Domisili Lengkap <span class="text-rose-500">*</span>
                            </label>
                            <textarea name="current_residence" id="current_residence" rows="2" required
                                placeholder="Contoh: Jl. Cisitu Lama No. 12, Coblong, Kota Bandung"
                                class="w-full px-3.5 py-2.5 text-xs rounded-xl border border-gray-300 focus:ring-2 focus:ring-rose-500 focus:border-rose-500 transition @error('current_residence') border-red-500 @enderror">{{ old('current_residence', $profile->current_residence) }}</textarea>
                            @error('current_residence')
                                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="residence_province" class="block text-xs font-bold text-gray-700 mb-1">
                                    Provinsi Domisili <span class="text-rose-500">*</span>
                                </label>
                                <select id="residence_province" name="residence_province" required
                                    class="w-full px-3.5 py-2.5 text-xs rounded-xl border border-gray-300 focus:ring-2 focus:ring-rose-500 focus:border-rose-500 transition @error('residence_province') border-red-500 @enderror">
                                    <option value="">Pilih Provinsi</option>
                                </select>
                                @error('residence_province')
                                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="residence_city" class="block text-xs font-bold text-gray-700 mb-1">
                                    Kota / Kabupaten Domisili <span class="text-rose-500">*</span>
                                </label>
                                <select id="residence_city" name="residence_city" required disabled
                                    class="w-full px-3.5 py-2.5 text-xs rounded-xl border border-gray-300 focus:ring-2 focus:ring-rose-500 focus:border-rose-500 transition @error('residence_city') border-red-500 @enderror">
                                    <option value="">Pilih Kota/Kabupaten</option>
                                </select>
                                @error('residence_city')
                                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="residence_district" class="block text-xs font-bold text-gray-700 mb-1">
                                    Kecamatan Domisili <span class="text-rose-500">*</span>
                                </label>
                                <select id="residence_district" name="residence_district" required disabled
                                    class="w-full px-3.5 py-2.5 text-xs rounded-xl border border-gray-300 focus:ring-2 focus:ring-rose-500 focus:border-rose-500 transition @error('residence_district') border-red-500 @enderror">
                                    <option value="">Pilih Kecamatan</option>
                                </select>
                                @error('residence_district')
                                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="residence_village" class="block text-xs font-bold text-gray-700 mb-1">
                                    Kelurahan Domisili <span class="text-rose-500">*</span>
                                </label>
                                <select id="residence_village" name="residence_village" required disabled
                                    class="w-full px-3.5 py-2.5 text-xs rounded-xl border border-gray-300 focus:ring-2 focus:ring-rose-500 focus:border-rose-500 transition @error('residence_village') border-red-500 @enderror">
                                    <option value="">Pilih Kelurahan</option>
                                </select>
                                @error('residence_village')
                                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- 4. Pendidikan & Pekerjaan -->
                    <div class="bg-white rounded-2xl border border-gray-200/80 shadow-sm p-6 sm:p-7 space-y-4">
                        <h2 class="text-sm font-bold text-gray-900 pb-3 border-b border-gray-100 flex items-center gap-2">
                            <span>🎓</span>
                            <span>Pendidikan Terakhir &amp; Pekerjaan</span>
                        </h2>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="education_level" class="block text-xs font-bold text-gray-700 mb-1">
                                    Strata Pendidikan <span class="text-rose-500">*</span>
                                </label>
                                <select id="education_level" name="education_level" required
                                    class="w-full px-3.5 py-2.5 text-xs rounded-xl border border-gray-300 focus:ring-2 focus:ring-rose-500 focus:border-rose-500 transition @error('education_level') border-red-500 @enderror">
                                    <option value="">Pilih Strata Pendidikan</option>
                                    <option value="SMA" {{ old('education_level', $profile->education_level ?? '') == 'SMA' ? 'selected' : '' }}>SMA / Sederajat</option>
                                    <option value="SMK" {{ old('education_level', $profile->education_level ?? '') == 'SMK' ? 'selected' : '' }}>SMK</option>
                                    <option value="D3" {{ old('education_level', $profile->education_level ?? '') == 'D3' ? 'selected' : '' }}>Diploma 3 (D3)</option>
                                    <option value="D4" {{ old('education_level', $profile->education_level ?? '') == 'D4' ? 'selected' : '' }}>Diploma 4 (D4)</option>
                                    <option value="S1" {{ old('education_level', $profile->education_level ?? '') == 'S1' ? 'selected' : '' }}>Sarjana (S1)</option>
                                    <option value="S2" {{ old('education_level', $profile->education_level ?? '') == 'S2' ? 'selected' : '' }}>Magister (S2)</option>
                                    <option value="S3" {{ old('education_level', $profile->education_level ?? '') == 'S3' ? 'selected' : '' }}>Doktor (S3)</option>
                                </select>
                                @error('education_level')
                                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="university" class="block text-xs font-bold text-gray-700 mb-1">
                                    Nama Institusi / Kampus <span class="text-rose-500">*</span>
                                </label>
                                <select id="university" name="university" required class="w-full">
                                    <option value="">Memuat data kampus...</option>
                                </select>
                                @error('university')
                                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Custom University Input -->
                        <div id="custom_university_container" class="hidden">
                            <label for="custom_university" class="block text-xs font-bold text-gray-700 mb-1">
                                Nama Kampus Lainnya <span class="text-rose-500">*</span>
                            </label>
                            <input type="text" id="custom_university" name="custom_university"
                                class="w-full px-3.5 py-2.5 text-xs rounded-xl border border-gray-300 focus:ring-2 focus:ring-rose-500 focus:border-rose-500 transition"
                                placeholder="Tuliskan nama lengkap perguruan tinggi Anda"
                                value="{{ old('custom_university', $profile->custom_university ?? '') }}">
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="major" class="block text-xs font-bold text-gray-700 mb-1">
                                    Jurusan / Program Studi <span class="text-rose-500">*</span>
                                </label>
                                <input type="text" id="major" name="major" required
                                    value="{{ old('major', $profile->major ?? '') }}"
                                    placeholder="Contoh: Teknik Informatika, Manajemen, Akuntansi"
                                    class="w-full px-3.5 py-2.5 text-xs rounded-xl border border-gray-300 focus:ring-2 focus:ring-rose-500 focus:border-rose-500 transition @error('major') border-red-500 @enderror">
                                @error('major')
                                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="occupation" class="block text-xs font-bold text-gray-700 mb-1">
                                    Profesi / Pekerjaan <span class="text-rose-500">*</span>
                                </label>
                                <input type="text" name="occupation" id="occupation" required
                                    value="{{ old('occupation', $profile->occupation) }}"
                                    placeholder="Contoh: Software Engineer / ASN / Wiraswasta"
                                    class="w-full px-3.5 py-2.5 text-xs rounded-xl border border-gray-300 focus:ring-2 focus:ring-rose-500 focus:border-rose-500 transition @error('occupation') border-red-500 @enderror">
                                @error('occupation')
                                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <input type="hidden" name="last_education" id="last_education"
                            value="{{ old('last_education', $profile->last_education) }}">
                    </div>

                    <!-- 5. Informasi Tambahan -->
                    <div class="bg-white rounded-2xl border border-gray-200/80 shadow-sm p-6 sm:p-7 space-y-4">
                        <h2 class="text-sm font-bold text-gray-900 pb-3 border-b border-gray-100 flex items-center gap-2">
                            <span>💍</span>
                            <span>Visi, Kriteria &amp; Harapan Pernikahan</span>
                        </h2>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="marriage_target_year" class="block text-xs font-bold text-gray-700 mb-1">
                                    Target Tahun Menikah
                                </label>
                                <input type="text" name="marriage_target_year" id="marriage_target_year"
                                    value="{{ old('marriage_target_year', $profile->marriage_target_year) }}"
                                    placeholder="Contoh: 2026 / Insya Allah Segera"
                                    class="w-full px-3.5 py-2.5 text-xs rounded-xl border border-gray-300 focus:ring-2 focus:ring-rose-500 focus:border-rose-500 transition">
                                @error('marriage_target_year')
                                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="personality" class="block text-xs font-bold text-gray-700 mb-1">
                                    Gambaran Kepribadian
                                </label>
                                <input type="text" name="personality" id="personality"
                                    value="{{ old('personality', $profile->personality) }}"
                                    placeholder="Contoh: Tenang, pendengar yang baik, suka kerapian"
                                    class="w-full px-3.5 py-2.5 text-xs rounded-xl border border-gray-300 focus:ring-2 focus:ring-rose-500 focus:border-rose-500 transition">
                                @error('personality')
                                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div>
                            <label for="ideal_partner_criteria" class="block text-xs font-bold text-gray-700 mb-1">
                                Visi Misi Pernikahan
                            </label>
                            <textarea name="ideal_partner_criteria" id="ideal_partner_criteria" rows="3"
                                placeholder="Jelaskan visi keluarga yang ingin dibangun..."
                                class="w-full px-3.5 py-2.5 text-xs rounded-xl border border-gray-300 focus:ring-2 focus:ring-rose-500 focus:border-rose-500 transition">{{ old('ideal_partner_criteria', $profile->ideal_partner_criteria) }}</textarea>
                            @error('ideal_partner_criteria')
                                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="visi_misi" class="block text-xs font-bold text-gray-700 mb-1">
                                Kriteria Pasangan yang Diharapkan
                            </label>
                            <textarea name="visi_misi" id="visi_misi" rows="3"
                                placeholder="Kriteria agama, akhlak, domisili, atau kriteria lain..."
                                class="w-full px-3.5 py-2.5 text-xs rounded-xl border border-gray-300 focus:ring-2 focus:ring-rose-500 focus:border-rose-500 transition">{{ old('visi_misi', $profile->visi_misi) }}</textarea>
                            @error('visi_misi')
                                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="expectation" class="block text-xs font-bold text-gray-700 mb-1">
                                Harapan dalam Rumah Tangga
                            </label>
                            <textarea name="expectation" id="expectation" rows="2"
                                placeholder="Harapan saling mendukung ibadah, karir, keluarga, dll..."
                                class="w-full px-3.5 py-2.5 text-xs rounded-xl border border-gray-300 focus:ring-2 focus:ring-rose-500 focus:border-rose-500 transition">{{ old('expectation', $profile->expectation) }}</textarea>
                            @error('expectation')
                                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="kelebihan_kekurangan" class="block text-xs font-bold text-gray-700 mb-1">
                                Kelebihan &amp; Kekurangan Diri
                            </label>
                            <textarea name="kelebihan_kekurangan" id="kelebihan_kekurangan" rows="2"
                                placeholder="Refleksi kelebihan dan hal yang sedang diperbaiki..."
                                class="w-full px-3.5 py-2.5 text-xs rounded-xl border border-gray-300 focus:ring-2 focus:ring-rose-500 focus:border-rose-500 transition">{{ old('kelebihan_kekurangan', $profile->kelebihan_kekurangan) }}</textarea>
                            @error('kelebihan_kekurangan')
                                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- 6. Kontak & Media -->
                    <div class="bg-white rounded-2xl border border-gray-200/80 shadow-sm p-6 sm:p-7 space-y-4">
                        <h2 class="text-sm font-bold text-gray-900 pb-3 border-b border-gray-100 flex items-center gap-2">
                            <span>📸</span>
                            <span>Foto Profil &amp; Informed Consent</span>
                        </h2>

                        <div>
                            <label for="instagram" class="block text-xs font-bold text-gray-700 mb-1">
                                Akun Instagram (Opsional)
                            </label>
                            <div class="flex rounded-xl shadow-2xs">
                                <span class="inline-flex items-center px-3 rounded-l-xl border border-r-0 border-gray-300 bg-gray-50 text-gray-500 text-xs font-semibold">
                                    @
                                </span>
                                <input type="text" name="instagram" id="instagram"
                                    value="{{ old('instagram', $profile->instagram) }}"
                                    placeholder="username_instagram"
                                    class="w-full px-3.5 py-2.5 text-xs rounded-r-xl border border-gray-300 focus:ring-2 focus:ring-rose-500 focus:border-rose-500 transition">
                            </div>
                            @error('instagram')
                                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Photo Section -->
                        <div class="pt-2">
                            <label class="block text-xs font-bold text-gray-700 mb-2">Foto Profil</label>
                            
                            @if ($profile->photo_url)
                                <div class="flex items-center gap-4 p-3 bg-gray-50 rounded-xl border border-gray-200 mb-3">
                                    <img src="{{ $profile->photo_url }}" alt="{{ $profile->full_name }}"
                                        class="h-16 w-16 object-cover rounded-xl border border-gray-200 shadow-2xs">
                                    <div class="text-xs">
                                        <p class="font-bold text-gray-800">Foto profil terpasang</p>
                                        <label class="inline-flex items-center gap-2 mt-1 cursor-pointer text-red-600">
                                            <input id="remove_photo" name="remove_photo" type="checkbox"
                                                class="rounded border-gray-300 text-rose-600 focus:ring-rose-500">
                                            <span>Hapus foto saat ini</span>
                                        </label>
                                    </div>
                                </div>
                            @endif

                            <div class="flex flex-col items-center justify-center p-5 border-2 border-dashed border-gray-300 rounded-2xl bg-gray-50/50 text-center">
                                <div class="text-xs text-gray-600">
                                    <label for="photo" class="cursor-pointer font-bold text-rose-600 hover:text-rose-700 hover:underline">
                                        {{ $profile->photo_url ? 'Unggah Foto Pengganti' : 'Pilih File Foto' }}
                                        <input id="photo" name="photo" type="file" class="sr-only" accept="image/jpeg,image/png,image/jpg">
                                    </label>
                                    <span class="pl-1 text-gray-400">atau drag & drop</span>
                                </div>
                                <p class="text-[11px] text-gray-400 mt-1">Format: JPG, JPEG, PNG. Maksimal 2MB.</p>
                            </div>
                            @error('photo')
                                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Informed Consent Section -->
                        <div class="pt-2">
                            <label class="block text-xs font-bold text-gray-700 mb-2">Dokumen Informed Consent</label>

                            @if ($profile->informed_consent_url)
                                <div class="flex items-center justify-between p-3 bg-emerald-50 rounded-xl border border-emerald-200 mb-3 text-xs">
                                    <div class="flex items-center gap-2 text-emerald-800 font-semibold">
                                        <span>✓</span>
                                        <span>Dokumen informed consent telah terunggah</span>
                                    </div>
                                    <label class="inline-flex items-center gap-1.5 cursor-pointer text-gray-700 text-xs">
                                        <input id="replace_consent" name="replace_consent" type="checkbox"
                                            class="rounded border-gray-300 text-rose-600 focus:ring-rose-500">
                                        <span>Ganti dokumen</span>
                                    </label>
                                </div>
                            @endif

                            <div class="{{ $profile->informed_consent_url ? 'hidden' : '' }}" id="consent_upload_group">
                                <div class="flex flex-col items-center justify-center p-5 border-2 border-dashed border-gray-300 rounded-2xl bg-gray-50/50 text-center">
                                    <div class="text-xs text-gray-600">
                                        <label for="informed_consent" class="cursor-pointer font-bold text-rose-600 hover:text-rose-700 hover:underline">
                                            Pilih Dokumen Consent
                                            <input id="informed_consent" name="informed_consent" type="file"
                                                class="sr-only" {{ $profile->informed_consent_url ? '' : 'required' }}
                                                accept="application/pdf,image/jpeg,image/png,image/jpg">
                                        </label>
                                        <span class="pl-1 text-gray-400">atau drag & drop</span>
                                    </div>
                                    <p class="text-[11px] text-gray-400 mt-1">
                                        Format PDF/JPG/PNG. Maks 5MB. Unduh template
                                        <a href="https://docs.google.com/document/d/1RcjFahFF3bmEpvDvf2QCZ8QlKi5gteNN/edit?tab=t.0"
                                            target="_blank" class="text-rose-600 font-bold hover:underline">di sini</a>.
                                    </p>
                                </div>
                            </div>
                            @error('informed_consent')
                                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Submit Buttons -->
                    <div class="flex items-center gap-3 pt-2">
                        <button type="submit"
                            class="inline-flex items-center gap-2 px-6 py-2.5 rounded-xl bg-gradient-to-r from-rose-500 to-pink-500 hover:from-rose-600 hover:to-pink-600 text-white font-semibold text-xs shadow-md shadow-pink-500/20 transition">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            <span>Simpan Perubahan Profil</span>
                        </button>
                        <a href="{{ route('taaruf.index') }}"
                            class="px-4 py-2.5 rounded-xl border border-gray-300 bg-white hover:bg-gray-50 text-gray-700 text-xs font-semibold transition">
                            Batal
                        </a>
                    </div>
                </form>
            </div>

            <!-- Right 1 Column: Status & Sidebar -->
            <div class="space-y-6">
                <!-- Status Profil Card -->
                <div class="bg-white rounded-2xl border border-gray-200/80 shadow-sm p-6 space-y-4">
                    <h3 class="text-xs font-bold text-gray-900 pb-3 border-b border-gray-100 flex items-center gap-2">
                        <span>🛡️</span>
                        <span>Visibilitas Katalog Ta'aruf</span>
                    </h3>

                    <div class="p-3 rounded-xl {{ $profile->is_active ? 'bg-emerald-50 border border-emerald-200 text-emerald-800' : 'bg-amber-50 border border-amber-200 text-amber-800' }} text-xs space-y-1 text-center">
                        <div class="font-bold flex items-center justify-center gap-2">
                            <span class="w-2 h-2 rounded-full {{ $profile->is_active ? 'bg-emerald-500' : 'bg-amber-500' }}"></span>
                            <span>{{ $profile->is_active ? 'Profil Sedang Aktif' : 'Profil Sedang Disembunyikan' }}</span>
                        </div>
                        <p class="text-[11px] opacity-90">
                            {{ $profile->is_active ? 'Biodata Anda dapat ditemukan oleh peserta lawan jenis.' : 'Biodata Anda tidak ditampilkan di katalog ta\'aruf.' }}
                        </p>
                    </div>

                    <form action="{{ route('taaruf.profile.toggle') }}" method="POST">
                        @csrf
                        <button type="submit"
                            class="w-full py-2.5 px-3 rounded-xl border text-xs font-bold transition {{ $profile->is_active ? 'border-red-200 bg-red-50 text-red-700 hover:bg-red-100' : 'border-emerald-200 bg-emerald-50 text-emerald-700 hover:bg-emerald-100' }}">
                            {{ $profile->is_active ? 'Sembunyikan / Nonaktifkan Profil' : 'Aktifkan Kembali Profil' }}
                        </button>
                    </form>
                </div>

                <!-- Pertanyaan Tambahan Link -->
                <div class="bg-white rounded-2xl border border-gray-200/80 shadow-sm p-6 space-y-3">
                    <h3 class="text-xs font-bold text-gray-900 pb-2 border-b border-gray-100 flex items-center gap-2">
                        <span>💬</span>
                        <span>Pertanyaan Prinsip Ta'aruf</span>
                    </h3>
                    <p class="text-xs text-gray-600 leading-relaxed">
                        Pertanyaan kesiapan (merokok, poligami, hutang, nafkah) dapat dikelola secara terpisah:
                    </p>
                    <a href="{{ route('taaruf.questions') }}"
                        class="w-full inline-flex items-center justify-center gap-1.5 py-2 px-3 rounded-xl bg-gray-50 hover:bg-rose-50 text-rose-700 border border-gray-200 hover:border-rose-200 font-bold text-xs transition">
                        <span>Kelola Pertanyaan Kesiapan &rarr;</span>
                    </a>
                </div>

                <!-- Panduan -->
                <div class="bg-white rounded-2xl border border-gray-200/80 shadow-sm p-6 space-y-3 text-xs text-gray-600">
                    <h4 class="font-bold text-gray-900 mb-2">Panduan Pembaruan Data</h4>
                    <ul class="space-y-2 leading-relaxed">
                        <li class="flex items-start gap-2">
                            <span class="text-rose-500 font-bold">•</span>
                            <span>Pastikan data nomor kontak / domisili tetap valid.</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <span class="text-rose-500 font-bold">•</span>
                            <span>Perubahan data akan langsung terupdate di katalog publik jika status aktif.</span>
                        </li>
                    </ul>
                </div>
            </div>

        </div>

    </div>
</div>

<!-- Select2 CSS & JS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

<style>
    .select2-container--default .select2-selection--single {
        height: 38px !important;
        border: 1px solid #d1d5db !important;
        border-radius: 0.75rem !important;
        padding: 0.35rem 0.75rem !important;
        font-size: 0.75rem !important;
    }
    .select2-container--default .select2-selection--single .select2-selection__rendered {
        line-height: 24px !important;
        padding-left: 0 !important;
        color: #1f2937 !important;
    }
    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 36px !important;
    }
    .select2-container--default.select2-container--focus .select2-selection--single {
        border-color: #f43f5e !important;
        outline: none !important;
    }
    .select2-dropdown {
        border: 1px solid #e5e7eb !important;
        border-radius: 0.75rem !important;
        font-size: 0.75rem !important;
        box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1) !important;
    }
    .select2-container--default .select2-results__option--highlighted[aria-selected] {
        background-color: #f43f5e !important;
    }
</style>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const replaceConsentCheckbox = document.getElementById('replace_consent');
        const consentUploadGroup = document.getElementById('consent_upload_group');
        const informedConsentInput = document.getElementById('informed_consent');

        if (replaceConsentCheckbox && consentUploadGroup) {
            replaceConsentCheckbox.addEventListener('change', function() {
                if (this.checked) {
                    consentUploadGroup.classList.remove('hidden');
                    informedConsentInput.required = true;
                } else {
                    consentUploadGroup.classList.add('hidden');
                    informedConsentInput.required = false;
                }
            });
        }

        // ===== ASAL DAERAH =====
        const originProvinsiSelect = document.getElementById('origin_province');
        const originKotaSelect = document.getElementById('origin_city');
        const originKecamatanSelect = document.getElementById('origin_district');
        const originKelurahanSelect = document.getElementById('origin_village');

        const savedOriginProvince = "{{ old('origin_province', $profile->origin_province ?? '') }}";
        const savedOriginCity = "{{ old('origin_city', $profile->origin_city ?? '') }}";
        const savedOriginDistrict = "{{ old('origin_district', $profile->origin_district ?? '') }}";
        const savedOriginVillage = "{{ old('origin_village', $profile->origin_village ?? '') }}";

        fetch('https://ibnux.github.io/data-indonesia/provinsi.json')
            .then(res => res.json())
            .then(data => {
                originProvinsiSelect.innerHTML = '<option value="">Pilih Provinsi</option>';
                data.forEach(prov => {
                    const opt = document.createElement('option');
                    opt.value = prov.nama;
                    opt.textContent = prov.nama;
                    opt.setAttribute('data-id', prov.id);
                    if (prov.nama === savedOriginProvince) opt.selected = true;
                    originProvinsiSelect.appendChild(opt);
                });
                if (savedOriginProvince) originProvinsiSelect.dispatchEvent(new Event('change'));
            }).catch(e => console.error(e));

        originProvinsiSelect.addEventListener('change', function() {
            const provId = this.options[this.selectedIndex]?.getAttribute('data-id');
            originKotaSelect.innerHTML = '<option value="">Memuat...</option>';
            originKotaSelect.disabled = true;
            originKecamatanSelect.innerHTML = '<option value="">Pilih Kecamatan</option>';
            originKecamatanSelect.disabled = true;
            originKelurahanSelect.innerHTML = '<option value="">Pilih Kelurahan</option>';
            originKelurahanSelect.disabled = true;

            if (!provId) return;

            fetch(`https://ibnux.github.io/data-indonesia/kabupaten/${provId}.json`)
                .then(res => res.json())
                .then(data => {
                    originKotaSelect.innerHTML = '<option value="">Pilih Kota/Kabupaten</option>';
                    data.forEach(kota => {
                        const opt = document.createElement('option');
                        opt.value = kota.nama;
                        opt.textContent = kota.nama;
                        opt.setAttribute('data-id', kota.id);
                        if (kota.nama === savedOriginCity) opt.selected = true;
                        originKotaSelect.appendChild(opt);
                    });
                    originKotaSelect.disabled = false;
                    if (savedOriginCity) originKotaSelect.dispatchEvent(new Event('change'));
                }).catch(e => console.error(e));
        });

        originKotaSelect.addEventListener('change', function() {
            const kotaId = this.options[this.selectedIndex]?.getAttribute('data-id');
            originKecamatanSelect.innerHTML = '<option value="">Memuat...</option>';
            originKecamatanSelect.disabled = true;
            originKelurahanSelect.innerHTML = '<option value="">Pilih Kelurahan</option>';
            originKelurahanSelect.disabled = true;

            if (!kotaId) return;

            fetch(`https://ibnux.github.io/data-indonesia/kecamatan/${kotaId}.json`)
                .then(res => res.json())
                .then(data => {
                    originKecamatanSelect.innerHTML = '<option value="">Pilih Kecamatan</option>';
                    data.forEach(kec => {
                        const opt = document.createElement('option');
                        opt.value = kec.nama;
                        opt.textContent = kec.nama;
                        opt.setAttribute('data-id', kec.id);
                        if (kec.nama === savedOriginDistrict) opt.selected = true;
                        originKecamatanSelect.appendChild(opt);
                    });
                    originKecamatanSelect.disabled = false;
                    if (savedOriginDistrict) originKecamatanSelect.dispatchEvent(new Event('change'));
                }).catch(e => console.error(e));
        });

        originKecamatanSelect.addEventListener('change', function() {
            const kecId = this.options[this.selectedIndex]?.getAttribute('data-id');
            originKelurahanSelect.innerHTML = '<option value="">Memuat...</option>';
            originKelurahanSelect.disabled = true;

            if (!kecId) return;

            fetch(`https://ibnux.github.io/data-indonesia/kelurahan/${kecId}.json`)
                .then(res => res.json())
                .then(data => {
                    originKelurahanSelect.innerHTML = '<option value="">Pilih Kelurahan</option>';
                    data.forEach(kel => {
                        const opt = document.createElement('option');
                        opt.value = kel.nama;
                        opt.textContent = kel.nama;
                        opt.setAttribute('data-id', kel.id);
                        if (kel.nama === savedOriginVillage) opt.selected = true;
                        originKelurahanSelect.appendChild(opt);
                    });
                    originKelurahanSelect.disabled = false;
                }).catch(e => console.error(e));
        });

        // ===== DOMISILI SAAT INI =====
        const residenceProvinsiSelect = document.getElementById('residence_province');
        const residenceKotaSelect = document.getElementById('residence_city');
        const residenceKecamatanSelect = document.getElementById('residence_district');
        const residenceKelurahanSelect = document.getElementById('residence_village');

        const savedResidenceProvince = "{{ old('residence_province', $profile->residence_province ?? '') }}";
        const savedResidenceCity = "{{ old('residence_city', $profile->residence_city ?? '') }}";
        const savedResidenceDistrict = "{{ old('residence_district', $profile->residence_district ?? '') }}";
        const savedResidenceVillage = "{{ old('residence_village', $profile->residence_village ?? '') }}";

        fetch('https://ibnux.github.io/data-indonesia/provinsi.json')
            .then(res => res.json())
            .then(data => {
                residenceProvinsiSelect.innerHTML = '<option value="">Pilih Provinsi</option>';
                data.forEach(prov => {
                    const opt = document.createElement('option');
                    opt.value = prov.nama;
                    opt.textContent = prov.nama;
                    opt.setAttribute('data-id', prov.id);
                    if (prov.nama === savedResidenceProvince) opt.selected = true;
                    residenceProvinsiSelect.appendChild(opt);
                });
                if (savedResidenceProvince) residenceProvinsiSelect.dispatchEvent(new Event('change'));
            }).catch(e => console.error(e));

        residenceProvinsiSelect.addEventListener('change', function() {
            const provId = this.options[this.selectedIndex]?.getAttribute('data-id');
            residenceKotaSelect.innerHTML = '<option value="">Memuat...</option>';
            residenceKotaSelect.disabled = true;
            residenceKecamatanSelect.innerHTML = '<option value="">Pilih Kecamatan</option>';
            residenceKecamatanSelect.disabled = true;
            residenceKelurahanSelect.innerHTML = '<option value="">Pilih Kelurahan</option>';
            residenceKelurahanSelect.disabled = true;

            if (!provId) return;

            fetch(`https://ibnux.github.io/data-indonesia/kabupaten/${provId}.json`)
                .then(res => res.json())
                .then(data => {
                    residenceKotaSelect.innerHTML = '<option value="">Pilih Kota/Kabupaten</option>';
                    data.forEach(kota => {
                        const opt = document.createElement('option');
                        opt.value = kota.nama;
                        opt.textContent = kota.nama;
                        opt.setAttribute('data-id', kota.id);
                        if (kota.nama === savedResidenceCity) opt.selected = true;
                        residenceKotaSelect.appendChild(opt);
                    });
                    residenceKotaSelect.disabled = false;
                    if (savedResidenceCity) residenceKotaSelect.dispatchEvent(new Event('change'));
                }).catch(e => console.error(e));
        });

        residenceKotaSelect.addEventListener('change', function() {
            const kotaId = this.options[this.selectedIndex]?.getAttribute('data-id');
            residenceKecamatanSelect.innerHTML = '<option value="">Memuat...</option>';
            residenceKecamatanSelect.disabled = true;
            residenceKelurahanSelect.innerHTML = '<option value="">Pilih Kelurahan</option>';
            residenceKelurahanSelect.disabled = true;

            if (!kotaId) return;

            fetch(`https://ibnux.github.io/data-indonesia/kecamatan/${kotaId}.json`)
                .then(res => res.json())
                .then(data => {
                    residenceKecamatanSelect.innerHTML = '<option value="">Pilih Kecamatan</option>';
                    data.forEach(kec => {
                        const opt = document.createElement('option');
                        opt.value = kec.nama;
                        opt.textContent = kec.nama;
                        opt.setAttribute('data-id', kec.id);
                        if (kec.nama === savedResidenceDistrict) opt.selected = true;
                        residenceKecamatanSelect.appendChild(opt);
                    });
                    residenceKecamatanSelect.disabled = false;
                    if (savedResidenceDistrict) residenceKecamatanSelect.dispatchEvent(new Event('change'));
                }).catch(e => console.error(e));
        });

        residenceKecamatanSelect.addEventListener('change', function() {
            const kecId = this.options[this.selectedIndex]?.getAttribute('data-id');
            residenceKelurahanSelect.innerHTML = '<option value="">Memuat...</option>';
            residenceKelurahanSelect.disabled = true;

            if (!kecId) return;

            fetch(`https://ibnux.github.io/data-indonesia/kelurahan/${kecId}.json`)
                .then(res => res.json())
                .then(data => {
                    residenceKelurahanSelect.innerHTML = '<option value="">Pilih Kelurahan</option>';
                    data.forEach(kel => {
                        const opt = document.createElement('option');
                        opt.value = kel.nama;
                        opt.textContent = kel.nama;
                        opt.setAttribute('data-id', kel.id);
                        if (kel.nama === savedResidenceVillage) opt.selected = true;
                        residenceKelurahanSelect.appendChild(opt);
                    });
                    residenceKelurahanSelect.disabled = false;
                }).catch(e => console.error(e));
        });

        // ===== KAMPUS / UNIVERSITAS =====
        const savedUniversity = "{{ old('university', $profile->university ?? '') }}";
        const savedCustomUniversity = "{{ old('custom_university', $profile->custom_university ?? '') }}";
        const universitySelect = document.getElementById('university');

        fetch('https://raw.githubusercontent.com/aryomuzakki/api-perguruan-tinggi-di-indonesia/main/data/pt.json')
            .then(res => res.json())
            .then(data => {
                const unis = data.map(pt => ({ id: pt.nama, text: pt.nama })).sort((a, b) => a.text.localeCompare(b.text));

                universitySelect.innerHTML = '<option value="">Pilih Kampus</option>';
                unis.forEach(u => {
                    const opt = document.createElement('option');
                    opt.value = u.id;
                    opt.textContent = u.text;
                    universitySelect.appendChild(opt);
                });

                const otherOpt = document.createElement('option');
                otherOpt.value = 'Lainnya';
                otherOpt.textContent = '➕ Lainnya (Tulis Manual)';
                universitySelect.appendChild(otherOpt);

                if (typeof jQuery !== 'undefined' && typeof jQuery.fn.select2 !== 'undefined') {
                    jQuery('#university').select2({
                        placeholder: "Ketik untuk mencari kampus...",
                        allowClear: true,
                        width: '100%'
                    });

                    if (savedUniversity) {
                        jQuery('#university').val(savedUniversity).trigger('change');
                        if (savedUniversity === 'Lainnya') {
                            document.getElementById('custom_university_container').classList.remove('hidden');
                        }
                    }

                    jQuery('#university').on('select2:select', function(e) {
                        const val = e.params.data.id;
                        const container = document.getElementById('custom_university_container');
                        if (val === 'Lainnya') {
                            container.classList.remove('hidden');
                        } else {
                            container.classList.add('hidden');
                        }
                    });
                }
            }).catch(e => console.error(e));
    });
</script>
@endpush
@endsection
