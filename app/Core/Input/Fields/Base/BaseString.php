<?php

namespace App\Core\Input\Fields\Base;

use App\Core\Error\ErrorManager;
use App\Core\Field;
use App\Core\IField;

/**
 * Class BaseString
 */
class BaseString extends Field implements IField
{

    /**
     * Используется в сообщениях где нужно вывести название поля
     */
    const FIELD_NAME = 'string';

    /**
     * Используется там где нужно указать этот Field как поле в FieldSet
     */
    const FIELD_KEY = 'string';


    protected $field = null;

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

    }
}
