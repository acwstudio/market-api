<?php

namespace Tests\Feature\Api;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\Feature\ApiTestTrait;
use Tests\Feature\EntitiesTest\DirectionTest;
use Tests\TestCase;

class DirectionMethodsTest extends TestCase
{
    use ApiTestTrait;

    const METHOD_LIST_URL = '/api/v1/directions/list';
    const METHOD_DETAIL_URL = '/api/v1/directions/detail';

    /**
     * @var Application|mixed
     */
    private $directionTest;

    public function __construct(?string $name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);

        $this->directionTest = app(DirectionTest::class);
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
                array_merge($this->apiBodyJson, $this->directionTest->getBodyRequest())
            );


        $response
            ->assertJson(function (AssertableJson $json) {
                $json
                    ->where($this->apiResponseSuccess, true)
                    ->has($this->apiResponseData)
                    ->has($this->apiResponseData . ".0", function (AssertableJson $json) {
                        $json->whereAllType($this->directionTest->getFieldsWithTypes());
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
        $directionId = null;

        try {
            $directionId = $this->directionTest->getDirectionFirstId();
        } catch (\Exception $exception) {
            $this->expectErrorMessage($exception->getMessage());
        }

        $response = $this
            ->withHeaders($this->apiHeaders)
            ->postJson(
                self::METHOD_DETAIL_URL,
                array_merge($this->apiBodyJson, [
                    "filter" => ["id" => $directionId]
                ])
            );

        $response
            ->assertJson(function (AssertableJson $json) {
                $json
                    ->where($this->apiResponseSuccess, true)
                    ->has($this->apiResponseData, function (AssertableJson $json) {
                        $json->whereAllType($this->directionTest->getFieldsWithTypes());
                        $json->etc();
                    })
                    ->etc();
            })
            ->assertStatus(200);
    }
}
