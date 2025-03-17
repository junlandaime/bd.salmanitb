@extends('layouts.app')
@section('title', $article->title . ' - Artikel Bidang Dakwah Masjid Salman ITB')
@section('meta_description', Str::limit($article->excerpt, 160))
@section('og_title', $article->title . ' - Artikel Bidang Dakwah Masjid Salman ITB')
@section('og_description', Str::limit($article->excerpt, 200))
@section('og_image', 'https://bidangdakwah.salmanitb.com/storage/' . $article->featured_image)

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
    <article class="max-w-4xl mx-auto px-4 py-8">
        <div class="mb-8">
            @if ($article->featured_image)
                <img src="{{ Storage::url($article->featured_image) }}" alt="{{ $article->title }}"
                    class="w-full h-96 object-cover rounded-lg shadow-lg mb-8">
            @endif

            <h1 class="text-4xl font-bold text-gray-900 mb-4">{{ $article->title }}</h1>

            <div class="flex items-center space-x-4 text-sm text-gray-500 mb-4">
                <div class="flex items-center">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    {{ $article->reading_time }}
                </div>

                <div class="flex items-center">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                        </path>
                    </svg>
                    {{ $article->published_at->format('M d, Y') }}
                </div>

                <div class="flex items-center">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                    {{ $article->author->name }}
                </div>
            </div>

            <div class="flex flex-wrap gap-2 mb-6">
                <span class="px-3 py-1 text-sm font-medium rounded-full"
                    style="background-color: {{ $article->category->color }}20; color: {{ $article->category->color }}">
                    {{ $article->category->name }}
                </span>
                @foreach ($article->tags as $tag)
                    <span class="px-3 py-1 text-sm font-medium bg-gray-100 text-gray-800 rounded-full">
                        {{ $tag->name }}
                    </span>
                @endforeach
            </div>

            <div class="prose prose-lg max-w-none">
                {!! $article->content !!}
            </div>
        </div>

        @if ($relatedArticles->count() > 0)
            <div class="border-t border-gray-200 pt-8 mt-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Related Articles</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($relatedArticles as $relatedArticle)
                        <a href="{{ route('articles.show', $relatedArticle->slug) }}"
                            class="block bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">
                            @if ($relatedArticle->featured_image)
                                <img src="{{ Storage::url($relatedArticle->featured_image) }}"
                                    alt="{{ $relatedArticle->title }}" class="w-full h-48 object-cover">
                            @endif
                            <div class="p-4">
                                <h3 class="text-lg font-semibold text-gray-900 mb-2">{{ $relatedArticle->title }}</h3>
                                <p class="text-gray-600 text-sm mb-4">{{ Str::limit($relatedArticle->excerpt, 100) }}</p>
                                <div class="flex items-center text-sm text-gray-500">
                                    <span>{{ $relatedArticle->reading_time }}</span>
                                    <span class="mx-2">&bull;</span>
                                    <span>{{ $relatedArticle->published_at->format('M d, Y') }}</span>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        @endif
    </article>
@endsection
