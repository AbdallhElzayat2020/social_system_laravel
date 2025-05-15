<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Auth\LoginController;

// auth admin routes
Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['guest:admin']], function () {
    Route::prefix('login')->controller(LoginController::class)->group(function () {
        Route::get('/', 'showLoginForm')->name('show-login-form');
        Route::post('/handle', 'handleLogin')->name('handle-login');
    });
});

// Protected routes
Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['auth:admin']], function () {
    // Your protected routes here
});