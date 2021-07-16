<?php

namespace App\Http\Controllers;

use App\Core\Input\Fields\Product\ProductGetList;
use App\Core\Response\ResponseTrait;
use App\Repositories\ProductRepository;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Product;
use App\Core\Error\ErrorManager;

class TestController extends Controller
{
    use ResponseTrait;

    /**
     * @var ProductRepository
     */
    public $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function test(Request $request)
    {
        if (!$request->isJson()) {
            return $this->errorResponse([
                ErrorManager::buildValidateError(VALIDATION_REQUEST_JSON_EXPECTED)->toArray()
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $requestFieldSet = new ProductGetList($request->json()->all() ? $request->json()->all() : []);

        $requestFieldSet->validate();

        $errors = $requestFieldSet->getErrorsArray();

        if (count($errors)) {
            return $this->errorResponse($errors, Response::HTTP_OK);
        }

        $requestFieldSet->prepare();

        $filteredResults = $this->productRepository->getList($requestFieldSet);

        $list = [];
        /** @var Product $product */
        foreach ($filteredResults['products'] as $product) {

            $list[] = [
                Product::FIELD_ID => $product->getId(),
                Product::FIELD_NAME => $product->getName(),
                Product::FIELD_SLUG => $product->getSlug()
            ];
        }

//        dd(
//            $requestFieldSet->getFilter()->getName()->getValue(),
//            $request->json()->all()
//        );

        return $this->successResponse([
            'list' => $list,
            'count' => $filteredResults['count'],
        ]);
    }
}