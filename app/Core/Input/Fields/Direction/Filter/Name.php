<?php

namespace App\Core\Input\Fields\Direction\Filter;

use App\Core\Input\Fields\Base\StringField;

class Name extends StringField
{
    /**
     * Используется в сообщениях где нужно вывести название поля
     */
    const FIELD_NAME = 'name';

    /**
     * Используется там где нужно указать этот Field как поле в FieldSet
     */
    const FIELD_KEY = 'name';
}
