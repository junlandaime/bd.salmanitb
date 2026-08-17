@extends('admin.layouts.app')
@section('title', 'Detail Materi: ' . $material->title . ' - Admin Panel')

@section('content')
<div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
    
    <!-- Breadcrumbs & Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
        <div>
            <div class="flex items-center gap-2 text-xs text-gray-500 mb-2">
                <a href="{{ route('admin.activities.index') }}" class="hover:text-emerald-600 transition">Kegiatan</a>
                <span>/</span>
                <a href="{{ route('admin.activities.show', $batch->activity) }}" class="hover:text-emerald-600 transition">{{ $batch->activity->title ?? 'Detail' }}</a>
                <span>/</span>
                <a href="{{ route('admin.batches.materials.index', $batch) }}" class="hover:text-emerald-600 transition">Materi Batch</a>
                <span>/</span>
                <span class="text-gray-700 font-medium">Detail</span>
            </div>
            <h1 class="text-2xl font-bold text-gray-900">{{ $material->title }}</h1>
            <p class="text-sm text-gray-500 mt-1">
                Batch: <span class="font-semibold text-emerald-700">{{ $batch->nama_batch }}</span> &bull; Modul ke-{{ $material->order }}
            </p>
        </div>

        <div class="flex items-center gap-2">
            <a href="{{ route('admin.batches.materials.index', $batch) }}"
                class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl border border-gray-300 bg-white text-gray-700 font-semibold text-sm hover:bg-gray-50 shadow-sm transition">
                <svg class="w-4 h-4 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Daftar Materi
            </a>
            <a href="{{ route('admin.batches.materials.edit', [$batch, $material]) }}"
                class="inline-flex items-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white px-4 py-2.5 rounded-xl font-semibold text-sm shadow-sm transition">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                </svg>
                Edit Materi
            </a>
            <form action="{{ route('admin.batches.materials.destroy', [$batch, $material]) }}" method="POST" class="inline"
                onsubmit="return confirm('Apakah Anda yakin ingin menghapus materi ini?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="p-2.5 text-red-500 hover:text-red-700 rounded-xl hover:bg-red-50 border border-transparent hover:border-red-200 transition" title="Hapus Materi">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                    </svg>
                </button>
            </form>
        </div>
    </div>

    <!-- Main Content Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        <!-- Left 2 Cols: Main Info -->
        <div class="lg:col-span-2 space-y-8">
            
            <!-- Description Card -->
            <div class="bg-white rounded-2xl border border-gray-200/80 shadow-sm p-6 sm:p-8">
                <div class="flex items-center gap-3 pb-4 border-b border-gray-100 mb-5">
                    <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center font-bold">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7" />
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-base font-bold text-gray-900">Deskripsi Materi</h2>
                        <span class="text-xs text-gray-400">Ringkasan silabus dan cakupan materi</span>
                    </div>
                </div>
                <div class="text-sm text-gray-700 leading-relaxed whitespace-pre-line">
                    {{ $material->description ?: 'Tidak ada deskripsi yang dicantumkan untuk materi ini.' }}
                </div>
            </div>

            <!-- Video Preview Card (if present) -->
            @if($material->video_url)
                <div class="bg-white rounded-2xl border border-gray-200/80 shadow-sm p-6 sm:p-8 overflow-hidden">
                    <div class="flex items-center justify-between pb-4 border-b border-gray-100 mb-5">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl bg-rose-50 text-rose-600 flex items-center justify-center font-bold">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div>
                                <h2 class="text-base font-bold text-gray-900">Preview Video Sesi</h2>
                                <span class="text-xs text-gray-400">Rekaman pemaparan materi pembelajaran</span>
                            </div>
                        </div>
                        <a href="{{ $material->video_url }}" target="_blank"
                            class="inline-flex items-center gap-1 text-xs font-semibold text-rose-600 hover:text-rose-700">
                            Buka di Tab Baru
                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                            </svg>
                        </a>
                    </div>
                    
                    <div class="rounded-xl overflow-hidden bg-black aspect-video shadow-inner">
                        <iframe src="{{ str_replace('watch?v=', 'embed/', $material->video_url) }}" 
                                frameborder="0" 
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                                allowfullscreen
                                class="w-full h-full"></iframe>
                    </div>
                </div>
            @endif

        </div>

        <!-- Right 1 Col: Resources & Metadata -->
        <div class="space-y-6">
            
            <!-- Digital Resources Card -->
            <div class="bg-white rounded-2xl border border-gray-200/80 shadow-sm p-6">
                <h3 class="text-sm font-bold text-gray-900 uppercase tracking-wider mb-4 text-xs">Tautan Materi</h3>
                
                <div class="space-y-3">
                    <!-- Slide -->
                    @if($material->slide_url)
                        <a href="{{ $material->slide_url }}" target="_blank"
                            class="flex items-center justify-between p-3.5 rounded-xl border border-blue-100 bg-blue-50/50 hover:bg-blue-100/70 transition group">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-lg bg-blue-100 text-blue-700 flex items-center justify-center font-bold">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z" />
                                    </svg>
                                </div>
                                <div>
                                    <div class="text-xs font-bold text-gray-900 group-hover:text-blue-700 transition">Slide Presentasi</div>
                                    <div class="text-[11px] text-gray-500 truncate max-w-[170px]">{{ $material->slide_url }}</div>
                                </div>
                            </div>
                            <svg class="w-4 h-4 text-gray-400 group-hover:text-blue-600 transition" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                            </svg>
                        </a>
                    @else
                        <div class="p-3 rounded-xl bg-gray-50 border border-gray-100 text-xs text-gray-400 flex items-center gap-2">
                            <span class="w-2 h-2 rounded-full bg-gray-300"></span>
                            Tidak ada tautan slide
                        </div>
                    @endif

                    <!-- Notes -->
                    @if($material->notes_url)
                        <a href="{{ $material->notes_url }}" target="_blank"
                            class="flex items-center justify-between p-3.5 rounded-xl border border-emerald-100 bg-emerald-50/50 hover:bg-emerald-100/70 transition group">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-lg bg-emerald-100 text-emerald-700 flex items-center justify-center font-bold">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                </div>
                                <div>
                                    <div class="text-xs font-bold text-gray-900 group-hover:text-emerald-700 transition">Catatan / Notulensi</div>
                                    <div class="text-[11px] text-gray-500 truncate max-w-[170px]">{{ $material->notes_url }}</div>
                                </div>
                            </div>
                            <svg class="w-4 h-4 text-gray-400 group-hover:text-emerald-600 transition" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                            </svg>
                        </a>
                    @else
                        <div class="p-3 rounded-xl bg-gray-50 border border-gray-100 text-xs text-gray-400 flex items-center gap-2">
                            <span class="w-2 h-2 rounded-full bg-gray-300"></span>
                            Tidak ada tautan catatan
                        </div>
                    @endif

                    <!-- Video -->
                    @if($material->video_url)
                        <a href="{{ $material->video_url }}" target="_blank"
                            class="flex items-center justify-between p-3.5 rounded-xl border border-rose-100 bg-rose-50/50 hover:bg-rose-100/70 transition group">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-lg bg-rose-100 text-rose-700 flex items-center justify-center font-bold">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <div>
                                    <div class="text-xs font-bold text-gray-900 group-hover:text-rose-700 transition">Video Rekaman</div>
                                    <div class="text-[11px] text-gray-500 truncate max-w-[170px]">{{ $material->video_url }}</div>
                                </div>
                            </div>
                            <svg class="w-4 h-4 text-gray-400 group-hover:text-rose-600 transition" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                            </svg>
                        </a>
                    @else
                        <div class="p-3 rounded-xl bg-gray-50 border border-gray-100 text-xs text-gray-400 flex items-center gap-2">
                            <span class="w-2 h-2 rounded-full bg-gray-300"></span>
                            Tidak ada tautan video
                        </div>
                    @endif
                </div>
            </div>

            <!-- Meta Details Card -->
            <div class="bg-white rounded-2xl border border-gray-200/80 shadow-sm p-6">
                <h3 class="text-sm font-bold text-gray-900 uppercase tracking-wider mb-4 text-xs">Informasi Detail</h3>
                <div class="space-y-3.5 text-xs">
                    <div class="flex justify-between py-1.5 border-b border-gray-100">
                        <span class="text-gray-500">Nomor Urut</span>
                        <span class="font-bold text-gray-900">#{{ $material->order }}</span>
                    </div>
                    <div class="flex justify-between py-1.5 border-b border-gray-100">
                        <span class="text-gray-500">Batch Kegiatan</span>
                        <span class="font-semibold text-gray-900">{{ $batch->nama_batch }}</span>
                    </div>
                    <div class="flex justify-between py-1.5 border-b border-gray-100">
                        <span class="text-gray-500">Nama Kegiatan</span>
                        <span class="font-semibold text-gray-900 text-right max-w-[140px] truncate">{{ $batch->activity->title }}</span>
                    </div>
                    <div class="flex justify-between py-1.5 border-b border-gray-100">
                        <span class="text-gray-500">Dibuat Pada</span>
                        <span class="text-gray-700 font-medium">{{ $material->created_at->format('d M Y, H:i') }}</span>
                    </div>
                    <div class="flex justify-between py-1.5">
                        <span class="text-gray-500">Terakhir Update</span>
                        <span class="text-gray-700 font-medium">{{ $material->updated_at->format('d M Y, H:i') }}</span>
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>
@endsection
