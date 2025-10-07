{{-- ========================= GALLERY SECTION ========================= --}}
@if (isset($gallery) && (is_array($gallery) ? count($gallery) : $gallery->count()))
    <section class="py-16 bg-white relative overflow-hidden">
        {{-- Decorative Elements --}}
        <div aria-hidden="true" class="absolute top-0 left-0 w-96 h-96 bg-emerald-100/20 rounded-full blur-3xl -z-10">
        </div>
        <div aria-hidden="true" class="absolute bottom-0 right-0 w-96 h-96 bg-emerald-50/30 rounded-full blur-3xl -z-10">
        </div>

        <div class="soft-container">
            {{-- Section Header --}}
            <div class="text-center mb-12" data-aos="fade-up">
                <span
                    class="inline-flex px-3 py-1 rounded-full bg-emerald-100 text-emerald-700 section-badge text-xs mb-3">
                    DOKUMENTASI KEGIATAN
                </span>
                <h2 class="text-3xl md:text-4xl font-bold mb-4">
                    Galeri {{ $activity->title }}
                </h2>
                <div class="h-1 w-20 bg-gradient-to-r from-emerald-600 to-emerald-400 rounded-full mx-auto mb-4"></div>
                <p class="text-gray-600 max-w-2xl mx-auto">
                    Momen-momen berharga dan keseruan yang telah kami lalui bersama dalam kegiatan ini
                </p>
            </div>

            {{-- Gallery Grid --}}
            <div x-data="{ activeImage: null, activeCaption: null }" class="relative">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($gallery as $index => $image)
                        <div data-aos="zoom-in" data-aos-delay="{{ $index * 50 }}" class="group">
                            <figure
                                class="relative overflow-hidden rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500 cursor-pointer bg-gray-100 aspect-[4/3]"
                                @click="activeImage = '{{ Storage::url($image->image) }}'; activeCaption = '{{ $image->caption ?? '' }}'">

                                {{-- Image --}}
                                <img src="{{ Storage::url($image->image) }}"
                                    alt="{{ $image->caption ?? 'Gallery Image' }}"
                                    class="w-full h-full object-cover transform transition-transform duration-700 group-hover:scale-110">

                                {{-- Overlay --}}
                                <div
                                    class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/0 to-black/0 opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                                    <div
                                        class="absolute bottom-0 left-0 right-0 p-6 transform translate-y-4 group-hover:translate-y-0 transition-transform duration-500">
                                        @if ($image->caption ?? false)
                                            <p class="text-white text-sm font-medium mb-2">{{ $image->caption }}</p>
                                        @endif
                                        <div class="flex items-center gap-2 text-white text-sm font-semibold">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                            <span>Lihat Detail</span>
                                        </div>
                                    </div>
                                </div>

                                {{-- Decorative Corner --}}
                                <div
                                    class="absolute top-4 right-4 w-12 h-12 border-t-2 border-r-2 border-white/0 group-hover:border-white/60 rounded-tr-xl transition-all duration-500">
                                </div>
                            </figure>
                        </div>
                    @endforeach
                </div>

                {{-- Lightbox Modal --}}
                <div x-show="activeImage" x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                    x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100"
                    x-transition:leave-end="opacity-0"
                    class="fixed inset-0 bg-black/95 backdrop-blur-sm z-50 flex items-center justify-center p-4"
                    @click="activeImage = null; activeCaption = null" style="display: none;">

                    {{-- Close Button --}}
                    <button @click="activeImage = null; activeCaption = null"
                        class="absolute top-6 right-6 w-12 h-12 rounded-full bg-white/10 hover:bg-white/20 backdrop-blur-sm flex items-center justify-center text-white transition-all duration-300 hover:scale-110 hover:rotate-90 z-10"
                        aria-label="Tutup">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>

                    {{-- Image Container --}}
                    <div @click.stop class="relative max-w-7xl w-full">
                        <img :src="activeImage"
                            class="w-full h-auto max-h-[85vh] object-contain rounded-2xl shadow-2xl"
                            x-transition:enter="transition ease-out duration-300 transform"
                            x-transition:enter-start="opacity-0 scale-95"
                            x-transition:enter-end="opacity-100 scale-100">

                        {{-- Caption --}}
                        <div x-show="activeCaption"
                            class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/80 to-transparent p-6 rounded-b-2xl">
                            <p class="text-white text-center font-medium" x-text="activeCaption"></p>
                        </div>
                    </div>

                    {{-- Helper Text --}}
                    <div class="absolute bottom-6 left-1/2 -translate-x-1/2 text-white/60 text-sm">
                        Klik di luar gambar untuk menutup
                    </div>
                </div>
            </div>

            {{-- View More CTA (Optional) --}}
            @if ($gallery->count() > 9)
                <div class="text-center mt-12" data-aos="fade-up">
                    <button
                        class="inline-flex items-center gap-2 px-6 py-3 rounded-xl bg-emerald-100 hover:bg-emerald-200 text-emerald-700 font-semibold transition-all duration-300 hover:scale-105">
                        Lihat Lebih Banyak
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                </div>
            @endif
        </div>
    </section>
@endif
