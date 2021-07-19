<?php


namespace App\Core\Input\Fields\Direction\Filter;

use App\Core\Error\ErrorManager;
use App\Core\Error\Regex;
use App\Core\Field;
use App\Core\IField;

class ProductIds extends Field implements IField{
    /**
     * Используется в сообщениях где нужно вывести название поля
     */
    const FIELD_NAME = 'product_ids';

    /**
     * Используется там где нужно указать этот Field как поле в FieldSet
     */
    const FIELD_KEY = 'product_ids';

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
        } else if (!is_null($this->field)) {
            if (!is_array($this->field)) {
                $this->errors->addError(ErrorManager::buildValidateError(VALIDATION_IS_NOT_ARRAY, [
                    ':field' => $this->getFieldName()
                ], new Regex(), [$this->getFieldName()]));
            }
        }
    }

    function prepare()
    {
    }
}
