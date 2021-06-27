<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Role::insert([
            'name' => 'Super Admin',
            'permissions' => '',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        \App\Models\Role::insert([
            'name' => 'Admin',
            'permissions' => '',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        \App\Models\Role::insert([
            'name' => 'User',
            'permissions' => '',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
