<?php

namespace Tests\Feature\Api;

use Illuminate\Testing\Fluent\AssertableJson;
use Tests\Feature\ApiTestTrait;
use Tests\TestCase;
use Tests\Feature\EntitiesTest\PersonTest;

class PersonMethodsTest extends TestCase
{
    use ApiTestTrait;

    const METHOD_LIST_URL = '/api/v1/persons/list';
    const METHOD_DETAIL_URL = '/api/v1/persons/detail';

    /**
     * @var PersonTest
     */
    public $personTest;

    public function __construct(?string $name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);

        $this->personTest = app(PersonTest::class);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_list()
    {
        $response = $this
            ->withHeaders($this->apiHeaders)
            ->postJson(
                self::METHOD_LIST_URL,
                array_merge($this->apiBodyJson, $this->personTest->getBodyRequest())
            );


        $response
            ->assertJson(function (AssertableJson $json) {
                $json
                    ->where($this->apiResponseSuccess, true)
                    ->has($this->apiResponseData)
                    ->has($this->apiResponseData . ".0", function (AssertableJson $json) {
                        $json->whereAllType($this->personTest->getFieldsWithTypes());
                        $json->etc();
                    })
                    ->etc();
            })
            ->assertStatus(200);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_detail()
    {
        $personId = null;

        try {
            $personId = $this->personTest->getPersonFirstId();
        } catch (\Exception $exception) {
            $this->expectErrorMessage($exception->getMessage());
        }

        $response = $this
            ->withHeaders($this->apiHeaders)
            ->postJson(
                self::METHOD_DETAIL_URL,
                array_merge($this->apiBodyJson, [
                    "filter" => ["id" => $personId]
                ])
            );

        $response
            ->assertJson(function (AssertableJson $json) {
                $json
                    ->where($this->apiResponseSuccess, true)
                    ->has($this->apiResponseData, function (AssertableJson $json) {
                        $json->whereAllType($this->personTest->getFieldsWithTypes());
                        $json->etc();
                    })
                    ->etc();
            })
            ->assertStatus(200);
    }
}
