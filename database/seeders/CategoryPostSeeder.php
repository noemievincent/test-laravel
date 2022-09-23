<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Ramsey\Uuid\Uuid;

class CategoryPostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $posts = DB::table('posts')->select('id')->get();
        $categories = DB::table('categories')->select('id')->get();

        for ($i = 0; $i < POSTS_COUNT; $i++) {
            $post_id = $posts[$i]->id;

            for ($j = rand(0, intdiv(CATEGORIES_COUNT, 2)); $j < CATEGORIES_COUNT; $j += rand(1, CATEGORIES_COUNT)) {
                $category_id = $categories[$j]->id;
                DB::table('category_post')->insert([
                    'category_id' => $category_id,
                    'post_id' => $post_id,
                ]);
            }
        }
    }
}
