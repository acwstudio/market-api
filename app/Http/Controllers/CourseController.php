<?php

namespace App\Http\Controllers;

use App\Http\Resources\Course\CourseCollection;
use App\Http\Resources\Course\CourseResource;
use App\Models\Course;
use App\Models\Product;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

/**
 * Class CourseController
 * @package App\Http\Controllers
 */
class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return CourseCollection
     */
    public function index()
    {
        $courses = QueryBuilder::for(Product::class)
            ->allowedIncludes([
                'subjects', 'formats', 'levels', 'directions', 'sections', 'persons', 'organization'
            ])
            ->allowedFilters([
                'name', 'expiration_date',
                AllowedFilter::exact('id'),
                AllowedFilter::exact('published'),
                AllowedFilter::exact('slug'),
                AllowedFilter::exact('is_document'),
                AllowedFilter::exact('is_installment'),
                AllowedFilter::exact('is_employment'),
                AllowedFilter::exact('organization_id'),
                AllowedFilter::exact('subject_id'),
                AllowedFilter::exact('format_id'),
                AllowedFilter::exact('level_id'),
                AllowedFilter::exact('direction_id'),
                AllowedFilter::exact('person_id'),
                AllowedFilter::exact('format_ids'),
            ])
            ->allowedSorts(['id', 'name', 'price'])
            ->jsonPaginate();

        return new CourseCollection($courses);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return CourseResource
     */
    public function show($id)
    {
        $course = QueryBuilder::for(Product::class)
            ->where('id', $id)
            ->allowedIncludes([
                'subjects', 'formats', 'levels', 'directions', 'sections', 'persons', 'organization'
            ])->firstOrFail();

        return new CourseResource($course);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
