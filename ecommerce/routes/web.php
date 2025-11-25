<?php

use Illuminate\Support\Facades\Route;
use App\Models\Menu;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminPasswordResetController;

Route::get('/', function () {
    $menus = Menu::where('visible', true)->orderBy('order')->get();
    return view('pages.landing', compact('menus'));
});

// Admin routes
Route::prefix('admin')->name('admin.')->group(function () {
    // Login routes (only for guests)
    Route::middleware('guest:admin')->group(function () {
        Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('login');
        Route::post('/login', [AdminAuthController::class, 'login'])->name('login.post');

        // Password reset routes
        Route::get('/password/reset', [AdminPasswordResetController::class, 'requestForm'])->name('password.request');
        Route::post('/password/email', [AdminPasswordResetController::class, 'sendResetLink'])->name('password.email');
        Route::get('/password/reset/{token}', [AdminPasswordResetController::class, 'resetForm'])->name('password.reset');
        Route::post('/password/reset', [AdminPasswordResetController::class, 'reset'])->name('password.update');
    });

    // Protected routes (only for authenticated admins)
    Route::middleware('auth:admin')->group(function () {
        Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
        Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');
    });
});