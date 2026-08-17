@extends('layouts.app')

@section('title', 'Layanan Ta\'aruf - Bidang Dakwah Masjid Salman ITB')

@section('content')
    <div class="min-h-screen bg-gray-50/70 py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

            <!-- Header Card -->
            <div
                class="bg-gradient-to-br from-slate-900 via-rose-950 to-pink-950 rounded-3xl text-white p-6 sm:p-8 shadow-lg relative overflow-hidden">
                <div
                    class="absolute inset-0 opacity-10 bg-[radial-gradient(#fff_1px,transparent_1px)] [background-size:16px_16px]">
                </div>

                <div class="relative z-10">
                    <!-- Breadcrumbs -->
                    <nav class="flex items-center gap-2 text-xs text-rose-300/80 mb-3 font-medium">
                        <a href="{{ route('alumni.dashboard') }}" class="hover:text-white transition">Dashboard Alumni</a>
                        <span>/</span>
                        <span class="text-white font-semibold">Layanan Ta'aruf</span>
                    </nav>

                    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                        <div>
                            <div
                                class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-rose-500/20 border border-rose-400/30 text-rose-300 text-xs font-semibold mb-2">
                                <span>💍</span>
                                <span>Khusus Alumni Sekolah Pranikah Salman</span>
                            </div>
                            <h1 class="text-2xl sm:text-3xl font-bold tracking-tight text-white">
                                Layanan Ta'aruf Mandiri
                            </h1>
                            <p class="text-xs sm:text-sm text-slate-300 mt-1">
                                Fasilitas ikhtiar mencari pasangan hidup sesuai syariat bagi alumni Sekolah Pranikah Salman
                                ITB.
                            </p>
                        </div>

                        @if ($taarufProfile && $taarufProfile->is_active)
                            <a href="{{ route('taaruf.list') }}"
                                class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-gradient-to-r from-rose-500 to-pink-500 hover:from-rose-600 hover:to-pink-600 text-white font-semibold text-xs shadow-md shadow-pink-500/20 transition self-start md:self-auto">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                                <span>Eksplor Daftar Profil</span>
                            </a>
                        @endif
                    </div>
                </div>
            </div>

            @if (session('error'))
                <div class="bg-red-50 border border-red-200 text-red-800 p-4 rounded-2xl shadow-sm flex items-center justify-between"
                    role="alert">
                    <span class="text-sm font-medium">{{ session('error') }}</span>
                    <button type="button" onclick="this.parentElement.remove()"
                        class="text-red-500 hover:text-red-700">✕</button>
                </div>
            @endif

            @if (session('success'))
                <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 p-4 rounded-2xl shadow-sm flex items-center justify-between"
                    role="alert">
                    <span class="text-sm font-medium">{{ session('success') }}</span>
                    <button type="button" onclick="this.parentElement.remove()"
                        class="text-emerald-500 hover:text-emerald-700">✕</button>
                </div>
            @endif

            <!-- Profile Completion Alert -->
            @if (isset($needsProfileUpdate) && $needsProfileUpdate)
                <div class="bg-amber-50/90 border border-amber-200/80 rounded-2xl p-5 sm:p-6 shadow-sm">
                    <div class="flex items-start gap-3.5">
                        <div
                            class="w-9 h-9 rounded-xl bg-amber-100 text-amber-700 flex items-center justify-center font-bold text-base shrink-0">
                            ⚠️
                        </div>
                        <div class="flex-1 min-w-0">
                            <h3 class="text-sm font-bold text-amber-900">Profil Ta'aruf Anda Belum Lengkap</h3>
                            <p class="text-xs text-amber-700 mt-1">
                                Lengkapi data kriteria pasangan dan kelebihan/kekurangan untuk memaksimalkan kecocokan data
                                Anda.
                            </p>

                            @if (isset($missingFields) && count($missingFields) > 0)
                                <div class="mt-3 bg-white/80 border border-amber-200 rounded-xl p-3.5">
                                    <span class="text-xs font-bold text-amber-900 block mb-2">Item yang belum diisi
                                        ({{ count($missingFields) }} item):</span>
                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-1.5 text-xs text-gray-700">
                                        @foreach ($missingFields as $field)
                                            <div class="flex items-center gap-1.5">
                                                <span class="text-amber-500 font-bold">&bull;</span>
                                                <span>{{ $field }}</span>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                                @php
                                    $totalFields = 13;
                                    if (!empty($taarufProfile->education_level)) {
                                        $lowEducationLevels = ['SD', 'SMP', 'SMA', 'SMK'];
                                        if (in_array($taarufProfile->education_level, $lowEducationLevels)) {
                                            $totalFields = 12;
                                        }
                                    }
                                    $completedFields = max(0, $totalFields - count($missingFields));
                                    $percentage = round(($completedFields / $totalFields) * 100);
                                @endphp

                                <div class="mt-3.5">
                                    <div class="flex justify-between text-xs text-amber-800 font-semibold mb-1">
                                        <span>Kelengkapan Biodata</span>
                                        <span>{{ $percentage }}% ({{ $completedFields }}/{{ $totalFields }})</span>
                                    </div>
                                    <div class="w-full bg-amber-200/80 rounded-full h-2 overflow-hidden">
                                        <div class="bg-amber-500 h-2 rounded-full transition-all duration-300"
                                            style="width: {{ $percentage }}%"></div>
                                    </div>
                                </div>
                            @endif

                            <div class="mt-4 flex flex-wrap items-center gap-2">
                                <a href="{{ route('taaruf.profile.edit') }}"
                                    class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl bg-amber-600 hover:bg-amber-700 text-white font-semibold text-xs transition shadow-sm">
                                    <span>Lengkapi Profil Sekarang</span>
                                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Main 2-Column Layout -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                <!-- Left 2 Columns: Panduan & Informasi Taaruf -->
                <div class="lg:col-span-2 space-y-6">

                    <div class="bg-white rounded-2xl border border-gray-200/80 shadow-sm p-6 sm:p-8">
                        <h2
                            class="text-base font-bold text-gray-900 pb-3 border-b border-gray-100 mb-4 flex items-center gap-2">
                            <span>📖</span>
                            <span>Mengenai Layanan Ta'aruf Salman</span>
                        </h2>

                        <p class="text-xs sm:text-sm text-gray-600 leading-relaxed mb-4">
                            Fitur Ta'aruf adalah media ikhtiar islami yang dikelola oleh Bidang Dakwah Masjid Salman ITB.
                            Layanan ini khusus menghubungkan sesama alumni Sekolah Pranikah (SPN Online maupun SPN Offline)
                            yang siap melangkah ke gerbang pernikahan.
                        </p>

                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 my-6">
                            <div class="bg-rose-50/60 border border-rose-100 rounded-2xl p-4 text-center">
                                <div class="text-2xl mb-1.5">🔒</div>
                                <h4 class="text-xs font-bold text-rose-900">Aman &amp; Terjaga</h4>
                                <p class="text-[11px] text-rose-700 mt-1 leading-normal">Hanya dapat diakses sesama alumni
                                    terverifikasi yang telah menyetujui kode etik.</p>
                            </div>
                            <div class="bg-emerald-50/60 border border-emerald-100 rounded-2xl p-4 text-center">
                                <div class="text-2xl mb-1.5">💬</div>
                                <h4 class="text-xs font-bold text-emerald-900">Q&amp;A Anonim</h4>
                                <p class="text-[11px] text-emerald-700 mt-1 leading-normal">Fitur tanya jawab seputar
                                    prinsip &amp; kesiapan sebelum pertukaran kontak lanjutan.</p>
                            </div>
                            <div class="bg-blue-50/60 border border-blue-100 rounded-2xl p-4 text-center">
                                <div class="text-2xl mb-1.5">⚖️</div>
                                <h4 class="text-xs font-bold text-blue-900">Sesuai Syariat</h4>
                                <p class="text-[11px] text-blue-700 mt-1 leading-normal">Menghindari khalwat dan menjaga
                                    adab perkenalan bernilai ibadah.</p>
                            </div>
                        </div>

                        <h3 class="text-xs font-bold text-gray-900 mb-2">Alur &amp; Langkah Ta'aruf:</h3>
                        <ol class="list-decimal pl-4 space-y-1.5 text-xs text-gray-600 leading-relaxed">
                            <li><strong>Setujui Ketentuan</strong> &ndash; Baca dan tandatangani lembar persetujuan
                                (Informed Consent).</li>
                            <li><strong>Lengkapi Biodata</strong> &ndash; Isi visi misi pernikahan, riwayat diri, dan
                                kriteria pasangan yang dicari.</li>
                            <li><strong>Eksplorasi Profil</strong> &ndash; Telusuri profil alumni lawan jenis sesuai filter
                                kriteria.</li>
                            <li><strong>Tanya Jawab</strong> &ndash; Kirim pertanyaan santun untuk mendalami pemahaman dan
                                keselarasan visi.</li>
                        </ol>
                    </div>

                </div>

                <!-- Right 1 Column: Profil Status & Quick Actions -->
                <div class="space-y-6">

                    <!-- Status Box -->
                    <div class="bg-white rounded-2xl border border-gray-200/80 shadow-sm p-6 text-center">
                        @if (!$taarufProfile)
                            <div
                                class="w-16 h-16 rounded-2xl bg-rose-50 text-rose-500 border border-rose-100 flex items-center justify-center text-2xl mx-auto mb-3">
                                💍
                            </div>
                            <h3 class="text-sm font-bold text-gray-900">Belum Ada Profil Ta'aruf</h3>
                            <p class="text-xs text-gray-500 mt-1 max-w-xs mx-auto mb-5 leading-relaxed">
                                Buat profil ta'aruf Anda untuk mulai menemukan calon pasangan yang sevisi.
                            </p>

                            <a href="{{ route('taaruf.terms') }}"
                                class="w-full inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl bg-gradient-to-r from-rose-500 to-pink-500 hover:from-rose-600 hover:to-pink-600 text-white font-semibold text-xs shadow-md shadow-pink-500/20 transition">
                                <span>Buat Profil Ta'aruf</span>
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                </svg>
                            </a>
                        @else
                            <!-- Profile Card -->
                            <div class="mb-4">
                                @if ($taarufProfile->photo_url)
                                    <img src="{{ $taarufProfile->photo_url }}" alt="{{ $taarufProfile->full_name }}"
                                        class="w-20 h-20 rounded-2xl object-cover mx-auto border-2 border-rose-100 shadow-xs">
                                @else
                                    <div
                                        class="w-20 h-20 rounded-2xl bg-rose-50 text-rose-600 border border-rose-100 flex items-center justify-center text-2xl font-bold mx-auto shadow-xs">
                                        {{ strtoupper(substr($taarufProfile->full_name ?? Auth::user()->name, 0, 1)) }}
                                    </div>
                                @endif
                            </div>

                            <h3 class="text-sm font-bold text-gray-900">{{ $taarufProfile->full_name }}</h3>
                            <p class="text-xs text-gray-500 mt-0.5">{{ $taarufProfile->occupation ?: 'Alumni SPN' }}</p>

                            <div class="my-3">
                                <span
                                    class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold {{ $taarufProfile->is_active ? 'bg-emerald-50 text-emerald-700 border border-emerald-200' : 'bg-gray-100 text-gray-600 border border-gray-200' }}">
                                    <span
                                        class="w-1.5 h-1.5 rounded-full {{ $taarufProfile->is_active ? 'bg-emerald-500 animate-pulse' : 'bg-gray-400' }}"></span>
                                    {{ $taarufProfile->is_active ? 'Profil Aktif (Dapat Dilihat)' : 'Profil Non-Aktif' }}
                                </span>
                            </div>

                            <div class="grid grid-cols-2 gap-2 mt-4">
                                <a href="{{ route('taaruf.profile.edit') }}"
                                    class="inline-flex items-center justify-center gap-1.5 px-3 py-2 rounded-xl border border-gray-300 bg-white hover:bg-gray-50 text-gray-700 text-xs font-semibold transition shadow-2xs">
                                    <svg class="w-3.5 h-3.5 text-gray-500" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                    </svg>
                                    <span>Edit</span>
                                </a>
                                <form action="{{ route('taaruf.profile.toggle') }}" method="POST">
                                    @csrf
                                    <button type="submit"
                                        class="w-full inline-flex items-center justify-center gap-1.5 px-3 py-2 rounded-xl border border-gray-300 bg-white hover:bg-gray-50 text-gray-700 text-xs font-semibold transition shadow-2xs">
                                        <svg class="w-3.5 h-3.5 text-gray-500" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4" />
                                        </svg>
                                        <span>{{ $taarufProfile->is_active ? 'Nonaktifkan' : 'Aktifkan' }}</span>
                                    </button>
                                </form>
                            </div>

                            <div class="mt-4 pt-4 border-t border-gray-100 space-y-2">
                                @if ($taarufProfile->is_active)
                                    <a href="{{ route('taaruf.list') }}"
                                        class="w-full inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-semibold text-xs shadow-sm transition">
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                        </svg>
                                        <span>Buka Daftar Ta'aruf</span>
                                    </a>
                                @else
                                    <a href="{{ route('taaruf.terms') }}"
                                        class="w-full inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-semibold text-xs shadow-sm transition">
                                        <span>Aktivasi Profil &rarr;</span>
                                    </a>
                                @endif

                                <a href="{{ route('taaruf.questions.index') }}"
                                    class="w-full inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl border border-gray-300 bg-white hover:bg-gray-50 text-gray-700 font-semibold text-xs transition relative">
                                    <svg class="w-4 h-4 text-gray-500" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <span>Pertanyaan Masuk</span>
                                    @if (isset($unreadQuestionsCount) && $unreadQuestionsCount > 0)
                                        <span
                                            class="px-2 py-0.5 rounded-full bg-rose-500 text-white text-[10px] font-bold">
                                            {{ $unreadQuestionsCount }} Baru
                                        </span>
                                    @endif
                                </a>
                            </div>
                        @endif
                    </div>

                    <!-- Kontak Bantuan -->
                    <div class="bg-white rounded-2xl border border-gray-200/80 shadow-sm p-6 text-xs text-gray-600">
                        <h4 class="font-bold text-gray-900 mb-2">Bantuan &amp; Layanan Pendamping</h4>
                        <p class="leading-relaxed mb-3">
                            Membutuhkan bantuan mediator ta'aruf atau memiliki kendala akun? Hubungi panitia via WhatsApp:
                        </p>
                        <a href="https://wa.me/6285703952464" target="_blank"
                            class="inline-flex items-center gap-1.5 text-emerald-600 font-bold hover:underline">
                            <span>💬</span>
                            <span>+6285703952464</span>
                        </a>
                    </div>

                </div>

            </div>

        </div>
    </div>
@endsection
