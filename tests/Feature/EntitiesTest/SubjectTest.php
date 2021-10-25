<?php

declare(strict_types=1);

namespace Tests\Feature\EntitiesTest;

use App\Models\Subject;
use Exception;
use Illuminate\Support\Facades\DB;

class SubjectTest implements EntityTestInterface
{
    /**
     * @return array
     */
    public function getBodyRequest(): array
    {
        return [];
    }

    /**
     * @return string[][]
     */
    public function getFieldsWithTypes(): array
    {
        return [
            Subject::FIELD_ID            => ['integer'],
            Subject::FIELD_PUBLISHED     => ['integer'],
            Subject::FIELD_NAME          => ['string'],
            Subject::FIELD_SLUG          => ['string', 'null'],
            Subject::FIELD_CREATED_AT    => ['string', 'null'],
            Subject::FIELD_UPDATED_AT    => ['string', 'null'],
        ];
    }

    /**
     * @throws Exception
     */
    public function getDirectionFirstId()
    {
        $subject = DB::table('subjects')->first();

        if (is_null($subject)) {
            throw new Exception('Subjects table is empty. Need one entry');
        }

        return $subject->id;
    }

}
