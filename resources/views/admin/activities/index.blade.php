@extends('admin.layouts.app')

@section('content')
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
        
        <!-- Header -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Kegiatan Bidang Dakwah</h1>
                <p class="text-sm text-gray-500 mt-1">Kelola seluruh kegiatan, kurikulum/learning paths, pemateri, dan batch pelaksanaan.</p>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('admin.batches.index') }}"
                    class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl border border-gray-300 bg-white text-gray-700 font-semibold text-sm hover:bg-gray-50 shadow-sm transition">
                    <svg class="w-4 h-4 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                    </svg>
                    Semua Batch
                </a>
                <a href="{{ route('admin.activities.create') }}"
                    class="inline-flex items-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white px-4 py-2.5 rounded-xl font-semibold text-sm shadow-sm transition">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Tambah Kegiatan Baru
                </a>
            </div>
        </div>

        @if (session('success'))
            <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 px-4 py-3 rounded-xl mb-6 flex items-center justify-between shadow-sm" role="alert">
                <span class="text-sm font-medium">{{ session('success') }}</span>
                <button type="button" onclick="this.parentElement.remove()" class="text-emerald-500 hover:text-emerald-700">✕</button>
            </div>
        @endif

        <!-- Kegiatan Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-10">
            @forelse ($activities as $activity)
                <div class="bg-white rounded-2xl border border-gray-200/80 shadow-sm hover:shadow-md transition flex flex-col justify-between overflow-hidden">
                    <div class="p-6">
                        <!-- Top Badges -->
                        <div class="flex items-center justify-between gap-2 mb-3">
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold bg-emerald-50 text-emerald-700 border border-emerald-100">
                                📂 {{ $activity->program->title ?? 'Program BD' }}
                            </span>
                            <span class="px-2.5 py-0.5 text-xs font-medium rounded-full 
                                @if ($activity->status === 'published') bg-green-100 text-green-800
                                @elseif($activity->status === 'draft') bg-yellow-100 text-yellow-800
                                @else bg-red-100 text-red-800 @endif">
                                {{ ucfirst($activity->status) }}
                            </span>
                        </div>

                        <!-- Title -->
                        <h3 class="text-lg font-bold text-gray-900 leading-snug">
                            {{ $activity->title }}
                        </h3>

                        <!-- Description -->
                        <p class="text-gray-500 text-sm mt-2 line-clamp-2 leading-relaxed">
                            {{ $activity->description }}
                        </p>

                        <!-- Key Stats / Indicators -->
                        <div class="grid grid-cols-2 gap-2 mt-5 pt-4 border-t border-gray-100 text-xs text-gray-600">
                            <div class="bg-gray-50 rounded-lg p-2 text-center">
                                <span class="block font-bold text-gray-900 text-sm">{{ $activity->learningPath->count() }}</span>
                                <span class="text-[11px] text-gray-500">Learning Paths</span>
                            </div>
                            <div class="bg-gray-50 rounded-lg p-2 text-center">
                                <span class="block font-bold text-gray-900 text-sm">{{ $activity->batches->count() }}</span>
                                <span class="text-[11px] text-gray-500">Total Batch</span>
                            </div>
                        </div>
                    </div>

                    <!-- Action Footer -->
                    <div class="bg-gray-50/75 px-6 py-3.5 border-t border-gray-100 flex items-center justify-between gap-2">
                        <div class="flex items-center gap-2">
                            <a href="{{ route('admin.activities.show', $activity->id) }}"
                                class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-white border border-gray-200 text-gray-700 hover:bg-gray-50 font-medium text-xs shadow-sm transition">
                                <span>Detail</span>
                            </a>
                            <a href="{{ route('admin.activities.batches.index', $activity->id) }}"
                                class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-emerald-50 border border-emerald-200 text-emerald-700 hover:bg-emerald-100 font-semibold text-xs transition">
                                <span>Batch ({{ $activity->batches->count() }})</span>
                            </a>
                        </div>
                        <div class="flex items-center gap-1">
                            <a href="{{ route('admin.activities.edit', $activity) }}"
                                class="p-1.5 text-gray-400 hover:text-gray-600 rounded-lg hover:bg-gray-100 transition" title="Edit Kegiatan">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                            </a>
                            <form action="{{ route('admin.activities.destroy', $activity) }}" method="POST" class="inline"
                                onsubmit="return confirm('Apakah Anda yakin ingin menghapus kegiatan ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-1.5 text-red-400 hover:text-red-600 rounded-lg hover:bg-red-50 transition" title="Hapus Kegiatan">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-3 text-center py-12 bg-white rounded-2xl border border-gray-200">
                    <p class="text-gray-500">Belum ada kegiatan yang dibuat.</p>
                </div>
            @endforelse
        </div>

        <div class="mb-10">
            {{ $activities->links() }}
        </div>

        <!-- ================= BATCH MONITORING TABLE ================= -->
        @php
            \App\Models\ActivityBatch::updateExpiredBatches();
            $allRecentBatches = \App\Models\ActivityBatch::with(['activity.program'])
                ->orderBy('tanggal_mulai_pendaftaran', 'desc')
                ->take(10)
                ->get();
        @endphp

        <div class="bg-white shadow-sm rounded-2xl border border-gray-200 overflow-hidden">
            <div class="p-5 border-b border-gray-100 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 bg-gray-50/50">
                <div>
                    <h3 class="text-base font-bold text-gray-900">Monitoring Batch Kegiatan Terbaru</h3>
                    <p class="text-xs text-gray-500 mt-0.5">Daftar batch pelaksanaan kegiatan Bidang Dakwah &amp; Sekolah Pranikah</p>
                </div>
                <a href="{{ route('admin.batches.index') }}" class="text-xs font-semibold text-emerald-600 hover:text-emerald-700 hover:underline">
                    Lihat Semua Batch &rarr;
                </a>
            </div>
            
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-500">
                    <thead class="text-xs text-gray-600 uppercase bg-gray-50 border-b border-gray-200">
                        <tr>
                            <th class="px-6 py-3.5">Kegiatan &amp; Program</th>
                            <th class="px-6 py-3.5">Nama Batch</th>
                            <th class="px-6 py-3.5">Status</th>
                            <th class="px-6 py-3.5">Periode Pendaftaran</th>
                            <th class="px-6 py-3.5">Kuota &amp; Harga</th>
                            <th class="px-6 py-3.5 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($allRecentBatches as $batch)
                            <tr class="hover:bg-gray-50/75 transition">
                                <td class="px-6 py-4">
                                    <div class="font-semibold text-gray-900">{{ $batch->activity->title ?? '-' }}</div>
                                    <div class="text-xs text-gray-400 mt-0.5">{{ $batch->activity->program->title ?? '-' }}</div>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="font-medium text-gray-800">{{ $batch->nama_batch }}</span>
                                    <span class="text-xs text-gray-400 block font-mono">Batch #{{ $batch->batch_ke }}</span>
                                </td>
                                <td class="px-6 py-4">
                                    @if ($batch->status === 'aktif')
                                        @if ($batch->isRegistrationOpen())
                                            <span class="px-2.5 py-1 inline-flex text-xs leading-4 font-semibold rounded-full bg-green-100 text-green-800">
                                                Aktif (Dibuka)
                                            </span>
                                        @elseif($batch->tanggal_mulai_pendaftaran && now()->lt($batch->tanggal_mulai_pendaftaran))
                                            <span class="px-2.5 py-1 inline-flex text-xs leading-4 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                                Aktif (Akan Dibuka)
                                            </span>
                                        @else
                                            <span class="px-2.5 py-1 inline-flex text-xs leading-4 font-semibold rounded-full bg-gray-100 text-gray-800">
                                                Selesai
                                            </span>
                                        @endif
                                    @elseif($batch->status === 'selesai')
                                        <span class="px-2.5 py-1 inline-flex text-xs leading-4 font-semibold rounded-full bg-blue-100 text-blue-800">
                                            Selesai
                                        </span>
                                    @else
                                        <span class="px-2.5 py-1 inline-flex text-xs leading-4 font-semibold rounded-full bg-gray-100 text-gray-800">
                                            Nonaktif
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-xs text-gray-600">
                                    @if($batch->tanggal_mulai_pendaftaran && $batch->tanggal_selesai_pendaftaran)
                                        <div>{{ $batch->tanggal_mulai_pendaftaran->format('d M Y') }} &ndash;</div>
                                        <div class="font-medium text-gray-800">{{ $batch->tanggal_selesai_pendaftaran->format('d M Y') }}</div>
                                    @else
                                        -
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-xs">
                                    <div class="font-semibold text-gray-900">Rp {{ number_format($batch->harga, 0, ',', '.') }}</div>
                                    <div class="text-gray-400 mt-0.5">Kuota: {{ $batch->kuota }} orang</div>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    @if($batch->activity)
                                        <a href="{{ route('admin.activities.batches.edit', [$batch->activity, $batch]) }}"
                                            class="inline-flex items-center px-3 py-1.5 rounded-lg bg-gray-100 text-gray-700 hover:bg-gray-200 text-xs font-semibold transition">
                                            Edit Batch
                                        </a>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-8 text-center text-gray-400">
                                    Belum ada batch kegiatan yang terdaftar.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
@endsection
