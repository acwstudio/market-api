<?php

declare(strict_types=1);

namespace App\Repositories;

abstract class CachedRepository
{
    protected const CACHE_TTL_SECONDS = 1;

    protected function getCacheKey(array $arguments): string
    {
        $role = self::class;

        $query = $role . json_encode($arguments);

        return hash('sha256', $query);
    }

    protected function getTtl(): int
    {
        return self::CACHE_TTL_SECONDS;
    }
}
