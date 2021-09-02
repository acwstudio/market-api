<?php

namespace App\Http\Resources;

use App\Models\Banner;
use Illuminate\Http\Resources\Json\JsonResource;

class BannerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        /** @var Banner $banner */
        $banner = $this->resource;

        return [
            Banner::FIELD_ID            => $banner->getId(),
            'type'                      => 'banners',
            Banner::FIELD_PUBLISHED     => $banner->getPublished(),
            Banner::FIELD_NAME          => $banner->getName(),
            Banner::FIELD_LINK          => $banner->getLink(),
            Banner::FIELD_IMAGE         => $banner->getImage(),
            Banner::FIELD_CREATED_AT    => $banner->getCreatedAt(),
            Banner::FIELD_UPDATED_AT    => $banner->getUpdatedAt(),
        ];
    }
}
