<?php

declare(strict_types=1);

namespace Tests\Feature\Api;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\Feature\ApiTestTrait;
use Tests\Feature\EntitiesTest\SubjectTest;
use Tests\TestCase;

class SubjectMethodsTest extends TestCase
{
    use ApiTestTrait;

    const METHOD_LIST_URL = '/api/v1/subjects/list';
    const METHOD_DETAIL_URL = '/api/v1/subjects/detail';

    /**
     * @var Application|mixed
     */
    private $subjectTest;

    public function __construct(?string $name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);

        $this->subjectTest = app(SubjectTest::class);
    }

    public function test_list()
    {
        $response = $this
            ->withHeaders($this->apiHeaders)
            ->postJson(
                self::METHOD_LIST_URL,
                array_merge($this->apiBodyJson, $this->subjectTest->getBodyRequest())
            );

        $response
            ->assertJson(function (AssertableJson $json) {
                $json
                    ->where($this->apiResponseSuccess, true)
                    ->has($this->apiResponseData)
                    ->has($this->apiResponseData . ".0", function (AssertableJson $json) {
                        $json->whereAllType($this->subjectTest->getFieldsWithTypes());
                        $json->etc();
                    })
                    ->etc();
            })
            ->assertStatus(200);
    }

    public function test_detail()
    {
        $subjectId = null;

        try {
            $subjectId = $this->subjectTest->getDirectionFirstId();
        } catch (\Exception $exception) {
            $this->expectErrorMessage($exception->getMessage());
        }

        $response = $this
            ->withHeaders($this->apiHeaders)
            ->postJson(
                self::METHOD_DETAIL_URL,
                array_merge($this->apiBodyJson, [
                    "filter" => ["id" => $subjectId]
                ])
            );

        $response
            ->assertJson(function (AssertableJson $json) {
                $json
                    ->where($this->apiResponseSuccess, true)
                    ->has($this->apiResponseData, function (AssertableJson $json) {
                        $json->whereAllType($this->subjectTest->getFieldsWithTypes());
                        $json->etc();
                    })
                    ->etc();
            })
            ->assertStatus(200);
    }

}
