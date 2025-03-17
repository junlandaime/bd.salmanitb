@extends('admin.layouts.app')

@section('content')
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="flex justify-between items-center mb-6">
            <div>
                <h1 class="text-2xl font-semibold text-gray-900">{{ $activity->title }}</h1>
                <p class="mt-1 text-sm text-gray-600">Detail activity information and content</p>
            </div>
            <div class="flex space-x-3">
                <a href="{{ route('admin.activities.index') }}"
                    class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                    <svg class="-ml-1 mr-2 h-5 w-5 text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                        fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z"
                            clip-rule="evenodd" />
                    </svg>
                    Back
                </a>
                <a href="{{ route('admin.activities.edit', $activity) }}"
                    class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                    <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                        fill="currentColor">
                        <path
                            d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                    </svg>
                    Edit Activity
                </a>
            </div>
        </div>

        @if (session('success'))
            <div class="rounded-md bg-green-50 p-4 mb-6">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-green-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium text-green-800">{{ session('success') }}</p>
                    </div>
                </div>
            </div>
        @endif

        <!-- Basic Information -->
        <div class="bg-white shadow overflow-hidden sm:rounded-lg mb-6">
            <div class="px-4 py-5 sm:px-6 flex justify-between items-center">
                <div>
                    <h3 class="text-lg leading-6 font-medium text-gray-900">Basic Information</h3>
                    <p class="mt-1 max-w-2xl text-sm text-gray-500">Activity details and settings.</p>
                </div>
                <div>
                    <span
                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $activity->status === 'published' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                        {{ ucfirst($activity->status) }}
                    </span>
                </div>
            </div>
            <div class="border-t border-gray-200">
                <dl>
                    <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Title</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $activity->title }}</dd>
                    </div>
                    <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Description</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $activity->description }}</dd>
                    </div>
                    <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Featured Image</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            @if ($activity->featured_image)
                                <img src="{{ Storage::url($activity->featured_image) }}" alt="Featured image"
                                    class="w-64 h-32 object-cover rounded">
                            @else
                                <span class="text-gray-500">No featured image</span>
                            @endif
                        </dd>
                    </div>
                    <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Featured Status</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            {{ $activity->is_featured ? 'Featured' : 'Not Featured' }}
                        </dd>
                    </div>
                </dl>
            </div>
        </div>

        <!-- Batch Section -->
        <div class="bg-white shadow overflow-hidden sm:rounded-lg mb-6">
            <div class="px-4 py-5 sm:px-6 flex justify-between items-center">
                <div>
                    <h3 class="text-lg leading-6 font-medium text-gray-900">Batch Kegiatan</h3>
                    <p class="mt-1 max-w-2xl text-sm text-gray-500">Daftar batch yang tersedia untuk kegiatan ini.</p>
                </div>
                <a href="{{ route('admin.activities.batches.create', $activity) }}"
                    class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                    <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                        fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z"
                            clip-rule="evenodd" />
                    </svg>
                    Tambah Batch
                </a>
            </div>
            <div class="border-t border-gray-200">
                @if ($activity->batches->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Batch</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Status</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Kuota</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Harga</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Pendaftaran</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Pelaksanaan</th>
                                    <th scope="col" class="relative px-6 py-3">
                                        <span class="sr-only">Aksi</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($activity->batches as $batch)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-medium text-gray-900">{{ $batch->nama_batch }}</div>
                                            <div class="text-sm text-gray-500">Batch ke-{{ $batch->batch_ke }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span
                                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                            @if ($batch->status === 'aktif') bg-green-100 text-green-800
                                            @elseif($batch->status === 'nonaktif') bg-gray-100 text-gray-800
                                            @else bg-blue-100 text-blue-800 @endif">
                                                {{ ucfirst($batch->status) }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $batch->kuota }} peserta
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            Rp {{ number_format($batch->harga, 0, ',', '.') }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">
                                                {{ $batch->tanggal_mulai_pendaftaran->format('d M Y') }}</div>
                                            <div class="text-sm text-gray-500">s/d
                                                {{ $batch->tanggal_selesai_pendaftaran->format('d M Y') }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">
                                                {{ $batch->tanggal_mulai_kegiatan->format('d M Y') }}</div>
                                            <div class="text-sm text-gray-500">s/d
                                                {{ $batch->tanggal_selesai_kegiatan->format('d M Y') }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <div class="flex justify-end space-x-2">
                                                <a href="{{ route('admin.activities.batches.edit', [$activity, $batch]) }}"
                                                    class="text-green-600 hover:text-green-900">Edit</a>
                                                <form
                                                    action="{{ route('admin.activities.batches.destroy', [$activity, $batch]) }}"
                                                    method="POST" class="inline-block">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-600 hover:text-red-900"
                                                        onclick="return confirm('Apakah Anda yakin ingin menghapus batch ini?')">
                                                        Hapus
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-12">
                        <svg class="mx-auto h-12 w-12 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                        </svg>
                        <h3 class="mt-2 text-sm font-medium text-gray-900">Belum ada batch</h3>
                        <p class="mt-1 text-sm text-gray-500">
                            Mulai dengan membuat batch baru untuk kegiatan ini.
                        </p>
                        <div class="mt-6">
                            <a href="{{ route('admin.activities.batches.create', $activity) }}"
                                class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z"
                                        clip-rule="evenodd" />
                                </svg>
                                Tambah Batch
                            </a>
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <!-- Learning Paths Section -->
        <div class="bg-white shadow rounded-lg p-6 mb-6">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-lg font-medium text-gray-900">Learning Paths</h2>
            </div>
            @if ($activity->learningPath->count() > 0)
                <div class="space-y-4">
                    @foreach ($activity->learningPath as $path)
                        <div class="p-4 bg-gray-50 rounded-lg">
                            <h3 class="text-sm font-medium text-gray-900">{{ $path->title }}</h3>
                            <p class="text-sm text-gray-500">{{ $path->description }}</p>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-sm text-gray-500">No learning paths available.</p>
            @endif
        </div>

        <!-- Highlights Section -->
        <div class="bg-white shadow rounded-lg p-6 mb-6">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-lg font-medium text-gray-900">Highlights</h2>
            </div>
            @if ($activity->highlights->count() > 0)
                <div class="space-y-4">
                    @foreach ($activity->highlights as $highlight)
                        <div class="p-4 bg-gray-50 rounded-lg">
                            <h3 class="text-sm font-medium text-gray-900">{{ $highlight->title }}</h3>
                            <p class="text-sm text-gray-500">{{ $highlight->description }}</p>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-sm text-gray-500">No highlights available.</p>
            @endif
        </div>

        <!-- Testimonials Section -->
        <div class="bg-white shadow rounded-lg p-6 mb-6">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-lg font-medium text-gray-900">Testimonials</h2>
            </div>
            @if ($activity->testimonials->count() > 0)
                <div class="space-y-4">
                    @foreach ($activity->testimonials as $testimonial)
                        <div class="p-4 bg-gray-50 rounded-lg">
                            <h3 class="text-sm font-medium text-gray-900">{{ $testimonial->name }}</h3>
                            <p class="text-sm text-gray-500">{{ $testimonial->content }}</p>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-sm text-gray-500">No testimonials available.</p>
            @endif
        </div>

        <!-- Gallery Section -->
        <div class="bg-white shadow rounded-lg p-6 mb-6">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-lg font-medium text-gray-900">Gallery</h2>
            </div>
            @if ($activity->gallery->count() > 0)
                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">
                    @foreach ($activity->gallery as $image)
                        <div class="relative">
                            <img src="{{ asset($image->image_url) }}" alt="{{ $image->caption }}"
                                class="w-full h-32 object-cover rounded-lg">
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-sm text-gray-500">No gallery images available.</p>
            @endif
        </div>

        <!-- FAQs Section -->
        <div class="bg-white shadow rounded-lg p-6">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-lg font-medium text-gray-900">FAQs</h2>
            </div>
            @if ($activity->faqs->count() > 0)
                <div class="space-y-4">
                    @foreach ($activity->faqs as $faq)
                        <div class="p-4 bg-gray-50 rounded-lg">
                            <h3 class="text-sm font-medium text-gray-900">{{ $faq->question }}</h3>
                            <p class="text-sm text-gray-500">{{ $faq->answer }}</p>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-sm text-gray-500">No FAQs available.</p>
            @endif
        </div>
    </div>
@endsection
