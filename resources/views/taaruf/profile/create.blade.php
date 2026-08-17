@extends('layouts.app')

@section('title', 'Buat Profil Ta\'aruf - Bidang Dakwah Salman ITB')

@section('content')
    <div class="min-h-screen bg-gray-50/70 py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

            <!-- Header Card -->
            <div
                class="bg-gradient-to-br from-slate-900 via-rose-950 to-pink-950 rounded-3xl text-white p-6 sm:p-8 shadow-lg relative overflow-hidden">
                <div
                    class="absolute inset-0 opacity-10 bg-[radial-gradient(#fff_1px,transparent_1px)] [background-size:16px_16px]">
                </div>

                <div class="relative z-10">
                    <nav class="flex items-center gap-2 text-xs text-rose-300/80 mb-3 font-medium">
                        <a href="{{ route('alumni.dashboard') }}" class="hover:text-white transition">Dashboard Alumni</a>
                        <span>/</span>
                        <a href="{{ route('taaruf.index') }}" class="hover:text-white transition">Ta'aruf</a>
                        <span>/</span>
                        <span class="text-white font-semibold">Buat Profil</span>
                    </nav>

                    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                        <div>
                            <div
                                class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-rose-500/20 border border-rose-400/30 text-rose-300 text-xs font-semibold mb-2">
                                <span>📝</span>
                                <span>Pendaftaran Biodata Ta'aruf</span>
                            </div>
                            <h1 class="text-2xl sm:text-3xl font-bold tracking-tight text-white">
                                Lengkapi Profil Ta'aruf Anda
                            </h1>
                            <p class="text-xs sm:text-sm text-slate-300 mt-1">
                                Lengkapi informasi diri dan kriteria pasangan yang Anda harapkan dengan jujur dan amanah.
                            </p>
                        </div>

                        <a href="{{ route('taaruf.index') }}"
                            class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-white/10 hover:bg-white/20 backdrop-blur text-white text-xs font-semibold border border-white/15 transition shadow-xs self-start md:self-auto">
                            &larr; Dashboard Ta'aruf
                        </a>
                    </div>
                </div>
            </div>

            @if (session('error'))
                <div class="bg-red-50 border border-red-200 text-red-800 p-4 rounded-2xl shadow-sm flex items-center justify-between"
                    role="alert">
                    <span class="text-sm font-medium">{{ session('error') }}</span>
                    <button type="button" onclick="this.parentElement.remove()"
                        class="text-red-500 hover:text-red-700">✕</button>
                </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                <!-- Left 2 Columns: Form Fields -->
                <div class="lg:col-span-2">
                    <form action="{{ route('taaruf.profile.store') }}" method="POST" enctype="multipart/form-data"
                        class="space-y-6">
                        @csrf

                        <!-- 1. Informasi Dasar Card -->
                        <div class="bg-white rounded-2xl border border-gray-200/80 shadow-sm p-6 sm:p-7 space-y-4">
                            <h2
                                class="text-sm font-bold text-gray-900 pb-3 border-b border-gray-100 flex items-center gap-2">
                                <span>👤</span>
                                <span>Informasi Dasar Diri</span>
                            </h2>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div>
                                    <label for="gender" class="block text-xs font-bold text-gray-700 mb-1">
                                        Jenis Kelamin <span class="text-rose-500">*</span>
                                    </label>
                                    <select name="gender" id="gender" required
                                        class="w-full px-3.5 py-2.5 text-xs rounded-xl border border-gray-300 focus:ring-2 focus:ring-rose-500 focus:border-rose-500 transition @error('gender') border-red-500 @enderror">
                                        <option value="">-- Pilih Jenis Kelamin --</option>
                                        <option value="male"
                                            {{ old('gender', $prefill['gender'] ?? '') == 'male' ? 'selected' : '' }}>
                                            Laki-laki (Ikhwan)</option>
                                        <option value="female"
                                            {{ old('gender', $prefill['gender'] ?? '') == 'female' ? 'selected' : '' }}>
                                            Perempuan (Akhwat)</option>
                                    </select>
                                    @error('gender')
                                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="nickname" class="block text-xs font-bold text-gray-700 mb-1">
                                        Nama Panggilan <span class="text-rose-500">*</span>
                                    </label>
                                    <input type="text" name="nickname" id="nickname" required
                                        value="{{ old('nickname', $prefill['nickname'] ?? '') }}"
                                        placeholder="Contoh: Fulan"
                                        class="w-full px-3.5 py-2.5 text-xs rounded-xl border border-gray-300 focus:ring-2 focus:ring-rose-500 focus:border-rose-500 transition @error('nickname') border-red-500 @enderror">
                                    @error('nickname')
                                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div>
                                <label for="full_name" class="block text-xs font-bold text-gray-700 mb-1">
                                    Nama Lengkap <span class="text-rose-500">*</span>
                                </label>
                                <input type="text" name="full_name" id="full_name" required
                                    value="{{ old('full_name', $prefill['full_name'] ?? '') }}"
                                    placeholder="Nama lengkap sesuai KTP"
                                    class="w-full px-3.5 py-2.5 text-xs rounded-xl border border-gray-300 focus:ring-2 focus:ring-rose-500 focus:border-rose-500 transition @error('full_name') border-red-500 @enderror">
                                @error('full_name')
                                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div>
                                    <label for="birth_place_date" class="block text-xs font-bold text-gray-700 mb-1">
                                        Tempat &amp; Tanggal Lahir <span class="text-rose-500">*</span>
                                    </label>
                                    <input type="text" name="birth_place_date" id="birth_place_date" required
                                        value="{{ old('birth_place_date') }}"
                                        placeholder="Contoh: Bandung, 15 Januari 1998"
                                        class="w-full px-3.5 py-2.5 text-xs rounded-xl border border-gray-300 focus:ring-2 focus:ring-rose-500 focus:border-rose-500 transition @error('birth_place_date') border-red-500 @enderror">
                                    @error('birth_place_date')
                                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="current_residence" class="block text-xs font-bold text-gray-700 mb-1">
                                        Domisili Saat Ini <span class="text-rose-500">*</span>
                                    </label>
                                    <input type="text" name="current_residence" id="current_residence" required
                                        value="{{ old('current_residence', $prefill['current_residence'] ?? '') }}"
                                        placeholder="Contoh: Coblong, Kota Bandung, Jawa Barat"
                                        class="w-full px-3.5 py-2.5 text-xs rounded-xl border border-gray-300 focus:ring-2 focus:ring-rose-500 focus:border-rose-500 transition @error('current_residence') border-red-500 @enderror">
                                    @error('current_residence')
                                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- 2. Pendidikan & Pekerjaan Card -->
                        <div class="bg-white rounded-2xl border border-gray-200/80 shadow-sm p-6 sm:p-7 space-y-4">
                            <h2
                                class="text-sm font-bold text-gray-900 pb-3 border-b border-gray-100 flex items-center gap-2">
                                <span>🎓</span>
                                <span>Pendidikan &amp; Pekerjaan</span>
                            </h2>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div>
                                    <label for="last_education" class="block text-xs font-bold text-gray-700 mb-1">
                                        Pendidikan Terakhir <span class="text-rose-500">*</span>
                                    </label>
                                    <input type="text" name="last_education" id="last_education" required
                                        value="{{ old('last_education', $prefill['last_education'] ?? '') }}"
                                        placeholder="Contoh: S1 Teknik Elektro ITB"
                                        class="w-full px-3.5 py-2.5 text-xs rounded-xl border border-gray-300 focus:ring-2 focus:ring-rose-500 focus:border-rose-500 transition @error('last_education') border-red-500 @enderror">
                                    @error('last_education')
                                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="occupation" class="block text-xs font-bold text-gray-700 mb-1">
                                        Profesi / Pekerjaan <span class="text-rose-500">*</span>
                                    </label>
                                    <input type="text" name="occupation" id="occupation" required
                                        value="{{ old('occupation', $prefill['occupation'] ?? '') }}"
                                        placeholder="Contoh: Software Engineer / ASN / Wiraswasta"
                                        class="w-full px-3.5 py-2.5 text-xs rounded-xl border border-gray-300 focus:ring-2 focus:ring-rose-500 focus:border-rose-500 transition @error('occupation') border-red-500 @enderror">
                                    @error('occupation')
                                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- 3. Visi & Kriteria Card -->
                        <div class="bg-white rounded-2xl border border-gray-200/80 shadow-sm p-6 sm:p-7 space-y-4">
                            <h2
                                class="text-sm font-bold text-gray-900 pb-3 border-b border-gray-100 flex items-center gap-2">
                                <span>💍</span>
                                <span>Visi, Kriteria &amp; Harapan Pernikahan</span>
                            </h2>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div>
                                    <label for="marriage_target_year" class="block text-xs font-bold text-gray-700 mb-1">
                                        Target Tahun Menikah
                                    </label>
                                    <input type="text" name="marriage_target_year" id="marriage_target_year"
                                        value="{{ old('marriage_target_year') }}"
                                        placeholder="Contoh: 2026 / Insya Allah Segera"
                                        class="w-full px-3.5 py-2.5 text-xs rounded-xl border border-gray-300 focus:ring-2 focus:ring-rose-500 focus:border-rose-500 transition">
                                    @error('marriage_target_year')
                                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="personality" class="block text-xs font-bold text-gray-700 mb-1">
                                        Gambaran Kepribadian
                                    </label>
                                    <input type="text" name="personality" id="personality"
                                        value="{{ old('personality') }}"
                                        placeholder="Contoh: Tenang, pendengar yang baik, suka kerapian"
                                        class="w-full px-3.5 py-2.5 text-xs rounded-xl border border-gray-300 focus:ring-2 focus:ring-rose-500 focus:border-rose-500 transition">
                                    @error('personality')
                                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div>
                                <label for="ideal_partner_criteria" class="block text-xs font-bold text-gray-700 mb-1">
                                    Visi Misi Pernikahan
                                </label>
                                <textarea name="ideal_partner_criteria" id="ideal_partner_criteria" rows="3"
                                    placeholder="Jelaskan visi keluarga yang ingin dibangun (tujuan berumah tangga, pendidikan anak, dll)..."
                                    class="w-full px-3.5 py-2.5 text-xs rounded-xl border border-gray-300 focus:ring-2 focus:ring-rose-500 focus:border-rose-500 transition">{{ old('ideal_partner_criteria') }}</textarea>
                                @error('ideal_partner_criteria')
                                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="visi_misi" class="block text-xs font-bold text-gray-700 mb-1">
                                    Kriteria Pasangan yang Diharapkan
                                </label>
                                <textarea name="visi_misi" id="visi_misi" rows="3"
                                    placeholder="Kriteria agama, akhlak, domisili, atau kriteria lain yang menjadi ikhtiar Anda..."
                                    class="w-full px-3.5 py-2.5 text-xs rounded-xl border border-gray-300 focus:ring-2 focus:ring-rose-500 focus:border-rose-500 transition">{{ old('visi_misi') }}</textarea>
                                @error('visi_misi')
                                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="expectation" class="block text-xs font-bold text-gray-700 mb-1">
                                    Harapan Khusus dalam Rumah Tangga
                                </label>
                                <textarea name="expectation" id="expectation" rows="2"
                                    placeholder="Harapan saling mendukung ibadah, karir, keluarga besar, dll..."
                                    class="w-full px-3.5 py-2.5 text-xs rounded-xl border border-gray-300 focus:ring-2 focus:ring-rose-500 focus:border-rose-500 transition">{{ old('expectation') }}</textarea>
                                @error('expectation')
                                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="kelebihan_kekurangan" class="block text-xs font-bold text-gray-700 mb-1">
                                    Kelebihan &amp; Kekurangan Diri
                                </label>
                                <textarea name="kelebihan_kekurangan" id="kelebihan_kekurangan" rows="2"
                                    placeholder="Tuliskan refleksi kelebihan serta hal yang sedang Anda perbaiki dari diri Anda..."
                                    class="w-full px-3.5 py-2.5 text-xs rounded-xl border border-gray-300 focus:ring-2 focus:ring-rose-500 focus:border-rose-500 transition">{{ old('kelebihan_kekurangan') }}</textarea>
                                @error('kelebihan_kekurangan')
                                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- 4. Media & Dokumen Card -->
                        <div class="bg-white rounded-2xl border border-gray-200/80 shadow-sm p-6 sm:p-7 space-y-4">
                            <h2
                                class="text-sm font-bold text-gray-900 pb-3 border-b border-gray-100 flex items-center gap-2">
                                <span>📸</span>
                                <span>Foto &amp; Informed Consent</span>
                            </h2>

                            <div>
                                <label for="instagram" class="block text-xs font-bold text-gray-700 mb-1">
                                    Akun Instagram (Opsional)
                                </label>
                                <div class="flex rounded-xl shadow-2xs">
                                    <span
                                        class="inline-flex items-center px-3 rounded-l-xl border border-r-0 border-gray-300 bg-gray-50 text-gray-500 text-xs font-semibold">
                                        @
                                    </span>
                                    <input type="text" name="instagram" id="instagram"
                                        value="{{ old('instagram', $prefill['instagram'] ?? '') }}"
                                        placeholder="username_instagram"
                                        class="w-full px-3.5 py-2.5 text-xs rounded-r-xl border border-gray-300 focus:ring-2 focus:ring-rose-500 focus:border-rose-500 transition">
                                </div>
                                @error('instagram')
                                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Photo Upload Dropzone with Alpine -->
                            <div>
                                <label class="block text-xs font-bold text-gray-700 mb-1">
                                    Foto Profil Peserta
                                </label>
                                <div x-data="photoUploader()" x-on:dragover.prevent="dragover = true"
                                    x-on:dragleave.prevent="dragover = false" x-on:drop.prevent="dropHandler($event)"
                                    :class="dragover ? 'border-rose-500 bg-rose-50/30' : 'border-gray-300 bg-gray-50/50'"
                                    class="flex flex-col items-center justify-center p-6 border-2 border-dashed rounded-2xl transition duration-150 text-center">

                                    <div
                                        class="w-10 h-10 rounded-xl bg-white text-rose-500 border border-gray-200 flex items-center justify-center text-lg mb-2 shadow-2xs">
                                        📷
                                    </div>
                                    <div class="text-xs text-gray-600 flex items-center gap-1">
                                        <label for="photo"
                                            class="cursor-pointer font-bold text-rose-600 hover:text-rose-700 hover:underline">
                                            Pilih File Foto
                                            <input id="photo" name="photo" type="file" class="sr-only"
                                                accept="image/jpeg,image/png,image/jpg" x-on:change="handleFileSelect()">
                                        </label>
                                        <span>atau tarik ke area ini</span>
                                    </div>
                                    <p class="text-[11px] text-gray-400 mt-1">Format JPG, JPEG, PNG. Maksimal 2MB.</p>

                                    <div x-show="preview" class="mt-3">
                                        <img class="max-h-40 rounded-xl mx-auto border border-gray-200 shadow-sm"
                                            :src="preview" alt="Preview Foto">
                                        <button type="button" x-on:click="removeFile()"
                                            class="mt-2 text-xs text-red-600 hover:underline font-semibold">
                                            Hapus Foto
                                        </button>
                                    </div>
                                </div>
                                @error('photo')
                                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Informed Consent Document Dropzone -->
                            <div>
                                <label class="block text-xs font-bold text-gray-700 mb-1">
                                    Dokumen Informed Consent <span class="text-rose-500">*</span>
                                </label>
                                <div x-data="documentUploader()" x-on:dragover.prevent="dragover = true"
                                    x-on:dragleave.prevent="dragover = false" x-on:drop.prevent="dropHandler($event)"
                                    :class="dragover ? 'border-rose-500 bg-rose-50/30' : 'border-gray-300 bg-gray-50/50'"
                                    class="flex flex-col items-center justify-center p-6 border-2 border-dashed rounded-2xl transition duration-150 text-center">

                                    <div
                                        class="w-10 h-10 rounded-xl bg-white text-rose-500 border border-gray-200 flex items-center justify-center text-lg mb-2 shadow-2xs">
                                        📄
                                    </div>
                                    <div class="text-xs text-gray-600 flex items-center gap-1">
                                        <label for="informed_consent"
                                            class="cursor-pointer font-bold text-rose-600 hover:text-rose-700 hover:underline">
                                            Unggah Dokumen Consent
                                            <input id="informed_consent" name="informed_consent" type="file" required
                                                class="sr-only" accept="application/pdf,image/jpeg,image/png,image/jpg"
                                                x-on:change="handleFileSelect()">
                                        </label>
                                        <span>atau tarik ke sini</span>
                                    </div>
                                    <p class="text-[11px] text-gray-400 mt-1">
                                        Format PDF/JPG/PNG. Maks 5MB. Unduh template
                                        <a href="https://docs.google.com/document/d/1RcjFahFF3bmEpvDvf2QCZ8QlKi5gteNN/edit?tab=t.0"
                                            target="_blank" class="text-rose-600 font-bold hover:underline">di sini</a>.
                                    </p>

                                    <div x-show="fileName" class="mt-3 w-full max-w-sm">
                                        <div
                                            class="p-2.5 border rounded-xl bg-white flex items-center justify-between text-xs">
                                            <span class="truncate font-semibold text-gray-800" x-text="fileName"></span>
                                            <button type="button" x-on:click="removeFile()"
                                                class="text-xs text-red-600 hover:underline font-bold ml-2">
                                                ✕
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                @error('informed_consent')
                                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Submit Actions -->
                        <div class="flex items-center gap-3 pt-2">
                            <button type="submit"
                                class="inline-flex items-center gap-2 px-6 py-2.5 rounded-xl bg-gradient-to-r from-rose-500 to-pink-500 hover:from-rose-600 hover:to-pink-600 text-white font-semibold text-xs shadow-md shadow-pink-500/20 transition">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                                <span>Simpan &amp; Daftarkan Profil Ta'aruf</span>
                            </button>
                            <a href="{{ route('taaruf.index') }}"
                                class="px-4 py-2.5 rounded-xl border border-gray-300 bg-white hover:bg-gray-50 text-gray-700 text-xs font-semibold transition">
                                Batal
                            </a>
                        </div>
                    </form>
                </div>

                <!-- Right 1 Column: Guidelines Sidebar -->
                <div class="space-y-6">
                    <div class="bg-white rounded-2xl border border-gray-200/80 shadow-sm p-6 space-y-4">
                        <h3 class="text-xs font-bold text-gray-900 pb-3 border-b border-gray-100 flex items-center gap-2">
                            <span>💡</span>
                            <span>Petunjuk &amp; Tips Pengisian</span>
                        </h3>

                        <div
                            class="p-3 bg-rose-50/70 rounded-xl border border-rose-100 text-xs text-rose-900 leading-relaxed">
                            Data yang Anda cantumkan akan ditampilkan di katalog ta'aruf hanya bagi alumni lawan jenis yang
                            berstatus aktif.
                        </div>

                        <ul class="text-xs text-gray-600 space-y-2 leading-relaxed">
                            <li class="flex items-start gap-2">
                                <span class="text-emerald-600 font-bold">✓</span>
                                <span>Isi semua kolom wajib bertanda bintang (<span
                                        class="text-rose-500 font-bold">*</span>) dengan jujur dan akurat.</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <span class="text-emerald-600 font-bold">✓</span>
                                <span>Gunakan foto profil yang santun, sopan, dan berwajah jelas.</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <span class="text-emerald-600 font-bold">✓</span>
                                <span>Pastikan surat persetujuan (informed consent) telah ditandatangani.</span>
                            </li>
                        </ul>
                    </div>

                    <div class="bg-white rounded-2xl border border-gray-200/80 shadow-sm p-6 text-xs text-gray-600">
                        <h4 class="font-bold text-gray-900 mb-2">Bantuan &amp; Konsultasi</h4>
                        <p class="leading-relaxed mb-3">
                            Jika ada kendala dalam proses pengisian biodata, hubungi tim fasilitator:
                        </p>
                        <a href="https://wa.me/6285703952464" target="_blank"
                            class="inline-flex items-center gap-1.5 text-emerald-600 font-bold hover:underline">
                            <span>💬</span>
                            <span>+6285703952464</span>
                        </a>
                    </div>
                </div>

            </div>

        </div>
    </div>

    @push('scripts')
        <script>
            function photoUploader() {
                return {
                    dragover: false,
                    preview: null,
                    handleFileSelect() {
                        const input = document.getElementById('photo');
                        if (input.files && input.files[0]) {
                            const reader = new FileReader();
                            reader.onload = (e) => {
                                this.preview = e.target.result;
                            };
                            reader.readAsDataURL(input.files[0]);
                        }
                    },
                    dropHandler(event) {
                        this.dragover = false;
                        const files = event.dataTransfer.files;
                        if (files.length > 0) {
                            const input = document.getElementById('photo');
                            input.files = files;
                            this.handleFileSelect();
                        }
                    },
                    removeFile() {
                        const input = document.getElementById('photo');
                        input.value = '';
                        this.preview = null;
                    }
                };
            }

            function documentUploader() {
                return {
                    dragover: false,
                    fileName: null,
                    handleFileSelect() {
                        const input = document.getElementById('informed_consent');
                        if (input.files && input.files[0]) {
                            this.fileName = input.files[0].name;
                        }
                    },
                    dropHandler(event) {
                        this.dragover = false;
                        const files = event.dataTransfer.files;
                        if (files.length > 0) {
                            const input = document.getElementById('informed_consent');
                            input.files = files;
                            this.handleFileSelect();
                        }
                    },
                    removeFile() {
                        const input = document.getElementById('informed_consent');
                        input.value = '';
                        this.fileName = null;
                    }
                };
            }
        </script>
    @endpush
@endsection
