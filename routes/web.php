<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\NewsSubscribersController;
use App\Http\Controllers\Frontend\CategoryController;
use App\Http\Controllers\Frontend\PostController;
use App\Http\Controllers\Frontend\ContactController;
use App\Http\Controllers\Frontend\SearchController;
use App\Http\Controllers\Frontend\Dashboard\ProfileController;
use App\Http\Controllers\Frontend\Dashboard\SettingController;
use App\Http\Controllers\Frontend\Dashboard\NotificationController;

Route::group([
    'as' => 'frontend.',
], function () {

    Route::get('/', [HomeController::class, 'index'])->name('index')->middleware('check_user_status');

    Route::get('wait', function () {
        return view('frontend.pages.waiting');
    })->name('waiting');

    /* Subscribers */
    Route::post('news-subscribers', [NewsSubscribersController::class, 'store'])->name('news.subscribers');

    /* show a single Category */
    Route::get('category/{slug}', CategoryController::class)->name('category.posts');

    /* Contact Routes */
    Route::controller(ContactController::class)->name('contact.')->prefix('contact-us')->group(function () {

        Route::get('/', 'index')->name('index');

        Route::post('/store', 'store')->name('store');

    });

    /* Post Routes */
    Route::controller(PostController::class)->name('post.')->prefix('post')->group(function () {

        Route::get('{slug}', 'show')->name('show');

        Route::get('comments/{slug}', 'getAllPosts')->name('getAllComments')->middleware('check_user_status');

        Route::post('comments/store', 'saveComment')->name('comments.store')->middleware('check_user_status');
    });

    /* Search Posts */
    Route::match(['post', 'get'], 'search', SearchController::class)->name('search');

    /*  User Profile Routes & Notifications & Settings   */
    Route::prefix('account/')->name('dashboard.')->middleware(['auth:web', 'verified', 'check_user_status'])->group(function () {

        /* Manage profile Routes */
        Route::controller(ProfileController::class)->group(function () {

            Route::get('/profile', 'index')->name('profile');

            /* store post */
            Route::post('/post', 'storePost')->name('post.store');

            /* delete post */
            Route::delete('/post/delete', 'deletePost')->name('post.delete');

            /* Update post */
            Route::get('/post/{slug}/edit', 'showEditPost')->name('post.edit');

            /* Update post */
            Route::put('/post/update', 'updatePost')->name('post.update');

            /* delete single image when edit post */
            Route::post('/post/image/delete/{image_id}', 'deletePostImage')->name('post.image.delete');

            /* get comments  */
            Route::get('/post/get-comments/{id}', 'getComments')->name('post.get-comments');
        });

        /* settings Routes */
        Route::controller(SettingController::class)->prefix('settings')->group(function () {
            Route::get('/', 'index')->name('settings');
            Route::post('/update', 'update')->name('settings.update');
            Route::post('/change-password', 'changePassword')->name('settings.changePassword');
        });

        /* Notification Routes */
        Route::controller(NotificationController::class)->middleware(['auth', 'check.notification.read'])
            ->prefix('notifications')->name('notifications.')->group(function () {

                /* show all Notifications */
                Route::get('/', 'index')->name('index');

                /* make Notification as read */
                Route::get('notifications/{id}/redirect', fn() => null)->name('redirect');

                /* delete Notifications */
                Route::delete('/dashboard/notifications', 'destroy')->name('destroy');

                /* delete All Notifications */
                Route::delete('/dashboard/all-notifications', 'deleteAll')->name('delete-all');

                /* mark All Notifications Read */
                Route::post('/dashboard/notifications/mark-all-read', 'markAllAsRead')->name('markAllAsRead');

            });

    });

});


//Route::get('/dashboard', function () {
//    return view('dashboard');
//})->middleware(['auth', 'verified'])->name('dashboard');
//
//
//Route::middleware('auth')->group(function () {
//    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
//});

require __DIR__ . '/auth.php';
require __DIR__ . '/admin.php';
