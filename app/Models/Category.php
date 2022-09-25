<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Category extends Model
{
    use HasFactory;

    public function get()
    {
        return DB::table('categories')->get();
    }

    public function category_exists($id)
    {
        return DB::table('categories')->selectRaw('count(categories.id)')->where('id', $id)->get();
    }

    //Problème
    public function get_by_post($id)
    {
        return DB::table('categories')->join('category_post', 'category_id', '=', 'categories.id')->join('posts', 'posts.id', '=', 'post_id')->where('posts.id', $id)->select('categories.slug', 'posts.slug')->get();
    }
}
