@extends('admin.layouts.app')

@section('content')
<div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="mb-6">
        <h1 class="text-2xl font-semibold text-gray-900">Edit Materi</h1>
        <p class="mt-1 text-sm text-gray-600">
            Batch: {{ $batch->nama_batch }} | Kegiatan: {{ $batch->activity->title }}
        </p>
    </div>

    <form action="{{ route('admin.batches.materials.update', [$batch, $material]) }}" method="POST" class="space-y-8">
        @csrf
        @method('PUT')

        <div class="bg-white shadow rounded-lg p-6">
            <h2 class="text-lg font-medium text-gray-900 mb-4">Informasi Materi</h2>
            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                <div class="sm:col-span-2">
                    <label for="title" class="block text-sm font-medium text-gray-700">Judul Materi</label>
                    <input type="text" name="title" id="title" value="{{ old('title', $material->title) }}"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500">
                    @error('title')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="sm:col-span-2">
                    <label for="description" class="block text-sm font-medium text-gray-700">Deskripsi</label>
                    <textarea name="description" id="description" rows="3"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500">{{ old('description', $material->description) }}</textarea>
                    @error('description')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="order" class="block text-sm font-medium text-gray-700">Urutan</label>
                    <input type="number" name="order" id="order" value="{{ old('order', $material->order) }}" min="1"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500">
                    @error('order')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        <div class="bg-white shadow rounded-lg p-6">
            <h2 class="text-lg font-medium text-gray-900 mb-4">Sumber Materi</h2>
            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                <div class="sm:col-span-2">
                    <label for="slide_url" class="block text-sm font-medium text-gray-700">URL Slide (opsional)</label>
                    <input type="url" name="slide_url" id="slide_url" value="{{ old('slide_url', $material->slide_url) }}"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500">
                    <p class="mt-1 text-sm text-gray-500">Masukkan URL Google Slides, PowerPoint Online, atau platform slide lainnya</p>
                    @error('slide_url')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="sm:col-span-2">
                    <label for="notes_url" class="block text-sm font-medium text-gray-700">URL Catatan/Dokumen (opsional)</label>
                    <input type="url" name="notes_url" id="notes_url" value="{{ old('notes_url', $material->notes_url) }}"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500">
                    <p class="mt-1 text-sm text-gray-500">Masukkan URL Google Docs, PDF, atau dokumen lainnya</p>
                    @error('notes_url')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="sm:col-span-2">
                    <label for="video_url" class="block text-sm font-medium text-gray-700">URL Video (opsional)</label>
                    <input type="url" name="video_url" id="video_url" value="{{ old('video_url', $material->video_url) }}"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500">
                    <p class="mt-1 text-sm text-gray-500">Masukkan URL YouTube, Vimeo, atau platform video lainnya</p>
                    @error('video_url')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        <div class="flex justify-end">
            <a href="{{ route('admin.batches.materials.index', $batch) }}"
                class="inline-flex justify-center py-2 px-4 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 mr-3">
                Batal
            </a>
            <button type="submit"
                class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                Simpan Perubahan
            </button>
        </div>
    </form>
</div>
@endsection
