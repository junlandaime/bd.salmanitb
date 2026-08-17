@extends('layouts.app')

@section('title', 'Pertanyaan Ta\'aruf Saya - Bidang Dakwah Salman ITB')

@section('content')
<div class="min-h-screen bg-gray-50/70 py-8" x-data="{ activeTab: 'received' }">
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
                    <span class="text-white font-semibold">Pertanyaan Masuk &amp; Diajukan</span>
                </nav>

                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                    <div>
                        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-rose-500/20 border border-rose-400/30 text-rose-300 text-xs font-semibold mb-2">
                            <span>💬</span>
                            <span>Q&amp;A Ta'aruf</span>
                        </div>
                        <h1 class="text-2xl sm:text-3xl font-bold tracking-tight text-white">
                            Pertanyaan Ta'aruf Saya
                        </h1>
                        <p class="text-xs sm:text-sm text-slate-300 mt-1">
                            Kelola pertanyaan anonim yang masuk ke profil Anda atau pantau pertanyaan yang telah Anda ajukan.
                        </p>
                    </div>

                    <a href="{{ route('taaruf.index') }}"
                        class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-white/10 hover:bg-white/20 backdrop-blur text-white text-xs font-semibold border border-white/15 transition shadow-xs self-start md:self-auto">
                        &larr; Dashboard Ta'aruf
                    </a>
                </div>
            </div>
        </div>

        @if (session('success'))
            <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 p-4 rounded-2xl shadow-sm flex items-center justify-between" role="alert">
                <span class="text-sm font-medium">{{ session('success') }}</span>
                <button type="button" onclick="this.parentElement.remove()" class="text-emerald-500 hover:text-emerald-700">✕</button>
            </div>
        @endif

        @if (session('error'))
            <div class="bg-red-50 border border-red-200 text-red-800 p-4 rounded-2xl shadow-sm flex items-center justify-between" role="alert">
                <span class="text-sm font-medium">{{ session('error') }}</span>
                <button type="button" onclick="this.parentElement.remove()" class="text-red-500 hover:text-red-700">✕</button>
            </div>
        @endif

        <!-- Tab Controls -->
        <div class="flex items-center gap-2 border-b border-gray-200 pb-2">
            <button @click="activeTab = 'received'"
                :class="activeTab === 'received' ? 'bg-rose-600 text-white font-bold shadow-sm' : 'bg-white text-gray-600 hover:bg-gray-100 border border-gray-200'"
                class="px-4 py-2 rounded-xl text-xs transition flex items-center gap-2">
                <span>📥 Pertanyaan Diterima</span>
                <span class="px-2 py-0.5 rounded-full text-[10px] {{ count($questions ?? []) > 0 ? 'bg-white/20 text-white font-bold' : 'bg-gray-100 text-gray-500' }}">
                    {{ count($questions ?? []) }}
                </span>
            </button>
            <button @click="activeTab = 'sent'"
                :class="activeTab === 'sent' ? 'bg-rose-600 text-white font-bold shadow-sm' : 'bg-white text-gray-600 hover:bg-gray-100 border border-gray-200'"
                class="px-4 py-2 rounded-xl text-xs transition flex items-center gap-2">
                <span>📤 Pertanyaan Yang Saya Ajukan</span>
                <span class="px-2 py-0.5 rounded-full text-[10px] {{ count($myQuestions ?? []) > 0 ? 'bg-white/20 text-white font-bold' : 'bg-gray-100 text-gray-500' }}">
                    {{ count($myQuestions ?? []) }}
                </span>
            </button>
        </div>

        <!-- Main Card Container -->
        <div class="bg-white rounded-2xl border border-gray-200/80 shadow-sm p-6 sm:p-7">
            
            <!-- Tab 1: Received Questions -->
            <div x-show="activeTab === 'received'" class="space-y-4">
                <div class="flex items-center justify-between pb-4 border-b border-gray-100">
                    <div>
                        <h2 class="text-base font-bold text-gray-900">Pertanyaan Diterima</h2>
                        <p class="text-xs text-gray-500">Pertanyaan yang diajukan oleh alumni lain pada profil Anda.</p>
                    </div>
                </div>

                @if (empty($questions) || count($questions) === 0)
                    <div class="text-center py-14 bg-gray-50/60 rounded-2xl border border-dashed border-gray-200">
                        <div class="w-12 h-12 rounded-2xl bg-gray-100 text-gray-400 flex items-center justify-center text-xl mx-auto mb-2">
                            📭
                        </div>
                        <h3 class="text-sm font-bold text-gray-900">Belum Ada Pertanyaan Masuk</h3>
                        <p class="text-xs text-gray-500 mt-1">Pertanyaan yang dikirimkan peserta lain akan tampil di sini.</p>
                    </div>
                @else
                    <div class="space-y-4">
                        @foreach ($questions as $question)
                            <div class="bg-gray-50/70 border border-gray-200/80 rounded-2xl p-5 space-y-3">
                                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2">
                                    <div class="flex items-center gap-2 text-xs">
                                        <span class="text-gray-400">{{ $question->created_at->format('d M Y, H:i') }}</span>
                                        @if ($question->is_answered)
                                            <span class="px-2.5 py-0.5 rounded-full bg-emerald-50 text-emerald-700 border border-emerald-200 font-semibold text-[10px]">
                                                Sudah Dijawab
                                            </span>
                                            <span class="px-2.5 py-0.5 rounded-full {{ $question->is_public ? 'bg-blue-50 text-blue-700 border border-blue-200' : 'bg-gray-100 text-gray-600 border border-gray-200' }} font-semibold text-[10px]">
                                                {{ $question->is_public ? 'Tampil di Profil (Publik)' : 'Privat' }}
                                            </span>
                                        @else
                                            <span class="px-2.5 py-0.5 rounded-full bg-amber-50 text-amber-700 border border-amber-200 font-semibold text-[10px]">
                                                Menunggu Jawaban
                                            </span>
                                        @endif
                                    </div>

                                    <div class="flex items-center gap-2">
                                        @if ($question->is_answered)
                                            <form action="{{ route('taaruf.questions.toggle-public', $question->id) }}" method="POST">
                                                @csrf
                                                <button type="submit"
                                                    class="px-2.5 py-1 rounded-lg border border-gray-300 bg-white hover:bg-gray-50 text-gray-700 text-[11px] font-semibold transition">
                                                    {{ $question->is_public ? 'Jadikan Privat' : 'Jadikan Publik' }}
                                                </button>
                                            </form>
                                        @endif
                                        <form action="{{ route('taaruf.questions.destroy', $question->id) }}" method="POST"
                                            onsubmit="return confirm('Hapus pertanyaan ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="px-2.5 py-1 rounded-lg border border-red-200 bg-red-50 hover:bg-red-100 text-red-600 text-[11px] font-semibold transition">
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </div>

                                <div class="text-xs font-bold text-gray-900 bg-white p-3.5 rounded-xl border border-gray-200 flex items-start gap-2">
                                    <span class="text-rose-600 font-bold shrink-0">Q:</span>
                                    <span class="whitespace-pre-line leading-relaxed font-semibold text-gray-800">{{ $question->question }}</span>
                                </div>

                                @if ($question->is_answered)
                                    <div class="text-xs text-gray-700 bg-emerald-50/50 p-3.5 rounded-xl border border-emerald-200 flex items-start gap-2">
                                        <span class="text-emerald-700 font-bold shrink-0">Jawaban Anda:</span>
                                        <span class="leading-relaxed whitespace-pre-line text-emerald-900">{{ $question->answer }}</span>
                                    </div>
                                @endif

                                <!-- Answer Form -->
                                <form action="{{ route('taaruf.questions.answer', $question->id) }}" method="POST" class="pt-2">
                                    @csrf
                                    <div class="flex flex-col sm:flex-row gap-2">
                                        <textarea name="answer" rows="2" required placeholder="{{ $question->is_answered ? 'Ubah jawaban Anda...' : 'Tuliskan jawaban santun Anda...' }}"
                                            class="flex-1 px-3.5 py-2 text-xs rounded-xl border border-gray-300 focus:ring-2 focus:ring-rose-500 focus:border-rose-500 transition">{{ $question->answer }}</textarea>
                                        <button type="submit"
                                            class="px-4 py-2 rounded-xl bg-rose-600 hover:bg-rose-700 text-white font-semibold text-xs shadow-xs transition self-end sm:self-auto shrink-0">
                                            {{ $question->is_answered ? 'Simpan Perubahan' : 'Kirim Jawaban' }}
                                        </button>
                                    </div>
                                </form>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            <!-- Tab 2: Sent Questions -->
            <div x-show="activeTab === 'sent'" class="space-y-4">
                <div class="flex items-center justify-between pb-4 border-b border-gray-100">
                    <div>
                        <h2 class="text-base font-bold text-gray-900">Pertanyaan Yang Saya Ajukan</h2>
                        <p class="text-xs text-gray-500">Daftar pertanyaan yang telah Anda kirimkan ke profil alumni lain.</p>
                    </div>
                </div>

                @if (empty($myQuestions) || count($myQuestions) === 0)
                    <div class="text-center py-14 bg-gray-50/60 rounded-2xl border border-dashed border-gray-200">
                        <div class="w-12 h-12 rounded-2xl bg-gray-100 text-gray-400 flex items-center justify-center text-xl mx-auto mb-2">
                            ✉️
                        </div>
                        <h3 class="text-sm font-bold text-gray-900">Belum Ada Pertanyaan Diajukan</h3>
                        <p class="text-xs text-gray-500 mt-1">Jelajahi profil alumni di Daftar Ta'aruf untuk mengajukan pertanyaan.</p>
                    </div>
                @else
                    <div class="space-y-4">
                        @foreach ($myQuestions as $q)
                            <div class="bg-gray-50/70 border border-gray-200/80 rounded-2xl p-5 space-y-3">
                                <div class="flex items-center justify-between text-xs">
                                    <div class="flex items-center gap-2">
                                        <span class="font-bold text-gray-800">Ditujukan ke: {{ $q->profile->full_name ?? 'Peserta' }}</span>
                                        <span class="text-gray-400">&bull; {{ $q->created_at->format('d M Y') }}</span>
                                    </div>
                                    <span class="px-2.5 py-0.5 rounded-full {{ $q->is_answered ? 'bg-emerald-50 text-emerald-700 border border-emerald-200' : 'bg-amber-50 text-amber-700 border border-amber-200' }} text-[10px] font-bold">
                                        {{ $q->is_answered ? 'Sudah Dijawab' : 'Menunggu Jawaban' }}
                                    </span>
                                </div>

                                <div class="text-xs text-gray-800 bg-white p-3.5 rounded-xl border border-gray-200 flex items-start gap-2">
                                    <span class="font-bold text-rose-600 shrink-0">Pertanyaan:</span>
                                    <span class="whitespace-pre-line leading-relaxed font-semibold text-gray-800">{{ $q->question }}</span>
                                </div>

                                @if ($q->is_answered)
                                    <div class="text-xs text-emerald-900 bg-emerald-50 p-3.5 rounded-xl border border-emerald-200 flex items-start gap-2">
                                        <span class="font-bold text-emerald-800 shrink-0">Jawaban:</span>
                                        <span class="whitespace-pre-line leading-relaxed text-emerald-900">{{ $q->answer }}</span>
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

        </div>

    </div>
</div>
@endsection
