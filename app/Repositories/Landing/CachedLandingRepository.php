<?php

declare(strict_types=1);

namespace App\Repositories\Landing;

use App\Http\Requests\EntityDetailRequest;
use App\Http\Requests\Landing\ListRequest;
use App\Http\Resources\LandingCollection;
use App\Http\Resources\LandingResource;
use App\Repositories\CachedRepository;
use Illuminate\Support\Facades\Cache;

final class CachedLandingRepository extends CachedRepository implements LandingRepositoryInterface
{
    private $landingRepository;

    public function __construct(LandingRepositoryInterface $landingRepository)
    {
        $this->landingRepository = $landingRepository;
    }

    public function getLandingsByFilters(ListRequest $request): LandingCollection
    {
        return Cache::remember($this->getCacheKey($request->all()), $this->getTtl(),
            function () use ($request) {
                return $this->landingRepository->getLandingsByFilters($request);
            });
    }

    public function getLandingDetailByFilters(EntityDetailRequest $request): LandingResource
    {
        return Cache::remember($this->getCacheKey($request->all()), $this->getTtl(),
            function () use ($request) {
                return $this->landingRepository->getLandingDetailByFilters($request);
            });
    }
}
