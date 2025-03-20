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

@push('styles')
    <style>
        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        .card-hover {
            transition: all 0.3s ease;
        }
    </style>
@endpush

@section('content')
    <!-- Main Content -->
    <main class="">
        <!-- Hero Section -->
        <section id="contact-hero" class="py-16 bg-gray-100 md:px-40" data-aos="fade-in">
            <div class="container mx-auto px-4">
                <div class="flex flex-col md:flex-row items-center">
                    <div class="md:w-1/2 mb-8 md:mb-0" data-aos="fade-right" data-aos-delay="100">
                        <h1 class="text-4xl md:text-5xl font-bold mb-4">HUBUNGI KAMI</h1>
                        <h2 class="text-3xl md:text-4xl font-bold mb-6">Bidang Dakwah Salman ITB</h2>
                        <p class="text-gray-700 mb-8">
                            Kami siap membantu Anda dengan pertanyaan, saran, atau kebutuhan informasi seputar program dan
                            kegiatan Bidang Dakwah Masjid Salman ITB. Jangan ragu untuk menghubungi kami melalui berbagai
                            saluran yang tersedia.
                        </p>
                    </div>
                    <div class="md:w-1/2 flex justify-center " data-aos="fade-left" data-aos-delay="200">
                        <img src="{{ asset('bd2.jpg') }}" alt="Kontak Kami" class="w-full max-w-md rounded-xl">
                    </div>
                </div>
            </div>
        </section>

        <!-- Contact Information Section -->
        <section class="py-16 md:px-40" data-aos="fade-up">
            <div class="container mx-auto px-4">
                <h2 class="text-3xl font-bold text-center mb-12">Informasi Kontak</h2>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <!-- Address Card -->
                    <div class="bg-white rounded-lg shadow-lg p-8 text-center card-hover" data-aos="fade-up"
                        data-aos-delay="100">
                        <div class="bg-green-100 w-16 h-16 mx-auto rounded-full flex items-center justify-center mb-4">
                            <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                </path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold mb-2">Alamat</h3>
                        <p class="text-gray-600">Jl. Ganesa No.7, Lb. Siliwangi, Kecamatan Coblong, Kota Bandung, Jawa Barat
                            40132</p>
                    </div>

                    <!-- Email Card -->
                    <div class="bg-white rounded-lg shadow-lg p-8 text-center card-hover" data-aos="fade-up"
                        data-aos-delay="200">
                        <div class="bg-green-100 w-16 h-16 mx-auto rounded-full flex items-center justify-center mb-4">
                            <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                                </path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold mb-2">Email</h3>
                        <a href="mailto:{{ $landingPage->contact_email }}" target="_blank"
                            class="text-green-600 hover:text-green-800">{{ $landingPage->contact_email }}</a>
                    </div>

                    <!-- Phone Card -->
                    <div class="bg-white rounded-lg shadow-lg p-8 text-center card-hover" data-aos="fade-up"
                        data-aos-delay="300">
                        <div class="bg-green-100 w-16 h-16 mx-auto rounded-full flex items-center justify-center mb-4">
                            <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z">
                                </path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold mb-2">WhatsApp</h3>
                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $landingPage->contact_whatsapp) }}"
                            target="_blank"
                            class="text-green-600 hover:text-green-800">{{ $landingPage->contact_whatsapp }}</a>
                    </div>
                </div>

                <div class="mt-12 bg-white rounded-lg shadow-lg p-8" data-aos="fade-up" data-aos-delay="400">
                    <h3 class="text-xl font-semibold mb-4">Jam Operasional</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="flex items-center">
                            <div class="bg-green-100 w-12 h-12 rounded-full flex items-center justify-center mr-4">
                                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="font-medium">Senin - Jumat</p>
                                <p class="text-gray-600">08.00 - 16.00 WIB</p>
                            </div>
                        </div>
                        <div class="flex items-center">
                            <div class="bg-green-100 w-12 h-12 rounded-full flex items-center justify-center mr-4">
                                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="font-medium">Sabtu</p>
                                <p class="text-gray-600">09.00 - 13.00 WIB</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Consultation Section -->
        <section class="py-16 bg-gray-50 md:px-40" data-aos="fade-in">
            <div class="container mx-auto px-4">
                <div class="max-w-4xl mx-auto">
                    <h2 class="text-3xl font-bold text-center mb-8" data-aos="fade-up">Konsultasi Langsung</h2>
                    <p class="text-center text-gray-600 mb-12" data-aos="fade-up" data-aos-delay="100">
                        Kami menyediakan layanan konsultasi langsung melalui WhatsApp untuk membantu Anda dengan pertanyaan
                        seputar program dan kegiatan kami.
                    </p>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <!-- Konsultasi Program -->
                        <div class="bg-white rounded-lg shadow-lg overflow-hidden card-hover" data-aos="fade-up"
                            data-aos-delay="200">
                            <div class="p-6 border-b border-gray-200">
                                <h3 class="text-xl font-bold text-gray-900">Konsultasi Program</h3>
                            </div>
                            <div class="p-6">
                                <p class="text-gray-600 mb-6">
                                    Konsultasikan kebutuhan Anda seputar program-program yang kami selenggarakan, termasuk
                                    jadwal, biaya, dan persyaratan.
                                </p>
                                <a target="_blank"
                                    href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $landingPage->contact_whatsapp) }}?text=Assalamu'alaikum,%20saya%20ingin%20konsultasi%20tentang%20program%20Bidang%20Dakwah%20Salman%20ITB"
                                    class="inline-flex items-center justify-center px-5 py-3 border border-transparent text-base font-medium rounded-md text-white bg-green-600 hover:bg-green-700 w-full">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="currentColor"
                                        viewBox="0 0 24 24">
                                        <path
                                            d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z" />
                                    </svg>
                                    Konsultasi via WhatsApp
                                </a>
                            </div>
                        </div>

                        <!-- Konsultasi Keislaman -->
                        <div class="bg-white rounded-lg shadow-lg overflow-hidden card-hover" data-aos="fade-up"
                            data-aos-delay="300">
                            <div class="p-6 border-b border-gray-200">
                                <h3 class="text-xl font-bold text-gray-900">Konsultasi Keislaman</h3>
                            </div>
                            <div class="p-6">
                                <p class="text-gray-600 mb-6">
                                    Ajukan pertanyaan seputar keislaman dan kehidupan sehari-hari kepada ustadz dan ustadzah
                                    yang berkompeten di bidangnya.
                                </p>
                                <a target="_blank"
                                    href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $landingPage->contact_whatsapp) }}?text=Assalamu'alaikum,%20saya%20ingin%20berkonsultasi%20tentang%20masalah%20keislaman"
                                    class="inline-flex items-center justify-center px-5 py-3 border border-transparent text-base font-medium rounded-md text-white bg-green-600 hover:bg-green-700 w-full">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="currentColor"
                                        viewBox="0 0 24 24">
                                        <path
                                            d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z" />
                                    </svg>
                                    Konsultasi via WhatsApp
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Map Section -->
        <section class="py-16 md:px-40" data-aos="fade-up">
            <div class="container mx-auto px-4">
                <h2 class="text-3xl font-bold text-center mb-12">Lokasi Kami</h2>
                <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                    <div class="aspect-w-16 aspect-h-9">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d990.2430774148318!2d107.61088000121023!3d-6.89391551305945!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68e7000a9b75bb%3A0xa7340eec78bacc1d!2sBidang%20Dakwah%20YPM%20Salman%20ITB!5e0!3m2!1sid!2sid!4v1742397564575!5m2!1sid!2sid"
                            width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
            </div>
        </section>

        <!-- FAQ Section -->
        <section class="py-16 bg-gray-50 md:px-40" data-aos="fade-in">
            <div class="container mx-auto px-4">
                <h2 class="text-3xl font-bold text-center mb-8" data-aos="fade-up">Pertanyaan Umum (FAQ)</h2>
                <p class="text-center text-gray-600 mb-12 max-w-3xl mx-auto" data-aos="fade-up" data-aos-delay="100">
                    Berikut adalah beberapa pertanyaan yang sering diajukan tentang program dan kegiatan kami.
                </p>

                <div class="max-w-4xl mx-auto" x-data="{ selected: null }">
                    @php
                        $faqs = App\Models\ActivityFaq::with('activity')->inRandomOrder()->take(10)->get();
                    @endphp

                    @forelse($faqs as $index => $faq)
                        <div class="mb-4 rounded-lg bg-white shadow-md overflow-hidden" data-aos="fade-up"
                            data-aos-delay="{{ $index * 50 }}">
                            <div @click="selected !== {{ $index }} ? selected = {{ $index }} : selected = null"
                                class="flex items-center justify-between p-4 cursor-pointer"
                                :class="{ 'bg-green-50 text-green-700': selected == {{ $index }} }">
                                <div>
                                    <h3 class="font-medium">{{ $faq->question }}</h3>
                                    <p class="text-sm text-gray-500 mt-1">Kegiatan: {{ $faq->activity->title }}</p>
                                </div>
                                <svg class="w-5 h-5 transition-transform duration-300"
                                    :class="{ 'rotate-180': selected == {{ $index }} }" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </div>
                            <div x-show="selected == {{ $index }}"
                                x-transition:enter="transition ease-out duration-200"
                                x-transition:enter-start="opacity-0 transform -translate-y-4"
                                x-transition:enter-end="opacity-100 transform translate-y-0"
                                x-transition:leave="transition ease-in duration-150"
                                x-transition:leave-start="opacity-100 transform translate-y-0"
                                x-transition:leave-end="opacity-0 transform -translate-y-4"
                                class="p-4 bg-white border-t border-gray-200">
                                <p class="text-gray-700">{{ $faq->answer }}</p>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-8 bg-white rounded-lg shadow-md" data-aos="fade-up">
                            <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                                </path>
                            </svg>
                            <h3 class="text-lg font-medium text-gray-900 mb-2">Belum ada FAQ</h3>
                            <p class="text-gray-500">Pertanyaan umum akan ditampilkan di sini.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </section>

        <!-- CTA Section -->
        <section class="relative bg-green-500 py-20 overflow-hidden" data-aos="fade-in">
            <!-- Animated Wave Background -->
            <div class="absolute inset-0 opacity-10">
                <svg class="w-full h-full" viewBox="0 0 1440 320" preserveAspectRatio="none">
                    <path fill="currentColor"
                        d="M0,192L48,197.3C96,203,192,213,288,229.3C384,245,480,267,576,250.7C672,235,768,181,864,181.3C960,181,1056,235,1152,234.7C1248,235,1344,181,1392,154.7L1440,128L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z">
                    </path>
                </svg>
            </div>

            <div class="container mx-auto px-4 relative z-10">
                <div class="max-w-4xl mx-auto text-center text-white">
                    <h2 class="text-3xl md:text-4xl font-bold mb-6" data-aos="fade-up">Ada Pertanyaan Lain?</h2>
                    <p class="text-lg md:text-xl mb-8 opacity-90" data-aos="fade-up" data-aos-delay="100">
                        Jika Anda memiliki pertanyaan lain yang belum terjawab, jangan ragu untuk menghubungi kami.
                    </p>
                    <div class="flex flex-col sm:flex-row justify-center gap-4" data-aos="fade-up" data-aos-delay="200">
                        <a href="mailto:{{ $landingPage->contact_email }}" target="_blank"
                            class="inline-flex items-center justify-center px-5 py-3 border border-transparent text-base font-medium rounded-md text-green-700 bg-white hover:bg-gray-100">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                                </path>
                            </svg>
                            Kirim Email
                        </a>
                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $landingPage->contact_whatsapp) }}"
                            target="_blank"
                            class="inline-flex items-center justify-center px-5 py-3 border border-transparent text-base font-medium rounded-md text-green-700 bg-white hover:bg-gray-100">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="currentColor"
                                viewBox="0 0 24 24">
                                <path
                                    d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z" />
                            </svg>
                            WhatsApp
                        </a>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
