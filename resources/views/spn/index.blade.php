@extends('layouts.spn')

@section('title', 'Sekolah Pranikah — Salman ITB' . ($batch ? ' ' . $batch->nama_batch : ''))
@section('meta_description',
    'Sekolah Pranikah Salman ITB: membekali calon pengantin dengan ilmu, mental, dan kesiapan
    menuju jenjang pernikahan yang sakinah.')

@section('content')
    @php
        $activePage = 'beranda';
        $currentBatch =
            $batch ??
            \App\Models\ActivityBatch::whereHas('activity', function ($q) {
                $q->whereIn('slug', ['sekolah-pranikah-offline', 'sekolah-pranikah-online', 'spn']);
            })
                ->where('status', 'aktif')
                ->latest()
                ->first();
        $isBatchOpen = $currentBatch && $currentBatch->isRegistrationOpen();
    @endphp

    @if (session('info') || session('error'))
        <div class="bg-orange text-white text-center py-3 px-4 text-sm font-bold shadow-xs">
            {{ session('info') ?? session('error') }}
        </div>
    @endif

    @php
        $batchPoster =
            $currentBatch && $currentBatch->featured_image
                ? (str_starts_with($currentBatch->featured_image, 'http')
                    ? $currentBatch->featured_image
                    : \Illuminate\Support\Facades\Storage::url($currentBatch->featured_image))
                : ($activity && $activity->featured_image
                    ? \Illuminate\Support\Facades\Storage::url($activity->featured_image)
                    : null);
        $isOnline =
            ($currentBatch && $currentBatch->activity && $currentBatch->activity->slug === 'sekolah-pranikah-online') ||
            ($currentBatch && str_contains(strtolower($currentBatch->nama_batch ?? ''), 'online'));
        $lokasi = $isOnline ? 'Zoom Meeting Online / Ruang Maya' : 'Komplek Masjid Salman ITB';
    @endphp

    <!-- ============ HERO SECTION ============ -->
    <section class="dot-grid px-5 sm:px-8 pt-10 sm:pt-14 pb-16" x-data="{ showPosterModal: false }">
        <div class="max-w-6xl mx-auto">
            @if ($batchPoster)
                <!-- Two-Column Dynamic Hero with Batch Poster -->
                <div class="grid lg:grid-cols-12 gap-8 sm:gap-12 items-center">
                    <!-- Left: Hero Information & CTAs -->
                    <div class="lg:col-span-7 text-left space-y-6">
                        <div class="inline-flex items-center gap-2">
                            <span class="text-xs sm:text-sm font-extrabold uppercase tracking-[0.3em] text-orange">
                                Bidang Dakwah &middot; Salman ITB
                            </span>
                        </div>

                        <div class="space-y-3">
                            <div class="inline-flex flex-wrap items-center gap-2">
                                <span
                                    class="bg-orangesoft text-navy font-extrabold tracking-wide text-xs sm:text-sm px-3.5 py-1.5 rounded-lg border border-orange/30 shadow-xs">
                                    {{ $currentBatch ? strtoupper($currentBatch->nama_batch ?? 'BATCH ' . $currentBatch->batch_ke) : ($isOnline ? 'SALMAN ITB ONLINE' : 'SALMAN ITB OFFLINE') }}
                                </span>
                                @if ($isBatchOpen)
                                    <span
                                        class="bg-emerald-600 text-white font-extrabold tracking-wide text-xs px-3 py-1.5 rounded-lg shadow-xs flex items-center gap-1.5 animate-pulse">
                                        <span class="w-2 h-2 rounded-full bg-white"></span> Pendaftaran Dibuka!
                                    </span>
                                @else
                                    <span
                                        class="bg-navy/10 text-navy font-bold tracking-wide text-xs px-3 py-1.5 rounded-lg">
                                        Pendaftaran Ditutup
                                    </span>
                                @endif
                            </div>

                            <h1 class="font-display font-black text-4xl sm:text-5xl lg:text-6xl text-navy leading-[1.1]">
                                SEKOLAH<br><span class="text-orange">PRANIKAH</span>
                            </h1>
                            <p class="text-sm sm:text-base text-navy/80 leading-relaxed font-medium max-w-xl">
                                Membekali calon pengantin dengan ilmu syariat, kematangan psikologis, kesiapan medis, hukum,
                                dan perencanaan finansial menuju keluarga sakinah.
                            </p>
                        </div>

                        <!-- Date & Location info card -->
                        @if ($currentBatch && $currentBatch->tanggal_mulai_kegiatan && $currentBatch->tanggal_selesai_kegiatan)
                            <div
                                class="p-4 rounded-xl bg-white border-2 border-navy/15 shadow-xs flex flex-col sm:flex-row sm:items-center justify-between gap-3 text-xs sm:text-sm">
                                <div>
                                    <span class="text-navy/60 font-semibold block text-[11px]">Jadwal Pelaksanaan</span>
                                    <span
                                        class="font-bold text-navy">{{ $currentBatch->tanggal_mulai_kegiatan->translatedFormat('d F') }}
                                        &ndash;
                                        {{ $currentBatch->tanggal_selesai_kegiatan->translatedFormat('d F Y') }}</span>
                                </div>
                                <div
                                    class="sm:text-right border-t sm:border-t-0 sm:border-l border-navy/10 pt-2 sm:pt-0 sm:pl-4">
                                    <span class="text-navy/60 font-semibold block text-[11px]">Format / Lokasi</span>
                                    <span class="font-bold text-navy">{{ $lokasi }}</span>
                                </div>
                            </div>
                        @endif

                        <!-- CTA Row -->
                        <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3 pt-2">
                            @if ($isBatchOpen)
                                <a href="{{ route('spn.daftar.step1') }}"
                                    class="inline-flex items-center justify-center gap-2 bg-orange text-white font-extrabold text-sm sm:text-base px-7 py-3.5 rounded-xl shadow-md hover:bg-navy transition hover:scale-[1.02]">
                                    <span>Daftar Batch Sekarang</span>
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                        stroke-width="2.5">
                                        <path d="M5 12h14M12 5l7 7-7 7" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </a>
                            @else
                                <a href="https://wa.me/6282126714989?text={{ urlencode('Assalamualaikum panitia SPN, saya ingin menanyakan info pembukaan pendaftaran batch berikutnya.') }}"
                                    target="_blank"
                                    class="inline-flex items-center justify-center gap-2 bg-navy text-cream font-extrabold text-sm sm:text-base px-6 py-3.5 rounded-xl shadow-md hover:bg-orange transition">
                                    💬 Info Batch Baru (WhatsApp)
                                </a>
                            @endif
                            <a href="{{ route('spn.kurikulum') }}"
                                class="inline-flex items-center justify-center gap-2 border-2 border-navy bg-white text-navy font-bold text-sm px-6 py-3.5 rounded-xl hover:bg-paper transition">
                                Lihat Kurikulum &rarr;
                            </a>
                        </div>

                        <!-- Brand Heritage -->
                        <div class="pt-2 flex items-center gap-4 text-xs text-navy/60">
                            <span class="font-bold text-navy">🏆 Pelopor sejak 2007</span>
                            <span>&middot;</span>
                            <span>Merk terdaftar di Ditjen KI Kemenkumham RI</span>
                        </div>
                    </div>

                    <!-- Right: Interactive Batch Poster Card -->
                    <div class="lg:col-span-5 flex justify-center">
                        <div class="relative group cursor-pointer w-full max-w-sm" @click="showPosterModal = true">
                            <div
                                class="absolute -inset-2 rounded-2xl bg-orange/20 filter blur-lg opacity-70 group-hover:opacity-100 transition duration-300">
                            </div>
                            <div
                                class="relative rounded-2xl overflow-hidden border-2 border-navy/30 bg-white shadow-xl transition transform duration-300 group-hover:-translate-y-1 group-hover:shadow-2xl">
                                <img src="{{ $batchPoster }}"
                                    alt="Poster {{ $currentBatch->nama_batch ?? 'Sekolah Pranikah' }}"
                                    class="w-full h-auto object-cover max-h-[500px]">
                                <div
                                    class="absolute inset-0 bg-navy/60 opacity-0 group-hover:opacity-100 transition flex flex-col items-center justify-center text-white p-4 text-center backdrop-blur-xs">
                                    <span class="p-3 rounded-full bg-white/20 mb-2">
                                        <svg class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v6m3-3H7" />
                                        </svg>
                                    </span>
                                    <p class="font-extrabold text-sm">Lihat Poster Ukuran Penuh</p>
                                    <p class="text-xs text-white/80 mt-1">Klik untuk memperbesar gambar</p>
                                </div>
                            </div>
                            <div class="mt-2 text-center">
                                <span class="text-[11px] font-semibold text-navy/60">🔍 Klik poster untuk melihat resolusi
                                    tinggi</span>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <!-- Classic Typographic Centered Hero (When No Poster Image Uploaded) -->
                <div class="text-center">
                    <p class="text-xs sm:text-sm font-extrabold uppercase tracking-[0.35em] text-orange mb-6 fade-up">
                        Bidang Dakwah &middot; Sekretariat Salman ITB
                    </p>

                    <div class="frame-marks inline-block border-2 border-navy/40 bg-white px-6 sm:px-14 py-8 sm:py-10 fade-up shadow-sm rounded-sm"
                        style="animation-delay:.05s">
                        <div class="fm-tr"></div>
                        <div class="fm-bl"></div>
                        <h1 class="title-3d text-[2.5rem] sm:text-6xl md:text-7xl lg:text-8xl">
                            SEKOLAH<br>PRANIKAH
                        </h1>
                    </div>

                    <div class="mt-7 flex flex-wrap items-center justify-center gap-3 fade-up" style="animation-delay:.1s">
                        <span
                            class="bg-orangesoft text-navy font-extrabold tracking-wide text-sm sm:text-base px-6 py-2.5 rounded-md shadow-xs border border-orange/30">
                            {{ $currentBatch ? strtoupper($currentBatch->nama_batch ?? 'BATCH ' . $currentBatch->batch_ke) : ($isOnline ? 'SALMAN ITB ONLINE' : 'SALMAN ITB OFFLINE') }}
                        </span>
                        @if ($isBatchOpen)
                            <span
                                class="bg-emerald-600 text-white font-extrabold tracking-wide text-xs sm:text-sm px-4 py-2.5 rounded-md shadow-xs flex items-center gap-1.5 animate-pulse">
                                <span class="w-2 h-2 rounded-full bg-white"></span> Pendaftaran Dibuka!
                            </span>
                        @else
                            <span
                                class="bg-navy/10 text-navy font-bold tracking-wide text-xs sm:text-sm px-4 py-2.5 rounded-md">
                                Pendaftaran Ditutup &mdash; Nantikan Batch Berikutnya
                            </span>
                        @endif
                    </div>

                    <!-- Trio Info -->
                    <div class="mt-12 grid sm:grid-cols-3 gap-8 sm:gap-6 text-left sm:text-center items-start fade-up"
                        style="animation-delay:.15s">
                        <div class="bg-white/80 p-5 rounded-xl border border-navy/10 shadow-xs">
                            <p class="font-display font-semibold text-navy/70 text-sm sm:text-base mb-1">Berlangsung Sejak
                            </p>
                            <p class="font-display font-black text-orange text-4xl sm:text-5xl mb-2">2007</p>
                            <p class="text-xs text-navy/60 italic leading-relaxed max-w-[16rem] sm:mx-auto">
                                Merek telah terdaftar di Direktorat Jenderal Kekayaan Intelektual, Kementerian Hukum RI
                            </p>
                        </div>
                        <div
                            class="flex sm:items-center sm:justify-center bg-white/80 p-5 rounded-xl border border-navy/10 shadow-xs min-h-[140px]">
                            <p class="text-sm sm:text-base font-medium leading-relaxed text-navy max-w-xs sm:mx-auto">
                                Membekali calon pengantin dengan ilmu, mental, dan kesiapan menuju jenjang pernikahan yang
                                sakinah.
                            </p>
                        </div>
                        <div class="bg-white/80 p-5 rounded-xl border border-navy/10 shadow-xs">
                            <p class="font-display font-semibold text-navy/70 text-sm sm:text-base mb-1">Pelopor</p>
                            <p class="font-display font-black text-navy text-2xl sm:text-3xl leading-snug">
                                Sekolah Pranikah
                            </p>
                            <p class="text-orange font-bold italic text-base sm:text-lg mt-1">di Indonesia</p>
                        </div>
                    </div>

                    <!-- CTA Row -->
                    <div class="mt-10 flex flex-col sm:flex-row items-center justify-center gap-4 fade-up"
                        style="animation-delay:.2s">
                        @if ($isBatchOpen)
                            <a href="{{ route('spn.daftar.step1') }}"
                                class="w-full sm:w-auto inline-flex items-center justify-center gap-2 bg-orange text-white font-extrabold text-base px-8 py-4 rounded-xl shadow-md hover:bg-navy transition hover:scale-[1.02]">
                                <span>Daftar Batch Sekarang</span>
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                    stroke-width="2.5">
                                    <path d="M5 12h14M12 5l7 7-7 7" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </a>
                        @else
                            <a href="https://wa.me/6282126714989?text={{ urlencode('Assalamualaikum panitia SPN, saya ingin menanyakan info pembukaan pendaftaran batch berikutnya.') }}"
                                target="_blank"
                                class="w-full sm:w-auto inline-flex items-center justify-center gap-2 bg-navy text-cream font-extrabold text-base px-8 py-4 rounded-xl shadow-md hover:bg-orange transition">
                                💬 Info Batch Baru (WhatsApp)
                            </a>
                        @endif
                        <a href="{{ route('spn.kurikulum') }}"
                            class="w-full sm:w-auto inline-flex items-center justify-center gap-2 border-2 border-navy bg-white text-navy font-bold text-base px-7 py-3.5 rounded-xl hover:bg-paper transition">
                            Lihat Kurikulum Lengkap &rarr;
                        </a>
                    </div>

                    @if ($currentBatch && $currentBatch->tanggal_mulai_kegiatan && $currentBatch->tanggal_selesai_kegiatan)
                        <p class="mt-6 text-xs sm:text-sm font-semibold text-navy/70">
                            📅 Pelaksanaan: <span
                                class="text-navy font-bold">{{ $currentBatch->tanggal_mulai_kegiatan->translatedFormat('d F') }}
                                &ndash; {{ $currentBatch->tanggal_selesai_kegiatan->translatedFormat('d F Y') }}</span>
                            &middot; {{ $lokasi }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <!-- Poster Zoom Modal (Lightbox) -->
        @if ($batchPoster)
            <div x-show="showPosterModal" x-cloak @keydown.escape.window="showPosterModal = false"
                class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-navydeep/80 backdrop-blur-sm"
                x-transition:enter="transition ease-out duration-200"
                x-transition:enter-start="opacity-0 transform scale-95"
                x-transition:enter-end="opacity-100 transform scale-100"
                x-transition:leave="transition ease-in duration-150"
                x-transition:leave-start="opacity-100 transform scale-100"
                x-transition:leave-end="opacity-0 transform scale-95">
                <div class="relative max-w-3xl max-h-[90vh] bg-white rounded-2xl p-2 shadow-2xl overflow-hidden flex flex-col"
                    @click.outside="showPosterModal = false">
                    <div class="flex items-center justify-between p-3 border-b border-navy/10">
                        <span class="font-display font-bold text-navy text-sm">
                            Poster {{ $currentBatch->nama_batch ?? 'Sekolah Pranikah' }}
                        </span>
                        <button @click="showPosterModal = false"
                            class="p-1 rounded-lg text-navy/60 hover:text-navy hover:bg-navy/5">
                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                    <div class="overflow-auto p-2 flex justify-center">
                        <img src="{{ $batchPoster }}" alt="Poster Detail"
                            class="max-h-[75vh] w-auto object-contain rounded-lg">
                    </div>
                </div>
            </div>
        @endif
    </section>

    <!-- ============ HIGHLIGHTS BOXES (DARI DATABASE / FALLBACK) ============ -->
    <section class="px-5 sm:px-8 py-14 bg-paper/60 border-y border-navy/10">
        <div class="max-w-6xl mx-auto">
            <div class="text-center max-w-2xl mx-auto mb-12">
                <p class="text-xs font-extrabold uppercase tracking-[0.25em] text-orange mb-2">Program Unggulan</p>
                <h2 class="font-display font-black text-2xl sm:text-4xl text-navy">Apa yang Anda Dapatkan di SPN?</h2>
                <p class="text-sm text-navy/70 mt-3">Kurikulum menyeluruh yang dirancang secara terpadu antara aspek
                    syariat, psikologi, medis, hukum, dan manajemen keluarga.</p>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 sm:gap-6 text-center">
                @if (isset($highlights) && $highlights->isNotEmpty())
                    @foreach ($highlights as $highlight)
                        <div
                            class="bg-white border-2 border-navy/15 rounded-xl p-6 shadow-xs hover:border-orange transition">
                            <p class="font-display font-black text-orange text-2xl sm:text-3xl">{{ $highlight->title }}
                            </p>
                            <p class="text-xs sm:text-sm text-navy/70 mt-2 font-medium">{{ $highlight->description }}</p>
                        </div>
                    @endforeach
                @else
                    <div class="bg-white border-2 border-navy/15 rounded-xl p-6 shadow-xs hover:border-orange transition">
                        <p class="font-display font-black text-orange text-4xl sm:text-5xl">12</p>
                        <p class="font-bold text-navy text-sm sm:text-base mt-2">Sesi Materi Kognitif</p>
                        <p class="text-xs text-navy/60 mt-1">Pemahaman mendalam seputar pernikahan</p>
                    </div>
                    <div class="bg-white border-2 border-navy/15 rounded-xl p-6 shadow-xs hover:border-orange transition">
                        <p class="font-display font-black text-navy text-4xl sm:text-5xl">5</p>
                        <p class="font-bold text-navy text-sm sm:text-base mt-2">Sesi Praktik</p>
                        <p class="text-xs text-navy/60 mt-1">Latihan psikomotorik & simulasi</p>
                    </div>
                    <div class="bg-white border-2 border-navy/15 rounded-xl p-6 shadow-xs hover:border-orange transition">
                        <p class="font-display font-black text-orange text-4xl sm:text-5xl">13+</p>
                        <p class="font-bold text-navy text-sm sm:text-base mt-2">Layanan Peserta</p>
                        <p class="text-xs text-navy/60 mt-1">Fasilitas dan pendampingan alumni</p>
                    </div>
                    <div class="bg-white border-2 border-navy/15 rounded-xl p-6 shadow-xs hover:border-orange transition">
                        <p class="font-display font-black text-navy text-4xl sm:text-5xl">❤️</p>
                        <p class="font-bold text-navy text-sm sm:text-base mt-2">Ta'aruf Eksklusif</p>
                        <p class="text-xs text-navy/60 mt-1">Layanan ta'aruf terfasilitasi & syar'i</p>
                    </div>
                @endif
            </div>
        </div>
    </section>

    <!-- ============ PREVIEW KURIKULUM / STRUKTUR PERTEMUAN ============ -->
    <section class="px-5 sm:px-8 py-16 bg-cream">
        <div class="max-w-6xl mx-auto">
            <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4 mb-8">
                <div>
                    <p class="text-xs font-extrabold uppercase tracking-[0.25em] text-orange mb-2">Materi & Jadwal</p>
                    <h2 class="font-display font-black text-2xl sm:text-3xl text-navy">Struktur Pertemuan SPN</h2>
                </div>
                <a href="{{ route('spn.jadwal') }}"
                    class="text-xs sm:text-sm font-bold text-navy hover:text-orange flex items-center gap-1 transition">
                    <span>Lihat Jadwal Lengkap</span> &rarr;
                </a>
            </div>

            <!-- Grid Card Pertemuan -->
            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Card 1 -->
                <div class="bg-white border-2 border-navy/20 rounded-xl p-5 shadow-xs flex flex-col justify-between">
                    <div>
                        <div class="flex items-center justify-between border-b border-navy/10 pb-3 mb-3">
                            <span
                                class="font-display font-black text-orange text-lg">{{ $isOnline ? 'Day 1' : 'Pertemuan 1' }}</span>
                            <span class="text-xs font-bold text-navy/60 bg-paper px-2.5 py-1 rounded">Sesi 1 & 2</span>
                        </div>
                        <h3 class="font-display font-bold text-navy text-base leading-snug">Visi Pernikahan Islami &amp;
                            Urgensi Pranikah</h3>
                        <p class="text-xs text-navy/70 mt-2 leading-relaxed">Membangun paradigma pernikahan sebagai ibadah
                            terpanjang dan panduan menjemput jodoh yang berkah.</p>
                    </div>
                    <div class="mt-4 pt-3 border-t border-navy/5 flex items-center justify-between text-xs text-navy/60">
                        <span>{{ $isOnline ? '💻 Zoom Meeting Live' : '🏛️ Gedung Serbaguna (GSG) Salman' }}</span>
                        <span class="font-semibold text-navy">{{ $isOnline ? 'Daring (Live)' : 'Offline' }}</span>
                    </div>
                </div>

                <!-- Card 2 -->
                <div class="bg-white border-2 border-navy/20 rounded-xl p-5 shadow-xs flex flex-col justify-between">
                    <div>
                        <div class="flex items-center justify-between border-b border-navy/10 pb-3 mb-3">
                            <span
                                class="font-display font-black text-orange text-lg">{{ $isOnline ? 'Day 2' : 'Pertemuan 2' }}</span>
                            <span class="text-xs font-bold text-navy/60 bg-paper px-2.5 py-1 rounded">Sesi 3 & 4</span>
                        </div>
                        <h3 class="font-display font-bold text-navy text-base leading-snug">Psikologi Pria-Wanita &amp;
                            Komunikasi Pasangan</h3>
                        <p class="text-xs text-navy/70 mt-2 leading-relaxed">Memahami perbedaan cara berpikir emosional dan
                            simulasi psikomotorik pemecahan masalah pernikahan.</p>
                    </div>
                    <div class="mt-4 pt-3 border-t border-navy/5 flex items-center justify-between text-xs text-navy/60">
                        <span>{{ $isOnline ? '💻 Zoom Meeting Live' : '🏛️ Gedung Serbaguna (GSG) Salman' }}</span>
                        <span class="font-semibold text-navy">{{ $isOnline ? 'Daring (Live)' : 'Offline' }}</span>
                    </div>
                </div>

                <!-- Card 3 -->
                <div class="bg-white border-2 border-navy/20 rounded-xl p-5 shadow-xs flex flex-col justify-between">
                    <div>
                        <div class="flex items-center justify-between border-b border-navy/10 pb-3 mb-3">
                            <span
                                class="font-display font-black text-orange text-lg">{{ $isOnline ? 'Day 3' : 'Pertemuan 3' }}</span>
                            <span class="text-xs font-bold text-navy/60 bg-paper px-2.5 py-1 rounded">Sesi 5 & 6</span>
                        </div>
                        <h3 class="font-display font-bold text-navy text-base leading-snug">Kesehatan Reproduksi &amp;
                            Intimasi Halal</h3>
                        <p class="text-xs text-navy/70 mt-2 leading-relaxed">Panduan medis pra-nikah, fertilitas,
                            kehamilan, dan adab berhubungan suami-istri secara terpisah (ikhwan/akhwat).</p>
                    </div>
                    <div class="mt-4 pt-3 border-t border-navy/5 flex items-center justify-between text-xs text-navy/60">
                        <span>{{ $isOnline ? '💻 Breakout Room Zoom' : '🏛️ Ruang Terpisah Salman' }}</span>
                        <span class="font-semibold text-navy">{{ $isOnline ? 'Daring (Live)' : 'Offline' }}</span>
                    </div>
                </div>
            </div>

            <div class="mt-8 text-center">
                <a href="{{ route('spn.kurikulum') }}"
                    class="inline-flex items-center gap-2 bg-navy text-cream text-xs font-bold px-6 py-3 rounded-lg hover:bg-orange transition">
                    <span>{{ $isOnline ? 'Eksplorasi 7 Hari Kurikulum & Series Fikih' : 'Eksplorasi Seluruh 18 Sesi Materi' }}</span>
                    &rarr;
                </a>
            </div>
        </div>
    </section>

    <!-- ============ TESTIMONIALS (JIKA ADA DARI DATABASE) ============ -->
    @if (isset($testimonials) && $testimonials->isNotEmpty())
        <section class="px-5 sm:px-8 py-16 bg-paper/60 border-t border-navy/10">
            <div class="max-w-6xl mx-auto">
                <div class="text-center max-w-xl mx-auto mb-10">
                    <p class="text-xs font-extrabold uppercase tracking-[0.25em] text-orange mb-2">Kisah Nyata</p>
                    <h2 class="font-display font-black text-2xl sm:text-3xl text-navy">Testimoni Para Alumni</h2>
                </div>
                <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($testimonials as $testi)
                        <div
                            class="bg-white border-2 border-navy/15 rounded-2xl p-6 shadow-xs flex flex-col justify-between">
                            <p class="text-xs sm:text-sm text-navy/80 italic leading-relaxed">
                                "{{ $testi->content }}"
                            </p>
                            <div class="mt-4 pt-4 border-t border-navy/10 flex items-center gap-3">
                                <div
                                    class="w-10 h-10 rounded-full bg-orangesoft text-navy font-bold flex items-center justify-center text-xs">
                                    {{ substr($testi->author, 0, 2) }}
                                </div>
                                <div>
                                    <p class="font-display font-bold text-navy text-xs sm:text-sm">{{ $testi->author }}
                                    </p>
                                    <p class="text-[11px] text-navy/60">{{ $testi->role ?? 'Alumni SPN' }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <!-- ============ FAQ ACCORDION PREVIEW (DARI DATABASE) ============ -->
    @if (isset($faqs) && $faqs->isNotEmpty())
        <section class="px-5 sm:px-8 py-16 bg-cream border-t border-navy/10" x-data="{ open: 0 }">
            <div class="max-w-4xl mx-auto">
                <div class="text-center mb-10">
                    <p class="text-xs font-extrabold uppercase tracking-[0.25em] text-orange mb-2">Tanya &amp; Jawab</p>
                    <h2 class="font-display font-black text-2xl sm:text-3xl text-navy">Pertanyaan Umum</h2>
                </div>
                <div class="space-y-4">
                    @foreach ($faqs->take(4) as $idx => $faq)
                        <div class="bg-white border-2 border-navy/15 rounded-xl overflow-hidden shadow-xs">
                            <button @click="open = (open === {{ $idx }} ? null : {{ $idx }})"
                                class="w-full flex items-center justify-between p-5 text-left transition hover:bg-paper/40">
                                <span
                                    class="font-display font-bold text-navy text-sm sm:text-base">{{ $faq->question }}</span>
                                <span class="text-orange font-bold text-lg shrink-0 ml-3"
                                    x-text="open === {{ $idx }} ? '−' : '+'"></span>
                            </button>
                            <div x-show="open === {{ $idx }}" x-collapse
                                class="px-5 pb-5 text-xs sm:text-sm text-navy/80 leading-relaxed border-t border-navy/10 pt-3">
                                {!! nl2br(e($faq->answer)) !!}
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="mt-6 text-center">
                    <a href="{{ route('spn.faq') }}"
                        class="text-xs sm:text-sm font-bold text-navy hover:text-orange transition">
                        Lihat Seluruh Pertanyaan (FAQ) &rarr;
                    </a>
                </div>
            </div>
        </section>
    @endif

    <!-- ============ BANNER AKHIR ============ -->
    <section class="px-5 sm:px-8 py-16 bg-navy text-cream text-center">
        <div class="max-w-4xl mx-auto">
            <h2 class="font-display font-black text-2xl sm:text-4xl leading-tight">Siap Membangun Fondasi Keluarga Sakinah?
            </h2>
            <p class="mt-4 text-sm sm:text-base text-cream/80 max-w-xl mx-auto">
                Bekali diri Anda sekarang. Jangan biarkan ketidaktahuan menjadi sumber keraguan menuju gerbang pernikahan.
            </p>
            <div class="mt-8 flex flex-wrap items-center justify-center gap-4">
                @if ($isBatchOpen)
                    <a href="{{ route('spn.daftar.step1') }}"
                        class="inline-flex items-center gap-2 bg-orange text-white font-extrabold text-sm sm:text-base px-8 py-3.5 rounded-xl shadow-lg hover:bg-white hover:text-navy transition">
                        <span>Daftar Sekarang Juga</span> &rarr;
                    </a>
                @else
                    <a href="https://wa.me/6282126714989" target="_blank"
                        class="inline-flex items-center gap-2 bg-orange text-white font-extrabold text-sm sm:text-base px-8 py-3.5 rounded-xl shadow-lg hover:bg-white hover:text-navy transition">
                        💬 Hubungi Panitia SPN (WhatsApp)
                    </a>
                @endif
            </div>
        </div>
    </section>
@endsection
