<?php

namespace App\Core\Input\Fields\Base;

use App\Core\Error\ErrorManager;
use App\Core\Error\Regex;
use App\Core\Field;
use App\Core\IField;

class Id extends Field
{
    /**
     * Используется там где нужно указать этот Field как поле в FieldSet
     */
    const FIELD_KEY = 'id';

    /**
     * Используется в сообщениях где нужно вывести название поля
     */
    protected $fieldName = 'id';
}
