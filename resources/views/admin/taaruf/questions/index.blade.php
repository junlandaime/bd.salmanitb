@extends('admin.layouts.app')

@section('title', 'Manajemen Pertanyaan Ta\'aruf')

@php
    use Illuminate\Support\Str;
@endphp


@section('content')
    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-2xl font-semibold text-gray-900">Manajemen Pertanyaan Ta'aruf</h1>

            <div class="mt-6 bg-white shadow rounded-lg">
                <div class="px-4 py-5 border-b border-gray-200 sm:px-6 flex justify-between items-center">
                    <h3 class="text-lg font-medium leading-6 text-gray-900">Daftar Pertanyaan Ta'aruf</h3>
                </div>
                <div class="p-6">
                    @if (session('success'))
                        <div class="mb-4 bg-green-50 border-l-4 border-green-400 p-4">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <svg class="h-5 w-5 text-green-400" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm text-green-700">{{ session('success') }}</p>
                                </div>
                                <div class="ml-auto pl-3">
                                    <div class="-mx-1.5 -my-1.5">
                                        <button type="button"
                                            class="inline-flex bg-green-50 rounded-md p-1.5 text-green-500 hover:bg-green-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-600">
                                            <span class="sr-only">Dismiss</span>
                                            <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                fill="currentColor">
                                                <path fill-rule="evenodd"
                                                    d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="mb-4 bg-red-50 border-l-4 border-red-400 p-4">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <svg class="h-5 w-5 text-red-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                        fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm text-red-700">{{ session('error') }}</p>
                                </div>
                                <div class="ml-auto pl-3">
                                    <div class="-mx-1.5 -my-1.5">
                                        <button type="button"
                                            class="inline-flex bg-red-50 rounded-md p-1.5 text-red-500 hover:bg-red-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-600">
                                            <span class="sr-only">Dismiss</span>
                                            <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                fill="currentColor">
                                                <path fill-rule="evenodd"
                                                    d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    <form method="GET" action="{{ route('admin.taaruf.questions.index') }}"
                        class="grid grid-cols-1 gap-4 md:grid-cols-5 mb-6">
                        <div>
                            <label for="profile_id" class="block text-sm font-medium text-gray-700">Profil Ditanya</label>
                            <select name="profile_id" id="profile_id"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500">
                                <option value="">Semua Profil</option>
                                @foreach ($profiles as $profile)
                                    <option value="{{ $profile->id }}" @selected(request('profile_id') == $profile->id)>
                                        {{ $profile->full_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="asked_by_user_id" class="block text-sm font-medium text-gray-700">Penanya</label>
                            <select name="asked_by_user_id" id="asked_by_user_id"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500">
                                <option value="">Semua Penanya</option>
                                @foreach ($askers as $asker)
                                    <option value="{{ $asker->id }}" @selected(request('asked_by_user_id') == $asker->id)>
                                        {{ optional($asker->taarufProfile)->full_name ?? $asker->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="answered" class="block text-sm font-medium text-gray-700">Status Jawaban</label>
                            <select name="answered" id="answered"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500">
                                <option value="">Semua Status</option>
                                <option value="1" @selected(request('answered') === '1')>Sudah Dijawab</option>
                                <option value="0" @selected(request('answered') === '0')>Belum Dijawab</option>
                            </select>
                        </div>
                        <div>
                            <label for="per_page" class="block text-sm font-medium text-gray-700">Jumlah per Halaman</label>
                            <select name="per_page" id="per_page"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500">
                                @foreach ([10, 25, 50, 100] as $size)
                                    <option value="{{ $size }}" @selected($perPage === $size)>{{ $size }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="flex items-end space-x-2">
                            <button type="submit"
                                class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">Terapkan</button>
                            <a href="{{ route('admin.taaruf.questions.index') }}"
                                class="inline-flex justify-center py-2 px-4 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">Reset</a>
                        </div>
                    </form>

                    <div class="mb-4 text-sm text-gray-600">
                        Menampilkan <span class="font-semibold">{{ $questions->count() }}</span> dari
                        <span class="font-semibold">{{ $questions->total() }}</span> pertanyaan
                    </div>



                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-12">
                                        No</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Tanggal</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Profil</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Penanya</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Pertanyaan</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Jawaban</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-20">
                                        Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                {{-- @foreach ($questions as $index => $question) --}}
                                @forelse ($questions as $question)
                                    <tr>
                                        {{-- <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $index + 1 }} --}}
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $questions->firstItem() ? $questions->firstItem() + $loop->index : $loop->iteration }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $question->created_at->format('d M Y H:i') }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            {{-- <a href="{{ route('admin.taaruf.show', $question->profile_id) }}"
                                                class="text-blue-600 hover:text-blue-900">
                                                {{ $question->profile->full_name }}
                                            </a> --}}
                                            @if ($question->profile)
                                                <a href="{{ route('admin.taaruf.show', $question->profile_id) }}"
                                                    class="text-blue-600 hover:text-blue-900">
                                                    {{ $question->profile->full_name }}
                                                </a>
                                            @else
                                                <span class="text-gray-400">Profil tidak tersedia</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{-- <a href="{{ route('admin.taaruf.show', $question->askedBy->taarufProfile->id) }}"
                                                class="text-blue-600 hover:text-blue-900">
                                                {{ $question->askedBy->taarufProfile->full_name }}
                                            </a>
                                            @if ($question->asked_by_user)
                                                {{ $question->asked_by_user->name }}
                                                @if ($question->is_anonymous)
                                                    <span
                                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                        Anonim
                                                    </span>
                                                @endif --}}
                                            @if ($question->askedBy && $question->askedBy->taarufProfile)
                                                <a href="{{ route('admin.taaruf.show', $question->askedBy->taarufProfile->id) }}"
                                                    class="text-blue-600 hover:text-blue-900">
                                                    {{ $question->askedBy->taarufProfile->full_name }}
                                                </a>
                                            @elseif($question->askedBy)
                                                {{ $question->askedBy->name }}
                                            @else
                                                <span class="text-gray-400">Tidak diketahui</span>
                                            @endif
                                            @if ($question->is_anonymous)
                                                <span
                                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 ml-2">
                                                    Anonim
                                                </span>
                                            @endif
                                        </td>
                                        @php
                                            $questionFull = $question->question ?? '';
                                            $questionLimit = 160;
                                            $shouldToggleQuestion = Str::length($questionFull) > $questionLimit;
                                            $questionShort = $shouldToggleQuestion
                                                ? Str::limit($questionFull, $questionLimit)
                                                : $questionFull;
                                        @endphp
                                        <td class="px-6 py-4 text-sm text-gray-500">
                                            <div>
                                                <div id="question-text-{{ $question->id }}" class="whitespace-pre-line"
                                                    data-short="{{ e($questionShort) }}"
                                                    data-full="{{ e($questionFull) }}" data-expanded="false">
                                                    {{ $questionShort }}
                                                </div>
                                                @if ($shouldToggleQuestion)
                                                    <button type="button"
                                                        class="mt-2 text-sm text-emerald-600 hover:text-emerald-800 focus:outline-none"
                                                        data-toggle-text data-target="question-text-{{ $question->id }}"
                                                        data-collapsed-label="Selengkapnya"
                                                        data-expanded-label="Tampilkan lebih sedikit"
                                                        aria-expanded="false"
                                                        aria-controls="question-text-{{ $question->id }}">
                                                        Selengkapnya
                                                    </button>
                                                @endif
                                            </div>
                                        </td>
                                        {{-- <td class="px-6 py-4 text-sm text-gray-500">{{ $question->question }}</td> --}}
                                        <td class="px-6 py-4 text-sm text-gray-500">
                                            @if ($question->is_answered)
                                                {{-- {{ $question->answer }} --}}
                                                @php
                                                    $answerFull = $question->answer ?? '';
                                                    $answerLimit = 160;
                                                    $shouldToggleAnswer = Str::length($answerFull) > $answerLimit;
                                                    $answerShort = $shouldToggleAnswer
                                                        ? Str::limit($answerFull, $answerLimit)
                                                        : $answerFull;
                                                @endphp
                                                <div>
                                                    <div id="answer-text-{{ $question->id }}" class="whitespace-pre-line"
                                                        data-short="{{ e($answerShort) }}"
                                                        data-full="{{ e($answerFull) }}" data-expanded="false">
                                                        {{ $answerShort }}
                                                    </div>
                                                    @if ($shouldToggleAnswer)
                                                        <button type="button"
                                                            class="mt-2 text-sm text-emerald-600 hover:text-emerald-800 focus:outline-none"
                                                            data-toggle-text data-target="answer-text-{{ $question->id }}"
                                                            data-collapsed-label="Selengkapnya"
                                                            data-expanded-label="Tampilkan lebih sedikit"
                                                            aria-expanded="false"
                                                            aria-controls="answer-text-{{ $question->id }}">
                                                            Selengkapnya
                                                        </button>
                                                    @endif
                                                </div>
                                            @else
                                                <span
                                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                                    Belum dijawab
                                                </span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <div class="flex space-x-2">
                                                <a href="{{ route('admin.taaruf.questions.show', $question->id) }}"
                                                    class="text-blue-600 hover:text-blue-900">
                                                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg"
                                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                    </svg>
                                                </a>
                                                <form
                                                    action="{{ route('admin.taaruf.questions.destroy', $question->id) }}"
                                                    method="POST" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-600 hover:text-red-900"
                                                        onclick="return confirm('Apakah Anda yakin ingin menghapus pertanyaan ini?')">
                                                        <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg"
                                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                        </svg>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    {{-- @endforeach --}}
                                @empty
                                    <tr>
                                        <td colspan="7"
                                            class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">Tidak ada
                                            pertanyaan yang ditemukan.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-6">
                        {{ $questions->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('[data-toggle-text]').forEach(function(button) {
                const targetId = button.getAttribute('data-target');
                const target = document.getElementById(targetId);

                if (!target) {
                    return;
                }

                const shortText = target.getAttribute('data-short') || '';
                const fullText = target.getAttribute('data-full') || '';
                const collapsedLabel = button.getAttribute('data-collapsed-label') || 'Selengkapnya';
                const expandedLabel = button.getAttribute('data-expanded-label') ||
                    'Tampilkan lebih sedikit';

                if (!shortText || !fullText || shortText === fullText) {
                    button.classList.add('hidden');
                    return;
                }

                target.textContent = shortText;
                target.setAttribute('data-expanded', 'false');
                button.textContent = collapsedLabel;
                button.setAttribute('aria-expanded', 'false');

                button.addEventListener('click', function() {
                    const isExpanded = target.getAttribute('data-expanded') === 'true';

                    if (isExpanded) {
                        target.textContent = shortText;
                        target.setAttribute('data-expanded', 'false');
                        button.textContent = collapsedLabel;
                        button.setAttribute('aria-expanded', 'false');
                    } else {
                        target.textContent = fullText;
                        target.setAttribute('data-expanded', 'true');
                        button.textContent = expandedLabel;
                        button.setAttribute('aria-expanded', 'true');
                    }
                });
            });
        });
    </script>
@endpush
