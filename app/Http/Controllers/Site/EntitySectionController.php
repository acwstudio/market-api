<?php

declare(strict_types=1);

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Http\Requests\EntitySection\DetailRequest;
use App\Http\Requests\EntitySection\ListRequest;
use App\Services\EntitySectionService;
use Illuminate\Http\JsonResponse;

final class EntitySectionController extends Controller
{
    private $entitySectionService;

    public function __construct(EntitySectionService $entitySectionService)
    {
        $this->entitySectionService = $entitySectionService;
    }

    public function list(ListRequest $request): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => $this->entitySectionService->list($request),
        ]);
    }

    public function detail(DetailRequest $request): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => $this->entitySectionService->detail($request),
        ]);
    }
}
