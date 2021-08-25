<?php
namespace App\Http\Controllers;


use Symfony\Component\HttpFoundation\Response;

trait ResponseTrait
{
    public function errorResponse(array $errors, int $httpCode = Response::HTTP_OK, $addedParams = [])
    {
        $data = ['errors' => $errors];

        if(count($addedParams)){
            $data = $addedParams + $data;
        }

        $data = [
            'success'        => false,
            'data'           => $data,
            'log_request_id' => ''
        ];

        return response()->json($data, $httpCode, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],
            JSON_UNESCAPED_UNICODE);
    }

    public function successResponse(array $data, int $httpCode = Response::HTTP_OK)
    {
        $data = [
            'success'        => true,
            'data'           => $data,
            'log_request_id' => ''
        ];

        return response()->json($data, $httpCode, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],
        JSON_UNESCAPED_UNICODE);
    }
}
