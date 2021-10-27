<?php

declare(strict_types=1);

namespace App\Repositories\Quiz;

use App\Http\Requests\Quiz\DetailRequest;
use App\Http\Requests\Quiz\ListRequest;
use App\Http\Resources\Site\QuizCollection;
use App\Http\Resources\Site\QuizResource;

interface QuizRepositoryInterface
{
    public function getQuizzesByFilters(ListRequest $request): QuizCollection;

    public function getQuizDetailByFilters(DetailRequest $request): QuizResource;
}
