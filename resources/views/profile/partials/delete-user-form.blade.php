<section class="space-y-6">
    <div class="flex items-center gap-3 pb-4 border-b border-gray-100 mb-6">
        <div class="w-10 h-10 rounded-2xl bg-red-50 text-red-700 flex items-center justify-center text-lg font-bold shadow-2xs">
            <i class="fas fa-exclamation-triangle"></i>
        </div>
        <div>
            <h2 class="text-base font-bold text-gray-900">
                Zona Bahaya: Hapus Akun
            </h2>
            <p class="text-xs text-gray-500 mt-0.5">
                Setelah akun dihapus, seluruh data riwayat dan akses layanan Anda akan dihapus secara permanen.
            </p>
        </div>
    </div>

    <div class="bg-red-50/50 border border-red-200/80 rounded-2xl p-4 sm:p-5 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div class="space-y-1">
            <h4 class="text-xs font-bold text-red-900">Penghapusan Akun Permanen</h4>
            <p class="text-xs text-red-700 leading-relaxed max-w-lg">
                Tindakan ini tidak dapat dibatalkan. Pastikan Anda telah mengunduh data penting sebelum melanjutkan.
            </p>
        </div>

        <button
            type="button"
            x-data=""
            x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
            class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-red-600 hover:bg-red-700 text-white font-bold text-xs shadow-sm transition shrink-0"
        >
            <i class="fas fa-trash-alt text-xs"></i>
            <span>Hapus Akun Saya</span>
        </button>
    </div>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6 sm:p-8 space-y-6">
            @csrf
            @method('delete')

            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-2xl bg-red-100 text-red-600 flex items-center justify-center font-bold text-lg shrink-0">
                    <i class="fas fa-trash-alt"></i>
                </div>
                <div>
                    <h2 class="text-base font-bold text-gray-900">
                        Apakah Anda yakin ingin menghapus akun?
                    </h2>
                    <p class="text-xs text-gray-500 mt-0.5">
                        Masukkan kata sandi Anda untuk mengonfirmasi penghapusan permanen.
                    </p>
                </div>
            </div>

            <div>
                <label for="password" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1.5">
                    Konfirmasi Kata Sandi Anda
                </label>
                <input
                    id="password"
                    name="password"
                    type="password"
                    class="w-full px-4 py-2.5 text-sm border border-gray-300 rounded-xl focus:ring-2 focus:ring-red-500 focus:border-red-500 transition"
                    placeholder="Masukkan kata sandi..."
                />
                @if($errors->userDeletion->get('password'))
                    <p class="text-xs text-red-600 font-medium mt-1">{{ $errors->userDeletion->first('password') }}</p>
                @endif
            </div>

            <div class="flex items-center justify-end gap-3 pt-2">
                <button type="button" x-on:click="$dispatch('close')"
                    class="px-5 py-2.5 rounded-xl border border-gray-300 bg-white text-gray-700 hover:bg-gray-50 font-semibold text-xs transition shadow-2xs">
                    Batal
                </button>
                <button type="submit"
                    class="px-5 py-2.5 rounded-xl bg-red-600 hover:bg-red-700 text-white font-bold text-xs shadow-sm transition">
                    Hapus Akun Secara Permanen
                </button>
            </div>
        </form>
    </x-modal>
</section>
