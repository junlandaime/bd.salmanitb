{{-- ========================= TESTIMONIALS SECTION ========================= --}}
@if (isset($testimonials) && $testimonials->count())
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
                    KATA MEREKA
                </span>
                <h2 class="text-3xl md:text-4xl font-bold mb-4">
                    Testimoni Alumni {{ $activity->title }}
                </h2>
                <div class="h-1 w-20 bg-gradient-to-r from-emerald-600 to-emerald-400 rounded-full mx-auto mb-4"></div>
                <p class="text-gray-600 max-w-2xl mx-auto">
                    Dengarkan langsung pengalaman dari alumni yang telah mengikuti kegiatan ini
                </p>
            </div>

            {{-- Testimonial Carousel --}}
            <div class="max-w-6xl mx-auto" data-aos="fade-up" data-aos-delay="200">
                <div x-data="{
                    activeSlide: 0,
                    totalSlides: {{ $testimonials->count() }},
                    autoplay: true,
                    interval: null,
                    startAutoplay() {
                        this.interval = setInterval(() => {
                            if (this.autoplay) {
                                this.next();
                            }
                        }, 5000);
                    },
                    stopAutoplay() {
                        this.autoplay = false;
                        clearInterval(this.interval);
                    },
                    prev() {
                        this.activeSlide = this.activeSlide === 0 ? this.totalSlides - 1 : this.activeSlide - 1;
                    },
                    next() {
                        this.activeSlide = this.activeSlide === this.totalSlides - 1 ? 0 : this.activeSlide + 1;
                    }
                }" x-init="startAutoplay()" @mouseenter="stopAutoplay()" class="relative">

                    {{-- Main Carousel Container --}}
                    <div class="relative rounded-2xl overflow-hidden shadow-2xl bg-white border border-gray-100">
                        {{-- Slides --}}
                        <div class="overflow-hidden">
                            <div class="flex transition-transform duration-700 ease-out"
                                :style="`transform: translateX(-${activeSlide * 100}%)`">
                                @foreach ($testimonials as $index => $testimonial)
                                    <div class="min-w-full">
                                        <div class="grid grid-cols-1 md:grid-cols-5 items-stretch">
                                            {{-- Image Section --}}
                                            <div
                                                class="md:col-span-2 relative overflow-hidden bg-gradient-to-br from-emerald-50 to-emerald-100">
                                                @if ($testimonial->image)
                                                    <img src="{{ Storage::url($testimonial->image) }}"
                                                        alt="{{ $testimonial->name }}"
                                                        class="w-full h-full object-cover min-h-[300px] md:min-h-[400px]">
                                                    {{-- Gradient Overlay --}}
                                                    <div
                                                        class="absolute inset-0 bg-gradient-to-t from-emerald-900/20 to-transparent">
                                                    </div>
                                                @else
                                                    <div
                                                        class="w-full h-full min-h-[300px] md:min-h-[400px] flex items-center justify-center">
                                                        <div class="text-center">
                                                            <div
                                                                class="w-20 h-20 mx-auto mb-4 rounded-full bg-emerald-600 flex items-center justify-center">
                                                                <svg class="w-10 h-10 text-white" fill="none"
                                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                                        stroke-width="2"
                                                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                                                </svg>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>

                                            {{-- Content Section --}}
                                            <div
                                                class="md:col-span-3 p-8 md:p-12 flex flex-col justify-center relative">
                                                {{-- Quote Icon --}}
                                                <div class="absolute top-6 right-6 opacity-5">
                                                    <svg class="w-32 h-32 text-emerald-600 fill-current"
                                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                                        <path
                                                            d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z" />
                                                    </svg>
                                                </div>

                                                {{-- Quote Icon (visible) --}}
                                                <svg class="text-emerald-600 fill-current w-12 h-12 mb-6"
                                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                                    <path
                                                        d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z" />
                                                </svg>

                                                {{-- Testimonial Text --}}
                                                <p
                                                    class="text-gray-700 text-lg md:text-xl leading-relaxed mb-8 relative z-10">
                                                    "{{ $testimonial->content }}"
                                                </p>

                                                {{-- Author Info --}}
                                                <div class="flex items-center gap-4">
                                                    <div
                                                        class="w-1 h-16 bg-gradient-to-b from-emerald-600 to-emerald-400 rounded-full">
                                                    </div>
                                                    <div>
                                                        <h4 class="font-bold text-gray-900 text-lg">
                                                            {{ $testimonial->name }}</h4>
                                                        <p class="text-emerald-600 font-medium">{{ $testimonial->role }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        {{-- Navigation Buttons --}}
                        <button @click="prev()"
                            class="absolute top-1/2 left-4 -translate-y-1/2 w-12 h-12 rounded-full bg-white hover:bg-emerald-600 shadow-lg hover:shadow-xl flex items-center justify-center text-emerald-600 hover:text-white transition-all duration-300 hover:scale-110 group">
                            <svg class="w-6 h-6 transition-transform group-hover:-translate-x-0.5" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 19l-7-7 7-7" />
                            </svg>
                        </button>
                        <button @click="next()"
                            class="absolute top-1/2 right-4 -translate-y-1/2 w-12 h-12 rounded-full bg-white hover:bg-emerald-600 shadow-lg hover:shadow-xl flex items-center justify-center text-emerald-600 hover:text-white transition-all duration-300 hover:scale-110 group">
                            <svg class="w-6 h-6 transition-transform group-hover:translate-x-0.5" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5l7 7-7 7" />
                            </svg>
                        </button>
                    </div>

                    {{-- Indicators --}}
                    <div class="flex justify-center items-center gap-2 mt-8">
                        @foreach ($testimonials as $index => $testimonial)
                            <button @click="activeSlide = {{ $index }}; stopAutoplay()"
                                class="transition-all duration-300 rounded-full focus:outline-none focus:ring-2 focus:ring-emerald-400 focus:ring-offset-2"
                                :class="activeSlide === {{ $index }} ? 'w-8 h-3 bg-emerald-600' :
                                    'w-3 h-3 bg-gray-300 hover:bg-gray-400'"
                                aria-label="Go to testimonial {{ $index + 1 }}">
                            </button>
                        @endforeach
                    </div>

                    {{-- Counter --}}
                    <div class="text-center mt-4 text-sm text-gray-500">
                        <span x-text="activeSlide + 1"></span> / {{ $testimonials->count() }}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endif
