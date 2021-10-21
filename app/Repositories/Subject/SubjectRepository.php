<?php

declare(strict_types=1);

namespace App\Repositories\Subject;

use App\Http\Requests\EntityDetailRequest;
use App\Http\Resources\SubjectResource;
use App\Models\Product;
use App\Models\Subject;
use App\Http\Resources\SubjectCollection;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

final class SubjectRepository implements SubjectRepositoryInterface
{
    /**
     * @var Subject
     */
    private $subjectModel;

    public function __construct(Subject $subject)
    {
        $this->subjectModel = $subject;
    }

    public function getSubjectsByFilters(Request $request): SubjectCollection
    {
        $queryBuilder = new QueryBuilder($this->subjectModel->newQuery(), $request);

        $query = $queryBuilder
            ->allowedFilters([
                AllowedFilter::exact('ids', Subject::FIELD_ID),
                AllowedFilter::exact(Subject::FIELD_PUBLISHED),
                AllowedFilter::exact(Subject::FIELD_NAME),
                AllowedFilter::exact(Subject::FIELD_SLUG),
                AllowedFilter::exact('product_ids', implode('.', [Subject::ENTITY_RELATIVE_PRODUCT, Product::FIELD_ID]))
            ])
            ->allowedSorts([Subject::FIELD_NAME, Subject::FIELD_ID])
            ->get();

        return new SubjectCollection($query);
    }

    public function getSubjectDetailByFilters(EntityDetailRequest $request): SubjectResource
    {
        $queryBuilder = new QueryBuilder($this->subjectModel->newQuery(), $request);

        $query = $queryBuilder
            ->allowedFilters([
                AllowedFilter::exact(Subject::FIELD_ID)
            ])
            ->firstOrFail();

        return (new SubjectResource($query))
            ->additional([
                'success'        => true,
                'log_request_id' => ''
            ]);
    }

}
