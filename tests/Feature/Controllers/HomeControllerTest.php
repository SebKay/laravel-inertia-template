

<?php

use Inertia\Testing\AssertableInertia as Assert;

use function Pest\Laravel\get;

test("Users can access \"index\" route", function () {
    get(route('home'))
        ->assertStatus(200)
        ->assertSessionHasNoErrors()
        ->assertInertia(
            fn (Assert $page) => $page
                ->component('Index')
        );
});
