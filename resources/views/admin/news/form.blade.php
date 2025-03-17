@csrf
<div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md">
    <div class="mb-4">
        <label for="title" class="block text-sm font-medium text-gray-700">
            Title
        </label>
        <input type="text" name="title" id="title"
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 sm:text-sm"
            value="{{ old('title', $news->title ?? '') }}" required>
    </div>

    <div class="mb-4">
        <label for="excerpt" class="block text-sm font-medium text-gray-700">
            Excerpt
        </label>
        <textarea name="excerpt" id="excerpt" rows="3"
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 sm:text-sm">{{ old('excerpt', $news->excerpt ?? '') }}</textarea>
    </div>

    <div class="mb-4">
        <label for="content" class="block text-sm font-medium text-gray-700">
            Content
        </label>
        <textarea name="content" id="content" rows="10"
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 sm:text-sm">{{ old('content', $news->content ?? '') }}</textarea>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
        <div>
            <label for="featured_image" class="block text-sm font-medium text-gray-700">
                Featured Image
            </label>
            <input type="file" name="featured_image" id="featured_image"
                class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-green-50 file:text-green-700 hover:file:bg-green-100"
                accept="image/*">
            @if (isset($news) && $news->featured_image)
                <div class="mt-2">
                    <img src="{{ Storage::url($news->featured_image) }}" alt="Current featured image"
                        class="h-32 w-auto">
                </div>
            @endif
        </div>

        <div>
            <label for="event_date" class="block text-sm font-medium text-gray-700">
                Event Date
            </label>
            <input type="datetime-local" name="event_date" id="event_date"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 sm:text-sm"
                value="{{ old('event_date', isset($news) ? $news->event_date?->format('Y-m-d\TH:i') : '') }}">
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
        <div>
            <label for="location" class="block text-sm font-medium text-gray-700">
                Location
            </label>
            <input type="text" name="location" id="location"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 sm:text-sm"
                value="{{ old('location', $news->location ?? '') }}">
        </div>

        <div>
            <label for="news_category_id" class="block text-sm font-medium text-gray-700">
                Category
            </label>
            <select name="news_category_id" id="news_category_id"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 sm:text-sm">
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" @selected(old('news_category_id', $news->news_category_id ?? '') == $category->id)>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>

    <!-- Tags -->
    <div class="mb-6">
        <label class="block text-sm font-medium text-gray-700 mb-1">Tags</label>
        <div class="border border-gray-300 rounded-md p-3 max-h-48 overflow-y-auto">
            <div class="grid grid-cols-2 gap-2">
                @foreach ($tags as $tag)
                    <div class="flex items-center">
                        <input type="checkbox" id="tag_{{ $tag->id }}" name="tags[]" value="{{ $tag->id }}"
                            {{ isset($news) && $news->tags->contains($tag->id) ? 'checked' : '' }}
                            class="h-4 w-4 text-green-600 border-gray-300 rounded focus:ring-green-500">
                        <label for="tag_{{ $tag->id }}" class="ml-2 text-sm text-gray-700">
                            {{ $tag->name }}
                        </label>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- New Tag Input -->
        <div class="mt-3">
            <label for="new_tag" class="block text-sm font-medium text-gray-700 mb-1">Add New Tag</label>
            <div class="flex items-center">
                <input type="text" id="new_tag"
                    class="border-gray-300 focus:border-green-500 focus:ring focus:ring-green-500 focus:ring-opacity-50 rounded-md shadow-sm text-sm flex-1"
                    placeholder="Enter new tag name"
                    onkeydown="if(event.key === 'Enter') { event.preventDefault(); addNewTag(); }">
                <button type="button" onclick="addNewTag()"
                    class="ml-2 inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md shadow-sm text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                    Add
                </button>
            </div>
        </div>

        @error('tags')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
        <div>
            <label for="status" class="block text-sm font-medium text-gray-700">
                Status
            </label>
            <select name="status" id="status"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 sm:text-sm">
                <option value="draft" @selected(old('status', $news->status ?? '') == 'draft')>Draft</option>
                <option value="published" @selected(old('status', $news->status ?? '') == 'published')>Published</option>
                <option value="archived" @selected(old('status', $news->status ?? '') == 'archived')>Archived</option>
            </select>
        </div>

        <div class="flex items-center mt-8">
            <input type="checkbox" name="is_featured" id="is_featured"
                class="h-4 w-4 rounded border-gray-300 text-green-600 focus:ring-green-500"
                @checked(old('is_featured', $news->is_featured ?? false))>
            <label for="is_featured" class="ml-2 block text-sm text-gray-700">
                Feature this news
            </label>
        </div>
    </div>
</div>

@push('scripts')
    <script src="https://cdn.ckeditor.com/ckeditor5/27.1.0/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create(document.querySelector('#content'))
            .catch(error => {
                console.error(error);
            });

        function addNewTag() {
            const newTagInput = document.getElementById('new_tag');
            const tagName = newTagInput.value.trim();

            if (!tagName) return;

            // Create a new tag container
            const tagsContainer = document.querySelector('.grid.grid-cols-2.gap-2');

            // Format the tag ID - replace spaces with underscores and make lowercase
            const newTagId = 'new_' + tagName.toLowerCase().replace(/\s+/g, '_');

            // Check if this tag already exists
            const existingTag = document.getElementById('tag_' + newTagId);
            if (existingTag) {
                // If it exists but not checked, just check it
                existingTag.checked = true;
                newTagInput.value = '';
                return;
            }

            const tagDiv = document.createElement('div');
            tagDiv.className = 'flex items-center';
            tagDiv.innerHTML = `
            <input 
                type="checkbox" 
                id="tag_${newTagId}" 
                name="tags[]" 
                value="${newTagId}" 
                checked
                class="h-4 w-4 text-green-600 border-gray-300 rounded focus:ring-green-500"
            >
            <label for="tag_${newTagId}" class="ml-2 text-sm text-gray-700">
                ${tagName} <span class="text-xs text-green-600">(new)</span>
            </label>
        `;

            tagsContainer.appendChild(tagDiv);
            newTagInput.value = '';
        }
    </script>
@endpush
