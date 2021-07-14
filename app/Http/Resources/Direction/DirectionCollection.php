<?php

namespace App\Http\Resources\Direction;

use Illuminate\Http\Resources\Json\ResourceCollection;

/**
 * Class DirectionCollection
 * @package App\Http\Resources\Direction
 */
class DirectionCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return parent::toArray($request);
    }
}
