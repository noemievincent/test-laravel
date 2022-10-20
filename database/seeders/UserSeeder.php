<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $name = 'Noémie Vincent';
        User::factory()->create([
            'name' => $name,
            'slug' => Str::slug($name),
            'email' => 'noemie.vincent1@student.hepl.be',
            'is_admin' => true,
        ]);
        User::factory()->count(9)->create();
    }
}
