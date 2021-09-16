<?php

namespace App\Http\Resources;

use App\Models\Level;
use Illuminate\Http\Resources\Json\JsonResource;

class LevelResource extends JsonResource
{
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

        return [
            Level::FIELD_ID         => $level->getId(),
            'type'                  => 'levels',
            Level::FIELD_PUBLISHED  => $level->getPublished(),
            Level::FIELD_NAME       => $level->getName(),
            Level::FIELD_SLUG       => $level->getSlug(),
            Level::FIELD_CREATED_AT => $level->getCreatedAt(),
            Level::FIELD_UPDATED_AT => $level->getUpdatedAt(),
        ];
    }
}
