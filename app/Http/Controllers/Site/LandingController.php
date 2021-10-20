<?php

declare(strict_types=1);

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Http\Requests\EntityDetailRequest;
use App\Http\Requests\Landing\ListRequest;
use App\Http\Resources\LandingCollection;
use App\Services\LandingService;

final class LandingController extends Controller
{
    private $landingService;

    public function __construct(LandingService $landingService)
    {
        $this->landingService = $landingService;
    }

    public function list(ListRequest $request): LandingCollection
    {
        $collection = $this->landingService->list($request);

        return $collection->additional([
            'count' => $collection->count(),
            'success' => true
        ]);
    }

    public function detail(EntityDetailRequest $request)
    {
        return $this->landingService
            ->detail($request)
            ->additional([
                'success' => true,
                'log_request_id' => ''
            ]);
    }
}
