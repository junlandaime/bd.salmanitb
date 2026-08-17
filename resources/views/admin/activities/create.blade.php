@extends('admin.layouts.app')

@section('content')
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Header -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
            <div>
                <div class="flex items-center gap-2 text-xs text-gray-500 mb-1">
                    <a href="{{ route('admin.activities.index') }}" class="hover:text-emerald-600 transition">Kegiatan</a>
                    <span>/</span>
                    <span class="text-gray-800 font-medium">Buat Baru</span>
                </div>
                <h1 class="text-2xl font-bold text-gray-900">Tambah Kegiatan Baru</h1>
                <p class="text-sm text-gray-500 mt-1">Lengkapi data kegiatan, deskripsi, kurikulum, testimoni, dan FAQ.</p>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('admin.activities.index') }}"
                    class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl border border-gray-300 bg-white text-gray-700 font-semibold text-sm hover:bg-gray-50 shadow-sm transition">
                    <svg class="w-4 h-4 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Kembali
                </a>
            </div>
        </div>

        @if ($errors->any())
            <div class="bg-red-50 border border-red-200 text-red-700 px-5 py-4 rounded-2xl mb-6 shadow-sm" role="alert">
                <div class="flex items-start gap-3">
                    <svg class="w-5 h-5 text-red-500 shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <div>
                        <h4 class="text-sm font-bold text-red-800 mb-1">Terdapat beberapa kesalahan:</h4>
                        <ul class="list-disc list-inside text-xs space-y-0.5">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @endif

        <form action="{{ route('admin.activities.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
            @csrf

            <!-- Basic Information Card -->
            <div class="bg-white rounded-2xl border border-gray-200/80 shadow-sm p-6 sm:p-8">
                <div class="mb-6 pb-4 border-b border-gray-100">
                    <h2 class="text-base font-bold text-gray-900 flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                        Informasi Dasar Kegiatan
                    </h2>
                    <p class="text-xs text-gray-500 mt-0.5">Atur judul, program induk, deskripsi lengkap, serta cover banner kegiatan.</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="program_id" class="block text-xs font-semibold text-gray-700 mb-1.5">Program Induk <span class="text-red-500">*</span></label>
                        <select name="program_id" id="program_id" required
                            class="w-full rounded-xl border border-gray-300 bg-white px-3.5 py-2.5 text-sm text-gray-900 focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 shadow-sm transition">
                            <option value="">-- Pilih Program --</option>
                            @foreach ($programs as $program)
                                <option value="{{ $program->id }}" {{ old('program_id') == $program->id ? 'selected' : '' }}>
                                    {{ $program->title }}
                                </option>
                            @endforeach
                        </select>
                        @error('program_id')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="status" class="block text-xs font-semibold text-gray-700 mb-1.5">Status Publikasi <span class="text-red-500">*</span></label>
                        <select name="status" id="status" required
                            class="w-full rounded-xl border border-gray-300 bg-white px-3.5 py-2.5 text-sm text-gray-900 focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 shadow-sm transition">
                            <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Draft (Konsep)</option>
                            <option value="published" {{ old('status', 'published') == 'published' ? 'selected' : '' }}>Published (Publikasikan)</option>
                            <option value="archived" {{ old('status') == 'archived' ? 'selected' : '' }}>Archived (Arsip)</option>
                        </select>
                        @error('status')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="md:col-span-2">
                        <label for="title" class="block text-xs font-semibold text-gray-700 mb-1.5">Nama / Judul Kegiatan <span class="text-red-500">*</span></label>
                        <input type="text" name="title" id="title" value="{{ old('title') }}" required placeholder="Contoh: Latihan Mujtahid Dakwah 1 (LMD 1)"
                            class="w-full rounded-xl border border-gray-300 bg-white px-3.5 py-2.5 text-sm text-gray-900 focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 shadow-sm transition">
                        @error('title')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="md:col-span-2">
                        <label for="overview" class="block text-xs font-semibold text-gray-700 mb-1.5">Ringkasan Singkat (Overview)</label>
                        <textarea name="overview" id="overview" rows="2" placeholder="Ringkasan 1-2 kalimat mengenai kegiatan ini..."
                            class="w-full rounded-xl border border-gray-300 bg-white px-3.5 py-2.5 text-sm text-gray-900 focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 shadow-sm transition">{{ old('overview') }}</textarea>
                        @error('overview')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="md:col-span-2">
                        <label for="description" class="block text-xs font-semibold text-gray-700 mb-1.5">Deskripsi Lengkap Kegiatan</label>
                        <textarea name="description" id="description" rows="5" placeholder="Jelaskan secara komprehensif mengenai latar belakang, tujuan, dan sasaran kegiatan..."
                            class="w-full rounded-xl border border-gray-300 bg-white px-3.5 py-2.5 text-sm text-gray-900 focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 shadow-sm transition">{{ old('description') }}</textarea>
                        @error('description')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="featured_image" class="block text-xs font-semibold text-gray-700 mb-1.5">Gambar Banner / Cover</label>
                        <input type="file" name="featured_image" id="featured_image" accept="image/*"
                            class="w-full text-xs text-gray-500 file:mr-3 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100 cursor-pointer">
                        <p class="mt-1.5 text-xs text-gray-400">Format yang didukung: JPG, PNG, WEBP. Maks 2MB.</p>
                        @error('featured_image')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center pt-5">
                        <label class="relative flex items-center gap-3 cursor-pointer select-none">
                            <input type="checkbox" name="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }}
                                class="w-4 h-4 rounded border-gray-300 text-emerald-600 focus:ring-emerald-500">
                            <div>
                                <span class="block text-sm font-semibold text-gray-800">Tampilkan sebagai Kegiatan Unggulan</span>
                                <span class="block text-xs text-gray-400">Kegiatan ini akan diprioritaskan di halaman depan / landing page.</span>
                            </div>
                        </label>
                    </div>
                </div>
            </div>

            <!-- Dynamic Components -->
            @include('admin.activities.components.learning-paths')
            @include('admin.activities.components.highlights')
            @include('admin.activities.components.testimonials')
            @include('admin.activities.components.gallery')
            @include('admin.activities.components.faqs')

            <!-- Sticky/Floating Action Footer -->
            <div class="bg-white rounded-2xl border border-gray-200/80 p-5 shadow-sm flex items-center justify-between gap-4">
                <a href="{{ route('admin.activities.index') }}"
                    class="px-5 py-2.5 rounded-xl border border-gray-300 bg-white text-gray-700 font-semibold text-sm hover:bg-gray-50 transition">
                    Batal
                </a>
                <button type="submit"
                    class="inline-flex items-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white px-6 py-2.5 rounded-xl font-semibold text-sm shadow-sm transition">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    Simpan Kegiatan
                </button>
            </div>
        </form>
    </div>
@endsection
