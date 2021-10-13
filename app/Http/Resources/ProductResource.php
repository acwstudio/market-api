<?php

declare(strict_types=1);

namespace App\Http\Resources;

use App\Models\Organization;
use App\Models\Product;
use App\Repositories\Product\ProductRepository;
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
            'id'                          => $product->id,
            'is_moderated'                => $product->is_moderated,
            'land'                        => $product->land,
            'published'                   => $product->published,
            'expiration_date'             => $product->expiration_date,
            'name'                        => $product->name,
            'slug'                        => $product->slug,
            'preview_image'               => $product->preview_image,
            'digital_image'               => $product->digital_image,
            'price'                       => $product->price,
            'start_date'                  => ProductRepository::dateToDisplayFormat($product->start_date),
            'is_employment'               => $product->is_employment,
            'is_installment'              => $product->is_installment,
            'installment_months'          => $product->installment_months,
            'is_document'                 => $product->is_document,
            'document'                    => $product->document,
            'triggers'                    => $product->triggers,
            'begin_duration'              => $product->begin_duration,
            'begin_duration_format_value' => $product->begin_duration_format_value,
            'duration'                    => $product->duration,
            'duration_format_value'       => $product->duration_format_value,
            'description'                 => $product->description,
            'color'                       => $product->color,
            'organization_id'             => $product->organization_id,
            'category_id'                 => $product->category_id,
            'user_id'                     => $product->user_id,
            'type'                        => 'products',
            'included'                    => [
                Product::ENTITY_RELATIVE_PERSONS      => PersonResource::collection($this->whenLoaded(Product::ENTITY_RELATIVE_PERSONS)),
                Product::ENTITY_RELATIVE_ORGANIZATION => OrganizationResource::make($this->whenLoaded(Product::ENTITY_RELATIVE_ORGANIZATION)),
                Product::ENTITY_RELATIVE_LEVELS       => LevelResource::collection($this->whenLoaded(Product::ENTITY_RELATIVE_LEVELS )),
                Product::ENTITY_RELATIVE_DIRECTIONS   => DirectionResource::collection($this->whenLoaded(Product::ENTITY_RELATIVE_DIRECTIONS)),
                Product::ENTITY_RELATIVE_FORMATS      => FormatResource::collection($this->whenLoaded(Product::ENTITY_RELATIVE_FORMATS)),
                Product::ENTITY_RELATIVE_CITY         => CityResource::collection($this->whenLoaded(implode('.', [Product::ENTITY_RELATIVE_ORGANIZATION, Organization::ENTITY_RELATIVE_CITY]))),
            ]
        ];
    }
}
