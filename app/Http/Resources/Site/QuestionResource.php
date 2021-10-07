<?php

namespace App\Http\Resources\Site;

use App\Models\Question;
use Illuminate\Http\Resources\Json\JsonResource;

class QuestionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        /** @var Question $question */
        $question = $this->resource;
        return [
            Question::FIELD_ID                => $question->getId(),
            'type'                            => 'questions',
            Question::FIELD_QUESTION          => $question->getQuestion(),
            Question::FIELD_PUBLISHED         => $question->getPublished(),
            Question::ENTITY_RELATIVE_ANSWERS => AnswerResource::collection($this->whenLoaded(Question::ENTITY_RELATIVE_ANSWERS))
        ];
    }
}
