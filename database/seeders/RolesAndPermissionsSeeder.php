<?php

namespace Database\Seeders;

use App\Enums\Permission;
use App\Enums\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;
use Spatie\Permission\Models\Permission as SpatiePermission;
use Spatie\Permission\Models\Role as SpatieRole;

class RolesAndPermissionsSeeder extends Seeder
{
    use WithoutModelEvents;

    protected Collection $roles;

    protected Collection $orgnaisationPermissions;

    protected Collection $postPermissions;

    public function run()
    {
        $this->createRoles();
        $this->createPermissions();
        $this->assignPermissionsToRoles();
    }

    protected function createRoles()
    {
        $this->roles = \collect([
            Role::ADMIN->value => SpatieRole::create(['name' => Role::ADMIN]),
            Role::USER->value => SpatieRole::create(['name' => Role::USER]),
        ]);
    }

    protected function createPermissions()
    {
        $this->orgnaisationPermissions = \collect([
            SpatiePermission::create(['name' => Permission::EDIT_ORGANISATION]),
            SpatiePermission::create(['name' => Permission::UPDATE_ORGANISATION]),
        ]);

        $this->postPermissions = \collect([
            SpatiePermission::create(['name' => Permission::CREATE_POSTS]),
            SpatiePermission::create(['name' => Permission::VIEW_POSTS]),
            SpatiePermission::create(['name' => Permission::EDIT_POSTS]),
            SpatiePermission::create(['name' => Permission::UPDATE_POSTS]),
            SpatiePermission::create(['name' => Permission::DELETE_POSTS]),
        ]);
    }

    protected function assignPermissionsToRoles()
    {
        $this->roles->get(Role::ADMIN->value)->givePermissionTo($this->postPermissions);
        $this->roles->get(Role::ADMIN->value)->givePermissionTo($this->orgnaisationPermissions);

        $this->roles->get(Role::USER->value)->givePermissionTo($this->postPermissions);
    }
}
