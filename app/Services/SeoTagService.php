<?php

declare(strict_types=1);

namespace App\Services;

use App\Dto\SeoTag\SeoTagDto;
use App\Repositories\SeoTag\SeoTagRepositoryInterface;

final class SeoTagService
{
    private SeoTagRepositoryInterface $seoTagRepository;

    public function __construct(SeoTagRepositoryInterface $seoTagRepository)
    {
        $this->seoTagRepository = $seoTagRepository;
    }

    public function create(SeoTagDto $dto): SeoTagDto
    {
        return $this->seoTagRepository->updateOrCreate($dto);
    }
}
