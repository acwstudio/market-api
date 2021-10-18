<?php

namespace Tests\Feature\EntitiesTest;

use App\Models\Answer;

class AnswerTest implements EntityTestInterface
{
    public function getBodyRequest()
    {
        return [];
    }

    public function getFieldsWithTypes()
    {
        return [
            Answer::FIELD_ID               => ['integer'],
            Answer::FIELD_QUESTION_ID      => ['integer'],
            Answer::FIELD_ANSWER           => ['string'],
            Answer::FIELD_NEXT_QUESTION_ID => ['integer'],
        ];
    }
}
