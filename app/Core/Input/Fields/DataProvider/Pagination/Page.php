<?php

namespace App\Core\Input\Fields\DataProvider\Pagination;

use App\Core\Error\ErrorManager;
use App\Core\Field;
use App\Core\IField;

/**
 * Class Page
 * Номер страницы
 *
 * @package App\Core\Input\Fields\Common\GetCalculations\Pagination
 */
class Page extends Field implements IField
{
    /**
     * Используется в сообщениях где нужно вывести название поля
     */
    const FIELD_NAME = 'page';

    /**
     * Используется там где нужно указать этот Field как поле в FieldSet
     */
    const FIELD_KEY = 'page';


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
            if (!is_int($this->field)) {
                $this->errors->addError(ErrorManager::buildValidateError(VALIDATION_IS_NOT_INTEGER, [
                    ':field' => self::FIELD_NAME
                ]));
            }
        }
    }

    function prepare()
    {
        parent::prepare();
    }
}
