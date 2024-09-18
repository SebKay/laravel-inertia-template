<?php

namespace App\Http\Controllers;

use App\Http\Requests\Login\LoginStoreRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    public function show(Request $request)
    {
        $isProd = app()->environment('production');

        return inertia('Login/Show', [
            'email' => ! $isProd ? config('app.seed.emails.super', '') : '',
            'password' => ! $isProd ? '12345' : '',
            'remember' => ! $isProd ? true : false,
            'redirect' => $request->query('redirect', ''),
        ]);
    }

    public function store(LoginStoreRequest $request)
    {
        throw_if(
            ! auth()->attempt($request->only('email', 'password'), $request->only('remember')),
            ValidationException::withMessages([
                'email' => __('auth.failed'),
            ])
        );

        $request->session()->regenerate();

        if ($request->validated('redirect')) {
            return redirect()->to($request->validated('redirect'));
        }

        return redirect()->route('home');
    }
}
