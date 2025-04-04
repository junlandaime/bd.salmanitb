@extends('admin.layouts.app')

@section('title', 'Edit Profil Taaruf')

@section('content')
    <div class="py-6 px-4">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-semibold text-gray-800">Edit Profil Taaruf</h1>
            <div class="flex space-x-2">
                <a href="{{ route('admin.taaruf.show', $profile->id) }}"
                    class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded">
                    <i class="fas fa-eye mr-2"></i>Lihat Profil
                </a>
                <a href="{{ route('admin.taaruf.index') }}"
                    class="bg-gray-500 hover:bg-gray-600 text-white py-2 px-4 rounded">
                    <i class="fas fa-arrow-left mr-2"></i>Kembali
                </a>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <form action="{{ route('admin.taaruf.update', $profile->id) }}" method="POST" enctype="multipart/form-data"
                class="p-6">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Left Column -->
                    <div>
                        <h2 class="text-xl font-semibold mb-4">Informasi Dasar</h2>

                        <div class="mb-4">
                            <label for="is_active" class="block text-sm font-medium text-gray-700 mb-1">Status
                                Profil</label>
                            <select id="is_active" name="is_active"
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                <option value="1" {{ $profile->is_active ? 'selected' : '' }}>Aktif</option>
                                <option value="0" {{ !$profile->is_active ? 'selected' : '' }}>Tidak Aktif</option>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="gender" class="block text-sm font-medium text-gray-700 mb-1">Jenis Kelamin</label>
                            <select id="gender" name="gender"
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                <option value="male" {{ $profile->gender === 'male' ? 'selected' : '' }}>Laki-laki
                                </option>
                                <option value="female" {{ $profile->gender === 'female' ? 'selected' : '' }}>Perempuan
                                </option>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="full_name" class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                            <input type="text" id="full_name" name="full_name"
                                value="{{ old('full_name', $profile->full_name) }}"
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                            @error('full_name')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="nickname" class="block text-sm font-medium text-gray-700 mb-1">Nama
                                Panggilan</label>
                            <input type="text" id="nickname" name="nickname"
                                value="{{ old('nickname', $profile->nickname) }}"
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                            @error('nickname')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="birth_place_date" class="block text-sm font-medium text-gray-700 mb-1">Tempat,
                                Tanggal Lahir</label>
                            <input type="text" id="birth_place_date" name="birth_place_date"
                                value="{{ old('birth_place_date', $profile->birth_place_date) }}"
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                            @error('birth_place_date')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="current_residence" class="block text-sm font-medium text-gray-700 mb-1">Domisili
                                Saat Ini</label>
                            <input type="text" id="current_residence" name="current_residence"
                                value="{{ old('current_residence', $profile->current_residence) }}"
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                            @error('current_residence')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="last_education" class="block text-sm font-medium text-gray-700 mb-1">Pendidikan
                                Terakhir</label>
                            <input type="text" id="last_education" name="last_education"
                                value="{{ old('last_education', $profile->last_education) }}"
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                            @error('last_education')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="occupation" class="block text-sm font-medium text-gray-700 mb-1">Pekerjaan</label>
                            <input type="text" id="occupation" name="occupation"
                                value="{{ old('occupation', $profile->occupation) }}"
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                            @error('occupation')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="marriage_target_year" class="block text-sm font-medium text-gray-700 mb-1">Target
                                Tahun Menikah</label>
                            <input type="number" id="marriage_target_year" name="marriage_target_year"
                                value="{{ old('marriage_target_year', $profile->marriage_target_year) }}" min="2025"
                                max="2050"
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                            @error('marriage_target_year')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="instagram" class="block text-sm font-medium text-gray-700 mb-1">Instagram</label>
                            <input type="text" id="instagram" name="instagram"
                                value="{{ old('instagram', $profile->instagram) }}"
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                            @error('instagram')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Right Column -->
                    <div>
                        <h2 class="text-xl font-semibold mb-4">Foto & Status Taaruf</h2>

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Foto Saat Ini</label>
                            @if ($profile->photo_url)
                                <div class="mb-2">
                                    <img src="{{ $profile->photo_url }}" alt="{{ $profile->full_name }}"
                                        class="w-32 h-32 object-cover rounded-lg">
                                </div>
                                <div class="flex items-center">
                                    <input type="checkbox" id="remove_photo" name="remove_photo"
                                        class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                    <label for="remove_photo" class="ml-2 text-sm text-gray-700">Hapus foto</label>
                                </div>
                            @else
                                <p class="text-gray-500 text-sm">Tidak ada foto</p>
                            @endif
                        </div>

                        <div class="mb-4">
                            <label for="photo" class="block text-sm font-medium text-gray-700 mb-1">Upload Foto
                                Baru</label>
                            <input type="file" id="photo" name="photo" class="w-full">
                            <p class="text-gray-500 text-xs mt-1">Format: JPG, JPEG, PNG. Maks: 2MB</p>
                            @error('photo')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mt-6 mb-4">
                            <label for="is_in_taaruf_process" class="block text-sm font-medium text-gray-700 mb-1">Sedang
                                Dalam Proses Taaruf</label>
                            <select id="is_in_taaruf_process" name="is_in_taaruf_process"
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                <option value="1" {{ $profile->is_in_taaruf_process ? 'selected' : '' }}>Ya</option>
                                <option value="0" {{ !$profile->is_in_taaruf_process ? 'selected' : '' }}>Tidak
                                </option>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="is_smoker" class="block text-sm font-medium text-gray-700 mb-1">Perokok</label>
                            <select id="is_smoker" name="is_smoker"
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                <option value="1" {{ $profile->is_smoker ? 'selected' : '' }}>Ya</option>
                                <option value="0" {{ !$profile->is_smoker ? 'selected' : '' }}>Tidak</option>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="is_polygamy_intended" class="block text-sm font-medium text-gray-700 mb-1">Berniat
                                Poligami (untuk laki-laki)</label>
                            <select id="is_polygamy_intended" name="is_polygamy_intended"
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                <option value="1" {{ $profile->is_polygamy_intended ? 'selected' : '' }}>Ya</option>
                                <option value="0" {{ !$profile->is_polygamy_intended ? 'selected' : '' }}>Tidak
                                </option>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="has_debt" class="block text-sm font-medium text-gray-700 mb-1">Memiliki
                                Hutang</label>
                            <select id="has_debt" name="has_debt"
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                <option value="1" {{ $profile->has_debt ? 'selected' : '' }}>Ya</option>
                                <option value="0" {{ !$profile->has_debt ? 'selected' : '' }}>Tidak</option>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="has_dependents" class="block text-sm font-medium text-gray-700 mb-1">Memiliki
                                Tanggungan</label>
                            <select id="has_dependents" name="has_dependents"
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                <option value="1" {{ $profile->has_dependents ? 'selected' : '' }}>Ya</option>
                                <option value="0" {{ !$profile->has_dependents ? 'selected' : '' }}>Tidak</option>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="personality"
                                class="block text-sm font-medium text-gray-700 mb-1">Kepribadian</label>
                            <input type="text" id="personality" name="personality"
                                value="{{ old('personality', $profile->personality) }}"
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                            @error('personality')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Full Width Fields -->
                <div class="mt-6">
                    <div class="mb-4">
                        <label for="expectation" class="block text-sm font-medium text-gray-700 mb-1">Ekspektasi dalam
                            Pernikahan</label>
                        <textarea id="expectation" name="expectation" rows="4"
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">{{ old('expectation', $profile->expectation) }}</textarea>
                        @error('expectation')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="ideal_partner_criteria" class="block text-sm font-medium text-gray-700 mb-1">Visi Misi
                            Pernikahan</label>
                        <textarea id="ideal_partner_criteria" name="ideal_partner_criteria" rows="4"
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">{{ old('ideal_partner_criteria', $profile->ideal_partner_criteria) }}</textarea>
                        @error('ideal_partner_criteria')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="visi_misi" class="block text-sm font-medium text-gray-700 mb-1">Kriteria
                            Pasangan</label>
                        <textarea id="visi_misi" name="visi_misi" rows="4"
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">{{ old('visi_misi', $profile->visi_misi) }}</textarea>
                        @error('visi_misi')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="kelebihan_kekurangan" class="block text-sm font-medium text-gray-700 mb-1">Kelebihan
                            dan Kekurangan Diri</label>
                        <textarea id="kelebihan_kekurangan" name="kelebihan_kekurangan" rows="4"
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">{{ old('kelebihan_kekurangan', $profile->kelebihan_kekurangan) }}</textarea>
                        @error('kelebihan_kekurangan')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="mt-6 flex justify-end">
                    <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
