<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\Subject\DetailRequest;
use App\Http\Requests\Subject\ListRequest;
use App\Services\SubjectService;
use Illuminate\Http\JsonResponse;

final class SubjectController extends Controller
{
    /**
     * @var SubjectService
     */
    private $subjectService;

    public function __construct(SubjectService $subjectService)
    {
        $this->subjectService = $subjectService;
    }

    public function list(ListRequest $request): JsonResponse
    {
        $collection = $this->subjectService->list($request);

        return response()->json([
            'success' => true,
            'count'   => $collection->count(),
            'data'    => $collection,
        ]);
    }

    /**
     * @param DetailRequest $request
     * @return JsonResponse
     */
    public function detail(DetailRequest $request): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => $this->subjectService->detail($request),
            'log_request_id' => ''
        ]);
    }

}
