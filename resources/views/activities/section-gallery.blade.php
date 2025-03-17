<!-- Gallery Section -->
<section class="py-20 bg-white sm:px-6 lg:px-28">
    <div div class ="container mx-auto px-4">
        <div class="text-center mb-16">
            <h3
                class="text-2xl font-bold mb-4 bg-clip-text text-transparent bg-gradient-to-r from-green-600 to-emerald-500">
                Galeri {{ $activity->title }}
            </h3>
            <p class="text-gray-600 max-w-2xl mx-auto">
                Lihat momen-momen berharga dalam kegiatan kami
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8" x-data="{ activeImage: null }">
            @foreach ($gallery as $image)
                <div x-data="{ hover: false }" @mouseenter="hover = true" @mouseleave="hover = false"
                    class="relative group overflow-hidden rounded-xl shadow-lg cursor-pointer transform transition-all duration-300 hover:-translate-y-2"
                    @click="activeImage = '{{ Storage::url($image->image) }}'">
                    <div class="aspect-w-16 aspect-h-12">
                        <img src="{{ Storage::url($image->image) }}" alt="{{ $image->title }}"
                            class="object-cover w-full h-full transform transition-transform duration-500 group-hover:scale-110">
                    </div>
                    <div
                        class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        <div class="absolute bottom-0 left-0 right-0 p-4 text-white">
                            <h4 class="font-semibold text-lg">{{ $image->title }}</h4>
                            <p class="text-sm text-gray-200">{{ $image->description }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
            <!-- Lightbox -->
            <div x-show="activeImage" x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"
                class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-90"
                @click="activeImage = null">
                <button @click="activeImage = null" class="absolute top-4 right-4 text-white">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
                <img :src="activeImage" class="max-h-[90vh] max-w-[90vw] object-contain">
            </div>
        </div>


    </div>
</section>
