<?php

use App\Models\User;
use Inertia\Testing\AssertableInertia as Assert;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertAuthenticated;
use function Pest\Laravel\assertGuest;
use function Pest\Laravel\get;
use function Pest\Laravel\post;

test("Guests can access login page", function () {
    get(route('login'))
        ->assertOk()
        ->assertInertia(
            fn (Assert $page) => $page
                ->component('Login/Show')
        );
});

test("Users can't access login page", function () {
    actingAs(User::factory()->create())
        ->get(route('login'))
        ->assertRedirect(route('home'));
});

test("Guests can login", function () {
    $user = User::factory()->create([
        'password' => '12345',
    ]);

    post(route('login'), [
        'email'    => $user->email,
        'password' => '12345',
    ])
        ->assertRedirect(route('home'));

    assertAuthenticated();
});

test("Guests can be redirected after login", function () {
    $user = User::factory()->create([
        'password' => '12345',
    ]);

    $redirect = "https://google.com";

    post(route('login'), [
        'email'    => $user->email,
        'password' => '12345',
        'redirect' => $redirect,
    ])
        ->assertRedirect($redirect);

    assertAuthenticated();
});

test("Guests can't login with invalid credentials", function () {
    $user = User::factory()->create([
        'password' => '12345',
    ]);

    post(route('login'), [
        'email'    => $user->email,
        'password' => 'test',
    ])
        ->assertsessionHasErrors('email');

    assertGuest();
});

test("Users can logout", function () {
    actingAs(User::factory()->create())
        ->post(route('logout'))
        ->assertRedirect(route('login'));

    assertGuest();
});
