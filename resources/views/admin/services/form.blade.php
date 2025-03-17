@csrf

<div class="space-y-6">
    <div>
        <label for="program_id" class="block text-sm font-medium text-gray-700">Program</label>
        <select id="program_id" name="program_id"
            class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm rounded-md">
            @foreach ($programs as $program)
                <option value="{{ $program->id }}"
                    {{ old('program_id', $service->program_id ?? '') == $program->id ? 'selected' : '' }}>
                    {{ $program->title }}
                </option>
            @endforeach
        </select>
        @error('program_id')
            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
        <input type="text" name="title" id="title" value="{{ old('title', $service->title ?? '') }}"
            class="mt-1 focus:ring-green-500 focus:border-green-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
        @error('title')
            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
        <textarea name="description" id="description" rows="3"
            class="mt-1 focus:ring-green-500 focus:border-green-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">{{ old('description', $service->description ?? '') }}</textarea>
        @error('description')
            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="icon" class="block text-sm font-medium text-gray-700">Icon (FontAwesome class)</label>
        <input type="text" name="icon" id="icon" value="{{ old('icon', $service->icon ?? '') }}"
            class="mt-1 focus:ring-green-500 focus:border-green-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
        @error('icon')
            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="image" class="block text-sm font-medium text-gray-700">Image</label>
        <input type="file" name="image" id="image" class="mt-1 block w-full">
        @if (isset($service) && $service->image)
            <div class="mt-2">
                <img src="{{ Storage::url($service->image) }}" alt="{{ $service->title }}"
                    class="h-20 w-20 object-cover rounded">
            </div>
        @endif
        @error('image')
            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="link_text" class="block text-sm font-medium text-gray-700">Link Text</label>
        <input type="text" name="link_text" id="link_text" value="{{ old('link_text', $service->link_text ?? '') }}"
            class="mt-1 focus:ring-green-500 focus:border-green-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
        @error('link_text')
            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="link_url" class="block text-sm font-medium text-gray-700">Link URL</label>
        <input type="text" name="link_url" id="link_url" value="{{ old('link_url', $service->link_url ?? '') }}"
            class="mt-1 focus:ring-green-500 focus:border-green-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
        @error('link_url')
            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="order" class="block text-sm font-medium text-gray-700">Order</label>
        <input type="number" name="order" id="order" value="{{ old('order', $service->order ?? 0) }}"
            class="mt-1 focus:ring-green-500 focus:border-green-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
        @error('order')
            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div class="flex items-start">
        <div class="flex items-center h-5">
            <input type="checkbox" name="is_active" id="is_active" value="1"
                {{ old('is_active', $service->is_active ?? true) ? 'checked' : '' }}
                class="focus:ring-green-500 h-4 w-4 text-green-600 border-gray-300 rounded">
        </div>
        <div class="ml-3 text-sm">
            <label for="is_active" class="font-medium text-gray-700">Active</label>
            <p class="text-gray-500">Show this service on the website</p>
        </div>
    </div>
</div>
