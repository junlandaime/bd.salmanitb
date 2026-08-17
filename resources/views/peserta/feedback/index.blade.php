@extends('layouts.peserta')

@section('title', 'Feedback & Saran - Dashboard Peserta')
@section('header', 'Feedback & Saran')

@section('content')
<div class="max-w-5xl mx-auto space-y-6">

    <!-- Header Card -->
    <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h2 class="text-xl font-bold text-gray-800">Riwayat Feedback &amp; Pertanyaan</h2>
            <p class="text-gray-500 text-sm mt-0.5">Sampaikan pertanyaan, saran, keluhan, atau laporkan kendala ke admin pengelola.</p>
        </div>
        <a href="{{ route('peserta.feedback.create') }}"
            class="inline-flex items-center justify-center gap-2 px-4 py-2.5 bg-teal-600 hover:bg-teal-700 text-white rounded-xl text-xs font-bold shadow-sm transition shrink-0">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            <span>Kirim Feedback Baru</span>
        </a>
    </div>

    <!-- Replied Notification Banner -->
    @php
        $answeredListCount = $feedbacks->where('status', 'answered')->count();
    @endphp
    @if($answeredListCount > 0)
        <div class="p-4 bg-emerald-50 border border-emerald-200 rounded-xl flex items-center justify-between text-emerald-800 text-xs shadow-2xs">
            <div class="flex items-center gap-3">
                <span class="flex h-3 w-3 relative shrink-0">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-3 w-3 bg-emerald-500"></span>
                </span>
                <div>
                    <strong class="font-bold text-emerald-900">Pemberitahuan:</strong> Terdapat <strong>{{ $answeredListCount }} feedback</strong> yang telah dijawab oleh admin. Klik tombol <em>"Buka Diskusi"</em> untuk membaca balasan.
                </div>
            </div>
        </div>
    @endif

    <!-- Feedbacks List Card -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        @if($feedbacks->count() > 0)
            <div class="divide-y divide-gray-100">
                @foreach($feedbacks as $feedback)
                    <div class="p-5 sm:p-6 hover:bg-gray-50/70 transition {{ $feedback->status === 'answered' ? 'bg-emerald-50/20' : '' }}">
                        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                            <div class="space-y-1.5 flex-1 min-w-0">
                                <div class="flex items-center gap-2 flex-wrap">
                                    <span class="px-2.5 py-0.5 text-[11px] font-semibold rounded-full bg-gray-100 text-gray-700 border border-gray-200">
                                        {{ $feedback->category_label }}
                                    </span>
                                    <span class="px-2.5 py-0.5 text-[11px] font-bold rounded-full border {{ $feedback->status_badge }}">
                                        {{ $feedback->status_label }}
                                    </span>
                                    @if($feedback->status === 'answered')
                                        <span class="inline-flex items-center gap-1 px-2.5 py-0.5 text-[11px] font-bold rounded-full bg-emerald-100 text-emerald-800 border border-emerald-300">
                                            <i class="fas fa-check-circle text-emerald-600"></i>
                                            Ada Balasan Admin ✓
                                        </span>
                                    @endif
                                    <span class="text-xs text-gray-400">
                                        {{ $feedback->created_at->translatedFormat('d M Y, H:i') }}
                                    </span>
                                </div>
                                <h3 class="text-sm font-bold text-gray-900 truncate">
                                    <a href="{{ route('peserta.feedback.show', $feedback->id) }}" class="hover:text-teal-700 transition">
                                        {{ $feedback->subject }}
                                    </a>
                                </h3>
                                <p class="text-xs text-gray-500 line-clamp-2 leading-relaxed">
                                    {{ Str::limit($feedback->message, 140) }}
                                </p>
                            </div>
                            <div class="flex items-center gap-3 shrink-0 pt-2 sm:pt-0">
                                <span class="text-xs text-gray-500 font-medium inline-flex items-center gap-1">
                                    <i class="fa-regular fa-comment-dots text-gray-400"></i>
                                    {{ $feedback->replies->count() }} Balasan
                                </span>
                                <a href="{{ route('peserta.feedback.show', $feedback->id) }}"
                                    class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg {{ $feedback->status === 'answered' ? 'bg-emerald-600 text-white hover:bg-emerald-700' : 'bg-teal-50 hover:bg-teal-100 text-teal-800 border border-teal-200' }} text-xs font-bold transition shadow-2xs">
                                    <span>Buka Diskusi</span>
                                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            @if($feedbacks->hasPages())
                <div class="px-6 py-4 border-t border-gray-100 bg-gray-50/50">
                    {{ $feedbacks->links() }}
                </div>
            @endif
        @else
            <div class="p-12 text-center">
                <div class="w-16 h-16 rounded-2xl bg-teal-50 text-teal-600 flex items-center justify-center mx-auto mb-3 text-2xl">
                    💬
                </div>
                <h3 class="text-base font-bold text-gray-900">Belum Ada Feedback</h3>
                <p class="text-xs text-gray-500 mt-1 max-w-sm mx-auto leading-relaxed">
                    Punya pertanyaan seputar program, kendala pendaftaran, atau kritik &amp; saran? Kirimkan feedback langsung kepada kami.
                </p>
                <a href="{{ route('peserta.feedback.create') }}"
                    class="inline-flex items-center gap-2 mt-4 px-4 py-2 bg-teal-600 hover:bg-teal-700 text-white rounded-xl text-xs font-bold shadow-sm transition">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    <span>Kirim Feedback Pertama</span>
                </a>
            </div>
        @endif
    </div>

</div>
@endsection
