<?php

namespace App\Http\Resources;

use App\Models\Product;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        /** @var Product $product */
        $product = $this->resource;

        $resource = [
            Product::FIELD_ID                          => $product->getId(),
            Product::FIELD_IS_MODERATED                => $product->getIsModerated(),
            Product::FIELD_LAND                        => $product->getLand(),
            Product::FIELD_PUBLISHED                   => $product->getPublished(),
            Product::FIELD_EXPIRATION_DATE             => $product->getExpirationDate(),
            Product::FIELD_NAME                        => $product->getName(),
            Product::FIELD_SLUG                        => $product->getSlug(),
            Product::FIELD_PREVIEW_IMAGE               => $product->getPreviewImage(),
            Product::FIELD_DIGITAL_IMAGE               => $product->getDigitalImage(),
            Product::FIELD_PRICE                       => $product->getPrice(),
            Product::FIELD_START_DATE                  => $product->getStartDate(),
            Product::FIELD_IS_EMPLOYMENT               => $product->getIsEmployment(),
            Product::FIELD_IS_INSTALLMENT              => $product->getIsInstallment(),
            Product::FIELD_INSTALLMENT_MONTHS          => $product->getInstallmentMonths(),
            Product::FIELD_IS_DOCUMENT                 => $product->getIsDocument(),
            Product::FIELD_DOCUMENT                    => $product->getDocument(),
            Product::FIELD_TRIGGERS                    => $product->getTriggers(),
            Product::FIELD_BEGIN_DURATION              => $product->getBeginDuration(),
            Product::FIELD_BEGIN_DURATION_FORMAT_VALUE => $product->getBeginDurationFormatValue(),
            Product::FIELD_DURATION                    => $product->getDuration(),
            Product::FIELD_DURATION_FORMAT_VALUE       => $product->getDurationFormatValue(),
            Product::FIELD_DESCRIPTION                 => $product->getDescription(),
            Product::FIELD_COLOR                       => $product->getColor(),
            Product::FIELD_ORGANIZATION_ID             => $product->getOrganizationId(),
            Product::FIELD_CATEGORY_ID                 => $product->getCategoryId(),
            Product::FIELD_USER_ID                     => $product->getUserId(),
            'type'                                     => 'products',
            'included'                                 => [
                Product::ENTITY_RELATIVE_ORGANIZATION => OrganizationResource::make($this->whenLoaded('organization')),
                Product::ENTITY_RELATIVE_LEVELS       => LevelResource::collection($this->whenLoaded('levels')),
                Product::ENTITY_RELATIVE_DIRECTIONS   => DirectionResource::collection($this->whenLoaded('directions')),
                Product::ENTITY_RELATIVE_FORMATS      => FormatResource::collection($this->whenLoaded('formats')),
                Product::ENTITY_RELATIVE_CITY         => CityResource::collection($this->whenLoaded('organization.city')),
            ]
        ];

        return $resource;
    }
}
