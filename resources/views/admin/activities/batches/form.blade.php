@php
    $isEdit = isset($batch);
    $route = $isEdit
        ? route('admin.activities.batches.update', [$activity, $batch])
        : route('admin.activities.batches.store', $activity);
@endphp

<form action="{{ $route }}" method="POST" class="space-y-6" enctype="multipart/form-data">
    @csrf
    @if ($isEdit)
        @method('PUT')
    @endif

    <div class="bg-white rounded-2xl border border-gray-200/80 shadow-sm p-6 sm:p-8">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="md:col-span-2">
                <label for="nama_batch" class="block text-xs font-semibold text-gray-700 mb-1">Nama Batch</label>
                <input type="text" name="nama_batch" id="nama_batch"
                    value="{{ old('nama_batch', $batch->nama_batch ?? '') }}"
                    placeholder="Contoh: Batch 49 Offline / Angkatan 2026"
                    class="w-full px-3.5 py-2.5 text-sm border border-gray-300 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition">
                @error('nama_batch')
                    <p class="mt-1 text-xs text-red-600 font-medium">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="batch_ke" class="block text-xs font-semibold text-gray-700 mb-1">Nomor Urut (Batch Ke-)</label>
                <input type="number" name="batch_ke" id="batch_ke"
                    value="{{ old('batch_ke', $batch->batch_ke ?? '') }}"
                    placeholder="Contoh: 49"
                    class="w-full px-3.5 py-2.5 text-sm border border-gray-300 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition">
                @error('batch_ke')
                    <p class="mt-1 text-xs text-red-600 font-medium">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="kuota" class="block text-xs font-semibold text-gray-700 mb-1">Kuota Peserta</label>
                <input type="number" name="kuota" id="kuota" value="{{ old('kuota', $batch->kuota ?? '') }}"
                    placeholder="Contoh: 250"
                    class="w-full px-3.5 py-2.5 text-sm border border-gray-300 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition">
                @error('kuota')
                    <p class="mt-1 text-xs text-red-600 font-medium">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="harga" class="block text-xs font-semibold text-gray-700 mb-1">Harga Dasar (Rp)</label>
                <input type="number" name="harga" id="harga" value="{{ old('harga', $batch->harga ?? '') }}"
                    placeholder="Contoh: 849000"
                    class="w-full px-3.5 py-2.5 text-sm border border-gray-300 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition">
                @error('harga')
                    <p class="mt-1 text-xs text-red-600 font-medium">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="status" class="block text-xs font-semibold text-gray-700 mb-1">Status Publikasi</label>
                <select name="status" id="status"
                    class="w-full px-3.5 py-2.5 text-sm border border-gray-300 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition bg-white">
                    <option value="aktif" {{ old('status', $batch->status ?? '') === 'aktif' ? 'selected' : '' }}>Aktif (Dipublikasikan)</option>
                    <option value="nonaktif" {{ old('status', $batch->status ?? '') === 'nonaktif' ? 'selected' : '' }}>Nonaktif (Draft)</option>
                    <option value="selesai" {{ old('status', $batch->status ?? '') === 'selesai' ? 'selected' : '' }}>Selesai</option>
                </select>
                @error('status')
                    <p class="mt-1 text-xs text-red-600 font-medium">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="tanggal_mulai_pendaftaran" class="block text-xs font-semibold text-gray-700 mb-1">Tanggal Mulai Pendaftaran</label>
                <input type="date" name="tanggal_mulai_pendaftaran" id="tanggal_mulai_pendaftaran"
                    value="{{ old('tanggal_mulai_pendaftaran', isset($batch) && $batch->tanggal_mulai_pendaftaran ? $batch->tanggal_mulai_pendaftaran->format('Y-m-d') : '') }}"
                    class="w-full px-3.5 py-2.5 text-sm border border-gray-300 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition bg-white">
                @error('tanggal_mulai_pendaftaran')
                    <p class="mt-1 text-xs text-red-600 font-medium">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="tanggal_selesai_pendaftaran" class="block text-xs font-semibold text-gray-700 mb-1">Tanggal Selesai Pendaftaran</label>
                <input type="date" name="tanggal_selesai_pendaftaran" id="tanggal_selesai_pendaftaran"
                    value="{{ old('tanggal_selesai_pendaftaran', isset($batch) && $batch->tanggal_selesai_pendaftaran ? $batch->tanggal_selesai_pendaftaran->format('Y-m-d') : '') }}"
                    class="w-full px-3.5 py-2.5 text-sm border border-gray-300 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition bg-white">
                @error('tanggal_selesai_pendaftaran')
                    <p class="mt-1 text-xs text-red-600 font-medium">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="tanggal_mulai_kegiatan" class="block text-xs font-semibold text-gray-700 mb-1">Tanggal Mulai Kegiatan</label>
                <input type="date" name="tanggal_mulai_kegiatan" id="tanggal_mulai_kegiatan"
                    value="{{ old('tanggal_mulai_kegiatan', isset($batch) && $batch->tanggal_mulai_kegiatan ? $batch->tanggal_mulai_kegiatan->format('Y-m-d') : '') }}"
                    class="w-full px-3.5 py-2.5 text-sm border border-gray-300 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition bg-white">
                @error('tanggal_mulai_kegiatan')
                    <p class="mt-1 text-xs text-red-600 font-medium">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="tanggal_selesai_kegiatan" class="block text-xs font-semibold text-gray-700 mb-1">Tanggal Selesai Kegiatan</label>
                <input type="date" name="tanggal_selesai_kegiatan" id="tanggal_selesai_kegiatan"
                    value="{{ old('tanggal_selesai_kegiatan', isset($batch) && $batch->tanggal_selesai_kegiatan ? $batch->tanggal_selesai_kegiatan->format('Y-m-d') : '') }}"
                    class="w-full px-3.5 py-2.5 text-sm border border-gray-300 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition bg-white">
                @error('tanggal_selesai_kegiatan')
                    <p class="mt-1 text-xs text-red-600 font-medium">{{ $message }}</p>
                @enderror
            </div>

            <div class="md:col-span-2">
                <label for="featured_image" class="block text-xs font-semibold text-gray-700 mb-1">Banner / Gambar Batch</label>
                <input type="file" name="featured_image" id="featured_image"
                    class="w-full text-xs text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100">
                @if (isset($batch) && $batch->featured_image)
                    <div class="mt-2">
                        <img src="{{ Storage::url($batch->featured_image) }}" alt="{{ $batch->nama_batch }}"
                            class="h-20 w-32 object-cover rounded-xl border border-gray-200">
                    </div>
                @endif
                @error('featured_image')
                    <p class="mt-1 text-xs text-red-600 font-medium">{{ $message }}</p>
                @enderror
            </div>

            <div class="md:col-span-2">
                <label for="external_link" class="block text-xs font-semibold text-gray-700 mb-1">Link Eksternal Pendaftaran (Opsional)</label>
                <input type="text" name="external_link" id="external_link"
                    value="{{ old('external_link', $batch->external_link ?? '') }}"
                    placeholder="https://..."
                    class="w-full px-3.5 py-2.5 text-sm border border-gray-300 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition">
                @error('external_link')
                    <p class="mt-1 text-xs text-red-600 font-medium">{{ $message }}</p>
                @enderror
            </div>
        </div>
    </div>

    <div class="flex items-center justify-end gap-3">
        <a href="{{ route('admin.activities.show', $activity) }}"
            class="px-5 py-2.5 rounded-xl border border-gray-300 bg-white text-gray-700 hover:bg-gray-50 font-semibold text-sm shadow-sm transition">
            Batal
        </a>
        <button type="submit"
            class="px-6 py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-semibold text-sm shadow-sm transition">
            {{ $isEdit ? 'Simpan Perubahan' : 'Tambah Batch' }}
        </button>
    </div>
</form>
