<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DirectionListResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $direction = $this;

        return [
            'id'              => $direction->id,
            'type'            => 'directions',
            'published'       => $direction->published,
            'name'            => $direction->name,
            'show_main'       => $direction->show_main,
            'getPreviewImage' => $direction->preview_image,
        ];
    }
}
