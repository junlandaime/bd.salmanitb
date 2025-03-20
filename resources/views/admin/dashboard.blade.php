@extends('admin.layouts.app')

@section('content')
    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-2xl font-semibold text-gray-900">Dashboard</h1>

            <!-- Stats Grid -->
            <div class="mt-6 grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3">
                <!-- Articles Stats -->
                <div class="bg-white overflow-hidden shadow rounded-lg">
                    <div class="p-5">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <svg class="h-6 w-6 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9.5a2.5 2.5 0 00-2.5-2.5H15" />
                                </svg>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-500 truncate">Total Articles</dt>
                                    <dd class="flex items-baseline">
                                        <div class="text-2xl font-semibold text-gray-900">{{ $stats['articles']['total'] }}
                                        </div>
                                        <div class="ml-2 flex items-baseline text-sm font-semibold">
                                            <span class="text-green-600">{{ $stats['articles']['published'] }}
                                                Published</span>
                                            <span class="mx-2 text-gray-500">&middot;</span>
                                            <span class="text-yellow-600">{{ $stats['articles']['draft'] }} Draft</span>
                                        </div>
                                    </dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- News Stats -->
                <div class="bg-white overflow-hidden shadow rounded-lg">
                    <div class="p-5">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <svg class="h-6 w-6 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9.5a2.5 2.5 0 00-2.5-2.5H15M12 10V3m0 0l3 3m-3-3L9 6" />
                                </svg>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-500 truncate">Total News</dt>
                                    <dd class="flex items-baseline">
                                        <div class="text-2xl font-semibold text-gray-900">{{ $stats['news']['total'] }}
                                        </div>
                                        <div class="ml-2 flex items-baseline text-sm font-semibold">
                                            <span class="text-green-600">{{ $stats['news']['published'] }} Published</span>
                                            <span class="mx-2 text-gray-500">&middot;</span>
                                            <span class="text-yellow-600">{{ $stats['news']['draft'] }} Draft</span>
                                        </div>
                                    </dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Programs Stats -->
                <div class="bg-white overflow-hidden shadow rounded-lg">
                    <div class="p-5">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <svg class="h-6 w-6 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                </svg>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-500 truncate">Total Programs</dt>
                                    <dd class="flex items-baseline">
                                        <div class="text-2xl font-semibold text-gray-900">{{ $stats['programs']['total'] }}
                                        </div>
                                        <div class="ml-2 flex items-baseline text-sm font-semibold">
                                            <span class="text-green-600">{{ $stats['programs']['published'] }}
                                                Published</span>
                                            <span class="mx-2 text-gray-500">&middot;</span>
                                            <span class="text-yellow-600">{{ $stats['programs']['draft'] }} Draft</span>

                                        </div>
                                    </dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Activities Stats -->
                <div class="bg-white overflow-hidden shadow rounded-lg">
                    <div class="p-5">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <svg class="h-6 w-6 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-500 truncate">Total Activities</dt>
                                    <dd class="flex items-baseline">
                                        <div class="text-2xl font-semibold text-gray-900">
                                            {{ $stats['activities']['total'] }}</div>
                                        <div class="ml-2 flex items-baseline text-sm font-semibold">
                                            <span class="text-green-600">{{ $stats['activities']['active'] }} Active</span>
                                        </div>
                                    </dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Users Stats -->
                <div class="bg-white overflow-hidden shadow rounded-lg">
                    <div class="p-5">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <svg class="h-6 w-6 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                </svg>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-500 truncate">Total Users</dt>
                                    <dd class="flex items-baseline">
                                        <div class="text-2xl font-semibold text-gray-900">{{ $stats['users']['total'] }}
                                        </div>
                                        <div class="ml-2 flex items-baseline text-sm font-semibold">
                                            <span class="text-green-600">{{ $stats['users']['admin'] }} Admins</span>
                                            <span class="mx-2 text-gray-500">&middot;</span>
                                            <span class="text-blue-600">{{ $stats['users']['alumni'] }} Alumni</span>
                                        </div>
                                    </dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Taaruf Stats -->
                <div class="bg-white overflow-hidden shadow rounded-lg">
                    <div class="p-5">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <svg class="h-6 w-6 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z" />
                                </svg>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-500 truncate">Taaruf Profiles</dt>
                                    <dd class="flex items-baseline">
                                        <div class="text-2xl font-semibold text-gray-900">
                                            {{ $stats['taaruf']['profiles'] ?? 0 }}</div>
                                        <div class="ml-2 flex items-baseline text-sm font-semibold">
                                            <span class="text-green-600">{{ $stats['taaruf']['active'] ?? 0 }}
                                                Active</span>
                                            <span class="mx-2 text-gray-500">&middot;</span>
                                            <span class="text-yellow-600">{{ $stats['taaruf']['questions'] ?? 0 }}
                                                Questions</span>
                                        </div>
                                    </dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Access Section -->
            <div class="mt-8">
                <h2 class="text-lg font-medium text-gray-900">Quick Access</h2>
                <div class="mt-4 grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">
                    <!-- Content Management -->
                    <div class="bg-white overflow-hidden shadow rounded-lg">
                        <div class="p-5">
                            <h3 class="text-md font-medium text-gray-900">Content Management</h3>
                            <div class="mt-4 grid grid-cols-2 gap-2">
                                <a href="{{ route('admin.articles.index') }}"
                                    class="inline-flex items-center px-3 py-2 border border-gray-300 shadow-sm text-sm leading-4 font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                                    Articles
                                </a>
                                <a href="{{ route('admin.news.index') }}"
                                    class="inline-flex items-center px-3 py-2 border border-gray-300 shadow-sm text-sm leading-4 font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                                    News
                                </a>
                                <a href="{{ route('admin.programs.index') }}"
                                    class="inline-flex items-center px-3 py-2 border border-gray-300 shadow-sm text-sm leading-4 font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                                    Programs
                                </a>
                                <a href="{{ route('admin.services.index') }}"
                                    class="inline-flex items-center px-3 py-2 border border-gray-300 shadow-sm text-sm leading-4 font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                                    Services
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Activity Management -->
                    <div class="bg-white overflow-hidden shadow rounded-lg">
                        <div class="p-5">
                            <h3 class="text-md font-medium text-gray-900">Manajemen Kegiatan</h3>
                            <div class="mt-4 grid grid-cols-2 gap-2">
                                <a href="{{ route('admin.activities.index') }}"
                                    class="inline-flex items-center px-3 py-2 border border-gray-300 shadow-sm text-sm leading-4 font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                                    Activities
                                </a>
                                <a href="{{ route('admin.batches.index') }}"
                                    class="inline-flex items-center px-3 py-2 border border-gray-300 shadow-sm text-sm leading-4 font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                                    Batches
                                </a>
                                <a href="{{ route('admin.alumni.import.form') }}"
                                    class="inline-flex items-center px-3 py-2 border border-gray-300 shadow-sm text-sm leading-4 font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                                    Import Alumni
                                </a>
                                <a href="{{ route('admin.alumni.materials.import.form') }}"
                                    class="inline-flex items-center px-3 py-2 border border-gray-300 shadow-sm text-sm leading-4 font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                                    Import Materials
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Taaruf Management -->
                    <div class="bg-white overflow-hidden shadow rounded-lg">
                        <div class="p-5">
                            <h3 class="text-md font-medium text-gray-900">Taaruf Management</h3>
                            <div class="mt-4 grid grid-cols-2 gap-2">
                                <a href="{{ route('admin.taaruf.index') }}"
                                    class="inline-flex items-center px-3 py-2 border border-gray-300 shadow-sm text-sm leading-4 font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                                    Profiles
                                </a>
                                <a href="{{ route('admin.taaruf.statistics') }}"
                                    class="inline-flex items-center px-3 py-2 border border-gray-300 shadow-sm text-sm leading-4 font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                                    Statistics
                                </a>
                                <a href="{{ route('admin.taaruf.questions.index') }}"
                                    class="inline-flex items-center px-3 py-2 border border-gray-300 shadow-sm text-sm leading-4 font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                                    Questions
                                </a>
                                <a href="{{ route('admin.users.index') }}"
                                    class="inline-flex items-center px-3 py-2 border border-gray-300 shadow-sm text-sm leading-4 font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                                    Users
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Content Section -->
            <div class="mt-8 grid grid-cols-1 gap-6 lg:grid-cols-2">
                <!-- Recent Articles -->
                <div class="bg-white shadow rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg leading-6 font-medium text-gray-900">Recent Articles</h3>
                        <div class="mt-5">
                            <div class="flow-root">
                                <ul role="list" class="-my-5 divide-y divide-gray-200">
                                    @foreach ($recentArticles as $article)
                                        <li class="py-4">
                                            <div class="flex items-center space-x-4">
                                                <div class="flex-1 min-w-0">
                                                    <p class="text-sm font-medium text-gray-900 truncate">
                                                        {{ $article->title }}
                                                    </p>
                                                    <p class="text-sm text-gray-500">
                                                        By {{ $article->author->name }} in {{ $article->category->name }}
                                                    </p>
                                                </div>
                                                <div class="flex items-center space-x-2">
                                                    <span
                                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $article->status === 'published' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                                        {{ ucfirst($article->status) }}
                                                    </span>
                                                    <a href="{{ route('admin.articles.edit', $article) }}"
                                                        class="text-gray-400 hover:text-gray-500">
                                                        <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg"
                                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                        </svg>
                                                    </a>
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="mt-6">
                                <a href="{{ route('admin.articles.index') }}"
                                    class="w-full flex justify-center items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                                    View all articles
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recent News -->
                <div class="bg-white shadow rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg leading-6 font-medium text-gray-900">Recent News</h3>
                        <div class="mt-5">
                            <div class="flow-root">
                                <ul role="list" class="-my-5 divide-y divide-gray-200">
                                    @foreach ($recentNews as $news)
                                        <li class="py-4">
                                            <div class="flex items-center space-x-4">
                                                <div class="flex-1 min-w-0">
                                                    <p class="text-sm font-medium text-gray-900 truncate">
                                                        {{ $news->title }}
                                                    </p>
                                                    <p class="text-sm text-gray-500">
                                                        By {{ $news->author->name }} in {{ $news->category->name }}
                                                    </p>
                                                </div>
                                                <div class="flex items-center space-x-2">
                                                    <span
                                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $news->status === 'published' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                                        {{ ucfirst($news->status) }}
                                                    </span>
                                                    <a href="{{ route('admin.news.edit', $news) }}"
                                                        class="text-gray-400 hover:text-gray-500">
                                                        <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg"
                                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                        </svg>
                                                    </a>
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="mt-6">
                                <a href="{{ route('admin.news.index') }}"
                                    class="w-full flex justify-center items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                                    View all news
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Upcoming Activities -->
                <div class="bg-white shadow rounded-lg lg:col-span-2">
                    <div class="p-6">
                        <h3 class="text-lg leading-6 font-medium text-gray-900">Upcoming Activities</h3>
                        <div class="mt-5">
                            <div class="flow-root">
                                <ul role="list" class="-my-5 divide-y divide-gray-200">
                                    @foreach ($upcomingActivities as $activity)
                                        <li class="py-4">
                                            <div class="flex items-center space-x-4">
                                                <div class="flex-1 min-w-0">
                                                    <p class="text-sm font-medium text-gray-900 truncate">
                                                        {{ $activity->name }}
                                                    </p>
                                                    <p class="text-sm text-gray-500">
                                                        {{ $activity->description }}
                                                    </p>
                                                </div>
                                                <div>
                                                    @foreach ($activity->batches as $batch)
                                                        <div class="text-sm text-gray-500">
                                                            {{ $batch->tanggal_mulai_kegiatan->format('d M Y') }} -
                                                            {{ $batch->tanggal_selesai_kegiatan->format('d M Y') }}
                                                        </div>
                                                    @endforeach
                                                </div>
                                                <div>
                                                    <a href="{{ route('admin.activities.edit', $activity) }}"
                                                        class="text-gray-400 hover:text-gray-500">
                                                        <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg"
                                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                        </svg>
                                                    </a>
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="mt-6">
                                <a href="{{ route('admin.activities.index') }}"
                                    class="w-full flex justify-center items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                                    View all activities
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
