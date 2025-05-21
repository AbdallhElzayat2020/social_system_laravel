<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\Auth\Password\ForgetPasswordController;
use App\Http\Controllers\Admin\Auth\Password\ResetPasswordController;
use App\Http\Controllers\Admin\Users\UserController;
use App\Http\Controllers\Admin\Category\CategoryController;
use App\Http\Controllers\Admin\Post\PostController;
use App\Http\Controllers\Admin\Setting\SettingController;
use App\Http\Controllers\Admin\Admin\AdminController;
use App\Http\Controllers\Admin\Authorization\AuthorizationController;

Route::group(['prefix' => 'admin', 'as' => 'admin.',], function () {

    Route::prefix('login')->controller(LoginController::class)->group(function () {

        Route::get('/', 'showLoginForm')->name('show-login-form')->middleware('guest.admin');

        Route::post('/handle', 'handleLogin')->name('handle-login')->middleware('guest.admin');

        Route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth.admin');
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

/*
====================================================================================
 Protected routes
====================================================================================
 */

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['auth.admin']], function () {

    /* resource routes
    ====================================================================================
    * Categories
    * Users
    * Posts
    * Admins
    ====================================================================================
      */

    Route::resources([
        'authorizations' => AuthorizationController::class,
        'categories' => CategoryController::class,
        'users' => UserController::class,
        'posts' => PostController::class,
        'admins' => AdminController::class,
    ]);

    /*  user change status */
    Route::get('users/status/{id}', [UserController::class, 'changeStatus'])->name('user.status-change');

    /*  categories change status */
    Route::get('categories/status/{id}', [CategoryController::class, 'changeStatus'])->name('category.status-change');

    /*  posts change status */
    Route::get('posts/status/{id}', [PostController::class, 'changeStatus'])->name('post.status-change');

    /* Admins change status */
    Route::get('admins/status/{id}', [AdminController::class, 'changeStatus'])->name('admins.status-change');

    /* delete single image when edit post */
    Route::post('/post/image/delete/{image_id}', [PostController::class, 'deletePostImage'])->name('post.image.delete');

    /* =================== Settings Routes ==================== */
    Route::controller(SettingController::class)->prefix('settings')->as('settings.')->group(function () {

        Route::get('/', 'index')->name('index');

        Route::put('/update', 'update')->name('update');

    });

    Route::get('dashboard', function () {
        return view('dashboard.pages.home');
    })->name('dashboard.index');
});