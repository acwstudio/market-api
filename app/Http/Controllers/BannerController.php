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
                AllowedFilter::exact('ids', Banner::FIELD_ID),
                AllowedFilter::exact(Banner::FIELD_PUBLISHED),
                AllowedFilter::exact(Banner::FIELD_NAME),
                AllowedFilter::exact(Banner::FIELD_LINK),
                AllowedFilter::exact(Banner::FIELD_BANNER_TYPE),
                AllowedFilter::exact(Banner::FIELD_COLOR_BG),
                AllowedFilter::exact(Banner::FIELD_COLOR_TEXT),
                AllowedFilter::exact(Banner::FIELD_COLOR_BG_LIST),
                AllowedFilter::exact(Banner::FIELD_COLOR_TEXT_LIST),
                AllowedFilter::exact(Banner::FIELD_DESCRIPTION)
            ])
            ->allowedSorts([Banner::FIELD_NAME, Banner::FIELD_ID])
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
                AllowedFilter::exact(Banner::FIELD_ID)
            ])
            ->firstOrFail();

        return (new BannerResource($query))
            ->additional([
                'success' => true,
                'log_request_id' => ''
            ]);

    }

}
