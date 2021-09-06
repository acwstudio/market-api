<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Page;
use Illuminate\Database\Eloquent\Builder;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;
use App\Http\Resources\Site\PageResource;

class TestController extends Controller
{
    public function test(Request $request)
    {
        $query = QueryBuilder::for(Page::class)
            ->allowedFilters([
                AllowedFilter::exact('id'),
                AllowedFilter::exact('slug'),
            ])
            ->with(['components', 'components.methods', 'components.methods.method', 'seotags'])
            ->firstOrFail();

        $pageResource = new PageResource($query);

        dd($pageResource);

        return response()->json([
            'success' =>true,
            'data' => $pageResource
        ]);
    }
}
