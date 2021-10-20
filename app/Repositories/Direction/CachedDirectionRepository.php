<?php

declare(strict_types=1);

namespace App\Repositories\Direction;

use App\Http\Requests\Direction\DetailRequest;
use App\Http\Requests\Direction\ListRequest;
use App\Http\Resources\DirectionCollection;
use App\Http\Resources\DirectionResource;
use App\Repositories\CachedRepository;
use Illuminate\Support\Facades\Cache;

final class CachedDirectionRepository  extends CachedRepository implements DirectionRepositoryInterface
{
    private DirectionRepositoryInterface $statsRepository;

    public function __construct(DirectionRepositoryInterface $statsRepository)
    {
        $this->statsRepository = $statsRepository;
    }

    public function getDirectionsByFilters(ListRequest $request): DirectionCollection
    {
        return Cache::remember($this->getCacheKey($request->all()), $this->getTtl(),
            function () use ($request) {
                return $this->statsRepository->getDirectionsByFilters($request);
            });
    }

    public function getDirectionDetailByFilters(DetailRequest $request): DirectionResource
    {
        return Cache::remember($this->getCacheKey($request->all()), $this->getTtl(),
            function () use ($request) {
                return $this->statsRepository->getDirectionDetailByFilters($request);
            });
    }
}
