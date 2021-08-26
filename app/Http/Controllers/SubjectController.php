<?php


namespace App\Http\Controllers;


use App\Core\Error\ErrorManager;
use App\Core\FieldSet;
use App\Core\Input\Fields\Subject\SubjectGetList;
use App\Core\Response\ResponseTrait;
use App\Http\Requests\EntityDetailRequest;
use App\Http\Resources\SubjectCollection;
use App\Http\Resources\SubjectResource;
use App\Models\Subject;
use App\Repositories\SubjectRepository;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;
use Symfony\Component\HttpFoundation\Response;

class SubjectController extends Controller
{
    /**
     * @var SubjectRepository
     */
    public $subjectRepository;

    public function __construct(SubjectRepository $subjectRepository)
    {
        $this->subjectRepository = $subjectRepository;
    }

    public function list(Request $request){

        $query = QueryBuilder::for(Subject::class)
            ->allowedFilters([
                AllowedFilter::exact('ids', 'id'),
                AllowedFilter::exact('published'),
                AllowedFilter::exact('name'),
                AllowedFilter::exact('slug'),
                AllowedFilter::exact('product_ids', 'products.id')
            ])
            ->allowedSorts(['name', 'id'])
            ->get();

        return (new SubjectCollection($query))
            ->additional([
                'count' => $query->count(),
                'success' => true
            ]);
    }

    /**
     * @return SubjectResource
     */
    public function detail(EntityDetailRequest $request)
    {
        $query = QueryBuilder::for(Subject::class)
            ->allowedFilters([
                AllowedFilter::exact('id'),
                AllowedFilter::exact('slug'),
            ])
            ->firstOrFail();

        return (new SubjectResource($query))
            ->additional([
                'success' => true,
                'log_request_id' => ''
            ]);
    }
}
