{{-- ========================= FAQ SECTION ========================= --}}
@if (isset($faqs) && $faqs->count())
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
                    PUNYA PERTANYAAN?
                </span>
                <h2 class="text-3xl md:text-4xl font-bold mb-4">
                    Pertanyaan yang Sering Diajukan
                </h2>
                <div class="h-1 w-20 bg-gradient-to-r from-emerald-600 to-emerald-400 rounded-full mx-auto mb-4"></div>
                <p class="text-gray-600 max-w-2xl mx-auto">
                    Temukan jawaban untuk pertanyaan yang sering diajukan seputar
                    {{ $activity->title ?? 'kegiatan ini' }}
                </p>
            </div>

            {{-- FAQ Accordion --}}
            <div class="max-w-4xl mx-auto" data-aos="fade-up" data-aos-delay="200">
                <div x-data="{ activeTab: null, showAll: false, visibleCount: 3 }" class="space-y-4">
                    @foreach ($faqs as $index => $faq)
                        <div x-show="showAll || {{ $index }} < visibleCount"
                            x-transition:enter="transition ease-out duration-500"
                            x-transition:enter-start="opacity-0 transform scale-95"
                            x-transition:enter-end="opacity-100 transform scale-100"
                            x-transition:leave="transition ease-in duration-300"
                            x-transition:leave-start="opacity-100 transform scale-100"
                            x-transition:leave-end="opacity-0 transform scale-95"
                            class="group border border-gray-200 rounded-2xl overflow-hidden bg-white shadow-sm hover:shadow-lg transition-all duration-300"
                            :class="activeTab === {{ $index }} ? 'border-emerald-200 shadow-lg' : 'hover:border-gray-300'">

                            {{-- Question Button --}}
                            <button
                                class="w-full flex items-start justify-between gap-4 p-6 text-left focus:outline-none focus:ring-2 focus:ring-emerald-400 focus:ring-offset-2 rounded-2xl transition-colors"
                                :class="activeTab === {{ $index }} ? 'bg-emerald-50/50' : 'hover:bg-gray-50'"
                                @click="activeTab = activeTab === {{ $index }} ? null : {{ $index }}">

                                {{-- Question Number & Text --}}
                                <div class="flex items-start gap-4 flex-1">
                                    <div class="flex-shrink-0 w-8 h-8 rounded-lg flex items-center justify-center text-sm font-bold transition-all duration-300"
                                        :class="activeTab === {{ $index }} ? 'bg-emerald-600 text-white' :
                                            'bg-gray-100 text-gray-600 group-hover:bg-emerald-100 group-hover:text-emerald-600'">
                                        {{ $index + 1 }}
                                    </div>
                                    <span class="font-semibold text-lg text-gray-900 pt-0.5">
                                        {{ $faq->question }}
                                    </span>
                                </div>

                                {{-- Toggle Icon --}}
                                <div class="flex-shrink-0 w-8 h-8 rounded-lg flex items-center justify-center transition-all duration-300"
                                    :class="activeTab === {{ $index }} ? 'bg-emerald-600 rotate-180' :
                                        'bg-gray-100 group-hover:bg-emerald-100'">
                                    <svg class="w-5 h-5 transition-colors"
                                        :class="activeTab === {{ $index }} ? 'text-white' :
                                            'text-gray-600 group-hover:text-emerald-600'"
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </div>
                            </button>

                            {{-- Answer Content --}}
                            <div x-show="activeTab === {{ $index }}" x-collapse x-cloak>
                                <div class="px-6 pb-6 pt-2">
                                    <div class="pl-12 pr-12">
                                        {{-- Decorative Line --}}
                                        <div
                                            class="h-px bg-gradient-to-r from-emerald-200 via-emerald-300 to-emerald-200 mb-4">
                                        </div>

                                        {{-- Answer Text --}}
                                        <div class="prose prose-gray max-w-none">
                                            <p class="text-gray-600 leading-relaxed">
                                                {{ $faq->answer }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    {{-- Show More/Show Less Button --}}
                    <div class="text-center mt-8" x-show="{{ $faqs->count() }} > visibleCount">
                        <button @click="showAll = !showAll"
                            class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-emerald-500 to-emerald-600 text-white font-semibold rounded-full hover:from-emerald-600 hover:to-emerald-700 transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl">
                            <span
                                x-text="showAll ? 'Tampilkan Lebih Sedikit' : 'Tampilkan Semua (' + ({{ $faqs->count() }} - visibleCount) + ' lainnya)'"></span>
                            <svg x-show="!showAll" class="w-5 h-5 ml-2 transition-transform duration-300" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7"></path>
                            </svg>
                            <svg x-show="showAll" class="w-5 h-5 ml-2 transition-transform duration-300" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7">
                                </path>
                            </svg>
                        </button>
                    </div>
                </div>

                {{-- Contact CTA --}}
                <div class="mt-12 p-8 rounded-2xl bg-gradient-to-br from-emerald-50 to-emerald-100/50 border border-emerald-200"
                    data-aos="fade-up" data-aos-delay="400">
                    <div class="flex flex-col md:flex-row items-center justify-between gap-6">
                        <div class="text-center md:text-left">
                            <h3 class="text-xl font-bold text-gray-900 mb-2">
                                Masih punya pertanyaan lain?
                            </h3>
                            <p class="text-gray-600">
                                Tim kami siap membantu menjawab pertanyaan Anda
                            </p>
                        </div>
                        <a href="#"
                            class="inline-flex items-center gap-2 px-6 py-3 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-semibold shadow-lg hover:shadow-xl transition-all duration-300 hover:scale-105 whitespace-nowrap">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                            </svg>
                            Hubungi Kami
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endif
