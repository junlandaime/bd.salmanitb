@extends('admin.layouts.app')
@section('title', 'Manajemen Pengguna - Admin Panel')

@section('content')
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
        
        <!-- Header -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Manajemen Pengguna</h1>
                <p class="text-sm text-gray-500 mt-1">Kelola akun administrator, staf, dan pengguna terdaftar.</p>
            </div>
            <a href="{{ route('admin.users.create') }}"
                class="inline-flex items-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white px-4 py-2.5 rounded-xl font-semibold text-sm shadow-sm transition">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Tambah Pengguna Baru
            </a>
        </div>

        @if (session('success'))
            <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 px-4 py-3 rounded-xl mb-6 flex items-center justify-between shadow-sm" role="alert">
                <span class="text-sm font-medium">{{ session('success') }}</span>
                <button type="button" onclick="this.parentElement.remove()" class="text-emerald-500 hover:text-emerald-700">✕</button>
            </div>
        @endif

        <!-- Filter Card -->
        <div class="bg-white rounded-2xl border border-gray-200/80 shadow-sm p-5 mb-8">
            <form action="{{ route('admin.users.index') }}" method="GET" class="space-y-4">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                    <!-- Search -->
                    <div>
                        <label for="search" class="block text-xs font-semibold text-gray-700 mb-1">Cari Pengguna</label>
                        <input type="text" name="search" id="search"
                            class="w-full px-3.5 py-2 text-sm border border-gray-300 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition"
                            placeholder="Nama atau email..." value="{{ request('search') }}">
                    </div>

                    <!-- Role Filter -->
                    <div>
                        <label for="role" class="block text-xs font-semibold text-gray-700 mb-1">Role / Peran</label>
                        <select name="role" id="role"
                            class="w-full px-3.5 py-2 text-sm border border-gray-300 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition bg-white">
                            <option value="">Semua Role</option>
                            @foreach ($roles as $role)
                                <option value="{{ $role->name }}" {{ request('role') == $role->name ? 'selected' : '' }}>
                                    {{ ucfirst($role->name) }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Date From -->
                    <div>
                        <label for="date_from" class="block text-xs font-semibold text-gray-700 mb-1">Dari Tanggal</label>
                        <input type="date" name="date_from" id="date_from"
                            class="w-full px-3.5 py-2 text-sm border border-gray-300 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition bg-white"
                            value="{{ request('date_from') }}">
                    </div>

                    <!-- Date To -->
                    <div>
                        <label for="date_to" class="block text-xs font-semibold text-gray-700 mb-1">Sampai Tanggal</label>
                        <input type="date" name="date_to" id="date_to"
                            class="w-full px-3.5 py-2 text-sm border border-gray-300 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition bg-white"
                            value="{{ request('date_to') }}">
                    </div>
                </div>

                <div class="flex items-center justify-between pt-2 border-t border-gray-100">
                    <div class="flex items-center gap-2">
                        <button type="submit"
                            class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-semibold text-xs transition shadow-sm">
                            Terapkan Filter
                        </button>
                        <a href="{{ route('admin.users.index') }}"
                            class="inline-flex items-center px-4 py-2 rounded-xl bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium text-xs transition">
                            Reset
                        </a>
                    </div>
                </div>
            </form>
        </div>

        <!-- Table Card -->
        <div class="bg-white rounded-2xl border border-gray-200/80 shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-500">
                    <thead class="text-xs text-gray-600 uppercase bg-gray-50/80 border-b border-gray-200">
                        <tr>
                            <th class="px-6 py-3.5">Nama &amp; Avatar</th>
                            <th class="px-6 py-3.5">Email</th>
                            <th class="px-6 py-3.5">Roles</th>
                            <th class="px-6 py-3.5">Tanggal Bergabung</th>
                            <th class="px-6 py-3.5 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($users as $user)
                            <tr class="hover:bg-gray-50/75 transition">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <img class="h-9 w-9 rounded-full border border-gray-200"
                                            src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=EBF8F2&color=047857"
                                            alt="{{ $user->name }}">
                                        <div class="font-bold text-gray-900">{{ $user->name }}</div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 font-mono text-xs text-gray-600">{{ $user->email }}</td>
                                <td class="px-6 py-4">
                                    <div class="flex flex-wrap gap-1">
                                        @forelse ($user->roles as $role)
                                            @php
                                                $badgeClass = match($role->name) {
                                                    'superAdmin' => 'bg-indigo-100 text-indigo-800 border-indigo-300 font-bold',
                                                    'admin' => 'bg-purple-100 text-purple-800 border-purple-200',
                                                    'admin_spn' => 'bg-amber-100 text-amber-800 border-amber-200 font-semibold',
                                                    'admin_taaruf' => 'bg-pink-100 text-pink-800 border-pink-200 font-semibold',
                                                    'author' => 'bg-blue-100 text-blue-800 border-blue-200',
                                                    'alumni' => 'bg-emerald-100 text-emerald-800 border-emerald-200',
                                                    default => 'bg-gray-100 text-gray-700 border-gray-200'
                                                };
                                            @endphp
                                            <span class="inline-flex items-center px-2 py-0.5 rounded-md text-[11px] border {{ $badgeClass }}">
                                                {{ $role->name }}
                                            </span>
                                        @empty
                                            <span class="inline-flex items-center px-2 py-0.5 rounded-md text-[11px] text-gray-400 bg-gray-50 border border-gray-200">
                                                Peserta (Tanpa Role)
                                            </span>
                                        @endforelse
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-xs text-gray-500">
                                    {{ $user->created_at->format('d M Y') }}
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex items-center justify-end gap-1">
                                        <a href="{{ route('admin.users.edit', $user) }}"
                                            class="p-1.5 text-gray-400 hover:text-gray-600 rounded-lg hover:bg-gray-100 transition" title="Edit Pengguna">
                                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                        </a>
                                        <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="inline"
                                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus pengguna ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="p-1.5 text-red-400 hover:text-red-600 rounded-lg hover:bg-red-50 transition" title="Hapus Pengguna">
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
                                <td colspan="5" class="px-6 py-8 text-center text-gray-400">Tidak ada pengguna ditemukan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <div class="px-6 py-4 border-t border-gray-100 bg-gray-50/50">
                {{ $users->links() }}
            </div>
        </div>

    </div>
@endsection
