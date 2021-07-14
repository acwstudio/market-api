<?php

namespace App\Http\Resources\Person;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class PersonResource
 * @package App\Http\Resources\Person
 */
class PersonResource extends JsonResource
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
            'type' => 'persons',
            'slug' => $this->slug,
            'attributes' => [
                'published' => $this->published,
                'name' => $this->name,
                'position' => $this->position,
                'show_main' => $this->show_main,
                'description' => $this->description,
                'preview_image' => $this->preview_image,
                'created_at' => $this->created_at,
                'updated_at' => $this->updated_at
            ]
        ];
    }
}
