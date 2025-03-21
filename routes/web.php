<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\AlumniController;
use App\Http\Controllers\TaarufController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\SitemapController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\ActivationController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\TaarufQuestionController;
use App\Http\Controllers\Admin\ActivityFaqController;
use App\Http\Controllers\Admin\TaarufAdminController;
use App\Http\Controllers\Admin\AlumniImportController;
use App\Http\Controllers\Admin\ProgramTopicController;
use App\Http\Controllers\Admin\ActivityBatchController;
use App\Http\Controllers\ActivityRegistrationController;
use App\Http\Controllers\Admin\ActivityGalleryController;
use App\Http\Controllers\Admin\ProgramScheduleController;
use App\Http\Controllers\Admin\ActivityHighlightController;
use App\Http\Controllers\Admin\ActivityTestimonialController;
use App\Http\Controllers\Admin\TaarufQuestionAdminController;
use App\Http\Controllers\Admin\ActivityLearningPathController;
use App\Http\Controllers\Admin\ProgramController as AdminProgramController;
use App\Http\Controllers\Admin\ServiceController as AdminServiceController;
use App\Http\Controllers\Admin\ActivityController as AdminActivityController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;


Route::get('/', [HomeController::class, 'index'])->name('home');
// Front-end routes
Route::get('/programs', [ProgramController::class, 'index'])->name('programs.index');
Route::get('/programs/{slug}', [ProgramController::class, 'show'])->name('programs.show');

Route::get('/activities', [ActivityController::class, 'index'])->name('activities.index');
Route::get('/activities/{activity:slug}', [ActivityController::class, 'show'])->name('activities.show');

// Route::get('/activities/{activity:slug}/register/{batch}', [ActivityRegistrationController::class, 'create'])->name('activities.register');
// Route::post('/activities/{activity:slug}/register/{batch}', [ActivityRegistrationController::class, 'store'])->name('activities.register.store');

Route::get('/services', [ServiceController::class, 'index'])->name('services.index');
Route::get('/services/{slug}', [ServiceController::class, 'show'])->name('services.show');


Route::get('/articles', [ArticleController::class, 'index'])->name('articles.index');
Route::get('/articles/{slug}', [ArticleController::class, 'show'])->name('articles.show');

Route::get('/news', [NewsController::class, 'index'])->name('news.index');
Route::get('/news/{slug}', [NewsController::class, 'show'])->name('news.show');


Route::get('/contact', [HomeController::class, 'contact'])->name('contact');

// SEO Routes
Route::get('/sitemap.xml', [SitemapController::class, 'index'])->name('sitemap.xml');

Route::get('/login/admin', function () {
    return view('auth.login', ['role' => 'admin']);
})->name('login.admin');

Route::get('/login/alumni', function () {
    return view('auth.login', ['role' => 'alumni']);
})->name('login.alumni');

// Account Activation Routes
Route::get('/activation', [ActivationController::class, 'showEmailForm'])->name('activation.email.form');
Route::post('/activation', [ActivationController::class, 'verifyEmail'])->name('activation.verify.email');
Route::get('/activation/email-sent', [ActivationController::class, 'emailSuccess'])->name('activation.email.success');
Route::get('/activation/{token}', [ActivationController::class, 'showActivationForm'])->name('activation.form');
Route::post('/activation/{token}', [ActivationController::class, 'activate'])->name('activation.activate');
Route::get('/activation/invalid', [ActivationController::class, 'invalid'])->name('activation.invalid');
Route::get('/activation/success', [ActivationController::class, 'success'])->name('activation.success')->withoutMiddleware(['auth']);;

// Alumni Portal Routes
Route::middleware(['auth', 'verified', 'role:alumni'])->prefix('alumni')->name('alumni.')->group(function () {
    Route::get('/dashboard', [AlumniController::class, 'dashboard'])->name('dashboard');
    Route::get('/batch/{batchId}/materials', [AlumniController::class, 'batchMaterials'])->name('batch.materials');
    Route::get('/batch/{batchId}/material/{materialId}', [AlumniController::class, 'viewMaterial'])->name('material.view');

    Route::get('/password/change', [PasswordController::class, 'showChangeForm'])->name('password.change');
    Route::post('/password/change', [PasswordController::class, 'change'])->name('password.update');
});
// Password Change Routes

// Taaruf Feature Routes
Route::middleware(['auth', 'verified', 'role:alumni'])->prefix('taaruf')->name('taaruf.')->group(function () {
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

    // Questions routes
    Route::post('/profile/{id}/questions', [TaarufQuestionController::class, 'store'])->name('profile.questions.store');
    Route::get('/my-questions', [TaarufQuestionController::class, 'index'])->name('questions.index');
    Route::post('/questions/{id}/answer', [TaarufQuestionController::class, 'answer'])->name('questions.answer');
    Route::post('/questions/{id}/toggle-public', [TaarufQuestionController::class, 'togglePublic'])->name('questions.toggle-public');
    Route::delete('/questions/{id}', [TaarufQuestionController::class, 'destroy'])->name('questions.destroy');
});

