<?php

namespace App\Http\Resources;

use App\Models\Subject;
use Illuminate\Http\Resources\Json\JsonResource;

class SubjectResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        /** @var Subject $subject */
        $subject = $this->resource;

        return [
            Subject::FIELD_ID         => $subject->getId(),
            'type'                   => 'subjects',
            Subject::FIELD_PUBLISHED  => $subject->getPublished(),
            Subject::FIELD_NAME       => $subject->getName(),
            Subject::FIELD_SLUG       => $subject->getSlug(),
            Subject::FIELD_CREATED_AT => $subject->getCreatedAt(),
            Subject::FIELD_UPDATED_AT => $subject->getUpdatedAt(),
        ];
    }
}
