<?php

namespace App\Http\Resources\Format;

use Illuminate\Http\Resources\Json\ResourceCollection;

/**
 * Class FormatCollection
 * @package App\Http\Resources\Format
 */
class FormatCollection extends ResourceCollection
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
