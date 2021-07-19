<?php

namespace App\Core\Input\Fields\Organization;

use App\Core\Error\ErrorManager;
use App\Core\Error\ErrorSet;
use App\Core\FieldSet;
use App\Core\IField;
use App\Core\Input\Fields\DataProvider\Sort;
use App\Core\Input\Fields\Organization\Filter;
use App\Models\Organization;

class OrganizationGetDetail extends FieldSet implements IField
{
    const FIELD_KEY = 'organization_get_detail';

    protected $fieldSetName = 'organization_get_detail';

    /**
     * @var Filter
     */
    protected $filter = null;

    /**
     * @var Sort
     */
    protected $sort = null;

    /**
     * Очень внимательно вписываем тут названия полей
     * @var string[] Fields этого набора
     */
    protected $fields = [
        Filter::FIELD_KEY     => Filter::class,
        Sort::FIELD_KEY       => Sort::class
    ];

    protected $requiredFields = [

    ];

    /**
     * Переопределение валидации для конкретной организации
     *
     * @return mixed|void
     */
    function validate(){
        parent::validate();

        if (empty($this->filter->getId()->getValue()) && empty($this->filter->getSlug()->getValue())){
            $this->makeValidationRequiredError($this->filter->getId()->getFieldName());
            $this->makeValidationRequiredError($this->filter->getSlug()->getFieldName());
        }
    }

    /**
     * @param $fieldName
     */
    private function makeValidationRequiredError($fieldName): void{
        $this->errors->addError(ErrorManager::buildValidateError(VALIDATION_IS_REQUIRED,
            [
                ':field' => $fieldName,
            ],
            null,
            [
                $fieldName
            ]
        ));
    }

    /**
     * @return Filter
     */
    public function getFilter(): Filter
    {
        return $this->filter;
    }

    /**
     * @return Sort
     */
    public function getSort(): Sort
    {
        return $this->sort;
    }
}
