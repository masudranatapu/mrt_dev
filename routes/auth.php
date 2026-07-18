<?php

use App\Http\Controllers\Auth\AdminAuthController;
use App\Http\Controllers\Backend\AdminDashboardController;
use Illuminate\Support\Facades\Route;

// admin auth
Route::group(['as' => 'admin.', 'prefix' => 'admin'], function () {
    // login register
    Route::get('login', [AdminAuthController::class, 'loginView'])->name('login');
    Route::post('login', [AdminAuthController::class, 'login'])->name('login.info');
    // forgot password
    Route::get('forgot/password', [AdminAuthController::class, 'forgotPasswordView'])->name('forgot.password.view');
    Route::post('forgot/password', [AdminAuthController::class, 'forgotPassword'])->name('forgot.password');
    Route::get('reset/password', [AdminAuthController::class, 'resetPasswordView'])->name('reset.password.view');
    Route::post('reset/password', [AdminAuthController::class, 'resetPassword'])->name('reset.password');
    // admin auth info
    Route::middleware(['auth.admin'])->group(function () {
        Route::middleware(['permission.list', "access.permission"])->group(function () {
            // profile info
            Route::group(['as' => 'profile.', 'prefix' => 'profile'], function () {
                Route::get('info', [AdminDashboardController::class, 'profile'])->name('index');
                Route::get('edit', [AdminDashboardController::class, 'profileEdit'])->name('edit');
                Route::post('update', [AdminDashboardController::class, 'profileUpdate'])->name('update');
                Route::get('check/user', [AdminDashboardController::class, 'checkUser'])->name('check.user');
                Route::get('setting', [AdminDashboardController::class, 'profileSetting'])->name('setting');
                Route::post('change-password', [AdminDashboardController::class, 'changePassword'])->name('change.password');
                Route::post('get/otp', [AdminDashboardController::class, 'getOtp'])->name('get.otp');
                Route::post('verify/user', [AdminDashboardController::class, 'verifyUser'])->name('verify.user');
                Route::post('send/otp', [AdminDashboardController::class, 'sendOtp'])->name('send.otp');
                Route::post('change/email', [AdminDashboardController::class, 'changeEmail'])->name('change.email');
                Route::post('change/phone', [AdminDashboardController::class, 'changePhone'])->name('change.phone');
            });
        });
        // logout
        Route::post('logout', [AdminAuthController::class, 'logout'])->name('logout');
    });
});
