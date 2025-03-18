@extends('layouts.app')

@section('title', 'Detail Profil Ta\'aruf')
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
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="mb-8">
            <nav class="flex" aria-label="Breadcrumb">
                <ol class="flex items-center space-x-2">
                    <li>
                        <a href="{{ route('alumni.dashboard') }}" class="text-green-600 hover:text-green-700">Dashboard
                            Alumni</a>
                    </li>
                    <li class="flex items-center">
                        <svg class="h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                clip-rule="evenodd" />
                        </svg>
                        <a href="{{ route('taaruf.index') }}" class="ml-2 text-green-600 hover:text-green-700">Ta'aruf</a>
                    </li>
                    <li class="flex items-center">
                        <svg class="h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                clip-rule="evenodd" />
                        </svg>
                        <a href="{{ route('taaruf.list') }}" class="ml-2 text-green-600 hover:text-green-700">Daftar
                            Alumni</a>
                    </li>
                    <li class="flex items-center">
                        <svg class="h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                clip-rule="evenodd" />
                        </svg>
                        <span class="ml-2 text-gray-500">Detail Profil</span>
                    </li>
                </ol>
            </nav>
            <h2 class="text-3xl font-bold text-gray-900 mt-4">Profil Ta'aruf</h2>
            <p class="text-gray-600">Detail informasi profil alumni</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="lg:col-span-2">
                <div class="bg-white rounded-lg shadow-lg mb-8 overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h5 class="text-xl font-bold text-green-600">Informasi Dasar</h5>
                    </div>
                    <div class="p-6">
                        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                            <div class="text-center mb-4">
                                @if ($profile->photo_url)
                                    <img src="{{ Storage::url($profile->photo_url) }}" alt="{{ $profile->full_name }}"
                                        class="rounded-lg border border-gray-200 inline-block max-w-full h-auto"
                                        style="max-width: 200px;">
                                @else
                                    <div class="bg-gray-100 rounded-lg flex items-center justify-center w-40 h-40 mx-auto">
                                        <svg class="h-20 w-20 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                @endif
                            </div>

                            <div class="md:col-span-3 md:pl-10">
                                <h4 class="text-2xl font-bold mb-4">{{ $profile->full_name }}</h4>

                                <div class="space-y-2 mb-6">
                                    <p><span class="font-semibold">Nama Panggilan:</span> {{ $profile->nickname }}</p>
                                    <p><span class="font-semibold">Tempat, Tanggal Lahir:</span>
                                        {{ $profile->birth_place_date }}</p>
                                    {{-- <p class="mb-1"><strong>Usia:</strong> {{ \Carbon\Carbon::parse(explode(', ', $profile->birth_place_date)[1])->age }} tahun</p> --}}
                                    <p class="mb-1"><strong>Usia:</strong>
                                        {{ \App\Helpers\DateHelper::getAgeFromBirthPlaceDate($profile->birth_place_date) ?? 'N/A' }}
                                        tahun</p>
                                    <p><span class="font-semibold">Domisili Saat Ini:</span>
                                        {{ $profile->current_residence }}</p>
                                    @if ($profile->instagram)
                                        <p><span class="font-semibold">Instagram:</span> @ {{ $profile->instagram }}</p>
                                    @endif
                                </div>

                                <div>
                                    <a href="{{ route('taaruf.list') }}"
                                        class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 transition">
                                        <svg class="h-5 w-5 mr-2 text-gray-500" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                                        </svg>
                                        Kembali ke Daftar
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-lg mb-8 overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h5 class="text-xl font-bold text-green-600">Pendidikan dan Pekerjaan</h5>
                    </div>
                    <div class="p-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <h6 class="font-bold text-gray-800 mb-2">Pendidikan Terakhir</h6>
                                <p class="text-gray-600">{{ $profile->last_education }}</p>
                            </div>

                            <div>
                                <h6 class="font-bold text-gray-800 mb-2">Pekerjaan</h6>
                                <p class="text-gray-600">{{ $profile->occupation }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-lg mb-8 overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h5 class="text-xl font-bold text-green-600">Informasi Tambahan</h5>
                    </div>
                    <div class="p-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <div class="mb-6">
                                    <h6 class="font-bold text-gray-800 mb-2">Target Tahun Menikah</h6>
                                    <p class="text-gray-600">{{ $profile->marriage_target_year ?? 'Tidak disebutkan' }}</p>
                                </div>

                                <div>
                                    <h6 class="font-bold text-gray-800 mb-2">Kepribadian</h6>
                                    <p class="text-gray-600">{{ $profile->personality ?? 'Tidak disebutkan' }}</p>
                                </div>
                            </div>

                            <div>
                                <div class="mb-6">
                                    <h6 class="font-bold text-gray-800 mb-2">Harapan dalam Pernikahan</h6>
                                    <p class="text-gray-600">{{ $profile->expectation ?? 'Tidak disebutkan' }}</p>
                                </div>

                                <div>
                                    <h6 class="font-bold text-gray-800 mb-2">Visi Misi Pernikahan</h6>
                                    <p class="text-gray-600">{{ $profile->ideal_partner_criteria ?? 'Tidak disebutkan' }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- <div class="bg-white rounded-lg shadow-lg mb-8 overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h5 class="text-xl font-bold text-green-600">Pertanyaan Tambahan</h5>
                    </div>
                    <div class="p-6">
                        <div class="overflow-x-auto">
                            <table class="min-w-full border border-gray-200 divide-y divide-gray-200">
                                <tbody class="divide-y divide-gray-200">
                                    <tr>
                                        <td class="px-4 py-3 bg-gray-50 text-gray-700 w-3/5">Sedang dalam proses ta'aruf
                                            dengan orang lain?</td>
                                        <td class="px-4 py-3">
                                            <span
                                                class="inline-flex px-3 py-1 rounded-full text-sm font-medium {{ $profile->is_in_taaruf_process ? 'bg-yellow-100 text-yellow-800' : 'bg-green-100 text-green-800' }}">
                                                {{ $profile->is_in_taaruf_process ? 'Ya' : 'Tidak' }}
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="px-4 py-3 bg-gray-50 text-gray-700">Perokok?</td>
                                        <td class="px-4 py-3">
                                            <span
                                                class="inline-flex px-3 py-1 rounded-full text-sm font-medium {{ $profile->is_smoker ? 'bg-yellow-100 text-yellow-800' : 'bg-green-100 text-green-800' }}">
                                                {{ $profile->is_smoker ? 'Ya' : 'Tidak' }}
                                            </span>
                                        </td>
                                    </tr>
                                    @if ($profile->gender === 'male')
                                        <tr>
                                            <td class="px-4 py-3 bg-gray-50 text-gray-700">Berniat untuk berpoligami?</td>
                                            <td class="px-4 py-3">
                                                <span
                                                    class="inline-flex px-3 py-1 rounded-full text-sm font-medium {{ $profile->is_polygamy_intended ? 'bg-yellow-100 text-yellow-800' : 'bg-green-100 text-green-800' }}">
                                                    {{ $profile->is_polygamy_intended ? 'Ya' : 'Tidak' }}
                                                </span>
                                            </td>
                                        </tr>
                                    @endif
                                    <tr>
                                        <td class="px-4 py-3 bg-gray-50 text-gray-700">Memiliki hutang yang signifikan?
                                        </td>
                                        <td class="px-4 py-3">
                                            <span
                                                class="inline-flex px-3 py-1 rounded-full text-sm font-medium {{ $profile->has_debt ? 'bg-yellow-100 text-yellow-800' : 'bg-green-100 text-green-800' }}">
                                                {{ $profile->has_debt ? 'Ya' : 'Tidak' }}
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="px-4 py-3 bg-gray-50 text-gray-700">Memiliki tanggungan?</td>
                                        <td class="px-4 py-3">
                                            <span
                                                class="inline-flex px-3 py-1 rounded-full text-sm font-medium {{ $profile->has_dependents ? 'bg-yellow-100 text-yellow-800' : 'bg-green-100 text-green-800' }}">
                                                {{ $profile->has_dependents ? 'Ya' : 'Tidak' }}
                                            </span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div> --}}
            </div>

            <div class="lg:col-span-1">
                <div class="bg-white rounded-lg shadow-lg mb-8 overflow-hidden top-8">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h5 class="text-xl font-bold text-green-600">Panduan Ta'aruf</h5>
                    </div>
                    <div class="p-6">
                        <div class="bg-blue-50 text-blue-800 p-4 rounded-lg mb-4">
                            <div class="flex">
                                <svg class="h-5 w-5 mr-2 text-blue-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                        clip-rule="evenodd" />
                                </svg>
                                <span>Jika Anda tertarik dengan profil ini, silakan ikuti panduan berikut.</span>
                            </div>
                        </div>

                        <p class="font-semibold text-gray-800 mb-2">Langkah-langkah Ta'aruf:</p>
                        <ol class="list-decimal pl-5 mb-6 space-y-2 text-gray-600">
                            <li>Hubungi admin melalui email atau WhatsApp untuk menyampaikan ketertarikan Anda</li>
                            <li>Admin akan memfasilitasi proses awal ta'aruf dengan menghubungi alumni yang bersangkutan
                            </li>
                            <li>Jika kedua belah pihak setuju, admin akan memfasilitasi pertemuan awal</li>
                            <li>Proses ta'aruf selanjutnya akan difasilitasi sesuai dengan ketentuan yang berlaku</li>
                        </ol>

                        <div class="bg-yellow-50 text-yellow-800 p-4 rounded-lg mb-6">
                            <div class="flex">
                                <svg class="h-5 w-5 mr-2 text-yellow-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z"
                                        clip-rule="evenodd" />
                                </svg>
                                <span>Dilarang menghubungi alumni secara langsung tanpa melalui proses yang telah
                                    ditentukan.</span>
                            </div>
                        </div>

                        <div class="mt-4">
                            <p class="font-semibold text-gray-800 mb-2">Kontak Admin:</p>
                            <p class="flex items-center mb-2 text-gray-600">
                                <svg class="h-5 w-5 mr-2 text-gray-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                                    <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                                </svg>
                                admin@salmanitb.com
                            </p>
                            <p class="flex items-center text-gray-600">
                                <svg class="h-5 w-5 mr-2 text-gray-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z" />
                                </svg>
                                +62 812-3456-7890
                            </p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h5 class="text-xl font-bold text-green-600">Pengingat Penting</h5>
                    </div>
                    <div class="p-6">
                        <ul class="space-y-3 text-gray-600">
                            <li class="flex items-start">
                                <svg class="h-5 w-5 text-green-500 mr-2 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                        clip-rule="evenodd" />
                                </svg>
                                <span>Hormati privasi alumni dengan tidak menyebarkan informasi profil mereka</span>
                            </li>
                            <li class="flex items-start">
                                <svg class="h-5 w-5 text-green-500 mr-2 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                        clip-rule="evenodd" />
                                </svg>
                                <span>Jaga adab komunikasi sesuai syariat Islam</span>
                            </li>
                            <li class="flex items-start">
                                <svg class="h-5 w-5 text-green-500 mr-2 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                        clip-rule="evenodd" />
                                </svg>
                                <span>Pastikan niat Anda untuk ta'aruf adalah untuk tujuan pernikahan</span>
                            </li>
                            <li class="flex items-start">
                                <svg class="h-5 w-5 text-green-500 mr-2 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                        clip-rule="evenodd" />
                                </svg>
                                <span>Ikuti semua ketentuan yang telah ditetapkan dalam proses ta'aruf</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
