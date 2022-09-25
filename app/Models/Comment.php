<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Comment extends Model
{
    use HasFactory;

    public function get()
    {
        return DB::table('comments')->get();
    }

    public function get_by_post($id)
    {
        return DB::table('comments')->join('posts', 'post_id', '=', 'posts.id')->where('post_id', $id)->select('comments.*')->get();
    }

    public function get_by_author($id)
    {
        return DB::table('comments')->join('users', 'author_id', '=', 'users.id')->where('author_id', $id)->select('comments.*')->get();
    }

//    public function avg_by_ratings($slug)
//    {
//        return DB::table('comments')->join('posts', 'post_id', '=', 'posts.id')->where('posts.slug', $slug)->selectRaw('round(avg(comments.rating))')->get();
//    }

    public function deleteComment($id)
    {
        DB::table('comments')->where('id', $id)->delete();
    }

    // Revoir update
    public function updateComment($comment)
    {
        return DB::table('comments')->where("id", $comment['id'])->updateOrInsert([
            'id' => $comment['id'],
            'body' => $comment['body'],
            'ratings' => $comment['rating']
        ]);
    }
}
