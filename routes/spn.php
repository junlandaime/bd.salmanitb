<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SpnController;
use App\Http\Controllers\SpnRegistrationController;

/*
|--------------------------------------------------------------------------
| SPN (Sekolah Pranikah) Routes
|--------------------------------------------------------------------------
|
| Rute untuk halaman informasi publik SPN dan alur wizard multi-step
| pendaftaran Sekolah Pranikah Masjid Salman ITB.
|
*/

Route::prefix('spn')->name('spn.')->group(function () {
    // Public Information Pages
    Route::get('/', [SpnController::class, 'index'])->name('index');
    Route::get('/kurikulum', [SpnController::class, 'kurikulum'])->name('kurikulum');
    Route::get('/jadwal', [SpnController::class, 'jadwal'])->name('jadwal');
    Route::get('/pemateri', [SpnController::class, 'pemateri'])->name('pemateri');
    Route::get('/harga', [SpnController::class, 'harga'])->name('harga');
    Route::get('/fasilitas', [SpnController::class, 'fasilitas'])->name('fasilitas');
    Route::get('/faq', [SpnController::class, 'faq'])->name('faq');

    // Registration Wizard
    Route::prefix('daftar')->name('daftar.')->controller(SpnRegistrationController::class)->group(function () {
        Route::get('/langkah-1', 'step1')->name('step1');
        Route::post('/langkah-1', 'storeStep1')->name('store-step1');

        Route::middleware('spn.step')->group(function () {
            Route::get('/langkah-2', 'step2')->name('step2');
            Route::post('/langkah-2', 'storeStep2')->name('store-step2');

            Route::get('/langkah-3', 'step3')->name('step3');
            Route::post('/langkah-3', 'storeStep3')->name('store-step3');

            Route::get('/langkah-4', 'step4')->name('step4');
            Route::post('/validate-referral', 'validateReferral')->name('validate-referral');
            Route::post('/langkah-4', 'storeStep4')->name('store-step4');

            Route::get('/langkah-5', 'step5')->name('step5');
            Route::post('/langkah-5', 'storeStep5')->name('store-step5');
        });

        Route::get('/berhasil/{code}', 'step6')->name('step6');
    });
});
