@extends('layouts.app')

@section('content')
<!-- Hero Section -->
<section class="relative pt-16 pb-32 flex content-center items-center justify-center" style="min-height: 75vh;">
    <div class="absolute top-0 w-full h-full bg-center bg-cover"
        style='background-image: url("https://picsum.photos/1920/1081");'>
        <span class="w-full h-full absolute opacity-50 bg-black"></span>
    </div>
    <div class="container relative mx-auto">
        <div class="items-center flex flex-wrap">
            <div class="w-full lg:w-6/12 px-4 ml-auto mr-auto text-center">
                <div class="pr-12">
                    <h1 class="text-white font-semibold text-5xl">
                        Program & Kegiatan
                    </h1>
                    <p class="mt-4 text-lg text-gray-200">
                        Program dan kegiatan unggulan Bidang Dakwah Masjid Salman ITB untuk membangun peradaban Islami
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Program -->
<section class="py-20 lg:px-32 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="flex flex-wrap justify-center text-center mb-12">
            <div class="w-full lg:w-6/12 px-4">
                <h2 class="text-4xl font-semibold">Program Bidang Dakwah</h2>
                <p class="text-lg leading-relaxed m-4 text-gray-600">
                    Pilih program sesuai dengan kebutuhan Anda
                </p>
            </div>
        </div>

        <!-- Program Grid -->
        <div class="flex flex-wrap">
            @foreach ($programs as $program)
            <div class="w-full md:w-4/12 px-4 text-center mb-8">
                <div class="relative flex flex-col min-w-0 break-words bg-white w-full shadow-lg rounded-lg">
                    <img alt="{{ $program->title }}" src="https://picsum.photos/seed/{{ $program->id }}/400/300"
                        class="w-full align-middle rounded-t-lg">
                    <div class="px-4 py-5 flex-auto">
                        <h6 class="text-xl font-semibold">{{ $program->title }}</h6>
                        <p class="mt-2 mb-4 text-gray-600">
                            {{ $program->description }}
                        </p>
                        <a href="{{ route('programs.show', $program->slug) }}"
                            class="bg-green-500 text-white active:bg-green-600 font-bold uppercase text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150">
                            Lihat Program
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Featured Programs -->
@if ($featuredActivities->count() > 0)
<section class="py-20 lg:px-32 bg-white">
    <div class="container mx-auto px-4">
        <div class="flex flex-wrap justify-center text-center mb-12">
            <div class="w-full lg:w-6/12 px-4">
                <h2 class="text-4xl font-semibold">Kegiatan Unggulan</h2>
                <p class="text-lg leading-relaxed m-4 text-gray-600">
                    Kegiatan terbaik yang kami tawarkan untuk Anda
                </p>
            </div>
        </div>

        <div class="flex flex-wrap">
            @foreach ($featuredActivities as $activity)
            <div class="w-full md:w-4/12 px-4 mb-8">
                <div class="relative flex flex-col min-w-0 break-words bg-white w-full shadow-lg rounded-lg">
                    <img alt="{{ $activity->title }}" src="{{ $activity->image_url }}"
                        class="w-full align-middle rounded-t-lg">
                    <div class="px-4 py-5 flex-auto">
                        <div class="text-xs font-semibold text-green-600 mb-2">{{ $activity->program->title }}
                        </div>
                        <h6 class="text-xl font-semibold">{{ $activity->title }}</h6>
                        <p class="mt-2 mb-4 text-gray-600">
                            {{ Str::limit($activity->description, 100) }}
                        </p>
                        <a href="{{ route('activities.show', $activity->slug) }}"
                            class="bg-green-500 text-white active:bg-green-600 font-bold uppercase text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150">
                            Selengkapnya
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif
@endsection