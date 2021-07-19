<?php

namespace App\Core\Input\Fields\Subject\Filter;

use App\Core\Input\Fields\Base\StringField;

class Slug extends StringField
{
    /**
     * Используется в сообщениях где нужно вывести название поля
     */
    const FIELD_NAME = 'slug';

    /**
     * Используется там где нужно указать этот Field как поле в FieldSet
     */
    const FIELD_KEY = 'slug';
}
