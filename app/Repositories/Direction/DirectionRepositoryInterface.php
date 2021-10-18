<?php

declare(strict_types=1);

namespace App\Repositories\Direction;

use App\Http\Requests\Direction\DetailRequest;
use App\Http\Requests\Direction\ListRequest;
use App\Http\Resources\DirectionCollection;
use App\Http\Resources\DirectionResource;

interface DirectionRepositoryInterface
{
    public function getDirectionsByFilters(ListRequest $request): DirectionCollection;

    public function getDirectionDetailByFilters(DetailRequest $request): DirectionResource;
}
