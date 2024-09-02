<?php

use App\Models\User;
use Inertia\Testing\AssertableInertia as Assert;

use function Pest\Faker\fake;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\get;
use function Pest\Laravel\patch;

beforeEach(function () {
    $this->adminUser = User::factory()
        ->admin(fake()->email())
        ->create();

    $this->orgName = fake()->company();

    $this->adminUser->organisations()->create([
        'name' => $this->orgName,
    ]);

    $this->adminUser->organisation()->associate($this->adminUser->organisations->first())->save();
});

describe('Admins', function () {
    test('Can see the edit page for their current organisation', function () {
        actingAs($this->adminUser)
            ->get(route('organisation.edit'))
            ->assertOk()
            ->assertInertia(
                fn (Assert $page) => $page
                    ->component('Organisation/Edit')
            );
    });

    test("Can update their organisation's name", function () {
        expect($this->adminUser->organisation->name)->toBe($this->orgName);

        $data = [
            'name' => fake()->company(),
        ];

        actingAs($this->adminUser)
            ->fromRoute('organisation.edit')
            ->patch(route('organisation.update'), $data)
            ->assertSessionDoesntHaveErrors()
            ->assertRedirectToRoute('organisation.edit');

        expect($this->adminUser->organisation->refresh()->name)->toBe($data['name']);
    });
});

describe('Non-Admins', function () {
    test("Can't see the edit page for their organisation", function () {
        $user = User::factory()
            ->user(fake()->email())
            ->create();

        $user->organisations()->save($this->adminUser->organisation);
        $user->organisation()->associate($user->organisations->first())->save();

        actingAs($user)
            ->get(route('organisation.edit'))
            ->assertForbidden();
    });

    test("Can't update their organisation's name", function () {
        $user = User::factory()
            ->user(fake()->email())
            ->create();

        $user->organisations()->save($this->adminUser->organisation);
        $user->organisation()->associate($user->organisations->first())->save();

        expect($user->organisation->name)->toBe($this->orgName);

        actingAs($user)
            ->patch(route('organisation.update'), [
                'name' => 'New Name',
            ])
            ->assertForbidden();

        expect($user->organisation->refresh()->name)->toBe($this->orgName);
    });
});

describe('Guests', function () {
    test("Can't see the edit page of organisations", function () {
        get(route('organisation.edit'))
            ->assertRedirectToRoute('login');
    });

    test("Can't update organisations", function () {
        patch(route('organisation.edit'))
            ->assertRedirectToRoute('login');
    });
});
