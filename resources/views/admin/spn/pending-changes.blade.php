@extends('layouts.admin')

@section('title', 'Perubahan Data Peserta - Admin SPN')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    
    <div class="mb-6 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Perubahan Data Peserta</h1>
            <p class="text-sm text-gray-500 mt-1">Review dan kelola permintaan perubahan data yang dilindungi dari peserta.</p>
        </div>
        <a href="{{ route('admin.spn.dashboard') }}" class="text-teal-600 hover:text-teal-800 font-medium text-sm flex items-center">
            <i class="fas fa-arrow-left mr-2"></i> Kembali ke Dashboard SPN
        </a>
    </div>

    @if($registrations->isEmpty())
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-8 text-center">
            <div class="text-gray-400 mb-3"><i class="fas fa-check-circle text-4xl"></i></div>
            <h3 class="text-lg font-bold text-gray-700">Tidak Ada Perubahan Pending</h3>
            <p class="text-sm text-gray-500 mt-1">Semua permintaan perubahan data telah ditangani.</p>
        </div>
    @else
        <div class="space-y-4">
            @foreach($registrations as $reg)
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-100 bg-gray-50 flex justify-between items-center">
                        <div>
                            <h3 class="font-bold text-gray-800">{{ $reg->nama_lengkap }}</h3>
                            <p class="text-xs text-gray-500">{{ $reg->registration_code }} &middot; {{ $reg->email }}</p>
                        </div>
                        <a href="{{ route('admin.spn.show', $reg->id) }}" class="text-teal-600 hover:text-teal-800 text-sm font-medium">
                            Lihat Detail <i class="fas fa-external-link-alt ml-1"></i>
                        </a>
                    </div>
                    <div class="p-6">
                        <table class="w-full text-sm">
                            <thead>
                                <tr class="text-left border-b border-gray-200">
                                    <th class="pb-2 text-xs font-semibold text-gray-500 uppercase">Field</th>
                                    <th class="pb-2 text-xs font-semibold text-gray-500 uppercase">Nilai Saat Ini</th>
                                    <th class="pb-2 text-xs font-semibold text-gray-500 uppercase">Diubah Menjadi</th>
                                    <th class="pb-2 text-xs font-semibold text-gray-500 uppercase text-right">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($reg->pending_changes as $field => $newValue)
                                    <tr class="border-b border-gray-100 last:border-0">
                                        <td class="py-3 font-medium text-gray-800">{{ ucwords(str_replace('_', ' ', $field)) }}</td>
                                        <td class="py-3 text-gray-600">{{ $reg->$field ?? '-' }}</td>
                                        <td class="py-3 text-teal-700 font-medium">{{ $newValue }}</td>
                                        <td class="py-3 text-right">
                                            <div class="flex justify-end gap-2">
                                                <form action="{{ route('admin.spn.approveChange', $reg->id) }}" method="POST" class="inline">
                                                    @csrf
                                                    <input type="hidden" name="field" value="{{ $field }}">
                                                    <button type="submit" class="px-3 py-1 bg-emerald-600 text-white text-xs font-semibold rounded-lg hover:bg-emerald-700 transition">
                                                        <i class="fas fa-check mr-1"></i> Setujui
                                                    </button>
                                                </form>
                                                <form action="{{ route('admin.spn.rejectChange', $reg->id) }}" method="POST" class="inline">
                                                    @csrf
                                                    <input type="hidden" name="field" value="{{ $field }}">
                                                    <button type="submit" class="px-3 py-1 bg-red-600 text-white text-xs font-semibold rounded-lg hover:bg-red-700 transition">
                                                        <i class="fas fa-times mr-1"></i> Tolak
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-6">
            {{ $registrations->links() }}
        </div>
    @endif
</div>
@endsection
