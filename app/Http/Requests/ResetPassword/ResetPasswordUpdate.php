<?php

namespace App\Http\Requests\ResetPassword;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class ResetPasswordUpdate extends FormRequest
{
    public function rules()
    {
        return [
            'email' => ['required', 'email', 'exists:users'],
            'token' => ['required'],
            'password_confirmation' => ['required', 'same:password'],
            'password' => [
                'required',
                Password::min(6)
                    ->mixedCase()
                    ->numbers()
                    ->symbols()
                    ->uncompromised(),
            ],
        ];
    }
}
