<!-- Highlights Section -->
<div class="bg-white rounded-2xl border border-gray-200/80 shadow-sm p-6 sm:p-8" 
     x-data="{ 
        highlights: @if(isset($activity)) {{ json_encode($activity->highlights) }} @else [] @endif 
     }">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-6 pb-4 border-b border-gray-100">
        <div>
            <h2 class="text-base font-bold text-gray-900 flex items-center gap-2">
                <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                Highlight / Keunggulan Kegiatan
            </h2>
            <p class="text-xs text-gray-500 mt-0.5">Poin-poin penting, fitur utama, atau fasilitas yang didapatkan peserta.</p>
        </div>
        <button type="button" @click="highlights.push({title: '', icon: '', description: ''})" 
                class="inline-flex items-center gap-1.5 px-3.5 py-2 rounded-xl bg-emerald-50 text-emerald-700 hover:bg-emerald-100 border border-emerald-200/60 font-semibold text-xs shadow-sm transition">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            Tambah Highlight
        </button>
    </div>

    <!-- Empty State -->
    <div x-show="highlights.length === 0" class="py-8 text-center border-2 border-dashed border-gray-200 rounded-2xl bg-gray-50/50">
        <svg class="mx-auto h-10 w-10 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
        </svg>
        <p class="text-sm font-medium text-gray-600 mt-2">Belum ada highlight</p>
        <p class="text-xs text-gray-400 mt-0.5">Tambahkan poin keunggulan utama dari kegiatan ini.</p>
    </div>

    <div class="space-y-4" x-show="highlights.length > 0">
        <template x-for="(highlight, index) in highlights" :key="index">
            <div class="bg-gray-50/70 border border-gray-200/80 rounded-2xl p-5 relative transition hover:border-gray-300">
                <div class="flex items-center justify-between mb-4 pb-2 border-b border-gray-200/60">
                    <span class="inline-flex items-center gap-1.5 text-xs font-bold text-gray-700 bg-white px-2.5 py-1 rounded-lg border border-gray-200 shadow-sm" x-text="`#${index + 1} Highlight`"></span>
                    <button type="button" @click="highlights.splice(index, 1)" 
                            class="inline-flex items-center gap-1 text-xs font-semibold text-red-600 hover:text-red-700 hover:bg-red-50 px-2.5 py-1 rounded-lg transition">
                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                        Hapus
                    </button>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-semibold text-gray-700 mb-1">Judul Highlight</label>
                        <input type="text" x-model="highlight.title" :name="`highlights[${index}][title]`" placeholder="Contoh: Sertifikat Resmi & Relasi Luas" 
                               class="w-full rounded-xl border border-gray-300 bg-white px-3.5 py-2 text-sm text-gray-900 focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 shadow-sm transition">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-700 mb-1">Nama Icon FontAwesome</label>
                        <input type="text" x-model="highlight.icon" :name="`highlights[${index}][icon]`" placeholder="Contoh: certificate, users, book, star" 
                               class="w-full rounded-xl border border-gray-300 bg-white px-3.5 py-2 text-sm text-gray-900 focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 shadow-sm transition">
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-xs font-semibold text-gray-700 mb-1">Deskripsi Singkat</label>
                        <textarea x-model="highlight.description" :name="`highlights[${index}][description]`" rows="2" placeholder="Penjelasan singkat mengenai keunggulan ini..." 
                                  class="w-full rounded-xl border border-gray-300 bg-white px-3.5 py-2 text-sm text-gray-900 focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 shadow-sm transition"></textarea>
                    </div>
                </div>
            </div>
        </template>
    </div>
</div>
