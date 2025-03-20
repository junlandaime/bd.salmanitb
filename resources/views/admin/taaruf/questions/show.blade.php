@extends('admin.layouts.app')

@section('title', 'Detail Pertanyaan Ta\'aruf')

@section('content')
    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-semibold text-gray-900">Detail Pertanyaan Ta'aruf</h1>
                <a href="{{ route('admin.taaruf.questions.index') }}"
                    class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    <svg class="-ml-1 mr-2 h-5 w-5 text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                        fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z"
                            clip-rule="evenodd" />
                    </svg>
                    Kembali
                </a>
            </div>

            <div class="bg-white shadow rounded-lg">
                <div class="px-4 py-5 border-b border-gray-200 sm:px-6">
                    <h3 class="text-lg font-medium leading-6 text-gray-900">Informasi Pertanyaan</h3>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <div class="mb-6">
                                <h5 class="text-sm font-medium text-gray-500">Profil Ta'aruf</h5>
                                <div class="mt-1 text-sm text-gray-900">
                                    <a href="{{ route('admin.taaruf.show', $question->profile_id) }}"
                                        class="text-blue-600 hover:text-blue-900">
                                        {{ $question->profile->full_name }}
                                    </a>
                                </div>
                            </div>

                            <div class="mb-6">
                                <h5 class="text-sm font-medium text-gray-500">Penanya</h5>
                                <div class="mt-1 text-sm text-gray-900">
                                    <a href="{{ route('admin.taaruf.show', $question->askedBy->taarufProfile->id) }}"
                                        class="text-blue-600 hover:text-blue-900">
                                        {{ $question->askedBy->taarufProfile->full_name }}
                                    </a>
                                    @if ($question->asked_by_user)
                                        {{ $question->asked_by_user->name }}
                                        @if ($question->is_anonymous)
                                            <span
                                                class="inline-flex items-center ml-2 px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                Ditampilkan sebagai Anonim
                                            </span>
                                        @endif
                                    @else
                                        <span class="text-gray-400">Tidak diketahui</span>
                                    @endif
                                </div>
                            </div>

                            <div class="mb-6">
                                <h5 class="text-sm font-medium text-gray-500">Email Penanya</h5>
                                <div class="mt-1 text-sm text-gray-900">
                                    {{ $question->asked_by_user->email ?? 'Tidak tersedia' }}
                                </div>
                            </div>
                        </div>

                        <div>
                            <div class="mb-6">
                                <h5 class="text-sm font-medium text-gray-500">Tanggal Dibuat</h5>
                                <div class="mt-1 text-sm text-gray-900">
                                    {{ $question->created_at->format('d M Y H:i') }}
                                </div>
                            </div>

                            <div class="mb-6">
                                <h5 class="text-sm font-medium text-gray-500">Status</h5>
                                <div class="mt-1">
                                    @if ($question->is_answered)
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            Sudah Dijawab
                                        </span>
                                    @else
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                            Belum Dijawab
                                        </span>
                                    @endif
                                </div>
                            </div>

                            @if ($question->is_answered)
                                <div class="mb-6">
                                    <h5 class="text-sm font-medium text-gray-500">Tanggal Dijawab</h5>
                                    <div class="mt-1 text-sm text-gray-900">
                                        {{ $question->updated_at->format('d M Y H:i') }}
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="border-t border-gray-200 pt-6 mt-6">
                        <div class="mb-6">
                            <h5 class="text-sm font-medium text-gray-500">Pertanyaan</h5>
                            <div class="mt-2 p-4 bg-gray-50 rounded-md text-sm text-gray-900">
                                {{ $question->question }}
                            </div>
                        </div>

                        @if ($question->is_answered)
                            <div class="mb-6">
                                <h5 class="text-sm font-medium text-gray-500">Jawaban</h5>
                                <div class="mt-2 p-4 bg-gray-50 rounded-md text-sm text-gray-900">
                                    {{ $question->answer }}
                                </div>
                            </div>
                        @endif
                    </div>

                    <div class="border-t border-gray-200 pt-6 mt-6">
                        <form action="{{ route('admin.taaruf.questions.destroy', $question->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500"
                                onclick="return confirm('Apakah Anda yakin ingin menghapus pertanyaan ini?')">
                                <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                        clip-rule="evenodd" />
                                </svg>
                                Hapus Pertanyaan
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
