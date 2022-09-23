<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Token extends Model
{
    use HasFactory;
    // Revoir fonction
    public function updateToken($author)
    {
        return  DB::table('authors')->where("id",$author['id'])->updateOrInsert([
            ':tokens' => $author['tokens'],
        ]);
    }
}
