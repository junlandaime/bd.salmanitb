@extends('layouts.spn')

@section('title', 'FAQ & Tanya Jawab — Sekolah Pranikah Salman ITB')
@section('meta_description', 'Pertanyaan yang sering diajukan seputar pendaftaran, materi, dan layanan Sekolah Pranikah Salman ITB.')

@section('content')
  @php $activePage = 'faq'; @endphp

  <!-- Header Section -->
  <section class="dot-grid border-b border-navy/10 px-5 sm:px-8 py-14 text-center">
    <div class="max-w-4xl mx-auto">
      <nav class="mb-4 flex items-center justify-center gap-2 text-xs font-semibold text-navy/60">
        <a href="{{ route('spn.index') }}" class="hover:text-orange">Beranda</a>
        <span>/</span>
        <span class="text-orange">FAQ</span>
      </nav>
      <p class="text-xs sm:text-sm font-extrabold uppercase tracking-[0.3em] text-orange mb-3">Tanya &amp; Jawab</p>
      <h1 class="font-display font-black text-3xl sm:text-5xl text-navy">Pertanyaan yang Sering Diajukan</h1>
      <p class="mx-auto mt-4 max-w-2xl text-sm sm:text-base text-navy/70 leading-relaxed">
        Temukan jawaban cepat untuk pertanyaan umum seputar program SPN Salman ITB.
      </p>
    </div>
  </section>

  <!-- FAQ Accordion Section -->
  <section class="bg-cream px-5 sm:px-8 py-14" x-data="{ open: 0 }">
    <div class="max-w-3xl mx-auto space-y-4">

      @if(isset($faqs) && $faqs->isNotEmpty())
        @foreach($faqs as $idx => $faq)
          <div class="bg-white border-2 border-navy/15 rounded-xl overflow-hidden shadow-xs">
            <button @click="open = (open === {{ $idx }} ? null : {{ $idx }})" class="w-full flex items-center justify-between p-5 text-left transition hover:bg-paper/40">
              <span class="font-display font-bold text-navy text-sm sm:text-base">{{ $faq->question }}</span>
              <span class="text-orange font-bold text-lg shrink-0 ml-3" x-text="open === {{ $idx }} ? '−' : '+'"></span>
            </button>
            <div x-show="open === {{ $idx }}" x-collapse class="px-5 pb-5 text-xs sm:text-sm text-navy/80 leading-relaxed border-t border-navy/10 pt-3">
              {!! nl2br(e($faq->answer)) !!}
            </div>
          </div>
        @endforeach
      @else
        <!-- Default Fallback FAQs -->
        <div class="bg-white border-2 border-navy/15 rounded-xl overflow-hidden shadow-xs">
          <button @click="open = (open === 0 ? null : 0)" class="w-full flex items-center justify-between p-5 text-left transition hover:bg-paper/40">
            <span class="font-display font-bold text-navy text-sm sm:text-base">Apa itu Sekolah Pranikah (SPN) Salman ITB?</span>
            <span class="text-orange font-bold text-lg shrink-0 ml-3" x-text="open === 0 ? '−' : '+'"></span>
          </button>
          <div x-show="open === 0" x-collapse class="px-5 pb-5 text-xs sm:text-sm text-navy/80 leading-relaxed border-t border-navy/10 pt-3">
            SPN Salman ITB adalah program edukasi pra-nikah Islami komprehensif dari Bidang Dakwah Masjid Salman ITB yang telah berdiri sejak tahun 2007. Program ini terdiri dari 18 sesi pembelajaran (materi kognitif, simulasi psikomotorik, dan mentoring) yang dirancang untuk membekali calon pengantin agar siap lahir dan batin.
          </div>
        </div>

        <div class="bg-white border-2 border-navy/15 rounded-xl overflow-hidden shadow-xs">
          <button @click="open = (open === 1 ? null : 1)" class="w-full flex items-center justify-between p-5 text-left transition hover:bg-paper/40">
            <span class="font-display font-bold text-navy text-sm sm:text-base">Siapa saja yang boleh mendaftar SPN?</span>
            <span class="text-orange font-bold text-lg shrink-0 ml-3" x-text="open === 1 ? '−' : '+'"></span>
          </button>
          <div x-show="open === 1" x-collapse class="px-5 pb-5 text-xs sm:text-sm text-navy/80 leading-relaxed border-t border-navy/10 pt-3">
            Program ini terbuka untuk seluruh kaum Muslimin (Ikhwan & Akhwat), baik yang berstatus mahasiswa, fresh graduate, profesional muda, maupun umum yang sedang mempersiapkan diri menuju jenjang pernikahan (baik yang sudah memiliki calon pasangan maupun yang belum).
          </div>
        </div>

        <div class="bg-white border-2 border-navy/15 rounded-xl overflow-hidden shadow-xs">
          <button @click="open = (open === 3 ? null : 3)" class="w-full flex items-center justify-between p-5 text-left transition hover:bg-paper/40">
            <span class="font-display font-bold text-navy text-sm sm:text-base">Apa perbedaan SPN Offline (Tatap Muka) dan SPN Online?</span>
            <span class="text-orange font-bold text-lg shrink-0 ml-3" x-text="open === 3 ? '−' : '+'"></span>
          </button>
          <div x-show="open === 3" x-collapse class="px-5 pb-5 text-xs sm:text-sm text-navy/80 leading-relaxed border-t border-navy/10 pt-3">
            <strong>SPN Offline:</strong> Dilaksanakan selama 9 hari pertemuan tatap muka di Komplek Masjid Salman ITB (09.30 – 15.00 WIB), mencakup makan siang, snack harian, seminar kit fisik (notebook, pulpen, goodie bag), dan buku referensi fisik.<br><br>
            <strong>SPN Online:</strong> Dilaksanakan secara <em>live synchronous</em> (tatap maya) via Zoom Meeting selama 7 hari pertemuan (09.30 – 15.00 WIB) ditambah Series Fikih Munakahat setiap Sabtu malam (19.30 – 21.45 WIB). Peserta mendapatkan materi ajar digital, worksheet refleksi, akses seumur hidup ke rekaman materi, serta diskon kemitraan dan akses ke Portal Ta'aruf Salman ITB.
          </div>
        </div>

        <div class="bg-white border-2 border-navy/15 rounded-xl overflow-hidden shadow-xs">
          <button @click="open = (open === 4 ? null : 4)" class="w-full flex items-center justify-between p-5 text-left transition hover:bg-paper/40">
            <span class="font-display font-bold text-navy text-sm sm:text-base">Apakah SPN Online dilaksanakan secara asinkronus (rekaman mandiri)?</span>
            <span class="text-orange font-bold text-lg shrink-0 ml-3" x-text="open === 4 ? '−' : '+'"></span>
          </button>
          <div x-show="open === 4" x-collapse class="px-5 pb-5 text-xs sm:text-sm text-navy/80 leading-relaxed border-t border-navy/10 pt-3">
            Tidak. SPN Online diselenggarakan secara <strong>live &amp; interaktif (synchronous) via Zoom Meeting</strong> dengan pemateri langsung, tanya jawab real-time, dan simulasi kelompok. Namun, peserta tetap mendapatkan akses seumur hidup ke rekaman materi apabila berhalangan hadir pada sesi tertentu.
          </div>
        </div>
      @endif

    </div>
  </section>
@endsection
