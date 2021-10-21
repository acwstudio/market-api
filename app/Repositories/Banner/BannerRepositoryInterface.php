<?php

declare(strict_types=1);

namespace App\Repositories\Banner;

use App\Http\Requests\EntityDetailRequest;
use App\Http\Resources\BannerCollection;
use App\Http\Resources\BannerResource;
use Illuminate\Http\Request;

interface BannerRepositoryInterface
{
    public function getBannersByFilters(Request $request): BannerCollection;

    public function getBannerDetailByFilters(EntityDetailRequest $request): BannerResource;
}
