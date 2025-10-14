@extends('author.layouts.app')

@section('title', 'Ubah Berita')

@section('content')
    <div class="container mx-auto px-6 py-6">
        <div class="max-w-4xl mx-auto">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-semibold text-gray-700">Ubah Berita</h1>
                <a href="{{ route('author.news.index') }}" class="text-sm text-gray-600 hover:text-gray-900">Kembali ke
                    daftar</a>
            </div>

            <form action="{{ route('author.news.update', $news) }}" method="POST" enctype="multipart/form-data"
                class="bg-white shadow rounded-lg">
                @method('PUT')
                @include('author.news.form')

                <div class="px-6 py-4 border-t flex justify-end space-x-3 bg-gray-50">
                    <a href="{{ route('author.news.index') }}"
                        class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-gray-700 bg-gray-100 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                        Batal
                    </a>
                    <button type="submit"
                        class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Perbarui Berita
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
