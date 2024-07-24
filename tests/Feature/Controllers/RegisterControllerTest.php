<?php

use App\Enums\Role;
use App\Models\User;
use Inertia\Testing\AssertableInertia as Assert;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertAuthenticated;
use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\get;
use function Pest\Laravel\post;

describe('Users', function () {
    test("Can't access the register page", function () {
        actingAs(User::factory()->create())
            ->get(route('register'))
            ->assertRedirectToRoute('home');
    });
});

describe('Guests', function () {
    test('Can access the register page', function () {
        get(route('register'))
            ->assertOk()
            ->assertInertia(
                fn (Assert $page) => $page
                    ->component('Register/Show')
            );
    });

    test('Can register', function () {
        $orgName = fake()->company();
        $email = fake()->email();

        post(route('register.store'), [
            'organisation_name' => $orgName,
            'first_name' => fake()->firstName(),
            'last_name' => fake()->lastName(),
            'email' => $email,
            'password' => 'P$ssword12345#',
        ])
            ->assertSessionDoesntHaveErrors()
            ->assertRedirectToRoute('home');

        assertDatabaseHas('users', [
            'email' => $email,
        ]);

        assertDatabaseHas('organisations', [
            'name' => $orgName,
        ]);

        expect(User::where('email', $email)->firstOrFail()->roles->first()->name)->toBe(Role::USER->value);

        assertAuthenticated();
    });

    test("Can't register with an email that already exists", function () {
        $email = 'jim@test.com';

        User::factory()->create([
            'email' => $email,
        ]);

        post(route('register.store'), [
            'organisation_name' => fake()->company(),
            'first_name' => fake()->firstName(),
            'last_name' => fake()->lastName(),
            'email' => $email,
            'password' => 'P$ssword12345#',
        ])
            ->assertSessionHasErrors('email');
    });
});
