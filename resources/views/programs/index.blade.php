@extends('layouts.app')
@section('title', 'Program Bidang Dakwah Masjid Salman ITB')

@section('content')

{{-- ========================= HERO SECTION ========================= --}}
<section class="relative isolate overflow-hidden bg-gradient-to-br from-slate-900 via-emerald-950 to-teal-950 text-white py-12 md:py-20">
    <div aria-hidden="true" class="absolute -top-24 -left-24 h-80 w-80 rounded-full bg-emerald-500/20 blur-3xl pointer-events-none"></div>
    <div aria-hidden="true" class="absolute -bottom-24 -right-24 h-80 w-80 rounded-full bg-teal-400/15 blur-3xl pointer-events-none"></div>
    <div class="absolute inset-0 opacity-5 bg-[radial-gradient(#fff_1px,transparent_1px)] [background-size:20px_20px] pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
        <div class="max-w-3xl mx-auto space-y-4" data-aos="fade-down">
            <span class="inline-flex items-center gap-1.5 px-3.5 py-1 rounded-full bg-emerald-500/15 border border-emerald-400/30 text-emerald-300 text-xs font-semibold">
                <span>📚</span>
                <span>Pusat Pembinaan &amp; Dakwah</span>
            </span>
            <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold tracking-tight text-white leading-tight">
                Program &amp; Pembinaan Salman ITB
            </h1>
            <p class="text-slate-300 text-xs sm:text-sm leading-relaxed">
                Menebarkan cahaya ilmu dan keimanan melalui program-program unggulan Bidang Dakwah Masjid Salman ITB untuk membangun peradaban Islami yang berdaya guna.
            </p>
        </div>
    </div>
</section>

{{-- ========================= BREADCRUMB ========================= --}}
<div class="bg-white border-b border-gray-200/80">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-3">
        <nav class="flex text-xs font-medium text-gray-500" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-2">
                <li>
                    <a href="{{ route('home') }}" class="hover:text-emerald-700 transition">Beranda</a>
                </li>
                <li><span>/</span></li>
                <li class="text-emerald-700 font-bold">Program</li>
            </ol>
        </nav>
    </div>
</div>

{{-- ========================= PROGRAM LIST ========================= --}}
<section class="py-16 bg-gray-50/70">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="text-center max-w-2xl mx-auto mb-12" data-aos="fade-down">
            <span class="inline-flex px-3 py-1 rounded-full bg-emerald-100 text-emerald-800 text-xs font-bold uppercase tracking-wider">
                Daftar Program
            </span>
            <h2 class="mt-3 text-2xl sm:text-3xl font-extrabold text-gray-900">
                Pilih Program yang Tepat untuk Anda
            </h2>
            <p class="mt-2 text-xs sm:text-sm text-gray-600">
                Setiap program dirancang secara berjenjang dengan kurikulum terstruktur dan pemateri kompeten.
            </p>
        </div>

        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
            @foreach ($programs as $program)
                <article class="group rounded-2xl bg-white border border-gray-200/80 shadow-xs hover:shadow-xl hover:border-emerald-300 transition-all duration-300 overflow-hidden flex flex-col justify-between"
                    data-aos="fade-up" data-aos-delay="{{ $loop->index * 70 }}">
                    
                    <div>
                        <a href="{{ route('programs.show', $program->slug) }}" class="block relative overflow-hidden aspect-[16/10]">
                            <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                                src="{{ $program->featured_image ? Storage::url($program->featured_image) : 'https://picsum.photos/600/400' }}"
                                alt="{{ $program->title }}">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent"></div>
                            <div class="absolute bottom-3 left-3 right-3">
                                <span class="inline-block px-2.5 py-1 rounded-full bg-emerald-600/90 backdrop-blur text-white text-[11px] font-bold">
                                    {{ $program->activities_count ?? 0 }} Kegiatan / Kelas
                                </span>
                            </div>
                        </a>

                        <div class="p-6 space-y-3">
                            <h3 class="text-base font-bold text-gray-900 group-hover:text-emerald-700 transition">
                                <a href="{{ route('programs.show', $program->slug) }}">
                                    {{ $program->title }}
                                </a>
                            </h3>
                            <p class="text-xs text-gray-600 leading-relaxed line-clamp-3">
                                {{ Str::limit(strip_tags($program->description), 130) }}
                            </p>
                        </div>
                    </div>

                    <div class="p-6 pt-0">
                        <a href="{{ route('programs.show', $program->slug) }}"
                            class="inline-flex items-center justify-between w-full px-4 py-2.5 rounded-xl bg-gray-50 hover:bg-emerald-50 text-gray-800 hover:text-emerald-700 text-xs font-bold transition border border-gray-200/80 hover:border-emerald-200">
                            <span>Lihat Kurikulum &amp; Detail</span>
                            <span>&rarr;</span>
                        </a>
                    </div>
                </article>
            @endforeach
        </div>

    </div>
</section>

{{-- ========================= FEATURED ACTIVITIES ========================= --}}
@if(isset($featuredActivities) && $featuredActivities->count() > 0)
<section class="py-16 bg-white border-t border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-2xl mx-auto mb-12" data-aos="fade-down">
            <span class="inline-flex px-3 py-1 rounded-full bg-teal-100 text-teal-800 text-xs font-bold uppercase tracking-wider">
                Kegiatan Unggulan
            </span>
            <h2 class="mt-3 text-2xl sm:text-3xl font-extrabold text-gray-900">
                Kelas &amp; Kegiatan Paling Diminati
            </h2>
        </div>

        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
            @foreach ($featuredActivities as $activity)
                <article class="group rounded-2xl bg-white border border-gray-200/80 shadow-xs hover:shadow-lg transition-all duration-300 overflow-hidden flex flex-col justify-between"
                    data-aos="zoom-in" data-aos-delay="{{ $loop->index * 70 }}">
                    <div>
                        <div class="relative aspect-[16/10] overflow-hidden">
                            <img src="{{ $activity->featured_image ? Storage::url($activity->featured_image) : 'https://picsum.photos/600/400' }}"
                                alt="{{ $activity->title }}"
                                class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                            <div class="absolute top-3 left-3">
                                <span class="px-2.5 py-1 rounded-full bg-emerald-600 text-white text-[11px] font-bold shadow-xs">
                                    {{ $activity->program->title ?? 'Kegiatan' }}
                                </span>
                            </div>
                        </div>
                        <div class="p-5 space-y-2">
                            <h3 class="text-sm font-bold text-gray-900 group-hover:text-emerald-700 transition">
                                {{ $activity->title }}
                            </h3>
                            <p class="text-xs text-gray-500 line-clamp-2">
                                {{ Str::limit(strip_tags($activity->description), 100) }}
                            </p>
                        </div>
                    </div>

                    <div class="p-5 pt-0">
                        <a href="{{ route('activities.show', $activity->slug) }}"
                            class="inline-flex items-center justify-center gap-1.5 w-full py-2 px-3 rounded-xl bg-emerald-50 text-emerald-700 hover:bg-emerald-600 hover:text-white text-xs font-bold transition">
                            <span>Detail Kegiatan</span>
                            <span>&rarr;</span>
                        </a>
                    </div>
                </article>
            @endforeach
        </div>
    </div>
</section>
@endif

@endsection
