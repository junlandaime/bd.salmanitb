@extends('author.layouts.app')

@section('title', 'Dashboard Penulis')
<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-WE2HFGE5VL"></script>
<script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
        dataLayer.push(arguments);
    }
    gtag('js', new Date());

    gtag('config', 'G-WE2HFGE5VL');
</script>

@section('content')
    <div class="container px-6 mx-auto py-6">
        <h1 class="text-2xl font-semibold text-gray-700 mb-6">Selamat datang, {{ Auth::user()->name }}</h1>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="bg-white shadow rounded-lg p-6">
                <h2 class="text-lg font-medium text-gray-600 mb-2">Artikel</h2>
                <p class="text-3xl font-bold text-gray-900">{{ $articleCount }}</p>
                <p class="text-sm text-gray-500 mt-1">{{ $publishedArticleCount }} artikel sudah terbit</p>
                <a href="{{ route('author.articles.create') }}"
                    class="mt-4 inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-green-600 hover:bg-green-700 rounded-md">
                    Tulis Artikel Baru
                </a>
            </div>
            <div class="bg-white shadow rounded-lg p-6">
                <h2 class="text-lg font-medium text-gray-600 mb-2">Berita</h2>
                <p class="text-3xl font-bold text-gray-900">{{ $newsCount }}</p>
                <p class="text-sm text-gray-500 mt-1">{{ $publishedNewsCount }} berita sudah terbit</p>
                <a href="{{ route('author.news.create') }}"
                    class="mt-4 inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 rounded-md">
                    Tulis Berita Baru
                </a>
            </div>
        </div>
    </div>
@endsection
