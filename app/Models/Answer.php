<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Answer extends Model
{
    use HasFactory, SoftDeletes;

    public $table = 'answers';

    const MODEL_NAME = 'Ответы',
        MODEL_LINK = 'answers';

    const FIELD_ID = 'id',
        FIELD_QUESTION_ID = 'question_id',
        FIELD_ANSWER = 'answer',
        FIELD_NEXT_QUESTION_ID = 'next_question_id',
        FIELD_CREATED_AT = 'created_at',
        FIELD_UPDATED_AT = 'updated_at';

    public $fillable = [
        self::FIELD_QUESTION_ID,
        self::FIELD_ANSWER,
        self::FIELD_NEXT_QUESTION_ID,
    ];

    public static function getModelName()
    {
        return self::MODEL_NAME;
    }

    public static function getModelLink()
    {
        return self::MODEL_LINK;
    }

    public function getId()
    {
        return $this->getAttribute(self::FIELD_ID);
    }

    public function getQuestionId()
    {
        return $this->getAttribute(self::FIELD_QUESTION_ID);
    }

    public function getAnswer()
    {
        return $this->getAttribute(self::FIELD_ANSWER);
    }

    public function getName()
    {
        return $this->getAttribute(self::FIELD_ANSWER);
    }

    public function getNextQuestionId()
    {
        return $this->getAttribute(self::FIELD_NEXT_QUESTION_ID);
    }

    public function getCreatedAt()
    {
        return $this->getAttribute(self::FIELD_CREATED_AT);
    }

    public function getUpdatedAt()
    {
        return $this->getAttribute(self::FIELD_UPDATED_AT);
    }

    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    public function nextQuestion()
    {
        return $this->belongsTo(Question::class, self::FIELD_NEXT_QUESTION_ID, Question::FIELD_ID);
    }
}
