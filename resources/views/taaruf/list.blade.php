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
                    <div class="p-6 border-b flex justify-between items-center">
                        <h5 class="text-xl font-bold text-green-600">Profil Alumni</h5>
                        <div class="flex items-center">
                            <label for="filter" class="mr-2 text-gray-600">Filter:</label>
                            <select id="filter"
                                class="rounded-md border-gray-300 shadow-sm focus:border-green-300 focus:ring focus:ring-green-200 focus:ring-opacity-50">
                                <option value="all">Semua</option>
                                <option value="location">Berdasarkan Lokasi</option>
                                <option value="education">Berdasarkan Pendidikan</option>
                                <option value="marriage_year">Berdasarkan Target Menikah</option>
                            </select>
                        </div>
                    </div>
                    <div class="p-6">
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
                                                    {{-- <span>{{ \Carbon\Carbon::parse(explode(', ', $profile->birth_place_date)[1])->age }}
                                                        tahun</span> --}}
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
                                {{ $profiles->links() }}
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

                filterSelect.addEventListener('change', function() {
                    // Implement filtering logic here
                    // This would typically involve an AJAX request to the server
                    // or client-side filtering of the profiles

                    console.log('Filter changed to:', this.value);

                    // For now, we'll just reload the page with a query parameter
                    // In a real implementation, you would use AJAX to update the list
                    window.location.href = '{{ route('taaruf.list') }}?filter=' + this.value;
                });
            });
        </script>
    @endpush
@endsection
