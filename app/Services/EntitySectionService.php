<?php

declare(strict_types=1);

namespace App\Services;

use App\Http\Requests\EntitySection\DetailRequest;
use App\Http\Requests\EntitySection\ListRequest;
use App\Http\Resources\Site\EntitySectionCollection;
use App\Http\Resources\Site\EntitySectionResource;
use App\Repositories\EntitySection\EntitySectionRepositoryInterface;

final class EntitySectionService
{
    private $entitySectionRepository;

    public function __construct(EntitySectionRepositoryInterface $entitySectionRepository)
    {
        $this->entitySectionRepository = $entitySectionRepository;
    }

    public function list(ListRequest $request): EntitySectionCollection
    {
        return $this->entitySectionRepository->getEntitySectionList($request);
    }

    public function detail(DetailRequest $request): EntitySectionResource
    {
        return $this->entitySectionRepository->getEntitySectionDetail($request);
    }
}
