@extends('admin.layouts.app')

@section('title', 'Alumni Multi-Batch - Admin Panel')

@section('content')
<div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8 space-y-6">
    
    <!-- Breadcrumb & Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <div class="flex items-center gap-2 text-xs text-gray-500 mb-1.5">
                <a href="{{ route('admin.batch-alumni.index') }}" class="hover:text-emerald-600 transition">Database Alumni</a>
                <span>/</span>
                <span class="text-amber-700 font-medium">Alumni Multi-Batch</span>
            </div>
            <div class="flex items-center gap-2.5">
                <span class="inline-flex items-center justify-center w-9 h-9 rounded-xl bg-amber-100 text-amber-700 text-lg font-bold">
                    🌟
                </span>
                <h1 class="text-2xl font-bold text-gray-900">Data Alumni Multi-Batch</h1>
                <span class="px-2.5 py-1 text-xs font-bold rounded-full bg-amber-100 text-amber-800 border border-amber-200">
                    {{ number_format($totalMultiBatch, 0, ',', '.') }} Alumni (>1 Batch)
                </span>
            </div>
            <p class="text-sm text-gray-500 mt-1">
                Daftar akun alumni yang tercatat mengikuti lebih dari satu kegiatan atau angkatan batch di Bidang Dakwah Masjid Salman ITB.
            </p>
        </div>

        <div class="flex flex-wrap items-center gap-2.5">
            <a href="{{ route('admin.batch-alumni.index') }}"
                class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl border border-gray-300 bg-white text-gray-700 font-semibold text-xs hover:bg-gray-50 shadow-xs transition">
                <svg class="w-4 h-4 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                <span>Semua Data Alumni</span>
            </a>
            <a href="{{ route('admin.alumni.import.form') }}"
                class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-semibold text-xs shadow-xs transition">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                </svg>
                <span>Import Excel</span>
            </a>
        </div>
    </div>

    <!-- Filters Card -->
    <div class="bg-white rounded-2xl border border-gray-200/80 shadow-xs p-5">
        <form action="{{ route('admin.batch-alumni.multi-batch') }}" method="GET" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            <!-- Search -->
            <div>
                <label for="search" class="block text-xs font-semibold text-gray-600 uppercase tracking-wider mb-1.5">Pencarian Alumni</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                    <input type="text" name="search" id="search" value="{{ request('search') }}"
                        placeholder="Nama atau email..."
                        class="w-full pl-9 pr-3.5 py-2 bg-gray-50/50 border border-gray-300 rounded-xl text-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-amber-500/20 focus:border-amber-500 transition">
                </div>
            </div>

            <!-- Filter Batch -->
            <div>
                <label for="batch_id" class="block text-xs font-semibold text-gray-600 uppercase tracking-wider mb-1.5">Salah Satu Batch</label>
                <select name="batch_id" id="batch_id"
                    class="w-full px-3 py-2 bg-gray-50/50 border border-gray-300 rounded-xl text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-amber-500/20 focus:border-amber-500 transition">
                    <option value="">Semua Batch Kegiatan</option>
                    @foreach ($batches as $batch)
                        <option value="{{ $batch->id }}" {{ request('batch_id') == $batch->id ? 'selected' : '' }}>
                            {{ $batch->activity->title ?? 'Kegiatan' }} &bull; {{ $batch->nama_batch }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Min Batches -->
            <div>
                <label for="min_batches" class="block text-xs font-semibold text-gray-600 uppercase tracking-wider mb-1.5">Jumlah Batch Diikuti</label>
                <select name="min_batches" id="min_batches"
                    class="w-full px-3 py-2 bg-gray-50/50 border border-gray-300 rounded-xl text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-amber-500/20 focus:border-amber-500 transition">
                    <option value="">Semua (> 1 Batch)</option>
                    <option value="2" {{ request('min_batches') == '2' ? 'selected' : '' }}>Minimal 2 Batch</option>
                    <option value="3" {{ request('min_batches') == '3' ? 'selected' : '' }}>Minimal 3 Batch</option>
                    <option value="4" {{ request('min_batches') == '4' ? 'selected' : '' }}>Minimal 4 Batch</option>
                </select>
            </div>

            <!-- Sorting & Submit -->
            <div class="flex items-end gap-2">
                <div class="flex-1">
                    <label for="sort_by" class="block text-xs font-semibold text-gray-600 uppercase tracking-wider mb-1.5">Urutan</label>
                    <select name="sort_by" id="sort_by"
                        class="w-full px-3 py-2 bg-gray-50/50 border border-gray-300 rounded-xl text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-amber-500/20 focus:border-amber-500 transition">
                        <option value="count_desc" {{ request('sort_by') == 'count_desc' ? 'selected' : '' }}>Batch Terbanyak &darr;</option>
                        <option value="count_asc" {{ request('sort_by') == 'count_asc' ? 'selected' : '' }}>Batch Tersedikit &uarr;</option>
                        <option value="name_asc" {{ request('sort_by') == 'name_asc' ? 'selected' : '' }}>Nama (A - Z)</option>
                        <option value="name_desc" {{ request('sort_by') == 'name_desc' ? 'selected' : '' }}>Nama (Z - A)</option>
                    </select>
                </div>
                <button type="submit"
                    class="px-4 py-2 bg-amber-500 hover:bg-amber-600 text-white rounded-xl font-semibold text-sm shadow-xs transition">
                    Filter
                </button>
                @if(request()->hasAny(['search', 'batch_id', 'min_batches', 'sort_by']))
                    <a href="{{ route('admin.batch-alumni.multi-batch') }}"
                        class="px-3.5 py-2 border border-gray-300 text-gray-600 hover:bg-gray-50 rounded-xl font-semibold text-sm transition" title="Reset">
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
                        <th class="px-5 py-3.5 font-semibold">Alumni</th>
                        <th class="px-5 py-3.5 font-semibold text-center">Jumlah Batch</th>
                        <th class="px-5 py-3.5 font-semibold">Daftar Batch &amp; Kegiatan yang Pernah Diikuti</th>
                        <th class="px-5 py-3.5 font-semibold">Status Akun</th>
                        <th class="px-5 py-3.5 font-semibold text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($users as $index => $user)
                        <tr class="hover:bg-gray-50/75 transition">
                            <td class="px-5 py-4 text-xs text-gray-400 font-medium">
                                {{ $users->firstItem() + $index }}
                            </td>
                            <td class="px-5 py-4 min-w-[200px]">
                                <div class="font-bold text-gray-900 leading-snug">{{ $user->name }}</div>
                                <div class="text-xs text-gray-500 font-mono mt-0.5">{{ $user->email }}</div>
                            </td>
                            <td class="px-5 py-4 text-center whitespace-nowrap">
                                <span class="inline-flex items-center gap-1 px-3 py-1 text-xs font-black rounded-lg bg-amber-100 text-amber-900 border border-amber-200">
                                    <span>🌟</span>
                                    <span>{{ $user->batch_alumni_count }} Batch</span>
                                </span>
                            </td>
                            <td class="px-5 py-4 min-w-[320px]">
                                <div class="flex flex-wrap gap-1.5">
                                    @foreach($user->batchAlumni as $ba)
                                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg text-xs font-medium bg-gray-50 border border-gray-200 text-gray-800 shadow-2xs hover:bg-emerald-50 hover:border-emerald-200 transition">
                                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                            <span class="font-semibold text-emerald-800">{{ $ba->activityBatch->activity->title ?? 'Kegiatan' }}</span>
                                            <span class="text-gray-400">&bull;</span>
                                            <span class="text-gray-600">{{ $ba->activityBatch->nama_batch ?? ('Batch ' . $ba->activityBatch->batch_ke) }}</span>
                                        </span>
                                    @endforeach
                                </div>
                            </td>
                            <td class="px-5 py-4 whitespace-nowrap">
                                @if($user->is_active)
                                    <span class="inline-flex items-center gap-1 px-2.5 py-1 text-xs font-semibold rounded-full bg-emerald-50 text-emerald-700 border border-emerald-200/60">
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                        Aktif
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1 px-2.5 py-1 text-xs font-semibold rounded-full bg-gray-100 text-gray-600">
                                        Belum Aktivasi
                                    </span>
                                @endif
                            </td>
                            <td class="px-5 py-4 text-right whitespace-nowrap">
                                <a href="{{ route('admin.users.edit', $user->id) }}"
                                    class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg bg-gray-100 hover:bg-amber-50 text-gray-700 hover:text-amber-700 font-semibold text-xs transition" title="Kelola Pengguna">
                                    <span>Kelola User</span>
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
                                    🔍
                                </div>
                                Tidak ada data alumni multi-batch yang cocok dengan kriteria filter.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($users->hasPages())
            <div class="px-6 py-4 border-t border-gray-100 bg-gray-50/50">
                {{ $users->links() }}
            </div>
        @endif
    </div>

</div>
@endsection
