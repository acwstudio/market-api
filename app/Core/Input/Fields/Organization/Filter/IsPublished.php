<?php

namespace App\Core\Input\Fields\Organization\Filter;

use App\Core\Error\ErrorManager;
use App\Core\Error\Regex;
use App\Core\Field;
use App\Core\IField;

class IsPublished extends Field implements IField
{
    /**
     * Используется в сообщениях где нужно вывести название поля
     */
    const FIELD_NAME = 'published';

    /**
     * Используется там где нужно указать этот Field как поле в FieldSet
     */
    const FIELD_KEY = 'published';


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
            $this->errors->addError(
                ErrorManager::buildValidateError(VALIDATION_IS_REQUIRED, [
                    ':field' => self::FIELD_NAME
                ])
            );
        } else if (!is_null($this->field)) {
            if (gettype($this->field) !== 'boolean') {
                $this->errors->addError(ErrorManager::buildValidateError(VALIDATION_IS_NOT_BOOLEAN, [
                    ':field' => self::FIELD_NAME
                ], new Regex('~^(true|false)$~i', 'Должно быть "true" или "false"')));
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
