<!-- Highlights Section -->
<div class="bg-white shadow rounded-lg p-6" 
     x-data="{ 
        highlights: @if(isset($activity)) {{ json_encode($activity->highlights) }} @else [] @endif 
     }">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-lg font-medium text-gray-900">Highlights</h2>
        <button type="button" @click="highlights.push({})" 
                class="bg-green-500 text-white px-3 py-1 rounded-md hover:bg-green-600">
            Add Highlight
        </button>
    </div>

    <div class="space-y-4">
        <template x-for="(highlight, index) in highlights" :key="index">
            <div class="border rounded-lg p-4">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Title</label>
                        <input type="text" x-model="highlight.title" :name="`highlights[${index}][title]`" 
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Icon</label>
                        <input type="text" x-model="highlight.icon" :name="`highlights[${index}][icon]`" 
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500">
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700">Description</label>
                        <textarea x-model="highlight.description" :name="`highlights[${index}][description]`" rows="2" 
                                  class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500"></textarea>
                    </div>
                    <div class="md:col-span-2 flex justify-end">
                        <button type="button" @click="highlights.splice(index, 1)" 
                                class="text-red-600 hover:text-red-800">Remove</button>
                    </div>
                </div>
            </div>
        </template>
    </div>
</div>
