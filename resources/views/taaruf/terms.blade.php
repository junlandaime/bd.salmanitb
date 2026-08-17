@extends('layouts.app')

@section('title', 'Syarat dan Ketentuan Ta\'aruf - Bidang Dakwah Salman ITB')

@section('content')
<div class="min-h-screen bg-gray-50/70 py-8" x-data="{ agreed: false }">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
        
        <!-- Header Card -->
        <div class="bg-gradient-to-br from-slate-900 via-rose-950 to-pink-950 rounded-3xl text-white p-6 sm:p-8 shadow-lg relative overflow-hidden">
            <div class="absolute inset-0 opacity-10 bg-[radial-gradient(#fff_1px,transparent_1px)] [background-size:16px_16px]"></div>
            
            <div class="relative z-10">
                <nav class="flex items-center gap-2 text-xs text-rose-300/80 mb-3 font-medium">
                    <a href="{{ route('alumni.dashboard') }}" class="hover:text-white transition">Dashboard Alumni</a>
                    <span>/</span>
                    <a href="{{ route('taaruf.index') }}" class="hover:text-white transition">Ta'aruf</a>
                    <span>/</span>
                    <span class="text-white font-semibold">Syarat &amp; Ketentuan</span>
                </nav>

                <h1 class="text-2xl sm:text-3xl font-bold tracking-tight text-white">
                    Syarat &amp; Ketentuan Layanan Ta'aruf
                </h1>
                <p class="text-xs sm:text-sm text-slate-300 mt-1">
                    Pahami kode etik dan panduan syariat sebelum mengaktifkan profil ta'aruf Anda.
                </p>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <!-- Left 2 Cols: Terms Content -->
            <div class="lg:col-span-2 space-y-6">
                
                <div class="bg-white rounded-2xl border border-gray-200/80 shadow-sm p-6 sm:p-8 space-y-6 text-xs sm:text-sm text-gray-700 leading-relaxed">
                    
                    <div>
                        <h3 class="text-base font-bold text-gray-900 flex items-center gap-2 mb-2">
                            <span class="w-6 h-6 rounded-lg bg-rose-50 text-rose-600 text-xs flex items-center justify-center font-bold">1</span>
                            Tujuan Fitur Ta'aruf
                        </h3>
                        <p class="text-gray-600 pl-8">
                            Fitur Ta'aruf Bidang Dakwah Masjid Salman ITB bertujuan memfasilitasi proses perkenalan (ta'aruf) yang bernilai ibadah dan sesuai syariat Islam khusus bagi alumni Sekolah Pranikah yang siap dan berkomitmen menuju pernikahan.
                        </p>
                    </div>

                    <div class="pt-4 border-t border-gray-100">
                        <h3 class="text-base font-bold text-gray-900 flex items-center gap-2 mb-2">
                            <span class="w-6 h-6 rounded-lg bg-rose-50 text-rose-600 text-xs flex items-center justify-center font-bold">2</span>
                            Persyaratan Peserta Ta'aruf
                        </h3>
                        <ul class="list-disc pl-12 space-y-1.5 text-gray-600">
                            <li>Alumni resmi Sekolah Pranikah (SPN Online / Offline) Salman ITB.</li>
                            <li>Telah mengaktifkan akun alumni pada portal resmi.</li>
                            <li>Berusia minimal 18 tahun dan mandiri secara syar'i.</li>
                            <li>Memiliki niat serius dan bertekad menikah dalam waktu yang wajar.</li>
                            <li>Wajib mengisi seluruh data biodata dengan jujur, akurat, dan dapat dipertanggungjawabkan.</li>
                        </ul>
                    </div>

                    <div class="pt-4 border-t border-gray-100">
                        <h3 class="text-base font-bold text-gray-900 flex items-center gap-2 mb-2">
                            <span class="w-6 h-6 rounded-lg bg-rose-50 text-rose-600 text-xs flex items-center justify-center font-bold">3</span>
                            Kerahasiaan Data &amp; Privasi
                        </h3>
                        <p class="text-gray-600 pl-8 mb-2">
                            Seluruh data dan privasi peserta dijaga ketat dalam sistem Bidang Dakwah Salman ITB:
                        </p>
                        <ul class="list-disc pl-12 space-y-1.5 text-gray-600">
                            <li>Data hanya dapat dilihat oleh alumni lawan jenis yang sama-sama berstatus aktif dan menyetujui ketentuan ini.</li>
                            <li>Kontak pribadi (No. HP/WA) tidak dipublikasikan secara bebas di katalog umum demi menjaga adab.</li>
                            <li>Dilarang keras menyebarluaskan, mengambil tangkapan layar (*screenshot*), atau mendistribusikan data peserta ke pihak luar.</li>
                        </ul>
                    </div>

                    <div class="pt-4 border-t border-gray-100">
                        <h3 class="text-base font-bold text-gray-900 flex items-center gap-2 mb-2">
                            <span class="w-6 h-6 rounded-lg bg-rose-50 text-rose-600 text-xs flex items-center justify-center font-bold">4</span>
                            Kode Etik Komunikasi
                        </h3>
                        <p class="text-gray-600 pl-8">
                            Pertanyaan dan komunikasi antar peserta wajib santun, fokus pada keselarasan visi ibadah, tidak berlebihan (*ghuluw*), dan menghindari percakapan yang mengarah pada khalwat atau pacaran.
                        </p>
                    </div>

                </div>

            </div>

            <!-- Right 1 Col: Agreement Form -->
            <div class="space-y-6">
                
                <div class="bg-white rounded-2xl border border-gray-200/80 shadow-sm p-6">
                    <h3 class="text-sm font-bold text-gray-900 pb-3 border-b border-gray-100 mb-4">
                        Pernyataan Persetujuan
                    </h3>

                    <form action="{{ route('taaruf.terms.accept') }}" method="POST" class="space-y-4">
                        @csrf
                        
                        <label class="flex items-start gap-3 p-3.5 rounded-xl border border-gray-200 bg-gray-50/70 hover:bg-gray-100/60 cursor-pointer transition">
                            <input id="agree" name="agree" type="checkbox" required x-model="agreed"
                                class="mt-0.5 w-4 h-4 rounded text-rose-600 border-gray-300 focus:ring-rose-500">
                            <span class="text-xs text-gray-700 leading-snug select-none">
                                Saya telah membaca, memahami, dan berjanji mematuhi seluruh <strong>Syarat &amp; Ketentuan</strong> layanan Ta'aruf Salman ITB.
                            </span>
                        </label>

                        <button type="submit" :disabled="!agreed"
                            :class="agreed ? 'bg-gradient-to-r from-rose-500 to-pink-500 hover:from-rose-600 hover:to-pink-600 text-white cursor-pointer shadow-md shadow-pink-500/20' : 'bg-gray-100 text-gray-400 border border-gray-200 cursor-not-allowed'"
                            class="w-full inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl font-semibold text-xs transition duration-150">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            <span>Setuju &amp; Lanjutkan</span>
                        </button>

                        <a href="{{ route('taaruf.index') }}"
                            class="w-full inline-flex items-center justify-center gap-2 px-4 py-2 rounded-xl border border-gray-300 bg-white hover:bg-gray-50 text-gray-700 font-semibold text-xs transition">
                            Batal
                        </a>
                    </form>
                </div>

                <!-- Info Help Card -->
                <div class="bg-gradient-to-br from-slate-900 to-slate-800 rounded-2xl text-white p-6 shadow-sm">
                    <div class="text-rose-400 text-lg mb-2">🛡️</div>
                    <h4 class="text-xs font-bold text-white mb-1.5">Kenyamanan &amp; Keamanan Anda</h4>
                    <p class="text-xs text-slate-300 leading-relaxed">
                        Anda dapat menonaktifkan visibilitas profil ta'aruf Anda sewaktu-waktu dari Dashboard Ta'aruf jika sedang dalam proses khitbah atau menikah.
                    </p>
                </div>

            </div>

        </div>

    </div>
</div>
@endsection
