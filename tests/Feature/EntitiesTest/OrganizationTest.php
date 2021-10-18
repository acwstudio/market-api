<?php

namespace Tests\Feature\EntitiesTest;

use App\Models\Organization;
use Exception;
use Illuminate\Support\Facades\DB;

class OrganizationTest implements EntityTestInterface
{
    public function getBodyRequest()
    {
        return [];
    }

    public function getFieldsWithTypes()
    {
        return [
            Organization::FIELD_ID => ['integer'],
            Organization::FIELD_PUBLISHED => ['integer'],
            Organization::FIELD_NAME => ['string'],
            Organization::FIELD_ABBREVIATION_NAME => ['string', 'null'],
            Organization::FIELD_SLUG => ['string'],
            Organization::FIELD_LAND => ['string', 'null'],
            Organization::FIELD_SUBTITLE => ['string', 'null'],
            Organization::FIELD_DESCRIPTION => ['string', 'null'],
            Organization::FIELD_HTML_BODY => ['string', 'null'],
            Organization::FIELD_LOGO_CODE => ['string', 'null'],
            Organization::FIELD_LOGO => ['string', 'null'],
            Organization::FIELD_COLOR_CODE_TITLES => ['string', 'null'],
            Organization::FIELD_PREVIEW_IMAGE => ['string', 'null'],
            Organization::FIELD_DIGITAL_IMAGE => ['string', 'null'],
            Organization::FIELD_ADDRESS => ['string'],
            Organization::FIELD_TYPE_TEXT => ['string', 'null'],
            Organization::FIELD_MAP_LINK => ['string', 'null'],
            Organization::FIELD_PARENT_ID => ["integer", "null"],
            Organization::FIELD_CITY_ID => ["integer", "null"],
            Organization::FIELD_CREATED_AT => ['string', 'null'],
            Organization::FIELD_UPDATED_AT => ['string', 'null'],
            "included" => ['array'],
        ];
    }

    /**
     * @throws Exception
     */
    public function getOrganizationFirstId()
    {
        $organization = DB::table('organizations')->first();

        if (is_null($organization)) {
            throw new Exception('organizations table is empty. need one entry');
        }

        return $organization->id;
    }
}
