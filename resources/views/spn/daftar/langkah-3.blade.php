@extends('layouts.spn')
@section('title', 'Pendidikan & Pekerjaan — Pendaftaran SPN Salman ITB')

@section('content')
<main class="max-w-3xl mx-auto px-5 sm:px-6 py-10 sm:py-14">
  
  @include('spn.daftar._progress-bar', ['currentStep' => 3])

  <div class="frame-marks bg-white border-2 border-navy/30 rounded-2xl shadow-sm p-6 sm:p-9" x-data="{
    pendidikan: '{{ old('pendidikan', session('spn_step3.pendidikan', $prefill['pendidikan'] ?? '')) }}',
    status_diri: '{{ old('status_diri', session('spn_step3.status_diri', $prefill['status_diri'] ?? '')) }}',
    pekerjaan: '{{ old('pekerjaan', session('spn_step3.pekerjaan', $prefill['pekerjaan'] ?? '')) }}',
    jabatan: '{{ old('jabatan', session('spn_step3.jabatan', $prefill['jabatan'] ?? '')) }}',
    instansi: '{{ old('instansi', session('spn_step3.instansi', $prefill['instansi'] ?? '')) }}',
    lokasi_kerja: '{{ old('lokasi_kerja', session('spn_step3.lokasi_kerja', $prefill['lokasi_kerja'] ?? '')) }}',
    universitas: '{{ old('universitas', session('spn_step3.universitas', $prefill['universitas'] ?? '')) }}',
    jurusan: '{{ old('jurusan', session('spn_step3.jurusan', $prefill['jurusan'] ?? '')) }}',
    angkatan: '{{ old('angkatan', session('spn_step3.angkatan', $prefill['angkatan'] ?? '')) }}',
    get isMahasiswa(){ return this.status_diri === 'mahasiswa'; },
    get valid(){
      const base = this.pendidikan && this.status_diri && this.pekerjaan && this.jabatan && this.instansi && this.lokasi_kerja;
      if(!base) return false;
      if(this.isMahasiswa) return this.universitas && this.jurusan && this.angkatan;
      return true;
    }
  }" x-cloak>
    <div class="fm-tr"></div><div class="fm-bl"></div>

    <div class="mb-7 border-b border-navy/10 pb-4">
      <span class="text-xs font-extrabold uppercase tracking-[0.2em] text-orange">Langkah 3 dari 6</span>
      <h1 class="font-display text-2xl sm:text-3xl text-navy font-black mt-1">Pendidikan &amp; Pekerjaan</h1>
      <p class="text-xs sm:text-sm text-navy/70 mt-1">Lengkapi riwayat studi dan aktivitas profesional Anda saat ini.</p>
    </div>

    @if(session('error'))
        <div class="mb-6 p-4 rounded-xl bg-red-50 border border-red-200 text-sm font-semibold text-red-600">
            {{ session('error') }}
        </div>
    @endif

    <form method="POST" action="{{ route('spn.daftar.store-step3') }}" class="space-y-6">
      @csrf

      <div class="grid sm:grid-cols-2 gap-4">
        <div>
          <label class="field-label" for="pdd">Pendidikan Terakhir <span class="req">*</span></label>
          <select id="pdd" name="pendidikan" x-model="pendidikan" class="field-input">
            <option value="">Pilih pendidikan terakhir</option>
            <option value="sma">SMA / SMK / Sederajat</option>
            <option value="d3">Diploma (D1 - D4)</option>
            <option value="s1">Sarjana (S1)</option>
            <option value="s2">Magister (S2)</option>
            <option value="s3">Doktor (S3)</option>
          </select>
          @error('pendidikan') <p class="text-xs text-red-500 font-semibold mt-1">{{ $message }}</p> @enderror
        </div>
        <div>
          <label class="field-label" for="sd">Status Diri / Kategori <span class="req">*</span></label>
          <select id="sd" name="status_diri" x-model="status_diri" class="field-input">
            <option value="">Pilih status diri</option>
            <option value="mahasiswa">Mahasiswa (ITB / Kampus Lain)</option>
            <option value="karyawan">Karyawan / Pegawai Swasta / BUMN</option>
            <option value="dosen">Dosen / Tenaga Pendidik</option>
            <option value="alumni_itb">Alumni ITB</option>
            <option value="umum">Umum / Profesional / Wiraswasta</option>
          </select>
          @error('status_diri') <p class="text-xs text-red-500 font-semibold mt-1">{{ $message }}</p> @enderror
        </div>
      </div>

      <!-- Khusus Mahasiswa -->
      <div x-show="isMahasiswa" x-collapse class="p-5 rounded-xl bg-paper border-2 border-navy/15 space-y-4">
        <h4 class="font-display font-bold text-navy text-sm">Informasi Kampus (Khusus Mahasiswa)</h4>
        <div class="grid sm:grid-cols-3 gap-4">
          <div>
            <label class="field-label" for="univ">Nama Perguruan Tinggi <span class="req">*</span></label>
            <input id="univ" name="universitas" x-model="universitas" class="field-input" placeholder="Contoh: Institut Teknologi Bandung">
            @error('universitas') <p class="text-xs text-red-500 font-semibold mt-1">{{ $message }}</p> @enderror
          </div>
          <div>
            <label class="field-label" for="jur">Fakultas / Program Studi <span class="req">*</span></label>
            <input id="jur" name="jurusan" x-model="jurusan" class="field-input" placeholder="Contoh: Teknik Elektro">
            @error('jurusan') <p class="text-xs text-red-500 font-semibold mt-1">{{ $message }}</p> @enderror
          </div>
          <div>
            <label class="field-label" for="ang">Tahun Angkatan Masuk <span class="req">*</span></label>
            <input id="ang" name="angkatan" x-model="angkatan" class="field-input" placeholder="Contoh: 2022">
            @error('angkatan') <p class="text-xs text-red-500 font-semibold mt-1">{{ $message }}</p> @enderror
          </div>
        </div>
      </div>

      <div class="grid sm:grid-cols-2 gap-4">
        <div>
          <label class="field-label" for="pk">Pekerjaan / Bidang Profesi <span class="req">*</span></label>
          <input id="pk" name="pekerjaan" x-model="pekerjaan" class="field-input" placeholder="Contoh: Software Engineer / Guru / Mahasiswa">
          @error('pekerjaan') <p class="text-xs text-red-500 font-semibold mt-1">{{ $message }}</p> @enderror
        </div>
        <div>
          <label class="field-label" for="jb">Jabatan / Posisi <span class="req">*</span></label>
          <input id="jb" name="jabatan" x-model="jabatan" class="field-input" placeholder="Contoh: Staff / Manager / Freelance / Mahasiswa">
          @error('jabatan') <p class="text-xs text-red-500 font-semibold mt-1">{{ $message }}</p> @enderror
        </div>
      </div>

      <div class="grid sm:grid-cols-2 gap-4">
        <div>
          <label class="field-label" for="ins">Nama Perusahaan / Instansi / Kampus <span class="req">*</span></label>
          <input id="ins" name="instansi" x-model="instansi" class="field-input" placeholder="Contoh: PT Telkom Indonesia / ITB">
          @error('instansi') <p class="text-xs text-red-500 font-semibold mt-1">{{ $message }}</p> @enderror
        </div>
        <div>
          <label class="field-label" for="lk">Kota Lokasi Tempat Bekerja / Kampus <span class="req">*</span></label>
          <input id="lk" name="lokasi_kerja" x-model="lokasi_kerja" class="field-input" placeholder="Contoh: Kota Bandung / Jakarta">
          @error('lokasi_kerja') <p class="text-xs text-red-500 font-semibold mt-1">{{ $message }}</p> @enderror
        </div>
      </div>

      <div class="flex items-center justify-between border-t border-navy/10 pt-6 mt-8">
        <a href="{{ route('spn.daftar.step2') }}" class="rounded-xl border-2 border-navy px-6 py-2.5 text-xs sm:text-sm font-bold text-navy hover:bg-paper transition">
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
