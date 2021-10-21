<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\Format\DetailRequest;
use App\Http\Requests\Format\ListRequest;
use App\Services\FormatService;
use Illuminate\Http\JsonResponse;

class FormatController extends Controller
{
    public $formatService;

    public function __construct(FormatService $formatService)
    {
        $this->formatService = $formatService;
    }

    public function list(ListRequest $request): JsonResponse
    {
        $collection = $this->formatService->list($request);

        return response()->json([
                'success' => true,
                'data' => $collection,
                'count' => $collection->count(),
            ]);
    }

    public function detail(DetailRequest $request): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => $this->formatService->detail($request),
            'log_request_id' => ''
        ]);
    }
}
