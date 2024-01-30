<?php

namespace App\Http\Controllers;

use App\Http\Requests\Organisation\OrganisationEdit;
use App\Http\Requests\Organisation\OrganisationUpdate;
use App\Http\Resources\OrganisationResource;

class OrganisationController extends Controller
{
    public function edit(OrganisationEdit $request)
    {
        return \inertia('Organisation/Edit', [
            'organisation' => OrganisationResource::make($request->user()->organisation),
        ]);
    }

    public function update(OrganisationUpdate $request)
    {
        $request->user()->organisation->update($request->only('name'));

        \session()->flash('message', \__('organisation.updated'));

        return \back();
    }
}
