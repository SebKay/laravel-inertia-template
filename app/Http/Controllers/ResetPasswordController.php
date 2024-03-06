<?php

namespace App\Http\Controllers;

use App\Http\Requests\ResetPassword\ResetPasswordStore;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\ValidationException;

class ResetPasswordController extends Controller
{
    public function show(Request $request)
    {
        return \inertia('ResetPassword/Show');
    }

    public function store(ResetPasswordStore $request)
    {
        $status = Password::sendResetLink($request->only('email'));

        if ($status !== Password::RESET_LINK_SENT) {
            throw ValidationException::withMessages([
                'reset_link' => \__($status),
            ]);
        }

        \session()->flash('message', \__('passwords.sent'));

        return \redirect()->route('login');
    }
}
