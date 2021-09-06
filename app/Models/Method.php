<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Method extends Model
{
    use HasFactory;

    public $table = 'methods';

    const FIELD_ID = 'id',
        FIELD_NAME = 'name',
        FIELD_URL = 'url',
        FIELD_CREATED_AT = 'created_at',
        FIELD_UPDATED_AT = 'updated_at';

    public $fillable = [
        self::FIELD_NAME,
        self::FIELD_URL
    ];

    public function getId()
    {
        return $this->getAttribute(self::FIELD_ID);
    }

    public function getName()
    {
        return $this->getAttribute(self::FIELD_NAME);
    }

    public function getUrl()
    {
        return $this->getAttribute(self::FIELD_URL);
    }

    public function getCreatedAt()
    {
        return $this->getAttribute(self::FIELD_CREATED_AT);
    }

    public function getUpdatedAt()
    {
        return $this->getAttribute(self::FIELD_UPDATED_AT);
    }

    public function componentMethods()
    {
        return $this->hasMany(ComponentMethod::class);
    }
}
