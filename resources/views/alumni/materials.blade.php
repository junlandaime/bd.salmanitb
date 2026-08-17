@extends('layouts.app')

@section('title', 'Materi ' . $batch->nama_batch . ' - ' . $batch->activity->title)

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
                    <span class="text-white">{{ $batch->activity->title }}</span>
                    <span>/</span>
                    <span class="text-emerald-300 font-semibold">{{ $batch->nama_batch }}</span>
                </nav>

                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                    <div>
                        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-emerald-500/20 border border-emerald-400/30 text-emerald-300 text-xs font-semibold mb-2">
                            <span>#{{ $batch->batch_ke ?: '1' }}</span>
                            <span>&bull;</span>
                            <span>{{ $batch->activity->title }}</span>
                        </div>
                        <h1 class="text-2xl sm:text-3xl font-bold tracking-tight text-white">
                            Materi Pembelajaran: {{ $batch->nama_batch }}
                        </h1>
                        <p class="text-xs sm:text-sm text-slate-300 mt-1 flex items-center gap-2">
                            <svg class="w-4 h-4 text-emerald-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <span>Periode Kegiatan: {{ $batch->tanggal_mulai_kegiatan ? $batch->tanggal_mulai_kegiatan->format('d M Y') : '-' }} &ndash; {{ $batch->tanggal_selesai_kegiatan ? $batch->tanggal_selesai_kegiatan->format('d M Y') : '-' }}</span>
                        </p>
                    </div>

                    <a href="{{ route('alumni.dashboard') }}"
                        class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-white/10 hover:bg-white/20 backdrop-blur text-white text-xs font-semibold border border-white/15 transition shadow-xs self-start md:self-auto">
                        &larr; Kembali ke Dashboard
                    </a>
                </div>
            </div>
        </div>

        @if (session('error'))
            <div class="bg-red-50 border border-red-200 text-red-800 p-4 rounded-2xl shadow-sm flex items-center justify-between" role="alert">
                <span class="text-sm font-medium">{{ session('error') }}</span>
                <button type="button" onclick="this.parentElement.remove()" class="text-red-500 hover:text-red-700">✕</button>
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <!-- Left 2 Cols: Materials List -->
            <div class="lg:col-span-2 space-y-4">
                
                <div class="bg-white rounded-2xl border border-gray-200/80 shadow-sm p-6 sm:p-8">
                    <div class="flex items-center justify-between pb-5 border-b border-gray-100 mb-6">
                        <div>
                            <h2 class="text-lg font-bold text-gray-900">Daftar Modul &amp; Pertemuan</h2>
                            <p class="text-xs text-gray-500 mt-0.5">Akses slide materi, rekaman video sesi, dan catatan resume.</p>
                        </div>
                        <span class="px-3 py-1 bg-emerald-50 text-emerald-700 text-xs font-bold rounded-full border border-emerald-100">
                            {{ $batch->materials->count() }} Modul
                        </span>
                    </div>

                    @if ($batch->materials->isEmpty())
                        <div class="text-center py-16 px-4 bg-gray-50/60 rounded-2xl border border-dashed border-gray-200">
                            <div class="w-16 h-16 rounded-2xl bg-gray-100 text-gray-400 flex items-center justify-center mx-auto mb-3 text-2xl">
                                📚
                            </div>
                            <h3 class="text-base font-bold text-gray-900">Belum Ada Materi Tersedia</h3>
                            <p class="text-xs text-gray-500 mt-1 max-w-sm mx-auto leading-relaxed">
                                Berkas materi untuk batch ini sedang dipersiapkan oleh tim fasilitator. Silakan cek kembali secara berkala.
                            </p>
                        </div>
                    @else
                        <div class="space-y-3.5">
                            @foreach ($batch->materials as $index => $material)
                                <div class="group bg-gray-50/50 hover:bg-white rounded-2xl border border-gray-200/80 hover:border-emerald-500/60 p-5 transition-all shadow-xs hover:shadow-md flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                                    <div class="flex items-start gap-3.5">
                                        <span class="w-8 h-8 rounded-xl bg-white border border-gray-200 text-emerald-700 font-bold text-xs flex items-center justify-center shrink-0 shadow-2xs group-hover:bg-emerald-600 group-hover:text-white group-hover:border-emerald-600 transition">
                                            {{ $material->order ?: ($index + 1) }}
                                        </span>
                                        <div>
                                            <h4 class="text-sm font-bold text-gray-900 group-hover:text-emerald-700 transition">
                                                {{ $material->title }}
                                            </h4>
                                            @if ($material->description)
                                                <p class="text-xs text-gray-500 mt-1 line-clamp-2 leading-relaxed">
                                                    {{ $material->description }}
                                                </p>
                                            @endif

                                            <div class="flex flex-wrap items-center gap-2 mt-2.5 text-[11px]">
                                                @if ($material->video_url)
                                                    <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-md bg-rose-50 text-rose-700 border border-rose-100 font-medium">
                                                        ▶ Video Sesi
                                                    </span>
                                                @endif
                                                @if ($material->slide_url)
                                                    <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-md bg-blue-50 text-blue-700 border border-blue-100 font-medium">
                                                        📊 Slide Materi
                                                    </span>
                                                @endif
                                                @if ($material->notes_url)
                                                    <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-md bg-amber-50 text-amber-700 border border-amber-100 font-medium">
                                                        📝 Notulensi
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="shrink-0 pt-2 sm:pt-0">
                                        <a href="{{ route('alumni.material.view', ['batchId' => $batch->id, 'materialId' => $material->id]) }}"
                                            class="w-full sm:w-auto inline-flex items-center justify-center gap-1.5 px-4 py-2 rounded-xl bg-white border border-gray-300 group-hover:border-emerald-500 group-hover:bg-emerald-600 group-hover:text-white text-gray-700 font-semibold text-xs transition shadow-2xs">
                                            <span>Buka Detail</span>
                                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>

            </div>

            <!-- Right 1 Col: Batch Summary Sidebar -->
            <div class="space-y-6">
                
                <div class="bg-white rounded-2xl border border-gray-200/80 shadow-sm p-6">
                    <h3 class="text-sm font-bold text-gray-900 pb-3 border-b border-gray-100 mb-4">Informasi Batch</h3>
                    
                    <div class="space-y-3.5 text-xs">
                        <div>
                            <span class="text-gray-400 block">Nama Program:</span>
                            <span class="text-gray-900 font-semibold mt-0.5 block">{{ $batch->activity->title }}</span>
                        </div>
                        <div>
                            <span class="text-gray-400 block">Nama Batch:</span>
                            <span class="text-gray-900 font-semibold mt-0.5 block">{{ $batch->nama_batch }}</span>
                        </div>
                        <div>
                            <span class="text-gray-400 block">Periode Pelaksanaan:</span>
                            <span class="text-gray-900 font-medium mt-0.5 block">
                                {{ $batch->tanggal_mulai_kegiatan ? $batch->tanggal_mulai_kegiatan->format('d M Y') : '-' }} &ndash; {{ $batch->tanggal_selesai_kegiatan ? $batch->tanggal_selesai_kegiatan->format('d M Y') : '-' }}
                            </span>
                        </div>
                        <div>
                            <span class="text-gray-400 block">Jumlah Materi:</span>
                            <span class="text-emerald-700 font-bold mt-0.5 block">{{ $batch->materials->count() }} Materi</span>
                        </div>
                    </div>
                </div>

                <!-- Help Box -->
                <div class="bg-emerald-50/60 rounded-2xl border border-emerald-100 p-5 text-xs text-emerald-900">
                    <h4 class="font-bold text-emerald-950 mb-1.5 flex items-center gap-1.5">
                        <span>💬</span>
                        <span>Butuh Bantuan?</span>
                    </h4>
                    <p class="text-emerald-800/90 leading-relaxed mb-3">
                        Jika link video atau berkas materi tidak dapat dibuka, silakan hubungi tim fasilitator kami via email.
                    </p>
                    <a href="mailto:bidangdakwah@salmanitb.com" class="font-bold text-emerald-700 hover:underline">
                        bidangdakwah@salmanitb.com &rarr;
                    </a>
                </div>

            </div>

        </div>

    </div>
</div>
@endsection
