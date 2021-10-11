<?php

namespace Tests\Feature\EntitiesTest;

use App\Models\Person;

class PersonTest implements EntityTestInterface
{
    public function getBodyRequest()
    {
        return [
            "filter" => ["show_main" => true]
        ];
    }

    public function getFieldsWithTypes()
    {
        return [
            Person::FIELD_ID => ['integer'],
            Person::FIELD_PUBLISHED => ['integer'],
            Person::FIELD_NAME => ['string'],
            Person::FIELD_POSITION => ['string', 'integer', 'null'],
            Person::FIELD_SHOW_MAIN => ['integer', 'null'],
            Person::FIELD_DESCRIPTION => ['string', 'null'],
            Person::FIELD_PREVIEW_IMAGE => ['string', 'null'],
            Person::FIELD_CREATED_AT => ['string', 'null'],
            Person::FIELD_UPDATED_AT => ['string', 'null'],
        ];
    }
}