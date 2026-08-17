@extends('admin.layouts.app')

@section('title', 'Pertanyaan Ta\'aruf - Admin Panel')

@php
    use Illuminate\Support\Str;
@endphp

@section('content')
<div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
    
    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
        <div>
            <div class="flex items-center gap-2 text-xs text-gray-500 mb-1">
                <a href="{{ route('admin.taaruf.index') }}" class="hover:text-pink-600">Layanan Ta'aruf</a>
                <span>/</span>
                <span>Pertanyaan Peserta</span>
            </div>
            <h1 class="text-2xl font-bold text-gray-900">Manajemen Pertanyaan Ta'aruf</h1>
            <p class="text-sm text-gray-500 mt-0.5">Pantau interaksi tanya-jawab antar peserta ta'aruf dan kelola status pertanyaannya.</p>
        </div>
        <a href="{{ route('admin.taaruf.index') }}"
            class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl border border-gray-300 bg-white text-gray-700 font-semibold text-sm hover:bg-gray-50 shadow-sm transition">
            &larr; Kembali ke Profil
        </a>
    </div>

    @if (session('success'))
        <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 px-5 py-4 rounded-2xl mb-6 flex items-center justify-between shadow-sm" role="alert">
            <div class="flex items-center gap-2 text-sm font-medium">
                <svg class="w-5 h-5 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
                <span>{{ session('success') }}</span>
            </div>
            <button type="button" onclick="this.parentElement.remove()" class="text-emerald-500 hover:text-emerald-700">✕</button>
        </div>
    @endif

    <!-- Filter Card -->
    <div class="bg-white rounded-2xl border border-gray-200/80 shadow-sm p-5 mb-8">
        <form method="GET" action="{{ route('admin.taaruf.questions.index') }}" class="space-y-4">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                <div>
                    <label for="profile_id" class="block text-xs font-semibold text-gray-700 mb-1">Profil Ditanya</label>
                    <select name="profile_id" id="profile_id"
                        class="w-full px-3.5 py-2 text-sm border border-gray-300 rounded-xl focus:ring-2 focus:ring-pink-500 focus:border-pink-500 transition bg-white">
                        <option value="">Semua Profil</option>
                        @foreach ($profiles as $profile)
                            <option value="{{ $profile->id }}" @selected(request('profile_id') == $profile->id)>
                                {{ $profile->full_name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                @if(isset($askers) && $askers->isNotEmpty())
                    <div>
                        <label for="asked_by_user_id" class="block text-xs font-semibold text-gray-700 mb-1">Penanya</label>
                        <select name="asked_by_user_id" id="asked_by_user_id"
                            class="w-full px-3.5 py-2 text-sm border border-gray-300 rounded-xl focus:ring-2 focus:ring-pink-500 focus:border-pink-500 transition bg-white">
                            <option value="">Semua Penanya</option>
                            @foreach ($askers as $asker)
                                <option value="{{ $asker->id }}" @selected(request('asked_by_user_id') == $asker->id)>
                                    {{ $asker->taarufProfile->full_name ?? $asker->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                @endif

                <div>
                    <label for="answered" class="block text-xs font-semibold text-gray-700 mb-1">Status Jawaban</label>
                    <select name="answered" id="answered"
                        class="w-full px-3.5 py-2 text-sm border border-gray-300 rounded-xl focus:ring-2 focus:ring-pink-500 focus:border-pink-500 transition bg-white">
                        <option value="">Semua Status</option>
                        <option value="1" @selected(request('answered') === '1')>Sudah Dijawab</option>
                        <option value="0" @selected(request('answered') === '0')>Belum Dijawab</option>
                    </select>
                </div>

                <div>
                    <label for="per_page" class="block text-xs font-semibold text-gray-700 mb-1">Baris per Halaman</label>
                    <select name="per_page" id="per_page"
                        class="w-full px-3.5 py-2 text-sm border border-gray-300 rounded-xl focus:ring-2 focus:ring-pink-500 focus:border-pink-500 transition bg-white">
                        @foreach ([10, 25, 50, 100] as $size)
                            <option value="{{ $size }}" @selected($perPage === $size)>{{ $size }} baris</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="flex items-center justify-between pt-2 border-t border-gray-100">
                <div class="flex items-center gap-2">
                    <button type="submit"
                        class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-pink-600 hover:bg-pink-700 text-white font-semibold text-xs transition shadow-sm">
                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                        </svg>
                        Terapkan Filter
                    </button>
                    <a href="{{ route('admin.taaruf.questions.index') }}"
                        class="inline-flex items-center px-4 py-2 rounded-xl bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium text-xs transition">
                        Reset
                    </a>
                </div>
                <span class="text-xs text-gray-400">Total: {{ $questions->total() }} Pertanyaan</span>
            </div>
        </form>
    </div>

    <!-- Questions Table Card -->
    <div class="bg-white rounded-2xl border border-gray-200/80 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-500">
                <thead class="text-xs text-gray-600 uppercase bg-gray-50/80 border-b border-gray-200">
                    <tr>
                        <th class="px-5 py-3.5 w-12 text-center">No</th>
                        <th class="px-5 py-3.5 whitespace-nowrap">Tanggal</th>
                        <th class="px-5 py-3.5">Profil Ditanya</th>
                        <th class="px-5 py-3.5">Penanya</th>
                        <th class="px-5 py-3.5">Pertanyaan</th>
                        <th class="px-5 py-3.5">Jawaban</th>
                        <th class="px-5 py-3.5 text-right whitespace-nowrap">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse ($questions as $question)
                        <tr class="hover:bg-gray-50/75 transition align-top">
                            <td class="px-5 py-4 text-center text-xs text-gray-400 font-mono">
                                {{ $questions->firstItem() ? $questions->firstItem() + $loop->index : $loop->iteration }}
                            </td>
                            <td class="px-5 py-4 whitespace-nowrap text-xs text-gray-600">
                                {{ $question->created_at->format('d M Y, H:i') }}
                            </td>
                            <td class="px-5 py-4 whitespace-nowrap font-medium">
                                @if ($question->profile)
                                    <a href="{{ route('admin.taaruf.show', $question->profile_id) }}" class="text-pink-600 hover:text-pink-800 font-semibold">
                                        {{ $question->profile->full_name }}
                                    </a>
                                @else
                                    <span class="text-gray-400">-</span>
                                @endif
                            </td>
                            <td class="px-5 py-4 whitespace-nowrap text-xs text-gray-600">
                                @if ($question->askedBy && $question->askedBy->taarufProfile)
                                    <a href="{{ route('admin.taaruf.show', $question->askedBy->taarufProfile->id) }}" class="text-gray-900 font-semibold hover:text-pink-600">
                                        {{ $question->askedBy->taarufProfile->full_name }}
                                    </a>
                                @elseif($question->askedBy)
                                    <span class="text-gray-800">{{ $question->askedBy->name }}</span>
                                @else
                                    <span class="text-gray-400">Anonim</span>
                                @endif

                                @if ($question->is_anonymous)
                                    <span class="ml-1.5 px-2 py-0.5 rounded-full text-[10px] font-semibold bg-gray-100 text-gray-600 inline-block">
                                        Anonim
                                    </span>
                                @endif
                            </td>

                            <!-- Pertanyaan with expand/collapse -->
                            <td class="px-5 py-4 text-xs text-gray-800 max-w-xs sm:max-w-sm">
                                @if(mb_strlen($question->question) > 90)
                                    <div x-data="{ expanded: false }">
                                        <p class="leading-relaxed" x-show="!expanded">{{ Str::limit($question->question, 90) }}</p>
                                        <p class="leading-relaxed whitespace-pre-line" x-show="expanded" x-cloak>{{ $question->question }}</p>
                                        <button type="button" @click="expanded = !expanded"
                                            class="mt-1 text-[11px] font-semibold text-emerald-600 hover:text-emerald-700 focus:outline-none inline-flex items-center gap-1 transition">
                                            <span x-text="expanded ? 'Tampilkan lebih sedikit' : 'Selengkapnya'"></span>
                                        </button>
                                    </div>
                                @else
                                    <p class="leading-relaxed whitespace-pre-line">{{ $question->question }}</p>
                                @endif
                            </td>

                            <!-- Jawaban with expand/collapse -->
                            <td class="px-5 py-4 text-xs max-w-xs sm:max-w-sm">
                                @if ($question->answer)
                                    @if(mb_strlen($question->answer) > 90)
                                        <div x-data="{ expanded: false }">
                                            <div class="text-emerald-800 leading-relaxed" x-show="!expanded">
                                                {{ Str::limit($question->answer, 90) }}
                                            </div>
                                            <div class="text-emerald-800 leading-relaxed whitespace-pre-line" x-show="expanded" x-cloak>
                                                {{ $question->answer }}
                                            </div>
                                            <button type="button" @click="expanded = !expanded"
                                                class="mt-1 text-[11px] font-semibold text-emerald-600 hover:text-emerald-700 focus:outline-none inline-flex items-center gap-1 transition">
                                                <span x-text="expanded ? 'Tampilkan lebih sedikit' : 'Selengkapnya'"></span>
                                            </button>
                                        </div>
                                    @else
                                        <div class="text-emerald-800 leading-relaxed whitespace-pre-line">
                                            {{ $question->answer }}
                                        </div>
                                    @endif
                                    <span class="inline-block mt-1.5 text-[10px] text-gray-400">
                                        Dijawab: {{ $question->answered_at ? $question->answered_at->format('d M Y') : '-' }}
                                    </span>
                                @else
                                    <span class="px-2.5 py-0.5 rounded-full text-[10px] font-semibold bg-amber-50 text-amber-700 border border-amber-200 inline-block">
                                        Belum dijawab
                                    </span>
                                @endif
                            </td>

                            <!-- Aksi Column -->
                            <td class="px-5 py-4 text-right whitespace-nowrap">
                                <div class="flex items-center justify-end gap-1">
                                    <!-- View Details -->
                                    <a href="{{ route('admin.taaruf.questions.show', $question->id) }}"
                                        class="p-1.5 text-blue-500 hover:text-blue-700 rounded-lg hover:bg-blue-50 transition"
                                        title="Lihat Detail Pertanyaan">
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                    </a>

                                    <!-- Delete Question -->
                                    <form action="{{ route('admin.taaruf.questions.destroy', $question->id) }}" method="POST" class="inline"
                                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus pertanyaan ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-1.5 text-red-400 hover:text-red-600 rounded-lg hover:bg-red-50 transition" title="Hapus Pertanyaan">
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
                            <td colspan="7" class="px-6 py-12 text-center text-gray-400 text-sm">
                                Belum ada riwayat pertanyaan ta'aruf yang sesuai filter.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($questions->hasPages())
            <div class="p-4 border-t border-gray-100 bg-gray-50/50">
                {{ $questions->links() }}
            </div>
        @endif
    </div>

</div>
@endsection
