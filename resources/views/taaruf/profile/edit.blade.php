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
                                </div>
                            </div>
                        </div>

                        <!-- Pendidikan dan Pekerjaan -->
                        <div class="bg-white rounded-lg shadow-lg overflow-hidden mb-6">
                            <div class="p-6 border-b border-gray-200">
                                <h2 class="text-xl font-bold text-gray-900">Pendidikan dan Pekerjaan</h2>
                            </div>
                            <div class="p-6">
                                <div class="mb-4">
                                    <label for="last_education" class="block text-sm font-medium text-gray-700 mb-1">
                                        Pendidikan Terakhir <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" name="last_education" id="last_education"
                                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50 @error('last_education') border-red-300 @enderror"
                                        value="{{ old('last_education', $profile->last_education) }}"
                                        placeholder="Contoh: S1 Teknik Informatika" required>
                                    @error('last_education')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="mb-4">
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
    @endpush
@endsection
