@csrf
<div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md">
    <div class="mb-4">
        <label for="title" class="block text-sm font-medium text-gray-700">Judul</label>
        <input type="text" name="title" id="title"
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 sm:text-sm"
            value="{{ old('title', $article->title ?? '') }}" required>
    </div>

    <div class="mb-4">
        <label for="excerpt" class="block text-sm font-medium text-gray-700">Ringkasan</label>
        <textarea name="excerpt" id="excerpt" rows="3"
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 sm:text-sm">{{ old('excerpt', $article->excerpt ?? '') }}</textarea>
    </div>

    <div class="mb-4">
        <label for="content" class="block text-sm font-medium text-gray-700">Konten</label>
        <textarea name="content" id="content" rows="10"
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 sm:text-sm">{{ old('content', $article->content ?? '') }}</textarea>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
        <div>
            <label for="featured_image" class="block text-sm font-medium text-gray-700">Gambar Utama</label>
            <input type="file" name="featured_image" id="featured_image"
                class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-green-50 file:text-green-700 hover:file:bg-green-100"
                accept="image/*" {{ isset($article) ? '' : 'required' }}>
            @if (isset($article) && $article->featured_image)
                <div class="mt-2">
                    <img src="{{ Storage::url($article->featured_image) }}" alt="Gambar saat ini" class="h-32 w-auto">
                </div>
            @endif
        </div>

        <div>
            <label for="reading_time" class="block text-sm font-medium text-gray-700">Durasi Baca</label>
            <input type="text" name="reading_time" id="reading_time"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 sm:text-sm"
                value="{{ old('reading_time', $article->reading_time ?? '5 min read') }}"
                placeholder="contoh: 5 min read">
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
        <div>
            <label for="article_category_id" class="block text-sm font-medium text-gray-700">Kategori</label>
            <select name="article_category_id" id="article_category_id"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 sm:text-sm">
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" @selected(old('article_category_id', $article->article_category_id ?? '') == $category->id)>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
            <select name="status" id="status"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 sm:text-sm">
                <option value="draft" @selected(old('status', $article->status ?? '') == 'draft')>Draft</option>
                <option value="published" @selected(old('status', $article->status ?? '') == 'published')>Terbit</option>
                <option value="archived" @selected(old('status', $article->status ?? '') == 'archived')>Arsip</option>
            </select>
        </div>
    </div>

    <div class="mb-4" id="published-at-container"
        style="display: {{ old('status', $article->status ?? 'draft') === 'published' ? 'block' : 'none' }};">
        <label for="published_at" class="block text-sm font-medium text-gray-700">Tanggal Terbit</label>
        <input type="datetime-local" name="published_at" id="published_at"
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 sm:text-sm"
            value="{{ old('published_at', isset($article) && $article->published_at ? $article->published_at->format('Y-m-d\TH:i') : '') }}">
        <p class="mt-1 text-xs text-gray-500">Kosongkan untuk menggunakan tanggal saat ini</p>
    </div>

    <div class="mb-6">
        <label class="block text-sm font-medium text-gray-700 mb-1">Tag</label>
        <div class="border border-gray-300 rounded-md p-3 max-h-48 overflow-y-auto">
            <div class="grid grid-cols-2 gap-2">
                @foreach ($tags as $tag)
                    <div class="flex items-center">
                        <input type="checkbox" id="tag_{{ $tag->id }}" name="tags[]" value="{{ $tag->id }}"
                            {{ isset($article) && $article->tags->contains($tag->id) ? 'checked' : '' }}
                            class="h-4 w-4 text-green-600 border-gray-300 rounded focus:ring-green-500">
                        <label for="tag_{{ $tag->id }}" class="ml-2 text-sm text-gray-700">
                            {{ $tag->name }}
                        </label>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="mt-3">
            <label for="new_tag" class="block text-sm font-medium text-gray-700 mb-1">Tambah Tag Baru</label>
            <div class="flex items-center">
                <input type="text" id="new_tag"
                    class="border-gray-300 focus:border-green-500 focus:ring focus:ring-green-500 focus:ring-opacity-50 rounded-md shadow-sm text-sm flex-1"
                    placeholder="Masukkan nama tag"
                    onkeydown="if(event.key === 'Enter') { event.preventDefault(); addNewTag(); }">
                <button type="button" onclick="addNewTag()"
                    class="ml-2 inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md shadow-sm text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                    Tambah
                </button>
            </div>
        </div>

        @error('tags')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div class="flex items-center mb-4">
        <input type="hidden" name="is_featured" value="0">
        <input type="checkbox" name="is_featured" id="is_featured" value="1"
            class="h-4 w-4 rounded border-gray-300 text-green-600 focus:ring-green-500"
            {{ old('is_featured', $article->is_featured ?? false) ? 'checked' : '' }}>
        <label for="is_featured" class="ml-2 block text-sm text-gray-700">Tandai sebagai artikel pilihan</label>
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

        // Toggle visibility of published_at field based on status
        document.getElementById('status').addEventListener('change', function() {
            const publishedAtContainer = document.getElementById('published-at-container');
            if (this.value === 'published') {
                publishedAtContainer.style.display = 'block';
            } else {
                publishedAtContainer.style.display = 'none';
            }
        });

        function addNewTag() {
            const newTagInput = document.getElementById('new_tag');
            const tagName = newTagInput.value.trim();

            if (!tagName) return;

            const tagsContainer = document.querySelector('.grid.grid-cols-2.gap-2');
            const newTagId = 'new_' + tagName.toLowerCase().replace(/\s+/g, '_');
            const existingTag = document.getElementById('tag_' + newTagId);

            if (existingTag) {
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
                    ${tagName} <span class="text-xs text-green-600">(baru)</span>
                </label>
            `;

            tagsContainer.appendChild(tagDiv);
            newTagInput.value = '';
        }
    </script>
@endpush
