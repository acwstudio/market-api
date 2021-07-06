<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ThemeColor extends Model
{
    use HasFactory;

    public $table = 'theme_colors';

    const FIELD_ID = 'id',
        FIELD_PUBLISHED = 'published',
        FIELD_NAME = 'name',
        FIELD_KEY = 'key',
        FIELD_VALUE = 'value',
        FIELD_THEME_ID = 'theme_id',
        FIELD_CREATED_AT = 'created_at',
        FIELD_UPDATED_AT = 'updated_at';

    public function getId()
    {
        return $this->getAttribute(self::FIELD_ID);
    }

    public function getPublished()
    {
        return $this->getAttribute(self::FIELD_PUBLISHED);
    }

    public function getName()
    {
        return $this->getAttribute(self::FIELD_NAME);
    }

    public function getKey()
    {
        return $this->getAttribute(self::FIELD_KEY);
    }

    public function getValue()
    {
        return $this->getAttribute(self::FIELD_VALUE);
    }

    public function getThemeId()
    {
        return $this->getAttribute(self::FIELD_THEME_ID);
    }

    public function getCreatedAt()
    {
        return $this->getAttribute(self::FIELD_CREATED_AT);
    }

    public function getUpdatedAt()
    {
        return $this->getAttribute(self::FIELD_UPDATED_AT);
    }

    public function theme()
    {
        return $this->hasOne(Theme::class);
    }
}
