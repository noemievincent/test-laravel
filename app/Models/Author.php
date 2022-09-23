<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Author extends Model
{
    public function get()
    {
        return DB::table('authors')->get();
    }

    public function find_by_slug($slug)
    {
        return DB::table('authors')->where('slug', $slug)->get();
    }

    public function find_by_email($email)
    {
        return DB::table('authors')->where('email', $email)->get();
    }

    public function updateAuthor($author)
    {
        return DB::table('authors')->updateOrInsert([
            ':id' => $author['id'],
            ':email' => $author['email'],
            ':password' => $author['password'],
            ':avatar' => $author['avatar']
        ]);
    }

    use HasFactory;
}
