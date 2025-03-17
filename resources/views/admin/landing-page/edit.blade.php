@extends('admin.layouts.app')
@section('title', 'Edit Landing Page - Admin Panel')

@section('content')
    <!-- Main Content -->
    <div class="p-4">
        <!-- Top Bar -->
        <div class="flex items-center justify-between mb-4">
            <button @click="sidebarOpen = !sidebarOpen"
                class="inline-flex items-center p-2 text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </button>
            <h1 class="text-xl font-semibold text-gray-900">Edit Landing Page</h1>
        </div>

        @if (session('success'))
            <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50" role="alert">
                {{ session('success') }}
                <button type="button" class="float-right" onclick="this.parentElement.remove()">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                            clip-rule="evenodd"></path>
                    </svg>
                </button>
            </div>
        @endif

        <form action="{{ route('admin.landing-page.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Hero Section -->
            <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">Hero Section</h2>
                <div class="space-y-4">
                    <div>
                        <label for="hero_title" class="block text-sm font-medium text-gray-700">Hero Title</label>
                        <input type="text" id="hero_title" name="hero_title"
                            value="{{ old('hero_title', $landingPage->hero_title) }}"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 sm:text-sm">
                        @error('hero_title')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="hero_subtitle" class="block text-sm font-medium text-gray-700">Hero Subtitle</label>
                        <textarea id="hero_subtitle" name="hero_subtitle" rows="3"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 sm:text-sm">{{ old('hero_subtitle', $landingPage->hero_subtitle) }}</textarea>
                        @error('hero_subtitle')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="hero_image" class="block text-sm font-medium text-gray-700">Hero Image</label>
                        @if ($landingPage->hero_image)
                            <div class="mt-2">
                                <img src="{{ Storage::url($landingPage->hero_image) }}" alt="Current Hero Image"
                                    class="h-32 w-auto">
                            </div>
                        @endif
                        <input type="file" id="hero_image" name="hero_image"
                            class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-green-50 file:text-green-700 hover:file:bg-green-100">
                        @error('hero_image')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Statistics -->
            <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">Statistics</h2>
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <div>
                        <label for="stats1" class="block text-sm font-medium text-gray-700">Stats 1</label>
                        <input type="text" id="stats1" name="stats1"
                            value="{{ old('stats1', $landingPage->stats1) }}"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 sm:text-sm">
                        @error('stats1')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        <input type="number" id="stats_1" name="stats_1"
                            value="{{ old('stats_1', $landingPage->stats_1) }}"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 sm:text-sm">
                        @error('stats_1')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="stats2" class="block text-sm font-medium text-gray-700">Stats 2</label>
                        <input type="text" id="stats2" name="stats2"
                            value="{{ old('stats2', $landingPage->stats2) }}"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 sm:text-sm">
                        @error('stats2')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        <input type="number" id="stats_2" name="stats_2"
                            value="{{ old('stats_2', $landingPage->stats_2) }}"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 sm:text-sm">
                        @error('stats_2')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="stats3" class="block text-sm font-medium text-gray-700">Stats 3</label>
                        <input type="text" id="stats3" name="stats3"
                            value="{{ old('stats3', $landingPage->stats3) }}"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 sm:text-sm">
                        @error('stats3')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        <input type="number" id="stats_3" name="stats_3"
                            value="{{ old('stats_3', $landingPage->stats_3) }}"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 sm:text-sm">
                        @error('stats_3')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="stats4" class="block text-sm font-medium text-gray-700">Stats 3</label>
                        <input type="text" id="stats4" name="stats4"
                            value="{{ old('stats4', $landingPage->stats4) }}"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 sm:text-sm">
                        @error('stats4')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        <input type="number" id="stats_4" name="stats_4"
                            value="{{ old('stats_4', $landingPage->stats_4) }}"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 sm:text-sm">
                        @error('stats_4')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Contact Information -->
            <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">Contact Information</h2>
                <div class="space-y-4">
                    <div>
                        <label for="contact_address" class="block text-sm font-medium text-gray-700">Address</label>
                        <textarea id="contact_address" name="contact_address" rows="3"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 sm:text-sm">{{ old('contact_address', $landingPage->contact_address ?? '') }}</textarea>
                        @error('contact_address')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="contact_phone" class="block text-sm font-medium text-gray-700">Phone Number</label>
                        <input type="tel" id="contact_phone" name="contact_phone"
                            value="{{ old('contact_phone', $landingPage->contact_phone ?? '') }}"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 sm:text-sm">
                        @error('contact_phone')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="contact_email" class="block text-sm font-medium text-gray-700">Email</label>
                        <input type="email" id="contact_email" name="contact_email"
                            value="{{ old('contact_email', $landingPage->contact_email ?? '') }}"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 sm:text-sm">
                        @error('contact_email')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="contact_whatsapp" class="block text-sm font-medium text-gray-700">WhatsApp
                            Number</label>
                        <input type="tel" id="contact_whatsapp" name="contact_whatsapp"
                            value="{{ old('contact_whatsapp', $landingPage->contact_whatsapp ?? '') }}"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 sm:text-sm">
                        @error('contact_whatsapp')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Social Media -->
            <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">Social Media</h2>
                <div class="space-y-4">
                    <div>
                        <label for="social_facebook" class="block text-sm font-medium text-gray-700">Facebook URL</label>
                        <input type="url" id="social_facebook" name="social_facebook"
                            value="{{ old('social_facebook', $landingPage->social_facebook ?? '') }}"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 sm:text-sm">
                        @error('social_facebook')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="social_twitter" class="block text-sm font-medium text-gray-700">Twitter URL</label>
                        <input type="url" id="social_twitter" name="social_twitter"
                            value="{{ old('social_twitter', $landingPage->social_twitter ?? '') }}"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 sm:text-sm">
                        @error('social_twitter')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="social_instagram" class="block text-sm font-medium text-gray-700">Instagram
                            URL</label>
                        <input type="url" id="social_instagram" name="social_instagram"
                            value="{{ old('social_instagram', $landingPage->social_instagram ?? '') }}"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 sm:text-sm">
                        @error('social_instagram')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="social_linkedin" class="block text-sm font-medium text-gray-700">Linkedin URL</label>
                        <input type="url" id="social_linkedin" name="social_linkedin"
                            value="{{ old('social_linkedin', $landingPage->social_linkedin ?? '') }}"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 sm:text-sm">
                        @error('social_linkedin')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="social_youtube" class="block text-sm font-medium text-gray-700">YouTube URL</label>
                        <input type="url" id="social_youtube" name="social_youtube"
                            value="{{ old('social_youtube', $landingPage->social_youtube ?? '') }}"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 sm:text-sm">
                        @error('social_youtube')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Footer & SEO -->
            <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">Footer & SEO</h2>
                <div class="space-y-4">
                    <div>
                        <label for="footer_description" class="block text-sm font-medium text-gray-700">Footer
                            Text</label>
                        <textarea id="footer_description" name="footer_description" rows="3"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 sm:text-sm">{{ old('footer_description', $landingPage->footer_description ?? '') }}</textarea>
                        @error('footer_description')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="meta_title" class="block text-sm font-medium text-gray-700">Meta Title</label>
                        <input type="text" id="meta_title" name="meta_title"
                            value="{{ old('meta_title', $landingPage->meta_title ?? '') }}"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 sm:text-sm">
                        @error('meta_title')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="meta_description" class="block text-sm font-medium text-gray-700">Meta
                            Description</label>
                        <textarea id="meta_description" name="meta_description" rows="3"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 sm:text-sm">{{ old('meta_description', $landingPage->meta_description ?? '') }}</textarea>
                        @error('meta_description')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="meta_keywords" class="block text-sm font-medium text-gray-700">Meta Keywords</label>
                        <input type="text" id="meta_keywords" name="meta_keywords"
                            value="{{ old('meta_keywords', $landingPage->meta_keywords ?? '') }}"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 sm:text-sm">
                        @error('meta_keywords')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- About Section -->
            <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">About Section</h2>
                <div class="space-y-4">
                    <div>
                        <label for="about_title" class="block text-sm font-medium text-gray-700">About Title</label>
                        <input type="text" id="about_title" name="about_title"
                            value="{{ old('about_title', $landingPage->about_title) }}"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 sm:text-sm">
                        @error('about_title')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="about_content" class="block text-sm font-medium text-gray-700">About Content</label>
                        <textarea id="about_content" name="about_content" rows="5"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 sm:text-sm">{{ old('about_content', $landingPage->about_content) }}</textarea>
                        @error('about_content')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Vision & Mission -->
            <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">Vision & Mission</h2>
                <div class="space-y-4">
                    <div>
                        <label for="vision_title" class="block text-sm font-medium text-gray-700">Vision Title</label>
                        <input type="text" id="vision_title" name="vision_title"
                            value="{{ old('vision_title', $landingPage->vision_title) }}"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 sm:text-sm">
                        @error('vision_title')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="vision_content" class="block text-sm font-medium text-gray-700">Vision Content</label>
                        <textarea id="vision_content" name="vision_content" rows="3"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 sm:text-sm">{{ old('vision_content', $landingPage->vision_content) }}</textarea>
                        @error('vision_content')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="mission_title" class="block text-sm font-medium text-gray-700">Mission Title</label>
                        <input type="text" id="mission_title" name="mission_title"
                            value="{{ old('mission_title', $landingPage->mission_title) }}"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 sm:text-sm">
                        @error('mission_title')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="mission_content" class="block text-sm font-medium text-gray-700">Mission
                            Content</label>
                        <textarea id="mission_content" name="mission_content" rows="3"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 sm:text-sm">{{ old('mission_content', $landingPage->mission_content) }}</textarea>
                        @error('mission_content')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="flex justify-end">
                <button type="submit"
                    class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                    Save Changes
                </button>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.ckeditor.com/ckeditor5/27.1.0/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create(document.querySelector('#about_content'))
            .catch(error => {
                console.error(error);
            });

        ClassicEditor
            .create(document.querySelector('#vision_content'))
            .catch(error => {
                console.error(error);
            });

        ClassicEditor
            .create(document.querySelector('#mission_content'))
            .catch(error => {
                console.error(error);
            });
    </script>
@endpush
