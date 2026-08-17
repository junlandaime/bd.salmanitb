@php
    $isEdit = isset($programSchedule);
    $route = $isEdit 
        ? route('admin.program-schedules.update', $programSchedule)
        : route('admin.program-schedules.store');
@endphp

@if ($errors->any())
    <div class="bg-red-50 border border-red-200 text-red-800 p-4 rounded-2xl mb-6 shadow-sm">
        <div class="flex items-start gap-3">
            <svg class="w-5 h-5 text-red-500 mt-0.5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <div>
                <h3 class="text-sm font-bold text-red-800">Mohon perbaiki kesalahan berikut:</h3>
                <ul class="list-disc list-inside text-xs mt-1.5 space-y-1 text-red-700">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endif

<form action="{{ $route }}" method="POST" class="space-y-6">
    @csrf
    @if($isEdit)
        @method('PUT')
    @else
        <input type="hidden" name="program_id" value="{{ $program->id }}">
    @endif

    <div class="bg-white rounded-2xl border border-gray-200/80 shadow-sm p-6 sm:p-8 space-y-6">
        <div class="flex items-center gap-2.5 pb-4 border-b border-gray-100">
            <span class="w-8 h-8 rounded-xl bg-purple-50 text-purple-600 flex items-center justify-center font-bold text-sm">
                🗓️
            </span>
            <div>
                <h2 class="text-base font-bold text-gray-900">{{ $isEdit ? 'Edit Rincian Jadwal' : 'Rincian Jadwal Baru' }}</h2>
                <p class="text-xs text-gray-500">Tentukan nama sesi, hari pertemuan rutin, rentang jam, dan tipe jadwal.</p>
            </div>
        </div>

        <!-- Title -->
        <div>
            <label for="title" class="block text-xs font-semibold uppercase tracking-wider text-gray-700 mb-1.5">
                Nama Sesi / Jadwal <span class="text-red-500">*</span>
            </label>
            <input type="text" name="title" id="title" 
                   value="{{ old('title', $programSchedule->title ?? '') }}" required
                   placeholder="Contoh: Sesi Ahad Pagi - Teori & Konsultasi"
                   class="w-full rounded-xl border-gray-200 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/20 text-sm py-2.5 px-3.5 bg-gray-50/50 hover:bg-white focus:bg-white text-gray-900 placeholder-gray-400 transition">
            @error('title')
                <p class="mt-1.5 text-xs text-red-600 font-medium">{{ $message }}</p>
            @enderror
        </div>

        <!-- Day Selection -->
        <div>
            <label for="day" class="block text-xs font-semibold uppercase tracking-wider text-gray-700 mb-1.5">
                Hari Pertemuan <span class="text-red-500">*</span>
            </label>
            <select name="day" id="day" required
                    class="w-full rounded-xl border-gray-200 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/20 text-sm py-2.5 px-3.5 bg-gray-50/50 hover:bg-white focus:bg-white text-gray-900 transition">
                @foreach(['Monday' => 'Senin (Monday)', 'Tuesday' => 'Selasa (Tuesday)', 'Wednesday' => 'Rabu (Wednesday)', 'Thursday' => 'Kamis (Thursday)', 'Friday' => 'Jumat (Friday)', 'Saturday' => 'Sabtu (Saturday)', 'Sunday' => 'Ahad (Sunday)'] as $val => $label)
                    <option value="{{ $val }}" {{ old('day', $programSchedule->day ?? '') === $val ? 'selected' : '' }}>
                        {{ $label }}
                    </option>
                @endforeach
            </select>
            @error('day')
                <p class="mt-1.5 text-xs text-red-600 font-medium">{{ $message }}</p>
            @enderror
        </div>

        <!-- Time Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label for="start_time" class="block text-xs font-semibold uppercase tracking-wider text-gray-700 mb-1.5">
                    Waktu Mulai <span class="text-red-500">*</span>
                </label>
                <input type="time" name="start_time" id="start_time" required
                       value="{{ old('start_time', $programSchedule->start_time ?? '') }}"
                       class="w-full rounded-xl border-gray-200 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/20 text-sm py-2.5 px-3.5 bg-gray-50/50 hover:bg-white focus:bg-white text-gray-900 transition">
                @error('start_time')
                    <p class="mt-1.5 text-xs text-red-600 font-medium">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="end_time" class="block text-xs font-semibold uppercase tracking-wider text-gray-700 mb-1.5">
                    Waktu Selesai <span class="text-red-500">*</span>
                </label>
                <input type="time" name="end_time" id="end_time" required
                       value="{{ old('end_time', $programSchedule->end_time ?? '') }}"
                       class="w-full rounded-xl border-gray-200 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/20 text-sm py-2.5 px-3.5 bg-gray-50/50 hover:bg-white focus:bg-white text-gray-900 transition">
                @error('end_time')
                    <p class="mt-1.5 text-xs text-red-600 font-medium">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <!-- Schedule Type -->
        <div>
            <label for="type" class="block text-xs font-semibold uppercase tracking-wider text-gray-700 mb-1.5">
                Tipe Jadwal <span class="text-red-500">*</span>
            </label>
            <select name="type" id="type" required
                    class="w-full rounded-xl border-gray-200 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/20 text-sm py-2.5 px-3.5 bg-gray-50/50 hover:bg-white focus:bg-white text-gray-900 transition">
                <option value="regular" {{ old('type', $programSchedule->type ?? '') === 'regular' ? 'selected' : '' }}>Regular (Sesi Rutin Mingguan)</option>
                <option value="special" {{ old('type', $programSchedule->type ?? '') === 'special' ? 'selected' : '' }}>Special (Sesi Khusus / Event Tertentu)</option>
            </select>
            @error('type')
                <p class="mt-1.5 text-xs text-red-600 font-medium">{{ $message }}</p>
            @enderror
        </div>
    </div>

    <!-- Action Footer -->
    <div class="flex items-center justify-end gap-3 pt-2">
        <a href="{{ route('admin.programs.edit', $program) }}" 
           class="px-5 py-2.5 rounded-xl border border-gray-200 bg-white text-gray-700 font-semibold text-sm hover:bg-gray-50 shadow-sm transition">
            Batal
        </a>
        <button type="submit" 
                class="inline-flex items-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white px-6 py-2.5 rounded-xl font-semibold text-sm shadow-sm hover:shadow transition">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
            </svg>
            {{ $isEdit ? 'Perbarui Jadwal' : 'Simpan Jadwal' }}
        </button>
    </div>
</form>
