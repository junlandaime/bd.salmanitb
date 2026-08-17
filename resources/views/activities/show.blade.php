@extends('layouts.app')

@section('title', $activity->title . ' - Bidang Dakwah Masjid Salman ITB')
@section('meta_description', Str::limit($activity->description, 160))
@section('og_title', $activity->title . ' - Bidang Dakwah Masjid Salman ITB')
@section('og_description', Str::limit($activity->description, 200))
@section('og_image', 'https://bidangdakwah.salmanitb.com/storage/' . $activity->featured_image)
 
@section('content')
    <style>
        .sales-container { max-width: 1200px; margin: 0 auto; padding-left: 1rem; padding-right: 1rem; }
        .soft-container { max-width: 1200px; margin: 0 auto; padding-left: 1rem; padding-right: 1rem; }

        /* Gradient text */
        .gradient-text {
            background: linear-gradient(135deg, #10b981, #34d399, #6ee7b7);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* Glass card */
        .glass-card {
            background: rgba(255, 255, 255, 0.12);
            backdrop-filter: saturate(1.5) blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.18);
        }

        /* Pulse glow for CTA */
        .cta-glow {
            animation: ctaGlow 2.5s ease-in-out infinite;
        }
        @keyframes ctaGlow {
            0%, 100% { box-shadow: 0 0 20px rgba(16, 185, 129, 0.3), 0 4px 24px rgba(0,0,0,0.1); }
            50% { box-shadow: 0 0 40px rgba(16, 185, 129, 0.5), 0 8px 32px rgba(0,0,0,0.15); }
        }

        /* Dot pattern */
        .dot-pattern {
            background-image: radial-gradient(rgba(255,255,255, 0.08) 1px, transparent 1px);
            background-size: 20px 20px;
        }

        /* Number counter animation */
        .counter-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .counter-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
        }

        /* Pricing card highlight */
        .pricing-highlight {
            position: relative;
            overflow: hidden;
        }
        .pricing-highlight::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: conic-gradient(from 0deg, transparent, rgba(16,185,129,0.1), transparent 30%);
            animation: rotateBorder 4s linear infinite;
        }
        @keyframes rotateBorder {
            100% { transform: rotate(360deg); }
        }

        /* Floating CTA */
        .floating-cta {
            transition: transform 0.3s ease, opacity 0.3s ease;
        }

        /* Section badge */
        .section-badge { letter-spacing: 0.06em; }

        /* Smooth scroll offset */
        html { scroll-behavior: smooth; }
        [id] { scroll-margin-top: 80px; }
    </style>

    @php
        $registrationStatus = [
            'closed' => !$activeBatch && $upcomingBatches->isEmpty(),
            'upcoming' => !$activeBatch && $upcomingBatches->isNotEmpty(),
            'open' => $activeBatch && now()->between($activeBatch->tanggal_mulai_pendaftaran, $activeBatch->tanggal_selesai_pendaftaran),
            'ending_soon' => $activeBatch && now()->between(
                $activeBatch->tanggal_selesai_pendaftaran->subDays(7),
                $activeBatch->tanggal_selesai_pendaftaran,
            ),
        ];

        // Dummy data for new sections (will be replaced with DB data later)
        $totalAlumni = 1200;
        $totalBatch = 15;
        $satisfactionRate = 98;

        $benefits = [
            'Modul pembelajaran lengkap',
            'Sertifikat kelulusan',
            'Akses grup alumni seumur hidup',
            'Konsultasi dengan mentor',
            'Rekaman materi (jika online)',
        ];

        $mentors = [
            ['name' => 'Ustadz Ahmad Fauzi, Lc., M.A.', 'role' => 'Dosen & Konselor Keluarga', 'expertise' => 'Fiqh Munakahat & Keluarga Sakinah'],
            ['name' => 'Dr. Siti Nurhaliza, M.Psi.', 'role' => 'Psikolog Klinis', 'expertise' => 'Psikologi Pernikahan & Keluarga'],
            ['name' => 'Ustadz Rizki Ramdani, S.Pd.I.', 'role' => 'Praktisi Dakwah', 'expertise' => 'Komunikasi Efektif dalam Rumah Tangga'],
        ];
    @endphp

    {{-- ========================= 1. HERO SECTION ========================= --}}
    <section class="relative isolate overflow-hidden bg-gradient-to-br from-emerald-800 via-emerald-700 to-teal-800 text-white min-h-[85vh] flex items-center">
        {{-- Background Image Overlay --}}
        <div class="absolute inset-0 z-0">
            <img src="{{ Storage::url($activity->featured_image) }}" alt="{{ $activity->title }}" class="w-full h-full object-cover opacity-15">
            <div class="absolute inset-0 bg-gradient-to-b from-emerald-900/60 via-emerald-800/40 to-emerald-900/80"></div>
        </div>

        {{-- Decorative --}}
        <div aria-hidden="true" class="absolute -top-32 -left-32 h-80 w-80 rounded-full bg-emerald-500/20 blur-3xl"></div>
        <div aria-hidden="true" class="absolute -bottom-32 -right-32 h-80 w-80 rounded-full bg-teal-400/15 blur-3xl"></div>
        <div aria-hidden="true" class="absolute inset-0 dot-pattern"></div>

        <div class="sales-container relative z-10 py-20 md:py-28 w-full">
            <div class="text-center max-w-4xl mx-auto">
                {{-- Program Badge --}}
                <div data-aos="fade-down" data-aos-delay="100">
                    <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white/10 border border-white/20 text-sm font-medium mb-6 backdrop-blur-sm">
                        <svg class="w-4 h-4 text-emerald-300" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.762zM9.3 16.573A9.026 9.026 0 007 14.935v-2.957l2.4 1.028a3 3 0 002.2 0l5.4-2.312v2.957a9.026 9.026 0 01-2.3 1.638 8.988 8.988 0 01-5.4.284z"/>
                        </svg>
                        Program {{ $activity->program->title }}
                    </span>
                </div>

                {{-- Title --}}
                <h1 class="text-4xl md:text-6xl lg:text-7xl font-extrabold leading-tight mb-6" data-aos="fade-up" data-aos-delay="200">
                    {{ $activity->title }}
                </h1>

                {{-- Subtitle / Overview --}}
                <p class="text-lg md:text-xl text-white/80 max-w-3xl mx-auto mb-10 leading-relaxed" data-aos="fade-up" data-aos-delay="300">
                    {{ $activity->overview ?? Str::limit($activity->description, 200) }}
                </p>

                {{-- Social Proof Stats --}}
                <div class="flex flex-wrap justify-center gap-6 md:gap-10 mb-12" data-aos="fade-up" data-aos-delay="400">
                    <div class="counter-card text-center px-6 py-3 rounded-2xl bg-white/8 backdrop-blur-sm border border-white/10">
                        <div class="text-3xl md:text-4xl font-extrabold text-emerald-300"
                             x-data="{ count: 0 }" x-init="setTimeout(() => { let i = setInterval(() => { count += Math.ceil({{ $totalAlumni }} / 40); if (count >= {{ $totalAlumni }}) { count = {{ $totalAlumni }}; clearInterval(i); } }, 30); }, 500)"
                             x-text="count.toLocaleString('id-ID') + '+'">0</div>
                        <div class="text-sm text-white/60 mt-1">Alumni</div>
                    </div>
                    <div class="counter-card text-center px-6 py-3 rounded-2xl bg-white/8 backdrop-blur-sm border border-white/10">
                        <div class="text-3xl md:text-4xl font-extrabold text-emerald-300"
                             x-data="{ count: 0 }" x-init="setTimeout(() => { let i = setInterval(() => { count++; if (count >= {{ $totalBatch }}) { count = {{ $totalBatch }}; clearInterval(i); } }, 80); }, 700)"
                             x-text="count + ' Batch'">0</div>
                        <div class="text-sm text-white/60 mt-1">Telah Dilaksanakan</div>
                    </div>
                    <div class="counter-card text-center px-6 py-3 rounded-2xl bg-white/8 backdrop-blur-sm border border-white/10">
                        <div class="text-3xl md:text-4xl font-extrabold text-emerald-300"
                             x-data="{ count: 0 }" x-init="setTimeout(() => { let i = setInterval(() => { count++; if (count >= {{ $satisfactionRate }}) { count = {{ $satisfactionRate }}; clearInterval(i); } }, 20); }, 900)"
                             x-text="count + '%'">0</div>
                        <div class="text-sm text-white/60 mt-1">Kepuasan Peserta</div>
                    </div>
                </div>

                {{-- Hero CTA + Countdown --}}
                @if ($registrationStatus['open'] || $registrationStatus['ending_soon'])
                    <div data-aos="zoom-in" data-aos-delay="500">
                        {{-- Countdown Timer --}}
                        @if ($activeBatch)
                            <div class="mb-6" x-data="countdown()" x-init="start('{{ $activeBatch->tanggal_selesai_pendaftaran->endOfDay()->toIso8601String() }}')">
                                <p class="text-sm text-white/60 mb-3 uppercase tracking-wider font-medium">
                                    {{ $registrationStatus['ending_soon'] ? '⚡ Pendaftaran segera ditutup' : 'Pendaftaran ditutup dalam' }}
                                </p>
                                <div class="flex justify-center gap-3 md:gap-4">
                                    <div class="bg-white/10 backdrop-blur-sm border border-white/15 rounded-xl px-4 py-3 min-w-[70px]">
                                        <div class="text-2xl md:text-3xl font-extrabold" x-text="days">00</div>
                                        <div class="text-xs text-white/50 mt-1">Hari</div>
                                    </div>
                                    <div class="bg-white/10 backdrop-blur-sm border border-white/15 rounded-xl px-4 py-3 min-w-[70px]">
                                        <div class="text-2xl md:text-3xl font-extrabold" x-text="hours">00</div>
                                        <div class="text-xs text-white/50 mt-1">Jam</div>
                                    </div>
                                    <div class="bg-white/10 backdrop-blur-sm border border-white/15 rounded-xl px-4 py-3 min-w-[70px]">
                                        <div class="text-2xl md:text-3xl font-extrabold" x-text="minutes">00</div>
                                        <div class="text-xs text-white/50 mt-1">Menit</div>
                                    </div>
                                    <div class="bg-white/10 backdrop-blur-sm border border-white/15 rounded-xl px-4 py-3 min-w-[70px]">
                                        <div class="text-2xl md:text-3xl font-extrabold" x-text="seconds">00</div>
                                        <div class="text-xs text-white/50 mt-1">Detik</div>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                            @if(in_array($activity->slug, ['sekolah-pranikah-offline', 'sekolah-pranikah-online']))
                                <a href="{{ route('spn.daftar.step1') }}"
                                   class="cta-glow inline-flex items-center gap-3 px-10 py-5 rounded-2xl bg-white text-emerald-700 font-bold text-lg hover:scale-105 transition-all duration-300 shadow-xl">
                                    Daftar Sekarang
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                                    </svg>
                                </a>
                                <a href="{{ route('spn.kurikulum', ['type' => $activity->slug === 'sekolah-pranikah-online' ? 'online' : 'offline']) }}"
                                   class="inline-flex items-center gap-2 px-6 py-4 rounded-2xl bg-white/10 hover:bg-white/20 border border-white/20 font-semibold transition-all duration-300">
                                    Lihat Kurikulum &amp; Pemateri
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/>
                                    </svg>
                                </a>
                            @else
                                <a href="#daftar"
                                   class="cta-glow inline-flex items-center gap-3 px-10 py-5 rounded-2xl bg-white text-emerald-700 font-bold text-lg hover:scale-105 transition-all duration-300">
                                    Daftar Sekarang
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                                    </svg>
                                </a>
                                <a href="#tentang"
                                   class="inline-flex items-center gap-2 px-6 py-4 rounded-2xl bg-white/10 hover:bg-white/20 border border-white/20 font-semibold transition-all duration-300">
                                    Pelajari Dulu
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/>
                                    </svg>
                                </a>
                            @endif
                        </div>
                    </div>
                @elseif ($registrationStatus['upcoming'])
                    <div data-aos="zoom-in" data-aos-delay="500">
                        <div class="inline-flex items-center gap-3 px-6 py-3 bg-amber-400/20 border border-amber-400/30 text-amber-200 rounded-full mb-4 backdrop-blur-sm">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            <span class="font-bold">Dibuka {{ $upcomingBatches->first()->tanggal_mulai_pendaftaran->format('d F Y') }}</span>
                        </div>
                        <p class="text-white/70">Batch selanjutnya akan segera dibuka. Pelajari dulu programnya!</p>
                    </div>
                @else
                    <div data-aos="zoom-in" data-aos-delay="500">
                        <div class="inline-flex items-center gap-2 px-6 py-3 bg-white/10 border border-white/20 rounded-full backdrop-blur-sm">
                            <svg class="w-5 h-5 text-white/60" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <span class="font-medium text-white/70">Nantikan Batch Selanjutnya</span>
                        </div>
                    </div>
                @endif

                {{-- Scroll Indicator --}}
                <div class="mt-16 animate-bounce">
                    <svg class="w-6 h-6 mx-auto text-white/40" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/>
                    </svg>
                </div>
            </div>
        </div>
    </section>

    {{-- ========================= 2. ABOUT / STORYTELLING ========================= --}}
    <section id="tentang" class="py-20 bg-white relative overflow-hidden">
        <div aria-hidden="true" class="absolute top-0 right-0 w-[500px] h-[500px] bg-emerald-50 rounded-full blur-3xl -z-10 opacity-60"></div>

        <div class="sales-container">
            <div class="grid md:grid-cols-2 gap-16 items-center">
                <div data-aos="fade-right">
                    @if ($activity->is_featured)
                        <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full bg-amber-100 text-amber-700 text-xs font-semibold mb-4">
                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                            </svg>
                            Kegiatan Unggulan
                        </span>
                    @endif

                    <span class="inline-flex px-3 py-1 rounded-full bg-emerald-100 text-emerald-700 section-badge text-xs mb-3">
                        TENTANG KEGIATAN
                    </span>
                    <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">{{ $activity->title }}</h2>
                    <div class="h-1 w-20 bg-gradient-to-r from-emerald-600 to-emerald-400 rounded-full mb-6"></div>

                    <div class="prose prose-lg max-w-none text-gray-600">
                        <p class="mb-4">
                            {{ $activity->title }} adalah kegiatan unggulan di bawah Program
                            <span class="font-semibold text-emerald-600">{{ $activity->program->title }}</span>
                            dari Bidang Dakwah Masjid Salman ITB.
                        </p>
                        <div class="space-y-3">
                            {!! nl2br(e($activity->description)) !!}
                        </div>
                    </div>
                </div>

                <div data-aos="fade-left" data-aos-delay="200">
                    <div class="relative">
                        <div class="rounded-2xl overflow-hidden shadow-2xl transform hover:scale-[1.02] transition-transform duration-500">
                            <img src="{{ Storage::url($activity->featured_image) }}" alt="{{ $activity->title }}" class="w-full h-full object-cover">
                        </div>
                        <div class="absolute -bottom-6 -left-6 w-24 h-24 rounded-full bg-emerald-200/50 -z-10"></div>
                        <div class="absolute -top-6 -right-6 w-20 h-20 rounded-full border-4 border-emerald-200/50 -z-10"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ========================= 3. HIGHLIGHTS (existing include) ========================= --}}
    @include('activities.section-highlight', ['highlights' => $activity->highlights])

    {{-- ========================= 4. LEARNING PATH (existing include) ========================= --}}
    @include('activities.section-learning-path', ['learningPaths' => $activity->learningPath])

    {{-- ========================= 5. MENTOR SECTION (dummy data) ========================= --}}
    <section class="py-20 bg-white relative overflow-hidden">
        <div aria-hidden="true" class="absolute top-0 left-0 w-96 h-96 bg-emerald-50/50 rounded-full blur-3xl -z-10"></div>

        <div class="sales-container">
            <div class="text-center mb-14" data-aos="fade-up">
                <span class="inline-flex px-3 py-1 rounded-full bg-emerald-100 text-emerald-700 section-badge text-xs mb-3">
                    PARA MENTOR
                </span>
                <h2 class="text-3xl md:text-4xl font-bold mb-4">Belajar dari Ahlinya</h2>
                <div class="h-1 w-20 bg-gradient-to-r from-emerald-600 to-emerald-400 rounded-full mx-auto mb-4"></div>
                <p class="text-gray-600 max-w-2xl mx-auto">
                    Dibimbing oleh para mentor berpengalaman di bidangnya
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-5xl mx-auto">
                @foreach ($mentors as $index => $mentor)
                    <div data-aos="fade-up" data-aos-delay="{{ $index * 150 }}">
                        <div class="group bg-white rounded-2xl p-8 shadow-lg hover:shadow-2xl transition-all duration-500 border border-gray-100 hover:border-emerald-200 text-center h-full">
                            {{-- Avatar Placeholder --}}
                            <div class="w-24 h-24 mx-auto mb-6 rounded-full bg-gradient-to-br from-emerald-400 to-teal-500 flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform duration-500">
                                <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                            </div>
                            <h4 class="text-lg font-bold text-gray-900 mb-1 group-hover:text-emerald-600 transition-colors">{{ $mentor['name'] }}</h4>
                            <p class="text-sm text-emerald-600 font-medium mb-3">{{ $mentor['role'] }}</p>
                            <p class="text-sm text-gray-500">{{ $mentor['expertise'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ========================= 6. TESTIMONIALS (existing include) ========================= --}}
    @include('activities.section-testimonials', ['testimonials' => $activity->testimonials])

    {{-- ========================= 7. GALLERY (existing include) ========================= --}}
    @include('activities.section-gallery', ['gallery' => $activity->gallery])

    {{-- ========================= 8. PRICING / CTA SECTION ========================= --}}
    @if ($registrationStatus['open'] || $registrationStatus['ending_soon'])
        <section id="daftar" class="py-20 bg-gradient-to-br from-emerald-800 via-emerald-700 to-teal-800 relative overflow-hidden">
            <div aria-hidden="true" class="absolute inset-0 dot-pattern"></div>
            <div aria-hidden="true" class="absolute -top-40 -right-40 w-80 h-80 rounded-full bg-emerald-500/20 blur-3xl"></div>
            <div aria-hidden="true" class="absolute -bottom-40 -left-40 w-80 h-80 rounded-full bg-teal-400/15 blur-3xl"></div>

            <div class="sales-container relative z-10">
                <div class="text-center mb-14" data-aos="fade-up">
                    <span class="inline-flex px-3 py-1 rounded-full bg-white/10 text-white section-badge text-xs mb-3 border border-white/20">
                        INVESTASI TERBAIK
                    </span>
                    <h2 class="text-3xl md:text-5xl font-extrabold text-white mb-4">Siap Memulai Perjalanan?</h2>
                    <p class="text-lg text-white/70 max-w-2xl mx-auto">
                        Investasi untuk masa depan yang lebih baik dimulai dari sini
                    </p>
                </div>

                <div class="max-w-lg mx-auto" data-aos="zoom-in" data-aos-delay="200">
                    {{-- Pricing Card --}}
                    <div class="relative">
                        {{-- Popular Badge --}}
                        @if ($registrationStatus['ending_soon'])
                            <div class="absolute -top-4 left-1/2 -translate-x-1/2 z-20">
                                <span class="px-5 py-2 bg-amber-400 text-amber-900 text-sm font-bold rounded-full shadow-lg animate-pulse">
                                    ⚡ Kuota Terbatas!
                                </span>
                            </div>
                        @else
                            <div class="absolute -top-4 left-1/2 -translate-x-1/2 z-20">
                                <span class="px-5 py-2 bg-emerald-400 text-emerald-900 text-sm font-bold rounded-full shadow-lg">
                                    ✨ Pendaftaran Dibuka
                                </span>
                            </div>
                        @endif

                        <div class="bg-white rounded-3xl p-10 shadow-2xl relative overflow-hidden">
                            {{-- Batch Image --}}
                            @if ($activeBatch->featured_image)
                                <div class="mb-6 -mx-4 -mt-4">
                                    <img src="{{ Storage::url($activeBatch->featured_image) }}"
                                         alt="{{ $activeBatch->nama_batch }}"
                                         class="w-full rounded-xl shadow-md">
                                </div>
                            @endif

                            {{-- Batch Title --}}
                            <div class="text-center mb-8">
                                <h3 class="text-xl font-bold text-gray-900 mb-1">
                                    Batch {{ $activeBatch->batch_ke }} — {{ $activeBatch->nama_batch }}
                                </h3>
                                <p class="text-sm text-gray-500">
                                    {{ $activeBatch->tanggal_mulai_kegiatan->format('d M') }} – {{ $activeBatch->tanggal_selesai_kegiatan->format('d M Y') }}
                                </p>
                            </div>

                            {{-- Price --}}
                            <div class="text-center mb-8">
                                <div class="text-5xl font-extrabold text-emerald-600 mb-2">
                                    Rp {{ number_format($activeBatch->harga, 0, ',', '.') }}
                                </div>
                                <p class="text-sm text-gray-500">Investasi per peserta</p>
                            </div>

                            {{-- Benefits List --}}
                            <div class="space-y-3 mb-10">
                                @foreach ($benefits as $benefit)
                                    <div class="flex items-center gap-3">
                                        <div class="flex-shrink-0 w-6 h-6 rounded-full bg-emerald-100 flex items-center justify-center">
                                            <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                            </svg>
                                        </div>
                                        <span class="text-gray-700">{{ $benefit }}</span>
                                    </div>
                                @endforeach
                            </div>

                            {{-- Kuota Info --}}
                            <div class="bg-emerald-50 rounded-xl p-4 mb-6 flex items-center justify-between">
                                <div>
                                    <p class="text-sm text-gray-600">Sisa Kuota</p>
                                    <p class="text-lg font-bold text-emerald-700">{{ $activeBatch->kuota }} Peserta</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600">Batas Daftar</p>
                                    <p class="text-lg font-bold text-emerald-700">{{ $activeBatch->tanggal_selesai_pendaftaran->format('d M Y') }}</p>
                                </div>
                            </div>

                            {{-- CTA Button --}}
                            @if(in_array($activity->slug, ['sekolah-pranikah-offline', 'sekolah-pranikah-online']))
                                <a href="{{ route('spn.daftar.step1') }}"
                                   class="cta-glow block w-full text-center px-8 py-5 rounded-2xl bg-gradient-to-r from-emerald-600 to-teal-600 hover:from-emerald-700 hover:to-teal-700 text-white font-bold text-lg transition-all duration-300 hover:scale-[1.02] shadow-lg">
                                    Daftar Sekarang
                                    <span class="block text-sm font-normal text-white/80 mt-1">Form Pendaftaran SPN Salman ITB</span>
                                </a>
                            @else
                                <a href="{{ $activeBatch->external_link ?? '#' }}" target="_blank"
                                   class="cta-glow block w-full text-center px-8 py-5 rounded-2xl bg-gradient-to-r from-emerald-600 to-teal-600 hover:from-emerald-700 hover:to-teal-700 text-white font-bold text-lg transition-all duration-300 hover:scale-[1.02]">
                                    Daftar Sekarang
                                    <span class="block text-sm font-normal text-white/80 mt-1">Pendaftaran mudah &amp; cepat</span>
                                </a>
                            @endif

                            {{-- Trust Badge --}}
                            <div class="mt-6 flex items-center justify-center gap-4 text-sm text-gray-400">
                                <div class="flex items-center gap-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                                    </svg>
                                    Aman & Terpercaya
                                </div>
                                <span class="text-gray-300">•</span>
                                <div class="flex items-center gap-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    Proses Cepat
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @elseif ($registrationStatus['upcoming'])
        <section id="daftar" class="py-20 bg-gradient-to-br from-emerald-800 via-emerald-700 to-teal-800 relative overflow-hidden">
            <div aria-hidden="true" class="absolute inset-0 dot-pattern"></div>
            <div class="sales-container relative z-10">
                <div class="max-w-2xl mx-auto text-center text-white">
                    <h2 class="text-3xl md:text-4xl font-extrabold mb-4" data-aos="fade-up">Batch Selanjutnya Segera Dibuka</h2>
                    <p class="text-lg text-white/70 mb-8" data-aos="fade-up" data-aos-delay="100">
                        Pantau media sosial kami untuk informasi batch terbaru
                    </p>
                    <div class="inline-flex items-center gap-3 px-6 py-3 bg-amber-400/20 border border-amber-400/30 text-amber-200 rounded-full backdrop-blur-sm" data-aos="fade-up" data-aos-delay="200">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        <span class="font-bold">Dibuka {{ $upcomingBatches->first()->tanggal_mulai_pendaftaran->format('d F Y') }}</span>
                    </div>

                    {{-- Social Media --}}
                    <div class="flex justify-center gap-4 mt-8" data-aos="fade-up" data-aos-delay="300">
                        @if ($landingPage->social_instagram ?? false)
                            <a href="{{ $landingPage->social_instagram }}" target="_blank" class="w-12 h-12 rounded-full bg-white/10 hover:bg-white/20 flex items-center justify-center transition border border-white/10">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z" clip-rule="evenodd"/></svg>
                            </a>
                        @endif
                        @if ($landingPage->social_youtube ?? false)
                            <a href="{{ $landingPage->social_youtube }}" target="_blank" class="w-12 h-12 rounded-full bg-white/10 hover:bg-white/20 flex items-center justify-center transition border border-white/10">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M19.812 5.418c.861.23 1.538.907 1.768 1.768C21.998 8.746 22 12 22 12s0 3.255-.418 4.814a2.504 2.504 0 0 1-1.768 1.768c-1.56.419-7.814.419-7.814.419s-6.255 0-7.814-.419a2.505 2.505 0 0 1-1.768-1.768C2 15.255 2 12 2 12s0-3.255.417-4.814a2.507 2.507 0 0 1 1.768-1.768C5.744 5 11.998 5 11.998 5s6.255 0 7.814.418ZM15.194 12 10 15V9l5.194 3Z" clip-rule="evenodd"/></svg>
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </section>
    @endif

    {{-- ========================= 9. FAQ (existing include) ========================= --}}
    @include('activities.section-faq', ['faqs' => $activity->faqs])

    {{-- ========================= 10. FLOATING CTA BAR (Mobile) ========================= --}}
    @if ($registrationStatus['open'] || $registrationStatus['ending_soon'])
        <div x-data="{ show: false }"
             x-init="window.addEventListener('scroll', () => { show = window.scrollY > 600 })"
             x-show="show"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="translate-y-full opacity-0"
             x-transition:enter-end="translate-y-0 opacity-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="translate-y-0 opacity-100"
             x-transition:leave-end="translate-y-full opacity-0"
             class="fixed bottom-0 left-0 right-0 z-50 md:hidden bg-white/95 backdrop-blur-lg border-t border-gray-200 shadow-[0_-4px_20px_rgba(0,0,0,0.1)] px-4 py-3">
            <div class="flex items-center justify-between gap-4">
                <div>
                    <p class="text-xs text-gray-500">Mulai dari</p>
                    <p class="text-lg font-extrabold text-emerald-600">Rp {{ number_format($activeBatch->harga, 0, ',', '.') }}</p>
                </div>
                <a href="#daftar" class="flex-shrink-0 px-6 py-3 rounded-xl bg-gradient-to-r from-emerald-600 to-teal-600 text-white font-bold text-sm shadow-lg hover:scale-105 transition-all">
                    Daftar Sekarang
                </a>
            </div>
        </div>
    @endif

@endsection

@push('scripts')
<script>
    // Countdown timer component
    function countdown() {
        return {
            days: '00', hours: '00', minutes: '00', seconds: '00',
            interval: null,
            start(deadline) {
                const target = new Date(deadline).getTime();
                this.interval = setInterval(() => {
                    const now = new Date().getTime();
                    const diff = target - now;
                    if (diff <= 0) {
                        clearInterval(this.interval);
                        this.days = '00'; this.hours = '00'; this.minutes = '00'; this.seconds = '00';
                        return;
                    }
                    this.days = String(Math.floor(diff / (1000 * 60 * 60 * 24))).padStart(2, '0');
                    this.hours = String(Math.floor((diff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60))).padStart(2, '0');
                    this.minutes = String(Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60))).padStart(2, '0');
                    this.seconds = String(Math.floor((diff % (1000 * 60)) / 1000)).padStart(2, '0');
                }, 1000);
            }
        }
    }
</script>
@endpush
