<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Quiz extends Model
{
    use HasFactory, SoftDeletes;

    public $table = 'quizzes';

    public const PAGES = [
        'catalog'    => 1,
        'homepage'   => 2,
        'product'    => 3,
        'university' => 4,
        'webinar'    => 5,
    ];

    const MODEL_NAME = 'Квизы',
        MODEL_LINK = 'quizzes';

    const FIELD_ID = 'id',
        FIELD_LEAD_ID = 'lead_id',
        FIELD_PUBLISHED = 'published',
        FIELD_NAME = 'name',
        FIELD_PAGE = 'page',
        FIELD_DESCRIPTION = 'description',
        FIELD_TITLE = 'title',
        FIELD_TEXT = 'text',
        FIELD_BUTTON = 'button',
        FIELD_BACKGROUND_IMAGE = 'background_image',
        FIELD_PERSON_IMAGE = 'person_image',
        FIELD_DELETED_AT = 'deleted_at',
        FIELD_CREATED_AT = 'created_at',
        FIELD_UPDATED_AT = 'updated_at';

    const ENTITY_RELATIVE_QUESTIONS = 'questions';

    public $fillable = [
        self::FIELD_ID,
        self::FIELD_LEAD_ID,
        self::FIELD_PUBLISHED,
        self::FIELD_NAME,
        self::FIELD_PAGE,
        self::FIELD_DESCRIPTION,
        self::FIELD_TITLE,
        self::FIELD_TEXT,
        self::FIELD_BUTTON,
        self::FIELD_BACKGROUND_IMAGE,
        self::FIELD_PERSON_IMAGE
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

    public function getLeadId()
    {
        return $this->getAttribute(self::FIELD_LEAD_ID);
    }

    public function getPublished()
    {
        return $this->getAttribute(self::FIELD_PUBLISHED);
    }

    public function getName()
    {
        return $this->getAttribute(self::FIELD_NAME);
    }

    public function getPage()
    {
        return $this->getAttribute(self::FIELD_PAGE);
    }

    public function getDescription()
    {
        return $this->getAttribute(self::FIELD_DESCRIPTION);
    }

    public function getTitle()
    {
        return $this->getAttribute(self::FIELD_TITLE);
    }

    public function getText()
    {
        return $this->getAttribute(self::FIELD_TEXT);
    }

    public function getButton()
    {
        return $this->getAttribute(self::FIELD_BUTTON);
    }

    public function getBackgroundImage()
    {
        return $this->getAttribute(self::FIELD_BACKGROUND_IMAGE);
    }

    public function getBackgroundImageUrl()
    {
        return Storage::url($this->getBackgroundImage());
    }

    public function getPersonImage()
    {
        return $this->getAttribute(self::FIELD_PERSON_IMAGE);
    }

    public function getPersonImageUrl()
    {
        return Storage::url($this->getPersonImage());
    }

    public function getCreatedAt()
    {
        return $this->getAttribute(self::FIELD_CREATED_AT);
    }

    public function getUpdatedAt()
    {
        return $this->getAttribute(self::FIELD_UPDATED_AT);
    }

    public function questions()
    {
        return $this->belongsToMany(Question::class);
    }

    public function lead()
    {
        return $this->belongsTo(Lead::class);
    }
}
