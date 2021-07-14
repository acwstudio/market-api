<?php

namespace App\Http\Resources\Format;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class FormatResource
 * @package App\Http\Resources\Format
 */
class FormatResource extends JsonResource
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
            'type' => 'subjects',
            'slug' => $this->slug,
            'attributes' => [
                'id' => $this->id,
                'published' => $this->published,
                'name' => $this->name,
                'created_at' => $this->created_at,
                'updated_at' => $this->updated_at,
            ]
        ];
    }
}
