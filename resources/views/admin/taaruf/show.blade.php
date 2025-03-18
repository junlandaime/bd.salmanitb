@extends('admin.layouts.app')

@section('title', 'Detail Profil Taaruf')

@section('content')
    <div class="py-6 px-4">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-semibold text-gray-800">Detail Profil Taaruf</h1>
            <div class="flex space-x-2">
                <a href="{{ route('admin.taaruf.edit', $profile->id) }}"
                    class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded">
                    <i class="fas fa-edit mr-2"></i>Edit Profil
                </a>
                <a href="{{ route('admin.taaruf.index') }}"
                    class="bg-gray-500 hover:bg-gray-600 text-white py-2 px-4 rounded">
                    <i class="fas fa-arrow-left mr-2"></i>Kembali
                </a>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="p-6">
                <div class="flex flex-col md:flex-row">
                    <!-- Left Column - Photo and Basic Info -->
                    <div class="w-full md:w-1/3 mb-6 md:mb-0 md:pr-6">
                        <div class="mb-6 flex justify-center">
                            @if ($profile->photo_url)
                                <img src="{{ Storage::url($profile->photo_url) }}" alt="{{ $profile->full_name }}"
                                    class="w-48 h-48 object-cover rounded-lg shadow-md">
                            @else
                                <div class="w-48 h-48 bg-gray-200 rounded-lg shadow-md flex items-center justify-center">
                                    <svg class="h-24 w-24 text-gray-400" fill="currentColor" viewBox="0 0 24 24">
                                        <path
                                            d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z" />
                                    </svg>
                                </div>
                            @endif
                        </div>

                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h2 class="text-xl font-semibold mb-4">Informasi Dasar</h2>

                            <div class="mb-3">
                                <span class="block text-sm font-medium text-gray-500">Status Profil</span>
                                <span
                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $profile->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    {{ $profile->is_active ? 'Aktif' : 'Tidak Aktif' }}
                                </span>
                            </div>

                            <div class="mb-3">
                                <span class="block text-sm font-medium text-gray-500">Nama Lengkap</span>
                                <span class="text-gray-900">{{ $profile->full_name }}</span>
                            </div>

                            <div class="mb-3">
                                <span class="block text-sm font-medium text-gray-500">Nama Panggilan</span>
                                <span class="text-gray-900">{{ $profile->nickname }}</span>
                            </div>

                            <div class="mb-3">
                                <span class="block text-sm font-medium text-gray-500">Jenis Kelamin</span>
                                <span
                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $profile->gender === 'male' ? 'bg-blue-100 text-blue-800' : 'bg-pink-100 text-pink-800' }}">
                                    {{ $profile->gender === 'male' ? 'Laki-laki' : 'Perempuan' }}
                                </span>
                            </div>

                            <div class="mb-3">
                                <span class="block text-sm font-medium text-gray-500">Tempat, Tanggal Lahir</span>
                                <span class="text-gray-900">{{ $profile->birth_place_date }}</span>
                            </div>

                            <div class="mb-3">
                                <span class="block text-sm font-medium text-gray-500">Email</span>
                                <span class="text-gray-900">{{ $profile->user->email }}</span>
                            </div>

                            @if ($profile->instagram)
                                <div class="mb-3">
                                    <span class="block text-sm font-medium text-gray-500">Instagram</span>
                                    <span class="text-gray-900">{{ $profile->instagram }}</span>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Right Column - Detailed Info -->
                    <div class="w-full md:w-2/3">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="bg-gray-50 p-4 rounded-lg">
                                <h2 class="text-xl font-semibold mb-4">Informasi Pribadi</h2>

                                <div class="mb-3">
                                    <span class="block text-sm font-medium text-gray-500">Domisili Saat Ini</span>
                                    <span class="text-gray-900">{{ $profile->current_residence }}</span>
                                </div>

                                <div class="mb-3">
                                    <span class="block text-sm font-medium text-gray-500">Pendidikan Terakhir</span>
                                    <span class="text-gray-900">{{ $profile->last_education }}</span>
                                </div>

                                <div class="mb-3">
                                    <span class="block text-sm font-medium text-gray-500">Pekerjaan</span>
                                    <span class="text-gray-900">{{ $profile->occupation }}</span>
                                </div>

                                <div class="mb-3">
                                    <span class="block text-sm font-medium text-gray-500">Target Tahun Menikah</span>
                                    <span
                                        class="text-gray-900">{{ $profile->marriage_target_year ?? 'Tidak ditentukan' }}</span>
                                </div>

                                <div class="mb-3">
                                    <span class="block text-sm font-medium text-gray-500">Kepribadian</span>
                                    <span class="text-gray-900">{{ $profile->personality ?? 'Tidak diisi' }}</span>
                                </div>
                            </div>

                            <div class="bg-gray-50 p-4 rounded-lg">
                                <h2 class="text-xl font-semibold mb-4">Status Taaruf</h2>

                                <div class="mb-3">
                                    <span class="block text-sm font-medium text-gray-500">Sedang Dalam Proses Taaruf</span>
                                    <span
                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $profile->is_in_taaruf_process ? 'bg-yellow-100 text-yellow-800' : 'bg-gray-100 text-gray-800' }}">
                                        {{ $profile->is_in_taaruf_process ? 'Ya' : 'Tidak' }}
                                    </span>
                                </div>

                                <div class="mb-3">
                                    <span class="block text-sm font-medium text-gray-500">Perokok</span>
                                    <span
                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $profile->is_smoker ? 'bg-red-100 text-red-800' : 'bg-green-100 text-green-800' }}">
                                        {{ $profile->is_smoker ? 'Ya' : 'Tidak' }}
                                    </span>
                                </div>

                                @if ($profile->gender === 'male')
                                    <div class="mb-3">
                                        <span class="block text-sm font-medium text-gray-500">Berniat Poligami</span>
                                        <span
                                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $profile->is_polygamy_intended ? 'bg-yellow-100 text-yellow-800' : 'bg-green-100 text-green-800' }}">
                                            {{ $profile->is_polygamy_intended ? 'Ya' : 'Tidak' }}
                                        </span>
                                    </div>
                                @endif

                                <div class="mb-3">
                                    <span class="block text-sm font-medium text-gray-500">Memiliki Hutang</span>
                                    <span
                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $profile->has_debt ? 'bg-yellow-100 text-yellow-800' : 'bg-green-100 text-green-800' }}">
                                        {{ $profile->has_debt ? 'Ya' : 'Tidak' }}
                                    </span>
                                </div>

                                <div class="mb-3">
                                    <span class="block text-sm font-medium text-gray-500">Memiliki Tanggungan</span>
                                    <span
                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $profile->has_dependents ? 'bg-yellow-100 text-yellow-800' : 'bg-green-100 text-green-800' }}">
                                        {{ $profile->has_dependents ? 'Ya' : 'Tidak' }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="mt-6 bg-gray-50 p-4 rounded-lg">
                            <h2 class="text-xl font-semibold mb-4">Ekspektasi & Kriteria</h2>

                            <div class="mb-3">
                                <span class="block text-sm font-medium text-gray-500 mb-1">Ekspektasi dalam
                                    Pernikahan</span>
                                <p class="text-gray-900 whitespace-pre-line">{{ $profile->expectation ?? 'Tidak diisi' }}
                                </p>
                            </div>

                            <div class="mb-3">
                                <span class="block text-sm font-medium text-gray-500 mb-1">Visi Misi Pernikahan</span>
                                <p class="text-gray-900 whitespace-pre-line">
                                    {{ $profile->ideal_partner_criteria ?? 'Tidak diisi' }}</p>
                            </div>
                        </div>

                        <div class="mt-6 bg-gray-50 p-4 rounded-lg">
                            <h2 class="text-xl font-semibold mb-4">Dokumen</h2>

                            <div class="mb-3">
                                <span class="block text-sm font-medium text-gray-500 mb-1">Informed Consent</span>
                                @if ($profile->informed_consent_url)
                                    <a href="{{ $profile->informed_consent_url }}" target="_blank"
                                        class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                        <svg class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                        Lihat Dokumen
                                    </a>
                                @else
                                    <span class="text-red-500">Dokumen tidak tersedia</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
