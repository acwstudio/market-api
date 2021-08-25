<?php

namespace App\Http\Resources;

use App\Models\Organization;
use Illuminate\Http\Resources\Json\JsonResource;

class OrganizationListResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        /** @var Organization $organization */
        $organization = $this;

        return [
            'id'            => $organization->id,
            'type'          => 'organizations',
            'published'     => $organization->published,
            'name'          => $organization->name,
            'slug'          => $organization->slug,
            'preview_image' => $organization->preview_image,
            'digital_image' => $organization->digital_image,
        ];
    }
}
