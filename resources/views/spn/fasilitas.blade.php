@extends('layouts.spn')

@section('title', 'Fasilitas & Layanan Peserta-Alumni — Sekolah Pranikah Salman ITB')
@section('meta_description', 'Fasilitas lengkap selama program dan layanan eksklusif setelah menjadi alumni SPN Salman ITB.')

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

        $batchPoster =
            $currentBatch && $currentBatch->featured_image
                ? (str_starts_with($currentBatch->featured_image, 'http')
                    ? $currentBatch->featured_image
                    : \Illuminate\Support\Facades\Storage::url($currentBatch->featured_image))
                : ($activity && $activity->featured_image
                    ? \Illuminate\Support\Facades\Storage::url($activity->featured_image)
                    : null);

        // Siapkan data galeri untuk Alpine.js
        $galleryItems = $gallery->map(function ($item) {
            return [
                'id' => $item->id,
                'url' => $item->image_url,
                'title' => $item->title ?? 'Dokumentasi SPN Salman ITB',
                'description' => $item->description ?? '',
            ];
        })->values();
    @endphp

    <!-- Header Section -->
    <section class="dot-grid border-b border-navy/10 px-5 sm:px-8 py-14 text-center">
        <div class="max-w-4xl mx-auto">
            <nav class="mb-4 flex items-center justify-center gap-2 text-xs font-semibold text-navy/60">
                <a href="{{ route('spn.index') }}" class="hover:text-orange">Beranda</a>
                <span>/</span>
                <span class="text-orange">Fasilitas</span>
            </nav>
            <p class="text-xs sm:text-sm font-extrabold uppercase tracking-[0.3em] text-orange mb-3">Benefit &amp; Layanan</p>
            <h1 class="font-display font-black text-3xl sm:text-5xl text-navy">Fasilitas &amp; Layanan Peserta</h1>
            <p class="mx-auto mt-4 max-w-2xl text-sm sm:text-base text-navy/70 leading-relaxed">
                Dukungan penuh selama proses pembelajaran hingga pendampingan jangka panjang setelah lulus menjadi alumni SPN Salman ITB.
            </p>
        </div>
    </section>

    <!-- Main Container with Alpine State -->
    <div x-data="{ 
            mode: '{{ $defaultMode }}',
            showPosterModal: false,
            lightboxOpen: false,
            currentIndex: 0,
            photos: {{ Js::from($galleryItems) }},
            openLightbox(index) {
                this.currentIndex = index;
                this.lightboxOpen = true;
            },
            nextPhoto() {
                if (this.photos.length > 0) {
                    this.currentIndex = (this.currentIndex + 1) % this.photos.length;
                }
            },
            prevPhoto() {
                if (this.photos.length > 0) {
                    this.currentIndex = (this.currentIndex - 1 + this.photos.length) % this.photos.length;
                }
            }
        }"
        @keydown.escape.window="lightboxOpen = false; showPosterModal = false"
        @keydown.arrow-right.window="if (lightboxOpen) nextPhoto()"
        @keydown.arrow-left.window="if (lightboxOpen) prevPhoto()"
        class="bg-cream px-5 sm:px-8 py-14 space-y-12">

        <div class="max-w-6xl mx-auto space-y-10">

            <!-- Program Mode Switcher -->
            <div class="flex flex-col items-center justify-center gap-3">
                <div class="inline-flex p-1.5 rounded-2xl bg-white border-2 border-navy/20 shadow-xs">
                    <button @click="mode = 'offline'"
                        :class="mode === 'offline' ? 'bg-navy text-cream font-black shadow-xs' : 'text-navy/70 hover:text-navy font-bold'"
                        class="flex items-center gap-2 rounded-xl px-5 sm:px-6 py-2.5 text-xs sm:text-sm transition">
                        <span>🏛️ Fasilitas SPN Offline</span>
                        @if (!$isOnlineBatch)
                            <span class="text-[10px] px-2 py-0.5 rounded-md bg-orange text-white">Batch Aktif</span>
                        @endif
                    </button>
                    <button @click="mode = 'online'"
                        :class="mode === 'online' ? 'bg-navy text-cream font-black shadow-xs' : 'text-navy/70 hover:text-navy font-bold'"
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
                            <span class="w-10 h-10 rounded-xl bg-navy text-cream font-display font-bold flex items-center justify-center text-lg">
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
                                <span class="font-bold text-navy">Seminar KIT eksklusif SPN (notebook, pulpen, pin, goodie bag)
                                    <span class="text-[11px] text-orange block font-normal">(Khusus Offline)</span></span>
                            </li>
                            <li class="flex items-start gap-2.5 bg-orange/10 p-2.5 rounded-lg border border-orange/20">
                                <span class="text-orange font-bold">✓</span>
                                <span class="font-bold text-navy">Buku "Nikah atau Hilang Masa Depan" &amp; referensi pranikah
                                    <span class="text-[11px] text-orange block font-normal">(Khusus Offline)</span></span>
                            </li>
                            <li class="flex items-start gap-2.5">
                                <span class="text-orange font-bold">✓</span>
                                <span>Ruang belajar representatif &amp; ber-AC di Komplek Masjid Salman ITB</span>
                            </li>
                        </ul>
                    </div>

                    <!-- Layanan Alumni (Offline) -->
                    <div class="bg-white border-2 border-orange rounded-2xl p-7 shadow-sm">
                        <div class="flex items-center gap-3 border-b border-navy/10 pb-4 mb-6">
                            <span class="w-10 h-10 rounded-xl bg-orange text-white font-display font-bold flex items-center justify-center text-lg">
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
                            <span class="w-10 h-10 rounded-xl bg-navy text-cream font-display font-bold flex items-center justify-center text-lg">
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
                                <span><strong>7 Hari Sesi Live Zoom Meeting Interaktif</strong> bersama para pemateri dan pakar</span>
                            </li>
                            <li class="flex items-start gap-2.5">
                                <span class="text-orange font-bold">✓</span>
                                <span><strong>Series Materi Fikih Munakahat</strong> setiap Sabtu malam (19.30 - 21.45 WIB)</span>
                            </li>
                            <li class="flex items-start gap-2.5">
                                <span class="text-orange font-bold">✓</span>
                                <span>Akses seumur hidup rekaman video/audio materi, bahan ajar, dan notulensi pembelajaran</span>
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
                            <span class="w-10 h-10 rounded-xl bg-orange text-white font-display font-bold flex items-center justify-center text-lg">
                                🎁
                            </span>
                            <div>
                                <h3 class="font-display font-black text-xl text-navy">Benefit Alumni &amp; Mitra Edukasi</h3>
                                <p class="text-xs text-navy/60">Layanan Ta'aruf &amp; Voucher Kemitraan</p>
                            </div>
                        </div>
                        <ul class="space-y-3 text-xs sm:text-sm text-navy/80 font-medium">
                            <li class="flex items-start gap-2.5">
                                <span class="text-orange font-bold">✓</span>
                                <span><strong>Akses Layanan Eksklusif Ta'aruf Salman ITB</strong> setelah dinyatakan lulus</span>
                            </li>
                            <li class="flex items-start gap-2.5">
                                <span class="text-orange font-bold">✓</span>
                                <span>Badge alumni SPN Salman apabila menggunakan platform Ta'aruf Online Indonesia</span>
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
                                <span><strong>Potongan 35%</strong> akses platform edukasi pernikahan temansiapnikah.com</span>
                            </li>
                            <li class="flex items-start gap-2.5">
                                <span class="text-orange font-bold">✓</span>
                                <span><strong>Potongan 25%</strong> layanan konsultasi keuangan syariah bersama Bumi Inspirasi</span>
                            </li>
                            <li class="flex items-start gap-2.5">
                                <span class="text-orange font-bold">✓</span>
                                <span><strong>Potongan 15%</strong> layanan psikologi bersama Firdaus Amany Psychological Center</span>
                            </li>
                        </ul>
                    </div>

                </div>
            </div>

            <!-- Notice box about offline vs online amenities -->
            <div class="p-5 rounded-2xl bg-white border border-navy/15 text-xs text-navy/80 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                <div class="flex items-center gap-3">
                    <span class="text-2xl">ℹ️</span>
                    <div>
                        <p class="font-bold text-navy text-sm">Catatan Perbedaan Fasilitas Fisik:</p>
                        <p class="text-navy/70">Makan siang, snack harian, seminar kit fisik (notebook, pulpen, goodie bag), serta buku referensi fisik disediakan khusus untuk peserta SPN Tatap Muka (Offline).</p>
                    </div>
                </div>
                @if ($isBatchOpen)
                    <a href="{{ route('spn.daftar.step1') }}"
                        class="shrink-0 bg-orange text-white font-extrabold px-5 py-2.5 rounded-xl hover:bg-navy transition shadow-sm">
                        Daftar Sekarang &rarr;
                    </a>
                @endif
            </div>

            <!-- ================= POSTER RESMI BATCH SPN ================= -->
            @if ($batchPoster)
                <div class="bg-gradient-to-br from-navy to-slate-900 rounded-3xl p-6 sm:p-8 text-white border-2 border-navy/30 shadow-xl overflow-hidden relative">
                    <div aria-hidden="true" class="absolute -right-20 -top-20 w-64 h-64 bg-orange/20 rounded-full blur-3xl pointer-events-none"></div>

                    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center relative z-10">
                        <div class="lg:col-span-7 space-y-4">
                            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white/10 border border-white/15 text-orange text-xs font-bold">
                                <span>📢</span>
                                <span>Poster Resmi Program</span>
                            </div>
                            <h3 class="font-display font-black text-2xl sm:text-3xl text-cream leading-tight">
                                {{ $currentBatch->nama_batch ?? 'Sekolah Pranikah Salman ITB' }}
                            </h3>
                            <p class="text-xs sm:text-sm text-cream/80 leading-relaxed">
                                Klik poster untuk melihat detail materi, jadwal pelaksanaan, profil narasumber, dan informasi paket pendaftaran dalam resolusi tinggi.
                            </p>

                            <div class="pt-2 flex flex-wrap items-center gap-3">
                                <button type="button" @click="showPosterModal = true"
                                    class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-orange hover:bg-orange/90 text-white font-bold text-xs shadow-md transition">
                                    <i class="fas fa-search-plus"></i>
                                    <span>Lihat Poster Ukuran Penuh</span>
                                </button>
                                @if($isBatchOpen)
                                    <a href="{{ route('spn.daftar.step1') }}"
                                        class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-white/10 hover:bg-white/20 text-cream font-bold text-xs border border-white/20 backdrop-blur-xs transition">
                                        <span>Daftar Batch Ini</span>
                                        <i class="fas fa-arrow-right text-[10px]"></i>
                                    </a>
                                @endif
                            </div>
                        </div>

                        <!-- Poster Card Preview -->
                        <div class="lg:col-span-5 flex justify-center">
                            <div class="relative group cursor-pointer w-full max-w-xs rounded-2xl overflow-hidden border-2 border-white/20 shadow-2xl bg-black/40"
                                @click="showPosterModal = true">
                                <img src="{{ $batchPoster }}"
                                    alt="Poster {{ $currentBatch->nama_batch ?? 'SPN' }}"
                                    class="w-full h-auto object-cover transform group-hover:scale-105 transition duration-500">
                                
                                <div class="absolute inset-0 bg-gradient-to-t from-navy/90 via-navy/30 to-transparent opacity-0 group-hover:opacity-100 transition-opacity flex flex-col justify-end p-4">
                                    <div class="flex items-center justify-center gap-2 text-white text-xs font-bold bg-orange px-3 py-2 rounded-xl shadow-lg">
                                        <i class="fas fa-expand"></i>
                                        <span>Buka Resolusi Penuh</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <!-- ================= DOKUMENTASI & GALERI KEGIATAN ================= -->
            <div class="bg-white border-2 border-navy/15 rounded-3xl p-6 sm:p-8 shadow-xs space-y-6">
                <div class="text-center max-w-xl mx-auto space-y-2">
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-orange/10 text-orange text-xs font-bold">
                        <span>📸</span>
                        <span>Dokumentasi Kegiatan</span>
                    </span>
                    <h3 class="font-display font-black text-2xl sm:text-3xl text-navy">Suasana Belajar &amp; Interaksi SPN</h3>
                    <p class="text-xs sm:text-sm text-navy/60">
                        Dokumentasi kelas tatap muka, diskusi kelompok, serta sesi interaktif para alumni Sekolah Pranikah Salman ITB.
                    </p>
                </div>

                @if ($gallery->isNotEmpty())
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-5 pt-4">
                        @foreach ($gallery as $index => $img)
                            <div class="group relative rounded-2xl overflow-hidden border-2 border-navy/10 bg-paper aspect-[4/3] cursor-pointer shadow-xs hover:shadow-lg transition-all duration-300"
                                @click="openLightbox({{ $index }})">
                                
                                <img src="{{ $img->image_url }}"
                                    alt="{{ $img->title ?? 'Dokumentasi SPN' }}"
                                    onerror="this.onerror=null; this.src='https://picsum.photos/800/600?random={{ $img->id }}';"
                                    class="w-full h-full object-cover transform group-hover:scale-110 transition duration-500">

                                <!-- Hover Overlay with Zoom Icon & Caption -->
                                <div class="absolute inset-0 bg-gradient-to-t from-navy/90 via-navy/40 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex flex-col justify-end p-4 text-white">
                                    <div class="flex items-center justify-between">
                                        <div class="min-w-0 pr-2">
                                            <h4 class="font-bold text-xs sm:text-sm truncate text-cream">
                                                {{ $img->title ?? 'Dokumentasi SPN' }}
                                            </h4>
                                            @if($img->description)
                                                <p class="text-[11px] text-cream/80 truncate mt-0.5">
                                                    {{ $img->description }}
                                                </p>
                                            @endif
                                        </div>
                                        <span class="w-8 h-8 rounded-full bg-orange flex items-center justify-center text-white text-xs shrink-0 shadow-md">
                                            <i class="fas fa-search-plus"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-10 bg-cream/50 rounded-2xl border-2 border-dashed border-navy/20">
                        <i class="fas fa-images text-4xl text-navy/30 mb-3"></i>
                        <p class="text-sm font-bold text-navy">Dokumentasi foto kegiatan akan segera diunggah.</p>
                        <p class="text-xs text-navy/60 mt-1">Nantikan pembaruan album foto dokumentasi kegiatan batch terbaru.</p>
                    </div>
                @endif
            </div>

        </div>

        <!-- ================= POSTER LIGHTBOX MODAL ================= -->
        @if ($batchPoster)
            <div x-show="showPosterModal" x-cloak
                class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/90 backdrop-blur-md"
                x-transition:enter="transition ease-out duration-200"
                x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100"
                x-transition:leave="transition ease-in duration-150"
                x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0">

                <div class="relative max-w-3xl w-full max-h-[90vh] bg-navy rounded-3xl overflow-hidden border-2 border-orange/50 shadow-2xl flex flex-col"
                    @click.outside="showPosterModal = false">
                    
                    <div class="flex items-center justify-between px-6 py-4 bg-navy-dark border-b border-white/10 text-cream">
                        <div class="flex items-center gap-2">
                            <span class="text-orange">📢</span>
                            <span class="font-bold text-sm truncate">
                                Poster {{ $currentBatch->nama_batch ?? 'Sekolah Pranikah' }}
                            </span>
                        </div>
                        <button @click="showPosterModal = false"
                            class="w-8 h-8 rounded-xl bg-white/10 hover:bg-white/20 text-white flex items-center justify-center text-xs transition"
                            aria-label="Tutup Poster">
                            ✕
                        </button>
                    </div>

                    <div class="overflow-auto p-4 flex items-center justify-center bg-black/40 flex-1">
                        <img src="{{ $batchPoster }}" alt="Poster Detail"
                            class="max-h-[75vh] w-auto object-contain rounded-xl shadow-lg">
                    </div>

                    <div class="p-4 bg-navy-dark border-t border-white/10 flex items-center justify-between text-xs text-cream/70">
                        <span>Gunakan tombol esc untuk menutup.</span>
                        @if ($isBatchOpen)
                            <a href="{{ route('spn.daftar.step1') }}"
                                class="px-4 py-2 rounded-xl bg-orange hover:bg-orange/90 text-white font-bold transition">
                                Daftar Sekarang &rarr;
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        @endif

        <!-- ================= GALLERY LIGHTBOX MODAL ================= -->
        <div x-show="lightboxOpen" x-cloak
            class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/95 backdrop-blur-md"
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0">

            <!-- Close Button Top Right -->
            <button @click="lightboxOpen = false"
                class="absolute top-6 right-6 w-11 h-11 rounded-full bg-white/10 hover:bg-white/25 text-white flex items-center justify-center text-lg z-50 transition hover:rotate-90"
                aria-label="Tutup">
                ✕
            </button>

            <!-- Navigation Buttons -->
            <template x-if="photos.length > 1">
                <button @click="prevPhoto()"
                    class="absolute left-4 sm:left-8 top-1/2 -translate-y-1/2 w-12 h-12 rounded-full bg-white/10 hover:bg-white/30 text-white flex items-center justify-center text-lg z-50 transition backdrop-blur-xs"
                    aria-label="Foto Sebelumnya">
                    <i class="fas fa-chevron-left"></i>
                </button>
            </template>

            <template x-if="photos.length > 1">
                <button @click="nextPhoto()"
                    class="absolute right-4 sm:right-8 top-1/2 -translate-y-1/2 w-12 h-12 rounded-full bg-white/10 hover:bg-white/30 text-white flex items-center justify-center text-lg z-50 transition backdrop-blur-xs"
                    aria-label="Foto Selanjutnya">
                    <i class="fas fa-chevron-right"></i>
                </button>
            </template>

            <!-- Modal Content Area -->
            <div class="relative max-w-5xl w-full flex flex-col items-center justify-center" @click.outside="lightboxOpen = false">
                <template x-if="photos.length > 0">
                    <div class="relative flex flex-col items-center">
                        <img :src="photos[currentIndex].url"
                            :alt="photos[currentIndex].title"
                            class="max-h-[75vh] max-w-full object-contain rounded-2xl shadow-2xl border border-white/10">

                        <!-- Photo Information Bar -->
                        <div class="mt-4 text-center px-4 max-w-2xl space-y-1">
                            <h4 class="text-base font-bold text-white" x-text="photos[currentIndex].title"></h4>
                            <p class="text-xs text-gray-300" x-text="photos[currentIndex].description" x-show="photos[currentIndex].description"></p>
                            <p class="text-[11px] text-orange font-bold tracking-wider pt-1">
                                Foto <span x-text="currentIndex + 1"></span> dari <span x-text="photos.length"></span>
                            </p>
                        </div>
                    </div>
                </template>
            </div>

        </div>

    </div>
@endsection
