<?php

declare(strict_types=1);

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Http\Requests\Quiz\DetailRequest;
use App\Http\Requests\Quiz\ListRequest;
use App\Services\QuizService;
use Illuminate\Http\JsonResponse;

final class QuizController extends Controller
{
    private $quizService;

    public function __construct(QuizService $quizService)
    {
        $this->quizService = $quizService;
    }

    public function list(ListRequest $request): JsonResponse
    {
        $collection = $this->quizService->list($request);

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
            'data'    => $this->quizService->detail($request)
        ]);
    }
}
