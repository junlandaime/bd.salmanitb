<?php

use Illuminate\Support\Facades\Route;

// Admin Controllers
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\GlobalStatisticsController;
use App\Http\Controllers\Admin\ProgramController as AdminProgramController;
use App\Http\Controllers\Admin\ProgramTopicController;
use App\Http\Controllers\Admin\ProgramScheduleController;
use App\Http\Controllers\Admin\ActivityController as AdminActivityController;
use App\Http\Controllers\Admin\ActivityBatchController;
use App\Http\Controllers\Admin\BatchMaterialController;
use App\Http\Controllers\Admin\BatchAlumniController;
use App\Http\Controllers\Admin\AlumniImportController;
use App\Http\Controllers\Admin\ActivityLearningPathController;
use App\Http\Controllers\Admin\ActivityHighlightController;
use App\Http\Controllers\Admin\ActivityTestimonialController;
use App\Http\Controllers\Admin\ActivityGalleryController;
use App\Http\Controllers\Admin\ActivityFaqController;
use App\Http\Controllers\Admin\ServiceController as AdminServiceController;
use App\Http\Controllers\Admin\ArticleController as AdminArticleController;
use App\Http\Controllers\Admin\ArticleCategoryController;
use App\Http\Controllers\Admin\NewsController as AdminNewsController;
use App\Http\Controllers\Admin\NewsCategoryController;
use App\Http\Controllers\Admin\TaarufAdminController;
use App\Http\Controllers\Admin\TaarufQuestionAdminController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\FeedbackAdminController;
use App\Http\Controllers\Admin\SpnAdminController;
use App\Http\Controllers\Admin\SpnReferralCodeController;
use App\Http\Controllers\Admin\SpnPricingController;
use App\Http\Controllers\LandingPageController;

// Author Controllers
use App\Http\Controllers\Author\DashboardController as AuthorDashboardController;
use App\Http\Controllers\Author\ArticleController as AuthorArticleController;
use App\Http\Controllers\Author\NewsController as AuthorNewsController;

/*
|--------------------------------------------------------------------------
| Admin & Author Panel Routes (RBAC Protected)
|--------------------------------------------------------------------------
|
| Rute untuk administrator dengan pembagian hak akses granular (RBAC):
| - superAdmin   : Hak akses penuh ke seluruh modul & manajemen user
| - admin        : Koordinator umum seluruh kegiatan dakwah
| - admin_spn    : Khusus pendaftaran & administrasi SPN
| - admin_taaruf : Khusus moderasi & verifikasi data Ta'aruf
| - author       : Penulis artikel & berita dakwah
|
*/

// ==========================================================================
// Author Routes
// ==========================================================================

Route::middleware(['auth', 'role:superAdmin|admin|author'])->prefix('author')->name('author.')->group(function () {
    Route::get('/dashboard', AuthorDashboardController::class)->name('dashboard');
    Route::resource('articles', AuthorArticleController::class)->except(['show']);
    Route::resource('news', AuthorNewsController::class)->except(['show']);
});

// ==========================================================================
// Master Admin Routes (Base Guard for all Admin Roles)
// ==========================================================================

