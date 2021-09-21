<?php

namespace App\Http\Resources\Site;

use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductFilterResource extends JsonResource
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
                "count" => $res->products->where('published', 1)->count(),
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
            "name"  => $res->getModelName(),
            "slug"  => $res->table,
            "items" => $items
        ];
    }
}
