<?php

namespace App\Http\Controllers;

use App\Http\Resources\PersonDetailResource;
use App\Http\Resources\PersonListCollection;
use App\Models\Person;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class PersonController extends Controller
{
    /**
     * @param Request $request
     * @return PersonListCollection
     */
    public function list(Request $request): PersonListCollection
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

        return (new PersonListCollection($query))
            ->additional([
                'count' => $query->count(),
                'success' => true
            ]);
    }

    /**
     * @return PersonDetailResource|string
     */
    public function detail()
    {
        $query = QueryBuilder::for(Person::class)
            ->allowedFilters([
                AllowedFilter::exact('id')
            ])
            ->firstOrFail();

        return (new PersonDetailResource($query))
            ->additional([
                'success' => true,
                'log_request_id' => ''
            ]);

    }

}
