@extends('layouts.app')

@section('title', $material->title . ' - ' . $batch->nama_batch)

@section('content')
<div class="min-h-screen bg-gray-50/70 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
        
        <!-- Header Card (Contained & Clean) -->
        <div class="bg-gradient-to-br from-emerald-900 via-teal-900 to-slate-900 rounded-3xl text-white p-6 sm:p-8 shadow-lg relative overflow-hidden">
            <div class="absolute inset-0 opacity-10 bg-[radial-gradient(#fff_1px,transparent_1px)] [background-size:16px_16px]"></div>
            
            <div class="relative z-10">
                <!-- Breadcrumbs -->
                <nav class="flex flex-wrap items-center gap-2 text-xs text-emerald-300/80 mb-3 font-medium">
                    <a href="{{ route('alumni.dashboard') }}" class="hover:text-white transition">Dashboard Alumni</a>
                    <span>/</span>
                    <a href="{{ route('alumni.batch.materials', $batch->id) }}" class="hover:text-white transition">{{ $batch->nama_batch }}</a>
                    <span>/</span>
                    <span class="text-white font-semibold truncate max-w-xs">{{ $material->title }}</span>
                </nav>

                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                    <div>
                        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-emerald-500/20 border border-emerald-400/30 text-emerald-300 text-xs font-semibold mb-2">
                            <span>Modul Ke-{{ $material->order ?: 1 }}</span>
                            <span>&bull;</span>
                            <span>{{ $batch->activity->title }}</span>
                        </div>
                        <h1 class="text-2xl sm:text-3xl font-bold tracking-tight text-white">
                            {{ $material->title }}
                        </h1>
                        <p class="text-xs sm:text-sm text-slate-300 mt-1">
                            {{ $batch->nama_batch }} &bull; Masjid Salman ITB
                        </p>
                    </div>

                    <a href="{{ route('alumni.batch.materials', $batch->id) }}"
                        class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-white/10 hover:bg-white/20 backdrop-blur text-white text-xs font-semibold border border-white/15 transition shadow-xs self-start md:self-auto">
                        &larr; Daftar Materi Batch
                    </a>
                </div>
            </div>
        </div>

        @php
            $videoId = null;
            $isGoogleDrive = false;
            $gdriveFileId = null;

            if (!empty($material->video_url)) {
                if (preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/ ]{11})/i', $material->video_url, $match)) {
                    $videoId = $match[1];
                } elseif (strpos($material->video_url, 'drive.google.com') !== false) {
                    $isGoogleDrive = true;
                    if (preg_match('/[-\w]{25,}/', $material->video_url, $gdriveMatch)) {
                        $gdriveFileId = $gdriveMatch[0];
                    }
                }
            }
        @endphp

        <!-- Main Content Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <!-- Left 2 Cols: Video Player & Description -->
            <div class="lg:col-span-2 space-y-6">
                
                <!-- Video Player Card -->
                @if ($material->video_url)
                    <div class="bg-white rounded-2xl border border-gray-200/80 shadow-sm overflow-hidden">
                        <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
                            <h2 class="text-sm font-bold text-gray-900 flex items-center gap-2">
                                <span class="w-2.5 h-2.5 rounded-full bg-rose-500 animate-pulse"></span>
                                Rekaman Video Sesi
                            </h2>
                            <a href="{{ $material->video_url }}" target="_blank"
                                class="text-xs text-emerald-600 hover:text-emerald-700 font-semibold flex items-center gap-1">
                                <span>Buka di Tab Baru</span>
                                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                </svg>
                            </a>
                        </div>
                        
                        <div class="p-4 sm:p-6 bg-slate-950">
                            <!-- Responsive 16:9 Video Wrapper with Bulletproof Padding Ratio -->
                            <div class="relative w-full overflow-hidden rounded-xl bg-black shadow-inner" style="padding-top: 56.25%; min-height: 240px;">
                                @if ($videoId)
                                    <iframe class="absolute inset-0 w-full h-full"
                                        src="https://www.youtube.com/embed/{{ $videoId }}?rel=0"
                                        title="{{ $material->title }}"
                                        frameborder="0"
                                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                        allowfullscreen></iframe>
                                @elseif ($isGoogleDrive && $gdriveFileId)
                                    <iframe class="absolute inset-0 w-full h-full"
                                        src="https://drive.google.com/file/d/{{ $gdriveFileId }}/preview"
                                        title="{{ $material->title }}"
                                        frameborder="0" allowfullscreen></iframe>
                                @else
                                    <div class="absolute inset-0 flex flex-col items-center justify-center text-center p-6 text-slate-400">
                                        <div class="w-12 h-12 rounded-full bg-white/10 flex items-center justify-center text-white mb-3">
                                            ▶
                                        </div>
                                        <h3 class="text-sm font-bold text-white mb-1">Tonton di Platform Penyedia</h3>
                                        <p class="text-xs max-w-sm mb-4">Video dapat diputar melalui tautan berikut:</p>
                                        <a href="{{ $material->video_url }}" target="_blank"
                                            class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-semibold shadow-sm transition">
                                            Buka Video Sekarang &rarr;
                                        </a>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Description Card -->
                <div class="bg-white rounded-2xl border border-gray-200/80 shadow-sm p-6 sm:p-7">
                    <h2 class="text-base font-bold text-gray-900 pb-3 border-b border-gray-100 mb-4">
                        Deskripsi &amp; Rangkuman Materi
                    </h2>
                    @if ($material->description)
                        <div class="text-xs sm:text-sm text-gray-700 max-w-none leading-relaxed whitespace-pre-line">
                            {{ $material->description }}
                        </div>
                    @else
                        <p class="text-xs text-gray-400 italic">Tidak ada deskripsi tambahan untuk materi ini.</p>
                    @endif
                </div>

            </div>

            <!-- Right 1 Col: Downloads & Navigation -->
            <div class="space-y-6">
                
                <!-- Downloadable Resources Card -->
                <div class="bg-white rounded-2xl border border-gray-200/80 shadow-sm p-6">
                    <h3 class="text-sm font-bold text-gray-900 pb-3 border-b border-gray-100 mb-4 flex items-center gap-2">
                        <span>📥</span>
                        <span>Berkas &amp; Sumber Daya</span>
                    </h3>

                    <div class="space-y-3">
                        @if ($material->slide_url)
                            <a href="{{ $material->slide_url }}" target="_blank"
                                class="flex items-center justify-between p-3.5 rounded-xl border border-blue-100 bg-blue-50/50 hover:bg-blue-100/70 transition group">
                                <div class="flex items-center gap-3">
                                    <div class="w-9 h-9 rounded-lg bg-blue-500 text-white flex items-center justify-center font-bold text-sm shadow-2xs">
                                        📊
                                    </div>
                                    <div>
                                        <div class="text-xs font-bold text-gray-900 group-hover:text-blue-700">Slide Presentasi</div>
                                        <div class="text-[11px] text-gray-500">PDF / PPT Materi</div>
                                    </div>
                                </div>
                                <svg class="w-4 h-4 text-blue-500 group-hover:translate-x-0.5 transition" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                </svg>
                            </a>
                        @endif

                        @if ($material->notes_url)
                            <a href="{{ $material->notes_url }}" target="_blank"
                                class="flex items-center justify-between p-3.5 rounded-xl border border-amber-100 bg-amber-50/50 hover:bg-amber-100/70 transition group">
                                <div class="flex items-center gap-3">
                                    <div class="w-9 h-9 rounded-lg bg-amber-500 text-white flex items-center justify-center font-bold text-sm shadow-2xs">
                                        📝
                                    </div>
                                    <div>
                                        <div class="text-xs font-bold text-gray-900 group-hover:text-amber-700">Notulensi / Resume</div>
                                        <div class="text-[11px] text-gray-500">Catatan Pertemuan</div>
                                    </div>
                                </div>
                                <svg class="w-4 h-4 text-amber-500 group-hover:translate-x-0.5 transition" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                </svg>
                            </a>
                        @endif

                        @if (!$material->slide_url && !$material->notes_url && !$material->video_url)
                            <div class="text-center py-6 text-xs text-gray-400 bg-gray-50 rounded-xl">
                                Belum ada berkas lampiran tambahan.
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Step Navigation Card -->
                <div class="bg-white rounded-2xl border border-gray-200/80 shadow-sm p-6">
                    <h3 class="text-sm font-bold text-gray-900 pb-3 border-b border-gray-100 mb-4">Navigasi Modul</h3>
                    
                    @php
                        $materialsList = $batch->materials->values();
                        $currentIndex = $materialsList->search(fn($m) => $m->id === $material->id);
                        $prevMaterial = $currentIndex > 0 ? $materialsList[$currentIndex - 1] : null;
                        $nextMaterial = $currentIndex < $materialsList->count() - 1 ? $materialsList[$currentIndex + 1] : null;
                    @endphp

                    <div class="grid grid-cols-2 gap-2 mb-4">
                        @if ($prevMaterial)
                            <a href="{{ route('alumni.material.view', ['batchId' => $batch->id, 'materialId' => $prevMaterial->id]) }}"
                                class="inline-flex items-center justify-center gap-1.5 p-2.5 rounded-xl border border-gray-300 bg-white hover:bg-gray-50 text-gray-700 text-xs font-semibold transition shadow-2xs">
                                <span>&larr; Modul {{ $prevMaterial->order ?: $currentIndex }}</span>
                            </a>
                        @else
                            <button disabled class="p-2.5 rounded-xl border border-gray-200 bg-gray-50 text-gray-300 text-xs font-medium cursor-not-allowed">
                                &larr; Sebelumnya
                            </button>
                        @endif

                        @if ($nextMaterial)
                            <a href="{{ route('alumni.material.view', ['batchId' => $batch->id, 'materialId' => $nextMaterial->id]) }}"
                                class="inline-flex items-center justify-center gap-1.5 p-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-semibold transition shadow-2xs">
                                <span>Modul {{ $nextMaterial->order ?: ($currentIndex + 2) }} &rarr;</span>
                            </a>
                        @else
                            <button disabled class="p-2.5 rounded-xl border border-gray-200 bg-gray-50 text-gray-300 text-xs font-medium cursor-not-allowed">
                                Selanjutnya &rarr;
                            </button>
                        @endif
                    </div>

                    <a href="{{ route('alumni.batch.materials', $batch->id) }}"
                        class="w-full inline-flex items-center justify-center gap-2 p-2.5 rounded-xl bg-gray-100 hover:bg-gray-200 text-gray-700 text-xs font-semibold transition">
                        <span>Lihat Semua Materi Batch</span>
                    </a>
                </div>

            </div>

        </div>
    </div>
</div>
@endsection
