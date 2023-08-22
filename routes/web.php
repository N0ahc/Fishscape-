<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\LikesController;
use App\Http\Controllers\CommentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [PostsController::class, 'welcome'], function () {
    return view('welcome');
});

Route::get('/dashboard', [PostsController::class, 'index'], function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/create', [PostsController::class, 'create'])->middleware(['auth', 'verified'])->name('create');
Route::post('/store', [PostsController::class, 'store'])->middleware(['auth', 'verified'])->name('store.post');


Route::middleware('auth')->group(function () {

    Route::post('/like/{post}', [LikesController::class, 'like'])->name('like');
    Route::post('/unlike/{post}', [LikesController::class, 'unlike'])->name('unlike');

    // Route::post('/likes', [LikesController::class, 'store'])->name('like.store');
    // Route::delete('/likes/{id}', [LikesController::class, 'destroy'])->name('like.destroy');

    Route::delete('/posts/{id}', [PostsController::class, 'destroy'])->name('post.destroy');
    Route::get('posts/{post}/edit', [PostsController::class, 'edit'])->name('post.edit');
    Route::patch('posts/{post}', [PostsController::class, 'update'])->name('post.update');

    Route::post('/comments', [CommentsController::class, 'store'])->name('comment.store');
    Route::delete('/comments/{id}', [CommentsController::class, 'destroy'])->name('comment.destroy');
    Route::get('comments/{comment}/edit', [CommentsController::class, 'edit'])->name('comment.edit');
    Route::patch('comments/{comment}', [CommentsController::class, 'update'])->name('comment.update');


    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
