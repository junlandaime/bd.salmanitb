@extends('admin.layouts.app')

@section('title', 'Dashboard Utama - Admin Panel')

@section('content')
<div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8 space-y-8">
    
    <!-- ================= 1. HEADER HERO ================= -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div>
            <div class="flex items-center gap-2">
                <span class="inline-flex items-center justify-center w-8 h-8 rounded-xl bg-emerald-100 text-emerald-700 text-sm font-bold">
                    🕌
                </span>
                <h1 class="text-2xl sm:text-3xl font-bold text-gray-900">Dashboard Operasional</h1>
            </div>
            <p class="text-sm text-gray-500 mt-1">
                Pusat kendali dan alur kerja harian portal Bidang Dakwah Masjid Salman ITB &middot; {{ \Carbon\Carbon::now()->isoFormat('dddd, D MMMM Y') }}
            </p>
        </div>
        <div class="flex flex-wrap items-center gap-2.5">
            <a href="{{ route('admin.statistics') }}"
                class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-semibold text-xs shadow-xs transition">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                </svg>
                <span>Statistik &amp; Analitik Global &rarr;</span>
            </a>
            <a href="{{ route('admin.spn.dashboard') }}"
                class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-amber-500 hover:bg-amber-600 text-white font-semibold text-xs shadow-xs transition">
                <span>💛 SPN Admin</span>
            </a>
            <a href="{{ route('admin.taaruf.index') }}"
                class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-pink-600 hover:bg-pink-700 text-white font-semibold text-xs shadow-xs transition">
                <span>❤️ Ta'aruf</span>
            </a>
        </div>
    </div>

    <!-- ================= 2. PUSAT PERHATIAN & TUGAS PENDING (ACTION REQUIRED) ================= -->
    @if($totalPendingActions > 0)
        <div class="bg-gradient-to-r from-amber-500/10 via-amber-50 to-orange-50 border border-amber-200/80 rounded-2xl p-5 shadow-xs">
            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
                <div class="flex items-start gap-3.5">
                    <div class="w-10 h-10 rounded-xl bg-amber-500 text-white flex items-center justify-center shrink-0 shadow-xs text-lg">
                        🔔
                    </div>
                    <div>
                        <div class="flex items-center gap-2">
                            <h2 class="font-bold text-gray-900 text-base">Tindakan Menunggu Respon Admin</h2>
                            <span class="px-2 py-0.5 text-xs font-bold rounded-full bg-amber-500 text-white animate-pulse">
                                {{ $totalPendingActions }} Perlu Diproses
                            </span>
                        </div>
                        <p class="text-xs sm:text-sm text-gray-600 mt-0.5">
                            Terdapat verifikasi bukti pembayaran atau pertanyaan peserta yang membutuhkan tindakan Anda segera.
                        </p>
                    </div>
                </div>

                <div class="flex flex-wrap items-center gap-2.5">
                    @if($pendingActions['spn_pending'] > 0)
                        <a href="{{ route('admin.spn.registrants', ['status' => 'pending']) }}"
                            class="inline-flex items-center gap-2 px-3.5 py-2 rounded-xl bg-white border border-amber-300 text-amber-900 hover:bg-amber-100/60 font-semibold text-xs transition shadow-xs">
                            <span class="w-2 h-2 rounded-full bg-amber-500"></span>
                            <span>{{ $pendingActions['spn_pending'] }} Verifikasi Pembayaran SPN</span>
                            <svg class="w-3.5 h-3.5 text-amber-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        </a>
                    @endif

                    @if($pendingActions['spn_pending_changes'] > 0)
                        <a href="{{ route('admin.spn.pendingChanges') }}"
                            class="inline-flex items-center gap-2 px-3.5 py-2 rounded-xl bg-white border border-indigo-300 text-indigo-900 hover:bg-indigo-50 font-semibold text-xs transition shadow-xs">
                            <span class="w-2 h-2 rounded-full bg-indigo-500"></span>
                            <span>{{ $pendingActions['spn_pending_changes'] }} Perubahan Biodata SPN</span>
                            <svg class="w-3.5 h-3.5 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        </a>
                    @endif

                    @if($pendingActions['taaruf_unanswered'] > 0)
                        <a href="{{ route('admin.taaruf.questions.index') }}"
                            class="inline-flex items-center gap-2 px-3.5 py-2 rounded-xl bg-white border border-pink-300 text-pink-900 hover:bg-pink-50 font-semibold text-xs transition shadow-xs">
                            <span class="w-2 h-2 rounded-full bg-pink-500"></span>
                            <span>{{ $pendingActions['taaruf_unanswered'] }} Pertanyaan Ta'aruf Baru</span>
                            <svg class="w-3.5 h-3.5 text-pink-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        </a>
                    @endif
                </div>
            </div>
        </div>
    @else
        <div class="bg-emerald-50/70 border border-emerald-200/80 rounded-2xl px-5 py-3.5 flex items-center justify-between shadow-xs">
            <div class="flex items-center gap-3">
                <span class="w-7 h-7 rounded-xl bg-emerald-100 text-emerald-700 flex items-center justify-center shrink-0 text-sm font-bold">✓</span>
                <p class="text-xs sm:text-sm font-semibold text-emerald-900">
                    Alur operasional berjalan optimal. Tidak ada verifikasi atau pertanyaan peserta yang pending saat ini.
                </p>
            </div>
            <span class="text-xs font-semibold text-emerald-700 bg-emerald-100 px-2.5 py-1 rounded-full">Semua Terkendali</span>
        </div>
    @endif

    <!-- ================= 3. RINGKASAN STATUS OPERASIONAL UTAMA ================= -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        
        <!-- 1. SPN Card -->
        <div class="bg-white rounded-2xl border border-gray-200/80 p-5 shadow-xs hover:shadow-md transition flex flex-col justify-between">
            <div class="flex items-center justify-between">
                <span class="text-[11px] font-bold text-amber-700 uppercase tracking-wider">Sekolah Pranikah (SPN)</span>
                <span class="w-8 h-8 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center text-sm font-bold">💛</span>
            </div>
            <div class="mt-3">
                <div class="text-2xl font-black text-gray-900">{{ $stats['spn']['total'] }} <span class="text-xs font-normal text-gray-400">pendaftar</span></div>
                <div class="text-xs text-emerald-700 font-semibold mt-0.5">
                    Rp {{ number_format($stats['spn']['total_infak'], 0, ',', '.') }} infak masuk
                </div>
            </div>
            <div class="mt-3 pt-2.5 border-t border-gray-100 flex items-center justify-between text-xs">
                <span class="text-gray-500">{{ $stats['spn']['verified'] }} Terverifikasi</span>
                <a href="{{ route('admin.spn.registrants') }}" class="font-semibold text-amber-600 hover:underline">Data Peserta &rarr;</a>
            </div>
        </div>

        <!-- 2. Database Alumni Card -->
        <div class="bg-white rounded-2xl border border-gray-200/80 p-5 shadow-xs hover:shadow-md transition flex flex-col justify-between">
            <div class="flex items-center justify-between">
                <span class="text-[11px] font-bold text-emerald-700 uppercase tracking-wider">Database Alumni</span>
                <span class="w-8 h-8 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center text-sm font-bold">🎓</span>
            </div>
            <div class="mt-3">
                <div class="text-2xl font-black text-gray-900">{{ number_format($stats['alumni']['total'], 0, ',', '.') }} <span class="text-xs font-normal text-gray-400">alumni</span></div>
                <div class="text-xs text-amber-700 font-bold mt-0.5">
                    <a href="{{ route('admin.batch-alumni.multi-batch') }}" class="hover:underline">
                        🌟 {{ $stats['alumni']['multi_batch_count'] }} Alumni Multi-Batch
                    </a>
                </div>
            </div>
            <div class="mt-3 pt-2.5 border-t border-gray-100 flex items-center justify-between text-xs">
                <a href="{{ route('admin.batch-alumni.multi-batch') }}" class="text-amber-700 font-medium hover:underline">Daftar Multi-Batch</a>
                <a href="{{ route('admin.batch-alumni.index') }}" class="font-semibold text-emerald-600 hover:underline">Kelola &rarr;</a>
            </div>
        </div>

        <!-- 3. Layanan Ta'aruf Card -->
        <div class="bg-white rounded-2xl border border-gray-200/80 p-5 shadow-xs hover:shadow-md transition flex flex-col justify-between">
            <div class="flex items-center justify-between">
                <span class="text-[11px] font-bold text-pink-700 uppercase tracking-wider">Layanan Ta'aruf</span>
                <span class="w-8 h-8 rounded-xl bg-pink-50 text-pink-600 flex items-center justify-center text-sm font-bold">❤️</span>
            </div>
            <div class="mt-3">
                <div class="text-2xl font-black text-gray-900">{{ $stats['taaruf']['total'] }} <span class="text-xs font-normal text-gray-400">profil</span></div>
                <div class="text-xs text-pink-600 font-semibold mt-0.5">{{ $stats['taaruf']['active'] }} Profil Aktif Siap Ta'aruf</div>
            </div>
            <div class="mt-3 pt-2.5 border-t border-gray-100 flex items-center justify-between text-xs">
                <span class="text-gray-500">{{ $stats['taaruf']['male'] }} L &middot; {{ $stats['taaruf']['female'] }} P</span>
                <a href="{{ route('admin.taaruf.index') }}" class="font-semibold text-pink-600 hover:underline">Kelola &rarr;</a>
            </div>
        </div>

        <!-- 4. Materi Pembelajaran & Batch Card -->
        <div class="bg-white rounded-2xl border border-gray-200/80 p-5 shadow-xs hover:shadow-md transition flex flex-col justify-between">
            <div class="flex items-center justify-between">
                <span class="text-[11px] font-bold text-purple-700 uppercase tracking-wider">Materi &amp; Pelatihan</span>
                <span class="w-8 h-8 rounded-xl bg-purple-50 text-purple-600 flex items-center justify-center text-sm font-bold">📚</span>
            </div>
            <div class="mt-3">
                <div class="text-2xl font-black text-gray-900">{{ $stats['batches']['active'] }} <span class="text-xs font-normal text-gray-400">batch aktif</span></div>
                <div class="text-xs text-purple-600 font-semibold mt-0.5">{{ $stats['batches']['total'] }} Total Angkatan Kegiatan</div>
            </div>
            <div class="mt-3 pt-2.5 border-t border-gray-100 flex items-center justify-between text-xs">
                <span class="text-gray-500">{{ $stats['articles']['published'] + $stats['news']['published'] }} Publikasi Terbit</span>
                <a href="{{ route('admin.batches.index') }}" class="font-semibold text-purple-600 hover:underline">Lihat Batch &rarr;</a>
            </div>
        </div>

    </div>

    <!-- ================= 4. MONITORING BATCH AKTIF (REGISTRATION TRACKING) ================= -->
    <div class="bg-white rounded-2xl border border-gray-200/80 p-6 shadow-xs">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2 pb-5 border-b border-gray-100">
            <div>
                <h2 class="text-base font-bold text-gray-900 flex items-center gap-2">
                    <span>🎯</span>
                    <span>Monitoring Batch &amp; Kegiatan yang Sedang Berjalan</span>
                </h2>
                <p class="text-xs text-gray-500 mt-0.5">Pantau durasi masa pendaftaran, persentase kuota terisi, dan berkas materi kegiatan.</p>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('admin.activities.index') }}" class="text-xs font-semibold text-emerald-600 hover:text-emerald-700 hover:underline">
                    + Buat Batch Baru
                </a>
                <span class="text-gray-300">&bull;</span>
                <a href="{{ route('admin.batches.index') }}" class="text-xs font-semibold text-gray-600 hover:text-gray-900 hover:underline">
                    Kelola Semua Batch &rarr;
                </a>
            </div>
        </div>

        <div class="mt-5 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
            @forelse($activeBatches as $b)
                <div class="rounded-xl border border-gray-200 p-4 bg-gray-50/50 hover:bg-white hover:border-amber-300 hover:shadow-sm transition flex flex-col justify-between">
                    <div>
                        <div class="flex items-center justify-between gap-2">
                            <span class="px-2 py-0.5 rounded-md text-[10px] font-bold uppercase bg-emerald-100 text-emerald-800">
                                {{ $b->activity->title ?? 'Kegiatan' }}
                            </span>
                            @if(!is_null($b->days_remaining))
                                @if($b->days_remaining > 0)
                                    <span class="text-[11px] font-semibold text-amber-700 bg-amber-50 border border-amber-200 px-2 py-0.5 rounded-full">
                                        ⏳ {{ $b->days_remaining }} hari lagi
                                    </span>
                                @elseif($b->days_remaining === 0)
                                    <span class="text-[11px] font-bold text-rose-700 bg-rose-50 border border-rose-200 px-2 py-0.5 rounded-full">
                                        Hari Terakhir
                                    </span>
                                @else
                                    <span class="text-[11px] font-semibold text-gray-500 bg-gray-100 px-2 py-0.5 rounded-full">
                                        Ditutup
                                    </span>
                                @endif
                            @endif
                        </div>

                        <h4 class="font-bold text-gray-900 text-sm mt-2.5">
                            {{ $b->nama_batch ?? 'Batch ' . $b->batch_ke }}
                        </h4>

                        <div class="mt-2 text-xs text-gray-500 space-y-1">
                            <div class="flex items-center justify-between">
                                <span>Pendaftaran:</span>
                                <span class="font-semibold text-gray-700">
                                    {{ $b->tanggal_mulai_pendaftaran ? $b->tanggal_mulai_pendaftaran->format('d M') : '-' }} s/d {{ $b->tanggal_selesai_pendaftaran ? $b->tanggal_selesai_pendaftaran->format('d M Y') : '-' }}
                                </span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span>Kegiatan:</span>
                                <span class="font-semibold text-gray-700">
                                    {{ $b->tanggal_mulai_kegiatan ? $b->tanggal_mulai_kegiatan->format('d M') : '-' }} s/d {{ $b->tanggal_selesai_kegiatan ? $b->tanggal_selesai_kegiatan->format('d M Y') : '-' }}
                                </span>
                            </div>
                        </div>

                        <!-- Progress Kuota -->
                        <div class="mt-4">
                            <div class="flex items-center justify-between text-xs mb-1">
                                <span class="font-medium text-gray-600">Keterisian Kuota:</span>
                                <span class="font-bold text-gray-900">
                                    {{ $b->registrations_count }} / {{ $b->kuota > 0 ? $b->kuota : '∞' }}
                                    @if($b->kuota > 0)
                                        <span class="text-gray-400 font-normal">({{ $b->percentage }}%)</span>
                                    @endif
                                </span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2 overflow-hidden">
                                <div class="bg-amber-500 h-2 rounded-full transition-all duration-500" style="width: {{ $b->percentage }}%"></div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-4 pt-3 border-t border-gray-100 flex items-center justify-between">
                        <span class="text-[11px] text-gray-500 font-medium">{{ $b->materials_count }} Materi batch</span>
                        <a href="{{ route('admin.spn.registrants', ['batch_id' => $b->id]) }}"
                            class="inline-flex items-center gap-1 text-xs font-semibold text-amber-600 hover:text-amber-700 hover:underline">
                            <span>Pendaftar &rarr;</span>
                        </a>
                    </div>
                </div>
            @empty
                <div class="col-span-full py-8 text-center text-gray-400 text-sm bg-gray-50/50 rounded-xl border border-dashed border-gray-200">
                    <p class="text-xl mb-1">📦</p>
                    <p>Saat ini belum ada batch kegiatan yang berstatus aktif.</p>
                    <a href="{{ route('admin.activities.index') }}" class="text-xs text-emerald-600 font-semibold hover:underline mt-2 inline-block">
                        + Buat Batch Kegiatan Baru
                    </a>
                </div>
            @endforelse
        </div>
    </div>

    <!-- ================= 5. LIVE FEEDS: PENDAFTAR SPN TERKINI, TANYA TA'ARUF & KONTEN TERBARU ================= -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        
        <!-- Kolom 1: Pendaftar SPN Terkini -->
        <div class="bg-white rounded-2xl border border-gray-200/80 p-5 shadow-xs flex flex-col justify-between">
            <div>
                <div class="flex items-center justify-between pb-3.5 border-b border-gray-100 mb-3.5">
                    <div>
                        <h3 class="font-bold text-gray-900 text-sm sm:text-base flex items-center gap-1.5">
                            <span>💛</span>
                            <span>Pendaftaran SPN Masuk</span>
                        </h3>
                        <p class="text-[11px] text-gray-400">Transaksi pendaftar terkini</p>
                    </div>
                    <a href="{{ route('admin.spn.registrants') }}" class="text-xs font-semibold text-amber-600 hover:underline">Semua</a>
                </div>

                <div class="divide-y divide-gray-100">
                    @forelse ($recentSpnRegistrations as $reg)
                        <div class="py-3 flex items-center justify-between gap-2">
                            <div class="min-w-0">
                                <div class="flex items-center gap-1.5">
                                    <h4 class="font-bold text-gray-900 text-xs truncate">{{ $reg->nama_lengkap }}</h4>
                                    <span class="font-mono text-[10px] text-gray-400">#{{ $reg->registration_code }}</span>
                                </div>
                                <p class="text-[11px] text-gray-500 mt-0.5">
                                    {{ $reg->activityBatch->nama_batch ?? 'Batch' }} &middot; 
                                    <span class="font-semibold text-gray-700">Rp {{ number_format($reg->total_bayar, 0, ',', '.') }}</span>
                                </p>
                            </div>
                            <div class="flex items-center gap-1.5 shrink-0">
                                @if($reg->status === 'terverifikasi')
                                    <span class="px-2 py-0.5 text-[10px] font-semibold rounded-full bg-emerald-50 text-emerald-700 border border-emerald-200">
                                        OK
                                    </span>
                                @elseif($reg->status === 'ditolak')
                                    <span class="px-2 py-0.5 text-[10px] font-semibold rounded-full bg-rose-50 text-rose-700 border border-rose-200">
                                        Ditolak
                                    </span>
                                @else
                                    <span class="px-2 py-0.5 text-[10px] font-semibold rounded-full bg-amber-50 text-amber-700 border border-amber-200 animate-pulse">
                                        Pending
                                    </span>
                                @endif
                                <a href="{{ route('admin.spn.show', $reg->id) }}"
                                    class="p-1 rounded-lg text-gray-400 hover:text-amber-600 hover:bg-amber-50 transition" title="Lihat">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                                </a>
                            </div>
                        </div>
                    @empty
                        <div class="py-8 text-center text-gray-400 text-xs">Belum ada pendaftaran SPN.</div>
                    @endforelse
                </div>
            </div>
            <div class="mt-3 pt-2.5 border-t border-gray-100 flex items-center justify-between text-xs text-gray-500">
                <span>Total Infak Terverifikasi:</span>
                <span class="font-bold text-gray-900">Rp {{ number_format($stats['spn']['total_infak'], 0, ',', '.') }}</span>
            </div>
        </div>

        <!-- Kolom 2: Pertanyaan Ta'aruf Belum Dijawab -->
        <div class="bg-white rounded-2xl border border-gray-200/80 p-5 shadow-xs flex flex-col justify-between">
            <div>
                <div class="flex items-center justify-between pb-3.5 border-b border-gray-100 mb-3.5">
                    <div>
                        <h3 class="font-bold text-gray-900 text-sm sm:text-base flex items-center gap-1.5">
                            <span>💬</span>
                            <span>Konsultasi Tanya Ta'aruf</span>
                        </h3>
                        <p class="text-[11px] text-gray-400">Pertanyaan masuk dari peserta</p>
                    </div>
                    <a href="{{ route('admin.taaruf.questions.index') }}" class="text-xs font-semibold text-pink-600 hover:underline">Semua</a>
                </div>

                <div class="divide-y divide-gray-100">
                    @forelse ($recentTaarufQuestions as $question)
                        <div class="py-3 flex items-start justify-between gap-2">
                            <div class="min-w-0">
                                <div class="flex items-center gap-1.5 text-xs">
                                    <span class="font-semibold text-gray-900 text-[11px]">
                                        {{ $question->is_anonymous ? 'Anonim' : ($question->askedBy->name ?? 'User') }}
                                    </span>
                                    <span class="text-gray-400">&rarr;</span>
                                    <span class="text-pink-600 font-medium text-[11px] truncate">
                                        {{ $question->profile->full_name ?? 'Profil' }}
                                    </span>
                                </div>
                                <p class="text-[11px] text-gray-600 mt-1 line-clamp-2 italic bg-gray-50 p-1.5 rounded border border-gray-100">
                                    "{{ $question->question }}"
                                </p>
                            </div>
                            <a href="{{ route('admin.taaruf.questions.show', $question->id) }}"
                                class="shrink-0 px-2 py-1 rounded-lg bg-pink-50 hover:bg-pink-100 text-pink-700 font-semibold text-[11px] transition border border-pink-200">
                                Jawab
                            </a>
                        </div>
                    @empty
                        <div class="py-8 text-center text-gray-400 text-xs">
                            <p class="text-lg mb-1">🎉</p>
                            <p>Semua pertanyaan ta'aruf terjawab.</p>
                        </div>
                    @endforelse
                </div>
            </div>
            <div class="mt-3 pt-2.5 border-t border-gray-100 flex items-center justify-between text-xs text-gray-500">
                <span>Total Pertanyaan Masuk:</span>
                <span class="font-bold text-gray-900">{{ $stats['taaruf']['total_questions'] }} Pertanyaan</span>
            </div>
        </div>

        <!-- Kolom 3: Publikasi Artikel & Kabar Dakwah Terkini -->
        <div class="bg-white rounded-2xl border border-gray-200/80 p-5 shadow-xs flex flex-col justify-between">
            <div>
                <div class="flex items-center justify-between pb-3.5 border-b border-gray-100 mb-3.5">
                    <div>
                        <h3 class="font-bold text-gray-900 text-sm sm:text-base flex items-center gap-1.5">
                            <span>📰</span>
                            <span>Publikasi Konten Terkini</span>
                        </h3>
                        <p class="text-[11px] text-gray-400">Artikel &amp; warta berita dakwah</p>
                    </div>
                    <a href="{{ route('admin.articles.create') }}" class="text-xs font-semibold text-emerald-600 hover:underline">+ Tulis</a>
                </div>

                <div class="divide-y divide-gray-100">
                    @forelse ($recentArticles->take(3) as $article)
                        <div class="py-2.5 flex items-center justify-between gap-2">
                            <div class="min-w-0">
                                <div class="flex items-center gap-1.5">
                                    <span class="text-[9px] font-bold uppercase px-1 py-0.5 rounded bg-emerald-50 text-emerald-700">Art</span>
                                    <h4 class="font-semibold text-gray-900 text-xs truncate">{{ $article->title }}</h4>
                                </div>
                                <p class="text-[10px] text-gray-400 mt-0.5">{{ $article->author->name ?? '-' }} &middot; {{ $article->created_at->format('d M Y') }}</p>
                            </div>
                            <span class="px-2 py-0.5 text-[10px] font-semibold rounded-full shrink-0 {{ $article->status === 'published' ? 'bg-emerald-50 text-emerald-700 border border-emerald-200' : 'bg-amber-50 text-amber-700 border border-amber-200' }}">
                                {{ ucfirst($article->status) }}
                            </span>
                        </div>
                    @empty
                        <div class="py-4 text-center text-gray-400 text-xs">Belum ada artikel.</div>
                    @endforelse

                    @foreach ($recentNews->take(2) as $news)
                        <div class="py-2.5 flex items-center justify-between gap-2">
                            <div class="min-w-0">
                                <div class="flex items-center gap-1.5">
                                    <span class="text-[9px] font-bold uppercase px-1 py-0.5 rounded bg-blue-50 text-blue-700">News</span>
                                    <h4 class="font-semibold text-gray-900 text-xs truncate">{{ $news->title }}</h4>
                                </div>
                                <p class="text-[10px] text-gray-400 mt-0.5">{{ $news->author->name ?? '-' }} &middot; {{ $news->created_at->format('d M Y') }}</p>
                            </div>
                            <span class="px-2 py-0.5 text-[10px] font-semibold rounded-full shrink-0 {{ $news->status === 'published' ? 'bg-blue-50 text-blue-700 border border-blue-200' : 'bg-amber-50 text-amber-700 border border-amber-200' }}">
                                {{ ucfirst($news->status) }}
                            </span>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="mt-3 pt-2.5 border-t border-gray-100 flex items-center justify-between text-xs text-gray-500">
                <span>Total Publikasi Terbit:</span>
                <span class="font-bold text-gray-900">{{ $stats['articles']['published'] + $stats['news']['published'] }} Konten</span>
            </div>
        </div>

    </div>

    <!-- ================= 6. PINTASAN AKSI OPERASIONAL & BANNER STATISTIK ================= -->
    <div class="bg-gradient-to-r from-gray-900 via-emerald-950 to-gray-900 rounded-2xl p-6 text-white shadow-md flex flex-col md:flex-row items-center justify-between gap-6">
        <div class="space-y-1.5 text-center md:text-left">
            <div class="flex items-center justify-center md:justify-start gap-2">
                <span class="px-2.5 py-0.5 rounded-full bg-emerald-500/30 border border-emerald-400/40 text-emerald-300 text-xs font-semibold">
                    Analitik Lengkap &amp; Demografi
                </span>
            </div>
            <h3 class="text-lg font-bold text-white">Butuh Analisis Mendalam &amp; Sebaran Demografi Peserta?</h3>
            <p class="text-xs text-gray-300 max-w-xl">
                Buka halaman statistik global untuk melihat grafik sebaran alumni tiap kegiatan, saluran promosi, status profesi, jenjang pendidikan, preferensi pernikahan, hingga rekapitulasi modul materi dakwah.
            </p>
        </div>
        <div class="shrink-0 flex items-center gap-3">
            <a href="{{ route('admin.statistics') }}"
                class="inline-flex items-center gap-2 px-5 py-3 rounded-xl bg-emerald-500 hover:bg-emerald-400 text-gray-900 font-bold text-xs shadow-lg transition">
                <span>Buka Statistik Portal &rarr;</span>
            </a>
        </div>
    </div>

</div>
@endsection
