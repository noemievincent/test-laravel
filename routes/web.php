<?php

use App\Http\Controllers\PostController;
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

Route::get('posts/{post}', function (Post $post) {
    return $post->load('comments', 'categories');
//    return $post->categories;
});

Route::get('categories/{category}', function (Category $category) {
    return $category->load('posts');
});

Route::get('users', function () {
   return User::all();
});

Route::get('users/{user:slug}', function (User $user) {
   return $user;
});
