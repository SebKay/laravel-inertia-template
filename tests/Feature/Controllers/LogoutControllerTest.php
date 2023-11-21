<?php

use App\Models\User;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertGuest;
use function Pest\Laravel\post;

describe('Users', function() {
    test('Can logout', function () {
        actingAs(User::factory()->create())
            ->post(route('logout'))
            ->assertRedirect(route('login'));

        assertGuest();
    });
});

describe('Guests', function() {
    test("Can't logout", function () {
        post(route('logout'))
            ->assertRedirect(route('login'));
    });
});
