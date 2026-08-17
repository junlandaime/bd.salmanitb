@extends('layouts.spn')
@section('title', 'Data Diri — Pendaftaran SPN Salman ITB')

@section('content')
<main class="max-w-3xl mx-auto px-5 sm:px-6 py-10 sm:py-14">
  
  @include('spn.daftar._progress-bar', ['currentStep' => 2])

  <div class="frame-marks bg-white border-2 border-navy/30 rounded-2xl shadow-sm p-6 sm:p-9" x-data="{
    nama_lengkap: '{{ old('nama_lengkap', session('spn_step2.nama_lengkap', $prefill['nama_lengkap'] ?? '')) }}',
    nama_gelar: '{{ old('nama_gelar', session('spn_step2.nama_gelar', $prefill['nama_gelar'] ?? '')) }}',
    nama_panggilan: '{{ old('nama_panggilan', session('spn_step2.nama_panggilan', $prefill['nama_panggilan'] ?? '')) }}',
    jenis_kelamin: '{{ old('jenis_kelamin', session('spn_step2.jenis_kelamin', $prefill['jenis_kelamin'] ?? '')) }}',
    email: '{{ old('email', session('spn_step2.email', $prefill['email'] ?? '')) }}',
    whatsapp: '{{ old('whatsapp', session('spn_step2.whatsapp', $prefill['whatsapp'] ?? '')) }}',
    instagram: '{{ old('instagram', session('spn_step2.instagram', $prefill['instagram'] ?? '')) }}',
    tanggal_lahir: '{{ old('tanggal_lahir', session('spn_step2.tanggal_lahir', $prefill['tanggal_lahir'] ?? '')) }}',
    usia: '{{ old('usia', session('spn_step2.usia', '')) }}',
    asal_daerah: '{{ old('asal_daerah', session('spn_step2.asal_daerah', $prefill['asal_daerah'] ?? '')) }}',
    domisili: '{{ old('domisili', session('spn_step2.domisili', $prefill['domisili'] ?? '')) }}',
    status_pernikahan: '{{ old('status_pernikahan', session('spn_step2.status_pernikahan', $prefill['status_pernikahan'] ?? '')) }}',
    init(){
      if(this.tanggal_lahir) this.hitungUsia();
    },
    hitungUsia(){
      if(!this.tanggal_lahir){ this.usia=''; return; }
      const b = new Date(this.tanggal_lahir), t = new Date();
      let a = t.getFullYear() - b.getFullYear();
      const m = t.getMonth() - b.getMonth();
      if(m < 0 || (m === 0 && t.getDate() < b.getDate())) a--;
      this.usia = a >= 0 ? a : '';
    },
    get valid(){
      return this.nama_lengkap && this.nama_panggilan && this.jenis_kelamin && this.email &&
        this.whatsapp && this.tanggal_lahir && this.asal_daerah &&
        this.domisili.trim().length > 0 && this.status_pernikahan;
    }
  }" x-cloak>
    <div class="fm-tr"></div><div class="fm-bl"></div>

    <div class="mb-7 border-b border-navy/10 pb-4">
      <span class="text-xs font-extrabold uppercase tracking-[0.2em] text-orange">Langkah 2 dari 6</span>
      <h1 class="font-display text-2xl sm:text-3xl text-navy font-black mt-1">Biodata Diri</h1>
      <p class="text-xs sm:text-sm text-navy/70 mt-1">Lengkapi informasi pribadi dan kontak aktif Anda dengan benar.</p>
    </div>

    @if(session('error'))
        <div class="mb-6 p-4 rounded-xl bg-red-50 border border-red-200 text-sm font-semibold text-red-600">
            {{ session('error') }}
        </div>
    @endif

    <form method="POST" action="{{ route('spn.daftar.store-step2') }}" class="space-y-6">
      @csrf

      <div>
        <label class="field-label" for="nl">Nama Lengkap (Tanpa Gelar) <span class="req">*</span></label>
        <input id="nl" name="nama_lengkap" x-model="nama_lengkap" class="field-input" placeholder="Contoh: Muhammad Fatih">
        @error('nama_lengkap') <p class="text-xs text-red-500 font-semibold mt-1">{{ $message }}</p> @enderror
      </div>

      <div class="grid sm:grid-cols-2 gap-4">
        <div>
          <label class="field-label" for="ng">Nama Lengkap &amp; Gelar</label>
          <input id="ng" name="nama_gelar" x-model="nama_gelar" class="field-input" placeholder="Contoh: Muhammad Fatih, S.T.">
          @error('nama_gelar') <p class="text-xs text-red-500 font-semibold mt-1">{{ $message }}</p> @enderror
        </div>
        <div>
          <label class="field-label" for="np">Nama Panggilan <span class="req">*</span></label>
          <input id="np" name="nama_panggilan" x-model="nama_panggilan" class="field-input" placeholder="Contoh: Fatih">
          @error('nama_panggilan') <p class="text-xs text-red-500 font-semibold mt-1">{{ $message }}</p> @enderror
        </div>
      </div>

      <div>
        <label class="field-label">Jenis Kelamin <span class="req">*</span></label>
        <div class="grid grid-cols-2 gap-3">
          <label class="flex items-center gap-3 border-2 rounded-xl px-4 py-3 cursor-pointer transition"
            :class="jenis_kelamin==='pria' ? 'border-orange bg-orangesoft/30 text-navy font-bold' : 'border-navy/15 hover:border-navy/40 text-navy/80'">
            <input type="radio" name="jenis_kelamin" value="pria" x-model="jenis_kelamin" class="w-4 h-4 text-orange focus:ring-orange">
            <span class="text-sm">Laki-laki (Ikhwan)</span>
          </label>
          <label class="flex items-center gap-3 border-2 rounded-xl px-4 py-3 cursor-pointer transition"
            :class="jenis_kelamin==='wanita' ? 'border-orange bg-orangesoft/30 text-navy font-bold' : 'border-navy/15 hover:border-navy/40 text-navy/80'">
            <input type="radio" name="jenis_kelamin" value="wanita" x-model="jenis_kelamin" class="w-4 h-4 text-orange focus:ring-orange">
            <span class="text-sm">Perempuan (Akhwat)</span>
          </label>
        </div>
        @error('jenis_kelamin') <p class="text-xs text-red-500 font-semibold mt-1">{{ $message }}</p> @enderror
      </div>

      <div class="grid sm:grid-cols-2 gap-4">
        <div>
          <label class="field-label" for="em">Alamat Email Aktif <span class="req">*</span></label>
          <input id="em" type="email" name="email" x-model="email" class="field-input" placeholder="nama@email.com">
          <p class="text-[11px] text-navy/60 mt-1">Akun peserta &amp; konfirmasi akan dikirim ke email ini.</p>
          @error('email') <p class="text-xs text-red-500 font-semibold mt-1">{{ $message }}</p> @enderror
        </div>
        <div>
          <label class="field-label" for="wa">Nomor WhatsApp Aktif <span class="req">*</span></label>
          <input id="wa" type="tel" name="whatsapp" x-model="whatsapp" class="field-input" placeholder="08xxxxxxxxxx">
          <p class="text-[11px] text-navy/60 mt-1">Untuk dimasukkan ke dalam grup koordinasi kelas.</p>
          @error('whatsapp') <p class="text-xs text-red-500 font-semibold mt-1">{{ $message }}</p> @enderror
        </div>
      </div>

      <div>
        <label class="field-label" for="ig">Akun Instagram (Opsional)</label>
        <input id="ig" name="instagram" x-model="instagram" class="field-input" placeholder="@username_anda">
        @error('instagram') <p class="text-xs text-red-500 font-semibold mt-1">{{ $message }}</p> @enderror
      </div>

      <div class="grid sm:grid-cols-2 gap-4">
        <div>
          <label class="field-label" for="tl">Tanggal Lahir <span class="req">*</span></label>
          <input id="tl" type="date" name="tanggal_lahir" x-model="tanggal_lahir" @change="hitungUsia()" class="field-input">
          @error('tanggal_lahir') <p class="text-xs text-red-500 font-semibold mt-1">{{ $message }}</p> @enderror
        </div>
        <div>
          <label class="field-label">Usia Terhitung</label>
          <div class="px-4 py-2.5 rounded-xl border-2 border-navy/15 bg-paper font-bold text-navy text-sm flex items-center h-[46px]">
            <span x-text="usia ? usia + ' Tahun' : 'Pilih tanggal lahir'"></span>
          </div>
        </div>
      </div>

      <div class="grid sm:grid-cols-2 gap-4">
        <div>
          <label class="field-label" for="ad">Kota / Kabupaten Asal <span class="req">*</span></label>
          <input id="ad" name="asal_daerah" x-model="asal_daerah" class="field-input" placeholder="Contoh: Kota Bandung">
          @error('asal_daerah') <p class="text-xs text-red-500 font-semibold mt-1">{{ $message }}</p> @enderror
        </div>
        <div>
          <label class="field-label" for="dom">Alamat Domisili Saat Ini <span class="req">*</span></label>
          <input id="dom" name="domisili" x-model="domisili" class="field-input" placeholder="Alamat tinggal saat ini...">
          @error('domisili') <p class="text-xs text-red-500 font-semibold mt-1">{{ $message }}</p> @enderror
        </div>
      </div>

      <div>
        <label class="field-label">Status Pernikahan Saat Ini <span class="req">*</span></label>
        <div class="grid grid-cols-3 gap-3">
          <label class="flex items-center justify-center gap-2 border-2 rounded-xl px-3 py-3 cursor-pointer text-center transition"
            :class="status_pernikahan==='belum' ? 'border-orange bg-orangesoft/30 text-navy font-bold' : 'border-navy/15 hover:border-navy/40 text-navy/80'">
            <input type="radio" name="status_pernikahan" value="belum" x-model="status_pernikahan" class="w-4 h-4 text-orange focus:ring-orange">
            <span class="text-xs sm:text-sm">Belum Menikah</span>
          </label>
          <label class="flex items-center justify-center gap-2 border-2 rounded-xl px-3 py-3 cursor-pointer text-center transition"
            :class="status_pernikahan==='menikah' ? 'border-orange bg-orangesoft/30 text-navy font-bold' : 'border-navy/15 hover:border-navy/40 text-navy/80'">
            <input type="radio" name="status_pernikahan" value="menikah" x-model="status_pernikahan" class="w-4 h-4 text-orange focus:ring-orange">
            <span class="text-xs sm:text-sm">Menikah</span>
          </label>
          <label class="flex items-center justify-center gap-2 border-2 rounded-xl px-3 py-3 cursor-pointer text-center transition"
            :class="status_pernikahan==='pernah' ? 'border-orange bg-orangesoft/30 text-navy font-bold' : 'border-navy/15 hover:border-navy/40 text-navy/80'">
            <input type="radio" name="status_pernikahan" value="pernah" x-model="status_pernikahan" class="w-4 h-4 text-orange focus:ring-orange">
            <span class="text-xs sm:text-sm">Pernah Menikah</span>
          </label>
        </div>
        @error('status_pernikahan') <p class="text-xs text-red-500 font-semibold mt-1">{{ $message }}</p> @enderror
      </div>

      <div class="flex items-center justify-between border-t border-navy/10 pt-6 mt-8">
        <a href="{{ route('spn.daftar.step1') }}" class="rounded-xl border-2 border-navy px-6 py-2.5 text-xs sm:text-sm font-bold text-navy hover:bg-paper transition">
          &larr; Kembali
        </a>
        <button type="submit" :disabled="!(valid)"
          :class="(valid) ? 'bg-orange hover:bg-navy text-white cursor-pointer shadow-sm' : 'bg-navy/15 text-navy/40 cursor-not-allowed'"
          class="rounded-xl px-7 py-3 text-sm font-extrabold transition">
          Langkah Selanjutnya &rarr;
        </button>
      </div>

    </form>
  </div>
  <p class="text-center text-xs text-navy/50 mt-6 font-semibold">Sekolah Pranikah &middot; Salman ITB</p>
</main>
@endsection
