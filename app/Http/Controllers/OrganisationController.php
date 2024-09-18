<?php

namespace App\Http\Controllers;

use App\Http\Requests\Organisation\OrganisationEditRequest;
use App\Http\Requests\Organisation\OrganisationUpdateRequest;
use App\Http\Resources\OrganisationResource;

class OrganisationController extends Controller
{
    public function edit(OrganisationEditRequest $request)
    {
        return inertia('Organisation/Edit', [
            'organisation' => OrganisationResource::make($request->user()->organisation),
        ]);
    }

    public function update(OrganisationUpdateRequest $request)
    {
        $request->user()->organisation->update($request->only('name'));

        session()->flash('success', __('organisation.updated'));

        return back();
    }
}
