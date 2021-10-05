<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ComponentMethod extends Model
{
    use HasFactory;

    public $table = 'component_method';

    const FIELD_ID = 'id',
        FIELD_COMPONENT_ID = 'component_id',
        FIELD_METHOD_ID = 'method_id',
        FIELD_DATA = 'data',
        FIELD_CREATED_AT = 'created_at',
        FIELD_UPDATED_AT = 'updated_at';
	
	const ENTITY_RELATIVE_METHOD = 'method';

    public $fillable = [
        self::FIELD_COMPONENT_ID,
        self::FIELD_METHOD_ID,
        self::FIELD_DATA,
    ];

    public function getId()
    {
        return $this->getAttribute(self::FIELD_ID);
    }

    public function getComponentId()
    {
        return $this->getAttribute(self::FIELD_COMPONENT_ID);
    }

    public function getMethodId()
    {
        return $this->getAttribute(self::FIELD_METHOD_ID);
    }

    public function getData()
    {
        return $this->getAttribute(self::FIELD_DATA);
    }

    public function getCreatedAt()
    {
        return $this->getAttribute(self::FIELD_CREATED_AT);
    }

    public function getUpdatedAt()
    {
        return $this->getAttribute(self::FIELD_UPDATED_AT);
    }

    public function component()
    {
        return $this->belongsTo(Component::class);
    }

    public function method()
    {
        return $this->belongsTo(Method::class);
    }
}
