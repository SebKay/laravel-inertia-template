<?php

namespace App\Http\Controllers;

use App\Http\Requests\Account\AccountUpdate;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function edit(Request $request)
    {
        return \inertia()->render('Account/Edit', [
            'user' => UserResource::make($request->user()),
        ]);
    }

    public function update(AccountUpdate $request)
    {
        $request->user()->update($request->only('first_name', 'last_name', 'email'));
        $request->user()->updatePassword($request->validated('password'));

        \session()->flash('message', 'Your account has been updated.');

        return \redirect()->back();
    }
}
