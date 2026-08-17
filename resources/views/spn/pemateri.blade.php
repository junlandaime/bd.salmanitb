@extends('layouts.spn')

@section('title', 'Pemateri & Narasumber Sekolah Pranikah — Salman ITB')
@section('meta_description', 'Dipandu oleh para ulama, psikolog klinis, dokter spesialis, konselor keluarga, dan perencana keuangan syariah.')

@section('content')
  @php $activePage = 'pemateri'; @endphp

  <!-- Header Section -->
  <section class="dot-grid border-b border-navy/10 px-5 sm:px-8 py-14 text-center">
    <div class="max-w-4xl mx-auto">
      <nav class="mb-4 flex items-center justify-center gap-2 text-xs font-semibold text-navy/60">
        <a href="{{ route('spn.index') }}" class="hover:text-orange">Beranda</a>
        <span>/</span>
        <span class="text-orange">Pemateri</span>
      </nav>
      <p class="text-xs sm:text-sm font-extrabold uppercase tracking-[0.3em] text-orange mb-3">Narasumber &amp; Mentor</p>
      <h1 class="font-display font-black text-3xl sm:text-5xl text-navy">Para Ahli di Bidangnya</h1>
      <p class="mx-auto mt-4 max-w-2xl text-sm sm:text-base text-navy/70 leading-relaxed">
        Belajar langsung dari praktisi pernikahan, ulama, konselor keluarga, psikolog klinis, dokter spesialis, dan perencana keuangan syariah bersertifikasi.
      </p>
    </div>
  </section>

  <!-- Content Section -->
  <section class="bg-cream px-5 sm:px-8 py-14" x-data="{ mode: '{{ $activeType ?? 'offline' }}' }">
    <div class="max-w-6xl mx-auto space-y-8">

      <!-- Program Mode Switcher -->
      <div class="flex justify-center mb-6">
        <div class="inline-flex p-1.5 rounded-2xl bg-white border-2 border-navy/20 shadow-xs">
          <button @click="mode = 'offline'" 
                  :class="mode === 'offline' ? 'bg-navy text-cream font-black shadow-xs' : 'text-navy/70 hover:text-navy font-bold'" 
                  class="flex items-center gap-2 rounded-xl px-6 py-2.5 text-xs sm:text-sm transition">
            <span>🏛️ Pemateri SPN Offline</span>
          </button>
          <button @click="mode = 'online'" 
                  :class="mode === 'online' ? 'bg-navy text-cream font-black shadow-xs' : 'text-navy/70 hover:text-navy font-bold'" 
                  class="flex items-center gap-2 rounded-xl px-6 py-2.5 text-xs sm:text-sm transition">
            <span>💻 Pemateri SPN Online</span>
          </button>
        </div>
      </div>

      <!-- ================= OFFLINE MENTORS ================= -->
      <div x-show="mode === 'offline'" x-cloak x-transition>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
          @if(isset($offlineLearningPaths) && $offlineLearningPaths->isNotEmpty())
            @foreach($offlineLearningPaths as $lp)
              @if($lp->mentors && $lp->mentors !== 'Fasilitator Program')
                <div class="rounded-xl border-2 border-navy/15 bg-white p-6 shadow-xs hover:border-orange transition flex flex-col justify-between">
                  <div>
                    <div class="flex items-center gap-4">
                      <div class="w-14 h-14 rounded-xl bg-navy text-cream font-display font-bold text-lg flex items-center justify-center shrink-0">
                        {{ substr($lp->mentors, 0, 2) }}
                      </div>
                      <div>
                        <h3 class="font-display text-base font-bold text-navy leading-snug">
                          {{ $lp->mentors }}
                        </h3>
                        <span class="inline-block mt-1 text-[11px] font-bold px-2 py-0.5 rounded bg-orangesoft text-navy">
                          {{ str_contains($lp->mentors, 'dr.') ? 'Dokter Spesialis' : (str_contains($lp->mentors, 'Psikolog') ? 'Psikolog Klinis' : (str_contains($lp->mentors, 'CFP') ? 'Konsultan Keuangan' : 'Ulama / Narasumber')) }}
                        </span>
                      </div>
                    </div>
                    <div class="mt-4 pt-3 border-t border-navy/10">
                      <p class="text-xs font-semibold text-navy/80">{{ $lp->title }}</p>
                    </div>
                  </div>
                </div>
              @endif
            @endforeach
          @else
            <!-- Fallback Mentors -->
            <div class="rounded-xl border-2 border-navy/15 bg-white p-6 shadow-xs hover:border-orange transition">
              <div class="flex items-center gap-4">
                <div class="w-14 h-14 rounded-xl bg-navy text-cream font-display font-bold text-lg flex items-center justify-center shrink-0">
                  DR
                </div>
                <div>
                  <h3 class="font-display text-base font-bold text-navy leading-snug">Dr. Ahmad Zailani, M.Ag</h3>
                  <span class="inline-block mt-1 text-[11px] font-bold px-2 py-0.5 rounded bg-orangesoft text-navy">Pakar Fikih &amp; Hukum Nikah</span>
                </div>
              </div>
              <div class="mt-4 pt-3 border-t border-navy/10 text-xs text-navy/70">
                Materi: Fikih Munakahat, Khitbah, Akad, &amp; Hukum Positif Perkawinan
              </div>
            </div>

            <div class="rounded-xl border-2 border-navy/15 bg-white p-6 shadow-xs hover:border-orange transition">
              <div class="flex items-center gap-4">
                <div class="w-14 h-14 rounded-xl bg-orange text-white font-display font-bold text-lg flex items-center justify-center shrink-0">
                  DR
                </div>
                <div>
                  <h3 class="font-display text-base font-bold text-navy leading-snug">dr. Ferry Achmad Firdaus, MM., Sp.OG</h3>
                  <span class="inline-block mt-1 text-[11px] font-bold px-2 py-0.5 rounded bg-orangesoft text-navy">Dokter Spesialis Obstetri &amp; Ginekologi</span>
                </div>
              </div>
              <div class="mt-4 pt-3 border-t border-navy/10 text-xs text-navy/70">
                Materi: Kesehatan Reproduksi &amp; Kesiapan Biologis (Sesi Ikhwan)
              </div>
            </div>

            <div class="rounded-xl border-2 border-navy/15 bg-white p-6 shadow-xs hover:border-orange transition">
              <div class="flex items-center gap-4">
                <div class="w-14 h-14 rounded-xl bg-navy text-cream font-display font-bold text-lg flex items-center justify-center shrink-0">
                  SI
                </div>
                <div>
                  <h3 class="font-display text-base font-bold text-navy leading-snug">Sofiana Indaswari, M.Psi., Psikolog</h3>
                  <span class="inline-block mt-1 text-[11px] font-bold px-2 py-0.5 rounded bg-orangesoft text-navy">Psikolog Klinis &amp; Konselor Pasangan</span>
                </div>
              </div>
              <div class="mt-4 pt-3 border-t border-navy/10 text-xs text-navy/70">
                Materi: Psikologi Gender, Resolusi Konflik, &amp; Ketahanan Rumah Tangga
              </div>
            </div>
          @endif
        </div>
      </div>

      <!-- ================= ONLINE MENTORS ================= -->
      <div x-show="mode === 'online'" x-cloak x-transition>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
          @if(isset($onlineLearningPaths) && $onlineLearningPaths->isNotEmpty())
            @foreach($onlineLearningPaths as $lp)
              @if($lp->mentors && $lp->mentors !== 'Fasilitator Program')
                <div class="rounded-xl border-2 border-navy/15 bg-white p-6 shadow-xs hover:border-orange transition flex flex-col justify-between">
                  <div>
                    <div class="flex items-center gap-4">
                      <div class="w-14 h-14 rounded-xl bg-navy text-cream font-display font-bold text-lg flex items-center justify-center shrink-0">
                        {{ substr($lp->mentors, 0, 2) }}
                      </div>
                      <div>
                        <h3 class="font-display text-base font-bold text-navy leading-snug">
                          {{ $lp->mentors }}
                        </h3>
                        <span class="inline-block mt-1 text-[11px] font-bold px-2 py-0.5 rounded bg-orangesoft text-navy">
                          Pemateri Daring
                        </span>
                      </div>
                    </div>
                    <div class="mt-4 pt-3 border-t border-navy/10">
                      <p class="text-xs font-semibold text-navy/80">{{ $lp->title }}</p>
                    </div>
                  </div>
                </div>
              @endif
            @endforeach
          @else
            <div class="col-span-full bg-white border-2 border-navy/15 rounded-xl p-8 text-center text-navy/70">
              <p class="text-sm">Daftar narasumber SPN Online akan diumumkan menjelang pelaksanaan batch daring.</p>
            </div>
          @endif
        </div>
      </div>

    </div>
  </section>
@endsection
