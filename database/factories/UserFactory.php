<?php

namespace Database\Factories;

use App\Enums\Role;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    public function definition()
    {
        return [
            'first_name' => \fake()->firstName(),
            'last_name' => \fake()->lastName(),
            'email' => \fake()->unique()->safeEmail(),
            'email_verified_at' => \now(),
            'password' => '12345',
            'remember_token' => Str::random(10),
        ];
    }

    public function unverified()
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }

    public function admin()
    {
        return $this->afterCreating(function (User $user) {
            $user->assignRole(Role::ADMIN->value);
        });
    }

    public function user()
    {
        return $this->afterCreating(function (User $user) {
            $user->assignRole(Role::USER->value);
        });
    }
}
