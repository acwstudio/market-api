<?php

namespace App\Http\Resources\Site;

use App\Models\OrganizationSection;
use Illuminate\Http\Resources\Json\JsonResource;

class OrganizationSectionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        /** @var OrganizationSection $organizationSection */
        $organizationSection = $this->resource;

        return [
            OrganizationSection::FIELD_ORGANIZATION_ID     => $organizationSection->getOrganizationId(),
            'type'                               => 'organization-sections',
            OrganizationSection::FIELD_SECTION_ID     => $organizationSection->getSectionId(),
            OrganizationSection::FIELD_PUBLISHED      => $organizationSection->getPublished(),
            OrganizationSection::FIELD_TITLE          => $organizationSection->getTitle(),
            OrganizationSection::FIELD_SORT           => $organizationSection->getSort(),
            OrganizationSection::FIELD_JSON           => json_decode($organizationSection->getJson()),
            OrganizationSection::FIELD_CREATED_AT     => $organizationSection->getCreatedAt(),
            OrganizationSection::FIELD_UPDATED_AT     => $organizationSection->getUpdatedAt()
        ];
    }
}
