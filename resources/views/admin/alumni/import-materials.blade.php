@extends('admin.layouts.app')
@section('title', 'Import Materi Batch - Admin Panel')

@section('content')
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
        
        <!-- Breadcrumb & Header -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
            <div>
                <div class="flex items-center gap-2 text-xs text-gray-500 mb-2">
                    <a href="{{ route('admin.batches.index') }}" class="hover:text-emerald-600 transition">Semua Batch</a>
                    <span>/</span>
                    <span class="text-gray-700 font-medium">Import Materi Excel</span>
                </div>
                <h1 class="text-2xl font-bold text-gray-900">Import Materi Batch Kegiatan</h1>
                <p class="text-sm text-gray-500 mt-1">
                    Unggah materi pembelajaran, slide presentasi, notulensi, dan rekaman video secara massal melalui file spreadsheet (Excel / CSV).
                </p>
            </div>

            <div class="flex items-center gap-3">
                <a href="{{ route('admin.batches.index') }}"
                    class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl border border-gray-300 bg-white text-gray-700 font-semibold text-sm hover:bg-gray-50 shadow-sm transition">
                    <svg class="w-4 h-4 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Kembali ke Daftar Batch
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
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-base font-bold text-gray-900">Formulir Import Materi</h2>
                            <p class="text-xs text-gray-500">Pilih batch kegiatan target dan lampirkan berkas spreadsheet materi Anda.</p>
                        </div>
                    </div>

                    <form action="{{ route('admin.alumni.materials.import') }}" method="POST" enctype="multipart/form-data" class="space-y-6" x-data="{ fileName: '' }">
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
                                        {{ $batch->activity ? $batch->activity->title : 'Kegiatan' }} &mdash; {{ $batch->nama_batch }}
                                    </option>
                                @endforeach
                            </select>
                            @error('activity_batch_id')
                                <p class="mt-1 text-xs text-red-600 font-medium">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- File Input Area -->
                        <div>
                            <label class="block text-xs font-semibold text-gray-700 mb-1.5">
                                Berkas Spreadsheet (Excel / CSV) <span class="text-red-500">*</span>
                            </label>
                            
                            <div class="relative border-2 border-dashed border-gray-300 hover:border-emerald-500 rounded-2xl p-6 text-center transition bg-gray-50/50 hover:bg-emerald-50/20 group">
                                <input type="file" name="file" id="file" accept=".csv, .xlsx, .xls" required
                                    @change="fileName = $event.target.files[0] ? $event.target.files[0].name : ''"
                                    class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">
                                
                                <div class="flex flex-col items-center justify-center">
                                    <div class="w-12 h-12 rounded-2xl bg-white border border-gray-200 group-hover:border-emerald-300 text-gray-400 group-hover:text-emerald-600 flex items-center justify-center mb-3 shadow-xs transition">
                                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                        </svg>
                                    </div>
                                    <p class="text-sm font-semibold text-gray-700 group-hover:text-emerald-700 transition">
                                        <span class="underline">Klik untuk memilih file</span> atau seret file ke sini
                                    </p>
                                    <p class="text-xs text-gray-400 mt-1">Mendukung format .XLSX, .XLS, atau .CSV (Maksimal 10 MB)</p>
                                </div>
                            </div>

                            <!-- Selected File Banner -->
                            <div x-show="fileName" x-cloak class="mt-3 p-3 bg-emerald-50 border border-emerald-200 rounded-xl flex items-center justify-between">
                                <div class="flex items-center gap-2 text-xs font-semibold text-emerald-800">
                                    <svg class="w-4 h-4 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <span>File Terpilih: <strong x-text="fileName"></strong></span>
                                </div>
                                <span class="text-[11px] text-emerald-600 font-bold uppercase">Siap Diunggah</span>
                            </div>

                            @error('file')
                                <p class="mt-1.5 text-xs text-red-600 font-medium">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Action Buttons -->
                        <div class="pt-4 border-t border-gray-100 flex items-center justify-end gap-3">
                            <a href="{{ route('admin.batches.index') }}"
                                class="px-5 py-2.5 rounded-xl border border-gray-300 bg-white text-gray-700 hover:bg-gray-50 font-semibold text-sm shadow-sm transition">
                                Batal
                            </a>
                            <button type="submit"
                                class="inline-flex items-center gap-2 px-6 py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-semibold text-sm shadow-sm transition">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                                </svg>
                                Mulai Import Materi
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Right: Instructions & Format Guide (1 col) -->
            <div class="space-y-6">
                
                <!-- Format Box -->
                <div class="bg-white rounded-2xl border border-gray-200/80 shadow-sm p-6">
                    <div class="flex items-center gap-2.5 mb-4">
                        <span class="w-8 h-8 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center font-bold text-sm">📋</span>
                        <h3 class="text-sm font-bold text-gray-900">Format Kolom Spreadsheet</h3>
                    </div>
                    
                    <p class="text-xs text-gray-500 leading-relaxed mb-4">
                        Pastikan berkas Excel atau CSV Anda memiliki header baris pertama dengan nama kolom berikut:
                    </p>

                    <div class="space-y-2.5 text-xs">
                        <div class="p-2.5 rounded-xl bg-gray-50 border border-gray-200/80">
                            <div class="flex items-center justify-between mb-1">
                                <span class="font-mono font-bold text-gray-800">materi</span>
                                <span class="text-[10px] font-bold uppercase text-red-600 bg-red-50 px-1.5 py-0.5 rounded">Wajib</span>
                            </div>
                            <p class="text-gray-500">Judul materi atau nama sesi pertemuan.</p>
                        </div>

                        <div class="p-2.5 rounded-xl bg-gray-50 border border-gray-200/80">
                            <div class="flex items-center justify-between mb-1">
                                <span class="font-mono font-bold text-gray-800">slide materi</span>
                                <span class="text-[10px] font-bold uppercase text-red-600 bg-red-50 px-1.5 py-0.5 rounded">Wajib</span>
                            </div>
                            <p class="text-gray-500">URL link slide materi (Google Drive, PDF, PPT, dll.).</p>
                        </div>

                        <div class="p-2.5 rounded-xl bg-gray-50 border border-gray-200/80">
                            <div class="flex items-center justify-between mb-1">
                                <span class="font-mono font-bold text-gray-800">notulensi</span>
                                <span class="text-[10px] font-bold uppercase text-gray-500 bg-gray-200/70 px-1.5 py-0.5 rounded">Opsional</span>
                            </div>
                            <p class="text-gray-500">URL link catatan / notulensi materi.</p>
                        </div>

                        <div class="p-2.5 rounded-xl bg-gray-50 border border-gray-200/80">
                            <div class="flex items-center justify-between mb-1">
                                <span class="font-mono font-bold text-gray-800">video rekaman materi</span>
                                <span class="text-[10px] font-bold uppercase text-gray-500 bg-gray-200/70 px-1.5 py-0.5 rounded">Opsional</span>
                            </div>
                            <p class="text-gray-500">URL video rekaman sesi pembelajaran (YouTube, Drive, dll.).</p>
                        </div>
                    </div>
                </div>

                <!-- Info Box -->
                <div class="bg-emerald-50/60 border border-emerald-200/80 rounded-2xl p-5 text-xs text-emerald-900 leading-relaxed">
                    <div class="flex items-center gap-2 font-bold mb-2 text-emerald-800">
                        <span>💡</span>
                        <span>Catatan Proses Import:</span>
                    </div>
                    <ul class="list-disc list-inside space-y-1 text-emerald-800/90 pl-1">
                        <li>Materi akan diurutkan secara otomatis sesuai urutan baris di Excel.</li>
                        <li>Materi yang di-import akan langsung dapat diakses oleh seluruh alumni yang terdaftar pada batch tersebut di portal alumni.</li>
                    </ul>
                </div>

            </div>

        </div>

    </div>
@endsection
