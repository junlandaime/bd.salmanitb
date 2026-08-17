@csrf
<div class="bg-white rounded-3xl border border-gray-200/80 shadow-sm p-6 sm:p-8 space-y-6">

    <!-- Judul Berita -->
    <div>
        <label for="title" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1.5">
            Judul Berita / Liputan <span class="text-red-500">*</span>
        </label>
        <input type="text" name="title" id="title"
            class="w-full px-4 py-2.5 text-sm border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition font-medium"
            placeholder="Tulis judul berita yang jelas & informatif..."
            value="{{ old('title', $news->title ?? '') }}" required>
        @error('title')
            <p class="text-xs text-red-600 font-medium mt-1">{{ $message }}</p>
        @enderror
    </div>

    <!-- Ringkasan (Excerpt) -->
    <div>
        <label for="excerpt" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1.5">
            Ringkasan Berita (Lead / Excerpt)
        </label>
        <textarea name="excerpt" id="excerpt" rows="2"
            class="w-full px-4 py-2.5 text-sm border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition leading-relaxed"
            placeholder="Ringkasan 5W+1H singkat mengenai kegiatan dakwah ini...">{{ old('excerpt', $news->excerpt ?? '') }}</textarea>
        <p class="text-[11px] text-gray-400 mt-1">Ringkasan akan ditampilkan sebagai paragraf pembuka di kartu berita.</p>
        @error('excerpt')
            <p class="text-xs text-red-600 font-medium mt-1">{{ $message }}</p>
        @enderror
    </div>

    <!-- Konten Berita -->
    <div>
        <label for="content" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1.5">
            Isi Liputan Berita Lengkap <span class="text-red-500">*</span>
        </label>
        <textarea name="content" id="content" rows="12"
            class="w-full px-4 py-2.5 text-sm border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition leading-relaxed"
            placeholder="Tulis narasi berita lengkap beserta kutipan narasumber...">{{ old('content', $news->content ?? '') }}</textarea>
        @error('content')
            <p class="text-xs text-red-600 font-medium mt-1">{{ $message }}</p>
        @enderror
    </div>

    <!-- Grid: Gambar Utama & Tanggal Kegiatan -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pt-2 border-t border-gray-100">
        <div>
            <label for="featured_image" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1.5">
                Foto Dokumentasi Utama
            </label>
            <input type="file" name="featured_image" id="featured_image"
                class="w-full text-xs text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 border border-gray-300 rounded-xl p-1"
                accept="image/*">
            <p class="text-[10px] text-gray-400 mt-1">Format: JPG, PNG, WEBP. Rekomendasi rasio 16:9.</p>
            @if (isset($news) && $news->featured_image)
                <div class="mt-2.5">
                    <img src="{{ Storage::url($news->featured_image) }}" alt="Gambar saat ini" class="h-28 w-auto rounded-xl object-cover border border-gray-200 shadow-2xs">
                </div>
            @endif
            @error('featured_image')
                <p class="text-xs text-red-600 font-medium mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="event_date" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1.5">
                Waktu Pelaksanaan Acara
            </label>
            <input type="datetime-local" name="event_date" id="event_date"
                class="w-full px-4 py-2.5 text-sm border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition bg-white"
                value="{{ old('event_date', isset($news) && $news->event_date ? $news->event_date->format('Y-m-d\TH:i') : '') }}">
            <p class="text-[11px] text-gray-400 mt-1">Waktu kapan acara/kegiatan tersebut berlangsung.</p>
            @error('event_date')
                <p class="text-xs text-red-600 font-medium mt-1">{{ $message }}</p>
            @enderror
        </div>
    </div>

    <!-- Grid: Lokasi & Kategori -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pt-2 border-t border-gray-100">
        <div>
            <label for="location" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1.5">
                Lokasi Kegiatan
            </label>
            <input type="text" name="location" id="location"
                class="w-full px-4 py-2.5 text-sm border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                placeholder="contoh: Ruang Utama Masjid Salman ITB"
                value="{{ old('location', $news->location ?? '') }}">
            @error('location')
                <p class="text-xs text-red-600 font-medium mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="news_category_id" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1.5">
                Kategori Berita <span class="text-red-500">*</span>
            </label>
            <select name="news_category_id" id="news_category_id" required
                class="w-full px-4 py-2.5 text-sm border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition bg-white">
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" @selected(old('news_category_id', $news->news_category_id ?? '') == $category->id)>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
            @error('news_category_id')
                <p class="text-xs text-red-600 font-medium mt-1">{{ $message }}</p>
            @enderror
        </div>
    </div>

    <!-- Grid: Status & Featured -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pt-2 border-t border-gray-100">
        <div>
            <label for="status" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1.5">
                Status Publikasi <span class="text-red-500">*</span>
            </label>
            <select name="status" id="status" required
                class="w-full px-4 py-2.5 text-sm border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition bg-white">
                <option value="draft" @selected(old('status', $news->status ?? '') == 'draft')>Simpan sebagai Draft</option>
                <option value="published" @selected(old('status', $news->status ?? '') == 'published')>Terbitkan Sekarang (Published)</option>
                <option value="archived" @selected(old('status', $news->status ?? '') == 'archived')>Arsip (Archived)</option>
            </select>
            @error('status')
                <p class="text-xs text-red-600 font-medium mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex items-center pt-5">
            <label class="inline-flex items-center gap-3 p-3 rounded-2xl border border-gray-200 hover:border-amber-400 bg-amber-50/30 cursor-pointer transition w-full">
                <input type="hidden" name="is_featured" value="0">
                <input type="checkbox" name="is_featured" id="is_featured" value="1"
                    class="w-4 h-4 rounded border-gray-300 text-amber-600 focus:ring-amber-500"
                    {{ old('is_featured', $news->is_featured ?? false) ? 'checked' : '' }}>
                <div>
                    <span class="text-xs font-bold text-gray-900 block">Tandai Berita Utama (Featured)</span>
                    <span class="text-[11px] text-gray-500">Akan tampil di sorotan berita utama.</span>
                </div>
            </label>
        </div>
    </div>

    <!-- Tanggal Terbit (Conditional) -->
    <div id="published-at-container" class="pt-2 border-t border-gray-100"
        style="display: {{ old('status', $news->status ?? 'draft') === 'published' ? 'block' : 'none' }};">
        <label for="published_at" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1.5">
            Waktu Publikasi Berita
        </label>
        <input type="datetime-local" name="published_at" id="published_at"
            class="w-full sm:w-80 px-4 py-2.5 text-sm border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition bg-white"
            value="{{ old('published_at', isset($news) && $news->published_at ? $news->published_at->format('Y-m-d\TH:i') : '') }}">
        <p class="text-[11px] text-gray-400 mt-1">Kosongkan jika ingin otomatis menggunakan waktu saat ini.</p>
    </div>

    <!-- Tags Selection -->
    <div class="pt-2 border-t border-gray-100 space-y-3">
        <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider">
            Tag Berita
        </label>
        <div class="border border-gray-200 rounded-2xl p-4 max-h-48 overflow-y-auto bg-gray-50/50">
            <div class="grid grid-cols-2 sm:grid-cols-3 gap-2.5">
                @foreach ($tags as $tag)
                    <label class="flex items-center gap-2 p-2 rounded-xl border border-gray-200 bg-white hover:border-blue-400 cursor-pointer transition">
                        <input type="checkbox" id="tag_{{ $tag->id }}" name="tags[]" value="{{ $tag->id }}"
                            {{ isset($news) && $news->tags->contains($tag->id) ? 'checked' : '' }}
                            class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                        <span class="text-xs font-medium text-gray-700">{{ $tag->name }}</span>
                    </label>
                @endforeach
            </div>
        </div>

        <!-- Tambah Tag Baru -->
        <div class="flex items-center gap-2 pt-1">
            <input type="text" id="new_tag"
                class="flex-1 max-w-sm px-3.5 py-2 text-xs border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                placeholder="Tulis tag berita baru..."
                onkeydown="if(event.key === 'Enter') { event.preventDefault(); addNewsTag(); }">
            <button type="button" onclick="addNewsTag()"
                class="px-4 py-2 text-xs font-bold rounded-xl bg-gray-100 hover:bg-blue-600 hover:text-white text-gray-700 border border-gray-300 transition shadow-2xs">
                + Tambah Tag
            </button>
        </div>
        @error('tags')
            <p class="text-xs text-red-600 font-medium mt-1">{{ $message }}</p>
        @enderror
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

        function addNewsTag() {
            const newTagInput = document.getElementById('new_tag');
            const tagName = newTagInput.value.trim();

            if (!tagName) return;

            const tagsContainer = document.querySelector('.grid.grid-cols-2.sm\\:grid-cols-3.gap-2\\.5');
            const newTagId = 'new_' + tagName.toLowerCase().replace(/\s+/g, '_');
            const existingTag = document.getElementById('tag_' + newTagId);

            if (existingTag) {
                existingTag.checked = true;
                newTagInput.value = '';
                return;
            }

            const tagLabel = document.createElement('label');
            tagLabel.className = 'flex items-center gap-2 p-2 rounded-xl border border-blue-300 bg-blue-50/50 cursor-pointer transition';
            tagLabel.innerHTML = `
                <input
                    type="checkbox"
                    id="tag_${newTagId}"
                    name="tags[]"
                    value="${newTagId}"
                    checked
                    class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500"
                >
                <span class="text-xs font-bold text-blue-900">${tagName} (baru)</span>
            `;

            if (tagsContainer) {
                tagsContainer.appendChild(tagLabel);
            }
            newTagInput.value = '';
        }
    </script>
@endpush
