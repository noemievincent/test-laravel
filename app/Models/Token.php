<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/**
 * App\Models\Token
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Token newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Token newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Token query()
 * @mixin \Eloquent
 */

class Token extends Model
{
    use HasFactory;
    // Revoir fonction
    public function updateToken($author)
    {
        return  DB::table('users')->where("id",$author['id'])->updateOrInsert([
            ':tokens' => $author['tokens'],
        ]);
    }
}
