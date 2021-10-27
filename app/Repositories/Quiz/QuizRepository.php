<?php

declare(strict_types=1);

namespace App\Repositories\Quiz;

use App\Http\Requests\Quiz\DetailRequest;
use App\Http\Requests\Quiz\ListRequest;
use App\Http\Resources\Site\QuizCollection;
use App\Http\Resources\Site\QuizResource;
use App\Models\Quiz;
use App\Models\Question;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

final class QuizRepository implements QuizRepositoryInterface
{
    private Quiz $quiz;

    public function __construct(Quiz $quiz)
    {
        $this->quiz = $quiz;
    }

    public function getQuizzesByFilters(ListRequest $request): QuizCollection
    {
        $queryBuilder = new QueryBuilder($this->quiz->newQuery(), $request);

        $query = $queryBuilder
            ->allowedFilters([
                AllowedFilter::exact('ids', Quiz::FIELD_ID),
                AllowedFilter::exact(Quiz::FIELD_PUBLISHED)
            ])
            ->allowedIncludes([
                Quiz::ENTITY_RELATIVE_QUESTIONS,
                implode('.', [Quiz::ENTITY_RELATIVE_QUESTIONS, Question::ENTITY_RELATIVE_ANSWERS])
            ])
            ->allowedSorts([Quiz::FIELD_ID]);

        $page = 1;
        $pageSize = 10;

        $pagination = $request->get('pagination') ?? ['page' => $page, 'page_size' => $pageSize];

        return new QuizCollection($query->paginate(
            $pagination['page_size'] ?? $pageSize,
            $columns = ['*'],
            $pageName = 'page',
            $pagination['page'] ?? $page
        ));
    }

    public function getQuizDetailByFilters(DetailRequest $request): QuizResource
    {
        $queryBuilder = new QueryBuilder($this->quiz->newQuery(), $request);

        $query = $queryBuilder
            ->allowedFilters([
                AllowedFilter::exact(Quiz::FIELD_ID)
            ])
            ->allowedIncludes([
                Quiz::ENTITY_RELATIVE_QUESTIONS,
                implode('.', [Quiz::ENTITY_RELATIVE_QUESTIONS, Question::ENTITY_RELATIVE_ANSWERS])
            ])
            ->firstOrFail();

        return new QuizResource($query);
    }
}
