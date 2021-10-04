<?php

namespace App\Http\Resources\Site;

use App\Models\EntitySection;
use Illuminate\Http\Resources\Json\JsonResource;

class EntitySectionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        /** @var EntitySection $entitySection */
        $entitySection = $this->resource;
        $entityType = explode('\\', $entitySection->getEntityType());

        return [
            EntitySection::FIELD_ENTITY_ID   => $entitySection->getEntityId(),
            EntitySection::FIELD_ENTITY_TYPE => lcfirst(array_pop($entityType)),
            'type'                           => 'entity-sections',
            EntitySection::FIELD_SECTION_ID  => $entitySection->getSectionId(),
            EntitySection::FIELD_PUBLISHED   => $entitySection->getPublished(),
            EntitySection::FIELD_TITLE       => $entitySection->getTitle(),
            EntitySection::FIELD_SORT        => $entitySection->getSort(),
            EntitySection::FIELD_JSON        => json_decode($entitySection->getJson()),
            EntitySection::FIELD_CREATED_AT  => $entitySection->getCreatedAt(),
            EntitySection::FIELD_UPDATED_AT  => $entitySection->getUpdatedAt()
        ];
    }
}
