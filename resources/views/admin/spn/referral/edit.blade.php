@extends('admin.layouts.app')

@section('title', 'Edit Referral Code SPN - Admin Panel')

@section('content')
<div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8 max-w-3xl">
    
    <!-- Header -->
    <div class="flex items-center justify-between mb-8">
        <div>
            <div class="flex items-center gap-2 text-xs text-gray-500 mb-1">
                <a href="{{ route('admin.spn.referral.index') }}" class="hover:text-emerald-600">Kode Referral SPN</a>
                <span>/</span>
                <span>Edit</span>
            </div>
            <h1 class="text-2xl font-bold text-gray-900">Edit Referral Code: {{ $referralCode->code }}</h1>
            <p class="text-sm text-gray-500 mt-0.5">Perbarui nama pemilik, nilai potongan, kuota pemakaian, atau status aktif voucher.</p>
        </div>
        <a href="{{ route('admin.spn.referral.index') }}"
            class="px-4 py-2.5 rounded-xl border border-gray-300 bg-white text-gray-700 hover:bg-gray-50 font-semibold text-sm shadow-sm transition">
            &larr; Kembali
        </a>
    </div>

    @if($errors->any())
        <div class="bg-red-50 border border-red-200 text-red-800 p-4 rounded-2xl mb-6 shadow-sm">
            <ul class="list-disc list-inside text-xs space-y-1">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="bg-white rounded-2xl border border-gray-200/80 shadow-sm p-6 sm:p-8">
        <form action="{{ route('admin.spn.referral.update', $referralCode->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label for="code" class="block text-xs font-semibold text-gray-700 mb-1">Kode Referral <span class="text-red-500">*</span></label>
                <input type="text" name="code" id="code" value="{{ old('code', $referralCode->code) }}" required
                    class="w-full px-3.5 py-2.5 text-sm font-mono uppercase tracking-wider border border-gray-300 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition">
            </div>

            <div>
                <label for="owner_name" class="block text-xs font-semibold text-gray-700 mb-1">Nama Pemilik / Afiliasi <span class="text-red-500">*</span></label>
                <input type="text" name="owner_name" id="owner_name" value="{{ old('owner_name', $referralCode->owner_name) }}" required
                    class="w-full px-3.5 py-2.5 text-sm border border-gray-300 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition">
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label for="discount_amount" class="block text-xs font-semibold text-gray-700 mb-1">Nominal Diskon (Rp) <span class="text-red-500">*</span></label>
                    <input type="number" name="discount_amount" id="discount_amount" value="{{ old('discount_amount', $referralCode->discount_amount) }}" required
                        class="w-full px-3.5 py-2.5 text-sm border border-gray-300 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition">
                </div>

                <div>
                    <label for="max_usage" class="block text-xs font-semibold text-gray-700 mb-1">Maksimal Pemakaian</label>
                    <input type="number" name="max_usage" id="max_usage" value="{{ old('max_usage', $referralCode->max_usage) }}"
                        class="w-full px-3.5 py-2.5 text-sm border border-gray-300 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition">
                </div>
            </div>

            <div class="p-4 rounded-xl bg-gray-50 border border-gray-100 flex items-center justify-between">
                <div>
                    <span class="text-xs font-semibold text-gray-500">Statistik Penggunaan</span>
                    <div class="text-sm font-bold text-gray-900 mt-0.5">Telah Digunakan: <span class="text-emerald-600">{{ $referralCode->used_count }} kali</span></div>
                </div>
                @if($referralCode->max_usage)
                    <div class="text-right">
                        <span class="text-xs text-gray-400">Sisa Kuota:</span>
                        <div class="text-sm font-bold text-gray-700">{{ max(0, $referralCode->max_usage - $referralCode->used_count) }} slot</div>
                    </div>
                @endif
            </div>

            <div class="pt-2 border-t border-gray-100">
                <label class="flex items-center gap-2.5 cursor-pointer">
                    <input id="is_active" name="is_active" type="checkbox" value="1" {{ old('is_active', $referralCode->is_active) ? 'checked' : '' }}
                        class="h-4 w-4 rounded text-emerald-600 focus:ring-emerald-500 border-gray-300">
                    <div>
                        <span class="block text-xs font-semibold text-gray-800">Aktifkan Kode Referral</span>
                    </div>
                </label>
            </div>

            <div class="flex items-center justify-end gap-3 pt-4 border-t border-gray-100">
                <a href="{{ route('admin.spn.referral.index') }}"
                    class="px-5 py-2.5 rounded-xl border border-gray-300 bg-white text-gray-700 hover:bg-gray-50 font-semibold text-sm shadow-sm transition">
                    Batal
                </a>
                <button type="submit"
                    class="px-6 py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-semibold text-sm shadow-sm transition">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
