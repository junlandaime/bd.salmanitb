@extends('admin.layouts.app')

@section('title', 'Detail Pertanyaan Ta\'aruf - Admin Panel')

@section('content')
<div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
    
    <!-- Breadcrumb & Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
        <div>
            <div class="flex items-center gap-2 text-xs text-gray-500 mb-1">
                <a href="{{ route('admin.taaruf.index') }}" class="hover:text-pink-600">Layanan Ta'aruf</a>
                <span>/</span>
                <a href="{{ route('admin.taaruf.questions.index') }}" class="hover:text-pink-600">Pertanyaan</a>
                <span>/</span>
                <span>Detail</span>
            </div>
            <h1 class="text-2xl font-bold text-gray-900">Detail Pertanyaan Ta'aruf</h1>
            <p class="text-sm text-gray-500 mt-0.5">Informasi lengkap terkait pertanyaan dan jawaban antar peserta.</p>
        </div>
        <div class="flex items-center gap-2">
            <a href="{{ route('admin.taaruf.questions.index') }}"
                class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl border border-gray-300 bg-white text-gray-700 font-semibold text-sm hover:bg-gray-50 shadow-sm transition">
                &larr; Kembali ke Daftar
            </a>
        </div>
    </div>

    <!-- Main Content Card -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        
        <!-- Left: Metadata -->
        <div class="space-y-6">
            <!-- Asker & Target Profile Card -->
            <div class="bg-white rounded-2xl border border-gray-200/80 shadow-sm p-6 space-y-5">
                <h3 class="text-xs font-bold text-gray-400 uppercase tracking-wider">Peserta Terlibat</h3>
                
                <!-- Target Profile -->
                <div>
                    <span class="block text-xs text-gray-500 font-medium">Profil yang Ditanya:</span>
                    @if ($question->profile)
                        <a href="{{ route('admin.taaruf.show', $question->profile_id) }}" class="mt-1 inline-flex items-center gap-2 font-bold text-pink-600 hover:text-pink-700 text-sm">
                            <span>👤</span>
                            <span>{{ $question->profile->full_name }}</span>
                        </a>
                    @else
                        <span class="text-sm text-gray-400">-</span>
                    @endif
                </div>

                <!-- Asker -->
                <div class="pt-4 border-t border-gray-100">
                    <span class="block text-xs text-gray-500 font-medium">Penanya:</span>
                    <div class="mt-1 flex items-center gap-2">
                        @if ($question->askedBy && $question->askedBy->taarufProfile)
                            <a href="{{ route('admin.taaruf.show', $question->askedBy->taarufProfile->id) }}" class="font-bold text-gray-900 hover:text-pink-600 text-sm">
                                {{ $question->askedBy->taarufProfile->full_name }}
                            </a>
                        @elseif($question->askedBy)
                            <span class="font-bold text-gray-900 text-sm">{{ $question->askedBy->name }}</span>
                        @else
                            <span class="text-sm text-gray-400">Tidak diketahui</span>
                        @endif

                        @if ($question->is_anonymous)
                            <span class="px-2 py-0.5 rounded-full text-[10px] font-semibold bg-gray-100 text-gray-600">
                                Anonim
                            </span>
                        @endif
                    </div>
                    @if($question->askedBy && $question->askedBy->email)
                        <p class="text-xs text-gray-400 mt-0.5">{{ $question->askedBy->email }}</p>
                    @endif
                </div>
            </div>

            <!-- Status Card -->
            <div class="bg-white rounded-2xl border border-gray-200/80 shadow-sm p-6 space-y-4">
                <h3 class="text-xs font-bold text-gray-400 uppercase tracking-wider">Status &amp; Waktu</h3>
                
                <div>
                    <span class="block text-xs text-gray-500 font-medium">Status Jawaban:</span>
                    <div class="mt-1">
                        @if ($question->is_answered)
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-800">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-600"></span>
                                <span>Sudah Dijawab</span>
                            </span>
                        @else
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-amber-100 text-amber-800">
                                <span class="w-1.5 h-1.5 rounded-full bg-amber-600 animate-pulse"></span>
                                <span>Belum Dijawab</span>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="pt-3 border-t border-gray-100">
                    <span class="block text-xs text-gray-500 font-medium">Tanggal Dibuat:</span>
                    <p class="text-xs font-semibold text-gray-800 mt-0.5">{{ $question->created_at->format('d F Y, H:i') }} WIB</p>
                </div>

                @if ($question->is_answered && $question->answered_at)
                    <div class="pt-3 border-t border-gray-100">
                        <span class="block text-xs text-gray-500 font-medium">Tanggal Dijawab:</span>
                        <p class="text-xs font-semibold text-gray-800 mt-0.5">{{ $question->answered_at->format('d F Y, H:i') }} WIB</p>
                    </div>
                @endif
            </div>

            <!-- Danger Zone: Delete -->
            <div class="bg-red-50/50 rounded-2xl border border-red-200 p-6 space-y-3">
                <h3 class="text-xs font-bold text-red-700 uppercase tracking-wider">Tindakan Administrator</h3>
                <p class="text-xs text-red-600 leading-relaxed">Hapus pertanyaan ini jika mengandung konten yang melanggar aturan ta'aruf.</p>
                <form action="{{ route('admin.taaruf.questions.destroy', $question->id) }}" method="POST"
                    onsubmit="return confirm('Apakah Anda yakin ingin menghapus pertanyaan ini secara permanen?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="w-full py-2.5 px-4 rounded-xl bg-red-600 hover:bg-red-700 text-white font-semibold text-xs transition shadow-sm flex items-center justify-center gap-2">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                        <span>Hapus Pertanyaan</span>
                    </button>
                </form>
            </div>
        </div>

        <!-- Right: Question & Answer Content -->
        <div class="lg:col-span-2 space-y-6">
            
            <!-- Pertanyaan Card -->
            <div class="bg-white rounded-2xl border border-gray-200/80 shadow-sm p-6 sm:p-8 space-y-4">
                <div class="flex items-center gap-2 text-xs font-bold text-pink-600 uppercase tracking-wider">
                    <span>💬</span>
                    <span>Isi Pertanyaan</span>
                </div>
                <div class="p-5 rounded-xl bg-gray-50 border border-gray-100 text-sm text-gray-800 leading-relaxed whitespace-pre-line">
                    {{ $question->question }}
                </div>
            </div>

            <!-- Jawaban Card -->
            <div class="bg-white rounded-2xl border border-gray-200/80 shadow-sm p-6 sm:p-8 space-y-4">
                <div class="flex items-center gap-2 text-xs font-bold text-emerald-700 uppercase tracking-wider">
                    <span>✍️</span>
                    <span>Jawaban dari Peserta</span>
                </div>
                @if ($question->is_answered && !empty($question->answer))
                    <div class="p-5 rounded-xl bg-emerald-50/60 border border-emerald-100 text-sm text-gray-900 leading-relaxed whitespace-pre-line">
                        {{ $question->answer }}
                    </div>
                @else
                    <div class="p-8 text-center rounded-xl bg-gray-50 border border-dashed border-gray-200 text-gray-400 text-sm">
                        Pertanyaan ini belum dijawab oleh profil yang bersangkutan.
                    </div>
                @endif
            </div>

        </div>

    </div>

</div>
@endsection
