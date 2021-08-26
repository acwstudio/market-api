<?php

namespace App\Http\Controllers;

use App\Http\Resources\FilterListCollection;
use App\Models\Direction;
use App\Models\Format;
use App\Models\Level;
use App\Models\Subject;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;

class FilterController extends Controller
{
    public function filter(Request $request)
    {
        $directions = QueryBuilder::for(Direction::class)
            ->select('id', 'name')
            ->where('published', 1)
            ->get();

        $levels = QueryBuilder::for(Level::class)
            ->select('id', 'name')
            ->where('published', 1)
            ->get();

        $formats = QueryBuilder::for(Format::class)
            ->select('id', 'name')
            ->where('published', 1)
            ->get();

        $subjects = QueryBuilder::for(Subject::class)
            ->select('id', 'name')
            ->where('published', 1)
            ->get();

        return (new FilterListCollection([
            'directions' => $directions,
            'levels' => $levels,
            'formats' => $formats,
            'subjects' => $subjects,
        ]))->additional([
            'count' => null,
            'success' => true
        ]);
    }
}
