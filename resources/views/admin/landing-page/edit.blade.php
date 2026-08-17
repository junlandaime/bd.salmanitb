@extends('admin.layouts.app')
@section('title', 'Pengaturan Landing Page - Admin Panel')

@section('content')
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8 max-w-5xl">
        
        <!-- Header -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Pengaturan Landing Page</h1>
                <p class="text-sm text-gray-500 mt-1">Sesuaikan teks banner hero, statistik, profil tentang kami, kontak, dan SEO website.</p>
            </div>
            <a href="{{ url('/') }}" target="_blank"
                class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl border border-gray-300 bg-white text-gray-700 font-semibold text-sm hover:bg-gray-50 shadow-sm transition">
                <span>Lihat Website &rarr;</span>
            </a>
        </div>

        @if (session('success'))
            <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 px-5 py-4 rounded-2xl mb-6 flex items-center justify-between shadow-sm" role="alert">
                <span class="text-sm font-medium">{{ session('success') }}</span>
                <button type="button" onclick="this.parentElement.remove()" class="text-emerald-500 hover:text-emerald-700">✕</button>
            </div>
        @endif

        <form action="{{ route('admin.landing-page.update') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
            @csrf
            @method('PUT')

            <!-- Hero Section Card -->
            <div class="bg-white rounded-2xl border border-gray-200/80 shadow-sm p-6 sm:p-8 space-y-6">
                <div class="flex items-center gap-2.5 pb-4 border-b border-gray-100">
                    <span class="w-8 h-8 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center font-bold text-sm">🌟</span>
                    <div>
                        <h2 class="text-base font-bold text-gray-900">Bagian Hero Banner</h2>
                        <p class="text-xs text-gray-500">Teks pembuka dan gambar utama halaman beranda.</p>
                    </div>
                </div>

                <div>
                    <label for="hero_title" class="block text-xs font-semibold text-gray-700 mb-1">Judul Hero (Hero Title)</label>
                    <input type="text" id="hero_title" name="hero_title"
                        value="{{ old('hero_title', $landingPage->hero_title) }}"
                        class="w-full px-3.5 py-2.5 text-sm border border-gray-300 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition">
                    @error('hero_title')
                        <p class="mt-1 text-xs text-red-600 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="hero_subtitle" class="block text-xs font-semibold text-gray-700 mb-1">Sub-judul Hero (Hero Subtitle)</label>
                    <textarea id="hero_subtitle" name="hero_subtitle" rows="3"
                        class="w-full px-3.5 py-2.5 text-sm border border-gray-300 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition">{{ old('hero_subtitle', $landingPage->hero_subtitle) }}</textarea>
                    @error('hero_subtitle')
                        <p class="mt-1 text-xs text-red-600 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="hero_image" class="block text-xs font-semibold text-gray-700 mb-1">Gambar Hero Banner</label>
                    @if ($landingPage->hero_image)
                        <div class="mb-3">
                            <img src="{{ Storage::url($landingPage->hero_image) }}" alt="Hero Image"
                                class="h-32 w-auto object-cover rounded-xl border border-gray-200">
                        </div>
                    @endif
                    <input type="file" id="hero_image" name="hero_image"
                        class="w-full text-xs text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100">
                </div>
            </div>

            <!-- Statistics Card -->
            <div class="bg-white rounded-2xl border border-gray-200/80 shadow-sm p-6 sm:p-8 space-y-6">
                <div class="flex items-center gap-2.5 pb-4 border-b border-gray-100">
                    <span class="w-8 h-8 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center font-bold text-sm">📊</span>
                    <div>
                        <h2 class="text-base font-bold text-gray-900">Statistik Capaian Dakwah</h2>
                        <p class="text-xs text-gray-500">Angka pencapaian dan label statistik di landing page.</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                    <div class="p-4 bg-gray-50 rounded-xl space-y-3">
                        <label class="block text-xs font-bold text-gray-700 uppercase">Statistik 1</label>
                        <input type="text" id="stats1" name="stats1" placeholder="Label, misal: Alumni"
                            value="{{ old('stats1', $landingPage->stats1) }}"
                            class="w-full px-3 py-2 text-xs border border-gray-300 rounded-lg bg-white">
                        <input type="number" id="stats_1" name="stats_1" placeholder="Angka, misal: 15000"
                            value="{{ old('stats_1', $landingPage->stats_1) }}"
                            class="w-full px-3 py-2 text-xs border border-gray-300 rounded-lg bg-white font-bold">
                    </div>

                    <div class="p-4 bg-gray-50 rounded-xl space-y-3">
                        <label class="block text-xs font-bold text-gray-700 uppercase">Statistik 2</label>
                        <input type="text" id="stats2" name="stats2" placeholder="Label, misal: Kegiatan"
                            value="{{ old('stats2', $landingPage->stats2) }}"
                            class="w-full px-3 py-2 text-xs border border-gray-300 rounded-lg bg-white">
                        <input type="number" id="stats_2" name="stats_2" placeholder="Angka, misal: 120"
                            value="{{ old('stats_2', $landingPage->stats_2) }}"
                            class="w-full px-3 py-2 text-xs border border-gray-300 rounded-lg bg-white font-bold">
                    </div>

                    <div class="p-4 bg-gray-50 rounded-xl space-y-3">
                        <label class="block text-xs font-bold text-gray-700 uppercase">Statistik 3</label>
                        <input type="text" id="stats3" name="stats3" placeholder="Label, misal: Mitra"
                            value="{{ old('stats3', $landingPage->stats3) }}"
                            class="w-full px-3 py-2 text-xs border border-gray-300 rounded-lg bg-white">
                        <input type="number" id="stats_3" name="stats_3" placeholder="Angka, misal: 45"
                            value="{{ old('stats_3', $landingPage->stats_3) }}"
                            class="w-full px-3 py-2 text-xs border border-gray-300 rounded-lg bg-white font-bold">
                    </div>

                    <div class="p-4 bg-gray-50 rounded-xl space-y-3">
                        <label class="block text-xs font-bold text-gray-700 uppercase">Statistik 4</label>
                        <input type="text" id="stats4" name="stats4" placeholder="Label, misal: Relawan"
                            value="{{ old('stats4', $landingPage->stats4) }}"
                            class="w-full px-3 py-2 text-xs border border-gray-300 rounded-lg bg-white">
                        <input type="number" id="stats_4" name="stats_4" placeholder="Angka, misal: 350"
                            value="{{ old('stats_4', $landingPage->stats_4) }}"
                            class="w-full px-3 py-2 text-xs border border-gray-300 rounded-lg bg-white font-bold">
                    </div>
                </div>
            </div>

            <!-- Contact & Social Media Card -->
            <div class="bg-white rounded-2xl border border-gray-200/80 shadow-sm p-6 sm:p-8 space-y-6">
                <div class="flex items-center gap-2.5 pb-4 border-b border-gray-100">
                    <span class="w-8 h-8 rounded-xl bg-purple-50 text-purple-600 flex items-center justify-center font-bold text-sm">📞</span>
                    <div>
                        <h2 class="text-base font-bold text-gray-900">Kontak &amp; Media Sosial</h2>
                        <p class="text-xs text-gray-500">Informasi alamat, nomor telepon, email, dan akun resmi.</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div class="sm:col-span-2">
                        <label for="contact_address" class="block text-xs font-semibold text-gray-700 mb-1">Alamat Kantor</label>
                        <textarea id="contact_address" name="contact_address" rows="2"
                            class="w-full px-3.5 py-2.5 text-sm border border-gray-300 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition">{{ old('contact_address', $landingPage->contact_address ?? '') }}</textarea>
                    </div>

                    <div>
                        <label for="contact_phone" class="block text-xs font-semibold text-gray-700 mb-1">Nomor Telepon</label>
                        <input type="tel" id="contact_phone" name="contact_phone"
                            value="{{ old('contact_phone', $landingPage->contact_phone ?? '') }}"
                            class="w-full px-3.5 py-2.5 text-sm border border-gray-300 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition">
                    </div>

                    <div>
                        <label for="contact_whatsapp" class="block text-xs font-semibold text-gray-700 mb-1">Nomor WhatsApp Resmi</label>
                        <input type="tel" id="contact_whatsapp" name="contact_whatsapp"
                            value="{{ old('contact_whatsapp', $landingPage->contact_whatsapp ?? '') }}"
                            class="w-full px-3.5 py-2.5 text-sm border border-gray-300 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition">
                    </div>

                    <div>
                        <label for="contact_email" class="block text-xs font-semibold text-gray-700 mb-1">Email Resmi</label>
                        <input type="email" id="contact_email" name="contact_email"
                            value="{{ old('contact_email', $landingPage->contact_email ?? '') }}"
                            class="w-full px-3.5 py-2.5 text-sm border border-gray-300 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition">
                    </div>

                    <div>
                        <label for="social_instagram" class="block text-xs font-semibold text-gray-700 mb-1">Instagram URL</label>
                        <input type="url" id="social_instagram" name="social_instagram"
                            value="{{ old('social_instagram', $landingPage->social_instagram ?? '') }}"
                            class="w-full px-3.5 py-2.5 text-sm border border-gray-300 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition">
                    </div>

                    <div>
                        <label for="social_youtube" class="block text-xs font-semibold text-gray-700 mb-1">YouTube URL</label>
                        <input type="url" id="social_youtube" name="social_youtube"
                            value="{{ old('social_youtube', $landingPage->social_youtube ?? '') }}"
                            class="w-full px-3.5 py-2.5 text-sm border border-gray-300 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition">
                    </div>

                    <div>
                        <label for="social_facebook" class="block text-xs font-semibold text-gray-700 mb-1">Facebook URL</label>
                        <input type="url" id="social_facebook" name="social_facebook"
                            value="{{ old('social_facebook', $landingPage->social_facebook ?? '') }}"
                            class="w-full px-3.5 py-2.5 text-sm border border-gray-300 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition">
                    </div>
                </div>
            </div>

            <!-- SEO Settings Card -->
            <div class="bg-white rounded-2xl border border-gray-200/80 shadow-sm p-6 sm:p-8 space-y-6">
                <div class="flex items-center gap-2.5 pb-4 border-b border-gray-100">
                    <span class="w-8 h-8 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center font-bold text-sm">🔍</span>
                    <div>
                        <h2 class="text-base font-bold text-gray-900">SEO &amp; Meta Tags</h2>
                        <p class="text-xs text-gray-500">Pengaturan metadata untuk mesin pencari Google.</p>
                    </div>
                </div>

                <div>
                    <label for="meta_title" class="block text-xs font-semibold text-gray-700 mb-1">Meta Title</label>
                    <input type="text" id="meta_title" name="meta_title"
                        value="{{ old('meta_title', $landingPage->meta_title ?? '') }}"
                        class="w-full px-3.5 py-2.5 text-sm border border-gray-300 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition">
                </div>

                <div>
                    <label for="meta_description" class="block text-xs font-semibold text-gray-700 mb-1">Meta Description</label>
                    <textarea id="meta_description" name="meta_description" rows="3"
                        class="w-full px-3.5 py-2.5 text-sm border border-gray-300 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition">{{ old('meta_description', $landingPage->meta_description ?? '') }}</textarea>
                </div>
            </div>

            <div class="flex items-center justify-end gap-3">
                <button type="submit"
                    class="px-8 py-3 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-semibold text-sm shadow-sm transition">
                    Simpan Pengaturan Landing Page
                </button>
            </div>
        </form>
    </div>
@endsection
