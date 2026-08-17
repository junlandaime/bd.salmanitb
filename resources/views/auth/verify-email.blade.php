@extends('layouts.guest')
@section('title', 'Verifikasi Email - Bidang Dakwah Masjid Salman ITB')

@section('content')
<div class="w-full max-w-md mx-auto">

    <!-- Icon & Heading -->
    <div class="text-center mb-8">
        <div class="w-16 h-16 rounded-2xl bg-emerald-500/20 border border-emerald-400/30 flex items-center justify-center text-3xl text-emerald-300 mx-auto mb-4 shadow-lg shadow-emerald-950/20">
            <i class="fas fa-envelope-open-text"></i>
        </div>
        <h1 class="text-xl font-extrabold text-white">Verifikasi Alamat Email</h1>
        <p class="mt-2 text-xs text-slate-300 leading-relaxed">
            Terima kasih telah mendaftar! Sebelum memulai, silakan klik tautan verifikasi yang telah kami kirimkan ke email Anda.
        </p>
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-6 flex items-center gap-3 px-4 py-3 rounded-xl bg-emerald-500/15 border border-emerald-400/30 text-emerald-300 text-xs font-medium">
            <i class="fas fa-check-circle flex-shrink-0"></i>
            <span>Tautan verifikasi baru telah dikirim ke alamat email Anda.</span>
        </div>
    @endif

    <div class="space-y-4">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <button type="submit"
                class="w-full py-3 px-4 rounded-xl bg-gradient-to-r from-emerald-500 to-teal-600 hover:from-emerald-600 hover:to-teal-700 text-white font-bold text-sm shadow-lg shadow-emerald-900/30 transition">
                <i class="fas fa-paper-plane mr-2"></i>
                Kirim Ulang Email Verifikasi
            </button>
        </form>

        <form method="POST" action="{{ route('logout') }}" class="text-center">
            @csrf
            <button type="submit" class="text-xs text-slate-400 hover:text-white transition font-medium">
                <i class="fas fa-sign-out-alt mr-1"></i>
                Keluar (Logout)
            </button>
        </form>
    </div>

</div>
@endsection
