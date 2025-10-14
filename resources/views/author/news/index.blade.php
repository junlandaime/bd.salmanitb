@extends('author.layouts.app')

@section('title', 'Berita Saya')

@section('content')
    <div class="container px-6 mx-auto py-6">
        <div class="flex justify-between items-center mb-6">
            <div>
                <h1 class="text-2xl font-semibold text-gray-700">Berita Saya</h1>
                <p class="text-sm text-gray-500">Kelola berita yang Anda tulis.</p>
            </div>
            <a href="{{ route('author.news.create') }}"
                class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-indigo-600 border border-transparent rounded-lg hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Tulis Berita
            </a>
        </div>

        <div class="bg-white overflow-hidden shadow rounded-lg">
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr class="text-xs font-semibold uppercase tracking-wider text-gray-500 bg-gray-50">
                            <th class="px-4 py-3">Judul</th>
                            <th class="px-4 py-3">Kategori</th>
                            <th class="px-4 py-3">Status</th>
                            <th class="px-4 py-3">Featured</th>
                            <th class="px-4 py-3">Lokasi</th>
                            <th class="px-4 py-3">Terbit</th>
                            <th class="px-4 py-3">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y">
                        @forelse ($news as $item)
                            <tr class="text-gray-700 {{ $item->is_featured ? 'bg-indigo-50' : '' }}">
                                <td class="px-4 py-3">
                                    <div class="flex items-center text-sm">
                                        <div class="relative hidden w-10 h-10 mr-3 rounded-full md:block">
                                            @if ($item->featured_image)
                                                <img class="object-cover w-full h-full rounded-full"
                                                    src="{{ Storage::url($item->featured_image) }}"
                                                    alt="{{ $item->title }}" loading="lazy" />
                                            @else
                                                <div
                                                    class="w-full h-full rounded-full bg-gray-200 flex items-center justify-center text-gray-500">
                                                    <span class="text-xs">BD</span>
                                                </div>
                                            @endif
                                        </div>
                                        <div>
                                            <div class="flex items-center gap-2">
                                                <p class="font-semibold">{{ Str::limit($item->title, 40) }}</p>
                                                @if ($item->is_featured)
                                                    <svg class="w-4 h-4 text-yellow-500" fill="currentColor"
                                                        viewBox="0 0 20 20">
                                                        <path
                                                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                                    </svg>
                                                @endif
                                            </div>
                                            <p class="text-xs text-gray-500">{{ Str::limit($item->excerpt, 50) }}</p>
                                            @if ($item->event_date)
                                                <p class="text-xs text-indigo-600 mt-1">
                                                    <svg class="w-3 h-3 inline mr-1" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                    </svg>
                                                    {{ $item->event_date->format('d M Y, H:i') }}
                                                </p>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    <span class="px-2 py-1 text-xs font-semibold leading-tight rounded-full"
                                        style="background-color: {{ $item->category->color }}20; color: {{ $item->category->color }}">
                                        {{ $item->category->name }}
                                    </span>
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    <span
                                        class="px-2 py-1 text-xs font-semibold leading-tight rounded-full {{ $item->status_badge }}">
                                        {{ ucfirst($item->status) }}
                                    </span>
                                </td>
                                <td class="px-4 py-3 text-sm text-center">
                                    @if ($item->is_featured)
                                        <span
                                            class="inline-flex items-center px-2 py-1 text-xs font-semibold leading-tight text-indigo-700 bg-indigo-100 rounded-full">
                                            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                            Ya
                                        </span>
                                    @else
                                        <span
                                            class="inline-flex items-center px-2 py-1 text-xs font-semibold leading-tight text-gray-500 bg-gray-100 rounded-full">
                                            -
                                        </span>
                                    @endif
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    @if ($item->location)
                                        <span class="inline-flex items-center text-gray-600">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                            </svg>
                                            {{ Str::limit($item->location, 20) }}
                                        </span>
                                    @else
                                        <span class="text-gray-400">-</span>
                                    @endif
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    @if ($item->published_at)
                                        <div class="flex flex-col">
                                            <span class="font-medium">{{ $item->published_at->format('d M Y') }}</span>
                                            <span
                                                class="text-xs text-gray-500">{{ $item->published_at->format('H:i') }}</span>
                                        </div>
                                    @else
                                        <span class="text-gray-400">-</span>
                                    @endif
                                </td>
                                <td class="px-4 py-3">
                                    <div class="flex items-center space-x-3 text-sm">
                                        <a href="{{ route('author.news.edit', $item) }}"
                                            class="inline-flex items-center px-2 py-1 text-indigo-600 hover:text-indigo-700"
                                            title="Edit">
                                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                                                <path
                                                    d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                            </svg>
                                            <span class="sr-only">Edit</span>
                                        </a>
                                        <form action="{{ route('author.news.destroy', $item) }}" method="POST"
                                            onsubmit="return confirm('Hapus berita ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="inline-flex items-center px-2 py-1 text-red-600 hover:text-red-700"
                                                title="Hapus">
                                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                                    aria-hidden="true">
                                                    <path fill-rule="evenodd"
                                                        d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                                <span class="sr-only">Hapus</span>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-4 py-6 text-center text-sm text-gray-500">
                                    Anda belum memiliki berita. Tulis berita pertama Anda sekarang.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="px-4 py-3 border-t bg-gray-50">
                {{ $news->links() }}
            </div>
        </div>

        {{-- Summary Stats --}}
        @if ($news->total() > 0)
            <div class="mt-6 grid grid-cols-1 md:grid-cols-4 gap-4">
                <div class="bg-white overflow-hidden shadow rounded-lg">
                    <div class="p-5">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <svg class="h-6 w-6 text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-500 truncate">Total Berita</dt>
                                    <dd class="text-lg font-semibold text-gray-900">{{ $news->total() }}</dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow rounded-lg">
                    <div class="p-5">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <svg class="h-6 w-6 text-green-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-500 truncate">Terbit</dt>
                                    <dd class="text-lg font-semibold text-gray-900">
                                        {{ $news->where('status', 'published')->count() }}</dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow rounded-lg">
                    <div class="p-5">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <svg class="h-6 w-6 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-500 truncate">Featured</dt>
                                    <dd class="text-lg font-semibold text-gray-900">
                                        {{ $news->where('is_featured', true)->count() }}</dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow rounded-lg">
                    <div class="p-5">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <svg class="h-6 w-6 text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-500 truncate">Draft</dt>
                                    <dd class="text-lg font-semibold text-gray-900">
                                        {{ $news->where('status', 'draft')->count() }}</dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection
