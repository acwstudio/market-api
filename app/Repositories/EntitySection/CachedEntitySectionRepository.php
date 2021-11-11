<?php

declare(strict_types=1);

namespace App\Repositories\EntitySection;

use App\Http\Requests\EntitySection\DetailRequest;
use App\Http\Requests\EntitySection\ListRequest;
use App\Http\Resources\Site\EntitySectionCollection;
use App\Http\Resources\Site\EntitySectionResource;
use App\Repositories\CachedRepository;
use Illuminate\Support\Facades\Cache;

final class CachedEntitySectionRepository extends CachedRepository implements EntitySectionRepositoryInterface
{
    private EntitySectionRepositoryInterface $entitySectionRepository;

    public function __construct(EntitySectionRepositoryInterface $entitySectionRepository)
    {
        $this->entitySectionRepository = $entitySectionRepository;
    }

    public function copyByOriginProduct(string $entityType, int $originEntityId, int $newEntityId): void
    {
        $this->entitySectionRepository->copyByOriginProduct($entityType, $originEntityId, $newEntityId);
    }

    public function getEntitySectionList(ListRequest $request): EntitySectionCollection
    {
        return Cache::remember($this->getCacheKey($request->all()), $this->getTtl(),
            function () use ($request) {
                return $this->entitySectionRepository->getEntitySectionList($request);
            });
    }

    public function getEntitySectionDetail(DetailRequest $request): EntitySectionResource
    {
        return Cache::remember($this->getCacheKey($request->all()), $this->getTtl(),
            function () use ($request) {
                return $this->entitySectionRepository->getEntitySectionDetail($request);
            });
    }
}
