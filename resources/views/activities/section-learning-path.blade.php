<!-- Learning Path Section -->
<div class="max-w-4xl mx-auto my-20 px-8">
    <h3 class="text-2xl font-bold text-center mb-12 relative">
        <span class="inline-block relative">
            Perjalanan Belajar Anda
            <div class="h-1 w-full bg-gradient-to-r from-green-400 to-emerald-600 absolute -bottom-2"></div>
        </span>
    </h3>

    <div class="relative">
        <!-- Timeline line -->
        <div
            class="hidden md:block absolute left-1/2 transform -translate-x-1/2 h-full w-1 bg-gradient-to-b from-green-400 to-emerald-600">
        </div>

        <!-- Timeline items -->
        <div class="space-y-12 relative">
            @foreach ($learningPaths as $path)
                <div x-data="{ show: false }" x-intersect="show = true" class="flex flex-col md:flex-row items-center">
                    <div class="flex-1 md:pr-10 md:text-right order-2 md:order-1" x-show="show"
                        x-transition:enter="transition ease-out duration-700"
                        x-transition:enter-start="opacity-0 transform -translate-x-16"
                        x-transition:enter-end="opacity-100 transform translate-x-0">
                        <h4 class="text-xl font-semibold text-gray-900 mb-2">{{ $path->title }}</h4>
                        <p class="text-gray-600">{{ $path->description }}</p>
                        <p class="text-sm text-green-600 mt-2">
                            <span class="font-semibold">Pemateri:</span> {{ $path->mentors }}
                        </p>
                    </div>

                    <div
                        class="w-12 h-12 rounded-full border-4 border-green-400 bg-white flex items-center justify-center relative z-10 order-1 md:order-2">
                        <span class="text-green-600 font-bold">{{ $path->order }}</span>
                    </div>

                    <div class="flex-1 md:pl-10 order-3" x-show="show"
                        x-transition:enter="transition ease-out duration-700"
                        x-transition:enter-start="opacity-0 transform translate-x-16"
                        x-transition:enter-end="opacity-100 transform translate-x-0">
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
