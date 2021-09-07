<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Question extends Model
{
    use HasFactory, SoftDeletes;

    public $table = 'questions';

    const MODEL_NAME = 'Вопросы',
        MODEL_LINK = 'questions';

    const FIELD_ID = 'id',
        FIELD_PUBLISHED = 'published',
        FIELD_QUESTION = 'question',
        FIELD_CREATED_AT = 'created_at',
        FIELD_UPDATED_AT = 'updated_at';

    public $fillable = [
        self::FIELD_ID,
        self::FIELD_PUBLISHED,
        self::FIELD_QUESTION
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

    public function getPublished()
    {
        return $this->getAttribute(self::FIELD_PUBLISHED);
    }

    public function getQuestion()
    {
        return $this->getAttribute(self::FIELD_QUESTION);
    }

    public function getName()
    {
        return $this->getAttribute(self::FIELD_QUESTION);
    }

    public function getCreatedAt()
    {
        return $this->getAttribute(self::FIELD_CREATED_AT);
    }

    public function getUpdatedAt()
    {
        return $this->getAttribute(self::FIELD_UPDATED_AT);
    }

    public function quizzes()
    {
        return $this->belongsToMany(Quiz::class);
    }

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }
}
