@extends('layouts.app')
@section('title', 'Kegiatan Bidang Dakwah Masjid Salman ITB')

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
    <header class="relative pt-16 pb-32 flex content-center items-center justify-center" style="min-height: 50vh;">
        <div class="absolute top-0 w-full h-full bg-center bg-cover"
            style="background-image: url('{{ asset('images/activities-background.jpg') }}');">
            <span class="w-full h-full absolute opacity-50 bg-black"></span>
        </div>
        <div class="container relative mx-auto px-4">
            <div class="items-center flex flex-wrap">
                <div class="w-full lg:w-8/12 px-4 ml-auto mr-auto text-center">
                    <div class="pr-12">
                        <div class="flex justify-center items-center space-x-4 mb-6">
                            <span class="px-3 py-1 rounded-full text-sm font-medium"
                                style="background-color: #05966920; color: #059669">
                                Kegiatan
                            </span>
                            <span class="text-white">{{ date('d F Y') }}</span>
                        </div>
                        <!-- Animated Title -->
                        <div x-data="{ text: '', fullText: 'Kegiatan Kami', charIndex: 0 }" x-init="() => {
                            const interval = setInterval(() => {
                                if (charIndex <= fullText.length) {
                                    text = fullText.substring(0, charIndex);
                                    charIndex++;
                                } else {
                                    clearInterval(interval);
                                }
                            }, 100);
                        }">
                            <h1 class="text-white font-semibold text-5xl mb-6">
                                <span x-text="text"></span>
                                <span class="animate-pulse">|</span>
                            </h1>
                        </div>
                        <div class="flex items-center justify-center">
                            <p class="text-gray-200">
                                Temukan berbagai kegiatan menarik yang kami selenggarakan untuk pengembangan diri dan
                                kontribusi
                                positif bagi masyarakat.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Breadcrumb -->
    <div class="bg-white shadow-sm w-full top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <nav class="flex py-3 text-gray-700 text-sm">
                <ol class="inline-flex items-center space-x-1 md:space-x-3">
                    <li class="inline-flex items-center">
                        <a href="{{ route('home') }}" class="inline-flex items-center text-gray-600 hover:text-green-500">
                            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z">
                                </path>
                            </svg>
                            Home
                        </a>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            <span class="ml-1 text-green-500 font-medium md:ml-2">Kegiatan</span>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>
    </div>

    <!-- Activities Grid -->
    <section class="py-16 bg-gray-50 lg:px-32">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-green-600 to-emerald-500">
                    Eksplorasi Kegiatan
                </h2>
                <div class="h-1 w-20 bg-gradient-to-r from-green-600 to-emerald-500 mx-auto my-6"></div>
                <p class="max-w-2xl mx-auto text-lg text-gray-600">
                    Berbagai kegiatan untuk mengembangkan potensi dan memberikan dampak positif bagi masyarakat.
                </p>
            </div>

            <!-- Activities Filter (Optional) -->
            <div class="flex flex-wrap justify-center gap-3 mb-10">
                <a href="{{ route('activities.index') }}"
                    class="px-4 py-2 rounded-full bg-green-500 text-white hover:bg-green-600 transition">
                    Semua
                </a>
                @foreach ($programs ?? [] as $program)
                    <a href="{{ route('activities.index', ['program' => $program->slug]) }}"
                        class="px-4 py-2 rounded-full bg-white border border-gray-300 text-gray-700 hover:bg-gray-100 transition">
                        {{ $program->title }}
                    </a>
                @endforeach
            </div>

            <!-- Activities Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($activities as $activity)
                    <div
                        class="bg-white rounded-lg overflow-hidden shadow-lg transition-transform duration-300 hover:-translate-y-2 hover:shadow-xl">
                        <!-- Featured badge -->
                        @if ($activity->is_featured)
                            <div class="absolute top-4 left-4 z-10">
                                <span
                                    class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M5 2a1 1 0 011 1v1h1a1 1 0 010 2H6v1a1 1 0 01-2 0V6H3a1 1 0 010-2h1V3a1 1 0 011-1zm0 10a1 1 0 011 1v1h1a1 1 0 110 2H6v1a1 1 0 11-2 0v-1H3a1 1 0 110-2h1v-1a1 1 0 011-1zm7-10a1 1 0 01.707.293l.707.707L15.414 4a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-2-2A1 1 0 0110 5.414l.293.293a1 1 0 001.414 0l.293-.293A1 1 0 0112 5z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                    Unggulan
                                </span>
                            </div>
                        @endif

                        <!-- Activity Image -->
                        <div class="relative">
                            <img src="{{ Storage::url($activity->featured_image) }}" alt="{{ $activity->title }}"
                                class="w-full h-56 object-cover">
                            <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black to-transparent h-20">
                            </div>
                        </div>

                        <!-- Activity Content -->
                        <div class="p-6">
                            <!-- Program Badge -->
                            <div class="mb-3">
                                <span class="px-3 py-1 text-xs font-semibold bg-gray-100 text-gray-800 rounded-full">
                                    {{ $activity->program->title }}
                                </span>
                            </div>

                            <!-- Activity Title -->
                            <h3 class="text-xl font-bold text-gray-900 mb-3 line-clamp-2">{{ $activity->title }}</h3>

                            <!-- Activity Overview -->
                            <p class="text-gray-600 mb-4 line-clamp-3">{{ $activity->overview }}</p>

                            <!-- Activity Highlights -->
                            @if ($activity->highlights->isNotEmpty())
                                <div class="mb-4">
                                    <div class="flex flex-wrap gap-2">
                                        @foreach ($activity->highlights->take(3) as $highlight)
                                            <span class="text-xs px-2 py-1 bg-green-50 text-green-700 rounded">
                                                {{ $highlight->title }}
                                            </span>
                                        @endforeach
                                    </div>
                                </div>
                            @endif

                            <!-- Registration Status -->
                            <div class="flex justify-between items-center mt-6">
                                <div>
                                    @php
                                        $activeBatch = $activity->getActiveBatch();
                                        $upcomingBatches = $activity->getUpcomingBatches();
                                    @endphp

                                    @if ($activeBatch)
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            Pendaftaran Dibuka
                                        </span>
                                    @elseif($upcomingBatches->isNotEmpty())
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                            Pendaftaran Akan Dibuka
                                        </span>
                                    @else
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                            Pendaftaran Ditutup
                                        </span>
                                    @endif
                                </div>

                                <a href="{{ route('activities.show', $activity->slug) }}"
                                    class="text-green-600 hover:text-green-800 font-medium flex items-center">
                                    Detail
                                    <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full py-12 text-center">
                        <svg class="w-16 h-16 mx-auto text-gray-400" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                            </path>
                        </svg>
                        <h3 class="mt-4 text-lg font-medium text-gray-900">Tidak Ada Kegiatan</h3>
                        <p class="mt-2 text-gray-600">Saat ini belum ada kegiatan yang tersedia.</p>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            <div class="mt-12">
                {{ $activities->links() }}
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="bg-gradient-to-r from-green-600 to-emerald-500 py-16">
        <div class="container mx-auto px-4 text-center">
            <h2 class="text-3xl font-bold text-white mb-6">Ingin Tahu Lebih Banyak?</h2>
            <p class="text-white text-lg mb-8 max-w-2xl mx-auto">
                Kami memiliki berbagai program dan kegiatan yang dirancang untuk mengembangkan potensi dan memberikan dampak
                positif.
            </p>
            <div class="flex justify-center space-x-4">
                <a href="{{ route('programs.index') }}"
                    class="px-6 py-3 bg-white text-green-600 rounded-lg font-semibold hover:bg-gray-100 transition">
                    Lihat Program Kami
                </a>
                <a href="{{ route('contact') }}"
                    class="px-6 py-3 bg-transparent border-2 border-white text-white rounded-lg font-semibold hover:bg-white hover:bg-opacity-20 transition">
                    Hubungi Kami
                </a>
            </div>
        </div>
    </section>
@endsection
