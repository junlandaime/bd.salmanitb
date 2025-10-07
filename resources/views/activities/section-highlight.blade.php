{{-- ========================= HIGHLIGHTS SECTION ========================= --}}
@if ($highlights->isNotEmpty())
    <section class="py-16 bg-gradient-to-br from-gray-50 to-white relative overflow-hidden">
        {{-- Decorative Elements --}}
        <div aria-hidden="true" class="absolute top-0 right-0 w-96 h-96 bg-emerald-100/30 rounded-full blur-3xl -z-10">
        </div>
        <div aria-hidden="true" class="absolute bottom-0 left-0 w-96 h-96 bg-emerald-50/50 rounded-full blur-3xl -z-10">
        </div>

        <div class="soft-container">
            {{-- Section Header --}}
            <div class="text-center mb-12" data-aos="fade-up">
                <span
                    class="inline-flex px-3 py-1 rounded-full bg-emerald-100 text-emerald-700 section-badge text-xs mb-3">
                    KEUNGGULAN PROGRAM
                </span>
                <h2 class="text-3xl md:text-4xl font-bold mb-4">
                    Mengapa Mengikuti {{ $activity->title }}?
                </h2>
                <div class="h-1 w-20 bg-gradient-to-r from-emerald-600 to-emerald-400 rounded-full mx-auto"></div>
            </div>

            {{-- Highlights Grid --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach ($highlights as $index => $highlight)
                    <div data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">
                        <div x-data="{ hover: false }" @mouseenter="hover = true" @mouseleave="hover = false"
                            class="group relative bg-white rounded-2xl p-8 shadow-lg hover:shadow-2xl transition-all duration-500 h-full border border-gray-100 hover:border-emerald-200">

                            {{-- Gradient Border Effect on Hover --}}
                            <div
                                class="absolute inset-0 rounded-2xl bg-gradient-to-br from-emerald-400/0 to-emerald-600/0 group-hover:from-emerald-400/5 group-hover:to-emerald-600/5 transition-all duration-500 -z-10">
                            </div>

                            {{-- Icon Container --}}
                            <div class="relative mb-6">
                                <div class="w-16 h-16 mx-auto rounded-xl bg-gradient-to-br from-emerald-400 to-emerald-600 flex items-center justify-center transform transition-all duration-500 shadow-lg"
                                    :class="{ 'scale-110 rotate-3': hover }">
                                    <i class="fas fa-{{ $highlight->icon }} text-3xl text-white"></i>
                                </div>

                                {{-- Decorative Ring --}}
                                <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-20 h-20 rounded-xl border-2 border-emerald-200/50 -z-10 transition-all duration-500"
                                    :class="{ 'scale-125 opacity-0': hover }"></div>
                            </div>

                            {{-- Content --}}
                            <div class="text-center">
                                <h4
                                    class="text-xl font-bold text-gray-900 mb-3 group-hover:text-emerald-600 transition-colors duration-300">
                                    {{ $highlight->title }}
                                </h4>
                                <p class="text-gray-600 leading-relaxed">
                                    {{ $highlight->description }}
                                </p>
                            </div>

                            {{-- Hover Accent --}}
                            <div
                                class="absolute bottom-0 left-0 right-0 h-1 bg-gradient-to-r from-emerald-400 to-emerald-600 rounded-b-2xl transform scale-x-0 group-hover:scale-x-100 transition-transform duration-500 origin-left">
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Optional CTA --}}
            @if ($registrationStatus['open'] ?? false)
                <div class="text-center mt-12" data-aos="fade-up" data-aos-delay="400">
                    <a href="#daftar"
                        class="inline-flex items-center gap-2 px-6 py-3 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-semibold shadow-lg hover:shadow-xl transition-all duration-300 hover:scale-105">
                        Daftar Sekarang
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 7l5 5m0 0l-5 5m5-5H6" />
                        </svg>
                    </a>
                </div>
            @endif
        </div>
    </section>
@endif
