@extends('layouts.guest')
@section('title', 'Daftar Akun Peserta - Bidang Dakwah Masjid Salman ITB')

@section('content')
<div class="w-full max-w-md mx-auto" x-data="{ showPassword: false, showConfirmPassword: false }">

    {{-- Icon & Heading --}}
    <div class="text-center mb-6">
        <div class="w-14 h-14 rounded-2xl bg-emerald-500/20 border border-emerald-400/30 flex items-center justify-center text-2xl text-emerald-300 mx-auto mb-3 shadow-inner">
            <i class="fas fa-user-plus"></i>
        </div>
        <h1 class="text-xl font-extrabold text-white tracking-tight">Daftar Akun Peserta</h1>
        <p class="mt-1 text-xs text-slate-300">Buat akun untuk mendaftar program &amp; mengakses dashboard peserta</p>
    </div>

    <!-- Session Status / Errors Alert -->
    @if ($errors->any())
        <div class="mb-5 p-3.5 bg-red-500/10 border border-red-400/30 rounded-xl text-red-300 text-xs flex items-start gap-2.5">
            <i class="fas fa-exclamation-circle text-red-400 mt-0.5 shrink-0"></i>
            <div>
                <p class="font-bold">Mohon periksa data yang Anda masukkan:</p>
                <ul class="list-disc list-inside mt-1 space-y-0.5 text-[11px] text-red-200">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

    <form method="POST" action="{{ route('register') }}" class="space-y-4">
        @csrf

        <!-- Honeypot (Anti-bot Protection) -->
        <div style="position:absolute;left:-9999px;top:-9999px;" aria-hidden="true">
            <input type="text" name="website" tabindex="-1" autocomplete="off" value="">
        </div>

        <!-- Nama Lengkap -->
        <div class="space-y-1">
            <label for="name" class="block text-xs font-semibold text-slate-300">Nama Lengkap</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                    <i class="fas fa-user text-sm"></i>
                </div>
                <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name"
                    placeholder="Nama lengkap sesuai KTP"
                    class="w-full pl-10 pr-4 py-2.5 rounded-xl bg-white/10 border border-white/20 text-white placeholder-slate-400 text-xs focus:outline-none focus:ring-4 focus:ring-emerald-500/20 focus:border-emerald-400 transition" />
            </div>
            @error('name')
                <p class="text-[11px] text-red-400 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Email Address -->
        <div class="space-y-1">
            <label for="email" class="block text-xs font-semibold text-slate-300">Alamat Email</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                    <i class="fas fa-envelope text-sm"></i>
                </div>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username"
                    placeholder="nama@email.com"
                    class="w-full pl-10 pr-4 py-2.5 rounded-xl bg-white/10 border border-white/20 text-white placeholder-slate-400 text-xs focus:outline-none focus:ring-4 focus:ring-emerald-500/20 focus:border-emerald-400 transition" />
            </div>
            @error('email')
                <p class="text-[11px] text-red-400 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Password -->
        <div class="space-y-1">
            <label for="password" class="block text-xs font-semibold text-slate-300">Kata Sandi (Password)</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                    <i class="fas fa-lock text-sm"></i>
                </div>
                <input id="password" :type="showPassword ? 'text' : 'password'" name="password" required
                    autocomplete="new-password" placeholder="Minimal 8 karakter"
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

        <!-- Confirm Password -->
        <div class="space-y-1">
            <label for="password_confirmation" class="block text-xs font-semibold text-slate-300">Konfirmasi Kata Sandi</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                    <i class="fas fa-shield-alt text-sm"></i>
                </div>
                <input id="password_confirmation" :type="showConfirmPassword ? 'text' : 'password'"
                    name="password_confirmation" required autocomplete="new-password" placeholder="Ulangi kata sandi di atas"
                    class="w-full pl-10 pr-10 py-2.5 rounded-xl bg-white/10 border border-white/20 text-white placeholder-slate-400 text-xs focus:outline-none focus:ring-4 focus:ring-emerald-500/20 focus:border-emerald-400 transition" />
                <button type="button" @click="showConfirmPassword = !showConfirmPassword"
                    class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-slate-400 hover:text-white transition focus:outline-none">
                    <i :class="showConfirmPassword ? 'fas fa-eye-slash' : 'fas fa-eye'" class="text-xs"></i>
                </button>
            </div>
            @error('password_confirmation')
                <p class="text-[11px] text-red-400 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Submit Button -->
        <div class="pt-3">
            <button type="submit"
                class="w-full inline-flex items-center justify-center gap-2 py-3 px-4 rounded-xl bg-gradient-to-r from-emerald-500 to-teal-600 hover:from-emerald-600 hover:to-teal-700 text-white font-bold text-xs shadow-lg shadow-emerald-900/30 hover:shadow-xl transition">
                <span>Daftar Sekarang</span>
                <span>&rarr;</span>
            </button>
        </div>

        <!-- Back to Login Link -->
        <div class="pt-4 border-t border-white/10 text-center space-y-2">
            <p class="text-xs text-slate-300">
                Sudah memiliki akun terdaftar?
            </p>
            <a href="{{ route('login') }}"
                class="inline-flex items-center justify-center gap-1.5 w-full py-2.5 px-4 border border-emerald-400/30 bg-emerald-500/10 hover:bg-emerald-500/20 text-emerald-300 text-xs font-bold rounded-xl transition">
                <span>Masuk ke Akun Anda</span>
                <span>&rarr;</span>
            </a>
        </div>
    </form>
</div>
@endsection
