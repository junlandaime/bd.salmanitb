@extends('admin.layouts.app')

@section('content')
<div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8 max-w-4xl">
    <!-- Header -->
    <div class="flex items-center justify-between mb-8">
        <div>
            <div class="flex items-center gap-2 text-xs text-gray-500 mb-1">
                <a href="{{ route('admin.activities.show', $activity) }}" class="hover:text-emerald-600">{{ $activity->title }}</a>
                <span>/</span>
                <span>Batch Baru</span>
            </div>
            <h1 class="text-2xl font-bold text-gray-900">Tambah Batch Baru</h1>
            <p class="text-sm text-gray-500 mt-0.5">Tambahkan periode batch baru untuk kegiatan {{ $activity->title }}</p>
        </div>
        <a href="{{ route('admin.activities.show', $activity) }}"
            class="px-4 py-2.5 rounded-xl border border-gray-300 bg-white text-gray-700 hover:bg-gray-50 font-semibold text-sm shadow-sm transition">
            &larr; Kembali
        </a>
    </div>

    @include('admin.activities.batches.form')
</div>
@endsection
