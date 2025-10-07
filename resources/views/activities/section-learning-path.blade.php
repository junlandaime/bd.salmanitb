<!-- Learning Path Section -->
<div class="max-w-4xl mx-auto my-20 px-8" x-data="{ showAll: false, visibleCount: 3 }">
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

        <!-- Mobile Timeline line -->
        <div class="md:hidden absolute left-5 top-0 h-full w-0.5 bg-gradient-to-b from-green-400 to-emerald-600"></div>
        <!-- Timeline items -->
        <div class="space-y-8 md:space-y-12 relative">
            @foreach ($learningPaths as $index => $path)
                @php
                    $isLeft = $index % 2 === 0;
                @endphp
                <div x-data="{ show: false }" x-intersect="show = true"
                    x-show="showAll || {{ $index }} < visibleCount"
                    x-transition:enter="transition ease-out duration-500"
                    x-transition:enter-start="opacity-0 transform scale-95"
                    x-transition:enter-end="opacity-100 transform scale-100"
                    x-transition:leave="transition ease-in duration-300"
                    x-transition:leave-start="opacity-100 transform scale-100"
                    x-transition:leave-end="opacity-0 transform scale-95" class="relative">

                    <!-- Mobile Layout (visible on mobile only) -->
                    <div class="md:hidden flex items-start space-x-4">
                        <!-- Timeline Circle for Mobile -->
                        <div
                            class="w-10 h-10 rounded-full border-3 {{ $isLeft ? 'border-green-400 bg-green-50' : 'border-emerald-500 bg-emerald-50' }} flex items-center justify-center shadow-md flex-shrink-0 mt-1">
                            <span
                                class="{{ $isLeft ? 'text-green-600' : 'text-emerald-600' }} font-bold text-sm">{{ $path->order }}</span>
                        </div>

                        <!-- Content for Mobile -->
                        <div class="flex-1" x-show="show" x-transition:enter="transition ease-out duration-700"
                            x-transition:enter-start="opacity-0 transform translate-x-8"
                            x-transition:enter-end="opacity-100 transform translate-x-0">
                            <div
                                class="bg-white rounded-lg shadow-md p-4 border-l-3 {{ $isLeft ? 'border-green-400' : 'border-emerald-500' }} hover:shadow-lg transition-shadow duration-300">
                                <h4 class="text-lg font-semibold text-gray-900 mb-2">{{ $path->title }}</h4>
                                <p class="text-gray-600 text-sm mb-2">{{ $path->description }}</p>
                                <p class="text-xs {{ $isLeft ? 'text-green-600' : 'text-emerald-600' }}">
                                    <span class="font-semibold">Pemateri:</span> {{ $path->mentors }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Desktop Layout (hidden on mobile) -->
                    <div class="hidden md:flex items-center relative">
                        <!-- Left Content (only show when isLeft = true) -->
                        <div class="flex-1 pr-8">
                            @if ($isLeft)
                                <div x-show="show" x-transition:enter="transition ease-out duration-700"
                                    x-transition:enter-start="opacity-0 transform -translate-x-16"
                                    x-transition:enter-end="opacity-100 transform translate-x-0" class="text-right">
                                    <div
                                        class="bg-white rounded-lg shadow-lg p-6 border-r-4 border-green-400 hover:shadow-xl transition-shadow duration-300 ml-auto max-w-md">
                                        <h4 class="text-xl font-semibold text-gray-900 mb-2">{{ $path->title }}</h4>
                                        <p class="text-gray-600 mb-3">{{ $path->description }}</p>
                                        <p class="text-sm text-green-600">
                                            <span class="font-semibold">Pemateri:</span> {{ $path->mentors }}
                                        </p>
                                    </div>
                                </div>
                            @endif
                        </div>

                        <!-- Timeline Circle (always in center) -->
                        <div
                            class="w-12 h-12 rounded-full border-4 {{ $isLeft ? 'border-green-400 bg-green-50' : 'border-emerald-500 bg-emerald-50' }} flex items-center justify-center relative z-10 shadow-lg flex-shrink-0">
                            <span
                                class="{{ $isLeft ? 'text-green-600' : 'text-emerald-600' }} font-bold">{{ $path->order }}</span>
                        </div>

                        <!-- Right Content (only show when isLeft = false) -->
                        <div class="flex-1 pl-8">
                            @if (!$isLeft)
                                <div x-show="show" x-transition:enter="transition ease-out duration-700"
                                    x-transition:enter-start="opacity-0 transform translate-x-16"
                                    x-transition:enter-end="opacity-100 transform translate-x-0" class="text-left">
                                    <div
                                        class="bg-white rounded-lg shadow-lg p-6 border-l-4 border-emerald-500 hover:shadow-xl transition-shadow duration-300 mr-auto max-w-md">
                                        <h4 class="text-xl font-semibold text-gray-900 mb-2">{{ $path->title }}</h4>
                                        <p class="text-gray-600 mb-3">{{ $path->description }}</p>
                                        <p class="text-sm text-emerald-600">
                                            <span class="font-semibold">Pemateri:</span> {{ $path->mentors }}
                                        </p>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Show More/Show Less Button -->
    <div class="text-center mt-12" x-show="{{ count($learningPaths) }} > visibleCount">
        <button @click="showAll = !showAll"
            class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-green-400 to-emerald-600 text-white font-semibold rounded-full hover:from-green-500 hover:to-emerald-700 transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl">
            <span
                x-text="showAll ? 'Tampilkan Lebih Sedikit' : 'Tampilkan Semua (' + ({{ count($learningPaths) }} - visibleCount) + ' lainnya)'"></span>
            <svg x-show="!showAll" class="w-5 h-5 ml-2 transition-transform duration-300" fill="none"
                stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
            </svg>
            <svg x-show="showAll" class="w-5 h-5 ml-2 transition-transform duration-300" fill="none"
                stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"></path>
            </svg>
        </button>
    </div>
</div>
