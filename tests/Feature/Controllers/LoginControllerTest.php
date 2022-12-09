<?php

use App\Models\User;
use Inertia\Testing\AssertableInertia as Assert;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertAuthenticated;
use function Pest\Laravel\assertGuest;
use function Pest\Laravel\get;
use function Pest\Laravel\post;

test("Guests users can access \"show\" route", function () {
    get(route('login'))
        ->assertStatus(200)
        ->assertSessionHasNoErrors()
        ->assertInertia(
            fn (Assert $page) => $page
                ->component('Login/Show')
        );
});

test("Authenticated users can't access \"show\" route", function () {
    /**
     * @var User
     */
    $user = User::factory()->create();

    actingAs($user)
        ->get(route('login'))
        ->assertRedirect(route('home'))
        ->assertSessionHasNoErrors();
});

test("Users can login", function () {
    /**
     * @var User
     */
    $user = User::factory()->create([
        'password' => '12345',
    ]);

    post(route('login'), [
        'email'    => $user->email,
        'password' => '12345',
    ])
        ->assertRedirect(route('home'))
        ->assertSessionHasNoErrors();

    assertAuthenticated();
});

test("Users can be redirected after login", function () {
    /**
     * @var User
     */
    $user = User::factory()->create([
        'password' => '12345',
    ]);

    $redirect = "https://google.com";

    post(route('login'), [
        'email'    => $user->email,
        'password' => '12345',
        'redirect' => $redirect,
    ])
        ->assertRedirect($redirect)
        ->assertSessionHasNoErrors();

    assertAuthenticated();
});

test("Users can't login with invalid credentials", function () {
    /**
     * @var User
     */
    $user = User::factory()->create([
        'password' => '12345',
    ]);

    post(route('login'), [
        'email'    => $user->email,
        'password' => 'test',
    ])
        ->assertSessionHasErrors();

    assertGuest();
});

test("Users can logout", function () {
    /**
     * @var User
     */
    $user = User::factory()->create();

    actingAs($user)
        ->post(route('logout'))
        ->assertRedirect(route('login'))
        ->assertSessionHasNoErrors();

    assertGuest();
});
