<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Http\Resources\Site\ProductSectionCollection;
use App\Models\ProductSection;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class ProductSectionController extends Controller
{
    public function detail()
    {
        $query = QueryBuilder::for(ProductSection::class)
            ->allowedFilters([
                AllowedFilter::exact('product_id'),
                AllowedFilter::exact('section_id')
            ])
            ->get();

        $collection = new ProductSectionCollection($query);
        $count = $query->count();

        return response()->json([
            'data' => $collection,
            'success' => true,
        ]);
    }
}
