<?php

namespace App\Http\Controllers;

use App\Http\Requests\EntityDetailRequest;
use App\Http\Resources\PersonCollection;
use App\Http\Resources\PersonResource;
use App\Http\Resources\PersonListCollection;
use App\Models\Person;
use App\Models\Product;
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
                AllowedFilter::exact('ids', Person::FIELD_ID),
                AllowedFilter::exact(Person::FIELD_PUBLISHED),
                AllowedFilter::exact(Person::FIELD_NAME),
                AllowedFilter::exact(Person::FIELD_SHOW_MAIN),
                AllowedFilter::exact('product_ids', implode('.', [Person::ENTITY_RELATIVE_PRODUCTS, Product::FIELD_ID]))
            ])
            ->allowedSorts([Person::FIELD_POSITION, Person::FIELD_NAME, Person::FIELD_ID])
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
                AllowedFilter::exact(Person::FIELD_ID)
            ])
            ->firstOrFail();

        return (new PersonResource($query))
            ->additional([
                'success' => true,
                'log_request_id' => ''
            ]);

    }

}
