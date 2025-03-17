<!-- Highlights Section -->
<div class="text-center mb-16 px-4 sm:px-6 lg:px-28">
    <h3 class="text-2xl font-bold mb-12 relative inline-block">
        Mengapa Mengikuti {{ $activity->title }}?
        <div class="h-1 w-full bg-gradient-to-r from-green-400 to-emerald-600 absolute -bottom-2"></div>
    </h3>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        @foreach ($highlights as $highlight)
            <div x-data="{ hover: false }" @mouseenter="hover = true" @mouseleave="hover = false"
                class="bg-white p-8 rounded-lg shadow-lg overflow-hidden transition-all duration-300 hover:shadow-2xl transform hover:-translate-y-2">
                <div class="relative">
                    <div class="mx-auto w-16 h-16 rounded-xl overflow-hidden bg-gradient-to-br from-green-400 to-emerald-600 flex items-center justify-center mb-6 transform transition-all duration-300"
                        :class="{ 'scale-110': hover }">
                        {{-- <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="{{ $highlight->icon }}"></path>
                        </svg> --}}
                        <i class="fas fa-{{ $highlight->icon }} text-3xl text-white"></i>
                    </div>
                    <h4 class="text-xl font-semibold mb-4 text-gray-900">{{ $highlight->title }}</h4>
                    <p class="text-gray-600">{{ $highlight->description }}</p>
                </div>
            </div>
        @endforeach
    </div>
</div>
