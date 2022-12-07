<?php

use App\Models\User;

it("has a first and last name", function () {
    $firstName = 'Jim';
    $lastName  = 'Gordon';

    $user = User::factory()->create([
        'first_name' => $firstName,
        'last_name'  => $lastName,
    ]);

    expect($user)
        ->first_name->toBe($firstName)
        ->last_name->toBe($lastName);
});
