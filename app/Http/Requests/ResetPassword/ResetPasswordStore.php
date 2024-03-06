<?php

namespace App\Http\Requests\ResetPassword;

use Illuminate\Foundation\Http\FormRequest;

class ResetPasswordStore extends FormRequest
{
    public function rules()
    {
        return [
            'email' => ['required', 'email', 'exists:users'],
        ];
    }
}
