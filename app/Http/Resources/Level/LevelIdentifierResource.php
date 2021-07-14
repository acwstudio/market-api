<?php

namespace App\Http\Resources\Level;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class LevelIdentifierResource
 * @package App\Http\Resources\Level
 */
class LevelIdentifierResource extends JsonResource
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
            'type' => 'levels',
            'slug' => $this->slug
        ];
    }
}
