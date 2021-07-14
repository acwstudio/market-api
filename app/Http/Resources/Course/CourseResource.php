<?php

namespace App\Http\Resources\Course;

use App\Http\Resources\Direction\DirectionIdentifierResource;
use App\Http\Resources\Format\FormatIdentifierResource;
use App\Http\Resources\Level\LevelIdentifierResource;
use App\Http\Resources\Organization\OrganizationIdentifierResource;
use App\Http\Resources\Person\PersonIdentifierResource;
use App\Http\Resources\Section\SectionIdentifierResource;
use App\Http\Resources\Subject\SubjectIdentifierResource;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class CourseResource
 * @package App\Http\Resources\Course
 */
class CourseResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id'   => $this->id,
            'type' => 'courses',
            'slug' => $this->slug,
            'attributes' => [
                'is_moderated'   => $this->is_moderated,
                'land'           => $this->land,
                'published'      => $this->published,
                'expiration'     => $this->expiration,
                'name'           => $this->name,
                'preview_image'  => $this->preview_image,
                'digital_image'  => $this->digital_image,
                'price'          => $this->price,
                'start_day'      => $this->start_day,
                'is_installment' => $this->is_installment,
                'installment_months' => $this->installment_months,
                'is_document'    => $this->is_document,
                'document'       => $this->document,
                'triggers'       => $this->triggers,
                'begin_duration' => $this->begin_duration,
                'duration'       => $this->duration,
                'duration_format_value'  => $this->duration_format_value,
                'description'    => $this->description,
                'organization_id' => $this->organization_id,
                'category_id'    => $this->category_id,
                'user_id'        => $this->user_id,
                'created_at'     => $this->created_at,
                'updated_at'     => $this->updated_at,
            ],
            'relationships' => [
                'subjects' => [
                    'links' => [
//                        'self' => route('event.relationships.images', ['event' => $this->id]),
                        'self' => '',
//                        'related' => route('event.images', ['event' => $this->id])
                        'related' => ''
                    ],
                    'data' => SubjectIdentifierResource::collection($this->whenLoaded('subjects'))
                ],
                'formats' => [
                    'links' => [
                        'self' => '',
                        'related' => ''
                    ],
                    'data' => FormatIdentifierResource::collection($this->whenLoaded('formats'))
                ],
                'levels' => [
                    'links' => [
                        'self' => '',
                        'related' => ''
                    ],
                    'data' => LevelIdentifierResource::collection($this->whenLoaded('levels'))
                ],
                'directions' => [
                    'links' => [
                        'self' => '',
                        'related' => ''
                    ],
                    'data' => DirectionIdentifierResource::collection($this->whenLoaded('directions'))
                ],
                'sections' => [
                    'links' => [
                        'self' => '',
                        'related' => ''
                    ],
                    'data' => SectionIdentifierResource::collection($this->whenLoaded('sections'))
                ],
                'persons' => [
                    'links' => [
                        'self' => '',
                        'related' => ''
                    ],
                    'data' => PersonIdentifierResource::collection($this->whenLoaded('persons'))
                ],
//                'product_sections' => [
//                    'links' => [
//                        'self' => '',
//                        'related' => ''
//                    ],
//                    'data' => ProductSectionIdentifierResource::collection($this->whenLoaded('productSection'))
//                ],
                'organization' => [
                    'links' => [
                        'self' => '',
                        'related' => ''
                    ],
                    'data' => new OrganizationIdentifierResource($this->whenLoaded('organization'))
                ],
            ]
        ];
    }
}
