<?php

namespace Tests\Feature\EntitiesTest;

use App\Models\Direction;
use Illuminate\Support\Facades\DB;
use Exception;

class DirectionTest
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
            Direction::FIELD_ID            => ['integer'],
            Direction::FIELD_PUBLISHED     => ['integer'],
            Direction::FIELD_NAME          => ['string'],
            Direction::FIELD_SHOW_MAIN     => ['integer', 'null'],
            Direction::FIELD_SORT          => ['integer', 'null'],
            Direction::FIELD_PREVIEW_IMAGE => ['string', 'null'],
            Direction::FIELD_SLUG          => ['string', 'null'],
            Direction::FIELD_CREATED_AT    => ['string', 'null'],
            Direction::FIELD_UPDATED_AT    => ['string', 'null'],
        ];
    }

    /**
     * @return mixed
     * @throws Exception
     */
    public function getDirectionFirstId()
    {
        $direction = DB::table('directions')->first();

        if (is_null($direction)) {
            throw new Exception('Direction table is empty. Need one entry');
        }

        return $direction->id;
    }

}
