<?php

namespace Tests\Feature\Api;

use Illuminate\Testing\Fluent\AssertableJson;
use Tests\Feature\ApiTestTrait;
use Tests\Feature\EntitiesTest\OrganizationTest;
use Tests\TestCase;

class OrganizationsListMethodTest extends TestCase
{
    use ApiTestTrait;

    const METHOD_URL = '/api/v1/organizations/list';

    /**
     * @var OrganizationTest
     */
    public $organizationTest;

    public function __construct(?string $name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);

        $this->organizationTest = app(OrganizationTest::class);
    }


    public function test_successfulResponseDataHasRequiredFieldsAndTypes()
    {
        $response = $this
            ->withHeaders($this->apiHeaders)
            ->postJson(
                self::METHOD_URL,
                array_merge($this->apiBodyJson, $this->organizationTest->getBodyRequest())
            );

        $response
            ->assertJson(function (AssertableJson $json) {
                $json
                    ->where($this->apiResponseSuccess, true)
                    ->has($this->apiResponseData)
                    ->has($this->apiResponseData . ".0", function (AssertableJson $json) {
                        $json->whereAllType($this->organizationTest->getFieldsWithTypes());
                        $json->etc();
                    })
                    ->etc();
            })
            ->assertStatus(200);
    }
}
