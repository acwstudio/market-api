<?php


namespace App\Core\Input\Fields\Product\Filter;


use App\Core\Error\ErrorManager;
use App\Core\Error\Regex;
use App\Core\Field;
use App\Core\IField;
use App\Core\Input\Fields\Base\Boolean;

class IsDocument extends Boolean
{
    /**
     * Используется в сообщениях где нужно вывести название поля
     */
    const FIELD_NAME = 'is_document';

    /**
     * Используется там где нужно указать этот Field как поле в FieldSet
     */
    const FIELD_KEY = 'is_document';
}
