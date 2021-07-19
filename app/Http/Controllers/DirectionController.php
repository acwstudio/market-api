<?php

namespace App\Http\Controllers;

use App\Core\Error\ErrorManager;
use App\Core\Input\Fields\Direction\DirectionGetList;
use App\Core\Response\ResponseTrait;
use App\Models\Direction;
use App\Repositories\DirectionRepository;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DirectionController extends Controller
{
    use ResponseTrait;

    /**
     * @var DirectionRepository
     */
    public $directionRepository;

    public function __construct(DirectionRepository $directionRepository)
    {
        $this->directionRepository = $directionRepository;
    }

    public function list(Request $request)
    {
        if (!$request->isJson()) {
            return $this->errorResponse([
                ErrorManager::buildValidateError(VALIDATION_REQUEST_JSON_EXPECTED)->toArray()
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $requestFieldSet = new DirectionGetList($request->json()->all() ? $request->json()->all() : []);

        $requestFieldSet->validate();

        $errors = $requestFieldSet->getErrorsArray();

        if (count($errors)) {
            return $this->errorResponse($errors, Response::HTTP_OK);
        }

        $requestFieldSet->prepare();

        $filteredResults = $this->directionRepository->getList($requestFieldSet);

        $list = [];
        /** @var Direction $direction */
        foreach ($filteredResults['directions'] as $direction) {

            $list[] = [
                Direction::FIELD_ID            => $direction->getId(),
                Direction::FIELD_NAME          => $direction->getName(),
                Direction::FIELD_SLUG          => $direction->getSlug(),
                Direction::FIELD_PREVIEW_IMAGE => $direction->getPreviewImageUrl(),
                Direction::FIELD_SHOW_MAIN     => $direction->getShowMain()
            ];
        }

        return $this->successResponse([
            'list'  => $list,
            'count' => $filteredResults['count'],
        ]);
    }
}
