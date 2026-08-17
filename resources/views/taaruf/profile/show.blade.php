@extends('layouts.app')

@section('title', 'Detail Profil Ta\'aruf - ' . $profile->full_name)

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
                    <nav class="flex flex-wrap items-center gap-2 text-xs text-rose-300/80 mb-3 font-medium">
                        <a href="{{ route('alumni.dashboard') }}" class="hover:text-white transition">Dashboard Alumni</a>
                        <span>/</span>
                        <a href="{{ route('taaruf.index') }}" class="hover:text-white transition">Ta'aruf</a>
                        <span>/</span>
                        <a href="{{ route('taaruf.list') }}" class="hover:text-white transition">Daftar Alumni</a>
                        <span>/</span>
                        <span class="text-white font-semibold truncate max-w-xs">{{ $profile->full_name }}</span>
                    </nav>

                    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                        <div>
                            <div
                                class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-rose-500/20 border border-rose-400/30 text-rose-300 text-xs font-semibold mb-2">
                                <span>💍</span>
                                <span>Biodata Peserta Ta'aruf</span>
                            </div>
                            <h1 class="text-2xl sm:text-3xl font-bold tracking-tight text-white">
                                {{ $profile->full_name }}
                            </h1>
                            <p class="text-xs sm:text-sm text-slate-300 mt-1">
                                {{ $profile->nickname ? 'Panggilan: ' . $profile->nickname . ' &bull; ' : '' }}
                                {{ \App\Helpers\DateHelper::getAgeFromBirthPlaceDate($profile->birth_place_date) ? \App\Helpers\DateHelper::getAgeFromBirthPlaceDate($profile->birth_place_date) . ' Tahun' : '' }}
                                &bull; Domisili {{ $profile->current_residence ?: ($profile->residence_city ?: '-') }}
                            </p>
                        </div>

                        <a href="{{ route('taaruf.list') }}"
                            class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-white/10 hover:bg-white/20 backdrop-blur text-white text-xs font-semibold border border-white/15 transition shadow-xs self-start md:self-auto">
                            &larr; Kembali ke Daftar
                        </a>
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

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                <!-- Left 2 Columns: Detailed Information Cards -->
                <div class="lg:col-span-2 space-y-6">

                    <!-- Basic Info Card -->
                    <div class="bg-white rounded-2xl border border-gray-200/80 shadow-sm p-6 sm:p-7">
                        <div
                            class="flex flex-col sm:flex-row gap-6 items-center sm:items-start pb-6 border-b border-gray-100">
                            <div class="shrink-0">
                                @if ($profile->photo_url)
                                    <img src="{{ $profile->photo_url }}" alt="{{ $profile->full_name }}"
                                        class="w-32 h-32 rounded-2xl object-cover border-2 border-rose-100 shadow-sm">
                                @else
                                    <div
                                        class="w-32 h-32 rounded-2xl bg-rose-50 text-rose-500 border border-rose-100 flex items-center justify-center text-4xl font-bold shadow-xs">
                                        {{ strtoupper(substr($profile->full_name, 0, 1)) }}
                                    </div>
                                @endif
                            </div>

                            <div class="flex-1 text-center sm:text-left space-y-2">
                                <h2 class="text-xl font-bold text-gray-900">{{ $profile->full_name }}</h2>
                                <p class="text-xs text-gray-500">Nama Panggilan: <span
                                        class="font-semibold text-gray-800">{{ $profile->nickname ?: '-' }}</span></p>

                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-2 text-xs text-gray-600 pt-2">
                                    <div class="p-2.5 bg-gray-50 rounded-xl border border-gray-100">
                                        <span class="text-gray-400 block text-[11px]">Usia Saat Ini:</span>
                                        <span
                                            class="font-bold text-gray-800">{{ \App\Helpers\DateHelper::getAgeFromBirthPlaceDate($profile->birth_place_date) ?? '-' }}
                                            Tahun</span>
                                    </div>
                                    <div class="p-2.5 bg-gray-50 rounded-xl border border-gray-100">
                                        <span class="text-gray-400 block text-[11px]">Target Menikah:</span>
                                        <span
                                            class="font-bold text-rose-600">{{ $profile->marriage_target_year ?: 'Insya Allah Segera' }}</span>
                                    </div>
                                    <div class="p-2.5 bg-gray-50 rounded-xl border border-gray-100">
                                        <span class="text-gray-400 block text-[11px]">Alumni SPN:</span>
                                        <span class="font-semibold text-gray-800">
                                            @if ($profile->user->batchAlumni->first() && $profile->user->batchAlumni->first()->activityBatch)
                                                {{ $profile->user->batchAlumni->first()->activityBatch->nama_batch }}
                                            @else
                                                Alumni SPN
                                            @endif
                                        </span>
                                    </div>
                                    <div class="p-2.5 bg-gray-50 rounded-xl border border-gray-100">
                                        <span class="text-gray-400 block text-[11px]">Instagram:</span>
                                        <span
                                            class="font-semibold text-gray-800">{{ $profile->instagram ? '@' . $profile->instagram : '-' }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Asal & Domisili Grid -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mt-6">
                            <div class="p-4 rounded-xl bg-emerald-50/50 border border-emerald-100">
                                <h4 class="text-xs font-bold text-emerald-900 mb-2 flex items-center gap-1.5">
                                    <span>🏡</span>
                                    <span>Asal Daerah (Kelahiran)</span>
                                </h4>
                                <div class="text-xs space-y-1 text-gray-700">
                                    <div><span class="text-gray-400">Kota/Kab:</span> <span
                                            class="font-semibold">{{ $profile->origin_city ?: '-' }}</span></div>
                                    <div><span class="text-gray-400">Provinsi:</span>
                                        <span>{{ $profile->origin_province ?: '-' }}</span></div>
                                    <div><span class="text-gray-400">Kecamatan:</span>
                                        <span>{{ $profile->origin_district ?: '-' }}</span></div>
                                </div>
                            </div>

                            <div class="p-4 rounded-xl bg-blue-50/50 border border-blue-100">
                                <h4 class="text-xs font-bold text-blue-900 mb-2 flex items-center gap-1.5">
                                    <span>📍</span>
                                    <span>Domisili Saat Ini</span>
                                </h4>
                                <div class="text-xs space-y-1 text-gray-700">
                                    <div><span class="text-gray-400">Kota/Kab:</span> <span
                                            class="font-semibold">{{ $profile->residence_city ?: ($profile->current_residence ?: '-') }}</span>
                                    </div>
                                    <div><span class="text-gray-400">Provinsi:</span>
                                        <span>{{ $profile->residence_province ?: '-' }}</span></div>
                                    <div><span class="text-gray-400">Kecamatan:</span>
                                        <span>{{ $profile->residence_district ?: '-' }}</span></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Education & Work Card -->
                    <div class="bg-white rounded-2xl border border-gray-200/80 shadow-sm p-6 sm:p-7">
                        <h3
                            class="text-sm font-bold text-gray-900 pb-3 border-b border-gray-100 mb-4 flex items-center gap-2">
                            <span>🎓</span>
                            <span>Pendidikan &amp; Pekerjaan</span>
                        </h3>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div class="p-4 rounded-xl bg-gray-50 border border-gray-200/80 space-y-1 text-xs">
                                <span class="text-gray-400 font-medium block">Pendidikan Terakhir:</span>
                                <div class="text-sm font-bold text-gray-900">
                                    {{ $profile->education_level ?: ($profile->last_education ?: '-') }}</div>
                                @if ($profile->university)
                                    <div class="text-gray-700 font-medium pt-1">📚
                                        {{ $profile->university === 'Lainnya' ? $profile->custom_university : $profile->university }}
                                    </div>
                                @endif
                                @if ($profile->major)
                                    <div class="text-gray-600">Jurusan: {{ $profile->major }}</div>
                                @endif
                            </div>

                            <div class="p-4 rounded-xl bg-gray-50 border border-gray-200/80 space-y-1 text-xs">
                                <span class="text-gray-400 font-medium block">Pekerjaan &amp; Profesi:</span>
                                <div class="text-sm font-bold text-gray-900">💼 {{ $profile->occupation ?: '-' }}</div>
                                @if ($profile->job_title)
                                    <div class="text-gray-600 pt-1">Posisi: {{ $profile->job_title }}</div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Visi & Kriteria Card -->
                    <div class="bg-white rounded-2xl border border-gray-200/80 shadow-sm p-6 sm:p-7 space-y-5">
                        <h3 class="text-sm font-bold text-gray-900 pb-3 border-b border-gray-100 flex items-center gap-2">
                            <span>🕊️</span>
                            <span>Visi, Kepribadian &amp; Kriteria Pasangan</span>
                        </h3>

                        <div>
                            <h4 class="text-xs font-bold text-gray-800 mb-1">Visi Misi Rumah Tangga:</h4>
                            <p
                                class="text-xs sm:text-sm text-gray-600 bg-gray-50 p-3.5 rounded-xl border border-gray-100 leading-relaxed whitespace-pre-line">
                                {{ $profile->visi_misi ?: ($profile->ideal_partner_criteria ?: 'Belum diisi.') }}
                            </p>
                        </div>

                        <div>
                            <h4 class="text-xs font-bold text-gray-800 mb-1">Kriteria Pasangan yang Diharapkan:</h4>
                            <p
                                class="text-xs sm:text-sm text-gray-600 bg-gray-50 p-3.5 rounded-xl border border-gray-100 leading-relaxed whitespace-pre-line">
                                {{ $profile->expectation ?: ($profile->ideal_partner_criteria ?: 'Sesuai tuntunan syariat dan saling mendukung dalam ketaatan.') }}
                            </p>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <h4 class="text-xs font-bold text-gray-800 mb-1">Gambaran Kepribadian:</h4>
                                <p
                                    class="text-xs text-gray-600 bg-gray-50 p-3 rounded-xl border border-gray-100 leading-relaxed">
                                    {{ $profile->personality ?: '-' }}
                                </p>
                            </div>
                            <div>
                                <h4 class="text-xs font-bold text-gray-800 mb-1">Kelebihan &amp; Kekurangan Diri:</h4>
                                <p
                                    class="text-xs text-gray-600 bg-gray-50 p-3 rounded-xl border border-gray-100 leading-relaxed">
                                    {{ $profile->kelebihan_kekurangan ?: '-' }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Public Questions Section -->
                    @php
                        $publicQuestions = \App\Models\TaarufQuestion::where('profile_id', $profile->id)
                            ->where('is_answered', true)
                            ->where('is_public', true)
                            ->orderBy('created_at', 'desc')
                            ->get();
                    @endphp

                    @if (count($publicQuestions) > 0)
                        <div class="bg-white rounded-2xl border border-gray-200/80 shadow-sm p-6 sm:p-7">
                            <h3
                                class="text-sm font-bold text-gray-900 pb-3 border-b border-gray-100 mb-4 flex items-center justify-between">
                                <span class="flex items-center gap-2">
                                    <span>💬</span>
                                    <span>Pertanyaan &amp; Jawaban Terbuka</span>
                                </span>
                                <span
                                    class="text-xs font-semibold text-emerald-700 bg-emerald-50 px-2.5 py-0.5 rounded-full border border-emerald-100">
                                    {{ count($publicQuestions) }} Terjawab
                                </span>
                            </h3>

                            <div class="space-y-3">
                                @foreach ($publicQuestions as $index => $q)
                                    <div class="bg-gray-50/70 border border-gray-200/80 rounded-2xl p-4 space-y-2">
                                        <div class="flex items-start gap-2 text-xs font-bold text-gray-900">
                                            <span class="text-rose-500 font-bold shrink-0">Q:</span>
                                            <span class="leading-relaxed whitespace-pre-line">{{ $q->question }}</span>
                                        </div>
                                        <div
                                            class="flex items-start gap-2 text-xs text-gray-700 pl-4 border-l-2 border-emerald-400">
                                            <span class="text-emerald-600 font-bold shrink-0">A:</span>
                                            <p class="leading-relaxed whitespace-pre-line">{{ $q->answer }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- Ask Question Form -->
                    <div class="bg-white rounded-2xl border border-gray-200/80 shadow-sm p-6 sm:p-7">
                        <h3
                            class="text-sm font-bold text-gray-900 pb-3 border-b border-gray-100 mb-4 flex items-center gap-2">
                            <span>✉️</span>
                            <span>Ajukan Pertanyaan kepada Peserta</span>
                        </h3>

                        <div
                            class="bg-rose-50/60 border border-rose-100 text-rose-800 rounded-xl p-3 text-xs mb-4 flex items-center gap-2">
                            <span>🔒</span>
                            <span>Pertanyaan dikirim secara santun dan identitas penanya dirahasiakan kepada peserta yang
                                bersangkutan.</span>
                        </div>

                        <form action="{{ route('taaruf.profile.questions.store', $profile->id) }}" method="POST"
                            class="space-y-4">
                            @csrf
                            <div>
                                <label for="question" class="block text-xs font-bold text-gray-700 mb-1">Pertanyaan Anda
                                    (Maks. 500 karakter):</label>
                                <textarea name="question" id="question" rows="3" required maxlength="500"
                                    placeholder="Tuliskan pertanyaan seputar kesiapan, prinsip, atau harapan keluarga..."
                                    class="w-full px-3.5 py-2.5 text-xs rounded-xl border border-gray-300 focus:ring-2 focus:ring-rose-500 focus:border-rose-500 transition @error('question') border-red-500 @enderror"></textarea>
                                @error('question')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <button type="submit"
                                class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-gradient-to-r from-rose-500 to-pink-500 hover:from-rose-600 hover:to-pink-600 text-white font-semibold text-xs shadow-md shadow-pink-500/20 transition">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                                </svg>
                                <span>Kirim Pertanyaan Santun</span>
                            </button>
                        </form>
                    </div>

                </div>

                <!-- Right 1 Column: Guide & Action Sidebar -->
                <div class="space-y-6">

                    <!-- Action Submission Box -->
                    <div
                        class="bg-gradient-to-br from-rose-900 to-pink-950 rounded-2xl text-white p-6 shadow-sm text-center">
                        <div
                            class="w-12 h-12 rounded-xl bg-white/10 text-2xl flex items-center justify-center mx-auto mb-3">
                            🤝
                        </div>
                        <h3 class="text-sm font-bold text-white mb-1">Tertarik Melanjutkan Ta'aruf?</h3>
                        <p class="text-xs text-rose-200/90 leading-relaxed mb-4">
                            Jika terdapat kecocokan visi dan kriteria, ajukan formulir minat ta'aruf resmi ke fasilitator
                            Bidang Dakwah.
                        </p>
                        <a target="_blank"
                            href="https://docs.google.com/forms/d/e/1FAIpQLSf_iqVADX6qSlJ4T5ceaYAmele14_0AtlcVp9pQpsIKu44BjQ/viewform"
                            class="w-full inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl bg-white text-rose-900 hover:bg-rose-50 font-bold text-xs shadow-md transition">
                            <span>Ajukan Nama untuk Ta'aruf &rarr;</span>
                        </a>
                    </div>

                    <!-- Template & Guide Links -->
                    <div class="bg-white rounded-2xl border border-gray-200/80 shadow-sm p-6 space-y-3">
                        <h4 class="text-xs font-bold text-gray-900 pb-2 border-b border-gray-100">Dokumen &amp; Panduan
                        </h4>

                        <a target="_blank"
                            href="https://docs.google.com/document/d/1Nd28lj0pWuKRh2gBGRgnCFGPdW1VLifs/edit?tab=t.0#heading=h.gjdgxs"
                            class="flex items-center justify-between p-3 rounded-xl bg-gray-50 hover:bg-rose-50 border border-gray-100 hover:border-rose-200 transition group text-xs">
                            <div class="flex items-center gap-2 font-medium text-gray-800 group-hover:text-rose-700">
                                <span>📄</span>
                                <span>Template CV Format SPN</span>
                            </div>
                            <span class="text-gray-400 group-hover:text-rose-600">&rarr;</span>
                        </a>

                        <a target="_blank"
                            href="https://www.canva.com/design/DAGgvvB4Mpc/3IOk581b_A1XvYJ1phJU5g/view?utm_content=DAGgvvB4Mpc&utm_campaign=designshare&utm_medium=link2&utm_source=uniquelinks&utlId=he59da50a6a"
                            class="flex items-center justify-between p-3 rounded-xl bg-gray-50 hover:bg-rose-50 border border-gray-100 hover:border-rose-200 transition group text-xs">
                            <div class="flex items-center gap-2 font-medium text-gray-800 group-hover:text-rose-700">
                                <span>🎨</span>
                                <span>Panduan Alur Ta'aruf</span>
                            </div>
                            <span class="text-gray-400 group-hover:text-rose-600">&rarr;</span>
                        </a>
                    </div>

                    <!-- Admin Contact -->
                    <div class="bg-white rounded-2xl border border-gray-200/80 shadow-sm p-6 text-xs text-gray-600">
                        <h4 class="font-bold text-gray-900 mb-2">Kontak Fasilitator / Panitia</h4>
                        <p class="leading-relaxed mb-3">
                            Konsultasi dan pendampingan ta'aruf dapat dikoordinasikan langsung bersama panitia:
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
