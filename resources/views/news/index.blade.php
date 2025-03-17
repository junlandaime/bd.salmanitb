@extends('layouts.app')
@section('title', 'Berita Bidang Dakwah Masjid Salman ITB')

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
    <!-- Hero Section -->
    <div class="relative pt-16 pb-32 flex content-center items-center justify-center" style="min-height: 75vh;">
        <div class="absolute top-0 w-full h-full bg-center bg-cover"
            style='background-image: url("{{ Storage::url($featuredNews->featured_image ?? 'news/default.jpg') }}");'>
            <span id="blackOverlay" class="w-full h-full absolute opacity-50 bg-black"></span>
        </div>
        <div class="container relative mx-auto">
            <div class="items-center flex flex-wrap">
                <div class="w-full lg:w-6/12 px-4 ml-auto mr-auto text-center">
                    @if ($featuredNews)
                        <div class="flex justify-center mb-4">
                            <span class="px-3 py-1 text-sm font-medium rounded-full"
                                style="background-color: {{ $featuredNews->category->color }}20; color: {{ $featuredNews->category->color }}">
                                {{ $featuredNews->category->name }}
                            </span>
                        </div>
                        <h1 class="text-white font-semibold text-5xl mb-4">
                            {{ $featuredNews->title }}
                        </h1>
                        <p class="mt-4 text-lg text-gray-300">
                            {{ $featuredNews->excerpt }}
                        </p>
                        <a href="{{ route('news.show', $featuredNews->slug) }}"
                            class="mt-8 inline-block px-6 py-3 bg-green-600 text-white font-medium rounded-lg hover:bg-green-700 transition-colors">
                            Read More
                        </a>
                    @else
                        <h1 class="text-white font-semibold text-5xl">
                            News & Events
                        </h1>
                    @endif
                </div>
            </div>
        </div>
    </div>



    <!-- News Section -->
    <section class="pb-20 bg-gray-50 -mt-24">
        <div class="container mx-auto px-4">
            <!-- Search and Filter -->
            <div class="flex flex-wrap">
                <div class="w-full md:w-8/12 px-4 mx-auto">
                    <div class="relative flex flex-col min-w-0 break-words bg-white w-full mb-8 shadow-lg rounded-lg">
                        <div class="px-6 py-6">
                            <form action="{{ route('news.index') }}" method="GET" class="flex flex-wrap gap-4">
                                <div class="flex-1">
                                    <input type="text" name="search" placeholder="Search news..."
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500"
                                        value="{{ request('search') }}">
                                </div>
                                <div class="w-full md:w-auto">
                                    <select name="category"
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500">
                                        <option value="">All Categories</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->slug }}" @selected(request('category') == $category->slug)>
                                                {{ $category->name }} ({{ $category->news_count }})
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <button type="submit"
                                    class="px-6 py-2 bg-green-600 text-white font-medium rounded-lg hover:bg-green-700 transition-colors">
                                    Filter
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- News Grid -->
            <div class="flex flex-wrap">
                @foreach ($news as $item)
                    <div class="w-full md:w-4/12 px-4 mb-8">
                        <div class="relative flex flex-col min-w-0 break-words bg-white w-full shadow-lg rounded-lg">
                            <img alt="{{ $item->title }}" src="{{ Storage::url($item->featured_image) }}"
                                class="w-full h-48 object-cover rounded-t-lg">
                            <div class="px-6 py-6">
                                <div class="flex items-center mb-4">
                                    <span class="px-2.5 py-0.5 rounded text-xs font-medium"
                                        style="background-color: {{ $item->category->color }}20; color: {{ $item->category->color }}">
                                        {{ $item->category->name }}
                                    </span>
                                    <span
                                        class="text-gray-500 text-sm ml-4">{{ $item->published_at->format('d F Y') }}</span>
                                </div>
                                <h4 class="text-xl font-bold mb-2">{{ $item->title }}</h4>
                                <p class="text-gray-600 mb-4">{{ Str::limit($item->excerpt, 100) }}</p>
                                @if ($item->event_date)
                                    <div class="flex items-center text-gray-500 text-sm mb-4">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                        {{ $item->event_date->format('d F Y, H:i') }}
                                    </div>
                                @endif
                                @if ($item->location)
                                    <div class="flex items-center text-gray-500 text-sm mb-4">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                        {{ $item->location }}
                                    </div>
                                @endif
                                <a href="{{ route('news.show', $item->slug) }}"
                                    class="text-green-600 hover:text-green-700 font-medium">
                                    Read More →
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="flex justify-center mt-8">
                {{ $news->links() }}
            </div>
        </div>
    </section>
@endsection
