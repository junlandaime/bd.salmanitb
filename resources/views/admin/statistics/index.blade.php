@extends('admin.layouts.app')

@section('title', 'Statistik & Analitik Portal - Admin Panel')

@section('content')
<div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8 space-y-8">
    
    <!-- ================= 1. HEADER ================= -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <div class="flex items-center gap-2 text-xs text-gray-500 mb-1.5">
                <a href="{{ route('admin.dashboard') }}" class="hover:text-emerald-600 transition">Dashboard Utama</a>
                <span>/</span>
                <span class="text-emerald-700 font-medium">Statistik &amp; Analitik Portal</span>
            </div>
            <div class="flex items-center gap-2.5">
                <span class="inline-flex items-center justify-center w-9 h-9 rounded-xl bg-emerald-100 text-emerald-700 text-lg font-bold">
                    📊
                </span>
                <h1 class="text-2xl sm:text-3xl font-bold text-gray-900">Statistik &amp; Analitik Portal</h1>
            </div>
            <p class="text-sm text-gray-500 mt-1">
                Pusat data agregat metrik kaderisasi alumni, pendaftaran kegiatan, demografi peserta, layanan ta'aruf, dan repositori dakwah.
            </p>
        </div>

        <div class="flex flex-wrap items-center gap-2.5">
            <button type="button" onclick="window.print()"
                class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl border border-gray-300 bg-white text-gray-700 font-semibold text-xs hover:bg-gray-50 shadow-xs transition cursor-pointer">
                <svg class="w-4 h-4 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                </svg>
                <span>Cetak Ringkasan</span>
            </button>
            <a href="{{ route('admin.dashboard') }}"
                class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-semibold text-xs shadow-xs transition">
                <span>&larr; Dashboard Utama</span>
            </a>
        </div>
    </div>

    <!-- ================= 2. EXECUTIVE METRICS CARDS (6 UTAMA) ================= -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-6 gap-4">
        
        <!-- Total Alumni -->
        <div class="bg-white rounded-2xl border border-gray-200/80 p-5 shadow-xs flex flex-col justify-between">
            <div class="flex items-center justify-between">
                <span class="text-[11px] font-bold text-emerald-700 uppercase tracking-wider">Database Alumni</span>
                <span class="w-8 h-8 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center text-sm font-bold">🎓</span>
            </div>
            <div class="mt-3">
                <div class="text-2xl font-black text-gray-900">{{ number_format($totalAlumniRecords, 0, ',', '.') }}</div>
                <div class="text-xs text-emerald-700 font-semibold mt-0.5">Alumni Binaan Salman</div>
            </div>
            <div class="mt-3 pt-2 border-t border-gray-100 text-[11px] text-gray-500">
                <span>{{ number_format($multiBatchAlumniCount, 0, ',', '.') }} Alumni Multi-Batch</span>
            </div>
        </div>

        <!-- Total Infak SPN -->
        <div class="bg-white rounded-2xl border border-gray-200/80 p-5 shadow-xs flex flex-col justify-between">
            <div class="flex items-center justify-between">
                <span class="text-[11px] font-bold text-amber-700 uppercase tracking-wider">Infak SPN</span>
                <span class="w-8 h-8 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center text-sm font-bold">💛</span>
            </div>
            <div class="mt-3">
                <div class="text-xl font-black text-gray-900">Rp {{ number_format($totalSpnInfak, 0, ',', '.') }}</div>
                <div class="text-xs text-amber-700 font-semibold mt-0.5">{{ $verifiedSpnRegistrations }} Terverifikasi</div>
            </div>
            <div class="mt-3 pt-2 border-t border-gray-100 text-[11px] text-gray-500">
                <span>Dari {{ $totalSpnRegistrations }} Pendaftar SPN</span>
            </div>
        </div>

        <!-- Layanan Ta'aruf -->
        <div class="bg-white rounded-2xl border border-gray-200/80 p-5 shadow-xs flex flex-col justify-between">
            <div class="flex items-center justify-between">
                <span class="text-[11px] font-bold text-pink-700 uppercase tracking-wider">Layanan Ta'aruf</span>
                <span class="w-8 h-8 rounded-xl bg-pink-50 text-pink-600 flex items-center justify-center text-sm font-bold">❤️</span>
            </div>
            <div class="mt-3">
                <div class="text-2xl font-black text-gray-900">{{ number_format($totalTaarufProfiles, 0, ',', '.') }}</div>
                <div class="text-xs text-pink-600 font-semibold mt-0.5">{{ $activeTaarufProfiles }} Profil Aktif</div>
            </div>
            <div class="mt-3 pt-2 border-t border-gray-100 text-[11px] text-gray-500">
                <span>{{ $inProcessTaaruf }} Sedang Berproses</span>
            </div>
        </div>

        <!-- Materi Pembelajaran -->
        <div class="bg-white rounded-2xl border border-gray-200/80 p-5 shadow-xs flex flex-col justify-between">
            <div class="flex items-center justify-between">
                <span class="text-[11px] font-bold text-purple-700 uppercase tracking-wider">Materi Dakwah</span>
                <span class="w-8 h-8 rounded-xl bg-purple-50 text-purple-600 flex items-center justify-center text-sm font-bold">📚</span>
            </div>
            <div class="mt-3">
                <div class="text-2xl font-black text-gray-900">{{ number_format($totalMaterials, 0, ',', '.') }}</div>
                <div class="text-xs text-purple-600 font-semibold mt-0.5">Modul Pembelajaran</div>
            </div>
            <div class="mt-3 pt-2 border-t border-gray-100 text-[11px] text-gray-500">
                <span>{{ $materialsWithSlide }} Slide &middot; {{ $materialsWithVideo }} Video</span>
            </div>
        </div>

        <!-- Publikasi Dakwah -->
        <div class="bg-white rounded-2xl border border-gray-200/80 p-5 shadow-xs flex flex-col justify-between">
            <div class="flex items-center justify-between">
                <span class="text-[11px] font-bold text-blue-700 uppercase tracking-wider">Publikasi Konten</span>
                <span class="w-8 h-8 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center text-sm font-bold">📰</span>
            </div>
            <div class="mt-3">
                <div class="text-2xl font-black text-gray-900">{{ $publishedArticles + $publishedNews }}</div>
                <div class="text-xs text-blue-600 font-semibold mt-0.5">{{ $publishedArticles }} Artikel &middot; {{ $publishedNews }} Berita</div>
            </div>
            <div class="mt-3 pt-2 border-t border-gray-100 text-[11px] text-gray-500">
                <span>{{ $totalArticles + $totalNews }} Total Berkas Konten</span>
            </div>
        </div>

        <!-- Pengguna Terdaftar -->
        <div class="bg-white rounded-2xl border border-gray-200/80 p-5 shadow-xs flex flex-col justify-between">
            <div class="flex items-center justify-between">
                <span class="text-[11px] font-bold text-gray-600 uppercase tracking-wider">Akun Pengguna</span>
                <span class="w-8 h-8 rounded-xl bg-gray-100 text-gray-700 flex items-center justify-center text-sm font-bold">👥</span>
            </div>
            <div class="mt-3">
                <div class="text-2xl font-black text-gray-900">{{ number_format($totalUsers, 0, ',', '.') }}</div>
                <div class="text-xs text-emerald-700 font-semibold mt-0.5">{{ number_format($activeUsers, 0, ',', '.') }} Akun Aktif</div>
            </div>
            <div class="mt-3 pt-2 border-t border-gray-100 text-[11px] text-gray-500">
                <span>{{ number_format($inactiveUsers, 0, ',', '.') }} Belum Aktivasi</span>
            </div>
        </div>

    </div>

    <!-- ================= 3. SEKSI KADERISASI & ALUMNI ANALYTICS ================= -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        
        <!-- Top 8 Kegiatan dengan Alumni Terbanyak -->
        <div class="bg-white rounded-2xl border border-gray-200/80 p-6 shadow-xs flex flex-col justify-between">
            <div>
                <div class="flex items-center justify-between pb-4 border-b border-gray-100 mb-5">
                    <div>
                        <h2 class="text-base font-bold text-gray-900 flex items-center gap-2">
                            <span>🎓</span>
                            <span>Sebaran Alumni per Kegiatan Dakwah</span>
                        </h2>
                        <p class="text-xs text-gray-500 mt-0.5">Top program kegiatan dengan jumlah alumni terbanyak yang tercatat di portal.</p>
                    </div>
                    <a href="{{ route('admin.batch-alumni.index') }}" class="text-xs font-semibold text-emerald-600 hover:underline">Kelola &rarr;</a>
                </div>

                <div class="space-y-3.5">
                    @php
                        $maxAlumniCount = $topActivitiesByAlumni->first()->total_alumni ?? 1;
                    @endphp
                    @forelse($topActivitiesByAlumni as $act)
                        @php
                            $pct = $maxAlumniCount > 0 ? round(($act->total_alumni / $maxAlumniCount) * 100) : 0;
                            $overallPct = $totalAlumniRecords > 0 ? round(($act->total_alumni / $totalAlumniRecords) * 100, 1) : 0;
                        @endphp
                        <div>
                            <div class="flex items-center justify-between text-xs mb-1">
                                <span class="font-bold text-gray-900">{{ $act->title }}</span>
                                <span class="font-extrabold text-emerald-700">
                                    {{ number_format($act->total_alumni, 0, ',', '.') }} alumni
                                    <span class="text-gray-400 font-normal">({{ $overallPct }}%)</span>
                                </span>
                            </div>
                            <div class="w-full bg-gray-100 rounded-full h-2.5 overflow-hidden">
                                <div class="bg-emerald-500 h-2.5 rounded-full transition-all duration-700" style="width: {{ $pct }}%"></div>
                            </div>
                        </div>
                    @empty
                        <p class="text-xs text-gray-400 py-6 text-center">Belum ada data kegiatan.</p>
                    @endforelse
                </div>
            </div>

            <div class="mt-5 pt-3 border-t border-gray-100 flex items-center justify-between text-xs text-gray-500">
                <span>Total Seluruh Rekam Alumni:</span>
                <span class="font-bold text-gray-900">{{ number_format($totalAlumniRecords, 0, ',', '.') }} Record</span>
            </div>
        </div>

        <!-- Retensi Alumni & Komposisi Gender -->
        <div class="space-y-6">
            
            <!-- Retensi / Frekuensi Batch -->
            <div class="bg-white rounded-2xl border border-gray-200/80 p-6 shadow-xs">
                <div class="flex items-center justify-between pb-3 border-b border-gray-100 mb-4">
                    <div>
                        <h3 class="text-sm font-bold text-gray-900 flex items-center gap-1.5">
                            <span>🌟</span>
                            <span>Tingkat Retensi &amp; Loyalitas Alumni</span>
                        </h3>
                        <p class="text-xs text-gray-500 mt-0.5">Distribusi keikutsertaan peserta dalam berbagai angkatan batch.</p>
                    </div>
                    <a href="{{ route('admin.batch-alumni.multi-batch') }}" class="text-xs font-semibold text-amber-700 hover:underline">
                        Lihat Multi-Batch &rarr;
                    </a>
                </div>

                <div class="grid grid-cols-2 sm:grid-cols-4 gap-3">
                    <div class="p-3.5 rounded-xl bg-gray-50 border border-gray-200/80 text-center">
                        <span class="text-xs text-gray-500 block">1 Batch Saja</span>
                        <span class="text-lg font-black text-gray-900 block mt-1">{{ number_format($retentionStats['1_batch'], 0, ',', '.') }}</span>
                        <span class="text-[10px] text-gray-400">Akun Peserta</span>
                    </div>
                    <div class="p-3.5 rounded-xl bg-amber-50/70 border border-amber-200/80 text-center">
                        <span class="text-xs text-amber-800 font-semibold block">2 Batch</span>
                        <span class="text-lg font-black text-amber-900 block mt-1">{{ number_format($retentionStats['2_batches'], 0, ',', '.') }}</span>
                        <span class="text-[10px] text-amber-700">Multi-Batch</span>
                    </div>
                    <div class="p-3.5 rounded-xl bg-amber-50/70 border border-amber-200/80 text-center">
                        <span class="text-xs text-amber-800 font-semibold block">3 Batch</span>
                        <span class="text-lg font-black text-amber-900 block mt-1">{{ number_format($retentionStats['3_batches'], 0, ',', '.') }}</span>
                        <span class="text-[10px] text-amber-700">Multi-Batch</span>
                    </div>
                    <div class="p-3.5 rounded-xl bg-amber-100 border border-amber-300 text-center">
                        <span class="text-xs text-amber-900 font-bold block">4+ Batch</span>
                        <span class="text-lg font-black text-amber-900 block mt-1">{{ number_format($retentionStats['4_plus_batches'], 0, ',', '.') }}</span>
                        <span class="text-[10px] text-amber-800 font-semibold">Sangat Loyal</span>
                    </div>
                </div>
            </div>

            <!-- Komposisi Gender Alumni -->
            <div class="bg-white rounded-2xl border border-gray-200/80 p-6 shadow-xs">
                <div class="flex items-center justify-between pb-3 border-b border-gray-100 mb-4">
                    <h3 class="text-sm font-bold text-gray-900 flex items-center gap-1.5">
                        <span>👥</span>
                        <span>Komposisi Gender Alumni Binaan</span>
                    </h3>
                    <span class="text-xs text-gray-400 font-medium">{{ number_format($totalAlumniRecords, 0, ',', '.') }} Total</span>
                </div>

                @php
                    $malePct = $totalAlumniRecords > 0 ? round(($alumniMale / $totalAlumniRecords) * 100, 1) : 0;
                    $femalePct = $totalAlumniRecords > 0 ? round(($alumniFemale / $totalAlumniRecords) * 100, 1) : 0;
                    $unknownPct = $totalAlumniRecords > 0 ? round(($alumniUnknownGender / $totalAlumniRecords) * 100, 1) : 0;
                @endphp

                <div class="space-y-3">
                    <div>
                        <div class="flex justify-between text-xs font-semibold mb-1">
                            <span class="text-blue-800">👨 Ikhwan (Laki-laki)</span>
                            <span class="text-blue-900 font-bold">{{ number_format($alumniMale, 0, ',', '.') }} ({{ $malePct }}%)</span>
                        </div>
                        <div class="w-full bg-blue-100 rounded-full h-2 overflow-hidden">
                            <div class="bg-blue-600 h-2 rounded-full" style="width: {{ $malePct }}%"></div>
                        </div>
                    </div>

                    <div>
                        <div class="flex justify-between text-xs font-semibold mb-1">
                            <span class="text-pink-800">🧕 Akhwat (Perempuan)</span>
                            <span class="text-pink-900 font-bold">{{ number_format($alumniFemale, 0, ',', '.') }} ({{ $femalePct }}%)</span>
                        </div>
                        <div class="w-full bg-pink-100 rounded-full h-2 overflow-hidden">
                            <div class="bg-pink-600 h-2 rounded-full" style="width: {{ $femalePct }}%"></div>
                        </div>
                    </div>

                    @if($alumniUnknownGender > 0)
                        <div>
                            <div class="flex justify-between text-xs font-semibold mb-1">
                                <span class="text-gray-500">⚪ Belum Terdata Gender</span>
                                <span class="text-gray-700 font-bold">{{ number_format($alumniUnknownGender, 0, ',', '.') }} ({{ $unknownPct }}%)</span>
                            </div>
                            <div class="w-full bg-gray-100 rounded-full h-2 overflow-hidden">
                                <div class="bg-gray-400 h-2 rounded-full" style="width: {{ $unknownPct }}%"></div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

        </div>

    </div>

    <!-- ================= 4. DEMOGRAFI PENDAFTAR & EFEKTIVITAS PROMOSI ================= -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        
        <!-- Saluran Informasi -->
        <div class="bg-white rounded-2xl border border-gray-200/80 p-6 shadow-xs">
            <h3 class="text-sm font-bold text-gray-900 pb-3 border-b border-gray-100 mb-4 flex items-center gap-2">
                <span>📣</span>
                <span>Sumber Informasi Pendaftar</span>
            </h3>
            <p class="text-xs text-gray-500 mb-4">Saluran promosi yang paling efektif menarik peserta.</p>

            <div class="space-y-3">
                @php
                    $totalInfo = $infoDariStats->sum('count') ?: 1;
                @endphp
                @forelse($infoDariStats as $item)
                    @php
                        $pct = round(($item->count / $totalInfo) * 100);
                        $label = match(strtolower($item->info_dari)) {
                            'medsos_salman', 'instagram' => 'Instagram / Medsos Salman',
                            'teman' => 'Teman / Keluarga',
                            'influencer' => 'Influencer / KOL',
                            'poster' => 'Poster / Brosur',
                            'website' => 'Website Salman',
                            default => ucfirst(str_replace('_', ' ', $item->info_dari)),
                        };
                    @endphp
                    <div>
                        <div class="flex justify-between text-xs font-semibold mb-1">
                            <span class="text-gray-700">{{ $label }}</span>
                            <span class="text-gray-900 font-bold">{{ $item->count }} ({{ $pct }}%)</span>
                        </div>
                        <div class="w-full bg-gray-100 rounded-full h-2 overflow-hidden">
                            <div class="bg-amber-500 h-2 rounded-full" style="width: {{ $pct }}%"></div>
                        </div>
                    </div>
                @empty
                    <p class="text-xs text-gray-400 py-4 text-center">Belum ada data pendaftar.</p>
                @endforelse
            </div>
        </div>

        <!-- Status Profesi & Pendidikan -->
        <div class="bg-white rounded-2xl border border-gray-200/80 p-6 shadow-xs">
            <h3 class="text-sm font-bold text-gray-900 pb-3 border-b border-gray-100 mb-4 flex items-center gap-2">
                <span>💼</span>
                <span>Status Profesi &amp; Pendidikan</span>
            </h3>
            <p class="text-xs text-gray-500 mb-4">Profil latar belakang peserta yang mendaftar.</p>

            <div class="space-y-4">
                <div>
                    <span class="text-[11px] font-bold text-gray-400 uppercase tracking-wider block mb-2">Status Diri / Profesi:</span>
                    <div class="space-y-2">
                        @php $totalStatus = $statusDiriStats->sum('count') ?: 1; @endphp
                        @forelse($statusDiriStats as $st)
                            @php
                                $pct = round(($st->count / $totalStatus) * 100);
                                $label = match(strtolower($st->status_diri)) {
                                    'mahasiswa' => 'Mahasiswa',
                                    'karyawan' => 'Karyawan / Swasta',
                                    'alumni_itb' => 'Alumni ITB',
                                    'dosen' => 'Dosen / Pengajar',
                                    'umum' => 'Masyarakat Umum',
                                    default => ucfirst(str_replace('_', ' ', $st->status_diri)),
                                };
                            @endphp
                            <div class="flex items-center justify-between text-xs">
                                <span class="text-gray-700 font-medium">{{ $label }}</span>
                                <span class="font-bold text-gray-900 bg-gray-100 px-2 py-0.5 rounded-md">{{ $st->count }} ({{ $pct }}%)</span>
                            </div>
                        @empty
                            <p class="text-xs text-gray-400">Belum ada data.</p>
                        @endforelse
                    </div>
                </div>

                <div class="pt-3 border-t border-gray-100">
                    <span class="text-[11px] font-bold text-gray-400 uppercase tracking-wider block mb-2">Pendidikan Terakhir:</span>
                    <div class="flex flex-wrap gap-1.5">
                        @forelse($educationStats as $edu)
                            <span class="px-2.5 py-1 rounded-lg text-xs font-semibold bg-emerald-50 text-emerald-800 border border-emerald-200">
                                {{ strtoupper($edu->pendidikan) }}: {{ $edu->count }}
                            </span>
                        @empty
                            <span class="text-xs text-gray-400">-</span>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>

        <!-- Preferensi Paket & Pembayaran -->
        <div class="bg-white rounded-2xl border border-gray-200/80 p-6 shadow-xs">
            <h3 class="text-sm font-bold text-gray-900 pb-3 border-b border-gray-100 mb-4 flex items-center gap-2">
                <span>💳</span>
                <span>Metode Pembayaran &amp; Paket</span>
            </h3>
            <p class="text-xs text-gray-500 mb-4">Pilihan paket dan kanal transaksi peserta.</p>

            <div class="space-y-4">
                <div>
                    <span class="text-[11px] font-bold text-gray-400 uppercase tracking-wider block mb-2">Metode Pembayaran:</span>
                    <div class="space-y-2">
                        @php $totalPay = $paymentMethods->sum('count') ?: 1; @endphp
                        @forelse($paymentMethods as $pay)
                            @php
                                $pct = round(($pay->count / $totalPay) * 100);
                                $label = match(strtolower($pay->metode_bayar)) {
                                    'qris' => 'QRIS (Semua Bank / E-Wallet)',
                                    'transfer' => 'Transfer Bank Muamalat',
                                    default => ucfirst($pay->metode_bayar),
                                };
                            @endphp
                            <div class="p-2.5 rounded-xl bg-gray-50 border border-gray-100 flex items-center justify-between text-xs">
                                <span class="font-semibold text-gray-800">{{ $label }}</span>
                                <span class="font-bold text-emerald-700">{{ $pay->count }} ({{ $pct }}%)</span>
                            </div>
                        @empty
                            <p class="text-xs text-gray-400">Belum ada transaksi.</p>
                        @endforelse
                    </div>
                </div>

                <div class="pt-3 border-t border-gray-100">
                    <span class="text-[11px] font-bold text-gray-400 uppercase tracking-wider block mb-2">Pilihan Paket:</span>
                    <div class="space-y-1.5">
                        @forelse($packageStats as $pkg)
                            <div class="flex items-center justify-between text-xs">
                                <span class="text-gray-700">{{ ucfirst(str_replace('_', ' ', $pkg->paket)) }}</span>
                                <span class="font-bold text-gray-900">{{ $pkg->count }} Pendaftar</span>
                            </div>
                        @empty
                            <p class="text-xs text-gray-400">-</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- ================= 5. ANALITIK LAYANAN TA'ARUF ================= -->
    <div class="bg-white rounded-2xl border border-gray-200/80 p-6 shadow-xs">
        <div class="flex items-center justify-between pb-4 border-b border-gray-100 mb-6">
            <div>
                <h2 class="text-base font-bold text-gray-900 flex items-center gap-2">
                    <span>❤️</span>
                    <span>Statistik Layanan Ta'aruf &amp; Pranikah Salman</span>
                </h2>
                <p class="text-xs text-gray-500 mt-0.5">Analisis sebaran demografi, preferensi menikah, dan responsivitas layanan konsultasi.</p>
            </div>
            <a href="{{ route('admin.taaruf.statistics') }}" class="text-xs font-semibold text-pink-600 hover:underline">Detail Statistik Ta'aruf &rarr;</a>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            
            <!-- Rasio Ikhwan vs Akhwat -->
            <div class="p-4 rounded-xl bg-pink-50/40 border border-pink-100 flex flex-col justify-between">
                <div>
                    <span class="text-xs font-bold text-pink-900 block mb-2">Sebaran Gender Ta'aruf</span>
                    <div class="space-y-2 text-xs">
                        <div class="flex justify-between">
                            <span class="text-blue-800 font-semibold">👨 Ikhwan (Laki-laki)</span>
                            <span class="font-bold text-blue-900">{{ $taarufMale }} ({{ $activeTaarufMale }} aktif)</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-pink-800 font-semibold">🧕 Akhwat (Perempuan)</span>
                            <span class="font-bold text-pink-900">{{ $taarufFemale }} ({{ $activeTaarufFemale }} aktif)</span>
                        </div>
                    </div>
                </div>
                <div class="mt-3 pt-2 border-t border-pink-200/60 text-[11px] text-pink-700">
                    <span>Total: {{ $totalTaarufProfiles }} Peserta Terdaftar</span>
                </div>
            </div>

            <!-- Target Tahun Menikah -->
            <div class="p-4 rounded-xl bg-gray-50 border border-gray-200/80 flex flex-col justify-between">
                <div>
                    <span class="text-xs font-bold text-gray-800 block mb-2">Target Tahun Menikah</span>
                    <div class="space-y-1.5 text-xs">
                        @forelse($marriageTargets->take(4) as $target)
                            <div class="flex justify-between">
                                <span class="text-gray-600">Tahun {{ $target->marriage_target_year }}</span>
                                <span class="font-bold text-gray-900">{{ $target->count }} orang</span>
                            </div>
                        @empty
                            <span class="text-gray-400 text-xs">-</span>
                        @endforelse
                    </div>
                </div>
                <div class="mt-3 pt-2 border-t border-gray-200 text-[11px] text-gray-500">
                    <span>Rencana pelaksanaan akad</span>
                </div>
            </div>

            <!-- Skrining Kesiapan -->
            <div class="p-4 rounded-xl bg-gray-50 border border-gray-200/80 flex flex-col justify-between">
                <div>
                    <span class="text-xs font-bold text-gray-800 block mb-2">Kesiapan &amp; Skrining</span>
                    <div class="space-y-1.5 text-xs">
                        @php
                            $smokeFreePct = $totalTaarufProfiles > 0 ? round((($totalTaarufProfiles - $smokerCount) / $totalTaarufProfiles) * 100) : 0;
                            $debtFreePct = $totalTaarufProfiles > 0 ? round((($totalTaarufProfiles - $debtCount) / $totalTaarufProfiles) * 100) : 0;
                        @endphp
                        <div class="flex justify-between">
                            <span class="text-emerald-700 font-medium">✓ Bebas Rokok</span>
                            <span class="font-bold text-emerald-800">{{ $smokeFreePct }}%</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-blue-700 font-medium">✓ Bebas Hutang</span>
                            <span class="font-bold text-blue-800">{{ $debtFreePct }}%</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Memiliki Tanggungan</span>
                            <span class="font-bold text-gray-800">{{ $dependentCount }} orang</span>
                        </div>
                    </div>
                </div>
                <div class="mt-3 pt-2 border-t border-gray-200 text-[11px] text-gray-500">
                    <span>Standar verifikasi kriteria</span>
                </div>
            </div>

            <!-- Interaksi Tanya-Jawab -->
            <div class="p-4 rounded-xl bg-gray-50 border border-gray-200/80 flex flex-col justify-between">
                <div>
                    <span class="text-xs font-bold text-gray-800 block mb-2">Aktivitas Konsultasi</span>
                    <div class="text-2xl font-black text-purple-700">{{ $totalTaarufQuestions }}</div>
                    <span class="text-xs text-purple-600 font-semibold block mt-0.5">Pertanyaan Masuk</span>
                    <div class="mt-2 text-xs flex justify-between">
                        <span class="text-gray-500">Response Rate:</span>
                        <span class="font-bold text-emerald-700">{{ $questionResponseRate }}%</span>
                    </div>
                </div>
                <div class="mt-3 pt-2 border-t border-gray-200 text-[11px] text-gray-500">
                    <span>{{ $answeredTaarufQuestions }} Pertanyaan Terjawab</span>
                </div>
            </div>

        </div>
    </div>

    <!-- ================= 6. ANALITIK KONTEN PUBLIKASI & MATERI DAKWAH ================= -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        
        <!-- Kategori Artikel & Warta Berita -->
        <div class="bg-white rounded-2xl border border-gray-200/80 p-6 shadow-xs flex flex-col justify-between">
            <div>
                <div class="flex items-center justify-between pb-4 border-b border-gray-100 mb-5">
                    <div>
                        <h3 class="text-base font-bold text-gray-900 flex items-center gap-2">
                            <span>📰</span>
                            <span>Kategori Artikel &amp; Berita Terpopuler</span>
                        </h3>
                        <p class="text-xs text-gray-500 mt-0.5">Topik materi dakwah dan warta yang paling banyak diterbitkan.</p>
                    </div>
                    <a href="{{ route('admin.articles.index') }}" class="text-xs font-semibold text-blue-600 hover:underline">Kelola &rarr;</a>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div>
                        <span class="text-xs font-bold text-gray-400 uppercase tracking-wider block mb-2.5">Kategori Artikel:</span>
                        <div class="space-y-2">
                            @forelse($topArticleCategories as $cat)
                                <div class="flex items-center justify-between text-xs p-2 rounded-lg bg-gray-50 border border-gray-100">
                                    <span class="font-semibold text-gray-800">{{ $cat->name }}</span>
                                    <span class="font-bold text-emerald-700">{{ $cat->articles_count }} artikel</span>
                                </div>
                            @empty
                                <p class="text-xs text-gray-400">-</p>
                            @endforelse
                        </div>
                    </div>

                    <div>
                        <span class="text-xs font-bold text-gray-400 uppercase tracking-wider block mb-2.5">Kategori Berita:</span>
                        <div class="space-y-2">
                            @forelse($topNewsCategories as $ncat)
                                <div class="flex items-center justify-between text-xs p-2 rounded-lg bg-gray-50 border border-gray-100">
                                    <span class="font-semibold text-gray-800">{{ $ncat->name }}</span>
                                    <span class="font-bold text-blue-700">{{ $ncat->news_count }} berita</span>
                                </div>
                            @empty
                                <p class="text-xs text-gray-400">-</p>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-5 pt-3 border-t border-gray-100 flex items-center justify-between text-xs text-gray-500">
                <span>Total Seluruh Konten Terbit:</span>
                <span class="font-bold text-gray-900">{{ $publishedArticles + $publishedNews }} Publikasi</span>
            </div>
        </div>

        <!-- Kelengkapan Materi Belajar & Kontributor -->
        <div class="bg-white rounded-2xl border border-gray-200/80 p-6 shadow-xs flex flex-col justify-between">
            <div>
                <div class="flex items-center justify-between pb-4 border-b border-gray-100 mb-5">
                    <div>
                        <h3 class="text-base font-bold text-gray-900 flex items-center gap-2">
                            <span>📚</span>
                            <span>Kelengkapan Modul Materi &amp; Kontributor</span>
                        </h3>
                        <p class="text-xs text-gray-500 mt-0.5">Sebaran berkas materi per batch dan kontributor artikel.</p>
                    </div>
                    <a href="{{ route('admin.batches.index') }}" class="text-xs font-semibold text-purple-600 hover:underline">Batch &rarr;</a>
                </div>

                <div class="space-y-4">
                    <div class="grid grid-cols-3 gap-3 text-center">
                        <div class="p-3 rounded-xl bg-purple-50 border border-purple-100">
                            <span class="text-xl font-black text-purple-800 block">{{ $materialsWithSlide }}</span>
                            <span class="text-[11px] text-purple-700 font-medium block mt-0.5">Slide Materi</span>
                        </div>
                        <div class="p-3 rounded-xl bg-red-50 border border-red-100">
                            <span class="text-xl font-black text-red-800 block">{{ $materialsWithVideo }}</span>
                            <span class="text-[11px] text-red-700 font-medium block mt-0.5">Video Rekaman</span>
                        </div>
                        <div class="p-3 rounded-xl bg-emerald-50 border border-emerald-100">
                            <span class="text-xl font-black text-emerald-800 block">{{ $materialsWithNotes }}</span>
                            <span class="text-[11px] text-emerald-700 font-medium block mt-0.5">Notulensi</span>
                        </div>
                    </div>

                    <div>
                        <span class="text-xs font-bold text-gray-400 uppercase tracking-wider block mb-2">Penulis / Kontributor Teraktif:</span>
                        <div class="space-y-1.5">
                            @forelse($topAuthors as $author)
                                <div class="flex items-center justify-between text-xs">
                                    <span class="font-medium text-gray-700">{{ $author->name }}</span>
                                    <span class="font-bold text-gray-900 bg-gray-100 px-2 py-0.5 rounded-md">{{ $author->articles_count }} artikel</span>
                                </div>
                            @empty
                                <p class="text-xs text-gray-400">-</p>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-5 pt-3 border-t border-gray-100 flex items-center justify-between text-xs text-gray-500">
                <span>Total Repositori Materi:</span>
                <span class="font-bold text-gray-900">{{ $totalMaterials }} Modul File</span>
            </div>
        </div>

    </div>

</div>
@endsection
