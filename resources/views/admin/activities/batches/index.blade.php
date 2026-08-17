@extends('admin.layouts.app')

@section('content')
<div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
    
    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
        <div>
            <div class="flex items-center gap-2 text-xs text-gray-500 mb-1">
                <a href="{{ route('admin.activities.index') }}" class="hover:text-emerald-600">Kegiatan</a>
                <span>/</span>
                <span>{{ $activity->title }}</span>
            </div>
            <h1 class="text-2xl font-bold text-gray-900">Kelola Batch: {{ $activity->title }}</h1>
            <p class="text-sm text-gray-500 mt-0.5">Daftar periode pelaksanaan, tanggal pendaftaran, kuota, dan harga.</p>
        </div>
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.activities.show', $activity) }}" 
               class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl border border-gray-300 bg-white text-gray-700 font-semibold text-sm hover:bg-gray-50 shadow-sm transition">
                &larr; Detail Kegiatan
            </a>
            <a href="{{ route('admin.activities.batches.create', $activity) }}" 
               class="inline-flex items-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white px-4 py-2.5 rounded-xl font-semibold text-sm shadow-sm transition">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Tambah Batch Baru
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 px-4 py-3 rounded-xl mb-6 flex items-center justify-between shadow-sm" role="alert">
            <span class="text-sm font-medium">{{ session('success') }}</span>
            <button type="button" onclick="this.parentElement.remove()" class="text-emerald-500 hover:text-emerald-700">✕</button>
        </div>
    @endif

    <!-- Batches List -->
    <div class="bg-white rounded-2xl border border-gray-200/80 shadow-sm overflow-hidden">
        <ul class="divide-y divide-gray-100">
            @forelse($batches as $batch)
                <li class="p-6 hover:bg-gray-50/75 transition">
                    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
                        <div class="flex-1 min-w-0">
                            <div class="flex items-center gap-3">
                                <h3 class="text-lg font-bold text-gray-900 truncate">
                                    {{ $batch->nama_batch }}
                                </h3>
                                @if ($batch->status === 'aktif')
                                    @if ($batch->isRegistrationOpen())
                                        <span class="px-2.5 py-0.5 inline-flex text-xs font-semibold rounded-full bg-emerald-100 text-emerald-800">
                                            Aktif (Dibuka)
                                        </span>
                                    @elseif($batch->tanggal_mulai_pendaftaran && now()->lt($batch->tanggal_mulai_pendaftaran))
                                        <span class="px-2.5 py-0.5 inline-flex text-xs font-semibold rounded-full bg-amber-100 text-amber-800">
                                            Aktif (Akan Dibuka)
                                        </span>
                                    @else
                                        <span class="px-2.5 py-0.5 inline-flex text-xs font-semibold rounded-full bg-gray-100 text-gray-800">
                                            Selesai
                                        </span>
                                    @endif
                                @elseif($batch->status === 'selesai')
                                    <span class="px-2.5 py-0.5 inline-flex text-xs font-semibold rounded-full bg-blue-100 text-blue-800">
                                        Selesai
                                    </span>
                                @else
                                    <span class="px-2.5 py-0.5 inline-flex text-xs font-semibold rounded-full bg-gray-100 text-gray-800">
                                        Nonaktif
                                    </span>
                                @endif
                            </div>

                            <div class="mt-3 grid grid-cols-1 sm:grid-cols-3 gap-3 text-xs text-gray-600">
                                <div class="flex items-center gap-2">
                                    <span class="text-gray-400">👥 Kuota:</span>
                                    <strong class="text-gray-900">{{ $batch->kuota }} peserta</strong>
                                </div>
                                <div class="flex items-center gap-2">
                                    <span class="text-gray-400">🏷️ Harga:</span>
                                    <strong class="text-gray-900">Rp {{ number_format($batch->harga, 0, ',', '.') }}</strong>
                                </div>
                                <div class="flex items-center gap-2">
                                    <span class="text-gray-400">📅 Pendaftaran:</span>
                                    <span class="text-gray-800">{{ $batch->tanggal_mulai_pendaftaran ? $batch->tanggal_mulai_pendaftaran->format('d M Y') : '-' }} &ndash; {{ $batch->tanggal_selesai_pendaftaran ? $batch->tanggal_selesai_pendaftaran->format('d M Y') : '-' }}</span>
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center gap-2 shrink-0">
                            <a href="{{ route('admin.activities.batches.edit', [$activity, $batch]) }}" 
                               class="inline-flex items-center gap-1.5 px-3.5 py-2 rounded-xl bg-white border border-gray-200 text-gray-700 hover:bg-gray-50 font-semibold text-xs shadow-sm transition">
                                Edit Batch
                            </a>
                            <form action="{{ route('admin.activities.batches.destroy', [$activity, $batch]) }}" method="POST" class="inline-block"
                                  onsubmit="return confirm('Apakah Anda yakin ingin menghapus batch ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="p-2 text-red-400 hover:text-red-600 rounded-xl hover:bg-red-50 transition" title="Hapus Batch">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </div>
                </li>
            @empty
                <li class="p-12 text-center">
                    <p class="text-gray-400 text-sm">Belum ada batch untuk kegiatan ini.</p>
                </li>
            @endforelse
        </ul>
    </div>
</div>
@endsection
