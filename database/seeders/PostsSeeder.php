<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Ramsey\Uuid\Uuid;
use Carbon\Carbon;

define('POSTS_COUNT', rand(30, 50));

class PostsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();

        $authors = DB::table('users')->select('id')->get();

        for ($i = 0; $i < POSTS_COUNT; $i++) {
            $creation_date = Carbon::create($faker->dateTimeBetween('-3 years', 'now')->format('Y-m-d H:i:s'));

            DB::table('posts')->insert([
                'id' => Uuid::uuid4(),
                'title' => $title = $faker->sentence(10),
                'slug' => Str::of($title)->slug('-'),
                'body' => '<p>'.implode('</p><p>', $faker->paragraphs(12)).'</p>',
                'excerpt' => $faker->sentence(40),
                'thumbnail' => $faker->imageUrl(640, 480, 'landscape', true),
                'author_id' => $authors[rand(0, AUTHORS_COUNT - 1)]->id,
                'published_at' => $creation_date->addDays(rand(0, 1) * rand(2, 20)),
                'created_at' => $creation_date,
                'updated_at' => rand(0, 10) ? $creation_date : $creation_date->addWeeks(rand(2, 8)),
                'deleted_at' => rand(0, 10) ? null : Carbon::now(),
            ]);
        }
    }
}
