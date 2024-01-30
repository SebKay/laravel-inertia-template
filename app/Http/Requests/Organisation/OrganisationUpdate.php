<?php

namespace App\Http\Requests\Organisation;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class OrganisationUpdate extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('update', $this->user()->organisation);
    }

    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:255'],
        ];
    }
}
