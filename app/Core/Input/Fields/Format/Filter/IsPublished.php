<?php

namespace App\Core\Input\Fields\Format\Filter;

use App\Core\Input\Fields\Base\Boolean;

class IsPublished extends Boolean
{
    /**
     * Используется в сообщениях где нужно вывести название поля
     */
    const FIELD_NAME = 'published';

    /**
     * Используется там где нужно указать этот Field как поле в FieldSet
     */
    const FIELD_KEY = 'published';
}
