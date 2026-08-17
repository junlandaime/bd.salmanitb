@extends('layouts.peserta')

@section('title', 'Edit Data Pendaftaran - SPN')
@section('header', 'Edit Data Pendaftaran')

@section('content')
<div class="max-w-4xl mx-auto">
    
    <div class="mb-6 flex justify-between items-center">
        <a href="{{ route('peserta.registration.show', $registration->id) }}" class="text-teal-600 hover:text-teal-800 font-medium text-sm flex items-center">
            <i class="fas fa-arrow-left mr-2"></i> Kembali ke Detail
        </a>
    </div>

    @if(!empty($registration->pending_changes))
        <div class="mb-6 p-4 bg-yellow-50 border-l-4 border-yellow-400 rounded">
            <div class="flex items-start">
                <i class="fas fa-info-circle text-yellow-500 mt-0.5 mr-3"></i>
                <div>
                    <h4 class="text-sm font-bold text-yellow-800">Anda Memiliki Perubahan Menunggu Verifikasi</h4>
                    <p class="text-sm text-yellow-700 mt-1">
                        Jika Anda mengedit field yang dilindungi (ada icon <i class="fas fa-lock mx-1 text-xs"></i>) lagi, perubahan sebelumnya akan tertimpa.
                    </p>
                </div>
            </div>
        </div>
    @endif

    <form action="{{ route('peserta.registration.update', $registration->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')

        <!-- Data Diri -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-100 bg-gray-50">
                <h3 class="font-bold text-gray-800"><i class="fas fa-user mr-2 text-teal-600"></i> Data Diri Dasar</h3>
            </div>
            <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="col-span-1 md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                    <input type="text" name="nama_lengkap" value="{{ old('nama_lengkap', $registration->nama_lengkap) }}" class="w-full border-gray-300 rounded-md shadow-sm focus:border-teal-500 focus:ring-teal-500">
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama Panggilan</label>
                    <input type="text" name="nama_panggilan" value="{{ old('nama_panggilan', $registration->nama_panggilan) }}" class="w-full border-gray-300 rounded-md shadow-sm focus:border-teal-500 focus:ring-teal-500">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Gelar (Optional)</label>
                    <input type="text" name="nama_gelar" value="{{ old('nama_gelar', $registration->nama_gelar) }}" class="w-full border-gray-300 rounded-md shadow-sm focus:border-teal-500 focus:ring-teal-500">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Jenis Kelamin</label>
                    <select name="jenis_kelamin" class="w-full border-gray-300 rounded-md shadow-sm focus:border-teal-500 focus:ring-teal-500">
                        <option value="pria" {{ old('jenis_kelamin', $registration->jenis_kelamin) == 'pria' ? 'selected' : '' }}>Pria</option>
                        <option value="wanita" {{ old('jenis_kelamin', $registration->jenis_kelamin) == 'wanita' ? 'selected' : '' }}>Wanita</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Status Pernikahan</label>
                    <select name="status_pernikahan" class="w-full border-gray-300 rounded-md shadow-sm focus:border-teal-500 focus:ring-teal-500">
                        <option value="belum" {{ old('status_pernikahan', $registration->status_pernikahan) == 'belum' ? 'selected' : '' }}>Belum Menikah</option>
                        <option value="menikah" {{ old('status_pernikahan', $registration->status_pernikahan) == 'menikah' ? 'selected' : '' }}>Menikah</option>
                        <option value="pernah" {{ old('status_pernikahan', $registration->status_pernikahan) == 'pernah' ? 'selected' : '' }}>Pernah Menikah</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Lahir</label>
                    <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir', $registration->tanggal_lahir?->format('Y-m-d')) }}" class="w-full border-gray-300 rounded-md shadow-sm focus:border-teal-500 focus:ring-teal-500">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Asal Daerah</label>
                    <input type="text" name="asal_daerah" value="{{ old('asal_daerah', $registration->asal_daerah) }}" class="w-full border-gray-300 rounded-md shadow-sm focus:border-teal-500 focus:ring-teal-500">
                </div>

                <div class="col-span-1 md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Alamat Domisili</label>
                    <textarea name="domisili" rows="3" class="w-full border-gray-300 rounded-md shadow-sm focus:border-teal-500 focus:ring-teal-500">{{ old('domisili', $registration->domisili) }}</textarea>
                </div>
            </div>
        </div>

        <!-- Kontak -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-100 bg-gray-50">
                <h3 class="font-bold text-gray-800"><i class="fas fa-address-book mr-2 text-teal-600"></i> Kontak</h3>
            </div>
            <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">WhatsApp</label>
                    <input type="text" name="whatsapp" value="{{ old('whatsapp', $registration->whatsapp) }}" class="w-full border-gray-300 rounded-md shadow-sm focus:border-teal-500 focus:ring-teal-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Instagram</label>
                    <input type="text" name="instagram" value="{{ old('instagram', $registration->instagram) }}" class="w-full border-gray-300 rounded-md shadow-sm focus:border-teal-500 focus:ring-teal-500">
                </div>
            </div>
        </div>

        <!-- Pendidikan & Pekerjaan -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-100 bg-gray-50">
                <h3 class="font-bold text-gray-800"><i class="fas fa-graduation-cap mr-2 text-teal-600"></i> Pendidikan & Pekerjaan</h3>
            </div>
            <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Pendidikan Terakhir</label>
                    <select name="pendidikan" class="w-full border-gray-300 rounded-md shadow-sm focus:border-teal-500 focus:ring-teal-500">
                        <option value="sma" {{ old('pendidikan', $registration->pendidikan) == 'sma' ? 'selected' : '' }}>SMA/SMK Sederajat</option>
                        <option value="d3" {{ old('pendidikan', $registration->pendidikan) == 'd3' ? 'selected' : '' }}>D3</option>
                        <option value="s1" {{ old('pendidikan', $registration->pendidikan) == 's1' ? 'selected' : '' }}>S1/D4</option>
                        <option value="s2" {{ old('pendidikan', $registration->pendidikan) == 's2' ? 'selected' : '' }}>S2</option>
                        <option value="s3" {{ old('pendidikan', $registration->pendidikan) == 's3' ? 'selected' : '' }}>S3</option>
                    </select>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Status Diri</label>
                    <select name="status_diri" class="w-full border-gray-300 rounded-md shadow-sm focus:border-teal-500 focus:ring-teal-500">
                        <option value="mahasiswa" {{ old('status_diri', $registration->status_diri) == 'mahasiswa' ? 'selected' : '' }}>Mahasiswa</option>
                        <option value="karyawan" {{ old('status_diri', $registration->status_diri) == 'karyawan' ? 'selected' : '' }}>Karyawan/Pegawai</option>
                        <option value="dosen" {{ old('status_diri', $registration->status_diri) == 'dosen' ? 'selected' : '' }}>Dosen/Guru</option>
                        <option value="alumni_itb" {{ old('status_diri', $registration->status_diri) == 'alumni_itb' ? 'selected' : '' }}>Alumni ITB</option>
                        <option value="umum" {{ old('status_diri', $registration->status_diri) == 'umum' ? 'selected' : '' }}>Umum/Lainnya</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Pekerjaan</label>
                    <input type="text" name="pekerjaan" value="{{ old('pekerjaan', $registration->pekerjaan) }}" class="w-full border-gray-300 rounded-md shadow-sm focus:border-teal-500 focus:ring-teal-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Instansi/Perusahaan</label>
                    <input type="text" name="instansi" value="{{ old('instansi', $registration->instansi) }}" class="w-full border-gray-300 rounded-md shadow-sm focus:border-teal-500 focus:ring-teal-500">
                </div>
            </div>
        </div>

        <!-- Data Admin / Protected Fields -->
        <div class="bg-yellow-50 rounded-xl shadow-sm border border-yellow-200 overflow-hidden">
            <div class="px-6 py-4 border-b border-yellow-200 bg-yellow-100 flex items-center justify-between">
                <h3 class="font-bold text-yellow-800"><i class="fas fa-lock mr-2"></i> Data Pembayaran & Paket</h3>
                <span class="text-xs bg-yellow-200 text-yellow-800 px-2 py-1 rounded">Butuh Persetujuan Admin</span>
            </div>
            <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Paket SPN
                        <i class="fas fa-lock text-gray-400 ml-1 text-xs" title="Perubahan memerlukan persetujuan admin"></i>
                    </label>
                    @php $currentPaket = $registration->pending_changes['paket'] ?? $registration->paket; @endphp
                    <select name="paket" class="w-full border-gray-300 rounded-md shadow-sm focus:border-yellow-500 focus:ring-yellow-500">
                        <option value="reguler" {{ old('paket', $currentPaket) == 'reguler' ? 'selected' : '' }}>Reguler</option>
                        <option value="premium" {{ old('paket', $currentPaket) == 'premium' ? 'selected' : '' }}>Premium</option>
                        <option value="alumni" {{ old('paket', $currentPaket) == 'alumni' ? 'selected' : '' }}>Alumni Salman</option>
                    </select>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Metode Bayar
                        <i class="fas fa-lock text-gray-400 ml-1 text-xs" title="Perubahan memerlukan persetujuan admin"></i>
                    </label>
                    @php $currentMetode = $registration->pending_changes['metode_bayar'] ?? $registration->metode_bayar; @endphp
                    <select name="metode_bayar" class="w-full border-gray-300 rounded-md shadow-sm focus:border-yellow-500 focus:ring-yellow-500">
                        <option value="qris" {{ old('metode_bayar', $currentMetode) == 'qris' ? 'selected' : '' }}>QRIS</option>
                        <option value="transfer" {{ old('metode_bayar', $currentMetode) == 'transfer' ? 'selected' : '' }}>Transfer Bank</option>
                    </select>
                </div>

                <div class="col-span-1 md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Upload Bukti Bayar Baru (Opsional)</label>
                    <input type="file" name="bukti_bayar" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-teal-50 file:text-teal-700 hover:file:bg-teal-100">
                    <p class="text-xs text-gray-500 mt-1">Kosongkan jika tidak ingin mengubah bukti bayar. Format: JPG, PNG. Maks: 2MB.</p>
                </div>

            </div>
        </div>

        <div class="flex justify-end gap-4 pb-10">
            <a href="{{ route('peserta.registration.show', $registration->id) }}" class="px-6 py-2 border border-gray-300 text-gray-700 rounded-lg font-medium hover:bg-gray-50 transition">
                Batal
            </a>
            <button type="submit" class="px-6 py-2 bg-teal-600 text-white rounded-lg font-medium hover:bg-teal-700 transition shadow-sm">
                Simpan Perubahan
            </button>
        </div>
    </form>
</div>
@endsection
