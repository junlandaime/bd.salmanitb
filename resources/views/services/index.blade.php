@extends('layouts.app')
@section('title', 'Layanan Bidang Dakwah Masjid Salman ITB')

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
        /* Subtle upgrades without changing data structure */
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

    {{-- ========================= HERO ========================= --}}
    <section
        class="relative isolate overflow-hidden bg-gradient-to-br from-emerald-700 via-emerald-600 to-emerald-700 text-white">
        <!-- Decorative blobs -->
        <div aria-hidden="true" class="absolute -top-24 -left-24 h-64 w-64 rounded-full bg-emerald-500/30 blur-3xl"></div>
        <div aria-hidden="true" class="absolute -bottom-24 -right-24 h-64 w-64 rounded-full bg-emerald-400/20 blur-3xl"></div>

        <div class="soft-container py-16 md:py-24">
            <div class="text-center max-w-3xl mx-auto" data-aos="fade-up">
                <p
                    class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white/10 ring-1 ring-white/20 section-badge text-sm">
                    <span class="i-lucide-sparkles"></span> Layanan Terbaik Untuk Umat
                </p>
                <h1 class="mt-4 text-4xl md:text-5xl font-extrabold leading-tight">Layanan Kami</h1>
                <p class="mt-4 text-lg text-white/90">
                    Berbagai layanan untuk memenuhi kebutuhan spiritual dan sosial umat
                </p>
            </div>
        </div>
    </section>

    {{-- ========================= SERVICES INTRO ========================= --}}
    <section class="py-16 bg-white">
        <div class="soft-container">
            <div class="text-center max-w-3xl mx-auto" data-aos="fade-up">
                <span class="inline-flex px-3 py-1 rounded-full bg-emerald-100 text-emerald-700 section-badge text-xs">
                    LAYANAN KAMI
                </span>
                <h2 class="mt-3 text-3xl md:text-4xl font-bold tracking-tight">Layanan Yang Kami Sediakan</h2>
                <p class="mt-4 text-gray-600">
                    Bidang Dakwah Salman ITB menyediakan berbagai layanan yang dirancang untuk memenuhi kebutuhan spiritual
                    dan sosial umat Islam di lingkungan Masjid Salman ITB dan sekitarnya.
                </p>
            </div>
        </div>
    </section>

    {{-- ========================= SERVICES GRID ========================= --}}
    <section class="py-16 bg-gray-50">
        <div class="soft-container">
            <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($services as $service)
                    <article class="card  rounded-2xl bg-white shadow-sm hover:shadow-xl transition overflow-hidden"
                        data-aos="fade-up" data-aos-delay="{{ $loop->index * 80 }}">
                        <div class="p-6">
                            @if ($service->icon)
                                <div
                                    class="inline-flex items-center justify-center w-14 h-14 rounded-2xl bg-gradient-to-br from-emerald-500 to-emerald-600 text-white shadow-lg mb-5">
                                    <i class="{{ $service->icon }} text-2xl"></i>
                                </div>
                            @endif

                            <h3 class="text-xl font-semibold text-gray-900">{{ $service->title }}</h3>

                            <div class="h-0.5 bg-gradient-to-r from-emerald-400 to-transparent w-16 my-4"></div>

                            <p class="text-gray-600 text-sm leading-relaxed">
                                {{ $service->description }}
                            </p>

                            @if ($service->link_url)
                                <div class="mt-6">
                                    <a href="{{ route('services.show', $service->slug) }}"
                                        class="inline-flex items-center gap-2 text-emerald-700 font-semibold hover:text-emerald-800 transition">
                                        {{ $service->link_text ?? 'Selengkapnya' }}
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                            class="w-4 h-4">
                                            <path d="M13.5 4.5 21 12l-7.5 7.5M21 12H3" />
                                        </svg>
                                    </a>
                                </div>
                            @endif
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ========================= CONTACT/CTA SECTION ========================= --}}
    <section class="relative py-16 bg-white overflow-hidden">
        <div class="soft-container">
            <div class="grid md:grid-cols-2 gap-10 items-center">
                <div data-aos="fade-right">
                    <span class="inline-flex px-3 py-1 rounded-full bg-sky-100 text-sky-700 section-badge text-xs">
                        HUBUNGI KAMI
                    </span>
                    <h3 class="mt-3 text-3xl md:text-4xl font-bold leading-tight">
                        Butuh Informasi Lebih Lanjut?
                    </h3>
                    <p class="mt-4 text-gray-600 leading-relaxed">
                        Tim kami siap membantu Anda dengan informasi lebih detail tentang layanan-layanan yang kami
                        sediakan.
                    </p>
                    <div class="mt-8">
                        <a href="{{ route('contact') }}"
                            class="inline-flex items-center gap-2 px-6 py-3 rounded-xl bg-emerald-600 text-white font-semibold shadow hover:shadow-md hover:bg-emerald-700 transition">
                            Hubungi Kami
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5">
                                <path d="M13.5 4.5 21 12l-7.5 7.5M21 12H3" />
                            </svg>
                        </a>
                    </div>
                </div>

                <div class="relative" data-aos="fade-left" data-aos-delay="100">
                    <div class=" rounded-2xl bg-gradient-to-br from-emerald-600 to-emerald-700 overflow-hidden shadow-xl">
                        <div class="relative">
                            <img alt="Contact Us" src="{{ asset('bd2.jpg') }}" class="w-full h-64 object-cover">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/40 via-transparent"></div>
                        </div>

                        <div class="p-8 text-white">
                            <h4 class="text-2xl font-bold">
                                Jam Operasional
                            </h4>
                            <div class="mt-4 space-y-2 text-white/90">
                                <div class="flex items-center gap-2">
                                    <div class="w-2 h-2 rounded-full bg-white/60"></div>
                                    <p>Senin - Jumat: 08:00 - 17:00</p>
                                </div>
                                <div class="flex items-center gap-2">
                                    <div class="w-2 h-2 rounded-full bg-white/60"></div>
                                    <p>Sabtu: 09:00 - 15:00</p>
                                </div>
                                <div class="flex items-center gap-2">
                                    <div class="w-2 h-2 rounded-full bg-white/60"></div>
                                    <p>Minggu: Tutup</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
