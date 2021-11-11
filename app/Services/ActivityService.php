<?php

declare(strict_types=1);

namespace App\Services;

use App\Repositories\Activity\ActivityRepository;

final class ActivityService
{
    private ActivityRepository $repository;

    public function __construct(ActivityRepository $repository)
    {
        $this->repository = $repository;
    }

    public function create(string $model, string $action, int $entityId): void
    {
        /**
         * @todo жосткий костыль, не рабочий код до тех пор, пока не будет подключена в каком либо виде авторизация
         */
        //$this->repository->create($model, $action, $entityId, auth()->id());
        $this->repository->create($model, $action, $entityId, 5);
    }
}
