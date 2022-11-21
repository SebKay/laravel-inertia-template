<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    public function run()
    {
        \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@laravel-inertia-template.test',
        ]);
    }
}
