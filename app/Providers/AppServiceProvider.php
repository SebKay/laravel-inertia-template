<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Vite;
use Illuminate\Support\ServiceProvider;
use Laravel\Pulse\Facades\Pulse;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        if ($this->app->environment('local')) {
            $this->app->register(\Laravel\Telescope\TelescopeServiceProvider::class);
            $this->app->register(TelescopeServiceProvider::class);
        }
    }

    public function boot(): void
    {
        JsonResource::withoutWrapping();

        Vite::prefetch(concurrency: 3);

        // @codeCoverageIgnoreStart
        Pulse::users(function ($ids) {
            return User::findMany($ids)->map(fn ($user) => [
                'id' => $user->id,
                'name' => $user->fullName,
                'extra' => "{$user->email} ({$user->roles->pluck('name')->implode(', ')})",
            ]);
        });
        // @codeCoverageIgnoreEnd
    }
}
