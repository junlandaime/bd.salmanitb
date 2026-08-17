@extends('layouts.peserta')

@section('title', 'Dashboard Peserta - Bidang Dakwah Salman ITB')
@section('header', 'Dashboard Peserta')

@section('content')
<div class="max-w-5xl mx-auto space-y-6">
    
    <!-- Hero Welcome Banner -->
    <div class="relative overflow-hidden rounded-3xl bg-gradient-to-br from-teal-800 via-emerald-800 to-teal-950 text-white p-6 sm:p-8 shadow-lg shadow-teal-950/10 border border-teal-700/40">
        <!-- Ambient Decorative Glows -->
        <div aria-hidden="true" class="absolute -top-24 -right-24 w-72 h-72 rounded-full bg-emerald-400/20 blur-3xl pointer-events-none"></div>
        <div aria-hidden="true" class="absolute -bottom-24 -left-24 w-72 h-72 rounded-full bg-teal-300/15 blur-3xl pointer-events-none"></div>
        <div class="absolute right-6 bottom-4 opacity-10 hidden md:block text-white">
            <i class="fas fa-mosque text-8xl"></i>
        </div>

        <div class="relative z-10 flex flex-col md:flex-row md:items-center md:justify-between gap-6">
            <div class="space-y-2 max-w-xl">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white/10 backdrop-blur-xs border border-white/15 text-emerald-200 text-xs font-semibold">
                    <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                    <span>Portal Peserta Bidang Dakwah</span>
                </div>
                <h1 class="text-2xl sm:text-3xl font-extrabold tracking-tight text-white leading-tight">
                    Ahlan wa Sahlan, {{ auth()->user()->name }}! 👋
                </h1>
                <p class="text-xs sm:text-sm text-emerald-100/90 leading-relaxed">
                    Pantau status pendaftaran kegiatan dakwah, perbarui data berkas, dan sampaikan pertanyaan atau saran Anda langsung ke tim pengelola.
                </p>
            </div>

            <div class="flex flex-wrap gap-2.5 shrink-0">
                <a href="{{ route('profile.edit') }}"
                    class="inline-flex items-center gap-2 px-3.5 py-2.5 rounded-xl bg-white/15 hover:bg-white/25 text-white font-semibold text-xs border border-white/20 backdrop-blur-xs transition shadow-2xs">
                    <i class="fas fa-user-cog text-teal-300"></i>
                    <span>Pengaturan Akun</span>
                </a>
                <a href="{{ route('peserta.feedback.create') }}"
                    class="inline-flex items-center gap-2 px-3.5 py-2.5 rounded-xl bg-white/15 hover:bg-white/25 text-white font-semibold text-xs border border-white/20 backdrop-blur-xs transition shadow-2xs">
                    <i class="fas fa-comment-dots text-emerald-300"></i>
                    <span>Kirim Feedback</span>
                </a>
                <a href="{{ route('spn.index') }}" target="_blank"
                    class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-emerald-500 hover:bg-emerald-400 text-teal-950 font-bold text-xs shadow-md transition">
                    <span>Lihat Program</span>
                    <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>

    <!-- Quick Stats & Status Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
        <!-- Stat 1: Total Program -->
        <div class="bg-white rounded-2xl p-5 border border-gray-200/80 shadow-xs flex items-center justify-between">
            <div class="space-y-1">
                <p class="text-xs font-bold uppercase tracking-wider text-gray-500">Program Terdaftar</p>
                <div class="flex items-baseline gap-2">
                    <span class="text-2xl font-extrabold text-gray-900">{{ $registrations->count() }}</span>
                    <span class="text-xs text-gray-500">kegiatan</span>
                </div>
            </div>
            <div class="w-12 h-12 rounded-2xl bg-teal-50 text-teal-700 flex items-center justify-center text-xl shadow-2xs">
                <i class="fas fa-graduation-cap"></i>
            </div>
        </div>

        <!-- Stat 2: Latest Status -->
        @php
            $latestReg = $registrations->first();
        @endphp
        <div class="bg-white rounded-2xl p-5 border border-gray-200/80 shadow-xs flex items-center justify-between">
            <div class="space-y-1">
                <p class="text-xs font-bold uppercase tracking-wider text-gray-500">Status Pendaftaran</p>
                @if($latestReg)
                    <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-xs font-bold border {{ $latestReg->status_badge }}">
                        @if($latestReg->status == 'terverifikasi')
                            <i class="fas fa-check-circle text-emerald-600"></i> Terverifikasi
                        @elseif($latestReg->status == 'ditolak')
                            <i class="fas fa-times-circle text-red-600"></i> Perlu Revisi
                        @else
                            <i class="fas fa-clock text-yellow-600"></i> Menunggu Verifikasi
                        @endif
                    </span>
                @else
                    <span class="text-xs text-gray-400 font-medium italic">Belum Mendaftar</span>
                @endif
            </div>
            <div class="w-12 h-12 rounded-2xl bg-emerald-50 text-emerald-700 flex items-center justify-center text-xl shadow-2xs">
                <i class="fas fa-clipboard-check"></i>
            </div>
        </div>

        <!-- Stat 3: Feedback & Bantuan -->
        @php
            $myFeedbacks = \App\Models\Feedback::byUser(auth()->id())->get();
            $myAnswered = $myFeedbacks->where('status', 'answered')->count();
        @endphp
        <a href="{{ route('peserta.feedback.index') }}" class="bg-white rounded-2xl p-5 border border-gray-200/80 shadow-xs hover:border-teal-300 hover:shadow-sm transition flex items-center justify-between group">
            <div class="space-y-1">
                <div class="flex items-center gap-2">
                    <p class="text-xs font-bold uppercase tracking-wider text-gray-500">Feedback &amp; Aspirasi</p>
                    @if($myAnswered > 0)
                        <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                    @endif
                </div>
                <div class="flex items-center gap-2">
                    <span class="text-2xl font-extrabold text-gray-900">{{ $myFeedbacks->count() }}</span>
                    @if($myAnswered > 0)
                        <span class="text-xs font-bold text-emerald-700 bg-emerald-50 px-2 py-0.5 rounded-md border border-emerald-200">
                            {{ $myAnswered }} Baru Dibalas
                        </span>
                    @else
                        <span class="text-xs text-gray-500">tiket terkirim</span>
                    @endif
                </div>
            </div>
            <div class="w-12 h-12 rounded-2xl bg-teal-50 text-teal-700 group-hover:bg-teal-600 group-hover:text-white transition flex items-center justify-center text-xl shadow-2xs">
                <i class="fas fa-comment-dots"></i>
            </div>
        </a>
    </div>

    <!-- Program Registrations Section -->
    <div class="space-y-4">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-lg font-bold text-gray-900">Program &amp; Pendaftaran Anda</h2>
                <p class="text-xs text-gray-500">Rincian status proses verifikasi, berkas, dan pembayaran pendaftaran.</p>
            </div>
            @if($registrations->isNotEmpty())
                <span class="px-3 py-1 bg-teal-50 text-teal-800 text-xs font-bold rounded-full border border-teal-200">
                    {{ $registrations->count() }} Pendaftaran Aktif
                </span>
            @endif
        </div>

        @if($registrations->isEmpty())
            <!-- Empty State & Discovery -->
            <div class="bg-white rounded-3xl border border-gray-200/80 shadow-sm p-8 sm:p-12 text-center space-y-6">
                <div class="w-20 h-20 rounded-3xl bg-gradient-to-br from-teal-50 to-emerald-100 text-teal-700 flex items-center justify-center mx-auto text-3xl shadow-inner border border-teal-100">
                    <i class="fas fa-compass"></i>
                </div>
                <div class="max-w-md mx-auto space-y-2">
                    <h3 class="text-xl font-bold text-gray-900">Anda Belum Terdaftar di Program Manapun</h3>
                    <p class="text-xs text-gray-500 leading-relaxed">
                        Saat ini Anda belum memiliki pendaftaran aktif. Silakan jelajahi program pembinaan, pelatihan, atau kelas Pranikah (SPN) Bidang Dakwah Masjid Salman ITB.
                    </p>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 max-w-xl mx-auto pt-2 text-left">
                    <div class="p-5 rounded-2xl bg-gradient-to-br from-teal-50/60 to-emerald-50/40 border border-teal-100 space-y-2">
                        <div class="w-8 h-8 rounded-xl bg-teal-600 text-white flex items-center justify-center text-xs font-bold">
                            ✨
                        </div>
                        <h4 class="font-bold text-gray-900 text-sm">Sekolah Pranikah (SPN)</h4>
                        <p class="text-xs text-gray-600 leading-relaxed">
                            Program persiapan pernikahan komprehensif bersama pakar &amp; ustadz terkemuka.
                        </p>
                        <a href="{{ route('spn.index') }}" class="inline-flex items-center gap-1.5 text-xs font-bold text-teal-700 hover:text-teal-900 pt-1">
                            <span>Informasi &amp; Daftar SPN</span>
                            <span>&rarr;</span>
                        </a>
                    </div>

                    <div class="p-5 rounded-2xl bg-gradient-to-br from-gray-50 to-slate-50 border border-gray-200 space-y-2">
                        <div class="w-8 h-8 rounded-xl bg-gray-700 text-white flex items-center justify-center text-xs font-bold">
                            💬
                        </div>
                        <h4 class="font-bold text-gray-900 text-sm">Bantuan &amp; Konsultasi</h4>
                        <p class="text-xs text-gray-600 leading-relaxed">
                            Punya kendala akun atau pertanyaan program? Hubungi admin melalui menu Feedback.
                        </p>
                        <a href="{{ route('peserta.feedback.create') }}" class="inline-flex items-center gap-1.5 text-xs font-bold text-gray-800 hover:text-emerald-700 pt-1">
                            <span>Kirim Pertanyaan</span>
                            <span>&rarr;</span>
                        </a>
                    </div>
                </div>
            </div>
        @else
            <div class="space-y-6">
                @foreach($registrations as $reg)
                    <div class="bg-white rounded-3xl border border-gray-200/80 overflow-hidden shadow-sm hover:shadow-md transition">
                        
                        <!-- Header Banner on Card -->
                        <div class="px-6 py-4 flex flex-wrap gap-4 justify-between items-center border-b
                            @if($reg->status == 'terverifikasi') bg-emerald-50/70 border-emerald-100
                            @elseif($reg->status == 'ditolak') bg-red-50/70 border-red-100
                            @else bg-amber-50/70 border-amber-100 @endif">
                            
                            <div class="space-y-0.5">
                                <div class="flex items-center gap-2 flex-wrap">
                                    <span class="px-2.5 py-0.5 text-[11px] font-bold uppercase tracking-wider bg-white rounded-full text-gray-600 border border-gray-200">
                                        {{ $reg->activityBatch->activity->title ?? ($reg->activityBatch->activity->name ?? 'Sekolah Pranikah') }}
                                    </span>
                                    <span class="font-mono text-xs font-bold text-teal-800 bg-teal-100/80 px-2 py-0.5 rounded-md border border-teal-200">
                                        #{{ $reg->registration_code }}
                                    </span>
                                </div>
                                <h3 class="text-lg font-bold text-gray-900">
                                    {{ $reg->activityBatch->nama_batch ?? ('Batch ' . ($reg->activityBatch->batch_ke ?? '-')) }}
                                </h3>
                            </div>
                            
                            <div class="text-right">
                                <span class="text-[11px] font-semibold text-gray-500 uppercase tracking-wider block mb-1">Status Verifikasi</span>
                                <span class="px-3.5 py-1 text-xs font-bold rounded-full border shadow-2xs {{ $reg->status_badge }}">
                                    @if($reg->status == 'terverifikasi')
                                        <i class="fas fa-check-circle mr-1 text-emerald-600"></i> Terverifikasi Resmi
                                    @elseif($reg->status == 'ditolak')
                                        <i class="fas fa-times-circle mr-1 text-red-600"></i> Perlu Revisi / Ditolak
                                    @else
                                        <i class="fas fa-clock mr-1 text-amber-600"></i> Menunggu Verifikasi
                                    @endif
                                </span>
                            </div>
                        </div>

                        <div class="p-6 sm:p-8 space-y-6">
                            <!-- Alert for Pending Changes / Notes -->
                            @if(!empty($reg->pending_changes))
                                <div class="p-4 bg-amber-50 border-l-4 border-amber-500 rounded-xl flex items-start gap-3">
                                    <i class="fas fa-info-circle text-amber-600 mt-0.5"></i>
                                    <div>
                                        <h4 class="text-xs font-bold text-amber-900">Menunggu Persetujuan Perubahan Data</h4>
                                        <p class="text-xs text-amber-800 mt-0.5 leading-relaxed">Perubahan paket atau informasi pembayaran yang Anda ajukan sedang dalam proses peninjauan admin.</p>
                                    </div>
                                </div>
                            @endif

                            @if(!empty($reg->catatan_admin))
                                <div class="p-4 bg-gray-50 border border-gray-200 rounded-2xl">
                                    <h4 class="text-xs font-bold text-gray-700 mb-1 flex items-center gap-1.5">
                                        <i class="fas fa-comment-dots text-teal-600"></i>
                                        <span>Catatan dari Admin Pengelola:</span>
                                    </h4>
                                    <p class="text-xs text-gray-700 italic leading-relaxed bg-white p-3 rounded-xl border border-gray-100">
                                        "{{ $reg->catatan_admin }}"
                                    </p>
                                </div>
                            @endif

                            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
                                <!-- Stepper Timeline (7 Cols) -->
                                <div class="lg:col-span-7 space-y-4">
                                    <h4 class="text-xs font-bold text-gray-700 uppercase tracking-wider flex items-center gap-2">
                                        <i class="fas fa-list-check text-teal-600"></i>
                                        <span>Tahapan &amp; Progress Pendaftaran</span>
                                    </h4>

                                    <div class="relative border-l-2 border-teal-100 ml-4 space-y-6 py-1">
                                        <!-- Step 1 -->
                                        <div class="relative pl-6">
                                            <span class="absolute -left-2.5 top-0.5 flex items-center justify-center w-5 h-5 bg-emerald-500 text-white rounded-full text-[10px] ring-4 ring-white shadow-2xs">
                                                <i class="fas fa-check"></i>
                                            </span>
                                            <h5 class="text-xs font-bold text-gray-900">Pendaftaran Berhasil</h5>
                                            <p class="text-[11px] text-gray-500 mt-0.5">Formulir pendaftaran dan bukti awal telah diterima sistem.</p>
                                            <time class="block text-[10px] text-gray-400 mt-1 font-mono">{{ $reg->created_at->format('d M Y, H:i') }} WIB</time>
                                        </div>

                                        <!-- Step 2 -->
                                        <div class="relative pl-6">
                                            <span class="absolute -left-2.5 top-0.5 flex items-center justify-center w-5 h-5 {{ $reg->status != 'pending' ? 'bg-emerald-500 text-white' : 'bg-amber-400 text-amber-950 animate-pulse' }} rounded-full text-[10px] ring-4 ring-white shadow-2xs">
                                                @if($reg->status != 'pending')
                                                    <i class="fas fa-check"></i>
                                                @else
                                                    <i class="fas fa-clock"></i>
                                                @endif
                                            </span>
                                            <h5 class="text-xs font-bold text-gray-900">Verifikasi Admin</h5>
                                            <p class="text-[11px] text-gray-500 mt-0.5">Pemeriksaan bukti transfer, berkas formulir, dan konfirmasi kuota.</p>
                                        </div>

                                        <!-- Step 3 -->
                                        <div class="relative pl-6">
                                            <span class="absolute -left-2.5 top-0.5 flex items-center justify-center w-5 h-5 {{ $reg->status == 'terverifikasi' ? 'bg-emerald-500 text-white' : 'bg-gray-200 text-gray-400' }} rounded-full text-[10px] ring-4 ring-white shadow-2xs">
                                                @if($reg->status == 'terverifikasi')
                                                    <i class="fas fa-check"></i>
                                                @else
                                                    <i class="fas fa-user-check"></i>
                                                @endif
                                            </span>
                                            <h5 class="text-xs font-bold text-gray-900">Peserta Resmi</h5>
                                            @if($reg->status == 'terverifikasi')
                                                <p class="text-[11px] text-emerald-700 font-semibold mt-0.5">Selamat, pendaftaran telah dikonfirmasi dan kuota terkunci ✓</p>
                                            @else
                                                <p class="text-[11px] text-gray-400 mt-0.5">Menunggu konfirmasi verifikasi admin.</p>
                                            @endif
                                        </div>

                                        <!-- Step 4 -->
                                        @php
                                            $batch = $reg->activityBatch;
                                            $batchEnded = $batch && $batch->tanggal_selesai_kegiatan && $batch->tanggal_selesai_kegiatan->isPast();
                                            $isBatchAlumni = auth()->user()->hasRole('alumni')
                                                && $batchEnded
                                                && \App\Models\BatchAlumni::where('user_id', auth()->id())->where('activity_batch_id', $reg->activity_batch_id)->exists();
                                        @endphp
                                        <div class="relative pl-6">
                                            <span class="absolute -left-2.5 top-0.5 flex items-center justify-center w-5 h-5 {{ $isBatchAlumni ? 'bg-emerald-500 text-white' : 'bg-gray-200 text-gray-400' }} rounded-full text-[10px] ring-4 ring-white shadow-2xs">
                                                <i class="fas fa-graduation-cap"></i>
                                            </span>
                                            <h5 class="text-xs font-bold text-gray-900">Kelulusan Alumni</h5>
                                            @if($isBatchAlumni)
                                                <p class="text-[11px] text-emerald-700 font-semibold mt-0.5">Telah resmi menjadi alumni batch ini ✓</p>
                                            @elseif($batch && $batch->tanggal_selesai_kegiatan)
                                                <p class="text-[11px] text-gray-400 mt-0.5">Otomatis aktif setelah kegiatan selesai ({{ $batch->tanggal_selesai_kegiatan->translatedFormat('d M Y') }}).</p>
                                            @else
                                                <p class="text-[11px] text-gray-400 mt-0.5">Otomatis aktif setelah seluruh sesi kegiatan selesai.</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <!-- Payment & Details Card (5 Cols) -->
                                <div class="lg:col-span-5 space-y-4">
                                    <h4 class="text-xs font-bold text-gray-700 uppercase tracking-wider flex items-center gap-2">
                                        <i class="fas fa-receipt text-teal-600"></i>
                                        <span>Rincian Biaya &amp; Paket</span>
                                    </h4>

                                    <div class="bg-gray-50/80 rounded-2xl p-5 border border-gray-200/80 space-y-3">
                                        <div class="flex justify-between items-center pb-2.5 border-b border-gray-200 text-xs">
                                            <span class="text-gray-500">Pilihan Paket</span>
                                            <span class="font-bold text-gray-900">{{ $reg->paket }}</span>
                                        </div>
                                        
                                        <div class="space-y-1.5 text-xs">
                                            <div class="flex justify-between text-gray-600">
                                                <span>Harga Dasar:</span>
                                                <span class="font-medium text-gray-900">Rp {{ number_format($reg->harga_dasar, 0, ',', '.') }}</span>
                                            </div>
                                            @if($reg->potongan_diskon > 0)
                                                <div class="flex justify-between items-start text-emerald-700 font-medium">
                                                    <div>
                                                        <span>Diskon Kategori ({{ $reg->discount_percentage }}%):</span>
                                                        <span class="text-[10px] text-emerald-600 block">({{ $reg->discount_category_label }})</span>
                                                    </div>
                                                    <span class="font-bold">- Rp {{ number_format($reg->potongan_diskon, 0, ',', '.') }}</span>
                                                </div>
                                            @endif
                                            @if($reg->potongan_referal > 0)
                                                <div class="flex justify-between text-teal-700 font-medium">
                                                    <span>Diskon Referral @if($reg->referralCode)({{ $reg->referralCode->code }})@endif:</span>
                                                    <span class="font-bold">- Rp {{ number_format($reg->potongan_referal, 0, ',', '.') }}</span>
                                                </div>
                                            @endif
                                        </div>

                                        <div class="flex justify-between items-baseline pt-3 border-t border-gray-200">
                                            <span class="text-xs font-bold text-gray-700">Total Biaya:</span>
                                            <span class="text-base font-extrabold text-teal-800">
                                                Rp {{ number_format($reg->total_bayar, 0, ',', '.') }}
                                            </span>
                                        </div>
                                    </div>

                                    <div class="grid grid-cols-2 gap-3 pt-1">
                                        <a href="{{ route('peserta.registration.show', $reg->id) }}"
                                            class="inline-flex items-center justify-center gap-1.5 py-2.5 px-4 rounded-xl bg-teal-600 hover:bg-teal-700 text-white font-bold text-xs shadow-sm transition">
                                            <span>Lihat Rincian</span>
                                            <i class="fas fa-arrow-right text-[10px]"></i>
                                        </a>
                                        <a href="{{ route('peserta.registration.edit', $reg->id) }}"
                                            class="inline-flex items-center justify-center gap-1.5 py-2.5 px-4 rounded-xl bg-white border border-gray-300 hover:bg-gray-50 text-gray-700 font-semibold text-xs transition shadow-2xs">
                                            <i class="fas fa-pen text-[10px]"></i>
                                            <span>Edit Data</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                @endforeach
            </div>
        @endif
    </div>

</div>
@endsection
