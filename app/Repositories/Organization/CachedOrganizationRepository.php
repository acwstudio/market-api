<?php

declare(strict_types=1);

namespace App\Repositories\Organization;

use App\Http\Requests\Organization\DetailRequest;
use App\Http\Requests\Organization\ListRequest;
use App\Http\Resources\OrganizationResource;
use App\Repositories\CachedRepository;
use Illuminate\Support\Facades\Cache;
use App\Http\Resources\OrganizationCollection;

final class CachedOrganizationRepository extends CachedRepository implements OrganizationRepositoryInterface
{
    private $statsRepository;

    public function __construct(OrganizationRepositoryInterface $statsRepository)
    {
        $this->statsRepository = $statsRepository;
    }

    public function getOrganizationsByFilters(ListRequest $request): OrganizationCollection
    {
        return Cache::remember($this->getCacheKey($request->all()), $this->getTtl(),
            function () use ($request) {
                return $this->statsRepository->getOrganizationsByFilters($request);
            });
    }

    public function getOrganizationDetailByFilters(DetailRequest $request): OrganizationResource
    {
        return Cache::remember($this->getCacheKey($request->all()), $this->getTtl(),
            function () use ($request) {
                return $this->statsRepository->getOrganizationDetailByFilters($request);
            });
    }
}
