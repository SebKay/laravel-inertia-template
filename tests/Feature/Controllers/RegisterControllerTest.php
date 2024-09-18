<?php

use App\Enums\Role;
use App\Models\User;
use Inertia\Testing\AssertableInertia as Assert;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertAuthenticated;
use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\assertGuest;
use function Pest\Laravel\from;
use function Pest\Laravel\get;
use function Pest\Laravel\post;

covers(App\Http\Controllers\RegisterController::class);

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
                    ->has('first_name')
                    ->has('last_name')
                    ->has('email')
                    ->has('password')
                    ->has('organisation_name')
            );
    });

    test('Props are not passed to the show page in production', function () {
        app()->instance('env', 'production');

        get(route('register'))
            ->assertOk()
            ->assertInertia(
                fn (Assert $page) => $page
                    ->component('Register/Show')
                    ->missing('first_name')
                    ->missing('last_name')
                    ->missing('email')
                    ->missing('password')
                    ->missing('organisation_name')
            );
    });

    test('Can register', function () {
        $orgName = fake()->company();
        $email = fake()->email();

        assertGuest();

        post(route('register.store'), [
            'organisation_name' => $orgName,
            'first_name' => fake()->firstName(),
            'last_name' => fake()->lastName(),
            'email' => $email,
            'password' => 'Pa$$word12345#',
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

        from(route('register'))
            ->post(route('register.store'), [
                'organisation_name' => fake()->company(),
                'first_name' => fake()->firstName(),
                'last_name' => fake()->lastName(),
                'email' => $email,
                'password' => 'P$ssword12345#',
            ])
            ->assertSessionHasErrors([
                'email' => __('validation.unique', ['attribute' => 'email']),
            ])
            ->assertRedirectToRoute('register');
    });
});
