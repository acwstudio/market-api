<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\EntityDetailRequest;
use App\Repositories\Subject\SubjectRepository;
use App\Services\SubjectService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

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

    public function list(Request $request): JsonResponse
    {
        $collection = $this->subjectService->list($request);

        return response()->json([
            'success' => true,
            'count'   => $collection->count(),
            'data'    => $collection,
        ]);
    }

    /**
     * @param EntityDetailRequest $request
     * @return JsonResponse
     */
    public function detail(EntityDetailRequest $request): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => $this->subjectService->detail($request),
            'log_request_id' => ''
        ]);
    }

}
