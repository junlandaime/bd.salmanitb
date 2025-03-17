<!-- FAQs Section -->
<div class="bg-white shadow rounded-lg p-6" 
     x-data="{ 
        faqs: @if(isset($activity)) {{ json_encode($activity->faqs) }} @else [] @endif 
     }">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-lg font-medium text-gray-900">FAQs</h2>
        <button type="button" @click="faqs.push({})" 
                class="bg-green-500 text-white px-3 py-1 rounded-md hover:bg-green-600">
            Add FAQ
        </button>
    </div>

    <div class="space-y-4">
        <template x-for="(faq, index) in faqs" :key="index">
            <div class="border rounded-lg p-4">
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Question</label>
                        <input type="text" x-model="faq.question" :name="`faqs[${index}][question]`" 
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Answer</label>
                        <textarea x-model="faq.answer" :name="`faqs[${index}][answer]`" rows="3" 
                                  class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500"></textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Order</label>
                        <input type="number" x-model="faq.order" :name="`faqs[${index}][order]`" 
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500">
                    </div>
                    <div class="flex justify-end">
                        <button type="button" @click="faqs.splice(index, 1)" 
                                class="text-red-600 hover:text-red-800">Remove</button>
                    </div>
                </div>
            </div>
        </template>
    </div>
</div>
