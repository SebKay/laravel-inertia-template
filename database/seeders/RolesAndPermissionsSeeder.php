<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsSeeder extends Seeder
{
    use WithoutModelEvents;

    protected Collection $roles;
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
            'admin' => Role::create(['name' => 'admin']),
        ]);
    }

    protected function createPermissions()
    {
        $this->postPermissions = \collect([
            Permission::create(['name' => 'create-posts']),
            Permission::create(['name' => 'view-posts']),
            Permission::create(['name' => 'edit-posts']),
            Permission::create(['name' => 'update-posts']),
            Permission::create(['name' => 'delete-posts']),
        ]);
    }

    protected function assignPermissionsToRoles()
    {
        $this->roles->get('admin')->givePermissionTo($this->postPermissions);
    }
}
