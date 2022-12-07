<?php

namespace Database\Seeders;

use App\Models\Organisation;
use App\Models\User;
use Illuminate\Database\Seeder;

class OrganisationsSeeder extends Seeder
{
    public function run()
    {
        $adminUser = User::whereEmail(\env('SEED_ADMIN_EMAIL'))->firstOrFail();

        Organisation::factory()
            ->for($adminUser)
            ->create();
    }
}
