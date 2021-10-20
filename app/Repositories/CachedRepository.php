<?php

declare(strict_types=1);

namespace App\Repositories;

abstract class CachedRepository
{
    /**
     * @todo это временное решение с тестовым указанием времени жизни кеша в 1 секунду
     * вижу несколько вариантов исправления данной ситуации:
     * в конфиге в файле cache.php внести для каждого класса сущности / метода отдельные параметры TTL
     * ну или как минимум продумать какое время кеша сделать общим у всех
     */
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
