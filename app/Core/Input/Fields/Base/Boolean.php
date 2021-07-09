<?php

namespace App\Core\Input\Fields\Base;

use App\Core\Error\ErrorManager;
use App\Core\Error\Regex;
use App\Core\Field;
use App\Core\IField;

class Boolean extends Field implements IField
{
    /**
     * Используется там где нужно указать этот Field как поле в FieldSet
     */
    const FIELD_KEY = 'boolean';

    /**
     * Используется в сообщениях где нужно вывести название поля
     */
    protected $fieldName = 'boolean';

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
        } else if (!is_null($this->field)) {
            if (gettype($this->field) !== 'boolean') {
                $this->errors->addError(ErrorManager::buildValidateError(VALIDATION_IS_NOT_BOOLEAN, [
                    ':field' => $this->getFieldName()
                ],
                    new Regex('~^(true|false)$~i', 'Значение должно быть "true" или "false"'),
                    [$this->getFieldName()]));
            }
        }
    }

    function prepare()
    {
        if (!is_null($this->field)) {
            $this->field = filter_var($this->field, FILTER_VALIDATE_BOOLEAN);
        }
    }
}
