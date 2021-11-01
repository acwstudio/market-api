<?php

namespace App\Http\Resources;

use App\Models\Banner;
use Illuminate\Http\Resources\Json\JsonResource;

class BannerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        /** @var Banner $banner */
        $banner = $this->resource;

        return [
            Banner::FIELD_ID                 => $banner->getId(),
            'type'                           => 'banners',
            Banner::FIELD_PUBLISHED          => $banner->getPublished(),
            Banner::FIELD_NAME               => $banner->getName(),
            Banner::FIELD_NAME_SECOND        => $banner->getNameSecond(),
            Banner::FIELD_LINK               => $banner->getLink(),
            Banner::FIELD_BANNER_TYPE        => $banner->getBannerType(),
            Banner::FIELD_COLOR_BG           => $banner->getColorBg(),
            Banner::FIELD_COLOR_TEXT         => $banner->getColorText(),
            Banner::FIELD_COLOR_BG_LIST      => $banner->getColorBgList(),
            Banner::FIELD_COLOR_TEXT_LIST    => $banner->getColorTextList(),
            Banner::FIELD_DESCRIPTION        => $banner->getDescription(),
            Banner::FIELD_IMAGE              => $banner->getImage(),
            Banner::FIELD_IMAGE_TABLET       => $banner->getImageTablet(),
            Banner::FIELD_IMAGE_MOBILE_PHONE => $banner->getImageMobilPhone(),
            Banner::FIELD_CREATED_AT         => $banner->getCreatedAt(),
            Banner::FIELD_UPDATED_AT         => $banner->getUpdatedAt(),
        ];
    }
}
