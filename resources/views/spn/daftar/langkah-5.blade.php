@extends('layouts.spn')
@section('title', 'Konfirmasi & Pembayaran — Pendaftaran SPN Salman ITB')

@section('content')
<main class="max-w-3xl mx-auto px-5 sm:px-6 py-10 sm:py-14">
  
  @include('spn.daftar._progress-bar', ['currentStep' => 5])

  <div class="frame-marks bg-white border-2 border-navy/30 rounded-2xl shadow-sm p-6 sm:p-9" x-data="{
    buktiName: '',
    buktiSize: '',
    buktiPreview: null,
    isPdf: false,
    setuju: false,
    copied: false,
    isSubmitting: false,
    handleFile(e) {
      const file = e.target.files.length ? e.target.files[0] : null;
      if (!file) return;

      this.buktiName = file.name;
      this.buktiSize = (file.size / 1024 / 1024 < 1) 
        ? Math.round(file.size / 1024) + ' KB' 
        : (file.size / 1024 / 1024).toFixed(2) + ' MB';
      this.isPdf = file.type === 'application/pdf' || file.name.toLowerCase().endsWith('.pdf');

      if (file.type.startsWith('image/')) {
        const reader = new FileReader();
        reader.onload = (event) => {
          this.buktiPreview = event.target.result;
        };
        reader.readAsDataURL(file);
      } else {
        this.buktiPreview = null;
      }
    },
    triggerFileInput() {
      this.$refs.fileInput.click();
    },
    cancelFile() {
      this.buktiName = '';
      this.buktiSize = '';
      this.buktiPreview = null;
      this.isPdf = false;
      if (this.$refs.fileInput) {
        this.$refs.fileInput.value = '';
      }
    },
    copyRekening() {
      navigator.clipboard.writeText('1130011057');
      this.copied = true;
      setTimeout(() => this.copied = false, 2500);
    },
    get valid() {
      return this.setuju === true && this.buktiName !== '';
    }
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

    <form method="POST" action="{{ route('spn.daftar.store-step5') }}" enctype="multipart/form-data" class="space-y-6" @submit="isSubmitting = true">
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
          <div class="flex justify-between py-2 items-center">
            <span class="text-navy/60">TTL &amp; Usia</span>
            <span class="font-semibold text-navy text-right">
              @php
                $tglLahir = !empty($reviewData['tanggal_lahir']) ? \Carbon\Carbon::parse($reviewData['tanggal_lahir']) : null;
                $calculatedAge = $tglLahir ? $tglLahir->age : ($reviewData['usia'] ?? null);
              @endphp
              {{ !empty($reviewData['asal_daerah']) ? $reviewData['asal_daerah'].', ' : '' }}
              {{ $tglLahir ? $tglLahir->translatedFormat('d F Y') : ($reviewData['tanggal_lahir'] ?? '-') }}
              @if(!empty($calculatedAge))
                <span class="text-orange font-bold">({{ $calculatedAge }} tahun)</span>
              @endif
            </span>
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

        <div class="space-y-2.5 text-xs sm:text-sm">
          <div class="flex justify-between text-cream/80">
            <span>Harga Dasar Paket ({{ $reviewData['_paket_name'] ?? $reviewData['paket_nama'] ?? ucwords(str_replace('_', ' ', $reviewData['paket'] ?? 'SPN')) }}):</span>
            <span class="font-semibold">Rp {{ number_format($reviewData['harga_dasar'] ?? 0, 0, ',', '.') }}</span>
          </div>

          @if(!empty($reviewData['potongan_diskon']) && $reviewData['potongan_diskon'] > 0)
            @php
              $discPercentage = !empty($reviewData['harga_dasar']) && $reviewData['harga_dasar'] > 0
                ? round(($reviewData['potongan_diskon'] / $reviewData['harga_dasar']) * 100)
                : 0;
              $discLabel = !empty($reviewData['discount_label'])
                ? $reviewData['discount_label']
                : (!empty($reviewData['_discount_label'])
                  ? $reviewData['_discount_label']
                  : 'Kategori Khusus');
            @endphp
            <div class="flex justify-between items-start text-emerald-400 bg-white/5 p-3 rounded-xl border border-emerald-400/20">
              <div>
                <div class="flex items-center gap-1.5 font-bold text-xs sm:text-sm">
                  <span>Potongan Diskon Kategori</span>
                  @if($discPercentage > 0)
                    <span class="px-1.5 py-0.5 rounded bg-emerald-400/20 text-emerald-300 text-[10px] font-extrabold">
                      {{ $discPercentage }}%
                    </span>
                  @endif
                </div>
                <span class="text-[11px] text-emerald-300 font-semibold block mt-0.5">
                  Label: {{ $discLabel }}
                </span>
              </div>
              <span class="font-bold text-sm sm:text-base text-emerald-400 shrink-0">
                - Rp {{ number_format($reviewData['potongan_diskon'], 0, ',', '.') }}
              </span>
            </div>
          @endif

          @if(!empty($reviewData['potongan_referal']) && $reviewData['potongan_referal'] > 0)
            <div class="flex justify-between items-center text-emerald-400 bg-white/5 p-3 rounded-xl border border-emerald-400/20">
              <div>
                <span class="font-bold text-xs sm:text-sm">Potongan Referral</span>
                @if(!empty($reviewData['_referral_code']) || !empty($reviewData['kode_referal']))
                  <span class="text-[11px] text-emerald-300 font-mono block mt-0.5">
                    Kode: {{ $reviewData['_referral_code'] ?? $reviewData['kode_referal'] }}
                  </span>
                @endif
              </div>
              <span class="font-bold text-sm sm:text-base text-emerald-400 shrink-0">
                - Rp {{ number_format($reviewData['potongan_referal'], 0, ',', '.') }}
              </span>
            </div>
          @endif

          <div class="border-t border-white/15 pt-3 mt-3 flex justify-between items-center">
            <div>
              <span class="font-display font-black text-base block">Total yang Harus Ditransfer:</span>
              <span class="text-[10px] text-cream/60">Termasuk seluruh potongan diskon</span>
            </div>
            <span class="font-display font-black text-orange text-2xl">
              Rp {{ number_format($reviewData['total_bayar'] ?? 0, 0, ',', '.') }}
            </span>
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

      <!-- Upload Bukti Bayar with Cancel & Change Controls -->
      <div>
        <label class="field-label" for="bb">Unggah Berkas Bukti Pembayaran <span class="req">*</span></label>
        <input id="bb" x-ref="fileInput" type="file" name="bukti_bayar" @change="handleFile($event)" accept="image/jpeg,image/png,image/jpg,image/webp,application/pdf" class="sr-only" tabindex="-1">
        
        <!-- State 1: Belum Ada File Dipilih -->
        <div x-show="!buktiName"
          @click="triggerFileInput()"
          class="border-2 border-dashed border-navy/30 rounded-2xl p-7 text-center bg-paper/40 hover:bg-paper cursor-pointer transition duration-200 group">
          <div class="w-14 h-14 rounded-2xl bg-orange/10 text-orange flex items-center justify-center text-2xl mx-auto mb-3 group-hover:scale-110 transition duration-200">
            📁
          </div>
          <span class="text-xs sm:text-sm font-black text-navy block">Klik untuk memilih file bukti transfer</span>
          <span class="text-[11px] text-navy/60 block mt-1">Mendukung format: JPG, PNG, WEBP, atau PDF (Maksimal 5 MB)</span>
          <div class="mt-3">
            <span class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl bg-navy text-white font-bold text-xs group-hover:bg-orange transition shadow-xs">
              <span>Pilih File Dari Perangkat</span>
            </span>
          </div>
        </div>

        <!-- State 2: File Sudah Terpilih (Dengan Tombol Ganti & Batalkan / Hapus) -->
        <div x-show="buktiName" x-cloak
          class="bg-white border-2 border-emerald-500/60 rounded-2xl p-5 shadow-xs space-y-3">
          <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
            <div class="flex items-center gap-3.5 min-w-0">
              <!-- Thumbnail Preview jika gambar, atau icon jika PDF -->
              <template x-if="buktiPreview">
                <div class="w-14 h-14 rounded-xl overflow-hidden border border-emerald-300 shrink-0 bg-gray-100 shadow-2xs">
                  <img :src="buktiPreview" alt="Preview" class="w-full h-full object-cover">
                </div>
              </template>
              <template x-if="!buktiPreview">
                <div class="w-14 h-14 rounded-xl bg-red-50 text-red-600 flex items-center justify-center text-2xl shrink-0 border border-red-200">
                  📄
                </div>
              </template>

              <div class="min-w-0">
                <div class="flex items-center gap-2">
                  <span class="px-2 py-0.5 rounded-md bg-emerald-100 text-emerald-800 text-[10px] font-extrabold">
                    ✓ File Siap Diunggah
                  </span>
                  <span class="text-[11px] text-gray-500 font-mono" x-text="buktiSize"></span>
                </div>
                <p class="text-xs sm:text-sm font-bold text-navy truncate mt-0.5" x-text="buktiName"></p>
              </div>
            </div>

            <!-- Action Buttons: Ganti & Batal -->
            <div class="flex items-center gap-2 w-full sm:w-auto justify-end shrink-0 pt-2 sm:pt-0 border-t sm:border-t-0 border-gray-100">
              <button type="button" @click="triggerFileInput()"
                class="px-3.5 py-1.5 rounded-xl bg-gray-100 hover:bg-gray-200 text-navy text-xs font-bold transition flex items-center gap-1.5 shadow-2xs">
                <span>🔄</span>
                <span>Ganti File</span>
              </button>
              <button type="button" @click="cancelFile()"
                class="px-3.5 py-1.5 rounded-xl bg-rose-50 hover:bg-rose-100 text-rose-600 text-xs font-bold transition flex items-center gap-1.5 border border-rose-200 shadow-2xs">
                <span>✕</span>
                <span>Batalkan</span>
              </button>
            </div>
          </div>
        </div>

        @error('bukti_bayar') <p class="text-xs text-red-500 font-semibold mt-1.5">{{ $message }}</p> @enderror
      </div>

      <!-- Pernyataan & Janji Peserta -->
      <div class="pt-2">
        <label class="flex items-start gap-3 p-4 rounded-xl border-2 border-navy/20 bg-paper cursor-pointer hover:border-orange transition">
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
        <button type="submit" :disabled="!(valid) || isSubmitting"
          :class="(valid && !isSubmitting) ? 'bg-orange hover:bg-navy text-white cursor-pointer shadow-md' : 'bg-navy/15 text-navy/40 cursor-not-allowed'"
          class="rounded-xl px-8 py-3 text-sm font-extrabold transition flex items-center justify-center min-w-[240px]">
          <span x-show="!isSubmitting">Selesaikan &amp; Kirim Pendaftaran &rarr;</span>
          <span x-show="isSubmitting" class="inline-flex items-center gap-2" x-cloak>
            <svg class="animate-spin h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
              <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
              <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            <span>Memproses Pendaftaran...</span>
          </span>
        </button>
      </div>

    </form>
  </div>
  <p class="text-center text-xs text-navy/50 mt-6 font-semibold">Sekolah Pranikah &middot; Salman ITB</p>
</main>
@endsection
