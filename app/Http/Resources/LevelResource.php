<?php

namespace App\Http\Resources;

use App\Models\Level;
use Illuminate\Http\Resources\Json\JsonResource;

class LevelResource extends JsonResource
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
        /** @var Level $level */
        $level = $this->resource;

        $ret = [
            Level::FIELD_ID         => $level->getId(),
            'type'                  => self::$isFilterResource ? Level::VALUE_TYPE : 'levels',
            Level::FIELD_PUBLISHED  => $level->getPublished(),
            Level::FIELD_NAME       => $level->getName(),
            Level::FIELD_SLUG       => $level->getSlug(),
            Level::FIELD_CREATED_AT => $level->getCreatedAt(),
            Level::FIELD_UPDATED_AT => $level->getUpdatedAt(),
        ];
        
        if (self::$isFilterResource) {
            $ret['search'] = Level::VALUE_SEARCH;
        }
        
        return $ret;
    }
}
