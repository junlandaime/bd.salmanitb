@extends('layouts.guest')
@section('title', 'Email Aktivasi Terkirim - Bidang Dakwah Masjid Salman ITB')

@section('content')
<div class="w-full max-w-md mx-auto text-center">

    {{-- Animated icon --}}
    <div class="w-20 h-20 rounded-full bg-emerald-500/20 border border-emerald-400/30 flex items-center justify-center text-4xl text-emerald-300 mx-auto mb-6 animate-bounce">
        <i class="fas fa-envelope-open"></i>
    </div>

    <h1 class="text-xl font-extrabold text-white">Email Aktivasi Terkirim!</h1>
    <p class="mt-3 text-sm text-slate-300 leading-relaxed">
        Kami telah mengirimkan link aktivasi ke alamat email Anda.<br>
        Silakan periksa kotak masuk (inbox) atau folder <strong class="text-white">spam</strong>.
    </p>
    <p class="mt-2 text-xs text-slate-400">
        Jika tidak menerima email dalam beberapa menit, coba kirim ulang.
    </p>

    {{-- Actions --}}
    <div class="mt-8 flex flex-col sm:flex-row gap-3">
        <a href="{{ route('activation.email.form') }}"
            class="flex-1 inline-flex justify-center items-center gap-2 px-4 py-3 rounded-xl border border-white/20 bg-white/10 hover:bg-white/15 text-white text-xs font-bold transition">
            <i class="fas fa-redo"></i>
            Kirim Ulang
        </a>
        <a href="{{ route('login') }}"
            class="flex-1 inline-flex justify-center items-center gap-2 px-4 py-3 rounded-xl bg-gradient-to-r from-emerald-500 to-teal-600 hover:from-emerald-600 hover:to-teal-700 text-white text-xs font-bold shadow-lg shadow-emerald-900/30 transition">
            <i class="fas fa-sign-in-alt"></i>
            Ke Halaman Login
        </a>
    </div>

</div>
@endsection
