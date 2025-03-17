@extends('layouts.app')
@section('title', 'Arikel Bidang Dakwah Masjid Salman ITB')

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
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        @if ($featuredArticle)
            <div class="mb-12">
                <a href="{{ route('articles.show', $featuredArticle->slug) }}"
                    class="block bg-white rounded-lg shadow-xl overflow-hidden hover:shadow-2xl transition-shadow duration-300">
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                        @if ($featuredArticle->featured_image)
                            <div class="relative h-96 lg:h-full">
                                <img src="{{ Storage::url($featuredArticle->featured_image) }}"
                                    alt="{{ $featuredArticle->title }}" class="absolute inset-0 w-full h-full object-cover">
                            </div>
                        @endif
                        <div class="p-8 flex flex-col justify-center">
                            <span
                                class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800 mb-4">
                                Featured Article
                            </span>
                            <h2 class="text-3xl font-bold text-gray-900 mb-4">{{ $featuredArticle->title }}</h2>
                            <p class="text-gray-600 mb-6">{{ $featuredArticle->excerpt }}</p>
                            <div class="flex items-center text-sm text-gray-500">
                                <span>{{ $featuredArticle->reading_time }}</span>
                                <span class="mx-2">&bull;</span>
                                <span>{{ $featuredArticle->published_at->format('M d, Y') }}</span>
                                <span class="mx-2">&bull;</span>
                                <span>{{ $featuredArticle->author->name }}</span>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        @endif

        <div class="mb-8">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold text-gray-900">Latest Articles</h2>
                <div class="flex space-x-4">
                    <select id="category-filter"
                        class="rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500">
                        <option value="">All Categories</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ request('category') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    <select id="tag-filter"
                        class="rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500">
                        <option value="">All Tags</option>
                        @foreach ($tags as $tag)
                            <option value="{{ $tag->id }}" {{ request('tag') == $tag->id ? 'selected' : '' }}>
                                {{ $tag->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach ($articles as $article)
                    <a href="{{ route('articles.show', $article->slug) }}"
                        class="block bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">
                        @if ($article->featured_image)
                            <div class="relative h-48">
                                <img src="{{ Storage::url($article->featured_image) }}" alt="{{ $article->title }}"
                                    class="absolute inset-0 w-full h-full object-cover">
                            </div>
                        @endif
                        <div class="p-6">
                            <div class="flex flex-wrap gap-2 mb-4">
                                <span class="px-2 py-1 text-xs font-medium rounded-full"
                                    style="background-color: {{ $article->category->color }}20; color: {{ $article->category->color }}">
                                    {{ $article->category->name }}
                                </span>
                                @foreach ($article->tags as $tag)
                                    <span class="px-2 py-1 text-xs font-medium bg-gray-100 text-gray-800 rounded-full">
                                        {{ $tag->name }}
                                    </span>
                                @endforeach
                            </div>
                            <h3 class="text-xl font-semibold text-gray-900 mb-2">{{ $article->title }}</h3>
                            <p class="text-gray-600 mb-4">{{ Str::limit($article->excerpt, 120) }}</p>
                            <div class="flex items-center text-sm text-gray-500">
                                <span>{{ $article->reading_time }}</span>
                                <span class="mx-2">&bull;</span>
                                <span>{{ $article->published_at->format('M d, Y') }}</span>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>

            <div class="mt-8">
                {{ $articles->links() }}
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            document.getElementById('category-filter').addEventListener('change', function() {
                updateFilters();
            });

            document.getElementById('tag-filter').addEventListener('change', function() {
                updateFilters();
            });

            function updateFilters() {
                const category = document.getElementById('category-filter').value;
                const tag = document.getElementById('tag-filter').value;

                let url = new URL(window.location.href);
                if (category) {
                    url.searchParams.set('category', category);
                } else {
                    url.searchParams.delete('category');
                }
                if (tag) {
                    url.searchParams.set('tag', tag);
                } else {
                    url.searchParams.delete('tag');
                }

                window.location.href = url.toString();
            }
        </script>
    @endpush
@endsection
