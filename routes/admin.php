<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Admin\CourseCategoryController;
use App\Http\Controllers\Admin\CourseRegistrationController;
use App\Http\Controllers\Admin\ContentController;
use App\Http\Controllers\Admin\CertificateController;
use App\Http\Controllers\Admin\IdCardController;
use App\Http\Controllers\Admin\PerformanceController;
use App\Http\Controllers\Admin\QuizController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\MarketingController;
use App\Http\Controllers\Admin\ReviewController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Users Management
    Route::resource('users', UserController::class);
    Route::post('/users/{user}/toggle-status', [UserController::class, 'toggleStatus'])->name('users.toggle-status');
    
    // Projects Management
    Route::resource('projects', ProjectController::class);
    Route::post('/projects/{project}/update-status', [ProjectController::class, 'updateStatus'])->name('projects.update-status');
    Route::post('/projects/{project}/review', [ProjectController::class, 'addReview'])->name('projects.review');
    
    // Courses Management
    Route::resource('courses', CourseController::class);
    Route::resource('course-categories', CourseCategoryController::class)
        ->only(['index', 'store', 'update', 'destroy'])
        ->parameters(['course-categories' => 'category']);
    Route::get('/course-registrations', [CourseRegistrationController::class, 'index'])->name('course-registrations.index');
    Route::post('/courses/{course}/publish', [CourseController::class, 'publish'])->name('courses.publish');
    Route::post('/courses/{course}/unpublish', [CourseController::class, 'unpublish'])->name('courses.unpublish');

    Route::get('/performance', [PerformanceController::class, 'index'])->name('performance.index');
    Route::resource('content', ContentController::class)->except(['show']);
    Route::resource('reviews', ReviewController::class)->only(['index', 'update', 'destroy']);
    Route::resource('certificates', CertificateController::class)->only(['index', 'store', 'destroy']);
    Route::resource('id-cards', IdCardController::class)
        ->only(['index', 'store', 'update', 'destroy'])
        ->parameters(['id-cards' => 'idCard']);
    
    // Quizzes Management
    Route::resource('quizzes', QuizController::class);
    Route::get('/quizzes/{quiz}/questions', [QuizController::class, 'questions'])->name('quizzes.questions');
    Route::post('/quizzes/{quiz}/questions', [QuizController::class, 'storeQuestion'])->name('quizzes.questions.store');
    
    // Blog Management
    Route::resource('blog', BlogController::class);
    Route::post('/blog/{post}/publish', [BlogController::class, 'publish'])->name('blog.publish');
    
    // Reports
    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
    Route::get('/reports/revenue', [ReportController::class, 'revenue'])->name('reports.revenue');
    Route::get('/reports/users', [ReportController::class, 'users'])->name('reports.users');
    
    // Marketing
    Route::get('/marketing', [MarketingController::class, 'index'])->name('marketing.index');
    Route::post('/marketing/send-email', [MarketingController::class, 'sendEmail'])->name('marketing.send-email');
    Route::post('/marketing/send-sms', [MarketingController::class, 'sendSms'])->name('marketing.send-sms');
    Route::post('/marketing/bulk-email', [MarketingController::class, 'bulkEmail'])->name('marketing.bulk-email');
    Route::post('/marketing/bulk-sms', [MarketingController::class, 'bulkSms'])->name('marketing.bulk-sms');
});
