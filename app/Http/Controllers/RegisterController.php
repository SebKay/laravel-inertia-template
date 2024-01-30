<?php

namespace App\Http\Controllers;

use App\Enums\Role;
use App\Http\Requests\Register\RegisterStore;
use App\Models\User;
use Illuminate\Auth\Events\Registered;

class RegisterController extends Controller
{
    public function show()
    {
        return \inertia('Register/Show', \app()->environment('local') ? [
            'first_name' => 'Jim',
            'last_name' => 'Gordon',
            'email' => 'test@test.com',
            'password' => '123456Ab#',
            'organisation_name' => 'GCPD',
        ] : []);
    }

    public function store(RegisterStore $request)
    {
        $user = new User($request->only('first_name', 'last_name', 'email'));

        $user->password = $request->validated('password');
        $user->save();

        $org = $user->organisations()->create([
            'name' => $request->validated('organisation_name'),
        ]);
        $org->users()->attach($user);
        $user->organisation()->associate($org)->save();

        $user->assignRole(Role::USER->value);

        \auth()->loginUsingId($user->id);

        \event(new Registered($user));

        return \redirect()->route('home');
    }
}
