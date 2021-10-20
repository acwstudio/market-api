<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\City\DetailRequest;
use App\Http\Requests\City\ListRequest;
use App\Http\Resources\CityResource;
use App\Services\CityService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CityController extends Controller
{
    private CityService $cityService;

    public function __construct(CityService $cityService)
    {
        $this->cityService = $cityService;
    }

    /**
     * @param Request $request
     * @return Application|ResponseFactory|Response
     */
    public function list(ListRequest $request): JsonResponse
    {
        $collection = $this->cityService->list($request);

        return response()->json([
            'success' => true,
            'data'    => $collection,
            'count'   => $collection->count(),
        ]);
    }

    /**
     * @return CityResource|string
     */
    public function detail(DetailRequest $request): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data'    => $this->cityService->detail($request)
        ]);
    }
}
