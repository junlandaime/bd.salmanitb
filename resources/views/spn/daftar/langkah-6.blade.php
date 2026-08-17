@extends('layouts.spn')
@section('title', 'Pendaftaran Berhasil — SPN Salman ITB')

@section('content')
<main class="max-w-3xl mx-auto px-5 sm:px-6 py-10 sm:py-14">
  
  @include('spn.daftar._progress-bar', ['currentStep' => 6])

  <div class="frame-marks bg-white border-2 border-navy/30 rounded-2xl shadow-sm p-6 sm:p-9" x-data="{
    nama: '{{ $registration->nama_lengkap }}',
    kode: '{{ $registration->registration_code }}',
    paketName: '{{ $registration->pricingPackage ? $registration->pricingPackage->name : 'Normal Bird' }}',
    total: '{{ $registration->total_bayar }}',
    copied: false,
    copyKode(){
      navigator.clipboard.writeText(this.kode);
      this.copied = true;
      setTimeout(() => this.copied = false, 2500);
    },
    get waLink(){
      const msg = 'Assalamualaikum, saya ' + this.nama + ' telah mendaftar SPN Salman dengan kode ' + this.kode + ' (' + this.paketName + ', Total Infak Rp' + Number(this.total).toLocaleString('id-ID') + ') dan telah mengunggah bukti pembayaran di website. Mohon konfirmasinya. Terima kasih.';
      return 'https://wa.me/6282126714989?text=' + encodeURIComponent(msg);
    }
  }" x-cloak>
    <div class="fm-tr"></div><div class="fm-bl"></div>

    <div class="mb-7 text-center">
      <div class="w-16 h-16 rounded-full bg-emerald-100 text-emerald-700 flex items-center justify-center text-3xl mx-auto mb-4 border-2 border-emerald-300">
        ✓
      </div>
      <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-amber-100 text-amber-800 mb-2 border border-amber-300">
        ⏳ Menunggu Verifikasi Admin
      </span>
      <h1 class="font-display text-2xl sm:text-3xl text-navy font-black">Pendaftaran &amp; Bukti Terkirim!</h1>
      <p class="text-xs sm:text-sm text-navy/70 mt-1 max-w-md mx-auto">
        Alhamdulillah, data pendaftaran dan bukti transfer Anda telah berhasil kami terima.
      </p>
    </div>

    <!-- Kode Registrasi Card -->
    <div class="bg-paper border-2 border-orange rounded-2xl p-6 text-center mb-6 shadow-xs">
      <p class="text-xs font-extrabold uppercase tracking-wider text-orange">Kode Pendaftaran Anda</p>
      <div class="flex items-center justify-center gap-3 mt-1.5 mb-2">
        <span class="font-mono text-2xl sm:text-3xl font-black text-navy tracking-wider" x-text="kode"></span>
        <button type="button" @click="copyKode()" class="text-xs bg-navy hover:bg-orange text-cream px-3 py-1.5 rounded-lg transition font-bold shadow-xs">
          <span x-text="copied ? '✓ Tersalin' : '📋 Salin Kode'"></span>
        </button>
      </div>
      <p class="text-xs text-navy/60">Simpan kode registrasi ini untuk keperluan verifikasi dan identifikasi peserta.</p>
    </div>

    <!-- Summary Details Card -->
    <div class="bg-paper border-2 border-navy/15 rounded-xl p-5 mb-6 text-left">
      <p class="text-xs font-extrabold tracking-wider text-navy uppercase mb-3">Ringkasan Pendaftaran</p>
      <div class="divide-y divide-navy/10 text-xs sm:text-sm">
        <div class="flex justify-between py-2">
          <span class="text-navy/60">Nama Pendaftar</span>
          <span class="font-bold text-navy text-right">{{ $registration->nama_lengkap }}</span>
        </div>
        <div class="flex justify-between py-2">
          <span class="text-navy/60">Paket SPN</span>
          <span class="font-semibold text-navy text-right capitalize">{{ str_replace('_', ' ', $registration->paket) }}</span>
        </div>
        @if($registration->potongan_diskon > 0)
        <div class="flex justify-between py-2 text-emerald-700">
          <span class="font-medium">Potongan Diskon ({{ $registration->discount_percentage }}%)</span>
          <span class="font-bold text-right">- Rp {{ number_format($registration->potongan_diskon, 0, ',', '.') }}
            <span class="text-[11px] block font-normal text-emerald-600">({{ $registration->discount_category_label }})</span>
          </span>
        </div>
        @endif
        @if($registration->potongan_referal > 0)
        <div class="flex justify-between py-2 text-emerald-700">
          <span class="font-medium">Potongan Referral</span>
          <span class="font-bold text-right">- Rp {{ number_format($registration->potongan_referal, 0, ',', '.') }}</span>
        </div>
        @endif
        <div class="flex justify-between py-2">
          <span class="text-navy/60">Metode Pembayaran</span>
          <span class="font-semibold text-navy text-right uppercase">{{ $registration->metode_bayar === 'qris' ? 'QRIS' : 'Transfer Bank Muamalat' }}</span>
        </div>
        <div class="flex justify-between py-2">
          <span class="text-navy/60">Total Infak</span>
          <span class="font-display font-black text-orange text-base text-right">Rp {{ number_format($registration->total_bayar, 0, ',', '.') }}</span>
        </div>
        <div class="flex justify-between py-2">
          <span class="text-navy/60">Bukti Pembayaran</span>
          <span class="font-bold text-emerald-700 text-right">✓ Berhasil Diunggah</span>
        </div>
      </div>
    </div>

    <!-- Petunjuk Selanjutnya -->
    <div class="bg-white border-2 border-navy/15 rounded-xl p-5 mb-6">
      <p class="text-xs font-extrabold tracking-wider text-navy uppercase mb-2">Langkah Selanjutnya</p>
      <ol class="text-xs sm:text-sm text-navy/80 space-y-2 list-decimal list-inside leading-relaxed">
        <li><strong>Verifikasi Admin:</strong> Panitia SPN Salman ITB akan memeriksa bukti transfer dalam <strong>1x24 jam</strong> kerja.</li>
        <li><strong>Akun &amp; Dashboard:</strong> Anda dapat memantau status persetujuan pendaftaran melalui menu <strong>Dashboard Peserta</strong> di website.</li>
        <li><strong>Koordinasi Kelas:</strong> Link grup WhatsApp peserta dan panduan teknis akan tersedia di Dashboard Peserta setelah pendaftaran disetujui.</li>
      </ol>
    </div>

    <!-- WhatsApp CTA & Nav -->
    <div class="text-center pt-2 space-y-3">
      <p class="text-xs text-navy/60 font-semibold">Ingin konfirmasi langsung ke panitia?</p>
      <a :href="waLink" target="_blank" class="inline-flex items-center gap-2 bg-emerald-600 hover:bg-navy text-white rounded-xl px-7 py-3 text-xs sm:text-sm font-extrabold transition shadow-sm">
        <span>💬</span> Konfirmasi via WhatsApp Panitia
      </a>
      <div class="pt-4 flex items-center justify-center gap-4 text-xs font-bold">
        <a href="{{ route('peserta.dashboard') }}" class="text-orange hover:text-navy transition">
          Buka Dashboard Peserta &rarr;
        </a>
        <span class="text-navy/30">&middot;</span>
        <a href="{{ route('spn.index') }}" class="text-navy/60 hover:text-navy transition">
          Kembali ke Beranda
        </a>
      </div>
    </div>

  </div>
  <p class="text-center text-xs text-navy/50 mt-6 font-semibold">Sekolah Pranikah &middot; Salman ITB</p>
</main>
@endsection
