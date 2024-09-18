<?php

namespace App\Http\Requests\Organisation;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class OrganisationEditRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Gate::allows('edit', $this->user()->organisation);
    }

    public function rules(): array
    {
        return [];
    }
}
