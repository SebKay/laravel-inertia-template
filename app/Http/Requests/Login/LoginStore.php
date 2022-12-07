<?php

namespace App\Http\Requests\Login;

use Illuminate\Foundation\Http\FormRequest;

class LoginStore extends FormRequest
{
    public function rules()
    {
        return [
            'email'    => ['required', 'email', 'exists:users'],
            'password' => ['required'],
            'remember' => ['boolean'],
            'redirect' => ['nullable', 'string'],
        ];
    }
}