// Admin routes
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');

    // Programs Management
    Route::resource('programs', AdminProgramController::class);
    Route::resource('program-topics', ProgramTopicController::class)->except(['index', 'show']);
    Route::resource('program-schedules', ProgramScheduleController::class)->except(['index', 'show']);

    // Activities Management
    Route::resource('activities', AdminActivityController::class);

    // Activity Batches Management
    Route::get('/batches', [ActivityBatchController::class, 'allBatches'])->name('batches.index');
    Route::get('/activities/{activity}/batches', [ActivityBatchController::class, 'index'])->name('activities.batches.index');
    // Route::resource('activities.batches', ActivityBatchController::class)->except(['show']);
    Route::get('/activities/{activity}/batch/create', [ActivityBatchController::class, 'create'])->name('activities.batches.create');
    Route::post('/activities/{activity}/batch', [ActivityBatchController::class, 'store'])->name('activities.batches.store');
    Route::get('/activities/{activity}/batch/{batch}/edit', [ActivityBatchController::class, 'edit'])->name('activities.batches.edit');
    Route::put('/activities/{activity}/batch/{batch}', [ActivityBatchController::class, 'update'])->name('activities.batches.update');
    Route::delete('/activities/{activity}/batch/{batch}', [ActivityBatchController::class, 'destroy'])->name('activities.batches.destroy');

    // Landing Page Management
    Route::get('/landing-page/edit', [LandingPageController::class, 'edit'])->name('landing-page.edit');
    Route::put('/landing-page/update', [LandingPageController::class, 'update'])->name('landing-page.update');

    // Batch Materials Management
    Route::get('/batches/{batch}/materials', [\App\Http\Controllers\Admin\BatchMaterialController::class, 'index'])->name('batches.materials.index');
    Route::get('/batches/{batch}/materials/create', [\App\Http\Controllers\Admin\BatchMaterialController::class, 'create'])->name('batches.materials.create');
    Route::post('/batches/{batch}/materials', [\App\Http\Controllers\Admin\BatchMaterialController::class, 'store'])->name('batches.materials.store');
    Route::get('/batches/{batch}/materials/{material}', [\App\Http\Controllers\Admin\BatchMaterialController::class, 'show'])->name('batches.materials.show');
    Route::get('/batches/{batch}/materials/{material}/edit', [\App\Http\Controllers\Admin\BatchMaterialController::class, 'edit'])->name('batches.materials.edit');
    Route::put('/batches/{batch}/materials/{material}', [\App\Http\Controllers\Admin\BatchMaterialController::class, 'update'])->name('batches.materials.update');
    Route::delete('/batches/{batch}/materials/{material}', [\App\Http\Controllers\Admin\BatchMaterialController::class, 'destroy'])->name('batches.materials.destroy');
    Route::post('/batches/{batch}/materials/reorder', [\App\Http\Controllers\Admin\BatchMaterialController::class, 'reorder'])->name('batches.materials.reorder');



    // Activity Sections Management
    Route::resource('activity-learning-paths', ActivityLearningPathController::class)->except(['index', 'show']);
    Route::resource('activity-highlights', ActivityHighlightController::class)->except(['index', 'show']);
    Route::resource('activity-testimonials', ActivityTestimonialController::class)->except(['index', 'show']);
    Route::resource('activity-gallery', ActivityGalleryController::class)->except(['index', 'show']);
    Route::resource('activity-faqs', ActivityFaqController::class)->except(['index', 'show']);

    // Services Management
    Route::resource('services', AdminServiceController::class)->except(['show']);

    // Article Management
    Route::resource('articles', \App\Http\Controllers\Admin\ArticleController::class)->except(['show']);
    Route::resource('article-categories', \App\Http\Controllers\Admin\ArticleCategoryController::class)->except(['show']);

    // News Management
    Route::resource('news', \App\Http\Controllers\Admin\NewsController::class)->except(['show']);
    Route::resource('news-categories', \App\Http\Controllers\Admin\NewsCategoryController::class)->except(['show']);

    // Taaruf Management
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


    // Alumni Import Management
    Route::get('/alumni/import', [AlumniImportController::class, 'showImportForm'])->name('alumni.import.form');
    Route::post('/alumni/import', [AlumniImportController::class, 'importAlumni'])->name('alumni.import');
    Route::get('/alumni/materials/import', [AlumniImportController::class, 'showMaterialImportForm'])->name('alumni.materials.import.form');
    Route::post('/alumni/materials/import', [AlumniImportController::class, 'importMaterials'])->name('alumni.materials.import');

    // Batch Alumni Management
    Route::resource('batch-alumni', \App\Http\Controllers\Admin\BatchAlumniController::class);

    // User Web Management
    Route::resource('users', UserController::class);
});


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
