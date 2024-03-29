<?php

declare(strict_types=1);

namespace App\Repositories\EntitySection;

use App\Http\Requests\EntitySection\DetailRequest;
use App\Http\Requests\EntitySection\ListRequest;
use App\Http\Resources\Site\EntitySectionCollection;
use App\Http\Resources\Site\EntitySectionResource;
use App\Models\EntitySection;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

final class EntitySectionRepository implements EntitySectionRepositoryInterface
{
    private EntitySection $entitySectionModel;

    public function __construct(EntitySection $entitySectionModel)
    {
        $this->entitySectionModel = $entitySectionModel;
    }

    public function copyByOriginProduct(string $entityType, int $originEntityId, int $newEntityId): void
    {
        $sections = $this->entitySectionModel->newQuery()
            ->where(EntitySection::FIELD_ENTITY_ID, $originEntityId)
            ->where(EntitySection::FIELD_ENTITY_TYPE, $entityType)
            ->get();

        /** @var EntitySection $section */
        foreach ($sections as $section) {
            $section->replicate()
                ->fill([EntitySection::FIELD_ENTITY_ID => $newEntityId])
                ->save();
        }
    }

    public function getEntitySectionList(ListRequest $request): EntitySectionCollection
    {
        $queryBuilder = new QueryBuilder($this->entitySectionModel->newQuery(), $request);

        $query = $queryBuilder
            ->allowedFilters([
                AllowedFilter::exact(EntitySection::FIELD_ENTITY_ID),
                AllowedFilter::exact(EntitySection::FIELD_ENTITY_TYPE),
            ])
            ->defaultSort(EntitySection::FIELD_SORT)
            ->get();

        return new EntitySectionCollection($query);
    }

    public function getEntitySectionDetail(DetailRequest $request): EntitySectionResource
    {
        $queryBuilder = new QueryBuilder($this->entitySectionModel->newQuery(), $request);

        $query = $queryBuilder
            ->allowedFilters([
                AllowedFilter::exact(EntitySection::FIELD_ENTITY_ID),
                AllowedFilter::exact(EntitySection::FIELD_ENTITY_TYPE),
                AllowedFilter::exact(EntitySection::FIELD_SECTION_ID)
            ])
            ->firstOrFail();

        return new EntitySectionResource($query);
    }
}
