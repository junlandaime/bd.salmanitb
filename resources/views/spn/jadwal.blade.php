@extends('layouts.spn')

@section('title', 'Jadwal Pelaksanaan Sekolah Pranikah — Salman ITB')
@section('meta_description', 'Jadwal lengkap pelaksanaan Sekolah Pranikah Salman ITB: 9 pertemuan tatap muka di Masjid Salman ITB.')

@section('content')
  @php
    $activePage = 'jadwal';
    $currentBatch = $batch ?? \App\Models\ActivityBatch::whereHas('activity', function($q){
        $q->whereIn('slug', ['sekolah-pranikah-offline', 'sekolah-pranikah-online', 'spn']);
    })->where('status', 'aktif')->latest()->first();
    $isBatchOpen = $currentBatch && $currentBatch->isRegistrationOpen();
  @endphp

  <!-- Header Section -->
  <section class="dot-grid border-b border-navy/10 px-5 sm:px-8 py-14 text-center">
    <div class="max-w-4xl mx-auto">
      <nav class="mb-4 flex items-center justify-center gap-2 text-xs font-semibold text-navy/60">
        <a href="{{ route('spn.index') }}" class="hover:text-orange">Beranda</a>
        <span>/</span>
        <span class="text-orange">Jadwal</span>
      </nav>
      <p class="text-xs sm:text-sm font-extrabold uppercase tracking-[0.3em] text-orange mb-3">Agenda &amp; Timeline</p>
      <h1 class="font-display font-black text-3xl sm:text-5xl text-navy">Jadwal Pelaksanaan</h1>
      <p class="mx-auto mt-4 max-w-2xl text-sm sm:text-base text-navy/70 leading-relaxed">
        @if($currentBatch && $currentBatch->tanggal_mulai_kegiatan && $currentBatch->tanggal_selesai_kegiatan)
          {{ $currentBatch->nama_batch ?? 'Sekolah Pranikah' }} &middot; {{ $currentBatch->tanggal_mulai_kegiatan->translatedFormat('d F') }} &ndash; {{ $currentBatch->tanggal_selesai_kegiatan->translatedFormat('d F Y') }}
        @else
          9 Pertemuan Tatap Muka &middot; Setiap Hari Ahad &middot; 09.30 &ndash; 15.00 WIB
        @endif
      </p>
    </div>
  </section>

  <!-- Schedule List Section -->
  <section class="bg-cream px-5 sm:px-8 py-14" x-data="{ mode: '{{ $activeType ?? 'offline' }}' }">
    <div class="max-w-6xl mx-auto space-y-6">

      <!-- Program Mode Switcher -->
      <div class="flex justify-center mb-6">
        <div class="inline-flex p-1.5 rounded-2xl bg-white border-2 border-navy/20 shadow-xs">
          <button @click="mode = 'offline'" 
                  :class="mode === 'offline' ? 'bg-navy text-cream font-black shadow-xs' : 'text-navy/70 hover:text-navy font-bold'" 
                  class="flex items-center gap-2 rounded-xl px-6 py-2.5 text-xs sm:text-sm transition">
            <span>🏛️ Jadwal SPN Offline</span>
            <span class="text-[10px] px-2 py-0.5 rounded-md" :class="mode === 'offline' ? 'bg-orange text-white' : 'bg-paper text-navy'">9 Pertemuan</span>
          </button>
          <button @click="mode = 'online'" 
                  :class="mode === 'online' ? 'bg-navy text-cream font-black shadow-xs' : 'text-navy/70 hover:text-navy font-bold'" 
                  class="flex items-center gap-2 rounded-xl px-6 py-2.5 text-xs sm:text-sm transition">
            <span>💻 Jadwal SPN Online</span>
            <span class="text-[10px] px-2 py-0.5 rounded-md" :class="mode === 'online' ? 'bg-orange text-white' : 'bg-paper text-navy'">Daring</span>
          </button>
        </div>
      </div>

      <!-- ================= JADWAL SPN OFFLINE ================= -->
      <div x-show="mode === 'offline'" x-cloak x-transition class="space-y-6">
        
        <!-- Venue & Time Info Box -->
        <div class="frame-marks bg-white border-2 border-navy/30 rounded-xl p-6 sm:p-8 shadow-xs flex flex-col sm:flex-row items-center justify-between gap-6">
          <div class="fm-tr"></div><div class="fm-bl"></div>
          <div>
            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-orangesoft text-navy border border-orange/30 mb-2">
              📍 Waktu &amp; Lokasi Tatap Muka
            </span>
            <h2 class="font-display font-black text-xl sm:text-2xl text-navy">Setiap Hari Ahad &middot; 09.30 – 15.00 WIB</h2>
            <p class="text-xs sm:text-sm text-navy/70 mt-1">Komplek Masjid Salman ITB, Jl. Ganesha No. 7, Coblong, Kota Bandung</p>
          </div>
          @if($isBatchOpen)
            <a href="{{ route('spn.daftar.step1') }}" class="inline-flex items-center justify-center gap-2 bg-orange text-white font-extrabold text-xs sm:text-sm px-6 py-3 rounded-xl hover:bg-navy transition shrink-0 shadow-xs">
              Daftar Sekarang &rarr;
            </a>
          @endif
        </div>

        <!-- Dynamic Schedule Grid from Database -->
        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
          @if(isset($offlineLearningPaths) && $offlineLearningPaths->isNotEmpty())
            @foreach($offlineLearningPaths as $index => $lp)
              <div class="bg-white border-2 border-navy/15 rounded-xl p-5 shadow-xs flex gap-4 hover:border-orange transition">
                <div class="shrink-0 w-16 text-center">
                  <p class="font-display font-black text-orange text-3xl leading-none">{{ sprintf('%02d', $lp->order ?? ($index + 1)) }}</p>
                  <p class="text-[10px] font-bold text-navy/60 uppercase mt-1">Pekan {{ $lp->order ?? ($index + 1) }}<br>Ahad</p>
                </div>
                <div class="flex-1 border-l-2 border-orangesoft pl-4 space-y-1.5">
                  <p class="font-display font-bold text-navy text-sm leading-snug">{{ $lp->title }}</p>
                  @if($lp->mentors)
                    <p class="text-xs text-navy/60 italic">{{ $lp->mentors }}</p>
                  @endif
                  <span class="inline-block text-[10px] font-bold text-navy bg-paper px-2 py-0.5 rounded">
                    {{ $lp->sessions ? $lp->sessions . ' Sesi · ' : '' }}09.30 - 15.00 WIB
                  </span>
                </div>
              </div>
            @endforeach
          @else
            <!-- Default 9 Pekan Fallback -->
            @for($i = 1; $i <= 9; $i++)
              <div class="bg-white border-2 border-navy/15 rounded-xl p-5 shadow-xs flex gap-4">
                <div class="shrink-0 w-16 text-center">
                  <p class="font-display font-black text-orange text-3xl leading-none">{{ sprintf('%02d', $i) }}</p>
                  <p class="text-[10px] font-bold text-navy/60 uppercase mt-1">Pekan {{ $i }}<br>Ahad</p>
                </div>
                <div class="flex-1 border-l-2 border-orangesoft pl-4 space-y-1.5">
                  <p class="font-display font-bold text-navy text-sm leading-snug">Pertemuan Pekan {{ $i }}</p>
                  <p class="text-xs text-navy/60 italic">Sesi materi kognitif &amp; simulasi psikomotorik</p>
                  <span class="inline-block text-[10px] font-bold text-navy bg-paper px-2 py-0.5 rounded">09.30 - 15.00 WIB</span>
                </div>
              </div>
            @endfor
          @endif
        </div>

      </div>

      <!-- ================= JADWAL SPN ONLINE ================= -->
      <div x-show="mode === 'online'" x-cloak x-transition class="space-y-6">
        <div class="frame-marks bg-white border-2 border-navy/30 rounded-xl p-6 sm:p-8 shadow-xs flex flex-col sm:flex-row items-center justify-between gap-6">
          <div class="fm-tr"></div><div class="fm-bl"></div>
          <div>
            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-orangesoft text-navy border border-orange/30 mb-2">
              💻 Waktu &amp; Media Pembelajaran Daring
            </span>
            <h2 class="font-display font-black text-xl sm:text-2xl text-navy">7 Hari Pertemuan Live via Zoom Meeting &amp; Series Fikih</h2>
            <p class="text-xs sm:text-sm text-navy/70 mt-1">Kegiatan dilaksanakan secara synchronous/live interaktif: Sesi Utama (09.30 – 15.00 WIB) + Series Fikih Munakahat (Sabtu Malam 19.30 – 21.45 WIB).</p>
          </div>
          @if($isBatchOpen)
            <a href="{{ route('spn.daftar.step1') }}" class="inline-flex items-center justify-center gap-2 bg-orange text-white font-extrabold text-xs sm:text-sm px-6 py-3 rounded-xl hover:bg-navy transition shrink-0 shadow-xs">
              Daftar Sekarang &rarr;
            </a>
          @endif
        </div>

        <!-- Special Saturday Night Series Banner -->
        <div class="bg-navy text-cream rounded-xl p-5 shadow-xs flex flex-col sm:flex-row items-center justify-between gap-4">
          <div class="flex items-center gap-3">
            <span class="text-3xl">🌙</span>
            <div>
              <p class="font-display font-bold text-orange text-sm sm:text-base">Series Materi Fikih Munakahat (Setiap Sabtu Malam)</p>
              <p class="text-xs text-cream/80">Pukul 19.30 – 21.45 WIB &middot; Kajian mendalam fiqih pernikahan bersama Asatidz Bidang Dakwah Salman</p>
            </div>
          </div>
          <span class="text-xs font-bold bg-white/10 text-cream px-3 py-1.5 rounded-lg border border-white/20 shrink-0">
            Live Zoom
          </span>
        </div>

        <!-- Schedule Grid (7 Days) -->
        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
          @if(isset($onlineLearningPaths) && $onlineLearningPaths->isNotEmpty())
            @foreach($onlineLearningPaths as $index => $lp)
              <div class="bg-white border-2 border-navy/15 rounded-xl p-5 shadow-xs flex gap-4 hover:border-orange transition">
                <div class="shrink-0 w-16 text-center">
                  <p class="font-display font-black text-orange text-3xl leading-none">{{ sprintf('%02d', $lp->order ?? ($index + 1)) }}</p>
                  <p class="text-[10px] font-bold text-navy/60 uppercase mt-1">Day {{ $lp->order ?? ($index + 1) }}<br>Zoom</p>
                </div>
                <div class="flex-1 border-l-2 border-orangesoft pl-4 space-y-1.5">
                  <p class="font-display font-bold text-navy text-sm leading-snug">{{ $lp->title }}</p>
                  @if($lp->mentors)
                    <p class="text-xs text-navy/60 italic">{{ $lp->mentors }}</p>
                  @endif
                  <span class="inline-block text-[10px] font-bold text-navy bg-paper px-2 py-0.5 rounded">
                    {{ $lp->sessions ? $lp->sessions . ' Sesi · ' : '' }}09.30 - 15.00 WIB
                  </span>
                </div>
              </div>
            @endforeach
          @else
            <!-- Fallback 7 Hari SPN Online Live Schedule -->
            @php
              $onlineDays = [
                ['day' => 1, 'title' => 'Fondasi Akidah, Niat & Ta\'aruf Syar\'i', 'time' => '09.30 - 15.00 WIB', 'desc' => 'Sesi 1: Fondasi Akidah & Sesi 2: Menjemput Jodoh yang Baik'],
                ['day' => 2, 'title' => 'Kematangan Diri & Simulasi Pemecahan Masalah', 'time' => '09.30 - 15.00 WIB', 'desc' => 'Sesi 1: Kesehatan Mental Pranikah & Sesi 2: Simulasi Masalah Pernikahan'],
                ['day' => 3, 'title' => 'Komunikasi Pasangan & Manajemen Konflik', 'time' => '09.30 - 15.00 WIB', 'desc' => 'Sesi 1: Komunikasi Rumah Tangga & Sesi 2: Praktik Komunikasi Asertif'],
                ['day' => 4, 'title' => 'Ketahanan Keluarga & Era Digital', 'time' => '09.30 - 15.00 WIB', 'desc' => 'Sesi 1: Digital Intimacy & Sesi 2: Pencegahan Perceraian'],
                ['day' => 5, 'title' => 'Manajemen Finansial & Anggaran Pernikahan', 'time' => '09.30 - 15.00 WIB', 'desc' => 'Sesi 1: Keuangan Pranikah & Sesi 2: Praktik Perancangan Anggaran'],
                ['day' => 6, 'title' => 'Penguatan Visi & Kesiapan Komprehensif', 'time' => '09.30 - 15.00 WIB', 'desc' => 'Sesi 1: Fondasi Niat & Sesi 2: Ta\'aruf Sesuai Syariat'],
                ['day' => 7, 'title' => 'Kesehatan Reproduksi & Layanan Ta\'aruf Salman', 'time' => '09.30 - 15.00 WIB', 'desc' => 'Sesi 1: Kesehatan Reproduksi & Sesi 2: Penjelasan Layanan Ta\'aruf'],
              ];
            @endphp
            @foreach($onlineDays as $item)
              <div class="bg-white border-2 border-navy/15 rounded-xl p-5 shadow-xs flex gap-4">
                <div class="shrink-0 w-16 text-center">
                  <p class="font-display font-black text-orange text-3xl leading-none">{{ sprintf('%02d', $item['day']) }}</p>
                  <p class="text-[10px] font-bold text-navy/60 uppercase mt-1">Day {{ $item['day'] }}<br>Zoom</p>
                </div>
                <div class="flex-1 border-l-2 border-orangesoft pl-4 space-y-1.5">
                  <p class="font-display font-bold text-navy text-sm leading-snug">{{ $item['title'] }}</p>
                  <p class="text-xs text-navy/60 italic">{{ $item['desc'] }}</p>
                  <span class="inline-block text-[10px] font-bold text-navy bg-paper px-2 py-0.5 rounded">{{ $item['time'] }}</span>
                </div>
              </div>
            @endforeach
          @endif
        </div>
      </div>

    </div>
  </section>
@endsection
