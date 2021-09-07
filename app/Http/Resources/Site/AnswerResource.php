<?php

namespace App\Http\Resources\Site;

use App\Models\Answer;
use Illuminate\Http\Resources\Json\JsonResource;

class AnswerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        /** @var Answer $answer */
        $answer = $this->resource;
        return [
            Answer::FIELD_ID               => $answer->getId(),
            'type'                         => 'answers',
            Answer::FIELD_QUESTION_ID      => $answer->getQuestionId(),
            Answer::FIELD_ANSWER           => $answer->getAnswer(),
            Answer::FIELD_NEXT_QUESTION_ID => $answer->getNextQuestionId(),
        ];
    }
}
