<?php

namespace App\Policies;

use App\Enums\Permission;
use App\Models\Organisation;
use App\Models\User;

class OrganisationPolicy
{
    public function edit(User $user, Organisation $organisation)
    {
        return $user->can(Permission::EDIT_ORGANISATION->value) && $user->currentOrganisation->is($organisation);
    }

    public function update(User $user, Organisation $organisation)
    {
        return $user->can(Permission::UPDATE_ORGANISATION->value) && $user->currentOrganisation->is($organisation);
    }
}
