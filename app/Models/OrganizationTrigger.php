<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class OrganizationTrigger extends Model
{
    use HasFactory;

    protected $table = 'organization_triggers';

    const FIELD_ID = 'id',
        FIELD_NAME = 'name',
        FIELD_DESCRIPTION = 'description',
        FIELD_CREATED_AT = 'created_at',
        FIELD_UPDATED_AT = 'updated_at';

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

    public function getCreatedAt()
    {
        return $this->getAttribute(self::FIELD_CREATED_AT);
    }

    public function getUpdatedAt()
    {
        return $this->getAttribute(self::FIELD_UPDATED_AT);
    }

    public function organizations()
    {
        return $this->morphToMany(Organization::class, 'organizationable');
    }

}
