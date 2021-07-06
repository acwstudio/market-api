<?php

namespace App\Core\Input\Fields\Base;

use App\Core\Error\ErrorManager;
use App\Core\Error\Regex;
use App\Core\Field;
use App\Core\IField;
use Carbon\Carbon;

class BaseDate extends Field implements IField
{
    /**
     * Используется в сообщениях где нужно вывести название поля
     */
    const FIELD_NAME = 'from';

    /**
     * Используется там где нужно указать этот Field как поле в FieldSet
     */
    const FIELD_KEY = 'from';


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
        } elseif (!is_null($this->field)) {
            try {
                Carbon::createFromFormat('d.m.Y', $this->field);
            } catch (\InvalidArgumentException $exception) {
                $this->errors->addError(ErrorManager::buildValidateError(VALIDATION_WRONG_FORMAT, [
                    ':field' => self::FIELD_NAME
                ], new Regex('~^[0-3][0-9].[0-1][0-9].[1-2][0-9]{3}\s[0-9]{2}:[0-9]{2}:[0-9]{2}~')));
            }
        }
    }

    function prepare()
    {
        if (!is_null($this->field)) {
            $d = Carbon::createFromFormat('d.m.Y', $this->field);
            $this->field = $d->format('Y-m-d');
        }
    }
}
