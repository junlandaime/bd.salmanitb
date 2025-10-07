@extends('layouts.app')

@section('title', $program->title . ' - Program Bidang Dakwah Masjid Salman ITB')
@section('meta_description', Str::limit($program->description, 160))
@section('og_title', $program->title . ' - Program Bidang Dakwah Masjid Salman ITB')
@section('og_description', Str::limit($program->description, 200))
@section('og_image', 'https://bidangdakwah.salmanitb.com/storage/' . $program->featured_image)

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
    <style>
        .soft-container {
            max-width: 1200px;
            margin: 0 auto;
            padding-left: 1rem;
            padding-right: 1rem
        }

        . {
            position: relative
        }

        .:before {
            content: "";
            position: absolute;
            inset: -1px;
            border-radius: 1rem;
            padding: 1px;
            background: linear-gradient(135deg, rgba(16, 185, 129, .6), rgba(59, 130, 246, .35));
            -webkit-mask: linear-gradient(#000 0 0) content-box, linear-gradient(#000 0 0);
            -webkit-mask-composite: xor;
            mask-composite: exclude
        }

        .card:hover .card-image {
            transform: scale(1.05)
        }

        .card .card-image {
            transition: transform .6s cubic-bezier(.2, .8, .2, 1)
        }

        .section-badge {
            letter-spacing: .06em
        }

        .glass {
            background: rgba(255, 255, 255, .65);
            backdrop-filter: saturate(1.4) blur(8px)
        }

        .dot-pattern {
            background-image: radial-gradient(rgba(0, 0, 0, .06) 1px, transparent 1px);
            background-size: 16px 16px
        }
    </style>

    {{-- ========================= HERO SECTION ========================= --}}
    <section
        class="relative isolate overflow-hidden bg-gradient-to-br from-emerald-700 via-emerald-600 to-emerald-700 text-white">
        <div aria-hidden="true" class="absolute -top-24 -left-24 h-64 w-64 rounded-full bg-emerald-500/30 blur-3xl"></div>
        <div aria-hidden="true" class="absolute -bottom-24 -right-24 h-64 w-64 rounded-full bg-emerald-400/20 blur-3xl"></div>

        <div class="soft-container py-16 md:py-24">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-10 items-center">
                <div data-aos="fade-right" data-aos-duration="800">
                    <p
                        class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white/10 ring-1 ring-white/20 section-badge text-sm">
                        <span>Bidang Dakwah YPM Salman ITB</span>
                    </p>
                    <h1 class="mt-4 text-4xl md:text-5xl font-extrabold leading-tight">{{ $program->title }}</h1>
                    <p class="mt-4 text-white/90 text-lg leading-relaxed">
                        {{ $program->description }}
                    </p>
                </div>
                <div class="relative flex items-center justify-center" data-aos="fade-left" data-aos-duration="800"
                    data-aos-delay="100">
                    <x-application-logo-full class="w-3/4 h-auto opacity-90" />
                </div>
            </div>
        </div>
    </section>

    {{-- ========================= OVERVIEW SECTION ========================= --}}
    <section class="py-16 bg-white">
        <div class="soft-container">
            <div class="grid md:grid-cols-2 gap-10 items-center">
                <div data-aos="fade-right" data-aos-duration="800">
                    <div class="glass rounded-2xl p-2 ">
                        <img src="{{ Storage::url($program->featured_image) }}" alt="{{ $program->title }}"
                            class="card-image w-full aspect-square object-cover rounded-2xl">
                    </div>
                </div>
                <div data-aos="fade-left" data-aos-duration="800" data-aos-delay="200">
                    <span
                        class="inline-flex px-3 py-1 rounded-full bg-emerald-100 text-emerald-700 section-badge text-xs">TENTANG
                        PROGRAM</span>
                    <h2 class="mt-3 text-3xl md:text-4xl font-bold tracking-tight">Ringkasan Program</h2>
                    <div class="mt-6 text-gray-700 leading-relaxed space-y-4">
                        {!! nl2br(e($program->overview)) !!}
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ========================= KEGIATAN & LAYANAN ========================= --}}
    @if ($program->activities->count() > 0 || $program->services->count() > 0)
        <section class="py-16 bg-gray-50">
            <div class="soft-container">
                <div class="text-center mb-12" data-aos="fade-down">
                    <span
                        class="inline-flex px-3 py-1 rounded-full bg-violet-100 text-violet-700 section-badge text-xs">KEGIATAN
                        & LAYANAN</span>
                    <h2 class="mt-3 text-3xl md:text-4xl font-bold tracking-tight">Yang Kami Tawarkan</h2>
                    <div class="mt-4 h-1 w-20 bg-gradient-to-r from-emerald-600 to-emerald-500 mx-auto rounded-full"></div>
                    <p class="mt-4 text-gray-600 max-w-2xl mx-auto text-lg">
                        Dalam rangka mendukung kelancaran ibadah dan kegiatan keagamaan, kami menyediakan berbagai kegiatan
                        dan layanan {{ $program->title }}
                    </p>
                </div>

                <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach ($program->activities as $kegiatan)
                        <article class="card  rounded-2xl bg-white shadow-sm hover:shadow-xl transition overflow-hidden"
                            data-aos="zoom-in" data-aos-delay="{{ $loop->index * 80 }}">
                            <div class="relative overflow-hidden">
                                <img src="{{ Storage::url($kegiatan->featured_image) }}" alt="{{ $kegiatan->title }}"
                                    class="card-image w-full h-56 object-cover">
                                <div class="absolute inset-0 bg-gradient-to-t from-black/40 via-transparent"></div>
                                <div class="absolute top-4 left-4">
                                    <span
                                        class="inline-flex items-center gap-1 bg-emerald-500 text-white px-3 py-1 rounded-full text-xs font-semibold">Kegiatan</span>
                                </div>
                            </div>
                            <div class="p-6">
                                <h3 class="text-xl font-semibold mb-3">{{ $kegiatan->title }}</h3>
                                <p class="text-gray-600 text-sm leading-relaxed mb-4">
                                    {{ $kegiatan->description }}
                                </p>
                                <a href="{{ route('activities.show', $kegiatan->slug) }}"
                                    class="inline-flex items-center gap-2 text-emerald-700 font-semibold text-sm hover:text-emerald-800 transition">
                                    Selengkapnya
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                        class="w-4 h-4">
                                        <path d="M13.5 4.5 21 12l-7.5 7.5M21 12H3" />
                                    </svg>
                                </a>
                            </div>
                        </article>
                    @endforeach

                    @foreach ($program->services as $layanan)
                        <article class="card  rounded-2xl bg-white shadow-sm hover:shadow-xl transition overflow-hidden"
                            data-aos="zoom-in" data-aos-delay="{{ ($program->activities->count() + $loop->index) * 80 }}">
                            <div class="relative overflow-hidden">
                                <img src="{{ Storage::url($layanan->image) }}" alt="{{ $layanan->title }}"
                                    class="card-image w-full h-56 object-cover">
                                <div class="absolute inset-0 bg-gradient-to-t from-black/40 via-transparent"></div>
                                <div class="absolute top-4 left-4">
                                    <span
                                        class="inline-flex items-center gap-1 bg-blue-500 text-white px-3 py-1 rounded-full text-xs font-semibold">Layanan</span>
                                </div>
                            </div>
                            <div class="p-6">
                                <h3 class="text-xl font-semibold mb-3">{{ $layanan->title }}</h3>
                                <p class="text-gray-600 text-sm leading-relaxed mb-4">
                                    Memastikan pelaksanaan sholat berjamaah lima waktu serta sholat Jumat dengan suasana
                                    yang khusyuk dan tertib.
                                </p>
                                @if ($layanan->link_url)
                                    <a href="{{ $layanan->link_url }}"
                                        class="inline-flex items-center gap-2 text-emerald-700 font-semibold text-sm hover:text-emerald-800 transition">
                                        {{ $layanan->link_text ?? 'Pelajari Lebih Lanjut' }}
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                            class="w-4 h-4">
                                            <path d="M13.5 4.5 21 12l-7.5 7.5M21 12H3" />
                                        </svg>
                                    </a>
                                @endif
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- ========================= CTA SECTION ========================= --}}
    <section
        class="relative py-16 bg-gradient-to-r from-emerald-700 via-emerald-600 to-emerald-700 text-white overflow-hidden">
        <div aria-hidden="true" class="absolute inset-0 dot-pattern opacity-20"></div>
        <div class="soft-container relative">
            <div class="text-center" data-aos="fade-up">
                <h2 class="text-3xl md:text-4xl font-extrabold">Bergabung dengan {{ $program->title }}</h2>
                <p class="mt-4 text-white/90 max-w-2xl mx-auto text-lg">
                    Jadilah bagian dari perjalanan membangun peradaban Islam melalui program-program dakwah yang inspiratif
                    dan bermanfaat
                </p>
                <div class="mt-8 flex flex-wrap gap-3 justify-center">
                    <a href="{{ route('activities.index') }}"
                        class="inline-flex items-center gap-2 px-6 py-3 rounded-xl bg-white text-emerald-700 font-semibold shadow hover:shadow-md transition">
                        Lihat Kegiatan
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5">
                            <path d="M13.5 4.5 21 12l-7.5 7.5M21 12H3" />
                        </svg>
                    </a>
                    <a href="{{ route('contact') }}"
                        class="inline-flex items-center gap-2 px-6 py-3 rounded-xl ring-1 ring-white/40 font-semibold hover:bg-white/10 transition">
                        Hubungi Kami
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection
