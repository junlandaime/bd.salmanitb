@extends('admin.layouts.app')

@section('content')
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="mb-6">
            <h1 class="text-2xl font-semibold text-gray-900">Edit Activity: {{ $activity->title }}</h1>
            <p class="mt-1 text-sm text-gray-600">Edit activity information and content</p>
        </div>

        <form action="{{ route('admin.activities.update', $activity) }}" method="POST" class="space-y-8"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Basic Information -->

            <div class="bg-white shadow rounded-lg p-6">
                <h2 class="text-lg font-medium text-gray-900 mb-4">Basic Information</h2>
                <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                    <div>
                        <label for="program_id" class="block text-sm font-medium text-gray-700">Program</label>
                        <select name="program_id" id="program_id"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500">
                            @foreach ($programs as $program)
                                <option value="{{ $program->id }}"
                                    {{ old('program_id', $activity->program_id) == $program->id ? 'selected' : '' }}>
                                    {{ $program->title }}
                                </option>
                            @endforeach
                        </select>
                        @error('program_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                        <select name="status" id="status"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500">
                            <option value="draft" {{ old('status', $activity->status) == 'draft' ? 'selected' : '' }}>Draft
                            </option>
                            <option value="published"
                                {{ old('status', $activity->status) == 'published' ? 'selected' : '' }}>Published</option>
                            <option value="archived" {{ old('status', $activity->status) == 'archived' ? 'selected' : '' }}>
                                Archived</option>
                        </select>
                        @error('status')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="sm:col-span-2">
                        <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                        <input type="text" name="title" id="title" value="{{ old('title', $activity->title) }}"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500">
                        @error('title')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="sm:col-span-2">
                        <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                        <textarea name="description" id="description" rows="3"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500">{{ old('description', $activity->description) }}</textarea>
                        @error('description')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="sm:col-span-2">
                        <label for="overview" class="block text-sm font-medium text-gray-700">Overview</label>
                        <textarea name="overview" id="overview" rows="3"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500">{{ old('overview', $activity->overview) }}</textarea>
                        @error('overview')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="featured_image" class="block text-sm font-medium text-gray-700">Featured Image</label>
                        @if ($activity->featured_image)
                            <div class="mb-2">
                                <img src="{{ Storage::url($activity->featured_image) }}" alt="Current featured image"
                                    class="w-64 h-32 object-cover rounded">
                            </div>
                        @endif
                        <input type="file" name="featured_image" id="featured_image"
                            class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-green-50 file:text-green-700 hover:file:bg-green-100">
                        @error('featured_image')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="flex items-center">
                            <input type="checkbox" name="is_featured" value="1"
                                {{ old('is_featured', $activity->is_featured) ? 'checked' : '' }}
                                class="rounded border-gray-300 text-green-600 shadow-sm focus:border-green-500 focus:ring-green-500">
                            <span class="ml-2 text-sm text-gray-600">Featured Activity</span>
                        </label>
                    </div>
                </div>
            </div>

            <div class="flex justify-end">
                <button type="submit"
                    class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                    Update Activity
                </button>
            </div>
        </form>

        <!-- Activity Sections -->
        <div class="mt-8 space-y-8">
            <!-- Learning Paths Section -->
            <div class="bg-white shadow rounded-lg p-6">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-lg font-medium text-gray-900">Learning Paths</h2>
                    <button onclick="addLearningPath()"
                        class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-green-600 hover:bg-green-700">
                        <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z"
                                clip-rule="evenodd" />
                        </svg>
                        Add Learning Path
                    </button>
                </div>
                @if ($activity->learningPath->count() > 0)
                    <div class="space-y-4">
                        @foreach ($activity->learningPath as $path)
                            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                                <div>
                                    <h3 class="text-sm font-medium text-gray-900">{{ $path->title }}</h3>
                                    <p class="text-sm text-gray-500">{{ $path->description }}</p>
                                </div>
                                <button onclick="editLearningPath({{ $path->id }})"
                                    class="text-sm text-green-600 hover:text-green-900">
                                    Edit
                                </button>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-sm text-gray-500">No learning paths. Add the first learning path.</p>
                @endif
            </div>

            <!-- Highlights Section -->
            <div class="bg-white shadow rounded-lg p-6">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-lg font-medium text-gray-900">Highlights</h2>
                    <button onclick="addHighlight()"
                        class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-green-600 hover:bg-green-700">
                        <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z"
                                clip-rule="evenodd" />
                        </svg>
                        Add Highlight
                    </button>
                </div>
                @if ($activity->highlights->count() > 0)
                    <div class="space-y-4">
                        @foreach ($activity->highlights as $highlight)
                            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                                <div>
                                    <h3 class="text-sm font-medium text-gray-900">{{ $highlight->title }}</h3>
                                    <p class="text-sm text-gray-500">{{ $highlight->description }}</p>
                                </div>
                                <button onclick="editHighlight({{ $highlight->id }})"
                                    class="text-sm text-green-600 hover:text-green-900">
                                    Edit
                                </button>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-sm text-gray-500">No highlights. Add the first highlight.</p>
                @endif
            </div>

            <!-- Testimonials Section -->
            <div class="bg-white shadow rounded-lg p-6">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-lg font-medium text-gray-900">Testimonials</h2>
                    <button onclick="addTestimonial()"
                        class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-green-600 hover:bg-green-700">
                        <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z"
                                clip-rule="evenodd" />
                        </svg>
                        Add Testimonial
                    </button>
                </div>
                @if ($activity->testimonials->count() > 0)
                    <div class="space-y-4">
                        @foreach ($activity->testimonials as $testimonial)
                            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                                <div>
                                    <h3 class="text-sm font-medium text-gray-900">{{ $testimonial->name }}</h3>
                                    <p class="text-sm text-gray-500">{{ $testimonial->content }}</p>
                                </div>
                                <button onclick="editTestimonial({{ $testimonial->id }})"
                                    class="text-sm text-green-600 hover:text-green-900">
                                    Edit
                                </button>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-sm text-gray-500">No testimonials. Add the first testimonial.</p>
                @endif
            </div>

            <!-- Gallery Section -->
            <div class="bg-white shadow rounded-lg p-6">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-lg font-medium text-gray-900">Gallery</h2>
                    <button onclick="addGallery()"
                        class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-green-600 hover:bg-green-700">
                        <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z"
                                clip-rule="evenodd" />
                        </svg>
                        Add Image
                    </button>
                </div>
                @if ($activity->gallery->count() > 0)
                    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">
                        @foreach ($activity->gallery as $image)
                            <div class="relative group">
                                {{-- <img src="{{ asset($image->image_url) }}" alt="{{ $image->caption }}" --}}
                                <img src="{{ Storage::url($image->image) }}" alt="{{ $image->caption }}"
                                    class="w-full h-32 object-cover rounded-lg">
                                <button onclick="editGallery({{ $image->id }})"
                                    class="absolute inset-0 flex items-center justify-center bg-black bg-opacity-50 opacity-0 group-hover:opacity-100 rounded-lg transition-opacity">
                                    <span class="text-white text-sm">Edit</span>
                                </button>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-sm text-gray-500">No images. Add the first image.</p>
                @endif
            </div>

            <!-- FAQs Section -->
            <div class="bg-white shadow rounded-lg p-6">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-lg font-medium text-gray-900">FAQs</h2>
                    <button onclick="addFaq()"
                        class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-green-600 hover:bg-green-700">
                        <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z"
                                clip-rule="evenodd" />
                        </svg>
                        Add FAQ
                    </button>
                </div>
                @if ($activity->faqs->count() > 0)
                    <div class="space-y-4">
                        @foreach ($activity->faqs as $faq)
                            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                                <div>
                                    <h3 class="text-sm font-medium text-gray-900">{{ $faq->question }}</h3>
                                    <p class="text-sm text-gray-500">{{ $faq->answer }}</p>
                                </div>
                                <button onclick="editFaq({{ $faq->id }})"
                                    class="text-sm text-green-600 hover:text-green-900">
                                    Edit
                                </button>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-sm text-gray-500">No FAQs. Add the first FAQ.</p>
                @endif
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            function addLearningPath() {
                window.location.href = "{{ route('admin.activity-learning-paths.create', ['activity_id' => $activity->id]) }}";
            }

            function editLearningPath(id) {
                window.location.href = `/admin/activity-learning-paths/${id}/edit`;
            }

            function addHighlight() {
                window.location.href = "{{ route('admin.activity-highlights.create', ['activity_id' => $activity->id]) }}";
            }

            function editHighlight(id) {
                window.location.href = `/admin/activity-highlights/${id}/edit`;
            }

            function addTestimonial() {
                window.location.href = "{{ route('admin.activity-testimonials.create', ['activity_id' => $activity->id]) }}";
            }

            function editTestimonial(id) {
                window.location.href = `/admin/activity-testimonials/${id}/edit`;
            }

            function addGallery() {
                window.location.href = "{{ route('admin.activity-gallery.create', ['activity_id' => $activity->id]) }}";
            }

            function editGallery(id) {
                window.location.href = `/admin/activity-gallery/${id}/edit`;
            }

            function addFaq() {
                window.location.href = "{{ route('admin.activity-faqs.create', ['activity_id' => $activity->id]) }}";
            }

            function editFaq(id) {
                window.location.href = `/admin/activity-faqs/${id}/edit`;
            }
        </script>
    @endpush

@endsection
