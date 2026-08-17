@extends('layouts.app')

@section('title', 'Dashboard Alumni - Bidang Dakwah Salman ITB')

@section('content')
<div class="min-h-screen bg-gray-50/70 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">
        
        <!-- Welcome Hero Card (Contained & Clean) -->
        <div class="bg-gradient-to-br from-emerald-900 via-teal-900 to-slate-900 rounded-3xl text-white p-6 sm:p-8 shadow-lg relative overflow-hidden">
            <!-- Subtle background pattern -->
            <div class="absolute inset-0 opacity-10 bg-[radial-gradient(#fff_1px,transparent_1px)] [background-size:16px_16px]"></div>
            
            <div class="relative z-10 flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">
                <div class="flex items-center gap-4 sm:gap-5">
                    <div class="w-16 h-16 sm:w-20 sm:h-20 rounded-2xl bg-white/10 backdrop-blur border border-white/20 flex items-center justify-center text-2xl sm:text-3xl font-bold text-emerald-300 shadow-inner shrink-0">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>
                    <div>
                        <div class="inline-flex items-center gap-1.5 px-3 py-0.5 rounded-full bg-emerald-500/20 border border-emerald-400/30 text-emerald-300 text-xs font-semibold mb-2">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse"></span>
                            Portal Alumni Resmi
                        </div>
                        <h1 class="text-2xl sm:text-3xl font-bold text-white tracking-tight">
                            Ahlan wa Sahlan, {{ Auth::user()->name }}!
                        </h1>
                        <p class="text-xs sm:text-sm text-slate-300 mt-1">
                            Akses materi pelatihan, riwayat batch kegiatan, dan jejaring dakwah alumni Masjid Salman ITB.
                        </p>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-wrap items-center gap-3 shrink-0">
                    <a href="{{ route('profile.edit') }}" 
                        class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-white/10 hover:bg-white/20 backdrop-blur text-white text-xs font-semibold border border-white/15 transition shadow-sm">
                        <svg class="w-4 h-4 text-emerald-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        <span>Edit Profil</span>
                    </a>
                    <a href="{{ route('taaruf.index') }}" 
                        class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-gradient-to-r from-pink-500 to-rose-500 hover:from-pink-600 hover:to-rose-600 text-white text-xs font-semibold shadow-md shadow-pink-500/20 transition">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                        </svg>
                        <span>Layanan Ta'aruf</span>
                    </a>
                </div>
            </div>

            <!-- Stats Mini Bar -->
            <div class="relative z-10 mt-8 pt-6 border-t border-white/10 grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div class="bg-black/20 backdrop-blur border border-white/10 rounded-2xl p-4">
                    <span class="text-xs text-slate-300 font-medium block">Batch Kegiatan Diikuti</span>
                    <span class="text-2xl font-bold text-white mt-1 block">{{ $batches->count() }} Kegiatan</span>
                </div>
                <div class="bg-black/20 backdrop-blur border border-white/10 rounded-2xl p-4">
                    <span class="text-xs text-slate-300 font-medium block">Total Materi &amp; Modul</span>
                    <span class="text-2xl font-bold text-emerald-300 mt-1 block">
                        {{ $batches->sum(fn($b) => $b->materials->count()) }} Berkas
                    </span>
                </div>
                <div class="bg-black/20 backdrop-blur border border-white/10 rounded-2xl p-4 flex flex-col justify-between">
                    <span class="text-xs text-slate-300 font-medium block">Status Keanggotaan</span>
                    <span class="text-sm font-bold text-emerald-400 mt-2 inline-flex items-center gap-1.5">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                        Alumni Terverifikasi
                    </span>
                </div>
            </div>
        </div>

        @if (session('error'))
            <div class="bg-red-50 border border-red-200 text-red-800 p-4 rounded-2xl shadow-sm flex items-center justify-between" role="alert">
                <div class="flex items-center gap-2 text-sm font-medium">
                    <svg class="w-5 h-5 text-red-500 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span>{{ session('error') }}</span>
                </div>
                <button type="button" onclick="this.parentElement.remove()" class="text-red-500 hover:text-red-700">✕</button>
            </div>
        @endif

        @if (session('success'))
            <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 p-4 rounded-2xl shadow-sm flex items-center justify-between" role="alert">
                <div class="flex items-center gap-2 text-sm font-medium">
                    <svg class="w-5 h-5 text-emerald-600 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    <span>{{ session('success') }}</span>
                </div>
                <button type="button" onclick="this.parentElement.remove()" class="text-emerald-500 hover:text-emerald-700">✕</button>
            </div>
        @endif

        @php
            $activeSpnRegs = \App\Models\SpnRegistration::where('user_id', Auth::id())->with('activityBatch')->latest()->get();
        @endphp

        @if($activeSpnRegs->isNotEmpty())
            <div class="bg-gradient-to-r from-amber-500/10 via-orange-50 to-amber-50 border border-amber-200 rounded-2xl p-4 sm:p-5 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 shadow-2xs">
                <div class="flex items-center gap-3.5">
                    <div class="w-10 h-10 rounded-xl bg-amber-500 text-white flex items-center justify-center text-base font-bold shrink-0 shadow-xs">
                        💛
                    </div>
                    <div>
                        <div class="flex items-center gap-2">
                            <h3 class="text-sm font-bold text-gray-900">Pendaftaran Batch Sekolah Pranikah Aktif</h3>
                            <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-amber-100 text-amber-800 border border-amber-200">
                                {{ $activeSpnRegs->count() }} Pendaftaran
                            </span>
                        </div>
                        <p class="text-xs text-gray-600 mt-0.5">
                            Pantau status verifikasi pembayaran dan administrasi batch SPN yang sedang Anda daftarkan.
                        </p>
                    </div>
                </div>
                <a href="{{ route('peserta.dashboard') }}"
                    class="inline-flex items-center justify-center gap-1.5 px-4 py-2.5 rounded-xl bg-amber-500 hover:bg-amber-600 text-white font-bold text-xs shadow-xs transition shrink-0">
                    <span>Status Pendaftaran SPN</span>
                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </a>
            </div>
        @endif

        <!-- Main Grid Layout -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <!-- Left 2 Columns: Batches List -->
            <div class="lg:col-span-2 space-y-6">
                
                <div class="bg-white rounded-2xl border border-gray-200/80 shadow-sm p-6 sm:p-8">
                    <div class="flex items-center justify-between pb-5 border-b border-gray-100 mb-6">
                        <div>
                            <h2 class="text-lg font-bold text-gray-900">Batch Kegiatan Anda</h2>
                            <p class="text-xs text-gray-500 mt-0.5">Daftar kelas dan program pelatihan yang pernah Anda ikuti.</p>
                        </div>
                        <span class="px-3 py-1 bg-emerald-50 text-emerald-700 text-xs font-bold rounded-full border border-emerald-100">
                            {{ $batches->count() }} Batch Terdaftar
                        </span>
                    </div>

                    @if ($batches->isEmpty())
                        <div class="text-center py-16 px-4 bg-gray-50/60 rounded-2xl border border-dashed border-gray-200">
                            <div class="w-16 h-16 rounded-2xl bg-gray-100 text-gray-400 flex items-center justify-center mx-auto mb-3 text-2xl">
                                📂
                            </div>
                            <h3 class="text-base font-bold text-gray-900">Belum Ada Batch Kegiatan</h3>
                            <p class="text-xs text-gray-500 mt-1 max-w-sm mx-auto leading-relaxed">
                                Anda belum terhubung dengan batch kegiatan manapun. Jika sudah menyelesaikan pelatihan, silakan hubungi tim admin.
                            </p>
                        </div>
                    @else
                        <div class="space-y-4">
                            @foreach ($batches as $batch)
                                <div class="group bg-white rounded-2xl border border-gray-200/80 hover:border-emerald-500/60 hover:shadow-md transition-all p-5 sm:p-6 flex flex-col sm:flex-row sm:items-center justify-between gap-5">
                                    <div class="flex items-start gap-4">
                                        <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-emerald-50 to-teal-100 border border-emerald-200 text-emerald-700 font-bold flex items-center justify-center text-sm shrink-0 shadow-xs">
                                            #{{ $batch->batch_ke ?: '1' }}
                                        </div>
                                        <div>
                                            <div class="flex items-center gap-2">
                                                <span class="text-xs font-semibold text-emerald-700 bg-emerald-50 px-2.5 py-0.5 rounded-full border border-emerald-100">
                                                    {{ $batch->activity->title ?? 'Kegiatan' }}
                                                </span>
                                            </div>
                                            <h3 class="text-base font-bold text-gray-900 group-hover:text-emerald-700 transition mt-1.5">
                                                {{ $batch->nama_batch }}
                                            </h3>
                                            <div class="flex flex-wrap items-center gap-y-1 gap-x-4 mt-2 text-xs text-gray-500">
                                                <span class="flex items-center gap-1.5">
                                                    <svg class="w-3.5 h-3.5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                    </svg>
                                                    {{ $batch->tanggal_mulai_kegiatan ? $batch->tanggal_mulai_kegiatan->format('d M Y') : '-' }} &ndash; {{ $batch->tanggal_selesai_kegiatan ? $batch->tanggal_selesai_kegiatan->format('d M Y') : '-' }}
                                                </span>
                                                <span class="flex items-center gap-1.5 font-medium text-gray-700">
                                                    📁 {{ $batch->materials->count() }} Materi
                                                </span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="shrink-0 pt-2 sm:pt-0">
                                        <a href="{{ route('alumni.batch.materials', $batch->id) }}"
                                            class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-semibold text-xs shadow-sm transition">
                                            <span>Buka Materi</span>
                                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
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

            <!-- Right 1 Column: Profile & Info -->
            <div class="space-y-6">
                
                <!-- Account Profile Card -->
                <div class="bg-white rounded-2xl border border-gray-200/80 shadow-sm p-6">
                    <div class="flex items-center gap-3.5 pb-4 border-b border-gray-100 mb-4">
                        <div class="w-12 h-12 rounded-xl bg-emerald-100 text-emerald-700 flex items-center justify-center font-bold text-base shrink-0">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </div>
                        <div class="min-w-0">
                            <h3 class="text-sm font-bold text-gray-900 truncate">{{ Auth::user()->name }}</h3>
                            <p class="text-xs text-gray-500 truncate">{{ Auth::user()->email }}</p>
                        </div>
                    </div>

                    <div class="space-y-2.5 text-xs">
                        <div class="flex items-center justify-between py-1 text-gray-600">
                            <span>Role Akun:</span>
                            <span class="font-bold text-gray-900 bg-gray-100 px-2 py-0.5 rounded-md">Alumni</span>
                        </div>
                        <div class="flex items-center justify-between py-1 text-gray-600">
                            <span>Bergabung:</span>
                            <span class="font-medium text-gray-900">{{ Auth::user()->created_at ? Auth::user()->created_at->format('d M Y') : '-' }}</span>
                        </div>
                    </div>

                    <div class="mt-5 pt-4 border-t border-gray-100 space-y-2">
                        <a href="{{ route('profile.edit') }}"
                            class="w-full inline-flex items-center justify-center gap-2 px-3.5 py-2 rounded-xl border border-gray-300 bg-white text-gray-700 hover:bg-gray-50 font-semibold text-xs transition shadow-2xs">
                            <svg class="w-3.5 h-3.5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                            </svg>
                            Kelola Akun &amp; Password
                        </a>
                        <a href="{{ route('alumni.feedback.index') }}"
                            class="w-full inline-flex items-center justify-between px-3.5 py-2 rounded-xl border border-teal-200 bg-teal-50 text-teal-700 hover:bg-teal-100 font-semibold text-xs transition">
                            <div class="flex items-center gap-2">
                                <svg class="w-3.5 h-3.5 text-teal-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                                </svg>
                                <span>Feedback &amp; Saran</span>
                            </div>
                            @php
                                $alumniAnsweredCount = \App\Models\Feedback::byUser(auth()->id())->where('status', 'answered')->count();
                            @endphp
                            @if($alumniAnsweredCount > 0)
                                <span class="px-2 py-0.5 text-[10px] font-bold bg-emerald-600 text-white rounded-full">
                                    {{ $alumniAnsweredCount }} Dibalas
                                </span>
                            @endif
                        </a>
                        <a href="{{ route('taaruf.index') }}"
                            class="w-full inline-flex items-center justify-center gap-2 px-3.5 py-2 rounded-xl border border-pink-200 bg-pink-50 text-pink-700 hover:bg-pink-100 font-semibold text-xs transition">
                            <svg class="w-3.5 h-3.5 text-pink-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                            </svg>
                            Program Ta'aruf Keluarga Salman
                        </a>
                    </div>
                </div>

                <!-- Info Help Card -->
                <div class="bg-gradient-to-br from-teal-900 to-emerald-950 rounded-2xl text-white p-6 shadow-sm">
                    <div class="w-8 h-8 rounded-lg bg-white/10 flex items-center justify-center text-sm font-bold text-emerald-300 mb-3">
                        💡
                    </div>
                    <h3 class="text-sm font-bold text-white mb-2">Panduan Hak Akses Materi</h3>
                    <p class="text-xs text-slate-300 leading-relaxed mb-4">
                        Materi, slide, notulensi, dan video rekaman hanya dapat diunduh oleh alumni terverifikasi yang terdaftar pada batch terkait.
                    </p>
                    <div class="pt-3 border-t border-white/10 flex items-center gap-2 text-xs text-emerald-300 font-medium">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                        <a href="mailto:bidangdakwah@salmanitb.com" class="hover:underline">bidangdakwah@salmanitb.com</a>
                    </div>
                </div>

            </div>

        </div>

    </div>
</div>
@endsection
