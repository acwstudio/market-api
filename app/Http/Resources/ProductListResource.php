<?php

namespace App\Http\Resources;

use App\Models\Product;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductListResource extends JsonResource
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
            'id' => $product->id,
            'type' => 'products',
            'published' => $product->published,
            "name" => $product->name,
            "preview_image" => $product->preview_image,
            "organization_id" => $product->organization_id,
            "slug" => $product->slug
        ];
    }
}
