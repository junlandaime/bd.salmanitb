<!-- FAQ Section -->
<section class="py-20 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="text-center mb-16">
            <h3 class="text-2xl font-bold mb-4 bg-clip-text text-transparent bg-gradient-to-r from-green-600 to-emerald-500">
                Pertanyaan Umum
            </h3>
            <p class="text-gray-600 max-w-2xl mx-auto">
                Temukan jawaban untuk pertanyaan yang sering diajukan
            </p>
        </div>

        <div class="max-w-3xl mx-auto">
            <div x-data="{ activeTab: null }" class="space-y-6">
                @foreach($faqs as $index => $faq)
                    <div class="border border-gray-200 rounded-lg overflow-hidden">
                        <button class="w-full flex items-center justify-between p-5 focus:outline-none" 
                                @click="activeTab = activeTab === {{ $index }} ? null : {{ $index }}">
                            <span class="font-medium text-lg text-left">{{ $faq->question }}</span>
                            <svg class="w-5 h-5 text-gray-500 transform transition-transform duration-300" 
                                 :class="activeTab === {{ $index }} ? 'rotate-180' : ''" 
                                 fill="none" 
                                 stroke="currentColor" 
                                 viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        <div x-show="activeTab === {{ $index }}"
                             x-collapse
                             x-cloak
                             class="px-5 pb-5">
                            <p class="text-gray-600">{{ $faq->answer }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
