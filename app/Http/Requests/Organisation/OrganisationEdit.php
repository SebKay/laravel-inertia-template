<?php

namespace App\Http\Requests\Organisation;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class OrganisationEdit extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('edit', $this->user()->currentOrganisation);
    }
}
