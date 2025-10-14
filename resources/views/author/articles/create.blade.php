@extends('author.layouts.app')

@section('title', 'Tulis Artikel')

@section('content')
    <div class="container mx-auto px-6 py-6">
        <div class="max-w-4xl mx-auto">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-semibold text-gray-700">Tulis Artikel Baru</h1>
                <a href="{{ route('author.articles.index') }}" class="text-sm text-gray-600 hover:text-gray-900">Kembali ke
                    daftar</a>
            </div>

            <form action="{{ route('author.articles.store') }}" method="POST" enctype="multipart/form-data"
                class="bg-white shadow rounded-lg">
                @include('author.articles.form')

                <div class="px-6 py-4 border-t flex justify-end space-x-3 bg-gray-50">
                    <a href="{{ route('author.articles.index') }}"
                        class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-gray-700 bg-gray-100 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                        Batal
                    </a>
                    <button type="submit"
                        class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                        Simpan Artikel
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
