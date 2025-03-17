@extends('admin.layouts.app')

@section('title', 'Import Materi Batch')

@section('content')
    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-2xl font-semibold text-gray-900">Import Materi Batch</h1>

            <div class="mt-6">
                <div class="bg-white overflow-hidden shadow rounded-lg">
                    <div class="p-6">
                        @if (session('success'))
                            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                                {{ session('success') }}
                            </div>
                        @endif

                        @if (session('error'))
                            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                                {{ session('error') }}
                            </div>
                        @endif

                        @if (session('import_stats') && !empty(session('import_stats')['errors']))
                            <div class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded mb-4">
                                <h5 class="font-bold">Import Errors:</h5>
                                <ul class="mt-2 list-disc pl-5">
                                    @foreach (session('import_stats')['errors'] as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('admin.alumni.materials.import') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="mb-4">
                                <label for="activity_batch_id" class="block text-sm font-medium text-gray-700 mb-1">Batch
                                    Kegiatan</label>
                                <select name="activity_batch_id" id="activity_batch_id"
                                    class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md @error('activity_batch_id') border-red-500 @enderror"
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
                                <label for="file" class="block text-sm font-medium text-gray-700 mb-1">File
                                    Excel/CSV</label>
                                <div class="mt-1 flex rounded-md shadow-sm">
                                    <input type="file" name="file"
                                        class="focus:ring-indigo-500 focus:border-indigo-500 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 @error('file') border-red-500 @enderror"
                                        id="file" required>
                                </div>
                                <p class="mt-2 text-sm text-gray-500">
                                    Format file: CSV, Excel (.xlsx, .xls). Pastikan file memiliki kolom: materi, slide
                                    materi, notulensi, video rekaman materi.
                                </p>
                                @error('file')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="flex items-center justify-start space-x-3 mt-6">
                                <button type="submit"
                                    class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    Import Materi
                                </button>
                                <a href="{{ route('admin.dashboard') }}"
                                    class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    Kembali
                                </a>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow rounded-lg mt-6">
                    <div class="p-6">
                        <h3 class="text-lg leading-6 font-medium text-gray-900">Informasi Import Materi</h3>
                        <div class="mt-4">
                            <p class="text-sm text-gray-500">Proses import materi akan melakukan hal berikut:</p>
                            <ol class="mt-2 list-decimal pl-5 text-sm text-gray-500">
                                <li class="mt-1">Menambahkan materi ke batch kegiatan yang dipilih</li>
                                <li class="mt-1">Materi akan tersedia untuk alumni batch kegiatan tersebut</li>
                                <li class="mt-1">Urutan materi akan sesuai dengan urutan dalam file</li>
                            </ol>

                            <p class="mt-4 text-sm text-gray-500">Format yang diharapkan:</p>
                            <ul class="mt-2 list-disc pl-5 text-sm text-gray-500">
                                <li class="mt-1"><span class="font-medium">materi</span>: Judul materi (wajib)</li>
                                <li class="mt-1"><span class="font-medium">slide materi</span>: URL slide presentasi
                                    (wajib)</li>
                                <li class="mt-1"><span class="font-medium">notulensi</span>: URL notulensi/catatan
                                    (opsional)</li>
                                <li class="mt-1"><span class="font-medium">video rekaman materi</span>: URL video rekaman
                                    (opsional)</li>
                            </ul>
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
            const fileInput = document.querySelector('input[type="file"]');
            if (fileInput) {
                fileInput.addEventListener('change', function(e) {
                    const fileName = e.target.files[0].name;
                    // Add a span to show the filename if needed
                    const parent = this.parentNode;
                    let filenameSpan = parent.querySelector('.filename-display');
                    if (!filenameSpan) {
                        filenameSpan = document.createElement('span');
                        filenameSpan.className = 'filename-display ml-2 text-sm text-gray-600';
                        parent.appendChild(filenameSpan);
                    }
                    filenameSpan.textContent = fileName;
                });
            }
        });
    </script>
@endpush