Route::middleware(['auth', 'role:superAdmin|admin|admin_spn|admin_taaruf'])->prefix('admin')->name('admin.')->group(function () {

    // ----------------------------------------------------------------------
    // 1. Shared / Common Admin Routes
    // ----------------------------------------------------------------------
    Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');

    // Feedback Management (Shared)
    Route::get('/feedback', [FeedbackAdminController::class, 'index'])->name('feedback.index');
    Route::get('/feedback/{id}', [FeedbackAdminController::class, 'show'])->name('feedback.show');
    Route::post('/feedback/{id}/reply', [FeedbackAdminController::class, 'reply'])->name('feedback.reply');
    Route::post('/feedback/{id}/close', [FeedbackAdminController::class, 'close'])->name('feedback.close');
    Route::post('/feedback/{id}/reopen', [FeedbackAdminController::class, 'reopen'])->name('feedback.reopen');
    Route::delete('/feedback/{id}', [FeedbackAdminController::class, 'destroy'])->name('feedback.destroy');

    // ----------------------------------------------------------------------
    // 2. Global Statistics & Reports (superAdmin, admin)
    // ----------------------------------------------------------------------
    Route::middleware('role:superAdmin|admin')->group(function () {
        Route::get('/statistics', [GlobalStatisticsController::class, 'index'])->name('statistics');
    });

    // ----------------------------------------------------------------------
    // 3. SPN Management (superAdmin, admin, admin_spn)
    // ----------------------------------------------------------------------
    Route::middleware('role:superAdmin|admin|admin_spn')->prefix('spn')->name('spn.')->group(function () {
        Route::get('/', [SpnAdminController::class, 'dashboard'])->name('dashboard');
        Route::get('/pendaftar', [SpnAdminController::class, 'registrants'])->name('registrants');
        Route::get('/pendaftar/{id}', [SpnAdminController::class, 'show'])->name('show');
        Route::post('/pendaftar/{id}/verify', [SpnAdminController::class, 'verify'])->name('verify');
        Route::post('/pendaftar/{id}/reject', [SpnAdminController::class, 'reject'])->name('reject');
        Route::delete('/pendaftar/{id}', [SpnAdminController::class, 'destroy'])->name('destroy');
        Route::get('/export', [SpnAdminController::class, 'export'])->name('export');
        Route::get('/pending-changes', [SpnAdminController::class, 'pendingChanges'])->name('pendingChanges');
        Route::post('/pending-changes/{id}/approve', [SpnAdminController::class, 'approveChange'])->name('approveChange');
        Route::post('/pending-changes/{id}/reject', [SpnAdminController::class, 'rejectChange'])->name('rejectChange');

        // Referral Code CRUD
        Route::resource('referral', SpnReferralCodeController::class)->except(['show']);

        // Pricing & Discount Management
        Route::get('/pricing', [SpnPricingController::class, 'index'])->name('pricing.index');
        Route::post('/pricing/package', [SpnPricingController::class, 'storePackage'])->name('pricing.storePackage');
        Route::put('/pricing/package/{id}', [SpnPricingController::class, 'updatePackage'])->name('pricing.updatePackage');
        Route::delete('/pricing/package/{id}', [SpnPricingController::class, 'destroyPackage'])->name('pricing.destroyPackage');
        Route::post('/pricing/discount', [SpnPricingController::class, 'storeDiscount'])->name('pricing.storeDiscount');
        Route::put('/pricing/discount/{id}', [SpnPricingController::class, 'updateDiscount'])->name('pricing.updateDiscount');
        Route::delete('/pricing/discount/{id}', [SpnPricingController::class, 'destroyDiscount'])->name('pricing.destroyDiscount');
    });

    // ----------------------------------------------------------------------
    // 4. Ta'aruf Management (superAdmin, admin, admin_taaruf)
    // ----------------------------------------------------------------------
    Route::middleware('role:superAdmin|admin|admin_taaruf')->group(function () {
        Route::get('/taaruf', [TaarufAdminController::class, 'index'])->name('taaruf.index');
        Route::get('/taaruf/statistics', [TaarufAdminController::class, 'statistics'])->name('taaruf.statistics');
        Route::get('/taaruf/{id}', [TaarufAdminController::class, 'show'])->name('taaruf.show');
        Route::get('/taaruf/{id}/edit', [TaarufAdminController::class, 'edit'])->name('taaruf.edit');
        Route::put('/taaruf/{id}', [TaarufAdminController::class, 'update'])->name('taaruf.update');
        Route::delete('/taaruf/{id}', [TaarufAdminController::class, 'destroy'])->name('taaruf.destroy');
        Route::patch('/taaruf/{id}/toggle-active', [TaarufAdminController::class, 'toggleActive'])->name('taaruf.toggle-active');

        // Taaruf Questions Management
        Route::get('/taaruf/q/questions', [TaarufQuestionAdminController::class, 'index'])->name('taaruf.questions.index');
        Route::get('/taaruf/questions/{id}', [TaarufQuestionAdminController::class, 'show'])->name('taaruf.questions.show');
        Route::delete('/taaruf/questions/{id}', [TaarufQuestionAdminController::class, 'destroy'])->name('taaruf.questions.destroy');
    });

    // ----------------------------------------------------------------------
    // 5. Programs, Activities, Batches, Materials & Services (superAdmin, admin)
    // ----------------------------------------------------------------------
    Route::middleware('role:superAdmin|admin')->group(function () {
        // Programs Management
        Route::resource('programs', AdminProgramController::class);
        Route::resource('program-topics', ProgramTopicController::class)->except(['index', 'show']);
        Route::resource('program-schedules', ProgramScheduleController::class)->except(['index', 'show']);

        // Activities Management
        Route::resource('activities', AdminActivityController::class);

        // Activity Batches Management
        Route::get('/batches', [ActivityBatchController::class, 'allBatches'])->name('batches.index');
        Route::get('/activities/{activity}/batches', [ActivityBatchController::class, 'index'])->name('activities.batches.index');
        Route::get('/activities/{activity}/batch/create', [ActivityBatchController::class, 'create'])->name('activities.batches.create');
        Route::post('/activities/{activity}/batch', [ActivityBatchController::class, 'store'])->name('activities.batches.store');
        Route::get('/activities/{activity}/batch/{batch}/edit', [ActivityBatchController::class, 'edit'])->name('activities.batches.edit');
        Route::put('/activities/{activity}/batch/{batch}', [ActivityBatchController::class, 'update'])->name('activities.batches.update');
        Route::delete('/activities/{activity}/batch/{batch}', [ActivityBatchController::class, 'destroy'])->name('activities.batches.destroy');

        // Landing Page Management
        Route::get('/landing-page/edit', [LandingPageController::class, 'edit'])->name('landing-page.edit');
        Route::put('/landing-page/update', [LandingPageController::class, 'update'])->name('landing-page.update');

        // Batch Materials Management
        Route::get('/batches/{batch}/materials', [BatchMaterialController::class, 'index'])->name('batches.materials.index');
        Route::get('/batches/{batch}/materials/create', [BatchMaterialController::class, 'create'])->name('batches.materials.create');
        Route::post('/batches/{batch}/materials', [BatchMaterialController::class, 'store'])->name('batches.materials.store');
        Route::get('/batches/{batch}/materials/{material}', [BatchMaterialController::class, 'show'])->name('batches.materials.show');
        Route::get('/batches/{batch}/materials/{material}/edit', [BatchMaterialController::class, 'edit'])->name('batches.materials.edit');
        Route::put('/batches/{batch}/materials/{material}', [BatchMaterialController::class, 'update'])->name('batches.materials.update');
        Route::delete('/batches/{batch}/materials/{material}', [BatchMaterialController::class, 'destroy'])->name('batches.materials.destroy');
        Route::post('/batches/{batch}/materials/reorder', [BatchMaterialController::class, 'reorder'])->name('batches.materials.reorder');

        // Activity Sections Management
        Route::resource('activity-learning-paths', ActivityLearningPathController::class)->except(['index', 'show']);
        Route::resource('activity-highlights', ActivityHighlightController::class)->except(['index', 'show']);
        Route::resource('activity-testimonials', ActivityTestimonialController::class)->except(['index', 'show']);
        Route::resource('activity-gallery', ActivityGalleryController::class)->except(['index', 'show']);
        Route::resource('activity-faqs', ActivityFaqController::class)->except(['index', 'show']);

        // Services Management
        Route::resource('services', AdminServiceController::class)->except(['show']);

        // Article Management
        Route::resource('articles', AdminArticleController::class)->except(['show']);
        Route::resource('article-categories', ArticleCategoryController::class)->except(['show']);

        // News Management
        Route::resource('news', AdminNewsController::class)->except(['show']);
        Route::resource('news-categories', NewsCategoryController::class)->except(['show']);

        // Alumni Import & Batch Alumni
        Route::get('/alumni/import', [AlumniImportController::class, 'showImportForm'])->name('alumni.import.form');
        Route::post('/alumni/import', [AlumniImportController::class, 'importAlumni'])->name('alumni.import');
        Route::get('/alumni/materials/import', [AlumniImportController::class, 'showMaterialImportForm'])->name('alumni.materials.import.form');
        Route::post('/alumni/materials/import', [AlumniImportController::class, 'importMaterials'])->name('alumni.materials.import');
        Route::get('/batch-alumni/multi-batch', [BatchAlumniController::class, 'multiBatch'])->name('batch-alumni.multi-batch');
        Route::resource('batch-alumni', BatchAlumniController::class);
    });

    // ----------------------------------------------------------------------
    // 6. User & Role Management (Exclusive to superAdmin)
    // ----------------------------------------------------------------------
    Route::middleware('role:superAdmin')->group(function () {
        Route::resource('users', UserController::class);
    });

});
