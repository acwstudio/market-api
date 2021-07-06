<?php

namespace App\Core\Input\Fields\DataProvider\Sort;

use App\Core\Error\ErrorManager;
use App\Core\Field;
use App\Core\IField;

/**
 * Class SortField
 * Название поля по которому нужна сортировка
 */
class SortField extends Field implements IField
{
    /**
     * Используется в сообщениях где нужно вывести название поля
     */
    const FIELD_NAME = 'field';

    /**
     * Используется там где нужно указать этот Field как поле в FieldSet
     */
    const FIELD_KEY = 'field';


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
            if (!is_string($this->field)) {
                $this->errors->addError(ErrorManager::buildValidateError(VALIDATION_IS_NOT_STRING, [
                    ':field' => self::FIELD_NAME
                ]));
            }
        }
    }

    function prepare()
    {
        parent::prepare();
    }
}
