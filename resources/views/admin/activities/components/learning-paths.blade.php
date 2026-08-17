<!-- Learning Paths Section -->
<div class="bg-white rounded-2xl border border-gray-200/80 shadow-sm p-6 sm:p-8" 
     x-data="{ 
        paths: @if(isset($activity)) {{ json_encode($activity->learningPath) }} @else [] @endif 
     }">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-6 pb-4 border-b border-gray-100">
        <div>
            <h2 class="text-base font-bold text-gray-900 flex items-center gap-2">
                <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                Learning Paths / Kurikulum
            </h2>
            <p class="text-xs text-gray-500 mt-0.5">Daftar jalur pembelajaran, silabus materi, dan pemateri terkait.</p>
        </div>
        <button type="button" @click="paths.push({title: '', order: paths.length + 1, description: '', mentors: ''})" 
                class="inline-flex items-center gap-1.5 px-3.5 py-2 rounded-xl bg-emerald-50 text-emerald-700 hover:bg-emerald-100 border border-emerald-200/60 font-semibold text-xs shadow-sm transition">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            Tambah Jalur
        </button>
    </div>

    <!-- Empty State -->
    <div x-show="paths.length === 0" class="py-8 text-center border-2 border-dashed border-gray-200 rounded-2xl bg-gray-50/50">
        <svg class="mx-auto h-10 w-10 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
        </svg>
        <p class="text-sm font-medium text-gray-600 mt-2">Belum ada learning path</p>
        <p class="text-xs text-gray-400 mt-0.5">Klik tombol di atas untuk menambahkan jalur pembelajaran.</p>
    </div>

    <div class="space-y-4" x-show="paths.length > 0">
        <template x-for="(path, index) in paths" :key="index">
            <div class="bg-gray-50/70 border border-gray-200/80 rounded-2xl p-5 relative transition hover:border-gray-300">
                <div class="flex items-center justify-between mb-4 pb-2 border-b border-gray-200/60">
                    <span class="inline-flex items-center gap-1.5 text-xs font-bold text-gray-700 bg-white px-2.5 py-1 rounded-lg border border-gray-200 shadow-sm" x-text="`#${index + 1} Jalur Pembelajaran`"></span>
                    <button type="button" @click="paths.splice(index, 1)" 
                            class="inline-flex items-center gap-1 text-xs font-semibold text-red-600 hover:text-red-700 hover:bg-red-50 px-2.5 py-1 rounded-lg transition">
                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                        Hapus
                    </button>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div class="md:col-span-2">
                        <label class="block text-xs font-semibold text-gray-700 mb-1">Judul Modul / Topik</label>
                        <input type="text" x-model="path.title" :name="`learning_paths[${index}][title]`" placeholder="Contoh: Modul 1 - Pengenalan Karakter Pemuda" 
                               class="w-full rounded-xl border border-gray-300 bg-white px-3.5 py-2 text-sm text-gray-900 focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 shadow-sm transition">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-700 mb-1">Urutan (Order)</label>
                        <input type="number" x-model="path.order" :name="`learning_paths[${index}][order]`" 
                               class="w-full rounded-xl border border-gray-300 bg-white px-3.5 py-2 text-sm text-gray-900 focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 shadow-sm transition">
                    </div>
                    <div class="md:col-span-3">
                        <label class="block text-xs font-semibold text-gray-700 mb-1">Deskripsi Silabus</label>
                        <textarea x-model="path.description" :name="`learning_paths[${index}][description]`" rows="2" placeholder="Ringkasan apa saja yang dipelajari pada sesi/modul ini..." 
                                  class="w-full rounded-xl border border-gray-300 bg-white px-3.5 py-2 text-sm text-gray-900 focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 shadow-sm transition"></textarea>
                    </div>
                    <div class="md:col-span-3">
                        <label class="block text-xs font-semibold text-gray-700 mb-1">Pemateri / Mentor <span class="text-gray-400 font-normal">(Pisahkan dengan & atau koma)</span></label>
                        <input type="text" x-model="path.mentors" :name="`learning_paths[${index}][mentors]`" placeholder="Contoh: Ustadz Dr. Fulan, M.Ag & Kang Budi" 
                               class="w-full rounded-xl border border-gray-300 bg-white px-3.5 py-2 text-sm text-gray-900 focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 shadow-sm transition">
                    </div>
                </div>
            </div>
        </template>
    </div>
</div>
