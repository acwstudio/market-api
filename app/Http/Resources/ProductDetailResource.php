<?php

namespace App\Http\Resources;

use App\Models\Product;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductDetailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        /** @var Product $product */
        $product = $this;

        return [
            'id'                  => $product->id,
            'type'                => 'products',
            'is_moderated'        => $product->is_moderated,
            'land'                => $product->land,
            'published'           => $product->published,
            'expiration_date'     => $product->expiration_date,
            'name'                => $product->name,
            'slug'                => $product->slug,
            'preview_image'       => $product->preview_image,
            'digital_image'       => $product->digital_image,
            'price'               => $product->price,
            'start_date'          => $product->start_date,
            'is_employment'       => $product->is_employment,
            'is_installment'      => $product->is_installment,
            'installment_month'   => $product->installment_months,
            'is_document'         => $product->is_document,
            'document'            => $product->document,
            'triggers'            => $product->triggers,
            'begin_duration'      => $product->begin_duration,
            'begin_duration_format_value' => $product->begin_duration_format_value,
            'duration'            => $product->duration,
            'duration_format_value' => $product->document,
            'description'         => $product->description,
            'color'               => $product->color,
            'organization_id'     => $product->organization_id,
            'category_id'         => $product->category_id,
            'user_id'             => $product->user_id,
            'created_at'          => $product->created_at,
            'updated_at'          => $product->updated_at,
        ];
    }

}
