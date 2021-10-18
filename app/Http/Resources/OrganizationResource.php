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
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        /** @var Organization $organization */
        $organization = $this->resource;
        
        $ret = [
            Organization::FIELD_ID                => $organization->getId(),
            'type'                                => self::$isFilterResource ? Organization::VALUE_TYPE : 'organizations',
            Organization::FIELD_PUBLISHED         => $organization->getPublished(),
            Organization::FIELD_NAME              => $organization->getName(),
            Organization::FIELD_ABBREVIATION_NAME => $organization->getAbbreviationName(),
            Organization::FIELD_SLUG              => $organization->getSlug(),
            Organization::FIELD_LAND              => $organization->getLand(),
            Organization::FIELD_SUBTITLE          => $organization->getSubtitle(),
            Organization::FIELD_DESCRIPTION       => $organization->getDescription(),
            Organization::FIELD_HTML_BODY         => $organization->getHtmlBody(),
            Organization::FIELD_LOGO_CODE         => $organization->getLogoCode(),
            Organization::FIELD_LOGO              => $organization->getPreviewImage(),
            Organization::FIELD_COLOR_CODE_TITLES => $organization->getColorCodeTitles(),
            Organization::FIELD_PREVIEW_IMAGE     => $organization->getPreviewImage(),
            Organization::FIELD_DIGITAL_IMAGE     => $organization->getDigitalImage(),
            Organization::FIELD_ADDRESS           => $organization->getAddress(),
            Organization::FIELD_TYPE_TEXT         => $organization->getTypeText(),
            Organization::FIELD_MAP_LINK          => $organization->getMapLink(),
            Organization::FIELD_PARENT_ID         => $organization->getParentId(),
            Organization::FIELD_CITY_ID           => $organization->getCityId(),
            Organization::FIELD_CREATED_AT        => $organization->getCreatedAt(),
            Organization::FIELD_UPDATED_AT        => $organization->getUpdatedAt(),
            'included'                            => [
                Organization::ENTITY_RELATIVE_CITY    => CityResource::make($this->whenLoaded(Organization::ENTITY_RELATIVE_CITY)),
                Organization::ENTITY_RELATIVE_PERSONS => PersonResource::collection($this->whenLoaded(Organization::ENTITY_RELATIVE_PERSONS)),
            ]
        ];
        
        if (self::$isFilterResource) {
            $ret['search'] = Organization::VALUE_SEARCH;
        }
        
        return $ret;
    }
}
