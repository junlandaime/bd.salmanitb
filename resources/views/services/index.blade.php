@extends('layouts.app')
@section('title', 'Layanan Bidang Dakwah Masjid Salman ITB')

@section('content')

{{-- ========================= HERO SECTION ========================= --}}
<section class="relative isolate overflow-hidden bg-gradient-to-br from-slate-900 via-emerald-950 to-teal-950 text-white py-12 md:py-20">
    <div aria-hidden="true" class="absolute -top-24 -left-24 h-80 w-80 rounded-full bg-emerald-500/20 blur-3xl pointer-events-none"></div>
    <div aria-hidden="true" class="absolute -bottom-24 -right-24 h-80 w-80 rounded-full bg-teal-400/15 blur-3xl pointer-events-none"></div>
    <div class="absolute inset-0 opacity-5 bg-[radial-gradient(#fff_1px,transparent_1px)] [background-size:20px_20px] pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
        <div class="max-w-3xl mx-auto space-y-4" data-aos="fade-down">
            <span class="inline-flex items-center gap-1.5 px-3.5 py-1 rounded-full bg-emerald-500/15 border border-emerald-400/30 text-emerald-300 text-xs font-semibold">
                <i class="fas fa-hands-helping"></i>
                <span>Layanan Umat</span>
            </span>
            <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold tracking-tight text-white leading-tight">
                Layanan Bidang Dakwah
            </h1>
            <p class="text-slate-300 text-xs sm:text-sm leading-relaxed">
                Menyediakan layanan keagamaan terpadu untuk jamaah dan masyarakat, mulai dari ketakmiran, pengurusan jenazah, hingga konsultasi.
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
                <li class="text-emerald-700 font-bold">Layanan</li>
            </ol>
        </nav>
    </div>
</div>

{{-- ========================= SERVICES LIST ========================= --}}
<section class="py-16 bg-gray-50/70">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="text-center max-w-2xl mx-auto mb-12" data-aos="fade-down">
            <span class="inline-flex px-3 py-1 rounded-full bg-emerald-100 text-emerald-800 text-xs font-bold uppercase tracking-wider">
                Katalog Layanan
            </span>
            <h2 class="mt-3 text-2xl sm:text-3xl font-extrabold text-gray-900">
                Pilihan Layanan Keislaman
            </h2>
            <p class="mt-2 text-xs sm:text-sm text-gray-600">
                Kami siap mendampingi kebutuhan ibadah dan sosial Anda dengan profesional dan sesuai syariat.
            </p>
        </div>

        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
            @forelse ($services as $service)
                <article class="group rounded-2xl bg-white border border-gray-200/80 shadow-xs hover:shadow-xl hover:border-emerald-300 transition-all duration-300 overflow-hidden flex flex-col justify-between"
                    data-aos="fade-up" data-aos-delay="{{ $loop->index * 70 }}">

                    <div>
                        <div class="p-6 space-y-4">
                            <div class="w-12 h-12 rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center text-lg">
                                @if($service->icon)
                                    <i class="{{ $service->icon }}"></i>
                                @else
                                    <i class="fas fa-hands-helping"></i>
                                @endif
                            </div>
                            <h3 class="text-base font-bold text-gray-900 group-hover:text-emerald-700 transition leading-snug">
                                <a href="{{ route('services.show', $service->slug) }}">
                                    {{ $service->title }}
                                </a>
                            </h3>
                            <p class="text-xs text-gray-600 leading-relaxed line-clamp-3">
                                {{ Str::limit(strip_tags($service->description), 130) }}
                            </p>
                        </div>
                    </div>

                    <div class="p-6 pt-0">
                        <a href="{{ route('services.show', $service->slug) }}"
                            class="inline-flex items-center justify-between w-full px-4 py-2.5 rounded-xl bg-gray-50 hover:bg-emerald-50 text-gray-800 hover:text-emerald-700 text-xs font-bold transition border border-gray-200/80 hover:border-emerald-200">
                            <span>Informasi &amp; Prosedur</span>
                            <span>&rarr;</span>
                        </a>
                    </div>
                </article>
            @empty
                <div class="col-span-full text-center py-12 bg-white rounded-2xl border border-dashed border-gray-200">
                    <div class="w-12 h-12 rounded-2xl bg-gray-100 text-gray-400 flex items-center justify-center text-xl mx-auto mb-2">
                        <i class="fas fa-hands-helping"></i>
                    </div>
                    <p class="text-sm font-bold text-gray-800">Belum ada layanan yang ditambahkan.</p>
                </div>
            @endforelse
        </div>

        @if(method_exists($services, 'links'))
            <div class="mt-12">
                {{ $services->links() }}
            </div>
        @endif

    </div>
</section>

@endsection
