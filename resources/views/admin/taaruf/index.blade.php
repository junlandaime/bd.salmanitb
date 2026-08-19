@extends('admin.layouts.app')

@section('title', 'Manajemen Taaruf - Admin Panel')

@section('content')
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
        
        <!-- Header -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Manajemen Profil Ta'aruf</h1>
                <p class="text-sm text-gray-500 mt-1">Kelola data peserta, verifikasi profil biodata, dan monitoring proses ta'aruf.</p>
            </div>
            <div class="flex items-center gap-2">
                <a href="{{ route('admin.taaruf.statistics') }}"
                    class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl border border-gray-300 bg-white text-gray-700 font-semibold text-sm hover:bg-gray-50 shadow-sm transition">
                    <svg class="w-4 h-4 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                    </svg>
                    Statistik
                </a>
                <a href="{{ route('admin.taaruf.questions.index') }}"
                    class="inline-flex items-center gap-2 bg-pink-600 hover:bg-pink-700 text-white px-4 py-2.5 rounded-xl font-semibold text-sm shadow-sm transition">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Pertanyaan
                </a>
            </div>
        </div>

        <!-- Filter Card -->
        <div class="bg-white rounded-2xl border border-gray-200/80 shadow-sm p-5 mb-8">
            <form action="{{ route('admin.taaruf.index') }}" method="GET" class="space-y-4">
                
                <!-- Top Row: Search (Full Width) -->
                <div>
                    <label for="search" class="block text-xs font-semibold text-gray-700 mb-1">Cari Profil</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-gray-400">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                        <input type="text" name="search" id="search" value="{{ request('search') }}"
                            placeholder="Nama lengkap, email, atau pekerjaan..."
                            class="w-full pl-10 pr-4 py-2 text-sm border border-gray-300 rounded-xl focus:ring-2 focus:ring-pink-500 focus:border-pink-500 transition">
                    </div>
                </div>

                <!-- Grid of Filters (6 columns on desktop) -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-6 gap-4">
                    
                    <!-- Gender Filter -->
                    <div>
                        <label for="gender" class="block text-xs font-semibold text-gray-700 mb-1">Jenis Kelamin</label>
                        <select name="gender" id="gender"
                            class="w-full px-3.5 py-2 text-sm border border-gray-300 rounded-xl focus:ring-2 focus:ring-pink-500 focus:border-pink-500 transition bg-white">
                            <option value="">Semua</option>
                            <option value="male" {{ request('gender') == 'male' ? 'selected' : '' }}>Laki-laki (Ikhwan)</option>
                            <option value="female" {{ request('gender') == 'female' ? 'selected' : '' }}>Perempuan (Akhwat)</option>
                            <option value="gender_mismatch" {{ request('gender') == 'gender_mismatch' ? 'selected' : '' }}>Ketidakcocokan Gender</option>
                        </select>
                    </div>

                    <!-- Status Filter -->
                    <div>
                        <label for="status" class="block text-xs font-semibold text-gray-700 mb-1">Status Akun</label>
                        <select name="status" id="status"
                            class="w-full px-3.5 py-2 text-sm border border-gray-300 rounded-xl focus:ring-2 focus:ring-pink-500 focus:border-pink-500 transition bg-white">
                            <option value="">Semua</option>
                            <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Aktif</option>
                            <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Tidak Aktif</option>
                        </select>
                    </div>

                    <!-- Taaruf Process Filter -->
                    <div>
                        <label for="taaruf_process" class="block text-xs font-semibold text-gray-700 mb-1">Proses Ta'aruf</label>
                        <select name="taaruf_process" id="taaruf_process"
                            class="w-full px-3.5 py-2 text-sm border border-gray-300 rounded-xl focus:ring-2 focus:ring-pink-500 focus:border-pink-500 transition bg-white">
                            <option value="">Semua</option>
                            <option value="in_process" {{ request('taaruf_process') == 'in_process' ? 'selected' : '' }}>Sedang Proses</option>
                            <option value="not_in_process" {{ request('taaruf_process') == 'not_in_process' ? 'selected' : '' }}>Tidak Sedang Proses</option>
                        </select>
                    </div>

                    <!-- Activity Status Filter -->
                    <div>
                        <label for="activity_status" class="block text-xs font-semibold text-gray-700 mb-1">Aktivitas Akun</label>
                        <select name="activity_status" id="activity_status"
                            class="w-full px-3.5 py-2 text-sm border border-gray-300 rounded-xl focus:ring-2 focus:ring-pink-500 focus:border-pink-500 transition bg-white">
                            <option value="">Semua Aktivitas</option>
                            <option value="active_24h" {{ request('activity_status') == 'active_24h' ? 'selected' : '' }}>Aktif 24 Jam Terakhir</option>
                            <option value="active_7d" {{ request('activity_status') == 'active_7d' ? 'selected' : '' }}>Aktif 7 Hari Terakhir</option>
                            <option value="active_30d" {{ request('activity_status') == 'active_30d' ? 'selected' : '' }}>Aktif 30 Hari Terakhir</option>
                        </select>
                    </div>

                    <!-- Sort By Field -->
                    <div>
                        <label for="sort_by" class="block text-xs font-semibold text-gray-700 mb-1">Urutkan Berdasarkan</label>
                        <select name="sort_by" id="sort_by"
                            class="w-full px-3.5 py-2 text-sm border border-gray-300 rounded-xl focus:ring-2 focus:ring-pink-500 focus:border-pink-500 transition bg-white">
                            <option value="last_active" {{ request('sort_by', 'last_active') == 'last_active' ? 'selected' : '' }}>⚡ Terakhir Aktif / Online</option>
                            <option value="created_at" {{ request('sort_by') == 'created_at' ? 'selected' : '' }}>Tanggal Dibuat</option>
                            <option value="full_name" {{ request('sort_by') == 'full_name' ? 'selected' : '' }}>Nama Lengkap</option>
                            <option value="gender" {{ request('sort_by') == 'gender' ? 'selected' : '' }}>Jenis Kelamin</option>
                            <option value="birth_place_date" {{ request('sort_by') == 'birth_place_date' ? 'selected' : '' }}>Tanggal Lahir</option>
                            <option value="occupation" {{ request('sort_by') == 'occupation' ? 'selected' : '' }}>Pekerjaan</option>
                            <option value="is_active" {{ request('sort_by') == 'is_active' ? 'selected' : '' }}>Status Aktif</option>
                            <option value="is_in_taaruf_process" {{ request('sort_by') == 'is_in_taaruf_process' ? 'selected' : '' }}>Proses Ta'aruf</option>
                        </select>
                    </div>

                    <!-- Sort Direction -->
                    <div>
                        <label for="sort_direction" class="block text-xs font-semibold text-gray-700 mb-1">Urutan</label>
                        <select name="sort_direction" id="sort_direction"
                            class="w-full px-3.5 py-2 text-sm border border-gray-300 rounded-xl focus:ring-2 focus:ring-pink-500 focus:border-pink-500 transition bg-white">
                            <option value="desc" {{ request('sort_direction', 'desc') == 'desc' ? 'selected' : '' }}>Menurun (Terbaru / Z-A)</option>
                            <option value="asc" {{ request('sort_direction') == 'asc' ? 'selected' : '' }}>Menaik (Terlama / A-Z)</option>
                        </select>
                    </div>

                </div>

                <!-- Actions -->
                <div class="flex items-center justify-between pt-3 border-t border-gray-100">
                    <div class="flex items-center gap-2">
                        <button type="submit"
                            class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-pink-600 hover:bg-pink-700 text-white font-semibold text-xs transition shadow-sm">
                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                            </svg>
                            Terapkan Filter
                        </button>
                        <a href="{{ route('admin.taaruf.index') }}"
                            class="inline-flex items-center px-4 py-2 rounded-xl bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium text-xs transition">
                            Reset
                        </a>
                    </div>
                    <span class="text-xs text-gray-400">Total: {{ $profiles->total() }} Profil</span>
                </div>
            </form>
        </div>

        <!-- Table Card -->
        <div class="bg-white rounded-2xl border border-gray-200/80 shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-500">
                    <thead class="text-xs text-gray-600 uppercase bg-gray-50/80 border-b border-gray-200">
                        <tr>
                            <th class="px-6 py-3.5">Peserta</th>
                            <th class="px-6 py-3.5">Alumni SPN</th>
                            <th class="px-6 py-3.5">Gender &amp; Usia</th>
                            <th class="px-6 py-3.5">Domisili &amp; Profesi</th>
                            <th class="px-6 py-3.5">Terakhir Aktif</th>
                            <th class="px-6 py-3.5">Status Akun</th>
                            <th class="px-6 py-3.5">Proses Ta'aruf</th>
                            <th class="px-6 py-3.5 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse ($profiles as $profile)
                            @php
                                $age = \App\Helpers\DateHelper::getAgeFromBirthPlaceDate($profile->birth_place_date);
                            @endphp
                            <tr class="hover:bg-gray-50/75 transition">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        @if ($profile->photo_url)
                                            <img class="h-10 w-10 rounded-full object-cover border border-gray-200 shrink-0"
                                                src="{{ $profile->photo_url }}" alt="{{ $profile->full_name }}">
                                        @else
                                            <div class="h-10 w-10 rounded-full bg-gray-100 text-gray-400 flex items-center justify-center text-sm font-bold shrink-0">
                                                👤
                                            </div>
                                        @endif
                                        <div class="min-w-0">
                                            <div class="font-bold text-gray-900 leading-snug">{{ $profile->full_name }}</div>
                                            <div class="text-xs text-gray-400 truncate">{{ $profile->user->email ?? '-' }}</div>
                                            @if($profile->nickname)
                                                <div class="text-[11px] text-pink-600">({{ $profile->nickname }})</div>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    @if ($profile->latest_spn_batch)
                                        <span class="inline-flex items-center gap-1 px-2.5 py-1 text-xs font-semibold rounded-full bg-teal-50 text-teal-800 border border-teal-200">
                                            <span>🎓</span>
                                            <span>{{ $profile->latest_spn_batch }}</span>
                                        </span>
                                    @else
                                        <span class="text-xs text-gray-400">-</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    <div class="space-y-1">
                                        <span class="inline-block px-2 py-0.5 text-[11px] font-semibold rounded-full {{ $profile->gender === 'male' ? 'bg-blue-50 text-blue-700 border border-blue-200' : 'bg-pink-50 text-pink-700 border border-pink-200' }}">
                                            {{ $profile->gender === 'male' ? 'Laki-laki' : 'Perempuan' }}
                                        </span>
                                        <div class="text-xs font-medium text-gray-700">
                                            {{ $age ? $age . ' Tahun' : '-' }}
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-xs">
                                    <div class="text-gray-900 font-medium truncate max-w-[160px]">
                                        📍 {{ $profile->current_residence ?: ($profile->residence_city ?: '-') }}
                                    </div>
                                    <div class="text-gray-500 truncate max-w-[160px] mt-0.5">
                                        💼 {{ $profile->occupation ?: '-' }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-xs whitespace-nowrap">
                                    <div class="inline-flex items-center gap-1.5 font-medium text-gray-700">
                                        <span class="w-2 h-2 rounded-full bg-emerald-500 shrink-0"></span>
                                        <span>{{ $profile->last_active_label }}</span>
                                    </div>
                                    @if($profile->user && $profile->user->last_login_at)
                                        <div class="text-[10px] text-gray-400 mt-0.5">
                                            {{ $profile->user->last_login_at->translatedFormat('d M Y, H:i') }} WIB
                                        </div>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    <span class="px-2.5 py-0.5 text-xs font-semibold rounded-full {{ $profile->is_active ? 'bg-emerald-100 text-emerald-800' : 'bg-gray-100 text-gray-600' }}">
                                        {{ $profile->is_active ? 'Aktif' : 'Nonaktif' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="px-2.5 py-0.5 text-xs font-semibold rounded-full {{ $profile->is_in_taaruf_process ? 'bg-amber-100 text-amber-800' : 'bg-gray-100 text-gray-600' }}">
                                        {{ $profile->is_in_taaruf_process ? 'Sedang Proses' : 'Tidak Dalam Proses' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex items-center justify-end gap-1">
                                        <a href="{{ route('admin.taaruf.show', $profile->id) }}"
                                            class="p-1.5 text-blue-500 hover:text-blue-700 rounded-lg hover:bg-blue-50 transition" title="Lihat Profil">
                                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                        </a>
                                        <a href="{{ route('admin.taaruf.edit', $profile->id) }}"
                                            class="p-1.5 text-gray-400 hover:text-gray-600 rounded-lg hover:bg-gray-100 transition" title="Edit Profil">
                                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                        </a>
                                        <form action="{{ route('admin.taaruf.destroy', $profile->id) }}" method="POST" class="inline"
                                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus profil ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="p-1.5 text-red-400 hover:text-red-600 rounded-lg hover:bg-red-50 transition" title="Hapus Profil">
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
                                <td colspan="8" class="px-6 py-8 text-center text-gray-400">Tidak ada profil ta'aruf yang ditemukan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <div class="px-6 py-4 border-t border-gray-100 bg-gray-50/50">
                {{ $profiles->links() }}
            </div>
        </div>

    </div>
@endsection
