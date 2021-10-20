<?php

declare(strict_types=1);

namespace App\Repositories\Person;

use App\Http\Requests\EntityDetailRequest;
use App\Http\Requests\Person\ListRequest;
use App\Http\Resources\PersonCollection;
use App\Http\Resources\PersonResource;
use App\Models\Person;
use App\Models\Product;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

final class PersonRepository implements PersonRepositoryInterface
{
    private $person;

    public function __construct(Person $person)
    {
        $this->person = $person;
    }

    public function getPersonsByFilters(ListRequest $request): PersonCollection
    {
        $queryBuilder = new QueryBuilder($this->person->newQuery(), $request);

        $query = $queryBuilder
            ->allowedFilters([
                AllowedFilter::exact('ids', Person::FIELD_ID),
                AllowedFilter::exact(Person::FIELD_PUBLISHED),
                AllowedFilter::exact(Person::FIELD_NAME),
                AllowedFilter::exact(Person::FIELD_SHOW_MAIN),
                AllowedFilter::exact('product_ids', implode('.', [Person::ENTITY_RELATIVE_PRODUCTS, Product::FIELD_ID]))
            ])
            ->allowedSorts([Person::FIELD_POSITION, Person::FIELD_NAME, Person::FIELD_ID])
            ->get();

        return new PersonCollection($query);
    }

    public function getPersonDetailById(EntityDetailRequest $request): PersonResource
    {
        $queryBuilder = new QueryBuilder($this->person->newQuery(), $request);

        $query = $queryBuilder
            ->allowedFilters([
                AllowedFilter::exact(Person::FIELD_ID)
            ])
            ->firstOrFail();

        return new PersonResource($query);
    }
}
