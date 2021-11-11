<?php

declare(strict_types=1);

namespace App\Repositories\SeoTag;

use App\Dto\SeoTag\SeoTagDto;

interface SeoTagRepositoryInterface
{
    public function updateOrCreate(SeoTagDto $dto): SeoTagDto;
}
