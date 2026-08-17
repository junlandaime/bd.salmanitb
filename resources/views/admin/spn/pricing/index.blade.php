@extends('admin.layouts.app')

@section('title', 'Manajemen Harga & Diskon SPN')

@section('content')
<div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8" x-data="{ showPackageModal: false, showDiscountModal: false, editPackage: null, editDiscount: null }">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
        <div>
            <div class="flex items-center gap-2">
                <a href="{{ route('admin.spn.dashboard') }}" class="text-xs font-semibold text-amber-600 hover:text-amber-700 hover:underline">
                    &larr; Dashboard SPN
                </a>
            </div>
            <h1 class="text-2xl sm:text-3xl font-bold text-gray-900 mt-1">Manajemen Harga & Diskon SPN</h1>
            <p class="text-sm text-gray-500 mt-0.5">
                Batch Aktif: <span class="font-bold text-gray-800">{{ $batch ? $batch->nama_batch : 'Tidak ada batch aktif' }}</span>
            </p>
        </div>
        <div class="flex flex-wrap items-center gap-3">
            <button @click="showPackageModal = true; editPackage = null"
                class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-amber-500 hover:bg-amber-600 text-white font-semibold text-sm shadow-sm transition">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                <span>Tambah Paket</span>
            </button>
            <button @click="showDiscountModal = true; editDiscount = null"
                class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-blue-600 hover:bg-blue-700 text-white font-semibold text-sm shadow-sm transition">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                <span>Tambah Diskon</span>
            </button>
        </div>
    </div>

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

    @if($errors->any())
        <div class="bg-rose-50 border border-rose-200 text-rose-800 px-4 py-3.5 rounded-2xl mb-6 shadow-sm">
            <div class="font-bold text-sm mb-1">Terdapat beberapa kesalahan:</div>
            <ul class="list-disc list-inside text-xs space-y-0.5">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Section 1: Packages -->
    <div class="bg-white rounded-2xl border border-gray-200/80 shadow-xs overflow-hidden mb-8">
        <div class="p-5 sm:p-6 border-b border-gray-100 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
            <div>
                <div class="flex items-center gap-2">
                    <span class="w-8 h-8 rounded-lg bg-amber-50 text-amber-600 flex items-center justify-center text-sm">📦</span>
                    <h2 class="text-base font-bold text-gray-900">Daftar Paket Harga</h2>
                </div>
                <p class="text-xs text-gray-500 mt-0.5">Paket pendaftaran SPN untuk periode pendaftaran saat ini.</p>
            </div>
            <button @click="showPackageModal = true; editPackage = null"
                class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl bg-amber-50 hover:bg-amber-100 text-amber-700 font-semibold text-xs transition border border-amber-200/60">
                <span>+ Tambah Paket</span>
            </button>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-500">
                <thead class="text-xs text-gray-600 uppercase bg-gray-50/80 border-b border-gray-200/80 tracking-wider">
                    <tr>
                        <th class="px-6 py-3.5 font-semibold">Nama Paket</th>
                        <th class="px-6 py-3.5 font-semibold">Slug (Kode)</th>
                        <th class="px-6 py-3.5 font-semibold">Harga Dasar</th>
                        <th class="px-6 py-3.5 font-semibold">Periode Ketersediaan</th>
                        <th class="px-6 py-3.5 font-semibold">Status</th>
                        <th class="px-6 py-3.5 font-semibold text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($packages as $package)
                        <tr class="hover:bg-gray-50/75 transition">
                            <td class="px-6 py-4">
                                <div class="font-bold text-gray-900">{{ $package->name }}</div>
                                <div class="text-xs text-gray-400">Urutan: {{ $package->sort_order ?? 1 }}</div>
                            </td>
                            <td class="px-6 py-4 font-mono text-xs text-gray-600">
                                {{ $package->slug }}
                            </td>
                            <td class="px-6 py-4 font-bold text-gray-900 text-sm">
                                Rp {{ number_format($package->base_price, 0, ',', '.') }}
                            </td>
                            <td class="px-6 py-4 text-xs text-gray-600">
                                <div class="font-medium text-gray-800">
                                    {{ $package->available_from ? \Carbon\Carbon::parse($package->available_from)->format('d M Y') : 'Mulai Sekarang' }}
                                </div>
                                <div class="text-gray-400 mt-0.5">
                                    s/d {{ $package->available_until ? \Carbon\Carbon::parse($package->available_until)->format('d M Y') : 'Seterusnya' }}
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                @if($package->is_active)
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 text-xs font-semibold rounded-full bg-emerald-50 text-emerald-700 border border-emerald-200/60">
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                        Aktif
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 text-xs font-semibold rounded-full bg-gray-100 text-gray-600">
                                        <span class="w-1.5 h-1.5 rounded-full bg-gray-400"></span>
                                        Nonaktif
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-right whitespace-nowrap">
                                <div class="flex items-center justify-end gap-1.5">
                                    <button type="button" @click="editPackage = {{ json_encode($package) }}; showPackageModal = true"
                                        class="p-1.5 rounded-lg text-gray-500 hover:text-amber-600 hover:bg-amber-50 transition" title="Edit Paket">
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                    </button>
                                    <form action="{{ route('admin.spn.pricing.destroyPackage', $package->id) }}" method="POST" class="inline" onsubmit="return confirm('Hapus paket ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-1.5 rounded-lg text-gray-500 hover:text-rose-600 hover:bg-rose-50 transition" title="Hapus Paket">
                                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center text-gray-400 text-sm">
                                Belum ada paket untuk batch ini.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Section 2: Discounts -->
    <div class="bg-white rounded-2xl border border-gray-200/80 shadow-xs overflow-hidden">
        <div class="p-5 sm:p-6 border-b border-gray-100 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
            <div>
                <div class="flex items-center gap-2">
                    <span class="w-8 h-8 rounded-lg bg-blue-50 text-blue-600 flex items-center justify-center text-sm">🏷️</span>
                    <h2 class="text-base font-bold text-gray-900">Varian Diskon (Normal Bird)</h2>
                </div>
                <p class="text-xs text-gray-500 mt-0.5">Daftar ini akan otomatis muncul pada dropdown pilihan diskon pendaftaran Langkah 4</p>
            </div>
            <button @click="showDiscountModal = true; editDiscount = null"
                class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl bg-blue-50 hover:bg-blue-100 text-blue-700 font-semibold text-xs transition border border-blue-200/60">
                <span>+ Tambah Diskon</span>
            </button>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-500">
                <thead class="text-xs text-gray-600 uppercase bg-gray-50/80 border-b border-gray-200/80 tracking-wider">
                    <tr>
                        <th class="px-6 py-3.5 font-semibold">Label Diskon</th>
                        <th class="px-6 py-3.5 font-semibold">Kategori Kode</th>
                        <th class="px-6 py-3.5 font-semibold">Otomatis Status Diri</th>
                        <th class="px-6 py-3.5 font-semibold">Besaran Diskon</th>
                        <th class="px-6 py-3.5 font-semibold">Status</th>
                        <th class="px-6 py-3.5 font-semibold text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($discounts as $discount)
                        <tr class="hover:bg-gray-50/75 transition">
                            <td class="px-6 py-4 font-bold text-gray-900">
                                {{ $discount->label }}
                            </td>
                            <td class="px-6 py-4 font-mono text-xs text-gray-600">
                                {{ $discount->category }}
                            </td>
                            <td class="px-6 py-4 text-xs">
                                @if($discount->applies_to_status_diri)
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-md bg-blue-50 text-blue-700 font-mono border border-blue-200/50">
                                        {{ $discount->applies_to_status_diri }}
                                    </span>
                                @else
                                    <span class="text-gray-400">Pilihan Bebas (Semua)</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 font-bold text-emerald-600 text-sm">
                                {{ $discount->discount_percent }}%
                            </td>
                            <td class="px-6 py-4">
                                @if($discount->is_active)
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 text-xs font-semibold rounded-full bg-emerald-50 text-emerald-700 border border-emerald-200/60">
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                        Aktif
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 text-xs font-semibold rounded-full bg-gray-100 text-gray-600">
                                        <span class="w-1.5 h-1.5 rounded-full bg-gray-400"></span>
                                        Nonaktif
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-right whitespace-nowrap">
                                <div class="flex items-center justify-end gap-1.5">
                                    <button type="button" @click="editDiscount = {{ json_encode($discount) }}; showDiscountModal = true"
                                        class="p-1.5 rounded-lg text-gray-500 hover:text-blue-600 hover:bg-blue-50 transition" title="Edit Diskon">
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                    </button>
                                    <form action="{{ route('admin.spn.pricing.destroyDiscount', $discount->id) }}" method="POST" class="inline" onsubmit="return confirm('Hapus diskon ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-1.5 rounded-lg text-gray-500 hover:text-rose-600 hover:bg-rose-50 transition" title="Hapus Diskon">
                                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center text-gray-400 text-sm">
                                Belum ada varian diskon untuk batch ini.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Package Modal -->
    <div x-show="showPackageModal" class="fixed inset-0 z-50 overflow-y-auto" style="display: none;">
        <div class="flex items-center justify-center min-h-screen px-4 py-6 text-center">
            <div x-show="showPackageModal" x-transition.opacity class="fixed inset-0 bg-gray-900/60 backdrop-blur-xs transition-opacity" @click="showPackageModal = false"></div>
            
            <div x-show="showPackageModal" x-transition class="inline-block bg-white rounded-2xl text-left overflow-hidden shadow-xl border border-gray-100 transform transition-all max-w-lg w-full z-10">
                <form :action="editPackage ? '{{ url('admin/spn/pricing/package') }}/' + editPackage.id : '{{ route('admin.spn.pricing.storePackage') }}'" method="POST">
                    @csrf
                    <template x-if="editPackage">
                        <input type="hidden" name="_method" value="PUT">
                    </template>
                    <div class="p-6">
                        <h3 class="text-lg font-bold text-gray-900 mb-4" x-text="editPackage ? 'Edit Paket SPN' : 'Tambah Paket Baru'"></h3>
                        <div class="space-y-4">
                            <div>
                                <label class="block text-xs font-semibold text-gray-700 uppercase tracking-wider mb-1">Nama Paket</label>
                                <input type="text" name="name" :value="editPackage ? editPackage.name : ''" placeholder="Misal: Normal Bird" required
                                    class="w-full px-3.5 py-2 bg-gray-50/50 border border-gray-300 rounded-xl text-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-amber-500/20 focus:border-amber-500 transition">
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-gray-700 uppercase tracking-wider mb-1">Slug (Kode Sistem)</label>
                                <input type="text" name="slug" :value="editPackage ? editPackage.slug : ''" placeholder="Misal: normal_bird" required
                                    class="w-full px-3.5 py-2 bg-gray-50/50 border border-gray-300 rounded-xl text-sm placeholder-gray-400 font-mono focus:outline-none focus:ring-2 focus:ring-amber-500/20 focus:border-amber-500 transition">
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-gray-700 uppercase tracking-wider mb-1">Harga Dasar (Rp)</label>
                                <input type="number" name="base_price" :value="editPackage ? editPackage.base_price : ''" placeholder="849000" required
                                    class="w-full px-3.5 py-2 bg-gray-50/50 border border-gray-300 rounded-xl text-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-amber-500/20 focus:border-amber-500 transition">
                            </div>
                            <div class="grid grid-cols-2 gap-3">
                                <div>
                                    <label class="block text-xs font-semibold text-gray-700 uppercase tracking-wider mb-1">Tersedia Dari</label>
                                    <input type="date" name="available_from" :value="editPackage && editPackage.available_from ? editPackage.available_from.substring(0,10) : ''"
                                        class="w-full px-3 py-2 bg-gray-50/50 border border-gray-300 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-amber-500/20 focus:border-amber-500 transition">
                                </div>
                                <div>
                                    <label class="block text-xs font-semibold text-gray-700 uppercase tracking-wider mb-1">Sampai Dengan</label>
                                    <input type="date" name="available_until" :value="editPackage && editPackage.available_until ? editPackage.available_until.substring(0,10) : ''"
                                        class="w-full px-3 py-2 bg-gray-50/50 border border-gray-300 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-amber-500/20 focus:border-amber-500 transition">
                                </div>
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-gray-700 uppercase tracking-wider mb-1">Urutan Tampilan</label>
                                <input type="number" name="sort_order" :value="editPackage ? editPackage.sort_order : '1'"
                                    class="w-full px-3.5 py-2 bg-gray-50/50 border border-gray-300 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-amber-500/20 focus:border-amber-500 transition">
                            </div>
                            <div class="flex items-center pt-2">
                                <input type="checkbox" name="is_active" value="1" id="pkg_active" :checked="editPackage ? editPackage.is_active : true"
                                    class="w-4 h-4 rounded text-amber-600 border-gray-300 focus:ring-amber-500">
                                <label for="pkg_active" class="ml-2 block text-sm font-medium text-gray-900">Aktifkan paket ini</label>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50/80 px-6 py-4 flex flex-row-reverse gap-3 border-t border-gray-100">
                        <button type="submit" class="inline-flex justify-center px-4 py-2.5 rounded-xl bg-amber-500 hover:bg-amber-600 text-white font-semibold text-sm shadow-sm transition">
                            Simpan Paket
                        </button>
                        <button type="button" @click="showPackageModal = false" class="inline-flex justify-center px-4 py-2.5 rounded-xl border border-gray-300 bg-white hover:bg-gray-50 text-gray-700 font-semibold text-sm shadow-sm transition">
                            Batal
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Discount Modal -->
    <div x-show="showDiscountModal" class="fixed inset-0 z-50 overflow-y-auto" style="display: none;">
        <div class="flex items-center justify-center min-h-screen px-4 py-6 text-center">
            <div x-show="showDiscountModal" x-transition.opacity class="fixed inset-0 bg-gray-900/60 backdrop-blur-xs transition-opacity" @click="showDiscountModal = false"></div>
            
            <div x-show="showDiscountModal" x-transition class="inline-block bg-white rounded-2xl text-left overflow-hidden shadow-xl border border-gray-100 transform transition-all max-w-lg w-full z-10">
                <form :action="editDiscount ? '{{ url('admin/spn/pricing/discount') }}/' + editDiscount.id : '{{ route('admin.spn.pricing.storeDiscount') }}'" method="POST">
                    @csrf
                    <template x-if="editDiscount">
                        <input type="hidden" name="_method" value="PUT">
                    </template>
                    <div class="p-6">
                        <h3 class="text-lg font-bold text-gray-900 mb-4" x-text="editDiscount ? 'Edit Varian Diskon' : 'Tambah Diskon Baru'"></h3>
                        <div class="space-y-4">
                            <div>
                                <label class="block text-xs font-semibold text-gray-700 uppercase tracking-wider mb-1">Label Diskon (Tampil ke Pendaftar)</label>
                                <input type="text" name="label" :value="editDiscount ? editDiscount.label : ''" placeholder="Misal: Alumni SSC / LMD Salman" required
                                    class="w-full px-3.5 py-2 bg-gray-50/50 border border-gray-300 rounded-xl text-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition">
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-gray-700 uppercase tracking-wider mb-1">Kategori Kode Unik</label>
                                <input type="text" name="category" :value="editDiscount ? editDiscount.category : ''" placeholder="Misal: alumni_ssc" required
                                    class="w-full px-3.5 py-2 bg-gray-50/50 border border-gray-300 rounded-xl text-sm font-mono placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition">
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-gray-700 uppercase tracking-wider mb-1">Otomatis Berlaku untuk Status Diri</label>
                                <select name="applies_to_status_diri" class="w-full px-3 py-2 bg-gray-50/50 border border-gray-300 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition">
                                    <option value="" :selected="!editDiscount || !editDiscount.applies_to_status_diri">Pilihan Bebas (Semua / Manual)</option>
                                    <option value="mahasiswa" :selected="editDiscount && editDiscount.applies_to_status_diri === 'mahasiswa'">Mahasiswa ITB</option>
                                    <option value="alumni_itb" :selected="editDiscount && editDiscount.applies_to_status_diri === 'alumni_itb'">Alumni ITB</option>
                                    <option value="dosen" :selected="editDiscount && editDiscount.applies_to_status_diri === 'dosen'">Dosen / Karyawan ITB</option>
                                </select>
                                <p class="text-xs text-gray-400 mt-1">Jika diset 'Pilihan Bebas', diskon akan muncul di pilihan opsi semua peserta.</p>
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-gray-700 uppercase tracking-wider mb-1">Besaran Potongan (%)</label>
                                <input type="number" step="1" min="0" max="100" name="discount_percent" :value="editDiscount ? editDiscount.discount_percent : ''" placeholder="15" required
                                    class="w-full px-3.5 py-2 bg-gray-50/50 border border-gray-300 rounded-xl text-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition">
                            </div>
                            <div class="flex items-center pt-2">
                                <input type="checkbox" name="is_active" value="1" id="disc_active" :checked="editDiscount ? editDiscount.is_active : true"
                                    class="w-4 h-4 rounded text-blue-600 border-gray-300 focus:ring-blue-500">
                                <label for="disc_active" class="ml-2 block text-sm font-medium text-gray-900">Aktifkan diskon ini</label>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50/80 px-6 py-4 flex flex-row-reverse gap-3 border-t border-gray-100">
                        <button type="submit" class="inline-flex justify-center px-4 py-2.5 rounded-xl bg-blue-600 hover:bg-blue-700 text-white font-semibold text-sm shadow-sm transition">
                            Simpan Diskon
                        </button>
                        <button type="button" @click="showDiscountModal = false" class="inline-flex justify-center px-4 py-2.5 rounded-xl border border-gray-300 bg-white hover:bg-gray-50 text-gray-700 font-semibold text-sm shadow-sm transition">
                            Batal
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
