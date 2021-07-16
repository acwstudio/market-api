<?php


namespace App\Http\Controllers;


use App\Core\Error\ErrorManager;
use App\Core\FieldSet;
use App\Core\Input\Fields\Subject\SubjectGetList;
use App\Core\Response\ResponseTrait;
use App\Models\Subject;
use App\Repositories\SubjectRepository;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SubjectController extends Controller
{
    use ResponseTrait;

    /**
     * @var SubjectRepository
     */
    public $subjectRepository;

    public function __construct(SubjectRepository $subjectRepository)
    {
        $this->subjectRepository = $subjectRepository;
    }

    public function list(Request $request){
        if (!$request->isJson()) {
            return $this->errorResponse([
                ErrorManager::buildValidateError(VALIDATION_REQUEST_JSON_EXPECTED)->toArray()
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $requestFieldSet = new SubjectGetList($request->json()->all() ? $request->json()->all() : []);

        $requestFieldSet->validate();

        $errors = $requestFieldSet->getErrorsArray();

        if (count($errors)) {
            return $this->errorResponse($errors, Response::HTTP_OK);
        }

        $requestFieldSet->prepare();

        $filteredResult = $this->subjectRepository->getList($requestFieldSet);

        $list = [];
        /** @var Subject $subjects */
        foreach($filteredResult['subjects'] as $subjects){
            $list[] = [
                Subject::FIELD_ID      => $subjects->getId(),
                Subject::FIELD_NAME    => $subjects->getName(),
                Subject::FIELD_SLUG    => $subjects->getSlug(),
            ];
        }

        return $this->successResponse([
            'list'  => $list,
            'count' => $filteredResult['count'],
        ]);
    }
}
