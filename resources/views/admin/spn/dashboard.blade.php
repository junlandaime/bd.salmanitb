@extends('admin.layouts.app')

@section('title', 'Dashboard SPN')

@section('content')
<div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Header Hero -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
        <div>
            <div class="flex items-center gap-2">
                <span class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-amber-100 text-amber-600 text-sm">
                    💛
                </span>
                <h1 class="text-2xl sm:text-3xl font-bold text-gray-900">Dashboard SPN</h1>
            </div>
            <p class="text-sm text-gray-500 mt-1">Overview & monitoring pendaftaran Sekolah Pranikah Salman ITB.</p>
        </div>
        <div class="flex flex-wrap items-center gap-3">
            <a href="{{ route('admin.spn.registrants') }}"
                class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-amber-500 hover:bg-amber-600 text-white font-semibold text-sm shadow-sm transition">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
                <span>Lihat Semua Pendaftar</span>
            </a>
            <a href="{{ route('admin.spn.export', ['batch_id' => $selectedBatchId]) }}"
                class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-semibold text-sm shadow-sm transition">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
                <span>Export Excel</span>
            </a>
        </div>
    </div>

    <!-- Batch Selector -->
    <div class="bg-white rounded-2xl border border-gray-200/80 p-4 mb-6 shadow-xs flex flex-col sm:flex-row sm:items-center gap-3">
        <div class="flex items-center gap-2 text-sm font-semibold text-gray-700 whitespace-nowrap">
            <span>📦</span>
            <span>Batch Aktif:</span>
        </div>
        <form action="{{ route('admin.spn.dashboard') }}" method="GET" class="flex-1">
            <select name="batch_id" onchange="this.form.submit()"
                class="w-full px-3 py-2 bg-gray-50/50 border border-gray-300 rounded-xl text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-amber-500/20 focus:border-amber-500 transition">
                @foreach($batches as $b)
                    <option value="{{ $b->id }}" {{ ($selectedBatchId == $b->id) ? 'selected' : '' }}>
                        {{ $b->activity->title ?? 'SPN' }} — {{ $b->nama_batch ?? 'Batch ' . $b->batch_ke }}
                        @if($b->status === 'aktif') ● Aktif @endif
                    </option>
                @endforeach
                @if($batches->isEmpty())
                    <option value="">Belum ada batch SPN</option>
                @endif
            </select>
        </form>
    </div>

    <!-- Quick Navigation Pills -->
    <div class="flex flex-wrap items-center gap-2 mb-8 p-1.5 bg-gray-100/80 rounded-2xl w-fit border border-gray-200/60">
        <a href="{{ route('admin.spn.dashboard') }}"
            class="px-4 py-2 rounded-xl text-xs sm:text-sm font-semibold bg-white text-gray-900 shadow-xs border border-gray-200/60">
            📊 Overview
        </a>
        <a href="{{ route('admin.spn.registrants') }}"
            class="px-4 py-2 rounded-xl text-xs sm:text-sm font-semibold text-gray-600 hover:text-gray-900 hover:bg-white/60 transition">
            👥 Data Pendaftar
        </a>
        <a href="{{ route('admin.spn.referral.index') }}"
            class="px-4 py-2 rounded-xl text-xs sm:text-sm font-semibold text-gray-600 hover:text-gray-900 hover:bg-white/60 transition">
            🎟️ Kode Referral
        </a>
        <a href="{{ route('admin.spn.pricing.index') }}"
            class="px-4 py-2 rounded-xl text-xs sm:text-sm font-semibold text-gray-600 hover:text-gray-900 hover:bg-white/60 transition">
            🏷️ Harga & Diskon
        </a>
    </div>

    <!-- KPI Summary Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 mb-8">
        <!-- Total Pendaftar -->
        <div class="bg-white rounded-2xl border border-gray-200/80 p-5 shadow-xs hover:shadow-md transition">
            <div class="flex items-center justify-between">
                <span class="text-xs font-bold text-gray-400 uppercase tracking-wider">Total Pendaftar</span>
                <span class="w-10 h-10 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center text-lg font-semibold">
                    👥
                </span>
            </div>
            <div class="mt-4">
                <div class="text-3xl font-extrabold text-gray-900">{{ number_format($stats['total']) }}</div>
                <div class="text-xs text-gray-500 font-medium mt-1">Seluruh berkas terinput</div>
            </div>
        </div>

        <!-- Terverifikasi -->
        <div class="bg-white rounded-2xl border border-gray-200/80 p-5 shadow-xs hover:shadow-md transition">
            <div class="flex items-center justify-between">
                <span class="text-xs font-bold text-emerald-600 uppercase tracking-wider">Terverifikasi</span>
                <span class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center text-lg font-semibold">
                    ✓
                </span>
            </div>
            <div class="mt-4">
                <div class="text-3xl font-extrabold text-emerald-600">{{ number_format($stats['verified']) }}</div>
                <div class="text-xs text-emerald-700 font-medium mt-1">Pembayaran valid & sah</div>
            </div>
        </div>

        <!-- Pending -->
        <div class="bg-white rounded-2xl border border-gray-200/80 p-5 shadow-xs hover:shadow-md transition">
            <div class="flex items-center justify-between">
                <span class="text-xs font-bold text-amber-600 uppercase tracking-wider">Menunggu Verifikasi</span>
                <span class="w-10 h-10 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center text-lg font-semibold">
                    ⏳
                </span>
            </div>
            <div class="mt-4">
                <div class="text-3xl font-extrabold text-amber-600">{{ number_format($stats['pending']) }}</div>
                <div class="text-xs text-amber-700 font-medium mt-1">Perlu dicek admin</div>
            </div>
        </div>

        <!-- Total Infak -->
        <div class="bg-white rounded-2xl border border-gray-200/80 p-5 shadow-xs hover:shadow-md transition">
            <div class="flex items-center justify-between">
                <span class="text-xs font-bold text-gray-400 uppercase tracking-wider">Total Infak Masuk</span>
                <span class="w-10 h-10 rounded-xl bg-purple-50 text-purple-600 flex items-center justify-center text-lg font-semibold">
                    💰
                </span>
            </div>
            <div class="mt-4">
                <div class="text-2xl sm:text-3xl font-extrabold text-gray-900 tracking-tight">
                    Rp {{ number_format($stats['total_infak'], 0, ',', '.') }}
                </div>
                <div class="text-xs text-gray-500 font-medium mt-1">Dari peserta terverifikasi</div>
            </div>
        </div>
    </div>

    <!-- Breakdown Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
        <!-- Package Breakdown -->
        <div class="bg-white rounded-2xl border border-gray-200/80 p-6 shadow-xs">
            <div class="flex items-center justify-between mb-5">
                <div class="flex items-center gap-2">
                    <span class="w-8 h-8 rounded-lg bg-amber-50 text-amber-600 flex items-center justify-center text-sm">📦</span>
                    <h3 class="text-base font-bold text-gray-900">Distribusi Paket Pendaftaran</h3>
                </div>
                <span class="text-xs text-gray-400 font-medium">Batch Aktif</span>
            </div>

            @php
                $earlyCount = $stats['packages']['early_bird'] ?? 0;
                $normalCount = $stats['packages']['normal_bird'] ?? 0;
                $pkgTotal = max($earlyCount + $normalCount, 1);
                $earlyPct = round(($earlyCount / $pkgTotal) * 100);
                $normalPct = round(($normalCount / $pkgTotal) * 100);
            @endphp

            <div class="space-y-4">
                <div>
                    <div class="flex justify-between items-center text-sm font-medium mb-1.5">
                        <span class="text-gray-700 flex items-center gap-2">
                            <span class="w-2.5 h-2.5 rounded-full bg-amber-500"></span> Early Bird
                        </span>
                        <span class="font-bold text-gray-900">{{ $earlyCount }} <span class="text-xs font-normal text-gray-500">({{ $earlyPct }}%)</span></span>
                    </div>
                    <div class="w-full bg-gray-100 rounded-full h-2.5 overflow-hidden">
                        <div class="bg-amber-500 h-2.5 rounded-full transition-all duration-500" style="width: {{ $earlyPct }}%"></div>
                    </div>
                </div>

                <div>
                    <div class="flex justify-between items-center text-sm font-medium mb-1.5">
                        <span class="text-gray-700 flex items-center gap-2">
                            <span class="w-2.5 h-2.5 rounded-full bg-blue-600"></span> Normal Bird
                        </span>
                        <span class="font-bold text-gray-900">{{ $normalCount }} <span class="text-xs font-normal text-gray-500">({{ $normalPct }}%)</span></span>
                    </div>
                    <div class="w-full bg-gray-100 rounded-full h-2.5 overflow-hidden">
                        <div class="bg-blue-600 h-2.5 rounded-full transition-all duration-500" style="width: {{ $normalPct }}%"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Gender Breakdown -->
        <div class="bg-white rounded-2xl border border-gray-200/80 p-6 shadow-xs">
            <div class="flex items-center justify-between mb-5">
                <div class="flex items-center gap-2">
                    <span class="w-8 h-8 rounded-lg bg-pink-50 text-pink-600 flex items-center justify-center text-sm">🚻</span>
                    <h3 class="text-base font-bold text-gray-900">Distribusi Jenis Kelamin</h3>
                </div>
                <span class="text-xs text-gray-400 font-medium">Demografi Peserta</span>
            </div>

            @php
                $priaCount = $stats['gender']['pria'] ?? 0;
                $wanitaCount = $stats['gender']['wanita'] ?? 0;
                $genderTotal = max($priaCount + $wanitaCount, 1);
                $priaPct = round(($priaCount / $genderTotal) * 100);
                $wanitaPct = round(($wanitaCount / $genderTotal) * 100);
            @endphp

            <div class="space-y-4">
                <div>
                    <div class="flex justify-between items-center text-sm font-medium mb-1.5">
                        <span class="text-gray-700 flex items-center gap-2">
                            <span class="w-2.5 h-2.5 rounded-full bg-blue-500"></span> Ikhwan (Pria)
                        </span>
                        <span class="font-bold text-gray-900">{{ $priaCount }} <span class="text-xs font-normal text-gray-500">({{ $priaPct }}%)</span></span>
                    </div>
                    <div class="w-full bg-gray-100 rounded-full h-2.5 overflow-hidden">
                        <div class="bg-blue-500 h-2.5 rounded-full transition-all duration-500" style="width: {{ $priaPct }}%"></div>
                    </div>
                </div>

                <div>
                    <div class="flex justify-between items-center text-sm font-medium mb-1.5">
                        <span class="text-gray-700 flex items-center gap-2">
                            <span class="w-2.5 h-2.5 rounded-full bg-pink-500"></span> Akhwat (Wanita)
                        </span>
                        <span class="font-bold text-gray-900">{{ $wanitaCount }} <span class="text-xs font-normal text-gray-500">({{ $wanitaPct }}%)</span></span>
                    </div>
                    <div class="w-full bg-gray-100 rounded-full h-2.5 overflow-hidden">
                        <div class="bg-pink-500 h-2.5 rounded-full transition-all duration-500" style="width: {{ $wanitaPct }}%"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Registrations Card -->
    <div class="bg-white rounded-2xl border border-gray-200/80 shadow-xs overflow-hidden">
        <div class="p-5 sm:p-6 border-b border-gray-100 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
            <div>
                <h3 class="text-base font-bold text-gray-900">Pendaftar Terbaru</h3>
                <p class="text-xs text-gray-500 mt-0.5">Daftar calon peserta yang baru mendaftar</p>
            </div>
            <a href="{{ route('admin.spn.registrants') }}"
                class="inline-flex items-center gap-1.5 text-xs sm:text-sm font-semibold text-amber-600 hover:text-amber-700 hover:underline">
                <span>Lihat Semua Pendaftar</span>
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-500">
                <thead class="text-xs text-gray-600 uppercase bg-gray-50/80 border-b border-gray-200/80 tracking-wider">
                    <tr>
                        <th class="px-6 py-3.5 font-semibold">Nama Peserta</th>
                        <th class="px-6 py-3.5 font-semibold">WhatsApp</th>
                        <th class="px-6 py-3.5 font-semibold">Paket</th>
                        <th class="px-6 py-3.5 font-semibold">Status</th>
                        <th class="px-6 py-3.5 font-semibold">Waktu Pendaftaran</th>
                        <th class="px-6 py-3.5 font-semibold text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($recentRegistrations as $registration)
                        <tr class="hover:bg-gray-50/75 transition">
                            <td class="px-6 py-4">
                                <div class="font-bold text-gray-900">{{ $registration->nama_lengkap }}</div>
                                <div class="text-xs text-gray-400 capitalize">{{ $registration->jenis_kelamin ?? '-' }}</div>
                            </td>
                            <td class="px-6 py-4 text-xs font-mono text-gray-700">
                                {{ $registration->whatsapp }}
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-2.5 py-1 text-xs font-semibold rounded-full bg-gray-100 text-gray-700 capitalize">
                                    {{ str_replace('_', ' ', $registration->paket) }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                @if($registration->status === 'terverifikasi')
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 text-xs font-semibold rounded-full bg-emerald-50 text-emerald-700 border border-emerald-200/60">
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                        Terverifikasi
                                    </span>
                                @elseif($registration->status === 'ditolak')
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 text-xs font-semibold rounded-full bg-rose-50 text-rose-700 border border-rose-200/60">
                                        <span class="w-1.5 h-1.5 rounded-full bg-rose-500"></span>
                                        Ditolak
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 text-xs font-semibold rounded-full bg-amber-50 text-amber-700 border border-amber-200/60">
                                        <span class="w-1.5 h-1.5 rounded-full bg-amber-500 animate-pulse"></span>
                                        Pending
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-xs text-gray-500">
                                {{ $registration->created_at->format('d M Y') }} &middot; <span class="text-gray-400">{{ $registration->created_at->format('H:i') }}</span>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <a href="{{ route('admin.spn.show', $registration->id) }}"
                                    class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg bg-gray-100 hover:bg-amber-50 text-gray-700 hover:text-amber-700 font-semibold text-xs transition">
                                    <span>Detail</span>
                                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                    </svg>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center text-gray-400 text-sm">
                                <div class="w-12 h-12 rounded-full bg-gray-100 text-gray-400 flex items-center justify-center mx-auto mb-2 text-xl">
                                    📭
                                </div>
                                Belum ada data pendaftar terbaru.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
