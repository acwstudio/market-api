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
            'filter'                                     => 'required|array',
            'filter.' . EntitySection::FIELD_ENTITY_ID   => 'required|integer',
            'filter.' . EntitySection::FIELD_ENTITY_TYPE => 'required|string',
        ]);

        $request->merge([
            'filter' => [
                EntitySection::FIELD_ENTITY_ID   => $request->input('filter.' . EntitySection::FIELD_ENTITY_ID),
                EntitySection::FIELD_ENTITY_TYPE => 'App\\Models\\' . ucfirst($request->input('filter.' . EntitySection::FIELD_ENTITY_TYPE))
            ]
        ]);

        $query = QueryBuilder::for(EntitySection::class)
            ->allowedFilters([
                AllowedFilter::exact(EntitySection::FIELD_ENTITY_ID),
                AllowedFilter::exact(EntitySection::FIELD_ENTITY_TYPE),
            ])
            ->defaultSort(EntitySection::FIELD_SORT)
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
                EntitySection::FIELD_SECTION_ID  => $request->input('filter.' . EntitySection::FIELD_SECTION_ID),
                EntitySection::FIELD_ENTITY_ID   => $request->input('filter.' . EntitySection::FIELD_ENTITY_ID),
                EntitySection::FIELD_ENTITY_TYPE => 'App\\Models\\' . ucfirst($request->input('filter.' . EntitySection::FIELD_ENTITY_TYPE))
            ]
        ]);

        $validated = $request->validate([
            'filter'                                     => 'required|array',
            'filter.' . EntitySection::FIELD_SECTION_ID  => 'required|integer',
            'filter.' . EntitySection::FIELD_ENTITY_ID   => 'required|integer',
            'filter.' . EntitySection::FIELD_ENTITY_TYPE => 'required|string',
        ]);

        $query = QueryBuilder::for(EntitySection::class)
            ->allowedFilters([
                AllowedFilter::exact(EntitySection::FIELD_ENTITY_ID),
                AllowedFilter::exact(EntitySection::FIELD_ENTITY_TYPE),
                AllowedFilter::exact(EntitySection::FIELD_SECTION_ID)
            ])
            ->firstOrFail();

        $collection = new EntitySectionResource($query);

        return response()->json([
            'success' => true,
            'data' => $collection,
        ]);
    }
}
