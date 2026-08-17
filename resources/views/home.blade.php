@extends('layouts.app')
@section('title', 'Bidang Dakwah Masjid Salman ITB')

@section('content')

    {{-- ========================= HERO SECTION ========================= --}}
    <section id="home"
        class="relative isolate overflow-hidden w-full max-w-full bg-gradient-to-br from-slate-900 via-emerald-950 to-teal-950 text-white pt-8 pb-16 md:pt-14 md:pb-24">
        <!-- Ambient glowing blobs -->
        <div aria-hidden="true"
            class="absolute -top-32 -left-32 h-96 w-96 rounded-full bg-emerald-500/20 blur-3xl pointer-events-none"></div>
        <div aria-hidden="true"
            class="absolute -bottom-32 -right-32 h-96 w-96 rounded-full bg-teal-400/15 blur-3xl pointer-events-none"></div>
        <div
            class="absolute inset-0 opacity-5 bg-[radial-gradient(#fff_1px,transparent_1px)] [background-size:20px_20px] pointer-events-none">
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 w-full">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-10 items-center">

                <!-- Left 7 cols: Content -->
                <div class="lg:col-span-7 space-y-6" data-aos="fade-right" data-aos-duration="700">
                    <div
                        class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-emerald-500/15 border border-emerald-400/30 text-emerald-300 text-xs font-semibold">
                        <span>✨</span>
                        <span>Selamat datang di Bidang Dakwah</span>
                    </div>

                    <div class="space-y-2">
                        <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold tracking-tight text-white leading-tight">
                            Pelopor Pembangunan Peradaban Islami
                        </h1>
                        <h2 class="text-lg sm:text-xl font-semibold text-emerald-300/90">
                            Yayasan Pembina Masjid (YPM) Salman ITB
                        </h2>
                    </div>

                    <div class="text-slate-300 text-sm sm:text-base leading-relaxed max-w-2xl prose prose-invert">
                        {!! $landingpage->hero_subtitle !!}
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex flex-wrap gap-2.5 sm:gap-3 pt-2" data-aos="fade-up" data-aos-delay="150">
                        <a href="{{ route('programs.index') }}"
                            class="inline-flex items-center gap-2 px-5 sm:px-6 py-2.5 sm:py-3 rounded-xl bg-gradient-to-r from-emerald-500 to-teal-500 hover:from-emerald-600 hover:to-teal-600 text-white text-xs sm:text-sm font-bold shadow-lg shadow-emerald-500/25 transition">
                            <span>Jelajahi Program</span>
                            <span>&rarr;</span>
                        </a>
                        <a href="{{ route('spn.index') }}"
                            class="inline-flex items-center gap-2 px-4 sm:px-5 py-2.5 sm:py-3 rounded-xl bg-white/10 hover:bg-white/15 backdrop-blur text-amber-300 hover:text-amber-200 border border-amber-400/30 text-xs sm:text-sm font-semibold transition">
                            <span>✨ Sekolah Pranikah (SPN)</span>
                        </a>
                        @auth
                            <a href="{{ route('taaruf.index') }}"
                                class="inline-flex items-center gap-2 px-4 sm:px-5 py-2.5 sm:py-3 rounded-xl bg-white/10 hover:bg-white/15 backdrop-blur text-rose-300 hover:text-rose-200 border border-rose-400/30 text-xs sm:text-sm font-semibold transition">
                                <span>💍 Ta'aruf Alumni</span>
                            </a>
                        @endauth
                    </div>
                </div>

                <!-- Right 5 cols: Image Card -->
                <div class="lg:col-span-5 relative mt-4 lg:mt-0" data-aos="fade-left" data-aos-duration="700">
                    <div
                        class="relative rounded-3xl p-2.5 sm:p-3 bg-white/5 border border-white/15 backdrop-blur-md shadow-2xl">
                        <img src="{{ $landingpage && $landingpage->hero_image ? Storage::url($landingpage->hero_image) : asset('bd.jpg') }}"
                            alt="Bidang Dakwah Salman ITB"
                            class="w-full aspect-[4/3] object-cover rounded-2xl shadow-inner transition duration-500 hover:scale-[1.02]" />

                        <!-- Overlay floating badge -->
                        <div
                            class="absolute -bottom-3 left-2 sm:-left-4 sm:-bottom-4 bg-slate-900/90 backdrop-blur border border-white/15 rounded-2xl p-3 sm:p-4 shadow-xl flex items-center gap-2.5 sm:gap-3 max-w-[90%]">
                            <div
                                class="w-9 h-9 sm:w-10 sm:h-10 rounded-xl bg-emerald-500/20 border border-emerald-400/30 flex items-center justify-center text-lg sm:text-xl shrink-0">
                                🕌
                            </div>
                            <div class="min-w-0">
                                <p class="text-xs font-bold text-white truncate">YPM Salman ITB</p>
                                <p class="text-[10px] sm:text-[11px] text-emerald-400 truncate">Pusat Pembinaan &amp; Dakwah
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- KPI Quick Stats --}}
            @php
                $statsList = [
                    [
                        'count' => (int) ($landingpage->stats_1 ?? ($landingpage->stats1_count ?? 1000)),
                        'label' => $landingpage->stats1 ?? 'Rumah Quran',
                        'icon' => '👥',
                    ],
                    [
                        'count' => (int) ($landingpage->stats_2 ?? ($landingpage->stats2_count ?? 1200)),
                        'label' => $landingpage->stats2 ?? 'Sekolah Pranikah',
                        'icon' => '📚',
                    ],
                    [
                        'count' => (int) ($landingpage->stats_3 ?? ($landingpage->stats3_count ?? 800)),
                        'label' => $landingpage->stats3 ?? 'Bahasa Arab',
                        'icon' => '🎓',
                    ],
                    [
                        'count' => (int) ($landingpage->stats_4 ?? ($landingpage->stats4_count ?? 300)),
                        'label' => $landingpage->stats4 ?? 'Pemulasaraan Jenazah',
                        'icon' => '✨',
                    ],
                ];
            @endphp
            <div class="mt-14 pt-8 border-t border-white/10 grid grid-cols-2 md:grid-cols-4 gap-4" data-aos="fade-up">
                @foreach ($statsList as $stat)
                    <div class="rounded-2xl p-5 bg-white/5 border border-white/10 backdrop-blur text-center space-y-1 hover:bg-white/10 transition"
                        x-data="{
                            current: 0,
                            target: {{ $stat['count'] }},
                            animate() {
                                let duration = 1400;
                                let start = null;
                                const step = (timestamp) => {
                                    if (!start) start = timestamp;
                                    let progress = Math.min((timestamp - start) / duration, 1);
                                    this.current = Math.floor(progress * this.target);
                                    if (progress < 1) {
                                        window.requestAnimationFrame(step);
                                    } else {
                                        this.current = this.target;
                                    }
                                };
                                window.requestAnimationFrame(step);
                            }
                        }" x-init="animate()">
                        <div class="text-2xl mb-1">{{ $stat['icon'] }}</div>
                        <p class="text-3xl sm:text-4xl font-extrabold text-white">
                            <span x-text="current.toLocaleString('id-ID')">0</span>+
                        </p>
                        <p class="text-xs text-slate-300 font-medium">{{ $stat['label'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ========================= JADWAL KELAS / BATCH MENDATANG ========================= --}}
    @php
        $upcomingPrograms = App\Models\Activity::with([
            'batches' => function ($query) {
                $query
                    ->where('status', 'aktif')
                    ->where(function ($q) {
                        $q->where('tanggal_mulai_pendaftaran', '>=', now())->orWhere(
                            'tanggal_selesai_pendaftaran',
                            '>=',
                            now(),
                        );
                    })
                    ->orderBy('tanggal_mulai_pendaftaran');
            },
        ])
            ->where('status', 'published')
            ->whereHas('batches', function ($query) {
                $query->where('status', 'aktif')->where('tanggal_selesai_pendaftaran', '>=', now());
            })
            ->get();
    @endphp

    <section class="py-16 bg-gray-50/70 w-full max-w-full overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full">
            <div class="text-center max-w-2xl mx-auto mb-12" data-aos="fade-down">
                <span
                    class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-emerald-100 text-emerald-800 text-xs font-bold uppercase tracking-wider">
                    <span>🗓️</span>
                    <span>Pendaftaran Dibuka</span>
                </span>
                <h2 class="mt-3 text-2xl sm:text-3xl font-extrabold text-gray-900 tracking-tight">
                    Jadwal Batch &amp; Kelas Terdekat
                </h2>
                <p class="mt-2 text-xs sm:text-sm text-gray-600">
                    Pilih batch kegiatan aktif dan amankan kuota pendaftaran Anda sekarang.
                </p>
            </div>

            <div class="space-y-4 max-w-5xl mx-auto">
                @forelse($upcomingPrograms as $program)
                    @foreach ($program->batches as $batch)
                        <div class="rounded-2xl bg-white p-5 sm:p-6 border border-gray-200/80 shadow-xs hover:shadow-md hover:border-emerald-300 transition-all duration-300"
                            data-aos="fade-up" data-aos-delay="{{ $loop->parent->index * 80 + $loop->index * 40 }}">
                            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">

                                <div class="space-y-1 flex-1">
                                    <span
                                        class="inline-block px-2.5 py-0.5 rounded-full bg-emerald-50 text-emerald-700 text-[11px] font-bold">
                                        {{ $program->title }}
                                    </span>
                                    <h3 class="text-base sm:text-lg font-bold text-gray-900">
                                        {{ $batch->nama_batch ?? 'Batch ' . ($batch->batch_ke ?? $loop->iteration) }}
                                    </h3>
                                    @if ($batch->kuota)
                                        <p class="text-xs text-gray-500">Kuota: {{ $batch->kuota }} peserta</p>
                                    @endif
                                </div>

                                <div class="flex flex-wrap items-center gap-2 sm:gap-3">
                                    <span
                                        class="inline-flex items-center gap-1.5 rounded-xl bg-emerald-50 text-emerald-800 px-3 py-1.5 font-medium text-xs border border-emerald-100">
                                        <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                                        <span>Mulai: {{ $batch->tanggal_mulai_pendaftaran->format('d M Y') }}</span>
                                    </span>
                                    <span
                                        class="inline-flex items-center gap-1.5 rounded-xl bg-rose-50 text-rose-800 px-3 py-1.5 font-medium text-xs border border-rose-100">
                                        <span class="w-2 h-2 rounded-full bg-rose-500"></span>
                                        <span>Tutup: {{ $batch->tanggal_selesai_pendaftaran->format('d M Y') }}</span>
                                    </span>
                                </div>

                                <div class="pt-2 md:pt-0">
                                    @if (in_array($program->slug, ['sekolah-pranikah-offline', 'sekolah-pranikah-online', 'spn']))
                                        <a href="{{ route('spn.index') }}"
                                            class="inline-flex items-center justify-center gap-1.5 px-5 py-2.5 rounded-xl bg-gradient-to-r from-amber-500 to-amber-600 hover:from-amber-600 hover:to-amber-700 text-white font-bold text-xs shadow-sm shadow-amber-500/20 transition w-full md:w-auto">
                                            <span>Daftar SPN &rarr;</span>
                                        </a>
                                    @else
                                        <a href="{{ route('activities.show', $program->slug) }}"
                                            class="inline-flex items-center justify-center gap-1.5 px-5 py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs shadow-sm transition w-full md:w-auto">
                                            <span>Detail Kegiatan &rarr;</span>
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                @empty
                    <div class="text-center py-12 bg-white rounded-2xl border border-dashed border-gray-200">
                        <div
                            class="w-12 h-12 rounded-2xl bg-gray-100 text-gray-400 flex items-center justify-center text-xl mx-auto mb-2">
                            📅
                        </div>
                        <p class="text-sm font-bold text-gray-800">Belum ada batch pendaftaran yang aktif saat ini.</p>
                        <p class="text-xs text-gray-500 mt-1">Silakan cek kembali nanti atau ikuti media sosial kami untuk
                            informasi terbaru.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    {{-- ========================= PROGRAM UNGGULAN ========================= --}}
    <section id="program" class="py-16 bg-white w-full max-w-full overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full">
            <div class="text-center max-w-2xl mx-auto mb-12" data-aos="fade-down">
                <span
                    class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-emerald-100 text-emerald-800 text-xs font-bold uppercase tracking-wider">
                    <span>📚</span>
                    <span>Program Unggulan</span>
                </span>
                <h2 class="mt-3 text-2xl sm:text-3xl font-extrabold text-gray-900 tracking-tight">
                    Pilihan Program Pembinaan &amp; Dakwah
                </h2>
                <p class="mt-2 text-xs sm:text-sm text-gray-600">
                    Program terpadu untuk membentuk karakter muslim unggul, tangguh, dan berwawasan luas.
                </p>
            </div>

            <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($featuredPrograms as $program)
                    <article
                        class="group rounded-2xl bg-white border border-gray-200/80 shadow-xs hover:shadow-xl hover:border-emerald-300 transition-all duration-300 overflow-hidden flex flex-col"
                        data-aos="zoom-in" data-aos-delay="{{ $loop->index * 80 }}">
                        <a href="{{ route('programs.show', $program->slug) }}"
                            class="block relative overflow-hidden aspect-[16/9]">
                            <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                                src="{{ $program->featured_image ? Storage::url($program->featured_image) : 'https://picsum.photos/600/400' }}"
                                alt="{{ $program->title }}">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/50 via-transparent to-transparent">
                            </div>
                        </a>

                        <div class="p-6 flex-1 flex flex-col justify-between space-y-4">
                            <div>
                                <h3 class="text-base font-bold text-gray-900 group-hover:text-emerald-700 transition">
                                    {{ $program->title }}
                                </h3>
                                <p class="mt-2 text-xs text-gray-600 leading-relaxed line-clamp-3">
                                    {{ Str::limit(strip_tags($program->description), 130) }}
                                </p>
                            </div>

                            <div class="pt-3 border-t border-gray-100 flex items-center justify-between">
                                <span class="text-xs font-bold text-emerald-700 group-hover:underline">Lihat Kurikulum &amp;
                                    Detail</span>
                                <span class="text-emerald-600 font-bold">&rarr;</span>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>

            <div class="text-center mt-10" data-aos="fade-up">
                <a href="{{ route('programs.index') }}"
                    class="inline-flex items-center gap-2 px-6 py-2.5 rounded-xl border border-gray-300 bg-white hover:bg-gray-50 text-gray-800 text-xs font-bold shadow-2xs transition">
                    <span>Lihat Semua Program</span>
                    <span>&rarr;</span>
                </a>
            </div>
        </div>
    </section>

    {{-- ========================= ARTIKEL & BERITA TERBARU ========================= --}}
    <section class="py-16 bg-gray-50/70 w-full max-w-full overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full">
            <div class="grid lg:grid-cols-3 gap-10 items-start">

                {{-- Left 2 cols: Artikel Pilihan --}}
                <div class="lg:col-span-2 space-y-6">
                    <div>
                        <span
                            class="inline-flex px-3 py-1 rounded-full bg-blue-100 text-blue-800 font-bold text-xs uppercase tracking-wider">
                            Artikel Pilihan
                        </span>
                        <h2 class="mt-2 text-2xl sm:text-3xl font-extrabold text-gray-900">
                            Wawasan &amp; Tadabbur
                        </h2>
                    </div>

                    <div class="grid gap-6 sm:grid-cols-2">
                        @foreach ($featuredArticles as $article)
                            <article
                                class="group rounded-2xl bg-white border border-gray-200/80 shadow-xs hover:shadow-lg transition-all duration-300 overflow-hidden"
                                data-aos="zoom-in" data-aos-delay="{{ $loop->index * 80 }}">
                                <a href="{{ route('articles.show', $article->slug) }}" class="block">
                                    <div class="relative overflow-hidden aspect-[16/10]">
                                        <img src="{{ $article->featured_image ? Storage::url($article->featured_image) : 'https://picsum.photos/600/400' }}"
                                            alt="{{ $article->title }}"
                                            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                    </div>
                                    <div class="p-5 space-y-2">
                                        <p class="text-[11px] font-semibold text-gray-400">
                                            {{ $article->published_at ? $article->published_at->format('d M Y') : '' }}
                                        </p>
                                        <h3
                                            class="text-sm font-bold text-gray-900 group-hover:text-emerald-700 transition leading-snug line-clamp-2">
                                            {{ $article->title }}
                                        </h3>
                                        <p class="text-xs text-gray-500 line-clamp-2 leading-relaxed">
                                            {!! Str::limit(strip_tags($article->content), 90) !!}
                                        </p>
                                        <div
                                            class="pt-2 text-xs font-bold text-emerald-600 flex items-center gap-1 group-hover:gap-2 transition-all">
                                            <span>Baca Selengkapnya</span>
                                            <span>&rarr;</span>
                                        </div>
                                    </div>
                                </a>
                            </article>
                        @endforeach
                    </div>
                </div>

                {{-- Right 1 col: Kabar Salman --}}
                <div class="space-y-6">
                    <div>
                        <span
                            class="inline-flex px-3 py-1 rounded-full bg-emerald-100 text-emerald-800 font-bold text-xs uppercase tracking-wider">
                            Berita Terbaru
                        </span>
                        <h2 class="mt-2 text-2xl sm:text-3xl font-extrabold text-gray-900">
                            Kabar Salman
                        </h2>
                    </div>

                    <div class="space-y-4">
                        @foreach ($latestNews as $news)
                            <article
                                class="group rounded-2xl bg-white border border-gray-200/80 shadow-xs hover:shadow-md transition p-3.5"
                                data-aos="fade-left" data-aos-delay="{{ $loop->index * 80 }}">
                                <a href="{{ route('news.show', $news->slug) }}" class="flex gap-3.5 items-center">
                                    <div class="w-20 h-20 flex-shrink-0 rounded-xl overflow-hidden">
                                        <img src="{{ $news->featured_image ? Storage::url($news->featured_image) : 'https://picsum.photos/320/240' }}"
                                            alt="{{ $news->title }}"
                                            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                                    </div>
                                    <div class="flex-1 min-w-0 space-y-1">
                                        <p class="text-[10px] font-semibold text-gray-400">
                                            {{ $news->published_at ? $news->published_at->format('d M Y') : '' }}
                                        </p>
                                        <h4
                                            class="text-xs font-bold text-gray-900 group-hover:text-emerald-700 transition line-clamp-2 leading-snug">
                                            {{ $news->title }}
                                        </h4>
                                        <p class="text-[11px] text-gray-500 line-clamp-1">
                                            {!! Str::limit(strip_tags($news->content), 60) !!}
                                        </p>
                                    </div>
                                </a>
                            </article>
                        @endforeach
                    </div>

                    <div>
                        <a href="{{ route('news.index') }}"
                            class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs shadow-sm transition w-full justify-center">
                            <span>Lihat Semua Berita</span>
                            <span>&rarr;</span>
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </section>

    {{-- ========================= CALL TO ACTION ========================= --}}
    <section class="py-16 bg-white w-full max-w-full overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full">
            <div
                class="bg-gradient-to-br from-slate-900 via-emerald-950 to-teal-950 rounded-3xl p-6 sm:p-12 text-white shadow-xl relative overflow-hidden">
                <div
                    class="absolute inset-0 opacity-10 bg-[radial-gradient(#fff_1px,transparent_1px)] [background-size:16px_16px]">
                </div>

                <div class="grid md:grid-cols-12 gap-6 items-center relative z-10">
                    <div class="md:col-span-8 space-y-2">
                        <span
                            class="inline-flex px-3 py-1 rounded-full bg-emerald-500/20 text-emerald-300 border border-emerald-400/30 text-xs font-bold">
                            Gabung Bersama Kami
                        </span>
                        <h2 class="text-2xl sm:text-3xl font-extrabold text-white">
                            Siap Bertumbuh Bersama Komunitas Salman?
                        </h2>
                        <p class="text-slate-300 text-xs sm:text-sm max-w-xl leading-relaxed">
                            Ikuti program pembinaan, sekolah pranikah, kajian, serta kegiatan dakwah berkualitas bersama
                            jamaah masjid Salman ITB.
                        </p>
                    </div>

                    <div class="md:col-span-4 flex md:justify-end">
                        <a href="{{ route('programs.index') }}"
                            class="inline-flex items-center gap-2 px-6 py-3 rounded-xl bg-gradient-to-r from-emerald-500 to-teal-500 hover:from-emerald-600 hover:to-teal-600 text-white font-bold text-xs shadow-lg shadow-emerald-500/25 transition">
                            <span>Daftar Program Sekarang &rarr;</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
