<nav class="mt-4 px-2 space-y-1">
    <!-- Dashboard - using a home/dashboard grid icon -->
    <a href="{{ route('admin.dashboard') }}"
        class="flex items-center px-4 py-2 rounded-md text-gray-700 hover:bg-gray-100 {{ request()->routeIs('admin.dashboard') ? 'bg-gray-100' : '' }}">
        <svg class="w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
            stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z" />
        </svg>
        Dashboard
    </a>

    <!-- Program Management Dropdown -->
    <a href="#"
        onclick="event.preventDefault(); document.getElementById('program-dropdown').classList.toggle('hidden');"
        class="flex items-center px-4 py-2 rounded-md text-gray-700 hover:bg-gray-100 {{ request()->routeIs('admin.programs.*') ? 'bg-gray-100' : '' }}">
        <svg class="w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
            stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
        </svg>
        Program BD
        <svg class="w-4 h-4 ml-auto" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
            stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
        </svg>
    </a>

    <!-- Program Management Items -->
    <div id="program-dropdown" class="pl-8 mt-1 {{ request()->routeIs('admin.programs.*') ? '' : 'hidden' }}">
        <a href="{{ route('admin.programs.index') }}"
            class="flex items-center px-4 py-2 rounded-md text-gray-700 hover:bg-gray-100 text-sm {{ request()->routeIs('admin.programs.index') ? 'bg-gray-100' : '' }}">
            <svg class="w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
            </svg>
            Daftar Program
        </a>
        <a href="{{ route('admin.programs.create') }}"
            class="flex items-center px-4 py-2 rounded-md text-gray-700 hover:bg-gray-100 text-sm {{ request()->routeIs('admin.programs.create') ? 'bg-gray-100' : '' }}">
            <svg class="w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            Tambah Program
        </a>
    </div>

    <!-- Activity Management Dropdown -->
    <a href="#"
        onclick="event.preventDefault(); document.getElementById('activity-dropdown').classList.toggle('hidden');"
        class="flex items-center px-4 py-2 rounded-md text-gray-700 hover:bg-gray-100 {{ request()->routeIs('admin.activities.*') ? 'bg-gray-100' : '' }}">
        <svg class="w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
            stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
        </svg>
        Kegiatan BD
        <svg class="w-4 h-4 ml-auto" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
            stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
        </svg>
    </a>

    <!-- Activity Management Items -->
    <div id="activity-dropdown" class="pl-8 mt-1 {{ request()->routeIs('admin.activities.*') ? '' : 'hidden' }}">
        <a href="{{ route('admin.activities.index') }}"
            class="flex items-center px-4 py-2 rounded-md text-gray-700 hover:bg-gray-100 text-sm {{ request()->routeIs('admin.activities.index') ? 'bg-gray-100' : '' }}">
            <svg class="w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
            </svg>
            Daftar Kegiatan
        </a>
        <a href="{{ route('admin.activities.create') }}"
            class="flex items-center px-4 py-2 rounded-md text-gray-700 hover:bg-gray-100 text-sm {{ request()->routeIs('admin.activities.create') ? 'bg-gray-100' : '' }}">
            <svg class="w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            Tambah Kegiatan
        </a>
    </div>

    <!-- Batch Materials Dropdown -->
    <a href="#"
        onclick="event.preventDefault(); document.getElementById('batch-materials-dropdown').classList.toggle('hidden');"
        class="flex items-center px-4 py-2 rounded-md text-gray-700 hover:bg-gray-100 {{ request()->routeIs('admin.batches.materials.*') || request()->routeIs('admin.batches.index') ? 'bg-gray-100' : '' }}">
        <svg class="w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
            stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
        </svg>
        Materi Batch
        <svg class="w-4 h-4 ml-auto" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
            stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
        </svg>
    </a>

    <!-- Batch Materials Items -->
    <div id="batch-materials-dropdown"
        class="pl-8 mt-1 {{ request()->routeIs('admin.batches.materials.*') || request()->routeIs('admin.batches.index') ? '' : 'hidden' }}">
        <a href="{{ route('admin.batches.index') }}"
            class="flex items-center px-4 py-2 rounded-md text-gray-700 hover:bg-gray-100 {{ request()->routeIs('admin.batches.index') ? 'bg-gray-100' : '' }}">
            <svg class="w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
            </svg>
            Semua Batch
        </a>

        @php
            $batches = \App\Models\ActivityBatch::with('activity')
                ->where('status', 'selesai')
                ->whereHas('materials', function ($query) {
                    $query->whereNotNull('id'); // Memastikan materialBatches ada
                })
                ->orderBy('tanggal_mulai_kegiatan', 'desc')
                ->take(5)
                ->get();
        @endphp

        @foreach ($batches as $batch)
            <a href="{{ route('admin.batches.materials.index', $batch) }}"
                class="flex items-center px-4 py-2 rounded-md text-gray-700 hover:bg-gray-100 text-sm {{ request()->route('batch') && request()->route('batch')->id == $batch->id ? 'bg-gray-100' : '' }}">
                <svg class="w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
                {{ $batch->activity->title }} - {{ $batch->nama_batch }}
            </a>
        @endforeach

        <a href="{{ route('admin.alumni.materials.import.form') }}"
            class="flex items-center px-4 py-2 rounded-md text-gray-700 hover:bg-gray-100 text-sm {{ request()->routeIs('admin.alumni.materials.import.*') ? 'bg-gray-100' : '' }}">
            <svg class="w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
            </svg>
            Import Materi Batch
        </a>
    </div>

    <!-- Content Management Dropdown -->
    <a href="#"
        onclick="event.preventDefault(); document.getElementById('content-dropdown').classList.toggle('hidden');"
        class="flex items-center px-4 py-2 rounded-md text-gray-700 hover:bg-gray-100 {{ request()->routeIs('admin.articles.*') || request()->routeIs('admin.news.*') ? 'bg-gray-100' : '' }}">
        <svg class="w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
            stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9.5a2.5 2.5 0 00-2.5-2.5H15" />
        </svg>
        Konten
        <svg class="w-4 h-4 ml-auto" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
            stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
        </svg>
    </a>

    <!-- Content Management Items -->
    <div id="content-dropdown"
        class="pl-8 mt-1 {{ request()->routeIs('admin.articles.*') || request()->routeIs('admin.news.*') ? '' : 'hidden' }}">
        <a href="{{ route('admin.articles.index') }}"
            class="flex items-center px-4 py-2 rounded-md text-gray-700 hover:bg-gray-100 text-sm {{ request()->routeIs('admin.articles.index') ? 'bg-gray-100' : '' }}">
            <svg class="w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9.5a2.5 2.5 0 00-2.5-2.5H15" />
            </svg>
            Artikel
        </a>
        <a href="{{ route('admin.news.index') }}"
            class="flex items-center px-4 py-2 rounded-md text-gray-700 hover:bg-gray-100 text-sm {{ request()->routeIs('admin.news.index') ? 'bg-gray-100' : '' }}">
            <svg class="w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9.5a2.5 2.5 0 00-2.5-2.5H15M12 10V3m0 0l3 3m-3-3L9 6" />
            </svg>
            Berita
        </a>
    </div>

    <!-- Services - using a cog/service icon -->
    <a href="{{ route('admin.services.index') }}"
        class="flex items-center px-4 py-2 rounded-md text-gray-700 hover:bg-gray-100 {{ request()->routeIs('admin.services.*') ? 'bg-gray-100' : '' }}">
        <svg class="w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
            stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
        </svg>
        Services
    </a>

    <!-- Taaruf - using a heart icon -->
    <a href="{{ route('admin.taaruf.index') }}"
        class="flex items-center px-4 py-2 rounded-md text-gray-700 hover:bg-gray-100 {{ request()->routeIs('admin.taaruf.*') ? 'bg-gray-100' : '' }}">
        <svg class="w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
            stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
        </svg>
        Taaruf
    </a>

    <!-- User Management Dropdown -->
    <a href="#"
        onclick="event.preventDefault(); document.getElementById('user-dropdown').classList.toggle('hidden');"
        class="flex items-center px-4 py-2 rounded-md text-gray-700 hover:bg-gray-100 {{ request()->routeIs('admin.users.*') || request()->routeIs('admin.alumni.import.*') || request()->routeIs('admin.alumni.materials.import.*') || request()->routeIs('admin.batch-alumni.*') ? 'bg-gray-100' : '' }}">
        <svg class="w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
            stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
        </svg>
        Pengguna
        <svg class="w-4 h-4 ml-auto" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
            stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
        </svg>
    </a>

    <!-- User Management Items -->
    <div id="user-dropdown"
        class="pl-8 mt-1 {{ request()->routeIs('admin.users.*') || request()->routeIs('admin.alumni.import.*') || request()->routeIs('admin.alumni.materials.import.*') || request()->routeIs('admin.batch-alumni.*') ? '' : 'hidden' }}">
        <a href="{{ route('admin.users.index') }}"
            class="flex items-center px-4 py-2 rounded-md text-gray-700 hover:bg-gray-100 text-sm {{ request()->routeIs('admin.users.index') ? 'bg-gray-100' : '' }}">
            <svg class="w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
            </svg>
            Daftar Pengguna
        </a>
        <a href="{{ route('admin.alumni.import.form') }}"
            class="flex items-center px-4 py-2 rounded-md text-gray-700 hover:bg-gray-100 text-sm {{ request()->routeIs('admin.alumni.import.*') ? 'bg-gray-100' : '' }}">
            <svg class="w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
            </svg>
            Import Alumni
        </a>
        <a href="{{ route('admin.batch-alumni.index') }}"
            class="flex items-center px-4 py-2 rounded-md text-gray-700 hover:bg-gray-100 text-sm {{ request()->routeIs('admin.batch-alumni.*') ? 'bg-gray-100' : '' }}">
            <svg class="w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
            </svg>
            Kelola Alumni
        </a>
    </div>

    <!-- Settings - using a cog icon -->
    <a href="{{ route('admin.landing-page.edit') }}"
        class="flex items-center px-4 py-2 rounded-md text-gray-700 hover:bg-gray-100 {{ request()->routeIs('admin.landing-page') ? 'bg-gray-100' : '' }}">
        <svg class="w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
            stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
        </svg>
        Settings
    </a>
</nav>
