<?php

declare(strict_types=1);

namespace App\Services;

use App\Http\Requests\Quiz\DetailRequest;
use App\Http\Requests\Quiz\ListRequest;
use App\Http\Resources\Site\QuizCollection;
use App\Http\Resources\Site\QuizResource;
use App\Repositories\Quiz\QuizRepositoryInterface;

final class QuizService
{
    private $quizRepository;

    public function __construct(QuizRepositoryInterface $quizRepository)
    {
        $this->quizRepository = $quizRepository;
    }

    public function list(ListRequest $request): QuizCollection
    {
        return $this->quizRepository->getQuizzesByFilters($request);
    }

    public function detail(DetailRequest $request): QuizResource
    {
        return $this->quizRepository->getQuizDetailByFilters($request);
    }

}
