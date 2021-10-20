<?php

namespace App\Http\Resources;

use App\Models\OrganizationTrigger;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrganizationTriggerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request)
    {
        /** @var OrganizationTrigger $trigger */
        $trigger = $this->resource;

        return [
            OrganizationTrigger::FIELD_ID          => $trigger->getId(),
            'type'                                 => 'triggers',
            OrganizationTrigger::FIELD_NAME        => $trigger->getName(),
            OrganizationTrigger::FIELD_DESCRIPTION => $trigger->getDescription(),
            OrganizationTrigger::FIELD_CREATED_AT  => $trigger->getCreatedAt(),
            OrganizationTrigger::FIELD_UPDATED_AT  => $trigger->getUpdatedAt(),
        ];
    }

}
