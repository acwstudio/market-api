<?php

namespace App\Http\Resources;

use App\Models\Format;
use Illuminate\Http\Resources\Json\JsonResource;

class FormatResource extends JsonResource
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
        /** @var Format $format */
        $format = $this->resource;

        $ret = [
            Format::FIELD_ID         => $format->getId(),
            'type'                   => self::$isFilterResource ? Format::VALUE_TYPE : 'formats',
            Format::FIELD_PUBLISHED  => $format->getPublished(),
            Format::FIELD_NAME       => $format->getName(),
            Format::FIELD_SLUG       => $format->getSlug(),
            Format::FIELD_CREATED_AT => $format->getCreatedAt(),
            Format::FIELD_UPDATED_AT => $format->getUpdatedAt(),
        ];
        
        if (self::$isFilterResource) {
            $ret['search'] = Format::VALUE_SEARCH;
        }
        
        return $ret;
    }
}
