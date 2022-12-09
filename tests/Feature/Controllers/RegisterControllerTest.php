<?php

use App\Models\User;
use Inertia\Testing\AssertableInertia as Assert;

use function Pest\Faker\faker;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertAuthenticated;
use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\get;
use function Pest\Laravel\post;

test("Guests can access \"show\" route", function () {
    get(route('register'))
        ->assertStatus(200)
        ->assertSessionHasNoErrors()
        ->assertInertia(
            fn (Assert $page) => $page
                ->component('Register/Show')
        );
});

test("Authenticated users can't access \"show\" route", function () {
    /**
     * @var User
     */
    $user = User::factory()->create();

    actingAs($user)
        ->get(route('register'))
        ->assertRedirect(route('home'))
        ->assertSessionHasNoErrors();
});

test("Guests can register", function () {
    $email = faker()->email();

    post(route('register.store'), [
        'first_name' => faker()->firstName(),
        'last_name'  => faker()->lastName(),
        'email'      => $email,
        'password'   => '123456Ab#',
    ])
        ->assertRedirect(route('home'))
        ->assertSessionHasNoErrors();

    assertDatabaseHas('users', [
        'email' => $email,
    ]);

    assertAuthenticated();
});
