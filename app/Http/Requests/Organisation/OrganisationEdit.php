<?php

namespace App\Http\Requests\Organisation;

use Illuminate\Foundation\Http\FormRequest;

class OrganisationEdit extends FormRequest
{
    public function authorize()
    {
        return $this->user()->can('manage-organisation');
    }
}
