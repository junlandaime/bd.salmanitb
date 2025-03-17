<!-- Learning Paths Section -->
<div class="bg-white shadow rounded-lg p-6" 
     x-data="{ 
        paths: @if(isset($activity)) {{ json_encode($activity->learningPath) }} @else [] @endif 
     }">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-lg font-medium text-gray-900">Learning Paths</h2>
        <button type="button" @click="paths.push({})" 
                class="bg-green-500 text-white px-3 py-1 rounded-md hover:bg-green-600">
            Add Path
        </button>
    </div>

    <div class="space-y-4">
        <template x-for="(path, index) in paths" :key="index">
            <div class="border rounded-lg p-4">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Title</label>
                        <input type="text" x-model="path.title" :name="`learning_paths[${index}][title]`" 
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Order</label>
                        <input type="number" x-model="path.order" :name="`learning_paths[${index}][order]`" 
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500">
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700">Description</label>
                        <textarea x-model="path.description" :name="`learning_paths[${index}][description]`" rows="2" 
                                  class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500"></textarea>
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700">Mentors</label>
                        <input type="text" x-model="path.mentors" :name="`learning_paths[${index}][mentors]`" 
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500">
                    </div>
                    <div class="md:col-span-2 flex justify-end">
                        <button type="button" @click="paths.splice(index, 1)" 
                                class="text-red-600 hover:text-red-800">Remove</button>
                    </div>
                </div>
            </div>
        </template>
    </div>
</div>
