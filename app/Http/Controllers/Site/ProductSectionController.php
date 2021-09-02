<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Http\Resources\Site\ProductSectionCollection;
use App\Http\Resources\Site\ProductSectionResource;
use App\Models\ProductSection;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class ProductSectionController extends Controller
{
    public function list(Request $request)
    {
        $validated = $request->validate([
            'filter' => 'required|array',
            'filter.product_id' => 'required|integer',
        ]);

        $query = QueryBuilder::for(ProductSection::class)
            ->allowedFilters([
                AllowedFilter::exact('product_id'),
            ])
            ->defaultSort('sort')
            ->get();

        $collection = new ProductSectionCollection($query);

        return response()->json([
            'success' => true,
            'data' => $collection,
        ]);
    }

    public function detail(Request $request)
    {
        $validated = $request->validate([
            'filter' => 'required|array',
            'filter.section_id' => 'required|integer',
            'filter.product_id' => 'required|integer'
        ]);

        $query = QueryBuilder::for(ProductSection::class)
            ->allowedFilters([
                AllowedFilter::exact('product_id'),
                AllowedFilter::exact('section_id')
            ])
            ->firstOrFail();

        $collection = new ProductSectionResource($query);

        return response()->json([
            'success' => true,
            'data' => $collection,
        ]);
    }
}
