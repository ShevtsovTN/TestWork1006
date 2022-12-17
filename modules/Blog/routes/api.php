<?php

use Illuminate\Support\Facades\Route;
use Modules\Blog\Http\Controllers\PostController;

Route::as('blog.posts.')->group(function () {
    Route::get('/posts', [PostController::class, 'index'])->name('index');
    Route::get('/posts/{post}', [PostController::class, 'show'])->name('show');
    Route::middleware('auth:api')->post('/posts', [PostController::class, 'store'])->name('store');
    Route::middleware('auth:api')->match(['put', 'patch'],'/posts/{post}', [PostController::class, 'update'])->name('update');
    Route::middleware('auth:api')->delete('/posts/{post}', [PostController::class, 'destroy'])->name('delete');
});
