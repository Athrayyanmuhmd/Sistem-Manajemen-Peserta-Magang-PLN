<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InternController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\DivisionController;
use App\Http\Controllers\UniversityController;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return redirect()->route('pln.dashboard');
});

// Authentication Routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Development only - remove in production
Route::get('/dev-login', [AuthController::class, 'devLogin'])->name('dev-login');

// Protected routes - require authentication
Route::middleware(['dev.auth'])->group(function () {
    // Dashboard Routes
    Route::get('/pln/dashboard', [DashboardController::class, 'index'])->name('pln.dashboard');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Resource routes with basic authentication
    Route::resource('interns', InternController::class);
    Route::resource('departments', DepartmentController::class);
    Route::resource('divisions', DivisionController::class);
    Route::resource('universities', UniversityController::class);
    
    // Additional intern management routes
    Route::post('/interns/{id}/restore', [InternController::class, 'restore'])->name('interns.restore');
    Route::delete('/interns/{id}/force-delete', [InternController::class, 'forceDelete'])->name('interns.force-delete');
    Route::post('/interns/bulk-action', [InternController::class, 'bulkAction'])->name('interns.bulk-action');
    Route::get('/interns/export/{format}', [InternController::class, 'export'])->name('interns.export');
    
    // Analytics Route
    Route::get('/analytics', [DashboardController::class, 'analytics'])->name('analytics.index');
    
    // Export Routes
    Route::get('/export/divisions', [DivisionController::class, 'export'])->name('divisions.export');
    Route::get('/export/universities', [UniversityController::class, 'export'])->name('universities.export');
    Route::get('/export/analytics', [DashboardController::class, 'exportAnalytics'])->name('analytics.export');

    // Live Stats Route
    Route::get('/dashboard/live-stats', [DashboardController::class, 'liveStats'])->name('dashboard.live-stats');
});
