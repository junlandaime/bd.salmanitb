@csrf
<div class="bg-white rounded-2xl border border-gray-200/80 shadow-sm p-6 sm:p-8 space-y-6">
    <div>
        <label for="title" class="block text-xs font-semibold text-gray-700 mb-1">Judul Artikel <span class="text-red-500">*</span></label>
        <input type="text" name="title" id="title"
            class="w-full px-3.5 py-2.5 text-sm border border-gray-300 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition"
            value="{{ old('title', $article->title ?? '') }}" required placeholder="Tuliskan judul artikel...">
        @error('title')
            <p class="mt-1 text-xs text-red-600 font-medium">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="excerpt" class="block text-xs font-semibold text-gray-700 mb-1">Kutipan Singkat (Excerpt)</label>
        <textarea name="excerpt" id="excerpt" rows="2" placeholder="Ringkasan 1-2 kalimat..."
            class="w-full px-3.5 py-2.5 text-sm border border-gray-300 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition">{{ old('excerpt', $article->excerpt ?? '') }}</textarea>
    </div>

    <div>
        <label for="content" class="block text-xs font-semibold text-gray-700 mb-1">Konten Lengkap <span class="text-red-500">*</span></label>
        <textarea name="content" id="content" rows="12"
            class="w-full px-3.5 py-2.5 text-sm border border-gray-300 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition">{{ old('content', $article->content ?? '') }}</textarea>
        @error('content')
            <p class="mt-1 text-xs text-red-600 font-medium">{{ $message }}</p>
        @enderror
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pt-2">
        <div>
            <label for="featured_image" class="block text-xs font-semibold text-gray-700 mb-1">Gambar Sampul</label>
            <input type="file" name="featured_image" id="featured_image"
                class="w-full text-xs text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100"
                accept="image/*">
            @if (isset($article) && $article->featured_image)
                <div class="mt-2">
                    <img src="{{ Storage::url($article->featured_image) }}" alt="Current featured image"
                        class="h-28 w-40 object-cover rounded-xl border border-gray-200">
                </div>
            @endif
        </div>

        <div>
            <label for="reading_time" class="block text-xs font-semibold text-gray-700 mb-1">Estimasi Waktu Baca</label>
            <input type="text" name="reading_time" id="reading_time"
                class="w-full px-3.5 py-2.5 text-sm border border-gray-300 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition"
                value="{{ old('reading_time', $article->reading_time ?? '5 min read') }}" placeholder="Contoh: 5 min read">
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
            <label for="article_category_id" class="block text-xs font-semibold text-gray-700 mb-1">Kategori Artikel <span class="text-red-500">*</span></label>
            <select name="article_category_id" id="article_category_id" required
                class="w-full px-3.5 py-2.5 text-sm border border-gray-300 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition bg-white">
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" @selected(old('article_category_id', $article->article_category_id ?? '') == $category->id)>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="status" class="block text-xs font-semibold text-gray-700 mb-1">Status Publikasi <span class="text-red-500">*</span></label>
            <select name="status" id="status" required
                class="w-full px-3.5 py-2.5 text-sm border border-gray-300 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition bg-white">
                <option value="draft" @selected(old('status', $article->status ?? '') == 'draft')>Draft (Konsep)</option>
                <option value="published" @selected(old('status', $article->status ?? '') == 'published')>Published (Terbitkan)</option>
                <option value="archived" @selected(old('status', $article->status ?? '') == 'archived')>Archived (Arsipkan)</option>
            </select>
        </div>
    </div>

    <!-- Tags -->
    <div class="pt-2">
        <label class="block text-xs font-semibold text-gray-700 mb-2">Tagar / Topik Terkait</label>
        <div class="border border-gray-200 rounded-xl p-3 max-h-40 overflow-y-auto bg-gray-50/50">
            <div class="grid grid-cols-2 sm:grid-cols-3 gap-2">
                @foreach ($tags as $tag)
                    <label class="flex items-center gap-2 text-xs text-gray-700 cursor-pointer">
                        <input type="checkbox" id="tag_{{ $tag->id }}" name="tags[]" value="{{ $tag->id }}"
                            {{ isset($article) && $article->tags->contains($tag->id) ? 'checked' : '' }}
                            class="h-4 w-4 text-emerald-600 border-gray-300 rounded focus:ring-emerald-500">
                        <span>{{ $tag->name }}</span>
                    </label>
                @endforeach
            </div>
        </div>
    </div>

    <div class="flex items-center pt-2">
        <label class="flex items-center gap-2.5 cursor-pointer">
            <input type="checkbox" name="is_featured" id="is_featured" value="1"
                class="h-4 w-4 rounded border-gray-300 text-emerald-600 focus:ring-emerald-500" @checked(old('is_featured', $article->is_featured ?? false))>
            <span class="text-xs font-semibold text-gray-800">Tampilkan sebagai Artikel Unggulan (Featured)</span>
        </label>
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
    </script>
@endpush
