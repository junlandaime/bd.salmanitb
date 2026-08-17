@extends('layouts.guest')
@section('title', 'Aktivasi Berhasil - Bidang Dakwah Masjid Salman ITB')

@section('content')
<div class="w-full max-w-md mx-auto text-center">

    {{-- Success icon --}}
    <div class="w-20 h-20 rounded-full bg-emerald-500/20 border border-emerald-400/30 flex items-center justify-center text-4xl text-emerald-300 mx-auto mb-6">
        <i class="fas fa-check-circle"></i>
    </div>

    <h1 class="text-xl font-extrabold text-white">
        @if(!empty($isAlumni))
            Akun Alumni Berhasil Diaktifkan!
        @else
            Akun Pendaftaran Berhasil Diaktifkan!
        @endif
    </h1>
    <p class="mt-3 text-sm text-slate-300 leading-relaxed">
        @if(!empty($isAlumni))
            Selamat! Akun alumni Anda telah aktif. Anda kini bisa mengakses semua materi dan fitur eksklusif alumni Bidang Dakwah Masjid Salman ITB.
        @else
            Selamat! Password Anda telah berhasil dibuat. Anda kini dapat memantau status pendaftaran dan pembayaran Anda melalui Dashboard Peserta.
        @endif
    </p>

    {{-- CTA --}}
    <div class="mt-8">
        @if(!empty($isAlumni))
            <a href="{{ route('alumni.dashboard') }}"
                class="inline-flex justify-center items-center gap-2 w-full px-6 py-3 rounded-xl bg-gradient-to-r from-emerald-500 to-teal-600 hover:from-emerald-600 hover:to-teal-700 text-white font-bold text-sm shadow-lg shadow-emerald-900/30 transition">
                <i class="fas fa-graduation-cap"></i>
                Masuk ke Dashboard Alumni
            </a>
        @else
            <a href="{{ route('peserta.dashboard') }}"
                class="inline-flex justify-center items-center gap-2 w-full px-6 py-3 rounded-xl bg-gradient-to-r from-emerald-500 to-teal-600 hover:from-emerald-600 hover:to-teal-700 text-white font-bold text-sm shadow-lg shadow-emerald-900/30 transition">
                <i class="fas fa-user-circle"></i>
                Masuk ke Dashboard Peserta
            </a>
        @endif
    </div>

    <p class="mt-4 text-xs text-slate-400">
        Atau <a href="{{ route('login') }}" class="text-emerald-400 font-bold hover:text-emerald-300 transition">login kembali</a>
    </p>

</div>
@endsection
