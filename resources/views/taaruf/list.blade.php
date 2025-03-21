@extends('layouts.app')

@section('title', 'Daftar Alumni Ta\'aruf')
<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-WE2HFGE5VL"></script>
<script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
        dataLayer.push(arguments);
    }
    gtag('js', new Date());

    gtag('config', 'G-WE2HFGE5VL');
</script>
@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="mb-8">
            <nav class="mb-4">
                <ol class="flex text-sm">
                    <li class="flex items-center">
                        <a href="{{ route('alumni.dashboard') }}" class="text-green-600 hover:text-green-700">Dashboard
                            Alumni</a>
                        <svg class="w-4 h-4 mx-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </li>
                    <li class="flex items-center">
                        <a href="{{ route('taaruf.index') }}" class="text-green-600 hover:text-green-700">Ta'aruf</a>
                        <svg class="w-4 h-4 mx-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </li>
                    <li class="text-gray-500">Daftar Alumni</li>
                </ol>
            </nav>
            <h2 class="text-3xl font-bold text-green-600">Daftar Alumni Ta'aruf</h2>
            <p class="text-gray-500 mt-2">Berikut adalah daftar alumni yang siap untuk ta'aruf</p>
        </div>

        @if (session('error'))
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4" role="alert">
                <p>{{ session('error') }}</p>
            </div>
        @endif

        @if (session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4" role="alert">
                <p>{{ session('success') }}</p>
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="lg:col-span-2">
                <div class="bg-white rounded-lg shadow-lg overflow-hidden mb-8">
                    <div class="p-6 border-b">
                        <h5 class="text-xl font-bold text-green-600 mb-4">Pencarian dan Filter</h5>
                        <form action="{{ route('taaruf.list') }}" method="GET" class="space-y-4">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label for="search" class="block text-sm font-medium text-gray-700 mb-1">Cari
                                        Nama</label>
                                    <div class="relative rounded-md shadow-sm">
                                        <input type="text" name="search" id="search"
                                            class="focus:ring-green-500 focus:border-green-500 block w-full pl-3 pr-10 py-2 sm:text-sm border-gray-300 rounded-md"
                                            placeholder="Masukkan nama..." value="{{ request('search') }}">
                                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                            </svg>
                                        </div>
                                    </div>
                                </div>

                                <div>
                                    <label for="filter"
                                        class="block text-sm font-medium text-gray-700 mb-1">Filter</label>
                                    <select id="filter" name="filter"
                                        class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm rounded-md">
                                        <option value="all"
                                            {{ request('filter') == 'all' || !request('filter') ? 'selected' : '' }}>Semua
                                        </option>
                                        <option value="location" {{ request('filter') == 'location' ? 'selected' : '' }}>
                                            Berdasarkan Lokasi</option>
                                        <option value="education" {{ request('filter') == 'education' ? 'selected' : '' }}>
                                            Berdasarkan Pendidikan</option>
                                        <option value="marriage_year"
                                            {{ request('filter') == 'marriage_year' ? 'selected' : '' }}>Berdasarkan Target
                                            Menikah</option>
                                    </select>
                                </div>
                            </div>

                            <div class="hidden filter-options" id="location-options">
                                <label for="location" class="block text-sm font-medium text-gray-700 mb-1">Pilih
                                    Lokasi</label>
                                <select name="location" id="location"
                                    class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm rounded-md">
                                    <option value="">Pilih Lokasi</option>
                                    @foreach ($locations ?? [] as $location)
                                        <option value="{{ $location }}"
                                            {{ request('location') == $location ? 'selected' : '' }}>{{ $location }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="hidden filter-options" id="education-options">
                                <label for="education" class="block text-sm font-medium text-gray-700 mb-1">Pilih
                                    Pendidikan</label>
                                <select name="education" id="education"
                                    class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm rounded-md">
                                    <option value="">Pilih Pendidikan</option>
                                    @foreach ($educations ?? [] as $education)
                                        <option value="{{ $education }}"
                                            {{ request('education') == $education ? 'selected' : '' }}>{{ $education }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="hidden filter-options" id="marriage_year-options">
                                <label for="marriage_year" class="block text-sm font-medium text-gray-700 mb-1">Pilih Target
                                    Tahun Menikah</label>
                                <select name="marriage_year" id="marriage_year"
                                    class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm rounded-md">
                                    <option value="">Pilih Tahun</option>
                                    @for ($year = 2025; $year <= 2030; $year++)
                                        <option value="{{ $year }}"
                                            {{ request('marriage_year') == $year ? 'selected' : '' }}>{{ $year }}
                                        </option>
                                    @endfor
                                </select>
                            </div>

                            <div class="flex justify-end">
                                <button type="submit"
                                    class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                    </svg>
                                    Cari
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="p-6">
                        <h5 class="text-xl font-bold text-green-600 mb-4">Profil Alumni</h5>
                        @if (count($profiles) > 0)
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                @foreach ($profiles as $profile)
                                    <div
                                        class="bg-white rounded-lg border shadow-sm hover:shadow-md transition duration-300 h-full">
                                        <div class="p-6">
                                            <div class="flex justify-center mb-4">
                                                @if ($profile->photo_url)
                                                    <img src="{{ $profile->photo_url }}" alt="{{ $profile->full_name }}"
                                                        class="w-24 h-24 rounded-full object-cover">
                                                @else
                                                    <div
                                                        class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center">
                                                        <svg class="w-12 h-12 text-gray-400" fill="none"
                                                            stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z">
                                                            </path>
                                                        </svg>
                                                    </div>
                                                @endif
                                            </div>

                                            <h5 class="text-xl font-bold text-center mb-4">{{ $profile->full_name }}</h5>

                                            <div class="space-y-2">
                                                <div class="flex justify-between">
                                                    <span class="text-gray-500">Usia:</span>
                                                    <span>{{ \App\Helpers\DateHelper::getAgeFromBirthPlaceDate($profile->birth_place_date) ?? 'N/A' }}
                                                        tahun</span>
                                                </div>
                                                <div class="flex justify-between">
                                                    <span class="text-gray-500">Domisili:</span>
                                                    <span>{{ $profile->current_residence }}</span>
                                                </div>
                                                <div class="flex justify-between">
                                                    <span class="text-gray-500">Pendidikan:</span>
                                                    <span>{{ $profile->last_education }}</span>
                                                </div>
                                                <div class="flex justify-between">
                                                    <span class="text-gray-500">Pekerjaan:</span>
                                                    <span>{{ $profile->occupation }}</span>
                                                </div>
                                                @if ($profile->marriage_target_year)
                                                    <div class="flex justify-between">
                                                        <span class="text-gray-500">Target Menikah:</span>
                                                        <span>{{ $profile->marriage_target_year }}</span>
                                                    </div>
                                                @endif
                                            </div>

                                            <div class="text-center mt-6">
                                                <a href="{{ route('taaruf.profile.show', $profile->id) }}"
                                                    class="inline-flex items-center px-4 py-2 border border-green-600 rounded-md text-sm font-medium text-green-600 hover:bg-green-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                                        </path>
                                                    </svg>
                                                    Lihat Profil Lengkap
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <div class="flex justify-center mt-8">
                                {{ $profiles->appends(request()->query())->links() }}
                            </div>
                        @else
                            <div class="text-center py-16">
                                <svg class="w-16 h-16 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z">
                                    </path>
                                </svg>
                                <h4 class="text-xl font-bold mb-2">Belum ada profil alumni yang tersedia</h4>
                                <p class="text-gray-500">Saat ini belum ada alumni lawan jenis yang aktif dalam fitur
                                    Ta'aruf</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="lg:col-span-1">
                <div class="bg-white rounded-lg shadow-lg overflow-hidden mb-6 top-5">
                    <div class="p-6 border-b">
                        <h5 class="text-xl font-bold text-green-600">Informasi</h5>
                    </div>
                    <div class="p-6">
                        <div class="bg-blue-50 border-l-4 border-blue-500 p-4 mb-4">
                            <div class="flex">
                                <svg class="w-5 h-5 text-blue-500 mr-2" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span class="text-blue-700">Daftar ini hanya menampilkan profil alumni lawan jenis yang
                                    aktif dalam fitur Ta'aruf.</span>
                            </div>
                        </div>

                        <p class="font-bold text-gray-700 mb-2">Panduan melihat profil:</p>
                        <ul class="list-disc pl-5 mb-4 text-gray-600 space-y-1">
                            <li>Klik "Lihat Profil Lengkap" untuk melihat informasi lebih detail</li>
                            <li>Profil yang ditampilkan telah menyetujui untuk ditampilkan dalam daftar ini</li>
                            <li>Hormati privasi setiap alumni dengan tidak menyebarkan informasi profil mereka</li>
                        </ul>

                        <p class="font-bold text-gray-700 mb-2">Langkah selanjutnya:</p>
                        <ul class="list-disc pl-5 mb-4 text-gray-600 space-y-1">
                            <li>Jika tertarik dengan profil tertentu, Anda dapat menghubungi admin untuk proses ta'aruf
                                lebih lanjut</li>
                            <li>Admin akan memfasilitasi proses perkenalan sesuai dengan ketentuan ta'aruf</li>
                        </ul>

                        <div class="bg-yellow-50 border-l-4 border-yellow-500 p-4 mt-4">
                            <div class="flex">
                                <svg class="w-5 h-5 text-yellow-500 mr-2" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z">
                                    </path>
                                </svg>
                                <span class="text-yellow-700">Dilarang menghubungi alumni secara langsung tanpa melalui
                                    proses yang telah ditentukan.</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                    <div class="p-6 border-b">
                        <h5 class="text-xl font-bold text-green-600">Status Profil Anda</h5>
                    </div>
                    <div class="p-6">
                        @if ($myProfile && $myProfile->is_active)
                            <div class="bg-green-50 border-l-4 border-green-500 p-4">
                                <div class="flex">
                                    <svg class="w-5 h-5 text-green-500 mr-2" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    <span class="text-green-700">Profil Ta'aruf Anda sedang aktif dan dapat dilihat oleh
                                        alumni lain.</span>
                                </div>
                            </div>
                        @else
                            <div class="bg-yellow-50 border-l-4 border-yellow-500 p-4">
                                <div class="flex">
                                    <svg class="w-5 h-5 text-yellow-500 mr-2" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z">
                                        </path>
                                    </svg>
                                    <span class="text-yellow-700">Profil Ta'aruf Anda sedang tidak aktif dan tidak dapat
                                        dilihat oleh alumni lain.</span>
                                </div>
                            </div>

                            <a href="{{ route('taaruf.index') }}"
                                class="mt-4 w-full inline-flex items-center justify-center px-4 py-2 border border-green-600 rounded-md text-sm font-medium text-green-600 hover:bg-green-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                    </path>
                                </svg>
                                Kelola Profil Ta'aruf
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const filterSelect = document.getElementById('filter');
                const filterOptions = document.querySelectorAll('.filter-options');

                // Function to show the appropriate filter options based on selection
                function showFilterOptions() {
                    // Hide all filter option divs first
                    filterOptions.forEach(option => {
                        option.classList.add('hidden');
                    });

                    // Show the selected filter options if not "all"
                    const selectedFilter = filterSelect.value;
                    if (selectedFilter !== 'all') {
                        const optionsToShow = document.getElementById(selectedFilter + '-options');
                        if (optionsToShow) {
                            optionsToShow.classList.remove('hidden');
                        }
                    }
                }

                // Initialize to show current filter options
                showFilterOptions();

                // Update when the filter changes
                filterSelect.addEventListener('change', showFilterOptions);
            });
        </script>
    @endpush
@endsection
