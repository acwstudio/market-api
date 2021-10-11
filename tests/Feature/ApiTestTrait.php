<?php

namespace Tests\Feature;


trait ApiTestTrait
{
    public $apiResponseSuccess = 'success';
    public $apiResponseData = 'data';

    public $apiHeaders = [
        'Content-Type' => 'application/json',
        'Accept'       => 'application/vnd.api+json',
    ];

    public $apiBodyJson = [
        "filter" => []
    ];
}