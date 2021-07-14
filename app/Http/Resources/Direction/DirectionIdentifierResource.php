<?php

namespace App\Http\Resources\Direction;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class DirectionIdentifierResource
 * @package App\Http\Resources\Direction
 */
class DirectionIdentifierResource extends JsonResource
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
            'slug' => $this->slug
        ];
    }
}
