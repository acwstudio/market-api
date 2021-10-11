<?php

namespace Tests\Feature\Api;

use Illuminate\Testing\Fluent\AssertableJson;
use Tests\Feature\ApiTestTrait;
use Tests\TestCase;
use App\Models\Person;
use Tests\Feature\EntitiesTest\PersonTest;

class PersonsListMethodTest extends TestCase
{
    use ApiTestTrait;

    const METHOD_URL = '/api/v1/persons/list';

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
    public function test_example()
    {
        $response = $this
            ->withHeaders($this->apiHeaders)
            ->postJson(
                self::METHOD_URL,
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
}
