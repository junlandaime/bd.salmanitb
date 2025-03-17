<!-- Testimonials Section -->
<section class="py-20 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="text-center mb-16">
            <h3 class="text-2xl font-bold mb-4 bg-clip-text text-transparent bg-gradient-to-r from-green-600 to-emerald-500">
                Testimoni Alumni {{ $activity->title }}
            </h3>
            <p class="text-gray-600 max-w-2xl mx-auto">
                Dengarkan langsung pengalaman dari alumni yang telah mengikuti kegiatan ini
            </p>
        </div>

        <div class="max-w-5xl mx-auto" x-data="{ activeSlide: 0 }">
            <div class="relative rounded-xl overflow-hidden shadow-xl bg-white">
                <!-- Testimonial Slides -->
                <div class="overflow-hidden">
                    <div class="flex transition-transform duration-500" :style="`transform: translateX(-${activeSlide * 100}%)`">
                        @foreach($testimonials as $index => $testimonial)
                            <div class="min-w-full grid grid-cols-1 md:grid-cols-5 items-center">
                                <div class="md:col-span-2 h-full">
                                    <img src="{{ $testimonial->image }}" alt="Testimonial {{ $index + 1 }}" class="object-cover h-full w-full">
                                </div>
                                <div class="p-8 md:p-12 md:col-span-3">
                                    <svg class="text-green-200 fill-current w-12 h-12 mb-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                        <path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z"/>
                                    </svg>
                                    <p class="text-gray-600 text-lg mb-6">{{ $testimonial->content }}</p>
                                    <div>
                                        <h4 class="font-semibold text-gray-900">{{ $testimonial->name }}</h4>
                                        <p class="text-green-600">{{ $testimonial->role }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                
                <!-- Controls -->
                <button class="absolute top-1/2 left-4 transform -translate-y-1/2 w-12 h-12 rounded-full bg-white shadow-lg flex items-center justify-center text-green-600 focus:outline-none" 
                        @click="activeSlide = activeSlide === 0 ? {{ count($testimonials) - 1 }} : activeSlide - 1">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                </button>
                <button class="absolute top-1/2 right-4 transform -translate-y-1/2 w-12 h-12 rounded-full bg-white shadow-lg flex items-center justify-center text-green-600 focus:outline-none" 
                        @click="activeSlide = activeSlide === {{ count($testimonials) - 1 }} ? 0 : activeSlide + 1">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </button>
            </div>
            
            <!-- Indicators -->
            <div class="flex justify-center mt-6 space-x-2">
                @foreach($testimonials as $index => $testimonial)
                    <button class="w-3 h-3 rounded-full focus:outline-none transition-colors duration-300" 
                            :class="activeSlide === {{ $index }} ? 'bg-green-600' : 'bg-gray-300'"
                            @click="activeSlide = {{ $index }}">
                    </button>
                @endforeach
            </div>
        </div>
    </div>
</section>
