@extends('layouts.spn')

@section('title', 'Kurikulum Sekolah Pranikah — Salman ITB')
@section('meta_description', 'Kurikulum komprehensif Sekolah Pranikah Salman ITB: 18 sesi pembelajaran tatap muka (Offline) dan modul pembelajaran daring (Online).')

@section('content')
  @php $activePage = 'kurikulum'; @endphp

  <!-- Header Section -->
  <section class="dot-grid border-b border-navy/10 px-5 sm:px-8 py-14 text-center">
    <div class="max-w-4xl mx-auto">
      <nav class="mb-4 flex items-center justify-center gap-2 text-xs font-semibold text-navy/60">
        <a href="{{ route('spn.index') }}" class="hover:text-orange">Beranda</a>
        <span>/</span>
        <span class="text-orange">Kurikulum</span>
      </nav>
      <p class="text-xs sm:text-sm font-extrabold uppercase tracking-[0.3em] text-orange mb-3">Silabus &amp; Pembelajaran</p>
      <h1 class="font-display font-black text-3xl sm:text-5xl text-navy">Kurikulum Terstruktur &amp; Komprehensif</h1>
      <p class="mx-auto mt-4 max-w-2xl text-sm sm:text-base text-navy/70 leading-relaxed">
        Dirancang terpadu bersama ulama, psikolog, dokter spesialis, konselor keluarga, dan praktisi perencana keuangan syariah.
      </p>
    </div>
  </section>

  <!-- Content Section -->
  <section class="bg-cream px-5 sm:px-8 py-14" x-data="{ mode: '{{ $activeType ?? 'offline' }}' }">
    <div class="max-w-6xl mx-auto space-y-8">

      <!-- Program Mode Switcher (Offline vs Online) -->
      <div class="flex flex-col items-center justify-center gap-3 mb-6">
        <div class="inline-flex p-1.5 rounded-2xl bg-white border-2 border-navy/20 shadow-xs">
          <button @click="mode = 'offline'" 
                  :class="mode === 'offline' ? 'bg-navy text-cream font-black shadow-xs' : 'text-navy/70 hover:text-navy font-bold'" 
                  class="flex items-center gap-2 rounded-xl px-6 py-2.5 text-xs sm:text-sm transition">
            <span>🏛️ SPN Offline (Tatap Muka)</span>
            <span class="text-[10px] px-2 py-0.5 rounded-md" :class="mode === 'offline' ? 'bg-orange text-white' : 'bg-paper text-navy'">18 Sesi</span>
          </button>
          <button @click="mode = 'online'" 
                  :class="mode === 'online' ? 'bg-navy text-cream font-black shadow-xs' : 'text-navy/70 hover:text-navy font-bold'" 
                  class="flex items-center gap-2 rounded-xl px-6 py-2.5 text-sm transition">
            <span>💻 SPN Online (Daring)</span>
            <span class="text-[10px] px-2 py-0.5 rounded-md" :class="mode === 'online' ? 'bg-orange text-white' : 'bg-paper text-navy'">Modul</span>
          </button>
        </div>
      </div>

      <!-- ================= SPN OFFLINE CURRICULUM ================= -->
      <div x-show="mode === 'offline'" x-cloak x-transition class="space-y-6">
        
        <!-- Intro Card -->
        <div class="frame-marks bg-white border-2 border-navy/30 rounded-xl p-6 sm:p-8 shadow-xs">
          <div class="fm-tr"></div><div class="fm-bl"></div>
          <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
            <div>
              <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-orangesoft text-navy border border-orange/30 mb-2">
                🏛️ Pembelajaran Tatap Muka di Komplek Masjid Salman ITB
              </span>
              <h2 class="font-display font-black text-2xl sm:text-3xl text-navy">18 Sesi Materi &amp; Praktik (9 Hari Pertemuan)</h2>
              <p class="text-xs sm:text-sm text-navy/70 mt-1">Menggabungkan pemaparan materi kognitif, diskusi studi kasus, simulasi psikomotorik, dan layanan ta'aruf.</p>
            </div>
            @if($batch && $batch->isRegistrationOpen() && $batch->activity && $batch->activity->slug === 'sekolah-pranikah-offline')
              <a href="{{ route('spn.daftar.step1') }}" class="inline-flex items-center justify-center gap-2 bg-orange text-white font-extrabold text-xs sm:text-sm px-6 py-3 rounded-xl hover:bg-navy transition shrink-0 shadow-xs">
                Daftar Batch {{ $batch->batch_ke }} Offline &rarr;
              </a>
            @endif
          </div>
        </div>

        <!-- Dynamic Learning Paths from Database -->
        @if(isset($offlineLearningPaths) && $offlineLearningPaths->isNotEmpty())
          <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($offlineLearningPaths as $index => $lp)
              <div class="bg-white border-2 border-navy/15 rounded-xl p-6 shadow-xs flex flex-col justify-between hover:border-orange transition">
                <div>
                  <div class="flex items-center justify-between border-b border-navy/10 pb-3 mb-4">
                    <span class="font-display font-black text-orange text-xl">Pekan {{ $lp->order ?? ($index + 1) }}</span>
                    @if($lp->sessions)
                      <span class="text-[11px] font-bold text-navy bg-paper px-2.5 py-1 rounded">{{ $lp->sessions }} Sesi</span>
                    @endif
                  </div>
                  <h3 class="font-display font-bold text-navy text-base leading-snug">{{ $lp->title }}</h3>
                  <p class="text-xs text-navy/70 mt-2.5 leading-relaxed">{{ $lp->description }}</p>
                </div>
                @if($lp->mentors)
                  <div class="mt-5 pt-3 border-t border-navy/10 text-[11px] font-semibold text-navy/70 flex items-center gap-1.5">
                    <span>🎙️</span>
                    <span>{{ $lp->mentors }}</span>
                  </div>
                @endif
              </div>
            @endforeach
          </div>
        @else
          <!-- Default Offline Grid Fallback -->
          <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
            <div class="bg-white border-2 border-navy/15 rounded-xl p-6 shadow-xs flex flex-col justify-between">
              <div>
                <div class="flex items-center justify-between border-b border-navy/10 pb-3 mb-4">
                  <span class="font-display font-black text-orange text-xl">Pertemuan 1</span>
                  <span class="text-[11px] font-bold text-navy bg-paper px-2.5 py-1 rounded">Sesi 1 & 2</span>
                </div>
                <h3 class="font-display font-bold text-navy text-base leading-snug">Visi Pernikahan Islami & Urgensi Pranikah</h3>
                <p class="text-xs text-navy/70 mt-2.5 leading-relaxed">Membangun paradigma pernikahan sebagai ibadah agung dan penyempurna separuh agama.</p>
              </div>
            </div>
            <div class="bg-white border-2 border-navy/15 rounded-xl p-6 shadow-xs flex flex-col justify-between">
              <div>
                <div class="flex items-center justify-between border-b border-navy/10 pb-3 mb-4">
                  <span class="font-display font-black text-orange text-xl">Pertemuan 2</span>
                  <span class="text-[11px] font-bold text-navy bg-paper px-2.5 py-1 rounded">Sesi 3 & 4</span>
                </div>
                <h3 class="font-display font-bold text-navy text-base leading-snug">Fikih Munakahat, Khitbah, Akad & Walimah</h3>
                <p class="text-xs text-navy/70 mt-2.5 leading-relaxed">Syariat perkawinan, mahar, hakikat akad nikah, dan adab walimah syar'i.</p>
              </div>
            </div>
            <div class="bg-white border-2 border-navy/15 rounded-xl p-6 shadow-xs flex flex-col justify-between">
              <div>
                <div class="flex items-center justify-between border-b border-navy/10 pb-3 mb-4">
                  <span class="font-display font-black text-orange text-xl">Pertemuan 3</span>
                  <span class="text-[11px] font-bold text-navy bg-paper px-2.5 py-1 rounded">Sesi 5 & 6</span>
                </div>
                <h3 class="font-display font-bold text-navy text-base leading-snug">Psikologi Pasangan & Manajemen Emosi</h3>
                <p class="text-xs text-navy/70 mt-2.5 leading-relaxed">Memahami perbedaan gender pria-wanita, seni meredam konflik, dan komunikasi asertif.</p>
              </div>
            </div>
          </div>
        @endif

        <!-- Sesi Praktik & Mentoring Box -->
        <div class="bg-navy text-cream rounded-2xl p-8 shadow-sm">
          <h3 class="font-display font-black text-xl sm:text-2xl text-orange mb-3">5 Sesi Praktik &amp; 6 Sesi Mentoring Khusus</h3>
          <div class="grid sm:grid-cols-2 gap-4 text-xs sm:text-sm text-cream/90 mt-6">
            <div class="flex items-start gap-2.5">
              <span class="text-orange font-bold text-base">✓</span>
              <span>Simulasi Ijab Qabul &amp; Adab Khutbah Nikah</span>
            </div>
            <div class="flex items-start gap-2.5">
              <span class="text-orange font-bold text-base">✓</span>
              <span>Praktik Penyusunan Anggaran &amp; Cashflow Rumah Tangga</span>
            </div>
            <div class="flex items-start gap-2.5">
              <span class="text-orange font-bold text-base">✓</span>
              <span>Simulasi Komunikasi Asertif &amp; Studi Kasus Konflik Pasangan</span>
            </div>
            <div class="flex items-start gap-2.5">
              <span class="text-orange font-bold text-base">✓</span>
              <span>Mentoring Kelompok bersama Fasilitator Berpengalaman</span>
            </div>
          </div>
        </div>

      </div>

      <!-- ================= SPN ONLINE CURRICULUM ================= -->
      <div x-show="mode === 'online'" x-cloak x-transition class="space-y-6">
        
        <!-- Intro Card Online -->
        <div class="frame-marks bg-white border-2 border-navy/30 rounded-xl p-6 sm:p-8 shadow-xs">
          <div class="fm-tr"></div><div class="fm-bl"></div>
          <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
            <div>
              <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-orangesoft text-navy border border-orange/30 mb-2">
                💻 Pembelajaran Daring Live via Zoom Meeting
              </span>
              <h2 class="font-display font-black text-2xl sm:text-3xl text-navy">7 Hari Sesi Live Interaktif + Series Fikih Munakahat</h2>
              <p class="text-xs sm:text-sm text-navy/70 mt-1">Dilaksanakan secara synchronous/live tatap maya, dilengkapi sesi simulasi psikomotorik, diskusi studi kasus, dan akses seumur hidup ke rekaman materi.</p>
            </div>
          </div>
        </div>

        <!-- Special Saturday Night Series Card -->
        <div class="bg-navy text-cream rounded-2xl p-6 sm:p-8 shadow-sm flex flex-col md:flex-row items-center justify-between gap-6">
          <div class="space-y-2">
            <span class="inline-block text-xs font-extrabold uppercase tracking-widest text-orange bg-white/10 px-3 py-1 rounded-md">Program Khusus</span>
            <h3 class="font-display font-black text-xl sm:text-2xl text-white">Series Materi Fikih Munakahat (Setiap Sabtu Malam)</h3>
            <p class="text-xs sm:text-sm text-cream/80 max-w-xl">Kajian komprehensif fikih nikah, syarat, rukun, hak & kewajiban suami istri bersama Asatidz Bidang Dakwah Masjid Salman ITB (19.30 – 21.45 WIB).</p>
          </div>
          <div class="text-center md:text-right shrink-0">
            <span class="font-display font-bold text-orange text-lg">Pukul 19.30 – 21.45 WIB</span>
            <p class="text-xs text-cream/60">Live via Zoom Room</p>
          </div>
        </div>

        <!-- Dynamic Online Learning Paths or Rich 7-Day Fallback -->
        @if(isset($onlineLearningPaths) && $onlineLearningPaths->isNotEmpty())
          <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($onlineLearningPaths as $index => $lp)
              <div class="bg-white border-2 border-navy/15 rounded-xl p-6 shadow-xs flex flex-col justify-between hover:border-orange transition">
                <div>
                  <div class="flex items-center justify-between border-b border-navy/10 pb-3 mb-4">
                    <span class="font-display font-black text-orange text-xl">Day {{ $lp->order ?? ($index + 1) }}</span>
                    @if($lp->duration)
                      <span class="text-[11px] font-bold text-navy bg-paper px-2.5 py-1 rounded">{{ $lp->duration }}</span>
                    @endif
                  </div>
                  <h3 class="font-display font-bold text-navy text-base leading-snug">{{ $lp->title }}</h3>
                  <p class="text-xs text-navy/70 mt-2.5 leading-relaxed">{{ $lp->description }}</p>
                </div>
                @if($lp->mentors)
                  <div class="mt-5 pt-3 border-t border-navy/10 text-[11px] font-semibold text-navy/70 flex items-center gap-1.5">
                    <span>🎙️</span>
                    <span>{{ $lp->mentors }}</span>
                  </div>
                @endif
              </div>
            @endforeach
          </div>
        @else
          <!-- 7-Day Rich Online Structure -->
          @php
            $onlineCurriculum = [
              ['day' => 'Day 1', 'sessions' => 'Sesi 1 & 2', 'title' => 'Fondasi Akidah & Menjemput Jodoh yang Baik', 'desc' => 'Fondasi niat pernikahan sebagai ibadah dan panduan ta\'aruf syar\'i yang berkah.', 'mentor' => 'Ust. Syatori Abdul Rauf & Ust. Arif Rahman Lubis, S.T., M.Hum'],
              ['day' => 'Day 2', 'sessions' => 'Sesi 3 & 4', 'title' => 'Kematangan Diri & Simulasi Pemecahan Masalah', 'desc' => 'Asesmen kesiapan mental, manajemen ekspektasi, dan latihan psikomotorik pemecahan masalah.', 'mentor' => 'Tika Faiza, M.Psi., Psikolog & Fasilitator SPN'],
              ['day' => 'Day 3', 'sessions' => 'Sesi 5 & 6', 'title' => 'Komunikasi & Manajemen Konflik Pasangan', 'desc' => 'Seni komunikasi asertif, meredam tensi emosi, dan simulasi studi kasus konflik pernikahan.', 'mentor' => 'Romi Sangaji, S.T., M.A. & Tim Psikomotorik'],
              ['day' => 'Day 4', 'sessions' => 'Sesi 7 & 8', 'title' => 'Digital Intimacy & Ketahanan Pernikahan', 'desc' => 'Tantangan era digital, menjaga integritas hubungan, serta strategi pencegahan perceraian.', 'mentor' => 'Dr. Yunita Sari, M.Psi. & Sofiana Indraswari, M.Psi.'],
              ['day' => 'Day 5', 'sessions' => 'Sesi 9 & 10', 'title' => 'Manajemen Finansial & Anggaran Rumah Tangga', 'desc' => 'Penyusunan cashflow keluarga, skala prioritas, dan simulasi perancangan anggaran nafkah.', 'mentor' => 'Isti Khairani, S.T., CFP, IFP, QFE'],
              ['day' => 'Day 6', 'sessions' => 'Sesi 11 & 12', 'title' => 'Penguatan Nilai & Kesiapan Hidup Berkeluarga', 'desc' => 'Penyelarasan visi misi keluarga, peran suami-istri, dan etika komunikasi dengan mertua.', 'mentor' => 'Drs. Adriano Rusfi, Psikolog & Faisyal M. S. Alwi, M.I.Kom'],
              ['day' => 'Day 7', 'sessions' => 'Sesi 13 & 14', 'title' => 'Kesehatan Reproduksi & Portal Ta\'aruf Salman', 'desc' => 'Kesehatan intim halal medis (ruang terpisah) dan pengenalan layanan kealumnian serta portal ta\'aruf.', 'mentor' => 'dr. Widiyastuti, Sp.OG. & Luqman Fariz Arrasyid, S.Tr.Sos'],
            ];
          @endphp
          <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($onlineCurriculum as $item)
              <div class="bg-white border-2 border-navy/15 rounded-xl p-6 shadow-xs flex flex-col justify-between">
                <div>
                  <div class="flex items-center justify-between border-b border-navy/10 pb-3 mb-4">
                    <span class="font-display font-black text-orange text-xl">{{ $item['day'] }}</span>
                    <span class="text-[11px] font-bold text-navy bg-paper px-2.5 py-1 rounded">{{ $item['sessions'] }}</span>
                  </div>
                  <h3 class="font-display font-bold text-navy text-base leading-snug">{{ $item['title'] }}</h3>
                  <p class="text-xs text-navy/70 mt-2.5 leading-relaxed">{{ $item['desc'] }}</p>
                </div>
                <div class="mt-5 pt-3 border-t border-navy/10 text-[11px] font-semibold text-navy/70 flex items-center gap-1.5">
                  <span>🎙️</span>
                  <span>{{ $item['mentor'] }}</span>
                </div>
              </div>
            @endforeach
          </div>
        @endif

      </div>

    </div>
  </section>
@endsection
