<?php

namespace App\Http\Resources\Format;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class FormatIdentifierResource
 * @package App\Http\Resources\Format
 */
class FormatIdentifierResource extends JsonResource
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
            'type' => 'formats',
            'slug' => $this->slug
        ];
    }
}
