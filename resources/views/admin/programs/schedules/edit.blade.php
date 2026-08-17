@extends('admin.layouts.app')

@section('content')
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="max-w-3xl mx-auto">
            <!-- Header -->
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
                <div class="flex items-center gap-3">
                    <a href="{{ route('admin.programs.edit', $program) }}"
                        class="p-2.5 bg-white border border-gray-200 rounded-xl text-gray-500 hover:text-gray-900 hover:bg-gray-50 shadow-sm transition"
                        title="Kembali ke Program">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                    </a>
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900">Edit Jadwal</h1>
                        <p class="text-sm text-gray-500 mt-0.5">Program: <strong class="text-gray-700">{{ $program->title }}</strong></p>
                    </div>
                </div>
            </div>

            @include('admin.programs.schedules.form')
        </div>
    </div>
@endsection
