@extends('layouts.peserta')

@section('title', 'Kirim Feedback Baru - Dashboard Peserta')
@section('header', 'Kirim Feedback')

@section('content')
<div class="max-w-3xl mx-auto space-y-6">

    <!-- Header Card -->
    <div class="flex items-center gap-3">
        <a href="{{ route('peserta.feedback.index') }}"
            class="inline-flex items-center justify-center w-9 h-9 rounded-xl bg-white border border-gray-200 text-gray-600 hover:text-teal-700 hover:bg-teal-50 shadow-2xs transition">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
        </a>
        <div>
            <h2 class="text-xl font-bold text-gray-900">Kirim Feedback / Pertanyaan</h2>
            <p class="text-xs text-gray-500 mt-0.5">Admin pengelola Bidang Dakwah akan meninjau dan merespon pesan Anda.</p>
        </div>
    </div>

    <!-- Form Card -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 sm:p-8">
        <form action="{{ route('peserta.feedback.store') }}" method="POST" class="space-y-5">
            @csrf
            
            <!-- Category -->
            <div>
                <label for="category" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1.5">
                    Kategori Feedback <span class="text-red-500">*</span>
                </label>
                <select id="category" name="category" required
                    class="w-full px-3.5 py-2.5 text-sm border border-gray-300 rounded-xl focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition bg-white">
                    <option value="">Pilih kategori yang sesuai...</option>
                    @foreach($categories as $value => $label)
                        <option value="{{ $value }}" {{ old('category') == $value ? 'selected' : '' }}>
                            {{ $label }}
                        </option>
                    @endforeach
                </select>
                @error('category')
                    <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Subject -->
            <div>
                <label for="subject" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1.5">
                    Judul / Subjek <span class="text-red-500">*</span>
                </label>
                <input type="text" name="subject" id="subject" value="{{ old('subject') }}" required
                    class="w-full px-3.5 py-2.5 text-sm border border-gray-300 rounded-xl focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition"
                    placeholder="Contoh: Pertanyaan seputar jadwal SPN Batch 17 / Kendala upload berkas">
                @error('subject')
                    <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Message -->
            <div>
                <label for="message" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1.5">
                    Pesan Lengkap <span class="text-red-500">*</span>
                </label>
                <textarea id="message" name="message" rows="6" required
                    class="w-full px-3.5 py-2.5 text-sm border border-gray-300 rounded-xl focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition"
                    placeholder="Tuliskan pesan, pertanyaan, atau keluhan Anda secara detail...">{{ old('message') }}</textarea>
                @error('message')
                    <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Buttons -->
            <div class="flex items-center justify-end gap-3 pt-3 border-t border-gray-100">
                <a href="{{ route('peserta.feedback.index') }}"
                    class="px-4 py-2.5 rounded-xl border border-gray-300 text-gray-700 text-xs font-semibold hover:bg-gray-50 transition">
                    Batal
                </a>
                <button type="submit"
                    class="inline-flex items-center gap-2 px-5 py-2.5 bg-teal-600 hover:bg-teal-700 text-white text-xs font-bold rounded-xl shadow-sm transition">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                    </svg>
                    <span>Kirim Feedback</span>
                </button>
            </div>
        </form>
    </div>

</div>
@endsection
