@extends('admin.layouts.app')

@section('content')
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Header -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
            <div>
                <div class="flex items-center gap-2 text-xs text-gray-500 mb-1">
                    <a href="{{ route('admin.activities.index') }}" class="hover:text-emerald-600 transition">Kegiatan</a>
                    <span>/</span>
                    <a href="{{ route('admin.activities.show', $activity) }}" class="hover:text-emerald-600 transition truncate max-w-xs">{{ $activity->title }}</a>
                    <span>/</span>
                    <span class="text-gray-800 font-medium">Edit</span>
                </div>
                <h1 class="text-2xl font-bold text-gray-900">Edit Kegiatan: {{ $activity->title }}</h1>
                <p class="text-sm text-gray-500 mt-1">Perbarui informasi utama, kurikulum, batch pelaksanaan, dan konten pendukung.</p>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('admin.activities.show', $activity) }}"
                    class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl border border-gray-300 bg-white text-gray-700 font-semibold text-sm hover:bg-gray-50 shadow-sm transition">
                    <svg class="w-4 h-4 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                    Lihat Detail
                </a>
            </div>
        </div>

        @if (session('success'))
            <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 px-5 py-4 rounded-2xl mb-6 flex items-center justify-between shadow-sm" role="alert">
                <div class="flex items-center gap-2.5 text-sm font-medium">
                    <svg class="w-5 h-5 text-emerald-600 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span>{{ session('success') }}</span>
                </div>
                <button type="button" onclick="this.parentElement.remove()" class="text-emerald-500 hover:text-emerald-700 font-bold">✕</button>
            </div>
        @endif

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

        <!-- Main Form -->
        <form action="{{ route('admin.activities.update', $activity) }}" method="POST" enctype="multipart/form-data" class="space-y-8">
            @csrf
            @method('PUT')

            <!-- Basic Information Card -->
            <div class="bg-white rounded-2xl border border-gray-200/80 shadow-sm p-6 sm:p-8">
                <div class="mb-6 pb-4 border-b border-gray-100 flex items-center justify-between">
                    <div>
                        <h2 class="text-base font-bold text-gray-900 flex items-center gap-2">
                            <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                            Informasi Utama Kegiatan
                        </h2>
                        <p class="text-xs text-gray-500 mt-0.5">Perbarui nama, program, status publikasi, dan cover banner.</p>
                    </div>
                    <span class="px-3 py-1 text-xs font-semibold rounded-full 
                        @if ($activity->status === 'published') bg-emerald-50 text-emerald-700 border border-emerald-200/60
                        @elseif($activity->status === 'draft') bg-amber-50 text-amber-700 border border-amber-200/60
                        @else bg-gray-100 text-gray-700 border border-gray-200 @endif">
                        {{ ucfirst($activity->status) }}
                    </span>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="program_id" class="block text-xs font-semibold text-gray-700 mb-1.5">Program Induk <span class="text-red-500">*</span></label>
                        <select name="program_id" id="program_id" required
                            class="w-full rounded-xl border border-gray-300 bg-white px-3.5 py-2.5 text-sm text-gray-900 focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 shadow-sm transition">
                            @foreach ($programs as $program)
                                <option value="{{ $program->id }}" {{ old('program_id', $activity->program_id) == $program->id ? 'selected' : '' }}>
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
                            <option value="draft" {{ old('status', $activity->status) == 'draft' ? 'selected' : '' }}>Draft (Konsep)</option>
                            <option value="published" {{ old('status', $activity->status) == 'published' ? 'selected' : '' }}>Published (Publikasikan)</option>
                            <option value="archived" {{ old('status', $activity->status) == 'archived' ? 'selected' : '' }}>Archived (Arsip)</option>
                        </select>
                        @error('status')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="md:col-span-2">
                        <label for="title" class="block text-xs font-semibold text-gray-700 mb-1.5">Nama / Judul Kegiatan <span class="text-red-500">*</span></label>
                        <input type="text" name="title" id="title" value="{{ old('title', $activity->title) }}" required
                            class="w-full rounded-xl border border-gray-300 bg-white px-3.5 py-2.5 text-sm text-gray-900 focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 shadow-sm transition">
                        @error('title')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="md:col-span-2">
                        <label for="overview" class="block text-xs font-semibold text-gray-700 mb-1.5">Ringkasan Singkat (Overview)</label>
                        <textarea name="overview" id="overview" rows="2"
                            class="w-full rounded-xl border border-gray-300 bg-white px-3.5 py-2.5 text-sm text-gray-900 focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 shadow-sm transition">{{ old('overview', $activity->overview) }}</textarea>
                        @error('overview')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="md:col-span-2">
                        <label for="description" class="block text-xs font-semibold text-gray-700 mb-1.5">Deskripsi Lengkap Kegiatan</label>
                        <textarea name="description" id="description" rows="5"
                            class="w-full rounded-xl border border-gray-300 bg-white px-3.5 py-2.5 text-sm text-gray-900 focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 shadow-sm transition">{{ old('description', $activity->description) }}</textarea>
                        @error('description')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="featured_image" class="block text-xs font-semibold text-gray-700 mb-1.5">Gambar Banner / Cover</label>
                        @if ($activity->featured_image)
                            <div class="mb-3 relative rounded-xl overflow-hidden border border-gray-200 shadow-sm inline-block">
                                <img src="{{ Storage::url($activity->featured_image) }}" alt="{{ $activity->title }}"
                                    class="w-48 h-28 object-cover">
                                <span class="absolute bottom-1 right-1 bg-black/60 text-white text-[10px] px-2 py-0.5 rounded">Cover Saat Ini</span>
                            </div>
                        @endif
                        <input type="file" name="featured_image" id="featured_image" accept="image/*"
                            class="w-full text-xs text-gray-500 file:mr-3 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100 cursor-pointer">
                        <p class="mt-1.5 text-xs text-gray-400">Kosongkan jika tidak ingin mengubah cover banner.</p>
                        @error('featured_image')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center pt-4">
                        <label class="relative flex items-center gap-3 cursor-pointer select-none">
                            <input type="checkbox" name="is_featured" value="1" {{ old('is_featured', $activity->is_featured) ? 'checked' : '' }}
                                class="w-4 h-4 rounded border-gray-300 text-emerald-600 focus:ring-emerald-500">
                            <div>
                                <span class="block text-sm font-semibold text-gray-800">Tampilkan sebagai Kegiatan Unggulan</span>
                                <span class="block text-xs text-gray-400">Kegiatan ini akan diprioritaskan di homepage / carousel promosi.</span>
                            </div>
                        </label>
                    </div>
                </div>

                <div class="mt-8 pt-6 border-t border-gray-100 flex justify-end">
                    <button type="submit"
                        class="inline-flex items-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white px-6 py-2.5 rounded-xl font-semibold text-sm shadow-sm transition">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        Simpan Perubahan Kegiatan
                    </button>
                </div>
            </div>
        </form>

        <!-- Sub-sections Management Grid -->
        <div class="mt-10 space-y-8">
            
            <!-- Learning Paths Section -->
            <div class="bg-white rounded-2xl border border-gray-200/80 shadow-sm p-6 sm:p-8">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-6 pb-4 border-b border-gray-100">
                    <div>
                        <h2 class="text-base font-bold text-gray-900 flex items-center gap-2">
                            <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                            Learning Paths / Silabus Materi
                        </h2>
                        <p class="text-xs text-gray-500 mt-0.5">Daftar tahapan belajar dan pemateri yang terdaftar untuk kegiatan ini.</p>
                    </div>
                    <a href="{{ route('admin.activity-learning-paths.create', ['activity_id' => $activity->id]) }}"
                        class="inline-flex items-center gap-1.5 px-3.5 py-2 rounded-xl bg-emerald-50 text-emerald-700 hover:bg-emerald-100 border border-emerald-200/60 font-semibold text-xs shadow-sm transition">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        Tambah Learning Path
                    </a>
                </div>

                @if ($activity->learningPath->count() > 0)
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        @foreach ($activity->learningPath as $path)
                            <div class="bg-gray-50/70 border border-gray-200/80 rounded-2xl p-4 flex flex-col justify-between hover:border-gray-300 transition">
                                <div>
                                    <div class="flex items-center justify-between gap-2 mb-2">
                                        <span class="px-2 py-0.5 rounded-lg bg-emerald-50 text-emerald-700 font-bold text-[11px] border border-emerald-100">
                                            Modul #{{ $path->order ?? $loop->iteration }}
                                        </span>
                                    </div>
                                    <h3 class="text-sm font-bold text-gray-900">{{ $path->title }}</h3>
                                    <p class="text-xs text-gray-500 mt-1 line-clamp-2">{{ $path->description }}</p>
                                    @if ($path->mentors)
                                        <p class="text-xs text-emerald-700 mt-2 font-medium">👤 {{ $path->mentors }}</p>
                                    @endif
                                </div>
                                <div class="mt-4 pt-3 border-t border-gray-200/60 flex items-center justify-between">
                                    <a href="{{ route('admin.activity-learning-paths.edit', $path) }}"
                                        class="inline-flex items-center gap-1 text-xs font-semibold text-emerald-600 hover:text-emerald-700">
                                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                        Edit
                                    </a>
                                    <form action="{{ route('admin.activity-learning-paths.destroy', $path) }}" method="POST"
                                        onsubmit="return confirm('Hapus learning path ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="inline-flex items-center gap-1 text-xs font-semibold text-red-600 hover:text-red-700">
                                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-8 bg-gray-50/50 border-2 border-dashed border-gray-200 rounded-2xl">
                        <p class="text-sm font-medium text-gray-500">Belum ada learning path yang ditambahkan.</p>
                    </div>
                @endif
            </div>

            <!-- Highlights Section -->
            <div class="bg-white rounded-2xl border border-gray-200/80 shadow-sm p-6 sm:p-8">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-6 pb-4 border-b border-gray-100">
                    <div>
                        <h2 class="text-base font-bold text-gray-900 flex items-center gap-2">
                            <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                            Highlights / Keunggulan Kegiatan
                        </h2>
                        <p class="text-xs text-gray-500 mt-0.5">Keunggulan dan fasilitas unggulan program.</p>
                    </div>
                    <a href="{{ route('admin.activity-highlights.create', ['activity_id' => $activity->id]) }}"
                        class="inline-flex items-center gap-1.5 px-3.5 py-2 rounded-xl bg-emerald-50 text-emerald-700 hover:bg-emerald-100 border border-emerald-200/60 font-semibold text-xs shadow-sm transition">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        Tambah Highlight
                    </a>
                </div>

                @if ($activity->highlights->count() > 0)
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        @foreach ($activity->highlights as $highlight)
                            <div class="bg-gray-50/70 border border-gray-200/80 rounded-2xl p-4 flex flex-col justify-between hover:border-gray-300 transition">
                                <div>
                                    <div class="flex items-center gap-2 mb-1.5">
                                        <span class="text-xs text-emerald-600 bg-emerald-50 px-2 py-0.5 rounded font-mono font-semibold">{{ $highlight->icon ?? 'star' }}</span>
                                        <h3 class="text-sm font-bold text-gray-900">{{ $highlight->title }}</h3>
                                    </div>
                                    <p class="text-xs text-gray-500 line-clamp-2">{{ $highlight->description }}</p>
                                </div>
                                <div class="mt-4 pt-3 border-t border-gray-200/60 flex items-center justify-between">
                                    <a href="{{ route('admin.activity-highlights.edit', $highlight) }}"
                                        class="inline-flex items-center gap-1 text-xs font-semibold text-emerald-600 hover:text-emerald-700">
                                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                        Edit
                                    </a>
                                    <form action="{{ route('admin.activity-highlights.destroy', $highlight) }}" method="POST"
                                        onsubmit="return confirm('Hapus highlight ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="inline-flex items-center gap-1 text-xs font-semibold text-red-600 hover:text-red-700">
                                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-8 bg-gray-50/50 border-2 border-dashed border-gray-200 rounded-2xl">
                        <p class="text-sm font-medium text-gray-500">Belum ada highlight kegiatan.</p>
                    </div>
                @endif
            </div>

            <!-- Testimonials Section -->
            <div class="bg-white rounded-2xl border border-gray-200/80 shadow-sm p-6 sm:p-8">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-6 pb-4 border-b border-gray-100">
                    <div>
                        <h2 class="text-base font-bold text-gray-900 flex items-center gap-2">
                            <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                            Testimoni Alumni & Peserta
                        </h2>
                        <p class="text-xs text-gray-500 mt-0.5">Ulasan dan cerita pengalaman dari peserta.</p>
                    </div>
                    <a href="{{ route('admin.activity-testimonials.create', ['activity_id' => $activity->id]) }}"
                        class="inline-flex items-center gap-1.5 px-3.5 py-2 rounded-xl bg-emerald-50 text-emerald-700 hover:bg-emerald-100 border border-emerald-200/60 font-semibold text-xs shadow-sm transition">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        Tambah Testimoni
                    </a>
                </div>

                @if ($activity->testimonials->count() > 0)
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        @foreach ($activity->testimonials as $testimonial)
                            <div class="bg-gray-50/70 border border-gray-200/80 rounded-2xl p-4 flex flex-col justify-between hover:border-gray-300 transition">
                                <div class="flex items-start gap-3">
                                    @if ($testimonial->image)
                                        <img src="{{ Storage::url($testimonial->image) }}" alt="{{ $testimonial->name }}" class="w-10 h-10 rounded-full object-cover shrink-0 border border-emerald-200">
                                    @else
                                        <div class="w-10 h-10 rounded-full bg-emerald-100 text-emerald-800 font-bold flex items-center justify-center shrink-0 text-xs">
                                            {{ substr($testimonial->name, 0, 2) }}
                                        </div>
                                    @endif
                                    <div class="min-w-0 flex-1">
                                        <h3 class="text-sm font-bold text-gray-900 truncate">{{ $testimonial->name }}</h3>
                                        <p class="text-xs text-emerald-700 font-medium">{{ $testimonial->role }}</p>
                                        <p class="text-xs text-gray-600 mt-2 line-clamp-3 italic">“{{ $testimonial->content }}”</p>
                                    </div>
                                </div>
                                <div class="mt-4 pt-3 border-t border-gray-200/60 flex items-center justify-between">
                                    <a href="{{ route('admin.activity-testimonials.edit', $testimonial) }}"
                                        class="inline-flex items-center gap-1 text-xs font-semibold text-emerald-600 hover:text-emerald-700">
                                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                        Edit
                                    </a>
                                    <form action="{{ route('admin.activity-testimonials.destroy', $testimonial) }}" method="POST"
                                        onsubmit="return confirm('Hapus testimoni ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="inline-flex items-center gap-1 text-xs font-semibold text-red-600 hover:text-red-700">
                                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-8 bg-gray-50/50 border-2 border-dashed border-gray-200 rounded-2xl">
                        <p class="text-sm font-medium text-gray-500">Belum ada testimoni kegiatan.</p>
                    </div>
                @endif
            </div>

            <!-- Gallery Section -->
            <div class="bg-white rounded-2xl border border-gray-200/80 shadow-sm p-6 sm:p-8">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-6 pb-4 border-b border-gray-100">
                    <div>
                        <h2 class="text-base font-bold text-gray-900 flex items-center gap-2">
                            <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                            Galeri Foto Dokumentasi
                        </h2>
                        <p class="text-xs text-gray-500 mt-0.5">Dokumentasi momen kegiatan dan interaksi peserta.</p>
                    </div>
                    <a href="{{ route('admin.activity-gallery.create', ['activity_id' => $activity->id]) }}"
                        class="inline-flex items-center gap-1.5 px-3.5 py-2 rounded-xl bg-emerald-50 text-emerald-700 hover:bg-emerald-100 border border-emerald-200/60 font-semibold text-xs shadow-sm transition">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        Tambah Foto
                    </a>
                </div>

                @if ($activity->gallery->count() > 0)
                    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">
                        @foreach ($activity->gallery as $image)
                            <div class="relative group rounded-2xl overflow-hidden border border-gray-200 shadow-sm bg-gray-100">
                                <img src="{{ Storage::url($image->image) }}" alt="{{ $image->caption ?? $image->title ?? 'Gallery' }}"
                                    class="w-full h-36 object-cover group-hover:scale-105 transition duration-300">
                                
                                <div class="absolute inset-0 bg-black/60 opacity-0 group-hover:opacity-100 transition flex flex-col justify-between p-3">
                                    <p class="text-[11px] text-white font-medium line-clamp-2">{{ $image->caption ?? $image->title }}</p>
                                    <div class="flex items-center justify-between gap-2">
                                        <a href="{{ route('admin.activity-gallery.edit', $image) }}"
                                            class="px-2.5 py-1 rounded-lg bg-white/90 hover:bg-white text-gray-900 font-bold text-xs shadow">
                                            Edit
                                        </a>
                                        <form action="{{ route('admin.activity-gallery.destroy', $image) }}" method="POST"
                                            onsubmit="return confirm('Hapus foto ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="p-1 rounded-lg bg-red-600/90 hover:bg-red-600 text-white">
                                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-8 bg-gray-50/50 border-2 border-dashed border-gray-200 rounded-2xl">
                        <p class="text-sm font-medium text-gray-500">Belum ada foto galeri.</p>
                    </div>
                @endif
            </div>

            <!-- FAQs Section -->
            <div class="bg-white rounded-2xl border border-gray-200/80 shadow-sm p-6 sm:p-8">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-6 pb-4 border-b border-gray-100">
                    <div>
                        <h2 class="text-base font-bold text-gray-900 flex items-center gap-2">
                            <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                            Pertanyaan Umum (FAQ)
                        </h2>
                        <p class="text-xs text-gray-500 mt-0.5">Pertanyaan dan jawaban penting mengenai teknis kegiatan.</p>
                    </div>
                    <a href="{{ route('admin.activity-faqs.create', ['activity_id' => $activity->id]) }}"
                        class="inline-flex items-center gap-1.5 px-3.5 py-2 rounded-xl bg-emerald-50 text-emerald-700 hover:bg-emerald-100 border border-emerald-200/60 font-semibold text-xs shadow-sm transition">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        Tambah FAQ
                    </a>
                </div>

                @if ($activity->faqs->count() > 0)
                    <div class="space-y-3">
                        @foreach ($activity->faqs as $faq)
                            <div class="bg-gray-50/70 border border-gray-200/80 rounded-2xl p-4 flex flex-col justify-between hover:border-gray-300 transition">
                                <div>
                                    <h3 class="text-sm font-bold text-gray-900 flex items-start gap-2">
                                        <span class="text-emerald-600 font-extrabold text-sm">Q:</span>
                                        <span>{{ $faq->question }}</span>
                                    </h3>
                                    <p class="text-xs text-gray-600 mt-1.5 pl-5">{{ $faq->answer }}</p>
                                </div>
                                <div class="mt-4 pt-3 border-t border-gray-200/60 flex items-center justify-between">
                                    <a href="{{ route('admin.activity-faqs.edit', $faq) }}"
                                        class="inline-flex items-center gap-1 text-xs font-semibold text-emerald-600 hover:text-emerald-700">
                                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                        Edit
                                    </a>
                                    <form action="{{ route('admin.activity-faqs.destroy', $faq) }}" method="POST"
                                        onsubmit="return confirm('Hapus FAQ ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="inline-flex items-center gap-1 text-xs font-semibold text-red-600 hover:text-red-700">
                                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-8 bg-gray-50/50 border-2 border-dashed border-gray-200 rounded-2xl">
                        <p class="text-sm font-medium text-gray-500">Belum ada FAQ untuk kegiatan ini.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
