<?php

namespace App\Http\Resources\Site;

use App\Models\ProductSection;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductSectionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        /** @var ProductSection $productSection */
        $productSection = $this->resource;

        return [
            ProductSection::FIELD_PRODUCT_ID     => $productSection->getProductId(),
            'type'                               => 'product-sections',
            ProductSection::FIELD_SECTION_ID     => $productSection->getSectionId(),
            ProductSection::FIELD_PUBLISHED      => $productSection->getPublished(),
            ProductSection::FIELD_TITLE          => $productSection->getTitle(),
            ProductSection::FIELD_IS_HIDE_ANCHOR => $productSection->getIsHideAnchor(),
            ProductSection::FIELD_SORT           => $productSection->getSort(),
            ProductSection::FIELD_JSON           => json_decode($productSection->getJson()),
            ProductSection::FIELD_CREATED_AT     => $productSection->getCreatedAt(),
            ProductSection::FIELD_UPDATED_AT     => $productSection->getUpdatedAt()
        ];
    }
}
