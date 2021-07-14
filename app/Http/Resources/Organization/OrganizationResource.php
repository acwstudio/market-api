<?php

namespace App\Http\Resources\Organization;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class OrganizationResource
 * @package App\Http\Resources\Organization
 */
class OrganizationResource extends JsonResource
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
            'slug' => $this->slug,
            'attributes' => [
                'published' => $this->published,
                'name' => $this->name,
                'land' => $this->land,
                'subtitle' => $this->subtitle,
                'description' => $this->description,
                'html_body' => $this->html_body,
                'classes' => $this->classes,
                'logo_code' => $this->logo_code,
                'color_code_titles' => $this->color_code_titles,
                'preview_image' => $this->preview_image,
                'digital_image' => $this->digital_image,
                'address' => $this->address,
                'type_text' => $this->type_text,
                'map_link' => $this->map_link,
                'parent_id' => $this->parent_id,
                'created_at' => $this->created_at,
                'updated_at' => $this->updated_at,
            ]
        ];
    }
}
