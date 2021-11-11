<?php

declare(strict_types=1);

namespace App\Repositories\Activity;

use App\Models\Activity;

final class ActivityRepository
{
    private Activity $activityModel;

    public function __construct(Activity $activity)
    {
        $this->activityModel = $activity;
    }

    public function create(string $model, string $action, int $entityId, int $userId): void
    {
        $this->activityModel->newQuery()
            ->create([
                Activity::FIELD_MODEL => $model,
                Activity::FIELD_ACTION => $action,
                Activity::FIELD_MODEL_ID => $entityId,
                Activity::FIELD_USER_ID => $userId
            ]);
    }
}
