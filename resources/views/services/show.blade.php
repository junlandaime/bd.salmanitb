@extends('layouts.app')
@section('title', $service->title . ' - Layanan Bidang Dakwah Masjid Salman ITB')
@section('meta_description', Str::limit($service->description, 160))
@section('og_title', $service->title . ' - Layanan Bidang Dakwah Masjid Salman ITB')
@section('og_description', Str::limit($service->description, 200))
@section('og_image', 'https://bidangdakwah.salmanitb.com/storage/' . $service->featured_image)

@section('additional_meta_tags')

@endsection

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
    </style>

    {{-- ========================= HERO ========================= --}}
    <section
        class="relative isolate overflow-hidden bg-gradient-to-br from-emerald-700 via-emerald-600 to-emerald-700 text-white">
        <!-- Background Image Overlay -->
        <div class="absolute inset-0">
            <img src="{{ $service->image ? Storage::url($service->image) : 'https://picsum.photos/1920/1085' }}"
                alt="{{ $service->title }}" class="w-full h-full object-cover opacity-20">
        </div>

        <!-- Decorative blobs -->
        <div aria-hidden="true" class="absolute -top-24 -left-24 h-64 w-64 rounded-full bg-emerald-500/30 blur-3xl"></div>
        <div aria-hidden="true" class="absolute -bottom-24 -right-24 h-64 w-64 rounded-full bg-emerald-400/20 blur-3xl"></div>

        <div class="soft-container py-16 md:py-20 relative">
            <div class="text-center max-w-3xl mx-auto" data-aos="fade-up">
                <p
                    class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white/10 ring-1 ring-white/20 section-badge text-sm">
                    Layanan di bawah Program {{ $service->program->title }}
                </p>
                <h1 class="mt-4 text-4xl md:text-5xl font-extrabold leading-tight">{{ $service->title }}</h1>
            </div>
        </div>
    </section>

    {{-- ========================= SERVICE CONTENT ========================= --}}
    <section class="py-16 bg-gray-50">
        <div class="soft-container">
            <div class="grid lg:grid-cols-3 gap-8">
                <!-- Main Content -->
                <div class="lg:col-span-2">
                    <article class=" rounded-2xl bg-white shadow-sm p-8" data-aos="fade-up">
                        @if ($service->icon)
                            <div class="flex items-center gap-4 mb-6">
                                <div
                                    class="inline-flex items-center justify-center w-14 h-14 rounded-2xl bg-gradient-to-br from-emerald-500 to-emerald-600 text-white shadow-lg">
                                    <i class="{{ $service->icon }} text-2xl"></i>
                                </div>
                                <h2 class="text-3xl font-bold text-gray-900">{{ $service->title }}</h2>
                            </div>
                        @else
                            <h2 class="text-3xl font-bold text-gray-900 mb-6">{{ $service->title }}</h2>
                        @endif

                        <div class="h-0.5 bg-gradient-to-r from-emerald-400 to-transparent w-24 mb-8"></div>

                        <!-- Service Description -->
                        <div class="prose prose-lg max-w-none" data-aos="fade-up" data-aos-delay="100">
                            <p class="text-gray-700 leading-relaxed">
                                {{ $service->description }}
                            </p>
                        </div>

                        <!-- Call to Action -->
                        @if ($service->link_url)
                            <div class="mt-10" data-aos="fade-up" data-aos-delay="200">
                                <a href="{{ $service->link_url }}"
                                    class="inline-flex items-center gap-2 px-8 py-4 rounded-xl bg-emerald-600 text-white font-semibold shadow-lg hover:shadow-xl hover:bg-emerald-700 transition">
                                    {{ $service->link_text ?? 'Pelajari Lebih Lanjut' }}
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                        class="w-5 h-5">
                                        <path d="M13.5 4.5 21 12l-7.5 7.5M21 12H3" />
                                    </svg>
                                </a>
                            </div>
                        @endif
                    </article>
                </div>

                <!-- Sidebar -->
                <div class="lg:col-span-1 space-y-6">
                    <!-- Related Program -->
                    <aside class=" rounded-2xl bg-white shadow-sm overflow-hidden" data-aos="fade-left">
                        <div class="p-6">
                            <span
                                class="inline-flex px-3 py-1 rounded-full bg-violet-100 text-violet-700 section-badge text-xs mb-4">
                                PROGRAM TERKAIT
                            </span>
                            <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $service->program->title }}</h3>

                            <div class="h-0.5 bg-gradient-to-r from-violet-400 to-transparent w-16 mb-4"></div>

                            <p class="text-gray-600 text-sm mb-6">{{ $service->program->description }}</p>
                            <a href="{{ route('programs.show', $service->program->slug) }}"
                                class="inline-flex items-center gap-2 text-emerald-700 font-semibold hover:text-emerald-800 transition">
                                Lihat Detail Program
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                    class="w-4 h-4">
                                    <path d="M13.5 4.5 21 12l-7.5 7.5M21 12H3" />
                                </svg>
                            </a>
                        </div>
                    </aside>

                    <!-- Contact Info -->
                    <aside
                        class=" rounded-2xl bg-gradient-to-br from-emerald-600 to-emerald-700 text-white shadow-sm overflow-hidden"
                        data-aos="fade-left" data-aos-delay="100">
                        <div class="p-6">
                            <span
                                class="inline-flex px-3 py-1 rounded-full bg-white/20 ring-1 ring-white/30 section-badge text-xs mb-4">
                                BANTUAN
                            </span>
                            <h3 class="text-xl font-bold mb-4">Butuh Bantuan?</h3>

                            <div class="h-0.5 bg-white/30 w-16 mb-4"></div>

                            <p class="text-white/90 text-sm mb-6">
                                Jika Anda memiliki pertanyaan tentang layanan ini, jangan ragu untuk menghubungi kami.
                            </p>
                            <a href="{{ route('contact') }}"
                                class="inline-flex items-center justify-center gap-2 w-full px-6 py-3 rounded-xl bg-white text-emerald-700 font-semibold shadow-lg hover:shadow-xl transition">
                                Hubungi Kami
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                    class="w-5 h-5">
                                    <path d="M13.5 4.5 21 12l-7.5 7.5M21 12H3" />
                                </svg>
                            </a>
                        </div>
                    </aside>
                </div>
            </div>
        </div>
    </section>

    {{-- ========================= OTHER SERVICES ========================= --}}
    <section class="py-16 bg-white">
        <div class="soft-container">
            <div class="text-center mb-10" data-aos="fade-down">
                <span class="inline-flex px-3 py-1 rounded-full bg-sky-100 text-sky-700 section-badge text-xs">
                    LAYANAN LAINNYA
                </span>
                <h2 class="mt-3 text-3xl md:text-4xl font-bold tracking-tight">Layanan Lainnya</h2>
            </div>

            <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($service->program->services()->where('id', '!=', $service->id)->take(3)->get() as $otherService)
                    <article class="card  rounded-2xl bg-white shadow-sm hover:shadow-xl transition overflow-hidden"
                        data-aos="fade-up" data-aos-delay="{{ $loop->index * 80 }}">
                        <div class="p-6">
                            @if ($otherService->icon)
                                <div
                                    class="inline-flex items-center justify-center w-14 h-14 rounded-2xl bg-gradient-to-br from-emerald-500 to-emerald-600 text-white shadow-lg mb-5">
                                    <i class="{{ $otherService->icon }} text-2xl"></i>
                                </div>
                            @endif

                            <h3 class="text-xl font-semibold text-gray-900">{{ $otherService->title }}</h3>

                            <div class="h-0.5 bg-gradient-to-r from-emerald-400 to-transparent w-16 my-4"></div>

                            <p class="text-gray-600 text-sm leading-relaxed mb-6">
                                {{ Str::limit($otherService->description, 100) }}
                            </p>

                            <a href="{{ route('services.show', $otherService->slug) }}"
                                class="inline-flex items-center gap-2 text-emerald-700 font-semibold hover:text-emerald-800 transition">
                                Selengkapnya
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                    class="w-4 h-4">
                                    <path d="M13.5 4.5 21 12l-7.5 7.5M21 12H3" />
                                </svg>
                            </a>
                        </div>
                    </article>
                @endforeach
            </div>

            <div class="text-center mt-10" data-aos="fade-up">
                <a href="{{ route('services.index') }}"
                    class="inline-flex items-center gap-2 px-6 py-3 rounded-xl bg-emerald-600 text-white font-semibold shadow-lg hover:shadow-xl hover:bg-emerald-700 transition">
                    Lihat Semua Layanan
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5">
                        <path d="M13.5 4.5 21 12l-7.5 7.5M21 12H3" />
                    </svg>
                </a>
            </div>
        </div>
    </section>
@endsection
