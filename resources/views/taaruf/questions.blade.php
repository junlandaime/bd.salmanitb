@extends('layouts.app')

@section('title', 'Pertanyaan Ta\'aruf')
<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-WE2HFGE5VL"></script>
<script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
        dataLayer.push(arguments);
    }
    gtag('js', new Date());

    gtag('config', 'G-WE2HFGE5VL');
</script>
@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="mb-8">
            <nav class="flex" aria-label="Breadcrumb">
                <ol class="flex items-center space-x-2">
                    <li>
                        <a href="{{ route('alumni.dashboard') }}" class="text-green-600 hover:text-green-700">Dashboard
                            Alumni</a>
                    </li>
                    <li class="flex items-center">
                        <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                clip-rule="evenodd" />
                        </svg>
                        <a href="{{ route('taaruf.index') }}" class="ml-2 text-green-600 hover:text-green-700">Ta'aruf</a>
                    </li>
                    <li class="flex items-center">
                        <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                clip-rule="evenodd" />
                        </svg>
                        <span class="ml-2 text-gray-500" aria-current="page">Pertanyaan Tambahan</span>
                    </li>
                </ol>
            </nav>
            <h2 class="text-3xl font-bold text-gray-900 mt-4">Pertanyaan Tambahan Ta'aruf</h2>
            <p class="text-gray-500">Jawab pertanyaan berikut dengan jujur untuk melengkapi profil Ta'aruf Anda</p>
        </div>

        @if (session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif

        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="md:col-span-2">
                <form action="{{ route('taaruf.questions.save') }}" method="POST" class="mb-8">
                    @csrf

                    <div class="bg-white rounded-lg shadow-lg overflow-hidden mb-8">
                        <div class="border-b border-gray-200 px-6 py-4">
                            <h5 class="text-xl font-bold text-green-600">Pertanyaan Penting</h5>
                        </div>
                        <div class="p-6">
                            <p class="text-gray-500 mb-6">
                                Pertanyaan-pertanyaan berikut merupakan informasi penting yang perlu diketahui oleh calon
                                pasangan.
                                Jawablah dengan jujur, karena kejujuran adalah kunci dalam proses ta'aruf.
                            </p>

                            <div class="mb-6">
                                <label class="block mb-2">Apakah Anda sedang dalam proses ta'aruf dengan orang lain? <span
                                        class="text-red-500">*</span></label>
                                <div class="flex items-center space-x-6">
                                    <div class="flex items-center">
                                        <input type="radio" id="is_in_taaruf_process_yes" name="is_in_taaruf_process"
                                            value="1" class="h-4 w-4 text-green-600"
                                            {{ old('is_in_taaruf_process', $taarufProfile->is_in_taaruf_process ?? '') ? 'checked' : '' }}
                                            required>
                                        <label class="ml-2" for="is_in_taaruf_process_yes">Ya</label>
                                    </div>
                                    <div class="flex items-center">
                                        <input type="radio" id="is_in_taaruf_process_no" name="is_in_taaruf_process"
                                            value="0" class="h-4 w-4 text-green-600"
                                            {{ old('is_in_taaruf_process', $taarufProfile->is_in_taaruf_process ?? '') === 0 ? 'checked' : '' }}
                                            required>
                                        <label class="ml-2" for="is_in_taaruf_process_no">Tidak</label>
                                    </div>
                                </div>
                                @error('is_in_taaruf_process')
                                    <div class="text-red-500 mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-6">
                                <label class="block mb-2">Apakah Anda seorang perokok? <span
                                        class="text-red-500">*</span></label>
                                <div class="flex items-center space-x-6">
                                    <div class="flex items-center">
                                        <input type="radio" id="is_smoker_yes" name="is_smoker" value="1"
                                            class="h-4 w-4 text-green-600"
                                            {{ old('is_smoker', $taarufProfile->is_smoker ?? '') ? 'checked' : '' }}
                                            required>
                                        <label class="ml-2" for="is_smoker_yes">Ya</label>
                                    </div>
                                    <div class="flex items-center">
                                        <input type="radio" id="is_smoker_no" name="is_smoker" value="0"
                                            class="h-4 w-4 text-green-600"
                                            {{ old('is_smoker', $taarufProfile->is_smoker ?? '') === 0 ? 'checked' : '' }}
                                            required>
                                        <label class="ml-2" for="is_smoker_no">Tidak</label>
                                    </div>
                                </div>
                                @error('is_smoker')
                                    <div class="text-red-500 mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            @if (auth()->user()->taarufProfile->gender === 'male')
                                <div class="mb-6">
                                    <label class="block mb-2">Apakah Anda berniat untuk berpoligami? <span
                                            class="text-red-500">*</span></label>
                                    <div class="flex items-center space-x-6">
                                        <div class="flex items-center">
                                            <input type="radio" id="is_polygamy_intended_yes" name="is_polygamy_intended"
                                                value="1" class="h-4 w-4 text-green-600"
                                                {{ old('is_polygamy_intended', $taarufProfile->is_polygamy_intended ?? '') ? 'checked' : '' }}
                                                required>
                                            <label class="ml-2" for="is_polygamy_intended_yes">Ya</label>
                                        </div>
                                        <div class="flex items-center">
                                            <input type="radio" id="is_polygamy_intended_no" name="is_polygamy_intended"
                                                value="0" class="h-4 w-4 text-green-600"
                                                {{ old('is_polygamy_intended', $taarufProfile->is_polygamy_intended ?? '') === 0 ? 'checked' : '' }}
                                                required>
                                            <label class="ml-2" for="is_polygamy_intended_no">Tidak</label>
                                        </div>
                                    </div>
                                    @error('is_polygamy_intended')
                                        <div class="text-red-500 mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            @else
                                <input type="hidden" name="is_polygamy_intended" value="0">
                            @endif

                            <div class="mb-6">
                                <label class="block mb-2">Apakah Anda memiliki hutang yang signifikan? <span
                                        class="text-red-500">*</span></label>
                                <div class="flex items-center space-x-6">
                                    <div class="flex items-center">
                                        <input type="radio" id="has_debt_yes" name="has_debt" value="1"
                                            class="h-4 w-4 text-green-600"
                                            {{ old('has_debt', $taarufProfile->has_debt ?? '') ? 'checked' : '' }}
                                            required>
                                        <label class="ml-2" for="has_debt_yes">Ya</label>
                                    </div>
                                    <div class="flex items-center">
                                        <input type="radio" id="has_debt_no" name="has_debt" value="0"
                                            class="h-4 w-4 text-green-600"
                                            {{ old('has_debt', $taarufProfile->has_debt ?? '') === 0 ? 'checked' : '' }}
                                            required>
                                        <label class="ml-2" for="has_debt_no">Tidak</label>
                                    </div>
                                </div>
                                @error('has_debt')
                                    <div class="text-red-500 mt-1">{{ $message }}</div>
                                @enderror
                                <p class="text-sm text-gray-500 mt-1">
                                    Hutang signifikan adalah hutang yang dapat mempengaruhi kehidupan rumah tangga, seperti
                                    KPR, hutang pendidikan, atau hutang usaha.
                                </p>
                            </div>

                            <div class="mb-6">
                                <label class="block mb-2">Apakah Anda memiliki tanggungan? <span
                                        class="text-red-500">*</span></label>
                                <div class="flex items-center space-x-6">
                                    <div class="flex items-center">
                                        <input type="radio" id="has_dependents_yes" name="has_dependents"
                                            value="1" class="h-4 w-4 text-green-600"
                                            {{ old('has_dependents', $taarufProfile->has_dependents ?? '') ? 'checked' : '' }}
                                            required>
                                        <label class="ml-2" for="has_dependents_yes">Ya</label>
                                    </div>
                                    <div class="flex items-center">
                                        <input type="radio" id="has_dependents_no" name="has_dependents"
                                            value="0" class="h-4 w-4 text-green-600"
                                            {{ old('has_dependents', $taarufProfile->has_dependents ?? '') === 0 ? 'checked' : '' }}
                                            required>
                                        <label class="ml-2" for="has_dependents_no">Tidak</label>
                                    </div>
                                </div>
                                @error('has_dependents')
                                    <div class="text-red-500 mt-1">{{ $message }}</div>
                                @enderror
                                <p class="text-sm text-gray-500 mt-1">
                                    Tanggungan dapat berupa anak (jika Anda pernah menikah sebelumnya), orang tua, atau
                                    anggota keluarga lain yang menjadi tanggung jawab Anda.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div>
                        <button type="submit"
                            class="inline-flex items-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-white bg-green-600 hover:bg-green-700 md:py-4 md:text-lg md:px-10">
                            <svg class="h-5 w-5 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z"
                                    clip-rule="evenodd" />
                            </svg>
                            Simpan Jawaban
                        </button>
                        <a href="{{ route('taaruf.index') }}"
                            class="ml-4 inline-flex items-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-green-700 bg-green-100 hover:bg-green-200 md:py-4 md:text-lg md:px-10">
                            <svg class="h-5 w-5 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                    clip-rule="evenodd" />
                            </svg>
                            Batal
                        </a>
                    </div>
                </form>
            </div>

            <div class="md:col-span-1">
                <div class="bg-white rounded-lg shadow-lg overflow-hidden sticky top-8">
                    <div class="border-b border-gray-200 px-6 py-4">
                        <h5 class="text-xl font-bold text-green-600">Informasi Penting</h5>
                    </div>
                    <div class="p-6">
                        <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 mb-4">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <svg class="h-5 w-5 text-yellow-400" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm text-yellow-700">
                                        Jawaban Anda akan ditampilkan kepada calon pasangan yang melihat profil Anda.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <p class="font-bold text-gray-900 mb-2">Mengapa pertanyaan ini penting?</p>
                        <ul class="list-disc pl-5 text-gray-600 mb-4 space-y-1">
                            <li>Kejujuran adalah fondasi penting dalam membangun rumah tangga</li>
                            <li>Informasi ini dapat menjadi pertimbangan penting bagi calon pasangan</li>
                            <li>Menyembunyikan informasi penting dapat menimbulkan masalah di kemudian hari</li>
                        </ul>

                        <p class="font-bold text-gray-900 mb-2">Setelah mengisi pertanyaan:</p>
                        <ul class="list-disc pl-5 text-gray-600 space-y-1">
                            <li>Profil Ta'aruf Anda akan lengkap dan aktif</li>
                            <li>Anda dapat melihat daftar alumni lain yang juga aktif dalam fitur Ta'aruf</li>
                            <li>Anda dapat mengubah jawaban ini kapan saja jika ada perubahan</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
