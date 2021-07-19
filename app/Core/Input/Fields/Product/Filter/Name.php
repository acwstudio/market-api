<?php

namespace App\Core\Input\Fields\Product\Filter;

use App\Core\Input\Fields\Base\BaseString;
use App\Core\Input\Fields\Base\StringField;

class Name extends BaseString
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
