<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Auth\LoginController;

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['guest.admin']], function () {

    Route::prefix('login')->controller(LoginController::class)->group(function () {

        Route::get('/', 'showLoginForm')->name('show-login-form');

        Route::post('/handle', 'handleLogin')->name('handle-login');

    });
});

Route::get('password', function () {
    return view('dashboard.auth.passwords.forget-password');
})->name('admin.forget-password');

// Protected routes
Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['auth.admin']], function () {

    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


    Route::get('dashboard', function () {
        return view('dashboard.pages.home');
    })->name('dashboard.index');
});