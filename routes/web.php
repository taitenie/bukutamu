<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\RekomendasiController;
use App\Http\Controllers\BidangController;
use App\Http\Controllers\BukuTamuController;
use App\Http\Controllers\SurveyController;
use App\Http\Controllers\SurveyWelcomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminLoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DashboardHomeController;
use App\Http\Controllers\DataAdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\SurveyResultController;
use App\Http\Controllers\ExportController;
use App\Models\Rekomendasi;
use App\Models\Bidang;

// ========== USER ROUTES ==========

// Home Page
Route::get('/', function () {
    $rekomendasi = Rekomendasi::all();
    $bidang = Bidang::all();
    return view('home', compact('rekomendasi', 'bidang'));
})->name('home');

// Contact Page
Route::get('/contact', function () {
    return view('contact');
})->name('contact');

// Buku Tamu
Route::post('/bukutamu', [BukuTamuController::class, 'store'])->name('bukutamu.store');

// Survey Routes
Route::get('/surveywelcome', [SurveyWelcomeController::class, 'welcome'])->name('survey.welcome');
Route::post('/survey/start', [SurveyWelcomeController::class, 'start'])->name('survey.start');
Route::get('/survey', [SurveyController::class, 'showQuestion'])->name('survey.question');
Route::post('/survey', [SurveyController::class, 'storeAnswer'])->name('survey.answer');
Route::get('/survey/thankyou', function () {
    return view('surveyclosing');
})->name('survey.thankyou');

// ========== FALLBACK LOGIN ROUTE FOR NON-ADMIN ==========
// Prevent "Route [login] not defined" error
Route::get('/login', function () {
    return redirect()->route('admin.login');
})->name('login');

// ========== ADMIN ROUTES ==========

// Admin Login
Route::get('/admin/login', [AdminLoginController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminLoginController::class, 'login'])->name('admin.login.submit');
Route::get('/admin/get-notifications', [AdminController::class, 'getNotifications']);

// Admin Logout
Route::post('/admin/logout', function () {
    Auth::guard('admin')->logout();
    return redirect('/admin/login');
})->name('admin.logout');

// Admin Dashboard (Protected)
Route::middleware('auth')->group(function () {
    Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/dashboardhome', [DashboardHomeController::class, 'index'])->name('admin.dashboardhome');

    // Data Admin CRUD
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::resource('dataadmin', DataAdminController::class);
    });

    // Profile Admin
    Route::get('/admin/profile', [ProfileController::class, 'show'])->name('admin.profile');

    // Buku Tamu Resource
    Route::resource('bukutamu', BukuTamuController::class);
    Route::get('admin/bukutamu/export', [BukuTamuController::class, 'export'])->name('bukutamu.export');


    // Dashboard Filter
    Route::get('/dashboard/filter', [DashboardHomeController::class, 'filter'])->name('admin.dashboardhome.filter');

    // Questions (Survey Questions CRUD)
    Route::get('/admin/question', [QuestionController::class, 'index'])->name('admin.question.index');
    Route::get('/admin/question/create', [QuestionController::class, 'create'])->name('admin.question.create');
    Route::post('/admin/question', [QuestionController::class, 'store'])->name('admin.question.store');
    Route::get('/admin/question/{id}/edit', [QuestionController::class, 'edit'])->name('admin.question.edit');
    Route::put('/admin/question/{id}', [QuestionController::class, 'update'])->name('admin.question.update');
    Route::delete('/admin/question/{id}', [QuestionController::class, 'destroy'])->name('admin.question.destroy');

    // Survey Results
    Route::get('/admin/surveys', [SurveyResultController::class, 'index'])->name('admin.surveys.index');
    Route::get('/admin/surveys/{id}', [SurveyResultController::class, 'show'])->name('admin.surveys.show');

    // Export PDF
    Route::get('/admin/export/pdf', [ExportController::class, 'exportDashboardPDF'])->name('admin.export.pdf');
});

// Admin Create Form
Route::get('admin/create', [AdminController::class, 'create']);
Route::post('admin/store', [AdminController::class, 'store'])->name('admin.store');
