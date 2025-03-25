@extends('admin.layouts.app')

@section('title', 'Manajemen Taaruf')

@section('content')
    <div class="py-6 px-4">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-semibold text-gray-800">Manajemen Profil Taaruf</h1>
            <a href="{{ route('admin.taaruf.statistics') }}"
                class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded">
                <i class="fas fa-chart-bar mr-2"></i>Statistik
            </a>
            <a href="{{ route('admin.taaruf.questions.index') }}"
                class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded">
                <i class="fas fa-chart-bar mr-2"></i>pertanyaan taaruf
            </a>
        </div>

        <!-- Filter Section -->
        <div class="bg-white rounded-lg shadow-md p-4 mb-6">
            <h2 class="text-lg font-medium mb-4">Filter</h2>
            <form action="{{ route('admin.taaruf.index') }}" method="GET" class="flex flex-wrap gap-4">
                <div class="w-full md:w-auto">
                    <label for="gender" class="block text-xs font-medium text-gray-700 mb-1">Jenis Kelamin</label>
                    <select name="gender" id="gender"
                        class="w-full md:w-48 rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                        <option value="">Semua</option>
                        <option value="male" {{ request('gender') == 'male' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="female" {{ request('gender') == 'female' ? 'selected' : '' }}>Perempuan</option>
                        <option value="gender_mismatch" {{ request('gender') == 'gender_mismatch' ? 'selected' : '' }}>Tidak
                            Cocok
                        </option>
                    </select>
                </div>
                <div class="w-full md:w-auto">
                    <label for="status" class="block text-xs font-medium text-gray-700 mb-1">Status</label>
                    <select name="status" id="status"
                        class="w-full md:w-48 rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                        <option value="">Semua</option>
                        <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Aktif</option>
                        <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Tidak Aktif
                        </option>
                    </select>
                </div>
                <div class="w-full md:w-auto flex items-end">
                    <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded">
                        Filter
                    </button>
                    <a href="{{ route('admin.taaruf.index') }}"
                        class="ml-2 bg-gray-200 hover:bg-gray-300 text-gray-700 py-2 px-4 rounded">
                        Reset
                    </a>
                </div>
            </form>
        </div>

        <!-- Profiles Table -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Nama
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Jenis Kelamin
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Usia
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Pekerjaan
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Status
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Proses Taaruf
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Aksi
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($profiles as $profile)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    @if ($profile->photo_url)
                                        <div class="flex-shrink-0 h-10 w-10">
                                            <img class="h-10 w-10 rounded-full object-cover" src="{{ $profile->photo_url }}"
                                                alt="{{ $profile->full_name }}">
                                        </div>
                                    @else
                                        <div
                                            class="flex-shrink-0 h-10 w-10 bg-gray-200 rounded-full flex items-center justify-center">
                                            <svg class="h-6 w-6 text-gray-400" fill="currentColor" viewBox="0 0 24 24">
                                                <path
                                                    d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z" />
                                            </svg>
                                        </div>
                                    @endif
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">
                                            {{ $profile->full_name }}
                                        </div>
                                        <div class="text-xs text-gray-500">
                                            {{ $profile->user->email }}
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span
                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $profile->gender === 'male' ? 'bg-blue-100 text-blue-800' : 'bg-pink-100 text-pink-800' }}">
                                    {{ $profile->gender === 'male' ? 'Laki-laki' : 'Perempuan' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-xs text-gray-500">
                                {{ $profile->birth_place_date }}
                            </td>
                            <td class="px-6 py-4 text-xs text-gray-500 text-wrap">
                                {{ $profile->occupation }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span
                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $profile->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    {{ $profile->is_active ? 'Aktif' : 'Tidak Aktif' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span
                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $profile->is_in_taaruf_process ? 'bg-yellow-100 text-yellow-800' : 'bg-gray-100 text-gray-800' }}">
                                    {{ $profile->is_in_taaruf_process ? 'Sedang Proses' : 'Tidak Dalam Proses' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-xs font-medium">
                                <div class="flex space-x-2">
                                    <a href="{{ route('admin.taaruf.show', $profile->id) }}"
                                        class="text-blue-600 hover:text-blue-900">
                                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                    </a>
                                    <a href="{{ route('admin.taaruf.edit', $profile->id) }}"
                                        class="text-indigo-600 hover:text-indigo-900">
                                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                    </a>
                                    <form action="{{ route('admin.taaruf.toggle-active', $profile->id) }}" method="POST"
                                        class="inline">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit"
                                            class="{{ $profile->is_active ? 'text-red-600 hover:text-red-900' : 'text-green-600 hover:text-green-900' }}">
                                            @if ($profile->is_active)
                                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                                    stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                            @else
                                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                                    stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                            @endif
                                        </button>
                                    </form>
                                    <form action="{{ route('admin.taaruf.destroy', $profile->id) }}" method="POST"
                                        class="inline"
                                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus profil ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900">
                                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                                stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-4 whitespace-nowrap text-xs text-gray-500 text-center">
                                Tidak ada profil taaruf yang ditemukan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-4">
            {{ $profiles->links() }}
        </div>
    </div>
@endsection
