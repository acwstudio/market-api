<?php

namespace App\Core\Input\Fields\Organization\Filter;

use App\Core\Input\Fields\Base\StringField;

class Land extends StringField
{
    /**
     * Используется в сообщениях где нужно вывести название поля
     */
    const FIELD_NAME = 'land';

    /**
     * Используется там где нужно указать этот Field как поле в FieldSet
     */
    const FIELD_KEY = 'land';
}
