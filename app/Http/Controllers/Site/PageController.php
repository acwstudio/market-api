<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
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
                AllowedFilter::exact('id')
            ])
            ->with(['components', 'components.methods', 'components.methods.method'])
            ->firstOrFail();

        $pageResource = new PageResource($query);

        return response()->json([
            'success' =>true,
            'data' => $pageResource
        ]);
    }
}
