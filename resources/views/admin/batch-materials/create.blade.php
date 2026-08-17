@extends('admin.layouts.app')
@section('title', 'Tambah Materi Batch - Admin Panel')

@section('content')
<div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
    
    <!-- Header & Breadcrumbs -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
        <div>
            <div class="flex items-center gap-2 text-xs text-gray-500 mb-2">
                <a href="{{ route('admin.activities.index') }}" class="hover:text-emerald-600 transition">Kegiatan</a>
                <span>/</span>
                <a href="{{ route('admin.activities.show', $batch->activity) }}" class="hover:text-emerald-600 transition">{{ $batch->activity->title ?? 'Detail' }}</a>
                <span>/</span>
                <a href="{{ route('admin.batches.materials.index', $batch) }}" class="hover:text-emerald-600 transition">Materi Batch</a>
                <span>/</span>
                <span class="text-gray-700 font-medium">Tambah</span>
            </div>
            <h1 class="text-2xl font-bold text-gray-900">Tambah Materi Baru</h1>
            <p class="text-sm text-gray-500 mt-1">
                Batch: <span class="font-semibold text-emerald-700">{{ $batch->nama_batch }}</span> &bull; Kegiatan: <span class="font-semibold text-gray-700">{{ $batch->activity->title }}</span>
            </p>
        </div>

        <a href="{{ route('admin.batches.materials.index', $batch) }}"
            class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl border border-gray-300 bg-white text-gray-700 font-semibold text-sm hover:bg-gray-50 shadow-sm transition">
            <svg class="w-4 h-4 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Kembali ke Daftar
        </a>
    </div>

    @if ($errors->any())
        <div class="bg-red-50 border border-red-200 text-red-800 px-5 py-4 rounded-2xl mb-8 shadow-sm" role="alert">
            <div class="font-bold text-sm mb-1 flex items-center gap-2">
                <svg class="w-4 h-4 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                Periksa kembali isian formulir:
            </div>
            <ul class="list-disc list-inside text-xs space-y-0.5 text-red-700">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.batches.materials.store', $batch) }}" method="POST" class="space-y-8">
        @csrf

        <!-- Card 1: Basic Information -->
        <div class="bg-white rounded-2xl border border-gray-200/80 shadow-sm p-6 sm:p-8">
            <div class="flex items-center gap-3 pb-5 border-b border-gray-100 mb-6">
                <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center font-bold">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                </div>
                <div>
                    <h2 class="text-base font-bold text-gray-900">Informasi Materi</h2>
                    <p class="text-xs text-gray-500">Judul materi pembelajaran, deskripsi silabus, dan urutan materi.</p>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div class="sm:col-span-2">
                    <label for="title" class="block text-xs font-semibold text-gray-700 mb-1.5">
                        Judul Materi <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="title" id="title" value="{{ old('title') }}" required
                        class="w-full px-4 py-2.5 text-sm border rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition @error('title') border-red-500 bg-red-50/50 @else border-gray-300 @enderror"
                        placeholder="Contoh: Pengantar Kepemimpinan Berbasis Masjid">
                    @error('title')
                        <p class="mt-1 text-xs text-red-600 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <div class="sm:col-span-2">
                    <label for="description" class="block text-xs font-semibold text-gray-700 mb-1.5">Deskripsi / Ringkasan</label>
                    <textarea name="description" id="description" rows="3"
                        class="w-full px-4 py-2.5 text-sm border rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition @error('description') border-red-500 bg-red-50/50 @else border-gray-300 @enderror"
                        placeholder="Uraian singkat mengenai poin-poin utama materi ini...">{{ old('description') }}</textarea>
                    @error('description')
                        <p class="mt-1 text-xs text-red-600 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="order" class="block text-xs font-semibold text-gray-700 mb-1.5">
                        Urutan Pertemuan / Modul <span class="text-red-500">*</span>
                    </label>
                    <div class="relative rounded-xl shadow-xs">
                        <input type="number" name="order" id="order" value="{{ old('order', $batch->materials->count() + 1) }}" min="1" required
                            class="w-full px-4 py-2.5 text-sm border rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition @error('order') border-red-500 bg-red-50/50 @else border-gray-300 @enderror">
                    </div>
                    <p class="mt-1 text-xs text-gray-400">Nomor urut penayangan materi pada halaman alumni.</p>
                    @error('order')
                        <p class="mt-1 text-xs text-red-600 font-medium">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Card 2: Digital Resources -->
        <div class="bg-white rounded-2xl border border-gray-200/80 shadow-sm p-6 sm:p-8">
            <div class="flex items-center gap-3 pb-5 border-b border-gray-100 mb-6">
                <div class="w-10 h-10 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center font-bold">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" />
                    </svg>
                </div>
                <div>
                    <h2 class="text-base font-bold text-gray-900">Sumber Daya & Tautan Digital</h2>
                    <p class="text-xs text-gray-500">Tautkan materi slide, catatan notulensi, dan video rekaman sesi.</p>
                </div>
            </div>

            <div class="space-y-6">
                <div>
                    <label for="slide_url" class="block text-xs font-semibold text-gray-700 mb-1.5">
                        URL Slide Presentasi <span class="text-gray-400 font-normal">(opsional)</span>
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-gray-400">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z" />
                            </svg>
                        </div>
                        <input type="url" name="slide_url" id="slide_url" value="{{ old('slide_url') }}"
                            class="w-full pl-10 pr-4 py-2.5 text-sm border rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition @error('slide_url') border-red-500 bg-red-50/50 @else border-gray-300 @enderror"
                            placeholder="https://docs.google.com/presentation/d/... atau Canva">
                    </div>
                    <p class="mt-1 text-xs text-gray-400">Google Slides, Canva, Microsoft PowerPoint Online, dsb.</p>
                    @error('slide_url')
                        <p class="mt-1 text-xs text-red-600 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="notes_url" class="block text-xs font-semibold text-gray-700 mb-1.5">
                        URL Catatan / Dokumen Notulensi <span class="text-gray-400 font-normal">(opsional)</span>
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-gray-400">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </div>
                        <input type="url" name="notes_url" id="notes_url" value="{{ old('notes_url') }}"
                            class="w-full pl-10 pr-4 py-2.5 text-sm border rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition @error('notes_url') border-red-500 bg-red-50/50 @else border-gray-300 @enderror"
                            placeholder="https://docs.google.com/document/d/... atau link PDF">
                    </div>
                    <p class="mt-1 text-xs text-gray-400">Google Docs, Notion, PDF Google Drive, dsb.</p>
                    @error('notes_url')
                        <p class="mt-1 text-xs text-red-600 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="video_url" class="block text-xs font-semibold text-gray-700 mb-1.5">
                        URL Video Rekaman <span class="text-gray-400 font-normal">(opsional)</span>
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-gray-400">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <input type="url" name="video_url" id="video_url" value="{{ old('video_url') }}"
                            class="w-full pl-10 pr-4 py-2.5 text-sm border rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition @error('video_url') border-red-500 bg-red-50/50 @else border-gray-300 @enderror"
                            placeholder="https://www.youtube.com/watch?v=... atau YouTube Shorts/Vimeo">
                    </div>
                    <p class="mt-1 text-xs text-gray-400">Tautan video YouTube, Vimeo, atau Google Drive rekaman.</p>
                    @error('video_url')
                        <p class="mt-1 text-xs text-red-600 font-medium">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Form Actions -->
        <div class="flex items-center justify-end gap-3 pt-2">
            <a href="{{ route('admin.batches.materials.index', $batch) }}"
                class="px-5 py-2.5 rounded-xl border border-gray-300 bg-white text-gray-700 font-semibold text-sm hover:bg-gray-50 shadow-sm transition">
                Batal
            </a>
            <button type="submit"
                class="inline-flex items-center gap-2 px-6 py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-semibold text-sm shadow-sm transition">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
                Simpan Materi
            </button>
        </div>
    </form>
</div>
@endsection
