@extends('admin.layouts.app')

@section('title', 'Daftar Pendaftar SPN')

@section('content')
<div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
        <div>
            <div class="flex items-center gap-2">
                <a href="{{ route('admin.spn.dashboard') }}" class="text-xs font-semibold text-amber-600 hover:text-amber-700 hover:underline">
                    &larr; Dashboard SPN
                </a>
            </div>
            <h1 class="text-2xl sm:text-3xl font-bold text-gray-900 mt-1">Daftar Pendaftar SPN</h1>
            <p class="text-sm text-gray-500 mt-0.5">Kelola verifikasi berkas dan bukti pembayaran pendaftar Sekolah Pranikah.</p>
        </div>
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.spn.export', request()->only('batch_id')) }}"
                class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-semibold text-sm shadow-sm transition">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
                <span>Export Excel</span>
            </a>
        </div>
    </div>

    @if (session('success'))
        <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 px-4 py-3.5 rounded-2xl mb-6 flex items-center justify-between shadow-sm" role="alert">
            <div class="flex items-center gap-3">
                <span class="w-6 h-6 rounded-full bg-emerald-100 text-emerald-600 flex items-center justify-center shrink-0">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                </span>
                <span class="text-sm font-medium">{{ session('success') }}</span>
            </div>
            <button type="button" onclick="this.parentElement.remove()" class="text-emerald-500 hover:text-emerald-700 p-1">✕</button>
        </div>
    @endif

    @if (session('error'))
        <div class="bg-rose-50 border border-rose-200 text-rose-800 px-4 py-3.5 rounded-2xl mb-6 flex items-center justify-between shadow-sm" role="alert">
            <div class="flex items-center gap-3">
                <span class="w-6 h-6 rounded-full bg-rose-100 text-rose-600 flex items-center justify-center shrink-0">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </span>
                <span class="text-sm font-medium">{{ session('error') }}</span>
            </div>
            <button type="button" onclick="this.parentElement.remove()" class="text-rose-500 hover:text-rose-700 p-1">✕</button>
        </div>
    @endif

    <!-- Filters Card -->
    <div class="bg-white rounded-2xl border border-gray-200/80 p-5 mb-6 shadow-xs">
        <form action="{{ route('admin.spn.registrants') }}" method="GET" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            <div>
                <label class="block text-xs font-semibold text-gray-600 uppercase tracking-wider mb-1.5">Pencarian</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama, email, WA..."
                        class="w-full pl-9 pr-3.5 py-2 bg-gray-50/50 border border-gray-300 rounded-xl text-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-amber-500/20 focus:border-amber-500 transition">
                </div>
            </div>
            <div>
                <label class="block text-xs font-semibold text-gray-600 uppercase tracking-wider mb-1.5">Batch / Kegiatan</label>
                <select name="batch_id" class="w-full px-3 py-2 bg-gray-50/50 border border-gray-300 rounded-xl text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-amber-500/20 focus:border-amber-500 transition">
                    <option value="">Semua Batch</option>
                    @foreach($batches as $b)
                        <option value="{{ $b->id }}" {{ request('batch_id') == $b->id ? 'selected' : '' }}>
                            {{ $b->activity->title ?? 'SPN' }} — {{ $b->nama_batch ?? 'Batch ' . $b->batch_ke }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-xs font-semibold text-gray-600 uppercase tracking-wider mb-1.5">Status Verifikasi</label>
                <select name="status" class="w-full px-3 py-2 bg-gray-50/50 border border-gray-300 rounded-xl text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-amber-500/20 focus:border-amber-500 transition">
                    <option value="">Semua Status</option>
                    <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>⏳ Pending (Menunggu)</option>
                    <option value="terverifikasi" {{ request('status') === 'terverifikasi' ? 'selected' : '' }}>✓ Terverifikasi</option>
                    <option value="ditolak" {{ request('status') === 'ditolak' ? 'selected' : '' }}>✗ Ditolak</option>
                </select>
            </div>
            <div>
                <label class="block text-xs font-semibold text-gray-600 uppercase tracking-wider mb-1.5">Paket</label>
                <select name="paket" class="w-full px-3 py-2 bg-gray-50/50 border border-gray-300 rounded-xl text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-amber-500/20 focus:border-amber-500 transition">
                    <option value="">Semua Paket</option>
                    <option value="early_bird" {{ request('paket') === 'early_bird' ? 'selected' : '' }}>Early Bird</option>
                    <option value="normal_bird" {{ request('paket') === 'normal_bird' ? 'selected' : '' }}>Normal Bird</option>
                </select>
            </div>
            <div class="flex items-end gap-2">
                <button type="submit"
                    class="flex-1 inline-flex items-center justify-center gap-2 px-4 py-2 rounded-xl bg-amber-500 hover:bg-amber-600 text-white font-semibold text-sm shadow-sm transition">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                    </svg>
                    <span>Filter</span>
                </button>
                @if(request()->hasAny(['search', 'status', 'paket', 'batch_id']))
                    <a href="{{ route('admin.spn.registrants') }}"
                        class="px-3.5 py-2 rounded-xl border border-gray-300 text-gray-600 hover:bg-gray-50 font-semibold text-sm transition" title="Reset Filter">
                        ✕
                    </a>
                @endif
            </div>
        </form>
    </div>

    <!-- Table Card -->
    <div class="bg-white rounded-2xl border border-gray-200/80 shadow-xs overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-500">
                <thead class="text-xs text-gray-600 uppercase bg-gray-50/80 border-b border-gray-200/80 tracking-wider">
                    <tr>
                        <th class="px-5 py-3.5 font-semibold">No</th>
                        <th class="px-5 py-3.5 font-semibold">Kode</th>
                        <th class="px-5 py-3.5 font-semibold">Batch</th>
                        <th class="px-5 py-3.5 font-semibold">Nama Peserta</th>
                        <th class="px-5 py-3.5 font-semibold">Kontak</th>
                        <th class="px-5 py-3.5 font-semibold">Paket</th>
                        <th class="px-5 py-3.5 font-semibold">Total Infak</th>
                        <th class="px-5 py-3.5 font-semibold">Status</th>
                        <th class="px-5 py-3.5 font-semibold">Tgl Daftar</th>
                        <th class="px-5 py-3.5 font-semibold text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($registrations as $index => $registration)
                        <tr class="hover:bg-gray-50/75 transition">
                            <td class="px-5 py-4 text-xs text-gray-400 font-medium">
                                {{ $registrations->firstItem() + $index }}
                            </td>
                            <td class="px-5 py-4 font-mono text-xs font-bold text-gray-700">
                                {{ $registration->registration_code }}
                            </td>
                            <td class="px-5 py-4">
                                <div class="text-xs font-semibold text-gray-700">{{ $registration->activityBatch->nama_batch ?? 'Batch ' . ($registration->activityBatch->batch_ke ?? '-') }}</div>
                                <div class="text-[11px] text-gray-400">{{ $registration->activityBatch->activity->title ?? '-' }}</div>
                            </td>
                            <td class="px-5 py-4">
                                <div class="font-bold text-gray-900 leading-snug">{{ $registration->nama_lengkap }}</div>
                                <div class="text-xs text-gray-500 mt-0.5">{{ $registration->domisili ?? '-' }}</div>
                            </td>
                            <td class="px-5 py-4 text-xs">
                                <div class="text-gray-900">{{ $registration->email }}</div>
                                <div class="text-gray-500 font-mono mt-0.5">{{ $registration->whatsapp }}</div>
                            </td>
                            <td class="px-5 py-4">
                                <span class="px-2.5 py-1 text-xs font-semibold rounded-full bg-gray-100 text-gray-700 capitalize">
                                    {{ str_replace('_', ' ', $registration->paket) }}
                                </span>
                            </td>
                            <td class="px-5 py-4 font-bold text-gray-900 text-sm">
                                Rp {{ number_format($registration->total_bayar, 0, ',', '.') }}
                            </td>
                            <td class="px-5 py-4">
                                @if($registration->status === 'terverifikasi')
                                    <span class="inline-flex items-center gap-1 px-2.5 py-1 text-xs font-semibold rounded-full bg-emerald-50 text-emerald-700 border border-emerald-200/60">
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                        Terverifikasi
                                    </span>
                                @elseif($registration->status === 'ditolak')
                                    <span class="inline-flex items-center gap-1 px-2.5 py-1 text-xs font-semibold rounded-full bg-rose-50 text-rose-700 border border-rose-200/60">
                                        <span class="w-1.5 h-1.5 rounded-full bg-rose-500"></span>
                                        Ditolak
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1 px-2.5 py-1 text-xs font-semibold rounded-full bg-amber-50 text-amber-700 border border-amber-200/60">
                                        <span class="w-1.5 h-1.5 rounded-full bg-amber-500 animate-pulse"></span>
                                        Pending
                                    </span>
                                @endif
                            </td>
                            <td class="px-5 py-4 text-xs text-gray-500 whitespace-nowrap">
                                {{ $registration->created_at->format('d M Y') }}
                            </td>
                            <td class="px-5 py-4 text-right whitespace-nowrap">
                                <div class="flex items-center justify-end gap-1.5">
                                    <a href="{{ route('admin.spn.show', $registration->id) }}"
                                        class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg bg-gray-100 hover:bg-amber-50 text-gray-700 hover:text-amber-700 font-semibold text-xs transition" title="Lihat Detail">
                                        <span>Detail</span>
                                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                        </svg>
                                    </a>
                                    @if($registration->status === 'pending')
                                        <form action="{{ route('admin.spn.verify', $registration->id) }}" method="POST" class="inline">
                                            @csrf
                                            <button type="submit" onclick="return confirm('Verifikasi pendaftar {{ $registration->nama_lengkap }}?')"
                                                class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg bg-emerald-50 hover:bg-emerald-100 text-emerald-700 font-semibold text-xs transition border border-emerald-200/60" title="Verifikasi">
                                                <span>✓ Verif</span>
                                            </button>
                                        </form>
                                    @endif
                                    <form action="{{ route('admin.spn.destroy', $registration->id) }}" method="POST" class="inline"
                                        onsubmit="return confirm('Hapus data pendaftaran #{{ $registration->registration_code }} ({{ $registration->nama_lengkap }}) secara permanen?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="inline-flex items-center p-1.5 rounded-lg bg-gray-100 hover:bg-red-50 text-gray-500 hover:text-red-600 transition" title="Hapus Pendaftaran">
                                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="10" class="px-6 py-12 text-center text-gray-400 text-sm">
                                <div class="w-12 h-12 rounded-full bg-gray-100 text-gray-400 flex items-center justify-center mx-auto mb-2 text-xl">
                                    🔍
                                </div>
                                Tidak ada data pendaftar yang cocok dengan kriteria pencarian.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($registrations->hasPages())
            <div class="px-6 py-4 border-t border-gray-100 bg-gray-50/50">
                {{ $registrations->withQueryString()->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
