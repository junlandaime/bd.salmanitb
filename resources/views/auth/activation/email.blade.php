@extends('layouts.guest')
@section('title', 'Aktivasi Akun Alumni - Bidang Dakwah Masjid Salman ITB')

@section('content')
<div class="w-full max-w-md mx-auto">
    
    {{-- Icon & heading --}}
    <div class="text-center mb-8">
        <div class="w-16 h-16 rounded-2xl bg-emerald-500/20 border border-emerald-400/30 flex items-center justify-center text-3xl text-emerald-300 mx-auto mb-4">
            <i class="fas fa-envelope-open-text"></i>
        </div>
        <h1 class="text-xl font-extrabold text-white">Aktivasi Akun Alumni</h1>
        <p class="mt-1 text-xs text-slate-400">Masukkan email untuk menerima link aktivasi</p>
    </div>

    {{-- Error session --}}
    @if(session('error'))
        <div class="mb-6 flex items-center gap-3 px-4 py-3 rounded-xl bg-red-500/10 border border-red-400/30 text-red-300 text-xs font-medium">
            <i class="fas fa-exclamation-circle flex-shrink-0"></i>
            <span>{{ session('error') }}</span>
        </div>
    @endif

    {{-- Form --}}
    <form method="POST" action="{{ route('activation.verify.email') }}" class="space-y-5">
        @csrf

        <div class="space-y-1.5">
            <label for="email" class="block text-xs font-semibold text-slate-300">Alamat Email</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                    <i class="fas fa-envelope text-sm"></i>
                </div>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                    class="w-full pl-10 pr-4 py-3 rounded-xl bg-white/10 border border-white/20 text-white placeholder-slate-400 text-sm focus:outline-none focus:ring-4 focus:ring-emerald-500/20 focus:border-emerald-400 transition"
                    placeholder="email@contoh.com">
            </div>
            @error('email')
                <p class="text-xs text-red-400 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit"
            class="w-full py-3 px-4 rounded-xl bg-gradient-to-r from-emerald-500 to-teal-600 hover:from-emerald-600 hover:to-teal-700 text-white font-bold text-sm shadow-lg shadow-emerald-900/30 transition">
            <i class="fas fa-paper-plane mr-2"></i>
            Kirim Link Aktivasi
        </button>
    </form>

    {{-- Back to login --}}
    <p class="mt-6 text-center text-xs text-slate-400">
        Sudah punya akun?
        <a href="{{ route('login') }}" class="text-emerald-400 font-bold hover:text-emerald-300 transition">
            Masuk di sini
        </a>
    </p>

</div>
@endsection
