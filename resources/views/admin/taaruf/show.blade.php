@extends('admin.layouts.app')

@section('title', 'Detail Profil Taaruf - ' . $profile->full_name)

@section('content')
<div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
    
    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
        <div>
            <div class="flex items-center gap-2 text-xs text-gray-500 mb-1">
                <a href="{{ route('admin.taaruf.index') }}" class="hover:text-pink-600">Layanan Ta'aruf</a>
                <span>/</span>
                <span>Detail Profil</span>
            </div>
            <div class="flex items-center gap-3">
                <h1 class="text-2xl font-bold text-gray-900">{{ $profile->full_name }}</h1>
                <span class="px-2.5 py-0.5 text-xs font-semibold rounded-full {{ $profile->is_active ? 'bg-emerald-50 text-emerald-700 border border-emerald-200' : 'bg-red-50 text-red-700 border border-red-200' }}">
                    {{ $profile->is_active ? 'Aktif' : 'Non-aktif' }}
                </span>
                @if ($profile->is_in_taaruf_process)
                    <span class="px-2.5 py-0.5 text-xs font-semibold rounded-full bg-amber-50 text-amber-700 border border-amber-200">
                        Sedang Proses
                    </span>
                @endif
            </div>
        </div>
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.taaruf.index') }}"
                class="px-4 py-2.5 rounded-xl border border-gray-300 bg-white text-gray-700 hover:bg-gray-50 font-semibold text-sm shadow-sm transition">
                &larr; Kembali
            </a>
            <a href="{{ route('admin.taaruf.edit', $profile->id) }}"
                class="px-4 py-2.5 rounded-xl bg-pink-600 hover:bg-pink-700 text-white font-semibold text-sm shadow-sm transition">
                Edit Profil
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        <!-- Left: Photo & Identity -->
        <div class="space-y-6">
            <div class="bg-white rounded-2xl border border-gray-200/80 shadow-sm p-6 text-center">
                <div class="mb-4 flex justify-center">
                    @if ($profile->photo_url)
                        <img src="{{ $profile->photo_url }}" alt="{{ $profile->full_name }}"
                            class="w-40 h-40 object-cover rounded-2xl shadow-sm border border-gray-100">
                    @else
                        <div class="w-40 h-40 bg-gray-100 rounded-2xl flex items-center justify-center text-4xl border border-gray-200">
                            {{ $profile->gender === 'male' ? '👨' : '𝄩👩' }}
                        </div>
                    @endif
                </div>

                <h3 class="text-base font-bold text-gray-900">{{ $profile->full_name }}</h3>
                <p class="text-xs text-gray-500 mt-0.5">({{ $profile->nickname ?: '-' }})</p>

                <div class="mt-4 flex items-center justify-center gap-2">
                    <span class="px-3 py-1 text-xs font-semibold rounded-full {{ $profile->gender === 'male' ? 'bg-blue-50 text-blue-700 border border-blue-200' : 'bg-pink-50 text-pink-700 border border-pink-200' }}">
                        {{ $profile->gender === 'male' ? '♂ Laki-laki' : '♀ Perempuan' }}
                    </span>
                </div>

                <div class="mt-6 pt-6 border-t border-gray-100 text-left space-y-3 text-xs">
                    <div>
                        <span class="text-gray-400 block">Email Akun:</span>
                        <span class="text-gray-900 font-medium">{{ $profile->user->email ?? '-' }}</span>
                    </div>
                    <div>
                        <span class="text-gray-400 block">Tempat, Tanggal Lahir:</span>
                        <span class="text-gray-900 font-medium">{{ $profile->birth_place_date ?: '-' }}</span>
                    </div>
                    <div>
                        <span class="text-gray-400 block">Instagram:</span>
                        <span class="text-gray-900 font-medium">{{ $profile->instagram ?: '-' }}</span>
                    </div>
                </div>
            </div>

            <!-- Informed Consent File -->
            <div class="bg-white rounded-2xl border border-gray-200/80 shadow-sm p-6">
                <h4 class="text-xs font-bold uppercase tracking-wider text-gray-500 mb-3">Dokumen Informed Consent</h4>
                @if ($profile->informed_consent_url)
                    <a href="{{ $profile->informed_consent_url }}" target="_blank"
                        class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-indigo-50 border border-indigo-200 text-indigo-700 font-semibold text-xs hover:bg-indigo-100 transition">
                        <span>📄 Lihat Dokumen Bukti &rarr;</span>
                    </a>
                @else
                    <p class="text-xs text-gray-400">Belum ada berkas informed consent diunggah.</p>
                @endif
            </div>
        </div>

        <!-- Right: Background & Detailed Criteria -->
        <div class="lg:col-span-2 space-y-6">
            
            <!-- Personal Info Card -->
            <div class="bg-white rounded-2xl border border-gray-200/80 shadow-sm p-6">
                <h3 class="text-base font-bold text-gray-900 pb-3 border-b border-gray-100 mb-4">Informasi Pribadi &amp; Karir</h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-xs">
                    <div>
                        <span class="text-gray-400 block">Domisili:</span>
                        <span class="text-gray-900 font-semibold mt-0.5 block">{{ $profile->current_residence ?: '-' }}</span>
                    </div>
                    <div>
                        <span class="text-gray-400 block">Pendidikan Terakhir:</span>
                        <span class="text-gray-900 font-semibold mt-0.5 block">{{ $profile->last_education ?: '-' }}</span>
                    </div>
                    <div>
                        <span class="text-gray-400 block">Pekerjaan:</span>
                        <span class="text-gray-900 font-semibold mt-0.5 block">{{ $profile->occupation ?: '-' }}</span>
                    </div>
                    <div>
                        <span class="text-gray-400 block">Target Tahun Menikah:</span>
                        <span class="text-gray-900 font-semibold mt-0.5 block">{{ $profile->marriage_target_year ?: 'Fleksibel' }}</span>
                    </div>
                </div>
            </div>

            <!-- Vision & Expectations Card -->
            <div class="bg-white rounded-2xl border border-gray-200/80 shadow-sm p-6 space-y-4">
                <h3 class="text-base font-bold text-gray-900 pb-3 border-b border-gray-100">Visi Misi &amp; Kriteria Pasangan</h3>
                
                <div>
                    <span class="text-xs font-semibold text-gray-700 block mb-1">Ekspektasi dalam Pernikahan:</span>
                    <p class="text-xs text-gray-600 bg-gray-50 p-3.5 rounded-xl leading-relaxed whitespace-pre-line">{{ $profile->expectation ?: 'Tidak diisi' }}</p>
                </div>

                <div>
                    <span class="text-xs font-semibold text-gray-700 block mb-1">Kriteria Pasangan Ideal:</span>
                    <p class="text-xs text-gray-600 bg-gray-50 p-3.5 rounded-xl leading-relaxed whitespace-pre-line">{{ $profile->ideal_partner_criteria ?: 'Tidak diisi' }}</p>
                </div>

                <div>
                    <span class="text-xs font-semibold text-gray-700 block mb-1">Kelebihan dan Kekurangan Diri:</span>
                    <p class="text-xs text-gray-600 bg-gray-50 p-3.5 rounded-xl leading-relaxed whitespace-pre-line">{{ $profile->kelebihan_kekurangan ?: 'Tidak diisi' }}</p>
                </div>
            </div>

        </div>

    </div>

</div>
@endsection
