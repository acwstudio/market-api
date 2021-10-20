<?php

declare(strict_types=1);

namespace App\Http\Resources;

use App\Models\Organization;
use Illuminate\Http\Resources\Json\JsonResource;

final class OrganizationResource extends JsonResource
{
    public static $isFilterResource;

    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        /** @var Organization $organization */
        $organization = $this->resource;

        $ret = [
            Organization::FIELD_ID                => $organization->getField(Organization::FIELD_ID),
            'type'                                => self::$isFilterResource ? Organization::VALUE_TYPE : 'organizations',
            Organization::FIELD_PUBLISHED         => $organization->getField(Organization::FIELD_PUBLISHED),
            Organization::FIELD_NAME              => $organization->getField(Organization::FIELD_NAME),
            Organization::FIELD_ABBREVIATION_NAME => $organization->getField(Organization::FIELD_ABBREVIATION_NAME),
            Organization::FIELD_SLUG              => $organization->getField(Organization::FIELD_SLUG),
            Organization::FIELD_LAND              => $organization->getField(Organization::FIELD_LAND),
            Organization::FIELD_SUBTITLE          => $organization->getField(Organization::FIELD_SUBTITLE),
            Organization::FIELD_DESCRIPTION       => $organization->getField(Organization::FIELD_DESCRIPTION),
            Organization::FIELD_HTML_BODY         => $organization->getField(Organization::FIELD_HTML_BODY),
            Organization::FIELD_LOGO_CODE         => $organization->getField(Organization::FIELD_LOGO_CODE),
            Organization::FIELD_LOGO              => $organization->getField(Organization::FIELD_LOGO),
            Organization::FIELD_COLOR_CODE_TITLES => $organization->getField(Organization::FIELD_COLOR_CODE_TITLES),
            Organization::FIELD_PREVIEW_IMAGE     => $organization->getField(Organization::FIELD_PREVIEW_IMAGE),
            Organization::FIELD_DIGITAL_IMAGE     => $organization->getField(Organization::FIELD_DIGITAL_IMAGE),
            Organization::FIELD_ADDRESS           => $organization->getField(Organization::FIELD_ADDRESS),
            Organization::FIELD_TYPE_TEXT         => $organization->getField(Organization::FIELD_TYPE_TEXT),
            Organization::FIELD_MAP_LINK          => $organization->getField(Organization::FIELD_MAP_LINK),
            Organization::FIELD_PARENT_ID         => $organization->getField(Organization::FIELD_PARENT_ID),
            Organization::FIELD_CITY_ID           => $organization->getField(Organization::FIELD_CITY_ID),
            Organization::FIELD_CREATED_AT        => $organization->getField(Organization::FIELD_CREATED_AT),
            Organization::FIELD_UPDATED_AT        => $organization->getField(Organization::FIELD_UPDATED_AT),
            'included'                            => [
                Organization::ENTITY_RELATIVE_CITY     => CityResource::make($this->whenLoaded(Organization::ENTITY_RELATIVE_CITY)),
                Organization::ENTITY_RELATIVE_PERSONS  => PersonResource::collection($this->whenLoaded(Organization::ENTITY_RELATIVE_PERSONS)),
                Organization::ENTITY_RELATIVE_TRIGGERS => OrganizationTriggerResource::collection($this->whenLoaded(Organization::ENTITY_RELATIVE_TRIGGERS)),
            ]
        ];

        if (self::$isFilterResource) {
            $ret['search'] = Organization::VALUE_SEARCH;
        }

        return $ret;
    }
}
