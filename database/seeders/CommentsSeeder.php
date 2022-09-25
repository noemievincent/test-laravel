<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Ramsey\Uuid\Uuid;

class CommentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();

        $posts = DB::table('posts')->select('id')->get();
        $authors = DB::table('users')->select('id')->get();

        $mod = rand(2, 3);
        for ($i = 0; $i < POSTS_COUNT; $i++) {
            if ($i % $mod) {
                $comments_count = rand(1, 7);
                $post_id = $posts[$i]->id;

                for ($j = 0; $j < $comments_count; $j++) {
                    DB::table('comments')->insert([
                        'id' => Uuid::uuid4(),
                        'author_id' => $authors[rand(0, AUTHORS_COUNT - 1)]->id,
                        'post_id' => $post_id,
                        'body' => $faker->text
                    ]);
                }
            }
        }
    }
}
