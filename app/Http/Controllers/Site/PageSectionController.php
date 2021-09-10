<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Http\Resources\Site\PageSectionResource;
use App\Models\PageSection;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class PageSectionController extends Controller
{
    public function detail(Request $request)
    {
        $validated = $request->validate([
            'filter' => 'required|array',
            'filter.section_id' => 'required|integer',
            'filter.page_id' => 'required|integer'
        ]);

        $query = QueryBuilder::for(PageSection::class)
            ->allowedFilters([
                AllowedFilter::exact('page_id'),
                AllowedFilter::exact('section_id')
            ])
            ->firstOrFail();

        $page = new PageSectionResource($query);

        return response()->json([
            'success' => true,
            'data' => $page,
        ]);
    }
}
