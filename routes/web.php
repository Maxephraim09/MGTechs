<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PublicContentController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\Admin\SettingController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// ============================================
// PUBLIC ROUTES
// ============================================
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/services', [HomeController::class, 'services'])->name('services');
Route::get('/portfolio', [HomeController::class, 'portfolio'])->name('portfolio');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
Route::post('/contact', [HomeController::class, 'submitContact'])->name('contact.submit');
Route::get('/content', [PublicContentController::class, 'index'])->name('content.index');
Route::get('/content/{content}', [PublicContentController::class, 'show'])->name('content.show');
Route::get('/content/{content}/download', [PublicContentController::class, 'download'])->name('content.download');
Route::get('/reviews', [ReviewController::class, 'index'])->name('reviews.index');
Route::post('/reviews', [ReviewController::class, 'store'])->name('reviews.store');

// Blog Routes
Route::get('/blog', [HomeController::class, 'blog'])->name('blog.index');
Route::get('/blog/{slug}', [HomeController::class, 'blogShow'])->name('blog.show');

// Course Routes (Public)
Route::get('/courses', [HomeController::class, 'courses'])->name('courses.index');
Route::get('/courses/{slug}', [HomeController::class, 'courseShow'])->name('courses.show');

// ============================================
// AUTHENTICATED ROUTES
// ============================================
Route::middleware(['auth'])->group(function () {
    
    // Dashboard - Redirect based on role
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Role-specific dashboards
    Route::get('/dashboard/admin', [DashboardController::class, 'admin'])->middleware('admin')->name('dashboard.admin');
    Route::get('/dashboard/client', [DashboardController::class, 'client'])->middleware('client')->name('dashboard.client');
    Route::get('/dashboard/student', [DashboardController::class, 'student'])->middleware('student')->name('dashboard.student');
    
    // Profile Routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ============================================
// ADMIN ROUTES
// ============================================
Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/settings', [SettingController::class, 'index'])->name('admin.settings');
    Route::post('/settings/update', [SettingController::class, 'update'])->name('admin.settings.update');
    Route::post('/settings/cache/clear', [SettingController::class, 'clearCache'])->name('admin.cache.clear');
});

// ============================================
// INCLUDE ROUTE FILES
// ============================================
require __DIR__.'/auth.php';
require __DIR__.'/admin.php';
require __DIR__.'/client.php';
require __DIR__.'/student.php';
