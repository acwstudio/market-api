<?php

namespace App\Http\Resources;

use App\Models\Direction;
use Illuminate\Http\Resources\Json\JsonResource;

class DirectionResource extends JsonResource
{
    public static $isFilterResource;

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

        $ret = [
            Direction::FIELD_ID            => $direction->id,
            'type'                         => self::$isFilterResource ? Direction::VALUE_TYPE : 'directions',
            Direction::FIELD_PUBLISHED     => $direction->published,
            Direction::FIELD_NAME          => $direction->name,
            Direction::FIELD_SHOW_MAIN     => $direction->show_main,
            Direction::FIELD_SORT          => $direction->sort,
            Direction::FIELD_PREVIEW_IMAGE => $direction->preview_image,
            Direction::FIELD_SLUG          => $direction->slug,
            Direction::FIELD_CREATED_AT    => $direction->created_at,
            Direction::FIELD_UPDATED_AT    => $direction->updated_at,
            'product_count'                => $direction->products->count()
        ];

        if (self::$isFilterResource) {
            $ret['search'] = Direction::VALUE_SEARCH;
        }

        return $ret;
    }
}
