@extends('admin.layouts.app')

@section('title', 'Database Alumni - Admin Panel')

@section('content')
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
        
        <!-- Header -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Database Alumni Kegiatan</h1>
                <p class="text-sm text-gray-500 mt-1">Data alumni dari berbagai batch kegiatan dan pelatihan Bidang Dakwah.</p>
            </div>
            <div class="flex flex-wrap items-center gap-2.5">
                <a href="{{ route('admin.batch-alumni.multi-batch') }}"
                    class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl border border-amber-300 bg-amber-50 text-amber-900 font-semibold text-xs hover:bg-amber-100 shadow-xs transition">
                    <span>🌟</span>
                    <span>Alumni Multi-Batch (>1 Batch)</span>
                </a>
                <a href="{{ route('admin.alumni.import.form') }}"
                    class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl border border-gray-300 bg-white text-gray-700 font-semibold text-xs hover:bg-gray-50 shadow-xs transition">
                    <svg class="w-4 h-4 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                    </svg>
                    Import Excel
                </a>
                <a href="{{ route('admin.batch-alumni.create') }}"
                    class="inline-flex items-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white px-4 py-2.5 rounded-xl font-semibold text-xs shadow-xs transition">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Tambah Alumni
                </a>
            </div>
        </div>

        @if (session('success'))
            <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 px-4 py-3 rounded-xl mb-6 flex items-center justify-between shadow-sm" role="alert">
                <span class="text-sm font-medium">{{ session('success') }}</span>
                <button type="button" onclick="this.parentElement.remove()" class="text-emerald-500 hover:text-emerald-700">✕</button>
            </div>
        @endif

        @if (session('error'))
            <div class="bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-xl mb-6 flex items-center justify-between shadow-sm" role="alert">
                <span class="text-sm font-medium">{{ session('error') }}</span>
                <button type="button" onclick="this.parentElement.remove()" class="text-red-500 hover:text-red-700">✕</button>
            </div>
        @endif

        <!-- Filter Card -->
        <div class="bg-white rounded-2xl border border-gray-200/80 shadow-sm p-5 mb-8">
            <form action="{{ route('admin.batch-alumni.index') }}" method="GET" class="space-y-4">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                    <div>
                        <label for="search" class="block text-xs font-semibold text-gray-700 mb-1">Cari Alumni</label>
                        <input type="text" name="search" id="search" value="{{ request('search') }}"
                            placeholder="Nama atau email..."
                            class="w-full px-3.5 py-2 text-sm border border-gray-300 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition">
                    </div>

                    <div>
                        <label for="batch_id" class="block text-xs font-semibold text-gray-700 mb-1">Filter Batch</label>
                        <select name="batch_id" id="batch_id"
                            class="w-full px-3.5 py-2 text-sm border border-gray-300 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition bg-white">
                            <option value="">Semua Batch</option>
                            @foreach ($batches as $batch)
                                <option value="{{ $batch->id }}" {{ request('batch_id') == $batch->id ? 'selected' : '' }}>
                                    {{ $batch->activity->title ?? $batch->activity->nama_kegiatan ?? 'Kegiatan' }} - {{ $batch->nama_batch }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="sort_by" class="block text-xs font-semibold text-gray-700 mb-1">Urutkan</label>
                        <select name="sort_by" id="sort_by"
                            class="w-full px-3.5 py-2 text-sm border border-gray-300 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition bg-white">
                            <option value="name_asc" {{ request('sort_by') == 'name_asc' ? 'selected' : '' }}>Nama (A-Z)</option>
                            <option value="name_desc" {{ request('sort_by') == 'name_desc' ? 'selected' : '' }}>Nama (Z-A)</option>
                            <option value="created_at_desc" {{ request('sort_by', 'created_at_desc') == 'created_at_desc' ? 'selected' : '' }}>Terbaru</option>
                        </select>
                    </div>
                </div>

                <div class="flex items-center justify-between pt-2 border-t border-gray-100">
                    <div class="flex items-center gap-2">
                        <button type="submit"
                            class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-semibold text-xs transition shadow-sm">
                            Terapkan Filter
                        </button>
                        <a href="{{ route('admin.batch-alumni.index') }}"
                            class="inline-flex items-center px-4 py-2 rounded-xl bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium text-xs transition">
                            Reset
                        </a>
                    </div>
                </div>
            </form>
        </div>

        <!-- Table Card -->
        <div class="bg-white rounded-2xl border border-gray-200/80 shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-500">
                    <thead class="text-xs text-gray-600 uppercase bg-gray-50/80 border-b border-gray-200">
                        <tr>
                            <th class="px-6 py-3.5">Nama &amp; Kontak</th>
                            <th class="px-6 py-3.5">Kegiatan &amp; Batch</th>
                            <th class="px-6 py-3.5">Instagram</th>
                            <th class="px-6 py-3.5">Gender</th>
                            <th class="px-6 py-3.5 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($batchAlumni as $alumni)
                            <tr class="hover:bg-gray-50/75 transition">
                                <td class="px-6 py-4">
                                    <div class="font-bold text-gray-900">{{ $alumni->user->name ?? '-' }}</div>
                                    <div class="text-xs text-gray-400 font-mono mt-0.5">{{ $alumni->user->email ?? '-' }}</div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="font-semibold text-gray-800">{{ $alumni->activityBatch->activity->title ?? $alumni->activityBatch->activity->nama_kegiatan ?? '-' }}</div>
                                    <div class="text-xs text-emerald-700 font-medium mt-0.5">{{ $alumni->activityBatch->nama_batch ?? '-' }}</div>
                                </td>
                                <td class="px-6 py-4 text-xs font-mono text-gray-600">
                                    {{ $alumni->instagram_account ? '@' . ltrim($alumni->instagram_account, '@') : '-' }}
                                </td>
                                <td class="px-6 py-4">
                                    @if($alumni->gender)
                                        <span class="px-2.5 py-0.5 text-xs font-semibold rounded-full {{ in_array(strtolower($alumni->gender), ['male', 'laki-laki', 'pria']) ? 'bg-blue-50 text-blue-700 border border-blue-200' : 'bg-pink-50 text-pink-700 border border-pink-200' }}">
                                            {{ ucfirst($alumni->gender) }}
                                        </span>
                                    @else
                                        <span class="text-gray-400 text-xs">-</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex items-center justify-end gap-1">
                                        <a href="{{ route('admin.batch-alumni.edit', $alumni) }}"
                                            class="p-1.5 text-gray-400 hover:text-gray-600 rounded-lg hover:bg-gray-100 transition" title="Edit Alumni">
                                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                        </a>
                                        <form action="{{ route('admin.batch-alumni.destroy', $alumni) }}" method="POST" class="inline"
                                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus data alumni ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="p-1.5 text-red-400 hover:text-red-600 rounded-lg hover:bg-red-50 transition" title="Hapus Alumni">
                                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-8 text-center text-gray-400">Tidak ada data alumni ditemukan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <div class="px-6 py-4 border-t border-gray-100 bg-gray-50/50">
                {{ $batchAlumni->links() }}
            </div>
        </div>

    </div>
@endsection
