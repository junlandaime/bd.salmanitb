<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Sekolah Pranikah — Salman ITB')</title>
    <meta name="description" content="@yield('meta_description', 'Sekolah Pranikah Salman ITB: membekali calon pengantin dengan ilmu, mental, dan kesiapan menuju jenjang pernikahan yang sakinah.')" />

    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-WE2HFGE5VL"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag() { dataLayer.push(arguments); }
        gtag('js', new Date());
        gtag('config', 'G-WE2HFGE5VL');
    </script>
    
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="@yield('title', 'Sekolah Pranikah — Salman ITB')">
    <meta property="og:description" content="@yield('meta_description', 'Sekolah Pranikah Salman ITB: membekali calon pengantin dengan ilmu, mental, dan kesiapan menuju jenjang pernikahan yang sakinah.')">
    <meta property="og:image" content="{{ asset('favicon.png') }}">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:url" content="{{ url()->current() }}">
    <meta name="twitter:title" content="@yield('title', 'Sekolah Pranikah — Salman ITB')">
    <meta name="twitter:description" content="@yield('meta_description', 'Sekolah Pranikah Salman ITB: membekali calon pengantin dengan ilmu, mental, dan kesiapan menuju jenjang pernikahan yang sakinah.')">
    <meta name="twitter:image" content="{{ asset('favicon.png') }}">

    <link rel="icon" href="data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 24 24%22><rect width=%2224%22 height=%2224%22 rx=%226%22 fill=%22%23F2773C%22/><path fill=%22white%22 d=%22M12 18.8l-1.1-1c-3.9-3.5-6.4-5.8-6.4-8.7C4.5 6.9 6.2 5.3 8.3 5.3c1.2 0 2.4.6 3.2 1.5.8-.9 2-1.5 3.2-1.5 2.1 0 3.8 1.6 3.8 3.8 0 2.9-2.5 5.2-6.4 8.7l-1.1 1z%22/></svg>" />
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500;600;700;800;900&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        cream: '#FAF3E2',
                        paper: '#F4ECD8',
                        navy: '#1B3460',
                        navydeep: '#11254A',
                        orange: '#F2773C',
                        orangesoft: '#FAD9B6',
                    },
                    fontFamily: {
                        display: ['Poppins', 'sans-serif'],
                        sans: ['"Plus Jakarta Sans"', 'sans-serif'],
                        body: ['"Plus Jakarta Sans"', 'sans-serif'],
                    },
                },
            },
        };
    </script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.14.1/dist/cdn.min.js"></script>
    
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        [x-cloak] { display: none !important; }

        .dot-grid {
            background-image:
                linear-gradient(to right, #E7DBC2 1px, transparent 1px),
                linear-gradient(to bottom, #E7DBC2 1px, transparent 1px);
            background-size: 32px 32px;
        }

        /* Layered "embossed" headline matching poster style */
        .title-3d {
            font-family: 'Poppins', sans-serif;
            font-weight: 900;
            color: #FAF3E2;
            -webkit-text-stroke: 0.05em #1B3460;
            text-stroke: 0.05em #1B3460;
            text-shadow:
                0.09em 0.09em 0 #F2773C,
                0.17em 0.17em 0 #1B3460;
            letter-spacing: 0.03em;
            line-height: 1.05;
        }

        /* Corner anchor marks */
        .frame-marks { position: relative; }
        .frame-marks::before,
        .frame-marks::after,
        .frame-marks > .fm-tr,
        .frame-marks > .fm-bl {
            content: '';
            position: absolute;
            width: 11px;
            height: 11px;
            background: #1B3460;
        }
        .frame-marks::before { top: -6px; left: -6px; }
        .frame-marks::after { bottom: -6px; right: -6px; }
        .frame-marks > .fm-tr { top: -6px; right: -6px; }
        .frame-marks > .fm-bl { bottom: -6px; left: -6px; }

        .tab-active { background-color: #1B3460; color: #FAF3E2; }
        .tab-inactive { background-color: transparent; color: #1B3460; }

        @media (prefers-reduced-motion: no-preference) {
            .fade-up { animation: fadeUp .6s ease-out both; }
            @keyframes fadeUp { from { opacity:0; transform: translateY(14px);} to { opacity:1; transform: translateY(0);} }
        }

        /* Form utilities with new palette */
        .field-label {
            display: block;
            font-size: 0.875rem;
            font-weight: 700;
            color: #1B3460;
            margin-bottom: 0.5rem;
            line-height: 1.4;
        }
        .field-input {
            display: block;
            width: 100%;
            border: 2px solid rgba(27, 52, 96, 0.2);
            border-radius: 0.75rem;
            padding: 0.625rem 0.875rem;
            font-size: 0.875rem;
            color: #11254A;
            background-color: #ffffff;
            transition: border-color 0.15s ease, box-shadow 0.15s ease;
            outline: none;
        }
        .field-input:focus {
            border-color: #F2773C;
            box-shadow: 0 0 0 3px rgba(242, 119, 60, 0.2);
        }
        .field-input::placeholder {
            color: #94A3B8;
        }
        .req {
            color: #F2773C;
            font-weight: 700;
        }
    </style>
    @stack('styles')
</head>
@php
    $currentBatch = $batch ?? \App\Models\ActivityBatch::whereHas('activity', function($q){
        $q->whereIn('slug', ['sekolah-pranikah-offline', 'sekolah-pranikah-online', 'spn']);
    })->where('status', 'aktif')->latest()->first();
    $isBatchOpen = $currentBatch && $currentBatch->isRegistrationOpen();
    $isOnline = ($currentBatch && $currentBatch->activity && $currentBatch->activity->slug === 'sekolah-pranikah-online') 
        || ($currentBatch && str_contains(strtolower($currentBatch->nama_batch ?? ''), 'online'));
    
    // Dynamic theme presets based on batch category
    $bodyBgClass = $isOnline ? 'bg-[#FFF9F5]' : 'bg-cream';
    $paperBgClass = $isOnline ? 'bg-[#FFF0E6]' : 'bg-paper';
@endphp
<body class="{{ $bodyBgClass }} font-sans text-navydeep antialiased selection:bg-orangesoft selection:text-navy">
    
    <!-- ============ TOP ORGANIZER BAR ============ -->
    <div class="border-b border-navy/10 bg-white/70 backdrop-blur-sm">
        <div class="max-w-6xl mx-auto px-5 sm:px-8 py-2.5 flex flex-wrap items-center justify-between gap-3 text-xs">
            <div class="flex items-center gap-2">
                <span class="text-[10px] sm:text-xs font-bold uppercase tracking-[0.15em] text-navy/50">Diselenggarakan oleh:</span>
                <div class="flex items-center gap-1.5">
                    <span class="inline-flex items-center gap-1 rounded bg-navy px-1.5 py-0.5 text-[10px] font-black text-cream">YPM</span>
                    <span class="font-bold text-navy text-[11px]">Yayasan Salman ITB</span>
                    <span class="text-navy/30">&middot;</span>
                    <span class="inline-flex items-center gap-1 rounded bg-orange px-1.5 py-0.5 text-[10px] font-black text-white">SPN</span>
                    <span class="font-bold text-navy text-[11px]">Sekolah Pranikah</span>
                </div>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('home') }}" class="text-navy/70 hover:text-orange font-semibold transition text-[11px] flex items-center gap-1">
                    <span>Portal Bidang Dakwah</span> &rarr;
                </a>
            </div>
        </div>
    </div>

    <!-- ============ MAIN NAVIGATION ============ -->
    <header class="sticky top-0 z-50 border-b border-navy/15 bg-cream/95 backdrop-blur shadow-xs">
        <div x-data="{ mobileOpen: false }">
            <div class="mx-auto flex h-18 max-w-6xl items-center justify-between px-5 sm:px-8 py-3">
                <a href="{{ route('spn.index') }}" class="flex items-center gap-3 shrink-0">
                    <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-navy text-cream font-black text-sm shadow-sm">SPN</span>
                    <span class="leading-tight">
                        <span class="block font-display font-extrabold text-navy text-base tracking-tight">Sekolah Pranikah</span>
                        <span class="block text-[11px] font-bold text-orange">
                            {{ $currentBatch ? ($currentBatch->nama_batch ?? ('Batch ' . $currentBatch->batch_ke)) : 'Salman ITB' }}
                        </span>
                    </span>
                </a>

                <!-- Desktop Nav -->
                <nav class="hidden items-center gap-6 text-xs sm:text-sm font-bold lg:flex text-navy/80">
                    <a href="{{ route('spn.index') }}" class="py-1 transition-colors {{ !isset($activePage) || $activePage === 'beranda' ? 'text-orange font-black border-b-2 border-orange' : 'hover:text-navy' }}">Beranda</a>
                    <a href="{{ route('spn.kurikulum') }}" class="py-1 transition-colors {{ isset($activePage) && $activePage === 'kurikulum' ? 'text-orange font-black border-b-2 border-orange' : 'hover:text-navy' }}">Kurikulum</a>
                    <a href="{{ route('spn.jadwal') }}" class="py-1 transition-colors {{ isset($activePage) && $activePage === 'jadwal' ? 'text-orange font-black border-b-2 border-orange' : 'hover:text-navy' }}">Jadwal</a>
                    <a href="{{ route('spn.pemateri') }}" class="py-1 transition-colors {{ isset($activePage) && $activePage === 'pemateri' ? 'text-orange font-black border-b-2 border-orange' : 'hover:text-navy' }}">Pemateri</a>
                    <a href="{{ route('spn.harga') }}" class="py-1 transition-colors {{ isset($activePage) && $activePage === 'harga' ? 'text-orange font-black border-b-2 border-orange' : 'hover:text-navy' }}">Biaya</a>
                    <a href="{{ route('spn.fasilitas') }}" class="py-1 transition-colors {{ isset($activePage) && $activePage === 'fasilitas' ? 'text-orange font-black border-b-2 border-orange' : 'hover:text-navy' }}">Fasilitas</a>
                    <a href="{{ route('spn.faq') }}" class="py-1 transition-colors {{ isset($activePage) && $activePage === 'faq' ? 'text-orange font-black border-b-2 border-orange' : 'hover:text-navy' }}">FAQ</a>
                </nav>

                <div class="flex items-center gap-2 sm:gap-3">
                    @auth
                        <a href="{{ route('peserta.dashboard') }}" class="inline-flex items-center gap-1.5 rounded-lg border-2 border-navy bg-white px-3.5 py-1.5 text-xs font-bold text-navy hover:bg-navy hover:text-cream transition shadow-xs">
                            <span>Dashboard</span>
                        </a>
                    @else
                        @if($isBatchOpen)
                            <a href="{{ route('spn.daftar.step1') }}" class="hidden sm:inline-flex items-center gap-1.5 rounded-lg bg-orange px-4 py-2 text-xs font-extrabold text-white shadow-xs transition hover:bg-navy">
                                <span>Daftar Sekarang</span> &rarr;
                            </a>
                        @else
                            <a href="https://wa.me/6282126714989?text={{ urlencode('Assalamualaikum panitia SPN, saya ingin menanyakan jadwal pembukaan pendaftaran batch SPN selanjutnya.') }}" target="_blank" class="hidden sm:inline-flex items-center gap-1.5 rounded-lg border border-navy/20 bg-white px-3 py-1.5 text-xs font-bold text-navy hover:bg-orangesoft transition">
                                💬 Info Batch Baru
                            </a>
                        @endif
                    @endauth

                    <button @click="mobileOpen = !mobileOpen" class="flex h-10 w-10 items-center justify-center rounded-lg border-2 border-navy/20 text-navy lg:hidden" :aria-expanded="mobileOpen" aria-label="Buka menu">
                        <span x-show="!mobileOpen"><svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M4 7h16M4 12h16M4 17h16"/></svg></span>
                        <span x-show="mobileOpen" x-cloak><svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M6 6l12 12M18 6L6 18"/></svg></span>
                    </button>
                </div>
            </div>

            <!-- Mobile Drawer -->
            <div x-show="mobileOpen" x-cloak x-transition.duration.200ms class="border-t border-navy/10 bg-cream px-5 pb-5 pt-3 lg:hidden">
                <nav class="flex flex-col gap-1.5 text-sm font-bold">
                    <a href="{{ route('spn.index') }}" class="block rounded-lg px-3 py-2 {{ !isset($activePage) || $activePage === 'beranda' ? 'bg-navy text-cream' : 'text-navy hover:bg-paper' }}">Beranda</a>
                    <a href="{{ route('spn.kurikulum') }}" class="block rounded-lg px-3 py-2 {{ isset($activePage) && $activePage === 'kurikulum' ? 'bg-navy text-cream' : 'text-navy hover:bg-paper' }}">Kurikulum</a>
                    <a href="{{ route('spn.jadwal') }}" class="block rounded-lg px-3 py-2 {{ isset($activePage) && $activePage === 'jadwal' ? 'bg-navy text-cream' : 'text-navy hover:bg-paper' }}">Jadwal</a>
                    <a href="{{ route('spn.pemateri') }}" class="block rounded-lg px-3 py-2 {{ isset($activePage) && $activePage === 'pemateri' ? 'bg-navy text-cream' : 'text-navy hover:bg-paper' }}">Pemateri</a>
                    <a href="{{ route('spn.harga') }}" class="block rounded-lg px-3 py-2 {{ isset($activePage) && $activePage === 'harga' ? 'bg-navy text-cream' : 'text-navy hover:bg-paper' }}">Biaya & Paket</a>
                    <a href="{{ route('spn.fasilitas') }}" class="block rounded-lg px-3 py-2 {{ isset($activePage) && $activePage === 'fasilitas' ? 'bg-navy text-cream' : 'text-navy hover:bg-paper' }}">Fasilitas</a>
                    <a href="{{ route('spn.faq') }}" class="block rounded-lg px-3 py-2 {{ isset($activePage) && $activePage === 'faq' ? 'bg-navy text-cream' : 'text-navy hover:bg-paper' }}">FAQ</a>
                    
                    @if($isBatchOpen)
                        <a href="{{ route('spn.daftar.step1') }}" class="mt-2 block rounded-lg bg-orange px-4 py-2.5 text-center font-extrabold text-white">Daftar Sekarang &rarr;</a>
                    @else
                        <a href="https://wa.me/6282126714989" target="_blank" class="mt-2 block rounded-lg border-2 border-navy bg-white px-4 py-2.5 text-center font-bold text-navy">💬 Hubungi Panitia (WhatsApp)</a>
                    @endif
                </nav>
            </div>
        </div>
    </header>

    <!-- ============ MAIN CONTENT ============ -->
    <main>
        @yield('content')
    </main>

    <!-- ============ FOOTER (STYLE SEKOLAH-PRANIKAH.HTML) ============ -->
    <footer class="px-5 sm:px-8 pt-12 pb-10 bg-cream border-t border-navy/10">
        <div class="max-w-6xl mx-auto">
            <div class="frame-marks border-2 border-navy/40 bg-white p-6 sm:p-8 grid sm:grid-cols-3 gap-8 rounded-sm">
                <div class="fm-tr"></div><div class="fm-bl"></div>

                <!-- Daftar / CTA -->
                <div x-data="{ copied: false }">
                    <p class="font-display font-extrabold text-navy text-sm uppercase tracking-[0.2em] mb-3">Pendaftaran SPN</p>
                    <div class="flex items-center gap-4">
                        <img src="https://api.qrserver.com/v1/create-qr-code/?size=120x120&color=1B3460&data={{ urlencode(route('spn.daftar.step1')) }}" alt="QR Code pendaftaran" class="w-20 h-20 border border-navy/15 rounded-sm bg-cream">
                        <div>
                            @if($isBatchOpen)
                                <a href="{{ route('spn.daftar.step1') }}"
                                   class="inline-flex items-center gap-2 bg-orange text-white text-xs font-bold px-3.5 py-2 rounded-full hover:bg-navy transition-colors">
                                    <span>Daftar Sekarang</span>
                                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path d="M5 12h14M12 5l7 7-7 7" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </a>
                            @else
                                <span class="inline-flex items-center gap-1.5 bg-navy/10 text-navy text-xs font-bold px-3 py-1.5 rounded-full">
                                    Pendaftaran Ditutup
                                </span>
                            @endif
                            <div class="mt-2">
                                <button @click="navigator.clipboard.writeText('{{ route('spn.daftar.step1') }}'); copied = true; setTimeout(() => copied = false, 2000)"
                                        class="text-[11px] text-navy/60 hover:text-orange font-semibold flex items-center gap-1">
                                    <span x-show="!copied">Salin Link Daftar</span>
                                    <span x-show="copied" class="text-emerald-600 font-bold">Tersalin!</span>
                                </button>
                            </div>
                        </div>
                    </div>
                    @if($currentBatch)
                        <p class="text-xs text-navy/80 mt-4"><span class="font-bold">Infak Pendaftaran:</span> Rp {{ number_format($currentBatch->harga, 0, ',', '.') }}</p>
                        @if($currentBatch->tanggal_selesai_pendaftaran)
                            <p class="text-xs text-navy/80"><span class="font-bold">Batas Pendaftaran:</span> {{ $currentBatch->tanggal_selesai_pendaftaran->translatedFormat('d F Y') }}</p>
                        @endif
                    @endif
                </div>

                <!-- Kontak & Alamat -->
                <div>
                    <p class="font-display font-extrabold text-navy text-sm uppercase tracking-[0.2em] mb-3">Informasi &amp; Lokasi</p>
                    <p class="text-xs sm:text-sm text-navy/80 leading-relaxed">
                        Sekretariat Bidang Dakwah, Gedung Kayu Lantai 1, Komplek Masjid Salman ITB, Jl. Ganesha No. 7,
                        Kel. Lebak Siliwangi, Kec. Coblong, Kota Bandung, Jawa Barat
                    </p>
                </div>

                <!-- Media Sosial -->
                <div>
                    <p class="font-display font-extrabold text-navy text-sm uppercase tracking-[0.2em] mb-3">Media Sosial</p>
                    <div class="space-y-2.5 text-xs sm:text-sm text-navy/80">
                        <a href="https://instagram.com/spn.salmanitb" target="_blank" class="flex items-center gap-2.5 hover:text-orange transition">
                            <svg class="w-4 h-4 text-orange shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="5"/><circle cx="12" cy="12" r="3.5"/><circle cx="17.2" cy="6.8" r="0.6" fill="currentColor"/></svg>
                            <span>@spn.salmanitb</span>
                        </a>
                        <a href="https://instagram.com/bidakwah.salmanitb" target="_blank" class="flex items-center gap-2.5 hover:text-orange transition">
                            <svg class="w-4 h-4 text-orange shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="5"/><circle cx="12" cy="12" r="3.5"/><circle cx="17.2" cy="6.8" r="0.6" fill="currentColor"/></svg>
                            <span>@bidakwah.salmanitb</span>
                        </a>
                        <a href="https://wa.me/6282126714989" target="_blank" class="flex items-center gap-2.5 hover:text-orange transition">
                            <svg class="w-4 h-4 text-orange shrink-0" viewBox="0 0 24 24" fill="currentColor"><path d="M12.04 2C6.58 2 2.13 6.45 2.13 11.91c0 1.75.46 3.39 1.26 4.81L2 22l5.42-1.36a9.9 9.9 0 004.62 1.15h.01c5.46 0 9.9-4.45 9.9-9.91 0-2.65-1.03-5.13-2.9-7C17.17 3.03 14.69 2 12.04 2zm0 1.67c2.23 0 4.33.87 5.9 2.45a8.2 8.2 0 012.42 5.79c0 4.53-3.7 8.24-8.25 8.24a8.2 8.2 0 01-4.2-1.15l-.3-.18-3.12.79.83-3.04-.2-.31a8.16 8.16 0 01-1.26-4.37c0-4.53 3.7-8.22 8.18-8.22zm-4.42 4.6c-.16 0-.42.06-.64.31-.22.25-.85.83-.85 2.02 0 1.19.87 2.34.99 2.5.12.16 1.7 2.6 4.13 3.64.58.25 1.03.4 1.38.51.58.18 1.11.16 1.53.1.47-.07 1.44-.59 1.64-1.15.2-.57.2-1.05.14-1.15-.06-.1-.22-.16-.46-.28-.24-.12-1.44-.71-1.66-.79-.22-.08-.39-.12-.55.12-.16.24-.63.79-.78.95-.14.16-.28.18-.52.06-.24-.12-1.02-.38-1.94-1.2-.72-.64-1.2-1.44-1.35-1.68-.14-.24-.02-.37.11-.49.11-.11.24-.28.36-.42.12-.14.16-.24.24-.4.08-.16.04-.3-.02-.42-.06-.12-.55-1.34-.76-1.83-.2-.48-.4-.42-.55-.42h-.47z"/></svg>
                            <span>+62 821-2671-4989</span>
                        </a>
                    </div>
                </div>

            </div>

            <p class="text-center text-xs text-navy/50 mt-8 font-medium">
                Sekolah Pranikah &middot; Salman ITB &mdash; Bidang Dakwah, Sekretariat Salman ITB. All rights reserved.
            </p>
        </div>
    </footer>

    <!-- WhatsApp Floating Button -->
    <a href="https://wa.me/6282126714989?text={{ urlencode('Assalamualaikum panitia SPN Salman ITB, saya ingin bertanya seputar pendaftaran SPN.') }}" target="_blank" rel="noopener"
       class="group fixed bottom-6 right-6 z-40 flex h-13 w-13 items-center justify-center rounded-full bg-orange text-white shadow-lg shadow-orange/30 transition hover:bg-navy hover:scale-105"
       aria-label="Chat WhatsApp Panitia SPN">
        <svg class="w-6 h-6" viewBox="0 0 24 24" fill="currentColor"><path d="M12.04 2C6.58 2 2.13 6.45 2.13 11.91c0 1.75.46 3.39 1.26 4.81L2 22l5.42-1.36a9.9 9.9 0 004.62 1.15h.01c5.46 0 9.9-4.45 9.9-9.91 0-2.65-1.03-5.13-2.9-7C17.17 3.03 14.69 2 12.04 2zm0 1.67c2.23 0 4.33.87 5.9 2.45a8.2 8.2 0 012.42 5.79c0 4.53-3.7 8.24-8.25 8.24a8.2 8.2 0 01-4.2-1.15l-.3-.18-3.12.79.83-3.04-.2-.31a8.16 8.16 0 01-1.26-4.37c0-4.53 3.7-8.22 8.18-8.22zm-4.42 4.6c-.16 0-.42.06-.64.31-.22.25-.85.83-.85 2.02 0 1.19.87 2.34.99 2.5.12.16 1.7 2.6 4.13 3.64.58.25 1.03.4 1.38.51.58.18 1.11.16 1.53.1.47-.07 1.44-.59 1.64-1.15.2-.57.2-1.05.14-1.15-.06-.1-.22-.16-.46-.28-.24-.12-1.44-.71-1.66-.79-.22-.08-.39-.12-.55.12-.16.24-.63.79-.78.95-.14.16-.28.18-.52.06-.24-.12-1.02-.38-1.94-1.2-.72-.64-1.2-1.44-1.35-1.68-.14-.24-.02-.37.11-.49.11-.11.24-.28.36-.42.12-.14.16-.24.24-.4.08-.16.04-.3-.02-.42-.06-.12-.55-1.34-.76-1.83-.2-.48-.4-.42-.55-.42h-.47z"/></svg>
    </a>

    @stack('scripts')
</body>
</html>
