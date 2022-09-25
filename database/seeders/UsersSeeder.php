<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Str;

define('AUTHORS_COUNT', rand(2, 8));

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();

        for ($i = 0; $i < AUTHORS_COUNT; $i++) {
            DB::table('users')->insert([
                'id' => Uuid::uuid4(),
                'name' => $name = $i > 0 ? strtolower($faker->name()) : 'Noémie Vincent',
                'slug' => Str::of($name)->slug('-'),
                'avatar' => $faker->imageUrl(128, 128, 'people', true, $name),
                'email' => $i > 0 ? $faker->unique()->safeEmail : 'noemie.vincent1@student.hepl.be',
                'password' => password_hash('change_this', PASSWORD_DEFAULT),
                'tokens' => str_replace("-", "",Uuid::uuid4()->toString()),
            ]);
        }
    }
}
