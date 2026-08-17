<section>
    <div class="flex items-center gap-3 pb-4 border-b border-gray-100 mb-6">
        <div class="w-10 h-10 rounded-2xl bg-amber-50 text-amber-700 flex items-center justify-center text-lg font-bold shadow-2xs">
            <i class="fas fa-key"></i>
        </div>
        <div>
            <h2 class="text-base font-bold text-gray-900">
                Ganti Kata Sandi (Password)
            </h2>
            <p class="text-xs text-gray-500 mt-0.5">
                Pastikan akun Anda menggunakan kata sandi yang aman dan tidak mudah ditebak.
            </p>
        </div>
    </div>

    <form method="post" action="{{ route('password.update') }}" class="space-y-5">
        @csrf
        @method('put')

        <!-- Current Password -->
        <div x-data="{ show: false }">
            <label for="update_password_current_password" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1.5">
                Kata Sandi Saat Ini <span class="text-red-500">*</span>
            </label>
            <div class="relative">
                <input id="update_password_current_password" name="current_password" :type="show ? 'text' : 'password'"
                    class="w-full pl-4 pr-10 py-2.5 text-sm border border-gray-300 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition"
                    autocomplete="current-password" placeholder="Masukkan kata sandi lama..." />
                <button type="button" @click="show = !show" class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-gray-400 hover:text-gray-600">
                    <i :class="show ? 'fas fa-eye-slash' : 'fas fa-eye'" class="text-xs"></i>
                </button>
            </div>
            @if($errors->updatePassword->get('current_password'))
                <p class="text-xs text-red-600 font-medium mt-1">{{ $errors->updatePassword->first('current_password') }}</p>
            @endif
        </div>

        <!-- New Password -->
        <div x-data="{ show: false }">
            <label for="update_password_password" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1.5">
                Kata Sandi Baru <span class="text-red-500">*</span>
            </label>
            <div class="relative">
                <input id="update_password_password" name="password" :type="show ? 'text' : 'password'"
                    class="w-full pl-4 pr-10 py-2.5 text-sm border border-gray-300 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition"
                    autocomplete="new-password" placeholder="Minimal 8 karakter..." />
                <button type="button" @click="show = !show" class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-gray-400 hover:text-gray-600">
                    <i :class="show ? 'fas fa-eye-slash' : 'fas fa-eye'" class="text-xs"></i>
                </button>
            </div>
            @if($errors->updatePassword->get('password'))
                <p class="text-xs text-red-600 font-medium mt-1">{{ $errors->updatePassword->first('password') }}</p>
            @endif
        </div>

        <!-- Confirm Password -->
        <div x-data="{ show: false }">
            <label for="update_password_password_confirmation" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1.5">
                Konfirmasi Kata Sandi Baru <span class="text-red-500">*</span>
            </label>
            <div class="relative">
                <input id="update_password_password_confirmation" name="password_confirmation" :type="show ? 'text' : 'password'"
                    class="w-full pl-4 pr-10 py-2.5 text-sm border border-gray-300 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition"
                    autocomplete="new-password" placeholder="Ulangi kata sandi baru..." />
                <button type="button" @click="show = !show" class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-gray-400 hover:text-gray-600">
                    <i :class="show ? 'fas fa-eye-slash' : 'fas fa-eye'" class="text-xs"></i>
                </button>
            </div>
            @if($errors->updatePassword->get('password_confirmation'))
                <p class="text-xs text-red-600 font-medium mt-1">{{ $errors->updatePassword->first('password_confirmation') }}</p>
            @endif
        </div>

        <div class="flex items-center gap-4 pt-2">
            <button type="submit"
                class="inline-flex items-center gap-2 px-6 py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs shadow-sm transition">
                <i class="fas fa-lock text-xs"></i>
                <span>Perbarui Kata Sandi</span>
            </button>

            @if (session('status') === 'password-updated')
                <span
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 3000)"
                    class="text-xs font-bold text-emerald-700 bg-emerald-50 px-3 py-1 rounded-lg border border-emerald-200"
                >
                    ✓ Kata sandi berhasil diubah.
                </span>
            @endif
        </div>
    </form>
</section>
