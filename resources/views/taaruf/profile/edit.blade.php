@extends('layouts.app')

@section('title', 'Edit Profil Ta\'aruf')
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
                    <li><a href="{{ route('taaruf.index') }}" class="hover:text-green-600">Ta'aruf</a></li>
                    <li><span class="mx-2">/</span></li>
                    <li class="text-green-600 font-medium">Edit Profil</li>
                </ol>
            </nav>

            <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Edit Profil Ta'aruf</h1>
                    <p class="text-gray-500 mt-1">Perbarui informasi profil ta'aruf Anda</p>
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
                    <form action="{{ route('taaruf.profile.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Informasi Dasar -->
                        <div class="bg-white rounded-lg shadow-lg overflow-hidden mb-6">
                            <div class="p-6 border-b border-gray-200">
                                <h2 class="text-xl font-bold text-gray-900">Informasi Dasar</h2>
                            </div>
                            <div class="p-6">
                                <div class="mb-4">
                                    <label for="gender" class="block text-sm font-medium text-gray-700 mb-1">
                                        Jenis Kelamin <span class="text-red-500">*</span>
                                    </label>
                                    <select name="gender" id="gender"
                                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50 @error('gender') border-red-300 @enderror"
                                        required>
                                        <option value="">-- Pilih Jenis Kelamin --</option>
                                        <option value="male"
                                            {{ old('gender', $profile->gender) == 'male' ? 'selected' : '' }}>Laki-laki
                                        </option>
                                        <option value="female"
                                            {{ old('gender', $profile->gender) == 'female' ? 'selected' : '' }}>Perempuan
                                        </option>
                                    </select>
                                    @error('gender')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="mb-4">
                                    <label for="full_name" class="block text-sm font-medium text-gray-700 mb-1">
                                        Nama Lengkap <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" name="full_name" id="full_name"
                                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50 @error('full_name') border-red-300 @enderror"
                                        value="{{ old('full_name', $profile->full_name) }}" required>
                                    @error('full_name')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="mb-4">
                                    <label for="nickname" class="block text-sm font-medium text-gray-700 mb-1">
                                        Nama Panggilan <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" name="nickname" id="nickname"
                                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50 @error('nickname') border-red-300 @enderror"
                                        value="{{ old('nickname', $profile->nickname) }}" required>
                                    @error('nickname')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="mb-4">
                                    <label for="birth_place_date" class="block text-sm font-medium text-gray-700 mb-1">
                                        Tempat, Tanggal Lahir <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" name="birth_place_date" id="birth_place_date"
                                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50 @error('birth_place_date') border-red-300 @enderror"
                                        value="{{ old('birth_place_date', $profile->birth_place_date) }}"
                                        placeholder="Contoh: Jakarta, 15 Januari 1995" required>
                                    @error('birth_place_date')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                                {{-- 
                                <div class="mb-4">
                                    <label for="current_residence" class="block text-sm font-medium text-gray-700 mb-1">
                                        Domisili Saat Ini <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" name="current_residence" id="current_residence"
                                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50 @error('current_residence') border-red-300 @enderror"
                                        value="{{ old('current_residence', $profile->current_residence) }}"
                                        placeholder="Contoh: Bandung, Jawa Barat" required>
                                    @error('current_residence')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div> --}}



                            </div>

                        </div>
                        <div class="bg-white rounded-lg shadow-lg overflow-hidden mb-6">
                            <div class="p-6 border-b border-gray-200">
                                <h2 class="text-xl font-bold text-gray-900">Asal Daerah</h2>
                                <p class="text-sm text-gray-500 mt-1">Informasi detail tempat asal Anda</p>
                                <p class="mt-1 text-xs text-gray-500">
                                    Data detail ini digunakan untuk memudahkan filter tempat Asal Daerah, bagian
                                    kelurahan tidak akan ditampilkan baik di profile dan filter, sebagai arsip pengelola
                                </p>
                            </div>
                            <div class="p-6">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-4">
                                    <!-- Provinsi Asal -->
                                    <div>
                                        <label for="origin_province" class="block text-sm font-medium text-gray-700 mb-1">
                                            Provinsi <span class="text-red-500">*</span>
                                        </label>
                                        <select id="origin_province" name="origin_province" required
                                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50 @error('origin_province') border-red-300 @enderror">
                                            <option value="">Pilih Provinsi</option>
                                        </select>
                                        @error('origin_province')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- Kota/Kabupaten Asal -->
                                    <div>
                                        <label for="origin_city" class="block text-sm font-medium text-gray-700 mb-1">
                                            Kota/Kabupaten <span class="text-red-500">*</span>
                                        </label>
                                        <select id="origin_city" name="origin_city" required disabled
                                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50 @error('origin_city') border-red-300 @enderror">
                                            <option value="">Pilih Kota/Kabupaten</option>
                                        </select>
                                        @error('origin_city')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <!-- Kecamatan Asal -->
                                    <div>
                                        <label for="origin_district" class="block text-sm font-medium text-gray-700 mb-1">
                                            Kecamatan <span class="text-red-500">*</span>
                                        </label>
                                        <select id="origin_district" name="origin_district" required disabled
                                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50 @error('origin_district') border-red-300 @enderror">
                                            <option value="">Pilih Kecamatan</option>
                                        </select>
                                        @error('origin_district')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- Kelurahan Asal -->
                                    <div>
                                        <label for="origin_village" class="block text-sm font-medium text-gray-700 mb-1">
                                            Kelurahan <span class="text-red-500">*</span>
                                        </label>
                                        <select id="origin_village" name="origin_village" required disabled
                                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50 @error('origin_village') border-red-300 @enderror">
                                            <option value="">Pilih Kelurahan</option>
                                        </select>
                                        @error('origin_village')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Domisili Saat Ini (Detail) -->
                        <div class="bg-white rounded-lg shadow-lg overflow-hidden mb-6">
                            <div class="p-6 border-b border-gray-200">
                                <h2 class="text-xl font-bold text-gray-900">Domisili Saat Ini</h2>
                                <p class="text-sm text-gray-500 mt-1">Informasi detail tempat tinggal Anda saat ini
                                </p>
                                <p class="mt-1 text-xs text-gray-500">
                                    Data detail ini digunakan untuk memudahkan filter tempat domisili saat ini, bagian
                                    kelurahan tidak akan ditampilkan baik di profile dan filter, sebagai arsip pengelola
                                </p>
                            </div>
                            <div class="p-6">
                                <div class="mb-4">
                                    <label for="current_residence" class="block text-sm font-medium text-gray-700 mb-1">
                                        Alamat Lengkap <span class="text-red-500">*</span>
                                    </label>
                                    <textarea name="current_residence" id="current_residence" rows="2"
                                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50 @error('current_residence') border-red-300 @enderror"
                                        placeholder="Contoh: Jl. Merdeka No. 123, RT 01/RW 05" required>{{ old('current_residence', $profile->current_residence) }}</textarea>
                                    @error('current_residence')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                    <p class="mt-1 text-xs text-gray-500">
                                        Data ini tidak akan ditampilkan pada profil, akan disimpan sebagai arsip di
                                        pengelola, jika
                                        tidak berkenan diisi bisa ditulis "-"
                                    </p>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-4">
                                    <!-- Provinsi Domisili -->
                                    <div>
                                        <label for="residence_province"
                                            class="block text-sm font-medium text-gray-700 mb-1">
                                            Provinsi <span class="text-red-500">*</span>
                                        </label>
                                        <select id="residence_province" name="residence_province" required
                                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50 @error('residence_province') border-red-300 @enderror">
                                            <option value="">Pilih Provinsi</option>
                                        </select>
                                        @error('residence_province')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- Kota/Kabupaten Domisili -->
                                    <div>
                                        <label for="residence_city" class="block text-sm font-medium text-gray-700 mb-1">
                                            Kota/Kabupaten <span class="text-red-500">*</span>
                                        </label>
                                        <select id="residence_city" name="residence_city" required disabled
                                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50 @error('residence_city') border-red-300 @enderror">
                                            <option value="">Pilih Kota/Kabupaten</option>
                                        </select>
                                        @error('residence_city')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <!-- Kecamatan Domisili -->
                                    <div>
                                        <label for="residence_district"
                                            class="block text-sm font-medium text-gray-700 mb-1">
                                            Kecamatan <span class="text-red-500">*</span>
                                        </label>
                                        <select id="residence_district" name="residence_district" required disabled
                                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50 @error('residence_district') border-red-300 @enderror">
                                            <option value="">Pilih Kecamatan</option>
                                        </select>
                                        @error('residence_district')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- Kelurahan Domisili -->
                                    <div>
                                        <label for="residence_village"
                                            class="block text-sm font-medium text-gray-700 mb-1">
                                            Kelurahan <span class="text-red-500">*</span>
                                        </label>
                                        <select id="residence_village" name="residence_village" required disabled
                                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50 @error('residence_village') border-red-300 @enderror">
                                            <option value="">Pilih Kelurahan</option>
                                        </select>
                                        @error('residence_village')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- SECTION: Form Pendidikan Terakhir -->
                        <div class="bg-white rounded-lg shadow-lg overflow-hidden mb-6">
                            <div class="p-6 border-b border-gray-200">
                                <h2 class="text-xl font-bold text-gray-900">Pendidikan Terakhir dan Pekerjaan Saat ini</h2>
                                <p class="text-sm text-gray-500 mt-1">Informasi pendidikan formal terakhir Anda dan
                                    Pekerjaan Anda saat ini</p>
                            </div>
                            <div class="p-6">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <!-- Strata Pendidikan -->
                                    <div>
                                        <label for="education_level" class="block text-sm font-medium text-gray-700 mb-1">
                                            Strata Pendidikan <span class="text-red-500">*</span>
                                        </label>
                                        <select id="education_level" name="education_level" required
                                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50 @error('education_level') border-red-300 @enderror">
                                            <option value="">Pilih Strata Pendidikan</option>
                                            <option value="SD"
                                                {{ old('education_level', $profile->education_level ?? '') == 'SD' ? 'selected' : '' }}>
                                                SD/Sederajat</option>
                                            <option value="SMP"
                                                {{ old('education_level', $profile->education_level ?? '') == 'SMP' ? 'selected' : '' }}>
                                                SMP/Sederajat</option>
                                            <option value="SMA"
                                                {{ old('education_level', $profile->education_level ?? '') == 'SMA' ? 'selected' : '' }}>
                                                SMA/Sederajat</option>
                                            <option value="SMK"
                                                {{ old('education_level', $profile->education_level ?? '') == 'SMK' ? 'selected' : '' }}>
                                                SMK</option>
                                            <option value="D3"
                                                {{ old('education_level', $profile->education_level ?? '') == 'D3' ? 'selected' : '' }}>
                                                Diploma 3 (D3)</option>
                                            <option value="D4"
                                                {{ old('education_level', $profile->education_level ?? '') == 'D4' ? 'selected' : '' }}>
                                                Diploma 4 (D4)</option>
                                            <option value="S1"
                                                {{ old('education_level', $profile->education_level ?? '') == 'S1' ? 'selected' : '' }}>
                                                Sarjana (S1)</option>
                                            <option value="S2"
                                                {{ old('education_level', $profile->education_level ?? '') == 'S2' ? 'selected' : '' }}>
                                                Magister (S2)</option>
                                            <option value="S3"
                                                {{ old('education_level', $profile->education_level ?? '') == 'S3' ? 'selected' : '' }}>
                                                Doktor (S3)</option>
                                        </select>
                                        @error('education_level')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- Nama Institusi/Kampus -->
                                    <div>
                                        <label for="university" class="block text-sm font-medium text-gray-700 mb-1">
                                            Nama Institusi/Kampus <span class="text-red-500">*</span>
                                        </label>
                                        <select id="university" name="university" required
                                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50 @error('university') border-red-300 @enderror">
                                            <option value="">Memuat data kampus...</option>
                                        </select>
                                        @error('university')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                        <p class="mt-1 text-xs text-gray-500">
                                            💡 Ketik untuk mencari kampus. Pilih "Lainnya" jika kampus tidak ada dalam
                                            daftar
                                        </p>
                                    </div>
                                </div>

                                <!-- Input Custom Kampus (Muncul jika pilih "Lainnya") -->
                                <div id="custom_university_container" class="mt-4">
                                    <label for="custom_university" class="block text-sm font-medium text-gray-700 mb-1">
                                        Nama Kampus Lainnya <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" id="custom_university" name="custom_university"
                                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50"
                                        placeholder="Masukkan nama kampus Anda"
                                        value="{{ old('custom_university', $profile->custom_university ?? '') }}">
                                    <p class="mt-1 text-xs text-gray-500">Tuliskan nama lengkap institusi pendidikan Anda
                                    </p>
                                </div>

                                <!-- Jurusan -->
                                <div class="mt-4">
                                    <label for="major" class="block text-sm font-medium text-gray-700 mb-1">
                                        Jurusan/Program Studi <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" id="major" name="major" required
                                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50 @error('major') border-red-300 @enderror"
                                        placeholder="Contoh: Teknik Informatika, Manajemen, Akuntansi"
                                        value="{{ old('major', $profile->major ?? '') }}">
                                    @error('major')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                    <p class="mt-1 text-xs text-gray-500">
                                        Untuk pendidikan SD-SMK, bisa dikosongkan atau tulis "Umum"
                                    </p>
                                </div>

                                <!-- Pekerjaan -->
                                <div class="mt-4">
                                    <label for="occupation" class="block text-sm font-medium text-gray-700 mb-1">
                                        Pekerjaan <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" name="occupation" id="occupation"
                                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50 @error('occupation') border-red-300 @enderror"
                                        value="{{ old('occupation', $profile->occupation) }}"
                                        placeholder="Contoh: Software Engineer" required>
                                    @error('occupation')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>


                        <input type="hidden" name="last_education" id="last_education"
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50 @error('last_education') border-red-300 @enderror"
                            value="{{ old('last_education', $profile->last_education) }}"
                            placeholder="Contoh: S1 Teknik Informatika" required>
                        @error('last_education')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror


                        <!-- Informasi Tambahan -->
                        <div class="bg-white rounded-lg shadow-lg overflow-hidden mb-6">
                            <div class="p-6 border-b border-gray-200">
                                <h2 class="text-xl font-bold text-gray-900">Informasi Tambahan</h2>
                            </div>
                            <div class="p-6">
                                <div class="mb-4">
                                    <label for="marriage_target_year"
                                        class="block text-sm font-medium text-gray-700 mb-1">
                                        Target Tahun Menikah
                                    </label>
                                    <input type="number" name="marriage_target_year" id="marriage_target_year"
                                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50 @error('marriage_target_year') border-red-300 @enderror"
                                        value="{{ old('marriage_target_year', $profile->marriage_target_year) }}"
                                        min="2025" max="2050" placeholder="Contoh: 2026">
                                    @error('marriage_target_year')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="mb-4">
                                    <label for="personality" class="block text-sm font-medium text-gray-700 mb-1">
                                        Kepribadian
                                    </label>
                                    <input type="text" name="personality" id="personality"
                                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50 @error('personality') border-red-300 @enderror"
                                        value="{{ old('personality', $profile->personality) }}"
                                        placeholder="Contoh: Introvert, Extrovert, Ambivert, dll">
                                    @error('personality')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="mb-4">
                                    <label for="expectation" class="block text-sm font-medium text-gray-700 mb-1">
                                        Harapan dalam Pernikahan
                                    </label>
                                    <textarea name="expectation" id="expectation" rows="3"
                                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50 @error('expectation') border-red-300 @enderror"
                                        placeholder="Tuliskan harapan Anda dalam pernikahan">{{ old('expectation', $profile->expectation) }}</textarea>
                                    @error('expectation')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="mb-4">
                                    <label for="ideal_partner_criteria"
                                        class="block text-sm font-medium text-gray-700 mb-1">
                                        Visi Misi Pernikahan
                                    </label>
                                    <textarea name="ideal_partner_criteria" id="ideal_partner_criteria" rows="3"
                                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50 @error('ideal_partner_criteria') border-red-300 @enderror"
                                        placeholder="Tuliskan Visi Misi Pernikahan menurut Anda">{{ old('ideal_partner_criteria', $profile->ideal_partner_criteria) }}</textarea>
                                    @error('ideal_partner_criteria')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="mb-4">
                                    <label for="visi_misi" class="block text-sm font-medium text-gray-700 mb-1">
                                        Kriteria Pasangan
                                    </label>
                                    <textarea name="visi_misi" id="visi_misi" rows="3"
                                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50 @error('visi_misi') border-red-300 @enderror"
                                        placeholder="Tuliskan Kriteria Pasangan menurut Anda">{{ old('visi_misi', $profile->visi_misi) }}</textarea>
                                    @error('visi_misi')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="mb-4">
                                    <label for="kelebihan_kekurangan"
                                        class="block text-sm font-medium text-gray-700 mb-1">
                                        Kelebihan dan Kekurangan Diri
                                    </label>
                                    <textarea name="kelebihan_kekurangan" id="kelebihan_kekurangan" rows="3"
                                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50 @error('kelebihan_kekurangan') border-red-300 @enderror"
                                        placeholder="Tuliskan Kelebihan dan Kekurangan Diri Anda">{{ old('kelebihan_kekurangan', $profile->kelebihan_kekurangan) }}</textarea>
                                    @error('kelebihan_kekurangan')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Kontak dan Media -->
                        <div class="bg-white rounded-lg shadow-lg overflow-hidden mb-6">
                            <div class="p-6 border-b border-gray-200">
                                <h2 class="text-xl font-bold text-gray-900">Kontak dan Media</h2>
                            </div>
                            <div class="p-6">
                                <div class="mb-4">
                                    <label for="instagram" class="block text-sm font-medium text-gray-700 mb-1">
                                        Akun Instagram
                                    </label>
                                    <div class="flex rounded-md shadow-sm">
                                        <span
                                            class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-500 text-sm">
                                            @
                                        </span>
                                        <input type="text" name="instagram" id="instagram"
                                            class="flex-1 rounded-none rounded-r-md border-gray-300 focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50 @error('instagram') border-red-300 @enderror"
                                            value="{{ old('instagram', $profile->instagram) }}"
                                            placeholder="username_instagram">
                                    </div>
                                    @error('instagram')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="mb-4">
                                    <label for="photo" class="block text-sm font-medium text-gray-700 mb-1">
                                        Foto Profil
                                    </label>
                                    <div class="mb-3">
                                        @if ($profile->photo_url)
                                            <img src="{{ $profile->photo_url }}" alt="{{ $profile->full_name }}"
                                                class="h-32 w-32 object-cover rounded-lg border border-gray-200">
                                            <div class="mt-2 flex items-center">
                                                <input id="remove_photo" name="remove_photo" type="checkbox"
                                                    class="h-4 w-4 text-green-600 focus:ring-green-500 border-gray-300 rounded">
                                                <label for="remove_photo" class="ml-2 block text-sm text-gray-700">
                                                    Hapus foto saat ini
                                                </label>
                                            </div>
                                        @else
                                            <p class="text-sm text-gray-500">Belum ada foto profil</p>
                                        @endif
                                    </div>
                                    <div class="mt-2">
                                        <label class="block text-sm font-medium text-gray-700 mb-1">
                                            Unggah foto baru
                                        </label>
                                        <div
                                            class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
                                            <div class="space-y-1 text-center">
                                                <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor"
                                                    fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                                    <path
                                                        d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02"
                                                        stroke-width="2" stroke-linecap="round"
                                                        stroke-linejoin="round" />
                                                </svg>
                                                <div class="flex text-sm text-gray-600">
                                                    <label for="photo"
                                                        class="relative cursor-pointer bg-white rounded-md font-medium text-green-600 hover:text-green-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-green-500">
                                                        <span>Pilih file</span>
                                                        <input id="photo" name="photo" type="file"
                                                            class="sr-only">
                                                    </label>
                                                    <p class="pl-1">disini</p>
                                                </div>
                                                <p class="text-xs text-gray-500">
                                                    Format: JPG, JPEG, PNG. Maksimal 2MB. Disarankan foto setengah badan
                                                    dengan wajah terlihat jelas.
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    @error('photo')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="mb-4">
                                    <label for="informed_consent" class="block text-sm font-medium text-gray-700 mb-1">
                                        Dokumen Informed Consent
                                    </label>
                                    <div class="mb-3">
                                        @if ($profile->informed_consent_url)
                                            <div class="flex items-center text-sm font-medium text-green-600">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2"
                                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                                Dokumen informed consent telah diunggah
                                            </div>
                                            <div class="mt-2 flex items-center">
                                                <input id="replace_consent" name="replace_consent" type="checkbox"
                                                    class="h-4 w-4 text-green-600 focus:ring-green-500 border-gray-300 rounded">
                                                <label for="replace_consent" class="ml-2 block text-sm text-gray-700">
                                                    Ganti dokumen informed consent
                                                </label>
                                            </div>
                                        @else
                                            <div class="flex items-center text-sm font-medium text-red-600">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2"
                                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                                Dokumen informed consent belum diunggah
                                            </div>
                                        @endif
                                    </div>
                                    <div class="mt-2 {{ $profile->informed_consent_url ? 'hidden' : '' }}"
                                        id="consent_upload_group">
                                        <label class="block text-sm font-medium text-gray-700 mb-1">
                                            Unggah dokumen consent
                                        </label>
                                        <div
                                            class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
                                            <div class="space-y-1 text-center">
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    class="mx-auto h-12 w-12 text-gray-400" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                                </svg>
                                                <div class="flex text-sm text-gray-600">
                                                    <label for="informed_consent"
                                                        class="relative cursor-pointer bg-white rounded-md font-medium text-green-600 hover:text-green-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-green-500">
                                                        <span>Pilih file</span>
                                                        <input id="informed_consent" name="informed_consent"
                                                            type="file" class="sr-only"
                                                            {{ $profile->informed_consent_url ? '' : 'required' }}>
                                                    </label>
                                                    <p class="pl-1">disini</p>
                                                </div>
                                                <p class="text-xs text-gray-500">
                                                    Format: PDF, JPG, JPEG, PNG. Maksimal 5MB. Unduh template <a
                                                        href="https://docs.google.com/document/d/1RcjFahFF3bmEpvDvf2QCZ8QlKi5gteNN/edit?tab=t.0"
                                                        class="text-green-600 hover:text-green-500" target="_blank">di
                                                        sini</a>, isi, tandatangani, dan unggah kembali.
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    @error('informed_consent')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center space-x-4 mb-8">
                            <button type="submit"
                                class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4" />
                                </svg>
                                Simpan Perubahan
                            </button>
                            <a href="{{ route('taaruf.index') }}"
                                class="inline-flex items-center px-6 py-3 border border-gray-300 shadow-sm text-base font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12" />
                                </svg>
                                Batal
                            </a>
                        </div>
                    </form>
                </div>

                <div class="md:col-span-1">
                    <div class="bg-white rounded-lg shadow-lg overflow-hidden mb-6 top-20">
                        <div class="p-6 border-b border-gray-200">
                            <h2 class="text-xl font-bold text-gray-900">Status Profil</h2>
                        </div>
                        <div class="p-6">
                            <div class="text-center mb-6">
                                <div class="mb-4">
                                    <span
                                        class="inline-flex items-center px-4 py-2 rounded-full text-base font-medium {{ $profile->is_active ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="{{ $profile->is_active ? 'M5 13l4 4L19 7' : 'M6 18L18 6M6 6l12 12' }}" />
                                        </svg>
                                        {{ $profile->is_active ? 'Profil Aktif' : 'Profil Tidak Aktif' }}
                                    </span>
                                </div>

                                <form action="{{ route('taaruf.profile.toggle') }}" method="POST">
                                    @csrf
                                    <button type="submit"
                                        class="inline-flex items-center justify-center px-4 py-2 w-full border border-transparent rounded-md shadow-sm text-base font-medium {{ $profile->is_active ? 'text-red-700 bg-red-100 hover:bg-red-200' : 'text-green-700 bg-green-100 hover:bg-green-200' }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4" />
                                        </svg>
                                        {{ $profile->is_active ? 'Nonaktifkan Profil' : 'Aktifkan Profil' }}
                                    </button>
                                </form>
                            </div>

                            <div class="bg-blue-50 border-l-4 border-blue-500 text-blue-700 p-4 rounded-r-md mb-6">
                                <div class="flex">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 flex-shrink-0"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <span>Perubahan yang Anda buat akan langsung terlihat oleh alumni lain jika profil Anda
                                        aktif.</span>
                                </div>
                            </div>

                            <div class="border-t border-gray-200 pt-4">
                                <h3 class="text-lg font-medium text-gray-900 mb-2">Pertanyaan Tambahan:</h3>
                                <p class="text-gray-600">Untuk mengubah jawaban pertanyaan tambahan, silakan kunjungi
                                    halaman <a href="{{ route('taaruf.questions') }}"
                                        class="text-green-600 hover:text-green-500">Pertanyaan Ta'aruf</a>.</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-lg shadow-lg overflow-hidden mb-6">
                        <div class="p-6 border-b border-gray-200">
                            <h2 class="text-xl font-bold text-gray-900">Panduan Pengisian</h2>
                        </div>
                        <div class="p-6">
                            <ul class="space-y-3 text-sm text-gray-600">
                                <li class="flex items-start">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="h-5 w-5 text-green-500 mr-2 flex-shrink-0" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <span>Isi semua field yang ditandai dengan <span class="text-red-500">*</span>
                                        (wajib)</span>
                                </li>
                                <li class="flex items-start">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="h-5 w-5 text-green-500 mr-2 flex-shrink-0" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <span>Unggah foto profil yang menampilkan wajah dengan jelas</span>
                                </li>
                                <li class="flex items-start">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="h-5 w-5 text-green-500 mr-2 flex-shrink-0" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <span>Pastikan dokumen informed consent telah diunggah dan ditandatangani</span>
                                </li>
                                <li class="flex items-start">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="h-5 w-5 text-green-500 mr-2 flex-shrink-0" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <span>Berikan informasi yang jujur dan akurat</span>
                                </li>
                                <li class="flex items-start">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="h-5 w-5 text-green-500 mr-2 flex-shrink-0" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <span>Anda dapat mengaktifkan atau menonaktifkan profil kapan saja</span>
                                </li>
                            </ul>

                            <div class="mt-6 text-center">
                                {{-- <a href="{{ route('taaruf.faq') }}"
                            class="text-green-600 hover:text-green-700 font-medium">
                            Baca FAQ Ta'aruf
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline-block ml-1"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                            </svg>
                            </a> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <!-- Select2 CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />

    <!-- jQuery (diperlukan untuk Select2) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <!-- Select2 JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

    <!-- Custom Select2 Theme untuk match dengan Tailwind -->
    <style>
        /* Styling Select2 agar sesuai dengan tema Tailwind */
        .select2-container--default .select2-selection--single {
            height: 42px !important;
            border: 1px solid #d1d5db !important;
            border-radius: 0.375rem !important;
            padding: 0.5rem 0.75rem !important;
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 26px !important;
            padding-left: 0 !important;
            color: #374151 !important;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 40px !important;
        }

        .select2-container--default.select2-container--focus .select2-selection--single {
            border-color: #10b981 !important;
            outline: 2px solid transparent !important;
            outline-offset: 2px !important;
            box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.1) !important;
        }

        .select2-dropdown {
            border: 1px solid #d1d5db !important;
            border-radius: 0.375rem !important;
        }

        .select2-container--default .select2-results__option--highlighted[aria-selected] {
            background-color: #10b981 !important;
        }

        .select2-search--dropdown .select2-search__field {
            border: 1px solid #d1d5db !important;
            border-radius: 0.375rem !important;
            padding: 0.5rem !important;
        }

        .select2-search--dropdown .select2-search__field:focus {
            border-color: #10b981 !important;
            outline: none !important;
            box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.1) !important;
        }

        .select2-container {
            width: 100% !important;
        }

        .select2-results__option {
            padding: 8px 12px !important;
        }

        /* Style untuk input custom kampus */
        #custom_university_container {
            display: none;
        }

        #custom_university_container.show {
            display: block;
        }
    </style>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Toggle consent upload section visibility
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

                // File upload previews and custom file input styling
                const photoInput = document.getElementById('photo');
                if (photoInput) {
                    photoInput.addEventListener('change', function(e) {
                        const fileName = e.target.files[0]?.name || 'No file chosen';
                        const fileNameDisplay = this.parentElement.parentElement.querySelector('.pl-1');
                        if (fileNameDisplay) {
                            fileNameDisplay.textContent = fileName;
                        }
                    });
                }

                const consentInput = document.getElementById('informed_consent');
                if (consentInput) {
                    consentInput.addEventListener('change', function(e) {
                        const fileName = e.target.files[0]?.name || 'No file chosen';
                        const fileNameDisplay = this.parentElement.parentElement.querySelector('.pl-1');
                        if (fileNameDisplay) {
                            fileNameDisplay.textContent = fileName;
                        }
                    });
                }
            });
        </script>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // ===== ASAL DAERAH =====
                const originProvinsiSelect = document.getElementById('origin_province');
                const originKotaSelect = document.getElementById('origin_city');
                const originKecamatanSelect = document.getElementById('origin_district');
                const originKelurahanSelect = document.getElementById('origin_village');

                // Saved values dari database untuk Asal Daerah
                const savedOriginProvince = "{{ old('origin_province', $profile->origin_province ?? '') }}";
                const savedOriginCity = "{{ old('origin_city', $profile->origin_city ?? '') }}";
                const savedOriginDistrict = "{{ old('origin_district', $profile->origin_district ?? '') }}";
                const savedOriginVillage = "{{ old('origin_village', $profile->origin_village ?? '') }}";

                // Load Provinsi Asal
                fetch('https://ibnux.github.io/data-indonesia/provinsi.json')
                    .then(response => response.json())
                    .then(data => {
                        originProvinsiSelect.innerHTML = '<option value="">Pilih Provinsi</option>';
                        data.forEach(prov => {
                            const option = document.createElement('option');
                            option.value = prov.nama;
                            option.textContent = prov.nama;
                            option.setAttribute('data-id', prov.id);
                            if (prov.nama === savedOriginProvince) {
                                option.selected = true;
                            }
                            originProvinsiSelect.appendChild(option);
                        });

                        // Trigger change jika ada nilai tersimpan
                        if (savedOriginProvince) {
                            originProvinsiSelect.dispatchEvent(new Event('change'));
                        }
                    })
                    .catch(error => console.error('Error loading provinsi asal:', error));

                // Event: Provinsi Asal dipilih
                originProvinsiSelect.addEventListener('change', function() {
                    const selected = this.options[this.selectedIndex];
                    const provId = selected.getAttribute('data-id');

                    originKotaSelect.innerHTML = '<option value="">Memuat...</option>';
                    originKotaSelect.disabled = true;
                    originKecamatanSelect.innerHTML = '<option value="">Pilih Kecamatan</option>';
                    originKecamatanSelect.disabled = true;
                    originKelurahanSelect.innerHTML = '<option value="">Pilih Kelurahan</option>';
                    originKelurahanSelect.disabled = true;

                    if (!provId) return;

                    fetch(`https://ibnux.github.io/data-indonesia/kabupaten/${provId}.json`)
                        .then(response => response.json())
                        .then(data => {
                            originKotaSelect.innerHTML = '<option value="">Pilih Kota/Kabupaten</option>';
                            data.forEach(kota => {
                                const option = document.createElement('option');
                                option.value = kota.nama;
                                option.textContent = kota.nama;
                                option.setAttribute('data-id', kota.id);
                                if (kota.nama === savedOriginCity) {
                                    option.selected = true;
                                }
                                originKotaSelect.appendChild(option);
                            });
                            originKotaSelect.disabled = false;

                            if (savedOriginCity) {
                                originKotaSelect.dispatchEvent(new Event('change'));
                            }
                        })
                        .catch(error => console.error('Error loading kota asal:', error));
                });

                // Event: Kota Asal dipilih
                originKotaSelect.addEventListener('change', function() {
                    const selected = this.options[this.selectedIndex];
                    const kotaId = selected.getAttribute('data-id');

                    originKecamatanSelect.innerHTML = '<option value="">Memuat...</option>';
                    originKecamatanSelect.disabled = true;
                    originKelurahanSelect.innerHTML = '<option value="">Pilih Kelurahan</option>';
                    originKelurahanSelect.disabled = true;

                    if (!kotaId) return;

                    fetch(`https://ibnux.github.io/data-indonesia/kecamatan/${kotaId}.json`)
                        .then(response => response.json())
                        .then(data => {
                            originKecamatanSelect.innerHTML = '<option value="">Pilih Kecamatan</option>';
                            data.forEach(kec => {
                                const option = document.createElement('option');
                                option.value = kec.nama;
                                option.textContent = kec.nama;
                                option.setAttribute('data-id', kec.id);
                                if (kec.nama === savedOriginDistrict) {
                                    option.selected = true;
                                }
                                originKecamatanSelect.appendChild(option);
                            });
                            originKecamatanSelect.disabled = false;

                            if (savedOriginDistrict) {
                                originKecamatanSelect.dispatchEvent(new Event('change'));
                            }
                        })
                        .catch(error => console.error('Error loading kecamatan asal:', error));
                });

                // Event: Kecamatan Asal dipilih
                originKecamatanSelect.addEventListener('change', function() {
                    const selected = this.options[this.selectedIndex];
                    const kecId = selected.getAttribute('data-id');

                    originKelurahanSelect.innerHTML = '<option value="">Memuat...</option>';
                    originKelurahanSelect.disabled = true;

                    if (!kecId) return;

                    fetch(`https://ibnux.github.io/data-indonesia/kelurahan/${kecId}.json`)
                        .then(response => response.json())
                        .then(data => {
                            originKelurahanSelect.innerHTML = '<option value="">Pilih Kelurahan</option>';
                            data.forEach(kel => {
                                const option = document.createElement('option');
                                option.value = kel.nama;
                                option.textContent = kel.nama;
                                option.setAttribute('data-id', kel.id);
                                if (kel.nama === savedOriginVillage) {
                                    option.selected = true;
                                }
                                originKelurahanSelect.appendChild(option);
                            });
                            originKelurahanSelect.disabled = false;
                        })
                        .catch(error => console.error('Error loading kelurahan asal:', error));
                });

                // ===== DOMISILI =====
                const residenceProvinsiSelect = document.getElementById('residence_province');
                const residenceKotaSelect = document.getElementById('residence_city');
                const residenceKecamatanSelect = document.getElementById('residence_district');
                const residenceKelurahanSelect = document.getElementById('residence_village');

                // Saved values dari database untuk Domisili
                const savedResidenceProvince = "{{ old('residence_province', $profile->residence_province ?? '') }}";
                const savedResidenceCity = "{{ old('residence_city', $profile->residence_city ?? '') }}";
                const savedResidenceDistrict = "{{ old('residence_district', $profile->residence_district ?? '') }}";
                const savedResidenceVillage = "{{ old('residence_village', $profile->residence_village ?? '') }}";

                // Load Provinsi Domisili
                fetch('https://ibnux.github.io/data-indonesia/provinsi.json')
                    .then(response => response.json())
                    .then(data => {
                        residenceProvinsiSelect.innerHTML = '<option value="">Pilih Provinsi</option>';
                        data.forEach(prov => {
                            const option = document.createElement('option');
                            option.value = prov.nama;
                            option.textContent = prov.nama;
                            option.setAttribute('data-id', prov.id);
                            if (prov.nama === savedResidenceProvince) {
                                option.selected = true;
                            }
                            residenceProvinsiSelect.appendChild(option);
                        });

                        if (savedResidenceProvince) {
                            residenceProvinsiSelect.dispatchEvent(new Event('change'));
                        }
                    })
                    .catch(error => console.error('Error loading provinsi domisili:', error));

                // Event: Provinsi Domisili dipilih
                residenceProvinsiSelect.addEventListener('change', function() {
                    const selected = this.options[this.selectedIndex];
                    const provId = selected.getAttribute('data-id');

                    residenceKotaSelect.innerHTML = '<option value="">Memuat...</option>';
                    residenceKotaSelect.disabled = true;
                    residenceKecamatanSelect.innerHTML = '<option value="">Pilih Kecamatan</option>';
                    residenceKecamatanSelect.disabled = true;
                    residenceKelurahanSelect.innerHTML = '<option value="">Pilih Kelurahan</option>';
                    residenceKelurahanSelect.disabled = true;

                    if (!provId) return;

                    fetch(`https://ibnux.github.io/data-indonesia/kabupaten/${provId}.json`)
                        .then(response => response.json())
                        .then(data => {
                            residenceKotaSelect.innerHTML =
                                '<option value="">Pilih Kota/Kabupaten</option>';
                            data.forEach(kota => {
                                const option = document.createElement('option');
                                option.value = kota.nama;
                                option.textContent = kota.nama;
                                option.setAttribute('data-id', kota.id);
                                if (kota.nama === savedResidenceCity) {
                                    option.selected = true;
                                }
                                residenceKotaSelect.appendChild(option);
                            });
                            residenceKotaSelect.disabled = false;

                            if (savedResidenceCity) {
                                residenceKotaSelect.dispatchEvent(new Event('change'));
                            }
                        })
                        .catch(error => console.error('Error loading kota domisili:', error));
                });

                // Event: Kota Domisili dipilih
                residenceKotaSelect.addEventListener('change', function() {
                    const selected = this.options[this.selectedIndex];
                    const kotaId = selected.getAttribute('data-id');

                    residenceKecamatanSelect.innerHTML = '<option value="">Memuat...</option>';
                    residenceKecamatanSelect.disabled = true;
                    residenceKelurahanSelect.innerHTML = '<option value="">Pilih Kelurahan</option>';
                    residenceKelurahanSelect.disabled = true;

                    if (!kotaId) return;

                    fetch(`https://ibnux.github.io/data-indonesia/kecamatan/${kotaId}.json`)
                        .then(response => response.json())
                        .then(data => {
                            residenceKecamatanSelect.innerHTML =
                                '<option value="">Pilih Kecamatan</option>';
                            data.forEach(kec => {
                                const option = document.createElement('option');
                                option.value = kec.nama;
                                option.textContent = kec.nama;
                                option.setAttribute('data-id', kec.id);
                                if (kec.nama === savedResidenceDistrict) {
                                    option.selected = true;
                                }
                                residenceKecamatanSelect.appendChild(option);
                            });
                            residenceKecamatanSelect.disabled = false;

                            if (savedResidenceDistrict) {
                                residenceKecamatanSelect.dispatchEvent(new Event('change'));
                            }
                        })
                        .catch(error => console.error('Error loading kecamatan domisili:', error));
                });

                // Event: Kecamatan Domisili dipilih
                residenceKecamatanSelect.addEventListener('change', function() {
                    const selected = this.options[this.selectedIndex];
                    const kecId = selected.getAttribute('data-id');

                    residenceKelurahanSelect.innerHTML = '<option value="">Memuat...</option>';
                    residenceKelurahanSelect.disabled = true;

                    if (!kecId) return;

                    fetch(`https://ibnux.github.io/data-indonesia/kelurahan/${kecId}.json`)
                        .then(response => response.json())
                        .then(data => {
                            residenceKelurahanSelect.innerHTML =
                                '<option value="">Pilih Kelurahan</option>';
                            data.forEach(kel => {
                                const option = document.createElement('option');
                                option.value = kel.nama;
                                option.textContent = kel.nama;
                                option.setAttribute('data-id', kel.id);
                                if (kel.nama === savedResidenceVillage) {
                                    option.selected = true;
                                }
                                residenceKelurahanSelect.appendChild(option);
                            });
                            residenceKelurahanSelect.disabled = false;
                        })
                        .catch(error => console.error('Error loading kelurahan domisili:', error));
                });
            });
        </script>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Variabel untuk menyimpan data kampus
                let universitiesData = [];

                // Saved values dari database
                const savedUniversity = "{{ old('university', $profile->university ?? '') }}";
                const savedCustomUniversity = "{{ old('custom_university', $profile->custom_university ?? '') }}";
                const savedEducationLevel = "{{ old('education_level', $profile->education_level ?? '') }}";

                // Load data kampus dari GitHub
                function loadUniversities() {
                    const universitySelect = document.getElementById('university');
                    universitySelect.innerHTML = '<option value="">Memuat data kampus...</option>';

                    fetch(
                            'https://raw.githubusercontent.com/aryomuzakki/api-perguruan-tinggi-di-indonesia/main/data/pt.json'
                        )
                        .then(response => response.json())
                        .then(data => {
                            universitiesData = data;

                            // Populate dropdown
                            const universities = data.map(pt => ({
                                id: pt.nama,
                                text: pt.nama
                            }));

                            // Sort alphabetically
                            universities.sort((a, b) => a.text.localeCompare(b.text));

                            // Inisialisasi Select2 setelah data dimuat
                            if (typeof jQuery !== 'undefined' && typeof jQuery.fn.select2 !== 'undefined') {
                                // Destroy existing Select2 jika ada
                                if (jQuery('#university').hasClass('select2-hidden-accessible')) {
                                    jQuery('#university').select2('destroy');
                                }

                                // Clear dan rebuild options
                                universitySelect.innerHTML = '<option value="">Pilih Kampus</option>';

                                // Add universities
                                universities.forEach(uni => {
                                    const option = document.createElement('option');
                                    option.value = uni.id;
                                    option.textContent = uni.text;
                                    universitySelect.appendChild(option);
                                });

                                // Add "Lainnya" option at the end
                                const otherOption = document.createElement('option');
                                otherOption.value = 'Lainnya';
                                otherOption.textContent = '➕ Lainnya (Tulis Manual)';
                                universitySelect.appendChild(otherOption);

                                // Initialize Select2 with search
                                jQuery('#university').select2({
                                    placeholder: "Ketik untuk mencari kampus...",
                                    allowClear: true,
                                    width: '100%',
                                    language: {
                                        noResults: function() {
                                            return "Kampus tidak ditemukan";
                                        },
                                        searching: function() {
                                            return "Mencari...";
                                        },
                                        inputTooShort: function() {
                                            return "Ketik minimal 2 karakter";
                                        }
                                    },
                                    minimumInputLength: 0,
                                    matcher: function(params, data) {
                                        // Jika tidak ada query pencarian, tampilkan semua
                                        if (jQuery.trim(params.term) === '') {
                                            return data;
                                        }

                                        // Skip jika tidak ada text
                                        if (typeof data.text === 'undefined') {
                                            return null;
                                        }

                                        // Pencarian case-insensitive dan flexible
                                        const term = params.term.toLowerCase();
                                        const text = data.text.toLowerCase();

                                        // Cek apakah text mengandung term yang dicari
                                        if (text.indexOf(term) > -1) {
                                            return data;
                                        }

                                        return null;
                                    }
                                });

                                // Set saved value jika ada
                                if (savedUniversity) {
                                    jQuery('#university').val(savedUniversity).trigger('change');

                                    // Jika value adalah "Lainnya", tampilkan input custom
                                    if (savedUniversity === 'Lainnya') {
                                        showCustomUniversityInput();
                                    }
                                }

                                // Event listener untuk perubahan
                                jQuery('#university').on('select2:select', function(e) {
                                    const selectedValue = e.params.data.id;

                                    if (selectedValue === 'Lainnya') {
                                        showCustomUniversityInput();
                                    } else {
                                        hideCustomUniversityInput();
                                    }
                                });

                                jQuery('#university').on('select2:clear', function(e) {
                                    hideCustomUniversityInput();
                                });

                                console.log('✅ Berhasil memuat ' + universities.length + ' kampus');
                            } else {
                                console.error('❌ jQuery atau Select2 belum dimuat');
                            }
                        })
                        .catch(error => {
                            console.error('❌ Error loading universities:', error);
                            universitySelect.innerHTML = '<option value="">Gagal memuat data kampus</option>';
                        });
                }

                // Show custom university input
                function showCustomUniversityInput() {
                    const container = document.getElementById('custom_university_container');
                    const input = document.getElementById('custom_university');

                    container.classList.add('show');
                    input.setAttribute('required', 'required');

                    // Set value jika ada saved custom university
                    if (savedCustomUniversity) {
                        input.value = savedCustomUniversity;
                    }
                }

                // Hide custom university input
                function hideCustomUniversityInput() {
                    const container = document.getElementById('custom_university_container');
                    const input = document.getElementById('custom_university');

                    container.classList.remove('show');
                    input.removeAttribute('required');
                    input.value = '';
                }

                // Inisialisasi saat page load
                setTimeout(function() {
                    loadUniversities();
                }, 100);

                // Education level change handler (opsional untuk logika tambahan)
                const educationLevelSelect = document.getElementById('education_level');
                educationLevelSelect.addEventListener('change', function() {
                    const level = this.value;
                    const majorInput = document.getElementById('major');

                    // Untuk SD-SMK, major tidak wajib
                    if (['SD', 'SMP', 'SMA', 'SMK'].includes(level)) {
                        majorInput.removeAttribute('required');
                        majorInput.placeholder = "Opsional - Bisa dikosongkan atau tulis 'Umum'";
                    } else {
                        majorInput.setAttribute('required', 'required');
                        majorInput.placeholder = "Contoh: Teknik Informatika, Manajemen, Akuntansi";
                    }
                });

                // Trigger education level change untuk set initial state
                if (savedEducationLevel) {
                    educationLevelSelect.dispatchEvent(new Event('change'));
                }
            });
        </script>
    @endpush
@endsection
