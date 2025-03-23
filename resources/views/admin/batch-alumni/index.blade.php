@extends('admin.layouts.app')

@section('title', 'Kelola Alumni')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Kelola Alumni</h1>
            <a href="{{ route('admin.batch-alumni.create') }}"
                class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
                Tambah Alumni
            </a>
        </div>

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

        <!-- Filter -->
        <div class="bg-white rounded-lg shadow-md p-6 mb-6">
            <form action="{{ route('admin.batch-alumni.index') }}" method="GET" class="space-y-4">
                <div class="flex flex-wrap items-end space-x-0 md:space-x-4 space-y-4 md:space-y-0">
                    <!-- Search field -->
                    <div class="w-full md:w-1/3">
                        <label for="search" class="block text-sm font-medium text-gray-700 mb-1">Search Alumni</label>
                        <input type="text" name="search" id="search" value="{{ request('search') }}"
                            placeholder="Search by name or email..."
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50">
                    </div>

                    <!-- Batch filter -->
                    <div class="w-full md:w-1/3">
                        <label for="batch_id" class="block text-sm font-medium text-gray-700 mb-1">Filter by Batch</label>
                        <select name="batch_id" id="batch_id"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50">
                            <option value="">All Batches</option>
                            @foreach ($batches as $batch)
                                <option value="{{ $batch->id }}"
                                    {{ request('batch_id') == $batch->id ? 'selected' : '' }}>
                                    {{ $batch->activity->nama_kegiatan }} - {{ $batch->nama_batch }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Sort options -->
                    <div class="w-full md:w-1/4">
                        <label for="sort_by" class="block text-sm font-medium text-gray-700 mb-1">Sort By</label>
                        <select name="sort_by" id="sort_by"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50">
                            <option value="name_asc" {{ request('sort_by') == 'name_asc' ? 'selected' : '' }}>Name (A-Z)
                            </option>
                            <option value="name_desc" {{ request('sort_by') == 'name_desc' ? 'selected' : '' }}>Name (Z-A)
                            </option>
                            <option value="batch_asc" {{ request('sort_by') == 'batch_asc' ? 'selected' : '' }}>Batch
                                (Oldest first)</option>
                            <option value="batch_desc" {{ request('sort_by') == 'batch_desc' ? 'selected' : '' }}>Batch
                                (Newest first)</option>
                            <option value="created_at_desc"
                                {{ request('sort_by') == 'created_at_desc' || !request('sort_by') ? 'selected' : '' }}>
                                Recent first</option>
                            <option value="created_at_asc" {{ request('sort_by') == 'created_at_asc' ? 'selected' : '' }}>
                                Oldest first</option>
                        </select>
                    </div>
                </div>

                <!-- Duplicate names filter checkbox -->
                <div class="flex items-center mt-4">
                    <input type="checkbox" name="duplicate_names" id="duplicate_names" value="1"
                        {{ request('duplicate_names') == '1' ? 'checked' : '' }}
                        class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                    <label for="duplicate_names" class="ml-2 block text-sm text-gray-700">
                        Show only alumni appearing in multiple batches
                    </label>
                </div>

                <div class="flex mt-4">
                    <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
                        Apply Filters
                    </button>
                    <a href="{{ route('admin.batch-alumni.index') }}"
                        class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded ml-2">
                        Reset
                    </a>
                </div>
            </form>
        </div>

        <!-- Alumni List -->
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
                            Email
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Batch
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Instagram
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Gender
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Aksi
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($batchAlumni as $alumni)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">{{ $alumni->user->name }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-500">{{ $alumni->user->email }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $alumni->activityBatch->activity->nama_kegiatan }}
                                </div>
                                <div class="text-xs text-gray-500">{{ $alumni->activityBatch->nama_batch }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-500">{{ $alumni->instagram_account ?: '-' }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-500">{{ $alumni->gender ?: '-' }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <a href="{{ route('admin.batch-alumni.edit', $alumni->id) }}"
                                    class="text-blue-600 hover:text-blue-900 mr-3">Edit</a>
                                <form action="{{ route('admin.batch-alumni.destroy', $alumni->id) }}" method="POST"
                                    class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900"
                                        onclick="return confirm('Are you sure you want to delete this alumni?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-4 whitespace-nowrap text-center text-gray-500">
                                No alumni records found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-4">
            {{ $batchAlumni->links() }}
        </div>
    </div>
@endsection
