<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\NewsSubscribersController;
use App\Http\Controllers\Frontend\CategoryController;
use App\Http\Controllers\Frontend\PostController;
use App\Http\Controllers\Frontend\ContactController;


Route::group([
    'as' => 'frontend.',
], function () {

    Route::get('/', [HomeController::class, 'index'])->name('index');
    Route::post('news-subscribers', [NewsSubscribersController::class, 'store'])->name('news.subscribers');
    Route::get('category/{slug}', CategoryController::class)->name('category.posts');
    Route::get('post/{slug}', [PostController::class, 'show'])->name('post.show');
    Route::get('post/comments/{slug}', [PostController::class, 'getAllPosts'])->name('post.getAllComments');
    Route::post('post/comments/store', [PostController::class, 'saveComment'])->name('post.comments.store');
    Route::get('contact-us', [ContactController::class, 'index'])->name('contact.index');
    Route::post('contact/store', [ContactController::class, 'store'])->name('contact.store');
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
