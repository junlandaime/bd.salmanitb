@extends('layouts.app')

@section('title', 'Syarat dan Ketentuan Ta\'aruf')
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
    <main class="mt-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="mb-8">
                <nav class="flex" aria-label="Breadcrumb">
                    <ol class="flex items-center space-x-4">
                        <li>
                            <a href="{{ route('alumni.dashboard') }}" class="text-green-600 hover:text-green-700">Dashboard
                                Alumni</a>
                        </li>
                        <li class="flex items-center">
                            <svg class="h-5 w-5 text-gray-400 mx-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd"
                                    d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                            <a href="{{ route('taaruf.index') }}" class="text-green-600 hover:text-green-700">Ta'aruf</a>
                        </li>
                        <li class="flex items-center">
                            <svg class="h-5 w-5 text-gray-400 mx-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd"
                                    d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                            <span class="text-gray-500" aria-current="page">Syarat dan Ketentuan</span>
                        </li>
                    </ol>
                </nav>
                <h2 class="text-3xl font-bold text-gray-900 mt-4">Syarat dan Ketentuan Ta'aruf</h2>
                <p class="text-gray-500 mt-2">Harap baca dengan seksama sebelum melanjutkan</p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-lg shadow-lg overflow-hidden mb-8">
                        <div class="px-6 py-4 border-b border-gray-200">
                            <h5 class="text-xl font-bold text-green-600">Ketentuan Penggunaan Fitur Ta'aruf</h5>
                        </div>
                        <div class="p-6">
                            <div class="mb-6">
                                <h5 class="text-lg font-semibold text-gray-900">1. Tujuan Fitur Ta'aruf</h5>
                                <p class="mt-2 text-gray-600">Fitur Ta'aruf Bidang Dakwah Masjid Salman ITB bertujuan untuk
                                    memfasilitasi proses perkenalan (ta'aruf) yang sesuai dengan syariat Islam bagi alumni
                                    Sekolah Pranikah yang serius menuju jenjang pernikahan.</p>
                            </div>

                            <div class="mb-6">
                                <h5 class="text-lg font-semibold text-gray-900">2. Persyaratan Pengguna</h5>
                                <ul class="mt-2 ml-6 space-y-2 text-gray-600 list-disc">
                                    <li>Merupakan alumni Sekolah Pranikah Online atau Sekolah Pranikah Offline Bidang Dakwah
                                        Masjid Salman ITB</li>
                                    <li>Telah mengaktivasi akun alumni</li>
                                    <li>Berusia minimal 18 tahun</li>
                                    <li>Memiliki niat serius untuk menikah</li>
                                    <li>Bersedia memberikan informasi yang benar dan akurat</li>
                                </ul>
                            </div>

                            <div class="mb-6">
                                <h5 class="text-lg font-semibold text-gray-900">3. Kerahasiaan Data</h5>
                                <p class="mt-2 text-gray-600">Semua informasi yang Anda berikan dalam fitur Ta'aruf akan
                                    dijaga kerahasiaannya dan hanya dapat diakses oleh:</p>
                                <ul class="mt-2 ml-6 space-y-2 text-gray-600 list-disc">
                                    <li>Alumni Sekolah Pranikah yang juga telah menyetujui ketentuan Ta'aruf</li>
                                    <li>Administrator sistem yang berwenang</li>
                                </ul>
                                <p class="mt-2 text-gray-600">Anda hanya dapat melihat profil alumni lawan jenis yang juga
                                    telah menyetujui ketentuan ini.</p>
                            </div>

                            <div class="mb-6">
                                <h5 class="text-lg font-semibold text-gray-900">4. Kode Etik</h5>
                                <ul class="mt-2 ml-6 space-y-2 text-gray-600 list-disc">
                                    <li>Berikan informasi yang jujur dan akurat tentang diri Anda</li>
                                    <li>Hormati privasi pengguna lain</li>
                                    <li>Jaga adab komunikasi sesuai syariat Islam</li>
                                    <li>Dilarang menggunakan fitur ini untuk tujuan selain ta'aruf menuju pernikahan</li>
                                    <li>Dilarang menyebarkan informasi pengguna lain di luar platform ini</li>
                                </ul>
                            </div>

                            <div class="mb-6">
                                <h5 class="text-lg font-semibold text-gray-900">5. Informed Consent</h5>
                                <p class="mt-2 text-gray-600">Anda akan diminta untuk mengisi dan mengunggah dokumen
                                    Informed Consent yang berisi pernyataan persetujuan penggunaan fitur Ta'aruf. Dokumen
                                    ini harus ditandatangani sebagai bukti persetujuan Anda.</p>
                            </div>

                            <div class="mb-6">
                                <h5 class="text-lg font-semibold text-gray-900">6. Hak Administrator</h5>
                                <p class="mt-2 text-gray-600">Administrator berhak untuk:</p>
                                <ul class="mt-2 ml-6 space-y-2 text-gray-600 list-disc">
                                    <li>Menonaktifkan profil yang melanggar ketentuan</li>
                                    <li>Memverifikasi kebenaran informasi yang diberikan</li>
                                    <li>Melakukan perubahan pada fitur Ta'aruf sesuai kebutuhan</li>
                                </ul>
                            </div>

                            <div>
                                <h5 class="text-lg font-semibold text-gray-900">7. Pembatasan Tanggung Jawab</h5>
                                <p class="mt-2 text-gray-600">Bidang Dakwah Masjid Salman ITB hanya memfasilitasi proses
                                    ta'aruf dan tidak bertanggung jawab atas:</p>
                                <ul class="mt-2 ml-6 space-y-2 text-gray-600 list-disc">
                                    <li>Keputusan pribadi pengguna dalam proses ta'aruf</li>
                                    <li>Hasil dari proses ta'aruf</li>
                                    <li>Perselisihan yang mungkin terjadi antar pengguna</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="lg:col-span-1">
                    <div class="bg-white rounded-lg shadow-lg overflow-hidden mb-8">
                        <div class="px-6 py-4 border-b border-gray-200">
                            <h5 class="text-xl font-bold text-green-600">Persetujuan</h5>
                        </div>
                        <div class="p-6">
                            <p class="text-gray-600">Dengan melanjutkan, Anda menyatakan:</p>
                            <ul class="mt-2 ml-6 space-y-2 text-gray-600 list-disc">
                                <li>Telah membaca dan memahami seluruh syarat dan ketentuan</li>
                                <li>Setuju untuk mematuhi semua ketentuan yang berlaku</li>
                                <li>Bersedia memberikan informasi yang benar dan akurat</li>
                                <li>Memiliki niat serius untuk ta'aruf menuju pernikahan</li>
                            </ul>

                            <form action="{{ route('taaruf.terms.accept') }}" method="POST" class="mt-6">
                                @csrf
                                <div class="mb-4">
                                    <div class="flex items-start">
                                        <div class="flex items-center h-5">
                                            <input id="agree" name="agree" type="checkbox" required
                                                class="focus:ring-green-500 h-4 w-4 text-green-600 border-gray-300 rounded">
                                        </div>
                                        <div class="ml-3 text-sm">
                                            <label for="agree" class="font-medium text-gray-700">Saya menyetujui semua
                                                syarat dan ketentuan di atas</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="flex flex-col space-y-3">
                                    <button type="submit" id="submitBtn" disabled
                                        class="bg-green-600 hover:bg-green-700 text-white font-medium py-2 px-4 rounded-md inline-flex items-center justify-center transition duration-150 ease-in-out">
                                        <svg class="w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                            fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        Setuju dan Lanjutkan
                                    </button>
                                    <a href="{{ route('taaruf.index') }}"
                                        class="bg-white hover:bg-gray-50 text-gray-700 font-medium py-2 px-4 border border-gray-300 rounded-md inline-flex items-center justify-center transition duration-150 ease-in-out">
                                        <svg class="w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                            fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        Batal
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                        <div class="px-6 py-4 border-b border-gray-200">
                            <h5 class="text-xl font-bold text-green-600">Informasi Tambahan</h5>
                        </div>
                        <div class="p-6">
                            <div class="bg-blue-50 border-l-4 border-blue-400 p-4 mb-4">
                                <div class="flex">
                                    <div class="flex-shrink-0">
                                        <svg class="h-5 w-5 text-blue-400" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2h-1V9a1 1 0 00-1-1z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm text-blue-700">
                                            Anda dapat mengaktifkan atau menonaktifkan status ta'aruf Anda kapan saja.
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <p class="text-gray-600">Jika Anda memiliki pertanyaan tentang ketentuan ini, silakan hubungi
                                admin melalui:</p>
                            <p class="mt-2 flex items-center text-gray-600">
                                <svg class="w-5 h-5 mr-2 text-gray-500" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                                    <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                                </svg>
                                admin@salmanitb.com
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const agreeCheckbox = document.getElementById('agree');
                const submitBtn = document.getElementById('submitBtn');

                agreeCheckbox.addEventListener('change', function() {
                    submitBtn.disabled = !this.checked;
                });
            });
        </script>
    @endpush
@endsection
