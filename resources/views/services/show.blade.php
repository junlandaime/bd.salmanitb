@extends('layouts.app')
@section('title', $service->title . ' - Layanan Bidang Dakwah Masjid Salman ITB')
@section('meta_description', Str::limit(strip_tags($service->description), 160))
@section('og_title', $service->title . ' - Layanan Bidang Dakwah Masjid Salman ITB')
@section('og_description', Str::limit(strip_tags($service->description), 200))
@section('og_image', $service->featured_image ? Storage::url($service->featured_image) : '')
 
@section('content')

{{-- ========================= SERVICE HEADER ========================= --}}
<section class="relative isolate overflow-hidden bg-gradient-to-br from-slate-900 via-emerald-950 to-teal-950 text-white py-12 md:py-20">
    <div aria-hidden="true" class="absolute -top-24 -left-24 h-80 w-80 rounded-full bg-emerald-500/20 blur-3xl pointer-events-none"></div>
    <div aria-hidden="true" class="absolute -bottom-24 -right-24 h-80 w-80 rounded-full bg-teal-400/15 blur-3xl pointer-events-none"></div>
    <div class="absolute inset-0 opacity-5 bg-[radial-gradient(#fff_1px,transparent_1px)] [background-size:20px_20px] pointer-events-none"></div>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 space-y-4 text-center">
        @if($service->program)
            <span class="inline-flex items-center gap-1.5 px-3.5 py-1 rounded-full bg-emerald-500/15 border border-emerald-400/30 text-emerald-300 text-xs font-semibold">
                Layanan Program {{ $service->program->title }}
            </span>
        @endif

        <h1 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold tracking-tight text-white leading-tight">
            {{ $service->title }}
        </h1>
    </div>
</section>

{{-- ========================= BREADCRUMB ========================= --}}
<div class="bg-white border-b border-gray-200/80">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-3">
        <nav class="flex text-xs font-medium text-gray-500" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-2">
                <li><a href="{{ route('home') }}" class="hover:text-emerald-700 transition">Beranda</a></li>
                <li><span>/</span></li>
                <li><a href="{{ route('services.index') }}" class="hover:text-emerald-700 transition">Layanan</a></li>
                <li><span>/</span></li>
                <li class="text-emerald-700 font-bold truncate max-w-xs">{{ $service->title }}</li>
            </ol>
        </nav>
    </div>
</div>

{{-- ========================= SERVICE DETAIL CONTENT ========================= --}}
<section class="py-16 bg-gray-50/70">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="rounded-3xl bg-white border border-gray-200/80 p-6 sm:p-10 shadow-xs space-y-8">
            
            @if($service->image)
                <div class="rounded-2xl overflow-hidden aspect-[16/9] shadow-sm">
                    <img src="{{ Storage::url($service->image) }}" alt="{{ $service->title }}" class="w-full h-full object-cover">
                </div>
            @endif

            <div class="space-y-4">
                <h2 class="text-xl font-bold text-gray-900">Deskripsi Layanan</h2>
                <div class="prose prose-emerald max-w-none text-xs sm:text-sm text-gray-700 leading-relaxed space-y-3">
                    {!! $service->content ?? $service->description !!}
                </div>
            </div>

            <div class="pt-6 border-t border-gray-100 flex flex-col sm:flex-row items-center justify-between gap-4">
                <a href="{{ route('services.index') }}"
                    class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl border border-gray-200 bg-white hover:bg-gray-50 text-xs font-bold text-gray-700 transition">
                    <span>&larr;</span>
                    <span>Kembali ke Katalog Layanan</span>
                </a>

                <a href="{{ route('contact') }}"
                    class="inline-flex items-center justify-center gap-2 px-6 py-2.5 rounded-xl bg-gradient-to-r from-emerald-600 to-teal-600 hover:from-emerald-700 hover:to-teal-700 text-white text-xs font-bold shadow-md shadow-emerald-600/20 transition">
                    <span>Ajukan / Hubungi Sekretariat</span>
                    <span>&rarr;</span>
                </a>
            </div>

        </div>
    </div>
</section>

@endsection
