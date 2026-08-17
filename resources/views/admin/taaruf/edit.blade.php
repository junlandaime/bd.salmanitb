@extends('admin.layouts.app')

@section('title', 'Edit Profil Taaruf - Admin Panel')

@section('content')
<div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8 max-w-4xl">
    
    <!-- Header -->
    <div class="flex items-center justify-between mb-8">
        <div>
            <div class="flex items-center gap-2 text-xs text-gray-500 mb-1">
                <a href="{{ route('admin.taaruf.index') }}" class="hover:text-pink-600">Layanan Ta'aruf</a>
                <span>/</span>
                <span>Edit Profil</span>
            </div>
            <h1 class="text-2xl font-bold text-gray-900">Edit Profil: {{ $profile->full_name }}</h1>
            <p class="text-sm text-gray-500 mt-0.5">Perbarui biodata, status verifikasi aktif, atau kriteria peserta ta'aruf.</p>
        </div>
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.taaruf.show', $profile->id) }}"
                class="px-4 py-2.5 rounded-xl border border-gray-300 bg-white text-gray-700 hover:bg-gray-50 font-semibold text-sm shadow-sm transition">
                &larr; Lihat Profil
            </a>
        </div>
    </div>

    @if ($errors->any())
        <div class="bg-red-50 border border-red-200 text-red-800 p-4 rounded-2xl mb-6 shadow-sm">
            <ul class="list-disc list-inside text-xs space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.taaruf.update', $profile->id) }}" method="POST" enctype="multipart/form-data" class="space-y-8">
        @csrf
        @method('PUT')

        <!-- Basic Info Card -->
        <div class="bg-white rounded-2xl border border-gray-200/80 shadow-sm p-6 sm:p-8 space-y-6">
            <div class="flex items-center gap-2.5 pb-4 border-b border-gray-100">
                <span class="w-8 h-8 rounded-xl bg-pink-50 text-pink-600 flex items-center justify-center font-bold text-sm">👤</span>
                <div>
                    <h2 class="text-base font-bold text-gray-900">Informasi Pribadi &amp; Akun</h2>
                    <p class="text-xs text-gray-500">Status akun, nama lengkap, kontak, dan tanggal lahir.</p>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div>
                    <label for="is_active" class="block text-xs font-semibold text-gray-700 mb-1">Status Keaktifan</label>
                    <select id="is_active" name="is_active"
                        class="w-full px-3.5 py-2.5 text-sm border border-gray-300 rounded-xl focus:ring-2 focus:ring-pink-500 focus:border-pink-500 transition bg-white">
                        <option value="1" {{ $profile->is_active ? 'selected' : '' }}>Aktif (Siap Proses Ta'aruf)</option>
                        <option value="0" {{ !$profile->is_active ? 'selected' : '' }}>Tidak Aktif (Dinonaktifkan)</option>
                    </select>
                </div>

                <div>
                    <label for="gender" class="block text-xs font-semibold text-gray-700 mb-1">Jenis Kelamin</label>
                    <select id="gender" name="gender"
                        class="w-full px-3.5 py-2.5 text-sm border border-gray-300 rounded-xl focus:ring-2 focus:ring-pink-500 focus:border-pink-500 transition bg-white">
                        <option value="male" {{ $profile->gender === 'male' ? 'selected' : '' }}>Laki-laki (Ikhwan)</option>
                        <option value="female" {{ $profile->gender === 'female' ? 'selected' : '' }}>Perempuan (Akhwat)</option>
                    </select>
                </div>

                <div>
                    <label for="full_name" class="block text-xs font-semibold text-gray-700 mb-1">Nama Lengkap <span class="text-red-500">*</span></label>
                    <input type="text" id="full_name" name="full_name" value="{{ old('full_name', $profile->full_name) }}" required
                        class="w-full px-3.5 py-2.5 text-sm border border-gray-300 rounded-xl focus:ring-2 focus:ring-pink-500 focus:border-pink-500 transition">
                </div>

                <div>
                    <label for="nickname" class="block text-xs font-semibold text-gray-700 mb-1">Nama Panggilan</label>
                    <input type="text" id="nickname" name="nickname" value="{{ old('nickname', $profile->nickname) }}"
                        class="w-full px-3.5 py-2.5 text-sm border border-gray-300 rounded-xl focus:ring-2 focus:ring-pink-500 focus:border-pink-500 transition">
                </div>

                <div>
                    <label for="birth_place_date" class="block text-xs font-semibold text-gray-700 mb-1">Tempat, Tanggal Lahir</label>
                    <input type="text" id="birth_place_date" name="birth_place_date" value="{{ old('birth_place_date', $profile->birth_place_date) }}"
                        placeholder="Bandung, 15 Januari 1998"
                        class="w-full px-3.5 py-2.5 text-sm border border-gray-300 rounded-xl focus:ring-2 focus:ring-pink-500 focus:border-pink-500 transition">
                </div>

                <div>
                    <label for="instagram" class="block text-xs font-semibold text-gray-700 mb-1">Akun Instagram</label>
                    <input type="text" id="instagram" name="instagram" value="{{ old('instagram', $profile->instagram) }}"
                        placeholder="@username"
                        class="w-full px-3.5 py-2.5 text-sm border border-gray-300 rounded-xl focus:ring-2 focus:ring-pink-500 focus:border-pink-500 transition">
                </div>
            </div>
        </div>

        <!-- Career & Education Card -->
        <div class="bg-white rounded-2xl border border-gray-200/80 shadow-sm p-6 sm:p-8 space-y-6">
            <div class="flex items-center gap-2.5 pb-4 border-b border-gray-100">
                <span class="w-8 h-8 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center font-bold text-sm">🎓</span>
                <div>
                    <h2 class="text-base font-bold text-gray-900">Domisili &amp; Latar Belakang</h2>
                    <p class="text-xs text-gray-500">Pendidikan terakhir, pekerjaan, dan target pernikahan.</p>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div>
                    <label for="current_residence" class="block text-xs font-semibold text-gray-700 mb-1">Domisili Saat Ini</label>
                    <input type="text" id="current_residence" name="current_residence" value="{{ old('current_residence', $profile->current_residence) }}"
                        class="w-full px-3.5 py-2.5 text-sm border border-gray-300 rounded-xl focus:ring-2 focus:ring-pink-500 focus:border-pink-500 transition">
                </div>

                <div>
                    <label for="last_education" class="block text-xs font-semibold text-gray-700 mb-1">Pendidikan Terakhir</label>
                    <input type="text" id="last_education" name="last_education" value="{{ old('last_education', $profile->last_education) }}"
                        class="w-full px-3.5 py-2.5 text-sm border border-gray-300 rounded-xl focus:ring-2 focus:ring-pink-500 focus:border-pink-500 transition">
                </div>

                <div>
                    <label for="occupation" class="block text-xs font-semibold text-gray-700 mb-1">Pekerjaan</label>
                    <input type="text" id="occupation" name="occupation" value="{{ old('occupation', $profile->occupation) }}"
                        class="w-full px-3.5 py-2.5 text-sm border border-gray-300 rounded-xl focus:ring-2 focus:ring-pink-500 focus:border-pink-500 transition">
                </div>

                <div>
                    <label for="marriage_target_year" class="block text-xs font-semibold text-gray-700 mb-1">Target Tahun Menikah</label>
                    <input type="number" id="marriage_target_year" name="marriage_target_year" value="{{ old('marriage_target_year', $profile->marriage_target_year) }}"
                        class="w-full px-3.5 py-2.5 text-sm border border-gray-300 rounded-xl focus:ring-2 focus:ring-pink-500 focus:border-pink-500 transition">
                </div>
            </div>
        </div>

        <div class="flex items-center justify-end gap-3">
            <a href="{{ route('admin.taaruf.show', $profile->id) }}"
                class="px-5 py-2.5 rounded-xl border border-gray-300 bg-white text-gray-700 hover:bg-gray-50 font-semibold text-sm shadow-sm transition">
                Batal
            </a>
            <button type="submit"
                class="px-6 py-2.5 rounded-xl bg-pink-600 hover:bg-pink-700 text-white font-semibold text-sm shadow-sm transition">
                Simpan Perubahan
            </button>
        </div>
    </form>
</div>
@endsection
