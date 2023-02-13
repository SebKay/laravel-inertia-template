<?php

use App\Models\User;
use Illuminate\Support\Facades\Hash;

it('has a first name', function () {
    $firstName = 'Jim';

    $user = User::factory()->create([
        'first_name' => $firstName,
    ]);

    expect($user)->first_name->toBe($firstName);
});

it('has a last name', function () {
    $lastName = 'Gordon';

    $user = User::factory()->create([
        'last_name' => $lastName,
    ]);

    expect($user)->last_name->toBe($lastName);
});

it("can update it's password", function () {
    $user = User::factory()->create([
        'password' => 'oldPassword#123',
    ]);

    expect(Hash::check('oldPassword#123', $user->password))->toBeTrue();

    $user->updatePassword('newPassword#123');
    $user->refresh();

    expect(Hash::check('newPassword#123', $user->password))->toBeTrue();
});

it("doesn't update it's password if the value is empty", function () {
    $user = User::factory()->create([
        'password' => 'oldPassword#123',
    ]);

    expect(Hash::check('oldPassword#123', $user->password))->toBeTrue();

    $user->updatePassword('');
    $user->refresh();

    expect(Hash::check('oldPassword#123', $user->password))->toBeTrue();

    $user->updatePassword(null);
    $user->refresh();

    expect(Hash::check('oldPassword#123', $user->password))->toBeTrue();
});
