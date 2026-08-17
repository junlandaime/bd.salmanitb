@extends('admin.layouts.app')
@section('title', 'Import Data Alumni - Admin Panel')

@section('content')
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
        
        <!-- Breadcrumb & Header -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
            <div>
                <div class="flex items-center gap-2 text-xs text-gray-500 mb-2">
                    <a href="{{ route('admin.batch-alumni.index') }}" class="hover:text-emerald-600 transition">Database Alumni</a>
                    <span>/</span>
                    <span class="text-gray-700 font-medium">Import Excel</span>
                </div>
                <h1 class="text-2xl font-bold text-gray-900">Import Data Alumni Kegiatan</h1>
                <p class="text-sm text-gray-500 mt-1">
                    Unggah data alumni batch kegiatan secara massal melalui file spreadsheet (CSV / Excel).
                </p>
            </div>

            <div class="flex items-center gap-3">
                <a href="{{ route('admin.batch-alumni.index') }}"
                    class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl border border-gray-300 bg-white text-gray-700 font-semibold text-sm hover:bg-gray-50 shadow-sm transition">
                    <svg class="w-4 h-4 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Kembali ke Alumni
                </a>
            </div>
        </div>

        @if (session('success'))
            <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 px-5 py-4 rounded-2xl mb-6 flex items-center justify-between shadow-sm" role="alert">
                <div class="flex items-center gap-2">
                    <svg class="w-5 h-5 text-emerald-600 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    <span class="text-sm font-medium">{{ session('success') }}</span>
                </div>
                <button type="button" onclick="this.parentElement.remove()" class="text-emerald-500 hover:text-emerald-700">✕</button>
            </div>
        @endif

        @if (session('error'))
            <div class="bg-red-50 border border-red-200 text-red-800 px-5 py-4 rounded-2xl mb-6 flex items-center justify-between shadow-sm" role="alert">
                <div class="flex items-center gap-2">
                    <svg class="w-5 h-5 text-red-600 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                    <span class="text-sm font-medium">{{ session('error') }}</span>
                </div>
                <button type="button" onclick="this.parentElement.remove()" class="text-red-500 hover:text-red-700">✕</button>
            </div>
        @endif

        @if (session('import_stats') && !empty(session('import_stats')['errors']))
            <div class="bg-amber-50 border border-amber-200 text-amber-900 px-5 py-4 rounded-2xl mb-6 shadow-sm" role="alert">
                <div class="flex items-center gap-2 font-bold text-sm text-amber-800 mb-2">
                    <svg class="w-5 h-5 text-amber-600 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                    Beberapa Baris Gagal Di-import:
                </div>
                <ul class="list-disc list-inside text-xs space-y-1 text-amber-800/90 pl-1">
                    @foreach (session('import_stats')['errors'] as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Form & Instruction Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <!-- Left: Form Area (2 cols) -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-2xl border border-gray-200/80 shadow-sm p-6 sm:p-8">
                    <div class="flex items-center gap-3 pb-5 border-b border-gray-100 mb-6">
                        <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center font-bold">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-base font-bold text-gray-900">Formulir Unggah File</h2>
                            <p class="text-xs text-gray-500">Pilih batch kegiatan target dan lampirkan berkas spreadsheet Anda.</p>
                        </div>
                    </div>

                    <form action="{{ route('admin.alumni.import') }}" method="POST" enctype="multipart/form-data" class="space-y-6" x-data="{ fileName: '' }">
                        @csrf
                        
                        <!-- Batch Selector -->
                        <div>
                            <label for="activity_batch_id" class="block text-xs font-semibold text-gray-700 mb-1.5">
                                Batch Kegiatan Target <span class="text-red-500">*</span>
                            </label>
                            <select name="activity_batch_id" id="activity_batch_id" required
                                class="w-full px-4 py-2.5 text-sm border rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition bg-white @error('activity_batch_id') border-red-500 bg-red-50/50 @else border-gray-300 @enderror">
                                <option value="">-- Pilih Batch Kegiatan --</option>
                                @foreach ($activityBatches as $batch)
                                    <option value="{{ $batch->id }}" {{ old('activity_batch_id') == $batch->id ? 'selected' : '' }}>
                                        {{ $batch->activity->title ?? $batch->activity->nama_kegiatan ?? 'Kegiatan' }} &bull; {{ $batch->nama_batch }}
                                    </option>
                                @endforeach
                            </select>
                            @error('activity_batch_id')
                                <p class="mt-1 text-xs text-red-600 font-medium">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Dropzone File Upload -->
                        <div>
                            <label class="block text-xs font-semibold text-gray-700 mb-1.5">
                                Berkas Excel / CSV <span class="text-red-500">*</span>
                            </label>
                            
                            <label for="file"
                                class="mt-1 flex flex-col items-center justify-center px-6 pt-7 pb-8 border-2 border-dashed rounded-2xl cursor-pointer hover:border-emerald-500 hover:bg-emerald-50/20 transition group @error('file') border-red-400 bg-red-50/30 @else border-gray-300 bg-gray-50/50 @enderror">
                                
                                <div class="w-12 h-12 rounded-2xl bg-emerald-50 text-emerald-600 group-hover:bg-emerald-100 flex items-center justify-center mb-3 transition">
                                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                    </svg>
                                </div>
                                
                                <span class="text-sm font-semibold text-gray-700 group-hover:text-emerald-700">
                                    Klik untuk memilih berkas atau seret ke sini
                                </span>
                                <span class="text-xs text-gray-400 mt-1">Mendukung format .csv, .xlsx, .xls (Maks 10MB)</span>
                                
                                <template x-if="fileName">
                                    <div class="mt-4 px-3.5 py-1.5 rounded-xl bg-emerald-100 text-emerald-800 text-xs font-semibold flex items-center gap-1.5">
                                        <svg class="w-4 h-4 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        <span x-text="fileName"></span>
                                    </div>
                                </template>

                                <input id="file" name="file" type="file" required
                                    @change="fileName = $event.target.files[0] ? $event.target.files[0].name : ''"
                                    class="sr-only" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel">
                            </label>
                            
                            @error('file')
                                <p class="mt-1.5 text-xs text-red-600 font-medium">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Actions -->
                        <div class="flex items-center justify-end gap-3 pt-4 border-t border-gray-100">
                            <a href="{{ route('admin.batch-alumni.index') }}"
                                class="px-5 py-2.5 rounded-xl border border-gray-300 bg-white text-gray-700 font-semibold text-sm hover:bg-gray-50 shadow-sm transition">
                                Batal
                            </a>
                            <button type="submit"
                                class="inline-flex items-center gap-2 px-6 py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-semibold text-sm shadow-sm transition">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                                </svg>
                                Mulai Import Data
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Right: Guide & Formatting Info (1 col) -->
            <div class="space-y-6">
                
                <!-- Format Requirement Card -->
                <div class="bg-white rounded-2xl border border-gray-200/80 shadow-sm p-6">
                    <div class="flex items-center gap-2.5 mb-4">
                        <div class="w-8 h-8 rounded-lg bg-indigo-50 text-indigo-600 flex items-center justify-center font-bold">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M3 14h18m-9-4v8m-7 0h14a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <h3 class="text-sm font-bold text-gray-900">Struktur Kolom Berkas</h3>
                    </div>
                    
                    <p class="text-xs text-gray-500 leading-relaxed mb-4">
                        Pastikan baris header pertama pada berkas Excel/CSV Anda memiliki nama kolom yang sesuai di bawah ini:
                    </p>

                    <div class="space-y-2">
                        <div class="p-2.5 rounded-xl bg-gray-50 border border-gray-100">
                            <div class="text-xs font-mono font-bold text-gray-900">Email Address</div>
                            <div class="text-[11px] text-gray-500">Email peserta / akun alumni (Wajib)</div>
                        </div>
                        <div class="p-2.5 rounded-xl bg-gray-50 border border-gray-100">
                            <div class="text-xs font-mono font-bold text-gray-900">Nama Lengkap</div>
                            <div class="text-[11px] text-gray-500">Nama lengkap peserta (Wajib)</div>
                        </div>
                        <div class="p-2.5 rounded-xl bg-gray-50 border border-gray-100">
                            <div class="text-xs font-mono font-bold text-gray-900">Akun instagram</div>
                            <div class="text-[11px] text-gray-500">Username instagram (Opsional)</div>
                        </div>
                        <div class="p-2.5 rounded-xl bg-gray-50 border border-gray-100">
                            <div class="text-xs font-mono font-bold text-gray-900">Jenis Kelamin</div>
                            <div class="text-[11px] text-gray-500">Laki-laki / Perempuan / Pria / Wanita</div>
                        </div>
                    </div>
                </div>

                <!-- Process Rules Card -->
                <div class="bg-gradient-to-br from-gray-900 to-gray-800 rounded-2xl text-white p-6 shadow-md">
                    <h3 class="text-sm font-bold tracking-wide uppercase text-emerald-400 mb-3 text-xs">Ketentuan Proses Import</h3>
                    <ul class="text-xs text-gray-300 space-y-2.5 leading-relaxed">
                        <li class="flex items-start gap-2">
                            <span class="text-emerald-400 font-bold">&bull;</span>
                            <span>Sistem akan membuat akun User baru secara otomatis jika email belum terdaftar di database.</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <span class="text-emerald-400 font-bold">&bull;</span>
                            <span>Menghubungkan user tersebut ke batch kegiatan yang Anda pilih.</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <span class="text-emerald-400 font-bold">&bull;</span>
                            <span>Akun baru berstatus non-aktif sampai user melakukan aktivasi email mandiri.</span>
                        </li>
                    </ul>
                </div>

            </div>

        </div>

    </div>
@endsection
