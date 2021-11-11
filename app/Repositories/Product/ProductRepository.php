<?php

declare(strict_types=1);

namespace App\Repositories\Product;

use App\Dto\Product\ProductDto;
use App\Http\Requests\Product\DetailRequest;
use App\Http\Requests\Product\ListRequest;
use App\Http\Resources\ProductResource;
use App\Models\Direction;
use App\Models\Format;
use App\Models\Level;
use App\Models\Organization;
use App\Models\Person;
use App\Models\Product;
use App\Models\ProductPlace;
use App\Models\Subject;
use Carbon\Carbon;
use App\Http\Resources\ProductCollection;
use Illuminate\Database\Eloquent\Builder;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

final class ProductRepository implements ProductRepositoryInterface
{
    private Product $productModel;

    public function __construct(Product $product)
    {
        $this->productModel = $product;
    }

    public function updateOrCreate(ProductDto $dto): ProductDto
    {
        $product = $this->productModel
            ->newQuery()
            ->updateOrCreate([
                Product::FIELD_ID => $dto->getId()
            ], $dto->toArray());

        $dto->setId($product->id)
            ->setEloquent($product);

        $this->attachRelations($dto);

        return $dto;
    }

    public static function dateToDisplayFormat(?string $date): ?string
    {
        return $date ? Carbon::parse($date)->format('d.m.Y H:i') : $date;
    }

    public function getProductsByFilters(ListRequest $request): ProductCollection
    {
        $queryBuilder = new QueryBuilder($this->productModel->newQuery(), $request);

        $query = $queryBuilder
            ->allowedFilters([
                AllowedFilter::exact('ids', Product::FIELD_ID),
                AllowedFilter::exact(Product::FIELD_PUBLISHED),
                AllowedFilter::exact(Product::FIELD_NAME),
                AllowedFilter::exact(Product::FIELD_SLUG),
                AllowedFilter::callback(Product::FIELD_EXPIRATION_DATE, function (Builder $query, $value) {
                    $query->whereDate(Product::FIELD_EXPIRATION_DATE, '<=', date('Y-m-d H:i:s', strtotime($value)));
                }),
                AllowedFilter::exact(Product::FIELD_IS_DOCUMENT),
                AllowedFilter::exact(Product::FIELD_IS_INSTALLMENT),
                AllowedFilter::exact(Product::FIELD_IS_EMPLOYMENT),
                AllowedFilter::exact('category_ids', Product::FIELD_CATEGORY_ID),
                AllowedFilter::exact('organization_ids', Product::FIELD_ORGANIZATION_ID),
                AllowedFilter::exact('city_ids', implode('.', [Product::ENTITY_RELATIVE_ORGANIZATION, Organization::FIELD_CITY_ID])),
                AllowedFilter::exact('subject_ids', implode('.', [Product::ENTITY_RELATIVE_SUBJECTS, Subject::FIELD_ID])),
                AllowedFilter::exact('format_ids', implode('.', [Product::ENTITY_RELATIVE_FORMATS, Format::FIELD_ID])),
                AllowedFilter::exact('level_ids', implode('.', [Product::ENTITY_RELATIVE_LEVELS, Level::FIELD_ID])),
                AllowedFilter::exact('direction_ids', implode('.', [Product::ENTITY_RELATIVE_DIRECTIONS, Direction::FIELD_ID])),
                AllowedFilter::exact('person_ids', implode('.', [Product::ENTITY_RELATIVE_PERSONS, Person::FIELD_ID])),
                AllowedFilter::exact('product_place_ids', implode('.', [Product::ENTITY_RELATIVE_PRODUCT_PLACES, ProductPlace::FIELD_ID])),
            ])
            ->allowedIncludes([
                Product::ENTITY_RELATIVE_ORGANIZATION,
                Product::ENTITY_RELATIVE_LEVELS,
                Product::ENTITY_RELATIVE_DIRECTIONS,
                Product::ENTITY_RELATIVE_FORMATS,
                implode('.', [Product::ENTITY_RELATIVE_ORGANIZATION, Organization::ENTITY_RELATIVE_CITY]),
                Product::ENTITY_RELATIVE_PERSONS
            ])
            ->allowedSorts([Product::FIELD_NAME, Product::FIELD_ID, Product::FIELD_EXPIRATION_DATE, Product::FIELD_SORT]);

        $page = 1;
        $pageSize = 10;

        $pagination = $request->get('pagination') ?? ['page' => $page, 'page_size' => $pageSize];

        return new ProductCollection($query->paginate(
            $pagination['page_size'] ?? $pageSize,
            $columns = ['*'],
            $pageName = 'page',
            $pagination['page'] ?? $page
        ));
    }

    public function getProductDetailByFilters(DetailRequest $request): ProductResource
    {
        $queryBuilder = new QueryBuilder($this->productModel->newQuery(), $request);

        $query = $queryBuilder
            ->allowedFilters([
                AllowedFilter::exact(Product::FIELD_ID),
                AllowedFilter::exact(Product::FIELD_SLUG)
            ])
            ->allowedIncludes([
                Product::ENTITY_RELATIVE_ORGANIZATION,
                Product::ENTITY_RELATIVE_LEVELS,
                Product::ENTITY_RELATIVE_DIRECTIONS,
                Product::ENTITY_RELATIVE_FORMATS,
                implode('.', [Product::ENTITY_RELATIVE_ORGANIZATION, Organization::ENTITY_RELATIVE_CITY]),
                Product::ENTITY_RELATIVE_PERSONS
            ])
            ->firstOrFail();

        return (new ProductResource($query));
    }

    public function delete(int $id): void
    {
        $this->productModel
            ->newQuery()
            ->where(Product::FIELD_ID, $id)
            ->delete();
    }

    private function attachRelations(ProductDto $dto): void
    {
        /**
         * @todo не красивая реализации, было бы не плохо отрефакторить саму концепцию
         */
        $eloquent = $dto->getEloquent();

        $eloquent->directions()->detach(array_column($eloquent->{Product::ENTITY_RELATIVE_DIRECTIONS}->toArray(), Direction::FIELD_ID));
        if ($directions = $dto->getDirections()) {
            $eloquent->directions()->attach($directions);
        }

        $eloquent->formats()->detach(array_column($eloquent->{Product::ENTITY_RELATIVE_FORMATS}->toArray(), Format::FIELD_ID));
        if ($formats = $dto->getFormats()) {
            $eloquent->formats()->attach($formats);
        }

        $eloquent->levels()->detach(array_column($eloquent->{Product::ENTITY_RELATIVE_LEVELS}->toArray(), Level::FIELD_ID));
        if ($levels = $dto->getLevels()) {
            $eloquent->levels()->attach($levels);
        }

        $eloquent->subjects()->detach(array_column($eloquent->{Product::ENTITY_RELATIVE_SUBJECTS}->toArray(), Subject::FIELD_ID));
        if ($subjects = $dto->getSubjects()) {
            $eloquent->subjects()->attach($subjects);
        }

        $eloquent->persons()->detach(array_column($eloquent->{Product::ENTITY_RELATIVE_PERSONS}->toArray(), Person::FIELD_ID));
        if ($persons = $dto->getPersons()) {
            $eloquent->persons()->attach($persons);
        }

        $eloquent->productplaces()->detach(array_column($eloquent->{Product::ENTITY_RELATIVE_PRODUCT_PLACES}->toArray(), Person::FIELD_ID));
        if ($productPlaces = $dto->getProductPlaces()) {
            $eloquent->productplaces()->attach($productPlaces);
        }
    }
}
