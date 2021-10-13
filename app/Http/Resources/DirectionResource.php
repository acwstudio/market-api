<?php

namespace App\Http\Resources;

use App\Models\Direction;
use Illuminate\Http\Resources\Json\JsonResource;

class DirectionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        /** @var Direction $direction */
        $direction = $this->resource;

        return [
            Direction::FIELD_ID            => $direction->getId(),
            'type'                         => 'directions',
            Direction::FIELD_PUBLISHED     => $direction->getPublished(),
            Direction::FIELD_NAME          => $direction->getName(),
            Direction::FIELD_SHOW_MAIN     => $direction->getShowMain(),
            Direction::FIELD_SORT          => $direction->getSort(),
            Direction::FIELD_PREVIEW_IMAGE => $direction->getPreviewImage(),
            Direction::FIELD_SLUG          => $direction->getSlug(),
            Direction::FIELD_CREATED_AT    => $direction->getCreatedAt(),
            Direction::FIELD_UPDATED_AT    => $direction->getUpdatedAt(),
            'product_count'                => $direction->products->count()
        ];
    }
}
