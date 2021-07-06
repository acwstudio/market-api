<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    public $table = 'roles';

    const FIELD_ID = 'id',
        FIELD_NAME = 'name',
        FIELD_LABEL = 'label',
        FIELD_GUARD_NAME = 'guard_name',
        FIELD_CREATED_AT = 'created_at',
        FIELD_UPDATED_AT = 'updated_at';

    public function getId()
    {
        return $this->attributes[self::FIELD_ID];
    }

    public function getName()
    {
        return $this->attributes[self::FIELD_NAME];
    }

    public function getLabel()
    {
        return $this->attributes[self::FIELD_LABEL];
    }

    public function getGuardName()
    {
        return $this->attributes[self::FIELD_GUARD_NAME];
    }
}
