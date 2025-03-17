@extends('layouts.app')

@section('content')
    <!-- Main Content -->
    <main class="mt-16">
        <!-- Hero Section -->
        <div class="relative overflow-hidden">
            <div class="max-w-7xl mx-auto">
                <div class="relative z-10 pb-8 bg-white sm:pb-16 md:pb-20 lg:max-w-2xl lg:w-full lg:pb-28 xl:pb-32">
                    <div class="relative pt-6 px-4 sm:px-6 lg:px-8">
                        <!-- Green Blob Animation -->
                        <div class="absolute right-0 top-0 -mr-40 transform translate-x-1/2 -translate-y-1/2">
                            <div class="w-96 h-96 bg-green-500 rounded-full opacity-20 animate-blob"></div>
                        </div>

                        <!-- Yellow Accent -->
                        <div class="absolute right-20 top-40">
                            <div class="w-24 h-24 bg-yellow-400 rounded-full"></div>
                        </div>

                        <!-- Content -->
                        <div class="mt-10 mx-auto max-w-7xl px-4 sm:mt-12 sm:px-6 md:mt-16 lg:mt-20 lg:px-8 xl:mt-28">
                            <div class="sm:text-center lg:text-left">
                                <h2 class="text-2xl font-semibold text-gray-900 tracking-tight sm:text-3xl md:text-4xl">
                                    Assalamu'alaykum Wr. Wb.,
                                </h2>
                                <h1 class="text-4xl tracking-tight font-extrabold text-gray-900 sm:text-5xl md:text-6xl">
                                    <span class="block">Selamat Datang di</span>
                                    <span class="block text-green-600">Bidang Dakwah Masjid Salman ITB</span>
                                </h1>
                                <p
                                    class="mt-3 text-base text-gray-500 sm:mt-5 sm:text-lg sm:max-w-xl sm:mx-auto md:mt-5 md:text-xl lg:mx-0">
                                    Bidang pengelola kegiatan dakwah dan pelayanan ibadah jamaah yang diselenggarakan oleh
                                    Yayasan Pembina Masjid (YPM) Salman ITB
                                </p>

                                <!-- CTA Buttons -->
                                <div class="mt-5 sm:mt-8 sm:flex sm:justify-center lg:justify-start">
                                    <div class="rounded-md shadow">
                                        <a href="{{ route('programs.index') }}"
                                            class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-white bg-green-600 hover:bg-green-700 md:py-4 md:text-lg md:px-10">
                                            Lihat Program
                                        </a>
                                    </div>
                                    <div class="mt-3 sm:mt-0 sm:ml-3">
                                        <a href="{{ route('contact') }}"
                                            class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-green-700 bg-green-100 hover:bg-green-200 md:py-4 md:text-lg md:px-10">
                                            Konsultasi
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Featured Programs Section -->
        <section class="py-16 bg-gray-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <h2 class="text-3xl font-bold text-center mb-12">Program Unggulan</h2>

                <div x-data="{ activeSlide: 0 }" class="relative">
                    <div class="overflow-hidden">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                            @foreach ($featuredPrograms as $program)
                                <div
                                    class="bg-white rounded-lg shadow-lg overflow-hidden transform hover:scale-105 transition duration-300">
                                    <img src="{{ $program->featured_image ?? 'https://picsum.photos/400/300' }}"
                                        alt="{{ $program->title }}" class="w-full h-48 object-cover">
                                    <div class="p-6">
                                        <h3 class="text-xl font-bold mb-2">{{ $program->title }}</h3>
                                        <p class="text-gray-600 mb-4">{{ Str::limit($program->description, 100) }}</p>
                                        <a href="{{ route('programs.show', $program) }}"
                                            class="text-green-600 hover:text-green-700 font-medium">Learn More →</a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Latest News Section -->
        <section class="py-16 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <h2 class="text-3xl font-bold text-center mb-12">Berita Terbaru</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                    @foreach ($latestNews as $news)
                        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                            <img src="{{ $news->featured_image ?? 'https://picsum.photos/400/300' }}"
                                alt="{{ $news->title }}" class="w-full h-48 object-cover">
                            <div class="p-6">
                                <div class="text-sm text-gray-500">{{ $news->published_at->format('d M Y') }}</div>
                                <h3 class="mt-2 text-xl font-bold">{{ $news->title }}</h3>
                                <p class="mt-2 text-gray-600">{{ Str::limit($news->content, 100) }}</p>
                                <a href="{{ route('news.show', $news) }}"
                                    class="mt-4 inline-block text-green-600 hover:text-green-700">Read More →</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        <!-- Featured Articles Section -->
        <section class="py-16 bg-gray-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <h2 class="text-3xl font-bold text-center mb-12">Artikel Pilihan</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    @foreach ($featuredArticles as $article)
                        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                            <img src="{{ $article->image_url ?? 'https://picsum.photos/400/300' }}"
                                alt="{{ $article->title }}" class="w-full h-48 object-cover">
                            <div class="p-6">
                                <div class="text-sm text-gray-500">{{ $article->published_at->format('d M Y') }}</div>
                                <h3 class="mt-2 text-xl font-bold">{{ $article->title }}</h3>
                                <p class="mt-2 text-gray-600">{{ Str::limit($article->content, 100) }}</p>
                                <a href="{{ route('articles.show', $article) }}"
                                    class="mt-4 inline-block text-green-600 hover:text-green-700">Read More →</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>


        @php
            $upcomingPrograms = App\Models\Activity::with([
                'batches' => function ($query) {
                    $query
                        ->where('status', 'aktif')
                        ->where(function ($q) {
                            $q->where('tanggal_mulai_pendaftaran', '<=', now()->addMonths(2))->where(
                                'tanggal_selesai_pendaftaran',
                                '>=',
                                now(),
                            );
                        })
                        ->orderBy('tanggal_mulai_pendaftaran');
                },
            ])
                ->where('status', 'published')
                ->whereHas('batches', function ($query) {
                    $query->where('status', 'aktif')->where('tanggal_selesai_pendaftaran', '>=', now());
                })
                ->get();
        @endphp

        <!-- Upcoming Program -->
        <section class="py-16">
            <div class="max-w-6xl mx-auto px-4">
                <h2 class="text-2xl font-bold mb-8" data-aos="fade-up">Kegiatan Mendatang</h2>
                <div class="space-y-4">
                    @forelse($upcomingPrograms as $program)
                        @foreach ($program->batches as $batch)
                            <div class="bg-white rounded-xl shadow-lg p-6 hover:shadow-xl transition-all duration-300"
                                data-aos="fade-up" data-aos-delay="100">
                                <div class="flex gap-6">
                                    <div class="text-center bg-blue-50 px-4 py-2 rounded-lg">
                                        <div class="text-2xl font-bold text-bluebg-blue-600">
                                            {{ $batch->tanggal_mulai_kegiatan->format('d') }}</div>
                                        <div class="text-sm text-bluebg-blue-600">
                                            {{ $batch->tanggal_mulai_kegiatan->format('M') }}
                                        </div>
                                    </div>
                                    <div class="flex-1">
                                        <div class="flex justify-between items-start">
                                            <div>
                                                <h3 class="font-semibold text-lg">{{ $program->title }}</h3>
                                                <p class="text-gray-600">Batch {{ $batch->batch_ke }} -
                                                    {{ $batch->nama_batch }}</p>
                                            </div>
                                            @if ($batch->isOpenForRegistration())
                                                <span class="px-3 py-1 bg-green-100 text-green-600 text-sm rounded-full">
                                                    Pendaftaran Dibuka
                                                </span>
                                            @else
                                                <span class="px-3 py-1 bg-blue-100 text-blue-600 text-sm rounded-full">
                                                    Upcoming
                                                </span>
                                            @endif
                                        </div>
                                        <div class="mt-2 flex gap-2 justify-between items-start">
                                            <div>
                                                {{-- <span
                                                    class="px-2 py-1 {{ $program->tipe_kelas === 'online' ? 'bg-blue-100 text-blue-600' : ($program->tipe_kelas === 'offline' ? 'bg-yellow-100 text-yellow-600' : 'bg-purple-100 text-purple-600') }} text-sm rounded">
                                                    {{ ucfirst($program->tipe_kelas) }}
                                                </span>
                                                <span
                                                    class="px-2 py-1 bg-blue-100 text-blue-600 text-sm rounded">{{ $program->durasi }}</span> --}}
                                                @if ($batch->isOpenForRegistration())
                                                    <span class="px-2 py-1 bg-red-100 text-red-600 text-sm rounded">
                                                        Sisa
                                                        {{ $batch->tanggal_selesai_pendaftaran->diffForHumans(null, true) }}
                                                    </span>
                                                @endif
                                            </div>
                                            @if ($batch->isOpenForRegistration())
                                                <div class="">

                                                    <a href="{{ route('activities.show', $program) }}"
                                                        class="inline-block px-3 py-1 bg-green-600 text-white rounded-lg hover:bg-green-900 transition-colors">
                                                        Daftar Sekarang
                                                    </a>
                                                </div>
                                            @endif
                                        </div>

                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @empty
                        <div class="text-center text-gray-500 py-8">
                            Tidak ada program yang akan datang dalam waktu dekat
                        </div>
                    @endforelse
                </div>
            </div>
        </section>



        <!-- Upcoming Activities Section -->
        <section class="py-16 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <h2 class="text-3xl font-bold text-center mb-12">Kegiatan Mendatang</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    @foreach ($upcomingActivities as $activity)
                        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                            <div class="p-6">
                                <h3 class="text-xl font-bold">{{ $activity->name }}</h3>
                                <p class="mt-2 text-gray-600">{{ $activity->description }}</p>
                                <div class="mt-4 space-y-2">
                                    @foreach ($activity->batches as $batch)
                                        <div class="flex items-center text-sm text-gray-500">
                                            <svg class="h-5 w-5 mr-2 text-green-500" xmlns="http://www.w3.org/2000/svg"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                            {{ $batch->tanggal_mulai_kegiatan->format('d M Y') }} -
                                            {{ $batch->tanggal_selesai_kegiatan->format('d M Y') }}
                                        </div>
                                    @endforeach
                                </div>
                                <a href="{{ route('activities.show', $activity) }}"
                                    class="mt-4 inline-block text-green-600 hover:text-green-700">Learn More →</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        <!-- CTA Section -->
        <section class="relative bg-green-500 py-20 overflow-hidden">
            <!-- Animated Wave Background -->
            <div class="absolute inset-0 opacity-10">
                <svg class="w-full h-full" viewBox="0 0 1440 320" preserveAspectRatio="none">
                    <path fill="currentColor"
                        d="M0,96L48,112C96,128,192,160,288,160C384,160,480,128,576,112C672,96,768,96,864,112C960,128,1056,160,1152,160C1248,160,1344,128,1392,112L1440,96L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z">
                    </path>
                </svg>
            </div>

            <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center">
                    <h2 class="text-3xl font-extrabold text-white sm:text-4xl">
                        <span class="block">Siap untuk bergabung?</span>
                        <span class="block text-green-100">Daftar sekarang dan ikuti kegiatan kami.</span>
                    </h2>
                    <div class="mt-8 flex justify-center">
                        <div class="inline-flex rounded-md shadow">
                            <a href="{{ route('register') }}"
                                class="inline-flex items-center justify-center px-5 py-3 border border-transparent text-base font-medium rounded-md text-green-600 bg-white hover:bg-green-50">
                                Daftar Sekarang
                            </a>
                        </div>
                        <div class="ml-3 inline-flex">
                            <a href="{{ route('contact') }}"
                                class="inline-flex items-center justify-center px-5 py-3 border border-transparent text-base font-medium rounded-md text-white bg-green-600 hover:bg-green-700">
                                Hubungi Kami
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <style>
        @keyframes blob {
            0% {
                transform: translate(0px, 0px) scale(1);
            }

            33% {
                transform: translate(30px, -50px) scale(1.1);
            }

            66% {
                transform: translate(-20px, 20px) scale(0.9);
            }

            100% {
                transform: translate(0px, 0px) scale(1);
            }
        }

        .animate-blob {
            animation: blob 7s infinite;
        }
    </style>
@endsection
