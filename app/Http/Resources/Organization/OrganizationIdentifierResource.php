<?php

namespace App\Http\Resources\Organization;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class OrganizationIdentifierResource
 * @package App\Http\Resources\Organization
 */
class OrganizationIdentifierResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'type' => 'organizations',
            'slug' => $this->slug
        ];
    }
}
