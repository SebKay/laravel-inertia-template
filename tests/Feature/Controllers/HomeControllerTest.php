<?php

use App\Models\User;
use Inertia\Testing\AssertableInertia as Assert;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\get;

test("Authenticated users can access \"index\" route", function () {
    /**
     * @var User
     */
    $user = User::factory()->create();

    actingAs($user)
        ->get(route('home'))
        ->assertStatus(200)
        ->assertSessionHasNoErrors()
        ->assertInertia(
            fn (Assert $page) => $page
                ->component('Home/Index')
        );
});

test("Guests can't access \"index\" route", function () {
    get(route('home'))
        ->assertRedirect(route('login'))
        ->assertSessionHasNoErrors();
});
