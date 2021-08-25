<?php

namespace App\Http\Resources;

use App\Models\Direction;
use Illuminate\Http\Resources\Json\JsonResource;

class DirectionDetailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        /** @var Direction $direction */
        $direction = $this;

        return [
            'id'            => $direction->id,
            'type'          => 'type',
            'published'     => $direction->published,
            'name'          => $direction->name,
            'show_main'     => $direction->show_main,
            'sort'          => $direction->sort,
            'preview_image' => $direction->preview_image,
            'slug'          => $direction->slug,
            'created_at'    => $direction->created_at,
            'updated_at'    => $direction->updated_at,
        ];
    }
}
