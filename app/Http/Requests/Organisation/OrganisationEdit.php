<?php

namespace App\Http\Requests\Organisation;

use App\Enums\Permission;
use Illuminate\Foundation\Http\FormRequest;

class OrganisationEdit extends FormRequest
{
    public function authorize()
    {
        return $this->user()->can(Permission::EDIT_ORGANISATION->value);
    }
}
