@extends('admin.layouts.app')
@section('title', 'Detail Feedback - Admin Panel')

@section('content')
<div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
    
    <!-- Top Breadcrumb / Back Navigation -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.feedback.index') }}"
                class="inline-flex items-center justify-center w-9 h-9 rounded-xl bg-white border border-gray-200 text-gray-600 hover:text-emerald-700 hover:bg-emerald-50 shadow-2xs transition">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
            </a>
            <div>
                <div class="flex items-center gap-2">
                    <span class="text-xs font-semibold text-gray-500">Tiket Feedback #{{ $feedback->id }}</span>
                    <span class="px-2.5 py-0.5 rounded-full text-xs font-bold border {{ $feedback->status_badge }}">
                        {{ $feedback->status_label }}
                    </span>
                    <span class="px-2.5 py-0.5 rounded-full text-xs font-semibold bg-gray-100 text-gray-700 border border-gray-200">
                        {{ $feedback->category_label }}
                    </span>
                </div>
                <h1 class="text-xl font-bold text-gray-900 mt-1">
                    {{ $feedback->subject }}
                </h1>
            </div>
        </div>

        <div class="flex items-center gap-2 self-start sm:self-auto">
            @if($feedback->isOpen())
                <form action="{{ route('admin.feedback.close', $feedback->id) }}" method="POST" onsubmit="return confirm('Tutup diskusi feedback ini? User tidak akan bisa membalas lagi sampai dibuka kembali.');">
                    @csrf
                    <button type="submit"
                        class="inline-flex items-center gap-1.5 px-3.5 py-2 rounded-xl bg-white border border-gray-300 hover:bg-gray-50 text-gray-700 font-semibold text-xs transition shadow-2xs">
                        <svg class="w-4 h-4 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                        <span>Tutup Diskusi</span>
                    </button>
                </form>
            @else
                <form action="{{ route('admin.feedback.reopen', $feedback->id) }}" method="POST">
                    @csrf
                    <button type="submit"
                        class="inline-flex items-center gap-1.5 px-3.5 py-2 rounded-xl bg-emerald-50 border border-emerald-300 hover:bg-emerald-100 text-emerald-800 font-semibold text-xs transition shadow-2xs">
                        <svg class="w-4 h-4 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 11V7a4 4 0 118 0m-4 8v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2z" />
                        </svg>
                        <span>Buka Kembali Diskusi</span>
                    </button>
                </form>
            @endif
        </div>
    </div>

    <!-- Main Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        <!-- Left: Discussion Thread (2 Columns) -->
        <div class="lg:col-span-2 space-y-6">
            
            <!-- Original Feedback Message -->
            <div class="bg-white rounded-2xl border border-gray-200/80 shadow-sm p-6">
                <div class="flex items-center justify-between pb-4 border-b border-gray-100 mb-4">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-emerald-100 text-emerald-800 flex items-center justify-center font-bold text-sm shrink-0">
                            {{ strtoupper(substr($feedback->user->name ?? 'U', 0, 1)) }}
                        </div>
                        <div>
                            <div class="font-bold text-gray-900 text-sm">
                                {{ $feedback->user->name ?? 'User Terhapus' }}
                            </div>
                            <div class="text-xs text-gray-400">
                                Mengirim pesan pada {{ $feedback->created_at->translatedFormat('d F Y, H:i') }} WIB
                            </div>
                        </div>
                    </div>
                    <span class="text-[11px] font-bold text-emerald-700 bg-emerald-50 px-2.5 py-1 rounded-full border border-emerald-100">
                        Pesan Awal
                    </span>
                </div>

                <div class="text-sm text-gray-800 leading-relaxed whitespace-pre-line bg-gray-50/50 p-4 rounded-xl border border-gray-100">
                    {{ $feedback->message }}
                </div>
            </div>

            <!-- Replies / Discussion Thread -->
            <div class="space-y-4">
                <div class="flex items-center justify-between">
                    <h3 class="text-sm font-bold text-gray-900 uppercase tracking-wider flex items-center gap-2">
                        <span>💬</span>
                        <span>Riwayat Diskusi ({{ $feedback->replies->count() }} Balasan)</span>
                    </h3>
                </div>

                @forelse($feedback->replies as $reply)
                    <div class="bg-white rounded-2xl border {{ $reply->is_admin ? 'border-emerald-200/90 bg-emerald-50/20' : 'border-gray-200/80' }} shadow-sm p-5 transition">
                        <div class="flex items-center justify-between pb-3 border-b {{ $reply->is_admin ? 'border-emerald-100' : 'border-gray-100' }} mb-3">
                            <div class="flex items-center gap-2.5">
                                <div class="w-8 h-8 rounded-lg {{ $reply->is_admin ? 'bg-emerald-600 text-white' : 'bg-gray-100 text-gray-700' }} flex items-center justify-center font-bold text-xs shrink-0 shadow-2xs">
                                    {{ $reply->is_admin ? 'A' : strtoupper(substr($reply->user->name ?? 'U', 0, 1)) }}
                                </div>
                                <div>
                                    <div class="flex items-center gap-2">
                                        <span class="font-bold text-xs text-gray-900">{{ $reply->user->name ?? 'User Terhapus' }}</span>
                                        @if($reply->is_admin)
                                            <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-emerald-100 text-emerald-800 border border-emerald-200">
                                                Admin Official
                                            </span>
                                        @else
                                            <span class="px-2 py-0.5 rounded-full text-[10px] font-medium bg-gray-100 text-gray-600">
                                                Pengirim
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
                    <div class="bg-white rounded-2xl border border-dashed border-gray-200 p-8 text-center">
                        <p class="text-xs text-gray-500">Belum ada balasan dalam diskusi ini. Gunakan form di bawah untuk mengirim tanggapan admin.</p>
                    </div>
                @endforelse
            </div>

            <!-- Reply Form or Closed Notice -->
            @if($feedback->isOpen())
                <div class="bg-white rounded-2xl border border-gray-200/80 shadow-sm p-6">
                    <h3 class="text-sm font-bold text-gray-900 mb-3 flex items-center gap-2">
                        <svg class="w-4 h-4 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6" />
                        </svg>
                        <span>Kirim Balasan Sebagai Admin</span>
                    </h3>
                    <form action="{{ route('admin.feedback.reply', $feedback->id) }}" method="POST" class="space-y-4">
                        @csrf
                        <div>
                            <textarea id="message" name="message" rows="4" required
                                class="w-full px-3.5 py-2.5 text-sm border border-gray-300 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition"
                                placeholder="Tuliskan jawaban atau tanggapan resmi dari pengelola..."></textarea>
                            @error('message')
                                <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="flex items-center justify-between">
                            <p class="text-[11px] text-gray-400">
                                * Balasan akan otomatis mengubah status feedback menjadi <strong class="text-emerald-700">Dijawab (Answered)</strong>.
                            </p>
                            <button type="submit"
                                class="inline-flex items-center gap-2 px-5 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs rounded-xl shadow-sm transition">
                                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                                </svg>
                                <span>Kirim Balasan</span>
                            </button>
                        </div>
                    </form>
                </div>
            @else
                <div class="bg-gray-100 rounded-2xl border border-gray-200 p-6 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-gray-200 text-gray-600 flex items-center justify-center shrink-0">
                            🔒
                        </div>
                        <div>
                            <h4 class="text-sm font-bold text-gray-900">Diskusi Ditutup</h4>
                            <p class="text-xs text-gray-500 mt-0.5">
                                Ditutup oleh <strong>{{ $feedback->closedBy->name ?? 'Admin' }}</strong> pada {{ $feedback->closed_at ? $feedback->closed_at->translatedFormat('d M Y, H:i') : $feedback->updated_at->translatedFormat('d M Y, H:i') }}.
                            </p>
                        </div>
                    </div>
                    <form action="{{ route('admin.feedback.reopen', $feedback->id) }}" method="POST">
                        @csrf
                        <button type="submit"
                            class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs shadow-sm transition">
                            <span>Buka Kembali</span>
                        </button>
                    </form>
                </div>
            @endif

        </div>

        <!-- Right: Sender Info & Actions (1 Column) -->
        <div class="space-y-6">
            
            <!-- Sender Profile Card -->
            <div class="bg-white rounded-2xl border border-gray-200/80 shadow-sm p-6">
                <h3 class="text-sm font-bold text-gray-900 pb-3 border-b border-gray-100 mb-4 flex items-center gap-2">
                    <svg class="w-4 h-4 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                    <span>Informasi Pengirim</span>
                </h3>

                @if($feedback->user)
                    <div class="flex items-center gap-3.5 mb-5">
                        <div class="w-12 h-12 rounded-2xl bg-emerald-100 text-emerald-800 flex items-center justify-center font-bold text-base shrink-0 shadow-2xs">
                            {{ strtoupper(substr($feedback->user->name, 0, 1)) }}
                        </div>
                        <div class="min-w-0">
                            <h4 class="font-bold text-gray-900 text-sm truncate">{{ $feedback->user->name }}</h4>
                            <p class="text-xs text-gray-500 truncate">{{ $feedback->user->email }}</p>
                        </div>
                    </div>

                    <div class="space-y-3 text-xs">
                        <div class="flex items-center justify-between py-1 border-b border-gray-100 text-gray-600">
                            <span>Role Akun:</span>
                            <div>
                                @forelse($feedback->user->roles as $role)
                                    <span class="px-2 py-0.5 font-bold rounded-md bg-emerald-50 text-emerald-800 border border-emerald-100 text-[10px]">
                                        {{ ucfirst($role->name) }}
                                    </span>
                                @empty
                                    <span class="px-2 py-0.5 font-semibold rounded-md bg-gray-100 text-gray-700 text-[10px]">
                                        Peserta Umum
                                    </span>
                                @endforelse
                            </div>
                        </div>

                        <div class="flex items-center justify-between py-1 border-b border-gray-100 text-gray-600">
                            <span>Tanggal Daftar:</span>
                            <span class="font-medium text-gray-900">{{ $feedback->user->created_at ? $feedback->user->created_at->translatedFormat('d M Y') : '-' }}</span>
                        </div>

                        <div class="flex items-center justify-between py-1 text-gray-600">
                            <span>Total Feedback:</span>
                            <span class="font-bold text-emerald-700 bg-emerald-50 px-2 py-0.5 rounded-md">
                                {{ \App\Models\Feedback::where('user_id', $feedback->user_id)->count() }} Tiket
                            </span>
                        </div>
                    </div>
                @else
                    <div class="text-xs text-red-600 italic bg-red-50 p-3 rounded-xl">
                        Akun pengguna ini telah dihapus dari sistem.
                    </div>
                @endif
            </div>

            <!-- Danger Zone: Soft Delete -->
            <div class="bg-white rounded-2xl border border-red-200 shadow-sm p-6">
                <h3 class="text-sm font-bold text-red-600 pb-3 border-b border-red-100 mb-3 flex items-center gap-2">
                    <svg class="w-4 h-4 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                    </svg>
                    <span>Zona Penghapusan</span>
                </h3>
                <p class="text-xs text-gray-500 mb-4 leading-relaxed">
                    Hapus feedback jika mengandung konten yang melanggar aturan. Feedback akan disembunyikan (soft delete).
                </p>
                <form action="{{ route('admin.feedback.destroy', $feedback->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus feedback ini?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="w-full inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl bg-red-50 hover:bg-red-100 text-red-700 font-bold text-xs border border-red-200 transition">
                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                        <span>Hapus Feedback Ini</span>
                    </button>
                </form>
            </div>

        </div>

    </div>
</div>
@endsection
