<?php

namespace App\Http\Resources\Level;

use Illuminate\Http\Resources\Json\ResourceCollection;

/**
 * Class LevelCollection
 * @package App\Http\Resources\Level
 */
class LevelCollection extends ResourceCollection
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
