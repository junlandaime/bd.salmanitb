@extends('layouts.app')

@section('title', 'Buat Profil Ta\'aruf')
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
    <main class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Breadcrumb Navigation -->
            <nav class="mb-6">
                <ol class="flex text-sm text-gray-500">
                    <li class="flex items-center">
                        <a href="{{ route('alumni.dashboard') }}" class="text-green-600 hover:text-green-700">Dashboard
                            Alumni</a>
                        <svg class="h-4 w-4 mx-2 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </li>
                    <li class="flex items-center">
                        <a href="{{ route('taaruf.index') }}" class="text-green-600 hover:text-green-700">Ta'aruf</a>
                        <svg class="h-4 w-4 mx-2 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </li>
                    <li class="text-gray-700 font-medium">Buat Profil</li>
                </ol>
            </nav>

            <!-- Page Header -->
            <div class="mb-10">
                <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight sm:text-4xl">
                    <span class="block text-green-600">Buat Profil Ta'aruf</span>
                </h1>
                <p class="mt-3 text-lg text-gray-500">Lengkapi informasi diri Anda dengan jujur dan akurat</p>
            </div>

            @if (session('error'))
                <div class="bg-red-50 border-l-4 border-red-500 p-4 mb-6">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-red-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-red-700">{{ session('error') }}</p>
                        </div>
                    </div>
                </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Main Form Column -->
                <div class="lg:col-span-2">
                    <form action="{{ route('taaruf.profile.store') }}" method="POST" enctype="multipart/form-data"
                        class="space-y-8">
                        @csrf

                        <!-- Informasi Dasar Card -->
                        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                            <div class="px-6 py-4 bg-green-600">
                                <h2 class="text-xl font-bold text-white">Informasi Dasar</h2>
                            </div>
                            <div class="p-6 space-y-4">
                                <div>
                                    <label for="gender" class="block text-sm font-medium text-gray-700">
                                        Jenis Kelamin <span class="text-red-500">*</span>
                                    </label>
                                    <select name="gender" id="gender"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-500 focus:ring-opacity-50 @error('gender') border-red-300 text-red-900 placeholder-red-300 focus:border-red-500 focus:ring-red-500 @enderror"
                                        required>
                                        <option value="">-- Pilih Jenis Kelamin --</option>
                                        <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Laki-laki
                                        </option>
                                        <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Perempuan
                                        </option>
                                    </select>
                                    @error('gender')
                                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="full_name" class="block text-sm font-medium text-gray-700">
                                        Nama Lengkap <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" name="full_name" id="full_name"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-500 focus:ring-opacity-50 @error('full_name') border-red-300 text-red-900 placeholder-red-300 focus:border-red-500 focus:ring-red-500 @enderror"
                                        value="{{ old('full_name') }}" required>
                                    @error('full_name')
                                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="nickname" class="block text-sm font-medium text-gray-700">
                                        Nama Panggilan <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" name="nickname" id="nickname"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-500 focus:ring-opacity-50 @error('nickname') border-red-300 text-red-900 placeholder-red-300 focus:border-red-500 focus:ring-red-500 @enderror"
                                        value="{{ old('nickname') }}" required>
                                    @error('nickname')
                                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="birth_place_date" class="block text-sm font-medium text-gray-700">
                                        Tempat, Tanggal Lahir <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" name="birth_place_date" id="birth_place_date"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-500 focus:ring-opacity-50 @error('birth_place_date') border-red-300 text-red-900 placeholder-red-300 focus:border-red-500 focus:ring-red-500 @enderror"
                                        value="{{ old('birth_place_date') }}"
                                        placeholder="Contoh: Jakarta, 15 Januari 1995" required>
                                    @error('birth_place_date')
                                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="current_residence" class="block text-sm font-medium text-gray-700">
                                        Domisili Saat Ini <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" name="current_residence" id="current_residence"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-500 focus:ring-opacity-50 @error('current_residence') border-red-300 text-red-900 placeholder-red-300 focus:border-red-500 focus:ring-red-500 @enderror"
                                        value="{{ old('current_residence') }}" placeholder="Contoh: Bandung, Jawa Barat"
                                        required>
                                    @error('current_residence')
                                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>


                            </div>
                        </div>

                        <!-- Pendidikan dan Pekerjaan Card -->
                        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                            <div class="px-6 py-4 bg-green-600">
                                <h2 class="text-xl font-bold text-white">Pendidikan dan Pekerjaan</h2>
                            </div>
                            <div class="p-6 space-y-4">
                                <div>
                                    <label for="last_education" class="block text-sm font-medium text-gray-700">
                                        Pendidikan Terakhir <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" name="last_education" id="last_education"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-500 focus:ring-opacity-50 @error('last_education') border-red-300 text-red-900 placeholder-red-300 focus:border-red-500 focus:ring-red-500 @enderror"
                                        value="{{ old('last_education') }}" placeholder="Contoh: S1 Teknik Informatika"
                                        required>
                                    @error('last_education')
                                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="occupation" class="block text-sm font-medium text-gray-700">
                                        Pekerjaan <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" name="occupation" id="occupation"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-500 focus:ring-opacity-50 @error('occupation') border-red-300 text-red-900 placeholder-red-300 focus:border-red-500 focus:ring-red-500 @enderror"
                                        value="{{ old('occupation') }}" placeholder="Contoh: Software Engineer" required>
                                    @error('occupation')
                                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Informasi Tambahan Card -->
                        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                            <div class="px-6 py-4 bg-green-600">
                                <h2 class="text-xl font-bold text-white">Informasi Tambahan</h2>
                            </div>
                            <div class="p-6 space-y-4">
                                <div>
                                    <label for="marriage_target_year" class="block text-sm font-medium text-gray-700">
                                        Target Tahun Menikah
                                    </label>
                                    <input type="number" name="marriage_target_year" id="marriage_target_year"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-500 focus:ring-opacity-50 @error('marriage_target_year') border-red-300 text-red-900 placeholder-red-300 focus:border-red-500 focus:ring-red-500 @enderror"
                                        value="{{ old('marriage_target_year') }}" min="2025" max="2050"
                                        placeholder="Contoh: 2026">
                                    @error('marriage_target_year')
                                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="personality" class="block text-sm font-medium text-gray-700">
                                        Kepribadian
                                    </label>
                                    <input type="text" name="personality" id="personality"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-500 focus:ring-opacity-50 @error('personality') border-red-300 text-red-900 placeholder-red-300 focus:border-red-500 focus:ring-red-500 @enderror"
                                        value="{{ old('personality') }}"
                                        placeholder="Contoh: Introvert, Extrovert, Ambivert, dll">
                                    @error('personality')
                                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="expectation" class="block text-sm font-medium text-gray-700">
                                        Harapan dalam Pernikahan
                                    </label>
                                    <textarea name="expectation" id="expectation" rows="3"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-500 focus:ring-opacity-50 @error('expectation') border-red-300 text-red-900 placeholder-red-300 focus:border-red-500 focus:ring-red-500 @enderror"
                                        placeholder="Tuliskan harapan Anda dalam pernikahan">{{ old('expectation') }}</textarea>
                                    @error('expectation')
                                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="ideal_partner_criteria" class="block text-sm font-medium text-gray-700">
                                        Visi Misi Pernikahan
                                    </label>
                                    <textarea name="ideal_partner_criteria" id="ideal_partner_criteria" rows="3"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-500 focus:ring-opacity-50 @error('ideal_partner_criteria') border-red-300 text-red-900 placeholder-red-300 focus:border-red-500 focus:ring-red-500 @enderror"
                                        placeholder="Tuliskan Visi Misi Pernikahan menurut Anda">{{ old('ideal_partner_criteria') }}</textarea>
                                    @error('ideal_partner_criteria')
                                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="visi_misi" class="block text-sm font-medium text-gray-700">
                                        Kriteria Pasangan
                                    </label>
                                    <textarea name="visi_misi" id="visi_misi" rows="3"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-500 focus:ring-opacity-50 @error('visi_misi') border-red-300 text-red-900 placeholder-red-300 focus:border-red-500 focus:ring-red-500 @enderror"
                                        placeholder="Tuliskan Kriteria Pasangan menurut Anda">{{ old('visi_misi') }}</textarea>
                                    @error('visi_misi')
                                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="kelebihan_kekurangan" class="block text-sm font-medium text-gray-700">
                                        Kelebihan dan Kekurangan Diri
                                    </label>
                                    <textarea name="kelebihan_kekurangan" id="kelebihan_kekurangan" rows="3"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-500 focus:ring-opacity-50 @error('kelebihan_kekurangan') border-red-300 text-red-900 placeholder-red-300 focus:border-red-500 focus:ring-red-500 @enderror"
                                        placeholder="Tuliskan Kelebihan dan Kekurangan Diri Anda">{{ old('kelebihan_kekurangan') }}</textarea>
                                    @error('kelebihan_kekurangan')
                                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Kontak dan Media Card -->
                        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                            <div class="px-6 py-4 bg-green-600">
                                <h2 class="text-xl font-bold text-white">Kontak dan Media</h2>
                            </div>
                            <div class="p-6 space-y-4">
                                <div>
                                    <label for="instagram" class="block text-sm font-medium text-gray-700">
                                        Akun Instagram
                                    </label>
                                    <div class="mt-1 flex rounded-md shadow-sm">
                                        <span
                                            class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-500 text-sm">
                                            @
                                        </span>
                                        <input type="text" name="instagram" id="instagram"
                                            class="flex-1 block w-full rounded-none rounded-r-md border-gray-300 focus:border-green-500 focus:ring focus:ring-green-500 focus:ring-opacity-50 @error('instagram') border-red-300 text-red-900 placeholder-red-300 focus:border-red-500 focus:ring-red-500 @enderror"
                                            value="{{ old('instagram') }}" placeholder="username_instagram">
                                    </div>
                                    @error('instagram')
                                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Photo Upload with Alpine.js -->
                                <div>
                                    <label for="photo" class="block text-sm font-medium text-gray-700">
                                        Foto Profil
                                    </label>
                                    <div x-data="photoUploader()" x-on:dragover.prevent="dragover = true"
                                        x-on:dragleave.prevent="dragover = false" x-on:drop.prevent="dropHandler($event)"
                                        x-bind:class="{ 'border-green-500 bg-green-50': dragover }"
                                        class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md transition duration-150">
                                        <div class="space-y-1 text-center">
                                            <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor"
                                                fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                                <path
                                                    d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                            <div class="flex text-sm text-gray-600">
                                                <label for="photo"
                                                    class="relative cursor-pointer bg-white rounded-md font-medium text-green-600 hover:text-green-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-green-500">
                                                    <span>Upload file</span>
                                                    <input id="photo" name="photo" type="file" class="sr-only"
                                                        accept="image/jpeg,image/png,image/jpg"
                                                        x-on:change="handleFileSelect()">
                                                </label>
                                                <p class="pl-1">atau drag and drop</p>
                                            </div>
                                            <p class="text-xs text-gray-500">
                                                Format: JPG, JPEG, PNG. Maksimal 2MB. Disarankan foto setengah badan dengan
                                                wajah terlihat jelas.
                                            </p>
                                            <!-- Container untuk preview foto -->
                                            <div x-show="preview" id="photoPreviewContainer" class="mt-3">
                                                <img id="photoPreview" class="max-h-48 rounded-md mx-auto"
                                                    x-bind:src="preview" alt="Preview foto">
                                                <button type="button" x-on:click="removeFile()"
                                                    class="mt-2 text-sm text-red-600 hover:text-red-800">Hapus</button>
                                            </div>
                                        </div>
                                    </div>
                                    @error('photo')
                                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Document Upload with Alpine.js -->
                                <div>
                                    <label for="informed_consent" class="block text-sm font-medium text-gray-700">
                                        Dokumen Informed Consent <span class="text-red-500">*</span>
                                    </label>
                                    <div x-data="documentUploader()" x-on:dragover.prevent="dragover = true"
                                        x-on:dragleave.prevent="dragover = false" x-on:drop.prevent="dropHandler($event)"
                                        x-bind:class="{ 'border-green-500 bg-green-50': dragover }"
                                        class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md transition duration-150">
                                        <div class="space-y-1 text-center">
                                            <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor"
                                                fill="none" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                            </svg>
                                            <div class="flex text-sm text-gray-600">
                                                <label for="informed_consent"
                                                    class="relative cursor-pointer bg-white rounded-md font-medium text-green-600 hover:text-green-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-green-500">
                                                    <span>Upload dokumen</span>
                                                    <input id="informed_consent" name="informed_consent" type="file"
                                                        class="sr-only" required
                                                        accept="application/pdf,image/jpeg,image/png,image/jpg"
                                                        x-on:change="handleFileSelect()">
                                                </label>
                                                <p class="pl-1">atau drag and drop</p>
                                            </div>
                                            <p class="text-xs text-gray-500">
                                                Format: PDF, JPG, JPEG, PNG. Maksimal 5MB. Unduh template <a
                                                    href="https://docs.google.com/document/d/1RcjFahFF3bmEpvDvf2QCZ8QlKi5gteNN/edit?tab=t.0"
                                                    class="text-green-600 hover:underline" target="_blank">di sini</a>,
                                                isi, tandatangani, dan unggah kembali.
                                            </p>
                                            <!-- Container untuk preview dokumen -->
                                            <div x-show="fileName" id="documentPreviewContainer" class="mt-3">
                                                <div id="documentPreview"
                                                    class="p-3 border rounded-md bg-gray-50 flex items-center justify-between">
                                                    <div class="flex items-center">
                                                        <svg class="h-6 w-6 text-gray-600 mr-2" fill="none"
                                                            stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                                        </svg>
                                                        <span id="documentName" class="text-sm text-gray-700"
                                                            x-text="fileName">Nama
                                                            dokumen</span>
                                                    </div>
                                                    <button type="button" x-on:click="removeFile()"
                                                        class="text-sm text-red-600 hover:text-red-800">Hapus</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @error('informed_consent')
                                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Submit Buttons -->
                        <div class="flex space-x-4">
                            <button type="submit"
                                class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                <svg class="h-5 w-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                                Simpan Profil
                            </button>
                            <a href="{{ route('taaruf.index') }}"
                                class="inline-flex items-center px-6 py-3 border border-gray-300 shadow-sm text-base font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                <svg class="h-5 w-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12" />
                                </svg>
                                Batal
                            </a>
                        </div>
                    </form>
                </div>

                <!-- Sidebar Column -->
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-lg shadow-lg overflow-hidden sticky top-8">
                        <div class="px-6 py-4 bg-green-600">
                            <h2 class="text-xl font-bold text-white">Petunjuk Pengisian</h2>
                        </div>
                        <div class="p-6 space-y-6">
                            <div class="bg-blue-50 border-l-4 border-blue-500 p-4">
                                <div class="flex">
                                    <div class="flex-shrink-0">
                                        <svg class="h-5 w-5 text-blue-400" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm text-blue-700">
                                            Informasi yang Anda berikan akan ditampilkan kepada alumni lain yang juga
                                            menggunakan fitur Ta'aruf.
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <h3 class="text-lg font-medium text-gray-900">Tips pengisian profil:</h3>
                                <ul class="mt-4 space-y-2 text-sm text-gray-600">
                                    <li class="flex items-start">
                                        <svg class="h-5 w-5 text-green-500 mr-2" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        Berikan informasi yang jujur dan akurat
                                    </li>
                                    <li class="flex items-start">
                                        <svg class="h-5 w-5 text-green-500 mr-2" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        Isi semua kolom wajib (bertanda *)
                                    </li>
                                    <li class="flex items-start">
                                        <svg class="h-5 w-5 text-green-500 mr-2" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        Gunakan bahasa yang sopan dan mudah dipahami
                                    </li>
                                    <li class="flex items-start">
                                        <svg class="h-5 w-5 text-green-500 mr-2" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        Unggah foto yang jelas dan representatif
                                    </li>
                                    <li class="flex items-start">
                                        <svg class="h-5 w-5 text-green-500 mr-2" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        Pastikan dokumen informed consent telah ditandatangani
                                    </li>
                                </ul>
                            </div>

                            <div>
                                <h3 class="text-lg font-medium text-gray-900">Setelah mengisi profil:</h3>
                                <ul class="mt-4 space-y-2 text-sm text-gray-600">
                                    <li class="flex items-start">
                                        <svg class="h-5 w-5 text-green-500 mr-2" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        Anda akan diminta menjawab beberapa pertanyaan tambahan
                                    </li>
                                    <li class="flex items-start">
                                        <svg class="h-5 w-5 text-green-500 mr-2" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        Profil Anda akan aktif dan dapat dilihat oleh alumni lain
                                    </li>
                                    <li class="flex items-start">
                                        <svg class="h-5 w-5 text-green-500 mr-2" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        Anda dapat mengubah atau menonaktifkan profil kapan saja
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    @push('scripts')
        {{-- <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script> --}}
        <script>
            function photoUploader() {
                return {
                    dragover: false,
                    preview: null,

                    handleFileSelect() {
                        const input = document.getElementById('photo');
                        if (input.files && input.files[0]) {
                            const reader = new FileReader();
                            reader.onload = (e) => {
                                this.preview = e.target.result;
                            };
                            reader.readAsDataURL(input.files[0]);
                        }
                    },

                    dropHandler(event) {
                        this.dragover = false;
                        const dt = event.dataTransfer;
                        const files = dt.files;

                        if (files.length > 0) {
                            const input = document.getElementById('photo');
                            input.files = files;
                            this.handleFileSelect();
                        }
                    },

                    removeFile() {
                        const input = document.getElementById('photo');
                        input.value = '';
                        this.preview = null;
                    }
                };
            }

            function documentUploader() {
                return {
                    dragover: false,
                    fileName: null,

                    handleFileSelect() {
                        const input = document.getElementById('informed_consent');
                        if (input.files && input.files[0]) {
                            this.fileName = input.files[0].name;
                        }
                    },

                    dropHandler(event) {
                        this.dragover = false;
                        const dt = event.dataTransfer;
                        const files = dt.files;

                        if (files.length > 0) {
                            const input = document.getElementById('informed_consent');
                            input.files = files;
                            this.handleFileSelect();
                        }
                    },

                    removeFile() {
                        const input = document.getElementById('informed_consent');
                        input.value = '';
                        this.fileName = null;
                    }
                };
            }
        </script>
    @endpush
@endsection
