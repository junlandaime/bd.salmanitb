@extends('layouts.guest')
@section('title', 'Link Aktivasi Tidak Valid - Bidang Dakwah Masjid Salman ITB')

@section('content')
<div class="w-full max-w-md mx-auto text-center">

    {{-- Error icon --}}
    <div class="w-20 h-20 rounded-full bg-red-500/20 border border-red-400/30 flex items-center justify-center text-4xl text-red-300 mx-auto mb-6">
        <i class="fas fa-exclamation-triangle"></i>
    </div>

    <h1 class="text-xl font-extrabold text-white">Link Tidak Valid atau Kadaluarsa</h1>
    <p class="mt-3 text-sm text-slate-300 leading-relaxed">
        Link aktivasi yang Anda gunakan tidak valid atau sudah kadaluarsa.<br>
        Silakan minta link aktivasi baru dengan memasukkan email Anda.
    </p>

    {{-- CTA --}}
    <div class="mt-8 flex flex-col gap-3">
        <a href="{{ route('activation.email.form') }}"
            class="inline-flex justify-center items-center gap-2 w-full px-6 py-3 rounded-xl bg-gradient-to-r from-emerald-500 to-teal-600 hover:from-emerald-600 hover:to-teal-700 text-white font-bold text-sm shadow-lg shadow-emerald-900/30 transition">
            <i class="fas fa-redo"></i>
            Minta Link Aktivasi Baru
        </a>
        <a href="{{ route('login') }}"
            class="inline-flex justify-center items-center gap-2 w-full px-6 py-3 rounded-xl border border-white/20 bg-white/10 hover:bg-white/15 text-white text-xs font-bold transition">
            <i class="fas fa-arrow-left"></i>
            Kembali ke Login
        </a>
    </div>

</div>
@endsection
