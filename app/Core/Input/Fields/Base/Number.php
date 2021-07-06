<?php

namespace App\Core\Input\Fields\Base;

use App\Core\Error\ErrorManager;
use App\Core\Error\Regex;
use App\Core\Field;
use App\Core\IField;

class Number extends Field implements IField
{
    /**
     * Используется там где нужно указать этот Field как поле в FieldSet
     */
    const FIELD_KEY = 'number';

    /**
     * Используется в сообщениях где нужно вывести название поля
     */
    protected $fieldName = 'number';

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
        if (!$this->required && is_null($this->field)) {
            return;
        }

        /**
         * Главная проверка, если поля нет и оно обязательное то дальше нет смысла проверять
         */
        if ($this->required && is_null($this->field)) {
            $this->errors->addError(ErrorManager::buildValidateError(VALIDATION_IS_REQUIRED, [
                ':field' => $this->getFieldName()
            ], new Regex(), [$this->getFieldName()]));

        } else if (!is_numeric($this->field)) {
            $this->errors->addError(ErrorManager::buildValidateError(VALIDATION_IS_NOT_NUMERIC, [
                ':field' => $this->getFieldName()
            ], new Regex(), [$this->getFieldName()]));
        }

    }

    function prepare()
    {

    }
}
