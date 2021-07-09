<?php

namespace App\Core\Input\Fields\DataProvider\Sort;

use App\Core\Error\ErrorManager;
use App\Core\Error\Regex;
use App\Core\Field;
use App\Core\IField;

/**
 * Class Order
 * Порядок сортировки
 */
class Order extends Field implements IField
{
    /**
     * Используется в сообщениях где нужно вывести название поля
     */
    const FIELD_NAME = 'order';

    /**
     * Используется там где нужно указать этот Field как поле в FieldSet
     */
    const FIELD_KEY = 'order';


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
            } else {
                if (!preg_match('~^(asc|desc)$~i', $this->field)) {
                    $this->errors->addError(ErrorManager::buildValidateError(VALIDATION_WRONG_FORMAT, [
                        ':field' => self::FIELD_NAME
                    ], new Regex('~^(asc|desc)$~i', 'Возможные значения "asc" или "desc"')));
                }
            }
        }
    }

    function prepare()
    {
        parent::prepare();
    }
}
