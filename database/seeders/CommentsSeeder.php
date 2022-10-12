<?php

namespace Database\Seeders;

use App\Models\Comment;
use Carbon\Carbon;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CommentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();
        $posts_ids = DB::table('posts')->pluck('id');
        $users_ids = DB::table('users')->pluck('id');
        $mod = rand(2, 3);
        for ($i = 0; $i < 100; $i++) {
            if ($i % $mod) {
                $comments_count = rand(1, 7);
                $post_id = $posts_ids[$i];
                for ($j = 0; $j < $comments_count; $j++) {
                    $user_id = $users_ids[rand(0, 9)]; //Knowing there are 10 users
                    $body = $faker->text;
                    $created_at = Carbon::create($faker->dateTimeBetween('-3 years', 'now')->format('Y-m-d H:i:s'));

                    Comment::create(
                        compact('body', 'user_id', 'post_id', 'created_at')
                    );
                }
            }
        }

    }
}
