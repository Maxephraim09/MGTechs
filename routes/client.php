<?php

use App\Http\Controllers\Client\DashboardController;
use App\Http\Controllers\Client\ProjectController;
use App\Http\Controllers\Client\FeedbackController;
use App\Http\Controllers\Client\ProfileController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'client'])->prefix('client')->name('client.')->group(function () {
    
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Projects
    Route::get('/projects', [ProjectController::class, 'index'])->name('projects.index');
    Route::get('/projects/request', [ProjectController::class, 'requestNewProject'])->name('projects.request');
    Route::post('/projects/request', [ProjectController::class, 'storeRequest'])->name('projects.request.store');
    Route::get('/projects/{project}', [ProjectController::class, 'show'])->name('projects.show');
    Route::post('/projects/{project}/feedback', [FeedbackController::class, 'store'])->name('feedback.store');
    Route::post('/projects/{project}/feedback', [FeedbackController::class, 'store'])->name('projects.feedback');
    Route::post('/projects/{project}/rate', [ProjectController::class, 'rateCompany'])->name('projects.rate');
    Route::post('/projects/{project}/upload', [ProjectController::class, 'upload'])->name('projects.upload');
    Route::get('/projects/{project}/download/{file}', [ProjectController::class, 'download'])->name('projects.download');
    
    // Feedback
    Route::get('/feedback', [FeedbackController::class, 'index'])->name('feedback.index');
    
    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
});
