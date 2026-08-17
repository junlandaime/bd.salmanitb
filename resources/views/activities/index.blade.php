@extends('layouts.app')
@section('title', 'Kegiatan Bidang Dakwah Masjid Salman ITB')

@section('content')

{{-- ========================= HERO SECTION ========================= --}}
<section class="relative isolate overflow-hidden bg-gradient-to-br from-slate-900 via-emerald-950 to-teal-950 text-white py-12 md:py-20">
    <div aria-hidden="true" class="absolute -top-24 -left-24 h-80 w-80 rounded-full bg-emerald-500/20 blur-3xl pointer-events-none"></div>
    <div aria-hidden="true" class="absolute -bottom-24 -right-24 h-80 w-80 rounded-full bg-teal-400/15 blur-3xl pointer-events-none"></div>
    <div class="absolute inset-0 opacity-5 bg-[radial-gradient(#fff_1px,transparent_1px)] [background-size:20px_20px] pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
        <div class="max-w-3xl mx-auto space-y-4" data-aos="fade-down">
            <span class="inline-flex items-center gap-1.5 px-3.5 py-1 rounded-full bg-emerald-500/15 border border-emerald-400/30 text-emerald-300 text-xs font-semibold">
                <span>🗓️</span>
                <span>Jadwal &amp; Pendaftaran</span>
            </span>
            <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold tracking-tight text-white leading-tight">
                Kegiatan &amp; Kelas Aktif
            </h1>
            <p class="text-slate-300 text-xs sm:text-sm leading-relaxed">
                Temukan berbagai kegiatan, kelas pembinaan, dan pelatihan bermakna untuk menguatkan iman, menambah ilmu, dan menebar kebaikan.
            </p>
        </div>
    </div>
</section>

{{-- ========================= BREADCRUMB ========================= --}}
<div class="bg-white border-b border-gray-200/80">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-3">
        <nav class="flex text-xs font-medium text-gray-500" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-2">
                <li><a href="{{ route('home') }}" class="hover:text-emerald-700 transition">Beranda</a></li>
                <li><span>/</span></li>
                <li class="text-emerald-700 font-bold">Kegiatan</li>
            </ol>
        </nav>
    </div>
</div>

{{-- ========================= ACTIVITIES LIST ========================= --}}
<section class="py-16 bg-gray-50/70">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="text-center max-w-2xl mx-auto mb-12" data-aos="fade-down">
            <span class="inline-flex px-3 py-1 rounded-full bg-emerald-100 text-emerald-800 text-xs font-bold uppercase tracking-wider">
                Daftar Kegiatan
            </span>
            <h2 class="mt-3 text-2xl sm:text-3xl font-extrabold text-gray-900">
                Pilih Kelas atau Kegiatan yang Dibuka
            </h2>
            <p class="mt-2 text-xs sm:text-sm text-gray-600">
                Daftar segera sebelum kuota peserta pada setiap batch terpenuhi.
            </p>
        </div>

        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
            @forelse ($activities as $activity)
                <article class="group rounded-2xl bg-white border border-gray-200/80 shadow-xs hover:shadow-xl hover:border-emerald-300 transition-all duration-300 overflow-hidden flex flex-col justify-between"
                    data-aos="fade-up" data-aos-delay="{{ $loop->index * 60 }}">
                    
                    <div>
                        <div class="relative aspect-[16/10] overflow-hidden">
                            <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                                src="{{ $activity->featured_image ? Storage::url($activity->featured_image) : 'https://picsum.photos/600/400' }}"
                                alt="{{ $activity->title }}">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent"></div>
                            
                            <div class="absolute top-3 left-3">
                                <span class="px-2.5 py-1 rounded-full bg-emerald-600/90 backdrop-blur text-white text-[11px] font-bold shadow-xs">
                                    {{ $activity->program->title ?? 'Program Dakwah' }}
                                </span>
                            </div>

                            @if($activity->batches && $activity->batches->where('status', 'aktif')->count() > 0)
                                <div class="absolute bottom-3 left-3">
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full bg-amber-500/90 backdrop-blur text-white text-[11px] font-bold">
                                        <span class="w-1.5 h-1.5 rounded-full bg-white animate-pulse"></span>
                                        <span>Pendaftaran Dibuka</span>
                                    </span>
                                </div>
                            @endif
                        </div>

                        <div class="p-6 space-y-3">
                            <h3 class="text-base font-bold text-gray-900 group-hover:text-emerald-700 transition leading-snug">
                                <a href="{{ route('activities.show', $activity->slug) }}">
                                    {{ $activity->title }}
                                </a>
                            </h3>
                            <p class="text-xs text-gray-600 leading-relaxed line-clamp-3">
                                {{ Str::limit(strip_tags($activity->description), 120) }}
                            </p>
                        </div>
                    </div>

                    <div class="p-6 pt-0">
                        @if(in_array($activity->slug, ['spn', 'sekolah-pranikah-offline', 'sekolah-pranikah-online']))
                            <a href="{{ route('spn.index') }}"
                                class="inline-flex items-center justify-center gap-1.5 w-full py-2.5 px-4 rounded-xl bg-gradient-to-r from-amber-500 to-amber-600 hover:from-amber-600 hover:to-amber-700 text-white font-bold text-xs shadow-sm transition">
                                <span>Detail SPN &rarr;</span>
                            </a>
                        @else
                            <a href="{{ route('activities.show', $activity->slug) }}"
                                class="inline-flex items-center justify-center gap-1.5 w-full py-2.5 px-4 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs shadow-sm transition">
                                <span>Detail &amp; Pendaftaran &rarr;</span>
                            </a>
                        @endif
                    </div>
                </article>
            @empty
                <div class="col-span-full text-center py-12 bg-white rounded-2xl border border-dashed border-gray-200">
                    <div class="w-12 h-12 rounded-2xl bg-gray-100 text-gray-400 flex items-center justify-center text-xl mx-auto mb-2">
                        📅
                    </div>
                    <p class="text-sm font-bold text-gray-800">Belum ada kegiatan yang dipublikasikan saat ini.</p>
                </div>
            @endforelse
        </div>

        <div class="mt-12">
            {{ $activities->links() }}
        </div>

    </div>
</section>

@endsection
