<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\ActivationController;
use App\Http\Controllers\SitemapController;

/*
|--------------------------------------------------------------------------
| Web Routes (Master)
|--------------------------------------------------------------------------
|
| File utama rute web. Berisi halaman publik utama dan memuat rute modular
| untuk autentikasi, peserta, alumni, SPN, dan administrator.
|
*/

// ==========================================================================
// Public Website Routes
// ==========================================================================

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/programs', [ProgramController::class, 'index'])->name('programs.index');
Route::get('/programs/{slug}', [ProgramController::class, 'show'])->name('programs.show');

Route::get('/activities', [ActivityController::class, 'index'])->name('activities.index');
Route::get('/activities/{activity:slug}', [ActivityController::class, 'show'])->name('activities.show');

Route::get('/services', [ServiceController::class, 'index'])->name('services.index');
Route::get('/services/{slug}', [ServiceController::class, 'show'])->name('services.show');

Route::get('/articles', [ArticleController::class, 'index'])->name('articles.index');
Route::get('/articles/{slug}', [ArticleController::class, 'show'])->name('articles.show');

Route::get('/news', [NewsController::class, 'index'])->name('news.index');
Route::get('/news/{slug}', [NewsController::class, 'show'])->name('news.show');

Route::get('/contact', [HomeController::class, 'contact'])->name('contact');

// SEO
Route::get('/sitemap.xml', [SitemapController::class, 'index'])->name('sitemap.xml');

// ==========================================================================
// Account Activation Routes
// ==========================================================================

Route::get('/activation', [ActivationController::class, 'showEmailForm'])->name('activation.email.form');
Route::post('/activation', [ActivationController::class, 'verifyEmail'])->name('activation.verify.email');
Route::get('/activation/email-sent', [ActivationController::class, 'emailSuccess'])->name('activation.email.success');
Route::get('/activation/{token}', [ActivationController::class, 'showActivationForm'])->name('activation.form');
Route::post('/activation/{token}', [ActivationController::class, 'activate'])->name('activation.activate');
Route::get('/activation/invalid', [ActivationController::class, 'invalid'])->name('activation.invalid');
Route::get('/activation/success', [ActivationController::class, 'success'])->name('activation.success')->withoutMiddleware(['auth']);

// ==========================================================================
// Modular Route Files
// ==========================================================================

require __DIR__ . '/auth.php';
require __DIR__ . '/peserta.php';
require __DIR__ . '/alumni.php';
require __DIR__ . '/spn.php';
require __DIR__ . '/admin.php';
