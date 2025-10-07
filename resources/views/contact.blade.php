@extends('layouts.app')

@section('title', 'Kontak Kami - Bidang Dakwah Masjid Salman ITB')

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
            <div class="grid grid-cols-1 md:grid-cols-2 gap-10 items-center">
                <div data-aos="fade-right" data-aos-duration="800">
                    <p
                        class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white/10 ring-1 ring-white/20 section-badge text-sm">
                        <span class="i-lucide-mail"></span> Mari Terhubung
                    </p>
                    <h1 class="mt-4 text-4xl md:text-5xl font-extrabold leading-tight">HUBUNGI KAMI</h1>
                    <h2 class="mt-2 text-2xl md:text-3xl font-semibold">Bidang Dakwah Salman ITB</h2>
                    <p class="mt-6 text-white/90 leading-relaxed">
                        Kami siap membantu Anda dengan pertanyaan, saran, atau kebutuhan informasi seputar program dan
                        kegiatan Bidang Dakwah Masjid Salman ITB. Jangan ragu untuk menghubungi kami melalui berbagai
                        saluran yang tersedia.
                    </p>
                </div>
                <div class="relative" data-aos="fade-left" data-aos-duration="800" data-aos-delay="100">
                    <div class="glass rounded-2xl p-2 ">
                        <img src="{{ asset('bd2.jpg') }}" alt="Kontak Kami"
                            class="card-image w-full aspect-square object-cover rounded-2xl" />
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ========================= CONTACT INFORMATION ========================= --}}
    <section class="py-16 bg-white">
        <div class="soft-container">
            <div class="text-center mb-10" data-aos="fade-down">
                <span class="inline-flex px-3 py-1 rounded-full bg-emerald-100 text-emerald-700 section-badge text-xs">
                    INFORMASI KONTAK
                </span>
                <h2 class="mt-3 text-3xl md:text-4xl font-bold tracking-tight">Hubungi Kami</h2>
            </div>

            <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3 mb-10">
                <!-- Address Card -->
                <article class="card  rounded-2xl bg-white shadow-sm hover:shadow-xl transition text-center p-8"
                    data-aos="fade-up" data-aos-delay="0">
                    <div
                        class="inline-flex items-center justify-center w-16 h-16 rounded-2xl bg-gradient-to-br from-emerald-500 to-emerald-600 text-white shadow-lg mb-5">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                            </path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Alamat</h3>
                    <div class="h-0.5 bg-gradient-to-r from-emerald-400 to-transparent w-16 mx-auto mb-4"></div>
                    <p class="text-gray-600 text-sm">Jl. Ganesa No.7, Lb. Siliwangi, Kecamatan Coblong, Kota Bandung, Jawa
                        Barat 40132</p>
                </article>

                <!-- Email Card -->
                <article class="card  rounded-2xl bg-white shadow-sm hover:shadow-xl transition text-center p-8"
                    data-aos="fade-up" data-aos-delay="80">
                    <div
                        class="inline-flex items-center justify-center w-16 h-16 rounded-2xl bg-gradient-to-br from-blue-500 to-blue-600 text-white shadow-lg mb-5">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                            </path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Email</h3>
                    <div class="h-0.5 bg-gradient-to-r from-blue-400 to-transparent w-16 mx-auto mb-4"></div>
                    <a href="mailto:{{ $landingPage->contact_email }}" target="_blank"
                        class="text-emerald-600 hover:text-emerald-800 font-medium transition">
                        {{ $landingPage->contact_email }}
                    </a>
                </article>

                <!-- WhatsApp Card -->
                <article class="card  rounded-2xl bg-white shadow-sm hover:shadow-xl transition text-center p-8"
                    data-aos="fade-up" data-aos-delay="160">
                    <div
                        class="inline-flex items-center justify-center w-16 h-16 rounded-2xl bg-gradient-to-br from-green-500 to-green-600 text-white shadow-lg mb-5">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z">
                            </path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">WhatsApp</h3>
                    <div class="h-0.5 bg-gradient-to-r from-green-400 to-transparent w-16 mx-auto mb-4"></div>
                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $landingPage->contact_whatsapp) }}"
                        target="_blank" class="text-emerald-600 hover:text-emerald-800 font-medium transition">
                        {{ $landingPage->contact_whatsapp }}
                    </a>
                </article>
            </div>

            <!-- Operating Hours -->
            <div class=" rounded-2xl bg-white shadow-sm p-8" data-aos="fade-up">
                <div class="text-center mb-6">
                    <span class="inline-flex px-3 py-1 rounded-full bg-violet-100 text-violet-700 section-badge text-xs">
                        JAM OPERASIONAL
                    </span>
                    <h3 class="mt-3 text-2xl font-bold">Waktu Layanan</h3>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 max-w-2xl mx-auto">
                    <div class="flex items-center gap-4 p-4 rounded-xl bg-emerald-50">
                        <div
                            class="inline-flex items-center justify-center w-12 h-12 rounded-xl bg-emerald-600 text-white flex-shrink-0">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="font-semibold text-gray-900">Senin - Jumat</p>
                            <p class="text-gray-600 text-sm">08.00 - 16.00 WIB</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-4 p-4 rounded-xl bg-sky-50">
                        <div
                            class="inline-flex items-center justify-center w-12 h-12 rounded-xl bg-sky-600 text-white flex-shrink-0">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="font-semibold text-gray-900">Sabtu</p>
                            <p class="text-gray-600 text-sm">09.00 - 13.00 WIB</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ========================= CONSULTATION SECTION ========================= --}}
    <section class="py-16 bg-gray-50">
        <div class="soft-container">
            <div class="text-center mb-10" data-aos="fade-down">
                <span class="inline-flex px-3 py-1 rounded-full bg-blue-100 text-blue-700 section-badge text-xs">
                    KONSULTASI
                </span>
                <h2 class="mt-3 text-3xl md:text-4xl font-bold tracking-tight">Konsultasi Langsung</h2>
                <p class="mt-3 text-gray-600 max-w-3xl mx-auto">
                    Kami menyediakan layanan konsultasi langsung melalui WhatsApp untuk membantu Anda dengan pertanyaan
                    seputar program dan kegiatan kami.
                </p>
            </div>

            <div class="grid gap-6 sm:grid-cols-2 max-w-4xl mx-auto">
                <!-- Konsultasi Program -->
                <article class="card  rounded-2xl bg-white shadow-sm hover:shadow-xl transition overflow-hidden"
                    data-aos="fade-up" data-aos-delay="0">
                    <div class="p-6 bg-gradient-to-br from-emerald-500 to-emerald-600 text-white">
                        <h3 class="text-xl font-bold">Konsultasi Program</h3>
                    </div>
                    <div class="p-6">
                        <p class="text-gray-600 text-sm leading-relaxed mb-6">
                            Konsultasikan kebutuhan Anda seputar program-program yang kami selenggarakan, termasuk jadwal,
                            biaya, dan persyaratan.
                        </p>
                        <a target="_blank"
                            href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $landingPage->contact_whatsapp) }}?text=Assalamu'alaikum,%20saya%20ingin%20konsultasi%20tentang%20program%20Bidang%20Dakwah%20Salman%20ITB"
                            class="inline-flex items-center justify-center gap-2 w-full px-5 py-3 rounded-xl bg-emerald-600 text-white font-semibold shadow-lg hover:shadow-xl hover:bg-emerald-700 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor"
                                viewBox="0 0 24 24">
                                <path
                                    d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z" />
                            </svg>
                            Konsultasi via WhatsApp
                        </a>
                    </div>
                </article>

                <!-- Konsultasi Keislaman -->
                <article class="card  rounded-2xl bg-white shadow-sm hover:shadow-xl transition overflow-hidden"
                    data-aos="fade-up" data-aos-delay="80">
                    <div class="p-6 bg-gradient-to-br from-violet-500 to-violet-600 text-white">
                        <h3 class="text-xl font-bold">Konsultasi Keislaman</h3>
                    </div>
                    <div class="p-6">
                        <p class="text-gray-600 text-sm leading-relaxed mb-6">
                            Ajukan pertanyaan seputar keislaman dan kehidupan sehari-hari kepada ustadz dan ustadzah yang
                            berkompeten di bidangnya.
                        </p>
                        <a target="_blank"
                            href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $landingPage->contact_whatsapp) }}?text=Assalamu'alaikum,%20saya%20ingin%20berkonsultasi%20tentang%20masalah%20keislaman"
                            class="inline-flex items-center justify-center gap-2 w-full px-5 py-3 rounded-xl bg-violet-600 text-white font-semibold shadow-lg hover:shadow-xl hover:bg-violet-700 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor"
                                viewBox="0 0 24 24">
                                <path
                                    d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z" />
                            </svg>
                            Konsultasi via WhatsApp
                        </a>
                    </div>
                </article>
            </div>
        </div>
    </section>

    {{-- ========================= MAP SECTION ========================= --}}
    <section class="py-16 bg-white">
        <div class="soft-container">
            <div class="text-center mb-10" data-aos="fade-down">
                <span class="inline-flex px-3 py-1 rounded-full bg-blue-100 text-blue-700 section-badge text-xs">
                    LOKASI
                </span>
                <h2 class="mt-3 text-3xl md:text-4xl font-bold tracking-tight">Lokasi Kami</h2>
            </div>
            <div class=" rounded-2xl bg-white shadow-sm overflow-hidden" data-aos="fade-up">
                <div class="aspect-w-16 aspect-h-9">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d990.2430774148318!2d107.61088000121023!3d-6.89391551305945!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68e7000a9b75bb%3A0xa7340eec78bacc1d!2sBidang%20Dakwah%20YPM%20Salman%20ITB!5e0!3m2!1sid!2sid!4v1742397564575!5m2!1sid!2sid"
                        width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade" class="w-full h-96"></iframe>
                </div>
            </div>
        </div>
    </section>

    {{-- ========================= FAQ SECTION ========================= --}}
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="text-center mb-10" data-aos="fade-down">
                <span class="inline-flex px-3 py-1 rounded-full bg-amber-100 text-amber-700 section-badge text-xs">
                    FAQ
                </span>
                <h2 class="mt-3 text-3xl md:text-4xl font-bold tracking-tight">Pertanyaan Umum</h2>
                <p class="mt-3 text-gray-600 max-w-3xl mx-auto">
                    Berikut adalah beberapa pertanyaan yang sering diajukan tentang program dan kegiatan kami.
                </p>
            </div>

            <div class="max-w-4xl mx-auto" x-data="{ selected: null }">
                @php
                    $faqs = App\Models\ActivityFaq::with('activity')->inRandomOrder()->take(10)->get();
                @endphp

                @forelse($faqs as $index => $faq)
                    <div class="mb-4  rounded-2xl bg-white shadow-sm overflow-hidden" data-aos="fade-up"
                        data-aos-delay="{{ $index * 50 }}">
                        <div @click="selected !== {{ $index }} ? selected = {{ $index }} : selected = null"
                            class="flex items-center justify-between p-6 cursor-pointer hover:bg-emerald-50 transition"
                            :class="{ 'bg-emerald-50': selected === {{ $index }} }">
                            <div class="flex-1 pr-4">
                                <h3 class="font-semibold text-gray-900"
                                    :class="{ 'text-emerald-700': selected === {{ $index }} }">
                                    {{ $faq->question }}
                                </h3>
                                <p class="text-xs text-gray-500 mt-1">
                                    <span class="inline-flex items-center gap-1">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z">
                                            </path>
                                        </svg>
                                        Kegiatan: {{ $faq->activity->title }}
                                    </span>
                                </p>
                            </div>
                            <svg class="w-5 h-5 transition-transform duration-300 flex-shrink-0"
                                :class="{
                                    'rotate-180': selected === {{ $index }},
                                    'text-emerald-700': selected === {{ $index }}
                                }"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                                </path>
                            </svg>
                        </div>
                        <div x-show="selected === {{ $index }}"
                            x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 transform -translate-y-4"
                            x-transition:enter-end="opacity-100 transform translate-y-0"
                            x-transition:leave="transition ease-in duration-150"
                            x-transition:leave-start="opacity-100 transform translate-y-0"
                            x-transition:leave-end="opacity-0 transform -translate-y-4"
                            class="px-6 pb-6 bg-white border-t border-gray-100" style="display: none;">
                            <p class="text-gray-700 text-sm leading-relaxed pt-4">{{ $faq->answer }}</p>
                        </div>
                    </div>
                @empty
                    <div class=" rounded-2xl bg-white shadow-sm text-center py-12" data-aos="fade-up">
                        <div
                            class="inline-flex items-center justify-center w-16 h-16 rounded-2xl bg-gray-100 text-gray-400 mb-4">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                                </path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">Belum ada FAQ</h3>
                        <p class="text-gray-500 text-sm">Pertanyaan umum akan ditampilkan di sini.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    {{-- ========================= CTA SECTION ========================= --}}
    <section
        class="relative py-16 bg-gradient-to-r from-emerald-700 via-emerald-600 to-emerald-700 text-white overflow-hidden">
        <div aria-hidden="true" class="absolute inset-0 dot-pattern opacity-20"></div>
        <div class="soft-container relative">
            <div class="text-center max-w-4xl mx-auto" data-aos="fade-up">
                <h2 class="text-3xl md:text-4xl font-extrabold mb-6">Ada Pertanyaan Lain?</h2>
                <p class="text-lg md:text-xl mb-8 text-white/90">
                    Jika Anda memiliki pertanyaan lain yang belum terjawab, jangan ragu untuk menghubungi kami.
                </p>
                <div class="flex flex-col sm:flex-row justify-center gap-4" data-aos="fade-up" data-aos-delay="200">
                    <a href="mailto:{{ $landingPage->contact_email }}" target="_blank"
                        class="inline-flex items-center justify-center gap-2 px-6 py-3 rounded-xl bg-white text-emerald-700 font-semibold shadow-lg hover:shadow-xl transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                            </path>
                        </svg>
                        Kirim Email
                    </a>
                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $landingPage->contact_whatsapp) }}"
                        target="_blank"
                        class="inline-flex items-center justify-center gap-2 px-6 py-3 rounded-xl bg-white text-emerald-700 font-semibold shadow-lg hover:shadow-xl transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z" />
                        </svg>
                        WhatsApp
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection
