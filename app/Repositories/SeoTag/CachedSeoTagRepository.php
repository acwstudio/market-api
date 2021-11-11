<?php

declare(strict_types=1);

namespace App\Repositories\SeoTag;

use App\Dto\SeoTag\SeoTagDto;
use App\Repositories\CachedRepository;

final class CachedSeoTagRepository extends CachedRepository implements SeoTagRepositoryInterface
{
    private SeoTagRepositoryInterface $seoTagRepository;

    public function __construct(SeoTagRepositoryInterface $seoTagRepository)
    {
        $this->seoTagRepository = $seoTagRepository;
    }

    public function updateOrCreate(SeoTagDto $dto): SeoTagDto
    {
        return $this->seoTagRepository->updateOrCreate($dto);
    }
}
