<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\Organization\DetailRequest;
use App\Http\Requests\Organization\ListRequest;
use App\Services\OrganizationService;
use Illuminate\Http\JsonResponse;

final class OrganizationController extends Controller
{
    private $organizationService;

    public function __construct(OrganizationService $organizationService)
    {
        $this->organizationService = $organizationService;
    }

    public function list(ListRequest $request): JsonResponse
    {
        $collection = $this->organizationService->list($request);

        return response()->json([
            'success' => true,
            'data'    => $collection,
            'count'   => $collection->total(),
        ]);
    }

    public function detail(DetailRequest $request): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data'    => $this->organizationService->detail($request)
        ]);
    }
}
