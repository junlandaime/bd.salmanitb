@extends('admin.layouts.app')

@section('content')
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
        
        <!-- Header -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Semua Batch Kegiatan &amp; Materi</h1>
                <p class="text-sm text-gray-500 mt-1">Daftar seluruh batch dari berbagai kegiatan dan manajemen berkas materi alumni.</p>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('admin.alumni.materials.import.form') }}"
                    class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-semibold text-sm shadow-sm transition">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                    </svg>
                    Import Materi (Excel)
                </a>
                <a href="{{ route('admin.activities.index') }}"
                    class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl border border-gray-300 bg-white text-gray-700 font-semibold text-sm hover:bg-gray-50 shadow-sm transition">
                    &larr; Daftar Kegiatan
                </a>
            </div>
        </div>

        @if (session('success'))
            <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 px-4 py-3 rounded-xl mb-6 flex items-center justify-between shadow-sm" role="alert">
                <span class="text-sm font-medium">{{ session('success') }}</span>
                <button type="button" onclick="this.parentElement.remove()" class="text-emerald-500 hover:text-emerald-700">✕</button>
            </div>
        @endif

        <!-- Filter Card -->
        <div class="bg-white rounded-2xl border border-gray-200/80 shadow-sm p-5 mb-8">
            <form action="{{ route('admin.batches.index') }}" method="GET" class="space-y-4">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                    <!-- Status -->
                    <div>
                        <label for="status" class="block text-xs font-semibold text-gray-700 mb-1">Status Batch</label>
                        <select id="status" name="status"
                            class="w-full px-3.5 py-2 text-sm border border-gray-300 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition bg-white">
                            <option value="">Semua Status</option>
                            <option value="aktif" {{ request('status') === 'aktif' ? 'selected' : '' }}>Aktif</option>
                            <option value="nonaktif" {{ request('status') === 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                            <option value="selesai" {{ request('status') === 'selesai' ? 'selected' : '' }}>Selesai</option>
                        </select>
                    </div>

                    <!-- Material -->
                    <div>
                        <label for="has_material" class="block text-xs font-semibold text-gray-700 mb-1">Ketersediaan Materi</label>
                        <select id="has_material" name="has_material"
                            class="w-full px-3.5 py-2 text-sm border border-gray-300 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition bg-white">
                            <option value="">Semua Batch</option>
                            <option value="1" {{ request('has_material') === '1' ? 'selected' : '' }}>Ada Materi</option>
                            <option value="0" {{ request('has_material') === '0' ? 'selected' : '' }}>Belum Ada Materi</option>
                        </select>
                    </div>

                    <!-- Search -->
                    <div>
                        <label for="search" class="block text-xs font-semibold text-gray-700 mb-1">Cari Batch / Kegiatan</label>
                        <input type="text" name="search" id="search" value="{{ request('search') }}"
                            class="w-full px-3.5 py-2 text-sm border border-gray-300 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition"
                            placeholder="Nama batch atau kegiatan...">
                    </div>

                    <!-- Sort -->
                    <div>
                        <label for="sort_by" class="block text-xs font-semibold text-gray-700 mb-1">Urutan</label>
                        <select id="sort_by" name="sort_by"
                            class="w-full px-3.5 py-2 text-sm border border-gray-300 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition bg-white">
                            <option value="tanggal_mulai_kegiatan_desc" {{ request('sort_by') === 'tanggal_mulai_kegiatan_desc' || !request('sort_by') ? 'selected' : '' }}>Tanggal Kegiatan (Terbaru)</option>
                            <option value="tanggal_mulai_kegiatan_asc" {{ request('sort_by') === 'tanggal_mulai_kegiatan_asc' ? 'selected' : '' }}>Tanggal Kegiatan (Terlama)</option>
                            <option value="nama_batch_asc" {{ request('sort_by') === 'nama_batch_asc' ? 'selected' : '' }}>Nama Batch (A-Z)</option>
                            <option value="harga_desc" {{ request('sort_by') === 'harga_desc' ? 'selected' : '' }}>Harga (Tertinggi)</option>
                            <option value="harga_asc" {{ request('sort_by') === 'harga_asc' ? 'selected' : '' }}>Harga (Terendah)</option>
                        </select>
                    </div>
                </div>

                <div class="flex items-center justify-between pt-2 border-t border-gray-100">
                    <div class="flex items-center gap-2">
                        <button type="submit"
                            class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-semibold text-xs transition shadow-sm">
                            Terapkan Filter
                        </button>
                        <a href="{{ route('admin.batches.index') }}"
                            class="inline-flex items-center px-4 py-2 rounded-xl bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium text-xs transition">
                            Reset
                        </a>
                    </div>
                </div>
            </form>
        </div>

        <!-- Batches List Card -->
        <div class="bg-white rounded-2xl border border-gray-200/80 shadow-sm overflow-hidden">
            <ul class="divide-y divide-gray-100">
                @forelse($batches as $batch)
                    <li class="p-6 hover:bg-gray-50/75 transition">
                        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
                            <div class="flex-1 min-w-0">
                                <div class="flex items-center gap-3">
                                    <h3 class="text-base font-bold text-gray-900 truncate">
                                        {{ $batch->activity->title ?? '-' }} &ndash; {{ $batch->nama_batch }}
                                    </h3>
                                    <span class="px-2.5 py-0.5 inline-flex text-xs font-semibold rounded-full 
                                        @if ($batch->status === 'aktif') bg-emerald-100 text-emerald-800
                                        @elseif($batch->status === 'nonaktif') bg-gray-100 text-gray-800
                                        @else bg-blue-100 text-blue-800 @endif">
                                        {{ ucfirst($batch->status) }}
                                    </span>

                                    @php $materialCount = $batch->materials->count(); @endphp
                                    @if ($materialCount > 0)
                                        <span class="px-2.5 py-0.5 inline-flex text-xs font-semibold rounded-full bg-amber-50 text-amber-800 border border-amber-200">
                                            📁 {{ $materialCount }} Materi
                                        </span>
                                    @endif
                                </div>

                                <div class="mt-3 grid grid-cols-1 sm:grid-cols-4 gap-3 text-xs text-gray-600">
                                    <div>
                                        <span class="text-gray-400">👥 Kuota:</span>
                                        <strong class="text-gray-900 ml-1">{{ $batch->kuota }} peserta</strong>
                                    </div>
                                    <div>
                                        <span class="text-gray-400">🏷️ Harga:</span>
                                        <strong class="text-gray-900 ml-1">Rp {{ number_format($batch->harga, 0, ',', '.') }}</strong>
                                    </div>
                                    <div>
                                        <span class="text-gray-400">📅 Kegiatan:</span>
                                        <span class="text-gray-800 ml-1">{{ \Carbon\Carbon::parse($batch->tanggal_mulai_kegiatan)->format('d M Y') }}</span>
                                    </div>
                                    <div>
                                        <span class="text-gray-400">📝 Pendaftaran:</span>
                                        <span class="text-gray-800 ml-1">{{ \Carbon\Carbon::parse($batch->tanggal_selesai_pendaftaran)->format('d M Y') }}</span>
                                    </div>
                                </div>
                            </div>

                            <div class="flex items-center gap-2 shrink-0">
                                <a href="{{ route('admin.batches.materials.index', $batch) }}"
                                    class="inline-flex items-center gap-1.5 px-3.5 py-2 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-700 hover:bg-emerald-100 font-semibold text-xs transition">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                    </svg>
                                    Materi
                                </a>
                                @if($batch->activity)
                                    <a href="{{ route('admin.activities.batches.edit', [$batch->activity, $batch]) }}"
                                        class="inline-flex items-center px-3.5 py-2 rounded-xl bg-white border border-gray-200 text-gray-700 hover:bg-gray-50 font-semibold text-xs shadow-sm transition">
                                        Edit
                                    </a>
                                @endif
                            </div>
                        </div>
                    </li>
                @empty
                    <li class="p-12 text-center text-gray-400 text-sm">
                        Belum ada batch kegiatan yang tersedia.
                    </li>
                @endforelse
            </ul>
        </div>

        @if (isset($batches) && method_exists($batches, 'links'))
            <div class="mt-6">
                {{ $batches->appends(request()->query())->links() }}
            </div>
        @endif
    </div>
@endsection
