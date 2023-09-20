<?php

use App\Models\User;
use Inertia\Testing\AssertableInertia as Assert;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\get;

test('Users can access home page', function () {
    actingAs(User::factory()->create())
        ->get(route('home'))
        ->assertOk()
        ->assertInertia(
            fn (Assert $page) => $page
                ->component('Home/Index')
        );
});

test("Guests can't access home page", function () {
    get(route('home'))->assertRedirect(route('login'));
});
