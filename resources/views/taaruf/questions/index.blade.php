@extends('layouts.app')

@section('title', 'Pertanyaan Ta\'aruf Saya')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="mb-8">
            <nav class="mb-4">
                <ol class="flex text-sm">
                    <li class="flex items-center">
                        <a href="{{ route('alumni.dashboard') }}" class="text-green-600 hover:text-green-700">Dashboard
                            Alumni</a>
                        <svg class="w-4 h-4 mx-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </li>
                    <li class="flex items-center">
                        <a href="{{ route('taaruf.index') }}" class="text-green-600 hover:text-green-700">Ta'aruf</a>
                        <svg class="w-4 h-4 mx-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </li>
                    <li class="text-gray-500">Pertanyaan Saya</li>
                </ol>
            </nav>
            <h2 class="text-3xl font-bold text-green-600">Pertanyaan Ta'aruf Saya</h2>
            <p class="text-gray-500 mt-2">Kelola pertanyaan yang diterima pada profil Ta'aruf Anda</p>
        </div>

        <!-- Wrap both navigation and content in the same x-data context -->
        <div x-data="{ activeTab: 'received' }">
            <!-- Tab Navigation -->
            <div class="mb-6">
                <div class="border-b border-gray-200">
                    <nav class="-mb-px flex space-x-8">
                        <button @click="activeTab = 'received'"
                            :class="{ 'border-green-500 text-green-600': activeTab === 'received', 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300': activeTab !== 'received' }"
                            class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                            Pertanyaan Diterima
                        </button>
                        <button @click="activeTab = 'sent'"
                            :class="{ 'border-green-500 text-green-600': activeTab === 'sent', 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300': activeTab !== 'sent' }"
                            class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                            Pertanyaan Yang Saya Ajukan
                        </button>
                    </nav>
                </div>
            </div>

            <!-- Content area - should be in the same Alpine.js context -->
            <div class="bg-white rounded-lg shadow-lg overflow-hidden mb-8">
                <div class="p-6 border-b flex justify-between items-center">
                    <h5 class="text-xl font-bold text-green-600" x-show="activeTab === 'received'">Daftar Pertanyaan
                        Diterima</h5>
                    <h5 class="text-xl font-bold text-green-600" x-show="activeTab === 'sent'">Daftar Pertanyaan Yang Saya
                        Ajukan</h5>
                </div>
                <div class="p-6">
                    @if (session('success'))
                        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4" role="alert">
                            <p>{{ session('success') }}</p>
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4" role="alert">
                            <p>{{ session('error') }}</p>
                        </div>
                    @endif
                    <!-- Content for tabs -->
                    <!-- Received Questions Tab -->
                    <div x-show="activeTab === 'received'">
                        @if (count($questions) > 0)
                            <div class="overflow-x-auto">
                                <table class="w-full">
                                    <thead>
                                        <tr class="bg-gray-50">
                                            <th
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Tanggal</th>
                                            <th
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Pertanyaan</th>
                                            <th
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Jawaban</th>
                                            <th
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Status</th>
                                            <th
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @foreach ($questions as $question)
                                            <tr class="hover:bg-gray-50">
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                    {{ $question->created_at->format('d M Y') }}
                                                </td>
                                                <td class="px-6 py-4 text-sm text-gray-500">
                                                    {{ $question->question }}
                                                </td>
                                                <td class="px-6 py-4 text-sm text-gray-500">
                                                    @if ($question->is_answered)
                                                        {{ $question->answer }}
                                                    @else
                                                        <span
                                                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                                            Belum dijawab
                                                        </span>
                                                    @endif
                                                </td>
                                                <td class="px-6 py-4 text-sm text-gray-500">
                                                    @if ($question->is_answered)
                                                        <div class="flex flex-col space-y-1">
                                                            <span
                                                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                                Sudah dijawab
                                                            </span>
                                                            <span
                                                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $question->is_public ? 'bg-blue-100 text-blue-800' : 'bg-gray-100 text-gray-800' }}">
                                                                {{ $question->is_public ? 'Publik' : 'Privat' }}
                                                            </span>
                                                        </div>
                                                    @else
                                                        <span
                                                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                                            Belum dijawab
                                                        </span>
                                                    @endif
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                    @if (!$question->is_answered)
                                                        <button type="button"
                                                            class="inline-flex items-center px-3 py-1.5 border border-green-600 rounded-md text-sm font-medium text-green-600 hover:bg-green-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500"
                                                            x-data=""
                                                            x-on:click="$dispatch('open-modal', 'answer-modal-{{ $question->id }}')">
                                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor"
                                                                viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2"
                                                                    d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6">
                                                                </path>
                                                            </svg>
                                                            Jawab
                                                        </button>
                                                    @else
                                                        <div class="flex space-x-2">
                                                            <!-- Toggle Public/Private Button -->
                                                            <form
                                                                action="{{ route('taaruf.questions.toggle-public', $question->id) }}"
                                                                method="POST">
                                                                @csrf
                                                                <button type="submit"
                                                                    class="inline-flex items-center px-3 py-1.5 border {{ $question->is_public ? 'border-blue-600 text-blue-600 hover:bg-blue-50' : 'border-gray-600 text-gray-600 hover:bg-gray-50' }} rounded-md text-sm font-medium focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                                                    <svg class="w-4 h-4 mr-1" fill="none"
                                                                        stroke="currentColor" viewBox="0 0 24 24">
                                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                                            stroke-width="2"
                                                                            d="{{ $question->is_public ? 'M15 12a3 3 0 11-6 0 3 3 0 016 0z M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z' : 'M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21' }}">
                                                                        </path>
                                                                    </svg>
                                                                    {{ $question->is_public ? 'Publik' : 'Privat' }}
                                                                </button>
                                                            </form>

                                                            <!-- Options Menu -->
                                                            <div x-data="{ open: false }"
                                                                class="relative inline-block text-left">
                                                                <button type="button"
                                                                    class="inline-flex items-center px-3 py-1.5 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500"
                                                                    @click="open = !open" @click.away="open = false">
                                                                    <svg class="w-4 h-4" fill="none"
                                                                        stroke="currentColor" viewBox="0 0 24 24">
                                                                        <path stroke-linecap="round"
                                                                            stroke-linejoin="round" stroke-width="2"
                                                                            d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z">
                                                                        </path>
                                                                    </svg>
                                                                </button>
                                                                <div x-show="open"
                                                                    x-transition:enter="transition ease-out duration-100"
                                                                    x-transition:enter-start="transform opacity-0 scale-95"
                                                                    x-transition:enter-end="transform opacity-100 scale-100"
                                                                    x-transition:leave="transition ease-in duration-75"
                                                                    x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                                                                    x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                                                                    class="origin-top-right absolute left-full ml-2 top-0 w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 divide-y divide-gray-100 focus:outline-none z-10"
                                                                    role="menu">
                                                                    <div class="py-1" role="none">
                                                                        <button type="button"
                                                                            class="group flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900 w-full text-left"
                                                                            role="menuitem"
                                                                            @click="$dispatch('open-modal', 'answer-modal-{{ $question->id }}')">
                                                                            <svg class="mr-3 h-4 w-4 text-gray-500 group-hover:text-gray-600"
                                                                                fill="none" stroke="currentColor"
                                                                                viewBox="0 0 24 24">
                                                                                <path stroke-linecap="round"
                                                                                    stroke-linejoin="round"
                                                                                    stroke-width="2"
                                                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                                                                </path>
                                                                            </svg>
                                                                            Edit Jawaban
                                                                        </button>
                                                                    </div>
                                                                    <div class="py-1" role="none">
                                                                        <form
                                                                            action="{{ route('taaruf.questions.destroy', $question->id) }}"
                                                                            method="POST" class="w-full">
                                                                            @csrf
                                                                            @method('DELETE')
                                                                            <button type="submit"
                                                                                class="group flex items-center px-4 py-2 text-sm text-red-700 hover:bg-red-50 hover:text-red-900 w-full text-left"
                                                                                role="menuitem"
                                                                                onclick="return confirm('Apakah Anda yakin ingin menghapus pertanyaan ini?')">
                                                                                <svg class="mr-3 h-4 w-4 text-red-500 group-hover:text-red-600"
                                                                                    fill="none" stroke="currentColor"
                                                                                    viewBox="0 0 24 24">
                                                                                    <path stroke-linecap="round"
                                                                                        stroke-linejoin="round"
                                                                                        stroke-width="2"
                                                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                                                                    </path>
                                                                                </svg>
                                                                                Hapus
                                                                            </button>
                                                                        </form>
                                                                    </div>
                                                                    <div class="py-1" role="none">
                                                                        <form
                                                                            action="{{ route('taaruf.questions.toggle-public', $question->id) }}"
                                                                            method="POST" class="w-full">
                                                                            @csrf
                                                                            <button type="submit"
                                                                                class="group flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900 w-full text-left"
                                                                                role="menuitem">
                                                                                <svg class="mr-3 h-4 w-4 text-gray-500 group-hover:text-gray-600"
                                                                                    fill="none" stroke="currentColor"
                                                                                    viewBox="0 0 24 24">
                                                                                    <path stroke-linecap="round"
                                                                                        stroke-linejoin="round"
                                                                                        stroke-width="2"
                                                                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                                                                    </path>
                                                                                    <path stroke-linecap="round"
                                                                                        stroke-linejoin="round"
                                                                                        stroke-width="2"
                                                                                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                                                                                    </path>
                                                                                </svg>
                                                                                {{ $question->is_public ? 'Sembunyikan dari Profil' : 'Tampilkan di Profil' }}
                                                                            </button>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                </td>
                                            </tr>

                                            <!-- Answer Modal -->
                                            <div id="answer-modal-{{ $question->id }}" x-data="{ open: false }"
                                                x-show="open" x-cloak
                                                @open-modal.window="if ($event.detail == 'answer-modal-{{ $question->id }}') open = true"
                                                @keydown.escape.window="open = false"
                                                class="fixed inset-0 overflow-y-auto z-50">
                                                <div
                                                    class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
                                                    <div x-show="open" x-transition:enter="ease-out duration-300"
                                                        x-transition:enter-start="opacity-0"
                                                        x-transition:enter-end="opacity-100"
                                                        x-transition:leave="ease-in duration-200"
                                                        x-transition:leave-start="opacity-100"
                                                        x-transition:leave-end="opacity-0"
                                                        class="fixed inset-0 transition-opacity" @click="open = false">
                                                        <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                                                    </div>

                                                    <span class="hidden sm:inline-block sm:align-middle sm:h-screen"
                                                        aria-hidden="true">&#8203;</span>

                                                    <div x-show="open" x-transition:enter="ease-out duration-300"
                                                        x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                                                        x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                                                        x-transition:leave="ease-in duration-200"
                                                        x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                                                        x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                                                        class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full"
                                                        @click.away="open = false">
                                                        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                                                            <div class="sm:flex sm:items-start">
                                                                <div
                                                                    class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                                                                    <h3 class="text-lg leading-6 font-medium text-gray-900"
                                                                        id="modal-title">
                                                                        {{ $question->is_answered ? 'Edit Jawaban' : 'Jawab Pertanyaan' }}
                                                                    </h3>
                                                                    <div class="mt-4">
                                                                        <form
                                                                            action="{{ route('taaruf.questions.answer', $question->id) }}"
                                                                            method="POST">
                                                                            @csrf
                                                                            <div class="mb-4">
                                                                                <label
                                                                                    class="block text-sm font-medium text-gray-700 mb-2">Pertanyaan:</label>
                                                                                <p class="text-gray-600">
                                                                                    {{ $question->question }}
                                                                                </p>
                                                                            </div>
                                                                            <div class="mb-4">
                                                                                <label for="answer{{ $question->id }}"
                                                                                    class="block text-sm font-medium text-gray-700 mb-2">
                                                                                    Jawaban Anda:
                                                                                </label>
                                                                                <textarea
                                                                                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-green-300 focus:ring focus:ring-green-200 focus:ring-opacity-50"
                                                                                    id="answer{{ $question->id }}" name="answer" rows="5" required>{{ $question->answer }}</textarea>
                                                                            </div>
                                                                            <div class="mb-4">
                                                                                <div class="flex items-center">
                                                                                    <input
                                                                                        id="is_public{{ $question->id }}"
                                                                                        name="is_public" type="checkbox"
                                                                                        value="1"
                                                                                        class="h-4 w-4 text-green-600 focus:ring-green-500 border-gray-300 rounded"
                                                                                        {{ $question->is_public ? 'checked' : '' }}>
                                                                                    <label
                                                                                        for="is_public{{ $question->id }}"
                                                                                        class="ml-2 block text-sm text-gray-700">
                                                                                        Tampilkan pertanyaan dan jawaban ini
                                                                                        di
                                                                                        profil publik saya
                                                                                    </label>
                                                                                </div>
                                                                                <p class="mt-1 text-sm text-gray-500">Jika
                                                                                    dicentang, pertanyaan dan jawaban ini
                                                                                    akan
                                                                                    terlihat oleh pengunjung profil Ta'aruf
                                                                                    Anda
                                                                                </p>
                                                                            </div>
                                                                            <div
                                                                                class="mt-5 sm:mt-6 sm:flex sm:flex-row-reverse">
                                                                                <button type="submit"
                                                                                    class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-green-600 text-base font-medium text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 sm:ml-3 sm:w-auto sm:text-sm">
                                                                                    Simpan Jawaban
                                                                                </button>
                                                                                <button type="button"
                                                                                    class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 sm:mt-0 sm:w-auto sm:text-sm"
                                                                                    @click="open = false">
                                                                                    Batal
                                                                                </button>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <div class="mt-4">
                                {{ $questions->links() }}
                            </div>
                        @else
                            <div class="flex items-center p-4 bg-blue-50 rounded-lg">
                                <svg class="w-5 h-5 text-blue-500 mr-2" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <p class="text-blue-600">Belum ada pertanyaan yang diterima pada profil Ta'aruf Anda.</p>
                            </div>
                        @endif
                    </div>

                    <!-- Sent Questions Tab -->
                    <div x-show="activeTab === 'sent'">
                        @if (count($myQuestions) > 0)
                            <div class="overflow-x-auto">
                                <table class="w-full">
                                    <thead>
                                        <tr class="bg-gray-50">
                                            <th
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Tanggal</th>
                                            <th
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Profil</th>
                                            <th
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Pertanyaan</th>
                                            <th
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Jawaban</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @foreach ($myQuestions as $myQuestion)
                                            <tr class="hover:bg-gray-50">
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                    {{ $myQuestion->created_at->format('d M Y') }}
                                                </td>
                                                <td class="px-6 py-4 text-sm text-gray-500">
                                                    <a href="{{ route('taaruf.profile.show', $myQuestion->profile->id) }}"
                                                        class="text-green-600 hover:text-green-700">
                                                        {{ $myQuestion->profile->user->name }}
                                                    </a>
                                                </td>
                                                <td class="px-6 py-4 text-sm text-gray-500">
                                                    {{ $myQuestion->question }}
                                                </td>
                                                <td class="px-6 py-4 text-sm text-gray-500">
                                                    @if ($myQuestion->is_answered)
                                                        {{ $myQuestion->answer }}
                                                    @else
                                                        <span
                                                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                                            Belum dijawab
                                                        </span>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="flex items-center p-4 bg-blue-50 rounded-lg">
                                <svg class="w-5 h-5 text-blue-500 mr-2" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <p class="text-blue-600">Anda belum mengajukan pertanyaan kepada profil Ta'aruf lain.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>


    </div>
@endsection
