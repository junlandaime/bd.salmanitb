@extends('layouts.app')

@section('title', 'Materi ' . $batch->nama_batch)
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
            <div class="mb-8">
                <nav class="flex mb-4" aria-label="Breadcrumb">
                    <ol class="inline-flex items-center space-x-1 md:space-x-3">
                        <li class="inline-flex items-center">
                            <a href="{{ route('alumni.dashboard') }}" class="text-gray-500 hover:text-green-600">
                                Dashboard Alumni
                            </a>
                        </li>
                        <li aria-current="page">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                <span class="ml-1 text-gray-500">Materi {{ $batch->activity->title }} -
                                    {{ $batch->nama_batch }}</span>
                            </div>
                        </li>
                    </ol>
                </nav>
                <h2 class="text-3xl font-bold text-green-600">Materi {{ $batch->activity->title }}</h2>
                <p class="text-gray-500 mt-2">{{ $batch->nama_batch }} |
                    {{ $batch->tanggal_mulai_kegiatan->format('d M Y') }} -
                    {{ $batch->tanggal_selesai_kegiatan->format('d M Y') }}</p>
            </div>

            @if (session('error'))
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6" role="alert">
                    <p>{{ session('error') }}</p>
                </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-lg shadow-lg overflow-hidden mb-8">
                        <div class="border-b border-gray-200 px-6 py-4">
                            <h5 class="text-xl font-semibold text-green-600">Daftar Materi</h5>
                        </div>
                        <div class="divide-y divide-gray-200">
                            @if ($batch->materials->isEmpty())
                                <div class="text-center py-16">
                                    <svg class="mx-auto h-12 w-12 text-gray-400" xmlns="http://www.w3.org/2000/svg"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                    </svg>
                                    <h5 class="mt-4 text-lg font-medium text-gray-900">Belum ada materi tersedia</h5>
                                    <p class="mt-2 text-gray-500">Materi untuk batch ini belum tersedia. Silakan cek kembali
                                        nanti.</p>
                                </div>
                            @else
                                @foreach ($batch->materials as $material)
                                    <div class="px-6 py-4 hover:bg-gray-50">
                                        <div class="flex justify-between items-center">
                                            <div>
                                                <h5 class="text-lg font-medium text-gray-900">{{ $material->title }}</h5>
                                                @if ($material->description)
                                                    <p class="text-gray-500 mt-1">{{ $material->description }}</p>
                                                @endif
                                            </div>
                                            <a href="{{ route('alumni.material.view', ['batchId' => $batch->id, 'materialId' => $material->id]) }}"
                                                class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                                <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg"
                                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                </svg>
                                                Lihat
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>

                <div class="space-y-8">
                    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                        <div class="border-b border-gray-200 px-6 py-4">
                            <h5 class="text-xl font-semibold text-green-600">Informasi Batch</h5>
                        </div>
                        <div class="p-6 space-y-4">
                            <div>
                                <h6 class="text-sm font-medium text-gray-500">Nama Kegiatan</h6>
                                <p class="mt-1 text-gray-900">{{ $batch->activity->title }}</p>
                            </div>
                            <div>
                                <h6 class="text-sm font-medium text-gray-500">Batch</h6>
                                <p class="mt-1 text-gray-900">{{ $batch->nama_batch }}</p>
                            </div>
                            <div>
                                <h6 class="text-sm font-medium text-gray-500">Periode</h6>
                                <p class="mt-1 text-gray-900">{{ $batch->tanggal_mulai_kegiatan->format('d M Y') }} -
                                    {{ $batch->tanggal_selesai_kegiatan->format('d M Y') }}</p>
                            </div>
                            <div>
                                <h6 class="text-sm font-medium text-gray-500">Durasi</h6>
                                <p class="mt-1 text-gray-900">{{ $batch->getDurationInWeeks() }} minggu</p>
                            </div>
                            <div>
                                <h6 class="text-sm font-medium text-gray-500">Jumlah Materi</h6>
                                <p class="mt-1 text-gray-900">{{ $batch->materials->count() }} materi</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                        <div class="border-b border-gray-200 px-6 py-4">
                            <h5 class="text-xl font-semibold text-green-600">Bantuan</h5>
                        </div>
                        <div class="p-6">
                            <p class="text-gray-700 mb-4">Jika Anda mengalami kesulitan dalam mengakses materi, silakan
                                ikuti langkah berikut:</p>
                            <ol class="list-decimal pl-5 space-y-2 text-gray-700">
                                <li>Pastikan Anda terdaftar sebagai alumni batch ini</li>
                                <li>Periksa koneksi internet Anda</li>
                                <li>Coba refresh halaman</li>
                                <li>Jika masalah berlanjut, hubungi admin</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
