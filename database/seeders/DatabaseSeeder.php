<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserSeeder::class);
        $this->call(PostsSeeder::class);
        $this->call(CommentsSeeder::class);
        $this->call(CategoriesSeeder::class);
        $this->call(CategoryPostRelationshipSeeder::class);
    }
}
