<?php

namespace App\Http\Resources\Site;

use Illuminate\Http\Resources\Json\ResourceCollection;

class MainMenuCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'items' => $this->collection
        ];
    }
}
