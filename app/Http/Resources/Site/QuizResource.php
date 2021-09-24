<?php

namespace App\Http\Resources\Site;

use App\Models\Quiz;
use Illuminate\Http\Resources\Json\JsonResource;

class QuizResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        /** @var Quiz $quiz */
        $quiz = $this->resource;
        return [
            Quiz::FIELD_ID               => $quiz->getId(),
            'type'                       => 'quizzes',
            Quiz::FIELD_LEAD_ID          => $quiz->getLeadId(),
            Quiz::FIELD_NAME             => $quiz->getName(),
            Quiz::FIELD_DESCRIPTION      => $quiz->getDescription(),
            Quiz::FIELD_PAGE             => $quiz->getPage(),
            Quiz::FIELD_TITLE            => $quiz->getTitle(),
            Quiz::FIELD_TEXT             => $quiz->getText(),
            Quiz::FIELD_BUTTON           => $quiz->getButton(),
            Quiz::FIELD_PUBLISHED        => $quiz->getPublished(),
            Quiz::FIELD_BACKGROUND_IMAGE => $quiz->getBackgroundImage(),
            Quiz::FIELD_PERSON_IMAGE     => $quiz->getPersonImage(),
            'questions'                  => QuestionResource::collection($this->whenLoaded('questions'))
        ];
    }
}
