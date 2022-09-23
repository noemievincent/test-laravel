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
        return DB::table('posts')->join('authors','author_id','=','authors.id')->where('authors.tokens',$token)->get();
    }
    public function api_add_author($id)
    {
        return DB::table('authors')->join('posts','author_id','=','authors.id')->where('posts.id','a30255b4-ae04-4cfe-9ad8-ecbd561560f5')->get();
    }
    public function api_add_comment($id)
    {
        return DB::table('posts')->join('comments','post_id','=','posts.id')->where('posts.id',$id)->get();
    }
    //Problème

    public function api_add_categories($id)
    {
        return DB::table('categories')->join('category_post','category_id','=','categories.id')->join('posts','posts.id','=','post_id')->select('categories.slug','posts.slug')->where('posts.id','a30255b4-ae04-4cfe-9ad8-ecbd561560f5')->get();
    }
}
