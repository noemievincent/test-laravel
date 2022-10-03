<?php

use App\Http\Controllers\AuthenticatedSessionController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PostsByAuthorsController;
use App\Http\Controllers\PostsByCategoriesController;
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
Route::get('posts', [PostController::class, 'index']);
Route::get('authors/{author:slug}/posts', PostsByAuthorsController::class);
Route::get('categories/{category:slug}/posts', PostsByCategoriesController::class);

// Create
Route::get('posts/create', [PostController::class, 'create']);

// Show
Route::get('posts/{post:slug}', [PostController::class, 'show']);


// Auth
Route::get('login', [AuthenticatedSessionController::class, 'create'])->middleware('guest');
Route::post('login', [AuthenticatedSessionController::class, 'store'])->middleware('guest');
Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->middleware('auth');
