<?php

use App\Models\User;
use Database\Seeders\RolesAndPermissionsSeeder;
use Illuminate\Support\Facades\Hash;

it("can get it's \"full_name\" correctly", function () {
    $user = User::factory()->create([
        'first_name' => 'John',
        'last_name' => 'Doe',
    ]);

    expect($user->full_name)->toBe('John Doe');
});

it("can update it's password", function () {
    $user = User::factory()->create([
        'password' => 'oldPassword#123',
    ]);

    expect(Hash::check('oldPassword#123', $user->password))->toBeTrue();

    $user->updatePassword('newPassword#123');

    expect(Hash::check('newPassword#123', $user->refresh()->password))->toBeTrue();
});

it("doesn't update it's password if the value is empty", function () {
    $user = User::factory()->create([
        'password' => 'oldPassword#123',
    ]);

    expect(Hash::check('oldPassword#123', $user->password))->toBeTrue();

    $user->updatePassword('');

    expect(Hash::check('oldPassword#123', $user->refresh()->password))->toBeTrue();

    $user->updatePassword(null);

    expect(Hash::check('oldPassword#123', $user->refresh()->password))->toBeTrue();
});

describe('With Roles and Permissions', function () {
    beforeEach(function () {
        $this->seed(RolesAndPermissionsSeeder::class);
    });

    it("can only access Filament if it's a \"super-admin\"", function () {
        $superAdminUser = User::factory()->superAdmin()->create();
        $adminUser = User::factory()->admin()->create();

        expect($superAdminUser->canAccessPanel())->toBeTrue();
        expect($adminUser->canAccessPanel())->toBeFalse();
    });

    it("uses it's full name for use in Filament", function () {
        $user = User::factory()->create();

        expect($user->getFilamentName())->toBe($user->full_name);
    });
});
