@extends('layouts.app')

@section('title', 'Kontak Kami - Bidang Dakwah Masjid Salman ITB')

@section('content')

{{-- ========================= HERO SECTION ========================= --}}
<section class="relative isolate overflow-hidden bg-gradient-to-br from-slate-900 via-emerald-950 to-teal-950 text-white py-12 md:py-20">
    <div aria-hidden="true" class="absolute -top-24 -left-24 h-80 w-80 rounded-full bg-emerald-500/20 blur-3xl pointer-events-none"></div>
    <div aria-hidden="true" class="absolute -bottom-24 -right-24 h-80 w-80 rounded-full bg-teal-400/15 blur-3xl pointer-events-none"></div>
    <div class="absolute inset-0 opacity-5 bg-[radial-gradient(#fff_1px,transparent_1px)] [background-size:20px_20px] pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="grid grid-cols-1 md:grid-cols-12 gap-8 items-center">
            <div class="md:col-span-7 space-y-4" data-aos="fade-right">
                <span class="inline-flex items-center gap-1.5 px-3.5 py-1 rounded-full bg-emerald-500/15 border border-emerald-400/30 text-emerald-300 text-xs font-semibold">
                    <span>💬</span>
                    <span>Layanan Informasi &amp; Kontak</span>
                </span>
                <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold tracking-tight text-white">
                    Hubungi Panitia &amp; Sekretariat
                </h1>
                <p class="text-slate-300 text-xs sm:text-sm leading-relaxed max-w-xl">
                    Punya pertanyaan seputar program pembinaan, pendaftaran kelas, konfirmasi pembayaran, atau layanan dakwah lainnya? Tim Bidang Dakwah Masjid Salman ITB siap membantu Anda.
                </p>
            </div>

            <div class="md:col-span-5" data-aos="fade-left">
                <div class="relative rounded-3xl p-2.5 bg-white/5 border border-white/15 backdrop-blur-md shadow-2xl">
                    <img src="{{ asset('bd2.jpg') }}" alt="Kontak Kami"
                        class="w-full aspect-[4/3] object-cover rounded-2xl shadow-inner" />
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ========================= CONTACT INFO CARDS ========================= --}}
<section class="py-16 bg-gray-50/70">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="text-center max-w-2xl mx-auto mb-12" data-aos="fade-down">
            <span class="inline-flex px-3 py-1 rounded-full bg-emerald-100 text-emerald-800 text-xs font-bold uppercase tracking-wider">
                Saluran Komunikasi
            </span>
            <h2 class="mt-3 text-2xl sm:text-3xl font-extrabold text-gray-900">
                Informasi &amp; Konsultasi
            </h2>
            <p class="mt-2 text-xs sm:text-sm text-gray-600">
                Silakan hubungi kami melalui saluran berikut pada jam kerja operasional.
            </p>
        </div>

        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3 mb-12">
            
            <!-- Address Card -->
            <div class="rounded-2xl bg-white border border-gray-200/80 p-6 sm:p-8 text-center shadow-xs hover:shadow-lg hover:border-emerald-300 transition-all duration-300 flex flex-col justify-between"
                data-aos="fade-up">
                <div class="space-y-4">
                    <div class="w-14 h-14 rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center text-2xl mx-auto">
                        📍
                    </div>
                    <h3 class="text-base font-bold text-gray-900">Alamat Sekretariat</h3>
                    <p class="text-xs text-gray-600 leading-relaxed">
                        {{ $landingPage->contact_address ?? 'Jl. Ganesa No.7, Lb. Siliwangi, Kecamatan Coblong, Kota Bandung, Jawa Barat 40132' }}
                    </p>
                </div>
                <div class="pt-6">
                    <a href="https://maps.google.com/?q=Masjid+Salman+ITB" target="_blank"
                        class="inline-flex items-center gap-1.5 text-xs font-bold text-emerald-600 hover:text-emerald-700">
                        <span>Buka di Google Maps</span>
                        <span>&rarr;</span>
                    </a>
                </div>
            </div>

            <!-- Email Card -->
            <div class="rounded-2xl bg-white border border-gray-200/80 p-6 sm:p-8 text-center shadow-xs hover:shadow-lg hover:border-blue-300 transition-all duration-300 flex flex-col justify-between"
                data-aos="fade-up" data-aos-delay="80">
                <div class="space-y-4">
                    <div class="w-14 h-14 rounded-2xl bg-blue-50 text-blue-600 flex items-center justify-center text-2xl mx-auto">
                        ✉️
                    </div>
                    <h3 class="text-base font-bold text-gray-900">Surat Elektronik</h3>
                    <p class="text-xs text-gray-600 leading-relaxed">
                        Kirimkan surat permohonan kerjasama, undangan, atau pertanyaan umum melalui email resmi kami.
                    </p>
                </div>
                <div class="pt-6">
                    <a href="mailto:{{ $landingPage->contact_email ?? 'bidangdakwah@salmanitb.com' }}"
                        class="inline-flex items-center gap-1.5 text-xs font-bold text-blue-600 hover:text-blue-700">
                        <span>{{ $landingPage->contact_email ?? 'bidangdakwah@salmanitb.com' }}</span>
                        <span>&rarr;</span>
                    </a>
                </div>
            </div>

            <!-- WhatsApp Card -->
            <div class="rounded-2xl bg-white border border-gray-200/80 p-6 sm:p-8 text-center shadow-xs hover:shadow-lg hover:border-emerald-300 transition-all duration-300 flex flex-col justify-between"
                data-aos="fade-up" data-aos-delay="160">
                <div class="space-y-4">
                    <div class="w-14 h-14 rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center text-2xl mx-auto">
                        💬
                    </div>
                    <h3 class="text-base font-bold text-gray-900">WhatsApp Resmi</h3>
                    <p class="text-xs text-gray-600 leading-relaxed">
                        Layanan chat cepat dan responsif bersama tim admin kami pada hari kerja.
                    </p>
                </div>
                <div class="pt-6">
                    @php
                        $cleanWa = preg_replace('/[^0-9]/', '', $landingPage->contact_whatsapp ?? '6285703952464');
                    @endphp
                    <a href="https://wa.me/{{ $cleanWa }}?text=Assalamu%27alaikum%20Admin%20Bidang%20Dakwah%20Salman%20ITB"
                        target="_blank"
                        class="inline-flex items-center justify-center gap-1.5 px-4 py-2 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs shadow-sm transition w-full">
                        <span>Chat via WhatsApp</span>
                        <span>&rarr;</span>
                    </a>
                </div>
            </div>

        </div>

        <!-- Operational Hours Banner -->
        <div class="rounded-2xl bg-white border border-gray-200/80 p-6 sm:p-8 shadow-xs max-w-4xl mx-auto" data-aos="fade-up">
            <div class="text-center mb-6">
                <span class="inline-flex px-3 py-1 rounded-full bg-purple-100 text-purple-800 text-xs font-bold uppercase tracking-wider">
                    Jam Kerja
                </span>
                <h3 class="mt-2 text-xl font-bold text-gray-900">Waktu Layanan Sekretariat</h3>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 max-w-2xl mx-auto">
                <div class="flex items-center gap-4 p-4 rounded-xl bg-emerald-50 border border-emerald-100">
                    <div class="w-10 h-10 rounded-xl bg-emerald-600 text-white flex items-center justify-center text-lg flex-shrink-0">
                        🕒
                    </div>
                    <div>
                        <p class="text-xs font-bold text-gray-900">Senin – Jumat</p>
                        <p class="text-xs text-emerald-800 font-medium">08.00 – 16.00 WIB</p>
                    </div>
                </div>

                <div class="flex items-center gap-4 p-4 rounded-xl bg-teal-50 border border-teal-100">
                    <div class="w-10 h-10 rounded-xl bg-teal-600 text-white flex items-center justify-center text-lg flex-shrink-0">
                        🕒
                    </div>
                    <div>
                        <p class="text-xs font-bold text-gray-900">Sabtu</p>
                        <p class="text-xs text-teal-800 font-medium">09.00 – 13.00 WIB</p>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>

{{-- ========================= GOOGLE MAPS EMBED ========================= --}}
<section class="py-12 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="rounded-3xl overflow-hidden border border-gray-200 shadow-sm aspect-[21/9] min-h-[350px]">
            <iframe
                title="Lokasi Masjid Salman ITB"
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3960.9998188185566!2d107.60840131477273!3d-6.890623295020815!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68e6504a74e50d%3A0xbb529b46f554e76c!2sMasjid%20Salman%20ITB!5e0!3m2!1sen!2sid!4v1652345678901!5m2!1sen!2sid"
                width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"
                referrerpolicy="no-referrer-when-downgrade">
            </iframe>
        </div>
    </div>
</section>

@endsection
