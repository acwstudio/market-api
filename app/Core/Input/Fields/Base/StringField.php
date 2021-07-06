<?php

namespace App\Core\Input\Fields\Base;

use App\Core\Error\ErrorManager;
use App\Core\Error\Regex;
use App\Core\Field;
use App\Core\IField;


class StringField extends Field implements IField
{
    /**
     * Используется там где нужно указать этот Field как поле в FieldSet
     */
    const FIELD_KEY = 'string';

    /**
     * Используется в сообщениях где нужно вывести название поля
     */
    protected $fieldName = 'string';

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
        /**
         * Главная проверка, если поля нет и оно обязательное то дальше нет смысла проверять
         */
        if ($this->required && is_null($this->field)) {
            $this->errors->addError(ErrorManager::buildValidateError(VALIDATION_IS_REQUIRED, [
                ':field' => $this->getFieldName()
            ], new Regex(), [$this->getFieldName()]));
        } else if (!is_null($this->field)) {
            if (!is_string($this->field)) {
                $this->errors->addError(ErrorManager::buildValidateError(VALIDATION_IS_NOT_STRING, [
                    ':field' => $this->getFieldName()
                ], new Regex(), [$this->getFieldName()]));
            } else {

            }
        }
    }

    function prepare()
    {
    }
}
