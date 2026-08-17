@extends('layouts.spn')
@section('title', 'Pertanyaan Pendahuluan — Pendaftaran SPN Salman ITB')

@section('content')
<main class="max-w-3xl mx-auto px-5 sm:px-6 py-10 sm:py-14">
  
  @include('spn.daftar._progress-bar', ['currentStep' => 1])

  <div class="frame-marks bg-white border-2 border-navy/30 rounded-2xl shadow-sm p-6 sm:p-9" x-data="{
    restu: '{{ old('restu', session('spn_step1.restu', '')) }}',
    gambaran: '{{ old('gambaran_awal', session('spn_step1.gambaran_awal', '')) }}',
    alasan: '{{ old('alasan', session('spn_step1.alasan', '')) }}',
    harapan: '{{ old('harapan', session('spn_step1.harapan', '')) }}',
    get valid(){
      return this.restu !== '' && this.gambaran.trim().length > 0 && this.alasan.trim().length > 0 && this.harapan.trim().length > 0;
    }
  }" x-cloak>
    <div class="fm-tr"></div><div class="fm-bl"></div>

    <div class="mb-7 border-b border-navy/10 pb-4">
      <span class="text-xs font-extrabold uppercase tracking-[0.2em] text-orange">Langkah 1 dari 6</span>
      <h1 class="font-display text-2xl sm:text-3xl text-navy font-black mt-1">Pertanyaan Pendahuluan</h1>
      <p class="text-xs sm:text-sm text-navy/70 mt-1">Sebelum melanjutkan ke pengisian biodata, mohon jawab beberapa pertanyaan reflektif berikut.</p>
    </div>

    @if(session('error'))
        <div class="mb-6 p-4 rounded-xl bg-red-50 border border-red-200 text-sm font-semibold text-red-600">
            {{ session('error') }}
        </div>
    @endif

    <form method="POST" action="{{ route('spn.daftar.store-step1') }}" class="space-y-6">
      @csrf

      <div>
        <label class="field-label">Sudah mendapat restu dari orang tua, wali, atau keluarga untuk mengikuti SPN Salman? <span class="req">*</span></label>
        <div class="space-y-2.5">
          <label class="flex items-center gap-3 border-2 rounded-xl px-4 py-3 cursor-pointer transition"
            :class="restu==='sudah' ? 'border-orange bg-orangesoft/30 text-navy font-bold' : 'border-navy/15 hover:border-navy/40 text-navy/80'">
            <input type="radio" name="restu" value="sudah" x-model="restu" class="w-4 h-4 text-orange focus:ring-orange">
            <span class="text-sm">Alhamdulillah, sudah</span>
          </label>
          <label class="flex items-center gap-3 border-2 rounded-xl px-4 py-3 cursor-pointer transition"
            :class="restu==='akan' ? 'border-orange bg-orangesoft/30 text-navy font-bold' : 'border-navy/15 hover:border-navy/40 text-navy/80'">
            <input type="radio" name="restu" value="akan" x-model="restu" class="w-4 h-4 text-orange focus:ring-orange">
            <span class="text-sm">Sehabis ini pasti akan meminta restu</span>
          </label>
        </div>
        @error('restu') <p class="text-xs text-red-500 font-semibold mt-1">{{ $message }}</p> @enderror
      </div>

      <div>
        <label class="field-label" for="gambaran">Apa gambaran awalmu terkait Sekolah Pranikah Salman ITB? <span class="req">*</span></label>
        <textarea id="gambaran" name="gambaran_awal" x-model="gambaran" maxlength="500" rows="3"
          class="field-input" placeholder="Ceritakan gambaran awalmu tentang program ini..."></textarea>
        <p class="text-xs text-navy/50 text-right mt-1 font-semibold" x-text="gambaran.length + '/500'"></p>
        @error('gambaran_awal') <p class="text-xs text-red-500 font-semibold mt-1">{{ $message }}</p> @enderror
      </div>

      <div>
        <label class="field-label" for="alasan">Apa alasanmu mengikuti Sekolah Pranikah Salman ITB? <span class="req">*</span></label>
        <textarea id="alasan" name="alasan" x-model="alasan" maxlength="500" rows="3"
          class="field-input" placeholder="Tuliskan motivasi & alasan utamamu..."></textarea>
        <p class="text-xs text-navy/50 text-right mt-1 font-semibold" x-text="alasan.length + '/500'"></p>
        @error('alasan') <p class="text-xs text-red-500 font-semibold mt-1">{{ $message }}</p> @enderror
      </div>

      <div>
        <label class="field-label" for="harapan">Apa harapanmu setelah mengikuti Sekolah Pranikah Salman ITB? <span class="req">*</span></label>
        <textarea id="harapan" name="harapan" x-model="harapan" maxlength="500" rows="3"
          class="field-input" placeholder="Tuliskan harapan setelah menyelesaikan program ini..."></textarea>
        <p class="text-xs text-navy/50 text-right mt-1 font-semibold" x-text="harapan.length + '/500'"></p>
        @error('harapan') <p class="text-xs text-red-500 font-semibold mt-1">{{ $message }}</p> @enderror
      </div>

      <div class="flex items-center justify-between border-t border-navy/10 pt-6 mt-8">
        <span></span>
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
