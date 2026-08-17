@extends('admin.layouts.app')
@section('title', 'Materi Batch ' . $batch->nama_batch . ' - Admin Panel')

@section('content')
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
        
        <!-- Breadcrumb & Header -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
            <div>
                <div class="flex items-center gap-2 text-xs text-gray-500 mb-2">
                    <a href="{{ route('admin.activities.index') }}" class="hover:text-emerald-600 transition">Kegiatan</a>
                    <span>/</span>
                    <a href="{{ route('admin.activities.show', $batch->activity) }}" class="hover:text-emerald-600 transition">{{ $batch->activity->title ?? 'Detail Kegiatan' }}</a>
                    <span>/</span>
                    <span class="text-gray-700 font-medium">Batch {{ $batch->batch_ke }}</span>
                </div>
                <h1 class="text-2xl font-bold text-gray-900">Materi Batch: {{ $batch->nama_batch }}</h1>
                <p class="text-sm text-gray-500 mt-1">
                    Kelola materi pembelajaran, slide presentasi, catatan, dan video rekaman untuk batch ini.
                </p>
            </div>
            
            <div class="flex items-center gap-3">
                <a href="{{ route('admin.activities.show', $batch->activity) }}"
                    class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl border border-gray-300 bg-white text-gray-700 font-semibold text-sm hover:bg-gray-50 shadow-sm transition">
                    <svg class="w-4 h-4 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Kembali ke Kegiatan
                </a>
                <a href="{{ route('admin.batches.materials.create', $batch) }}" 
                    class="inline-flex items-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white px-4 py-2.5 rounded-xl font-semibold text-sm shadow-sm transition">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Tambah Materi Baru
                </a>
            </div>
        </div>

        @if(session('success'))
            <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 px-4 py-3 rounded-xl mb-6 flex items-center justify-between shadow-sm" role="alert">
                <div class="flex items-center gap-2">
                    <svg class="w-5 h-5 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    <span class="text-sm font-medium">{{ session('success') }}</span>
                </div>
                <button type="button" onclick="this.parentElement.remove()" class="text-emerald-500 hover:text-emerald-700">✕</button>
            </div>
        @endif

        <!-- Batch Info Banner -->
        <div class="bg-gradient-to-r from-emerald-50 to-teal-50 border border-emerald-100 rounded-2xl p-5 mb-8 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-xl bg-emerald-600 text-white flex items-center justify-center font-bold text-lg shadow-sm">
                    #{{ $batch->batch_ke }}
                </div>
                <div>
                    <div class="text-xs font-semibold uppercase tracking-wider text-emerald-800">Batch Aktif</div>
                    <div class="text-base font-bold text-gray-900">{{ $batch->nama_batch }}</div>
                    <div class="text-xs text-gray-600 mt-0.5">Kegiatan: <span class="font-medium text-gray-900">{{ $batch->activity->title }}</span></div>
                </div>
            </div>
            <div class="flex items-center gap-4 text-xs">
                <div class="bg-white/80 backdrop-blur px-3.5 py-2 rounded-xl border border-emerald-200/60 shadow-xs">
                    <span class="text-gray-500 block">Total Materi:</span>
                    <span class="font-bold text-gray-900 text-sm">{{ $batch->materials->count() }} item</span>
                </div>
            </div>
        </div>

        <!-- Materials Table Card -->
        @if($batch->materials->count() > 0)
            <div class="bg-white rounded-2xl border border-gray-200/80 shadow-sm overflow-hidden" x-data="materialsList()">
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500">
                        <thead class="text-xs text-gray-600 uppercase bg-gray-50/80 border-b border-gray-200">
                            <tr>
                                <th class="px-6 py-3.5 w-16 text-center">Urutan</th>
                                <th class="px-6 py-3.5">Informasi Materi</th>
                                <th class="px-6 py-3.5">Tautan Sumber Daya</th>
                                <th class="px-6 py-3.5 text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100" id="materials-list">
                            @foreach($batch->materials as $material)
                                <tr class="hover:bg-gray-50/75 transition" data-id="{{ $material->id }}">
                                    <td class="px-6 py-4 text-center">
                                        <span class="inline-flex items-center justify-center w-8 h-8 rounded-xl bg-gray-100 font-bold text-xs text-gray-700 border border-gray-200">
                                            {{ $material->order }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="font-bold text-gray-900 text-base mb-1">{{ $material->title }}</div>
                                        <p class="text-xs text-gray-500 line-clamp-2 max-w-xl leading-relaxed">
                                            {{ $material->description ?: 'Tidak ada deskripsi' }}
                                        </p>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex flex-wrap items-center gap-1.5">
                                            @if($material->slide_url)
                                                <a href="{{ $material->slide_url }}" target="_blank"
                                                    class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg text-xs font-semibold bg-blue-50 text-blue-700 border border-blue-200 hover:bg-blue-100 transition" title="Buka Slide Presentasi">
                                                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z" />
                                                    </svg>
                                                    Slide
                                                </a>
                                            @endif
                                            @if($material->notes_url)
                                                <a href="{{ $material->notes_url }}" target="_blank"
                                                    class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg text-xs font-semibold bg-emerald-50 text-emerald-700 border border-emerald-200 hover:bg-emerald-100 transition" title="Buka Catatan / Notulensi">
                                                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                                    </svg>
                                                    Notes
                                                </a>
                                            @endif
                                            @if($material->video_url)
                                                <a href="{{ $material->video_url }}" target="_blank"
                                                    class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg text-xs font-semibold bg-rose-50 text-rose-700 border border-rose-200 hover:bg-rose-100 transition" title="Tonton Video">
                                                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                    </svg>
                                                    Video
                                                </a>
                                            @endif
                                            @if(!$material->slide_url && !$material->notes_url && !$material->video_url)
                                                <span class="text-xs text-gray-400 italic">Belum ada lampiran</span>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <div class="flex items-center justify-end gap-1">
                                            <a href="{{ route('admin.batches.materials.show', [$batch, $material]) }}"
                                                class="p-1.5 text-gray-400 hover:text-emerald-600 rounded-lg hover:bg-emerald-50 transition" title="Lihat Detail">
                                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                </svg>
                                            </a>
                                            <a href="{{ route('admin.batches.materials.edit', [$batch, $material]) }}"
                                                class="p-1.5 text-gray-400 hover:text-gray-700 rounded-lg hover:bg-gray-100 transition" title="Edit Materi">
                                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                </svg>
                                            </a>
                                            <form action="{{ route('admin.batches.materials.destroy', [$batch, $material]) }}" method="POST" class="inline"
                                                onsubmit="return confirm('Apakah Anda yakin ingin menghapus materi ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="p-1.5 text-red-400 hover:text-red-600 rounded-lg hover:bg-red-50 transition" title="Hapus Materi">
                                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @else
            <!-- Empty State -->
            <div class="bg-white rounded-2xl border border-gray-200/80 shadow-sm p-12 text-center max-w-lg mx-auto">
                <div class="w-16 h-16 bg-emerald-50 text-emerald-600 rounded-2xl flex items-center justify-center mx-auto mb-4 border border-emerald-100">
                    <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-gray-900">Belum Ada Materi</h3>
                <p class="mt-1 text-sm text-gray-500 leading-relaxed">
                    Materi pembelajaran untuk batch ini belum ditambahkan. Tambahkan materi baru agar dapat diakses oleh alumni & peserta.
                </p>
                <div class="mt-6">
                    <a href="{{ route('admin.batches.materials.create', $batch) }}"
                        class="inline-flex items-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white px-5 py-2.5 rounded-xl font-semibold text-sm shadow-sm transition">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        Tambah Materi Sekarang
                    </a>
                </div>
            </div>
        @endif

    </div>
@endsection

@push('scripts')
<script>
    function materialsList() {
        return {
            init() {
                // Future drag and drop hook
            }
        }
    }
</script>
@endpush
