@extends('layouts.app')

@section('title', $program->title . ' - Program Bidang Dakwah Masjid Salman ITB')
@section('meta_description', Str::limit(strip_tags($program->description), 160))
@section('og_title', $program->title . ' - Program Bidang Dakwah Masjid Salman ITB')
@section('og_description', Str::limit(strip_tags($program->description), 200))
@section('og_image', $program->featured_image ? Storage::url($program->featured_image) : '')
 
@section('content')

{{-- ========================= HERO SECTION ========================= --}}
<section class="relative isolate overflow-hidden bg-gradient-to-br from-slate-900 via-emerald-950 to-teal-950 text-white py-12 md:py-20">
    <div aria-hidden="true" class="absolute -top-24 -left-24 h-80 w-80 rounded-full bg-emerald-500/20 blur-3xl pointer-events-none"></div>
    <div aria-hidden="true" class="absolute -bottom-24 -right-24 h-80 w-80 rounded-full bg-teal-400/15 blur-3xl pointer-events-none"></div>
    <div class="absolute inset-0 opacity-5 bg-[radial-gradient(#fff_1px,transparent_1px)] [background-size:20px_20px] pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="grid grid-cols-1 md:grid-cols-12 gap-8 items-center">
            <div class="md:col-span-8 space-y-4" data-aos="fade-right">
                <span class="inline-flex items-center gap-1.5 px-3.5 py-1 rounded-full bg-emerald-500/15 border border-emerald-400/30 text-emerald-300 text-xs font-semibold">
                    <span>📚</span>
                    <span>Program Dakwah &amp; Pembinaan</span>
                </span>
                <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold tracking-tight text-white leading-tight">
                    {{ $program->title }}
                </h1>
                <p class="text-slate-300 text-xs sm:text-sm leading-relaxed max-w-2xl">
                    {{ strip_tags($program->description) }}
                </p>
            </div>

            <div class="md:col-span-4 flex justify-center" data-aos="fade-left">
                <div class="relative rounded-3xl p-3 bg-white/5 border border-white/15 backdrop-blur-md shadow-2xl w-full max-w-sm">
                    <img src="{{ $program->featured_image ? Storage::url($program->featured_image) : 'https://picsum.photos/600/400' }}"
                        alt="{{ $program->title }}"
                        class="w-full aspect-[4/3] object-cover rounded-2xl shadow-inner" />
                </div>
            </div>
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
                <li><a href="{{ route('programs.index') }}" class="hover:text-emerald-700 transition">Program</a></li>
                <li><span>/</span></li>
                <li class="text-emerald-700 font-bold truncate max-w-xs">{{ $program->title }}</li>
            </ol>
        </nav>
    </div>
</div>

{{-- ========================= ACTIVITIES UNDER PROGRAM ========================= --}}
<section class="py-16 bg-gray-50/70">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="text-center max-w-2xl mx-auto mb-12" data-aos="fade-down">
            <span class="inline-flex px-3 py-1 rounded-full bg-emerald-100 text-emerald-800 text-xs font-bold uppercase tracking-wider">
                Kelas &amp; Kegiatan
            </span>
            <h2 class="mt-3 text-2xl sm:text-3xl font-extrabold text-gray-900">
                Kegiatan Terkait {{ $program->title }}
            </h2>
            <p class="mt-2 text-xs sm:text-sm text-gray-600">
                Daftar kelas, pelatihan, atau kegiatan yang dinaungi oleh program ini.
            </p>
        </div>

        @if($program->activities && $program->activities->count() > 0)
            <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($program->activities as $activity)
                    <article class="group rounded-2xl bg-white border border-gray-200/80 shadow-xs hover:shadow-xl hover:border-emerald-300 transition-all duration-300 overflow-hidden flex flex-col justify-between"
                        data-aos="fade-up" data-aos-delay="{{ $loop->index * 70 }}">
                        <div>
                            <div class="relative aspect-[16/10] overflow-hidden">
                                <img src="{{ $activity->featured_image ? Storage::url($activity->featured_image) : 'https://picsum.photos/600/400' }}"
                                    alt="{{ $activity->title }}"
                                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                <div class="absolute top-3 left-3">
                                    <span class="px-2.5 py-1 rounded-full bg-emerald-600/90 backdrop-blur text-white text-[11px] font-bold">
                                        {{ $activity->batches ? $activity->batches->count() . ' Batch' : 'Tersedia' }}
                                    </span>
                                </div>
                            </div>

                            <div class="p-6 space-y-3">
                                <h3 class="text-base font-bold text-gray-900 group-hover:text-emerald-700 transition leading-snug">
                                    {{ $activity->title }}
                                </h3>
                                <p class="text-xs text-gray-600 leading-relaxed line-clamp-3">
                                    {{ Str::limit(strip_tags($activity->description), 130) }}
                                </p>
                            </div>
                        </div>

                        <div class="p-6 pt-0">
                            @if(in_array($activity->slug, ['spn', 'sekolah-pranikah-offline', 'sekolah-pranikah-online']))
                                <a href="{{ route('spn.index') }}"
                                    class="inline-flex items-center justify-center gap-1.5 w-full py-2.5 px-4 rounded-xl bg-gradient-to-r from-amber-500 to-amber-600 hover:from-amber-600 hover:to-amber-700 text-white font-bold text-xs shadow-sm transition">
                                    <span>Halaman SPN &rarr;</span>
                                </a>
                            @else
                                <a href="{{ route('activities.show', $activity->slug) }}"
                                    class="inline-flex items-center justify-center gap-1.5 w-full py-2.5 px-4 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs shadow-sm transition">
                                    <span>Detail &amp; Pendaftaran &rarr;</span>
                                </a>
                            @endif
                        </div>
                    </article>
                @endforeach
            </div>
        @else
            <div class="text-center py-12 bg-white rounded-2xl border border-dashed border-gray-200">
                <div class="w-12 h-12 rounded-2xl bg-gray-100 text-gray-400 flex items-center justify-center text-xl mx-auto mb-2">
                    📋
                </div>
                <p class="text-sm font-bold text-gray-800">Belum ada kegiatan aktif di bawah program ini.</p>
                <p class="text-xs text-gray-500 mt-1">Silakan cek program lainnya atau hubungi sekretariat kami.</p>
            </div>
        @endif

    </div>
