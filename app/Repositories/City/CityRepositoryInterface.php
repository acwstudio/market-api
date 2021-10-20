<?php

declare(strict_types=1);

namespace App\Repositories\City;

use App\Http\Requests\City\DetailRequest;
use App\Http\Requests\City\ListRequest;
use App\Http\Resources\CityCollection;
use App\Http\Resources\CityResource;

interface CityRepositoryInterface
{
    public function getCitiesByFilters(ListRequest $request): CityCollection;

    public function getCityDetailByFilters(DetailRequest $request): CityResource;
}
