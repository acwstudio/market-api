<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class App extends Model
{
    use HasFactory, SoftDeletes;

    public $table = 'apps';

    const MODEL_NAME = 'Приложения',
        MODEL_LINK = 'apps';

    const FIELD_ID = 'id',
        FIELD_APP = 'app',
        FIELD_KEY = 'key',
        FIELD_VALUE = 'value',
        FIELD_CREATED_AT = 'created_at',
        FIELD_UPDATED_AT = 'updated_at';

    public $fillable = [
        self::FIELD_ID,
        self::FIELD_APP,
        self::FIELD_KEY,
        self::FIELD_VALUE
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

    public function getApp()
    {
        return $this->getAttribute(self::FIELD_APP);
    }

    public function getKey()
    {
        return $this->getAttribute(self::FIELD_KEY);
    }

    public function getValue()
    {
        return $this->getAttribute(self::FIELD_VALUE);
    }

    public function getCreatedAt()
    {
        return $this->getAttribute(self::FIELD_CREATED_AT);
    }

    public function getUpdatedAt()
    {
        return $this->getAttribute(self::FIELD_UPDATED_AT);
    }
}
