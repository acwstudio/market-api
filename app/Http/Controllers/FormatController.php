<?php


namespace App\Http\Controllers;


use App\Core\Error\ErrorManager;
use App\Core\FieldSet;
use App\Core\Input\Fields\Format\FormatGetList;
use App\Core\Response\ResponseTrait;
use App\Models\Format;
use App\Repositories\FormatRepository;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class FormatController extends Controller
{
    use ResponseTrait;

    /**
     * @var FormatRepository
     */
    public $formatRepository;

    public function __construct(FormatRepository $formatRepository)
    {
        $this->formatRepository = $formatRepository;
    }

    public function list(Request $request){
        if (!$request->isJson()) {
            return $this->errorResponse([
                ErrorManager::buildValidateError(VALIDATION_REQUEST_JSON_EXPECTED)->toArray()
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $requestFieldSet = new FormatGetList($request->json()->all() ? $request->json()->all() : []);

        $requestFieldSet->validate();

        $errors = $requestFieldSet->getErrorsArray();

        if (count($errors)) {
            return $this->errorResponse($errors, Response::HTTP_OK);
        }

        $requestFieldSet->prepare();

        $filteredResult = $this->formatRepository->getList($requestFieldSet);

        $list = [];
        /** @var Format $organization */
        foreach($filteredResult['formats'] as $format){
            $list[] = [
                Format::FIELD_ID      => $format->getId(),
                Format::FIELD_NAME    => $format->getName(),
                Format::FIELD_SLUG    => $format->getSlug(),
            ];
        }

        return $this->successResponse([
            'list'  => $list,
            'count' => $filteredResult['count'],
        ]);
    }
}
