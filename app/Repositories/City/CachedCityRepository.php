<?php

namespace App\Repositories\City;

use App\Http\Requests\City\DetailRequest;
use App\Http\Requests\City\ListRequest;
use App\Http\Resources\CityCollection;
use App\Http\Resources\CityResource;
use App\Repositories\CachedRepository;
use Illuminate\Support\Facades\Cache;

class CachedCityRepository  extends CachedRepository implements CityRepositoryInterface
{
    private $statsRepository;

    public function __construct(CityRepositoryInterface $statsRepository)
    {
        $this->statsRepository = $statsRepository;
    }

    public function getCitiesByFilters(ListRequest $request): CityCollection
    {
        return Cache::remember($this->getCacheKey($request->all()), $this->getTtl(),
            function () use ($request) {
                return $this->statsRepository->getCitiesByFilters($request);
            });
    }

    public function getCityDetailByFilters(DetailRequest $request): CityResource
    {
        return Cache::remember($this->getCacheKey($request->all()), $this->getTtl(),
            function () use ($request) {
                return $this->statsRepository->getCityDetailByFilters($request);
            });
    }
}
