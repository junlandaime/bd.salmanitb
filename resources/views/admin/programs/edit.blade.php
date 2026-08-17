@extends('admin.layouts.app')

@section('content')
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="max-w-5xl mx-auto space-y-8">
            <!-- Header -->
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div class="flex items-center gap-3">
                    <a href="{{ route('admin.programs.index') }}"
                        class="p-2.5 bg-white border border-gray-200 rounded-xl text-gray-500 hover:text-gray-900 hover:bg-gray-50 shadow-sm transition"
                        title="Kembali ke Daftar Program">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                    </a>
                    <div>
                        <div class="flex items-center gap-2">
                            <h1 class="text-2xl font-bold text-gray-900">Edit Program</h1>
                            <span class="px-2.5 py-0.5 text-xs font-semibold rounded-full 
                                @if ($program->status === 'published') bg-emerald-100 text-emerald-800
                                @elseif($program->status === 'draft') bg-amber-100 text-amber-800
                                @else bg-red-100 text-red-800 @endif">
                                {{ ucfirst($program->status) }}
                            </span>
                        </div>
                        <p class="text-sm text-gray-500 mt-0.5">Perbarui detail, topik materi, dan jadwal pelaksanaan program: <strong class="text-gray-700">{{ $program->title }}</strong></p>
                    </div>
                </div>
            </div>

            <!-- Error Notification -->
            @if ($errors->any())
                <div class="bg-red-50 border border-red-200 text-red-800 p-4 rounded-2xl shadow-sm">
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

            <!-- Main Edit Form -->
            <form action="{{ route('admin.programs.update', $program) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PUT')

                <div class="bg-white rounded-2xl border border-gray-200/80 shadow-sm p-6 sm:p-8 space-y-6">
                    <div class="flex items-center gap-2.5 pb-4 border-b border-gray-100">
                        <span class="w-8 h-8 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center font-bold text-sm">
                            📂
                        </span>
                        <div>
                            <h2 class="text-base font-bold text-gray-900">Detail Informasi Program</h2>
                            <p class="text-xs text-gray-500">Perbarui judul, ringkasan, dan status program.</p>
                        </div>
                    </div>

                    <!-- Title -->
                    <div>
                        <label for="title" class="block text-xs font-semibold uppercase tracking-wider text-gray-700 mb-1.5">
                            Nama Program <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="title" id="title" value="{{ old('title', $program->title) }}" required
                            class="w-full rounded-xl border-gray-200 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/20 text-sm py-2.5 px-3.5 bg-gray-50/50 hover:bg-white focus:bg-white text-gray-900 transition">
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
                            class="w-full rounded-xl border-gray-200 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/20 text-sm py-2.5 px-3.5 bg-gray-50/50 hover:bg-white focus:bg-white text-gray-900 transition">{{ old('overview', $program->overview) }}</textarea>
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
                            class="w-full rounded-xl border-gray-200 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/20 text-sm py-2.5 px-3.5 bg-gray-50/50 hover:bg-white focus:bg-white text-gray-900 transition">{{ old('description', $program->description) }}</textarea>
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
                            @if ($program->featured_image)
                                <div class="mb-3 relative group w-fit">
                                    <img src="{{ asset('storage/' . $program->featured_image) }}" alt="{{ $program->title }}"
                                        class="w-48 h-28 object-cover rounded-xl border border-gray-200 shadow-sm">
                                </div>
                            @endif
                            <input type="file" name="featured_image" id="featured_image" accept="image/*"
                                class="w-full text-sm text-gray-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100 border border-gray-200 rounded-xl p-1.5 bg-gray-50/50 transition">
                            <p class="mt-1.5 text-xs text-gray-400">Format: JPG, PNG, WebP (Biarkan kosong jika tidak ingin mengubah)</p>
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
                                <option value="draft" {{ old('status', $program->status) === 'draft' ? 'selected' : '' }}>Draft</option>
                                <option value="published" {{ old('status', $program->status) === 'published' ? 'selected' : '' }}>Published</option>
                                <option value="archived" {{ old('status', $program->status) === 'archived' ? 'selected' : '' }}>Archived</option>
                            </select>
                            @error('status')
                                <p class="mt-1.5 text-xs text-red-600 font-medium">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Action Footer -->
                    <div class="flex items-center justify-end gap-3 pt-4 border-t border-gray-100">
                        <a href="{{ route('admin.programs.index') }}"
                            class="px-5 py-2.5 rounded-xl border border-gray-200 bg-white text-gray-700 font-semibold text-sm hover:bg-gray-50 shadow-sm transition">
                            Batal
                        </a>
                        <button type="submit"
                            class="inline-flex items-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white px-6 py-2.5 rounded-xl font-semibold text-sm shadow-sm hover:shadow transition">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            Perbarui Program
                        </button>
                    </div>
                </div>
            </form>

            <!-- Topics Section -->
            <div class="bg-white rounded-2xl border border-gray-200/80 shadow-sm p-6 sm:p-8">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 pb-4 border-b border-gray-100 mb-6">
                    <div class="flex items-center gap-2.5">
                        <span class="w-8 h-8 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center font-bold text-sm">
                            📚
                        </span>
                        <div>
                            <h2 class="text-base font-bold text-gray-900">Daftar Topik / Silabus</h2>
                            <p class="text-xs text-gray-500">Materi atau tema pembahasan yang dicakup dalam program ini.</p>
                        </div>
                    </div>
                    <a href="{{ route('admin.program-topics.create', ['program_id' => $program->id]) }}"
                        class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl bg-emerald-50 text-emerald-700 hover:bg-emerald-100 font-semibold text-xs transition border border-emerald-200">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        Tambah Topik Baru
                    </a>
                </div>

                <div class="overflow-x-auto rounded-xl border border-gray-100">
                    <table class="w-full text-sm text-left text-gray-500">
                        <thead class="text-xs text-gray-600 uppercase bg-gray-50/80 border-b border-gray-100">
                            <tr>
                                <th class="px-5 py-3 w-16 text-center">Urutan</th>
                                <th class="px-5 py-3">Judul Topik</th>
                                <th class="px-5 py-3">Deskripsi</th>
                                <th class="px-5 py-3 text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse ($program->topics->sortBy('order') as $topic)
                                <tr class="hover:bg-gray-50/75 transition">
                                    <td class="px-5 py-3.5 text-center">
                                        <span class="inline-flex items-center justify-center w-7 h-7 rounded-lg bg-gray-100 text-xs font-bold text-gray-700 font-mono">
                                            #{{ $topic->order }}
                                        </span>
                                    </td>
                                    <td class="px-5 py-3.5 font-semibold text-gray-900">
                                        <div class="flex items-center gap-2">
                                            @if($topic->icon)
                                                <span class="text-xs text-emerald-600 bg-emerald-50 px-2 py-0.5 rounded font-mono">{{ $topic->icon }}</span>
                                            @endif
                                            <span>{{ $topic->title }}</span>
                                        </div>
                                    </td>
                                    <td class="px-5 py-3.5 text-xs text-gray-500 max-w-md">
                                        {{ Str::limit($topic->description, 120) }}
                                    </td>
                                    <td class="px-5 py-3.5 text-right whitespace-nowrap">
                                        <a href="{{ route('admin.program-topics.edit', $topic) }}"
                                            class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg bg-white border border-gray-200 text-gray-700 hover:bg-gray-50 font-medium text-xs shadow-sm transition">
                                            <svg class="w-3.5 h-3.5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                            Edit
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-5 py-8 text-center text-gray-400 text-xs">
                                        Belum ada topik materi yang ditambahkan untuk program ini.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Schedules Section -->
            <div class="bg-white rounded-2xl border border-gray-200/80 shadow-sm p-6 sm:p-8">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 pb-4 border-b border-gray-100 mb-6">
                    <div class="flex items-center gap-2.5">
                        <span class="w-8 h-8 rounded-xl bg-purple-50 text-purple-600 flex items-center justify-center font-bold text-sm">
                            🗓️
                        </span>
                        <div>
                            <h2 class="text-base font-bold text-gray-900">Jadwal Pelaksanaan Rutin</h2>
                            <p class="text-xs text-gray-500">Hari, jam operasional, dan tipe pertemuan rutin program.</p>
                        </div>
                    </div>
                    <a href="{{ route('admin.program-schedules.create', ['program_id' => $program->id]) }}"
                        class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl bg-emerald-50 text-emerald-700 hover:bg-emerald-100 font-semibold text-xs transition border border-emerald-200">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        Tambah Jadwal Baru
                    </a>
                </div>

                <div class="overflow-x-auto rounded-xl border border-gray-100">
                    <table class="w-full text-sm text-left text-gray-500">
                        <thead class="text-xs text-gray-600 uppercase bg-gray-50/80 border-b border-gray-100">
                            <tr>
                                <th class="px-5 py-3">Nama Sesi</th>
                                <th class="px-5 py-3">Hari</th>
                                <th class="px-5 py-3">Waktu</th>
                                <th class="px-5 py-3">Tipe</th>
                                <th class="px-5 py-3 text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse ($program->schedules->sortBy('day') as $schedule)
                                <tr class="hover:bg-gray-50/75 transition">
                                    <td class="px-5 py-3.5 font-semibold text-gray-900">
                                        {{ $schedule->title }}
                                    </td>
                                    <td class="px-5 py-3.5">
                                        <span class="px-2.5 py-1 text-xs font-semibold rounded-lg bg-blue-50 text-blue-700 border border-blue-100">
                                            {{ $schedule->day }}
                                        </span>
                                    </td>
                                    <td class="px-5 py-3.5 text-xs text-gray-600 font-mono">
                                        {{ $schedule->start_time }} - {{ $schedule->end_time }}
                                    </td>
                                    <td class="px-5 py-3.5">
                                        <span class="px-2.5 py-0.5 text-xs font-semibold rounded-full {{ $schedule->type === 'regular' ? 'bg-emerald-50 text-emerald-700' : 'bg-purple-50 text-purple-700' }}">
                                            {{ ucfirst($schedule->type) }}
                                        </span>
                                    </td>
                                    <td class="px-5 py-3.5 text-right whitespace-nowrap">
                                        <a href="{{ route('admin.program-schedules.edit', $schedule) }}"
                                            class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg bg-white border border-gray-200 text-gray-700 hover:bg-gray-50 font-medium text-xs shadow-sm transition">
                                            <svg class="w-3.5 h-3.5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                            Edit
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-5 py-8 text-center text-gray-400 text-xs">
                                        Belum ada jadwal pelaksanaan rutin yang ditambahkan untuk program ini.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
