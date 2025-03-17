@extends('layouts.app')

@section('title', $material->title)
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
    <main class="mt-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <!-- Breadcrumb -->
            <nav class="mb-5">
                <ol class="flex text-sm text-gray-500">
                    <li><a href="{{ route('alumni.dashboard') }}" class="text-green-600 hover:text-green-700">Dashboard
                            Alumni</a></li>
                    <li class="mx-2">/</li>
                    <li><a href="{{ route('alumni.batch.materials', $batch->id) }}"
                            class="text-green-600 hover:text-green-700">Materi {{ $batch->nama_batch }}</a></li>
                    <li class="mx-2">/</li>
                    <li class="text-gray-700 font-medium">{{ $material->title }}</li>
                </ol>
            </nav>

            <h1 class="text-3xl font-bold text-gray-900 mb-1">{{ $material->title }}</h1>
            <p class="text-gray-500 mb-8">{{ $batch->activity->title }} - {{ $batch->nama_batch }}</p>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="md:col-span-2">
                    <!-- Video Section -->
                    @if ($material->video_url)
                        <div class="bg-white rounded-lg shadow-lg overflow-hidden mb-8">
                            <div class="p-4 border-b border-gray-100">
                                <h2 class="text-xl font-bold text-gray-900">Video Rekaman</h2>
                            </div>
                            <div class="p-4">
                                <div class="aspect-w-16 aspect-h-9 rounded-md overflow-hidden">
                                    @php
                                        // Extract YouTube video ID if it's a YouTube URL
$videoId = null;
if (strpos($material->video_url, 'youtube.com') !== false) {
    parse_str(parse_url($material->video_url, PHP_URL_QUERY), $params);
    $videoId = $params['v'] ?? null;
} elseif (strpos($material->video_url, 'youtu.be') !== false) {
                                            $videoId = substr(parse_url($material->video_url, PHP_URL_PATH), 1);
                                        }
                                    @endphp

                                    @if ($videoId)
                                        <iframe class="w-full h-full"
                                            src="https://www.youtube.com/embed/{{ $videoId }}" frameborder="0"
                                            allowfullscreen></iframe>
                                    @else
                                        <div class="flex flex-col items-center justify-center py-12 text-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-gray-300 mb-4"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14v-4z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M5 10l4.553-2.276A1 1 0 0110 8.618v6.764a1 1 0 01-1.447.894L5 14v-4z" />
                                            </svg>
                                            <h3 class="text-lg font-medium text-gray-900 mb-2">Video tidak dapat ditampilkan
                                            </h3>
                                            <p class="text-gray-500 mb-4">URL video tidak valid atau tidak didukung untuk
                                                ditampilkan langsung.</p>
                                            <a href="{{ $material->video_url }}"
                                                class="inline-flex items-center px-4 py-2 border border-transparent text-base font-medium rounded-md text-white bg-green-600 hover:bg-green-700"
                                                target="_blank">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                                </svg>
                                                Buka Video di Tab Baru
                                            </a>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Description Section -->
                    @if ($material->description)
                        <div class="bg-white rounded-lg shadow-lg overflow-hidden mb-8">
                            <div class="p-4 border-b border-gray-100">
                                <h2 class="text-xl font-bold text-gray-900">Deskripsi</h2>
                            </div>
                            <div class="p-4">
                                <p class="text-gray-600">{{ $material->description }}</p>
                            </div>
                        </div>
                    @endif
                </div>

                <div class="md:col-span-1">
                    <!-- Download Materials Section -->
                    <div class="bg-white rounded-lg shadow-lg overflow-hidden mb-8">
                        <div class="p-4 border-b border-gray-100">
                            <h2 class="text-xl font-bold text-gray-900">Materi Tersedia</h2>
                        </div>
                        <div class="p-4">
                            <div class="space-y-2">
                                @if ($material->slide_url)
                                    <a href="{{ $material->slide_url }}"
                                        class="flex items-center justify-between p-3 rounded-md bg-gray-50 hover:bg-gray-100 transition duration-200"
                                        target="_blank">
                                        <div class="flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-500 mr-3"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                            </svg>
                                            <span class="text-gray-700">Slide Presentasi</span>
                                        </div>
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                        </svg>
                                    </a>
                                @endif

                                @if ($material->notes_url)
                                    <a href="{{ $material->notes_url }}"
                                        class="flex items-center justify-between p-3 rounded-md bg-gray-50 hover:bg-gray-100 transition duration-200"
                                        target="_blank">
                                        <div class="flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-500 mr-3"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                            </svg>
                                            <span class="text-gray-700">Notulensi / Catatan</span>
                                        </div>
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                        </svg>
                                    </a>
                                @endif

                                @if ($material->video_url)
                                    <a href="{{ $material->video_url }}"
                                        class="flex items-center justify-between p-3 rounded-md bg-gray-50 hover:bg-gray-100 transition duration-200"
                                        target="_blank">
                                        <div class="flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-500 mr-3"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14v-4z" />
                                            </svg>
                                            <span class="text-gray-700">Link Video</span>
                                        </div>
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                        </svg>
                                    </a>
                                @endif

                                @if (!$material->slide_url && !$material->notes_url && !$material->video_url)
                                    <div
                                        class="flex flex-col items-center justify-center py-8 text-center bg-gray-50 rounded-md">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-gray-300 mb-2"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                        </svg>
                                        <p class="text-gray-500">Tidak ada materi yang tersedia untuk diunduh.</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Navigation Section -->
                    <div class="bg-white rounded-lg shadow-lg overflow-hidden mb-8">
                        <div class="p-4 border-b border-gray-100">
                            <h2 class="text-xl font-bold text-gray-900">Navigasi Materi</h2>
                        </div>
                        <div class="p-4">
                            <div class="flex justify-between mb-4">
                                @php
                                    $currentIndex = $batch->materials->search(function ($item) use ($material) {
                                        return $item->id === $material->id;
                                    });

                                    $prevMaterial = $currentIndex > 0 ? $batch->materials[$currentIndex - 1] : null;
                                    $nextMaterial =
                                        $currentIndex < $batch->materials->count() - 1
                                            ? $batch->materials[$currentIndex + 1]
                                            : null;
                                @endphp

                                @if ($prevMaterial)
                                    <a href="{{ route('alumni.material.view', ['batchId' => $batch->id, 'materialId' => $prevMaterial->id]) }}"
                                        class="inline-flex items-center px-3 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 19l-7-7 7-7" />
                                        </svg>
                                        Sebelumnya
                                    </a>
                                @else
                                    <button disabled
                                        class="inline-flex items-center px-3 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-400 bg-gray-100 cursor-not-allowed">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 19l-7-7 7-7" />
                                        </svg>
                                        Sebelumnya
                                    </button>
                                @endif

                                @if ($nextMaterial)
                                    <a href="{{ route('alumni.material.view', ['batchId' => $batch->id, 'materialId' => $nextMaterial->id]) }}"
                                        class="inline-flex items-center px-3 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none">
                                        Selanjutnya
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-1" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 5l7 7-7 7" />
                                        </svg>
                                    </a>
                                @else
                                    <button disabled
                                        class="inline-flex items-center px-3 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-400 bg-gray-100 cursor-not-allowed">
                                        Selanjutnya
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-1" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 5l7 7-7 7" />
                                        </svg>
                                    </button>
                                @endif
                            </div>

                            <a href="{{ route('alumni.batch.materials', $batch->id) }}"
                                class="w-full flex items-center justify-center px-4 py-2 border border-transparent text-base font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 6h16M4 10h16M4 14h16M4 18h16" />
                                </svg>
                                Kembali ke Daftar Materi
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
