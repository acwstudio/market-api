<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Component;
use App\Models\ComponentMethod;
use App\Models\Method;
use App\Models\Page;
use Illuminate\Database\Eloquent\Builder;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;
use App\Http\Resources\Site\PageResource;

class PageController extends Controller
{
    public function page(Request $request)
    {
        $query = QueryBuilder::for(Page::class)
            ->allowedFilters([
                AllowedFilter::exact(Page::FIELD_ID),
                AllowedFilter::exact(Page::FIELD_SLUG),
            ])
            ->with([Page::ENTITY_RELATIVE_COMPONENTS, implode('.', [Page::ENTITY_RELATIVE_COMPONENTS, Component::ENTITY_RELATIVE_METHODS]), implode('.', [Page::ENTITY_RELATIVE_COMPONENTS, Component::ENTITY_RELATIVE_METHODS, ComponentMethod::ENTITY_RELATIVE_METHOD]), Page::ENTITY_RELATIVE_SEOTAGS])
            ->firstOrFail();

        $pageResource = new PageResource($query);

        return response()->json([
            'success' =>true,
            'data' => $pageResource
        ]);
    }
}
