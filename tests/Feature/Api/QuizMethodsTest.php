<?php

namespace Tests\Feature\Api;

use Illuminate\Testing\Fluent\AssertableJson;
use Tests\Feature\ApiTestTrait;
use Tests\Feature\EntitiesTest\AnswerTest;
use Tests\Feature\EntitiesTest\QuestionTest;
use Tests\Feature\EntitiesTest\QuizTest;
use Tests\TestCase;

class QuizMethodsTest extends TestCase
{
    use ApiTestTrait;

    const METHOD_LIST_URL = '/api/v1/quizzes/list';
    const METHOD_DETAIL_URL = '/api/v1/quizzes/detail';

    /**
     * @var QuizTest
     */
    public $quizTest;
    /**
     * @var QuestionTest
     */
    public $questionTest;
    /**
     * @var AnswerTest
     */
    public $answerTest;

    public function __construct(?string $name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);

        $this->quizTest = app(QuizTest::class);
        $this->questionTest = app(QuestionTest::class);
        $this->answerTest = app(AnswerTest::class);
    }

    public function test_list_with_questions_and_answers()
    {

        $response = $this
            ->withHeaders($this->apiHeaders)
            ->postJson(
                self::METHOD_LIST_URL,
                array_merge($this->apiBodyJson, $this->quizTest->getBodyRequest())
            );

        $response
            ->assertJson(function (AssertableJson $json) {
                $json
                    ->where($this->apiResponseSuccess, true)
                    ->has($this->apiResponseData)
                    ->has($this->apiResponseData . ".0", function (AssertableJson $json) {
                        $json->whereAllType($this->quizTest->getFieldsWithTypes());
                        $json->etc();
                    })
                    ->has($this->apiResponseData . ".0.questions.0", function (AssertableJson $json) {
                        $json->whereAllType($this->questionTest->getFieldsWithTypes());
                        $json->etc();
                    })
                    ->has($this->apiResponseData . ".0.questions.0.answers.0", function (AssertableJson $json) {
                        $json->whereAllType($this->answerTest->getFieldsWithTypes());
                        $json->etc();
                    })
                    ->etc();
            })
            ->assertStatus(200);
    }

    public function test_detail_with_questions_and_answers()
    {
        $quizId = null;

        try {
            $quizId = $this->quizTest->getQuizFirstId();
        } catch (\Exception $exception) {
            $this->expectErrorMessage($exception->getMessage());
        }

        $response = $this
            ->withHeaders($this->apiHeaders)
            ->postJson(
                self::METHOD_DETAIL_URL,
                array_merge($this->apiBodyJson, [
                    "filter" => ["id" => $quizId],
                ])
            );

        $response
            ->assertJson(function (AssertableJson $json) {
                $json
                    ->where($this->apiResponseSuccess, true)
                    ->has($this->apiResponseData, function (AssertableJson $json) {
                        $json->whereAllType($this->quizTest->getFieldsWithTypes());
                        $json->etc();
                    })
                    ->has($this->apiResponseData . ".questions.0", function (AssertableJson $json) {
                        $json->whereAllType($this->questionTest->getFieldsWithTypes());
                        $json->etc();
                    })
                    ->has($this->apiResponseData . ".questions.0.answers.0", function (AssertableJson $json) {
                        $json->whereAllType($this->answerTest->getFieldsWithTypes());
                        $json->etc();
                    })
                    ->etc();
            })
            ->assertStatus(200);
    }
}
