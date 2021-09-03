<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Http\Resources\Site\OrganizationSectionCollection;
use App\Http\Resources\Site\OrganizationSectionResource;
use App\Models\OrganizationSection;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class OrganizationSectionController extends Controller
{
    public function list(Request $request)
    {
        $validated = $request->validate([
            'filter' => 'required|array',
            'filter.organization_id' => 'required|integer',
        ]);

        $query = QueryBuilder::for(OrganizationSection::class)
            ->allowedFilters([
                AllowedFilter::exact('organization_id'),
            ])
            ->defaultSort('sort')
            ->get();

        $collection = new OrganizationSectionCollection($query);

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
            'filter.organization_id' => 'required|integer'
        ]);

        $query = QueryBuilder::for(OrganizationSection::class)
            ->allowedFilters([
                AllowedFilter::exact('organization_id'),
                AllowedFilter::exact('section_id')
            ])
            ->firstOrFail();

        $collection = new OrganizationSectionResource($query);

        return response()->json([
            'success' => true,
            'data' => $collection,
        ]);
    }
}
