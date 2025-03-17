<!-- Testimonials Section -->
<div class="bg-white shadow rounded-lg p-6" 
     x-data="{ 
        testimonials: @if(isset($activity)) {{ json_encode($activity->testimonials) }} @else [] @endif 
     }">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-lg font-medium text-gray-900">Testimonials</h2>
        <button type="button" @click="testimonials.push({})" 
                class="bg-green-500 text-white px-3 py-1 rounded-md hover:bg-green-600">
            Add Testimonial
        </button>
    </div>

    <div class="space-y-4">
        <template x-for="(testimonial, index) in testimonials" :key="index">
            <div class="border rounded-lg p-4">
                <div class="grid grid-cols-1 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Name</label>
                        <input type="text" x-model="testimonial.name" :name="`testimonials[${index}][name]`" 
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Role/Title</label>
                        <input type="text" x-model="testimonial.role" :name="`testimonials[${index}][role]`" 
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Content</label>
                        <textarea x-model="testimonial.content" :name="`testimonials[${index}][content]`" rows="3" 
                                  class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500"></textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Photo</label>
                        <input type="file" :name="`testimonials[${index}][photo]`" 
                               class="mt-1 block w-full">
                    </div>
                    <div class="flex justify-end">
                        <button type="button" @click="testimonials.splice(index, 1)" 
                                class="text-red-600 hover:text-red-800">Remove</button>
                    </div>
                </div>
            </div>
        </template>
    </div>
</div>
