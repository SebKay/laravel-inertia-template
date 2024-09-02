<?php

use App\Models\User;
use Inertia\Testing\AssertableInertia as Assert;

use function Pest\Faker\fake;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertAuthenticated;
use function Pest\Laravel\assertGuest;
use function Pest\Laravel\from;
use function Pest\Laravel\get;
use function Pest\Laravel\post;

describe('Users', function () {
    test("Can't access the login page", function () {
        actingAs(User::factory()->create())
            ->get(route('login'))
            ->assertRedirectToRoute('home');
    });
});

describe('Guests', function () {
    test('Can access the login page', function () {
        get(route('login'))
            ->assertOk()
            ->assertInertia(
                fn (Assert $page) => $page
                    ->component('Login/Show')
            );
    });

    test('Can login', function () {
        $password = fake()->password();
        $user = User::factory()->create([
            'password' => $password,
        ]);

        assertGuest();

        post(route('login'), [
            'email' => $user->email,
            'password' => $password,
        ])
            ->assertSessionDoesntHaveErrors()
            ->assertRedirectToRoute('home');

        assertAuthenticated();
    });

    test('Can be redirected after login', function () {
        $password = fake()->password();
        $user = User::factory()->create([
            'password' => $password,
        ]);

        $redirectUrl = 'https://www.google.com/';

        assertGuest();

        from(route('login'))
            ->post(route('login'), [
                'email' => $user->email,
                'password' => $password,
                'redirect' => $redirectUrl,
            ])
            ->assertSessionDoesntHaveErrors()
            ->assertRedirect($redirectUrl);

        assertAuthenticated();
    });

    test("Can't login with invalid credentials", function () {
        $user = User::factory()->create([
            'password' => fake()->password(),
        ]);

        assertGuest();

        from(route('login'))
            ->post(route('login'), [
                'email' => $user->email,
                'password' => 'test',
            ])
            ->assertSessionHasErrors([
                'email' => __('auth.failed'),
            ])
            ->assertRedirectToRoute('login');

        assertGuest();
    });
});
