@extends('admin.layouts.app')

@section('title', 'Import Data Alumni')

@section('content')
    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-2xl font-semibold text-gray-900">Import Data Alumni</h1>
            {{-- <a href="{{ route('admin.alumni.materials.import.form') }}"
                class="inline-flex items-center px-2 py-1 border border-transparent shadow-sm text-sm font-light rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">Import
                Material </a> --}}

            <div class="mt-6">
                <div class="bg-white overflow-hidden shadow rounded-lg">
                    <div class="p-5">
                        @if (session('success'))
                            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4" role="alert">
                                {{ session('success') }}
                            </div>
                        @endif

                        @if (session('error'))
                            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4" role="alert">
                                {{ session('error') }}
                            </div>
                        @endif

                        @if (session('import_stats') && !empty(session('import_stats')['errors']))
                            <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 mb-4" role="alert">
                                <h5 class="font-medium">Import Errors:</h5>
                                <ul class="list-disc pl-5 mt-2">
                                    @foreach (session('import_stats')['errors'] as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('admin.alumni.import') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-4">
                                <label for="activity_batch_id" class="block text-sm font-medium text-gray-700">Batch
                                    Kegiatan</label>
                                <select name="activity_batch_id" id="activity_batch_id"
                                    class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md 
                                @error('activity_batch_id') border-red-500 @enderror"
                                    required>
                                    <option value="">-- Pilih Batch Kegiatan --</option>
                                    @foreach ($activityBatches as $batch)
                                        <option value="{{ $batch->id }}">
                                            {{ $batch->activity->title }} - {{ $batch->nama_batch }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('activity_batch_id')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="file" class="block text-sm font-medium text-gray-700">File Excel/CSV</label>
                                <div
                                    class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
                                    <div class="space-y-1 text-center">
                                        <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none"
                                            viewBox="0 0 48 48" aria-hidden="true">
                                            <path
                                                d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                        <div class="flex text-sm text-gray-600">
                                            <label for="file"
                                                class="relative cursor-pointer bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none">
                                                <span>Upload a file</span>
                                                <input id="file" name="file" type="file"
                                                    class="sr-only @error('file') border-red-500 @enderror" required>
                                            </label>
                                            <p class="pl-1">or drag and drop</p>
                                        </div>
                                        <p class="text-xs text-gray-500">CSV, Excel (.xlsx, .xls)</p>
                                        <p id="selected-filename" class="text-sm text-gray-500 mt-2"></p>
                                    </div>
                                </div>
                                @error('file')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                                <p class="mt-2 text-sm text-gray-500">
                                    Format file: CSV, Excel (.xlsx, .xls). Pastikan file memiliki kolom: Email Address, Nama
                                    Lengkap, Akun instagram, Jenis Kelamin.
                                </p>
                            </div>

                            <div class="flex justify-start mt-6">
                                <button type="submit"
                                    class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    Import Data
                                </button>
                                <a href="{{ route('admin.dashboard') }}"
                                    class="ml-3 inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    Kembali
                                </a>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow rounded-lg mt-6">
                    <div class="p-5">
                        <h3 class="text-lg leading-6 font-medium text-gray-900">Informasi Import</h3>
                        <div class="mt-4 text-sm text-gray-500">
                            <p>Proses import akan melakukan hal berikut:</p>
                            <ol class="list-decimal pl-5 mt-2 space-y-1">
                                <li>Membuat akun user baru jika email belum terdaftar</li>
                                <li>Menambahkan user sebagai alumni batch kegiatan yang dipilih</li>
                                <li>Akun yang dibuat akan berstatus tidak aktif sampai user melakukan aktivasi</li>
                                <li>User perlu mengaktivasi akun melalui halaman aktivasi dengan memasukkan email mereka
                                </li>
                            </ol>
                            <p class="mt-3">Pastikan data yang diimport sudah benar dan lengkap.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Show filename when file is selected
            const fileInput = document.getElementById('file');
            const filenameDisplay = document.getElementById('selected-filename');

            fileInput.addEventListener('change', function() {
                if (this.files && this.files[0]) {
                    filenameDisplay.textContent = 'Selected file: ' + this.files[0].name;
                }
            });
        });
    </script>
@endpush
