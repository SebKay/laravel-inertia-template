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

        $orgs = Organisation::factory(5)
            ->for($adminUser)
            ->afterCreating(function (Organisation $org) use ($adminUser) {
                $org->users()->attach($adminUser);
            })
            ->create();

        $adminUser->currentOrganisation()
            ->associate($orgs->first())
            ->save();
    }
}
