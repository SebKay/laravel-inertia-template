<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\ServiceProvider;
use Laravel\Pulse\Facades\Pulse;

class AppServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        JsonResource::withoutWrapping();

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
