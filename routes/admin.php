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
use App\Http\Controllers\Admin\Contact\ContactController;

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

    Route::resource('authorizations', AuthorizationController::class);
//        ->middleware('can:view_roles');
    Route::resource('categories', CategoryController::class);
//        ->middleware('can:view_categories');
    Route::resource('users', UserController::class);
//        ->middleware('can:view_users');
    Route::resource('posts', PostController::class);
//        ->middleware('can:view_posts');
    Route::resource('admins', AdminController::class);
//        ->middleware('can:view_admins');
//    Route::resources([
//        'authorizations' => AuthorizationController::class,
//        'categories' => CategoryController::class,
//        'users' => UserController::class,
//        'posts' => PostController::class,
//        'admins' => AdminController::class,
//    ]);


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

    /* =================== Contact Routes ==================== */
    Route::controller(ContactController::class)->prefix('contact')->as('contact.')->group(function () {

        Route::get('/', 'index')->name('index');
        Route::get('show/{id}', 'show')->name('show');
        Route::get('destroy/{id}', 'destroy')->name('destroy');
        Route::post('mark-as-read/{contact}', 'markAsRead')->name('mark-as-read');
        Route::post('mark-as-pending/{contact}', 'markAsPending')->name('mark-as-pending');
        Route::get('reply/{contact}', 'showReplyForm')->name('reply');
        Route::post('reply/{contact}', 'sendReply')->name('send-reply');
        Route::post('status/{contact}', 'updateStatus')->name('update-status');
    });

    Route::get('dashboard', function () {
        return view('dashboard.pages.home');
    })->name('dashboard.index');
});