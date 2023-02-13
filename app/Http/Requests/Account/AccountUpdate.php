<?php

namespace App\Http\Requests\Account;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class AccountUpdate extends FormRequest
{
    public function rules()
    {
        return [
            'first_name' => ['required', 'sometimes', 'string', 'max:255'],
            'last_name' => ['required', 'sometimes', 'string', 'max:255'],
            'email' => ['required', 'sometimes', 'email', 'unique:users,email,'.\auth()->id()],
            'password' => [
                'nullable',
                Password::min(6)
                    ->mixedCase()
                    ->numbers()
                    ->symbols()
                    ->uncompromised(),
            ],
        ];
    }
}
