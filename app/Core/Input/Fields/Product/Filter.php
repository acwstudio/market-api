<?php

namespace App\Core\Input\Fields\Product;

use App\Core\FieldSet;
use App\Core\IField;
use App\Core\Input\Fields\Organization\Filter\Ids;
use App\Core\Input\Fields\Product\Filter\DirectionIds;
use App\Core\Input\Fields\Product\Filter\ExpirationDateTime;
use App\Core\Input\Fields\Product\Filter\FormatIds;
use App\Core\Input\Fields\Product\Filter\IsDocument;
use App\Core\Input\Fields\Product\Filter\IsEmployment;
use App\Core\Input\Fields\Product\Filter\IsInstallment;
use App\Core\Input\Fields\Product\Filter\IsPublished;
use App\Core\Input\Fields\Product\Filter\LevelIds;
use App\Core\Input\Fields\Product\Filter\Name;
use App\Core\Input\Fields\Product\Filter\OrganizationIds;
use App\Core\Input\Fields\Product\Filter\PersonIds;
use App\Core\Input\Fields\Product\Filter\Slug;
use App\Core\Input\Fields\Product\Filter\SubjectIds;

class Filter extends FieldSet implements IField
{
    const FIELD_KEY = 'filter';

    protected $fieldSetName = 'filter';

    /**
     * @var IsPublished
     */
    protected $published = null;

    /**
     * @var Name
     */
    protected $name = null;

    /**
     * @var ExpirationDateTime
     */
    protected $expiration_date = null;

    /**
     * @var Slug
     */
    protected $slug = null;

    /**
     * @var Ids
     */
    protected $ids = null;

    /**
     * @var IsDocument
     */
    protected $document = null;

    /**
     * @var IsDocument
     */
    protected $is_document = null;

    /**
     * @var IsInstallment
     */
    protected $is_installment = null;

    /**
     * @var IsEmployment
     */
    protected $employment = null;

    /**
     * @var OrganizationIds
     */
    protected $organization_ids = null;

    /**
     * @var SubjectIds
     */
    protected $subject_ids = null;

    /**
     * @var FormatIds
     */
    protected $format_ids = null;

    /**
     * @var LevelIds
     */
    protected $level_ids = null;

    /**
     * @var DirectionIds
     */
    protected $direction_ids = null;

    /**
     * @var PersonIds
     */
    protected $person_ids = null;

    /**
     * Очень внимательно вписываем тут названия полей
     * @var string[] Fields этого набора
     */
    protected $fields = [
        IsPublished::FIELD_KEY        => IsPublished::class,
        Name::FIELD_KEY               => Name::class,
        Slug::FIELD_KEY               => Slug::class,
        DirectionIds::FIELD_KEY       => DirectionIds::class,
        Ids::FIELD_KEY                => Ids::class,
        IsDocument::FIELD_KEY         => IsDocument::class,
        IsInstallment::FIELD_KEY      => IsInstallment::class,
        IsEmployment::FIELD_KEY       => IsEmployment::class,
        OrganizationIds::FIELD_KEY    => OrganizationIds::class,
        SubjectIds::FIELD_KEY         => SubjectIds::class,
        FormatIds::FIELD_KEY          => FormatIds::class,
        LevelIds::FIELD_KEY           => LevelIds::class,
        PersonIds::FIELD_KEY          => PersonIds::class,
        ExpirationDateTime::FIELD_KEY => ExpirationDateTime::class,
    ];

    protected $requiredFields = [

    ];

    /**
     * @return IsPublished
     */
    public function getIsPublished(): IsPublished
    {
        return $this->published;
    }

    public function getName(): Name
    {
        return $this->name;
    }

    public function getSlug(): Slug
    {
        return $this->slug;
    }

    public function getDirectionIds(): DirectionIds
    {
        return $this->direction_ids;
    }

    public function getIds(): Ids
    {
        return $this->ids;
    }

    /**
     * @return IsDocument
     */
    public function getIsDocument(): IsDocument
    {
        return $this->is_document;
    }

    /**
     * @return IsInstallment
     */
    public function getIsInstallment(): IsInstallment
    {
        return $this->is_installment;
    }

    /**
     * @return IsEmployment
     */
    public function getIsEmployment(): IsEmployment
    {
        return $this->employment;
    }

    /**
     * @return OrganizationIds
     */
    public function getOrganizationIds(): OrganizationIds
    {
        return $this->organization_ids;
    }

    /**
     * @return SubjectIds
     */
    public function getSubjectIds(): SubjectIds
    {
        return $this->subject_ids;
    }

    /**
     * @return FormatIds
     */
    public function getFormatIds(): FormatIds
    {
        return $this->format_ids;
    }

    /**
     * @return LevelIds
     */
    public function getLevelIds(): LevelIds
    {
        return $this->level_ids;
    }

    /**
     * @return PersonIds
     */
    public function getPersonIds(): PersonIds
    {
        return $this->person_ids;
    }

    /**
     * @return ExpirationDateTime
     */
    public function getExpirationDateTime(): ExpirationDateTime
    {
        return $this->expiration_date;
    }
}
