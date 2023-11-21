<?php

namespace App\Http\Requests\Organisation;

use Illuminate\Foundation\Http\FormRequest;

class OrganisationUpdate extends FormRequest
{
    public function authorize()
    {
        return $this->user()->can('update-organisation');
    }

    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:255'],
        ];
    }
}
