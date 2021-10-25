<?php

declare(strict_types=1);

namespace App\Repositories\Banner;

use App\Http\Requests\Banner\DetailRequest;
use App\Http\Requests\Banner\ListRequest;
use App\Http\Resources\BannerCollection;
use App\Http\Resources\BannerResource;
use App\Repositories\CachedRepository;
use Illuminate\Support\Facades\Cache;

final class CachedBannerRepository extends CachedRepository implements BannerRepositoryInterface
{
    private $statsRepository;

    public function __construct(BannerRepositoryInterface $statsRepository)
    {
        $this->statsRepository = $statsRepository;
    }

    public function getBannersByFilters(ListRequest $request): BannerCollection
    {
        return Cache::remember($this->getCacheKey($request->all()), $this->getTtl(),
            function () use ($request) {
                return $this->statsRepository->getBannersByFilters($request);
            });
    }

    public function getBannerDetailByFilters(DetailRequest $request): BannerResource
    {
        return Cache::remember($this->getCacheKey($request->all()), $this->getTtl(),
            function () use ($request) {
                return $this->statsRepository->getBannerDetailByFilters($request);
            });
    }

}
