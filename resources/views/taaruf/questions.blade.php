@extends('layouts.app')

@section('title', 'Pertanyaan Tambahan Ta\'aruf - Bidang Dakwah Salman ITB')

@section('content')
<div class="min-h-screen bg-gray-50/70 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
        
        <!-- Header Card -->
        <div class="bg-gradient-to-br from-slate-900 via-rose-950 to-pink-950 rounded-3xl text-white p-6 sm:p-8 shadow-lg relative overflow-hidden">
            <div class="absolute inset-0 opacity-10 bg-[radial-gradient(#fff_1px,transparent_1px)] [background-size:16px_16px]"></div>
            
            <div class="relative z-10">
                <nav class="flex items-center gap-2 text-xs text-rose-300/80 mb-3 font-medium">
                    <a href="{{ route('alumni.dashboard') }}" class="hover:text-white transition">Dashboard Alumni</a>
                    <span>/</span>
                    <a href="{{ route('taaruf.index') }}" class="hover:text-white transition">Ta'aruf</a>
                    <span>/</span>
                    <span class="text-white font-semibold">Pertanyaan Tambahan</span>
                </nav>

                <h1 class="text-2xl sm:text-3xl font-bold tracking-tight text-white">
                    Pertanyaan Kesiapan Ta'aruf
                </h1>
                <p class="text-xs sm:text-sm text-slate-300 mt-1">
                    Jawab pertanyaan prinsip berikut secara jujur sebagai transparansi ikhtiar ta'aruf Anda.
                </p>
            </div>
        </div>

        @if (session('error'))
            <div class="bg-red-50 border border-red-200 text-red-800 p-4 rounded-2xl shadow-sm flex items-center justify-between" role="alert">
                <span class="text-sm font-medium">{{ session('error') }}</span>
                <button type="button" onclick="this.parentElement.remove()" class="text-red-500 hover:text-red-700">✕</button>
            </div>
        @endif

        @if (session('success'))
            <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 p-4 rounded-2xl shadow-sm flex items-center justify-between" role="alert">
                <span class="text-sm font-medium">{{ session('success') }}</span>
                <button type="button" onclick="this.parentElement.remove()" class="text-emerald-500 hover:text-emerald-700">✕</button>
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <!-- Left 2 Cols: Form -->
            <div class="lg:col-span-2 space-y-6">
                
                <form action="{{ route('taaruf.questions.save') }}" method="POST">
                    @csrf

                    <div class="bg-white rounded-2xl border border-gray-200/80 shadow-sm p-6 sm:p-8 space-y-6">
                        
                        <div class="border-b border-gray-100 pb-4">
                            <h2 class="text-base font-bold text-gray-900">Pertanyaan Prinsip &amp; Kesiapan</h2>
                            <p class="text-xs text-gray-500 mt-0.5">
                                Keterbukaan di awal menjadi pondasi sakinah dan saling percaya.
                            </p>
                        </div>

                        <!-- Q1: Sedang Proses Taaruf -->
                        <div class="space-y-2">
                            <label class="block text-xs font-bold text-gray-800">
                                1. Apakah Anda saat ini sedang dalam proses ta'aruf dengan orang lain? <span class="text-rose-500">*</span>
                            </label>
                            <div class="grid grid-cols-2 gap-3 max-w-sm">
                                <label class="flex items-center gap-2.5 p-3 rounded-xl border border-gray-200 hover:bg-gray-50 cursor-pointer text-xs font-semibold">
                                    <input type="radio" name="is_in_taaruf_process" value="1" required
                                        {{ old('is_in_taaruf_process', $taarufProfile->is_in_taaruf_process ?? '') ? 'checked' : '' }}
                                        class="text-rose-600 focus:ring-rose-500">
                                    <span>Ya, Sedang Proses</span>
                                </label>
                                <label class="flex items-center gap-2.5 p-3 rounded-xl border border-gray-200 hover:bg-gray-50 cursor-pointer text-xs font-semibold">
                                    <input type="radio" name="is_in_taaruf_process" value="0" required
                                        {{ old('is_in_taaruf_process', $taarufProfile->is_in_taaruf_process ?? '') === 0 ? 'checked' : '' }}
                                        class="text-rose-600 focus:ring-rose-500">
                                    <span>Tidak</span>
                                </label>
                            </div>
                            @error('is_in_taaruf_process')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Q2: Perokok -->
                        <div class="space-y-2 pt-4 border-t border-gray-100">
                            <label class="block text-xs font-bold text-gray-800">
                                2. Apakah Anda seorang perokok / pengguna vape? <span class="text-rose-500">*</span>
                            </label>
                            <div class="grid grid-cols-2 gap-3 max-w-sm">
                                <label class="flex items-center gap-2.5 p-3 rounded-xl border border-gray-200 hover:bg-gray-50 cursor-pointer text-xs font-semibold">
                                    <input type="radio" name="is_smoker" value="1" required
                                        {{ old('is_smoker', $taarufProfile->is_smoker ?? '') ? 'checked' : '' }}
                                        class="text-rose-600 focus:ring-rose-500">
                                    <span>Ya</span>
                                </label>
                                <label class="flex items-center gap-2.5 p-3 rounded-xl border border-gray-200 hover:bg-gray-50 cursor-pointer text-xs font-semibold">
                                    <input type="radio" name="is_smoker" value="0" required
                                        {{ old('is_smoker', $taarufProfile->is_smoker ?? '') === 0 ? 'checked' : '' }}
                                        class="text-rose-600 focus:ring-rose-500">
                                    <span>Tidak</span>
                                </label>
                            </div>
                            @error('is_smoker')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Q3: Poligami (khusus pria) -->
                        @if (auth()->user()->taarufProfile && auth()->user()->taarufProfile->gender === 'male')
                            <div class="space-y-2 pt-4 border-t border-gray-100">
                                <label class="block text-xs font-bold text-gray-800">
                                    3. Apakah Anda berniat untuk berpoligami di kemudian hari? <span class="text-rose-500">*</span>
                                </label>
                                <div class="grid grid-cols-2 gap-3 max-w-sm">
                                    <label class="flex items-center gap-2.5 p-3 rounded-xl border border-gray-200 hover:bg-gray-50 cursor-pointer text-xs font-semibold">
                                        <input type="radio" name="is_polygamy_intended" value="1" required
                                            {{ old('is_polygamy_intended', $taarufProfile->is_polygamy_intended ?? '') ? 'checked' : '' }}
                                            class="text-rose-600 focus:ring-rose-500">
                                        <span>Ya</span>
                                    </label>
                                    <label class="flex items-center gap-2.5 p-3 rounded-xl border border-gray-200 hover:bg-gray-50 cursor-pointer text-xs font-semibold">
                                        <input type="radio" name="is_polygamy_intended" value="0" required
                                            {{ old('is_polygamy_intended', $taarufProfile->is_polygamy_intended ?? '') === 0 ? 'checked' : '' }}
                                            class="text-rose-600 focus:ring-rose-500">
                                        <span>Tidak</span>
                                    </label>
                                </div>
                                @error('is_polygamy_intended')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        @else
                            <input type="hidden" name="is_polygamy_intended" value="0">
                        @endif

                        <!-- Q4: Hutang Signifikan -->
                        <div class="space-y-2 pt-4 border-t border-gray-100">
                            <label class="block text-xs font-bold text-gray-800">
                                4. Apakah Anda memiliki tanggungan hutang signifikan (KPR, cicilan produktif, dll)? <span class="text-rose-500">*</span>
                            </label>
                            <div class="grid grid-cols-2 gap-3 max-w-sm">
                                <label class="flex items-center gap-2.5 p-3 rounded-xl border border-gray-200 hover:bg-gray-50 cursor-pointer text-xs font-semibold">
                                    <input type="radio" name="has_debt" value="1" required
                                        {{ old('has_debt', $taarufProfile->has_debt ?? '') ? 'checked' : '' }}
                                        class="text-rose-600 focus:ring-rose-500">
                                    <span>Ya, Memiliki</span>
                                </label>
                                <label class="flex items-center gap-2.5 p-3 rounded-xl border border-gray-200 hover:bg-gray-50 cursor-pointer text-xs font-semibold">
                                    <input type="radio" name="has_debt" value="0" required
                                        {{ old('has_debt', $taarufProfile->has_debt ?? '') === 0 ? 'checked' : '' }}
                                        class="text-rose-600 focus:ring-rose-500">
                                    <span>Tidak Ada</span>
                                </label>
                            </div>
                            @error('has_debt')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Q5: Tanggungan Keluarga -->
                        <div class="space-y-2 pt-4 border-t border-gray-100">
                            <label class="block text-xs font-bold text-gray-800">
                                5. Apakah Anda memiliki tanggungan nafkah keluarga (orang tua, adik, dll)? <span class="text-rose-500">*</span>
                            </label>
                            <div class="grid grid-cols-2 gap-3 max-w-sm">
                                <label class="flex items-center gap-2.5 p-3 rounded-xl border border-gray-200 hover:bg-gray-50 cursor-pointer text-xs font-semibold">
                                    <input type="radio" name="has_dependents" value="1" required
                                        {{ old('has_dependents', $taarufProfile->has_dependents ?? '') ? 'checked' : '' }}
                                        class="text-rose-600 focus:ring-rose-500">
                                    <span>Ya</span>
                                </label>
                                <label class="flex items-center gap-2.5 p-3 rounded-xl border border-gray-200 hover:bg-gray-50 cursor-pointer text-xs font-semibold">
                                    <input type="radio" name="has_dependents" value="0" required
                                        {{ old('has_dependents', $taarufProfile->has_dependents ?? '') === 0 ? 'checked' : '' }}
                                        class="text-rose-600 focus:ring-rose-500">
                                    <span>Tidak</span>
                                </label>
                            </div>
                            @error('has_dependents')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="pt-6 border-t border-gray-100 flex items-center gap-3">
                            <button type="submit"
                                class="inline-flex items-center gap-2 px-6 py-2.5 rounded-xl bg-gradient-to-r from-rose-500 to-pink-500 hover:from-rose-600 hover:to-pink-600 text-white font-semibold text-xs shadow-md shadow-pink-500/20 transition">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                <span>Simpan Jawaban Pertanyaan</span>
                            </button>
                            <a href="{{ route('taaruf.index') }}"
                                class="px-4 py-2.5 rounded-xl border border-gray-300 bg-white hover:bg-gray-50 text-gray-700 text-xs font-semibold transition">
                                Batal
                            </a>
                        </div>

                    </div>
                </form>

            </div>

            <!-- Right 1 Col: Info -->
            <div class="space-y-6">
                <div class="bg-white rounded-2xl border border-gray-200/80 shadow-sm p-6 space-y-4">
                    <h3 class="text-sm font-bold text-gray-900 pb-3 border-b border-gray-100 flex items-center gap-2">
                        <span>💡</span>
                        <span>Mengapa Keterbukaan Ini Penting?</span>
                    </h3>
                    <p class="text-xs text-gray-600 leading-relaxed">
                        Pertanyaan di atas dirancang untuk meminimalisir kesalahpahaman dan memastikan kedua pihak memiliki kesiapan mental dan finansial sebelum melangkah ke proses ta'aruf yang lebih serius.
                    </p>
                    <div class="p-3 bg-amber-50 rounded-xl border border-amber-100 text-xs text-amber-800">
                        Jawaban Anda dapat diperbarui sewaktu-waktu jika terjadi perubahan kondisi.
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>
@endsection
