@extends('admin.layouts.app')

@section('title', 'Detail Profil Taaruf - ' . $profile->full_name)

@section('content')
<div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
    @php
        $age = \App\Helpers\DateHelper::getAgeFromBirthPlaceDate($profile->birth_place_date);
    @endphp

    <!-- Header -->
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4 mb-8">
        <div>
            <div class="flex items-center gap-2 text-xs text-gray-500 mb-1.5">
                <a href="{{ route('admin.taaruf.index') }}" class="hover:text-pink-600 font-medium">Layanan Ta'aruf</a>
                <span>/</span>
                <span>Detail Profil Peserta</span>
            </div>
            <div class="flex flex-wrap items-center gap-3">
                <h1 class="text-2xl font-extrabold text-gray-900">{{ $profile->full_name }}</h1>
                @if($profile->nickname)
                    <span class="text-sm font-semibold text-pink-600 bg-pink-50 px-2.5 py-0.5 rounded-full border border-pink-200">
                        ({{ $profile->nickname }})
                    </span>
                @endif
                <span class="px-2.5 py-0.5 text-xs font-semibold rounded-full {{ $profile->is_active ? 'bg-emerald-50 text-emerald-700 border border-emerald-200' : 'bg-red-50 text-red-700 border border-red-200' }}">
                    {{ $profile->is_active ? '● Akun Aktif' : '○ Non-aktif' }}
                </span>
                @if ($profile->is_in_taaruf_process)
                    <span class="px-2.5 py-0.5 text-xs font-semibold rounded-full bg-amber-50 text-amber-700 border border-amber-200">
                        ⏳ Sedang Proses Ta'aruf
                    </span>
                @endif
                @if ($profile->latest_spn_batch)
                    <span class="px-2.5 py-0.5 text-xs font-semibold rounded-full bg-teal-50 text-teal-800 border border-teal-200">
                        🎓 {{ $profile->latest_spn_batch }}
                    </span>
                @endif
            </div>
        </div>
        <div class="flex flex-wrap items-center gap-2.5">
            <a href="{{ route('admin.taaruf.index') }}"
                class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl border border-gray-300 bg-white text-gray-700 hover:bg-gray-50 font-semibold text-xs shadow-xs transition">
                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                <span>Kembali</span>
            </a>
            <form action="{{ route('admin.taaruf.toggle-active', $profile->id) }}" method="POST" class="inline">
                @csrf
                @method('PATCH')
                <button type="submit"
                    class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl border {{ $profile->is_active ? 'border-amber-200 bg-amber-50 text-amber-700 hover:bg-amber-100' : 'border-emerald-200 bg-emerald-50 text-emerald-700 hover:bg-emerald-100' }} font-semibold text-xs shadow-xs transition">
                    <span>{{ $profile->is_active ? 'Nonaktifkan Profil' : 'Aktifkan Profil' }}</span>
                </button>
            </form>
            <a href="{{ route('admin.taaruf.edit', $profile->id) }}"
                class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl bg-pink-600 hover:bg-pink-700 text-white font-semibold text-xs shadow-xs transition">
                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                </svg>
                <span>Edit Profil</span>
            </a>
            <form action="{{ route('admin.taaruf.destroy', $profile->id) }}" method="POST" class="inline"
                onsubmit="return confirm('PERINGATAN: Apakah Anda yakin ingin menghapus profil ini secara permanen?');">
                @csrf
                @method('DELETE')
                <button type="submit"
                    class="inline-flex items-center gap-1.5 px-3 py-2 rounded-xl border border-red-200 bg-red-50 hover:bg-red-100 text-red-600 font-semibold text-xs shadow-xs transition" title="Hapus Profil">
                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                    </svg>
                    <span>Hapus</span>
                </button>
            </form>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        <!-- Left: Photo, Identity & Account Info -->
        <div class="space-y-6">
            <!-- Profile Identity Card -->
            <div class="bg-white rounded-2xl border border-gray-200/80 shadow-xs p-6 text-center">
                <div class="mb-4 flex justify-center">
                    @if ($profile->photo_url)
                        <img src="{{ $profile->photo_url }}" alt="{{ $profile->full_name }}"
                            class="w-40 h-40 object-cover rounded-2xl shadow-sm border-2 border-pink-100">
                    @else
                        <div class="w-40 h-40 bg-gray-100 rounded-2xl flex items-center justify-center text-5xl border border-gray-200">
                            {{ $profile->gender === 'male' ? '👨' : '𝄩👩' }}
                        </div>
                    @endif
                </div>

                <h3 class="text-lg font-bold text-gray-900">{{ $profile->full_name }}</h3>
                <p class="text-xs text-gray-500 mt-0.5">{{ $profile->nickname ? '(' . $profile->nickname . ')' : 'Peserta Ta\'aruf' }}</p>

                <div class="mt-3 flex flex-wrap items-center justify-center gap-2">
                    <span class="px-3 py-1 text-xs font-semibold rounded-full {{ $profile->gender === 'male' ? 'bg-blue-50 text-blue-700 border border-blue-200' : 'bg-pink-50 text-pink-700 border border-pink-200' }}">
                        {{ $profile->gender === 'male' ? '♂ Laki-laki (Ikhwan)' : '♀ Perempuan (Akhwat)' }}
                    </span>
                    <span class="px-2.5 py-1 text-xs font-semibold rounded-full bg-gray-100 text-gray-700 border border-gray-200">
                        {{ $age ? $age . ' Tahun' : 'Usia -' }}
                    </span>
                </div>

                <!-- Last Active Status Box -->
                <div class="mt-4 p-3 rounded-xl bg-emerald-50/70 border border-emerald-200 text-left flex items-center justify-between text-xs">
                    <div class="flex items-center gap-2">
                        <span class="w-2.5 h-2.5 rounded-full bg-emerald-500 animate-pulse"></span>
                        <span class="font-bold text-emerald-900">{{ $profile->last_active_label }}</span>
                    </div>
                    @if($profile->user && $profile->user->last_login_at)
                        <span class="text-[10px] text-emerald-700">{{ $profile->user->last_login_at->translatedFormat('d M Y, H:i') }} WIB</span>
                    @endif
                </div>

                <div class="mt-6 pt-5 border-t border-gray-100 text-left space-y-3 text-xs">
                    <div>
                        <span class="text-gray-400 block font-medium">Email Akun:</span>
                        <span class="text-gray-900 font-semibold select-all">{{ $profile->user->email ?? '-' }}</span>
                    </div>
                    <div>
                        <span class="text-gray-400 block font-medium">Tempat, Tanggal Lahir:</span>
                        <span class="text-gray-900 font-semibold">{{ $profile->birth_place_date ?: '-' }}</span>
                    </div>
                    <div>
                        <span class="text-gray-400 block font-medium">Instagram:</span>
                        @if($profile->instagram)
                            <a href="https://instagram.com/{{ ltrim($profile->instagram, '@') }}" target="_blank"
                                class="text-pink-600 font-bold hover:underline inline-flex items-center gap-1">
                                <span>&#64;{{ ltrim($profile->instagram, '@') }}</span>
                                <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                </svg>
                            </a>
                        @else
                            <span class="text-gray-500 font-medium">-</span>
                        @endif
                    </div>
                    <div>
                        <span class="text-gray-400 block font-medium">Terdaftar Sejak:</span>
                        <span class="text-gray-700 font-medium">{{ $profile->created_at->translatedFormat('d F Y, H:i') }} WIB</span>
                    </div>
                </div>
            </div>

            <!-- Informed Consent Document -->
            <div class="bg-white rounded-2xl border border-gray-200/80 shadow-xs p-6">
                <h4 class="text-xs font-bold uppercase tracking-wider text-gray-500 mb-3 flex items-center gap-1.5">
                    <span>📄</span>
                    <span>Dokumen Informed Consent</span>
                </h4>
                @if ($profile->informed_consent_url)
                    <div class="space-y-3">
                        <p class="text-xs text-gray-600">Peserta telah menandatangani &amp; mengunggah dokumen informed consent resmi.</p>
                        <a href="{{ $profile->informed_consent_url }}" target="_blank"
                            class="w-full inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl bg-pink-50 border border-pink-200 text-pink-700 font-bold text-xs hover:bg-pink-100 transition shadow-2xs">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            <span>Buka / Unduh Berkas</span>
                        </a>
                    </div>
                @else
                    <div class="text-center py-4 bg-gray-50 rounded-xl border border-dashed border-gray-200">
                        <p class="text-xs text-gray-400">Belum ada berkas informed consent diunggah.</p>
                    </div>
                @endif
            </div>

            <!-- SPN Batch History -->
            <div class="bg-white rounded-2xl border border-gray-200/80 shadow-xs p-6 space-y-3">
                <h4 class="text-xs font-bold uppercase tracking-wider text-gray-500 flex items-center gap-1.5 pb-2 border-b border-gray-100">
                    <span>🎓</span>
                    <span>Riwayat Keikutsertaan SPN</span>
                </h4>
                @php
                    $alumniBatches = $profile->user ? $profile->user->batchAlumni : collect();
                    $registrations = $profile->user ? $profile->user->spnRegistrations : collect();
                @endphp
                @if ($alumniBatches->isNotEmpty() || $registrations->isNotEmpty())
                    <div class="space-y-2 text-xs">
                        @foreach ($alumniBatches as $ba)
                            <div class="p-2.5 rounded-xl bg-teal-50/70 border border-teal-200 flex items-center justify-between">
                                <div>
                                    <span class="font-bold text-teal-900 block">{{ $ba->activityBatch->nama_batch ?? 'Batch SPN' }}</span>
                                    <span class="text-[10px] text-teal-700">Tahun: {{ $ba->activityBatch->tahun ?? '-' }} &middot; {{ $ba->gender }}</span>
                                </div>
                                <span class="px-2 py-0.5 rounded-full bg-teal-200/60 text-teal-800 text-[10px] font-bold">Alumni Resmi</span>
                            </div>
                        @endforeach
                        @foreach ($registrations as $reg)
                            @if(!$alumniBatches->pluck('activity_batch_id')->contains($reg->activity_batch_id))
                                <div class="p-2.5 rounded-xl bg-gray-50 border border-gray-200 flex items-center justify-between">
                                    <div>
                                        <span class="font-semibold text-gray-800 block">{{ $reg->activityBatch->nama_batch ?? 'SPN' }}</span>
                                        <span class="text-[10px] text-gray-500">Kode: {{ $reg->registration_code }}</span>
                                    </div>
                                    <span class="px-2 py-0.5 rounded-full bg-gray-200 text-gray-700 text-[10px] font-medium uppercase">{{ $reg->status }}</span>
                                </div>
                            @endif
                        @endforeach
                    </div>
                @else
                    <p class="text-xs text-gray-400">Belum ada catatan batch alumni tersambung.</p>
                @endif
            </div>

        </div>

        <!-- Right: Full Profile Details -->
        <div class="lg:col-span-2 space-y-6">
            
            <!-- Card 1: Data Wilayah (Asal Kelahiran & Domisili Saat Ini) -->
            <div class="bg-white rounded-2xl border border-gray-200/80 shadow-xs p-6 sm:p-7">
                <h3 class="text-sm font-bold text-gray-900 pb-3 border-b border-gray-100 mb-4 flex items-center gap-2">
                    <span>📍</span>
                    <span>Wilayah Asal Daerah &amp; Domisili Saat Ini</span>
                </h3>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <!-- Asal Daerah -->
                    <div class="p-4 rounded-xl bg-emerald-50/60 border border-emerald-100 space-y-2 text-xs text-gray-700">
                        <h4 class="font-bold text-emerald-900 flex items-center gap-1.5 text-xs">
                            <span>🏡</span>
                            <span>Asal Daerah (Kelahiran)</span>
                        </h4>
                        <div class="space-y-1 pt-1">
                            <div><span class="text-gray-400">Provinsi:</span> <span class="font-semibold text-gray-900">{{ $profile->origin_province ?: '-' }}</span></div>
                            <div><span class="text-gray-400">Kota/Kabupaten:</span> <span class="font-semibold text-gray-900">{{ $profile->origin_city ?: '-' }}</span></div>
                            <div><span class="text-gray-400">Kecamatan:</span> <span class="font-semibold text-gray-900">{{ $profile->origin_district ?: '-' }}</span></div>
                            <div><span class="text-gray-400">Desa/Kelurahan:</span> <span class="font-semibold text-gray-900">{{ $profile->origin_village ?: '-' }}</span></div>
                        </div>
                    </div>

                    <!-- Domisili Saat Ini -->
                    <div class="p-4 rounded-xl bg-blue-50/60 border border-blue-100 space-y-2 text-xs text-gray-700">
                        <h4 class="font-bold text-blue-900 flex items-center gap-1.5 text-xs">
                            <span>🏢</span>
                            <span>Domisili Saat Ini</span>
                        </h4>
                        <div class="space-y-1 pt-1">
                            <div><span class="text-gray-400">Provinsi:</span> <span class="font-semibold text-gray-900">{{ $profile->residence_province ?: '-' }}</span></div>
                            <div><span class="text-gray-400">Kota/Kabupaten:</span> <span class="font-semibold text-gray-900">{{ $profile->residence_city ?: '-' }}</span></div>
                            <div><span class="text-gray-400">Kecamatan:</span> <span class="font-semibold text-gray-900">{{ $profile->residence_district ?: '-' }}</span></div>
                            <div><span class="text-gray-400">Desa/Kelurahan:</span> <span class="font-semibold text-gray-900">{{ $profile->residence_village ?: '-' }}</span></div>
                            <div class="pt-1 border-t border-blue-200/60"><span class="text-gray-400">Alamat Lengkap:</span> <span class="font-semibold text-gray-900 block mt-0.5">{{ $profile->current_residence ?: '-' }}</span></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card 2: Pendidikan & Karir Pekerjaan -->
            <div class="bg-white rounded-2xl border border-gray-200/80 shadow-xs p-6 sm:p-7">
                <h3 class="text-sm font-bold text-gray-900 pb-3 border-b border-gray-100 mb-4 flex items-center gap-2">
                    <span>🎓</span>
                    <span>Pendidikan &amp; Karir Pekerjaan</span>
                </h3>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-xs">
                    <div class="p-4 rounded-xl bg-gray-50 border border-gray-200/80 space-y-1.5">
                        <span class="text-gray-400 font-medium block">Pendidikan Terakhir:</span>
                        <div class="text-sm font-extrabold text-gray-900">
                            {{ $profile->education_level ?: ($profile->last_education ?: '-') }}
                        </div>
                        @if ($profile->university)
                            <div class="text-gray-800 font-semibold pt-1">
                                📚 {{ $profile->university === 'Lainnya' ? ($profile->custom_university ?: 'Lainnya') : $profile->university }}
                            </div>
                        @endif
                        @if ($profile->major)
                            <div class="text-gray-600">
                                Jurusan/Prodi: <span class="font-semibold text-gray-800">{{ $profile->major }}</span>
                            </div>
                        @endif
                    </div>

                    <div class="p-4 rounded-xl bg-gray-50 border border-gray-200/80 space-y-1.5">
                        <span class="text-gray-400 font-medium block">Pekerjaan &amp; Profesi:</span>
                        <div class="text-sm font-extrabold text-gray-900">
                            💼 {{ $profile->occupation ?: '-' }}
                        </div>
                        <div>
                            <span class="text-gray-400 block mt-2">Target Tahun Menikah:</span>
                            <span class="font-extrabold text-pink-600 text-sm block">{{ $profile->marriage_target_year ? $profile->marriage_target_year : 'Insya Allah Segera' }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card 3: Visi Misi, Kepribadian & Kriteria Pasangan -->
            <div class="bg-white rounded-2xl border border-gray-200/80 shadow-xs p-6 sm:p-7 space-y-5">
                <h3 class="text-sm font-bold text-gray-900 pb-3 border-b border-gray-100 flex items-center gap-2">
                    <span>🕊️</span>
                    <span>Visi Misi, Kepribadian &amp; Kriteria Pasangan</span>
                </h3>

                <div>
                    <h4 class="text-xs font-bold text-gray-800 mb-1.5">Visi Misi Rumah Tangga:</h4>
                    <div class="text-xs text-gray-700 bg-gray-50 p-4 rounded-xl border border-gray-200/80 leading-relaxed whitespace-pre-line">
                        {{ $profile->visi_misi ?: ($profile->ideal_partner_criteria ?: 'Belum diisi.') }}
                    </div>
                </div>

                <div>
                    <h4 class="text-xs font-bold text-gray-800 mb-1.5">Ekspektasi &amp; Kriteria Pasangan yang Diharapkan:</h4>
                    <div class="text-xs text-gray-700 bg-gray-50 p-4 rounded-xl border border-gray-200/80 leading-relaxed whitespace-pre-line">
                        {{ $profile->expectation ?: ($profile->ideal_partner_criteria ?: 'Belum diisi.') }}
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <h4 class="text-xs font-bold text-gray-800 mb-1.5">Gambaran Kepribadian Diri:</h4>
                        <div class="text-xs text-gray-700 bg-gray-50 p-3.5 rounded-xl border border-gray-200/80 leading-relaxed whitespace-pre-line">
                            {{ $profile->personality ?: '-' }}
                        </div>
                    </div>
                    <div>
                        <h4 class="text-xs font-bold text-gray-800 mb-1.5">Kelebihan &amp; Kekurangan Diri:</h4>
                        <div class="text-xs text-gray-700 bg-gray-50 p-3.5 rounded-xl border border-gray-200/80 leading-relaxed whitespace-pre-line">
                            {{ $profile->kelebihan_kekurangan ?: '-' }}
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card 4: Skrining Khusus & Syariah -->
            <div class="bg-white rounded-2xl border border-gray-200/80 shadow-xs p-6 sm:p-7">
                <h3 class="text-sm font-bold text-gray-900 pb-3 border-b border-gray-100 mb-4 flex items-center gap-2">
                    <span>🛡️</span>
                    <span>Kesiapan &amp; Skrining Syariah</span>
                </h3>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 text-xs">
                    <div class="p-3.5 rounded-xl border {{ $profile->is_smoker ? 'bg-rose-50 border-rose-200 text-rose-800' : 'bg-emerald-50 border-emerald-200 text-emerald-800' }} flex items-center justify-between">
                        <span class="font-medium">Kebiasaan Merokok:</span>
                        <span class="font-bold">{{ $profile->is_smoker ? '🚬 Merokok' : '✓ Tidak Merokok' }}</span>
                    </div>

                    <div class="p-3.5 rounded-xl border {{ $profile->is_polygamy_intended ? 'bg-amber-50 border-amber-200 text-amber-800' : 'bg-gray-50 border-gray-200 text-gray-800' }} flex items-center justify-between">
                        <span class="font-medium">Kesiapan Poligami:</span>
                        <span class="font-bold">{{ $profile->is_polygamy_intended ? 'Ya' : 'Tidak' }}</span>
                    </div>

                    <div class="p-3.5 rounded-xl border {{ $profile->has_debt ? 'bg-amber-50 border-amber-200 text-amber-800' : 'bg-emerald-50 border-emerald-200 text-emerald-800' }} flex items-center justify-between">
                        <span class="font-medium">Tanggungan Hutang:</span>
                        <span class="font-bold">{{ $profile->has_debt ? '⚠️ Ada Tanggungan' : '✓ Bebas Hutang' }}</span>
                    </div>

                    <div class="p-3.5 rounded-xl border {{ $profile->has_dependents ? 'bg-blue-50 border-blue-200 text-blue-800' : 'bg-gray-50 border-gray-200 text-gray-800' }} flex items-center justify-between">
                        <span class="font-medium">Tanggungan Keluarga:</span>
                        <span class="font-bold">{{ $profile->has_dependents ? 'Ada Tanggungan' : 'Tidak Ada' }}</span>
                    </div>
                </div>
            </div>

            <!-- Card 5: Riwayat Pertanyaan & Jawaban Kuesioner -->
            <div class="bg-white rounded-2xl border border-gray-200/80 shadow-xs p-6 sm:p-7">
                <div class="flex items-center justify-between pb-3 border-b border-gray-100 mb-4">
                    <h3 class="text-sm font-bold text-gray-900 flex items-center gap-2">
                        <span>💬</span>
                        <span>Riwayat Pertanyaan Masuk ({{ $profile->questions->count() }})</span>
                    </h3>
                    <span class="text-xs text-gray-500">
                        {{ $profile->questions->where('is_answered', true)->count() }} Terjawab
                    </span>
                </div>

                @if ($profile->questions->isNotEmpty())
                    <div class="space-y-4">
                        @foreach ($profile->questions as $q)
                            <div class="bg-gray-50/70 border border-gray-200/80 rounded-2xl p-4 space-y-2 text-xs">
                                <div class="flex items-center justify-between text-gray-500 text-[11px]">
                                    <div class="flex items-center gap-2">
                                        <span class="font-bold text-gray-700">Dari: {{ $q->is_anonymous ? 'Penanya Anonim' : ($q->askedBy->name ?? 'User') }}</span>
                                        <span>&bull; {{ $q->created_at->translatedFormat('d M Y, H:i') }} WIB</span>
                                    </div>
                                    <div class="flex items-center gap-1.5">
                                        <span class="px-2 py-0.5 rounded-full {{ $q->is_public ? 'bg-blue-50 text-blue-700 border border-blue-200' : 'bg-gray-200 text-gray-600' }} font-bold text-[10px]">
                                            {{ $q->is_public ? 'Publik' : 'Privat' }}
                                        </span>
                                        <span class="px-2 py-0.5 rounded-full {{ $q->is_answered ? 'bg-emerald-50 text-emerald-700 border border-emerald-200' : 'bg-amber-50 text-amber-700 border border-amber-200' }} font-bold text-[10px]">
                                            {{ $q->is_answered ? 'Terjawab' : 'Belum Dijawab' }}
                                        </span>
                                    </div>
                                </div>
                                <div class="p-3 bg-white rounded-xl border border-gray-200 text-gray-900 leading-relaxed font-medium">
                                    <span class="text-pink-600 font-bold mr-1">Q:</span>
                                    {{ $q->question }}
                                </div>
                                @if ($q->is_answered)
                                    <div class="p-3 bg-emerald-50/60 rounded-xl border border-emerald-200 text-emerald-900 leading-relaxed">
                                        <div class="flex items-center justify-between mb-1">
                                            <span class="text-emerald-700 font-bold">A (Jawaban):</span>
                                            @if($q->answered_at)
                                                <span class="text-[10px] text-emerald-600">{{ $q->answered_at->translatedFormat('d M Y, H:i') }} WIB</span>
                                            @endif
                                        </div>
                                        <p class="whitespace-pre-line">{{ $q->answer }}</p>
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-8 bg-gray-50/50 rounded-xl border border-dashed border-gray-200">
                        <p class="text-xs text-gray-400">Belum ada pertanyaan yang diajukan ke profil ini.</p>
                    </div>
                @endif
            </div>

        </div>

    </div>

</div>
@endsection

