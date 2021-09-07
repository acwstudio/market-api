<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lead extends Model
{
    use HasFactory, SoftDeletes;

    public $table = 'leads';

    const MODEL_NAME = 'Лиды',
        MODEL_LINK = 'leads';

    const FIELD_ID = 'id',
        FIELD_NAME = 'name',
        FIELD_DESCRIPTION = 'description',
        FIELD_TITLE = 'title',
        FIELD_TEXT = 'text',
        FIELD_CREATED_AT = 'created_at',
        FIELD_UPDATED_AT = 'updated_at';

    public $fillable = [
        self::FIELD_NAME,
        self::FIELD_DESCRIPTION,
        self::FIELD_TITLE,
        self::FIELD_TEXT,
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

    public function getName()
    {
        return $this->getAttribute(self::FIELD_NAME);
    }

    public function getDescription()
    {
        return $this->getAttribute(self::FIELD_DESCRIPTION);
    }

    public function getTitle()
    {
        return $this->getAttribute(self::FIELD_TITLE);
    }

    public function getText()
    {
        return $this->getAttribute(self::FIELD_TEXT);
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
        return $this->hasMany(Quiz::class);
    }
}
