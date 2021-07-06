<?php

namespace App\Core\Input\Fields\Base;

use App\Core\Error\ErrorManager;
use App\Core\Error\Regex;
use App\Core\Field;
use App\Core\IField;

class Price extends Field implements IField
{
    /**
     * Используется там где нужно указать этот Field как поле в FieldSet
     */
    const FIELD_KEY = 'price';

    /**
     * Используется в сообщениях где нужно вывести название поля
     */
    protected $fieldName = 'price';

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
                ':field' => $this->getFieldName()
            ], new Regex(), [$this->getFieldName()]));
        } else if (!is_null($this->field)) {
            if (!is_int($this->field)) {
                $this->errors->addError(ErrorManager::buildValidateError(VALIDATION_IS_NOT_INTEGER, [
                    ':field' => $this->getFieldName()
                ], new Regex(), [$this->getFieldName()]));
            } else {
                if (!preg_match('~^[0-9]{1,12}$~', $this->field)) {
                    $this->errors->addError(ErrorManager::buildValidateError(VALIDATION_WRONG_FORMAT, [
                        ':field' => $this->getFieldName()
                    ], new Regex('~^[0-9]{1,12}$~', 'Максимум 12 цифр'), [$this->getFieldName()]));
                } else {
                    if ($this->field <= 0) {
                        $this->errors->addError(ErrorManager::buildValidateError(VALIDATION_NOT_VALID, [
                            ':field' => $this->getFieldName()
                        ], new Regex(), [$this->getFieldName()]));
                    }
                }
            }
        }
    }

    function prepare()
    {
    }
}
