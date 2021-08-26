<?php

namespace App\Http\Resources;

use App\Models\Organization;
use Illuminate\Http\Resources\Json\JsonResource;

class OrganizationDetailResource extends JsonResource
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
        $organization = $this->resource;

        return [
            'id'                => $organization->id,
            'type'              => 'organizations',
            'published'         => $organization->published,
            'name'              => $organization->name,
            'abbreviation_name' => $organization->abbreviation_name,
            'slug'              => $organization->slug,
            'land'              => $organization->land,
            'subtitle'          => $organization->subtitle,
            'description'       => $organization->description,
            'html_body'         => $organization->html_body,
            'logo_code'         => $organization->logo_code,
            'color_code_titles' => $organization->color_code_titles,
            'preview_image'     => $organization->preview_image,
            'digital_image'     => $organization->digital_image,
            'address'           => $organization->address,
            'type_text'         => $organization->type_text,
            'map_link'          => $organization->map_link,
            'parent_id'         => $organization->parent_id,
            'created_at'        => $organization->created_at,
            'updated_at'        => $organization->updated_at,
        ];
    }
}
