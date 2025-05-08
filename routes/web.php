<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\NewsSubscribersController;
use App\Http\Controllers\Frontend\CategoryController;
use App\Http\Controllers\Frontend\PostController;

Route::group([
    'as' => 'frontend.',
], function () {

    Route::get('/', [HomeController::class, 'index'])->name('index');
    Route::post('news-subscribers', [NewsSubscribersController::class, 'store'])->name('news.subscribers');
    Route::get('category/{slug}', CategoryController::class)->name('category.posts');
    Route::get('post/{slug}', [PostController::class, 'show'])->name('post.show');
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
