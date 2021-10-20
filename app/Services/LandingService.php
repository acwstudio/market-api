<?php

declare(strict_types=1);

namespace App\Services;

use App\Http\Requests\EntityDetailRequest;
use App\Http\Requests\Landing\ListRequest;
use App\Http\Resources\LandingCollection;
use App\Http\Resources\LandingResource;
use App\Repositories\Landing\LandingRepositoryInterface;

final class LandingService
{
    private $landingRepository;

    public function __construct(LandingRepositoryInterface $landingRepository)
    {
        $this->landingRepository = $landingRepository;
    }

    public function list(ListRequest $request): LandingCollection
    {
        return $this->landingRepository->getLandingsByFilters($request);
    }

    public function detail(EntityDetailRequest $request): LandingResource
    {
        return $this->landingRepository->getLandingDetailByFilters($request);
    }
}
