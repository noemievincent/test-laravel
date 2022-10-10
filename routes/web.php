<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\AuthenticatedSessionController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PostsByAuthorsController;
use App\Http\Controllers\PostsByCategoriesController;
use App\Models\Post;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Index
Route::get('/posts', [PostController::class, 'index']);
Route::get('/authors/{author:slug}', PostsByAuthorsController::class);
Route::get('/categories/{category:slug}/posts', PostsByCategoriesController::class);

// Create
Route::post('/posts', [PostController::class, 'store'])->middleware('auth', 'can:create, App\Models\Post');
Route::get('/posts/create', [PostController::class, 'create'])->middleware('auth', 'can:create, App\Models\Post');

// Show
Route::get('/post/{post:slug}', [PostController::class, 'show']);

// Edit
Route::post('/post/{post:slug}', [PostController::class, 'update'])->middleware('auth')->can('update', 'post');
Route::get('/post/{post:slug}/edit', [PostController::class, 'edit'])->middleware('auth')->can('update', 'post');

//Delete
Route::post('/post/{post:slug}/delete', [PostController::class, 'destroy'])->middleware('auth')->can('delete', 'post');

// Comment
Route::post('/post/{post:slug}/comment', [CommentController::class, 'store'])->middleware('auth');
Route::post('/post/{post:slug}/comment/{comment}', [CommentController::class, 'update'])->middleware('auth');

Route::post('/post/{post:slug}/comment/{comment}/delete', [CommentController::class, 'destroy']);

// Auth
Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login')->middleware('guest');
Route::post('/login', [AuthenticatedSessionController::class, 'store'])->middleware('guest');
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->middleware('auth');

Route::get('/register', [RegisteredUserController::class, 'create'])->middleware('guest');
Route::post('/register', [RegisteredUserController::class, 'store'])->middleware('guest');
