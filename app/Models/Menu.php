<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Menu extends Model
{
    use HasFactory, SoftDeletes;

    public $table = 'menus';

    const MODEL_NAME = 'Меню',
        MODEL_LINK   = 'menus';

    const FIELD_ID       = 'id',
        FIELD_ACTIVE     = 'active',
        FIELD_MODEL      = 'model',
        FIELD_MODEL_ID   = 'model_id',
        FIELD_POINTER    = 'pointer',
        FIELD_ANCHOR     = 'anchor',
        FIELD_CREATED_AT = 'created_at',
        FIELD_UPDATED_AT = 'updated_at';

    public $fillable = [
        self::FIELD_ACTIVE,
        self::FIELD_ANCHOR,
        self::FIELD_MODEL,
        self::FIELD_POINTER,
        self::FIELD_MODEL_ID
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

    public function getActive()
    {
        return $this->getAttribute(self::FIELD_ACTIVE);
    }

    public function getName()
    {
        return $this->model::find($this->model_id)->name;
    }

    public function getSort()
    {
        return $this->getAttribute(self::FIELD_POINTER);
    }

    public function getAnchor()
    {
        return $this->getAttribute(self::FIELD_ANCHOR);
    }

    public function getModel()
    {
        return $this->getAttribute(self::FIELD_MODEL);
    }

    public function getModelId()
    {
        return $this->getAttribute(self::FIELD_MODEL_ID);
    }

    public function getCreatedAt()
    {
        return $this->getAttribute(self::FIELD_CREATED_AT);
    }

    public function getUpdatedAt()
    {
        return $this->getAttribute(self::FIELD_UPDATED_AT);
    }

    public function menuable()
    {
        return $this->morphTo(__FUNCTION__, 'model', 'model_id');
    }
}
