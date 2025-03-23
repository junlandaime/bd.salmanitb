@extends('admin.layouts.app')

@section('content')
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-semibold text-gray-900">Kegiatan Bidang Dakwah</h1>
            <a href="{{ route('admin.activities.create') }}"
                class="bg-green-500 text-white px-4 py-2 rounded-md hover:bg-green-600">
                Tambah Kegiatan Baru
            </a>
        </div>

        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        <!-- Kegiatan Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mb-4">
            @foreach ($activities as $activity)
                <div class="bg-white rounded-lg shadow-sm">
                    <div class="p-5">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-xl font-bold text-gray-900">{{ $activity->title }}</h3>
                            <span
                                class="px-2.5 py-0.5 text-xs font-medium rounded-full 
                        @if ($activity->status === 'published') bg-green-100 text-green-800
                        @elseif($activity->status === 'draft') bg-yellow-100 text-yellow-800
                        @else bg-red-100 text-red-800 @endif">
                                {{ ucfirst($activity->status) }}
                            </span>
                        </div>
                        <p class="text-gray-600 mb-4">
                            {{ Str::limit($activity->description, 100) }}
                        </p>
                        <div class="flex items-center justify-between mb-4">
                            <div>
                                <p class="text-sm text-gray-600">Program</p>
                                <p class="text-base font-bold text-gray-900">{{ $activity->program->title }}</p>
                            </div>
                            <div>
                                @if ($activity->is_featured)
                                    <span
                                        class="px-2.5 py-0.5 text-xs font-medium rounded-full bg-green-100 text-green-800">
                                        Featured
                                    </span>
                                @else
                                    <span class="px-2.5 py-0.5 text-xs font-medium rounded-full bg-gray-100 text-gray-800">
                                        Not Featured
                                    </span>
                                @endif
                            </div>
                        </div>
                        <p class="text-sm text-gray-600 mb-4">
                            Learning Paths: {{ $activity->learningPath->count() }}
                        </p>
                        <div class="flex space-x-2">
                            <a href="{{ route('admin.activities.show', $activity->id) }}"
                                class="text-white bg-green-600 hover:bg-green-700 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-green-600 dark:hover:bg-green-700 focus:outline-none dark:focus:ring-green-800">
                                Detail
                            </a>
                            <a href="{{ route('admin.activities.edit', $activity) }}"
                                class="text-white bg-green-600 hover:bg-green-700 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-4 py-2 focus:outline-none">
                                Edit
                            </a>
                            <form action="{{ route('admin.activities.destroy', $activity) }}" method="POST" class="inline"
                                onsubmit="return confirm('Are you sure?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="text-white bg-red-500 hover:bg-red-600 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-4 py-2">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-4">
            {{ $activities->links() }}
        </div>

        @php
            $upcomingPrograms = App\Models\Activity::with(['batches'])
                ->where('status', 'published')
                ->whereHas('batches', function ($query) {
                    $query->where(
                        'status',
                        'selesai',
                        // ->where('tanggal_selesai_pendaftaran', '>=', now())
                    );
                })
                ->get();
        @endphp

        <!-- Recent Registrations -->
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <div class="p-4">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Batch Terbaru</h3>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 ">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Poster
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Program
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Batch
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Status
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Periode Pendaftaran
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Kuota
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Harga
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Link Pendaftaran
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Aksi
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($upcomingPrograms as $program)
                                @foreach ($program->batches as $batch)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @if ($batch->featured_image)
                                                <div
                                                    class="text-white p-3 text-center inline-flex items-center justify-center w-12 h-12 mb-5 shadow-lg rounded-full bg-green-400">
                                                    <img src="{{ Storage::url($batch->featured_image) }}"
                                                        alt="{{ $batch->title }}">
                                                </div>
                                            @endif

                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">

                                            <div class="text-sm font-medium text-gray-900">
                                                {{ $program->title }}
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-medium text-gray-900">
                                                Batch {{ $batch->batch_ke }} - {{ $batch->nama_batch }}
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span
                                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                        {{ $batch->status === 'aktif'
                                            ? 'bg-green-100 text-green-800'
                                            : ($batch->status === 'draft'
                                                ? 'bg-gray-100 text-gray-800'
                                                : 'bg-red-100 text-red-800') }}">
                                                {{ ucfirst($batch->status) }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">
                                                {{ $batch->tanggal_mulai_pendaftaran->format('d M Y') }} -
                                                {{ $batch->tanggal_selesai_pendaftaran->format('d M Y') }}
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $batch->kuota }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            Rp {{ number_format($batch->harga, 0, ',', '.') }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ Str::limit($batch->external_link, 20) }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <div class="flex gap-2">
                                                {{-- <a href="{{ route('admin.program-layanan.batch.edit', [$program, $batch]) }}"
                                                    class="text-blue-600 hover:text-blue-900">
                                                    Edit
                                                </a>
                                                <form
                                                    action="{{ route('admin.program-layanan.batch.destroy', [$program, $batch]) }}"
                                                    method="POST"
                                                    onsubmit="return confirm('Apakah Anda yakin ingin menghapus batch ini?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-600 hover:text-red-900">
                                                        Hapus
                                                    </button>
                                                </form> --}}
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @empty

                                <tr>
                                    <td colspan="6" class="px-4 py-3 text-center">Tidak ada program yang akan datang
                                        dalam waktu dekat</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
