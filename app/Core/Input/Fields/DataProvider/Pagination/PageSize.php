<?php

namespace App\Core\Input\Fields\DataProvider\Pagination;

use App\Core\Error\ErrorManager;
use App\Core\Field;
use App\Core\IField;

/**
 * Class PageSize
 * Размер страницы
 *
 */
class PageSize extends Field implements IField
{
    /**
     * Используется в сообщениях где нужно вывести название поля
     */
    const FIELD_NAME = 'page_size';

    /**
     * Используется там где нужно указать этот Field как поле в FieldSet
     */
    const FIELD_KEY = 'page_size';


    function setValue($value)
    {
        $this->field = $value;
    }

    function getValue()
    {
        return $this->field;
    }

    function validate()
    {
        if ($this->required && is_null($this->field)) {
            $this->errors->addError(ErrorManager::buildValidateError(VALIDATION_IS_REQUIRED, [
                ':field' => self::FIELD_NAME
            ]));
        } else {
            if (!is_int($this->field)) {
                $this->errors->addError(ErrorManager::buildValidateError(VALIDATION_IS_NOT_INTEGER, [
                    ':field' => self::FIELD_NAME
                ]));
            } else {
                if ($this->field > 100) {
                    $this->errors->addError(ErrorManager::buildValidateError(VALIDATION_MAX_PAGE_SIZE_EXCEEDED, [
                        ':field' => self::FIELD_NAME,
                        ':max' => 100
                    ]));
                }
            }
        }
    }

    function prepare()
    {
        parent::prepare();
    }
}
