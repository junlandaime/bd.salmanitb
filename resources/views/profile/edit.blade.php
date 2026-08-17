@extends('layouts.app')

@section('title', 'Pengaturan Akun & Profil - Bidang Dakwah Masjid Salman ITB')

@section('content')
<div class="min-h-screen bg-slate-50/70 py-10">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

        @php
            $user = Auth::user();
            $backUrl = match (true) {
                $user->hasAnyRole(['superAdmin', 'admin', 'admin_spn', 'admin_taaruf']) => route('admin.dashboard'),
                $user->hasRole('author') => route('author.dashboard'),
                $user->hasRole('alumni') => route('alumni.dashboard'),
                default => route('peserta.dashboard'),
            };
        @endphp

        <!-- Top Header & Breadcrumb -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <div class="flex items-center gap-2 text-xs text-gray-500 mb-1">
                    <a href="{{ $backUrl }}" class="hover:text-emerald-700 font-medium">Dashboard</a>
                    <span>/</span>
                    <span class="text-gray-800 font-semibold">Pengaturan Profil</span>
                </div>
                <h1 class="text-2xl sm:text-3xl font-extrabold text-gray-900 tracking-tight">
                    Pengaturan Akun &amp; Profil
                </h1>
                <p class="text-xs sm:text-sm text-gray-500 mt-1">
                    Kelola informasi akun, kata sandi, dan preferensi privasi Anda.
                </p>
            </div>
            <a href="{{ $backUrl }}"
                class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-white border border-gray-200 hover:bg-gray-50 text-gray-700 font-bold text-xs shadow-2xs transition self-start sm:self-auto">
                <i class="fas fa-arrow-left text-xs"></i>
                <span>Kembali ke Dashboard</span>
            </a>
        </div>

        <!-- User Summary Card -->
        <div class="bg-white rounded-3xl border border-gray-200/80 p-5 sm:p-6 shadow-sm flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div class="flex items-center gap-4">
                <div class="w-14 h-14 rounded-2xl bg-emerald-100 text-emerald-800 font-extrabold text-xl flex items-center justify-center border border-emerald-200 shadow-2xs shrink-0">
                    {{ strtoupper(substr($user->name, 0, 1)) }}
                </div>
                <div class="min-w-0">
                    <h3 class="text-base font-bold text-gray-900 truncate">{{ $user->name }}</h3>
                    <p class="text-xs text-gray-500 truncate">{{ $user->email }}</p>
                    <div class="flex flex-wrap gap-1.5 mt-1.5">
                        @forelse($user->roles as $role)
                            <span class="px-2 py-0.5 rounded-md text-[10px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                {{ ucfirst($role->name) }}
                            </span>
                        @empty
                            <span class="px-2 py-0.5 rounded-md text-[10px] font-bold bg-gray-100 text-gray-600 border border-gray-200">
                                Peserta
                            </span>
                        @endforelse
                    </div>
                </div>
            </div>
            <div class="text-xs text-gray-400 sm:text-right border-t sm:border-t-0 pt-3 sm:pt-0 border-gray-100">
                <span class="block text-[11px]">Bergabung sejak</span>
                <span class="font-semibold text-gray-700">{{ $user->created_at->translatedFormat('d F Y') }}</span>
            </div>
        </div>

        <!-- Section 1: Update Profile Info -->
        <div class="p-6 sm:p-8 bg-white border border-gray-200/80 rounded-3xl shadow-sm">
            <div class="max-w-2xl">
                @include('profile.partials.update-profile-information-form')
            </div>
        </div>

        <!-- Section 2: Update Password -->
        <div class="p-6 sm:p-8 bg-white border border-gray-200/80 rounded-3xl shadow-sm">
            <div class="max-w-2xl">
                @include('profile.partials.update-password-form')
            </div>
        </div>

        <!-- Section 3: Delete Account -->
        <div class="p-6 sm:p-8 bg-white border border-gray-200/80 rounded-3xl shadow-sm">
            <div class="max-w-2xl">
                @include('profile.partials.delete-user-form')
            </div>
        </div>

    </div>
</div>
@endsection
