<?php

namespace App\Http\Controllers;

use App\Http\Requests\EntityDetailRequest;
use App\Http\Resources\PersonCollection;
use App\Http\Resources\PersonResource;
use App\Http\Resources\PersonListCollection;
use App\Models\Person;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class PersonController extends Controller
{
    /**
     * @param Request $request
     * @return PersonCollection
     */
    public function list(Request $request): PersonCollection
    {
        $query = QueryBuilder::for(Person::class)
            ->allowedFilters([
                AllowedFilter::exact('ids', 'id'),
                AllowedFilter::exact('published'),
                AllowedFilter::exact('name'),
                AllowedFilter::exact('show_main'),
                AllowedFilter::exact('product_ids', 'products.id')
            ])
            ->allowedSorts(['position', 'name', 'id'])
            ->get();

        return (new PersonCollection($query))
            ->additional([
                'count' => $query->count(),
                'success' => true
            ]);
    }

    /**
     * @return PersonResource|string
     */
    public function detail(EntityDetailRequest $request)
    {
        $query = QueryBuilder::for(Person::class)
            ->allowedFilters([
                AllowedFilter::exact('id')
            ])
            ->firstOrFail();

        return (new PersonResource($query))
            ->additional([
                'success' => true,
                'log_request_id' => ''
            ]);

    }

}
