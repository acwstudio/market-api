<?php

declare(strict_types=1);

namespace App\Http\Resources;

use App\Models\Direction;
use App\Models\Format;
use App\Models\Landing;
use App\Models\Level;
use App\Models\Organization;
use Illuminate\Http\Resources\Json\JsonResource;

final class LandingResource extends JsonResource
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request): array
    {
        /** @var Landing $landing */
        $landing = $this->resource;

        FormatResource::$isFilterResource = true;
        LevelResource::$isFilterResource = true;
        DirectionResource::$isFilterResource = true;
        CityResource::$isFilterResource = true;
        OrganizationResource::$isFilterResource = true;

        return [
            Landing::FIELD_ID          => $landing->getAttribute(Landing::FIELD_ID),
            'type'                     => 'landings',
            Landing::FIELD_NAME        => $landing->getAttribute(Landing::FIELD_NAME),
            Landing::FIELD_SLUG        => $landing->getAttribute(Landing::FIELD_SLUG),
            Landing::FIELD_DESCRIPTION => $landing->getAttribute(Landing::FIELD_DESCRIPTION),
            Landing::FIELD_COLOR_BG    => $landing->getAttribute(Landing::FIELD_COLOR_BG),
            Landing::FIELD_IMAGE_SRC   => $landing->getAttribute(Landing::FIELD_IMAGE_SRC),
            Landing::FIELD_CREATED_AT  => $landing->getAttribute(Landing::FIELD_CREATED_AT),
            Landing::FIELD_UPDATED_AT  => $landing->getAttribute(Landing::FIELD_UPDATED_AT),
            'included'                 => [
                Landing::ENTITY_RELATIVE_FORMAT       => $landing->getAttribute(Landing::FIELD_IS_ALL_FORMS) ?
                    FormatResource::collection(Format::all()) :
                    FormatResource::collection($this->whenLoaded(Landing::ENTITY_RELATIVE_FORMATS)),

                Landing::ENTITY_RELATIVE_LEVEL        => $landing->getAttribute(Landing::FIELD_IS_ALL_LEVELS) ?
                    LevelResource::collection(Level::all()) :
                    LevelResource::collection($this->whenLoaded(Landing::ENTITY_RELATIVE_LEVELS)),

                Landing::ENTITY_RELATIVE_DIRECTION    => $landing->getAttribute(Landing::FIELD_IS_ALL_DIRECTIONS) ?
                    DirectionResource::collection(Direction::all()) :
                    DirectionResource::collection($this->whenLoaded(Landing::ENTITY_RELATIVE_DIRECTIONS)),

                Landing::ENTITY_RELATIVE_CITY         => $landing->getAttribute(Landing::FIELD_IS_ALL_CITIES) ?
                    CityResource::collection(Landing::ENTITY_RELATIVE_CITIES) :
                    CityResource::collection($this->whenLoaded(Landing::ENTITY_RELATIVE_CITIES)),

                Landing::ENTITY_RELATIVE_ORGANIZATION => $landing->getAttribute(Landing::FIELD_IS_ALL_ORGANIZATIONS) ?
                    OrganizationResource::collection(Organization::all()) :
                    OrganizationResource::collection($this->whenLoaded(Landing::ENTITY_RELATIVE_ORGANIZATIONS)),
            ],
        ];
    }
}
