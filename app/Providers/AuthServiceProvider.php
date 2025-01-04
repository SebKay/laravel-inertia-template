<?php

namespace App\Providers;

use App\Enums\Role;
use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        \Spatie\Permission\Models\Role::class => \App\Policies\RolePolicy::class,
        \Spatie\Permission\Models\Permission::class => \App\Policies\PermissionPolicy::class,
    ];

    public function boot(): void
    {
        // @codeCoverageIgnoreStart
        Gate::define('viewPulse', function (User $user) {
            return $user->hasRole(Role::SUPER_ADMIN->value);
        });
        // @codeCoverageIgnoreEnd
    }
}
