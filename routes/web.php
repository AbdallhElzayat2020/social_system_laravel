<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\NewsSubscribersController;
use App\Http\Controllers\Frontend\CategoryController;
use App\Http\Controllers\Frontend\PostController;
use App\Http\Controllers\Frontend\ContactController;
use App\Http\Controllers\Frontend\SearchController;

Route::group([
    'as' => 'frontend.',
], function () {

    Route::get('/', [HomeController::class, 'index'])->name('index');

    Route::post('news-subscribers', [NewsSubscribersController::class, 'store'])->name('news.subscribers');

    Route::get('category/{slug}', CategoryController::class)->name('category.posts');

    /* Contact Routes */
    Route::controller(ContactController::class)->name('contact.')->prefix('contact-us')->group(function () {

        Route::get('/', 'index')->name('index');

        Route::post('/store', 'store')->name('store');

    });

    /* Post Routes */
    Route::controller(PostController::class)->name('post.')->prefix('post')->group(function () {

        Route::get('{slug}', 'show')->name('show');

        Route::get('comments/{slug}', 'getAllPosts')->name('getAllComments');

        Route::post('comments/store', 'saveComment')->name('comments.store');
    });

    /* Search Posts */

    Route::match(['post', 'get'], 'search', SearchController::class)->name('search');
});


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__ . '/auth.php';
