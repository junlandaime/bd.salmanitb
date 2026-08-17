@extends('layouts.spn')
@section('title', 'Paket & Pembayaran — Pendaftaran SPN Salman ITB')

@section('content')
<main class="max-w-3xl mx-auto px-5 sm:px-6 py-10 sm:py-14">

  @include('spn.daftar._progress-bar', ['currentStep' => 4])

  <div class="frame-marks bg-white border-2 border-navy/30 rounded-2xl shadow-sm p-6 sm:p-9" x-data="{
    packages: {{ json_encode($packages->map(fn($p) => ['id' => $p->id, 'name' => $p->name, 'slug' => $p->slug, 'base_price' => (float)$p->base_price, 'is_available' => $p->isAvailable()])) }},
    prices: {
        @foreach($packages as $pkg)
            '{{ $pkg->id }}': {{ $pkg->base_price }},
        @endforeach
    },
    paket: '{{ old('paket', session('spn_step4.spn_pricing_package_id', '')) }}',
    selectedDiscountId: '{{ old('spn_discount_id', session('spn_step4.spn_discount_id', '')) }}',
    referal: '{{ old('kode_referal', '') }}',
    metode_bayar: '{{ old('metode_bayar', session('spn_step4.metode_bayar', '')) }}',
    info_dari: '{{ old('info_dari', session('spn_step4.info_dari', '')) }}',
    status_diri: '{{ session('spn_step3.status_diri', '') }}',
    universitas: '{{ session('spn_step3.universitas', '') }}',
    referral_discount: 0,
    is_validating: false,
    referral_message: '',
    referral_valid: false,
    discounts: {{ json_encode($discounts->map(fn($d) => ['id' => $d->id, 'percent' => $d->discount_percent, 'label' => $d->label, 'applies_to' => $d->applies_to_status_diri])) }},
    init() {
        const availablePackages = this.packages.filter(p => p.is_available);
        if (!this.paket || !availablePackages.some(p => String(p.id) === String(this.paket))) {
            if (availablePackages.length > 0) {
                this.paket = String(availablePackages[0].id);
            }
        }
        if (!this.selectedDiscountId) {
            const auto = this.findMatchingDiscount();
            if (auto) {
                this.selectedDiscountId = String(auto.id);
            }
        }
    },
    findMatchingDiscount() {
        if (!this.status_diri) return null;
        return this.discounts.find(d => {
            if (!d.applies_to) return false;
            if (d.applies_to === 'mahasiswa') {
                return this.status_diri === 'mahasiswa' && this.universitas.toLowerCase() === 'itb';
            }
            if (d.applies_to === 'alumni_itb' || d.applies_to === 'alumni') {
                return this.status_diri === 'alumni' || this.status_diri === 'alumni_itb';
            }
            if (d.applies_to === 'dosen' || d.applies_to === 'karyawan_dosen') {
                return this.status_diri === 'dosen' || this.status_diri === 'karyawan';
            }
            return d.applies_to === this.status_diri;
        });
    },
    get isNormalBird() {
        const pkg = this.packages.find(p => String(p.id) === String(this.paket));
        return pkg ? (pkg.slug === 'normal_bird' || pkg.name.toLowerCase().includes('normal')) : true;
    },
    get activeDiscount() {
        if (!this.isNormalBird || !this.selectedDiscountId) return null;
        return this.discounts.find(d => String(d.id) === String(this.selectedDiscountId));
    },
    get discountPercent() {
        return this.activeDiscount ? this.activeDiscount.percent : 0;
    },
    get discountLabel() {
        return this.activeDiscount ? this.activeDiscount.label + ' (' + this.activeDiscount.percent + '%)' : '';
    },
    get hargaDasar(){ return this.prices[this.paket] || 0; },
    get potonganDiskon(){ return Math.round(this.hargaDasar * this.discountPercent / 100); },
    get hargaSetelahDiskon(){ return Math.max(0, this.hargaDasar - this.potonganDiskon); },
    get totalBayar(){ return Math.max(0, this.hargaSetelahDiskon - this.referral_discount); },
    get totalFormatted(){ return 'Rp' + this.totalBayar.toLocaleString('id-ID'); },
    get valid(){ return this.paket && this.metode_bayar && this.info_dari; },
    validateReferral() {
        if (!this.referal.trim()) return;
        this.is_validating = true;
        this.referral_message = '';
        fetch('{{ route('spn.daftar.validate-referral') }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ code: this.referal })
        })
        .then(res => res.json())
        .then(data => {
            this.is_validating = false;
            if (data.valid) {
                this.referral_valid = true;
                this.referral_discount = parseFloat(data.discount_amount);
                this.referral_message = 'Kode valid! Milik: ' + data.owner_name + ' (Diskon Rp' + this.referral_discount.toLocaleString('id-ID') + ')';
            } else {
                this.referral_valid = false;
                this.referral_discount = 0;
                this.referral_message = data.message || 'Kode referral tidak valid atau sudah kedaluwarsa.';
            }
        })
        .catch(() => {
            this.is_validating = false;
            this.referral_valid = false;
            this.referral_discount = 0;
            this.referral_message = 'Gagal memvalidasi kode. Silakan coba lagi.';
        });
    }
  }" x-cloak>
    <div class="fm-tr"></div><div class="fm-bl"></div>

    <div class="mb-7 border-b border-navy/10 pb-4">
      <span class="text-xs font-extrabold uppercase tracking-[0.2em] text-orange">Langkah 4 dari 6</span>
      <h1 class="font-display text-2xl sm:text-3xl text-navy font-black mt-1">Paket &amp; Pembayaran</h1>
      <p class="text-xs sm:text-sm text-navy/70 mt-1">Pilih paket harga, terapkan potongan kategori atau kode referral, dan pilih metode pembayaran.</p>
    </div>

    @if(session('error'))
        <div class="mb-6 p-4 rounded-xl bg-red-50 border border-red-200 text-sm font-semibold text-red-600">
            {{ session('error') }}
        </div>
    @endif

    <form method="POST" action="{{ route('spn.daftar.store-step4') }}" class="space-y-6">
      @csrf

      <!-- Paket Pilihan -->
      <div>
        <label class="field-label">Pilihan Paket SPN <span class="req">*</span></label>
        <div class="grid sm:grid-cols-2 gap-4">
          @foreach($packages as $pkg)
            @php
              $isAvailable = $pkg->isAvailable();
            @endphp
            @if($isAvailable)
              <label class="relative flex items-center justify-between border-2 rounded-xl p-4 cursor-pointer transition"
                :class="paket==='{{ $pkg->id }}' ? 'border-orange bg-orangesoft/30 shadow-xs' : 'border-navy/15 hover:border-navy/40'">
                <div class="flex items-center gap-3">
                  <input type="radio" name="paket" value="{{ $pkg->id }}" x-model="paket" class="w-4 h-4 text-orange focus:ring-orange">
                  <div>
                    <span class="block font-display font-bold text-navy text-sm">{{ $pkg->name }}</span>
                    <span class="block text-xs font-black text-orange mt-0.5">Rp {{ number_format($pkg->base_price, 0, ',', '.') }}</span>
                    @if($pkg->available_until)
                      <span class="block text-[11px] text-navy/60 mt-0.5">s.d. {{ $pkg->available_until->translatedFormat('d F Y') }}</span>
                    @endif
                  </div>
                </div>
                @if($pkg->slug === 'early_bird' || str_contains(strtolower($pkg->name), 'early'))
                  <span class="text-[10px] font-extrabold uppercase tracking-wider bg-orange/15 text-orange px-2 py-0.5 rounded-full">
                    Hemat
                  </span>
                @endif
              </label>
            @else
              <div class="relative flex items-center justify-between border-2 border-navy/15 bg-gray-100/70 rounded-xl p-4 opacity-60 cursor-not-allowed select-none">
                <div class="flex items-center gap-3">
                  <input type="radio" disabled class="w-4 h-4 text-gray-400 cursor-not-allowed">
                  <div>
                    <span class="block font-display font-bold text-navy/70 text-sm flex items-center gap-1.5">
                      {{ $pkg->name }}
                      <span class="text-xs">🔒</span>
                    </span>
                    <span class="block text-xs font-bold text-navy/50 mt-0.5">Rp {{ number_format($pkg->base_price, 0, ',', '.') }}</span>
                    @if($pkg->available_until)
                      <span class="block text-[11px] text-red-500 font-semibold mt-0.5">Berakhir {{ $pkg->available_until->translatedFormat('d M Y') }}</span>
                    @endif
                  </div>
                </div>
                <span class="text-[10px] font-bold uppercase tracking-wider bg-gray-200 text-gray-600 px-2.5 py-0.5 rounded-full border border-gray-300">
                  Ditutup
                </span>
              </div>
            @endif
          @endforeach
        </div>
        @error('paket') <p class="text-xs text-red-500 font-semibold mt-1">{{ $message }}</p> @enderror
      </div>

      <!-- Diskon Kategori (Normal Bird Only) -->
      <div x-show="isNormalBird" x-collapse class="space-y-3 bg-paper p-5 rounded-xl border-2 border-navy/15">
        <label class="field-label" for="disc">Potongan Kategori Khusus (Jika Ada)</label>
        <select id="disc" name="spn_discount_id" x-model="selectedDiscountId" class="field-input">
          <option value="">Tidak ada potongan / Kategori Umum (0%)</option>
          @foreach($discounts as $disc)
            <option value="{{ $disc->id }}">
              {{ $disc->label }} &mdash; Diskon {{ $disc->discount_percent }}%
            </option>
          @endforeach
        </select>
        <p class="text-[11px] text-navy/60">Diskon kategori berlaku untuk paket Normal Bird.</p>
      </div>

      <!-- Kode Referral -->
      <div>
        <label class="field-label" for="ref">Kode Referral / Voucher Promo (Opsional)</label>
        <div class="flex gap-2">
          <input id="ref" name="kode_referal" x-model="referal" class="field-input uppercase" placeholder="Contoh: SALMAN2026">
          <button type="button" @click="validateReferral()" :disabled="is_validating || !referal.trim()"
            class="px-5 py-2.5 rounded-xl bg-navy text-cream hover:bg-orange font-bold text-xs shrink-0 transition disabled:opacity-50">
            <span x-show="!is_validating">Terapkan</span>
            <span x-show="is_validating">Cek...</span>
          </button>
        </div>
        <p x-show="referral_message" class="text-xs mt-1.5 font-bold" :class="referral_valid ? 'text-emerald-600' : 'text-red-500'" x-text="referral_message"></p>
      </div>

      <!-- Ringkasan Perhitungan -->
      <div class="bg-paper border-2 border-navy/15 rounded-xl p-5 space-y-2 text-xs sm:text-sm">
        <div class="flex justify-between text-navy/70">
          <span>Harga Dasar:</span>
          <span class="font-bold text-navy" x-text="'Rp' + hargaDasar.toLocaleString('id-ID')"></span>
        </div>
        <div x-show="potonganDiskon > 0" class="flex justify-between text-emerald-700">
          <span>Potongan Kategori (<span x-text="discountPercent + '%'"></span>):</span>
          <span class="font-bold" x-text="'- Rp' + potonganDiskon.toLocaleString('id-ID')"></span>
        </div>
        <div x-show="referral_discount > 0" class="flex justify-between text-emerald-700">
          <span>Potongan Kode Referral:</span>
          <span class="font-bold" x-text="'- Rp' + referral_discount.toLocaleString('id-ID')"></span>
        </div>
        <div class="border-t border-navy/15 pt-2 mt-2 flex justify-between items-center">
          <span class="font-display font-black text-navy text-sm sm:text-base">Total yang Harus Dibayar:</span>
          <span class="font-display font-black text-orange text-lg sm:text-2xl" x-text="totalFormatted"></span>
        </div>
      </div>

      <!-- Metode Pembayaran -->
      <div>
        <label class="field-label">Metode Pembayaran <span class="req">*</span></label>
        <div class="grid sm:grid-cols-2 gap-3">
          <label class="flex items-center gap-3 border-2 rounded-xl p-3.5 cursor-pointer transition"
            :class="metode_bayar==='transfer' ? 'border-orange bg-orangesoft/30 text-navy font-bold' : 'border-navy/15 hover:border-navy/40 text-navy/80'">
            <input type="radio" name="metode_bayar" value="transfer" x-model="metode_bayar" class="w-4 h-4 text-orange focus:ring-orange">
            <div>
              <span class="block text-sm">Transfer Bank Muamalat</span>
              <span class="block text-[11px] text-navy/60">Verifikasi manual via bukti transfer</span>
            </div>
          </label>
          <label class="flex items-center gap-3 border-2 rounded-xl p-3.5 cursor-pointer transition"
            :class="metode_bayar==='qris' ? 'border-orange bg-orangesoft/30 text-navy font-bold' : 'border-navy/15 hover:border-navy/40 text-navy/80'">
            <input type="radio" name="metode_bayar" value="qris" x-model="metode_bayar" class="w-4 h-4 text-orange focus:ring-orange">
            <div>
              <span class="block text-sm">QRIS Salman ITB</span>
              <span class="block text-[11px] text-navy/60">Scan barcode QRIS resmi</span>
            </div>
          </label>
        </div>
        @error('metode_bayar') <p class="text-xs text-red-500 font-semibold mt-1">{{ $message }}</p> @enderror
      </div>

      <!-- Info Dari -->
      <div>
        <label class="field-label" for="inf">Mengetahui Informasi SPN Dari Mana? <span class="req">*</span></label>
        <select id="inf" name="info_dari" x-model="info_dari" class="field-input">
          <option value="">Pilih sumber informasi</option>
          <option value="instagram_salman">Instagram @spn.salmanitb / @bidakwah.salmanitb</option>
          <option value="alumni_spn">Rekomendasi Teman / Alumni SPN</option>
          <option value="poster_masjid">Poster / Banner di Masjid Salman ITB</option>
          <option value="whatsapp_broadcast">Grup WhatsApp / Broadcast</option>
          <option value="website_salman">Website Resmi Salman ITB</option>
          <option value="lainnya">Lainnya</option>
        </select>
        @error('info_dari') <p class="text-xs text-red-500 font-semibold mt-1">{{ $message }}</p> @enderror
      </div>

      <div class="flex items-center justify-between border-t border-navy/10 pt-6 mt-8">
        <a href="{{ route('spn.daftar.step3') }}" class="rounded-xl border-2 border-navy px-6 py-2.5 text-xs sm:text-sm font-bold text-navy hover:bg-paper transition">
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
