@extends('admin.layouts.app')
@section('title', 'User Management - Admin Panel')

@section('content')
    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-2xl font-semibold text-gray-900">User Management</h1>

            <!-- Search and Filter Form -->
            <div class="mt-6 bg-white rounded-lg shadow p-4 mb-6">
                <form action="{{ route('admin.users.index') }}" method="GET" class="space-y-4">
                    <div class="flex flex-wrap gap-4">
                        <!-- Search -->
                        <div class="flex-1 min-w-[200px]">
                            <label for="search" class="block text-sm font-medium text-gray-700">Search</label>
                            <div class="mt-1 relative rounded-md shadow-sm">
                                <input type="text" name="search" id="search"
                                    class="focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2 sm:text-sm border-gray-300 rounded-md"
                                    placeholder="Name or email" value="{{ request('search') }}">
                            </div>
                        </div>

                        <!-- Role Filter -->
                        <div class="w-full sm:w-auto">
                            <label for="role" class="block text-sm font-medium text-gray-700">Role</label>
                            <select name="role" id="role"
                                class="mt-1 block w-full p-2 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                <option value="">All Roles</option>
                                @foreach ($roles as $role)
                                    <option value="{{ $role->name }}"
                                        {{ request('role') == $role->name ? 'selected' : '' }}>
                                        {{ $role->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Date From -->
                        <div class="w-full sm:w-auto">
                            <label for="date_from" class="block text-sm font-medium text-gray-700">Date From</label>
                            <input type="date" name="date_from" id="date_from"
                                class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2 sm:text-sm border-gray-300 rounded-md"
                                value="{{ request('date_from') }}">
                        </div>

                        <!-- Date To -->
                        <div class="w-full sm:w-auto">
                            <label for="date_to" class="block text-sm font-medium text-gray-700">Date To</label>
                            <input type="date" name="date_to" id="date_to"
                                class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2 sm:text-sm border-gray-300 rounded-md"
                                value="{{ request('date_to') }}">
                        </div>

                        <!-- Sort -->
                        <div class="w-full sm:w-auto">
                            <label for="sort" class="block text-sm font-medium text-gray-700">Sort By</label>
                            <select name="sort" id="sort"
                                class="mt-1 block w-full p-2 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                <option value="created_at"
                                    {{ request('sort', 'created_at') == 'created_at' ? 'selected' : '' }}>Created Date
                                </option>
                                <option value="name" {{ request('sort') == 'name' ? 'selected' : '' }}>Name</option>
                                <option value="email" {{ request('sort') == 'email' ? 'selected' : '' }}>Email</option>
                            </select>
                        </div>

                        <!-- Sort Direction -->
                        <div class="w-full sm:w-auto">
                            <label for="direction" class="block text-sm font-medium text-gray-700">Direction</label>
                            <select name="direction" id="direction"
                                class="mt-1 block w-full p-2 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                <option value="desc" {{ request('direction', 'desc') == 'desc' ? 'selected' : '' }}>
                                    Descending</option>
                                <option value="asc" {{ request('direction') == 'asc' ? 'selected' : '' }}>Ascending
                                </option>
                            </select>
                        </div>
                    </div>

                    <!-- Buttons -->
                    <div class="flex justify-between">
                        <div class="flex space-x-2">
                            <button type="submit"
                                class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                Apply Filters
                            </button>
                            <a href="{{ route('admin.users.index') }}"
                                class="inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md shadow-sm text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                Reset
                            </a>
                        </div>
                        <a href="{{ route('admin.users.create') }}"
                            class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                            Add User
                        </a>
                    </div>
                </form>
            </div>

            <!-- User List -->
            <div class="bg-white overflow-hidden shadow rounded-lg">
                <div class="p-6">
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left text-gray-500">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-4 py-4">Name</th>
                                    <th scope="col" class="px-4 py-4">Email</th>
                                    <th scope="col" class="px-4 py-4">Roles</th>
                                    <th scope="col" class="px-4 py-4">Created At</th>
                                    <th scope="col" class="px-4 py-4">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($users as $user)
                                    <tr class="border-b hover:bg-gray-50">
                                        <td class="px-4 py-3 font-medium text-gray-900">
                                            {{ $user->name }}
                                        </td>
                                        <td class="px-4 py-3">{{ $user->email }}</td>
                                        <td class="px-4 py-3">
                                            @foreach ($user->roles as $role)
                                                <span
                                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                    {{ $role->name }}
                                                </span>
                                            @endforeach
                                        </td>
                                        <td class="px-4 py-3">{{ $user->created_at->format('d M Y') }}</td>
                                        <td class="px-4 py-3 flex items-center space-x-2">
                                            <a href="{{ route('admin.users.edit', $user) }}"
                                                class="text-gray-400 hover:text-gray-500">
                                                <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                </svg>
                                            </a>
                                            <form action="{{ route('admin.users.destroy', $user) }}" method="POST"
                                                onsubmit="return confirm('Are you sure?');">
                                                @csrf
                                                @method('DELETE')
                                                <button class="text-red-600 hover:text-red-900">
                                                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg"
                                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center py-4">No users found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-6">
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
