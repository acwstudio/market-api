<?php

declare(strict_types=1);

namespace App\Repositories\Banner;

use App\Http\Requests\Banner\DetailRequest;
use App\Http\Requests\Banner\ListRequest;
use App\Http\Resources\BannerCollection;
use App\Http\Resources\BannerResource;

interface BannerRepositoryInterface
{
    public function getBannersByFilters(ListRequest $request): BannerCollection;

    public function getBannerDetailByFilters(DetailRequest $request): BannerResource;
}
