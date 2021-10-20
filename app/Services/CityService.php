<?php

declare(strict_types=1);

namespace App\Services;

use App\Http\Requests\City\DetailRequest;
use App\Http\Requests\City\ListRequest;
use App\Http\Resources\CityCollection;
use App\Http\Resources\CityResource;
use App\Repositories\City\CityRepositoryInterface;

final class CityService
{
    private $cityRepository;

    public function __construct(CityRepositoryInterface $cityRepository)
    {
        $this->cityRepository = $cityRepository;
    }

    public function list(ListRequest $request): CityCollection
    {
        return $this->cityRepository->getCitiesByFilters($request);
    }

    public function detail(DetailRequest $request): CityResource
    {
        return $this->cityRepository->getCityDetailByFilters($request);
    }
}