</section>

{{-- ========================= TOPICS & SCHEDULES ========================= --}}
@if(($program->topics && $program->topics->count() > 0) || ($program->schedules && $program->schedules->count() > 0))
<section class="py-16 bg-white border-t border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid md:grid-cols-2 gap-10">
            
            @if($program->topics && $program->topics->count() > 0)
                <div class="space-y-6" data-aos="fade-right">
                    <div>
                        <span class="inline-flex px-3 py-1 rounded-full bg-emerald-100 text-emerald-800 text-xs font-bold uppercase tracking-wider">
                            Kurikulum &amp; Topik
                        </span>
                        <h3 class="mt-2 text-xl font-bold text-gray-900">Materi yang Dipelajari</h3>
                    </div>

                    <div class="space-y-3">
                        @foreach($program->topics as $topic)
                            <div class="p-4 rounded-2xl bg-gray-50 border border-gray-200/80 flex items-start gap-3.5">
                                <div class="w-7 h-7 rounded-xl bg-emerald-100 text-emerald-700 font-bold text-xs flex items-center justify-center flex-shrink-0 mt-0.5">
                                    {{ $loop->iteration }}
                                </div>
                                <div class="space-y-1">
                                    <h4 class="text-xs font-bold text-gray-900">{{ $topic->title ?? $topic->name }}</h4>
                                    @if(!empty($topic->description))
                                        <p class="text-[11px] text-gray-600 leading-relaxed">{{ $topic->description }}</p>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            @if($program->schedules && $program->schedules->count() > 0)
                <div class="space-y-6" data-aos="fade-left">
                    <div>
                        <span class="inline-flex px-3 py-1 rounded-full bg-blue-100 text-blue-800 text-xs font-bold uppercase tracking-wider">
                            Jadwal Rutin
                        </span>
                        <h3 class="mt-2 text-xl font-bold text-gray-900">Waktu &amp; Lokasi Pembinaan</h3>
                    </div>

                    <div class="space-y-3">
                        @foreach($program->schedules as $sched)
                            <div class="p-4 rounded-2xl bg-gray-50 border border-gray-200/80 flex items-start gap-3.5">
                                <div class="w-7 h-7 rounded-xl bg-blue-100 text-blue-700 font-bold text-xs flex items-center justify-center flex-shrink-0 mt-0.5">
                                    🕒
                                </div>
                                <div class="space-y-1">
                                    <h4 class="text-xs font-bold text-gray-900">{{ $sched->day ?? $sched->name }} - {{ $sched->time ?? '' }}</h4>
                                    @if(!empty($sched->location))
                                        <p class="text-[11px] text-gray-600 leading-relaxed">📍 {{ $sched->location }}</p>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

        </div>
    </div>
</section>
@endif

@endsection
