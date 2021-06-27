<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::insert([
            'name' => 'Azad Furkan ŞAKAR',
            'email' => 'afsakarr@gmail.com',
            'role_id' => 1,
            'email_verified_at' => now(),
            'password' => '$2y$10$vRwZk/01LvnHc0SdJ540qu.x4juy7.MTauu7sb5e5PNm0TNzg8VvK',
            'remember_token' => Str::random(10),
        ]);
    }
}
