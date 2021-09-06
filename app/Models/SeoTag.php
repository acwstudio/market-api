<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SeoTag extends Model
{
    public $table = 'seo_tags';

    const FIELD_ID = 'id',
        FIELD_MODEL = 'model',
        FIELD_MODEL_ID = 'model_id',
        FIELD_TITLE = 'title',
        FIELD_KEYWORDS = 'keywords',
        FIELD_DESCRIPTION = 'description',
        FIELD_H1 = 'h1',
        FIELD_CREATED_AT = 'created_at',
        FIELD_UPDATED_AT = 'updated_at';

    public $fillable = [
        self::FIELD_TITLE,
        self::FIELD_KEYWORDS,
        self::FIELD_DESCRIPTION,
        self::FIELD_H1,
        self::FIELD_MODEL,
        self::FIELD_MODEL_ID
    ];

    public static function isTagsByParams($params, $prefix = '')
    {
        return !is_null($params[$prefix . self::FIELD_H1] ?? null)
            || !is_null($params[$prefix . self::FIELD_TITLE] ?? null)
            || !is_null($params[$prefix . self::FIELD_KEYWORDS] ?? null)
            || !is_null($params[$prefix . self::FIELD_DESCRIPTION] ?? null);
    }

    public function getId()
    {
        return $this->getAttribute(self::FIELD_ID);
    }

    public function getTitle()
    {
        return $this->getAttribute(self::FIELD_TITLE);
    }

    public function getH1()
    {
        return $this->getAttribute(self::FIELD_H1);
    }

    public function getKeywords()
    {
        return $this->getAttribute(self::FIELD_KEYWORDS);
    }

    public function getDescription()
    {
        return $this->getAttribute(self::FIELD_DESCRIPTION);
    }
}
