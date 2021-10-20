<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\Direction\DetailRequest;
use App\Http\Requests\Direction\ListRequest;
use App\Http\Resources\DirectionResource;
use App\Services\DirectionService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;

final class DirectionController extends Controller
{
    /**
     * @var DirectionService
     */
    public $directionService;

    public function __construct(DirectionService $directionService)
    {
        $this->directionService = $directionService;
    }

    /**
     * @param ListRequest $request
     * @return Application|ResponseFactory|Response
     */
    public function list(ListRequest $request): JsonResponse
    {
        $collection = $this->directionService->list($request);

        return response()->json([
            'success' =>true,
            'data' => $collection,
            'count' => $collection->count(),
        ]);
    }

    /**
     * @return DirectionResource|string
     */
    public function detail(DetailRequest $request): JsonResponse
    {
        return response()->json([
            'success' =>true,
            'data' => $this->directionService->detail($request)
        ]);
    }

}
