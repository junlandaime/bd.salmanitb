@extends('admin.layouts.app')

@section('title', 'Edit Alumni')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex items-center mb-6">
        <a href="{{ route('admin.batch-alumni.index') }}" class="text-blue-500 hover:text-blue-700 mr-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Kembali
        </a>
        <h1 class="text-2xl font-bold text-gray-800">Edit Alumni</h1>
    </div>

    @if(session('error'))
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
        {{ session('error') }}
    </div>
    @endif

    <div class="bg-white rounded-lg shadow-md p-6">
        <form action="{{ route('admin.batch-alumni.update', $batchAlumni->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="user_id" class="block text-sm font-medium text-gray-700 mb-1">User</label>
                <select name="user_id" id="user_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50 @error('user_id') border-red-500 @enderror" required>
                    <option value="">Select User</option>
                    @foreach($users as $user)
                    <option value="{{ $user->id }}" {{ (old('user_id') ?? $batchAlumni->user_id) == $user->id ? 'selected' : '' }}>
                        {{ $user->name }} ({{ $user->email }})
                    </option>
                    @endforeach
                </select>
                @error('user_id')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="activity_batch_id" class="block text-sm font-medium text-gray-700 mb-1">Batch</label>
                <select name="activity_batch_id" id="activity_batch_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50 @error('activity_batch_id') border-red-500 @enderror" required>
                    <option value="">Select Batch</option>
                    @foreach($batches as $batch)
                    <option value="{{ $batch->id }}" {{ (old('activity_batch_id') ?? $batchAlumni->activity_batch_id) == $batch->id ? 'selected' : '' }}>
                        {{ $batch->activity->nama_kegiatan }} - {{ $batch->nama_batch }}
                    </option>
                    @endforeach
                </select>
                @error('activity_batch_id')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="instagram_account" class="block text-sm font-medium text-gray-700 mb-1">Instagram Account</label>
                <input type="text" name="instagram_account" id="instagram_account" value="{{ old('instagram_account') ?? $batchAlumni->instagram_account }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50 @error('instagram_account') border-red-500 @enderror">
                @error('instagram_account')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="gender" class="block text-sm font-medium text-gray-700 mb-1">Gender</label>
                <select name="gender" id="gender" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50 @error('gender') border-red-500 @enderror">
                    <option value="">Select Gender</option>
                    <option value="Laki-laki" {{ (old('gender') ?? $batchAlumni->gender) == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                    <option value="Perempuan" {{ (old('gender') ?? $batchAlumni->gender) == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                </select>
                @error('gender')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="notes" class="block text-sm font-medium text-gray-700 mb-1">Notes</label>
                <textarea name="notes" id="notes" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50 @error('notes') border-red-500 @enderror">{{ old('notes') ?? $batchAlumni->notes }}</textarea>
                @error('notes')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-end">
                <a href="{{ route('admin.batch-alumni.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded mr-2">
                    Cancel
                </a>
                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
                    Update
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
