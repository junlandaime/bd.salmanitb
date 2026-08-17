@extends('admin.layouts.app')
@section('title', 'Manajemen Feedback - Admin Panel')

@section('content')
<div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
    
    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
        <div>
            <div class="flex items-center gap-3">
                <h1 class="text-2xl font-bold text-gray-900">Manajemen Feedback</h1>
                @if($openCount > 0)
                    <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-bold bg-amber-50 text-amber-800 border border-amber-200">
                        <span class="w-1.5 h-1.5 rounded-full bg-amber-500 animate-pulse"></span>
                        {{ $openCount }} Belum Dijawab
                    </span>
                @else
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-emerald-50 text-emerald-700 border border-emerald-200">
                        Semua Terjawab ✓
                    </span>
                @endif
            </div>
            <p class="text-sm text-gray-500 mt-1">Kelola pertanyaan, saran, keluhan, dan laporan dari peserta maupun alumni.</p>
        </div>
    </div>

    <!-- Filter Card -->
    <div class="bg-white rounded-2xl border border-gray-200/80 shadow-sm p-5 mb-8">
        <form method="GET" action="{{ route('admin.feedback.index') }}" class="space-y-4">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                <!-- Search Input -->
                <div class="sm:col-span-2">
                    <label for="search" class="block text-xs font-semibold text-gray-700 mb-1">Cari Feedback</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-gray-400">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                        <input type="text" name="search" id="search" value="{{ request('search') }}"
                            class="w-full pl-10 pr-3.5 py-2 text-sm border border-gray-300 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition"
                            placeholder="Cari subjek, nama pengirim, atau email...">
                    </div>
                </div>

                <!-- Status Filter -->
                <div>
                    <label for="status" class="block text-xs font-semibold text-gray-700 mb-1">Status Diskusi</label>
                    <select name="status" id="status"
                        class="w-full px-3.5 py-2 text-sm border border-gray-300 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition bg-white">
                        <option value="">Semua Status</option>
                        <option value="open" {{ request('status') === 'open' ? 'selected' : '' }}>🟡 Belum Dijawab (Open)</option>
                        <option value="answered" {{ request('status') === 'answered' ? 'selected' : '' }}>🟢 Dijawab (Answered)</option>
                        <option value="closed" {{ request('status') === 'closed' ? 'selected' : '' }}>⚪ Ditutup (Closed)</option>
                    </select>
                </div>

                <!-- Category Filter -->
                <div>
                    <label for="category" class="block text-xs font-semibold text-gray-700 mb-1">Kategori</label>
                    <select name="category" id="category"
                        class="w-full px-3.5 py-2 text-sm border border-gray-300 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition bg-white">
                        <option value="">Semua Kategori</option>
                        @foreach($categories as $value => $label)
                            <option value="{{ $value }}" {{ request('category') === $value ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="flex items-center justify-between pt-2 border-t border-gray-100">
                <div class="flex items-center gap-2">
                    <button type="submit"
                        class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-semibold text-xs transition shadow-sm">
                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                        </svg>
                        Terapkan Filter
                    </button>
                    <a href="{{ route('admin.feedback.index') }}"
                        class="inline-flex items-center px-4 py-2 rounded-xl bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium text-xs transition">
                        Reset
                    </a>
                </div>
                <span class="text-xs text-gray-500 hidden sm:inline">
                    Total: <strong class="text-gray-800">{{ $feedbacks->total() }}</strong> feedback ditemukan
                </span>
            </div>
        </form>
    </div>

    <!-- Table Card -->
    <div class="bg-white rounded-2xl border border-gray-200/80 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-500">
                <thead class="text-xs text-gray-600 uppercase bg-gray-50/80 border-b border-gray-200">
                    <tr>
                        <th class="px-6 py-3.5">Pengirim</th>
                        <th class="px-6 py-3.5">Kategori</th>
                        <th class="px-6 py-3.5">Subjek & Pesan</th>
                        <th class="px-6 py-3.5">Status</th>
                        <th class="px-6 py-3.5">Tanggal</th>
                        <th class="px-6 py-3.5 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($feedbacks as $feedback)
                        <tr class="hover:bg-gray-50/60 transition">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center gap-3">
                                    <div class="w-9 h-9 rounded-xl bg-emerald-100 text-emerald-800 flex items-center justify-center font-bold text-xs shrink-0 shadow-2xs">
                                        {{ strtoupper(substr($feedback->user->name ?? 'U', 0, 1)) }}
                                    </div>
                                    <div class="min-w-0">
                                        <div class="font-bold text-gray-900 text-xs truncate max-w-[160px]">
                                            {{ $feedback->user->name ?? 'User Terhapus' }}
                                        </div>
                                        <div class="text-[11px] text-gray-400 truncate max-w-[160px]">
                                            {{ $feedback->user->email ?? '-' }}
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2.5 py-1 rounded-full text-xs font-semibold bg-gray-100 text-gray-700 border border-gray-200">
                                    {{ $feedback->category_label }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="max-w-md">
                                    <a href="{{ route('admin.feedback.show', $feedback->id) }}" class="font-bold text-gray-900 hover:text-emerald-700 transition line-clamp-1 text-xs">
                                        {{ $feedback->subject }}
                                    </a>
                                    <p class="text-xs text-gray-500 line-clamp-1 mt-0.5">
                                        {{ Str::limit($feedback->message, 80) }}
                                    </p>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2.5 py-1 text-xs font-bold rounded-full border {{ $feedback->status_badge }}">
                                    @if($feedback->status === 'open')
                                        <i class="fas fa-clock mr-1 text-amber-600"></i>
                                    @elseif($feedback->status === 'answered')
                                        <i class="fas fa-check-circle mr-1 text-emerald-600"></i>
                                    @else
                                        <i class="fas fa-lock mr-1 text-gray-500"></i>
                                    @endif
                                    {{ $feedback->status_label }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-xs text-gray-500">
                                {{ $feedback->created_at->translatedFormat('d M Y, H:i') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right">
                                <a href="{{ route('admin.feedback.show', $feedback->id) }}"
                                    class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-emerald-50 text-emerald-700 hover:bg-emerald-100 text-xs font-bold border border-emerald-200/80 transition">
                                    <span>Tinjau</span>
                                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                    </svg>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center">
                                <div class="w-12 h-12 rounded-2xl bg-gray-100 text-gray-400 flex items-center justify-center mx-auto mb-3 text-xl">
                                    💬
                                </div>
                                <h3 class="text-sm font-bold text-gray-900">Belum Ada Feedback</h3>
                                <p class="text-xs text-gray-500 mt-1 max-w-sm mx-auto">
                                    Tidak ada data feedback yang sesuai dengan kriteria pencarian atau filter yang dipilih.
                                </p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($feedbacks->hasPages())
            <div class="px-6 py-4 border-t border-gray-100 bg-gray-50/50">
                {{ $feedbacks->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
