@extends('admin.layouts.app')

@section('content')
<div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="mb-6">
        <h1 class="text-2xl font-semibold text-gray-900">Tambah Testimonial</h1>
        <p class="mt-1 text-sm text-gray-600">Tambahkan testimonial baru untuk kegiatan {{ $activity->title }}</p>
    </div>

    @include('admin.activities.testimonials.form')
</div>
@endsection
