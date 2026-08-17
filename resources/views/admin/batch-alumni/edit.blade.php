@extends('admin.layouts.app')

@section('title', 'Edit Alumni - Admin Panel')

@section('content')
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8 max-w-3xl">
        
        <!-- Header -->
        <div class="flex items-center justify-between mb-8">
            <div>
                <div class="flex items-center gap-2 text-xs text-gray-500 mb-1">
                    <a href="{{ route('admin.batch-alumni.index') }}" class="hover:text-emerald-600">Database Alumni</a>
                    <span>/</span>
                    <span>Edit Data</span>
                </div>
                <h1 class="text-2xl font-bold text-gray-900">Edit Data Alumni</h1>
                <p class="text-sm text-gray-500 mt-0.5">Perbarui informasi batch, username instagram, gender, atau catatan alumni.</p>
            </div>
            <a href="{{ route('admin.batch-alumni.index') }}"
                class="px-4 py-2.5 rounded-xl border border-gray-300 bg-white text-gray-700 hover:bg-gray-50 font-semibold text-sm shadow-sm transition">
                &larr; Kembali
            </a>
        </div>

        @if (session('error'))
            <div class="bg-red-50 border border-red-200 text-red-800 px-5 py-4 rounded-2xl mb-6 shadow-sm" role="alert">
                <span class="text-sm font-medium">{{ session('error') }}</span>
            </div>
        @endif

        <div class="bg-white rounded-2xl border border-gray-200/80 shadow-sm p-6 sm:p-8">
            <form action="{{ route('admin.batch-alumni.update', $batchAlumni->id) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                <div>
                    <label for="user_id" class="block text-xs font-semibold text-gray-700 mb-1">Pengguna / Akun Alumni <span class="text-red-500">*</span></label>
                    <select name="user_id" id="user_id" required
                        class="w-full px-3.5 py-2.5 text-sm border border-gray-300 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition bg-white">
                        <option value="">-- Pilih Pengguna --</option>
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}" {{ (old('user_id') ?? $batchAlumni->user_id) == $user->id ? 'selected' : '' }}>
                                {{ $user->name }} ({{ $user->email }})
                            </option>
                        @endforeach
                    </select>
                    @error('user_id')
                        <p class="mt-1 text-xs text-red-600 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="activity_batch_id" class="block text-xs font-semibold text-gray-700 mb-1">Batch Kegiatan <span class="text-red-500">*</span></label>
                    <select name="activity_batch_id" id="activity_batch_id" required
                        class="w-full px-3.5 py-2.5 text-sm border border-gray-300 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition bg-white">
                        <option value="">-- Pilih Batch --</option>
                        @foreach ($batches as $batch)
                            <option value="{{ $batch->id }}" {{ (old('activity_batch_id') ?? $batchAlumni->activity_batch_id) == $batch->id ? 'selected' : '' }}>
                                {{ $batch->activity->title ?? $batch->activity->nama_kegiatan ?? 'Kegiatan' }} - {{ $batch->nama_batch }}
                            </option>
                        @endforeach
                    </select>
                    @error('activity_batch_id')
                        <p class="mt-1 text-xs text-red-600 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label for="instagram_account" class="block text-xs font-semibold text-gray-700 mb-1">Akun Instagram</label>
                        <input type="text" name="instagram_account" id="instagram_account"
                            value="{{ old('instagram_account', $batchAlumni->instagram_account) }}"
                            placeholder="@username"
                            class="w-full px-3.5 py-2.5 text-sm border border-gray-300 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition">
                        @error('instagram_account')
                            <p class="mt-1 text-xs text-red-600 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="gender" class="block text-xs font-semibold text-gray-700 mb-1">Jenis Kelamin</label>
                        <select name="gender" id="gender"
                            class="w-full px-3.5 py-2.5 text-sm border border-gray-300 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition bg-white">
                            <option value="">-- Pilih Jenis Kelamin --</option>
                            <option value="Pria" {{ (old('gender', $batchAlumni->gender) == 'Pria' || old('gender', $batchAlumni->gender) == 'male' || old('gender', $batchAlumni->gender) == 'Laki-laki') ? 'selected' : '' }}>Laki-laki (Pria)</option>
                            <option value="Wanita" {{ (old('gender', $batchAlumni->gender) == 'Wanita' || old('gender', $batchAlumni->gender) == 'female' || old('gender', $batchAlumni->gender) == 'Perempuan') ? 'selected' : '' }}>Perempuan (Wanita)</option>
                        </select>
                        @error('gender')
                            <p class="mt-1 text-xs text-red-600 font-medium">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div>
                    <label for="notes" class="block text-xs font-semibold text-gray-700 mb-1">Catatan Tambahan</label>
                    <textarea name="notes" id="notes" rows="3"
                        class="w-full px-3.5 py-2.5 text-sm border border-gray-300 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition">{{ old('notes', $batchAlumni->notes) }}</textarea>
                    @error('notes')
                        <p class="mt-1 text-xs text-red-600 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center justify-end gap-3 pt-4 border-t border-gray-100">
                    <a href="{{ route('admin.batch-alumni.index') }}"
                        class="px-5 py-2.5 rounded-xl border border-gray-300 bg-white text-gray-700 hover:bg-gray-50 font-semibold text-sm shadow-sm transition">
                        Batal
                    </a>
                    <button type="submit"
                        class="px-6 py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-semibold text-sm shadow-sm transition">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>

    </div>
@endsection
