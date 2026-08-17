<footer class="relative bg-slate-950 text-slate-300 overflow-hidden border-t border-slate-900">
    <!-- Decorative subtle ambient glow -->
    <div aria-hidden="true" class="absolute -top-32 left-1/4 h-80 w-80 rounded-full bg-emerald-600/10 blur-[100px] pointer-events-none"></div>
    <div aria-hidden="true" class="absolute -bottom-32 right-1/4 h-80 w-80 rounded-full bg-teal-500/10 blur-[100px] pointer-events-none"></div>

    <div class="relative max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:py-16 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 lg:gap-10">
            
            <!-- Col 1: About & Logo -->
            <div class="space-y-4">
                <div class="flex items-center">
                    <a href="{{ route('home') }}" class="group">
                        <x-application-logo-full
                            class="block h-14 w-auto fill-current text-white transition-transform group-hover:scale-105" />
                    </a>
                </div>
                <p class="text-slate-400 text-xs leading-relaxed">
                    Bidang Dakwah YPM Salman ITB berkomitmen mengembangkan nilai-nilai Islam yang rahmatan lil 'alamin melalui pembinaan, kelas pranikah, dan dakwah inspiratif.
                </p>

                <!-- Social Links -->
                <div class="flex items-center space-x-2 pt-2">
                    @if ($footerLandingPage->social_instagram ?? false)
                        <a href="{{ $footerLandingPage->social_instagram }}" target="_blank"
                            class="inline-flex items-center justify-center w-8 h-8 rounded-xl bg-white/5 hover:bg-rose-600 text-slate-300 hover:text-white border border-white/10 transition-all hover:scale-105"
                            title="Instagram">
                            <span class="sr-only">Instagram</span>
                            <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24">
                                <path fill-rule="evenodd"
                                    d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z"
                                    clip-rule="evenodd" />
                            </svg>
                        </a>
                    @endif
                    @if ($footerLandingPage->social_youtube ?? false)
                        <a href="{{ $footerLandingPage->social_youtube }}" target="_blank"
                            class="inline-flex items-center justify-center w-8 h-8 rounded-xl bg-white/5 hover:bg-red-600 text-slate-300 hover:text-white border border-white/10 transition-all hover:scale-105"
                            title="YouTube">
                            <span class="sr-only">YouTube</span>
                            <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24">
                                <path fill-rule="evenodd"
                                    d="M19.812 5.418c.861.23 1.538.907 1.768 1.768C21.998 8.746 22 12 22 12s0 3.255-.418 4.814a2.504 2.504 0 0 1-1.768 1.768c-1.56.419-7.814.419-7.814.419s-6.255 0-7.814-.419a2.505 2.505 0 0 1-1.768-1.768C2 15.255 2 12 2 12s0-3.255.417-4.814a2.507 2.507 0 0 1 1.768-1.768C5.744 5 11.998 5 11.998 5s6.255 0 7.814.418ZM15.194 12 10 15V9l5.194 3Z"
                                    clip-rule="evenodd" />
                            </svg>
                        </a>
                    @endif
                    @if ($footerLandingPage->social_facebook ?? false)
                        <a href="{{ $footerLandingPage->social_facebook }}" target="_blank"
                            class="inline-flex items-center justify-center w-8 h-8 rounded-xl bg-white/5 hover:bg-blue-600 text-slate-300 hover:text-white border border-white/10 transition-all hover:scale-105"
                            title="Facebook">
                            <span class="sr-only">Facebook</span>
                            <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24">
                                <path fill-rule="evenodd"
                                    d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"
                                    clip-rule="evenodd" />
                            </svg>
                        </a>
                    @endif
                </div>
            </div>

            <!-- Col 2: Program & Layanan -->
            <div class="space-y-3">
                <h3 class="text-white font-bold text-xs uppercase tracking-wider flex items-center gap-2">
                    <span class="h-1 w-4 bg-emerald-500 rounded-full"></span>
                    <span>Program &amp; Layanan</span>
                </h3>
                <ul class="space-y-2 text-xs">
                    <li>
                        <a href="{{ route('spn.index') }}" class="text-slate-400 hover:text-amber-400 transition flex items-center gap-1.5 font-medium">
                            <span class="text-amber-400">✨</span>
                            <span>Sekolah Pranikah (SPN)</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('taaruf.index') }}" class="text-slate-400 hover:text-rose-400 transition flex items-center gap-1.5 font-medium">
                            <span class="text-rose-400">💍</span>
                            <span>Ta'aruf Alumni Salman</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('programs.index') }}" class="text-slate-400 hover:text-emerald-400 transition">
                            Semua Program Dakwah
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('activities.index') }}" class="text-slate-400 hover:text-emerald-400 transition">
                            Jadwal Kegiatan &amp; Kelas
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('articles.index') }}" class="text-slate-400 hover:text-emerald-400 transition">
                            Artikel &amp; Tadabbur
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Col 3: Akun & Informasi -->
            <div class="space-y-3">
                <h3 class="text-white font-bold text-xs uppercase tracking-wider flex items-center gap-2">
                    <span class="h-1 w-4 bg-emerald-500 rounded-full"></span>
                    <span>Akses Cepat</span>
                </h3>
                <ul class="space-y-2 text-xs">
                    <li>
                        <a href="{{ route('home') }}" class="text-slate-400 hover:text-emerald-400 transition">
                            Beranda
                        </a>
                    </li>
                    @auth
                        @if (auth()->user()->hasRole('admin'))
                            <li>
                                <a href="{{ route('admin.dashboard') }}" class="text-slate-400 hover:text-emerald-400 transition">
                                    Panel Admin
                                </a>
                            </li>
                        @endif
                        <li>
                            <a href="{{ route('alumni.dashboard') }}" class="text-slate-400 hover:text-emerald-400 transition">
                                Dashboard Alumni
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('profile.edit') }}" class="text-slate-400 hover:text-emerald-400 transition">
                                Pengaturan Akun
                            </a>
                        </li>
                        <li>
                            <a href="{{ auth()->user()->hasRole('alumni') ? route('alumni.feedback.create') : route('peserta.feedback.create') }}" class="text-slate-400 hover:text-emerald-400 transition flex items-center gap-1.5">
                                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" /></svg>
                                Kirim Feedback
                            </a>
                        </li>
                    @else
                        <li>
                            <a href="{{ route('login') }}" class="text-slate-400 hover:text-emerald-400 transition">
                                Masuk / Login
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('activation.email.form') }}" class="text-slate-400 hover:text-emerald-400 transition">
                                Aktivasi Akun Alumni
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('login') }}" class="text-slate-400 hover:text-emerald-400 transition flex items-center gap-1.5">
                                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" /></svg>
                                Kirim Feedback
                            </a>
                        </li>
                    @endauth
                    <li>
                        <a href="{{ route('contact') }}" class="text-slate-400 hover:text-emerald-400 transition">
                            Hubungi Panitia
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Col 4: Kontak & Operasional -->
            <div class="space-y-3">
                <h3 class="text-white font-bold text-xs uppercase tracking-wider flex items-center gap-2">
                    <span class="h-1 w-4 bg-emerald-500 rounded-full"></span>
                    <span>Sekretariat</span>
                </h3>
                <ul class="space-y-2.5 text-xs text-slate-400">
                    <li class="flex items-start gap-2">
                        <span class="text-emerald-400">📍</span>
                        <span>Jl. Ganesa No.7, Lb. Siliwangi, Coblong, Kota Bandung</span>
                    </li>
                    @if ($footerLandingPage->contact_whatsapp ?? false)
                        <li class="flex items-center gap-2">
                            <span class="text-emerald-400">💬</span>
                            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $footerLandingPage->contact_whatsapp) }}"
                                target="_blank" class="hover:text-emerald-400 transition">
                                {{ $footerLandingPage->contact_whatsapp }}
                            </a>
                        </li>
                    @endif
                    @if ($footerLandingPage->contact_email ?? false)
                        <li class="flex items-center gap-2">
                            <span class="text-emerald-400">✉️</span>
                            <a href="mailto:{{ $footerLandingPage->contact_email }}" class="hover:text-emerald-400 transition">
                                {{ $footerLandingPage->contact_email }}
                            </a>
                        </li>
                    @endif
                </ul>

                <div class="p-3 rounded-xl bg-white/5 border border-white/10 text-[11px] space-y-1">
                    <p class="font-bold text-emerald-400">Jam Operasional:</p>
                    <p class="text-slate-300">Senin – Jumat: 08.00 – 16.00 WIB</p>
                    <p class="text-slate-300">Sabtu: 09.00 – 13.00 WIB</p>
                </div>
            </div>

        </div>

        <!-- Bottom Copyright -->
        <div class="mt-12 pt-6 border-t border-slate-900 flex flex-col sm:flex-row justify-between items-center gap-4 text-xs text-slate-500">
            <p>
                &copy; {{ date('Y') }} <span class="text-emerald-400 font-semibold">Bidang Dakwah YPM Salman ITB</span>. All rights reserved.
            </p>
            <div class="flex items-center gap-4">
                <a href="{{ route('home') }}" class="hover:text-slate-400 transition">Beranda</a>
                <span>•</span>
                <a href="{{ route('contact') }}" class="hover:text-slate-400 transition">Kontak</a>
            </div>
        </div>
    </div>
</footer>
