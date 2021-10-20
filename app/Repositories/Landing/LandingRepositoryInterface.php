<?php

declare(strict_types=1);

namespace App\Repositories\Landing;

use App\Http\Requests\EntityDetailRequest;
use App\Http\Requests\Landing\ListRequest;
use App\Http\Resources\LandingCollection;
use App\Http\Resources\LandingResource;

interface LandingRepositoryInterface
{
    public function getLandingsByFilters(ListRequest $request): LandingCollection;

    public function getLandingDetailByFilters(EntityDetailRequest $request): LandingResource;
}
