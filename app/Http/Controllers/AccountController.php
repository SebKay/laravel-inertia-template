<?php

namespace App\Http\Controllers;

use App\Http\Requests\Account\AccountUpdate;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function edit(Request $request)
    {
        $user = UserResource::make($request->user());

        return \inertia()->render('Account/Edit', [
            'first_name' => $user->first_name,
            'last_name'  => $user->last_name,
            'email'      => $user->email,
        ]);
    }

    public function update(AccountUpdate $request)
    {
        $user = $request->user();

        $user->update($request->only('first_name', 'last_name', 'email'));
        $user->updatePassword($request->validated('password'));

        return redirect()->back()->with('notice', [
            'type'    => 'success',
            'message' => 'Your account has been updated.',
        ]);
    }
}
