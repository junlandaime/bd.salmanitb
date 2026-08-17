@extends('admin.layouts.app')

@section('content')
<div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-semibold text-gray-900">Kelola Referral Code SPN</h1>
        <a href="{{ route('admin.spn.referral.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition">
            Tambah Referral Code
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    <div class="bg-white shadow-sm rounded-lg overflow-hidden border border-gray-100">
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th class="px-6 py-3">Kode</th>
                        <th class="px-6 py-3">Pemilik</th>
                        <th class="px-6 py-3">Diskon</th>
                        <th class="px-6 py-3">Penggunaan</th>
                        <th class="px-6 py-3">Status</th>
                        <th class="px-6 py-3">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($referralCodes as $code)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="px-6 py-4 font-mono font-medium text-gray-900">{{ $code->code }}</td>
                            <td class="px-6 py-4">{{ $code->owner_name }}</td>
                            <td class="px-6 py-4 text-green-600 font-semibold">Rp {{ number_format($code->discount_amount, 0, ',', '.') }}</td>
                            <td class="px-6 py-4">
                                {{ $code->used_count }} / {{ $code->max_usage ?? '&#8734;' }}
                            </td>
                            <td class="px-6 py-4">
                                @if($code->is_active)
                                    <span class="px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">Aktif</span>
                                @else
                                    <span class="px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">Tidak Aktif</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 flex space-x-2">
                                <a href="{{ route('admin.spn.referral.edit', $code->id) }}" class="text-blue-600 hover:underline">Edit</a>
                                <form action="{{ route('admin.spn.referral.destroy', $code->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus kode ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-8 text-center text-gray-500">Belum ada kode referral.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
