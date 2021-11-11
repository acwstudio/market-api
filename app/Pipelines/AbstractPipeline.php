<?php

declare(strict_types=1);

namespace App\Pipelines;

use App\Services\ActivityService;
use Illuminate\Pipeline\Pipeline;

abstract class AbstractPipeline
{
    protected Pipeline $pipeline;

    protected ActivityService $activityService;

    public function __construct(Pipeline $pipeline, ActivityService $activityService)
    {
        $this->pipeline = $pipeline;
        $this->activityService = $activityService;
    }
}
