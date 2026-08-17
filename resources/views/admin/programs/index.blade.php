@extends('admin.layouts.app')

@section('content')
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
        
        <!-- Header -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Program Bidang Dakwah</h1>
                <p class="text-sm text-gray-500 mt-1">Kelola pilar program dakwah, topik pembahasan, dan jadwal rutin.</p>
            </div>
            <a href="{{ route('admin.programs.create') }}"
                class="inline-flex items-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white px-4 py-2.5 rounded-xl font-semibold text-sm shadow-sm transition">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Tambah Program Baru
            </a>
        </div>

        @if (session('success'))
            <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 px-4 py-3 rounded-xl mb-6 flex items-center justify-between shadow-sm" role="alert">
                <span class="text-sm font-medium">{{ session('success') }}</span>
                <button type="button" onclick="this.parentElement.remove()" class="text-emerald-500 hover:text-emerald-700">✕</button>
            </div>
        @endif

        <!-- Program Cards Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
            @forelse ($programs as $program)
                <div class="bg-white rounded-2xl border border-gray-200/80 shadow-sm hover:shadow-md transition flex flex-col justify-between overflow-hidden">
                    <div class="p-6">
                        <div class="flex items-center justify-between gap-2 mb-3">
                            <span class="text-xs font-mono text-gray-400">#{{ $program->id }}</span>
                            <span class="px-2.5 py-0.5 text-xs font-semibold rounded-full 
                                @if ($program->status === 'published') bg-emerald-100 text-emerald-800
                                @elseif($program->status === 'draft') bg-amber-100 text-amber-800
                                @else bg-red-100 text-red-800 @endif">
                                {{ ucfirst($program->status) }}
                            </span>
                        </div>

                        <h3 class="text-lg font-bold text-gray-900 leading-snug">
                            {{ $program->title }}
                        </h3>

                        <p class="text-gray-500 text-sm mt-2 line-clamp-2 leading-relaxed">
                            {{ $program->description ?? 'Tidak ada deskripsi program.' }}
                        </p>

                        <div class="grid grid-cols-2 gap-2 mt-5 pt-4 border-t border-gray-100 text-xs text-gray-600">
                            <div class="bg-gray-50 rounded-lg p-2 text-center">
                                <span class="block font-bold text-gray-900 text-sm">{{ $program->topics->count() }}</span>
                                <span class="text-[11px] text-gray-500">Topik</span>
                            </div>
                            <div class="bg-gray-50 rounded-lg p-2 text-center">
                                <span class="block font-bold text-gray-900 text-sm">{{ $program->schedules->count() }}</span>
                                <span class="text-[11px] text-gray-500">Jadwal</span>
                            </div>
                        </div>
                    </div>

                    <div class="bg-gray-50/75 px-6 py-3.5 border-t border-gray-100 flex items-center justify-between gap-2">
                        <span class="text-xs text-gray-400 font-mono">slug: {{ $program->slug }}</span>
                        <div class="flex items-center gap-1">
                            <a href="{{ route('admin.programs.edit', $program) }}"
                                class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-white border border-gray-200 text-gray-700 hover:bg-gray-50 font-medium text-xs shadow-sm transition">
                                <span>Edit</span>
                            </a>
                            <form action="{{ route('admin.programs.destroy', $program) }}" method="POST" class="inline"
                                onsubmit="return confirm('Apakah Anda yakin ingin menghapus program ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-1.5 text-red-400 hover:text-red-600 rounded-lg hover:bg-red-50 transition" title="Hapus Program">
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
                    <p class="text-gray-500">Belum ada program yang ditambahkan.</p>
                </div>
            @endforelse
        </div>

        <div>
            {{ $programs->links() }}
        </div>
    </div>
@endsection
