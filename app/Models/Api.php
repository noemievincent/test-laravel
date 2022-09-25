<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Api extends Model
{
    use HasFactory;

    public function getApi($token)
    {
        return DB::table('posts')->join('users', 'author_id', '=', 'users.id')->where('users.tokens', $token)->get();
    }

    public function api_add_author($id)
    {
        return DB::table('users')->join('posts', 'author_id', '=', 'users.id')->where('posts.id', $id)->get();
    }

    public function api_add_comment($id)
    {
        return DB::table('posts')->join('comments', 'post_id', '=', 'posts.id')->where('posts.id', $id)->get();
    }

    //Problème

    public function api_add_categories($id)
    {
        return DB::table('categories')->join('category_post', 'category_id', '=', 'categories.id')->join('posts', 'posts.id', '=', 'post_id')->select('categories.slug', 'posts.slug')->where('posts.id', $id)->get();
    }
}
