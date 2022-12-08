<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    public function run()
    {
        User::factory()
            ->afterCreating(function (User $user) {
                $user->assignRole('admin');
            })
            ->create([
                'email' => \env('SEED_ADMIN_EMAIL'),
            ]);
    }
}
