<?php

namespace App\Http\Resources;

use App\Models\Person;
use Illuminate\Http\Resources\Json\JsonResource;

class PersonDetailResource extends JsonResource
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
        $person = $this;

        return [
            'id' => $person->id,
            'type' => 'persons',
            'published' => $person->published,
            'name' => $person->name,
            'position' => $person->position,
            'show_main' => $person->show_main,
            'description' => $person->description,
            'preview_image' => $person->preview_image,
            'created_at' => $person->created_at,
            'updated_at' => $person->updated_at,
        ];
    }
}
