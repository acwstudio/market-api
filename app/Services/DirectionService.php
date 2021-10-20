<?php

declare(strict_types=1);

namespace App\Services;

use App\Http\Requests\Direction\DetailRequest;
use App\Http\Requests\Direction\ListRequest;
use App\Http\Resources\DirectionCollection;
use App\Http\Resources\DirectionResource;
use App\Repositories\Direction\DirectionRepositoryInterface;

final class DirectionService
{
    private $directionRepository;

    public function __construct(DirectionRepositoryInterface $directionRepository)
    {
        $this->directionRepository = $directionRepository;
    }

    public function list(ListRequest $request): DirectionCollection
    {
        return $this->directionRepository->getDirectionsByFilters($request);
    }

    public function detail(DetailRequest $request): DirectionResource
    {
        return $this->directionRepository->getDirectionDetailByFilters($request);
    }
}
