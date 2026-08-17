@extends('layouts.spn')

@section('title', 'Biaya & Paket Pendaftaran Sekolah Pranikah — Salman ITB')
@section('meta_description', 'Pilih paket pendaftaran Sekolah Pranikah Salman ITB: Early Bird dan Normal Bird dengan opsi potongan kategori.')

@section('content')
  @php
    $activePage = 'harga';
    $isBatchOpen = $batch && $batch->isRegistrationOpen();
  @endphp

  <!-- Header Section -->
  <section class="dot-grid border-b border-navy/10 px-5 sm:px-8 py-14 text-center">
    <div class="max-w-4xl mx-auto">
      <nav class="mb-4 flex items-center justify-center gap-2 text-xs font-semibold text-navy/60">
        <a href="{{ route('spn.index') }}" class="hover:text-orange">Beranda</a>
        <span>/</span>
        <span class="text-orange">Biaya</span>
      </nav>
      <p class="text-xs sm:text-sm font-extrabold uppercase tracking-[0.3em] text-orange mb-3">Investasi Masa Depan</p>
      <h1 class="font-display font-black text-3xl sm:text-5xl text-navy">Paket &amp; Infak Pendaftaran</h1>
      <p class="mx-auto mt-4 max-w-2xl text-sm sm:text-base text-navy/70 leading-relaxed">
        {{ $batch ? ($batch->nama_batch ?? ('Batch ' . $batch->batch_ke)) : 'Sekolah Pranikah' }} &mdash; Dapatkan pembekalan komprehensif lahir dan batin menuju keluarga sakinah.
      </p>
    </div>
  </section>

  <!-- Pricing Cards Section -->
  <section class="bg-cream px-5 sm:px-8 py-14">
    <div class="max-w-6xl mx-auto space-y-12">

      <div class="grid grid-cols-1 md:grid-cols-2 gap-8 max-w-4xl mx-auto">
        @if(isset($packages) && $packages->isNotEmpty())
          @foreach($packages as $package)
            @php $isEarly = $package->slug === 'early_bird'; @endphp
            <div class="bg-white border-2 {{ $isEarly ? 'border-orange' : 'border-navy/20' }} rounded-2xl p-8 shadow-sm flex flex-col justify-between relative">
              @if($isEarly)
                <span class="absolute -top-3.5 right-6 bg-orange text-white text-[11px] font-black uppercase tracking-wider px-3 py-1 rounded-full shadow-xs">
                  Kuota Terbatas
                </span>
              @endif
              <div>
                <h3 class="font-display font-black text-2xl text-navy">{{ $package->name }}</h3>
                <p class="text-xs text-navy/60 mt-1">
                  @if($package->available_until)
                    Berlaku s/d {{ $package->available_until->translatedFormat('d F Y') }}
                  @else
                    Pendaftaran reguler batch aktif
                  @endif
                </p>
                
                <div class="mt-6 pb-6 border-b border-navy/10">
                  @if($isEarly)
                    <span class="text-xs text-navy/40 line-through block">Rp 849.000</span>
                  @else
                    <span class="text-xs text-navy/40 block">&nbsp;</span>
                  @endif
                  <span class="font-display font-black text-4xl {{ $isEarly ? 'text-orange' : 'text-navy' }}">
                    Rp {{ number_format($package->base_price, 0, ',', '.') }}
                  </span>
                </div>

                <ul class="mt-6 space-y-3 text-xs sm:text-sm text-navy/80 font-medium">
                  <li class="flex items-center gap-2">✓ <span>18 Sesi materi kognitif &amp; simulasi psikomotorik</span></li>
                  <li class="flex items-center gap-2">✓ <span>Modul lengkap, seminar kit, &amp; sertifikat resmi</span></li>
                  <li class="flex items-center gap-2">✓ <span>Akses Ta'aruf eksklusif Salman ITB</span></li>
                  <li class="flex items-center gap-2">✓ <span>13 layanan pendampingan &amp; kealumnian</span></li>
                </ul>
              </div>

              <div class="mt-8">
                @if($isBatchOpen && $package->isAvailable())
                  <a href="{{ route('spn.daftar.step1') }}" class="block w-full text-center {{ $isEarly ? 'bg-orange hover:bg-navy text-white' : 'border-2 border-navy text-navy hover:bg-navy hover:text-cream' }} font-extrabold text-sm py-3.5 rounded-xl transition shadow-xs">
                    Pilih Paket Ini &rarr;
                  </a>
                @elseif(!$package->isAvailable())
                  <span class="block w-full text-center bg-navy/10 text-navy/50 font-bold text-xs py-3 rounded-xl">
                    Paket Telah Berakhir
                  </span>
                @else
                  <a href="https://wa.me/6282126714989" target="_blank" class="block w-full text-center border-2 border-navy text-navy font-bold text-xs py-3 rounded-xl hover:bg-paper transition">
                    💬 Hubungi Panitia (Info Batch)
                  </a>
                @endif
              </div>
            </div>
          @endforeach
        @else
          <!-- Fallback Static Cards -->
          <div class="bg-white border-2 border-orange rounded-2xl p-8 shadow-sm flex flex-col justify-between relative">
            <span class="absolute -top-3.5 right-6 bg-orange text-white text-[11px] font-black uppercase tracking-wider px-3 py-1 rounded-full shadow-xs">
              Promo Terbatas
            </span>
            <div>
              <h3 class="font-display font-black text-2xl text-navy">Early Bird</h3>
              <p class="text-xs text-navy/60 mt-1">Pendaftaran lebih awal sebelum batas tanggal</p>
              <div class="mt-6 pb-6 border-b border-navy/10">
                <span class="text-xs text-navy/40 line-through block">Rp 849.000</span>
                <span class="font-display font-black text-4xl text-orange">Rp 749.000</span>
              </div>
              <ul class="mt-6 space-y-3 text-xs sm:text-sm text-navy/80 font-medium">
                <li class="flex items-center gap-2">✓ <span>18 Sesi materi kognitif &amp; simulasi psikomotorik</span></li>
                <li class="flex items-center gap-2">✓ <span>Modul lengkap, seminar kit, &amp; sertifikat</span></li>
                <li class="flex items-center gap-2">✓ <span>Akses Ta'aruf eksklusif Salman ITB</span></li>
              </ul>
            </div>
            <div class="mt-8">
              <a href="{{ route('spn.daftar.step1') }}" class="block w-full text-center bg-orange text-white font-extrabold text-sm py-3.5 rounded-xl hover:bg-navy transition">
                Daftar Early Bird &rarr;
              </a>
            </div>
          </div>

          <div class="bg-white border-2 border-navy/20 rounded-2xl p-8 shadow-xs flex flex-col justify-between">
            <div>
              <h3 class="font-display font-black text-2xl text-navy">Normal Bird</h3>
              <p class="text-xs text-navy/60 mt-1">Pendaftaran reguler sebelum batas akhir</p>
              <div class="mt-6 pb-6 border-b border-navy/10">
                <span class="text-xs text-navy/40 block">&nbsp;</span>
                <span class="font-display font-black text-4xl text-navy">Rp 849.000</span>
              </div>
              <ul class="mt-6 space-y-3 text-xs sm:text-sm text-navy/80 font-medium">
                <li class="flex items-center gap-2">✓ <span>18 Sesi materi kognitif &amp; simulasi psikomotorik</span></li>
                <li class="flex items-center gap-2">✓ <span>Modul lengkap, seminar kit, &amp; sertifikat</span></li>
                <li class="flex items-center gap-2">✓ <span>Akses Ta'aruf eksklusif Salman ITB</span></li>
              </ul>
            </div>
            <div class="mt-8">
              <a href="{{ route('spn.daftar.step1') }}" class="block w-full text-center border-2 border-navy text-navy font-extrabold text-sm py-3.5 rounded-xl hover:bg-navy hover:text-cream transition">
                Daftar Normal Bird &rarr;
              </a>
            </div>
          </div>
        @endif
      </div>

      <!-- Diskon Kategori Dinamis dari Database -->
      <div class="bg-white border-2 border-navy/20 rounded-2xl p-8 max-w-4xl mx-auto shadow-xs">
        <h3 class="font-display font-black text-xl text-navy mb-2">Potongan Diskon Kategori Khusus</h3>
        <p class="text-xs text-navy/70 mb-6">Potongan diskon otomatis terhitung pada langkah pembayaran form pendaftaran saat status diri/kategori dipilih.</p>
        
        <div class="grid sm:grid-cols-2 gap-4 text-xs sm:text-sm">
          @if(isset($discounts) && $discounts->isNotEmpty())
            @foreach($discounts as $disc)
              <div class="p-4 rounded-xl bg-paper border border-navy/10 flex justify-between items-center">
                <span class="font-bold text-navy">{{ $disc->label }}</span>
                <span class="font-display font-black text-orange text-lg">Diskon {{ $disc->discount_percent }}%</span>
              </div>
            @endforeach
          @else
            <div class="p-4 rounded-xl bg-paper border border-navy/10 flex justify-between items-center">
              <span class="font-bold text-navy">Mahasiswa ITB</span>
              <span class="font-display font-black text-orange text-lg">Diskon 20%</span>
            </div>
            <div class="p-4 rounded-xl bg-paper border border-navy/10 flex justify-between items-center">
              <span class="font-bold text-navy">Alumni ITB</span>
              <span class="font-display font-black text-orange text-lg">Diskon 15%</span>
            </div>
            <div class="p-4 rounded-xl bg-paper border border-navy/10 flex justify-between items-center">
              <span class="font-bold text-navy">Karyawan / Dosen ITB</span>
              <span class="font-display font-black text-orange text-lg">Diskon 20%</span>
            </div>
            <div class="p-4 rounded-xl bg-paper border border-navy/10 flex justify-between items-center">
              <span class="font-bold text-navy">Alumni Kaderisasi Salman (SSC/LMD)</span>
              <span class="font-display font-black text-orange text-lg">Diskon 15%</span>
            </div>
          @endif
        </div>
      </div>

    </div>
  </section>
@endsection
