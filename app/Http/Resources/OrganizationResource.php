<?php

declare(strict_types=1);

namespace App\Http\Resources;

use App\Models\Organization;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

final class OrganizationResource extends JsonResource
{
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

        return [
            Organization::FIELD_ID                => $organization->id,
            'type'                                => 'organizations',
            Organization::FIELD_PUBLISHED         => $organization->published,
            Organization::FIELD_NAME              => $organization->name,
            Organization::FIELD_ABBREVIATION_NAME => $organization->abbreviation_name,
            Organization::FIELD_SLUG              => $organization->slug,
            Organization::FIELD_LAND              => $organization->land,
            Organization::FIELD_SUBTITLE          => $organization->subtitle,
            Organization::FIELD_DESCRIPTION       => $organization->description,
            Organization::FIELD_HTML_BODY         => $organization->html_body,
            Organization::FIELD_LOGO_CODE         => $organization->logo_code,
            Organization::FIELD_LOGO              => Storage::url($organization->preview_image),
            Organization::FIELD_COLOR_CODE_TITLES => $organization->color_code_titles,
            Organization::FIELD_PREVIEW_IMAGE     => Storage::url($organization->preview_image),
            Organization::FIELD_DIGITAL_IMAGE     => Storage::url($organization->digital_image),
            Organization::FIELD_ADDRESS           => $organization->address,
            Organization::FIELD_TYPE_TEXT         => $organization->type_text,
            Organization::FIELD_MAP_LINK          => $organization->map_link,
            Organization::FIELD_PARENT_ID         => $organization->parent_id,
            Organization::FIELD_CITY_ID           => $organization->city_id,
            Organization::FIELD_CREATED_AT        => $organization->created_at,
            Organization::FIELD_UPDATED_AT        => $organization->updated_at,
            'included'                            => [
                Organization::ENTITY_RELATIVE_CITY    => CityResource::make($this->whenLoaded(Organization::ENTITY_RELATIVE_CITY)),
                Organization::ENTITY_RELATIVE_PERSONS => PersonResource::collection($this->whenLoaded(Organization::ENTITY_RELATIVE_PERSONS)),
            ]
        ];
    }
}
