<?php

use App\Models\User;
use Inertia\Testing\AssertableInertia as Assert;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\get;

describe('Users', function() {
    test('Can access home page', function () {
        actingAs(User::factory()->create())
            ->get(route('home'))
            ->assertInertia(
                fn (Assert $page) => $page
                    ->component('Home/Index')
            );
    });
});

describe('Guests', function() {
    test("Can't access home page", function () {
        get(route('home'))
            ->assertRedirect(route('login'));
    });
});
