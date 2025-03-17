<!-- Gallery Section -->
<div class="bg-white shadow rounded-lg p-6" 
     x-data="{ 
        images: @if(isset($activity)) {{ json_encode($activity->gallery) }} @else [] @endif 
     }">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-lg font-medium text-gray-900">Gallery</h2>
        <button type="button" @click="images.push({})" 
                class="bg-green-500 text-white px-3 py-1 rounded-md hover:bg-green-600">
            Add Image
        </button>
    </div>

    <div class="space-y-4">
        <template x-for="(image, index) in images" :key="index">
            <div class="border rounded-lg p-4">
                <div class="grid grid-cols-1 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Caption</label>
                        <input type="text" x-model="image.caption" :name="`gallery[${index}][caption]`" 
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Image</label>
                        <input type="file" :name="`gallery[${index}][image]`" 
                               class="mt-1 block w-full">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Order</label>
                        <input type="number" x-model="image.order" :name="`gallery[${index}][order]`" 
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500">
                    </div>
                    <div class="flex justify-end">
                        <button type="button" @click="images.splice(index, 1)" 
                                class="text-red-600 hover:text-red-800">Remove</button>
                    </div>
                </div>
            </div>
        </template>
    </div>
</div>
