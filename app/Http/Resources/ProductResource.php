<?php

declare(strict_types=1);

namespace App\Http\Resources;

use App\Models\Organization;
use App\Models\Product;
use Illuminate\Http\Resources\Json\JsonResource;

final class ProductResource extends JsonResource
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request): array
    {
        /** @var Product $product */
        $product = $this->resource;

        return [
            Product::FIELD_ID                          => $product->getField(Product::FIELD_ID),
            Product::FIELD_IS_MODERATED                => $product->getField(Product::FIELD_IS_MODERATED),
            Product::FIELD_LAND                        => $product->getField(Product::FIELD_LAND),
            Product::FIELD_PUBLISHED                   => $product->getField(Product::FIELD_PUBLISHED),
            Product::FIELD_EXPIRATION_DATE             => $product->getField(Product::FIELD_EXPIRATION_DATE),
            Product::FIELD_NAME                        => $product->getField(Product::FIELD_NAME),
            Product::FIELD_SLUG                        => $product->getField(Product::FIELD_SLUG),
            Product::FIELD_PREVIEW_IMAGE               => $product->getField(Product::FIELD_PREVIEW_IMAGE),
            Product::FIELD_DIGITAL_IMAGE               => $product->getField(Product::FIELD_DIGITAL_IMAGE),
            Product::FIELD_PRICE                       => $product->getField(Product::FIELD_PRICE),
            Product::FIELD_START_DATE                  => $product->getField(Product::FIELD_START_DATE),
            Product::FIELD_IS_EMPLOYMENT               => $product->getField(Product::FIELD_IS_EMPLOYMENT),
            Product::FIELD_IS_INSTALLMENT              => $product->getField(Product::FIELD_IS_INSTALLMENT),
            Product::FIELD_INSTALLMENT_MONTHS          => $product->getField(Product::FIELD_INSTALLMENT_MONTHS),
            Product::FIELD_IS_DOCUMENT                 => $product->getField(Product::FIELD_IS_DOCUMENT),
            Product::FIELD_DOCUMENT                    => $product->getField(Product::FIELD_DOCUMENT),
            Product::FIELD_TRIGGERS                    => $product->getField(Product::FIELD_TRIGGERS),
            Product::FIELD_BEGIN_DURATION              => $product->getField(Product::FIELD_BEGIN_DURATION),
            Product::FIELD_BEGIN_DURATION_FORMAT_VALUE => $product->getField(Product::FIELD_BEGIN_DURATION_FORMAT_VALUE),
            Product::FIELD_DURATION                    => $product->getField(Product::FIELD_DURATION),
            Product::FIELD_DURATION_FORMAT_VALUE       => $product->getField(Product::FIELD_DURATION_FORMAT_VALUE),
            Product::FIELD_DESCRIPTION                 => $product->getField(Product::FIELD_DESCRIPTION),
            Product::FIELD_COLOR                       => $product->getField(Product::FIELD_COLOR),
            Product::FIELD_ORGANIZATION_ID             => $product->getField(Product::FIELD_ORGANIZATION_ID),
            Product::FIELD_CATEGORY_ID                 => $product->getField(Product::FIELD_CATEGORY_ID),
            Product::FIELD_USER_ID                     => $product->getField(Product::FIELD_USER_ID),
            'type'                                     => 'products',
            'included'                                 => [
                Product::ENTITY_RELATIVE_PERSONS      => PersonResource::collection($this->whenLoaded(Product::ENTITY_RELATIVE_PERSONS)),
                Product::ENTITY_RELATIVE_ORGANIZATION => OrganizationResource::make($this->whenLoaded(Product::ENTITY_RELATIVE_ORGANIZATION)),
                Product::ENTITY_RELATIVE_LEVELS       => LevelResource::collection($this->whenLoaded(Product::ENTITY_RELATIVE_LEVELS)),
                Product::ENTITY_RELATIVE_DIRECTIONS   => DirectionResource::collection($this->whenLoaded(Product::ENTITY_RELATIVE_DIRECTIONS)),
                Product::ENTITY_RELATIVE_FORMATS      => FormatResource::collection($this->whenLoaded(Product::ENTITY_RELATIVE_FORMATS)),
                Product::ENTITY_RELATIVE_CITY         => CityResource::collection($this->whenLoaded(implode('.', [Product::ENTITY_RELATIVE_ORGANIZATION, Organization::ENTITY_RELATIVE_CITY]))),
            ]
        ];
    }
}
