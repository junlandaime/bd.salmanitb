@extends('layouts.guest')
@section('title', 'Masuk ke Akun - Bidang Dakwah Masjid Salman ITB')

@section('content')
<div class="w-full max-w-md mx-auto" x-data="{ showPassword: false }">

    {{-- Icon & Heading --}}
    <div class="text-center mb-6">
        <div class="w-14 h-14 rounded-2xl bg-emerald-500/20 border border-emerald-400/30 flex items-center justify-center text-2xl text-emerald-300 mx-auto mb-3 shadow-inner">
            <i class="fas fa-arrow-right-to-bracket"></i>
        </div>
        <h1 class="text-xl font-extrabold text-white tracking-tight">Masuk ke Akun</h1>
        <p class="mt-1 text-xs text-slate-300">Masukkan alamat email dan kata sandi Anda untuk melanjutkan</p>
    </div>

    {{-- Session Status / Flash Message --}}
    @if (session('status'))
        <div class="mb-5 p-3.5 bg-emerald-500/15 border border-emerald-400/30 rounded-xl text-emerald-300 text-xs flex items-center gap-2.5">
            <i class="fas fa-check-circle text-emerald-400 shrink-0"></i>
            <span>{{ session('status') }}</span>
        </div>
    @endif

    {{-- Errors Alert --}}
    @if ($errors->any())
        <div class="mb-5 p-3.5 bg-red-500/10 border border-red-400/30 rounded-xl text-red-300 text-xs flex items-start gap-2.5">
            <i class="fas fa-exclamation-circle text-red-400 mt-0.5 shrink-0"></i>
            <div>
                <p class="font-bold">Gagal masuk:</p>
                <ul class="list-disc list-inside mt-1 space-y-0.5 text-[11px] text-red-200">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}" class="space-y-4">
        @csrf

        <!-- Email Address -->
        <div class="space-y-1">
            <label for="email" class="block text-xs font-semibold text-slate-300">Alamat Email</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                    <i class="fas fa-envelope text-sm"></i>
                </div>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username"
                    placeholder="nama@email.com"
                    class="w-full pl-10 pr-4 py-2.5 rounded-xl bg-white/10 border border-white/20 text-white placeholder-slate-400 text-xs focus:outline-none focus:ring-4 focus:ring-emerald-500/20 focus:border-emerald-400 transition" />
            </div>
            @error('email')
                <p class="text-[11px] text-red-400 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Password -->
        <div class="space-y-1">
            <label for="password" class="block text-xs font-semibold text-slate-300">Kata Sandi</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                    <i class="fas fa-lock text-sm"></i>
                </div>
                <input id="password" :type="showPassword ? 'text' : 'password'" name="password" required
                    autocomplete="current-password" placeholder="••••••••"
                    class="w-full pl-10 pr-10 py-2.5 rounded-xl bg-white/10 border border-white/20 text-white placeholder-slate-400 text-xs focus:outline-none focus:ring-4 focus:ring-emerald-500/20 focus:border-emerald-400 transition" />
                <button type="button" @click="showPassword = !showPassword"
                    class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-slate-400 hover:text-white transition focus:outline-none">
                    <i :class="showPassword ? 'fas fa-eye-slash' : 'fas fa-eye'" class="text-xs"></i>
                </button>
            </div>
            @error('password')
                <p class="text-[11px] text-red-400 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Remember Me and Forgot Password -->
        <div class="flex items-center justify-between pt-1">
            <label for="remember_me" class="inline-flex items-center cursor-pointer">
                <input id="remember_me" type="checkbox" name="remember"
                    class="rounded border-white/20 bg-white/10 text-emerald-500 shadow-2xs focus:ring-emerald-400/30 cursor-pointer">
                <span class="ml-2 text-xs text-slate-300">Ingat saya</span>
            </label>

            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}"
                    class="text-xs font-semibold text-emerald-400 hover:text-emerald-300 transition">
                    Lupa kata sandi?
                </a>
            @endif
        </div>

        <!-- Submit Button -->
        <div class="pt-2">
            <button type="submit"
                class="w-full inline-flex items-center justify-center gap-2 py-3 px-4 rounded-xl bg-gradient-to-r from-emerald-500 to-teal-600 hover:from-emerald-600 hover:to-teal-700 text-white font-bold text-xs shadow-lg shadow-emerald-900/30 hover:shadow-xl transition">
                <span>Masuk ke Akun</span>
                <span>&rarr;</span>
            </button>
        </div>

        <!-- Register & Alumni Activation Links -->
        <div class="pt-4 border-t border-white/10 space-y-3">
            <div class="text-center">
                <p class="text-xs text-slate-300 mb-2">
                    Belum punya akun Bidang Dakwah?
                </p>
                <a href="{{ route('register') }}"
                    class="inline-flex items-center justify-center gap-1.5 w-full py-2.5 px-4 border border-emerald-400/30 bg-emerald-500/10 hover:bg-emerald-500/20 text-emerald-300 text-xs font-bold rounded-xl transition shadow-2xs">
                    <svg class="w-4 h-4 text-emerald-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                    </svg>
                    <span>Daftar Akun Peserta Baru</span>
                    <span>&rarr;</span>
                </a>
            </div>

            <div class="pt-2 border-t border-white/10 text-center">
                <p class="text-[11px] text-slate-400">
                    Alumni SPN / Kegiatan Salman?
                    <a href="{{ route('activation.email.form') }}" class="font-semibold text-emerald-400 hover:text-emerald-300 underline ml-1">
                        Aktivasi Akun Alumni &rarr;
                    </a>
                </p>
            </div>
        </div>
    </form>
</div>
@endsection
