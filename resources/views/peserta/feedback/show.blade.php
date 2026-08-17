@extends('layouts.peserta')

@section('title', 'Detail Feedback - Dashboard Peserta')
@section('header', 'Detail Feedback')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">

    <!-- Top Navigation & Title -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div class="flex items-center gap-3">
            <a href="{{ route('peserta.feedback.index') }}"
                class="inline-flex items-center justify-center w-9 h-9 rounded-xl bg-white border border-gray-200 text-gray-600 hover:text-teal-700 hover:bg-teal-50 shadow-2xs transition">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
            </a>
            <div>
                <div class="flex items-center gap-2">
                    <span class="px-2.5 py-0.5 rounded-full text-xs font-semibold bg-gray-100 text-gray-700 border border-gray-200">
                        {{ $feedback->category_label }}
                    </span>
                    <span class="px-2.5 py-0.5 rounded-full text-xs font-bold border {{ $feedback->status_badge }}">
                        {{ $feedback->status_label }}
                    </span>
                </div>
                <h2 class="text-xl font-bold text-gray-900 mt-1">
                    {{ $feedback->subject }}
                </h2>
            </div>
        </div>
    </div>

    <!-- Answered Alert Notice -->
    @if($feedback->status === 'answered')
        <div class="p-4 bg-emerald-50 border border-emerald-300 rounded-xl flex items-center justify-between text-emerald-900 text-xs shadow-2xs">
            <div class="flex items-center gap-2.5">
                <i class="fas fa-check-circle text-emerald-600 text-base"></i>
                <div>
                    <strong class="font-bold">Admin telah menanggapi feedback Anda!</strong> Silakan baca jawaban di bawah ini. Anda dapat mengirimkan balasan lanjutan jika diperlukan.
                </div>
            </div>
        </div>
    @endif

    <!-- Original Feedback Card -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
        <div class="flex items-center justify-between pb-3 border-b border-gray-100 mb-3">
            <div class="flex items-center gap-2.5">
                <div class="w-8 h-8 rounded-lg bg-teal-100 text-teal-800 flex items-center justify-center font-bold text-xs shrink-0">
                    {{ strtoupper(substr($feedback->user->name ?? 'P', 0, 1)) }}
                </div>
                <div>
                    <div class="font-bold text-xs text-gray-900">Anda ({{ $feedback->user->name }})</div>
                    <div class="text-[11px] text-gray-400">
                        {{ $feedback->created_at->translatedFormat('d F Y, H:i') }} WIB
                    </div>
                </div>
            </div>
            <span class="text-[11px] font-bold text-teal-700 bg-teal-50 px-2 py-0.5 rounded-md border border-teal-100">
                Pesan Awal
            </span>
        </div>
        <div class="text-sm text-gray-800 leading-relaxed whitespace-pre-line bg-gray-50/50 p-4 rounded-xl border border-gray-100">
            {{ $feedback->message }}
        </div>
    </div>

    <!-- Discussion Thread -->
    <div class="space-y-4">
        <h3 class="text-xs font-bold text-gray-500 uppercase tracking-wider flex items-center gap-1.5">
            <span>💬</span>
            <span>Diskusi &amp; Tanggapan ({{ $feedback->replies->count() }} Balasan)</span>
        </h3>

        @forelse($feedback->replies as $reply)
            <div class="bg-white rounded-xl border {{ $reply->is_admin ? 'border-emerald-300 bg-emerald-50/30 ring-1 ring-emerald-200/50' : 'border-gray-100' }} shadow-sm p-5 transition">
                <div class="flex items-center justify-between pb-3 border-b {{ $reply->is_admin ? 'border-emerald-200' : 'border-gray-100' }} mb-3">
                    <div class="flex items-center gap-2.5">
                        <div class="w-8 h-8 rounded-lg {{ $reply->is_admin ? 'bg-emerald-600 text-white shadow-sm' : 'bg-gray-100 text-gray-700' }} flex items-center justify-center font-bold text-xs shrink-0 shadow-2xs">
                            {{ $reply->is_admin ? 'A' : strtoupper(substr($reply->user->name ?? 'P', 0, 1)) }}
                        </div>
                        <div>
                            <div class="flex items-center gap-2">
                                <span class="font-bold text-xs text-gray-900">{{ $reply->is_admin ? 'Admin Bidang Dakwah' : ($reply->user->name ?? 'Peserta') }}</span>
                                @if($reply->is_admin)
                                    <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-emerald-100 text-emerald-800 border border-emerald-300 flex items-center gap-1">
                                        <i class="fas fa-check-circle text-emerald-600"></i>
                                        Tanggapan Resmi Admin
                                    </span>
                                @else
                                    <span class="px-2 py-0.5 rounded-full text-[10px] font-medium bg-gray-100 text-gray-600">
                                        Anda
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <span class="text-[11px] text-gray-400">
                        {{ $reply->created_at->translatedFormat('d M Y, H:i') }} WIB
                    </span>
                </div>
                <div class="text-xs sm:text-sm text-gray-800 leading-relaxed whitespace-pre-line">
                    {{ $reply->message }}
                </div>
            </div>
        @empty
            <div class="bg-white rounded-xl border border-dashed border-gray-200 p-6 text-center">
                <p class="text-xs text-gray-500">Belum ada balasan dari admin. Mohon tunggu tim pengelola meninjau feedback Anda.</p>
            </div>
        @endforelse
    </div>

    <!-- Reply Form or Closed Box -->
    @if($feedback->isOpen())
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <h3 class="text-sm font-bold text-gray-900 mb-3 flex items-center gap-2">
                <svg class="w-4 h-4 text-teal-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6" />
                </svg>
                <span>Tulis Balasan Diskusi</span>
            </h3>
            <form action="{{ route('peserta.feedback.reply', $feedback->id) }}" method="POST" class="space-y-3">
                @csrf
                <div>
                    <textarea id="message" name="message" rows="3" required
                        class="w-full px-3.5 py-2.5 text-sm border border-gray-300 rounded-xl focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition"
                        placeholder="Tulis balasan atau tanggapan lanjutan Anda..."></textarea>
                    @error('message')
                        <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="flex justify-end">
                    <button type="submit"
                        class="inline-flex items-center gap-2 px-5 py-2.5 bg-teal-600 hover:bg-teal-700 text-white font-bold text-xs rounded-xl shadow-sm transition">
                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                        </svg>
                        <span>Kirim Balasan</span>
                    </button>
                </div>
            </form>
        </div>
    @else
        <div class="bg-amber-50/80 border border-amber-200 rounded-xl p-5 flex items-start gap-3.5">
            <div class="text-amber-600 text-xl shrink-0 mt-0.5">
                <i class="fas fa-lock"></i>
            </div>
            <div>
                <h4 class="text-sm font-bold text-amber-900">Diskusi Ini Telah Ditutup oleh Admin</h4>
                <p class="text-xs text-amber-800 mt-0.5 leading-relaxed">
                    Sesi tanya jawab pada tiket ini telah diselesaikan. Jika Anda memiliki pertanyaan atau kendala baru, silakan
                    <a href="{{ route('peserta.feedback.create') }}" class="font-bold underline hover:text-amber-950">buat diskusi baru di sini</a>.
                </p>
            </div>
        </div>
    @endif

</div>
@endsection
