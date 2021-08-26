<?php

namespace App\Http\Resources;

use App\Models\Person;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin \App\Models\Person */
class PersonListResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        /** @var Person $person */
        $person = $this->resource;

        return [
            'id'              => $this->id,
            'type'            => 'persons',
            'published'       => $person->published,
            'name'            => $person->name,
            'show_main'       => $person->show_main,
            'getPreviewImage' => $person->preview_image,
        ];
    }
}
