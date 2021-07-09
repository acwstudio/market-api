<?php

namespace App\Core\Input\Fields\Organization\Filter;

use App\Core\Error\ErrorManager;
use App\Core\Field;
use App\Core\IField;

class ParentId extends Field implements IField{
    /**
     * Используется в сообщениях где нужно вывести название поля
     */
    const FIELD_NAME = 'parent_id';

    /**
     * Используется там где нужно указать этот Field как поле в FieldSet
     */
    const FIELD_KEY = 'parent_id';

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
                ':field' => self::FIELD_NAME
            ]));
        }
    }

    function prepare()
    {
    }
}
