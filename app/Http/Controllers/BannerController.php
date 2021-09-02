<?php

namespace App\Http\Controllers;

use App\Http\Requests\EntityDetailRequest;
use App\Http\Resources\BannerCollection;
use App\Http\Resources\BannerResource;
use App\Models\Banner;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class BannerController extends Controller
{
    /**
     * @param Request $request
     * @return BannerCollection
     */
    public function list(Request $request): BannerCollection
    {
        $query = QueryBuilder::for(Banner::class)
            ->allowedFilters([
                AllowedFilter::exact('ids', 'id'),
                AllowedFilter::exact('published'),
                AllowedFilter::exact('name'),
                AllowedFilter::exact('link')
            ])
            ->allowedSorts(['name', 'id'])
            ->get();

        return (new BannerCollection($query))
            ->additional([
                'count' => $query->count(),
                'success' => true
            ]);
    }

    /**
     * @return BannerResource|string
     */
    public function detail(EntityDetailRequest $request)
    {
        $query = QueryBuilder::for(Banner::class)
            ->allowedFilters([
                AllowedFilter::exact('id')
            ])
            ->firstOrFail();

        return (new BannerResource($query))
            ->additional([
                'success' => true,
                'log_request_id' => ''
            ]);

    }

}
