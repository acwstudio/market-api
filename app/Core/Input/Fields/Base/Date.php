<?php

namespace App\Core\Input\Fields\Base;

use App\Core\Error\ErrorManager;
use App\Core\Error\Regex;
use App\Core\Field;
use App\Core\IField;
use Carbon\Carbon;

class Date extends Field implements IField
{
    /**
     * Используется там где нужно указать этот Field как поле в FieldSet
     */
    const FIELD_KEY = 'date';

    /**
     * Используется в сообщениях где нужно вывести название поля
     */
    protected $fieldName = 'date';

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
            if (!is_string($this->field)) {
                $this->errors->addError(ErrorManager::buildValidateError(VALIDATION_IS_NOT_STRING, [
                    ':field' => $this->getFieldName()
                ], new Regex(), [$this->getFieldName()]));
            } else {
                if (!preg_match('~^[0-3][0-9].[0-1][0-9].[1-2][0-9]{3}$~', $this->field)) {
                    $this->errors->addError(ErrorManager::buildValidateError(VALIDATION_WRONG_FORMAT, [
                        ':field' => $this->getFieldName()
                    ], new Regex('~^[0-3][0-9].[0-1][0-9].[1-2][0-9]{3}~', 'Формат даты d.m.Y'), [$this->getFieldName()]));
                } else {
                    $date = Carbon::createFromFormat('d.m.Y', $this->field);

                    if (!($date->format('d.m.Y') == $this->field)) {
                        $this->errors->addError(ErrorManager::buildValidateError(VALIDATION_INVALID_DATE, [
                            ':field' => $this->getFieldName()
                        ], new Regex('~^[0-3][0-9].[0-1][0-9].[1-2][0-9]{3}~', 'Формат даты d.m.Y'), [$this->getFieldName()]));
                    } else {
                        if ($date > now()) {
                            $this->errors->addError(ErrorManager::buildValidateError(VALIDATION_WRONG_PAST_DATE, [
                                ':field' => $this->getFieldName()
                            ], new Regex('~^[0-3][0-9].[0-1][0-9].[1-2][0-9]{3}~', 'Формат даты d.m.Y'), [$this->getFieldName()]));
                        }
                    }
                }
            }
        }
    }


    function prepare()
    {

        /**
         * @todo: Maybe replace date format with const
         */
        if ($this->field) {
            /* @var $date Carbon */
            $date = ($this->field) ? Carbon::createFromFormat('d.m.Y', $this->field)->format('Y-m-d') : null;
            $this->field = $date;
        }
    }
}
