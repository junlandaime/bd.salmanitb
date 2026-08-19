@extends('admin.layouts.app')

@section('title', 'Detail Pendaftar SPN - ' . $registration->nama_lengkap)

@section('content')
<div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8" x-data="{ showRejectModal: false }">
    <!-- Top Action Bar -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
        <div>
            <a href="{{ route('admin.spn.registrants') }}"
                class="inline-flex items-center gap-1.5 text-xs font-semibold text-gray-500 hover:text-gray-900 transition mb-2">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Kembali ke Daftar Pendaftar
            </a>
            <div class="flex items-center gap-3">
                <h1 class="text-2xl sm:text-3xl font-bold text-gray-900">{{ $registration->nama_lengkap }}</h1>
                @if($registration->status === 'terverifikasi')
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 text-xs font-bold rounded-full bg-emerald-50 text-emerald-700 border border-emerald-200/60">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                        Terverifikasi
                    </span>
                @elseif($registration->status === 'ditolak')
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 text-xs font-bold rounded-full bg-rose-50 text-rose-700 border border-rose-200/60">
                        <span class="w-1.5 h-1.5 rounded-full bg-rose-500"></span>
                        Ditolak
                    </span>
                @else
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 text-xs font-bold rounded-full bg-amber-50 text-amber-700 border border-amber-200/60">
                        <span class="w-1.5 h-1.5 rounded-full bg-amber-500 animate-pulse"></span>
                        Pending Verifikasi
                    </span>
                @endif
            </div>
            <p class="text-xs text-gray-500 font-mono mt-1">Kode: <span class="font-bold text-gray-700">{{ $registration->registration_code }}</span> &middot; Terdaftar {{ $registration->created_at->format('d M Y, H:i') }}</p>
        </div>

        <!-- Action Buttons -->
        <div class="flex items-center gap-3">
            @if($registration->status === 'pending')
                <form action="{{ route('admin.spn.verify', $registration->id) }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" onclick="return confirm('Yakin ingin verifikasi pendaftar ini?')"
                        class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-semibold text-sm shadow-sm transition">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        <span>Verifikasi Pembayaran</span>
                    </button>
                </form>
                <button type="button" @click="showRejectModal = true"
                    class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-rose-500 hover:bg-rose-600 text-white font-semibold text-sm shadow-sm transition">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                    <span>Tolak / Minta Revisi</span>
                </button>
            @elseif($registration->status === 'ditolak')
                <form action="{{ route('admin.spn.verify', $registration->id) }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" onclick="return confirm('Verifikasi pendaftar ini?')"
                        class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-semibold text-sm shadow-sm transition">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        <span>Verifikasi Pembayaran</span>
                    </button>
                </form>
                <button type="button" @click="showRejectModal = true"
                    class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-rose-500 hover:bg-rose-600 text-white font-semibold text-sm shadow-sm transition">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                    <span>Tolak / Ubah Catatan</span>
                </button>
            @else
                <div class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-emerald-50 text-emerald-800 text-xs font-semibold border border-emerald-200">
                    <svg class="w-4 h-4 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span>Terverifikasi — Akan jadi alumni setelah kegiatan berakhir</span>
                </div>
            @endif

            <form action="{{ route('admin.spn.destroy', $registration->id) }}" method="POST" class="inline"
                onsubmit="return confirm('PERINGATAN: Apakah Anda yakin ingin menghapus data pendaftaran #{{ $registration->registration_code }} ({{ $registration->nama_lengkap }}) secara permanen? Tindakan ini tidak dapat dibatalkan.');">
                @csrf
                @method('DELETE')
                <button type="submit"
                    class="inline-flex items-center gap-1.5 px-3.5 py-2.5 rounded-xl bg-red-50 hover:bg-red-100 text-red-700 font-semibold text-sm border border-red-200 transition" title="Hapus Data Pendaftaran">
                    <svg class="w-4 h-4 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                    </svg>
                    <span>Hapus</span>
                </button>
            </form>
        </div>
    </div>

    @if(!empty($registration->pending_changes))
        <div class="bg-amber-50 border border-amber-300 text-amber-900 p-5 rounded-2xl mb-6 shadow-sm">
            <div class="flex items-center gap-2 mb-3">
                <span class="text-xl">⚠️</span>
                <h3 class="text-sm font-bold uppercase tracking-wider">Permintaan Perubahan Data Dilindungi</h3>
            </div>
            <p class="text-xs text-amber-800 mb-4">Pendaftar mengajukan perubahan data yang memerlukan persetujuan admin. Silakan periksa nilai baru di bawah ini:</p>
            <div class="bg-white rounded-xl border border-amber-200 overflow-hidden">
                <table class="w-full text-xs sm:text-sm">
                    <thead class="bg-amber-100/60 text-amber-900 border-b border-amber-200">
                        <tr>
                            <th class="py-2.5 px-4 text-left font-bold">Field</th>
                            <th class="py-2.5 px-4 text-left font-bold">Nilai Saat Ini</th>
                            <th class="py-2.5 px-4 text-left font-bold">Permintaan Perubahan</th>
                            <th class="py-2.5 px-4 text-right font-bold">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach($registration->pending_changes as $field => $newValue)
                            <tr>
                                <td class="py-2.5 px-4 font-semibold text-gray-800">{{ ucwords(str_replace('_', ' ', $field)) }}</td>
                                <td class="py-2.5 px-4 text-gray-500">{{ $registration->$field ?? '-' }}</td>
                                <td class="py-2.5 px-4 font-bold text-teal-700">{{ $newValue }}</td>
                                <td class="py-2.5 px-4 text-right">
                                    <div class="inline-flex gap-2">
                                        <form action="{{ route('admin.spn.approveChange', $registration->id) }}" method="POST" class="inline">
                                            @csrf
                                            <input type="hidden" name="field" value="{{ $field }}">
                                            <button type="submit" class="px-2.5 py-1 bg-emerald-600 hover:bg-emerald-700 text-white rounded-lg text-xs font-semibold transition">
                                                Setujui
                                            </button>
                                        </form>
                                        <form action="{{ route('admin.spn.rejectChange', $registration->id) }}" method="POST" class="inline">
                                            @csrf
                                            <input type="hidden" name="field" value="{{ $field }}">
                                            <button type="submit" class="px-2.5 py-1 bg-rose-600 hover:bg-rose-700 text-white rounded-lg text-xs font-semibold transition">
                                                Tolak
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif

    @if(session('success'))
        <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 px-4 py-3.5 rounded-2xl mb-6 flex items-center justify-between shadow-sm" role="alert">
            <div class="flex items-center gap-3">
                <span class="w-6 h-6 rounded-full bg-emerald-100 text-emerald-600 flex items-center justify-center shrink-0">✓</span>
                <span class="text-sm font-medium">{{ session('success') }}</span>
            </div>
            <button type="button" onclick="this.parentElement.remove()" class="text-emerald-500 hover:text-emerald-700 p-1">✕</button>
        </div>
    @endif
    @if(session('error'))
        <div class="bg-rose-50 border border-rose-200 text-rose-800 px-4 py-3.5 rounded-2xl mb-6 flex items-center justify-between shadow-sm" role="alert">
            <div class="flex items-center gap-3">
                <span class="w-6 h-6 rounded-full bg-rose-100 text-rose-600 flex items-center justify-center shrink-0">✕</span>
                <span class="text-sm font-medium">{{ session('error') }}</span>
            </div>
            <button type="button" onclick="this.parentElement.remove()" class="text-rose-500 hover:text-rose-700 p-1">✕</button>
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Left 2 Cols: Personal & Academic & Motivation -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Data Diri Card -->
            <div class="bg-white rounded-2xl border border-gray-200/80 shadow-xs p-6">
                <div class="flex items-center gap-2 pb-4 border-b border-gray-100 mb-5">
                    <span class="w-8 h-8 rounded-lg bg-amber-50 text-amber-600 flex items-center justify-center text-sm">👤</span>
                    <h3 class="text-base font-bold text-gray-900">Informasi Pribadi & Kontak</h3>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm">
                    <div>
                        <span class="text-xs font-semibold text-gray-400 uppercase tracking-wider block">Nama Lengkap & Gelar</span>
                        <p class="font-bold text-gray-900 mt-1">{{ $registration->nama_lengkap }} {{ $registration->nama_gelar ? '(' . $registration->nama_gelar . ')' : '' }}</p>
                    </div>
                    <div>
                        <span class="text-xs font-semibold text-gray-400 uppercase tracking-wider block">Nama Panggilan</span>
                        <p class="font-medium text-gray-800 mt-1">{{ $registration->nama_panggilan ?? '-' }}</p>
                    </div>
                    <div>
                        <span class="text-xs font-semibold text-gray-400 uppercase tracking-wider block">Jenis Kelamin</span>
                        <p class="font-medium text-gray-800 mt-1 capitalize">{{ $registration->jenis_kelamin }}</p>
                    </div>
                    <div>
                        <span class="text-xs font-semibold text-gray-400 uppercase tracking-wider block">Tanggal Lahir & Usia</span>
                        <p class="font-medium text-gray-800 mt-1">
                            {{ $registration->tanggal_lahir?->format('d M Y') ?? '-' }} 
                            @if($registration->usia) <span class="text-xs text-gray-500">({{ $registration->usia }} tahun)</span> @endif
                        </p>
                    </div>
                    <div>
                        <span class="text-xs font-semibold text-gray-400 uppercase tracking-wider block">Email</span>
                        <p class="font-medium text-gray-900 mt-1">{{ $registration->email }}</p>
                    </div>
                    <div>
                        <span class="text-xs font-semibold text-gray-400 uppercase tracking-wider block">WhatsApp</span>
                        <p class="font-mono font-medium text-gray-900 mt-1">{{ $registration->whatsapp }}</p>
                    </div>
                    <div>
                        <span class="text-xs font-semibold text-gray-400 uppercase tracking-wider block">Instagram</span>
                        <p class="font-medium text-gray-800 mt-1">{{ $registration->instagram ? '@' . ltrim($registration->instagram, '@') : '-' }}</p>
                    </div>
                    <div>
                        <span class="text-xs font-semibold text-gray-400 uppercase tracking-wider block">Status Pernikahan</span>
                        <p class="font-medium text-gray-800 mt-1 capitalize">{{ $registration->status_pernikahan ?? '-' }}</p>
                    </div>
                    <div>
                        <span class="text-xs font-semibold text-gray-400 uppercase tracking-wider block">Asal Daerah</span>
                        <p class="font-medium text-gray-800 mt-1">{{ $registration->asal_daerah ?? '-' }}</p>
                    </div>
                    <div>
                        <span class="text-xs font-semibold text-gray-400 uppercase tracking-wider block">Domisili Saat Ini</span>
                        <p class="font-medium text-gray-800 mt-1">{{ $registration->domisili ?? '-' }}</p>
                    </div>
                    <div class="sm:col-span-2">
                        <span class="text-xs font-semibold text-gray-400 uppercase tracking-wider block">Kesiapan Restu Orang Tua</span>
                        <p class="font-medium text-gray-800 mt-1">
                            @if($registration->restu === 'sudah')
                                <span class="inline-flex items-center gap-1 text-emerald-600 font-semibold">✓ Sudah ada restu</span>
                            @else
                                <span class="inline-flex items-center gap-1 text-amber-600 font-semibold">⏳ Akan meminta restu</span>
                            @endif
                        </p>
                    </div>
                </div>
            </div>

            <!-- Pendidikan & Pekerjaan Card -->
            <div class="bg-white rounded-2xl border border-gray-200/80 shadow-xs p-6">
                <div class="flex items-center gap-2 pb-4 border-b border-gray-100 mb-5">
                    <span class="w-8 h-8 rounded-lg bg-indigo-50 text-indigo-600 flex items-center justify-center text-sm">🎓</span>
                    <h3 class="text-base font-bold text-gray-900">Pendidikan & Pekerjaan</h3>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm">
                    <div>
                        <span class="text-xs font-semibold text-gray-400 uppercase tracking-wider block">Pendidikan Terakhir</span>
                        <p class="font-bold text-gray-900 mt-1 uppercase">{{ $registration->pendidikan ?? '-' }}</p>
                    </div>
                    <div>
                        <span class="text-xs font-semibold text-gray-400 uppercase tracking-wider block">Status Diri</span>
                        <p class="font-medium text-gray-800 mt-1 capitalize">{{ str_replace('_', ' ', $registration->status_diri ?? '-') }}</p>
                    </div>
                    <div>
                        <span class="text-xs font-semibold text-gray-400 uppercase tracking-wider block">Pekerjaan / Jabatan</span>
                        <p class="font-medium text-gray-800 mt-1">
                            {{ $registration->pekerjaan ?? '-' }} {{ $registration->jabatan ? '— ' . $registration->jabatan : '' }}
                        </p>
                    </div>
                    <div>
                        <span class="text-xs font-semibold text-gray-400 uppercase tracking-wider block">Instansi / Lokasi Kerja</span>
                        <p class="font-medium text-gray-800 mt-1">
                            {{ $registration->instansi ?? '-' }} {{ $registration->lokasi_kerja ? '(' . $registration->lokasi_kerja . ')' : '' }}
                        </p>
                    </div>
                    @if($registration->universitas)
                    <div class="sm:col-span-2 bg-gray-50/70 p-3.5 rounded-xl border border-gray-100">
                        <span class="text-xs font-semibold text-gray-500 uppercase tracking-wider block">Perguruan Tinggi</span>
                        <p class="font-medium text-gray-900 mt-0.5">
                            {{ $registration->universitas }} &middot; {{ $registration->jurusan }} (Angkatan {{ $registration->angkatan }})
                        </p>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Motivasi & Harapan Card -->
            <div class="bg-white rounded-2xl border border-gray-200/80 shadow-xs p-6">
                <div class="flex items-center gap-2 pb-4 border-b border-gray-100 mb-5">
                    <span class="w-8 h-8 rounded-lg bg-pink-50 text-pink-600 flex items-center justify-center text-sm">💡</span>
                    <h3 class="text-base font-bold text-gray-900">Motivasi & Harapan</h3>
                </div>

                <div class="space-y-4 text-sm">
                    <div>
                        <span class="text-xs font-semibold text-gray-400 uppercase tracking-wider block">Gambaran Awal Pernikahan</span>
                        <p class="text-gray-700 whitespace-pre-line mt-1 bg-gray-50/50 p-3 rounded-xl border border-gray-100 leading-relaxed">{{ $registration->gambaran_awal ?? 'Tidak diisi' }}</p>
                    </div>
                    <div>
                        <span class="text-xs font-semibold text-gray-400 uppercase tracking-wider block">Alasan Mengikuti SPN</span>
                        <p class="text-gray-700 whitespace-pre-line mt-1 bg-gray-50/50 p-3 rounded-xl border border-gray-100 leading-relaxed">{{ $registration->alasan ?? 'Tidak diisi' }}</p>
                    </div>
                    <div>
                        <span class="text-xs font-semibold text-gray-400 uppercase tracking-wider block">Harapan Setelah Mengikuti</span>
                        <p class="text-gray-700 whitespace-pre-line mt-1 bg-gray-50/50 p-3 rounded-xl border border-gray-100 leading-relaxed">{{ $registration->harapan ?? 'Tidak diisi' }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right 1 Col: Pembayaran & Bukti -->
        <div class="space-y-6">
            <!-- Payment Summary Card -->
            <div class="bg-white rounded-2xl border border-gray-200/80 shadow-xs p-6">
                <div class="flex items-center gap-2 pb-4 border-b border-gray-100 mb-5">
                    <span class="w-8 h-8 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center text-sm">💳</span>
                    <h3 class="text-base font-bold text-gray-900">Rincian Pembayaran</h3>
                </div>

                <div class="space-y-3.5 text-sm">
                    <div class="flex justify-between items-center pb-2 border-b border-gray-100">
                        <span class="text-gray-500">Pilihan Paket</span>
                        <span class="font-bold text-gray-900 capitalize">{{ str_replace('_', ' ', $registration->paket) }}</span>
                    </div>

                    <div class="flex justify-between items-center text-xs">
                        <span class="text-gray-500">Status / Kategori</span>
                        <span class="font-semibold text-gray-800 bg-gray-100 px-2.5 py-1 rounded-lg">
                            {{ $registration->discount_category_label }}
                        </span>
                    </div>

                    <div class="flex justify-between items-center">
                        <span class="text-gray-500">Harga Dasar Paket</span>
                        <span class="font-semibold text-gray-700">Rp {{ number_format($registration->harga_dasar, 0, ',', '.') }}</span>
                    </div>

                    @if($registration->potongan_diskon > 0)
                    <div class="p-3 rounded-xl bg-emerald-50/80 border border-emerald-200/80 text-emerald-800 space-y-1.5">
                        <div class="flex justify-between items-start">
                            <div>
                                <div class="flex items-center gap-1.5 text-xs font-bold">
                                    <span>Potongan Diskon Kategori</span>
                                    <span class="px-1.5 py-0.5 rounded-md bg-emerald-200 text-emerald-900 text-[10px] font-extrabold">
                                        {{ $registration->discount_percentage }}%
                                    </span>
                                </div>
                                <span class="text-xs text-emerald-900 font-bold block mt-0.5">
                                    Label Diskon: {{ $registration->discount_category_label }}
                                </span>
                            </div>
                            <span class="font-bold text-sm text-emerald-700 shrink-0">- Rp {{ number_format($registration->potongan_diskon, 0, ',', '.') }}</span>
                        </div>
                    </div>
                    @endif

                    @if($registration->potongan_referal > 0)
                    <div class="p-2.5 rounded-xl bg-teal-50/80 border border-teal-200/80 text-teal-800 space-y-1">
                        <div class="flex justify-between items-center">
                            <span class="text-xs font-bold flex items-center gap-1.5">
                                <span>Potongan Referral</span>
                                @if($registration->referralCode)
                                    <span class="px-1.5 py-0.5 rounded-md bg-teal-200/80 text-teal-900 text-[10px] font-mono font-extrabold">
                                        {{ $registration->referralCode->code }}
                                    </span>
                                @endif
                            </span>
                            <span class="font-bold text-sm text-teal-700">- Rp {{ number_format($registration->potongan_referal, 0, ',', '.') }}</span>
                        </div>
                    </div>
                    @endif

                    <div class="border-t-2 border-dashed border-gray-200 pt-3.5 mt-2 flex justify-between items-baseline">
                        <div>
                            <span class="font-bold text-gray-900 block text-xs">Total Pembayaran / Infak</span>
                            <span class="text-[10px] text-gray-400">Termasuk seluruh potongan</span>
                        </div>
                        <span class="text-xl font-extrabold text-teal-800">
                            Rp {{ number_format($registration->total_bayar, 0, ',', '.') }}
                        </span>
                    </div>

                    <div class="pt-2 border-t border-gray-100 space-y-1.5 text-xs text-gray-500">
                        <div class="flex justify-between items-center">
                            <span>Metode Pembayaran</span>
                            <span class="font-bold text-gray-800 uppercase px-2 py-0.5 bg-gray-50 rounded-md border border-gray-200">
                                {{ $registration->metode_bayar ?? 'Transfer' }}
                            </span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span>Mengetahui Info Dari</span>
                            <span class="font-medium text-gray-700 capitalize">
                                {{ str_replace('_', ' ', $registration->info_dari ?? '-') }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Bukti Bayar Card -->
            <div class="bg-white rounded-2xl border border-gray-200/80 shadow-xs p-6">
                <div class="flex items-center gap-2 pb-4 border-b border-gray-100 mb-4">
                    <span class="w-8 h-8 rounded-lg bg-blue-50 text-blue-600 flex items-center justify-center text-sm">📎</span>
                    <h3 class="text-base font-bold text-gray-900">Bukti Pembayaran</h3>
                </div>

                @if($registration->hasMedia('bukti_bayar'))
                    @php $media = $registration->getFirstMedia('bukti_bayar'); @endphp
                    @if(in_array($media->mime_type, ['image/jpeg', 'image/png', 'image/jpg', 'image/webp']))
                        <div class="rounded-xl overflow-hidden border border-gray-200 bg-gray-50">
                            <a href="{{ $registration->getFirstMediaUrl('bukti_bayar') }}" target="_blank" class="block group relative">
                                <img src="{{ $registration->getFirstMediaUrl('bukti_bayar') }}" alt="Bukti Pembayaran" class="w-full h-auto object-cover max-h-80 group-hover:opacity-95 transition">
                                <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 flex items-center justify-center text-white text-xs font-semibold transition">
                                    🔍 Klik untuk Memperbesar
                                </div>
                            </a>
                        </div>
                    @else
                        <a href="{{ $registration->getFirstMediaUrl('bukti_bayar') }}" target="_blank"
                            class="flex items-center gap-3 p-4 rounded-xl border border-gray-200 bg-gray-50/70 hover:bg-gray-100 transition text-blue-600 text-sm font-semibold">
                            <svg class="w-6 h-6 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                            <span>Unduh Dokumen Bukti ({{ strtoupper(pathinfo($media->file_name, PATHINFO_EXTENSION)) }})</span>
                        </a>
                    @endif
                @else
                    <div class="bg-gray-50/80 rounded-xl p-8 text-center border border-dashed border-gray-200">
                        <span class="text-2xl block mb-2">🧾</span>
                        <p class="text-xs text-gray-500 font-medium">Tidak ada berkas bukti pembayaran yang dilampirkan.</p>
                    </div>
                @endif
            </div>

            <!-- Catatan Admin Card -->
            @if($registration->catatan_admin)
                <div class="bg-amber-50/80 rounded-2xl border border-amber-200/80 p-5">
                    <div class="flex items-center gap-2 mb-2">
                        <span class="text-amber-700 text-sm">⚠️</span>
                        <h4 class="text-xs font-bold text-amber-900 uppercase tracking-wider">Catatan Verifikasi Admin</h4>
                    </div>
                    <p class="text-xs text-amber-800 leading-relaxed">{{ $registration->catatan_admin }}</p>
                </div>
            @endif

            @if($registration->verified_at)
                <div class="bg-gray-50/80 rounded-2xl border border-gray-200/80 p-4 text-xs text-gray-500">
                    <div class="flex items-center gap-2">
                        <span>ℹ️</span>
                        <span>Diverifikasi pada <span class="font-medium text-gray-800">{{ $registration->verified_at->format('d M Y, H:i') }}</span> @if($registration->verifiedByUser) oleh <span class="font-medium text-gray-800">{{ $registration->verifiedByUser->name }}</span> @endif</span>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <!-- Reject Modal -->
    <div x-show="showRejectModal" class="fixed inset-0 z-50 overflow-y-auto" style="display: none;">
        <div class="flex items-center justify-center min-h-screen px-4 py-6 text-center">
            <div x-show="showRejectModal" x-transition.opacity class="fixed inset-0 bg-gray-900/60 backdrop-blur-xs transition-opacity" @click="showRejectModal = false"></div>
            
            <div x-show="showRejectModal" x-transition class="inline-block bg-white rounded-2xl text-left overflow-hidden shadow-xl border border-gray-100 transform transition-all max-w-lg w-full z-10">
                <form action="{{ route('admin.spn.reject', $registration->id) }}" method="POST">
                    @csrf
                    <div class="p-6">
                        <div class="flex items-center gap-3 mb-4">
                            <div class="w-10 h-10 rounded-xl bg-rose-50 text-rose-600 flex items-center justify-center text-lg shrink-0">
                                ⚠️
                            </div>
                            <div>
                                <h3 class="text-lg font-bold text-gray-900">Tolak Pendaftaran</h3>
                                <p class="text-xs text-gray-500">Pendaftar akan menerima notifikasi status penolakan.</p>
                            </div>
                        </div>

                        <div>
                            <label for="catatan_admin" class="block text-xs font-semibold text-gray-700 uppercase tracking-wider mb-1.5">
                                Alasan Penolakan / Catatan Admin <span class="text-rose-500">*</span>
                            </label>
                            <textarea name="catatan_admin" id="catatan_admin" rows="4" required
                                class="w-full px-3.5 py-2.5 bg-gray-50/50 border border-gray-300 rounded-xl text-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-rose-500/20 focus:border-rose-500 transition"
                                placeholder="Contoh: Bukti transfer buram/tidak terbaca, mohon upload ulang"></textarea>
                        </div>
                    </div>

                    <div class="bg-gray-50/80 px-6 py-4 flex flex-row-reverse gap-3 border-t border-gray-100">
                        <button type="submit" class="inline-flex justify-center px-4 py-2.5 rounded-xl bg-rose-600 hover:bg-rose-700 text-white font-semibold text-sm shadow-sm transition">
                            Tolak Pendaftar
                        </button>
                        <button type="button" @click="showRejectModal = false" class="inline-flex justify-center px-4 py-2.5 rounded-xl border border-gray-300 bg-white hover:bg-gray-50 text-gray-700 font-semibold text-sm shadow-sm transition">
                            Batal
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
