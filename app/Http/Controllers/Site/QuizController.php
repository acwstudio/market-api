<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Http\Resources\Site\QuizCollection;
use App\Http\Resources\Site\QuizResource;
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
                AllowedFilter::exact('published')
            ])
            ->allowedIncludes(['questions', 'questions.answers'])
            ->allowedSorts(['id'])
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
                AllowedFilter::exact('id')
            ])
            ->allowedIncludes(['questions', 'questions.answers'])
            ->firstOrFail();

        return (new QuizResource($query))
            ->additional([
                'success' => true,
                'log_request_id' => ''
            ]);
    }
}
