<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\Banner\DetailRequest;
use App\Http\Requests\Banner\ListRequest;
use App\Http\Resources\BannerResource;
use App\Services\BannerService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    public $bannerService;

    public function __construct(BannerService $bannerService)
    {
        $this->bannerService = $bannerService;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function list(ListRequest $request): JsonResponse
    {
        $collection = $this->bannerService->list($request);

        return response()->json([
            'success' => true,
            'count'   => $collection->count(),
            'data'    => $collection,
        ]);
    }

    /**
     * @return BannerResource|string
     */
    public function detail(DetailRequest $request): JsonResponse
    {
        return response()->json([
            'success'        => true,
            'data'           => $this->bannerService->detail($request),
            'log_request_id' => ''
        ]);
    }

}
