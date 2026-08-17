@extends('admin.layouts.app')

@section('title', 'Statistik Taaruf - Admin Panel')

@section('content')
<div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
    
    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
        <div>
            <div class="flex items-center gap-2 text-xs text-gray-500 mb-1">
                <a href="{{ route('admin.taaruf.index') }}" class="hover:text-pink-600">Layanan Ta'aruf</a>
                <span>/</span>
                <span>Statistik &amp; Analitik</span>
            </div>
            <h1 class="text-2xl font-bold text-gray-900">Statistik Profil &amp; Peserta Ta'aruf</h1>
            <p class="text-sm text-gray-500 mt-0.5">Analitik sebaran demografi, status keaktifan, kuesioner, dan preferensi pernikahan peserta.</p>
        </div>
        <div class="flex items-center gap-2">
            <a href="{{ route('admin.taaruf.questions.index') }}"
                class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl border border-gray-300 bg-white text-gray-700 font-semibold text-sm hover:bg-gray-50 shadow-sm transition">
                <svg class="w-4 h-4 text-pink-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span>Lihat Pertanyaan ({{ $totalQuestions }})</span>
            </a>
            <a href="{{ route('admin.taaruf.index') }}"
                class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-pink-600 hover:bg-pink-700 text-white font-semibold text-sm shadow-sm transition">
                &larr; Kembali ke Daftar Profil
            </a>
        </div>
    </div>

    @php
        $activityRate = $totalProfiles > 0 ? round(($activeProfiles / $totalProfiles) * 100) : 0;
        $malePercentage = $totalProfiles > 0 ? round(($maleProfiles / $totalProfiles) * 100) : 0;
        $femalePercentage = $totalProfiles > 0 ? round(($femaleProfiles / $totalProfiles) * 100) : 0;
        $activeMalePercentage = $maleProfiles > 0 ? round(($activeMaleProfiles / $maleProfiles) * 100) : 0;
        $activeFemalePercentage = $femaleProfiles > 0 ? round(($activeFemaleProfiles / $femaleProfiles) * 100) : 0;
        $responseRate = $totalQuestions > 0 ? round(($answeredQuestions / $totalQuestions) * 100) : 0;
    @endphp

    {{-- ========================================================================= --}}
    {{-- 1. UTAMA: 4 KPI CARD UTAMA (MEMPERTAHANKAN TAMPILAN DATA SEBELUMNYA) --}}
    {{-- ========================================================================= --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 mb-8">
        
        <!-- Total Profil -->
        <div class="bg-white rounded-2xl border border-gray-200/80 p-6 shadow-sm flex flex-col justify-between">
            <div class="flex items-center justify-between">
                <span class="text-xs font-bold text-gray-500 uppercase tracking-wider">Total Profil</span>
                <div class="w-10 h-10 rounded-xl bg-pink-50 text-pink-600 flex items-center justify-center text-lg">
                    👥
                </div>
            </div>
            <div class="mt-4">
                <div class="text-3xl font-extrabold text-gray-900">{{ number_format($totalProfiles, 0, ',', '.') }}</div>
                <div class="text-xs text-gray-500 font-medium mt-1">Total peserta terdaftar</div>
            </div>
        </div>

        <!-- Profil Aktif -->
        <div class="bg-white rounded-2xl border border-gray-200/80 p-6 shadow-sm flex flex-col justify-between">
            <div class="flex items-center justify-between">
                <span class="text-xs font-bold text-gray-500 uppercase tracking-wider">Profil Aktif</span>
                <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center text-lg">
                    🟢
                </div>
            </div>
            <div class="mt-4">
                <div class="text-3xl font-extrabold text-emerald-600">{{ number_format($activeProfiles, 0, ',', '.') }}</div>
                <div class="text-xs text-emerald-700 font-semibold mt-1">{{ $activityRate }}% dari total profil</div>
            </div>
        </div>

        <!-- Sedang Proses Taaruf -->
        <div class="bg-white rounded-2xl border border-gray-200/80 p-6 shadow-sm flex flex-col justify-between">
            <div class="flex items-center justify-between">
                <span class="text-xs font-bold text-gray-500 uppercase tracking-wider">Sedang Proses Ta'aruf</span>
                <div class="w-10 h-10 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center text-lg">
                    💛
                </div>
            </div>
            <div class="mt-4">
                <div class="text-3xl font-extrabold text-amber-600">{{ number_format($inTaarufProcess, 0, ',', '.') }}</div>
                <div class="text-xs text-amber-700 font-semibold mt-1">Dalam tahap pertukaran data</div>
            </div>
        </div>

        <!-- Tingkat Aktivitas -->
        <div class="bg-white rounded-2xl border border-gray-200/80 p-6 shadow-sm flex flex-col justify-between">
            <div class="flex items-center justify-between">
                <span class="text-xs font-bold text-gray-500 uppercase tracking-wider">Tingkat Aktivitas</span>
                <div class="w-10 h-10 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center text-lg">
                    📊
                </div>
            </div>
            <div class="mt-4">
                <div class="text-3xl font-extrabold text-blue-600">{{ $activityRate }}%</div>
                <div class="text-xs text-gray-500 font-medium mt-1">Rasio profil yang siap ta'aruf</div>
            </div>
        </div>

    </div>

    {{-- ========================================================================= --}}
    {{-- 2. DISTRIBUSI GENDER & STATUS AKTIF GENDER (MEMPERTAHANKAN DATA SEBELUMNYA) --}}
    {{-- ========================================================================= --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
        
        <!-- Distribusi Jenis Kelamin -->
        <div class="bg-white rounded-2xl border border-gray-200/80 shadow-sm p-6">
            <div class="flex items-center justify-between pb-4 border-b border-gray-100 mb-6">
                <div>
                    <h2 class="text-base font-bold text-gray-900">Distribusi Jenis Kelamin</h2>
                    <p class="text-xs text-gray-500 mt-0.5">Sebaran peserta ikhwan dan akhwat di database.</p>
                </div>
                <span class="px-2.5 py-1 rounded-full bg-gray-100 text-gray-700 text-xs font-bold">{{ $totalProfiles }} Total</span>
            </div>
            
            <div class="space-y-6">
                <!-- Laki-laki -->
                <div class="p-4 rounded-xl bg-blue-50/50 border border-blue-100">
                    <div class="flex items-center justify-between text-xs font-semibold mb-2">
                        <span class="text-blue-800 flex items-center gap-2 font-bold text-sm">
                            <span>👨</span>
                            <span>Laki-laki (Ikhwan)</span>
                        </span>
                        <span class="text-blue-900 font-extrabold text-sm">{{ $maleProfiles }} ({{ $malePercentage }}%)</span>
                    </div>
                    <div class="w-full bg-blue-200/60 rounded-full h-3 overflow-hidden">
                        <div class="bg-blue-600 h-3 rounded-full transition-all duration-700" style="width: {{ $malePercentage }}%"></div>
                    </div>
                </div>

                <!-- Perempuan -->
                <div class="p-4 rounded-xl bg-pink-50/50 border border-pink-100">
                    <div class="flex items-center justify-between text-xs font-semibold mb-2">
                        <span class="text-pink-800 flex items-center gap-2 font-bold text-sm">
                            <span>🧕</span>
                            <span>Perempuan (Akhwat)</span>
                        </span>
                        <span class="text-pink-900 font-extrabold text-sm">{{ $femaleProfiles }} ({{ $femalePercentage }}%)</span>
                    </div>
                    <div class="w-full bg-pink-200/60 rounded-full h-3 overflow-hidden">
                        <div class="bg-pink-600 h-3 rounded-full transition-all duration-700" style="width: {{ $femalePercentage }}%"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Status Aktif berdasarkan Jenis Kelamin -->
        <div class="bg-white rounded-2xl border border-gray-200/80 shadow-sm p-6">
            <div class="flex items-center justify-between pb-4 border-b border-gray-100 mb-6">
                <div>
                    <h2 class="text-base font-bold text-gray-900">Status Aktif berdasarkan Jenis Kelamin</h2>
                    <p class="text-xs text-gray-500 mt-0.5">Persentase keaktifan masing-masing gender.</p>
                </div>
                <span class="px-2.5 py-1 rounded-full bg-emerald-100 text-emerald-800 text-xs font-bold">{{ $activeProfiles }} Aktif</span>
            </div>
            
            <div class="space-y-6">
                <!-- Laki-laki Aktif -->
                <div class="p-4 rounded-xl bg-gray-50 border border-gray-200/80">
                    <div class="flex items-center justify-between text-xs font-semibold mb-2">
                        <span class="text-gray-800 font-bold flex items-center gap-2">
                            <span class="w-2.5 h-2.5 rounded-full bg-blue-500"></span>
                            <span>Laki-laki Aktif</span>
                        </span>
                        <span class="text-gray-900 font-extrabold text-sm">{{ $activeMaleProfiles }} ({{ $activeMalePercentage }}%)</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-3 overflow-hidden">
                        <div class="bg-blue-500 h-3 rounded-full transition-all duration-700" style="width: {{ $activeMalePercentage }}%"></div>
                    </div>
                    <span class="text-[11px] text-gray-400 mt-1.5 block">Dari total {{ $maleProfiles }} laki-laki terdaftar</span>
                </div>

                <!-- Perempuan Aktif -->
                <div class="p-4 rounded-xl bg-gray-50 border border-gray-200/80">
                    <div class="flex items-center justify-between text-xs font-semibold mb-2">
                        <span class="text-gray-800 font-bold flex items-center gap-2">
                            <span class="w-2.5 h-2.5 rounded-full bg-pink-500"></span>
                            <span>Perempuan Aktif</span>
                        </span>
                        <span class="text-gray-900 font-extrabold text-sm">{{ $activeFemaleProfiles }} ({{ $activeFemalePercentage }}%)</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-3 overflow-hidden">
                        <div class="bg-pink-500 h-3 rounded-full transition-all duration-700" style="width: {{ $activeFemalePercentage }}%"></div>
                    </div>
                    <span class="text-[11px] text-gray-400 mt-1.5 block">Dari total {{ $femaleProfiles }} perempuan terdaftar</span>
                </div>
            </div>
        </div>

    </div>

    {{-- ========================================================================= --}}
    {{-- 3. STATISTIK TAMBAHAN BERMANFAAT: TARGET NIKAH, PENDIDIKAN & DOMISILI --}}
    {{-- ========================================================================= --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-8">
        
        <!-- Target Tahun Menikah -->
        <div class="bg-white rounded-2xl border border-gray-200/80 shadow-sm p-6">
            <h3 class="text-base font-bold text-gray-900 pb-3 border-b border-gray-100 mb-4 flex items-center gap-2">
                <span>💍</span>
                <span>Target Tahun Menikah</span>
            </h3>
            <p class="text-xs text-gray-500 mb-5">Rencana waktu pelaksanaan pernikahan peserta.</p>

            <div class="space-y-3.5">
                @forelse($marriageTargets as $target)
                    @php
                        $pct = $totalProfiles > 0 ? round(($target->count / $totalProfiles) * 100) : 0;
                    @endphp
                    <div>
                        <div class="flex justify-between text-xs font-semibold mb-1">
                            <span class="text-gray-700">Tahun {{ $target->marriage_target_year }}</span>
                            <span class="text-gray-900 font-bold">{{ $target->count }} orang ({{ $pct }}%)</span>
                        </div>
                        <div class="w-full bg-gray-100 rounded-full h-2 overflow-hidden">
                            <div class="bg-pink-500 h-2 rounded-full" style="width: {{ $pct }}%"></div>
                        </div>
                    </div>
                @empty
                    <p class="text-xs text-gray-400 italic">Belum ada data target tahun menikah.</p>
                @endforelse
            </div>
        </div>

        <!-- Tingkat Pendidikan -->
        <div class="bg-white rounded-2xl border border-gray-200/80 shadow-sm p-6">
            <h3 class="text-base font-bold text-gray-900 pb-3 border-b border-gray-100 mb-4 flex items-center gap-2">
                <span>🎓</span>
                <span>Jenjang Pendidikan Terakhir</span>
            </h3>
            <p class="text-xs text-gray-500 mb-5">Sebaran kualifikasi akademis peserta ta'aruf.</p>

            <div class="space-y-3.5">
                @foreach($educationStats as $level => $count)
                    @php
                        $pct = $totalProfiles > 0 ? round(($count / $totalProfiles) * 100) : 0;
                    @endphp
                    <div>
                        <div class="flex justify-between text-xs font-semibold mb-1">
                            <span class="text-gray-700">{{ $level }}</span>
                            <span class="text-gray-900 font-bold">{{ $count }} ({{ $pct }}%)</span>
                        </div>
                        <div class="w-full bg-gray-100 rounded-full h-2 overflow-hidden">
                            <div class="bg-emerald-500 h-2 rounded-full" style="width: {{ $pct }}%"></div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Top Kota Domisili -->
        <div class="bg-white rounded-2xl border border-gray-200/80 shadow-sm p-6">
            <h3 class="text-base font-bold text-gray-900 pb-3 border-b border-gray-100 mb-4 flex items-center gap-2">
                <span>📍</span>
                <span>Top Wilayah Domisili</span>
            </h3>
            <p class="text-xs text-gray-500 mb-5">Kota/Kabupaten domisili terbanyak peserta.</p>

            <div class="space-y-3">
                @forelse($topCities as $city)
                    <div class="flex items-center justify-between p-2.5 rounded-xl bg-gray-50 border border-gray-100 text-xs">
                        <span class="font-bold text-gray-800">{{ $city->city ?: 'TIDAK DIISI' }}</span>
                        <span class="px-2 py-0.5 rounded-full bg-white border border-gray-200 font-extrabold text-pink-600 shadow-2xs">
                            {{ $city->count }} peserta
                        </span>
                    </div>
                @empty
                    <p class="text-xs text-gray-400 italic">Belum ada data wilayah domisili.</p>
                @endforelse
            </div>
        </div>

    </div>

    {{-- ========================================================================= --}}
    {{-- 4. STATISTIK SKRINING KRITERIA, KELENGKAPAN BERKAS & INTERAKSI PERTANYAAN --}}
    {{-- ========================================================================= --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        <!-- Skrining Kesiapan & Kebiasaan -->
        <div class="bg-white rounded-2xl border border-gray-200/80 shadow-sm p-6">
            <h3 class="text-base font-bold text-gray-900 pb-3 border-b border-gray-100 mb-4 flex items-center gap-2">
                <span>🔍</span>
                <span>Skrining Kesiapan &amp; Kebiasaan</span>
            </h3>
            
            <div class="space-y-3">
                <div class="flex items-center justify-between p-3 rounded-xl bg-emerald-50/60 border border-emerald-100">
                    <div>
                        <span class="text-xs font-bold text-emerald-900 block">Bebas Rokok</span>
                        <span class="text-[11px] text-emerald-700">Tidak merokok</span>
                    </div>
                    <span class="text-sm font-extrabold text-emerald-700">{{ $totalProfiles - $smokerProfiles }} ({{ $totalProfiles > 0 ? round((($totalProfiles - $smokerProfiles) / $totalProfiles) * 100) : 0 }}%)</span>
                </div>

                <div class="flex items-center justify-between p-3 rounded-xl bg-blue-50/60 border border-blue-100">
                    <div>
                        <span class="text-xs font-bold text-blue-900 block">Bebas Hutang</span>
                        <span class="text-[11px] text-blue-700">Tidak memiliki beban hutang</span>
                    </div>
                    <span class="text-sm font-extrabold text-blue-700">{{ $totalProfiles - $debtProfiles }} ({{ $totalProfiles > 0 ? round((($totalProfiles - $debtProfiles) / $totalProfiles) * 100) : 0 }}%)</span>
                </div>

                <div class="flex items-center justify-between p-3 rounded-xl bg-gray-50 border border-gray-200/80">
                    <div>
                        <span class="text-xs font-bold text-gray-800 block">Memiliki Tanggungan</span>
                        <span class="text-[11px] text-gray-500">Menanggung keluarga/orang tua</span>
                    </div>
                    <span class="text-sm font-extrabold text-gray-700">{{ $dependentProfiles }} ({{ $totalProfiles > 0 ? round(($dependentProfiles / $totalProfiles) * 100) : 0 }}%)</span>
                </div>

                <div class="flex items-center justify-between p-3 rounded-xl bg-gray-50 border border-gray-200/80">
                    <div>
                        <span class="text-xs font-bold text-gray-800 block">Kesediaan Poligami</span>
                        <span class="text-[11px] text-gray-500">Membuka opsi / bersedia</span>
                    </div>
                    <span class="text-sm font-extrabold text-gray-700">{{ $polygamyIntendedProfiles }} ({{ $totalProfiles > 0 ? round(($polygamyIntendedProfiles / $totalProfiles) * 100) : 0 }}%)</span>
                </div>
            </div>
        </div>

        <!-- Kelengkapan Dokumen & Biodata -->
        <div class="bg-white rounded-2xl border border-gray-200/80 shadow-sm p-6">
            <h3 class="text-base font-bold text-gray-900 pb-3 border-b border-gray-100 mb-4 flex items-center gap-2">
                <span>📄</span>
                <span>Kelengkapan Berkas Biodata</span>
            </h3>
            
            <div class="space-y-4">
                <!-- Foto Profil -->
                <div class="p-4 rounded-xl bg-gray-50 border border-gray-200/80">
                    <div class="flex items-center justify-between text-xs font-bold mb-2">
                        <span class="text-gray-700">Foto Profil Terunggah</span>
                        <span class="text-emerald-700 font-extrabold">{{ $withPhoto }} / {{ $totalProfiles }} ({{ $totalProfiles > 0 ? round(($withPhoto / $totalProfiles) * 100) : 0 }}%)</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2.5 overflow-hidden">
                        <div class="bg-emerald-500 h-2.5 rounded-full" style="width: {{ $totalProfiles > 0 ? ($withPhoto / $totalProfiles) * 100 : 0 }}%"></div>
                    </div>
                </div>

                <!-- Informed Consent -->
                <div class="p-4 rounded-xl bg-gray-50 border border-gray-200/80">
                    <div class="flex items-center justify-between text-xs font-bold mb-2">
                        <span class="text-gray-700">Informed Consent Disetujui</span>
                        <span class="text-emerald-700 font-extrabold">{{ $withConsent }} / {{ $totalProfiles }} ({{ $totalProfiles > 0 ? round(($withConsent / $totalProfiles) * 100) : 0 }}%)</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2.5 overflow-hidden">
                        <div class="bg-emerald-500 h-2.5 rounded-full" style="width: {{ $totalProfiles > 0 ? ($withConsent / $totalProfiles) * 100 : 0 }}%"></div>
                    </div>
                </div>

                <div class="p-3 bg-pink-50/60 rounded-xl border border-pink-100 text-xs text-pink-800 leading-relaxed">
                    ✨ Semua profil aktif telah melewati verifikasi surat pernyataan dan kriteria dasar ta'aruf.
                </div>
            </div>
        </div>

        <!-- Aktivitas Pertanyaan & Interaksi -->
        <div class="bg-white rounded-2xl border border-gray-200/80 shadow-sm p-6">
            <h3 class="text-base font-bold text-gray-900 pb-3 border-b border-gray-100 mb-4 flex items-center gap-2">
                <span>💬</span>
                <span>Aktivitas Tanya-Jawab</span>
            </h3>
            
            <div class="space-y-4">
                <div class="grid grid-cols-2 gap-3 text-center">
                    <div class="p-3 rounded-xl bg-purple-50 border border-purple-100">
                        <span class="text-xl font-extrabold text-purple-700 block">{{ number_format($totalQuestions, 0, ',', '.') }}</span>
                        <span class="text-[11px] text-purple-600 font-medium mt-0.5 block">Total Pertanyaan</span>
                    </div>
                    <div class="p-3 rounded-xl bg-emerald-50 border border-emerald-100">
                        <span class="text-xl font-extrabold text-emerald-700 block">{{ number_format($answeredQuestions, 0, ',', '.') }}</span>
                        <span class="text-[11px] text-emerald-600 font-medium mt-0.5 block">Telah Dijawab</span>
                    </div>
                </div>

                <div>
                    <div class="flex items-center justify-between text-xs font-bold mb-1.5">
                        <span class="text-gray-600">Response Rate Jawaban</span>
                        <span class="text-emerald-700 font-extrabold">{{ $responseRate }}%</span>
                    </div>
                    <div class="w-full bg-gray-100 rounded-full h-2.5 overflow-hidden">
                        <div class="bg-emerald-500 h-2.5 rounded-full" style="width: {{ $responseRate }}%"></div>
                    </div>
                </div>

                <div class="pt-2">
                    <a href="{{ route('admin.taaruf.questions.index') }}"
                        class="inline-flex items-center justify-center w-full py-2.5 px-4 rounded-xl bg-gray-100 hover:bg-pink-50 text-gray-700 hover:text-pink-700 text-xs font-bold border border-gray-200 hover:border-pink-200 transition">
                        <span>Kelola Pertanyaan Peserta &rarr;</span>
                    </a>
                </div>
            </div>
        </div>

    </div>

</div>
@endsection
