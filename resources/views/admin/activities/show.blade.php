@extends('admin.layouts.app')

@section('content')
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
        
        <!-- Header -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
            <div>
                <div class="flex items-center gap-2 text-xs text-gray-500 mb-1">
                    <a href="{{ route('admin.activities.index') }}" class="hover:text-emerald-600">Kegiatan</a>
                    <span>/</span>
                    <span>Detail</span>
                </div>
                <h1 class="text-2xl font-bold text-gray-900">{{ $activity->title }}</h1>
                <p class="text-sm text-gray-500 mt-0.5">Detail informasi, kurikulum / learning path, dan manajemen batch kegiatan.</p>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('admin.activities.index') }}"
                    class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl border border-gray-300 bg-white text-gray-700 font-semibold text-sm hover:bg-gray-50 shadow-sm transition">
                    &larr; Kembali
                </a>
                <a href="{{ route('admin.activities.edit', $activity) }}"
                    class="inline-flex items-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white px-4 py-2.5 rounded-xl font-semibold text-sm shadow-sm transition">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                    </svg>
                    Edit Kegiatan
                </a>
            </div>
        </div>

        @if (session('success'))
            <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 px-4 py-3 rounded-xl mb-6 flex items-center justify-between shadow-sm" role="alert">
                <span class="text-sm font-medium">{{ session('success') }}</span>
                <button type="button" onclick="this.parentElement.remove()" class="text-emerald-500 hover:text-emerald-700">✕</button>
            </div>
        @endif

        <!-- Basic Information Card -->
        <div class="bg-white rounded-2xl border border-gray-200/80 shadow-sm p-6 mb-8">
            <div class="flex items-center justify-between pb-4 border-b border-gray-100 mb-6">
                <div>
                    <h2 class="text-base font-bold text-gray-900">Informasi Utama</h2>
                    <p class="text-xs text-gray-500 mt-0.5">Pengaturan judul, deskripsi, dan status publikasi</p>
                </div>
                <span class="px-2.5 py-0.5 text-xs font-semibold rounded-full {{ $activity->status === 'published' ? 'bg-emerald-100 text-emerald-800' : 'bg-amber-100 text-amber-800' }}">
                    {{ ucfirst($activity->status) }}
                </span>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="md:col-span-2 space-y-4">
                    <div>
                        <span class="text-xs font-semibold text-gray-400 uppercase">Judul Kegiatan</span>
                        <p class="text-base font-bold text-gray-900 mt-0.5">{{ $activity->title }}</p>
                    </div>
                    <div>
                        <span class="text-xs font-semibold text-gray-400 uppercase">Program Induk</span>
                        <p class="text-sm font-semibold text-emerald-700 mt-0.5">{{ $activity->program->title ?? 'Program BD' }}</p>
                    </div>
                    <div>
                        <span class="text-xs font-semibold text-gray-400 uppercase">Deskripsi</span>
                        <p class="text-sm text-gray-600 mt-0.5 leading-relaxed">{{ $activity->description }}</p>
                    </div>
                </div>
                <div>
                    <span class="text-xs font-semibold text-gray-400 uppercase block mb-1.5">Featured Image</span>
                    @if ($activity->featured_image)
                        <img src="{{ Storage::url($activity->featured_image) }}" alt="{{ $activity->title }}"
                            class="w-full h-40 object-cover rounded-xl border border-gray-200 shadow-sm">
                    @else
                        <div class="w-full h-40 rounded-xl bg-gray-50 border border-dashed border-gray-200 flex items-center justify-center text-gray-400 text-xs">
                            Tidak ada gambar unggulan
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Batch Kegiatan Card -->
        <div class="bg-white rounded-2xl border border-gray-200/80 shadow-sm overflow-hidden mb-8">
            <div class="p-6 border-b border-gray-100 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 bg-gray-50/50">
                <div>
                    <h2 class="text-base font-bold text-gray-900">Daftar Batch Pelaksanaan</h2>
                    <p class="text-xs text-gray-500 mt-0.5">Kelola kuota, tanggal pendaftaran, dan harga per batch</p>
                </div>
                <a href="{{ route('admin.activities.batches.create', $activity) }}"
                    class="inline-flex items-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white px-4 py-2 rounded-xl font-semibold text-xs shadow-sm transition">
                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Tambah Batch
                </a>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-500">
                    <thead class="text-xs text-gray-600 uppercase bg-gray-50 border-b border-gray-200">
                        <tr>
                            <th class="px-6 py-3.5">Nama Batch</th>
                            <th class="px-6 py-3.5">Status</th>
                            <th class="px-6 py-3.5">Kuota</th>
                            <th class="px-6 py-3.5">Harga</th>
                            <th class="px-6 py-3.5">Pendaftaran</th>
                            <th class="px-6 py-3.5">Pelaksanaan</th>
                            <th class="px-6 py-3.5 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse ($activity->batches as $batch)
                            <tr class="hover:bg-gray-50/75 transition">
                                <td class="px-6 py-4">
                                    <div class="font-bold text-gray-900">{{ $batch->nama_batch }}</div>
                                    <div class="text-xs text-gray-400 font-mono">Batch #{{ $batch->batch_ke }}</div>
                                </td>
                                <td class="px-6 py-4">
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
                                </td>
                                <td class="px-6 py-4 text-xs font-semibold text-gray-800">
                                    {{ $batch->kuota }} orang
                                </td>
                                <td class="px-6 py-4 text-xs font-bold text-gray-900">
                                    Rp {{ number_format($batch->harga, 0, ',', '.') }}
                                </td>
                                <td class="px-6 py-4 text-xs text-gray-600">
                                    <div>{{ $batch->tanggal_mulai_pendaftaran ? $batch->tanggal_mulai_pendaftaran->format('d M Y') : '-' }}</div>
                                    <div class="text-gray-400">s/d {{ $batch->tanggal_selesai_pendaftaran ? $batch->tanggal_selesai_pendaftaran->format('d M Y') : '-' }}</div>
                                </td>
                                <td class="px-6 py-4 text-xs text-gray-600">
                                    <div>{{ $batch->tanggal_mulai_kegiatan ? $batch->tanggal_mulai_kegiatan->format('d M Y') : '-' }}</div>
                                    <div class="text-gray-400">s/d {{ $batch->tanggal_selesai_kegiatan ? $batch->tanggal_selesai_kegiatan->format('d M Y') : '-' }}</div>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex items-center justify-end gap-1">
                                        <a href="{{ route('admin.activities.batches.edit', [$activity, $batch]) }}"
                                            class="inline-flex items-center px-3 py-1.5 rounded-lg bg-gray-100 text-gray-700 hover:bg-gray-200 text-xs font-semibold transition">
                                            Edit
                                        </a>
                                        <form action="{{ route('admin.activities.batches.destroy', [$activity, $batch]) }}" method="POST" class="inline-block"
                                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus batch ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="p-1.5 text-red-400 hover:text-red-600 rounded-lg hover:bg-red-50 transition" title="Hapus Batch">
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
                                <td colspan="7" class="px-6 py-8 text-center text-gray-400">Belum ada batch untuk kegiatan ini.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Learning Paths Card -->
        <div class="bg-white rounded-2xl border border-gray-200/80 shadow-sm p-6 mb-8">
            <div class="flex items-center justify-between pb-4 border-b border-gray-100 mb-6">
                <div>
                    <h2 class="text-base font-bold text-gray-900">Kurikulum &amp; Learning Paths ({{ $activity->learningPath->count() }})</h2>
                    <p class="text-xs text-gray-500 mt-0.5">Struktur silabus materi kegiatan</p>
                </div>
            </div>
            @if ($activity->learningPath->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @foreach ($activity->learningPath as $path)
                        <div class="p-4 bg-gray-50/80 rounded-xl border border-gray-100">
                            <h3 class="text-sm font-bold text-gray-900">{{ $path->title }}</h3>
                            <p class="text-xs text-gray-500 mt-1 leading-relaxed">{{ $path->description }}</p>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-xs text-gray-400 py-4 text-center">Belum ada learning paths.</p>
            @endif
        </div>

        <!-- FAQs & Highlights Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Highlights -->
            <div class="bg-white rounded-2xl border border-gray-200/80 shadow-sm p-6">
                <h3 class="font-bold text-gray-900 text-base pb-3 border-b border-gray-100 mb-4">Highlights Kegiatan</h3>
                @if ($activity->highlights->count() > 0)
                    <div class="space-y-3">
                        @foreach ($activity->highlights as $highlight)
                            <div class="p-3.5 bg-gray-50 rounded-xl">
                                <h4 class="text-xs font-bold text-gray-900">{{ $highlight->title }}</h4>
                                <p class="text-xs text-gray-500 mt-0.5">{{ $highlight->description }}</p>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-xs text-gray-400 py-4 text-center">Belum ada highlights.</p>
                @endif
            </div>

            <!-- FAQs -->
            <div class="bg-white rounded-2xl border border-gray-200/80 shadow-sm p-6">
                <h3 class="font-bold text-gray-900 text-base pb-3 border-b border-gray-100 mb-4">Pertanyaan Umum (FAQs)</h3>
                @if ($activity->faqs->count() > 0)
                    <div class="space-y-3">
                        @foreach ($activity->faqs as $faq)
                            <div class="p-3.5 bg-gray-50 rounded-xl">
                                <h4 class="text-xs font-bold text-gray-900">{{ $faq->question }}</h4>
                                <p class="text-xs text-gray-500 mt-0.5">{{ $faq->answer }}</p>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-xs text-gray-400 py-4 text-center">Belum ada FAQs.</p>
                @endif
            </div>
        </div>

    </div>
@endsection
