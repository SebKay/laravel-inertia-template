<?php

namespace App\Http\Controllers;

use App\Enums\Role;
use App\Http\Requests\Register\RegisterStoreRequest;
use App\Models\User;

class RegisterController extends Controller
{
    public function show()
    {
        return inertia('Register/Show', app()->environment('local', 'testing') ? [
            'first_name' => 'Jim',
            'last_name' => 'Gordon',
            'email' => 'test@test.com',
            'password' => '123456Ab#',
        ] : []);
    }

    public function store(RegisterStoreRequest $request)
    {
        $user = new User($request->only('first_name', 'last_name', 'email'));

        $user->password = $request->validated('password');
        $user->save();

        $user->assignRole(Role::USER->value);

        auth()->guard()->loginUsingId($user->id);

        return redirect()->route('home');
    }
}
