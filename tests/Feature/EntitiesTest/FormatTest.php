<?php

namespace Tests\Feature\EntitiesTest;

use App\Models\Format;
use Illuminate\Support\Facades\DB;
use Exception;

class FormatTest implements EntityTestInterface
{
    public function getBodyRequest()
    {
        return [];
    }

    public function getFieldsWithTypes()
    {

        return [
            Format::FIELD_ID => ['integer'],
            Format::FIELD_PUBLISHED => ['integer'],
            Format::FIELD_NAME => ['string'],
            Format::FIELD_SLUG => ['string'],
            Format::FIELD_CREATED_AT => ['string', 'null'],
            Format::FIELD_UPDATED_AT => ['string', 'null'],
        ];
    }

    /**
     * @throws Exception
     */
    public function getFormatFirstId()
    {
        $format = DB::table('formats')->first();

        if (is_null($format)) {
            throw new Exception('formats table is empty. need one entry');
        }

        return $format->id;
    }
}
