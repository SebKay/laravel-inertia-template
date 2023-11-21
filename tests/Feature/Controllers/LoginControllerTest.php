<?php

use App\Models\User;
use Inertia\Testing\AssertableInertia as Assert;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertAuthenticated;
use function Pest\Laravel\assertGuest;
use function Pest\Laravel\get;
use function Pest\Laravel\post;

describe('Users', function() {
    test("Can't access login page", function () {
        actingAs(User::factory()->create())
            ->get(route('login'))
            ->assertRedirect(route('home'));
    });
});

describe('Guests', function() {
    test('Can access login page', function () {
        get(route('login'))
            ->assertOk()
            ->assertInertia(
                fn (Assert $page) => $page
                    ->component('Login/Show')
            );
    });

    test('Can login', function () {
        $user = User::factory()->create([
            'password' => '12345',
        ]);

        post(route('login'), [
            'email' => $user->email,
            'password' => '12345',
        ])
            ->assertRedirect(route('home'));

        assertAuthenticated();
    });

    test('Can be redirected after login', function () {
        $user = User::factory()->create([
            'password' => '12345',
        ]);

        $redirect = 'https://google.com';

        post(route('login'), [
            'email' => $user->email,
            'password' => '12345',
            'redirect' => $redirect,
        ])
            ->assertRedirect($redirect);

        assertAuthenticated();
    });

    test("Can't login with invalid credentials", function () {
        $user = User::factory()->create([
            'password' => '12345',
        ]);

        post(route('login'), [
            'email' => $user->email,
            'password' => 'test',
        ])
            ->assertsessionHasErrors();

        assertGuest();
    });
});
