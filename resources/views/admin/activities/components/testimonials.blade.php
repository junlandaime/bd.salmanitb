<!-- Testimonials Section -->
<div class="bg-white rounded-2xl border border-gray-200/80 shadow-sm p-6 sm:p-8" 
     x-data="{ 
        testimonials: @if(isset($activity)) {{ json_encode($activity->testimonials) }} @else [] @endif 
     }">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-6 pb-4 border-b border-gray-100">
        <div>
            <h2 class="text-base font-bold text-gray-900 flex items-center gap-2">
                <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                Testimoni Alumni / Peserta
            </h2>
            <p class="text-xs text-gray-500 mt-0.5">Ulasan dan kesan dari peserta angkatan sebelumnya.</p>
        </div>
        <button type="button" @click="testimonials.push({name: '', role: '', content: ''})" 
                class="inline-flex items-center gap-1.5 px-3.5 py-2 rounded-xl bg-emerald-50 text-emerald-700 hover:bg-emerald-100 border border-emerald-200/60 font-semibold text-xs shadow-sm transition">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            Tambah Testimoni
        </button>
    </div>

    <!-- Empty State -->
    <div x-show="testimonials.length === 0" class="py-8 text-center border-2 border-dashed border-gray-200 rounded-2xl bg-gray-50/50">
        <svg class="mx-auto h-10 w-10 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
        </svg>
        <p class="text-sm font-medium text-gray-600 mt-2">Belum ada testimoni</p>
        <p class="text-xs text-gray-400 mt-0.5">Tambahkan testimoni untuk membangun kepercayaan calon peserta.</p>
    </div>

    <div class="space-y-4" x-show="testimonials.length > 0">
        <template x-for="(testimonial, index) in testimonials" :key="index">
            <div class="bg-gray-50/70 border border-gray-200/80 rounded-2xl p-5 relative transition hover:border-gray-300">
                <div class="flex items-center justify-between mb-4 pb-2 border-b border-gray-200/60">
                    <span class="inline-flex items-center gap-1.5 text-xs font-bold text-gray-700 bg-white px-2.5 py-1 rounded-lg border border-gray-200 shadow-sm" x-text="`#${index + 1} Testimoni`"></span>
                    <button type="button" @click="testimonials.splice(index, 1)" 
                            class="inline-flex items-center gap-1 text-xs font-semibold text-red-600 hover:text-red-700 hover:bg-red-50 px-2.5 py-1 rounded-lg transition">
                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                        Hapus
                    </button>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-semibold text-gray-700 mb-1">Nama Peserta / Tokoh</label>
                        <input type="text" x-model="testimonial.name" :name="`testimonials[${index}][name]`" placeholder="Contoh: Ahmad Fauzan" 
                               class="w-full rounded-xl border border-gray-300 bg-white px-3.5 py-2 text-sm text-gray-900 focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 shadow-sm transition">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-700 mb-1">Profesi / Angkatan (Role)</label>
                        <input type="text" x-model="testimonial.role" :name="`testimonials[${index}][role]`" placeholder="Contoh: Alumni Salman ITB 2023" 
                               class="w-full rounded-xl border border-gray-300 bg-white px-3.5 py-2 text-sm text-gray-900 focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 shadow-sm transition">
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-xs font-semibold text-gray-700 mb-1">Isi Testimoni</label>
                        <textarea x-model="testimonial.content" :name="`testimonials[${index}][content]`" rows="3" placeholder="Ceritakan pengalaman dan manfaat yang dirasakan..." 
                                  class="w-full rounded-xl border border-gray-300 bg-white px-3.5 py-2 text-sm text-gray-900 focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 shadow-sm transition"></textarea>
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-xs font-semibold text-gray-700 mb-1">Foto Peserta</label>
                        <input type="file" :name="`testimonials[${index}][photo]`" 
                               class="w-full text-xs text-gray-500 file:mr-3 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100 cursor-pointer">
                    </div>
                </div>
            </div>
        </template>
    </div>
</div>
