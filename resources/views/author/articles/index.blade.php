@extends('author.layouts.app')

@section('title', 'Artikel Saya - Panel Penulis')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 space-y-6">

    <!-- Header & Action -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <div class="flex items-center gap-2 text-xs text-gray-500 mb-1">
                <a href="{{ route('author.dashboard') }}" class="hover:text-emerald-700">Dashboard</a>
                <span>/</span>
                <span>Artikel Saya</span>
            </div>
            <h1 class="text-2xl font-bold text-gray-900">Artikel Saya</h1>
            <p class="text-xs sm:text-sm text-gray-500 mt-0.5">Kelola seluruh tulisan, draft, dan artikel dakwah yang telah Anda publikasikan.</p>
        </div>
        <a href="{{ route('author.articles.create') }}"
            class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs shadow-sm transition self-start sm:self-auto">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            <span>Tulis Artikel Baru</span>
        </a>
    </div>

    <!-- Table Card -->
    <div class="bg-white rounded-3xl border border-gray-200/80 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead>
                    <tr class="text-[11px] font-bold uppercase tracking-wider text-gray-500 bg-gray-50/80 border-b border-gray-200">
                        <th class="px-6 py-3.5">Artikel</th>
                        <th class="px-6 py-3.5">Kategori</th>
                        <th class="px-6 py-3.5">Status</th>
                        <th class="px-6 py-3.5 text-center">Featured</th>
                        <th class="px-6 py-3.5 text-center">Durasi</th>
                        <th class="px-6 py-3.5">Tanggal Terbit</th>
                        <th class="px-6 py-3.5 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse ($articles as $article)
                        <tr class="hover:bg-gray-50/75 transition {{ $article->is_featured ? 'bg-emerald-50/20' : '' }}">
                            <!-- Judul & Gambar -->
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3.5">
                                    <div class="relative w-12 h-12 rounded-xl overflow-hidden bg-gray-100 shrink-0 border border-gray-200">
                                        @if($article->featured_image)
                                            <img class="object-cover w-full h-full"
                                                src="{{ Storage::url($article->featured_image) }}"
                                                alt="{{ $article->title }}" loading="lazy" />
                                        @else
                                            <div class="w-full h-full flex items-center justify-center text-gray-400 text-xs">
                                                📄
                                            </div>
                                        @endif
                                    </div>
                                    <div class="min-w-0 max-w-sm">
                                        <div class="flex items-center gap-1.5">
                                            <h3 class="font-bold text-xs sm:text-sm text-gray-900 truncate">
                                                {{ $article->title }}
                                            </h3>
                                            @if ($article->is_featured)
                                                <span class="text-amber-500 shrink-0" title="Artikel Unggulan">★</span>
                                            @endif
                                        </div>
                                        <p class="text-[11px] text-gray-500 truncate mt-0.5">{{ $article->excerpt ?? 'Tanpa ringkasan' }}</p>
                                    </div>
                                </div>
                            </td>

                            <!-- Kategori -->
                            <td class="px-6 py-4">
                                <span class="px-2.5 py-1 text-[11px] font-bold rounded-full border"
                                    style="background-color: {{ $article->category->color ?? '#10b981' }}15; color: {{ $article->category->color ?? '#10b981' }}; border-color: {{ $article->category->color ?? '#10b981' }}40;">
                                    {{ $article->category->name ?? 'Umum' }}
                                </span>
                            </td>

                            <!-- Status -->
                            <td class="px-6 py-4">
                                @if($article->status === 'published')
                                    <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-xs font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                        Terbit
                                    </span>
                                @elseif($article->status === 'draft')
                                    <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-xs font-bold bg-amber-50 text-amber-700 border border-amber-200">
                                        <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                                        Draft
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-xs font-bold bg-gray-100 text-gray-700 border border-gray-200">
                                        Arsip
                                    </span>
                                @endif
                            </td>

                            <!-- Featured -->
                            <td class="px-6 py-4 text-center">
                                @if ($article->is_featured)
                                    <span class="inline-flex items-center px-2 py-0.5 text-[10px] font-bold text-amber-800 bg-amber-100 rounded-md border border-amber-200">
                                        Ya
                                    </span>
                                @else
                                    <span class="text-xs text-gray-300">-</span>
                                @endif
                            </td>

                            <!-- Durasi Baca -->
                            <td class="px-6 py-4 text-center">
                                <span class="text-xs text-gray-600 font-mono">
                                    {{ $article->reading_time ?? '3 min' }}
                                </span>
                            </td>

                            <!-- Tanggal Terbit -->
                            <td class="px-6 py-4 text-xs text-gray-600">
                                @if ($article->published_at)
                                    <span class="font-semibold block text-gray-900">{{ $article->published_at->translatedFormat('d M Y') }}</span>
                                    <span class="text-[10px] text-gray-400 font-mono">{{ $article->published_at->format('H:i') }} WIB</span>
                                @else
                                    <span class="text-gray-400 italic">Belum terbit</span>
                                @endif
                            </td>

                            <!-- Aksi -->
                            <td class="px-6 py-4 text-right">
                                <div class="flex items-center justify-end gap-1">
                                    @if ($article->status === 'published')
                                        <a href="{{ route('articles.show', $article->slug) }}" target="_blank"
                                            class="p-2 text-gray-400 hover:text-emerald-700 rounded-xl hover:bg-emerald-50 transition" title="Lihat di Web">
                                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                            </svg>
                                        </a>
                                    @endif
                                    <a href="{{ route('author.articles.edit', $article) }}"
                                        class="p-2 text-gray-400 hover:text-gray-900 rounded-xl hover:bg-gray-100 transition" title="Edit Artikel">
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                    </a>
                                    <form action="{{ route('author.articles.destroy', $article) }}" method="POST" class="inline"
                                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus artikel ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="p-2 text-red-400 hover:text-red-700 rounded-xl hover:bg-red-50 transition" title="Hapus Artikel">
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
                            <td colspan="7" class="px-6 py-12 text-center text-gray-500">
                                <div class="w-16 h-16 rounded-2xl bg-gray-50 text-gray-400 flex items-center justify-center mx-auto text-2xl mb-3 border border-gray-200">
                                    📄
                                </div>
                                <h4 class="text-sm font-bold text-gray-700">Belum Ada Artikel</h4>
                                <p class="text-xs text-gray-400 mt-1">Anda belum memiliki artikel. Mulailah dengan menulis artikel pertama Anda!</p>
                                <a href="{{ route('author.articles.create') }}" class="inline-block mt-4 px-5 py-2 bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs rounded-xl shadow-xs transition">
                                    Tulis Artikel Sekarang
                                </a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($articles->hasPages())
            <div class="px-6 py-4 border-t border-gray-100 bg-gray-50/50">
                {{ $articles->links() }}
            </div>
        @endif
    </div>

</div>
@endsection
