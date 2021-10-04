<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Http\Resources\Site\QuizCollection;
use App\Http\Resources\Site\QuizResource;
use App\Models\Question;
use App\Models\Quiz;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class QuizController extends Controller
{
    public function list()
    {
        $query = QueryBuilder::for(Quiz::class)
            ->allowedFilters([
                AllowedFilter::exact(Quiz::FIELD_PUBLISHED)
            ])
            ->allowedIncludes([Quiz::ENTITY_RELATIVE_QUESTIONS, implode('.', [Quiz::ENTITY_RELATIVE_QUESTIONS, Question::ENTITY_RELATIVE_ANSWERS])])
            ->allowedSorts([Quiz::FIELD_ID])
            ->get();

        return (new QuizCollection($query))
            ->additional([
                'count' => $query->count(),
                'success' => true
            ]);
    }

    public function detail()
    {
        $query = QueryBuilder::for(Quiz::class)
            ->allowedFilters([
                AllowedFilter::exact(Quiz::FIELD_ID)
            ])
            ->allowedIncludes([Quiz::ENTITY_RELATIVE_QUESTIONS, implode('.', [Quiz::ENTITY_RELATIVE_QUESTIONS, Question::ENTITY_RELATIVE_ANSWERS])])
            ->with([Quiz::ENTITY_RELATIVE_QUESTIONS, implode('.', [Quiz::ENTITY_RELATIVE_QUESTIONS, Question::ENTITY_RELATIVE_ANSWERS])])
            ->firstOrFail();

        return (new QuizResource($query))
            ->additional([
                'success' => true,
                'log_request_id' => ''
            ]);
    }
}
