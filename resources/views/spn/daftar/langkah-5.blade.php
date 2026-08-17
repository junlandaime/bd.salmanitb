@extends('layouts.spn')
@section('title', 'Konfirmasi & Pembayaran — Pendaftaran SPN Salman ITB')

@section('content')
<main class="max-w-3xl mx-auto px-5 sm:px-6 py-10 sm:py-14">
  
  @include('spn.daftar._progress-bar', ['currentStep' => 5])

  <div class="frame-marks bg-white border-2 border-navy/30 rounded-2xl shadow-sm p-6 sm:p-9" x-data="{
    buktiName:'', setuju:false, copied:false,
    handleFile(e){ this.buktiName = e.target.files.length ? e.target.files[0].name : ''; },
    copyRekening(){
      navigator.clipboard.writeText('1130011057');
      this.copied = true;
      setTimeout(() => this.copied = false, 2500);
    },
    get valid(){ return this.setuju === true && this.buktiName !== ''; }
  }" x-cloak>
    <div class="fm-tr"></div><div class="fm-bl"></div>

    <div class="mb-7 border-b border-navy/10 pb-4">
      <span class="text-xs font-extrabold uppercase tracking-[0.2em] text-orange">Langkah 5 dari 6</span>
      <h1 class="font-display text-2xl sm:text-3xl text-navy font-black mt-1">Konfirmasi &amp; Pembayaran</h1>
      <p class="text-xs sm:text-sm text-navy/70 mt-1">Periksa kembali data Anda, lakukan transfer infak pendaftaran, lalu unggah bukti pembayaran.</p>
    </div>

    @if(session('error'))
        <div class="mb-6 p-4 rounded-xl bg-red-50 border border-red-200 text-sm font-semibold text-red-600">
            {{ session('error') }}
        </div>
    @endif

    <form method="POST" action="{{ route('spn.daftar.store-step5') }}" enctype="multipart/form-data" class="space-y-6">
      @csrf

      <!-- Data Diri Review -->
      <div class="bg-paper border-2 border-navy/15 rounded-xl p-5">
        <p class="text-xs font-extrabold tracking-wider text-orange uppercase mb-3">1. Data Pribadi &amp; Kontak</p>
        <div class="divide-y divide-navy/10 text-xs sm:text-sm">
          <div class="flex justify-between py-2">
            <span class="text-navy/60">Nama Lengkap</span>
            <span class="font-bold text-navy text-right">{{ $reviewData['nama_lengkap'] ?? '-' }} {{ !empty($reviewData['nama_gelar']) ? '('.$reviewData['nama_gelar'].')' : '' }}</span>
          </div>
          <div class="flex justify-between py-2">
            <span class="text-navy/60">Jenis Kelamin</span>
            <span class="font-semibold text-navy text-right capitalize">{{ $reviewData['jenis_kelamin'] ?? '-' }}</span>
          </div>
          <div class="flex justify-between py-2">
            <span class="text-navy/60">Email</span>
            <span class="font-semibold text-navy text-right">{{ $reviewData['email'] ?? '-' }}</span>
          </div>
          <div class="flex justify-between py-2">
            <span class="text-navy/60">WhatsApp</span>
            <span class="font-semibold text-navy text-right font-mono">{{ $reviewData['whatsapp'] ?? '-' }}</span>
          </div>
          <div class="flex justify-between py-2">
            <span class="text-navy/60">TTL &amp; Usia</span>
            <span class="font-semibold text-navy text-right">{{ $reviewData['tanggal_lahir'] ?? '-' }} ({{ $reviewData['usia'] ?? '-' }} thn)</span>
          </div>
          <div class="flex justify-between py-2">
            <span class="text-navy/60">Domisili</span>
            <span class="font-semibold text-navy text-right">{{ $reviewData['domisili'] ?? '-' }}</span>
          </div>
        </div>
      </div>

      <!-- Pendidikan Review -->
      <div class="bg-paper border-2 border-navy/15 rounded-xl p-5">
        <p class="text-xs font-extrabold tracking-wider text-orange uppercase mb-3">2. Pendidikan &amp; Pekerjaan</p>
        <div class="divide-y divide-navy/10 text-xs sm:text-sm">
          <div class="flex justify-between py-2">
            <span class="text-navy/60">Pendidikan Terakhir</span>
            <span class="font-bold text-navy uppercase">{{ $reviewData['pendidikan'] ?? '-' }}</span>
          </div>
          <div class="flex justify-between py-2">
            <span class="text-navy/60">Status Diri</span>
            <span class="font-semibold text-navy capitalize">{{ str_replace('_', ' ', $reviewData['status_diri'] ?? '-') }}</span>
          </div>
          <div class="flex justify-between py-2">
            <span class="text-navy/60">Profesi / Instansi</span>
            <span class="font-semibold text-navy">{{ $reviewData['pekerjaan'] ?? '-' }} &mdash; {{ $reviewData['instansi'] ?? '-' }}</span>
          </div>
          @if(!empty($reviewData['universitas']))
            <div class="flex justify-between py-2">
              <span class="text-navy/60">Kampus / Jurusan</span>
              <span class="font-semibold text-navy">{{ $reviewData['universitas'] }} &middot; {{ $reviewData['jurusan'] ?? '' }} ({{ $reviewData['angkatan'] ?? '' }})</span>
            </div>
          @endif
        </div>
      </div>

      <!-- Pembayaran Summary & Bank Account Box -->
      <div class="bg-navy text-cream rounded-xl p-6 space-y-4">
        <div class="border-b border-white/10 pb-3 flex justify-between items-center">
          <p class="font-display font-extrabold text-orange text-sm uppercase tracking-wider">3. Rincian Infak Pendaftaran</p>
          <span class="text-xs font-bold text-cream/70 bg-white/10 px-2.5 py-1 rounded capitalize">{{ $reviewData['metode_bayar'] ?? 'Transfer' }}</span>
        </div>

        <div class="space-y-2 text-xs sm:text-sm">
          <div class="flex justify-between text-cream/80">
            <span>Harga Dasar Paket ({{ $reviewData['paket_nama'] ?? 'SPN' }}):</span>
            <span class="font-semibold">Rp {{ number_format($reviewData['harga_dasar'] ?? 0, 0, ',', '.') }}</span>
          </div>
          @if(!empty($reviewData['potongan_diskon']) && $reviewData['potongan_diskon'] > 0)
            <div class="flex justify-between text-emerald-400">
              <span>Potongan Kategori:</span>
              <span class="font-semibold">- Rp {{ number_format($reviewData['potongan_diskon'], 0, ',', '.') }}</span>
            </div>
          @endif
          @if(!empty($reviewData['potongan_referal']) && $reviewData['potongan_referal'] > 0)
            <div class="flex justify-between text-emerald-400">
              <span>Potongan Referral:</span>
              <span class="font-semibold">- Rp {{ number_format($reviewData['potongan_referal'], 0, ',', '.') }}</span>
            </div>
          @endif
          <div class="border-t border-white/15 pt-3 mt-3 flex justify-between items-center">
            <span class="font-display font-black text-base">Total yang Harus Ditransfer:</span>
            <span class="font-display font-black text-orange text-2xl">Rp {{ number_format($reviewData['total_bayar'] ?? 0, 0, ',', '.') }}</span>
          </div>
        </div>

        <!-- Rekening Bank -->
        <div class="bg-white/10 rounded-xl p-4 mt-4 border border-white/15">
          <p class="text-xs text-cream/70 uppercase font-bold tracking-wider mb-2">Tujuan Transfer Bank:</p>
          <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 bg-white text-navy p-3 rounded-lg">
            <div>
              <p class="text-xs font-black text-navy">Bank Muamalat (Kode Bank: 147)</p>
              <p class="font-mono font-black text-lg text-orange">1130011057</p>
              <p class="text-xs text-navy/70">a.n. <strong class="text-navy">YPM Salman ITB</strong></p>
            </div>
            <button type="button" @click="copyRekening()"
              class="px-4 py-2 bg-navy hover:bg-orange text-cream text-xs font-extrabold rounded-md transition shrink-0">
              <span x-show="!copied">Salin No. Rekening</span>
              <span x-show="copied" class="text-emerald-400">Tersalin ✓</span>
            </button>
          </div>
        </div>
      </div>

      <!-- Upload Bukti Bayar -->
      <div>
        <label class="field-label" for="bb">Unggah Berkas Bukti Pembayaran <span class="req">*</span></label>
        <div class="border-2 border-dashed border-navy/30 rounded-xl p-6 text-center bg-paper/50 hover:bg-paper transition">
          <input id="bb" type="file" name="bukti_bayar" @change="handleFile($event)" accept="image/*,application/pdf" class="hidden" required>
          <label for="bb" class="cursor-pointer">
            <span class="text-3xl block mb-2">📎</span>
            <span class="text-xs sm:text-sm font-bold text-navy block">Klik untuk memilih foto / scan bukti transfer</span>
            <span class="text-[11px] text-navy/60 block mt-1">Format: JPG, PNG, atau PDF (Maksimal 5 MB)</span>
          </label>
          <p x-show="buktiName" class="mt-3 text-xs font-bold text-emerald-700 bg-emerald-50 py-1.5 px-3 rounded-md inline-block border border-emerald-200" x-text="'File terpilih: ' + buktiName"></p>
        </div>
        @error('bukti_bayar') <p class="text-xs text-red-500 font-semibold mt-1">{{ $message }}</p> @enderror
      </div>

      <!-- Pernyataan & Janji Peserta -->
      <div class="pt-2">
        <label class="flex items-start gap-3 p-4 rounded-xl border-2 border-navy/20 bg-paper cursor-pointer">
          <input type="checkbox" name="setuju" value="1" x-model="setuju" class="mt-1 w-4 h-4 text-orange focus:ring-orange rounded border-navy/30" required>
          <span class="text-xs sm:text-sm text-navy leading-relaxed">
            Saya menyatakan bahwa data yang diisi adalah benar, saya berkomitmen mengikuti seluruh rangkaian kegiatan Sekolah Pranikah Salman ITB dengan sungguh-sungguh, serta mematuhi seluruh tata tertib yang berlaku. <span class="req">*</span>
          </span>
        </label>
        @error('setuju') <p class="text-xs text-red-500 font-semibold mt-1">{{ $message }}</p> @enderror
      </div>

      <div class="flex items-center justify-between border-t border-navy/10 pt-6 mt-8">
        <a href="{{ route('spn.daftar.step4') }}" class="rounded-xl border-2 border-navy px-6 py-2.5 text-xs sm:text-sm font-bold text-navy hover:bg-paper transition">
          &larr; Kembali
        </a>
        <button type="submit" :disabled="!(valid)"
          :class="(valid) ? 'bg-orange hover:bg-navy text-white cursor-pointer shadow-md' : 'bg-navy/15 text-navy/40 cursor-not-allowed'"
          class="rounded-xl px-8 py-3 text-sm font-extrabold transition">
          Selesaikan &amp; Kirim Pendaftaran &rarr;
        </button>
      </div>

    </form>
  </div>
  <p class="text-center text-xs text-navy/50 mt-6 font-semibold">Sekolah Pranikah &middot; Salman ITB</p>
</main>
@endsection
