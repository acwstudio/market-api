<?php

namespace Tests\Feature\Api;

use Illuminate\Testing\Fluent\AssertableJson;
use Tests\Feature\ApiTestTrait;
use Tests\Feature\EntitiesTest\FormatTest;
use Tests\TestCase;

class FormatMethodsTest extends TestCase
{
    use ApiTestTrait;

    const METHOD_LIST_URL = '/api/v1/formats/list';
    const METHOD_DETAIL_URL = '/api/v1/formats/detail';

    /**
     * @var FormatTest
     */
    public $formatTest;

    public function __construct(?string $name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);

        $this->formatTest = app(FormatTest::class);
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
                array_merge($this->apiBodyJson, $this->formatTest->getBodyRequest())
            );


        $response
            ->assertJson(function (AssertableJson $json) {
                $json
                    ->where($this->apiResponseSuccess, true)
                    ->has($this->apiResponseData)
                    ->has($this->apiResponseData . ".0", function (AssertableJson $json) {
                        $json->whereAllType($this->formatTest->getFieldsWithTypes());
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
        $formatId = null;

        try {
            $formatId = $this->formatTest->getFormatFirstId();
        } catch (\Exception $exception) {
            $this->expectErrorMessage($exception->getMessage());
        }

        $response = $this
            ->withHeaders($this->apiHeaders)
            ->postJson(
                self::METHOD_DETAIL_URL,
                array_merge($this->apiBodyJson, [
                    "filter" => ["id" => $formatId]
                ])
            );

        $response
            ->assertJson(function (AssertableJson $json) {
                $json
                    ->where($this->apiResponseSuccess, true)
                    ->has($this->apiResponseData, function (AssertableJson $json) {
                        $json->whereAllType($this->formatTest->getFieldsWithTypes());
                        $json->etc();
                    })
                    ->etc();
            })
            ->assertStatus(200);
    }
}
