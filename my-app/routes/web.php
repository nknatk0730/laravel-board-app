<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');
Route::get('/posts/{post}/edit', [PostController::class, 'edit'])->name('posts.edit');
Route::put('/posts/{post}', [PostController::class, 'update'])->name('posts.update');
Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');
// コメントを作成するためのルーティングを追加
Route::post('/posts/{post}/comments', [CommentController::class, 'store'])->name('comments.store');
// いいねを投稿するルーティング
Route::post('/posts/{post}/likes', [LikeController::class, 'toggleLike'])->name('likes.toggle')->middleware('auth');
// contact form
Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
Route::post('/contact/confirm', [ContactController::class, 'confirm'])->name('contact.confirm');
Route::post('/contact/send', [ContactController::class, 'send'])->name('contact.send');
Route::get('/contact/complete', [ContactController::class, 'complete'])->name('contact.complete');


require __DIR__.'/auth.php';
