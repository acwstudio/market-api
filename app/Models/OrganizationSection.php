<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrganizationSection extends Model
{
    use HasFactory;

    public $table = 'organization_sections';

    const FIELD_ORGANIZATION_ID = 'organization_id',
        FIELD_SECTION_ID = 'section_id',
        FIELD_PUBLISHED = 'published',
        FIELD_TITLE = 'title',
        FIELD_SORT = 'sort',
        FIELD_JSON = 'json',
        FIELD_CREATED_AT = 'created_at',
        FIELD_UPDATED_AT = 'updated_at';

    protected $fillable = [
        self::FIELD_ORGANIZATION_ID,
        self::FIELD_SECTION_ID,
        self::FIELD_PUBLISHED,
        self::FIELD_TITLE,
        self::FIELD_SORT,
        self::FIELD_JSON,
    ];

    public function getPublished()
    {
        return $this->getAttribute(self::FIELD_PUBLISHED);
    }

    public function getOrganizationId()
    {
        return $this->getAttribute(self::FIELD_ORGANIZATION_ID);
    }

    public function getSectionId()
    {
        return $this->getAttribute(self::FIELD_SECTION_ID);
    }

    public function getTitle()
    {
        return $this->getAttribute(self::FIELD_TITLE);
    }

    public function getSort()
    {
        return $this->getAttribute(self::FIELD_SORT);
    }

    public function getJson()
    {
        return $this->getAttribute(self::FIELD_JSON);
    }

    public function getCreatedAt()
    {
        return $this->getAttribute(self::FIELD_CREATED_AT);
    }

    public function getUpdatedAt()
    {
        return $this->getAttribute(self::FIELD_UPDATED_AT);
    }

    public function organization()
    {
        return $this->hasOne(Organization::class);
    }

    public function section()
    {
        return $this->hasOne(Section::class, Section::FIELD_ID, self::FIELD_SECTION_ID);
    }
}
