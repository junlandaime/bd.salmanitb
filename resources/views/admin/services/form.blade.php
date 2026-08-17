@csrf

<div class="bg-white rounded-2xl border border-gray-200/80 shadow-sm p-6 sm:p-8 space-y-6">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
            <label for="program_id" class="block text-xs font-semibold text-gray-700 mb-1">Program Induk <span class="text-red-500">*</span></label>
            <select id="program_id" name="program_id" required
                class="w-full px-3.5 py-2.5 text-sm border border-gray-300 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition bg-white">
                @foreach ($programs as $program)
                    <option value="{{ $program->id }}"
                        {{ old('program_id', $service->program_id ?? '') == $program->id ? 'selected' : '' }}>
                        {{ $program->title }}
                    </option>
                @endforeach
            </select>
            @error('program_id')
                <p class="mt-1 text-xs text-red-600 font-medium">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="title" class="block text-xs font-semibold text-gray-700 mb-1">Nama Layanan <span class="text-red-500">*</span></label>
            <input type="text" name="title" id="title" value="{{ old('title', $service->title ?? '') }}" required
                placeholder="Contoh: Konsultasi Pra Nikah / Bimbingan Rohani"
                class="w-full px-3.5 py-2.5 text-sm border border-gray-300 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition">
            @error('title')
                <p class="mt-1 text-xs text-red-600 font-medium">{{ $message }}</p>
            @enderror
        </div>

        <div class="md:col-span-2">
            <label for="description" class="block text-xs font-semibold text-gray-700 mb-1">Deskripsi Layanan <span class="text-red-500">*</span></label>
            <textarea name="description" id="description" rows="4" required
                placeholder="Jelaskan mengenai manfaat, sasaran, dan alur layanan ini..."
                class="w-full px-3.5 py-2.5 text-sm border border-gray-300 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition">{{ old('description', $service->description ?? '') }}</textarea>
            @error('description')
                <p class="mt-1 text-xs text-red-600 font-medium">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="icon" class="block text-xs font-semibold text-gray-700 mb-1">Icon (Opsional)</label>
            <input type="text" name="icon" id="icon" value="{{ old('icon', $service->icon ?? '') }}"
                placeholder="Contoh: fa-solid fa-heart"
                class="w-full px-3.5 py-2.5 text-sm border border-gray-300 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition">
            @error('icon')
                <p class="mt-1 text-xs text-red-600 font-medium">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="order" class="block text-xs font-semibold text-gray-700 mb-1">Urutan Tampil</label>
            <input type="number" name="order" id="order" value="{{ old('order', $service->order ?? 0) }}"
                class="w-full px-3.5 py-2.5 text-sm border border-gray-300 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition">
            @error('order')
                <p class="mt-1 text-xs text-red-600 font-medium">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="link_text" class="block text-xs font-semibold text-gray-700 mb-1">Teks Tombol Aksi (Opsional)</label>
            <input type="text" name="link_text" id="link_text" value="{{ old('link_text', $service->link_text ?? '') }}"
                placeholder="Contoh: Konsultasi Sekarang"
                class="w-full px-3.5 py-2.5 text-sm border border-gray-300 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition">
        </div>

        <div>
            <label for="link_url" class="block text-xs font-semibold text-gray-700 mb-1">Link URL Tombol (Opsional)</label>
            <input type="text" name="link_url" id="link_url" value="{{ old('link_url', $service->link_url ?? '') }}"
                placeholder="https://..."
                class="w-full px-3.5 py-2.5 text-sm border border-gray-300 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition">
        </div>

        <div class="md:col-span-2">
            <label for="image" class="block text-xs font-semibold text-gray-700 mb-1">Gambar / Cover Layanan</label>
            <input type="file" name="image" id="image"
                class="w-full text-xs text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100"
                accept="image/*">
            @if (isset($service) && $service->image)
                <div class="mt-2">
                    <img src="{{ Storage::url($service->image) }}" alt="{{ $service->title }}"
                        class="h-20 w-20 object-cover rounded-xl border border-gray-200">
                </div>
            @endif
        </div>

        <div class="md:col-span-2 pt-2 border-t border-gray-100">
            <label class="flex items-center gap-2.5 cursor-pointer">
                <input type="checkbox" name="is_active" id="is_active" value="1"
                    {{ old('is_active', $service->is_active ?? true) ? 'checked' : '' }}
                    class="h-4 w-4 rounded text-emerald-600 focus:ring-emerald-500 border-gray-300">
                <span class="text-xs font-semibold text-gray-800">Aktifkan dan Tampilkan Layanan di Website</span>
            </label>
        </div>
    </div>
</div>
