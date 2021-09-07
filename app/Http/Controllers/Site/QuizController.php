<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Http\Resources\Site\QuizCollection;
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
}
