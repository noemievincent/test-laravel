<?php

use App\Http\Controllers\AsideController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PostsByAuthorsController;
use App\Http\Controllers\PostsByCategoriesController;
use App\Http\Controllers\UserController;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\DB;
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

Route::get('posts', [PostController::class, 'index']);

Route::get('authors/{author:slug}/posts', PostsByAuthorsController::class);

Route::get('categories/{category:slug}/posts', PostsByCategoriesController::class);

Route::get('posts/{post:slug}', [PostController::class, 'show']);


Route::get('categories/{category}', function (Category $category) {
    return $category->load('posts');
});

Route::get('users', function () {
   return User::all();
});

Route::get('users/{user:slug}', function (User $user) {
   return $user;
});
