<?php

declare(strict_types=1);

namespace App\Repositories\Banner;

use App\Http\Requests\EntityDetailRequest;
use App\Http\Resources\BannerResource;
use App\Models\Banner;
use App\Http\Resources\BannerCollection;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

final class BannerRepository implements BannerRepositoryInterface
{
    private $bannerModel;

    public function __construct(Banner $banner)
    {
        $this->bannerModel = $banner;
    }

    public function getBannersByFilters(Request $request): BannerCollection
    {
        $queryBuilder = new QueryBuilder($this->bannerModel->newQuery(), $request);

        $query = $queryBuilder
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

        return new BannerCollection($query);
    }

    public function getBannerDetailByFilters(EntityDetailRequest $request): BannerResource
    {
        $queryBuilder = new QueryBuilder($this->bannerModel->newQuery(), $request);

        $query = $queryBuilder
            ->allowedFilters([
                AllowedFilter::exact(Banner::FIELD_ID)
            ])
            ->firstOrFail();

        return (new BannerResource($query))
            ->additional([
                'success'        => true,
                'log_request_id' => ''
            ]);
    }

}
