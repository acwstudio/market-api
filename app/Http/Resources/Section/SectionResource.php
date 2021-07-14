<?php

namespace App\Http\Resources\Section;

use Illuminate\Http\Resources\Json\JsonResource;

class SectionResource extends JsonResource
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
            'type' => 'sections',
            'slug' => $this->slug,
            'attributes' => [
                'published' => $this->published,
                'name' => $this->name,
                'is_global' => $this->is_global,
                'config_key' => $this->config_key,
                'preview_image' => $this->preview_image,
                'group' => $this->group,
                'json_template' => $this->json_template,
                'created_at' => $this->created_at,
                'updated_at' => $this->created_at,
            ]
        ];
    }
}
