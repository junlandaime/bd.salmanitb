@extends('layouts.app')
@section('title', $news->title . ' - Berita Bidang Dakwah Masjid Salman ITB')
@section('meta_description', Str::limit($news->excerpt, 160))
@section('og_title', $news->title . ' - Berita Bidang Dakwah Masjid Salman ITB')
@section('og_description', Str::limit($news->excerpt, 200))
@section('og_image', 'https://bidangdakwah.salmanitb.com/storage/' . $news->featured_image)

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
    <!-- News Header -->
    <header class="relative pt-16 pb-32 flex content-center items-center justify-center" style="min-height: 50vh;">
        <div class="absolute top-0 w-full h-full bg-center bg-cover"
            style='background-image: url("{{ Storage::url($news->featured_image) }}");'>
            <span class="w-full h-full absolute opacity-50 bg-black"></span>
        </div>
        <div class="container relative mx-auto px-4">
            <div class="items-center flex flex-wrap">
                <div class="w-full lg:w-8/12 px-4 ml-auto mr-auto text-center">
                    <div class="pr-12">
                        <div class="flex justify-center items-center space-x-4 mb-6">
                            <span class="px-3 py-1 rounded-full text-sm font-medium"
                                style="background-color: {{ $news->category->color }}20; color: {{ $news->category->color }}">
                                {{ $news->category->name }}
                            </span>
                            <span class="text-white">{{ $news->published_at->format('d F Y') }}</span>
                        </div>
                        <h1 class="text-white font-semibold text-5xl mb-6">
                            {{ $news->title }}
                        </h1>
                        <div class="space-y-4 flex flex-col items-center py-5">
                            <img src="{{ Storage::url($news->featured_image) }}" alt="{{ $news->title }}"
                                class="w-4/6 rounded-md">
                        </div>
                        <div class="flex items-center justify-center">
                            <img src="https://ui-avatars.com/api/?name={{ urlencode($news->author->name) }}"
                                class="w-12 h-12 rounded-full mr-4">
                            <div class="text-left">
                                <p class="text-white font-medium">{{ $news->author->name }}</p>
                                <p class="text-gray-300">{{ $news->author->title ?? 'Staff' }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- News Content -->
    <section class="py-20 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="flex flex-wrap justify-center">
                <!-- Main Content -->
                <div class="w-full lg:w-8/12">
                    <div class="bg-white rounded-lg shadow-lg p-8">
                        <!-- Event Details if applicable -->
                        @if ($news->event_date || $news->location)
                            <div class="flex flex-wrap gap-6 mb-8 p-6 bg-gray-50 rounded-lg">
                                @if ($news->event_date)
                                    <div class="flex items-center">
                                        <svg class="w-6 h-6 text-gray-500 mr-3" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                        <div>
                                            <p class="text-sm text-gray-500">Date & Time</p>
                                            <p class="font-medium">{{ $news->event_date->format('d F Y, H:i') }}</p>
                                        </div>
                                    </div>
                                @endif

                                @if ($news->location)
                                    <div class="flex items-center">
                                        <svg class="w-6 h-6 text-gray-500 mr-3" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                        <div>
                                            <p class="text-sm text-gray-500">Location</p>
                                            <p class="font-medium">{{ $news->location }}</p>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        @endif

                        <!-- News Body -->
                        <div class="prose max-w-none">
                            <p class="text-xl text-gray-600 mb-8">
                                {{ $news->excerpt }}
                            </p>

                            {!! $news->content !!}

                            <!-- Tags -->
                            @if ($news->tags->count() > 0)
                                <div class="flex flex-wrap gap-2 mb-8">
                                    @foreach ($news->tags as $tag)
                                        <span
                                            class="px-3 py-1 bg-gray-100 text-gray-600 rounded-full text-sm">#{{ $tag->name }}</span>
                                    @endforeach
                                </div>
                            @endif

                            <!-- Share Buttons -->
                            <div class="border-t pt-8">
                                <h3 class="text-lg font-bold mb-4">Share:</h3>
                                <div class="flex space-x-4">
                                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}"
                                        target="_blank"
                                        class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                                        Facebook
                                    </a>
                                    <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->url()) }}&text={{ urlencode($news->title) }}"
                                        target="_blank"
                                        class="px-4 py-2 bg-blue-400 text-white rounded-lg hover:bg-blue-500">
                                        Twitter
                                    </a>
                                    <a href="https://wa.me/?text={{ urlencode($news->title . ' ' . request()->url()) }}"
                                        target="_blank"
                                        class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">
                                        WhatsApp
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Author Bio -->
                    <div class="bg-white rounded-lg shadow-lg p-8 mt-8">
                        <div class="flex items-center">
                            <img src="https://ui-avatars.com/api/?name={{ urlencode($news->author->name) }}"
                                class="w-24 h-24 rounded-full mr-6">
                            <div>
                                <h3 class="text-xl font-bold mb-2">{{ $news->author->name }}</h3>
                                <p class="text-gray-600 mb-4">
                                    {{ $news->author->bio ?? 'Staff at Bidang Dakwah Salman ITB' }}
                                </p>
                                <div class="flex space-x-4">
                                    @if ($news->author->twitter)
                                        <a href="{{ $news->author->twitter }}"
                                            class="text-blue-500 hover:text-blue-600">Twitter</a>
                                    @endif
                                    @if ($news->author->linkedin)
                                        <a href="{{ $news->author->linkedin }}"
                                            class="text-blue-500 hover:text-blue-600">LinkedIn</a>
                                    @endif
                                    @if ($news->author->website)
                                        <a href="{{ $news->author->website }}"
                                            class="text-blue-500 hover:text-blue-600">Website</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Related News -->
                    @if ($relatedNews->count() > 0)
                        <div class="mt-12">
                            <h2 class="text-2xl font-bold mb-6">Related News</h2>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                @foreach ($relatedNews as $relatedItem)
                                    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                                        <img src="{{ Storage::url($relatedItem->featured_image) }}"
                                            alt="{{ $relatedItem->title }}" class="w-full h-48 object-cover">
                                        <div class="p-6">
                                            <div class="flex items-center mb-4">
                                                <span class="px-2.5 py-0.5 rounded text-xs font-medium"
                                                    style="background-color: {{ $relatedItem->category->color }}20; color: {{ $relatedItem->category->color }}">
                                                    {{ $relatedItem->category->name }}
                                                </span>
                                                <span
                                                    class="text-gray-500 text-sm ml-4">{{ $relatedItem->published_at->format('d F Y') }}</span>
                                            </div>
                                            <h3 class="text-xl font-bold mb-2">{{ $relatedItem->title }}</h3>
                                            <p class="text-gray-600 mb-4">{{ Str::limit($relatedItem->excerpt, 100) }}</p>
                                            <a href="{{ route('news.show', $relatedItem->slug) }}"
                                                class="text-green-500 hover:text-green-600">
                                                Read More →
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection
