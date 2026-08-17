<nav class="mt-4 px-3 space-y-5 text-sm font-medium">

    <!-- ================= SECTION: UTAMA (Shared) ================= -->
    <div>
        <div class="px-3 py-1">
            <p class="text-[11px] font-bold tracking-wider text-gray-400 uppercase">Utama</p>
        </div>
        <div class="mt-1 space-y-1">
            <a href="{{ route('admin.dashboard') }}"
                class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition {{ request()->routeIs('admin.dashboard') ? 'bg-emerald-50 text-emerald-700 font-semibold' : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' }}">
                <svg class="w-5 h-5 {{ request()->routeIs('admin.dashboard') ? 'text-emerald-600' : 'text-gray-400' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                </svg>
                Dashboard
            </a>
            @hasanyrole('superAdmin|admin')
            <a href="{{ route('admin.statistics') }}"
                class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition {{ request()->routeIs('admin.statistics') ? 'bg-emerald-50 text-emerald-700 font-semibold' : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' }}">
                <svg class="w-5 h-5 {{ request()->routeIs('admin.statistics') ? 'text-emerald-600' : 'text-gray-400' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                </svg>
                Statistik Portal
            </a>
            @endhasanyrole
            <a href="{{ route('admin.feedback.index') }}"
                class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition {{ request()->routeIs('admin.feedback.*') ? 'bg-emerald-50 text-emerald-700 font-semibold' : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' }}">
                <svg class="w-5 h-5 {{ request()->routeIs('admin.feedback.*') ? 'text-emerald-600' : 'text-gray-400' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                </svg>
                <span class="flex-1">Feedback</span>
                @php $openFeedbackCount = \App\Models\Feedback::where('status', 'open')->count(); @endphp
                @if($openFeedbackCount > 0)
                    <span class="px-2 py-0.5 text-[10px] font-bold bg-red-100 text-red-700 rounded-full border border-red-200">{{ $openFeedbackCount }}</span>
                @endif
            </a>
        </div>
    </div>

    <!-- ================= SECTION: SEKOLAH PRANIKAH (SPN) ================= -->
    @hasanyrole('superAdmin|admin|admin_spn')
    <div x-data="{ open: {{ request()->routeIs('admin.spn.*') ? 'true' : 'false' }} }">
        <button @click="open = !open" type="button" class="w-full flex items-center justify-between px-3 py-1.5 rounded-lg text-left hover:bg-amber-50/70 transition group cursor-pointer focus:outline-none">
            <span class="text-[11px] font-bold tracking-wider text-amber-700 uppercase flex items-center gap-1.5 group-hover:text-amber-800">
                <span class="w-2 h-2 rounded-full bg-amber-500"></span>
                Sekolah Pranikah (SPN)
            </span>
            <svg class="w-3.5 h-3.5 text-amber-600 group-hover:text-amber-800 transform transition-transform duration-200" :class="{ 'rotate-180': open }" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
            </svg>
        </button>
        <div x-show="open" class="mt-1 space-y-1 pl-1">
            <a href="{{ route('admin.spn.dashboard') }}"
                class="flex items-center gap-3 px-3 py-2 rounded-xl transition {{ request()->routeIs('admin.spn.dashboard') ? 'bg-amber-50 text-amber-800 font-semibold' : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' }}">
                <svg class="w-4 h-4 {{ request()->routeIs('admin.spn.dashboard') ? 'text-amber-600' : 'text-gray-400' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                </svg>
                Overview SPN
            </a>
            <a href="{{ route('admin.spn.registrants') }}"
                class="flex items-center gap-3 px-3 py-2 rounded-xl transition {{ (request()->routeIs('admin.spn.registrants') || request()->routeIs('admin.spn.show') || request()->routeIs('admin.spn.pendingChanges')) ? 'bg-amber-50 text-amber-800 font-semibold' : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' }}">
                <svg class="w-4 h-4 {{ (request()->routeIs('admin.spn.registrants') || request()->routeIs('admin.spn.show') || request()->routeIs('admin.spn.pendingChanges')) ? 'text-amber-600' : 'text-gray-400' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                </svg>
                Data Pendaftar
            </a>
            <a href="{{ route('admin.spn.pricing.index') }}"
                class="flex items-center gap-3 px-3 py-2 rounded-xl transition {{ request()->routeIs('admin.spn.pricing.*') ? 'bg-amber-50 text-amber-800 font-semibold' : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' }}">
                <svg class="w-4 h-4 {{ request()->routeIs('admin.spn.pricing.*') ? 'text-amber-600' : 'text-gray-400' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                </svg>
                Harga &amp; Diskon
            </a>
            <a href="{{ route('admin.spn.referral.index') }}"
                class="flex items-center gap-3 px-3 py-2 rounded-xl transition {{ request()->routeIs('admin.spn.referral.*') ? 'bg-amber-50 text-amber-800 font-semibold' : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' }}">
                <svg class="w-4 h-4 {{ request()->routeIs('admin.spn.referral.*') ? 'text-amber-600' : 'text-gray-400' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z" />
                </svg>
                Kode Referral
            </a>
        </div>
    </div>
    @endhasanyrole

    <!-- ================= SECTION: LAYANAN TA'ARUF ================= -->
    @hasanyrole('superAdmin|admin|admin_taaruf')
    <div x-data="{ open: {{ (request()->routeIs('admin.taaruf.*')) ? 'true' : 'false' }} }">
        <button @click="open = !open" type="button" class="w-full flex items-center justify-between px-3 py-1.5 rounded-lg text-left hover:bg-pink-50/70 transition group cursor-pointer focus:outline-none">
            <span class="text-[11px] font-bold tracking-wider text-pink-700 uppercase flex items-center gap-1.5 group-hover:text-pink-800">
                <span class="w-2 h-2 rounded-full bg-pink-500"></span>
                Layanan Ta'aruf
            </span>
            <svg class="w-3.5 h-3.5 text-pink-600 group-hover:text-pink-800 transform transition-transform duration-200" :class="{ 'rotate-180': open }" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
            </svg>
        </button>
        <div x-show="open" class="mt-1 space-y-1 pl-1">
            <a href="{{ route('admin.taaruf.index') }}"
                class="flex items-center gap-3 px-3 py-2 rounded-xl transition {{ (request()->routeIs('admin.taaruf.index') || request()->routeIs('admin.taaruf.show') || request()->routeIs('admin.taaruf.edit')) ? 'bg-pink-50 text-pink-700 font-semibold' : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' }}">
                <svg class="w-4 h-4 {{ (request()->routeIs('admin.taaruf.index') || request()->routeIs('admin.taaruf.show') || request()->routeIs('admin.taaruf.edit')) ? 'text-pink-600' : 'text-gray-400' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                </svg>
                Profil Peserta Ta'aruf
            </a>
            <a href="{{ route('admin.taaruf.questions.index') }}"
                class="flex items-center gap-3 px-3 py-2 rounded-xl transition {{ (request()->routeIs('admin.taaruf.questions.*')) ? 'bg-pink-50 text-pink-700 font-semibold' : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' }}">
                <svg class="w-4 h-4 {{ (request()->routeIs('admin.taaruf.questions.*')) ? 'text-pink-600' : 'text-gray-400' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                </svg>
                Moderasi Tanya Jawab
            </a>
            <a href="{{ route('admin.taaruf.statistics') }}"
                class="flex items-center gap-3 px-3 py-2 rounded-xl transition {{ (request()->routeIs('admin.taaruf.statistics')) ? 'bg-pink-50 text-pink-700 font-semibold' : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' }}">
                <svg class="w-4 h-4 {{ (request()->routeIs('admin.taaruf.statistics')) ? 'text-pink-600' : 'text-gray-400' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                </svg>
                Statistik Ta'aruf
            </a>
        </div>
    </div>
    @endhasanyrole

    <!-- ================= SECTION: PROGRAM & KEGIATAN BD ================= -->
    @hasanyrole('superAdmin|admin')
    <div x-data="{ open: {{ (request()->routeIs('admin.programs.*') || request()->routeIs('admin.program-topics.*') || request()->routeIs('admin.program-schedules.*') || request()->routeIs('admin.activities.*') || request()->routeIs('admin.activity-*') || request()->routeIs('admin.batches.*') || request()->routeIs('admin.alumni.materials.import.*')) ? 'true' : 'false' }} }">
        <button @click="open = !open" type="button" class="w-full flex items-center justify-between px-3 py-1.5 rounded-lg text-left hover:bg-gray-100/70 transition group cursor-pointer focus:outline-none">
            <span class="text-[11px] font-bold tracking-wider text-gray-400 uppercase group-hover:text-gray-700">Program &amp; Kegiatan</span>
            <svg class="w-3.5 h-3.5 text-gray-400 group-hover:text-gray-600 transform transition-transform duration-200" :class="{ 'rotate-180': open }" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
            </svg>
        </button>
        <div x-show="open" class="mt-1 space-y-1 pl-1">
            <a href="{{ route('admin.programs.index') }}"
                class="flex items-center gap-3 px-3 py-2 rounded-xl transition {{ (request()->routeIs('admin.programs.*') || request()->routeIs('admin.program-topics.*') || request()->routeIs('admin.program-schedules.*')) ? 'bg-emerald-50 text-emerald-700 font-semibold' : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' }}">
                <svg class="w-4 h-4 {{ (request()->routeIs('admin.programs.*') || request()->routeIs('admin.program-topics.*') || request()->routeIs('admin.program-schedules.*')) ? 'text-emerald-600' : 'text-gray-400' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                </svg>
                Program Bidang Dakwah
            </a>
            <a href="{{ route('admin.activities.index') }}"
                class="flex items-center gap-3 px-3 py-2 rounded-xl transition {{ (request()->routeIs('admin.activities.*') || request()->routeIs('admin.activity-*')) ? 'bg-emerald-50 text-emerald-700 font-semibold' : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' }}">
                <svg class="w-4 h-4 {{ (request()->routeIs('admin.activities.*') || request()->routeIs('admin.activity-*')) ? 'text-emerald-600' : 'text-gray-400' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
                Kegiatan &amp; Kurikulum
            </a>
            <a href="{{ route('admin.batches.index') }}"
                class="flex items-center gap-3 px-3 py-2 rounded-xl transition {{ request()->routeIs('admin.batches.*') ? 'bg-emerald-50 text-emerald-700 font-semibold' : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' }}">
                <svg class="w-4 h-4 {{ request()->routeIs('admin.batches.*') ? 'text-emerald-600' : 'text-gray-400' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                </svg>
                Semua Batch &amp; Materi
            </a>
            <a href="{{ route('admin.alumni.materials.import.form') }}"
                class="flex items-center gap-3 px-3 py-2 rounded-xl transition {{ request()->routeIs('admin.alumni.materials.import.*') ? 'bg-emerald-50 text-emerald-700 font-semibold' : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' }}">
                <svg class="w-4 h-4 {{ request()->routeIs('admin.alumni.materials.import.*') ? 'text-emerald-600' : 'text-gray-400' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                </svg>
                Import Materi (Excel)
            </a>
        </div>
    </div>

    <!-- ================= SECTION: LAYANAN ================= -->
    <div x-data="{ open: {{ (request()->routeIs('admin.services.*')) ? 'true' : 'false' }} }">
        <button @click="open = !open" type="button" class="w-full flex items-center justify-between px-3 py-1.5 rounded-lg text-left hover:bg-gray-100/70 transition group cursor-pointer focus:outline-none">
            <span class="text-[11px] font-bold tracking-wider text-gray-400 uppercase group-hover:text-gray-700">Layanan Dakwah</span>
            <svg class="w-3.5 h-3.5 text-gray-400 group-hover:text-gray-600 transform transition-transform duration-200" :class="{ 'rotate-180': open }" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
            </svg>
        </button>
        <div x-show="open" class="mt-1 space-y-1 pl-1">
            <a href="{{ route('admin.services.index') }}"
                class="flex items-center gap-3 px-3 py-2 rounded-xl transition {{ request()->routeIs('admin.services.*') ? 'bg-emerald-50 text-emerald-700 font-semibold' : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' }}">
                <svg class="w-4 h-4 {{ request()->routeIs('admin.services.*') ? 'text-emerald-600' : 'text-gray-400' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                </svg>
                Daftar Layanan
            </a>
        </div>
    </div>

    <!-- ================= SECTION: KONTEN & PUBLIKASI ================= -->
    <div x-data="{ open: {{ (request()->routeIs('admin.articles.*') || request()->routeIs('admin.article-categories.*') || request()->routeIs('admin.news.*') || request()->routeIs('admin.news-categories.*')) ? 'true' : 'false' }} }">
        <button @click="open = !open" type="button" class="w-full flex items-center justify-between px-3 py-1.5 rounded-lg text-left hover:bg-gray-100/70 transition group cursor-pointer focus:outline-none">
            <span class="text-[11px] font-bold tracking-wider text-gray-400 uppercase group-hover:text-gray-700">Konten &amp; Publikasi</span>
            <svg class="w-3.5 h-3.5 text-gray-400 group-hover:text-gray-600 transform transition-transform duration-200" :class="{ 'rotate-180': open }" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
            </svg>
        </button>
        <div x-show="open" class="mt-1 space-y-1 pl-1">
            <a href="{{ route('admin.articles.index') }}"
                class="flex items-center gap-3 px-3 py-2 rounded-xl transition {{ (request()->routeIs('admin.articles.*') || request()->routeIs('admin.article-categories.*')) ? 'bg-emerald-50 text-emerald-700 font-semibold' : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' }}">
                <svg class="w-4 h-4 {{ (request()->routeIs('admin.articles.*') || request()->routeIs('admin.article-categories.*')) ? 'text-emerald-600' : 'text-gray-400' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9.5a2.5 2.5 0 00-2.5-2.5H15" />
                </svg>
                Artikel
            </a>
            <a href="{{ route('admin.news.index') }}"
                class="flex items-center gap-3 px-3 py-2 rounded-xl transition {{ (request()->routeIs('admin.news.*') || request()->routeIs('admin.news-categories.*')) ? 'bg-emerald-50 text-emerald-700 font-semibold' : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' }}">
                <svg class="w-4 h-4 {{ (request()->routeIs('admin.news.*') || request()->routeIs('admin.news-categories.*')) ? 'text-emerald-600' : 'text-gray-400' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9.5a2.5 2.5 0 00-2.5-2.5H15M12 10V3m0 0l3 3m-3-3L9 6" />
                </svg>
                Berita &amp; Rilis
            </a>
        </div>
    </div>

    <!-- ================= SECTION: DATABASE ALUMNI ================= -->
    <div x-data="{ open: {{ (request()->routeIs('admin.batch-alumni.*') || (request()->routeIs('admin.alumni.*') && !request()->routeIs('admin.alumni.materials.import.*'))) ? 'true' : 'false' }} }">
        <button @click="open = !open" type="button" class="w-full flex items-center justify-between px-3 py-1.5 rounded-lg text-left hover:bg-gray-100/70 transition group cursor-pointer focus:outline-none">
            <span class="text-[11px] font-bold tracking-wider text-gray-400 uppercase group-hover:text-gray-700">Kealumnian</span>
            <svg class="w-3.5 h-3.5 text-gray-400 group-hover:text-gray-600 transform transition-transform duration-200" :class="{ 'rotate-180': open }" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
            </svg>
        </button>
        <div x-show="open" class="mt-1 space-y-1 pl-1">
            <a href="{{ route('admin.batch-alumni.index') }}"
                class="flex items-center gap-3 px-3 py-2 rounded-xl transition {{ request()->routeIs('admin.batch-alumni.*') ? 'bg-emerald-50 text-emerald-700 font-semibold' : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' }}">
                <svg class="w-4 h-4 {{ request()->routeIs('admin.batch-alumni.*') ? 'text-emerald-600' : 'text-gray-400' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
                Database Alumni
            </a>
            <a href="{{ route('admin.alumni.import.form') }}"
                class="flex items-center gap-3 px-3 py-2 rounded-xl transition {{ (request()->routeIs('admin.alumni.import.*') || (request()->routeIs('admin.alumni.*') && !request()->routeIs('admin.alumni.materials.import.*'))) ? 'bg-emerald-50 text-emerald-700 font-semibold' : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' }}">
                <svg class="w-4 h-4 {{ (request()->routeIs('admin.alumni.import.*') || (request()->routeIs('admin.alumni.*') && !request()->routeIs('admin.alumni.materials.import.*'))) ? 'text-emerald-600' : 'text-gray-400' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                </svg>
                Import Data Alumni
            </a>
        </div>
    </div>

    <!-- ================= SECTION: PENGATURAN LANDING PAGE ================= -->
    <div class="pt-2 border-t border-gray-100">
        <a href="{{ route('admin.landing-page.edit') }}"
            class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition {{ request()->routeIs('admin.landing-page.*') ? 'bg-emerald-50 text-emerald-700 font-semibold' : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' }}">
            <svg class="w-5 h-5 {{ request()->routeIs('admin.landing-page.*') ? 'text-emerald-600' : 'text-gray-400' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
            </svg>
            Pengaturan Landing Page
        </a>
    </div>
    @endhasanyrole

    <!-- ================= SECTION: PENGATURAN PENGGUNA (SuperAdmin Only) ================= -->
    @role('superAdmin')
    <div class="pt-2 border-t border-gray-100">
        <a href="{{ route('admin.users.index') }}"
            class="flex items-center justify-between px-3 py-2.5 rounded-xl transition {{ request()->routeIs('admin.users.*') ? 'bg-indigo-50 text-indigo-700 font-semibold' : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' }}">
            <div class="flex items-center gap-3">
                <svg class="w-5 h-5 {{ request()->routeIs('admin.users.*') ? 'text-indigo-600' : 'text-gray-400' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                </svg>
                <span>Kelola Pengguna</span>
            </div>
            <span class="px-1.5 py-0.5 text-[9px] font-extrabold uppercase bg-indigo-100 text-indigo-700 rounded-md">Super</span>
        </a>
    </div>
    @endrole

</nav>
