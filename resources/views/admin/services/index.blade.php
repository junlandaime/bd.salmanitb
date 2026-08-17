@extends('admin.layouts.app')

@section('content')
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
        
        <!-- Header -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Daftar Layanan Dakwah</h1>
                <p class="text-sm text-gray-500 mt-1">Kelola portofolio unit layanan, konsultasi, dan fasilitas Bidang Dakwah Masjid Salman ITB.</p>
            </div>
            <a href="{{ route('admin.services.create') }}"
                class="inline-flex items-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white px-4 py-2.5 rounded-xl font-semibold text-sm shadow-sm transition">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Tambah Layanan Baru
            </a>
        </div>

        @if (session('success'))
            <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 px-4 py-3 rounded-xl mb-6 flex items-center justify-between shadow-sm" role="alert">
                <span class="text-sm font-medium">{{ session('success') }}</span>
                <button type="button" onclick="this.parentElement.remove()" class="text-emerald-500 hover:text-emerald-700">✕</button>
            </div>
        @endif

        <!-- Services Cards Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
            @forelse ($services as $service)
                <div class="bg-white rounded-2xl border border-gray-200/80 shadow-sm hover:shadow-md transition flex flex-col justify-between overflow-hidden">
                    <div class="p-6">
                        <div class="flex items-center justify-between gap-2 mb-3">
                            <span class="px-2.5 py-1 text-xs font-semibold rounded-full bg-emerald-50 text-emerald-700 border border-emerald-100">
                                {{ $service->program->title ?? 'Program BD' }}
                            </span>
                            <span class="px-2.5 py-0.5 text-xs font-semibold rounded-full {{ $service->is_active ? 'bg-emerald-100 text-emerald-800' : 'bg-gray-100 text-gray-600' }}">
                                {{ $service->is_active ? 'Aktif' : 'Nonaktif' }}
                            </span>
                        </div>

                        <div class="flex items-start gap-3 mt-4">
                            @if ($service->image)
                                <img src="{{ Storage::url($service->image) }}" alt="{{ $service->title }}"
                                    class="h-12 w-12 rounded-xl object-cover border border-gray-200 shrink-0">
                            @else
                                <div class="h-12 w-12 rounded-xl bg-gray-100 text-gray-400 flex items-center justify-center text-lg shrink-0">
                                    🤝
                                </div>
                            @endif
                            <div class="min-w-0">
                                <h3 class="text-base font-bold text-gray-900 leading-snug">{{ $service->title }}</h3>
                                <p class="text-xs text-gray-400 mt-1">Urutan: #{{ $service->order }}</p>
                            </div>
                        </div>

                        <p class="text-gray-500 text-sm mt-4 line-clamp-3 leading-relaxed">
                            {{ $service->description }}
                        </p>
                    </div>

                    <div class="bg-gray-50/75 px-6 py-3.5 border-t border-gray-100 flex items-center justify-end gap-2">
                        <a href="{{ route('admin.services.edit', $service) }}"
                            class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-white border border-gray-200 text-gray-700 hover:bg-gray-50 font-medium text-xs shadow-sm transition">
                            <span>Edit</span>
                        </a>
                        <form action="{{ route('admin.services.destroy', $service) }}" method="POST" class="inline"
                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus layanan ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="p-1.5 text-red-400 hover:text-red-600 rounded-lg hover:bg-red-50 transition" title="Hapus Layanan">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="col-span-3 text-center py-12 bg-white rounded-2xl border border-gray-200">
                    <p class="text-gray-500">Belum ada layanan yang ditambahkan.</p>
                </div>
            @endforelse
        </div>

    </div>
@endsection
