<!-- FAQs Section -->
<div class="bg-white rounded-2xl border border-gray-200/80 shadow-sm p-6 sm:p-8" 
     x-data="{ 
        faqs: @if(isset($activity)) {{ json_encode($activity->faqs) }} @else [] @endif 
     }">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-6 pb-4 border-b border-gray-100">
        <div>
            <h2 class="text-base font-bold text-gray-900 flex items-center gap-2">
                <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                Pertanyaan yang Sering Diajukan (FAQ)
            </h2>
            <p class="text-xs text-gray-500 mt-0.5">Tanya jawab seputar syarat, teknis kegiatan, atau sertifikat.</p>
        </div>
        <button type="button" @click="faqs.push({question: '', answer: '', order: faqs.length + 1})" 
                class="inline-flex items-center gap-1.5 px-3.5 py-2 rounded-xl bg-emerald-50 text-emerald-700 hover:bg-emerald-100 border border-emerald-200/60 font-semibold text-xs shadow-sm transition">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            Tambah FAQ
        </button>
    </div>

    <!-- Empty State -->
    <div x-show="faqs.length === 0" class="py-8 text-center border-2 border-dashed border-gray-200 rounded-2xl bg-gray-50/50">
        <svg class="mx-auto h-10 w-10 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
        <p class="text-sm font-medium text-gray-600 mt-2">Belum ada FAQ</p>
        <p class="text-xs text-gray-400 mt-0.5">Tambahkan tanya jawab untuk memudahkan calon peserta.</p>
    </div>

    <div class="space-y-4" x-show="faqs.length > 0">
        <template x-for="(faq, index) in faqs" :key="index">
            <div class="bg-gray-50/70 border border-gray-200/80 rounded-2xl p-5 relative transition hover:border-gray-300">
                <div class="flex items-center justify-between mb-4 pb-2 border-b border-gray-200/60">
                    <span class="inline-flex items-center gap-1.5 text-xs font-bold text-gray-700 bg-white px-2.5 py-1 rounded-lg border border-gray-200 shadow-sm" x-text="`#${index + 1} FAQ`"></span>
                    <button type="button" @click="faqs.splice(index, 1)" 
                            class="inline-flex items-center gap-1 text-xs font-semibold text-red-600 hover:text-red-700 hover:bg-red-50 px-2.5 py-1 rounded-lg transition">
                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                        Hapus
                    </button>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div class="md:col-span-2">
                        <label class="block text-xs font-semibold text-gray-700 mb-1">Pertanyaan (Question)</label>
                        <input type="text" x-model="faq.question" :name="`faqs[${index}][question]`" placeholder="Contoh: Apakah kegiatan ini berbayar?" 
                               class="w-full rounded-xl border border-gray-300 bg-white px-3.5 py-2 text-sm text-gray-900 focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 shadow-sm transition">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-700 mb-1">Urutan</label>
                        <input type="number" x-model="faq.order" :name="`faqs[${index}][order]`" 
                               class="w-full rounded-xl border border-gray-300 bg-white px-3.5 py-2 text-sm text-gray-900 focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 shadow-sm transition">
                    </div>
                    <div class="md:col-span-3">
                        <label class="block text-xs font-semibold text-gray-700 mb-1">Jawaban (Answer)</label>
                        <textarea x-model="faq.answer" :name="`faqs[${index}][answer]`" rows="3" placeholder="Tuliskan jawaban yang lengkap dan jelas..." 
                                  class="w-full rounded-xl border border-gray-300 bg-white px-3.5 py-2 text-sm text-gray-900 focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 shadow-sm transition"></textarea>
                    </div>
                </div>
            </div>
        </template>
    </div>
</div>
