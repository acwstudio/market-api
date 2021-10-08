<?php

namespace App\Http\Resources;

use App\Models\Landing;
use Illuminate\Http\Resources\Json\JsonResource;

class LandingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        /** @var Landing $landing */
        $landing = $this->resource;

        return [
            Landing::FIELD_ID          => $landing->getId(),
            'type'                     => 'landings',
            Landing::FIELD_NAME        => $landing->getName(),
            Landing::FIELD_SLUG        => $landing->getSlug(),
            Landing::FIELD_DESCRIPTION => $landing->getDescription(),
            Landing::FIELD_COLOR_BG    => $landing->getColorBg(),
            Landing::FIELD_IMAGE_SRC   => $landing->getImageSrc(),
            Landing::FIELD_CREATED_AT  => $landing->getCreatedAt(),
            Landing::FIELD_UPDATED_AT  => $landing->getUpdatedAt(),
            'included'                 => [
                Landing::ENTITY_RELATIVE_FORMATS       => FormatResource::collection($this->whenLoaded(Landing::ENTITY_RELATIVE_FORMATS)),
                Landing::ENTITY_RELATIVE_LEVELS        => LevelResource::collection($this->whenLoaded(Landing::ENTITY_RELATIVE_LEVELS)),
                Landing::ENTITY_RELATIVE_DIRECTIONS    => DirectionResource::collection($this->whenLoaded(Landing::ENTITY_RELATIVE_DIRECTIONS)),
                Landing::ENTITY_RELATIVE_CITIES        => CityResource::collection($this->whenLoaded(Landing::ENTITY_RELATIVE_CITIES)),
                Landing::ENTITY_RELATIVE_ORGANIZATIONS => OrganizationResource::collection($this->whenLoaded(Landing::ENTITY_RELATIVE_ORGANIZATIONS))
            ]
        ];
    }
}
