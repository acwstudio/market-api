<?php

namespace App\Http\Controllers;

use App\Core\Error\ErrorManager;
use App\Core\Input\Fields\Organization\OrganizationGetList;
use App\Core\Input\Fields\Organization\OrganizationGetDetail;
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

    public function detail(Request $request){
        if (!$request->isJson()) {
            return $this->errorResponse([
                ErrorManager::buildValidateError(VALIDATION_REQUEST_JSON_EXPECTED)->toArray()
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $requestFieldSet = new OrganizationGetDetail($request->json()->all() ? $request->json()->all() : []);

        $requestFieldSet->validate();

        $errors = $requestFieldSet->getErrorsArray();

        if (count($errors)) {
            return $this->errorResponse($errors, Response::HTTP_OK);
        }

        $requestFieldSet->prepare();

        $filteredResult = $this->organizationRepository->getDetail($requestFieldSet);

        /** @var Organization $organization */
        $response = [
            Organization::FIELD_ID                  => $filteredResult['organization']->getId(),
            Organization::FIELD_PARENT_ID           => $filteredResult['organization']->getParentId(),
            Organization::FIELD_PUBLISHED           => $filteredResult['organization']->getPublished(),
            Organization::FIELD_NAME                => $filteredResult['organization']->getName(),
            Organization::FIELD_SLUG                => $filteredResult['organization']->getSlug(),
            Organization::FIELD_SUBTITLE            => $filteredResult['organization']->getSubtitle(),
            Organization::FIELD_LAND                => $filteredResult['organization']->getLand(),
            Organization::FIELD_DESCRIPTION         => $filteredResult['organization']->getDescription(),
            Organization::FIELD_HTML_BODY           => $filteredResult['organization']->getHtmlBody(),
            Organization::FIELD_CLASSES             => $filteredResult['organization']->getClasses(),
            Organization::FIELD_COLOR_CODE_TITLES   => $filteredResult['organization']->getColorCodeTitles(),
            Organization::FIELD_ADDRESS             => $filteredResult['organization']->getAddress(),
            Organization::FIELD_TYPE_TEXT           => $filteredResult['organization']->getTypeText(),
            Organization::FIELD_MAP_LINK            => $filteredResult['organization']->getMapLink(),
            Organization::FIELD_PREVIEW_IMAGE       => $filteredResult['organization']->getPreviewImageUrl(),
            Organization::FIELD_DIGITAL_IMAGE       => $filteredResult['organization']->getDigitalImageUrl(),
            Organization::FIELD_CREATED_AT          => $filteredResult['organization']->getCreatedAt(),
            Organization::FIELD_UPDATED_AT          => $filteredResult['organization']->getUpdatedAt(),
        ];

        return $this->successResponse(
            $response
        );
    }
}
