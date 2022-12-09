<?php

namespace App\Http\Controllers;

use App\Http\Requests\Account\AccountUpdate;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class AccountController extends Controller
{
    public function edit()
    {
        $user = UserResource::make(Auth::user());

        return Inertia::render('Account/Edit', [
            'first_name' => $user->first_name,
            'last_name'  => $user->last_name,
            'email'      => $user->email,
        ]);
    }

    public function update(AccountUpdate $request)
    {
        $request->user()->update($request->only('first_name', 'last_name', 'email'));

        return redirect()->route('account.edit')->with('notice', [
            'type'    => 'success',
            'message' => 'Your account has been updated.',
        ]);
    }
}
