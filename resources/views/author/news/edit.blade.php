@extends('author.layouts.app')

@section('title', 'Ubah Berita - Panel Penulis')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-6 space-y-6">
    
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <div class="flex items-center gap-2 text-xs text-gray-500 mb-1">
                <a href="{{ route('author.news.index') }}" class="hover:text-blue-700">Berita Saya</a>
                <span>/</span>
                <span>Ubah</span>
            </div>
            <h1 class="text-2xl font-bold text-gray-900">Ubah Berita</h1>
            <p class="text-xs sm:text-sm text-gray-500 mt-0.5">Perbarui isi liputan, lokasi, tanggal acara, atau gambar berita.</p>
        </div>
        <a href="{{ route('author.news.index') }}"
            class="px-4 py-2 rounded-xl border border-gray-300 bg-white text-gray-700 hover:bg-gray-50 font-bold text-xs shadow-2xs transition">
            &larr; Kembali
        </a>
    </div>

    <form action="{{ route('author.news.update', $news) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @method('PUT')
        @include('author.news.form')

        <div class="flex items-center justify-end gap-3 pt-4 border-t border-gray-200">
            <a href="{{ route('author.news.index') }}"
                class="px-5 py-2.5 rounded-xl border border-gray-300 bg-white text-gray-700 hover:bg-gray-50 font-semibold text-xs transition shadow-2xs">
                Batal
            </a>
            <button type="submit"
                class="px-6 py-2.5 rounded-xl bg-blue-600 hover:bg-blue-700 text-white font-bold text-xs shadow-sm transition">
                Perbarui Berita
            </button>
        </div>
    </form>

</div>
@endsection
