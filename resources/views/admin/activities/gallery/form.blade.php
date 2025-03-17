@php
    $isEdit = isset($gallery);
    $route = $isEdit ? route('admin.activity-gallery.update', $gallery) : route('admin.activity-gallery.store');
@endphp

<form action="{{ $route }}" method="POST" class="space-y-6" enctype="multipart/form-data">
    @csrf
    @if ($isEdit)
        @method('PUT')
    @else
        <input type="hidden" name="activity_id" value="{{ $activity->id }}">
    @endif

    <div class="bg-white shadow rounded-lg p-6">
        <div class="grid grid-cols-1 gap-6">
            <div>
                <label for="image" class="block text-sm font-medium text-gray-700">Image</label>
                @if ($isEdit && $gallery->image)
                    <div class="mt-2 mb-4">
                        <img src="{{ asset('storage/' . $gallery->image) }}" alt="{{ $gallery->title }}"
                            class="w-64 h-48 object-cover rounded-lg">
                    </div>
                @endif
                <input type="file" name="image" id="image" {{ !$isEdit ? 'required' : '' }}
                    class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-green-50 file:text-green-700 hover:file:bg-green-100">
                <p class="mt-1 text-sm text-gray-500">Recommended: High quality image, aspect ratio 4:3</p>
                @error('image')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                <input type="text" name="title" id="title" value="{{ old('title', $gallery->title ?? '') }}"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500">
                @error('title')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                <textarea name="description" id="description" rows="4"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500">{{ old('description', $gallery->description ?? '') }}</textarea>
                @error('description')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>
    </div>

    <div class="flex justify-end space-x-3">
        <a href="{{ route('admin.activities.edit', $activity) }}"
            class="inline-flex justify-center py-2 px-4 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
            Cancel
        </a>
        <button type="submit"
            class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
            {{ $isEdit ? 'Update' : 'Upload' }} Gallery Item
        </button>
    </div>
</form>
