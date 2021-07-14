<?php

namespace App\Http\Resources\Direction;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class DirectionResource
 * @package App\Http\Resources\Direction
 */
class DirectionResource extends JsonResource
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
            'type' => 'directions',
            'slug' => $this->slug,
            'attributes' => [
                'published' => $this->published,
                'name' => $this->name,
                'show_main' => $this->published,
                'sort' => $this->sort,
                'preview_image' => $this->preview_image,
                'created_at' => $this->created_at,
                'updated_at' => $this->updated_at,
            ]
        ];
    }
}
