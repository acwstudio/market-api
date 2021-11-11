<?php

declare(strict_types=1);

namespace App\Repositories\SeoTag;

use App\Dto\SeoTag\SeoTagDto;
use App\Models\SeoTag;

final class SeoTagRepository implements SeoTagRepositoryInterface
{
    private SeoTag $seoTag;

    public function __construct(SeoTag $seoTag)
    {
        $this->seoTag = $seoTag;
    }

    public function updateOrCreate(SeoTagDto $dto): SeoTagDto
    {
        $seoTag = $this->seoTag
            ->newQuery()
            ->updateOrCreate([
                SeoTag::FIELD_MODEL_ID => $dto->getModelId(),
                SeoTag::FIELD_MODEL => $dto->getModel(),
            ], $dto->toArray());

        return SeoTagDto::fromArray($seoTag->toArray());
    }
}
