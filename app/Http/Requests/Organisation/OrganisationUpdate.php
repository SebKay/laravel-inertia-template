<?php

namespace App\Http\Requests\Organisation;

use App\Enums\Permission;
use Illuminate\Foundation\Http\FormRequest;

class OrganisationUpdate extends FormRequest
{
    public function authorize()
    {
        return $this->user()->can(Permission::UPDATE_ORGANISATION->value);
    }

    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:255'],
        ];
    }
}
