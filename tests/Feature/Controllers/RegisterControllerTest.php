<?php

use App\Models\User;
use Inertia\Testing\AssertableInertia as Assert;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertAuthenticated;
use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\get;
use function Pest\Laravel\post;

test('Guests can access register page', function () {
    get(route('register'))
        ->assertOk()
        ->assertInertia(
            fn (Assert $page) => $page
                ->component('Register/Show')
        );
});

test("Users can't access register page", function () {
    actingAs(User::factory()->create())
        ->get(route('register'))
        ->assertRedirect(route('home'));
});

test('Guests can register', function () {
    $email = fake()->email();

    post(route('register.store'), [
        'first_name' => fake()->firstName(),
        'last_name' => fake()->lastName(),
        'email' => $email,
        'password' => '123456Ab#',
    ])
        ->assertRedirect(route('home'));

    assertDatabaseHas('users', [
        'email' => $email,
    ]);

    assertAuthenticated();
});
