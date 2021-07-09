<?php

namespace App\Http\Controllers;

use App\Core\Error\ErrorManager;
use App\Core\Input\Fields\Organization\OrganizationGetList;
use App\Core\FieldSet;
use App\Core\Response\ResponseTrait;
use App\Models\Organization;
use App\Repositories\OrganizationRepository;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class OrganizationController extends Controller
{
    use ResponseTrait;

    /**
     * @var OrganizationRepository
     */
    public $organizationRepository;

    public function __construct(OrganizationRepository $organizationRepository)
    {
        $this->organizationRepository = $organizationRepository;
    }

    public function list(Request $request){
        if (!$request->isJson()) {
            return $this->errorResponse([
                ErrorManager::buildValidateError(VALIDATION_REQUEST_JSON_EXPECTED)->toArray()
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $requestFieldSet = new OrganizationGetList($request->json()->all() ? $request->json()->all() : []);

        $requestFieldSet->validate();

        $errors = $requestFieldSet->getErrorsArray();

        if (count($errors)) {
            return $this->errorResponse($errors, Response::HTTP_OK);
        }

        $requestFieldSet->prepare();

        $filteredResult = $this->organizationRepository->getList($requestFieldSet);

        $list = [];
        /** @var Organization $organization */
        foreach($filteredResult['organizations'] as $organization){
            $list[] = [
                Organization::FIELD_PUBLISHED       => $organization->getPublished(),
                Organization::FIELD_ID              => $organization->getId(),
                Organization::FIELD_NAME            => $organization->getName(),
                Organization::FIELD_SLUG            => $organization->getSlug(),
                Organization::FIELD_PREVIEW_IMAGE   => $organization->getPreviewImageUrl(),
                Organization::FIELD_DIGITAL_IMAGE   => $organization->getDigitalImageUrl(),
            ];
        }

        return $this->successResponse([
            'list'  => $list,
            'count' => $filteredResult['count'],
        ]);
    }
}
