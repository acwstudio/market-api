<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Component extends Model
{
    use HasFactory;

    public $table = 'components';

    const FIELD_ID = 'id',
        FIELD_TITLE = 'title',
        FIELD_KEY = 'key',
        FIELD_VIEW_TYPE = 'view_type',
        FIELD_CREATED_AT = 'created_at',
        FIELD_UPDATED_AT = 'updated_at';

    const ENTITY_RELATIVE_METHODS = 'methods';

    public $fillable = [
        self::FIELD_TITLE,
        self::FIELD_KEY,
        self::FIELD_VIEW_TYPE
    ];

    public function getId()
    {
        return $this->getAttribute(self::FIELD_ID);
    }

    public function getTitle()
    {
        return $this->getAttribute(self::FIELD_TITLE);
    }

    public function getKey()
    {
        return $this->getAttribute(self::FIELD_KEY);
    }

    public function getViewType()
    {
        return $this->getAttribute(self::FIELD_VIEW_TYPE);
    }

    public function getCreatedAt()
    {
        return $this->getAttribute(self::FIELD_CREATED_AT);
    }

    public function getUpdatedAt()
    {
        return $this->getAttribute(self::FIELD_UPDATED_AT);
    }

    public function pages()
    {
        return $this->belongsToMany(Page::class);
    }

    public function methods()
    {
        return $this->hasMany(ComponentMethod::class);
    }
}
