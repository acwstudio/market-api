<?php

declare(strict_types=1);

namespace App\Repositories\Banner;

use App\Http\Requests\EntityDetailRequest;
use App\Http\Resources\BannerResource;
use App\Repositories\CachedRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use App\Http\Resources\BannerCollection;

final class CachedBannerRepository extends CachedRepository implements BannerRepositoryInterface
{
    private $statsRepository;

    public function __construct(BannerRepositoryInterface $statsRepository)
    {
        $this->statsRepository = $statsRepository;
    }

    public function getBannersByFilters(Request $request): BannerCollection
    {
        return Cache::remember($this->getCacheKey($request->all()), $this->getTtl(),
            function () use ($request) {
                return $this->statsRepository->getBannersByFilters($request);
            });
    }

    public function getBannerDetailByFilters(EntityDetailRequest $request): BannerResource
    {
        return Cache::remember($this->getCacheKey($request->all()), $this->getTtl(),
            function () use ($request) {
                return $this->statsRepository->getBannerDetailByFilters($request);
            });
    }

}
