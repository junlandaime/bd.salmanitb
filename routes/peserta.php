<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PesertaController;
use App\Http\Controllers\FeedbackController;
use App\Http\Middleware\EnsureIsPeserta;

/*
|--------------------------------------------------------------------------
| Peserta & Authenticated User Routes
|--------------------------------------------------------------------------
|
| Rute untuk pengguna terdaftar (peserta umum), dashboard switcher,
| pengaturan profil, serta fitur feedback & pendaftaran program.
|
*/

// ==========================================================================
// Dashboard Switcher (Berdasarkan Role User)
// ==========================================================================

Route::get('/dashboard', function () {
    $user = auth()->user();
    if ($user->hasAnyRole(['superAdmin', 'admin', 'admin_spn', 'admin_taaruf'])) {
        return redirect()->route('admin.dashboard');
    } elseif ($user->hasRole('alumni')) {
        return redirect()->route('alumni.dashboard');
    } elseif ($user->hasRole('author')) {
        return redirect()->route('author.dashboard');
    }
    // Semua user tanpa role khusus diarahkan ke dashboard peserta
    return redirect()->route('peserta.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// ==========================================================================
// User Profile Management
// ==========================================================================

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ==========================================================================
// Peserta Dashboard Routes
// ==========================================================================

Route::middleware(['auth', 'verified', EnsureIsPeserta::class])->prefix('peserta')->name('peserta.')->group(function () {
    Route::get('/dashboard', [PesertaController::class, 'dashboard'])->name('dashboard');
    Route::get('/registration/{id}', [PesertaController::class, 'show'])->name('registration.show');
    Route::get('/registration/{id}/edit', [PesertaController::class, 'edit'])->name('registration.edit');
    Route::put('/registration/{id}', [PesertaController::class, 'update'])->name('registration.update');

    // Feedback
    Route::get('/feedback', [FeedbackController::class, 'index'])->name('feedback.index');
    Route::get('/feedback/create', [FeedbackController::class, 'create'])->name('feedback.create');
    Route::post('/feedback', [FeedbackController::class, 'store'])->name('feedback.store');
    Route::get('/feedback/{id}', [FeedbackController::class, 'show'])->name('feedback.show');
    Route::post('/feedback/{id}/reply', [FeedbackController::class, 'reply'])->name('feedback.reply');
});
