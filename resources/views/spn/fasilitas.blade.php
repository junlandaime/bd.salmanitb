@extends('layouts.spn')

@section('title', 'Fasilitas & Layanan Peserta-Alumni — Sekolah Pranikah Salman ITB')
@section('meta_description', 'Fasilitas lengkap selama program dan layanan eksklusif setelah menjadi alumni SPN Salman
    ITB.')

@section('content')
    @php
        $activePage = 'fasilitas';
        $currentBatch =
            $batch ??
            \App\Models\ActivityBatch::whereHas('activity', function ($q) {
                $q->whereIn('slug', ['sekolah-pranikah-offline', 'sekolah-pranikah-online', 'spn']);
            })
                ->where('status', 'aktif')
                ->latest()
                ->first();
        $isBatchOpen = $currentBatch && $currentBatch->isRegistrationOpen();
        $isOnlineBatch =
            ($currentBatch && $currentBatch->activity && $currentBatch->activity->slug === 'sekolah-pranikah-online') ||
            ($currentBatch && str_contains(strtolower($currentBatch->nama_batch ?? ''), 'online'));
        $defaultMode = request('type', $isOnlineBatch ? 'online' : 'offline');
    @endphp

    <!-- Header Section -->
    <section class="dot-grid border-b border-navy/10 px-5 sm:px-8 py-14 text-center">
        <div class="max-w-4xl mx-auto">
            <nav class="mb-4 flex items-center justify-center gap-2 text-xs font-semibold text-navy/60">
                <a href="{{ route('spn.index') }}" class="hover:text-orange">Beranda</a>
                <span>/</span>
                <span class="text-orange">Fasilitas</span>
            </nav>
            <p class="text-xs sm:text-sm font-extrabold uppercase tracking-[0.3em] text-orange mb-3">Benefit &amp; Layanan
            </p>
            <h1 class="font-display font-black text-3xl sm:text-5xl text-navy">Fasilitas &amp; Layanan Peserta</h1>
            <p class="mx-auto mt-4 max-w-2xl text-sm sm:text-base text-navy/70 leading-relaxed">
                Dukungan penuh selama proses pembelajaran hingga pendampingan jangka panjang setelah lulus menjadi alumni
                SPN Salman ITB.
            </p>
        </div>
    </section>

    <!-- Facilities Section with Dynamic Switcher -->
    <section class="bg-cream px-5 sm:px-8 py-14" x-data="{ mode: '{{ $defaultMode }}' }">
        <div class="max-w-6xl mx-auto space-y-8">

            <!-- Program Mode Switcher -->
            <div class="flex flex-col items-center justify-center gap-3">
                <div class="inline-flex p-1.5 rounded-2xl bg-white border-2 border-navy/20 shadow-xs">
                    <button @click="mode = 'offline'"
                        :class="mode === 'offline' ? 'bg-navy text-cream font-black shadow-xs' :
                            'text-navy/70 hover:text-navy font-bold'"
                        class="flex items-center gap-2 rounded-xl px-5 sm:px-6 py-2.5 text-xs sm:text-sm transition">
                        <span>🏛️ Fasilitas SPN Offline</span>
                        @if (!$isOnlineBatch)
                            <span class="text-[10px] px-2 py-0.5 rounded-md bg-orange text-white">Batch Aktif</span>
                        @endif
                    </button>
                    <button @click="mode = 'online'"
                        :class="mode === 'online' ? 'bg-navy text-cream font-black shadow-xs' :
                            'text-navy/70 hover:text-navy font-bold'"
                        class="flex items-center gap-2 rounded-xl px-5 sm:px-6 py-2.5 text-xs sm:text-sm transition">
                        <span>💻 Fasilitas SPN Online</span>
                        @if ($isOnlineBatch)
                            <span class="text-[10px] px-2 py-0.5 rounded-md bg-orange text-white">Batch Aktif</span>
                        @endif
                    </button>
                </div>
                <p class="text-xs text-navy/60 text-center"
                    x-text="mode === 'offline' ? 'Menampilkan fasilitas untuk program tatap muka di Komplek Masjid Salman ITB' : 'Menampilkan fasilitas untuk program daring via Zoom Meeting Interaktif'">
                </p>
            </div>

            <!-- ================= FASILITAS SPN OFFLINE ================= -->
            <div x-show="mode === 'offline'" x-cloak x-transition class="space-y-8">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

                    <!-- Fasilitas Selama Program (Offline) -->
                    <div class="bg-white border-2 border-navy/20 rounded-2xl p-7 shadow-xs">
                        <div class="flex items-center gap-3 border-b border-navy/10 pb-4 mb-6">
                            <span
                                class="w-10 h-10 rounded-xl bg-navy text-cream font-display font-bold flex items-center justify-center text-lg">
                                🏛️
                            </span>
                            <div>
                                <h3 class="font-display font-black text-xl text-navy">Selama Kegiatan (Offline)</h3>
                                <p class="text-xs text-navy/60">Tatap muka 9 hari di Masjid Salman ITB</p>
                            </div>
                        </div>
                        <ul class="space-y-3.5 text-xs sm:text-sm text-navy/80 font-medium">
                            <li class="flex items-start gap-2.5">
                                <span class="text-orange font-bold">✓</span>
                                <span>Akses seumur hidup rekaman materi, bahan ajar, dan notulensi pembelajaran</span>
                            </li>
                            <li class="flex items-start gap-2.5">
                                <span class="text-orange font-bold">✓</span>
                                <span>Worksheet reflektif &amp; modul panduan terstruktur</span>
                            </li>
                            <li class="flex items-start gap-2.5 bg-orange/10 p-2.5 rounded-lg border border-orange/20">
                                <span class="text-orange font-bold">✓</span>
                                <span class="font-bold text-navy">Makan siang &amp; snack setiap hari pertemuan tatap muka
                                    <span class="text-[11px] text-orange block font-normal">(Khusus Offline)</span></span>
                            </li>
                            <li class="flex items-start gap-2.5 bg-orange/10 p-2.5 rounded-lg border border-orange/20">
                                <span class="text-orange font-bold">✓</span>
                                <span class="font-bold text-navy">Seminar KIT eksklusif SPN (notebook, pulpen, pin, goodie
                                    bag) <span class="text-[11px] text-orange block font-normal">(Khusus
                                        Offline)</span></span>
                            </li>
                            <li class="flex items-start gap-2.5 bg-orange/10 p-2.5 rounded-lg border border-orange/20">
                                <span class="text-orange font-bold">✓</span>
                                <span class="font-bold text-navy">Buku "Nikah atau Hilang Masa Depan" &amp; referensi
                                    pranikah <span class="text-[11px] text-orange block font-normal">(Khusus
                                        Offline)</span></span>
                            </li>
                            <li class="flex items-start gap-2.5">
                                <span class="text-orange font-bold">✓</span>
                                <span>Ruang belajar representatif di Komplek Masjid Salman ITB</span>
                            </li>
                        </ul>
                    </div>

                    <!-- Layanan Alumni (Offline) -->
                    <div class="bg-white border-2 border-orange rounded-2xl p-7 shadow-sm">
                        <div class="flex items-center gap-3 border-b border-navy/10 pb-4 mb-6">
                            <span
                                class="w-10 h-10 rounded-xl bg-orange text-white font-display font-bold flex items-center justify-center text-lg">
                                🎓
                            </span>
                            <div>
                                <h3 class="font-display font-black text-xl text-navy">Layanan Alumni &amp; Jejaring</h3>
                                <p class="text-xs text-navy/60">16 Layanan terintegrasi pasca kelulusan</p>
                            </div>
                        </div>
                        <ul class="space-y-3 text-xs sm:text-sm text-navy/80 font-medium">
                            <li class="flex items-start gap-2.5">
                                <span class="text-orange font-bold">✓</span>
                                <span>Akses eksklusif Portal Ta'aruf Bidang Dakwah Masjid Salman ITB</span>
                            </li>
                            <li class="flex items-start gap-2.5">
                                <span class="text-orange font-bold">✓</span>
                                <span>Template Wedding Planner &amp; Checklist Kesiapan Berkas KUA</span>
                            </li>
                            <li class="flex items-start gap-2.5">
                                <span class="text-orange font-bold">✓</span>
                                <span>Sertifikat kelulusan resmi ber-barcode verifikasi</span>
                            </li>
                            <li class="flex items-start gap-2.5">
                                <span class="text-orange font-bold">✓</span>
                                <span>Layanan konsultasi pranikah bersama Asatidz Bidang Dakwah Salman</span>
                            </li>
                            <li class="flex items-start gap-2.5">
                                <span class="text-orange font-bold">✓</span>
                                <span>Potongan biaya pre-marital checkup di Klinik Utama Jasmine MQ Medika</span>
                            </li>
                            <li class="flex items-start gap-2.5">
                                <span class="text-orange font-bold">✓</span>
                                <span>Potongan layanan psikologi di Firdaus Amany Psychological Center</span>
                            </li>
                            <li class="flex items-start gap-2.5">
                                <span class="text-orange font-bold">✓</span>
                                <span>Potongan layanan konsultasi keuangan syariah bersama Bumi Inspirasi</span>
                            </li>
                        </ul>
                    </div>

                </div>
            </div>

            <!-- ================= FASILITAS SPN ONLINE ================= -->
            <div x-show="mode === 'online'" x-cloak x-transition class="space-y-8">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

                    <!-- Fasilitas Selama Program (Online) -->
                    <div class="bg-white border-2 border-navy/20 rounded-2xl p-7 shadow-xs">
                        <div class="flex items-center gap-3 border-b border-navy/10 pb-4 mb-6">
                            <span
                                class="w-10 h-10 rounded-xl bg-navy text-cream font-display font-bold flex items-center justify-center text-lg">
                                💻
                            </span>
                            <div>
                                <h3 class="font-display font-black text-xl text-navy">Selama Kegiatan (Online)</h3>
                                <p class="text-xs text-navy/60">Live Zoom Interaktif 7 Hari + Series Fikih</p>
                            </div>
                        </div>
                        <ul class="space-y-3.5 text-xs sm:text-sm text-navy/80 font-medium">
                            <li class="flex items-start gap-2.5">
                                <span class="text-orange font-bold">✓</span>
                                <span><strong>7 Hari Sesi Live Zoom Meeting Interaktif</strong> bersama para pemateri dan
                                    pakar</span>
                            </li>
                            <li class="flex items-start gap-2.5">
                                <span class="text-orange font-bold">✓</span>
                                <span><strong>Series Materi Fikih Munakahat</strong> setiap Sabtu malam (19.30 - 21.45
                                    WIB)</span>
                            </li>
                            <li class="flex items-start gap-2.5">
                                <span class="text-orange font-bold">✓</span>
                                <span>Akses seumur hidup rekaman video/audio materi, bahan ajar, dan notulensi
                                    pembelajaran</span>
                            </li>
                            <li class="flex items-start gap-2.5">
                                <span class="text-orange font-bold">✓</span>
                                <span>Worksheet pertanyaan reflektif &amp; modul panduan digital</span>
                            </li>
                            <li class="flex items-start gap-2.5">
                                <span class="text-orange font-bold">✓</span>
                                <span>Sesi praktik simulasi psikomotorik &amp; diskusi kelompok via breakout room</span>
                            </li>
                        </ul>
                    </div>

                    <!-- Layanan Alumni & Voucher Mitra (Online) -->
                    <div class="bg-white border-2 border-orange rounded-2xl p-7 shadow-sm">
                        <div class="flex items-center gap-3 border-b border-navy/10 pb-4 mb-6">
                            <span
                                class="w-10 h-10 rounded-xl bg-orange text-white font-display font-bold flex items-center justify-center text-lg">
                                🎁
                            </span>
                            <div>
                                <h3 class="font-display font-black text-xl text-navy">Benefit Alumni &amp; Mitra Edukasi
                                </h3>
                                <p class="text-xs text-navy/60">Layanan Ta'aruf &amp; Voucher Kemitraan</p>
                            </div>
                        </div>
                        <ul class="space-y-3 text-xs sm:text-sm text-navy/80 font-medium">
                            <li class="flex items-start gap-2.5">
                                <span class="text-orange font-bold">✓</span>
                                <span><strong>Akses Layanan Eksklusif Ta'aruf Salman ITB</strong> setelah dinyatakan
                                    lulus</span>
                            </li>
                            <li class="flex items-start gap-2.5">
                                <span class="text-orange font-bold">✓</span>
                                <span>Badge alumni SPN Salman apabila menggunakan platform Ta'aruf Online Indonesia</span>
                            </li>
                            <li class="flex items-start gap-2.5">
                                <span class="text-orange font-bold">✓</span>
                                <span>Akses akun premium Ta'aruf Online Indonesia (bagi peserta terpilih)</span>
                            </li>
                            <li class="flex items-start gap-2.5">
                                <span class="text-orange font-bold">✓</span>
                                <span>Template Wedding Planner &amp; E-Sertifikat resmi kelulusan</span>
                            </li>
                            <li class="flex items-start gap-2.5">
                                <span class="text-orange font-bold">✓</span>
                                <span>Layanan konsultasi pernikahan bersama Asatidz Bidang Dakwah Salman</span>
                            </li>
                            <li class="flex items-start gap-2.5">
                                <span class="text-orange font-bold">✓</span>
                                <span><strong>Potongan 35%</strong> akses platform edukasi pernikahan
                                    temansiapnikah.com</span>
                            </li>
                            <li class="flex items-start gap-2.5">
                                <span class="text-orange font-bold">✓</span>
                                <span><strong>Potongan 25%</strong> layanan konsultasi keuangan syariah bersama Bumi
                                    Inspirasi</span>
                            </li>
                            <li class="flex items-start gap-2.5">
                                <span class="text-orange font-bold">✓</span>
                                <span><strong>Potongan 15%</strong> layanan psikologi bersama Firdaus Amany Psychological
                                    Center</span>
                            </li>
                            <li class="flex items-start gap-2.5">
                                <span class="text-orange font-bold">✓</span>
                                <span><strong>Potongan 10%</strong> layanan pemeriksaan pra nikah di Klinik Jasmine MQ
                                    Medika</span>
                            </li>
                        </ul>
                    </div>

                </div>
            </div>

            <!-- Notice box about offline vs online amenities -->
            <div
                class="p-5 rounded-2xl bg-white border border-navy/15 text-xs text-navy/80 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                <div class="flex items-center gap-3">
                    <span class="text-2xl">ℹ️</span>
                    <div>
                        <p class="font-bold text-navy text-sm">Catatan Perbedaan Fasilitas Fisik:</p>
                        <p class="text-navy/70">Makan siang, snack harian, seminar kit fisik (notebook, pulpen, goodie
                            bag), serta buku referensi fisik disediakan khusus untuk peserta SPN Tatap Muka (Offline).</p>
                    </div>
                </div>
                @if ($isBatchOpen)
                    <a href="{{ route('spn.daftar.step1') }}"
                        class="shrink-0 bg-orange text-white font-extrabold px-5 py-2.5 rounded-xl hover:bg-navy transition">
                        Daftar Sekarang &rarr;
                    </a>
                @endif
            </div>

            <!-- Gallery Grid (Jika Ada dari Database) -->
            @if (isset($gallery) && $gallery->isNotEmpty())
                <div class="mt-12 bg-white border-2 border-navy/15 rounded-2xl p-8 shadow-xs">
                    <h3 class="font-display font-black text-xl text-navy mb-6 text-center">Galeri &amp; Dokumentasi
                        Kegiatan</h3>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        @foreach ($gallery as $img)
                            <div class="aspect-video rounded-xl overflow-hidden border border-navy/10 bg-paper">
                                <img src="{{ $img->image_url ?? $img->url }}"
                                    alt="{{ $img->caption ?? 'Dokumentasi SPN' }}"
                                    class="w-full h-full object-cover hover:scale-105 transition duration-300">
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

        </div>
    </section>
@endsection
