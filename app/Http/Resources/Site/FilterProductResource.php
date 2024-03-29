<?php

namespace App\Http\Resources\Site;

use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Resources\Json\JsonResource;

class FilterProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $items = [];
        
        foreach ($this->resource as $res) {
            $items[] = [
                "id"    => $res->id,
                "name"  => $res->name,
                "count" => $res->products->where(Product::FIELD_PUBLISHED, 1)->count(),
                "page"  => [
                    "filter" => [
                        "slug" => "catalog"
                    ],
                    "params" => [
                        $res->table => [
                            $res->id
                        ]
                    ]
                ]
            ];
        }
        
        return [
            "name"      => $res->getModelName(),
            "slug"      => $res->table,
            "filter_by" => $res->getFilterBy(),
            "items"     => $items
        ];
    }
}
