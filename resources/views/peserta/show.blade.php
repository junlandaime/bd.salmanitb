@extends('layouts.peserta')

@section('title', 'Detail Pendaftaran - SPN')
@section('header', 'Detail Pendaftaran')

@section('content')
<div class="max-w-5xl mx-auto">
    
    <div class="mb-6 flex justify-between items-center">
        <a href="{{ route('peserta.dashboard') }}" class="text-teal-600 hover:text-teal-800 font-medium text-sm flex items-center">
            <i class="fas fa-arrow-left mr-2"></i> Kembali ke Dashboard
        </a>
        <a href="{{ route('peserta.registration.edit', $registration->id) }}" class="bg-teal-600 hover:bg-teal-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition shadow-sm">
            <i class="fas fa-edit mr-2"></i> Edit Data
        </a>
    </div>

    <!-- Status Banner -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden mb-6 p-6">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center">
            <div>
                <span class="text-xs font-semibold uppercase tracking-wider text-gray-500">Kode Pendaftaran</span>
                <h2 class="text-2xl font-bold text-gray-900 font-mono mt-1">{{ $registration->registration_code }}</h2>
                <p class="text-sm text-gray-500 mt-1">Didaftarkan pada: {{ $registration->created_at->format('d F Y, H:i') }}</p>
            </div>
            <div class="mt-4 md:mt-0 text-right">
                <span class="px-4 py-2 rounded-full font-bold border {{ $registration->status_badge }} inline-block">
                    Status: {{ ucfirst($registration->status) }}
                </span>
            </div>
        </div>
        
        @if(!empty($registration->catatan_admin))
            <div class="mt-6 p-4 bg-red-50 border border-red-200 rounded-lg">
                <h4 class="text-sm font-bold text-red-800 mb-1"><i class="fas fa-comment-dots mr-2"></i>Pesan dari Admin:</h4>
                <p class="text-sm text-red-700">{{ $registration->catatan_admin }}</p>
            </div>
        @endif
        
        @if(!empty($registration->pending_changes))
            <div class="mt-6 p-4 bg-yellow-50 border-l-4 border-yellow-400 rounded">
                <div class="flex items-start">
                    <i class="fas fa-info-circle text-yellow-500 mt-0.5 mr-3"></i>
                    <div>
                        <h4 class="text-sm font-bold text-yellow-800">Menunggu Persetujuan Perubahan Data</h4>
                        <p class="text-sm text-yellow-700 mt-1 mb-2">Perubahan data yang dilindungi sedang menunggu verifikasi admin:</p>
                        <ul class="list-disc ml-5 text-sm text-yellow-800">
                            @foreach($registration->pending_changes as $key => $val)
                                <li><strong>{{ ucfirst(str_replace('_', ' ', $key)) }}:</strong> Menjadi "{{ $val }}"</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @endif
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        
        <!-- Kolom Kiri (Besar) -->
        <div class="lg:col-span-2 space-y-6">
            
            <!-- Data Diri -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100 bg-gray-50">
                    <h3 class="font-bold text-gray-800"><i class="fas fa-user mr-2 text-teal-600"></i> Data Diri</h3>
                </div>
                <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-y-4 gap-x-6">
                    <div class="col-span-1 md:col-span-2">
                        @include('components.peserta-field', ['label' => 'Nama Lengkap', 'value' => $registration->nama_lengkap])
                    </div>
                    @include('components.peserta-field', ['label' => 'Nama Panggilan', 'value' => $registration->nama_panggilan])
                    @include('components.peserta-field', ['label' => 'Gelar', 'value' => $registration->nama_gelar])
                    @include('components.peserta-field', ['label' => 'Jenis Kelamin', 'value' => ucfirst($registration->jenis_kelamin)])
                    @include('components.peserta-field', ['label' => 'Status Pernikahan', 'value' => ucfirst($registration->status_pernikahan)])
                    @include('components.peserta-field', ['label' => 'Tanggal Lahir', 'value' => $registration->tanggal_lahir?->format('d F Y') . ' (' . $registration->usia . ' tahun)'])
                    @include('components.peserta-field', ['label' => 'Asal Daerah', 'value' => $registration->asal_daerah])
                    <div class="col-span-1 md:col-span-2">
                        @include('components.peserta-field', ['label' => 'Alamat Domisili', 'value' => $registration->domisili])
                    </div>
                </div>
            </div>

            <!-- Kontak -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100 bg-gray-50">
                    <h3 class="font-bold text-gray-800"><i class="fas fa-address-book mr-2 text-teal-600"></i> Kontak</h3>
                </div>
                <div class="p-6 grid grid-cols-1 sm:grid-cols-3 gap-4">
                    @include('components.peserta-field', ['label' => 'Email', 'value' => $registration->email])
                    @include('components.peserta-field', ['label' => 'WhatsApp', 'value' => $registration->whatsapp])
                    @include('components.peserta-field', ['label' => 'Instagram', 'value' => $registration->instagram])
                </div>
            </div>

            <!-- Pendidikan & Pekerjaan -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100 bg-gray-50">
                    <h3 class="font-bold text-gray-800"><i class="fas fa-graduation-cap mr-2 text-teal-600"></i> Pendidikan & Pekerjaan</h3>
                </div>
                <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-y-4 gap-x-6">
                    @include('components.peserta-field', ['label' => 'Status Pendidikan', 'value' => strtoupper($registration->pendidikan)])
                    @include('components.peserta-field', ['label' => 'Status Diri', 'value' => ucwords(str_replace('_', ' ', $registration->status_diri))])
                    @include('components.peserta-field', ['label' => 'Universitas', 'value' => $registration->universitas])
                    @include('components.peserta-field', ['label' => 'Jurusan / Angkatan', 'value' => $registration->jurusan . ($registration->angkatan ? ' / ' . $registration->angkatan : '')])
                    @include('components.peserta-field', ['label' => 'Pekerjaan', 'value' => $registration->pekerjaan])
                    @include('components.peserta-field', ['label' => 'Jabatan', 'value' => $registration->jabatan])
                    @include('components.peserta-field', ['label' => 'Instansi', 'value' => $registration->instansi])
                    @include('components.peserta-field', ['label' => 'Lokasi Kerja', 'value' => $registration->lokasi_kerja])
                </div>
            </div>
            
            <!-- Screening -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100 bg-gray-50">
                    <h3 class="font-bold text-gray-800"><i class="fas fa-clipboard-list mr-2 text-teal-600"></i> Data Screening</h3>
                </div>
                <div class="p-6 space-y-6">
                    <div>
                        <span class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1">Restu Orang Tua</span>
                        <span class="inline-block px-3 py-1 bg-gray-100 rounded-full text-sm font-medium">{{ ucfirst($registration->restu) }} Mengabari</span>
                    </div>
                    <div>
                        <span class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1">Gambaran Awal SPN</span>
                        <p class="text-sm text-gray-800 bg-gray-50 p-3 rounded-lg">{{ $registration->gambaran_awal }}</p>
                    </div>
                    <div>
                        <span class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1">Alasan Mengikuti SPN</span>
                        <p class="text-sm text-gray-800 bg-gray-50 p-3 rounded-lg">{{ $registration->alasan }}</p>
                    </div>
                    <div>
                        <span class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1">Harapan Setelah SPN</span>
                        <p class="text-sm text-gray-800 bg-gray-50 p-3 rounded-lg">{{ $registration->harapan }}</p>
                    </div>
                </div>
            </div>

        </div>

        <!-- Kolom Kanan (Kecil) -->
        <div class="space-y-6">
            
            <!-- Pembayaran -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100 bg-gray-50">
                    <h3 class="font-bold text-gray-800"><i class="fas fa-wallet mr-2 text-teal-600"></i> Info Pembayaran</h3>
                </div>
                <div class="p-6">
                    <div class="space-y-3">
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-500">Paket:</span>
                            <span class="font-medium text-gray-900">{{ $registration->paket }}</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-500">Metode Bayar:</span>
                            <span class="font-medium text-gray-900">{{ strtoupper($registration->metode_bayar) }}</span>
                        </div>
                        <hr class="border-gray-100">
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-500">Harga Dasar:</span>
                            <span class="font-medium text-gray-900">Rp {{ number_format($registration->harga_dasar, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-500">Diskon:</span>
                            <span class="font-medium text-red-600">- Rp {{ number_format($registration->potongan_diskon, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-500">Referral:</span>
                            <span class="font-medium text-red-600">- Rp {{ number_format($registration->potongan_referal, 0, ',', '.') }}</span>
                        </div>
                        <hr class="border-gray-100">
                        <div class="flex justify-between text-lg font-bold">
                            <span class="text-gray-800">Total:</span>
                            <span class="text-teal-700">Rp {{ number_format($registration->total_bayar, 0, ',', '.') }}</span>
                        </div>
                    </div>
                    
                    <div class="mt-6">
                        <span class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-2">Bukti Pembayaran</span>
                        @if($registration->hasMedia('bukti_bayar'))
                            <a href="{{ $registration->getFirstMediaUrl('bukti_bayar') }}" target="_blank" class="block w-full text-center bg-gray-100 hover:bg-gray-200 text-gray-800 font-medium py-2 px-4 rounded-lg transition text-sm">
                                <i class="fas fa-external-link-alt mr-1"></i> Lihat Bukti Transfer
                            </a>
                            <div class="mt-2 rounded-lg overflow-hidden border border-gray-200">
                                <img src="{{ $registration->getFirstMediaUrl('bukti_bayar') }}" alt="Bukti Pembayaran" class="w-full h-auto object-cover">
                            </div>
                        @else
                            <div class="text-sm text-red-500 italic p-3 bg-red-50 rounded border border-red-100 text-center">Belum ada bukti pembayaran</div>
                        @endif
                    </div>
                </div>
            </div>
            
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="p-6 text-sm text-gray-600">
                    Mengetahui info SPN dari: <br>
                    <strong>{{ ucwords(str_replace('_', ' ', $registration->info_dari)) }}</strong>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
