<?php

namespace App\Http\Controllers;

use App\Http\Requests\Login\LoginStoreRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    public function show(Request $request)
    {
        return inertia('Login/Show', app()->environment('local', 'testing') ? [
            'email' => config('app.seed.emails.super'),
            'password' => '12345',
            'remember' => true,
            'redirect' => $request->query('redirect', ''),
        ] : []);
    }

    public function store(LoginStoreRequest $request)
    {
        throw_if(
            ! auth()->guard()->attempt($request->only('email', 'password'), $request->only('remember')),
            ValidationException::withMessages([
                'email' => __('auth.failed'),
            ])
        );

        if ($request->validated('redirect')) {
            return redirect()->to($request->validated('redirect'));
        }

        return redirect()->route('home');
    }
}
