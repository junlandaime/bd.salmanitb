@extends('admin.layouts.app')

@section('content')
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="max-w-4xl mx-auto">
            <!-- Header -->
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
                <div class="flex items-center gap-3">
                    <a href="{{ route('admin.programs.index') }}"
                        class="p-2.5 bg-white border border-gray-200 rounded-xl text-gray-500 hover:text-gray-900 hover:bg-gray-50 shadow-sm transition"
                        title="Kembali ke Daftar Program">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                    </a>
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900">Tambah Program Baru</h1>
                        <p class="text-sm text-gray-500 mt-0.5">Buat pilar program dakwah dan kegiatan baru di Bidang Dakwah.</p>
                    </div>
                </div>
            </div>

            <!-- Error Notification -->
            @if ($errors->any())
                <div class="bg-red-50 border border-red-200 text-red-800 p-4 rounded-2xl mb-6 shadow-sm">
                    <div class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-red-500 mt-0.5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <div>
                            <h3 class="text-sm font-bold text-red-800">Mohon perbaiki kesalahan berikut:</h3>
                            <ul class="list-disc list-inside text-xs mt-1.5 space-y-1 text-red-700">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @endif

            <form action="{{ route('admin.programs.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf

                <!-- Main Info Card -->
                <div class="bg-white rounded-2xl border border-gray-200/80 shadow-sm p-6 sm:p-8 space-y-6">
                    <div class="flex items-center gap-2.5 pb-4 border-b border-gray-100">
                        <span class="w-8 h-8 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center font-bold text-sm">
                            📂
                        </span>
                        <div>
                            <h2 class="text-base font-bold text-gray-900">Informasi Program</h2>
                            <p class="text-xs text-gray-500">Lengkapi detail judul, ringkasan, dan deskripsi lengkap program.</p>
                        </div>
                    </div>

                    <!-- Title -->
                    <div>
                        <label for="title" class="block text-xs font-semibold uppercase tracking-wider text-gray-700 mb-1.5">
                            Nama Program <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="title" id="title" value="{{ old('title') }}" required
                            placeholder="Contoh: Sekolah Pra Nikah (SPN)"
                            class="w-full rounded-xl border-gray-200 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/20 text-sm py-2.5 px-3.5 bg-gray-50/50 hover:bg-white focus:bg-white text-gray-900 placeholder-gray-400 transition">
                        @error('title')
                            <p class="mt-1.5 text-xs text-red-600 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Overview -->
                    <div>
                        <label for="overview" class="block text-xs font-semibold uppercase tracking-wider text-gray-700 mb-1.5">
                            Ringkasan Singkat (Overview) <span class="text-red-500">*</span>
                        </label>
                        <textarea name="overview" id="overview" rows="3" required
                            placeholder="Penjelasan ringkas program yang akan tampil di kartu pratinjau..."
                            class="w-full rounded-xl border-gray-200 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/20 text-sm py-2.5 px-3.5 bg-gray-50/50 hover:bg-white focus:bg-white text-gray-900 placeholder-gray-400 transition">{{ old('overview') }}</textarea>
                        @error('overview')
                            <p class="mt-1.5 text-xs text-red-600 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Description -->
                    <div>
                        <label for="description" class="block text-xs font-semibold uppercase tracking-wider text-gray-700 mb-1.5">
                            Deskripsi Lengkap <span class="text-red-500">*</span>
                        </label>
                        <textarea name="description" id="description" rows="5" required
                            placeholder="Deskripsi mendalam mengenai latar belakang, visi, dan materi program..."
                            class="w-full rounded-xl border-gray-200 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/20 text-sm py-2.5 px-3.5 bg-gray-50/50 hover:bg-white focus:bg-white text-gray-900 placeholder-gray-400 transition">{{ old('description') }}</textarea>
                        @error('description')
                            <p class="mt-1.5 text-xs text-red-600 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Featured Image & Status Grid -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pt-2">
                        <div>
                            <label for="featured_image" class="block text-xs font-semibold uppercase tracking-wider text-gray-700 mb-1.5">
                                Gambar Sampul / Banner
                            </label>
                            <input type="file" name="featured_image" id="featured_image" accept="image/*"
                                class="w-full text-sm text-gray-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100 border border-gray-200 rounded-xl p-1.5 bg-gray-50/50 transition">
                            <p class="mt-1.5 text-xs text-gray-400">Format: JPG, PNG, WebP (Maks. 2MB)</p>
                            @error('featured_image')
                                <p class="mt-1.5 text-xs text-red-600 font-medium">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="status" class="block text-xs font-semibold uppercase tracking-wider text-gray-700 mb-1.5">
                                Status Publikasi <span class="text-red-500">*</span>
                            </label>
                            <select name="status" id="status"
                                class="w-full rounded-xl border-gray-200 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/20 text-sm py-2.5 px-3.5 bg-gray-50/50 hover:bg-white focus:bg-white text-gray-900 transition">
                                <option value="draft" {{ old('status') === 'draft' ? 'selected' : '' }}>Draft (Disimpan sebagai draft)</option>
                                <option value="published" {{ old('status') === 'published' ? 'selected' : '' }}>Published (Ditampilkan publik)</option>
                                <option value="archived" {{ old('status') === 'archived' ? 'selected' : '' }}>Archived (Diarsipkan)</option>
                            </select>
                            @error('status')
                                <p class="mt-1.5 text-xs text-red-600 font-medium">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Action Footer -->
                <div class="flex items-center justify-end gap-3 pt-2">
                    <a href="{{ route('admin.programs.index') }}"
                        class="px-5 py-2.5 rounded-xl border border-gray-200 bg-white text-gray-700 font-semibold text-sm hover:bg-gray-50 shadow-sm transition">
                        Batal
                    </a>
                    <button type="submit"
                        class="inline-flex items-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white px-6 py-2.5 rounded-xl font-semibold text-sm shadow-sm hover:shadow transition">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        Simpan Program
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
