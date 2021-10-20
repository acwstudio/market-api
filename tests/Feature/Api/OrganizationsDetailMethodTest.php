<?php

namespace Tests\Feature\Api;

use Illuminate\Testing\Fluent\AssertableJson;
use Tests\Feature\ApiTestTrait;
use Tests\Feature\EntitiesTest\OrganizationTest;
use Tests\TestCase;

class OrganizationsDetailMethodTest extends TestCase
{
    use ApiTestTrait;

    const METHOD_URL = '/api/v1/organizations/detail';

    /**
     * @var OrganizationTest
     */
    public $organizationTest;

    public function __construct(?string $name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);

        $this->organizationTest = app(OrganizationTest::class);
    }

    /**
     * @group test
     */
    public function test_successfulResponseDataHasRequiredFieldsAndTypes()
    {
        $response = $this
            ->withHeaders($this->apiHeaders)
            ->postJson(
                self::METHOD_URL,
                $this->apiBodyJson
            );

        $response
            ->assertJson(function (AssertableJson $json) {
                $json
                    ->where($this->apiResponseSuccess, true)
                    ->has($this->apiResponseData, function (AssertableJson $json) {
                        $json->whereAllType($this->organizationTest->getFieldsWithTypes());
                        $json->etc();
                    })
                    ->etc();
            })
            ->assertStatus(200);
    }
}










