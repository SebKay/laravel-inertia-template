<?php

namespace Database\Seeders;

use App\Enums\Role;
use App\Models\Organisation;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrganisationsSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run()
    {
        User::whereHas('roles', fn ($q) => $q->where('name', [Role::SUPER_ADMIN->value, Role::ADMIN->value]))
            ->get()
            ->each(function (User $user) {
                $user->organisation()
                    ->associate(
                        Organisation::factory()
                            ->for($user)
                            ->afterCreating(function (Organisation $org) use ($user) {
                                $org->users()->attach($user);
                            })
                            ->create()
                    )
                    ->save();
            });
    }
}
