<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Http\Resources\Site\EntitySectionCollection;
use App\Http\Resources\Site\EntitySectionResource;
use App\Models\EntitySection;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class EntitySectionController extends Controller
{
    public function list(Request $request)
    {
        $validated = $request->validate([
            'filter' => 'required|array',
            'filter.entity_id' => 'required|integer',
            'filter.entity_type' => 'required|string',
        ]);

        $request->merge([
            'filter' => [
                'entity_id' => $request->input('filter.entity_id'),
                'entity_type' => 'App\\Models\\' . ucfirst($request->input('filter.entity_type'))
            ]
        ]);

        $query = QueryBuilder::for(EntitySection::class)
            ->allowedFilters([
                AllowedFilter::exact('entity_id'),
                AllowedFilter::exact('entity_type'),
            ])
            ->defaultSort('sort')
            ->get();

        $collection = new EntitySectionCollection($query);

        return response()->json([
            'success' => true,
            'data' => $collection,
        ]);
    }

    public function detail(Request $request)
    {
        $request->merge([
            'filter' => [
                'section_id' => $request->input('filter.section_id'),
                'entity_id' => $request->input('filter.entity_id'),
                'entity_type' => 'App\\Models\\' . ucfirst($request->input('filter.entity_type'))
            ]
        ]);

        $validated = $request->validate([
            'filter' => 'required|array',
            'filter.section_id' => 'required|integer',
            'filter.entity_id' => 'required|integer',
            'filter.entity_type' => 'required|string',
        ]);

        $query = QueryBuilder::for(EntitySection::class)
            ->allowedFilters([
                AllowedFilter::exact('entity_id'),
                AllowedFilter::exact('entity_type'),
                AllowedFilter::exact('section_id')
            ])
            ->firstOrFail();

        $collection = new EntitySectionResource($query);

        return response()->json([
            'success' => true,
            'data' => $collection,
        ]);
    }
}
