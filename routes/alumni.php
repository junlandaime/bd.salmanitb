<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AlumniController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\TaarufController;
use App\Http\Controllers\TaarufQuestionController;
use App\Http\Controllers\FeedbackController;

/*
|--------------------------------------------------------------------------
| Alumni Portal & Ta'aruf Routes
|--------------------------------------------------------------------------
|
| Rute khusus bagi alumni program Bidang Dakwah Masjid Salman ITB,
| mencakup materi kegiatan, penggantian password, feedback, dan fitur Ta'aruf.
|
*/

// ==========================================================================
// Alumni Portal Routes
// ==========================================================================

Route::middleware(['auth', 'verified', 'role:alumni'])->prefix('alumni')->name('alumni.')->group(function () {
    Route::get('/dashboard', [AlumniController::class, 'dashboard'])->name('dashboard');
    Route::get('/batch/{batchId}/materials', [AlumniController::class, 'batchMaterials'])->name('batch.materials');
    Route::get('/batch/{batchId}/material/{materialId}', [AlumniController::class, 'viewMaterial'])->name('material.view');

    Route::get('/password/change', [PasswordController::class, 'showChangeForm'])->name('password.change');
    Route::post('/password/change', [PasswordController::class, 'change'])->name('password.update');

    // Feedback
    Route::get('/feedback', [FeedbackController::class, 'index'])->name('feedback.index');
    Route::get('/feedback/create', [FeedbackController::class, 'create'])->name('feedback.create');
    Route::post('/feedback', [FeedbackController::class, 'store'])->name('feedback.store');
    Route::get('/feedback/{id}', [FeedbackController::class, 'show'])->name('feedback.show');
    Route::post('/feedback/{id}/reply', [FeedbackController::class, 'reply'])->name('feedback.reply');
});

// ==========================================================================
// Taaruf Feature Routes
// ==========================================================================

Route::middleware(['auth', 'verified', 'role:alumni', 'taaruf.eligible'])->prefix('taaruf')->name('taaruf.')->group(function () {
    Route::get('/', [TaarufController::class, 'index'])->name('index');
    Route::get('/terms', [TaarufController::class, 'showTerms'])->name('terms');
    Route::post('/terms/accept', [TaarufController::class, 'acceptTerms'])->name('terms.accept');

    // Profile management
    Route::get('/profile/create', [TaarufController::class, 'createProfile'])->name('profile.create');
    Route::post('/profile', [TaarufController::class, 'storeProfile'])->name('profile.store');
    Route::get('/profile/edit', [TaarufController::class, 'editProfile'])->name('profile.edit');
    Route::put('/profile', [TaarufController::class, 'updateProfile'])->name('profile.update');
    Route::post('/profile/toggle-active', [TaarufController::class, 'toggleActive'])->name('profile.toggle');

    // Questions
    Route::get('/questions', [TaarufController::class, 'showQuestions'])->name('questions');
    Route::post('/questions', [TaarufController::class, 'saveQuestions'])->name('questions.save');

    // Browse profiles
    Route::get('/list', [TaarufController::class, 'showList'])->name('list');
    Route::get('/profile/{id}', [TaarufController::class, 'showProfile'])->name('profile.show');

    // Taaruf Questions (Q&A between users)
    Route::post('/profile/{id}/questions', [TaarufQuestionController::class, 'store'])->name('profile.questions.store');
    Route::get('/my-questions', [TaarufQuestionController::class, 'index'])->name('questions.index');
    Route::post('/questions/{id}/answer', [TaarufQuestionController::class, 'answer'])->name('questions.answer');
    Route::post('/questions/{id}/toggle-public', [TaarufQuestionController::class, 'togglePublic'])->name('questions.toggle-public');
    Route::delete('/questions/{id}', [TaarufQuestionController::class, 'destroy'])->name('questions.destroy');
});
