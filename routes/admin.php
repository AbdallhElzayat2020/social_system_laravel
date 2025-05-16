<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\Auth\Password\ForgetPasswordController;
use App\Http\Controllers\Admin\Auth\Password\ResetPasswordController;

Route::group(['prefix' => 'admin', 'as' => 'admin.',], function () {

    Route::prefix('login')->controller(LoginController::class)->group(function () {

        Route::get('/', 'showLoginForm')->name('show-login-form')->middleware('guest.admin');

        Route::post('/handle', 'handleLogin')->name('handle-login')->middleware('guest.admin');
    });

    // Forgot Password routes
    Route::controller(ForgetPasswordController::class)->prefix('password')->name('password.')->group(function () {

        Route::get('forgot', 'showEmailForm')->name('email');

        Route::post('forgot', 'sendOtp')->name('send-otp');

        Route::get('verify/{email}', 'showOtpForm')->name('show-otp-form');

        Route::post('verify', 'verifyOtp')->name('verify-otp');
    });

    // Reset Password routes
    Route::controller(ResetPasswordController::class)->prefix('password')->name('password.')->group(function () {

        Route::get('reset/{email}', 'showResetForm')->name('show-reset-form');

        Route::post('reset', 'resetPassword')->name('reset-password');

    });

});


// Protected routes
Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['auth.admin']], function () {

    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    Route::get('dashboard', function () {
        return view('dashboard.pages.home');
    })->name('dashboard.index');
});