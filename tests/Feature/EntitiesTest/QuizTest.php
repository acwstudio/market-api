<?php

namespace Tests\Feature\EntitiesTest;

use App\Models\Quiz;
use Exception;
use Illuminate\Support\Facades\DB;

class QuizTest implements EntityTestInterface
{
    public function getBodyRequest()
    {
        return [
            'include' => 'questions, questions.answers'
        ];
    }

    public function getFieldsWithTypes()
    {
        return [
            Quiz::FIELD_ID => ['integer'],
            Quiz::FIELD_LEAD_ID => ['integer'],
            Quiz::FIELD_NAME => ['string', 'null'],
            Quiz::FIELD_DESCRIPTION => ['string', 'null'],
            Quiz::FIELD_PAGE => ['integer'],
            Quiz::FIELD_TITLE => ['string'],
            Quiz::FIELD_TEXT => ['string'],
            Quiz::FIELD_BUTTON => ['string'],
            Quiz::FIELD_PUBLISHED => ['integer'],
            Quiz::FIELD_BACKGROUND_IMAGE => ['string', 'null'],
            Quiz::FIELD_PERSON_IMAGE => ['string', 'null'],
        ];
    }

    /**
     * @throws Exception
     */
    public function getQuizFirstId()
    {
        $quiz = DB::table('quizzes')->first();

        if (is_null($quiz)) {
            throw new Exception('quizzes table is empty. need one entry');
        }

        return $quiz->id;
    }
}
