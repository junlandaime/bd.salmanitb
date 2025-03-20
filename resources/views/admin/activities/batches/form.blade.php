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

    <div class="bg-white shadow rounded-lg p-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="md:col-span-2">
                <label for="nama_batch" class="block text-sm font-medium text-gray-700">Nama Batch</label>
                <input type="text" name="nama_batch" id="nama_batch"
                    value="{{ old('nama_batch', $batch->nama_batch ?? '') }}"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500">
                @error('nama_batch')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="batch_ke" class="block text-sm font-medium text-gray-700">Batch Ke-</label>
                <input type="number" name="batch_ke" id="batch_ke"
                    value="{{ old('batch_ke', $batch->batch_ke ?? '') }}"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500">
                @error('batch_ke')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="kuota" class="block text-sm font-medium text-gray-700">Kuota Peserta</label>
                <input type="number" name="kuota" id="kuota" value="{{ old('kuota', $batch->kuota ?? '') }}"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500">
                @error('kuota')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="harga" class="block text-sm font-medium text-gray-700">Harga (Rp)</label>
                <input type="number" name="harga" id="harga" value="{{ old('harga', $batch->harga ?? '') }}"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500">
                @error('harga')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="tanggal_mulai_pendaftaran" class="block text-sm font-medium text-gray-700">Tanggal Mulai
                    Pendaftaran</label>
                <input type="date" name="tanggal_mulai_pendaftaran" id="tanggal_mulai_pendaftaran"
                    value="{{ old('tanggal_mulai_pendaftaran', isset($batch) && $batch->tanggal_mulai_pendaftaran ? $batch->tanggal_mulai_pendaftaran->format('Y-m-d') : '') }}"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500">
                @error('tanggal_mulai_pendaftaran')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="tanggal_selesai_pendaftaran" class="block text-sm font-medium text-gray-700">Tanggal Selesai
                    Pendaftaran</label>
                <input type="date" name="tanggal_selesai_pendaftaran" id="tanggal_selesai_pendaftaran"
                    value="{{ old('tanggal_selesai_pendaftaran', isset($batch) && $batch->tanggal_selesai_pendaftaran ? $batch->tanggal_selesai_pendaftaran->format('Y-m-d') : '') }}"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500">
                @error('tanggal_selesai_pendaftaran')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="tanggal_mulai_kegiatan" class="block text-sm font-medium text-gray-700">Tanggal Mulai
                    Kegiatan</label>
                <input type="date" name="tanggal_mulai_kegiatan" id="tanggal_mulai_kegiatan"
                    value="{{ old('tanggal_mulai_kegiatan', isset($batch) && $batch->tanggal_mulai_kegiatan ? $batch->tanggal_mulai_kegiatan->format('Y-m-d') : '') }}"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500">
                @error('tanggal_mulai_kegiatan')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="tanggal_selesai_kegiatan" class="block text-sm font-medium text-gray-700">Tanggal Selesai
                    Kegiatan</label>
                <input type="date" name="tanggal_selesai_kegiatan" id="tanggal_selesai_kegiatan"
                    value="{{ old('tanggal_selesai_kegiatan', isset($batch) && $batch->tanggal_selesai_kegiatan ? $batch->tanggal_selesai_kegiatan->format('Y-m-d') : '') }}"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500">
                @error('tanggal_selesai_kegiatan')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                <select name="status" id="status"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500">
                    <option value="nonaktif"
                        {{ old('status', $batch->status ?? '') === 'nonaktif' ? 'selected' : '' }}>
                        Draft</option>
                    <option value="aktif" {{ old('status', $batch->status ?? '') === 'aktif' ? 'selected' : '' }}>
                        Published</option>
                    <option value="selesai" {{ old('status', $batch->status ?? '') === 'selesai' ? 'selected' : '' }}>
                        Selesai</option>
                </select>
                @error('status')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label for="featured_image" class="block text-sm font-medium text-gray-700">Image</label>
                <input type="file" name="featured_image" id="featured_image" class="mt-1 block w-full">
                @if (isset($batch) && $batch->featured_image)
                    <div class="mt-2">
                        <img src="{{ Storage::url($batch->featured_image) }}" alt="{{ $batch->title }}"
                            class="h-20 w-20 object-cover rounded">
                    </div>
                @endif
                @error('featured_image')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
            <div class="md:col-span-2">
                <label for="external_link" class="block text-sm font-medium text-gray-700">Link Pendaftaran</label>
                <input type="text" name="external_link" id="external_link"
                    value="{{ old('external_link', $batch->external_link ?? '') }}"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500">
                @error('external_link')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>
    </div>

    <div class="flex justify-end space-x-3">
        <a href="{{ route('admin.activities.show', $activity) }}"
            class="inline-flex justify-center py-2 px-4 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
            Cancel
        </a>
        <button type="submit"
            class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
            {{ $isEdit ? 'Update' : 'Create' }} Batch
        </button>
    </div>
</form>
