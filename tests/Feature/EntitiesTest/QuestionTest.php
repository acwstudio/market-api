<?php

namespace Tests\Feature\EntitiesTest;

use App\Models\Question;

class QuestionTest implements EntityTestInterface
{
    public function getBodyRequest()
    {
        return [];
    }

    public function getFieldsWithTypes()
    {
        return [
            Question::FIELD_ID                => ['integer'],
            Question::FIELD_QUESTION          => ['string'],
            Question::FIELD_PUBLISHED         => ['integer'],
        ];
    }
}
