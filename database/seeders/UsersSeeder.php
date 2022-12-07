<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    public function run()
    {
        User::factory()->create([
            'email' => \env('SEED_ADMIN_EMAIL'),
        ]);
    }
}
