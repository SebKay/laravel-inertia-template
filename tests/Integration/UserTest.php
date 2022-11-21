<?php

use App\Models\User;

it("has a name", function () {
    $user = User::factory()->create([
        'name' => 'Jim Gordon',
    ]);

    expect($user->name)->toBe('Jim Gordon');
});
