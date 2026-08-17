@extends('admin.layouts.app')

@section('content')
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8 max-w-4xl">
        <!-- Header -->
        <div class="flex items-center justify-between mb-8">
            <div>
                <div class="flex items-center gap-2 text-xs text-gray-500 mb-1">
                    <a href="{{ route('admin.articles.index') }}" class="hover:text-emerald-600">Artikel</a>
                    <span>/</span>
                    <span>Tulis Baru</span>
                </div>
                <h1 class="text-2xl font-bold text-gray-900">Tulis Artikel Baru</h1>
                <p class="text-sm text-gray-500 mt-0.5">Publikasikan tulisan dakwah, opini, atau materi edukasi keluarga.</p>
            </div>
            <a href="{{ route('admin.articles.index') }}"
                class="px-4 py-2.5 rounded-xl border border-gray-300 bg-white text-gray-700 hover:bg-gray-50 font-semibold text-sm shadow-sm transition">
                &larr; Kembali
            </a>
        </div>

        <form action="{{ route('admin.articles.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @include('admin.articles.form')

            <div class="flex items-center justify-end gap-3">
                <a href="{{ route('admin.articles.index') }}"
                    class="px-5 py-2.5 rounded-xl border border-gray-300 bg-white text-gray-700 hover:bg-gray-50 font-semibold text-sm shadow-sm transition">
                    Batal
                </a>
                <button type="submit"
                    class="px-6 py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-semibold text-sm shadow-sm transition">
                    Simpan Artikel
                </button>
            </div>
        </form>
    </div>
@endsection
