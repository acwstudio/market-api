<?php

namespace App\Http\Resources;

use App\Models\Person;
use Illuminate\Http\Resources\Json\JsonResource;

class PersonResource extends JsonResource
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
            Person::FIELD_ID            => $person->getId(),
            'type'                      => 'persons',
            Person::FIELD_PUBLISHED     => $person->getPublished(),
            Person::FIELD_NAME          => $person->getName(),
            Person::FIELD_POSITION      => $person->getPosition(),
            Person::FIELD_SHOW_MAIN     => $person->getShowMain(),
            Person::FIELD_DESCRIPTION   => $person->getDescription(),
            Person::FIELD_PREVIEW_IMAGE => $person->getPreviewImage(),
            Person::FIELD_CREATED_AT    => $person->getCreatedAt(),
            Person::FIELD_UPDATED_AT    => $person->getUpdatedAt(),
        ];
    }
}
