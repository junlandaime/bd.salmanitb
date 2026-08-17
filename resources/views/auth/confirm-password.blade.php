@extends('layouts.guest')
@section('title', 'Konfirmasi Password - Bidang Dakwah Masjid Salman ITB')

@section('content')
<div class="w-full max-w-md mx-auto">

    <!-- Icon & Heading -->
    <div class="text-center mb-8">
        <div class="w-16 h-16 rounded-2xl bg-emerald-500/20 border border-emerald-400/30 flex items-center justify-center text-3xl text-emerald-300 mx-auto mb-4 shadow-lg shadow-emerald-950/20">
            <i class="fas fa-lock"></i>
        </div>
        <h1 class="text-xl font-extrabold text-white">Konfirmasi Password</h1>
        <p class="mt-2 text-xs text-slate-300 leading-relaxed">
            Ini adalah area aman aplikasi. Masukkan password Anda untuk melanjutkan.
        </p>
    </div>

    <form method="POST" action="{{ route('password.confirm') }}" class="space-y-5">
        @csrf

        <!-- Password -->
        <div class="space-y-1.5" x-data="{ show: false }">
            <label for="password" class="block text-xs font-semibold text-slate-300">Password Akun</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                    <i class="fas fa-lock text-sm"></i>
                </div>
                <input id="password" :type="show ? 'text' : 'password'" name="password" required autocomplete="current-password"
                    class="w-full pl-10 pr-10 py-3 rounded-xl bg-white/10 border border-white/20 text-white placeholder-slate-400 text-sm focus:outline-none focus:ring-4 focus:ring-emerald-500/20 focus:border-emerald-400 transition"
                    placeholder="Masukkan password Anda">
                <button type="button" @click="show = !show"
                    class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-slate-400 hover:text-white transition">
                    <i :class="show ? 'fas fa-eye-slash' : 'fas fa-eye'" class="text-sm"></i>
                </button>
            </div>
            @error('password')
                <p class="text-xs text-red-400 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit"
            class="w-full py-3 px-4 rounded-xl bg-gradient-to-r from-emerald-500 to-teal-600 hover:from-emerald-600 hover:to-teal-700 text-white font-bold text-sm shadow-lg shadow-emerald-900/30 transition">
            <i class="fas fa-arrow-right mr-2"></i>
            Lanjutkan
        </button>
    </form>

</div>
@endsection
