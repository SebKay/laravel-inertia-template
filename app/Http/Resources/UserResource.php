<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'         => $this->id,
            'email'      => $this->whenHas('email'),
            'first_name' => $this->whenHas('first_name'),
            'last_name'  => $this->whenHas('last_name'),
            'can'        => $this->all_permissions,
        ];
    }
}
